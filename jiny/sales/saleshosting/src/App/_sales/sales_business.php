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

	include "./func/css.php";


	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		$javascript = "<script>
						function form_submit(mode,uid){
					//alert(\"edit\");
					var business = document.busniess.company.value;
					var email = document.business.email.value;
					if(!business) alert(\"회사명을 입력해 주세요11\");
					else if(!email) alert(\"거래처 고유 이메일을 입력해 주세요\");
					else {
						var url = \"/ajax_sales_business_editup.php?uid=\"+uid+\"&mode=\"+mode;
						var formData = new FormData($('#data')[0]);
						$.ajax({
							url:url,
        					type: 'POST',
        					data: formData,
        					async: false,
        					success: function (data) {
        						$('#business').html(data);
        						//popup_close();
        					},
        					cache: false,
        					contentType: false,
        					processData: false
    					});
					}
				
				}

				function form_delete(mode,uid){
					var url = \"/ajax_sales_business_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#business').html(data);
                            //popup_close();
                        }
                    });
				
				}

			function business_edit(mode,uid){
				// $('#company').html(\"\");
			
				$.ajax({
                    url:'/ajax_sales_business_edit.php?uid='+uid+'&mode='+mode,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#company').html(data);
                    }
                }); 


			/*
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
            		url:'/ajax_sales_business_edit.php?uid='+uid+'&mode='+mode,
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
        	*/
				
        	}
		</script>";
	
		$body =  $javascript._skin_body($skin_name,"sales_business");

		$inout = _formdata("inout");
		$business = _formdata("business");

		// ajax 형태로 처리함.
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form name='company' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='inout' value='$inout'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		//$button ="<input type='button' value='거래처 추가' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		//$body = str_replace("{new}",$button,$body);



		$body = str_replace("{business}","<span id=\"business\">
					<script>
						$.ajax({
            				url:'/ajax_sales_business.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#business').html(data);
            				}
        				});
    				</script>
					</span>",$body);

		$body = str_replace("{company}","<span id=\"company\">
					<script>
						$.ajax({
            				url:'/ajax_sales_company.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#company').html(data);
            				}
        				});
    				</script>
					</span>",$body);

		/*
		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 	
		$body = str_replace("<!--{skin_emptybody}-->","
					<form name='company' method='post' enctype='multipart/form-data'>
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>
					<input type='hidden' name='inout' value='$inout'>
					<span id=\"company_list\">
					
					<script>
						$.ajax({
            				url:'/ajax_sales_company.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('.mainbody').html(data);
            				}
        				});
    				</script>

					</span>
					</form>",$body);
		*/
					

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