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
	    
	if($_COOKIE[adminemail]){ ///////////////

		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
		$auth = $_POST['auth'];
		$enable = $_POST['enable'];
					
		$email = $_POST['email'];
    	$name = $_POST['name'];
    	$password = $_POST['password'];
    				
    	$post = $_POST['post'];
    	$address = $_POST['address'];
    				
		$memgrade = $_POST['memgrade'];		
			
		$country1 = $_POST['country1']; 
		$language1 = $_POST['language1'];
			
		$point = $_POST['point'];
		$money = $_POST['money'];
		

		if(!$email) msg_alert("회원 이메일 주소가 없습니다.");
    	else if(!$name) msg_alert("회원 이름이 없습니다.");
    	else if(!$password) msg_alert("접속 암호가 없습니다.");
    	else {
	   				
			$query = "UPDATE `shop_member` SET `auth`='$auth', `email`='$email', `password`='$password', `username`='$name', `userphone`='$phone', 
			`post`='$post', `address`='$address', `country`='$country1', `language`='$language1', `point`='$point', `money`='$money', `grade`='$memgrade' WHERE `Id`='$UID'";
			mysql_db_query($mysql_dbname,$query,$connect);
			
			// echo $query; 
			page_back2();
		}
    		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
		


?>
