<?
	@session_start();
	
	include "./dbinfo.php";
	$connect = mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	
	
	$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    $result=mysql_db_query($mysql_dbname,$query,$connect);
	if( mysql_num_rows($result) ){ 
		$MEM=mysql_fetch_array($result);
	
		//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
		$query = "select * from `sales_server` where Id = '$MEM[server]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if( mysql_affected_rows() )	{
			$server = mysql_fetch_array($result);
			$dbconnect = mysql_connect($server[ip],$server[userid],$server[password],TRUE);				
		} 
		
	
		$query = "select * from `sales_company_$MEM[Id]` ";
		$result = mysql_db_query($server[dbname],$query,$dbconnect);
    	if($result){
			$rows=mysql_fetch_array($result);
			
		} else echo "sales_company_$MEM[Id] is empty <br>";
	
	
	}
	

	
	
	

	
?>

