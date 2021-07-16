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
		
	////////////////////////
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());

	if($_COOKIE[adminemail]){ ///////////////

    			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_languagenew");
    					
    			$body=str_replace("{formstart}","<form name='country1' method='post' enctype='multipart/form-data' action='admin_language_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
											
				$body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);		
				$body = str_replace("{code}","<input type='text' name='code' $cssFormStyle >",$body);
				$body = str_replace("{language}","<input type='text' name='language1'  $cssFormStyle >",$body);
					
				
				//% 언어별 언어이름 설정
					$query1 = "select * from `shop_language` ";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						
						$language_text = "<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>";
						
						for($i=0;$i<$total1;$i++){
							$rows1=mysql_fetch_array($result1);
							$codetext = $rows1[code];
							$language_text .= "<tr>
								<td width='110' align='right'><font size=2>$rows1[code] of $rows1[language]</font></td>
								<td><input type='text' name='name_$rows1[code]' value='$rows[$codetext]' $cssFormStyle></td>
								</tr>";
							
						}
						$language_text .= "</table>";
						$body = str_replace("{language_text}","$language_text",$body);
					}			
					
					
				$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
							
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
						
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

