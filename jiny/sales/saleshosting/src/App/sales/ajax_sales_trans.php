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


	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");

	$javascript = "<script>
		function trans_newdata(){
			ajax_async('#newdata','ajax_sales_trans_newdata.php');
		}

		// ++ 전표 작성일자 변경
		$('#transdate').on('change',function(){
        	trans_list();
        	trans_newdata();
    	});

    	// 전표일자 변경, 엔터 입력시
		$('#transdate').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
            	trans_list();
        	}
    	});

    	// 거래내역 화면 갱신
    	function trans_list(){
    		ajax_async('#translist','ajax_sales_trans_list.php');
    	}

    	// ===================
		// 거래처 검색 , 키 엔터 
		$('#company_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
            	company_search();
        	}
    	});

		// 거래처 검색 팝업 
		$('#btn_company_search').click(function(){
			company_search();
		});

		// 거래처 추가 팝업 
		$('#btn_company_add').click(function(){
			// var url = \"ajax_sales_company_edit.php?popup=ture\";
			// popup_ajax(url);
			ajax_async('#mainbody','ajax_sales_company_edit.php');
		});

		// 거래처 검색팝업
		function company_search(){
			var business_id = document.getElementsByName('business');
           	if(!business_id ){
           		alert(\"사업자를 선택해 주세요\");
           	} else {
				var url = \"ajax_sales_trans_company.php\";
				popup_ajax(url);	
			}			
		}

		// ===================
		// 전표 삭제 
		$('#btn_delete').on('click',function(){
           	trans_del();
       	});

		function trans_del(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       		var chk_export = document.getElementsByName('export[]');
       		var chk_import = document.getElementsByName('import[]');
       		var pay = document.getElementsByName('pay[]');
       		var chk_count = 0;
       		
       		
       		for(var i=0;i<chk.length;i++){
       			if(chk[i].checked) {
       				chk_count++;       				
       				if(chk_export[i].value) {
       					alert(\"Export 전표는 삭제할 수 없습니다.\");
       					return;
       				}

       				if(chk_import[i].value) {
       					alert(\"Import 전표는 삭제할 수 없습니다.\");
       					return;
       				} 

       				if(pay[i].value) {
       					alert(\"결제된 전표는 선택할 수 없습니다.\");
       					return;
       				}


       			}
       		}

			
			if(chk.length > 0){
				if(chk_count > 0){
					var returnValue = confirm(\"선택한 거래를 삭제하겠습니까?\");
					if(returnValue == true){
 						var url = \"ajax_sales_trans_list.php?mode=delete\";
 						ajax_async('#translist',url);
 					}
 				} else alert(\"선택된 거래내역이 없습니다.\");
 			} else alert(\"기입된 거래전표 리스트가 없습니다.\");
 		}


 		$('#btn_pay').on('click',function(){
 			var company_id = document.getElementsByName('company_id');
            if(!company_id ){
            	alert(\"거래처를 선택해 주세요\");
            } else {
            	trans_pay();
       		}
       	});

       	// 선택 전표, 입출금 결제 
 		function trans_pay(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       		var pay = document.getElementsByName('pay[]');
       		var chk_count = 0;
       				
       		for(var i=0;i<chk.length;i++){
       			if(chk[i].checked) {
       				chk_count++;
       				if(pay[i].value) {
       					alert(\"결제된 전표는 선택할 수 없습니다.\");
       					return;
       				}
       			}
       		}
       				
			if(chk.length > 0){
				if(chk_count > 0){
					var url = \"ajax_sales_trans_pay.php\";
					popup_ajax(url);
 				} else alert(\"선택된 거래내역이 없습니다.\");
 			} else alert(\"기입된 거래전표 리스트가 없습니다.\");

 		}

 		
 		$('#btn_print').on('click',function(){
 			var company_id = document.getElementsByName('company_id');
           	if(!company_id ){
           		alert(\"거래처를 선택해 주세요\");
           	} else {
           		trans_print();
       		}
       	});

       	// 선택 전표, 출력 
 		function trans_print(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       		var pay = document.getElementsByName('pay[]');
       		var chk_count = 0;
       				
       		for(var i=0;i<chk.length;i++){
       			if(chk[i].checked) {
       				chk_count++;
       				if(pay[i].value) {
       					alert(\"결제된 전표는 선택할 수 없습니다.\");
       					return;
       				}
       			}
       		}
       				
			if(chk.length > 0){
				if(chk_count > 0){
					var url = \"/tcpdf/trans_pdf.php\";		
					var form = document.trans;
					form.action = url;  //이동할 페이지						
			
					form.submit();
 				} else {
 					alert(\"선택된 거래내역이 없습니다.\");
 				}
 			} else {
 				alert(\"기입된 거래전표 리스트가 없습니다.\");
 			}
 		}

 		
 		// 선택 전표, 전표 
 		$('#btn_export').on('click',function(){
 			var company_id = document.getElementsByName('company_id');
           	if(!company_id ){
           		alert(\"거래처를 선택해 주세요\");
           	} else {
           		trans_export();
       		}
 		});
 		
 		function trans_export(){

 			var submit = false;
       		var chk = document.getElementsByName('TID[]');
       		var chk_export = document.getElementsByName('export[]');
       		var chk_import = document.getElementsByName('import[]');
       		var chk_count = 0;
       		
       		for(var i=0;i<chk.length;i++){
       			if(chk[i].checked) {
       				chk_count++;       				
       				if(chk_export[i].value) {
       					alert(\"Export된 전표는 선택할 수 없습니다.\");
       					return;
       				}   

       				if(chk_import[i].value) {
       					alert(\"Import 전표는 재전송 할 수 없습니다.\");
       					return;
       				} 

       			}
       		}

       		if(chk.length > 0){
				if(chk_count > 0){
					var url = \"ajax_sales_trans_export.php?mode=export\";
					popup_ajax(url);
 				} else {
 					alert(\"선택된 거래내역이 없습니다.\");
 				}
 			} else {
 				alert(\"기입된 거래전표 리스트가 없습니다.\");
 			}
 		}
  
    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 판매재고 관련 함수들...
		include "sales_function.php";

		
		$body = $javascript._theme_page($site_env->theme,"sales_trans",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,469),$body);

		$css_btn ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";

		$mode = _formmode();
		$company_id = _formdata("company_id");
		$transdate = _formdata("transdate");
		$warehouse = _formdata("warehouse");
		$manager = _formdata("manager");

		// 거래구분 설정
		$trans = _formdata("trans"); if(!$trans) $trans = "sell";
		$body = str_replace("{trans}", _html_FormRadio_sel("trans","매출=sell;매입=buy",$trans) ,$body);

		//$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='trans' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='msg' id=\"msg\">
								<input type='hidden' name='tax' id=\"company_tax\">
								<input type='hidden' name='currency' id=\"currency\">
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// 전표 삭제 버튼
		$body = str_replace("{delete}","<input type='button' value='삭제' style=\"".$css_btn_gray."\" id=\"btn_delete\">",$body);

		// 전표 결제 버튼
		if($trans == "sell") $body = str_replace("{pay}","<input type='button' value='입금' style=\"".$css_btn_gray."\" id=\"btn_pay\">",$body);
		else $body = str_replace("{pay}","<input type='button' value='출금' style=\"".$css_btn_gray."\" id=\"btn_pay\">",$body);
		
		$body = str_replace("{export}","<input type='button' value='자료전송' style=\"".$css_btn_gray."\" id=\"btn_export\">",$body);
		$body = str_replace("{print}","<input type='button' value='인쇄' style=\"".$css_btn_gray."\" id=\"btn_print\">",$body);

		//# 전표 작성일자 설정
		// 작성일자 변경시, 해당월로 페이지 이동
		if($transdate) {
			$body = str_replace("{transdate}","<input type='date' name='transdate' value='$transdate' style=\"$css_textbox\" id=\"transdate\">",$body);
		} else {
			$body = str_replace("{transdate}","<input type='date' name='transdate' value='$TODAY' style=\"$css_textbox\" id=\"transdate\">",$body);
		}

		//# 거래처 화면 및 검색처리..
		$query = "select * from `sales_company` where Id = '$company_id'";
		if($coms = _sales_query_rows($query)){
			$balance1 = $coms->balance1;			
			$body = str_replace("{company_search}","<input type='text' name='company_search' style=\"$css_textbox\" id=\"company_search\">",$body);
		} else {
			$body = str_replace("{company_search}","<input type='text' name='company_search' placeholder='거래처명 검색' style=\"$css_textbox\" id=\"company_search\">",$body);
		}	
		$body = str_replace("{search}","<input type=hidden name=company_id value='$company_id' id=\"company_id\">
			<input type='button' value='검색' style=\"".$css_btn."\" id=\"btn_company_search\">",$body);
		
		$body = str_replace("{company_add}","<input type='button' value='+' id=\"btn_company_add\">",$body);

		// ++ 창고리스트  처리
		$body = str_replace("{warehouse}",_sales_warehouseRows_OnSelect($warehouse),$body);		

		// ++ 담당자 처리
		$body = str_replace("{manager}",_sales_managerRows_OnSelect($manager),$body);
		
		// ++ 사업장 선택 
		$body = str_replace("{business}",_sales_businessRows_select($rows->business),$body);		

		// ++ 세율 적용
		$body = str_replace("{currency}","<span id=\"currency_view\"></span>",$body);

		// ++ 세율 적용
		$body = str_replace("{tax}","<span id=\"tax\"></span>",$body);


		// ++ 신규 자료 입력 	
		$newdata_form = "<div id=\"newdata\">
			<center><img src='../images/loading.gif' border='0'></center>
			<script> trans_newdata(); </script>
    		</div>";
    	$body = str_replace("{newdata}",$newdata_form,$body);
		
		// ++전표 자료 출력 		
		$list_form = "<div id=\"translist\">
			<center><img src='../images/loading.gif' border='0'></center>
			<script> trans_list(); </script>
    		</div>";
    	$body = str_replace("{datalist}",$list_form,$body);	


    	$body = str_replace("{total_d}","<span id=\"total_d\"></span>",$body);
		$body = str_replace("{vat_d}","<span id=\"vat_d\"></span>",$body);
		$body = str_replace("{discount_d}","<span id=\"discount_d\"></span>",$body);
		$body = str_replace("{payment_d}","<span id=\"payment_d\"></span>",$body);
		$body = str_replace("{balance_d}","<span id=\"balance_d\"></span>",$body);

		$body = str_replace("{total_m}","<span id=\"total_m\"></span>",$body);
		$body = str_replace("{vat_m}","<span id=\"vat_m\"></span>",$body);
		$body = str_replace("{discount_m}","<span id=\"discount_m\"></span>",$body);
		$body = str_replace("{payment_m}","<span id=\"payment_m\"></span>",$body);
		$body = str_replace("{balance_m}","<span id=\"balance_m\"></span>",$body);

		$body = str_replace("{total_y}","<span id=\"total_y\"></span>",$body);
		$body = str_replace("{vat_y}","<span id=\"vat_y\"></span>",$body);
		$body = str_replace("{discount_y}","<span id=\"discount_y\"></span>",$body);
		$body = str_replace("{payment_y}","<span id=\"payment_y\"></span>",$body);
		$body = str_replace("{balance_y}","<span id=\"balance_y\"></span>",$body);

		echo $body;

	} else {

		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;	

	}	



?>

