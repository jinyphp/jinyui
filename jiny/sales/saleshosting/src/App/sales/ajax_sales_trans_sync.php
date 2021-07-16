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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	
	$javascript = "<script>
		function mode(mode,uid,limit){
			var url = \"ajax_sales_trans_syncup.php\";
			alert(url);

			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

        function search(){
        	list(0);
        }

        function list(limit){
			var url = \"ajax_sales_trans_sync.php\";
        	var form = document.sales;
        	form.limit.value = limit;
        	// alert(url);
			ajax_html('#mainbody',url);
    	}

    	// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.sales.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

    	// 국가
 		$('#country_list').on('change',function(){
        	list(0);
    	});

    	// 사업장
 		$('#business_list').on('change',function(){
        	list(0);
    	});

    	// 
 		$('#inout_list').on('change',function(){
        	list(0);
    	});
                
    </script>";



	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"sales_trans_sync",$site_language,$site_mobile);

		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$country_list = _formdata("country_list");
		$inout_list = _formdata("inout_list"); if(!$inout_list) $inout_list = _formdata("inout");
		// echo "inout = $inout <br>";
		
		// 출력 목록수 지정
		$_block_num = 10;
		if($_list_num = _formdata("list_num")){
		} else $_list_num = 10;

		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);

		
		$body = str_replace("{formstart}","<form name='sales' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
								<input type='hidden' name='inout' value='$inout'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		

		// service.business 거래처 전체목록에서, 나와 연결된 links 에 이메일을 검색함.
		$query = "select * from service.trans_sync ";
		/*
		if($mode == "export") {
			// 자료 전송 이력
			$query .= "where export_email = '".$_COOKIE['cookie_email']."' ";
		} if($mode == "import") {
			// 자료 전송 이력
			$query .= "where import_email = '".$_COOKIE['cookie_email']."' ";
		} else {
			$query .= "where import_email = '".$_COOKIE['cookie_email']."' || export_email = '".$_COOKIE['cookie_email']."' ";
		}
		$query .= "order by regdate desc ";	
		*/

		// import 자료
		$query .= "where import_email = '".$_COOKIE['cookie_email']."' ";

		$trans = _formdata("trans");
		if($trans == "sell") $query .= "and trans = 'buy' "; else if($trans == "buy") $query .= "and trans = 'sell' ";

		// 전체 또는 검색된 데이터 갯수를 얻음.
		$total = _mysqli_query_count($query); 

		$_list_num = 10;
		$limit = _formdata("limit");
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// 검색된 데이터 내에서 , limit 설정 
		// echo $query."<br>";




		
		$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'><input type='checkbox' name='chk_all' id=\"check_all\"></td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>전송일자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>구분</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>사업자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>거래처</td>";	

		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >상품명</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>수량</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>금액</td>";

		
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>동기화</td>";
		$list .= "</tr></table>";

		if($rowss = _sales_query_rowss($query)){			

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	

				// 발급자와 전표 아이디 동일한 내용이 있는지 확인
				$query1 = "select * from sales_trans where export_link ='".$rows->transSync_code."' and export_tid = '".$rows->trans_id."'";
				if($sync_rows = _sales_query_rows($query1)){
					// 저장된 전표
					//if($rows->linkTimes > $sync_rows->export_times) $sync = "<a href='#' onclick=\"javascript:mode('syncEdit','".$rows->code."','$limit')\">update</a>";
					//else 
						$sync = "update";
				} else {
					//  신규 전표
					if($rows->trans == "sell"){
						// 원 전표 매출 -> 매입승인
						$sync = "<a href='#' onclick=\"javascript:mode('syncNew','".$rows->Id."','$limit')\">매입승인</a>";
					} else if($rows->trans == "sell"){
						// 원 전표 매입 -> 매출승인
						$sync = "<a href='#' onclick=\"javascript:mode('syncNew','".$rows->Id."','$limit')\">매출승인</a>";
					}
					
				}
				




				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
				if($rows->trans == "sell") $trans = "매입"; else if($rows->trans == "buy") $trans = "매출";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'>".$tid."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$trans."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->export_name."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->import_name."</td>

						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->goodname."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->num."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->total."</td>

						  
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> $sync </td>
							</tr>
						</table>";
			}

			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}", $list.$listbar, $body);

		} else {
			$msg = "동기화 목록이 없습니다.";

			$list  .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' align='center'>$msg</td>";
			$list .= "</tr></table>";	
			
			$body = str_replace("{datalist}", $list, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	




	
?>
