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

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	$javascript = "<script>
		// 결제버튼
		function popup_submit(mode,uid){
			
            var url = \"ajax_sales_trans_syncup.php?mode=\"+mode+\"&uid=\"+uid;
			// alert(url);
			$.ajax({
            	url:url,
            	type:'post',
            	async:false,
            	data:$('form').serialize(),
            	success:function(data){
            		$('#popup_body').html(data);
            	}
        	});

        	// 팝업창 종료
			popup_close();
            	
		}		

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

    </script>";

    

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 판매재고 관련 함수들...
		include "sales_function.php";
		
		$mode = _formdata("mode");
		if($mode == "import_cancel"){
			// export 취소
			$uid = _formdata("uid");
    		if($site_mobile == "m") $width = "300px"; else $width = "500px";

			$title = "자료 승인취소";
			$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"sales_trans_export",$site_language,$site_mobile) );

			$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>								
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$body = str_replace("{form_submit}","<input type='button' value='승인 취소' onclick=\"javascript:popup_submit('import_cancel','$uid')\" style=\"".$css_btn_gray."\" >",$body);

			echo $body;

		} else if($mode == "export_cancel"){
			// export 전표 취소화면 표시

			$uid = _formdata("uid");
    		if($site_mobile == "m") $width = "300px"; else $width = "500px";

			$title = "자료 전송취소";
			$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"sales_trans_export",$site_language,$site_mobile) );

			$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>								
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
			$body = str_replace("{formend}","</form>",$body);

		
			if($rows = _sales_transRows_Id($uid)){
				if($rows->import == "on"){
					$msg_alert = "상대방이 승인한 자료는 일방적으로 승인을 취소할 수 없습니다.";
					$body = str_replace("{form_submit}",$msg_alert,$body);
				} else {
					// submit 클릭시 실제적인 동작은 ajax_sales_trans_syncup.php 에서 처리됨.
					$body = str_replace("{form_submit}","<input type='button' value='전송 취소' onclick=\"javascript:popup_submit('export_cancel','$uid')\" style=\"".$css_btn_gray."\" >",$body);
				}	
			}			

			echo $body;


		
		} else if($mode == "export"){
			// 선택 전표, Export 처리

			// 작성자 export
			$business = _formdata("business");
			$query1 = "select * from `sales_business` where Id = '".$business."'";
			//echo $query1."<br>";
			if($business_rows = _sales_query_rows($query1)){
				if($business_rows->email) {
					$export = true; 
				} else {
					$export = false;
					$msg .= "자료 전송을 위해서는 내사업자 정보 이메일이 필요합니다.";
				}
			} else {
				$msg .= "발급 사업자가 선택되지 않았습니다.";
				$export = false;
			}

			// 거래처 Import
			$company_id = _formdata("company_id");
			$query1 = "select * from `sales_company` where Id = '".$company_id."'";
			//echo $query1."<br>";
			if($company_rows = _sales_query_rows($query1)){
				if($company_rows->email) {
					$import = true; 
				} else {
					$import = false;
					$msg .= "자료 전송을 위해서는 거래처 정보 이메일이 필요합니다.";
				}
			} else {
				$msg .= "거래처 선택되지 않았습니다.";
				$import = false;
			}


			$code = "*".$sales_db->Id.":".$business.";";

			// 결체 체크 목록
			//# 선택한 결제 전표 목록 출력.

			$TID = $_POST['TID'];		
			if($TID && $import && $export){
				for($i=0;$i<count($TID);$i++){
					// 선택값을 or로 연결, query 생성
					$where .= " Id='$TID[$i]' or ";

					// trans Export 갱신 query 생성
					// 속도를 위하여, 하나의 Query 형태로 연결				
					$query_transExport .= "UPDATE `sales_trans` SET  `lock`= 'on', `export`= 'on', `export_times`= '$TODAYTIME' WHERE `Id`='$TID[$i]';";					

				}

				_sales_query($query_transExport);


				$where .= ";";
				$where = str_replace("or ;", ";", $where);
				$query = "select * from `sales_trans` where ".$where;

				$msg .= $query."<br>";
				if($trans_rowss = _sales_query_rowss($query)){
					// 선택한 모든 TID를 rowss 결과를, json 으로 전송함
					$_POST['trans_json'] = addslashes( json_encode($trans_rowss) );
				}	

			}


			// *****
			// 선택한 정보를 마스터 동기서버에 저장
			$_POST['mode'] = "export";
			$_POST['transSync_code'] = $sales_db->Id.":".$business_rows->Id.":".$company_rows->Id.";"; // 회원번호:사업자:거래처

			$_POST['company_json'] = addslashes( json_encode($company_rows) );
			$_POST['business_json'] = addslashes( json_encode($business_rows) );
			
			$_POST['export_name'] = $business_rows->business;
			$_POST['export_email'] = $business_rows->email;
			$_POST['export_times'] = $TODAYTIME;
			$_POST['import_name'] = $company_rows->company;
			$_POST['import_email'] = $company_rows->email;   			

			// CUTL POST 처리
			$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
			$curl_url = "http://www.saleshosting.co.kr/sales/curl_trans_sync.php";
			$curl_return = _curl_post($curl_url,$_POST);		





    		//
    		// 화면 출력 부분 
			if($site_mobile == "m") $width = "300px"; else $width = "500px";

			$title = "자료 전송";
			$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"sales_trans_export",$site_language,$site_mobile) );

			$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode' value='export'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$msg = "선택한 전표를 거래처와 공유전송 되었습니다.";
			$body = str_replace("{form_submit}",$msg,$body);

			echo $body;

			// 신규 입력한 내역을 포함, 거래내역을 갱신함.
			echo "<script>
				$.ajax({
            		url:'ajax_sales_trans_list.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#translist').html(data);
            		}
        		});
    		</script>";    		

		}

	
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}

	


?>

