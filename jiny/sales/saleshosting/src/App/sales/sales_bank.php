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

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
	
		$body = _skin_body($skin_name,"sales_bank");

		$script = "
				<script>
				function bank_mode(mode,uid){
                  	var url = \"/ajax_sales_bank_editup.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#bank_edit').html(data);
                        }
                    }); 	
                }

				function bank_edit(mode,uid){
                  	var url = \"/ajax_sales_bank_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#bank_edit').html(data);
                        }
                    }); 	
                }

				function form_submit(mode,uid){
					var url = \"/ajax_sales_bank_editup.php?mode=\"+mode+\"&uid=\"+uid;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#bank_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});

					
				}
				</script>";

		
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}",$script."<form id='data' name='env' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='NEW' onclick=\"javascript:bank_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);


		// Form and Ajax Process
		$body = str_replace("{bank_list}","
					<span id=\"bank_list\">

					<script>
						$.ajax({
            				url:'/ajax_sales_bank.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#bank_list').html(data);
            				}
        				});
    				</script>

					</span>",$body);
		$body = str_replace("{edit}","<span id=\"bank_edit\"></span>",$body);
	
		echo $body;

	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$skin_name = "default";
		$body = _skin_body("default","login");
		
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