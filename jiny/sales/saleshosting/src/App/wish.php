<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*


	// 관심 상품 
	// update : 2016.01.11 = 코드정리 

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

	
	if(isset($_COOKIE['cookie_email'])){

		$body =  _skin_emptybody($skin_name);
		$body = str_replace("</head>","<script src=\"/js/wish.js?cashing=".microtime()."\"></script></head>",$body); 

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("<!--{skin_emptybody}-->","
		<script>"._javascript_ajax_html("#mainbody","/ajax_wish.php?ajaxkey=".$ajaxkey)."</script>
		",$body);
		
		echo $body;


	
	} else {
		// 로그인 
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")."</script>";	
		$body =  _skin_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

		


?>