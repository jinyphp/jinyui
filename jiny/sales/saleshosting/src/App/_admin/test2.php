<?	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
    /*
    $query = "select * from `shop_goods` where api='on' ";
	$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    $total=mysql_result($result,0,0);
    	
	$result=mysql_db_query($mysql_dbname,$query,$connect);
	if(mysql_affected_rows()) {
	 	for($i=0;$i<$total;$i++){
			$rows=mysql_fetch_array($result);
			$json .= json_encode($rows)."\n";
		}
    }
    
   	echo $json;
    */
    
    $query = "select * from `master_goods` ";
	$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    $total=mysql_result($result,0,0);
    	
	$result=mysql_db_query($mysql_dbname,$query,$connect);
	if(mysql_affected_rows()) {
	 	for($i=0;$i<$total;$i++){
			$rows=mysql_fetch_array($result);
			$json .= json_encode($rows)."\n";
		}
    }
    
   	echo $json;    
    
?>
