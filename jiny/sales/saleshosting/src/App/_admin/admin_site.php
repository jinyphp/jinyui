<?
	// ////////////////////////////////////////////////////////////
	// 거래처 목록 리스트
	// 2014.08.04 hojinlee
	//
	//
	
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
		
	
	include "../func_files.php";

	
	
    
    
    if($_GET['MOBILE']) $_SESSION['mobile'] = $_GET['MOBILE']; // 모바일 접속구분을 체크한경우...
    if(!$_SESSION['mobile']) { $_SESSION['mobile'] =  is_checkMobile(); } else $MOBILE = $_SESSION['mobile'];
    $MOBILE = $_SESSION['mobile'];

	if($_COOKIE[adminemail]){ ///////////////	
		
		if($MOBILE == "mobile") $body = admin_skinLoad("admin_site.htm"); else $body = admin_skinLoad("admin_site_pc.htm");
		$body = str_replace("{status}",$_GET['status'],$body); 
		
		$query = "select * from `shop_site` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
		
			$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
			$list .= "<td width='50' bgcolor='ffffff'> <font size=2> 언어 </font></td>";
			$list .= "<td width='150' bgcolor='ffffff'> <font size=2> 사이트명 </font></td>";
			$list .= "<td bgcolor='ffffff'> <font size=2> 제목 </font></td>";
			
			$list .= "</tr></table>";
				
			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
		
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
			
				if($MOBILE == "mobile") {
					$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
					$list .= "<td width='50' bgcolor='ffffff'> <font size=2> $rows[language]</font></td>";
					$list .= "<td width='150' bgcolor='ffffff'> <font size=2> <a href='admin_siteedit.php?UID=$rows[Id]'>$rows[sitename]</a></font></td>";
					$list .= "<td bgcolor='ffffff'> <font size=2> $rows[title]</font></td>";
					
					$list .= "</tr></table>";
		
				} else {
					$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
					$list .= "<td width='50' bgcolor='ffffff'> <font size=2> $rows[language]</font></td>";
					$list .= "<td width='150' bgcolor='ffffff'> <font size=2> <a href='admin_siteedit.php?UID=$rows[Id]'>$rows[sitename]</a></font></td>";
					$list .= "<td bgcolor='ffffff'> <font size=2> $rows[title]</font></td>";
					
					$list .= "</tr></table>";
				}
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
			}
		}
		
		$body = str_replace("{datalist}","$list",$body); 
		
		
		
	
	 
	// $body = str_replace("src=\"","src=\"./ko/",$body); 
	echo $body;
	
		include "./admin_copyright.php";
		
	} else { /////////////////
	
		echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
	}	


?>
