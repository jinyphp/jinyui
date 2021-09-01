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
    
	if($_COOKIE[adminemail]){ ///////////////
	
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_members");
		
		$query = "select * from `shop_member` where regdate >= '$TODAY 00:00:00'";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    	$body = str_replace("{today_new}","$total 명",$body); 
    	
		$query = "select * from `shop_member` where lastlog >= '$TODAY 00:00:00'";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    	$body = str_replace("{today_access}","$total 명",$body); 

		//# 번역스트링 처리
		$body = _adminstring_converting($body);
				
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";

?>
