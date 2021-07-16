<?
	$body = str_replace("{code}",$countryCode,$body);

	if($MOBILE == "mobile"){
	
		/////////////////////	
		//상품 판매국가
		$query = "select * from `shop_country` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
		$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$leftBody1 = ""; //"<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
				
				$query2 = "select * from `shop_goods_$rows[code]` ";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				if($rows[code] == $countryCode){
					$leftBody1 .= "<font size=2><a href='admin_goods.php?code=$rows[code]'><b>$rows[name]</b></a> ($total2)</font> | ";
    			} else {
    				$leftBody1 .= "<font size=2><a href='admin_goods.php?code=$rows[code]'>$rows[name]</a> ($total2)</font> | ";
    			}	
			}
			// $leftBody1 .= "</table>";
		}
	
		$body = str_replace("{productcountry}",$leftBody1,$body);
		
		
		/////////////////////
		// 카테고리...
		$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr><td>";
			
			$query = "select * from `shop_goods_$countryCode`";
			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
		
			$query = "select * from `shop_goods_$countryCode` group by cate desc";
			$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if(mysql_affected_rows()){
    		
    			while(1){
    				$rows=mysql_fetch_array($result);
    				if($rows[cate]) $leftBody .= "<a href='admin_goods.php?cate=$rows[cate]&code=$countryCode'><font size=2>$rows[cate]</font></a> | ";
    				else break;
    			}
    		
    		}
	
		$leftBody .= "</td></tr></table>";			
   					
		$body = str_replace("{productMenu}",$leftBody,$body);



	} else {
		/////////////////////	
		//상품 판매국가
		$query = "select * from `shop_country` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
		$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$leftBody1 = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
				
				$query2 = "select * from `shop_goods` where country like '%$rows[code]%'";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				if($rows[code] == $countryCode){
    				$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2  color='0000ff'><a href='admin_goods.php?code=$rows[code]'><b>$rows[name]</b></a> ($total2)</font></td></tr>";
    			} else {
    				$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2 color='000000'><a href='admin_goods.php?code=$rows[code]'>$rows[name]</a> ($total2)</font></td></tr>";
    			}	
			}
			$leftBody1 .= "</table>";
		}
	
		$body = str_replace("{productcountry}",$leftBody1,$body);
		
		
		/////////////////////
		// 카테고리...
		$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
		
		$query = "select * from `shop_goods_$countryCode`";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    	
		$query = "select * from `shop_goods_$countryCode` group by cate desc";
		$result=mysql_db_query($mysql_dbname,$query,$connect);
    	if(mysql_affected_rows()){
    		
    		while(1){
    			$rows=mysql_fetch_array($result);
    			if($rows[cate]) 
    			if($rows[cate] == $_GET['cate']){
    				$leftBody .= "<tr><td width='5' valign='top'><font size=2><font color='#DEDEDF'>-</font></td>
    									      <td><a href='admin_goods.php?cate=$rows[cate]&code=$countryCode'><font size=2 color='0000ff'><b>$rows[cate]</b></font></a></td>
    										  </tr>";
    			} else {
    				$leftBody .= "<tr><td width='5' valign='top'><font size=2><font color='#DEDEDF'>-</font></td>
    									      <td><a href='admin_goods.php?cate=$rows[cate]&code=$countryCode'><font size=2>$rows[cate]</font></a></td>
    										  </tr>";
    			}
    										  
    			else break;
    		}
    		
    	}
		$leftBody .= "</table>";			
		$body = str_replace("{productMenu}",$leftBody,$body);
	}
					
?>
