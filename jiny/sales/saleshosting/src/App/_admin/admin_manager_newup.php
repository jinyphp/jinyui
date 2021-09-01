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
			echo "<meta http-equiv='refresh' content='0; url=admin_goodsnew.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;
			
			$enable = $_POST['enable'];
    			
    		$name = $_POST['name'];
    			
			$manager = $_POST['manager'];
    		$password = $_POST['password'];
    		$manager_country = $_POST['manager_country'];
    						
			$per1 = $_POST['per1']; //주문관리
    		$per2 = $_POST['per2']; //상품관리
    		$per3 = $_POST['per3']; //디자인관리
    		$per4 = $_POST['per4']; //관리자
    			
			if($manager){
					$query = "INSERT INTO `shop_manager` (`enable`,`name`,`email`, `password`, `country`, `per1`, `per2`, `per3`, `per4`) 
					VALUES ('$enable', '$name', '$manager', '$password', '$manager_country', '$per1', '$per2', '$per3', '$per4');";
					mysql_db_query($mysql_dbname,$query,$connect);
			} else msg_alert("오류! 관리자 이메일이 없습니다.");
		    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_manager.php'>";
			page_back2();
			
		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
		
?>

