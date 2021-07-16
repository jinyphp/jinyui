<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	//* 언어설정 : 셀렉트 또는 링크연결로 언어셋 변경시 섹션값에 저장. 디폴트 ko
	
	if($_POST['LANG']) $_SESSION['language'] = $_POST['LANG']; 
	else if($_GET['LANG']) $_SESSION['language'] = $_GET['LANG'];
	else {
		if($_SESSION['language']){
		} else {
			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);
			$query = "select * from `shop_domain` where domain = '$domain'";
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()) {
				$rows=mysql_fetch_array($result);
				$_SESSION['language'] = $rows[language];
				$_SESSION['country'] = $rows[country];
			} else $_SESSION['language'] = "ko";
		} 

	}
	$LANG = $_SESSION['language']; if(!$LANG) $LANG = "ko";
	
	if($_POST['COUNTRY']) $_SESSION['country'] = $_POST['COUNTRY']; 
	else if($_GET['COUNTRY']) $_SESSION['country'] = $_GET['COUNTRY'];
	else {
		if($_SESSION['country']){
		} else {
			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);
			$query = "select * from `shop_domain` where domain = '$domain'";
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()) {
				$rows=mysql_fetch_array($result);
				$_SESSION['language'] = $rows[language];
				$_SESSION['country'] = $rows[country];
			} else $_SESSION['country'] = "kr";
		}
	
	}
	$COUNTRY = $_SESSION['country']; if(!$COUNTRY) $COUNTRY = "kr";

		
	////////////////////////
	
	if($_COOKIE[adminemail]){ ///////////////
	
	
		if($_SESSION['nonce'] != $_POST['nonce']){
			$_SESSION['nonce'] = NULL;	
			echo "<meta http-equiv='refresh' content='0; url=admin_country.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;
	
    	
   			include "../func_files.php";
    		include "../func_skin.php";

			
    		$pgcountry = $_POST['pgcountry'];
    		
    		$pgname = $_POST['pgname'];
    		$pgid = $_POST['pgid'];
    		$pgkey = $_POST['pgkey'];	
    		
			$enable = $_POST['enable'];	
			
			$pgcomment = $_POST['pgcomment'];			

			if(!$pgname) msg_alert("오류! PG 이름이 없습니다.");	
    		else {
    			$query = "INSERT INTO `shop_pg` (`country`, `pgname`, `pgid`, `pgkey`, `pgsite`, `enable`, `pgcomment`) VALUES ('$pgcountry', '$pgname', '$pgid', '$pgkey', '$pgsite', '$enable', '$pgcommen');";
				mysql_db_query($mysql_dbname,$query,$connect);    				
			}    						    			
    						    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_pg.php'>";
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else { /////////////////
	
		echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
	}	
?>

