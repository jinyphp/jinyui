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
	include "./func_goods.php";
	
	include "./func_string.php";
	
    if( $_COOKIE[Session] && $_COOKIE[email] ){
    	// 로그인 페이지로 이동...
		echo "<meta http-equiv='refresh' content='0; url=./sales_main.php'>";
	} else { //////////////////////////////////////////
	
		if(!$_POST['email']) msg_alert("이메일을 입력해 주십시요!");
		else if(!$_POST['password']) msg_alert("비밀번호를 입력해 주십시요!");
		else {	
		
		
    		$query = "select * from sales_manager where email = '".$_POST['email']."'";
    		//echo $query."<br>";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_affected_rows() ){ 
		    	$rows=mysql_fetch_array($result);
		    	
		    	$email = $_POST['email'];
		    	$password = $_POST['password'];
				if($email == $rows[email] && $password == $rows[password]){

					$query = "select * from sales_members where Id = '$rows[members_id]'";
    				//echo $query."<br>";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
					if( mysql_affected_rows() ){ 
		    			$MEM=mysql_fetch_array($result);

						if(!$_COOKIE[Session]) setcookie("Session","login",0,"/");
						setcookie("email",$MEM[email],0,"/");
						setcookie("manager",$rows[email],0,"/");
						
						$_SESSION['bizmenu'] = $rows[bizmenu];
						
						// echo "set login email is $MEM[email] <br>";
						// echo "login email is $MEM[email] == ".$_COOKIE[email];

						/*
		    			// if($TODAY <= $rows[expire]) echo "<script> window.alert(\"사용기간 만료! 연장해 주세요\") </script>";
		    			// msg_alert("유료 회원 접속기간이 만료 되었습니다. 연장필요!");
	
		   				//setcookie("albaCode",$rows[albacode],0,"/");
		   				//setcookie("memid",$rows[Id],0,"/");
		 				//setcookie("phone",$rows[phone],0,"/");
		   				//setcookie("device",$rows[DEVICE],0,"/");
		   			
		   				//$query = "UPDATE sales_members SET lastlogin='$TODAYTIME' WHERE Id='$rows[Id]'";
    					//echo $query."<br>";
    					//mysql_db_query($mysql_dbname,$query,$connect);
    			
    					// $msg = "Master 로그인";
    					// echo "<script> window.alert($msg) </script>";
    					*/
    					
    					
    					echo "<meta http-equiv='refresh' content='0; url=./sales_main.php'>";
    				
    				} else msg_alert("오류, 이메일, 패스워드가 일치하지 않습니다.");	
    				
    				
    			} else msg_alert("오류, 직원 회원이메일 및 비밀번호가 일치하지 않습니다.");	
		    		
			} else msg_alert("오류, 회원 이메일을 찾을 수 없습니다.");

			
		}
	
	} 	
	
	
    
?>
