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


   
    if(isset($_COOKIE['cookie_login'])){

    	if($_COOKIE['cookie_login'] == "facebook"){

    	} else if($_COOKIE['cookie_login'] == "naver"){

    	} else if($_COOKIE['cookie_login'] == "google"){

    	} else if($_COOKIE['cookie_login'] == "twitter"){

    	} else if($_COOKIE['cookie_login'] == "kakao"){

    	}

    	setcookie("cookie_login",NULL,0,"/");
    		
    }
	
	if(isset($_COOKIE['cookie_Session'])) setcookie("cookie_Session",NULL,0,"/");
	if(isset($_COOKIE['cookie_email'])) setcookie("cookie_email",NULL,0,"/");  
	if(isset($_COOKIE['cookie_google'])) setcookie("cookie_google",NULL,0,"/");

	//if($_COOKIE[site_reseller]) setcookie("site_reseller",NULL,0,"/");
	if(isset($_COOKIE['cookie_layout'])) setcookie("cookie_layout",NULL,0,"/");
	if(isset($_COOKIE['cookie_mobile'])) setcookie("cookie_mobile",NULL,0,"/");

	if(isset($_SESSION['cartlog'])) $_SESSION['cartlog'] = NULL;

    echo "<meta http-equiv='refresh' content='0; url=login.php'>"; 

	/*
    echo "
    	<script>
			$.ajax({
        	url:'/ajax_header.php',
        	type:'post',
        	data:$('form').serialize(),
        	success:function(data){
        		$('.header').html(data);
        	}
        });
		</script>";

	echo "sing out";	
	*/


?>