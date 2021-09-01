<?


	if($_GET['treemode'] == "country"){
		$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
	
		$query = "select * from `sales_company_$MEM[Id]` group by country desc";
		// $result=mysql_db_query($mysql_dbname,$query,$connect);
		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    	if( mysql_num_rows($result) ){
    		
    		while(1){
    			$rows=mysql_fetch_array($result);
    			if($rows[country]) {

    				$query = "select count(*) from `sales_company_$MEM[Id]` where `country` = '$rows[country]' ";
					// $result1=mysql_db_query($mysql_dbname,$query,$connect);
					$result1=mysql_db_query($server[dbname],$query,$dbconnect);
    				$total=mysql_result($result1,0,0); 

    			
    				if($total >0)
    				$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_company.php?treemode=country&country=$rows[country]'>$rows[country]</a> ($total)</font></td></tr>";
    				else
    				$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_company.php?treemode=country&country=$rows[country]'>$rows[country]</a></font></td></tr>";	

    			} else break;
    		}
    						
    	}
	
	
		$leftBody .= "</table>";
		
	} else {

		//** 일반모드
		
		$leftBody = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
		
						
						$query = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '1' ";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					$total=mysql_result($result,0,0); //echo "inout : $total, $query <br>";

    					if($total > 0 ){
							$cate_out  = "<font size=2><a href='sales_company.php?inout=1'>{@16}</a> ($total)</font>";
						} else {
							$cate_out  = "<font size=2><a href='sales_company.php?inout=1'>{@16}</a></font>";
						}
						
						$query = "select * from `sales_company_$MEM[Id]` where `inout` = '1' group by country desc";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ){
    						$cate_out .= "<table border='0' cellspacing='2' cellpadding='2' width=100%>";
    						while(1){
    							$rows=mysql_fetch_array($result);
    							
    							$query1 = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '1' and country = '$rows[country]'";
								// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
								$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    							$total1=mysql_result($result1,0,0);
    							
    							
    							if($rows[country]) $cate_out .= "<tr><td style='font-size:12px;padding:10px;'>
    							<font color='#DEDEDF'>┗</font> <a href='sales_company.php?inout=1&country=$rows[country]'>$rows[country]</a> ($total1)</td></tr>";
    							else break;
    						}
    						$cate_out .= "</table>";
    					}
						// $body = str_replace("{cate_out}",$cate_out,$body);
						
						///////////////////////
						
						$leftBody .= "<tr><td width='5' valign='top' style='border-left:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><font color='#3B5998' size='2'>▪</font></td>
						<td style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'>$cate_out</td></tr>";						
		
						
						$query = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '2' ";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					$total=mysql_result($result,0,0); //echo "inout : $total, ";
    					if($total > 0 ){
							$cate_in  = "<font size=2><a href='sales_company.php?inout=2'>{@17}</a> ($total)</font>";
							//$body = str_replace("{cate_in}",$cate_in,$body);
						} else {
							$cate_in  = "<font size=2><a href='sales_company.php?inout=2'>{@17}</a></font>";
							//$body = str_replace("{cate_in}",$cate_in,$body);
						}
						
						$query = "select * from `sales_company_$MEM[Id]` where `inout` = '2' group by country desc";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ){
    						$cate_in .= "<table border='0' cellspacing='2' cellpadding='2' width=100%>";
    						while(1){
    							$rows=mysql_fetch_array($result);
    							
    							$query1 = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '2' and country = '$rows[country]'";
								// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
								$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    							$total1=mysql_result($result1,0,0);
    							
    							
    							if($rows[country]) $cate_in .= "<tr><td style='font-size:12px;padding:10px;'>
    							<font color='#DEDEDF'>┗</font> <a href='sales_company.php?inout=2&country=$rows[country]'>$rows[country]</a> ($total1)</td></tr>";
    							else break;
    						}
    						$cate_in .= "</table>";
    					}
						// $body = str_replace("{cate_in}",$cate_in,$body);
						
						////////////////////////////////
						
						$leftBody .= "<tr><td width='5' valign='top' style='border-left:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><font color='#3B5998' size='2'>▪</font></td>
						<td style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'>$cate_in</td></tr>";						
						
						$query = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '3' ";
						// $result = mysql_db_query($mysql_dbname,$query,$connect);
						$result = mysql_db_query($server[dbname],$query,$dbconnect);
    					$total = mysql_result($result,0,0); // echo "inout : $total, ";
						if($total > 0){
							$cate_inout = "<font size=2><a href='sales_company.php?inout=3'>{@18}</a> ($total)</font>";	
						} else {
							$cate_inout = "<font size=2><a href='sales_company.php?inout=3'>{@18}</a></font>";
						}
						
						$query = "select * from `sales_company_$MEM[Id]` where `inout` = '3' group by country desc";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ){
    						$cate_inout .= "<table border='0' cellspacing='2' cellpadding='2' width=100%>";
    						while(1){
    							$rows=mysql_fetch_array($result);
    							
    							$query1 = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '3' and country = '$rows[country]'";
								// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
								$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    							$total1=mysql_result($result1,0,0);
    						
    							
    							if($rows[country]) $cate_inout .= "<tr><td style='font-size:12px;padding:10px;'>
    							<font color='#DEDEDF'>┗</font> <a href='sales_company.php?inout=3&country=$rows[country]'>$rows[country]</a> ($total1)</td></tr>";
    							else break;
    						}
    						$cate_inout .= "</table>";
    					}
						// $body = str_replace("{cate_inout}",$cate_inout,$body);
						
						$leftBody .= "<tr><td width='5' valign='top' style='border-left:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><font color='#3B5998' size='2'>▪</font></td>
						<td style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'>$cate_inout</td></tr>";
						
						/////////////////////////
						
						$query = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '4' ";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					$total=mysql_result($result,0,0); // echo "inout : $total, ";
						if($total > 0 ){
							$cate_nornal  = "<font size=2><a href='sales_company.php?inout=4'>{@19}</a> ($total)</font>";
							$body = str_replace("{cate_nornal}",$cate_nornal,$body);
						} else {
							$cate_nornal  = "<font size=2><a href='sales_company.php?inout=4'>{@19}</a></font>";
							$body = str_replace("{cate_nornal}",$cate_nornal,$body);
						}
						
						$query = "select * from `sales_company_$MEM[Id]` where `inout` = '4' group by country desc";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ){
    						$cate_nornal .= "<table border='0' cellspacing='2' cellpadding='2' width=100%>";
    						while(1){
    							$rows=mysql_fetch_array($result);
    							
    							$query1 = "select count(*) from `sales_company_$MEM[Id]` where `inout` = '4' and country = '$rows[country]'";
								// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
								$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    							$total1=mysql_result($result1,0,0);
    						
    							
    							if($rows[country]) $cate_nornal .= "<tr><td style='font-size:12px;padding:10px;'>
    							<font color='#DEDEDF'>┗</font> <a href='sales_company.php?inout=4&country=$rows[country]'>$rows[country]</a> ($total1)</td></tr>";
    							else break;
    						}
    						$cate_nornal .= "</table>";
    					}
					
						$leftBody .= "<tr><td width='5' valign='top' style='border-left:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'><font color='#3B5998' size='2'>▪</font></td>
						<td style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;font-size:12px;padding:10px;'>$cate_nornal</td></tr>";		
		

		$leftBody .= "</table>";
	}
	
	$body = str_replace("{companyMenu}",$leftBody,$body);

			
?>
