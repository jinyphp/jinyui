<?
	//* ////////////////////////////////////////////////////////////
	//* salesking ´Ù±¹¾î ¼îÇÎ¸ô V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	if($_COOKIE[Session]) setcookie("Session",NULL,0,"/");
	if($_COOKIE[adminemail]) setcookie("adminemail",NULL,0,"/");  

	
    echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";  
?>
