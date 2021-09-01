<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	// include "./func/css.php";
	// include "./func/members.php";
	// include "./func/reseller.php";
	// include "./func/hosting.php";

	$javascript = "<script>
		function update_database_sales(){
			var url = \"update_databases_sales.php\";
			popup_ajax(url);
		}

		function update_database_shop(){
			var url = \"update_databases_shop.php\";
			popup_ajax(url);
		}

		
    </script>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"service_update",$site_language,$site_mobile);	

		$body = str_replace("{formstart}","<form id=\"data\" name='hosting' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='uid' id=\"uid\">
					   			<input type='hidden' name='mode' id=\"mode\">
					   			<input type='hidden' name='limit' id=\"limit\">",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button = "<input type='button' value='DB sales' onclick=\"javascript:update_database_sales()\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{update_database_sales}",$button,$body);
		$body = str_replace("{update_database_sales_times}","",$body);

		$button = "<input type='button' value='DB shop' onclick=\"javascript:update_database_shop()\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{update_database_shop}",$button,$body);
		$body = str_replace("{update_database_shop_times}","",$body);

		$button = "<input type='button' value='sales files' onclick=\"javascript:update_file_sales()\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{update_files_sales}",$button,$body);
		$body = str_replace("{update_files_sales_times}","",$body);

		$button = "<input type='button' value='shop files' onclick=\"javascript:update_file_shop()\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{update_files_shop}",$button,$body);
		$body = str_replace("{update_files_shop_times}","",$body);

		echo $body;
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		
		echo $body;

	}

	
?>