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
	
	include "./func_adminstring.php";
		
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());

	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
		if($MOBILE == "mobile") $body = admin_skinLoad("admin_pgnew.htm"); else $body = admin_skinLoad("admin_pgnew_pc.htm");
    					
    	$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='admin_pgnewup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
		$body = str_replace("{formend}","</form>",$body);
											
		$body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);
				
		// $body = str_replace("{country}","<input type='text' name='pgcountry'  $cssFormStyle >",$body);	
		//////////////////////
		
		$query1 = "select * from shop_country where enable = 'on' or enable = 'checked'";
		$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    	$total1 = mysql_result($result1,0,0);
				
    	$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    	if(mysql_affected_rows()){
    		$body1 = "<select size='1' name='pgcountry' $cssFormStyle> ";
			for($i1=1;$i1<=$total1;$i1++){
				$rows1=mysql_fetch_array($result1);
				
				if($rows[pgcountry] == $rows1[code]) 
				$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[name]</option>";
				else $body1 .= "<option value='$rows1[code]' >$rows1[name]</option>";
			}
			$body1 .= "</select>";
		}
		$body = str_replace("{country}",$body1,$body);

				
				
		$body = str_replace("{pgname}","<input type='text' name='pgname' $cssFormStyle >",$body);
		$body = str_replace("{pgid}","<input type='text' name='pgid' $cssFormStyle >",$body);
		$body = str_replace("{pgkey}","<input type='text' name='pgkey'   $cssFormStyle >",$body);
		$body = str_replace("{pgsite}","<input type='text' name='pgsite'  $cssFormStyle >",$body);
		$body = str_replace("{pgcomment}","<input type='text' name='pgcomment'  $cssFormStyle >",$body);
					
		$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
							
		//# 번역스트링 처리
		$body = _adminstring_converting($body);	
		
		echo $body;					
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";

?>

