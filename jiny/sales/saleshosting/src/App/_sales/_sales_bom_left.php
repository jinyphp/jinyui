<?

		$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
	
		$query = "select * from `sales_goods_$MEM[Id]` where bom IS NOT NULL group by cate desc";
		// $result=mysql_db_query($mysql_dbname,$query,$connect);
		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    	if( mysql_num_rows($result) ){
    		
    		while(1){
    			$rows=mysql_fetch_array($result);
    			if($rows[cate]) {
    			
    				$query = "select count(*) from `sales_goods_$MEM[Id]` where bom IS NOT NULL and `cate` = '$rows[cate]' ";
					// $result1=mysql_db_query($mysql_dbname,$query,$connect);
					$result1=mysql_db_query($server[dbname],$query,$dbconnect);
    				$total=mysql_result($result1,0,0); 

    				if($total >0)
    				$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_bom.php?treemode=cate&cate=$rows[cate]'>$rows[cate]</a> ($total)</font></td></tr>";
    				else
    				$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_bom.php?treemode=cate&cate=$rows[cate]'>$rows[cate]</a></font></td></tr>";	
    			} else break;
    		}
    						
    	} else {
    		$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2>등록된 분류가 없습니다.</font></td></tr>";	
    	}
	
	
		$leftBody .= "</table>";

		$body = str_replace("{product_cate}",$leftBody,$body);
					
?>
