<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
		
	////////////////////////
	
	if($_COOKIE[adminemail]){ ///////////////

		if($_SESSION['nonce'] != $_POST['nonce']){
			$_SESSION['nonce'] = NULL;	
			echo "<meta http-equiv='refresh' content='0; url=admin_skingoods.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;

			$enable = $_POST['enable'];
			$pageview = $_POST['pageview'];
			
			$skin_type = $_POST['skin_type'];
			$skin_code = $_POST['skin_code'];
			$skin_cate = $_POST['skin_cate'];
			$skin_mode = $_POST['skin_mode'];
			
			$skin_rows = $_POST['skin_rows'];
			$skin_cols = $_POST['skin_cols'];
			$skin_sorting = $_POST['skin_sorting'];
			
			$skin_skin = $_POST['skin_skin']; $skin_skin = addslashes($skin_skin);
			
			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);

			if(!$skin_code) msg_alert("오류! 치환코드를 입력해주세요");
    		else {
    			$query = "INSERT INTO `shop_skingoods` (`enable`, `domain`, `type`, `code`, `cate`, `mode`, `rows`, `cols`, `sorting`, `skin`, `pageview`) 
    			VALUES ('$enable', '$domain', '$skin_type', '$skin_code', '$skin_cate', '$skin_mode', '$skin_rows', '$skin_cols', '$skin_sorting', '$skin_skin', '$pageview');";
				mysql_db_query($mysql_dbname,$query,$connect);  
				// echo $query;
			}    		
							    			
    		page_back2();				    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_skingoods.php'>";

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

