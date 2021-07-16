<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
    $connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
    
    
	if($_COOKIE[adminemail]){ ///////////////	
		echo "<meta http-equiv='refresh' content='0; url=admin_main.php'>";
	} else {
		echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	}
		
	


?>
