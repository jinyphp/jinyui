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


	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		$body =  _skin_emptybody($skin_name);

	
		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 	
		$body = str_replace("<!--{skin_emptybody}-->","
					<form name='manager' method='post' enctype='multipart/form-data'>
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>
					<span id=\"manager_list\">
					
					<script>
						$.ajax({
            				url:'/ajax_sales_manager.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('.mainbody').html(data);
            				}
        				});
    				</script>

					</span>
					</form>",$body);

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