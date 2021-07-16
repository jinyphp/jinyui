<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	
	include "./func_adminstring.php";	
	
	function android_alertShowMessage($title,$message){
		echo "<script type=\"text/javascript\">
			showAlertDialog(\"$title\",\"$message\")
	    	history.go(-1) 
	    </script>";
    }
    
    
    if( $_COOKIE[adminemail]){
		echo "<meta http-equiv='refresh' content='0; url=./shop_main.php'>";
	} else { //////////////////////////////////////////
    

    	if($_POST['mode'] == "login"){
    		
    		if(!$_POST['email']) msg_alert("이메일 주소가 없습니다.");
    		
    		if(!$_POST['password']) msg_alert("비밀번호가 없습니다.");
    		
    		if($_POST['email'] && $_POST['password']){
    			$email = str_replace("'","",$_POST['email']);
    			$PASSWORD = str_replace("'","",$_POST['password']);
    			
    			$query = "select * from shop_manager  where email = '$email'";
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
		    		
		    		/////////////////////////////////////////////
		    		
		    		if( $_POST['email'] == $rows[email] && $_POST['password'] == $rows[password] ){
		    			
		    				    			
		   					if(!$_COOKIE[Session]) setcookie("Session","login",0,"/");
		   					setcookie("adminemail",$rows[email],0,"/");
		   					
		   					//setcookie("device",$rows[DEVICE],0,"/");
		   					
		   					
		   					$query = "UPDATE shop_manager SET lastlogin='$TODAYTIME' WHERE email='$rows[email]'";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
    						$msg = multiString_conv("ko","관리자로그인",$LANG);
    						echo "<script> window.alert($msg) </script>";
    						
    						echo "<meta http-equiv='refresh' content='0; url=./admin_main.php'>";
    					
    				} else {
    					// $msg = multiString_conv("ko","비빌번호가 일치하지 않습니다.",$LANG);
    					// msg_alert($msg);
    					msg_alert("비밀번호가 일치하지 않습니다.");
    				}
    				
    				
		    		
				} else {
					
					$msg = multiString_conv("ko","존재하지 않는 이메일 주소입니다.",$LANG);
					msg_alert($msg);	
    			}
    		} 
    		
    	
    	} else {
    	///////////////////////////////////////////////////////////////
    	
    		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    		$body = admin_shopskin("admin_login");

			
			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);
			$query = "select * from `shop_seo` where domain = '$domain' and language = 'ko'";
		 
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_affected_rows() ){ 
		    	$rows=mysql_fetch_array($result);
		    	$body = str_replace("{sitename}","<a href='http://www.".$domain."'>$rows[title]</a>",$body);
		    } else {
		    	$body = str_replace("{sitename}","unknown",$body);
		    }		
		
			
			//* FORM 입력처리
			$body=str_replace("{formstart}","<form name='login' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$userID'>
					    				<input type='hidden' name='mode' value='login'>",$body);
			$body = str_replace("{formend}","</form>",$body);
			$body = str_replace("{email}","<input type='email' name='email' value='$rows[email]' autofocus reguired $cssFormStyle >",$body);    
			$body = str_replace("{password}","<input type='password' name='password' value='$rows[password]' reguired $cssFormStyle >",$body);
			
			$body = str_replace("{submit}","<input type='submit' name='reg' value='로그인' $css_submit >",$body);
		
			$body = str_replace("{login}","",$body);

			//*
			//# 번역스트링 처리
			$body = _adminstring_converting($body);
			echo $body;
    	
    	}
	}    
    
    
    
    
    
	

?>
