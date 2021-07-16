<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
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
			$body = shopskin("sales_report");
			
			$body = str_replace("{company_name}",$MEM[company],$body); 
			$body = str_replace("{login_info}",$_COOKIE[manager],$body);
			
			//# 거래처 종합
			$query = "SELECT * FROM `sales_company_$MEM[Id]` ";
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
			$body = str_replace("{tot_company}",$total,$body);
			// $result=mysql_db_query($mysql_dbname,$query,$connect);
			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 					
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			$balance1 += $rows[balance1];
	    			$balance2 += $rows[balance2];
	    		}
	    		$body = str_replace("{balance1}",$balance1,$body);
	    		$body = str_replace("{balance2}",$balance2,$body);
	    		$balance = $balance1 - $balance2;
	    		$body = str_replace("{balance}",$balance,$body);
	    	}		
			
			//# 상품 종합
			$query = "SELECT * FROM `sales_goods_$MEM[Id]` ";
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
			$body = str_replace("{tot_goods}",$total,$body); 
			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	
	
	
	

	
?>
