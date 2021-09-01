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
		
		$body = _skin_body($skin_name,"sales_goodshouse");

		$script = "
				<script>
				function house_edit(mode,uid){
                  	var url = \"/ajax_sales_house_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#goods').html(data);
                        }
                    }); 	
                }

				function form_house_submit(mode,uid){
					var url = \"/ajax_sales_house_editup.php?mode=\"+mode+\"&uid=\"+uid;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#goods').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});

					
				}

				function form_submit(mode,uid){
					var company = document.house.company.value;
					var email = document.house.email.value;
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
        						$('#goods').html(data);
        					},
        					cache: false,
        					contentType: false,
        					processData: false
    					});
					}
					
				}


				</script>";

	
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}",$script."<form id='data' name='house' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $button ="<input type='button' value='NEW' onclick=\"javascript:house_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		// $body = str_replace("{new}",$button,$body);


		// Form and Ajax Process
		$body = str_replace("{house}","
					<span id=\"house\">
					<script>
						$.ajax({
            				url:'/ajax_sales_house.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#house').html(data);
            				}
        				});
    				</script
					</span>",$body);
		
		// $body = str_replace("{company}","<span id=\"company\"></span>",$body);
		$body = str_replace("{goods}","
					<span id=\"goods\">
					<script>
						$.ajax({
            				url:'/ajax_sales_goods.php?inout=$inout',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#goods').html(data);
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