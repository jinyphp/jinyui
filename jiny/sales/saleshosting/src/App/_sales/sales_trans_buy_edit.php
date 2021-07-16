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
	
	
	
	$CSS = "style='height:30px;;width:100%;margin:-3px;border:2px;background-color:#f2f2f2'";
	
	
	
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
			$TID = $_POST['TID']; if(!$TID) $TID = $_GET['TID'];
			
			$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID'";
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
			if(  mysql_num_rows($result)  ){ 
				$rows=mysql_fetch_array($result);
	
				switch($mode){
					case 'editup':
						
						$spec = $_POST['spec'];
						$num = $_POST['num'];
						
						$prices = $_POST['prices'];
						$vat = $_POST['vat'];
						$discount = $_POST['discount'];
						$prices_sum = $_POST['sum'];
						$prices_total = $_POST['total'];
						
						//# 업체 미수금 
    					$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$rows[UIDB]'";
						// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ) {
    						$rows1 = mysql_fetch_array($result1);
    						$balance2 = $rows1[balance2] + $rows[prices_total] - $prices_total;
							$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance2`= '$balance2' WHERE `Id`='$rows[UIDB]'";
							// echo $query1."<br>";
							// mysql_db_query($mysql_dbname,$query1,$connect);
							mysql_db_query($server[dbname],$query1,$dbconnect);
						}

						//상품 재고수량 조정
						if($rows[goods]){
							$query = "select * from `sales_goods_$MEM[Id]` where Id = '$rows[goods]'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ) {
    							$rows1=mysql_fetch_array($result);
    							
    							$stock = $rows1[stock] - $rows[num] + $num;
								$query = "UPDATE `sales_goods_$MEM[Id]` SET `stock`= '$stock' WHERE `Id`='$rows[goods]'";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
							}
						}
						
						
						//# 지점창고 : 재고 조정
						if($rows[warehouse]){
							$query = "select * from `sales_goodstock_$MEM[Id]` where warehouse = '$rows[warehouse]' and GID = '$rows[goods]'";
							//echo $query."<br>";
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ) {
    							$rows1=mysql_fetch_array($result);
    								
    							
    							$stock = $rows1[stock] - $rows[num] + $num;
								$query = "UPDATE `sales_goodstock_$MEM[Id]` SET `stock`= '$stock' WHERE warehouse = '$rows[warehouse]' and GID = '$rows[goods]'";
								//echo $query."<br>";
								mysql_db_query($server[dbname],$query,$dbconnect);
    								
    						}
    							
						}

						
				
						$query = "UPDATE `sales_trans_$MEM[Id]` SET `spec`='$spec', `num`='$num', `prices`='$prices',
									`discount`='$discount', `vat`='$vat', `prices_sum`='$prices_sum', `prices_total`='$prices_total' WHERE `Id`='$TID'";
        				// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
					
						echo "<meta http-equiv='refresh' content='0; url=sales_trans_buy.php?company_id=$rows[UIDB]&transdate=$rows[transdate]'>";

						break;
					default:
					
						if($rows[pay]){
							$msg = "입금처리된 거래는 수정을 할 수 없습니다. 입금내역을 삭제후 수정가능합니다.";
							msg_alert($msg);
						} else {
			
							$body = shopskin("sales_trans_buy_edit");

							/////////////////////////////////
			
							$query = "select * from `sales_company_$MEM[Id]` where Id = '$rows[UIDB]'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ){
    							$coms=mysql_fetch_array($result);
    							$body = str_replace("{company}","$coms[company]",$body);
							}
							if($coms[vat]) $vat = $coms[vatrate];
			
			
			
							$body = str_replace("{formstart}","<form name='trans' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						<input type='hidden' name='TID' value='$TID'>
					    						<input type='hidden' name='mode' value='editup'>",$body);
							$body = str_replace("{formend}","</form>",$body);

							$body = str_replace("{submit}","<input type='submit' value='수정' $btn_style_blue>",$body);
			
							$listform = "<script>
       						function trans_sum(vat){
 								document.trans.sum.value = document.trans.num.value * document.trans.prices.value;
 					
 								if(vat) document.trans.vat.value = document.trans.sum.value / 100 * vat;
 					
 								document.trans.total.value = Number(document.trans.sum.value) - Number(document.trans.discount.value) + Number(document.trans.vat.value);
 							}
    						</script>"; 
    						$body = str_replace("{script}",$listform,"$body");
    		
							$body = str_replace("{transdate}","$rows[transdate]","$body");
							$body = str_replace("{goodname}","$rows[goodname]","$body");
				
							$body = str_replace("{spec}","<input type='text' name='spec' value='$rows[spec]' $CSS>","$body");
							$body = str_replace("{num}","<input type='text' name='num' value='$rows[num]' $CSS onChange=\"javascript:trans_sum($vat)\">","$body");
							$body = str_replace("{prices}","<input type='text' name='prices' value='$rows[prices]' $CSS onChange=\"javascript:trans_sum($vat)\">","$body");
							$body = str_replace("{sum}","<input type='text' name='sum' value='$rows[prices_sum]' $CSS onChange=\"javascript:trans_sum($vat)\">","$body");
							$body = str_replace("{vat}","<input type='text' name='vat' value='$rows[vat]' $CSS onChange=\"javascript:trans_sum($vat)\">","$body");
							$body = str_replace("{discount}","<input type='text' name='discount' value='$rows[discount]' $CSS onChange=\"javascript:trans_sum($vat)\">","$body");
							$body = str_replace("{total}","<input type='text' name='total' value='$rows[prices_total]' $CSS onChange=\"javascript:submit($vat)\">","$body");
						}
						break;
			
				}
			
			//////////////////////////////////////////////////////////////////		
			}
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);
?>

