<?php
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


	include "./func/members.php";


	if(isset($_COOKIE['cookie_email'])){

		
		$body = _skin_body($skin_name,"sales_service");

		$members = _members_rows($_COOKIE['cookie_email']);

		$body = str_replace("{member_name}",$members->username." ".$members->firstname,$body);
		$body = str_replace("{member_email}",$members->email,$body);

		echo $body;
	
	} else {
		// 관심상품 로그인 
		// $body = str_replace("{wish_list}","로그인이 필요합니다.",$body);
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