<?
	@session_start();


	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; //# 사이트 언어, 지역 설정
	include "mobile.php";
	
	include "./func_skin.php"; //# 스킨 레이아웃 함수들...
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	
	if( !isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
	  	$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";
	} else { //////////////////////////////////////////
		
		$query = "select * from `sales_members` where email = '$_COOKIE[email]'"; 
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(  mysql_num_rows($result)  ){ 
			$MEM=mysql_fetch_array($result);
		
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(  mysql_num_rows($result)  )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}



			//////////////////////////////////////////////////////////////////
			
    		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    			
    		$query="UPDATE `sales_goods_$MEM[Id]` SET `auth`='on' WHERE `Id`='$UID'";
    		// mysql_db_query($mysql_dbname,$query,$connect);
    		mysql_db_query($server[dbname],$query,$dbconnect);
    			
    		echo "<script> history.go(-1); </script>";	
		
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
	
	}
	

	mysql_close($connect);
	mysql_close($dbconnect);
	
	
	
?>

