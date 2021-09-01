<?
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

			
    		$language1 = $_POST['language1'];
    		
    		$sitename = $_POST['sitename'];
    		$sitetitle = $_POST['sitetitle'];
    		$sitewidth = $_POST['sitewidth'];				

			if(!$sitename) msg_alert("오류! 사이트 이름이 없습니다.");	
    		else {
    			$query = "INSERT INTO `shop_site` (`sitename`, `title`, `language`, `width`) VALUES ('$sitename', '$sitetitle', '$language1', '$sitewidth');";
				mysql_db_query($mysql_dbname,$query,$connect);    				
			}    						    			
    						    			
    		echo "<meta http-equiv='refresh' content='0; url=admin_site.php'>";
    	
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else { /////////////////
	
		echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
	}	
?>

