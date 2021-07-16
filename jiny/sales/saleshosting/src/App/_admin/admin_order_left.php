<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
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
				
				$query2 = "select * from `shop_order` where country = '$rows[code]' ";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				if($rows[code] == $countryCode){
    				//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    				//			  <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$rows[code]'><b>$rows[name]</b></a> ($total2)</font></td></tr>";
    			
    				$leftBody1 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$rows[code]'><b>$rows[name]</b></a> ($total2)</font> | ";
    			} else {
    				// $leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    				//			  <td><font size=2 color='000000'><a href='admin_orders.php?code=$rows[code]'>$rows[name]</a> ($total2)</font></td></tr>";
    				
    				$leftBody1 .= "<font size=2  color='000000'><a href='admin_orders.php?code=$rows[code]'>$rows[name]</a> ($total2)</font> | ";
    			}	
			}
			// $leftBody1 .= "</table>";
		}
	
		$body = str_replace("{productcountry}",$leftBody1,$body);
		
		////////////////////////
		// 주문상태 메뉴
		$leftBody1 = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
		if($_GET['status'] == "bankcheck"){
			//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=bankcheck'><b>무통장</b></a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=bankcheck'><b>무통장</b></a></font> | ";			   		
		} else {
			//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=bankcheck'>무통장</a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=bankcheck'>무통장</a></font> | ";
    	}
    	
    	if($_GET['status'] == "credit"){
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=credit'><b>카드주문</b></a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=credit'><b>카드주문</b></a></font> | ";
    	} else {
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=credit'>카드주문</a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=credit'>카드주문</a></font> | ";	
    	}
    	
    	
    	if($_GET['status'] == "ordering"){
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=ordering'><b>접수완료</b></a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=ordering'><b>접수완료</b></a></font> | ";
    	} else {
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=ordering'>접수완료</a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=ordering'>접수완료</a></font> | ";	
    	}

    	
    	if($_GET['status'] == "finish"){
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=finish'><b>배송완료</b</a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=finish'><b>배송완료</b</a></font> | ";
    	} else {
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=finish'>배송완료</a></font></td></tr>"; 
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=finish'>배송완료</a></font> | ";   	
    	}
    	
    	if($_GET['status'] == "cancel"){
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=cancel'><b>접수취소</b></a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=cancel'><b>접수취소</b></a></font> | ";				   				   				   
    	} else {
    		//$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    		//			   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=cancel'>접수취소</a></font></td></tr>";
    		$leftBody2 .= "<font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=cancel'>접수취소</a></font> | ";
    	}
    							  
		//$leftBody1 .= "</table>";
		$body = str_replace("{ordermenu}",$leftBody2,$body);


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
				
				$query2 = "select * from `shop_order` where country = '$rows[code]' ";
				$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
				$total2=mysql_result($result2,0,0);
				
				if($rows[code] == $countryCode){
    				$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$rows[code]'><b>$rows[name]</b></a> ($total2)</font></td></tr>";
    			} else {
    				$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2 color='000000'><a href='admin_orders.php?code=$rows[code]'>$rows[name]</a> ($total2)</font></td></tr>";
    			}	
			}
			$leftBody1 .= "</table>";
		}
	
		$body = str_replace("{productcountry}",$leftBody1,$body);
		
		////////////////////////
		// 주문상태 메뉴
		$leftBody1 = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
		
	
		
		$query2 = "select * from `shop_order` where country = '$countryCode' and status = 'bankcheck'";
		$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
		$total2=mysql_result($result2,0,0);
		
		if($_GET['status'] == "bankcheck"){
			$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=bankcheck'><b>무통장</b></a> ($total2)</font></td></tr>";		
		} else {
			$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=bankcheck'>무통장</a> ($total2)</font></td></tr>";
    	}
    	
    	//***
    	$query2 = "select * from `shop_order` where country = '$countryCode' and status = 'credit'";
		$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
		$total2=mysql_result($result2,0,0);

    	if($_GET['status'] == "credit"){
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=credit'><b>카드주문</b></a> ($total2)</font></td></tr>";
    	} else {
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=credit'>카드주문</a> ($total2)</font></td></tr>";    	
    	}
    	
    	
    	//***
    	$query2 = "select * from `shop_order` where country = '$countryCode' and status = 'ordering'";
		$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
		$total2=mysql_result($result2,0,0);
		
    	if($_GET['status'] == "ordering"){
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=ordering'><b>접수완료</b></a> ($total2)</font></td></tr>";
    	} else {
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=ordering'>접수완료</a> ($total2)</font></td></tr>";    	
    	}
    	
    	//***
    	$query2 = "select * from `shop_order` where country = '$countryCode' and status = 'finish'";
		$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
		$total2=mysql_result($result2,0,0);
		
    	if($_GET['status'] == "finish"){
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=finish'><b>배송완료</b</a> ($total2)</font></td></tr>";
    	} else {
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=finish'>배송완료</a> ($total2)</font></td></tr>";    	
    	}
    	
    	//***
    	$query2 = "select * from `shop_order` where country = '$countryCode' and status = 'cancel'";
		$result2=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query2),$connect);
		$total2=mysql_result($result2,0,0);
		
    	if($_GET['status'] == "cancel"){
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=cancel'><b>접수취소</b></a> ($total2)</font></td></tr>";				   				   				   
    	} else {
    		$leftBody1 .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    					   <td><font size=2  color='0000ff'><a href='admin_orders.php?code=$countryCode&status=cancel'>접수취소</a> ($total2)</font></td></tr>";
    	}
    							  
		$leftBody1 .= "</table>";
		$body = str_replace("{ordermenu}",$leftBody1,$body);
	}
					
?>
