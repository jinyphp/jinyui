<?php
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/css.php";	
	include "./func/error.php";	



	if(isset($_COOKIE['cookie_email'])){
		// $skin_name = "default";
		// $body = __($skin_name,"myinfo");
		$body = _theme_page($site_env->theme,"myinfo",$site_language,$site_mobile);
		$login_script = "<script>
			$.ajax({
            	url:'ajax_myinfo.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#mainbody').html(data);
            	}
        	});
		</script>";  

		echo $body.$login_script;

	} else {	

		$javascript = "<script>
			function members_submit(){
				var email_check = $('#email_check').val();
				var email = $('#email').val();
				var password = $('#password').val();

				if(email_check == \"false\") alert(\"정상적인 이메일 주소가 아닙니다.\");
				else if(!email) alert(\"please, input email\");
				else if(!password) alert(\"please, input password\");
				else {
					$.ajax({
            			url:'ajax_members_editup.php?mode=regist',
            			type:'post',
            			data:$('form').serialize(),
            			success:function(data){
            				$('#members').html(data);
            			}
        			});
				}				
			}
		</script>";

		$body =  _skin_emptybody($skin_name);
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("<!--{skin_emptybody}-->",_theme_page($site_env->theme,"member",$site_language,$site_mobile),$body);
		
		// ++ 동의서 부분 출력
		$body = str_replace("{agreement}","
    							<section id=\"agreement\" style='z-index:3;'>
    							<center><img src='./images/loading.gif' border='0'></center>
								<script>
									ajax_html('#agreement','/ajax_members_agreement.php'); 	
    							</script>
    							</section>",$body); 

		$body = str_replace("{members}","<span id=\"members\">
				<center><img src='./images/loading.gif' border='0'></center>
				<script>
					ajax_html('#members','/ajax_members.php'); 
    			</script>
				</span>",$body);

		/*
		 // AJAX 처리 

		// 회원약관 및 동의서 부분 출력
		// AJAX 방식으로 처리 
		
		// $body = str_replace("{agree}","<input type='checkbox' name='agree' >",$body);
		*/


		$body = str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data'>
					<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		echo $javascript.$body;


	}

	

?>