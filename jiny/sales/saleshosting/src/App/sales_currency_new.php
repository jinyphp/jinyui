<?php
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
	

	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

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
			
			///////////////////////////
			//# 스킨 레이아웃 
			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
			$body = shopskin("admin_currency_new"); 
		
			$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='admin_currency_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
			$body = str_replace("{formend}","</form>",$body);
											
			$body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
			$body = str_replace("{currency}","<input type='text' name='currency' $cssFormStyle >",$body);
			$body = str_replace("{currencyid}","<input type='text' name='currencyid' $cssFormStyle >",$body);
			$body = str_replace("{currencyname}","<input type='text' name='currencyname' $cssFormStyle >",$body);
		
			$body = str_replace("{currency_align}","<input type='text' name='currency_align' value='$rows[currency_align]'  $cssFormStyle >",$body);
			$body = str_replace("{currency_mark}","<input type='text' name='currency_mark' value='$rows[currency_mark]'  $cssFormStyle >",$body);
			$body = str_replace("{currency_rate}","<input type='text' name='currency_rate' value='$rows[currency_rate]'  $cssFormStyle >",$body);
					
			
			$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $btn_style_blue >",$body);
		


			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	
	
	

?>

