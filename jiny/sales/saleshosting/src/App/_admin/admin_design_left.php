<?

	if($MOBILE == "mobile"){
	
		$query = "select * from `shop_language` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
		$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr><td>";
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
				
				
				$query2 = "select * from `shop_desgin` where code ='$rows[code]'";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				
				
				$leftBody .= "<font size=2><a href='admin_design.php?code=$rows[code]'> $rows[language] </a></font> <font size=2>( $total2 )</font> | ";	
			}
			$leftBody .= "</td></tr></table>";
		}
	
		
		
	
	
		$body = str_replace("{languagelist}",$leftBody,$body);

			
	} else {
	
		
	
		$query = "select * from `shop_language` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
		$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
				
				
				$query2 = "select * from `shop_desgin` where code ='$rows[code]'";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				
				
				$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    						  <td><font size=2><a href='admin_design.php?code=$rows[code]'> $rows[language] </a></font> <font size=2>( $total2 )</font></td></tr>";	
			}
			$leftBody .= "</table>";
		}
	
		
		
	
	
		$body = str_replace("{languagelist}",$leftBody,$body);
	
	}
			
?>
