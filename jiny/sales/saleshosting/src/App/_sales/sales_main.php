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
	
	include "./gcm/gcm_sales.php";
	
	// echo "sales main<br>";
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
		// echo $query."<br>";
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
			$body = shopskin("sales_main");
			
			if($MEM[company]) $body = str_replace("{company_name}",$MEM[company],$body);
			else if($MEM[manager]) $body = str_replace("{company_name}",$MEM[manager],$body);
			else $body = str_replace("{company_name}","<a href='sales_members_edit.php'>업체명</a>을 입력해 주세요. ",$body);
			
			
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
	    	} else {
	    		$body = str_replace("{balance1}","0",$body);
	    		$body = str_replace("{balance2}","0",$body);
	    		$body = str_replace("{balance}","0",$body);
			}	
			
			//# 상품 종합
			$query = "SELECT * FROM `sales_goods_$MEM[Id]` ";
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
			$body = str_replace("{tot_goods}",$total,$body); 
			
			//
			$body = str_replace("{memtype}","$MEM[memtype]",$body);
			
			$body = str_replace("{max_company}","$MEM[maxcompany]",$body);
			$body = str_replace("{max_trans}","$MEM[maxtrans]",$body);			
			$body = str_replace("{renewal}","$MEM[paydate]",$body);
			
			if($MEM[expire] < $TODAY){
				$msg = "유료 사용기간이 만료 했습니다. 기간연장 및 결제를 부탁드립니다.";
				echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       					<script>
       						alert(\"$msg\");
       						location.href=\" ./sales_members_service.php \";
    					</script>";  
				$body = str_replace("{expire}","<font color='#FF0000'>$MEM[expire]</font>",$body);
			} else $body = str_replace("{expire}","$MEM[expire]",$body);
			
			
			/////
			// 전표 수량
			$year=substr($rows[transdate],0,4);
			$query = "select * from sales_trans_$MEM[Id] where transdate >= '$year-01-01' ";   	
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 					
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			if($rows[transdate] == "$TODAY") $_today++;
	    			
	    			if($rows[transdate] == "$TODAY" and $rows[trans] == "sell") {
	    				$_today_sell++;
	    				$_today_sell_prices += $rows[prices_total];
	    			}
	    			
	    			if($rows[transdate] == "$TODAY" and $rows[trans] == "buy") {
	    				$_today_buy++;
	    				$_today_buy_prices +=$rows[prices_total];
	    			}
	    			
	    			
	    			$month=substr($rows[transdate],0,8);
	    			if($rows[transdate] >= $month."01" and $rows[transdate] <= $month."31" and $rows[trans] == "sell") {
	    				$_month_sell++;
	    				$_month_sell_prices += $rows[prices_total];
	    			}
	    			
	    			if($rows[transdate] >= $month."01" and $rows[transdate] <= $month."31" and $rows[trans] == "buy") {
	    				$_month_buy++;
	    				$_month_buy_prices += $rows[prices_total];
	    			}
	    			
	    			
	    			
	    			if($rows[transdate] >= $year."-01-01"  and $rows[trans] == "sell") {
	    				$_year_sell++;
	    				$_year_sell_prices += $rows[prices_total];
	    			}
	    			
	    			if($rows[transdate] >= $year."-01-01"  and $rows[trans] == "buy") {
	    				$_year_buy++;
	    				$_year_buy_prices += $rows[prices_total];
	    			}
	    			
	    			
	    			
    			}
    		}
    		
    		
    		$body=str_replace("{today_trans}","$_today",$body);

			$body=str_replace("{sell_today}","$_today_sell",$body);
			$body=str_replace("{sell_today_prices}","$_today_sell_prices",$body);
			
			$body=str_replace("{sell_month}","$_month_sell",$body);
			$body=str_replace("{sell_month_prices}","$_month_sell_prices",$body);
			
			$body=str_replace("{sell_year}","$_year_sell",$body);
			$body=str_replace("{sell_year_prices}","$_year_sell_prices",$body);
			
			
			
			$body=str_replace("{buy_today}","$_today_buy",$body);
			$body=str_replace("{buy_today_prices}","$_today_buy_prices",$body);
			
			$body=str_replace("{buy_month}","$_month_buy",$body);
			$body=str_replace("{buy_month_prices}","$_month_buy_prices",$body);
			
			$body=str_replace("{buy_year}","$_year_buy",$body);
			$body=str_replace("{buy_year_prices}","$_year_buy_prices",$body);

			
			
			//////////////////////////////////////////////////////////////////
			
			// GCM_SenderByPhone("01039113106","신규회원등록:$MEM[email]신규회원가입!","sales",$mysql_dbname,$connect);

		
		} else {
			msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		}
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	
	
	

	
?>
