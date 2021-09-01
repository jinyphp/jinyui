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

	// ERP Library
	include "./lib/company.php";
	include "./lib/goods.php";
	include "./lib/trans.php";
	include "./lib/report.php";



	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";

		$script = "<script>
				function form_submit(mode,uid){
					var title = $('#title').val();
					
					if(!title){
						alert(\"견적서 제목을 입력해 주세요.\");
					} else {
						var url = \"/ajax_sales_quotation_editup.php?uid=\"+uid+\"&mode=\"+mode;
						var formData = new FormData($('#data')[0]);
						$.ajax({
							url:url,
        					type: 'POST',
        					data: formData,
        					async: false,
        					success: function (data) {
        						$('.mainbody').html(data);
        					},
        					cache: false,
        					contentType: false,
        					processData: false
    					});
					}

					
				}

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
						
 							$.ajax({
            					url:'/ajax_sales_quotation_list.php?mode=delete',
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

		</script>";


		$body = $script._skin_page($skin_name,"sales_quotation_edit");

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
	
		$body=str_replace("{formstart}","<form id='data' name='quotation' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
	


	
		$query = "select * from `sales_quotation` where Id = '$uid'";
    	if($rows= _sales_query_rows($query)){
    		$_SESSION['quotation_data'] = $quotation_data = $rows->quotation;
    		
    		$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > 
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			
    	} else {
    		if($_SESSION['quotation_data']){

    		} else {
    			$_SESSION['quotation_data'] = $quotation_data = md5('quotation_data'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime());
    		}
    	
    		$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

    	}

		$body = str_replace("{mail}","<input type='button' value='메일' style=\"".$css_btn_gray."\" id=\"btn_mail\">",$body);
		$body = str_replace("{pdf}","<input type='button' value='PDF' style=\"".$css_btn_gray."\" id=\"btn_pdf\">",$body);
		$body = str_replace("{excel}","<input type='button' value='엑셀' style=\"".$css_btn_gray."\" id=\"btn_excel\">",$body);
		$body = str_replace("{print}","<input type='button' value='인쇄' style=\"".$css_btn_gray."\" id=\"btn_print\">",$body);

		$body = str_replace("{delete}","<input type='button' value='항목제거' style=\"".$css_btn_gray."\" id=\"btn_delete\">",$body);

    	if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{title}","<input type='text' name='title' value='".$rows->title."' id=\"title\" style=\"$css_textbox\">",$body);

		if($rows->transdate){
			$body = str_replace("{transdate}","<input type='date' name='transdate' value='".$rows->transdate."' id=\"transdate\" style=\"$css_textbox\">",$body);
		} else {
			$body = str_replace("{transdate}","<input type='date' name='transdate' value='".$TODAY."' id=\"transdate\" style=\"$css_textbox\">",$body);
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


		$body = str_replace("{customer}","<input type='text' name='customer' value='".$rows->customer."' style=\"$css_textbox\">",$body);
		$body = str_replace("{phone}","<input type='text' name='phone' value='".$rows->phone."' style=\"$css_textbox\">",$body);
		$body = str_replace("{email}","<input type='text' name='email' value='".$rows->email."' style=\"$css_textbox\">",$body);

		if($rows->tax)
		$body = str_replace("{tax}","<input type='text' name='tax' value='".$rows->tax."' id=\"company_tax\" style=\"$css_textbox\">",$body);
		else $body = str_replace("{tax}","<input type='text' name='tax' value='0' id=\"company_tax\" style=\"$css_textbox\">",$body);

		//# 사업장 선택 
		$form_business = "<select name='business' style=\"$css_textbox\" >";
		$form_business .= "<option value=''>사업장</option>";
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
			

		$body = str_replace("{memo}",_form_textarea("memo",$comment,"10",$css_textarea),$body);	



		// 신규 자료 입력 
		$newdata_form = "<span id=\"newdata\">	
		<script>
			$.ajax({
            	url:'/ajax_sales_quotation_newdata.php',
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
            	url:'/ajax_sales_quotation_list.php',
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
		$body = _skin_body($skin_name,"login");
		
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

		echo $body.$login_script;
	}	

	
?>

