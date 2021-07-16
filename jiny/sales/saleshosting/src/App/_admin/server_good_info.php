<?	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	$MID = $_POST['MID'];
   
    $query = "select * from `server_goods` where Id = '$MID'";
	$result=mysql_db_query($mysql_dbname,$query,$connect);
	if(mysql_affected_rows()) {
	 	$rows=mysql_fetch_array($result);
		$json = json_encode($rows);
    }
  
   	echo $json;    
   	
    
?>
