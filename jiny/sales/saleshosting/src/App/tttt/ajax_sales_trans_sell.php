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


			$('#btn_delete').on('click',function(){
            	trans_del();
       		});

			function trans_del(){
       			var submit = false;
       			var chk = document.getElementsByName('TID[]');
       			var chk_count = 0;
       				
       			for(var i=0;i<chk.length;i++){
       				if(chk[i].checked) chk_count++;
       			}
       				
				if(chk.length > 0){
					if(chk_count > 0){
						var returnValue = confirm(\"선택한 거래를 삭제하겠습니까?\");
						if(returnValue == true){
 							//document.trans.mode.value = \"delete\";
 							//document.trans.submit();
 							$.ajax({
            					url:'/ajax_sales_trans_list.php?mode=delete',
            					type:'post',
            					data:$('form').serialize(),
            					success:function(data){
            						$('#list').html(data);
            					}
        					});

 						}
 					} else alert(\"선택된 거래내역이 없습니다.\");
 				} else alert(\"기입된 거래전표 리스트가 없습니다.\");
 			}


 			$('#btn_pay').on('click',function(){
            	if(!document.trans.company_id.value){
            		alert(\"거래처를 선택해 주세요\");
            	} else {
            		trans_pay();
       			}
       		});

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

 						//document.trans.action = \"sales_trans_sell_pay.php\";
 						//document.trans.submit();

						var maskHeight = $(document).height();  
						var maskWidth = $(window).width();

						//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
						$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
						// 팡법창 크기 계산
						//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
						// popup_size(1000,500);
						var width = 800;
						var height = 100;
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
            				url:'/ajax_sales_trans_pay.php',
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




 					} else alert(\"선택된 거래내역이 없습니다.\");
 				} else alert(\"기입된 거래전표 리스트가 없습니다.\");

 			}

 			function trans_expert(mem){
       			var submit = false;
       			var chk = document.getElementsByName('TID[]');
       			var expert = document.getElementsByName('expert[]');
       			var chk_count = 0;
       			/*	
       			if(!mem) {
       				alert(\"회원 거래처만 전표 전송이 가능합니다.\");
       				return;
       			}
       			*/
       				
       			for(var i=0;i<chk.length;i++){
       				if(chk[i].checked) {
       					chk_count++;
       					if(expert[i].value) {
       						alert(\"이미 전송된 자료입니다.\");
       						return;
       					}
       				}
       			}
       				
				if(chk.length > 0){
					if(chk_count > 0){
 						document.trans.action = \"sales_trans_sell_expert.php\";
 						document.trans.submit();
 					} else alert(\"선택된 거래내역이 없습니다.\");
 				} else alert(\"기입된 거래전표 리스트가 없습니다.\");

 			}

 			function trans_print(){
       			var submit = false;
       			var ilen = document.querySelectorAll('input[type=\"checkbox\"]:checked').length;
       				
				if(ilen>0){
 					document.trans.action = \"sales_trans_sell_report.php\";
 					document.trans.submit();
 				} else alert(\"선택된 거래내역이 없습니다.\");	
 			}
  
        </script>";


		$body = $javascript._skin_page($skin_name,"sales_trans_sell");

		$css_btn ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";

		$mode = _formmode();
		$company_id = _formdata("company_id");
		$transdate = _formdata("transdate");
		$warehouse = _formdata("warehouse");
		$manager = _formdata("manager");

		// 거래구분 설정
		$trans = _formdata("trans"); if(!$trans) $trans = "sell";
		//echo "trans = $trans";
		if($trans == "sell") $form_trans  ="<input type=radio name=trans value='sell' checked='checked'> 매출 ";
		else $form_trans  ="<input type=radio name=trans value='sell'> 매출 ";
		if($trans == "buy") $form_trans .="<input type=radio name=trans value='buy' checked='checked'> 매입 ";
		else $form_trans .="<input type=radio name=trans value='buy'> 매입 ";
		$body = str_replace("{trans}",$form_trans,$body);

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='trans' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='tax'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// 전표 삭제 버튼
		$body = str_replace("{delete}","<input type='button' value='삭제' style=\"".$css_btn_gray."\" id=\"btn_delete\">",$body);

		// 전표 결제 버튼
		if($trans == "sell") $body = str_replace("{pay}","<input type='button' value='입금' style=\"".$css_btn_gray."\" id=\"btn_pay\">",$body);
		else $body = str_replace("{pay}","<input type='button' value='출금' style=\"".$css_btn_gray."\" id=\"btn_pay\">",$body);
		
		$body = str_replace("{expert}","<input type='button' value='자료전송' style=\"".$css_btn_gray."\" id=\"btn_expert\">",$body);
		$body = str_replace("{print}","<input type='button' value='인쇄' style=\"".$css_btn_gray."\" id=\"btn_print\">",$body);

		//# 전표 작성일자 설정
		// 작성일자 변경시, 해당월로 페이지 이동
		if($transdate) $body = str_replace("{transdate}","<input type='date' name='transdate' value='$transdate'  style=\"$css_textbox\">",$body);
		else $body = str_replace("{transdate}","<input type='date' name='transdate' value='$TODAY'  style=\"$css_textbox\">",$body);

		//# 거래처 화면 및 검색처리..
		$query = "select * from `sales_company` where Id = '$company_id'";
		if($coms = _sales_query_rows($query)){
			$balance1 = $coms->balance1;			
			$body = str_replace("{company_search}","<input type='text' name='company_search' style=\"$css_textbox\" id=\"company_search\">",$body);
		} else {
			$body = str_replace("{company_search}","<input type='text' name='company_search' placeholder='거래처명 검색' style=\"$css_textbox\" id=\"company_search\">",$body);
		}	
		$body = str_replace("{search}","<input type=hidden name=company_id value='$company_id'>
			<input type='button' value='검색' style=\"".$css_btn."\" id=\"btn_company_search\">",$body);
		
		//# 창고리스트  처리
		$query = "select * from sales_company_house where enable ='on'";
		if($rowss = _sales_query_rowss($query)){
			$form_warehouse = "<select name='warehouse' style=\"$css_textbox\" >";
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($warehouse == $rows1->Id) $form_warehouse .= "<option value='".$rows1->Id."' selected>".$rows1->name."</option>"; 
				else $form_warehouse .= "<option value='".$rows1->Id."'>".$rows1->name."</option>";
			}
			$form_warehouse .= "</select>";
			$body = str_replace("{warehouse}","$form_warehouse",$body);
		} else $body = str_replace("{warehouse}","",$body);

		//# 담당자 처리
		$form_manager = "<select name='manager' style=\"$css_textbox\" >";
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

		// 세율 적용
		$body = str_replace("{currency}","<span id=\"currency\"></span>",$body);

		// 세율 적용
		$body = str_replace("{tax}","<span id=\"tax\"></span>",$body);

		// 거래 요약 정보 출력
		$css_textbox_noline = "width:90%;height:28px;font-size:12px; border:0px solid #ffffff;";
		/*
		$body = str_replace("{balance_d}","<input type='text' readonly name='balance_d' style=\"$css_textbox_noline\">",$body);

		$body = str_replace("{total_d}","<input type='text' readonly name='total_d' style=\"$css_textbox_noline\">",$body);
		$body = str_replace("{vat_d}","<input type='text' readonly name='vat_d' style=\"$css_textbox_noline\">",$body);
		$body = str_replace("{discount_d}","<input type='text' readonly name='discount_d' style=\"$css_textbox_noline\">",$body);
		$body = str_replace("{payment_d}","<input type='text' readonly name='payment_d' style=\"$css_textbox_noline\">",$body);

		$body = str_replace("{total_m}","<input type='text' readonly name='total_m' style=\"$css_textbox_noline\">",$body);
		$body = str_replace("{vat_m}","<input type='text' readonly name='vat_m' style=\"$css_textbox_noline\">",$body);
		$body = str_replace("{discount_m}","<input type='text' readonly name='discount_m' style=\"$css_textbox_noline\">",$body);
		$body = str_replace("{payment_m}","<input type='text' readonly name='payment_m' style=\"$css_textbox_noline\">",$body);
		*/

		$body = str_replace("{balance_d}","<span id=\"balance_d\"></span>",$body);

		$body = str_replace("{total_d}","<span id=\"total_d\"></span>",$body);
		$body = str_replace("{vat_d}","<span id=\"vat_d\"></span>",$body);
		$body = str_replace("{discount_d}","<span id=\"discount_d\"></span>",$body);
		$body = str_replace("{payment_d}","<span id=\"payment_d\"></span>",$body);

		$body = str_replace("{total_m}","<span id=\"total_m\"></span>",$body);
		$body = str_replace("{vat_m}","<span id=\"vat_m\"></span>",$body);
		$body = str_replace("{discount_m}","<span id=\"discount_m\"></span>",$body);
		$body = str_replace("{payment_m}","<span id=\"payment_m\"></span>",$body);

		// 신규 자료 입력 
		$newdata_form = "<span id=\"newdata\">	
		<script>
			$.ajax({
            	url:'/ajax_sales_trans_newdata.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#newdata').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{newdata}",$newdata_form,$body);


    	// =================
		//# 전표 자료 출력 
		$list_form = "<span id=\"list\">	
		<script>
			$.ajax({
            	url:'/ajax_sales_trans_list.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#list').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{datalist}",$list_form,$body);

		
		
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

