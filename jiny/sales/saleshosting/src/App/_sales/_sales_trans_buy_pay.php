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
			
			if(!$company_id) msg_alert("선택된 거래처가 없습니다.");
			
			$CSS = "style='height:30px;;width:100%;margin:-3px;border:2px;border:1px solid #D2D2D2;'";
			
			if($mode == "payup" && $_SESSION['nonce'] == $_POST['nonce']){
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$transdate = $_POST['transdate'];
				$amount = $_POST['amount'];
				$TID = $_POST['TID'];
				$company_id = $_POST['company_id'];
				$paymemo = $_POST['paymemo'];
				
				if(!$company_id) msg_alert_none("거래처가 없습니다.");
				else if(!$amount) msg_alert_none("결제 금액이 없습니다.");
				else {
					for($i=0;$i<count($TID);$i++){
    					$query = "UPDATE `sales_trans_$MEM[Id]` SET `pay`='$nonce', `payment`='$payment', `paydate`='$transdate', `paymoney`='$amount' WHERE `Id`='$TID[$i]'";
        				// mysql_db_query($mysql_dbname,$query,$connect);
        				mysql_db_query($server[dbname],$query,$dbconnect);
        				// echo $query."<br>";
					}
					
					if(count($TID)>0){
						$COMB = $company_id;
						$query = "INSERT INTO `sales_trans_$MEM[Id]` (`regdate`, `transdate`, `memid`, `trans`,  `UIDA`, `UIDB`, `pay`, `payment`, `paydate`, `paymoney`, `paymemo`, `auth`) 
											VALUES ('$TODAYTIME', '".$_POST['transdate']."', '$MEM[Id]', 'buy_payin',  '$COMA', '$COMB', '$nonce', '$payment', '$transdate', '$amount', '$paymemo', 'on')";
						// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
					
						//# 업체 미수금 : balance2 매입
    					$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
						// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ) {
    						$rows1 = mysql_fetch_array($result1);
    						$balance2 = $rows1[balance2] - $amount;
							$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance2`= '$balance2' WHERE `Id`='$company_id'";
							// mysql_db_query($mysql_dbname,$query1,$connect);
							mysql_db_query($server[dbname],$query1,$dbconnect);
						}

					}
					
				} 
				
				// echo "<script> history.go(-3); </script>";
				echo "<meta http-equiv='refresh' content='0; url=sales_trans_buy.php?company_id=$company_id&transdate=$transdate'>";
				
			} else {
			
			
			//////////////////////
			
				
				$TID = $_POST['TID'];
				//# 선택한 결제 전표 목록 출력.
				if($TID){
					$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
					for($i=0,$amount=0;$i<count($TID);$i++){
    					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID[$i]'";
    					// $result=mysql_db_query($mysql_dbname,$query,$connect);
    					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ) {
    						$rows=mysql_fetch_array($result); 
    					
    						$listform = bodyskin("sales_trans_payment_in_list",$_SESSION['mobile'],$_SESSION['language']);
							
							$listform = str_replace("{goodname}","$rows[goodname]","$listform");
							$listform = str_replace("{num}","$rows[num]","$listform");
							$listform = str_replace("{prices}","$rows[prices]","$listform");
							$listform = str_replace("{sum}","$rows[prices_sum]","$listform");
							$listform = str_replace("{vat}","$rows[vat]","$listform");
							$listform = str_replace("{discount}","$rows[discount]","$listform");
							$listform = str_replace("{total}","$rows[prices_total]","$listform");
							

    						if($rows[pay]){				
								// $listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$TID[$i]' readonly>","$listform");
								$listform = str_replace("{TID}","입금","$listform");
							} else {
								$listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$TID[$i]' checked onChange=\"javascript:submit()\">","$listform");
								$amount += $rows[prices_total];
							}
							
							$list .= $listform;
							
        				}		
    				}
    				
				} 
				
				$body = shopskin("sales_trans_buy_pay");
				$body=str_replace("{paylist}","$list",$body);
				
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 	
				$body = str_replace("{formstart}","<form name='payment' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='nonce' value='$nonce'>
					    						 <input type='hidden' name='company_id' value='$company_id'>
					    						 <input type='hidden' name='mode' value=''>",$body);
				$body = str_replace("{formend}","</form>",$body);
			
				//# 입금 확인 버튼 클릭, 모드를 payup 으로 변경후, 처리...
				$script = "<script>
       				function trans_payin(){
 						document.payment.mode.value = \"payup\";
 						document.payment.submit();
 					}
    				</script>"; 
    			$body = str_replace("{submit}","$script <input type='button' value='출금저장' $btn_style_blue onclick=\"javascript:trans_payin()\">",$body);	
				
			
				if($_GET['transdate']) $body=str_replace("{transdate}","<input type='date' name='transdate' value='$transdate' $CSS>",$body);
				else $body=str_replace("{transdate}","<input type='date' name='transdate' value='$TODAY' $CSS>",$body);
			
			
				//# 거래처 지정
				if($company_id){
					$query = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
					// $result=mysql_db_query($mysql_dbname,$query,$connect);
					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ){ 				
	    				$rows=mysql_fetch_array($result);
						$body=str_replace("{company}","$rows[company]",$body);
						$body = str_replace("{search}","",$body);
					}
				} else {
					$body = str_replace("{company}","<input type='text' name='company' $CSS placeholder='거래�?>",$body);
					$script = "<script>
       				function trans_companysearch(){
 						document.payment.mode.value = \"\";
 						document.payment.submit();
 					}
    				</script>"; 
    				$body = str_replace("{search}","$script <input type='button' value='거래처 검색' $btn_style_gray onclick=\"javascript:trans_companysearch()\">",$body);	
				}
			
				if($_POST['company']){
					$query = "select * from `sales_company_$MEM[Id]` where company like '%".$_POST['company']."%'";
					// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
					$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    				$total = mysql_result($result,0,0);
    			
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ){ 
						$script = "<script>
       						function choose_company(com_id){
 								document.payment.company_id.value = com_id;
 								document.payment.submit();
 							}
    						</script>";     			
						$companylist .= $script;
						for($i=0;$i<$total;$i++){
	    					$rows=mysql_fetch_array($result);
							$listform = bodyskin("sales_trans_buy_search",$_SESSION['mobile'],$_SESSION['language']);
							// $listform = str_replace("{goodname}","<a href='".$_SERVER['PHP_SELF']."?company_id=$rows[Id]&nonce=$nonce'>$rows[company]</a>","$listform");
							$com_id = $rows[Id];
							$listform = str_replace("{goodname}","<a href='#' onclick=\"choose_company($com_id)\">$rows[company]</a>","$listform");
							$companylist .= $listform;
						}
					}
					$companylist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
					$body = str_replace("{company_list}",$companylist,$body);
	
				} else $body = str_replace("{company_list}","",$body);
			
			
				$body=str_replace("{manager}","<input type='text' name='manager' $CSS placeholder='담당자'>",$body);
			
				$body=str_replace("{paymoney}","<input type='text' name='amount' value='$amount' $CSS placeholder='입금액'>",$body);
    			$body=str_replace("{paymemo}","<input type='text' name='paymemo' value='' $CSS placeholder='메모'>",$body);
    			
				$FORM_payment = "<select size='1' name='payment' $CSS>
		    						 <option value='은행송금'>은행송금</option>
		    				  		 <option value='현금결제'>현금결제</option>
		    				  		 <option value='신용카드'>신용카드</option>
		    				  		 </select>";
		    	$body=str_replace("{payment}","$FORM_payment",$body);	
		    		  		 
		
			}
		
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역 스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);	


?>

