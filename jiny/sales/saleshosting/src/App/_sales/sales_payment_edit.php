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
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
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
			$company_id = $_POST['company_id']; if(!$company_id) $company_id = $_GET['company_id'];
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    		$TID = $_GET['TID']; if(!$TID) $TID = $_POST['TID'];
			
			
			
			switch($mode){
				case 'del':
				
					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ){ 
		    			$rows=mysql_fetch_array($result);
				
						//# 업체 미수금 
    					$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$rows[UIDB]'";
						// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ) {
    						$rows1 = mysql_fetch_array($result1);
    						
    						if($rows[trans] == "sell_payin"){
    							$balance1 = $rows1[balance1] + $rows[paymoney]; // 삭제한 금액많큼 미수금 증가.
								$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance1`= '$balance1' WHERE `Id`='$rows[UIDB]'";
								// echo $query1."<br>";
								// mysql_db_query($mysql_dbname,$query1,$connect);
								mysql_db_query($server[dbname],$query1,$dbconnect);
							} else if($rows[trans] == "buy_payin"){
								$balance2 = $rows1[balance2] + $rows[paymoney]; // 삭제한 금액많큼 미수금 증가.
								$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance2`= '$balance2' WHERE `Id`='$rows[UIDB]'";
								// echo $query1."<br>";
								// mysql_db_query($mysql_dbname,$query1,$connect);
								mysql_db_query($server[dbname],$query1,$dbconnect);
							}
						}

						$query = "DELETE FROM `sales_trans_$MEM[Id]` WHERE `Id`='$TID'";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					$query = "UPDATE `sales_trans_$MEM[Id]` SET `pay`= '',`paydate`= '',`paymoney`= '',`payment`= '',`paymemo`= '' WHERE `pay`='$rows[pay]'";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					//echo "<script> history.go(-2); </script>";
    					echo "<meta http-equiv='refresh' content='0; url=sales_payment.php?company_id=$company_id'>";
    				}
					break;
				case 'editup':
					$paymoney = $_POST['paymoney'];
					$transdate = $_POST['transdate'];
					$payment = $_POST['payment'];
					$paymemo = $_POST['paymemo'];
					$paymode = $_POST['paymode'];
				
					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ){ 
		    			$rows=mysql_fetch_array($result);
				
						//# 업체 미수금 
    					$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$rows[UIDB]'";
						// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ) {
    						$rows1 = mysql_fetch_array($result1);
    						
    						if($rows[trans] == 'sell_payin'){
    							$balance1 = $rows1[balance1] + $rows[paymoney]- $paymoney; // 
								$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance1`= '$balance1' WHERE `Id`='$rows[UIDB]'";
								// mysql_db_query($mysql_dbname,$query1,$connect);
								mysql_db_query($server[dbname],$query1,$dbconnect);
								
								$query="UPDATE `sales_trans_$MEM[Id]` SET `paymoney`='$paymoney',`payment`='$payment',`transdate`='$transdate'  WHERE `Id`='$TID'";
    							// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
								
							} else if($rows[trans] == 'buy_payin'){
    							$balance2 = $rows1[balance2] + $rows[paymoney]- $paymoney; // 
								$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance2`= '$balance2' WHERE `Id`='$rows[UIDB]'";
								// mysql_db_query($mysql_dbname,$query1,$connect);
								mysql_db_query($server[dbname],$query1,$dbconnect);
							
								$query="UPDATE `sales_trans_$MEM[Id]` SET `paymoney`='$paymoney',`payment`='$payment',`transdate`='$transdate'  WHERE `Id`='$TID'";
    							// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
							}
							
							
							
						}
						
						
						
    					echo "<script> history.go(-2); </script>";	
    				}
				
				
					break;	
				case 'edit':
					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ){ 
		    			$rows=mysql_fetch_array($result);
		    			
						$body = shopskin("sales_payment_edit");
					
						$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_payment_edit.php'> 
										<input type='hidden' name='TID' value='$TID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);
					
						$body = str_replace("{transdate}","<input type='date' name='transdate'  value='$rows[transdate]' $cssFormStyle placeholder='지급일자'>",$body);
						
						if($rows[trans] == "sell_payin")
							$body = str_replace("{paymode}","입금 <input type=radio name='paymode' value=1 checked='checked'> 출금 <input type=radio name='paymode' value=2>",$body);
						else 
							$body = str_replace("{paymode}","입금 <input type=radio name='paymode' value=1> 출금 <input type=radio name='paymode' value=2 checked='checked'>",$body);
					
						
						
						$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$rows[UIDB]'";
						// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ){
    						$rows1=mysql_fetch_array($result1);
    						$body = str_replace("{company}","<input type='text' readonly name='company' value='$rows1[company]' $cssFormStyle placeholder='거래처명'>",$body);
    					} else $body = str_replace("{company}","",$body);
    				
    				
    					$FORM_payment = "<select size='1' name='payment' $cssFormStyle>";
		    			if($rows[payment] == "은행송금") $FORM_payment .= "<option value='은행송금' checked='checked'>은행송금</option>"; else $FORM_payment .= "<option value='은행송금'>은행송금</option>";
		    			if($rows[payment] == "현금결제") $FORM_payment .= "<option value='현금결제' checked='checked'>현금결제</option>"; else $FORM_payment .= "<option value='현금결제'>현금결제</option>";
		    			if($rows[payment] == "신용카드") $FORM_payment .= "<option value='신용카드' checked='checked'>신용카드</option>"; else $FORM_payment .= "<option value='신용카드'>신용카드</option>";
		    			$FORM_payment .= "</select>";
		    			$body=str_replace("{payment}","$FORM_payment",$body);		
						// $body = str_replace("{payment}","<input type='text' name='payment'  value='$rows[payment]' $cssFormStyle placeholder='지급방법'>",$body);
						
						$body = str_replace("{paymoney}","<input type='text' name='paymoney'  value='$rows[paymoney]' $cssFormStyle placeholder='지급금액'>",$body);
						$body = str_replace("{memo}","<textarea name='memo' rows='8' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='메모'>$rows[paymemo]</textarea>",$body);
						
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $butten_style>",$body);
										
						$body = str_replace("{delete}",skin_button("삭제","sales_payment_edit.php?mode=del&TID=$TID"),$body); 
						
						$body = str_replace("{list}",_button_blue("목록","sales_payment.php"),$body); 
					}	
					break;
					
				case 'newup':
					$company_id = $_POST['company_id'];
					$paymoney = $_POST['paymoney'];
					$transdate = $_POST['transdate'];
					$payment = $_POST['payment'];
					$paymemo = $_POST['paymemo'];
					$paymode = $_POST['paymode'];
					$company_id = $_POST['company_id'];
					
					if($_SESSION['nonce'] == $_POST['nonce']){
						$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
						if(!$company_id) msg_alert("거래처가 없습니다.");
						else if(!$paymoney) msg_alert("결제 금액이 없습니다.");
						else if(!$transdate) msg_alert("결제 일자가 없습니다.");
						else {
							
							if($paymode == "1"){
							// 입금결제
								$COMB = $company_id;
								$query = "INSERT INTO `sales_trans_$MEM[Id]` (`regdate`, `transdate`, `memid`, `trans`,  `UIDA`, `UIDB`, `payment`, `paydate`, `paymoney`) 
											VALUES ('$TODAYTIME', '$transdate', '$MEM[Id]', 'sell_payin',  '$COMA', '$COMB', '$payment', '$transdate', '$paymoney')";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
					
								//# 업체 미수금 
    							$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
								// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
								$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    							if( mysql_num_rows($result1) ) {
    								$rows1 = mysql_fetch_array($result1);
    								$balance1 = $rows1[balance1] - $paymoney;
									$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance1`= '$balance1' WHERE `Id`='$company_id'";
									// echo $query1."<br>";
									// mysql_db_query($mysql_dbname,$query1,$connect);
									mysql_db_query($server[dbname],$query1,$dbconnect);
								}

							} else {
							// 출금 결제
								$COMB = $company_id;
								$query = "INSERT INTO `sales_trans_$MEM[Id]` (`regdate`, `transdate`, `memid`, `trans`,  `UIDA`, `UIDB`, `payment`, `paydate`, `paymoney`) 
											VALUES ('$TODAYTIME', '$transdate', '$MEM[Id]', 'buy_payin',  '$COMA', '$COMB', '$payment', '$transdate', '$paymoney')";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
					
								//# 업체 미수금 
    							$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
								// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
								$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    							if( mysql_num_rows($result1) ) {
    								$rows1 = mysql_fetch_array($result1);
    								$balance2 = $rows1[balance2] - $paymoney;
									$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance2`= '$balance2' WHERE `Id`='$company_id'";
									// echo $query1."<br>";
									// mysql_db_query($mysql_dbname,$query1,$connect);
									mysql_db_query($server[dbname],$query1,$dbconnect);
								}							
							
							
							}
					
						} 
				
						echo "<script> history.go(-2); </script>";
					
				
					}
			
					
					break;	
				default:
				
					$company_id = $_POST['company_id']; if(!$company_id) $company_id = $_GET['company_id'];
					
					$body = shopskin("sales_payment_edit");
					$body = str_replace("{list}",_button_blue("목록","sales_payment.php"),$body); 
					
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
					$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_payment_edit.php'> 
										<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
					
					if($_GET['paymode'] == "1")
						$body = str_replace("{paymode}","입금 <input type=radio name='paymode' value=1 checked='checked'> 출금 <input type=radio name='paymode' value=2>",$body);
					else 
						$body = str_replace("{paymode}","입금 <input type=radio name='paymode' value=1> 출금 <input type=radio name='paymode' value=2 checked='checked'>",$body);
					
					
					
					
					$body = str_replace("{transdate}","<input type='date' name='transdate'  value='$rows[transdate]' $cssFormStyle placeholder='지급일자'>",$body);
						
					
    					
    					
    					$query1 = "select * from sales_company_$MEM[Id] ";
    					// $result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
						$result1=mysql_db_query($server[dbname],str_replace("*","count(*)",$query1),$dbconnect);
    					$total1=mysql_result($result1,0,0);	
    					// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
						$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
						if( mysql_num_rows($result1) ) {
							$company = "<select name='company_id' $cssFormStyle >";
							$company .= "<option value=''>거래처선택</option>";
							for($ii=0;$ii<$total1;$ii++){
								$rows1=mysql_fetch_array($result1);
								$company .= "<option value='$rows1[Id]'>$rows1[company]</option>";
							}
							$body = str_replace("{company}","$company ",$body);
						}
    					
    					
    				
					
					$FORM_payment = "<select size='1' name='payment' $cssFormStyle>";
		    		if($rows[payment] == "은행송금") $FORM_payment .= "<option value='은행송금' checked='checked'>은행송금</option>"; else $FORM_payment .= "<option value='은행송금'>은행송금</option>";
		    		if($rows[payment] == "현금결제") $FORM_payment .= "<option value='현금결제' checked='checked'>현금결제</option>"; else $FORM_payment .= "<option value='현금결제'>현금결제</option>";
		    		if($rows[payment] == "신용카드") $FORM_payment .= "<option value='신용카드' checked='checked'>신용카드</option>"; else $FORM_payment .= "<option value='신용카드'>신용카드</option>";
		    		$FORM_payment .= "</select>";
		    		$body=str_replace("{payment}","$FORM_payment",$body);		
					// $body = str_replace("{payment}","<input type='text' name='payment'  value='$rows[payment]' $cssFormStyle placeholder='지급방법'>",$body);	
					// $body = str_replace("{payment}","<input type='text' name='payment'  value='$rows[payment]' $cssFormStyle placeholder='지급방법'>",$body);
					$body = str_replace("{paymoney}","<input type='text' name='paymoney' value='$rows[paymoney]' $cssFormStyle placeholder='지급금액'>",$body);
					
					$body = str_replace("{memo}","<textarea name='memo' rows='8' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='메모'></textarea>",$body);
		
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='등록' $butten_style>",$body);
					$body = str_replace("{delete}","",$body); 
				
				
				
			
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

