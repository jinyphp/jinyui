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
	
	
	
	if($_COOKIE[adminemail]){ ///////////////	
	
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
		$DOMAIN = $_POST['domain']; if(!$DOMAIN) $DOMAIN = $_GET['domain'];
		
		if($DOMAIN){
		
			if($mode == "editup"){
		
				$query = "select * from `shop_language` ";
				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
	    		$total=mysql_result($result,0,0);
	
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					for($i=0;$i<$total;$i++){
						$rows=mysql_fetch_array($result);
					
						$title = "title_".$rows[code];
						$title = $_POST[$title];
					
						$keyword = "keyword_".$rows[code];
						$keyword = $_POST[$keyword];
					
						$description = "description_".$rows[code];
						$description = $_POST[$description];
					
						$query1 = "select * from `shop_seo` where domain = '$DOMAIN' and language = '$rows[code]'";
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if(mysql_affected_rows()) {
							$query2 = "UPDATE `shop_seo` SET `title`='$title', `keyword`='$keyword', `description`='$description' WHERE `domain`='$DOMAIN' and language = '$rows[code]'";
							//echo $query2."<br>";
						} else {
					
							$query2 = "INSERT INTO `shop_seo` (`domain`, `language`, `title`, `keyword`, `description`) VALUES ('$DOMAIN', '$rows[code]', '$title', '$keyword', '$description')";
							//echo $query2."<br>";
						}
						mysql_db_query($mysql_dbname,$query2,$connect);
					
					}
				}
			
			}
	
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
