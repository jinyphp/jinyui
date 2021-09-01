<?	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../func_datetime.php";
	

	$domain = $_POST['domain'];
	$supplyer = $_POST['supplyer'];
	$GID = $_POST['GID'];
	$goodname = $_POST['goodname'];
	$spec = $_POST['spec'];
	$subtitle = $_POST['subtitle'];
	$images = $_POST['images'];

	$sell_prices = $_POST['sell_prices'];
	$supply_prices = $_POST['supply_prices'];

	$description = $_POST['description'];



	$query = "select * from `server_goods` where GID = '$GID' and domain = '$domain' ";
	$status .= $query ."<br>"; 
	
	$result=mysql_db_query($mysql_dbname,$query,$connect);
	if( mysql_affected_rows() ) {
		//정보 갱신
		$query = "UPDATE `server_goods` SET `goodname`='$goodname', `spec`='$spec', `subtitle`='$subtitle', `images`='$images', `sell_prices`='$sell_prices', 
							`description`='$description' where GID = '$GID' and domain = '$domain'";
		$status .= $query ."<br>"; 
		mysql_db_query($mysql_dbname,$query,$connect);
		
	} else {
		// 신규등록
		$query = "INSERT INTO `server_goods` (`regdate`, `domain`, `supplyer`, `GID`, `goodname`, `spec`, `subtitle`, `images`, `sell_prices`, `supply_prices`, `insales`, `description`) 
				VALUES ('$TODAYTIME', '$domain', '$supplyer', '$GID', '$goodname','$spec','$subtitle', '$images', '$sell_prices', '$supply_prices', 1, '$description');";
		$status .= $query ."<br>"; 
		mysql_db_query($mysql_dbname,$query,$connect);

	}
	
	echo $status;


	
    
?>
