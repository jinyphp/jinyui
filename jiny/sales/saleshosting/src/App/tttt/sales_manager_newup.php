<?
	@session_start();
	if($_SESSION['nonce'] != $_POST['nonce']){
		$_SESSION['nonce'] = NULL;	
	} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능

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
    		// echo $query; 
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
			
    			$email = $_POST['email'];
				$password = $_POST['password'];
    			
    			$manager = $_POST['manager'];
    			$phone = $_POST['phone']; 
    			$fax = $_POST['fax']; $fax = str_replace("-","",$fax);
    			$mobile = $_POST['mobile']; $mobile = str_replace("-","",$mobile);
    			$part = $_POST['part']; 
    			
    			$comment = $_POST['comment'];
    			
    		
    			if(!$email) msg_alert("오류! 이메일이 없습니다.");
    			else if(!$password) msg_alert("오류! 비밀번호가 없습니다.");
    			else if(!$manager) msg_alert("오류! 직원 이름이 없습니다.");
    			else {
					 
					$query = "select * from sales_manager where email = '$email'";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(  mysql_num_rows($result)  ) msg_alert("중복된 이메일주소 입니다.");
					else {
						$query = "INSERT INTO sales_manager (`regdate`, `members_id`, `part`, `name`, `email`, `password`, `fax`, `phone`, `mobile`,`memo`) 
    								VALUES ('$TODAY', '$MEM[Id]', '$part', '$manager', '$email', '$password', '$fax', '$phone', '$mobile', '$comment')";
    					mysql_db_query($mysql_dbname,$query,$connect);
					
					}
				}	
				
    			echo "<script> history.go(-2); </script>";	
		
				//////////////////////////////////////////////////////////////////		
		
			} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
	
		}
	

	} ///// ##### SESSION END ##### /////
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	
	
?>

