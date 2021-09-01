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


	include "./sales.php";

  	// 팝업창
	$body = $javascript._skin_page($skin_name,"service_update_database");
	$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

	$body = str_replace("{ifram_url}","http://api.saleshosting.co.kr/curl_adduser.php?database=".$sales_db->database,$body);

	echo $body;

?>