<?

		$leftBody = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
	
		$query = "select * from `sales_goods_$MEM[Id]` where bom IS NULL group by cate desc";
		// $result=mysql_db_query($mysql_dbname,$query,$connect);
		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    	if( mysql_num_rows($result) ){
    		
    		while(1){
    			$rows=mysql_fetch_array($result);
    			if($rows[cate]) {
    			
    				$query = "select count(*) from `sales_goods_$MEM[Id]` where bom IS NULL and `cate` = '$rows[cate]' ";
					// $result1=mysql_db_query($mysql_dbname,$query,$connect);
					$result1=mysql_db_query($server[dbname],$query,$dbconnect);
    				$total=mysql_result($result1,0,0); 

    				if($total >0)
    				$leftBody .= "<tr><td width='5' valign='top' style='border-left:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><font color='#3B5998' >▪</font></td>
    							  <td style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><a href='sales_goods.php?treemode=cate&cate=$rows[cate]'>$rows[cate]</a> ($total)</td></tr>";
    				else
    				$leftBody .= "<tr><td width='5' valign='top' style='border-left:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><font color='#3B5998' >▪</font></td>
    							  <td style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><a href='sales_goods.php?treemode=cate&cate=$rows[cate]'>$rows[cate]</a></td></tr>";	
    			} else break;
    		}
    						
    	} else {
    		$leftBody .= "<tr><td width='5' valign='top' style='border-left:1px solid #D2D2D2;border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><font color='#3B5998' >▪</font></td>
    							  <td style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'>등록된 분류가 없습니다.</td></tr>";	
    	}
	
	
		$leftBody .= "</table>";

		$body = str_replace("{product_cate}",$leftBody,$body);
					
?>
