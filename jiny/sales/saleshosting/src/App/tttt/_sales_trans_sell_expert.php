<?
	@session_start();
	
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php";
	include "mobile.php";
	
	include "./func_skin.php"; 
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
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
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
			$company_id = $_POST['company_id']; if(!$company_id) $company_id = $_GET['company_id'];
			$transdate = $_POST['transdate']; if(!$transdate) $transdate = $_GET['transdate'];
			$TID = $_POST['TID'];
			
			
			if($mode == "send"){
			
				for($i=0;$i<count($TID);$i++){
				
					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID[$i]'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ) {
    					$rows=mysql_fetch_array($result);
    					
						if($rows[expert]){
						
						} else {
							
        					
        					//# 상대 거래처에 자료 입력하기...
        					if($company_id){
        						// 1. 거래처 정보 읽어오기
        						$query = "select * from sales_company_$MEM[Id] where Id = '$company_id'";
								// echo $query."<br>";
								// $result=mysql_db_query($mysql_dbname,$query,$connect);
								$result=mysql_db_query($server[dbname],$query,$dbconnect);
								if(  mysql_num_rows($result)  ){
									$coms = mysql_fetch_array($result);
									
									// 2. 서비스 이용중인 회원인지 검사
									if($coms[email]){
										$query = "select * from `sales_members` where email = '$coms[email]'";
    									// echo $query."<br>";
    									$result=mysql_db_query($mysql_dbname,$query,$connect);
										if(  mysql_num_rows($result)  ){ 
											$mem1=mysql_fetch_array($result);
											
											// 거래처 DB접속 정보 
											$query = "select * from `sales_server` where Id = '$mem1[server]'";
    										$result=mysql_db_query($mysql_dbname,$query,$connect);
											if(  mysql_num_rows($result)  )	{
												$_server=mysql_fetch_array($result);
												$_dbconnect=mysql_connect($_server[ip],$_server[userid],$_server[password]) or die("user database can not connect.");
											}

											
											$query = "select * from sales_company_$mem1[Id] where email = '$MEM[email]'";
											// echo $query."<br>";
											// $result=mysql_db_query($mysql_dbname,$query,$connect);
											$result=mysql_db_query($_server[dbname],$query,$_dbconnect);
											if(  mysql_num_rows($result)  ){
												$coms2 = mysql_fetch_array($result);
												
												$COMB = $coms2[Id];
												$query = "INSERT INTO `sales_trans_$mem1[Id]` (`regdate`, `transdate`, `memid`, `trans`,  `UIDA`, `UIDB`,  
															`goodname`, `spec`, `num`, `currency`, `prices`, `vat`, `discount`, `prices_sum`, `prices_total`, `TIDA`) 
														VALUES ('$TODAYTIME', '$transdate', '$MEM[Id]', 'buy',  '$COMA', '$COMB',  
															'$rows[goodname]', '$rows[spec]', '$rows[num]', '$rows[currency]', '$rows[prices]', '$rows[vat]', '$rows[discount]', '$rows[prices_sum]', '$rows[prices_total]','$TID[$i]'	)";
												// echo $query."<br>";
												mysql_db_query($_server[dbname],$query,$_dbconnect);
												//mysql_db_query($mysql_dbname,$query,$connect);
												
												
												// 전송 표시
												$query = "UPDATE `sales_trans_$MEM[Id]` SET `expert`='$TODAYTIME' WHERE `Id`='$TID[$i]'";
        										// mysql_db_query($mysql_dbname,$query,$connect);
        										mysql_db_query($server[dbname],$query,$dbconnect);
        										// echo $query."<br>";
												
											} else {
												$msg = "오류! 상대방 거래처에 내정보 거래처가 등록되어 있지 않습니다..";
											
											}
									
										} else $msg = "* 오류! $coms[company]는 우리 사이트 사용 회원이 아닙니다. 등록된 회원 거래처만  전표 전송을 할 수 있습니다.";
										
									} else $msg = "오류! 전표 전송을 하기 위해서는, 회원 email 주소가 잆어야 합니다.";
								} else $msg = "오류! 등록되지 않은 거래처 입니다.";
        					
        					} else $msg = "오류! 거래처 코드가 없습니다.";
        					
        						
						}
 
					} else $msg = "오류! 자료가 없는 전표입니다.";
					
    				
				}
				echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
				echo $msg;
				// echo "<meta http-equiv='refresh' content='0; url=sales_trans_sell.php?company_id=$company_id&transdate=$transdate'>";
			
			} else {
			
				$body = shopskin("sales_trans_sell_expert");

    			$body = str_replace("{formstart}","<form name='expert' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='company_id' value='$company_id'>
					    						 <input type='hidden' name='transdate' value='$transdate'>
					    						 <input type='hidden' name='mode' value='send'>",$body);
				$body = str_replace("{formend}","</form>",$body);
    			$body = str_replace("{send}","$script <input type='submit' value='전송' $butten_style >",$body);	
    	
			
				$body=str_replace("{transdate}","$transdate",$body);
			
				if($company_id){
					$query = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
					// $result=mysql_db_query($mysql_dbname,$query,$connect);
					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ){ 				
	    				$coms=mysql_fetch_array($result);
	    				$body=str_replace("{company}","$coms[company]",$body);
					}
				} else {
					$body=str_replace("{company}","_____",$body);
				
					$msg = "거래처가 없습니다.";
					echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       					<script> alert(\"$msg\"); </script>";
       				echo "<meta http-equiv='refresh' content='0; url=sales_trans_sell.php?company_id=$company_id&transdate=$transdate'>";
				}
				
			
				//# 선택한 결제 전표 목록 출력.
				if($TID){
					for($i=0,$amount=0;$i<count($TID);$i++){
    					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID[$i]'";
    					// $result=mysql_db_query($mysql_dbname,$query,$connect);
    					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ) {
    						$rows=mysql_fetch_array($result); 
    					
    						$listform = bodyskin("sales_trans_sell_report_list",$_SESSION['mobile'],$_SESSION['language']);
							
							if($rows[expert]) {
								$listform = str_replace("{TID}","<input 'readonly' type='checkbox' name='TID[]' value='$TID[$i]' >","$listform");
								$expert = "/ (전송된 자료입니다)"; 
								$listform = str_replace("{goodname}","$rows[goodname] $expert","$listform");
							} else {
								$listform = str_replace("{TID}","<input 'readonly' type='checkbox' name='TID[]' value='$TID[$i]' checked>","$listform");
								$expert = "";
								$listform = str_replace("{goodname}","$rows[goodname] $expert","$listform");
							}
							
							
							$listform = str_replace("{num}","$rows[num]","$listform");
							$listform = str_replace("{prices}","$rows[prices]","$listform");
							$listform = str_replace("{sum}","$rows[prices_sum]","$listform");
							$listform = str_replace("{vat}","$rows[vat]","$listform");
							$listform = str_replace("{discount}","$rows[discount]","$listform");
							$listform = str_replace("{total}","$rows[prices_total]","$listform");
							
							$day=substr($rows[transdate],8,2);  						
							// $listform = str_replace("{TID}","$day","$listform");
							

							$prices_sum += $rows[prices_sum];
							$vat_sum += $rows[vat];

							$tot_prices += $rows[prices_total];
							$list .= $listform;
							
        				}		
    				}
    				$body=str_replace("{expertlist}","$list",$body);
    			
				} else {
					$msg = "전송할 전표가 없습니다.";
					$body=str_replace("{expertlist}",$msg,$body);
					echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       						<script> alert(\"$msg\"); </script>";
       				echo "<meta http-equiv='refresh' content='0; url=sales_trans_sell.php?company_id=$company_id&transdate=$transdate'>";		
				}
				
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

