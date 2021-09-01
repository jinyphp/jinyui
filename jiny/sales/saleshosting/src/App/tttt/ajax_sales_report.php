<?
	@session_start();


	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";

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
				var maskHeight = $(document).height();  
				var maskWidth = $(window).width();

				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
				// 팡법창 크기 계산
				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				// popup_size(1000,500);
				var width = 800;
				var height = 500;
				var left = ($(window).width() - width )/2;
				var top = ( $(window).height() - height )/2;			
				$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 			  
    
    			//마스크의 투명도 처리
    			$('#popup_mask').fadeTo(\"slow\",0.8); 
				$('#popup_body').show();

				// 팝업 내용을 Ajax로 읽어옴
				//var company = document.trans.company_search.value;
				//alert(company);
				$.ajax({
            		url:'/ajax_sales_company_list.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
                		$('#popup_body').html(data);

                		var maskHeight1 = $(document).height();  
						var maskWidth1 = $(window).width();

						//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
						$('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
            		}
        		}); 
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
		
			$('#btn_priod_search').click(function(){
				report();
			});

			$('input:radio[name=trans]').change(function(){
				report();
    		}); 

 			function report(){
 				$.ajax({
            		url:'/ajax_sales_report_list.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#list').html(data);
            		}
        		});
 			}


  
        </script>";



		$body = $javascript._skin_page($skin_name,"sales_report");

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

 
		$body = str_replace("{start}","<input type='date' name='start' value='$TODAY'  style=\"$css_textbox\">",$body);
		$body = str_replace("{end}","<input type='date' name='end' value='$TODAY'  style=\"$css_textbox\">",$body);
		$body = str_replace("{priod_search}","<input type='button' value='기간검색' style=\"".$css_btn."\" id=\"btn_priod_search\">",$body);


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
		$list_form = "<span id=\"list\">	
		<script>
			$.ajax({
            	url:'/ajax_sales_report_list.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#list').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{list}",$list_form,$body);

		
		
		echo $body;

	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$body =  _skin_emptybody($skin_name);

		$login_script = "<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
		</script>";
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}	



?>

