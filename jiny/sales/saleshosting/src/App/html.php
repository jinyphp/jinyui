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


	include "./func/datetime.php";
	include "./func/error.php";
	include "./func/ajax.php";

	$html = class layout;

	$html->print();
	


	/*
	$body =  _skin_emptybody($skin_name);
	$body = str_replace("</head>","<script src=\"/js/shop_cart.js?cashing=".microtime()."\"></script></head>",$body);
	//$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

	$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
	$body = str_replace("<!--{skin_emptybody}-->","
		<center><img src='./images/loading.gif' border='0'></center>
		<script>"._ajax_script(".mainbody","/ajax_cart.php?ajaxkey=".$ajaxkey)."</script>
		
		",$body);

	echo $body;
	*/



?>