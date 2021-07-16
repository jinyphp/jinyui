<?

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/css.php";
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

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		$body = _skin_body($skin_name,"sales_business");

		$script = "
				<script>
				function business_edit(mode,uid){
                  	var url = \"/ajax_sales_business_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#company').html(data);
                        }
                    }); 	
                }

				function form_business_submit(mode,uid){
					var url = \"/ajax_sales_business_editup.php?mode=\"+mode+\"&uid=\"+uid;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#company').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});

					
				}

				function form_submit(mode,uid){
					var company = document.business.company.value;
					var email = document.business.email.value;
					if(!company) alert(\"회사명을 입력해 주세요\");
					else if(!email) alert(\"거래처 고유 이메일을 입력해 주세요\");
					else {
						var url = \"/ajax_sales_company_editup.php?uid=\"+uid+\"&mode=\"+mode;
						var formData = new FormData($('#data')[0]);
						$.ajax({
							url:url,
        					type: 'POST',
        					data: formData,
        					async: false,
        					success: function (data) {
        						$('#company').html(data);
        					},
        					cache: false,
        					contentType: false,
        					processData: false
    					});
					}
					
				}

				function form_delete(mode,uid){
					var url = \"/ajax_sales_company_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#company').html(data);

                        }
                    });
				}


				


				</script>";

		$inout = _formdata("inout");
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}",$script."<form id='data' name='business' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='NEW' onclick=\"javascript:business_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);


		// Form and Ajax Process
		$body = str_replace("{business}","
					<span id=\"business\">
					<script>
						$.ajax({
            				url:'/ajax_sales_business.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#business').html(data);
            				}
        				});
    				</script
					</span>",$body);
		
		// $body = str_replace("{company}","<span id=\"company\"></span>",$body);
		$body = str_replace("{company}","
					<span id=\"company\">
					<script>
						$.ajax({
            				url:'/ajax_sales_company.php?inout=$inout',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#company').html(data);
            				}
        				});
    				</script
					</span>",$body);	
		
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