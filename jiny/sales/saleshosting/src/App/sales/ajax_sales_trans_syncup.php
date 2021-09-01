<?
	@session_start();

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");


	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");
		
		// 판매재고 관련 함수들...
		include "sales_function.php";



		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");


		// echo "ajax_sales_trans_syncup";
		if($mode == "import_cancel"){
			//echo "import 승인을 취소합니다.";
			
			if($rows = _sales_transRows_Id($uid)){
				
				// 거래처 정보를 읽어옵니다.
				if($company_rows = _sales_companyRows_Id($rows->company_id)){

					// 거래처로부터 선택한 import 금액을 차감합니다.
					_sales_companyRows_balance($company_rows, $rows->trans, "-".$rows->total);

					//echo $company_rows->email;

					// 상대방 거래처에게 import한 정보를 삭제
					// 상대방 trans 에 접근, import 필드를 clear
					
					if($host_rows = _service_hostRows_email($company_rows->email)){
						$_POST['mode'] = "import_clear";	// CURL : 상대방 전표 import 초기화 
						$_POST['uid'] = $rows->export_tid;	// 상대방 원전표 id값 

						// CUTL POST 처리
						$_POST['adminkey'] = $host_rows->adminkey; // CURL 콜처리를 위한 adminkey값 적용
						$curl_url = "http://".$host_rows->domain."/sales/curl_trans_sync.php";					
						//echo $curl_url;
						$curl_return = _curl_post($curl_url,$_POST);
						
					}
					
				
					// 선택한 전표를 삭제합니다.
					_sales_transDelete_Id($uid);
				
				}

			}
	
			// 신규 입력한 내역을 포함, 거래내역을 갱신함.
			echo "<script> ajax_sync('#translist','ajax_sales_trans_list.php'); </script>";
		

		} else if($mode == "export_cancel"){
			// 전송한 export를 취소합니다.
			// ajax_sales_trans_export.php 에서 호출되는 동작	
			if($rows = _sales_transRows_Id($uid)){
				
				if($rows->import == "on"){
					$msg_alert = "상대방이 승인한 자료는 일방적으로 승인을 취소할 수 없습니다.";
					// 일방적으로 취소하면 상대방의 링크가 깨짐.
					//echo "<script> alert(\"$msg_alert\"); </script>";
				} else {
					// 상대방이 아직 미승인 자료는 취소할 수 있습니다.
					// 우선 선택한 전표의 Export 정보를 삭제합니다.					
					$query1 = "UPDATE `sales_trans` SET  `lock`= '', `export`= '', `export_times`= '$TODAYTIME' WHERE `Id`='$uid'";
					//echo $query1."<br>";
					_sales_query($query1);
					
					// 공유 service.trans_sync 자료를 찾아 삭제합니다.
					// 회원번호:사업자:거래처
					$transSync_code = $sales_db->Id.":".$rows->business.":".$rows->company_id.";"; 
					$query1 = "DELETE FROM service.trans_sync WHERE `trans_id`='$uid' and `transSync_code`='$transSync_code' ";
    				//echo $query1."<br>";
					_sales_query($query1);

					$msg_alert = "자료전송 취소 성공";
					echo "<script> alert(\"$msg_alert\"); </script>";
				}
			}

			// 신규 입력한 내역을 포함, 거래내역을 갱신함.
			echo "<script> ajax_sync('#translist','ajax_sales_trans_list.php'); </script>";


		} else if($mode == "syncNew"){
			// 자료 전표 신규 import 승인			
			if($rows = _service_transRows_Id($uid)){

				// 내 사업자 확인
				// 전송받은 내사업자가 있는지 확인 
				if($business_rows = _sales_businessRows_Email_Name($rows->import_email,$rows->import_name) ){
				} else {
					//echo "미등록 사업자, 내정보 추가 <br>";
					_sales_buinsessInsert_json($rows->import_data);
					// 사업자 등록후 business_rows 정보 읽어, 필드 정보 추가함.
					$business_rows = _sales_businessRows_Email_Name($rows->import_email,$rows->import_name);							
				}


				// 거래처 정보 확인
				// 전송한 사업자가 거래처 등록되어 있는지 확인 
				if($company_rows = _sales_companyRows_Email_Name($rows->export_email, $rows->export_name)){	
					_sales_companyRows_balance($company_rows, $rows->trans, $rows->total);

				} else {
					//echo "새로운 거채처를 등록을 합니다. <br>";
					_sales_companyInsert_json($rows->export_data);
					// 거래처 등록후 company_rows 정보 읽어, 필드 정보 추가함.
					$company_rows = _sales_companyRows_Email_Name($rows->export_email, $rows->export_name);					
				}

				// 선택한 자료 갱신				
				// 자료 전산 작업하는 실제적인 날짜/시간
				_sales_transImport($business_rows,$company_rows,$rows);
				

				// ************
				// 자료 승인결과 전송 : Curl
				// 자료 전송한 상대방에게 자표 승인결과를 통보합니다.
				if($host_rows = _service_hostRows_email($company_rows->email)){
					$_POST['mode'] = "import_auth";
					$_POST['uid'] = $rows->trans_id; // 원전표 id값 

					// CUTL POST 처리
					$_POST['adminkey'] = $host_rows->adminkey; // CURL 콜처리를 위한 adminkey값 적용
					$curl_url = "http://".$host_rows->domain."/sales/curl_trans_sync.php";
					//echo $curl_url."<br>";
					$curl_return = _curl_post("http://".$host_rows->domain."/sales/curl_trans_sync.php",$_POST);
					//echo $curl_return;						
				}				

			}
		}	



		
	} else {
		$body = _theme_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}
	


	


	
?>

