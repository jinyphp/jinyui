<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	

	if($MOBILE == "mobile"){
	
		$query = "select * from `shop_country` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
		$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr><td>";
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
				
				$query2 = "select * from `shop_member_$rows[code]` ";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				
				$leftBody .= "<font size=2><a href='admin_members.php?code=$rows[code]'>$rows[name]</a> ($total2)</font> | ";	
			}
			$leftBody .= "</td></tr></table>";
		}
	
		$body = str_replace("{countrymembers}",$leftBody,$body);

			
	} else {
	
		
	
		$query = "select * from `shop_country` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
		$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
				
				$query2 = "select * from `shop_member_$rows[code]` ";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				
				$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='admin_members.php?code=$rows[code]'>$rows[name]</a> ($total2)</font></td></tr>";	
			}
			$leftBody .= "</table>";
		}
	
		$body = str_replace("{countrymembers}",$leftBody,$body);
	
	}
			
?>
