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
			echo "<meta http-equiv='refresh' content='0; url=admin_loginenv.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;

			$enable = $_POST['enable'];
			$skin_language = $_POST['skin_language'];
			
			$skin_login = $_POST['skin_login'];
			$skin_logout = $_POST['skin_logout'];
			$skin_memnew = $_POST['skin_memnew'];
			$skin_memedit = $_POST['skin_memedit'];
			
			$skin_fontsize = $_POST['skin_fontsize'];
			$skin_fontcolor = $_POST['skin_fontcolor'];
			
			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);

			if(!$skin_language) msg_alert("오류! 언어를 선택해주세요");
    		else {
    			$query = "INSERT INTO `shop_loginenv` (`enable`, `domain`, `language`, `login`, `logout`, `memedit`, `memnew`, `fontsize`, `fontcolor`) 
    			VALUES ('$enable', '$domain', '$skin_language', '$skin_login', '$skin_logout', '$skin_memnew', '$skin_memedit', '$skin_fontsize', '$skin_fontcolor');";
				mysql_db_query($mysql_dbname,$query,$connect);  
				// echo $query;
			}    		
							    			
    		page_back2();				    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_loginenv.php'>";

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

