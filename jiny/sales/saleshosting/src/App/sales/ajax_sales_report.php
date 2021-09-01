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

		function company_search(){
			var url = \"ajax_sales_report_company.php?multiple=multi\";
			popup_ajax(url);	
		}

		$('#stock_house').on('change',function(){
      		report();	
   		});

		$('#manager').on('change',function(){
      		report();	
   		});

		$('#business').on('change',function(){
      		report();	
   		});
		
		$('input:radio[name=trans]').change(function(){
			report();
    	}); 

 		function report(){
 			var url = \"ajax_sales_report_list.php\";
 			ajax_async('#report_list',url);
 			/*
 			$.ajax({
            		url:'ajax_sales_report_list.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#report_list').html(data);
            		}
        	});
        	*/
 		}

		// 거래내역 출력 
 		$('#btn_print').on('click',function(){
 			var url = \"/tcpdf/trans_report_pdf.php\";		
			var form = document.trans;
			form.action = url;  //이동할 페이지
  			//form.mode.value = mode;
  			//form.uid.value = uid;
  			//form.limit.value = limit;
			
			form.submit();
       	});
  
    </script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		



		// $body = $javascript._skin_page($skin_name,"sales_report");
		$body = $javascript._theme_page($site_env->theme,"sales_report",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,475),$body);

		$css_btn ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";

		$mode = _formmode();
		$company_id = _formdata("company_id");
		$transdate = _formdata("transdate");
		$warehouse = _formdata("warehouse");
		$manager = _formdata("manager");

		// 거래구분 설정
		$trans = _formdata("trans"); 
		if($trans == "buysell") $body = str_replace("{buysell}","<input type=radio name=trans value='buysell' checked='checked' id=\"trans_select\">",$body);
		else $body = str_replace("{buysell}","<input type=radio name=trans value='buysell' id=\"trans_select\">",$body);

		if($trans == "sell") $body = str_replace("{sell}","<input type=radio name=trans value='sell' checked='checked' id=\"trans_select\">",$body);
		else $body = str_replace("{sell}","<input type=radio name=trans value='sell' id=\"trans_select\">",$body);

		if($trans == "buy") $body = str_replace("{buy}","<input type=radio name=trans value='buy' checked='checked' id=\"trans_select\">",$body);
		else $body = str_replace("{buy}","<input type=radio name=trans value='buy' id=\"trans_select\">",$body);

		if($trans == "paid") $body = str_replace("{pay}","<input type=radio name=trans value='paid' checked='checked' id=\"trans_select\">",$body);
		else $body = str_replace("{pay}","<input type=radio name=trans value='paid' id=\"trans_select\">",$body);

		if($trans == "sell_paid") $body = str_replace("{payin}","<input type=radio name=trans value='sell_apid' checked='checked' id=\"trans_select\">",$body);
		else $body = str_replace("{payin}","<input type=radio name=trans value='sell_paid' id=\"trans_select\">",$body);

		if($trans == "buy_paid") $body = str_replace("{payout}","<input type=radio name=trans value='buy_paid' checked='checked' id=\"trans_select\">",$body);
		else $body = str_replace("{payout}","<input type=radio name=trans value='buy_paid' id=\"trans_select\">",$body);

		if($trans == "all") $body = str_replace("{all}","<input type=radio name=trans value='all' checked='checked' id=\"trans_select\">",$body);
		else $body = str_replace("{all}","<input type=radio name=trans value='all' id=\"trans_select\">",$body);



		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='trans' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='tax' id=\"company_tax\">
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		$body = str_replace("{mail}","<input type='button' value='메일' style=\"".$css_btn_gray."\" id=\"btn_mail\">",$body);
		$body = str_replace("{pdf}","<input type='button' value='PDF' style=\"".$css_btn_gray."\" id=\"btn_pdf\">",$body);
		$body = str_replace("{excel}","<input type='button' value='엑셀' style=\"".$css_btn_gray."\" id=\"btn_excel\">",$body);
		$body = str_replace("{print}","<input type='button' value='인쇄' style=\"".$css_btn_gray."\" id=\"btn_print\">",$body);

 
		if($start = _formdata("start")) $body = str_replace("{start}","<input type='date' name='start' value='$start'  style=\"$css_textbox\">",$body);
		else $body = str_replace("{start}","<input type='date' name='start' value='$TODAY'  style=\"$css_textbox\">",$body);

		if($end = _formdata("end")) $body = str_replace("{end}","<input type='date' name='end' value='$end'  style=\"$css_textbox\">",$body);
		else $body = str_replace("{end}","<input type='date' name='end' value='$TODAY'  style=\"$css_textbox\">",$body);
		// $body = str_replace("{priod_search}","<input type='button' value='기간검색' style=\"".$css_btn."\" id=\"btn_priod_search\">",$body);
		$body = str_replace("{priod_search}","<input type='button' value='기간검색' onclick=\"javascript:report()\" style=\"".$css_btn_gray."\" id=\"btn_priod_search\">",$body);


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
		
		//# 창고리스트  처리
		$query = "select * from sales_goods_house where enable ='on'";
		if($rowss = _sales_query_rowss($query)){
			$form_warehouse = "<select name='warehouse' style=\"$css_textbox\" id=\"stock_house\">";
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($warehouse == $rows1->Id) $form_warehouse .= "<option value='".$rows1->Id."' selected>".$rows1->name."</option>"; 
				else $form_warehouse .= "<option value='".$rows1->Id."'>".$rows1->name."</option>";
			}
			$form_warehouse .= "</select>";
			$body = str_replace("{warehouse}","$form_warehouse",$body);
		} else $body = str_replace("{warehouse}","",$body);

		//# 담당자 처리
		$form_manager = "<select name='manager' style=\"$css_textbox\"  id=\"manager\">";
		$form_manager .= "<option value=''>관리자</option>";
		$query = "select * from sales_manager where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($manager == $rows1->Id) $form_manager .= "<option value='".$rows1->Id."' selected>".$rows1->lastname."</option>"; 
				else $form_manager .= "<option value='".$rows1->Id."'>".$rows1->lastname."</option>";
			}
		}
		$form_manager .= "</select>";
		$body = str_replace("{manager}",$form_manager,$body);

		//# 사업장 선택 
		
		$form_business = "<select name='business' id=\"business\" style=\"$css_textbox\" >";
		$query = "select * from sales_business where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->business == $rows1->Id) $form_business .= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>"; 
				else $form_business .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
			}
		}
		$form_business .= "</select>";
		$body = str_replace("{business}",$form_business,$body);
		

    	// =================
		//# 전표 자료 출력 
		$list_form = "<span id=\"report_list\">
			<center><img src='../images/loading.gif' border='0'></center>	
		<script>
			$.ajax({
            	url:'ajax_sales_report_list.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#report_list').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{list}",$list_form,$body);

		
		
		echo $body;

	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;	
	}	



?>

