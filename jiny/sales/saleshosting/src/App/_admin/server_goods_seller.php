<?	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../func_datetime.php";
	

	$domain = $_POST['domain'];
	$reseller = $_POST['reseller'];
	$GID = $_POST['GID'];
	
	$sell_prices = $_POST['sell_prices'];
	$buy_prices = $_POST['buy_prices'];
	
	$sell_currency = $_POST['sell_currency'];
	$buy_currency = $_POST['buy_currency'];

	$query = "select * from `server_goods_sellers` where GID = '$GID' and domain = '$domain' ";
	$status .= $query ."<br>"; 
	
	$result=mysql_db_query($mysql_dbname,$query,$connect);
	if( mysql_affected_rows() ) {
		
		$query = "UPDATE `server_goods_sellers` SET `reseller`='$reseller', `sell_prices`='$sell_prices', `buy_prices`='$buy_prices', 
							`sell_currency`='$sell_currency', `buy_currency`='$buy_currency' where GID = '$GID' and domain = '$domain'";
		$status .= $query ."<br>"; 
		mysql_db_query($mysql_dbname,$query,$connect);
		
	} else {
		
		$query = "INSERT INTO `server_goods_sellers` (`regdate`, `domain`, `reseller`, `GID`, `sell_prices`, `buy_prices`, `sell_currency`, `buy_currency`) 
				VALUES ('$TODAYTIME', '$domain', '$reseller', '$GID', '$sell_prices', '$buy_prices', '$sell_currency', '$buy_currency');";
		$status .= $query ."<br>"; 
		mysql_db_query($mysql_dbname,$query,$connect);

	}
	
	echo $status;


	
    
?>
