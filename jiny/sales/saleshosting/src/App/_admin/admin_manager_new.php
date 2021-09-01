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
		$body = admin_shopskin("admin_managernew");		
    					
    		
    		
		$body=str_replace("{formstart}","<form name='manager' method='post' enctype='multipart/form-data' action='admin_manager_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>",$body);
		$body = str_replace("{formend}","</form>",$body);
											
		
		
		$body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
		$body = str_replace("{per1}","<input type='checkbox' name='per1' >",$body);					

		$body = str_replace("{per2}","<input type='checkbox' name='per2' >",$body);
					
		$body = str_replace("{per3}","<input type='checkbox' name='per3' >",$body);					

		$body = str_replace("{per4}","<input type='checkbox' name='per4' >",$body);

		$body = str_replace("{name}","<input type='text' name='name'  $cssFormStyle >",$body);
					
		$body = str_replace("{manager}","<input type='text' name='manager'  $cssFormStyle >",$body);
		$body = str_replace("{password}","<input type='text' name='password'  $cssFormStyle >",$body);
							
		$body = str_replace("{manager_country}","<input type='text' name='manager_country'  $cssFormStyle >",$body);
							
		$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit>",$body);
							
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		echo $body;
		
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

