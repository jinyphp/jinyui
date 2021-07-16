<?
	@session_start();
	
    include "./dbinfo.php";
    $connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
    
    $query = "UPDATE sales_members SET DEVICE='$_COOKIE[DEVICEID]' WHERE albaCode='$_COOKIE[albaCode]'";
    mysql_db_query($mysql_dbname,$query,$connect);
    
    
    echo "<script>  
    		window.alert(\"새로운 모바일 기기로 갱신되었습니다.\");
    		history.go(-1) 
	      </script>";
	
    
    // echo "<meta http-equiv='refresh' content='0; url=./sales_main.php'>";

    
?>
