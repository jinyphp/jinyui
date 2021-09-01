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
		
		$CSS_search = "style='height:30px;width:100%;margin:-3px;border:2px;border:1px solid #D2D2D2;'";

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
			$company_id = $_POST['company_id']; if(!$company_id) $company_id = $_GET['company_id'];
			$start = $_POST['start']; if(!$start) $start = $_GET['start'];
			$end = $_POST['end']; if(!$end) $end = $_GET['end'];
			$manager = $_POST['manager']; if(!$manager) $manager = $_GET['manager'];
			
			//# 스킨 레이아웃 
			$body = shopskin("sales_report_buy");
			
			$body = str_replace("{formstart}","<form name='report' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='nonce' value='$nonce'>
					    						 <input type='hidden' name='company_id' value='$company_id'>
					    						 <input type='hidden' name='mode' value=''>",$body);
			$body = str_replace("{formend}","</form>",$body);
			
			if($start) $body=str_replace("{start}","<input type='date' name='start' value='$start' $CSS onChange=\"javascript:submit()\">",$body);
			else $body=str_replace("{start}","<input type='date' name='start' value='$TODAY' $CSS onChange=\"javascript:submit()\">",$body);
			
			if($end) $body=str_replace("{end}","<input type='date' name='end' value='$end' $CSS onChange=\"javascript:submit()\">",$body);
			else $body=str_replace("{end}","<input type='date' name='end' value='$TODAY' $CSS onChange=\"javascript:submit()\">",$body);	
			
			
			$script = "<script>
       				function pageprint() {
       				
						var divElements = document.getElementById('printbody').innerHTML;
            			var oldPage = document.body.innerHTML;
           				document.body.innerHTML = \"<html><head><title></title><link rel='stylesheet' type='text/css' href='css/print.css' media='print'></head><body>\" + divElements + \"</body>\";
           				
           				window.print();
           				document.body.innerHTML = oldPage; v

            			       
       				 } 			
    			</script>"; 
    		
    		$body = str_replace("{print}","$script <input type='button' value='인쇄' $butten_style onclick=\"javascript:pageprint()\">",$body);	
			
			
			if($_POST['company_search']){
			//# 거래처 검색
				$query = "select * from `sales_company_$MEM[Id]` where company like '%".$_POST['company_search']."%'";
				// echo $query."<br>";
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    			$total = mysql_result($result,0,0);
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
						$listform = bodyskin("sales_payment_search",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{companylist}","<a href='".$_SERVER['PHP_SELF']."?company_id=$rows[Id]&start=$start&end=$end&manager=$manager'>$rows[company]</a>","$listform");
						$companylist .= $listform;
					}
				}
				// $companylist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
				$body = str_replace("{company_list}",$companylist,$body);
				

			} else $body = str_replace("{company_list}","",$body);
			
			
			if($company_id){
				$query = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
				// $result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
	    			$rows=mysql_fetch_array($result);
					$body=str_replace("{company}","$rows[company]",$body);
					$body = str_replace("{search}","",$body);
				}
					
				$body = str_replace("{company_search}","<input type='text' name='company_search' value='$rows[company]' $CSS_search placeholder='거래처'>",$body);
				$body = str_replace("{submit}","<input type='submit' name='reg' value='검색'>",$body);	
			} else {
				$body = str_replace("{company_search}","<input type='text' name='company_search' $CSS_search placeholder='거래처'>",$body);
				$body = str_replace("{submit}","<input type='submit' name='reg' value='검색'>",$body);
			}

			
			$query1 = "select * from sales_manager where members_id = '$MEM[Id]'";
			$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    		$total1=mysql_result($result1,0,0);	
			$result1=mysql_db_query($mysql_dbname,$query1,$connect);
			if( mysql_num_rows($result1) ) {
				$_manager = "<select name='manager' $cssFormStyle >";
				$_manager .= "<option value=''>담당자</option>";
				for($ii=0;$ii<$total1;$ii++){
					$rows1=mysql_fetch_array($result1);
					//if($GOO[manager] == $rows1[Id]) $manager .= "<option value='$rows1[Id]' selected>$rows1[name]</option>"; 
					//else 
					$_manager .= "<option value='$rows1[Id]'>$rows1[name]</option>";
				}
				$body = str_replace("{manager_list}","$_manager",$body);
			}
			




			// 목록 표시
			if($company_id) $query = "SELECT * FROM `sales_company_$MEM[Id]` where Id = '$company_id' ";
			else $query = "SELECT * FROM `sales_company_$MEM[Id]` ";
			//echo "listing...".$query."<br>";
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    		
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 	
    		
				$list = "<h1 align='center'>매출처원장</h1>";			
				$list .= "<font size='2' align='center'>$start ~ $end</font>";			
	    		
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_report_buy_subtitle",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{company}","<b>$rows[company]</b>",$listform);	
				
					$listform = str_replace("{president}","$rows[president]",$listform);
					$listform = str_replace("{phone}","$rows[phone]",$listform);
					$listform = str_replace("{currency}","$rows[currency]",$listform);
					
					$listform = str_replace("{balance}","$rows[balance2]",$listform);

					$list .= $listform;	
					
				
					$query1 = "SELECT * FROM `sales_trans_$MEM[Id]` where ( trans = 'buy' or trans = 'buy_payin' ) and UIDB = '$rows[Id]'";
					
					//echo "transdate >= '$start' and transdate <= '$end' <br>";
					
					if($start && $end) $query1 .= " and transdate >= '$start' and transdate <= '$end' ";
					else $query1 .= " and transdate >= '".$TODAY."' and transdate <= '".$TODAY."' ";
			
					if($manager) $query1 .= " and manager = '$manager' ";
			
					$query1 .= " order by transdate desc, Id desc";
					
					//echo "trans...".$query1."<br>";
					// $result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
					$result1 = mysql_db_query($server[dbname],str_replace("*","count(*)",$query1),$dbconnect);
    				$total1 = mysql_result($result1,0,0);
    				// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    				if( mysql_num_rows($result1) ){ 				
	    		
						for($j=0;$j<$total1;$j++){
	    					$trans=mysql_fetch_array($result1);
	    					
	    					$listform = bodyskin("sales_report_buy_list",$_SESSION['mobile'],$_SESSION['language']);
					
							$day=substr($trans[transdate],8,2);
							$listform = str_replace("{day}","$trans[transdate]","$listform");
				
							
							$listform = str_replace("{spec}","$trans[spec]",$listform );
							$listform = str_replace("{num}","$trans[num]",$listform );
							$listform = str_replace("{prices}","$trans[prices]",$listform );
							$listform = str_replace("{sum}","$trans[prices_sum]",$listform );
							$listform = str_replace("{vat}","$trans[vat]",$listform );
							$listform = str_replace("{discount}","$trans[discount]",$listform );
							$listform = str_replace("{total}","$trans[prices_total]",$listform );
							
							if($trans[trans] == "buy_payin") {
								$listform = str_replace("{paymoney}","$trans[paymoney]",$listform );
								$listform = str_replace("{goodname}","입금 / $trans[payment]","$listform");	
							} else {
								$listform = str_replace("{paymoney}","",$listform );
								$listform = str_replace("{goodname}","$trans[goodname]","$listform");	
							}
							
							$num += $trans[num];
							$prices += $trans[prices];
							$prices_sum += $trans[prices_sum];
							$vat += $trans[vat];
							$discount += $trans[discount];
							$prices_total += $trans[prices_total];
							if($trans[trans] == "buy_payin") $paymoney += $trans[paymoney];
							
							$list .= $listform;	


						}
						
						$listform = bodyskin("sales_report_buy_list",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{day}","","$listform");
						$listform = str_replace("{goodname}","소계","$listform");	
						$listform = str_replace("{spec}","",$listform );
						$listform = str_replace("{num}","$num",$listform );
						$listform = str_replace("{prices}","$prices",$listform );
						$listform = str_replace("{sum}","$prices_sum",$listform );
						$listform = str_replace("{vat}","$vat",$listform );
						$listform = str_replace("{discount}","$discount",$listform );
						$listform = str_replace("{total}","$prices_total",$listform );
						$listform = str_replace("{paymoney}","$paymoney",$listform );
							
						$list .= $listform;	
						
					}
	    			
	    			///////////
			
	    		}
	    	
				$body=str_replace("{reportlist}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","등록/검색된 거래처가 없습니다.",$listform);
	    		$body=str_replace("{reportlist}",$listform,$body);
	    	}


			
			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	
	
	
	

	
?>
