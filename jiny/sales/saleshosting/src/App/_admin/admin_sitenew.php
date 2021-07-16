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
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
	
   
   
    include "../func_javascript.php";
    include "../func_files.php";
    include "../func_datetime.php";

    include "../func_skin.php";


	if($_GET['MOBILE']) $_SESSION['mobile'] = $_GET['MOBILE']; // 모바일 접속구분을 체크한경우...
    if(!$_SESSION['mobile']) { $_SESSION['mobile'] =  is_checkMobile(); } else $MOBILE = $_SESSION['mobile'];
	$MOBILE = $_SESSION['mobile'];

	if($_COOKIE[adminemail]){ ///////////////

    			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
				if($MOBILE == "mobile") $body = admin_skinLoad("admin_sitenew.htm"); else $body = admin_skinLoad("admin_sitenew_pc.htm");
    					
    			$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='admin_sitenewup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
											
			
				// $body = str_replace("{language}","<input type='text' name='language1'  $cssFormStyle >",$body);	
				
				//////////////////
				// $body = str_replace("{language}","<input type='text' name='language1'  $cssFormStyle >",$body);
				$query1 = "select * from shop_language where enable = 'on' or enable = 'checked'";
				$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1 = mysql_result($result1,0,0);
				
    			$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    			if(mysql_affected_rows()){
    				$body1 = "<select size='1' name='language1' $cssFormStyle> ";
					for($i1=1;$i1<=$total1;$i1++){
						$rows1=mysql_fetch_array($result1);
				
						if($rows[language] == $rows1[code]) 
						$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[language]</option>";
						else $body1 .= "<option value='$rows1[code]' >$rows1[language]</option>";
					}
					$body1 .= "</select>";
				}
				$body = str_replace("{language}",$body1,$body);

				
				
				$body = str_replace("{sitename}","<input type='text' name='sitename' $cssFormStyle >",$body);
				$body = str_replace("{sitetitle}","<input type='text' name='sitetitle' $cssFormStyle >",$body);
				$body = str_replace("{sitewidth}","<input type='text' name='sitewidth'   $cssFormStyle >",$body);
				$body = str_replace("{sitelogo}","<input type='file' name='userfile1'  $cssFormStyle >",$body);
					
				$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' >",$body);
							
		
				echo $body;
						



    			
		    	
		    	

		include "./admin_copyright.php";
	
	} else { /////////////////
	
		echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
	}

?>

