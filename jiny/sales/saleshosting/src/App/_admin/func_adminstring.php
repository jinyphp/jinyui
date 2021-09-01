<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2015.01.27
	//* Program By : hojin lee 
	//*
	
	
	function _adminstring_converting($body){
		global $connect, $mysql_dbname;
		
		//# 번역스트링 처리
		$query1 = "select * from `shop_string` where language = '".$_SESSION['language']."' ";
		$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    	$total1=mysql_result($result1,0,0);
    
		$result1=mysql_db_query($mysql_dbname,$query1,$connect);
		if(mysql_affected_rows()) {
			for($i=0;$i<$total1;$i++){
				$rows1=mysql_fetch_array($result1);
				
		
				$string = "$rows1[string]";
				
				if($rows1[string_size] && $rows1[string_color]){
					$string = "<font size='$rows1[string_size]' color='$rows1[string_color]'>$string</font>";
				} else {
					if($rows1[string_size]) $string = "<font size='$rows1[string_size]'>$string</font>";
					if($rows1[string_color]) $string = "<font color='$rows1[string_color]'>$string</font>";
				}
				
				if($rows1[link]) $string = "<a href='$rows1[link]'>$string</a>";
				
				if($_COOKIE[adminemail]) $string .= "<a href='./admin_string_new.php?mode=edit&code=$rows1[code]'><img src='./images/string.jpg' boarder='0'></a>";
				
				$body = str_replace("{@$rows1[code]}",$string,$body);
			}
		}
		
		return $body;
	
	}

	


?>
