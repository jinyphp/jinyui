<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	// update : 2016.01.18 = 수정편집 

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







	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		$body = _theme_emptybody();

		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("lis_tnum");

		$themepages = "shop_cart";
		$body = str_replace("id=\"mainbody\"", "class=\"$themepages\" id=\"mainbody\"", $body); // mainbody에 class 값을 삽입

		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("<!--{skin_emptybody}-->","
					<center><img src='../images/loading.gif' border='0'></center>
					<form name='goods' method='post' enctype='multipart/form-data'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='searchkey' value='$search'>					
						<input type='hidden' name='list_num' value='$list_num'>					
						<script>"._javascript_ajax_html("#mainbody","ajax_shop_cart.php")."</script>				
					</form>",$body);

		echo $body;


	/*
	$url = $_SERVER['REQUEST_URI'];
	//echo "url = $url<br>";
	$_url = explode("?", $url);
	$query = "select * from site_menu where url like '".$_url[0]."%'";
	//echo $query."<br>";
	if($rows = _sales_query_rows($query)){
		//echo $rows->name;

		$query = "select * from site_menu where tree like '%>".$rows->ref.";%'";
		//echo $query."<br>";
		if($submenu_rowss = _sales_query_rowss($query)){
		
			for($i=0;$i<count($submenu_rowss);$i++){
				$sub_rows = $submenu_rowss[$i];
				if($sub_rows->Id == $rows->Id) $subMenu .= "<b>".$sub_rows->name."</b><br>";
				else $subMenu .= $sub_rows->name."<br>";
			}
		}

		echo "<script> $('#mainbody').before(\"$subMenu\"); </script>";
	}
	*/	



	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody",$path_ajax_login)."</script>";	
		$body =  _theme_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

		


?>