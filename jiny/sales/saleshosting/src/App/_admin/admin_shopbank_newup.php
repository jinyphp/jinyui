<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# ì‚¬ì´íŠ¸ ì–¸ì–´, ì§€ì—­ ì„¤ì •
	include "../mobile.php";

	include "./func_adminskin.php"; //# ìŠ¤í‚¨ ë ˆì´ì•„ì›ƒ í•¨ìˆ˜ë“¤...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";

		
	////////////////////////
	
	if($_COOKIE[adminemail]){ ///////////////
	
	
		if($_SESSION['nonce'] != $_POST['nonce']){
			$_SESSION['nonce'] = NULL;	
			echo "<meta http-equiv='refresh' content='0; url=admin_shopbank.php'>";

		} else {
		///////////////////////////
		// ì„¹ì…˜ ì¤‘ë³µì²˜ë¦¬ ë°©ì§€ ê¸°ëŠ¥
	
			$_SESSION['nonce'] = NULL;
			
			$country1 = $_POST['country1'];
			
			$swiff = $_POST['swiff'];
    		$bankname = $_POST['bankname'];
    		$bankuser = $_POST['bankuser'];
    		$banknum = $_POST['banknum'];
    		$enable = $_POST['enable'];
    						

			if(!$country1) msg_alert("ì˜¤ë¥˜! êµ­ê°€ ì—†ìŠµë‹ˆë‹¤.");
    		else if(!$bankname) msg_alert("ì˜¤ë¥˜! ì€í–‰ëª… ì—†ìŠµë‹ˆë‹¤.");
    		else if(!$bankuser) msg_alert("ì˜¤ë¥˜! ì˜ˆê¸ˆì£¼ ì—†ìŠµë‹ˆë‹¤.");
    		else if(!$banknum) msg_alert("ì˜¤ë¥˜! ê³„ì¢Œë²ˆí˜¸ ì—†ìŠµë‹ˆë‹¤.");
    		else {
    			$query = "INSERT INTO `shop_bank` (`code`, `swiff`, `bankname`, `bankuser`, `banknum`, `enable`) VALUES ('$country1', '$swiff', '$bankname', '$bankuser', '$banknum', '$enable');";
				mysql_db_query($mysql_dbname,$query,$connect);    				
			}    						    			
    						    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_shopbank.php'>";
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

