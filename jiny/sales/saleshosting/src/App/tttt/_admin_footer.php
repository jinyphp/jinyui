<?

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	include "./func/skin.php";
	include "./func/datetime.php";

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	//if(isset($_COOKIE['cookie_email'])){
		//include "./sales.php";
		
		// $skin_name = "default";
		$body = _skin_body($skin_name,"site_footer");
		$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

		$script = "
				<script>
				function site_edit(mode,uid){
                  	var url = \"/ajax_admin_footer_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }

				function form_submit(mode,uid){
					var url = \"/ajax_admin_footer_editup.php?mode=\"+mode+\"&uid=\"+uid;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});

					
				}
				</script>";

		
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}",$script."<form id='data' name='footer' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='NEW' onclick=\"javascript:site_edit('new','0')\" id=\"".$btn_style_gray."\" >";          
		$body = str_replace("{new}","",$body);


		// Form and Ajax Process
		$body = str_replace("{site_list}","
					<span id=\"site_list\">

					<script>
						$.ajax({
            				url:'/ajax_admin_footer.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#site_list').html(data);
            				}
        				});
    				</script>

					</span>",$body);
		$body = str_replace("{edit}","<span id=\"site_edit\"></span>",$body);
	
		echo $body;

	/*
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
	*/

		


?>