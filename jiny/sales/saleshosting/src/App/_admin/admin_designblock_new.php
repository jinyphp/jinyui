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
	
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_designnew");	
    			
		
		
    	$body=str_replace("{formstart}","<form name='country1' method='post' enctype='multipart/form-data' action='admin_designblock_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
		$body = str_replace("{formend}","</form>",$body);
					
		$body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);
		
		$body = str_replace("{code}","<input type='text' name='code' $cssFormStyle >",$body);		
				
		$body = str_replace("{useimage}","<input type='checkbox' name='useimage' $cssFormStyle >",$body);
		$body = str_replace("{images}","<input type='file' name='userfile1' $cssFormStyle >",$body);
		$body = str_replace("{images_url}","<input type='text' name='images_url' $cssFormStyle >",$body);
		
		$body = str_replace("{html}","<textarea name='html' rows='8' style='width:100%'></textarea>",$body);
			
		$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
							
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		
		echo $body;

	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

