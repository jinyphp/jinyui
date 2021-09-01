
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
			echo "<meta http-equiv='refresh' content='0; url=admin_memlist_new.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;
			
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
    			$query = "INSERT INTO `shop_member` (`regdate`, `email`, `password`, `username`, `userphone`, `post`, `address`, `country`, `language`, `currency`, `lastlog`, `point`, `money`, `auth`, `grade`) 
					VALUES ('$TODAYTIME', '$email', '$password', '$name', '$phone', '$post', '$address', '$country1', '$language1', '$currency', '$TODAYTIME', '$point', '$money', '$auth', '$memgrade');";
    			mysql_db_query($mysql_dbname,$query,$connect);
    					   				
			}    						    			
    				
    				
    		page_back2();				    			
    		

		///// ##### SESSION END ##### /////
			
		}
	
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

