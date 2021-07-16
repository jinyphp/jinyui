<?
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";

		$javascript = "<script>
			function pay_cal(){
				//alert(\"수정\");
				var total_money = 0;
				var moneys_prices = document.getElementsByName('moneys[]');
				var money = document.getElementsByName('money');
            	for(key=0; key < moneys_prices.length; key++)  {        
                	var x = moneys_prices[key].value;
                	total_money += Number(x);
					//alert( total_money );
				}
				document.trans_pay.money.value = total_money;
				
			}

			// 결제버튼
			$('#paynow').on('click',function(){

				var payment = $('input:radio[name=payment]:checked').val();
				var money = $('input:text[name=money]').val();
				if(!payment){
            		alert(\"결제방식을 선택해 주세요\");
            	} else if(money <= 0){
            		alert(\"결제 금액을 입력해 주세요\");
            	} else {
            		alert(\"결제\");
            		popup_close();
            		$.ajax({
            			url:'/ajax_sales_trans_list.php?mode=paynow',
            			type:'post',
            			data:$('form').serialize(),
            			success:function(data){
            				$('#list').html(data);
            				$('#check_all').attr(\"checked\",false);
            			}
        			});
            	}
            	
			});	
        </script>";

        // 팝업창
		$body = $javascript._skin_page($skin_name,"sales_trans_pay");
		$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

		$ajaxkey = _formdata("ajaxkey");
		$trans = _formdata("trans");
		$body = str_replace("{formstart}","<form name='trans_pay' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='trans' value='$trans'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$body = str_replace("{paydate}","<input type='date' name='paydate' value='$TODAY'  style=\"$css_textbox\">",$body);
		
		//# 담당자 처리
		$manager = _formdata("manager"); // 전표 처리, 담당 메니져 정보를 읽어옴ㅁ
		$form_manager = "<select name='payment_manager' style=\"$css_textbox\" >";
		$form_manager .= "<option value=''>관리자</option>";
		$query = "select * from sales_manager where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($manager == $rows1->Id) $form_manager .= "<option value='".$rows1->Id."' selected>".$rows1->lastname."</option>"; 
				else $form_manager .= "<option value='".$rows1->Id."'>".$rows1->lastname."</option>";
			}
		}
		$form_manager .= "</select>";
		$body = str_replace("{manager}",$form_manager,$body);

		/*
		$form_payment = "<select name='payment' style=\"$css_textbox\" >";
		$form_payment .= "<option value='bank'>계좌이체</option>";
		$form_payment .= "<option value='cash'>현금</option>";
		$form_payment .= "<option value='신용카드'>신용카드</option>";
		$form_payment .= "<option value='emoney'>이머니</option>";
		$form_payment .= "</select>";
		*/
		// 매출
		$form_payment  ="<input type=radio name=payment value='bank'> 계좌이체 ";
		$form_payment .="<input type=radio name=payment value='cash'> 현금 ";
		$form_payment .="<input type=radio name=payment value='card'> 신용카드 ";
		$form_payment .="<input type=radio name=payment value='emoney'> 이머니 ";
		$body = str_replace("{payment}",$form_payment ,$body);
		

		// $body = str_replace("{memo}",_form_textarea("pay_memo","memo note","10",$css_textarea),$body);
		//$body = str_replace("{memo}","<input type='text' name='pay_comment' style=\"$css_textbox\">",$body);

		$body = str_replace("{paynow}","<input type=\"button\" value=\"결제\" style=\"".$css_btn_gray."\"/ id=\"paynow\">",$body);


		// 결체 체크 목록
		$TID = $_POST['TID'];
		//# 선택한 결제 전표 목록 출력.
		if($TID){
			$list = "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='background-color:#DEDEDF;border-top:1px solid #D2D2D2;border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
					<tr>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' > 제품명 </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 가격 </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 수량 </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"80\"> 결제금액 </td>
					</tr>
					</table>";

			for($i=0,$amount=0;$i<count($TID);$i++){
    			$query = "select * from `sales_trans` where Id = '$TID[$i]'";
    			if($rows = _sales_query_rows($query)){	
    					
    				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
					<tr>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' > ".$rows->goodname ." </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> ".$rows->prices."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> ".$rows->num."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"80\"> 
						<input type='number' name='moneys[]' value='".$rows->unpaid."' onChange=\"javascript:pay_cal()\" id=\"moneys\" style=\"$css_textbox\">  </td>
					</tr>
					</table>";

					$amount += $rows->unpaid;
					/*
    						$listform = bodyskin("sales_trans_sell_pay_list",$_SESSION['mobile'],$_SESSION['language']);
							
							$listform = str_replace("{goodname}","$rows[goodname]","$listform");
							$listform = str_replace("{num}","$rows[num]","$listform");
							$listform = str_replace("{prices}","$rows[prices]","$listform");
							$listform = str_replace("{sum}","$rows[prices_sum]","$listform");
							$listform = str_replace("{vat}","$rows[vat]","$listform");
							$listform = str_replace("{discount}","$rows[discount]","$listform");
							$listform = str_replace("{total}","$rows[prices_total]","$listform");
							

    						if($rows[pay]){   						
								// $listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$TID[$i]'>","$listform");
								$listform = str_replace("{TID}","출금","$listform");	
							} else {
								$listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$TID[$i]' checked onChange=\"javascript:submit()\">","$listform");
								$amount += $rows[prices_total];
							}
							
							$list .= $listform;
							*/
							
        		}		
    		}

    		$body = str_replace("{list}", $list, $body);
    		$body = str_replace("{money}","<input type='text' name='money' value='$amount' style=\"$css_textbox\">",$body);
    		$body = str_replace("{memo}","<input type='text' name='pay_memo' style=\"$css_textbox\">",$body);
    				
		} 

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}

	/*
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
    					$query = "UPDATE `sales_trans_$MEM[Id]` SET `payment`='$payment', `paydate`='$transdate', `paymoney`='$amount' WHERE `Id`='$TID[$i]'";
        				// mysql_db_query($mysql_dbname,$query,$connect);
        				mysql_db_query($server[dbname],$query,$dbconnect);
        				//echo $query."<br>";
					}
					
					$COMB = $company_id;
					$query = "INSERT INTO `sales_trans_$MEM[Id]` (`regdate`, `transdate`, `memid`, `trans`,  `UIDA`, `UIDB`, `payment`, `paydate`, `paymoney`, `paymemo`, `auth`) 
											VALUES ('$TODAYTIME', '".$_POST['transdate']."', '$MEM[Id]', 'sell_payin',  '$COMA', '$COMB', '$payment', '$transdate', '$amount', '$paymemo', 'on')";
					// mysql_db_query($mysql_dbname,$query,$connect);
					mysql_db_query($server[dbname],$query,$dbconnect);
					
					//# 업체 미수금 : balance1 매출
    				$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
					// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    				if( mysql_num_rows($result1) ) {
    					$rows1 = mysql_fetch_array($result1);
    					$balance1 = $rows1[balance1] - $amount;
    					
						$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance1`= '$balance1' WHERE `Id`='$company_id'";
						// echo $query1."<br>";
						// mysql_db_query($mysql_dbname,$query1,$connect);
						mysql_db_query($server[dbname],$query1,$dbconnect);
					}

					
					
				} 
				
				// echo "<script> history.go(-3); </script>";
				echo "<meta http-equiv='refresh' content='0; url=sales_trans_sell.php?company_id=$company_id&transdate=$transdate'>";
				
			} else {
			
			
			//////////////////////
			
			
				
				
				
				
				$body = shopskin("sales_trans_sell_pay");
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
    			$body = str_replace("{submit}","$script <input type='button' value='입금저장' $butten_style onclick=\"javascript:trans_payin()\">",$body);	
				
			
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
    				$body = str_replace("{search}","$script <input type='button' value='거래처 검색' $butten_style onclick=\"javascript:trans_companysearch()\">",$body);	
					
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
							$listform = bodyskin("sales_trans_sell_search",$_SESSION['mobile'],$_SESSION['language']);
							// $listform = str_replace("{goodname}","<a href='".$_SERVER['PHP_SELF']."?company_id=$rows[Id]&nonce=$nonce'>$rows[company]</a>","$listform");
							$com_id = $rows[Id];
							$listform = str_replace("{goodname}","<a href='#' onclick=\"choose_company($com_id)\">$rows[company]</a>","$listform");
							$companylist .= $listform;
						}
					}
					$companylist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
					$body = str_replace("{company_list}",$companylist,$body);
	
				} else $body = str_replace("{company_list}","",$body);
			
			
				$body=str_replace("{manager}","<input type='text' name='manager' value='$manager' $CSS placeholder='담당자'>",$body);
			
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
	*/


?>

