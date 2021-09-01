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
	
	
	
	$CSS_search = "style='height:30px;;width:100%;margin:-3px;border:2px;border:1px solid #D2D2D2;'";
	
	function _form_newdata($tid,$transdate,$goods,$goodname,$spec,$num,$prices,$sum,$vat,$discount,$total){
				
		$CSS = "style='height:30px;;width:100%;margin:-3px;border:2px;background-color:#f2f2f2'";
		
		$listform = bodyskin("sales_trans_buy_list",$_SESSION['mobile'],$_SESSION['language']);
		
		$company_id = $_POST['company_id']; if(!$company_id) $company_id = $_GET['company_id'];
		$transdate = $_POST['transdate']; if(!$transdate) $transdate = $_GET['transdate'];
		
		$barcodeMode = "trans_buy"; 
		$url_return = "sales_trans_buy.php?company_id=$company_id&transdate=$transdate&";
		$listform = str_replace("{TID}","<butten onclick='showBarcode(\"$barcodeMode \",\" $url_return\")'><img src='./images/barcode.gif' width=30 border=0></butten>",$listform);
		
				
		$day=substr($transdate,8,2);
		$listform = str_replace("{day}","<input type='text' name='day' value='$day' $CSS>","$listform");
			
		if($goodname) 
		$listform = str_replace("{goodname}","<input type='hidden' name='goods' value='$goods'><input type='text' name='goodname' value='$goodname' autofocus $CSS onChange=\"javascript:submit()\">","$listform");	
		else $listform = str_replace("{goodname}","<input type='hidden' name='goods' value='$goods'><input type='text' name='goodname' placeholder='상품명' autofocus $CSS onChange=\"javascript:submit()\">","$listform");
		
		if($spec) 	
		$listform = str_replace("{spec}","<input type='text' name='spec' value='$spec' $CSS>",$listform );
		else $listform = str_replace("{spec}","<input type='text' name='spec' placeholder='규격' $CSS>",$listform );
		
		

		$listform .= "<script>
       			function trans_sum(vat){
 					document.trans.sum.value = document.trans.num.value * document.trans.prices.value;
 					
 					if(vat) document.trans.vat.value = document.trans.sum.value / 100 * vat;
 					
 					document.trans.total.value = Number(document.trans.sum.value) - Number(document.trans.discount.value) + Number(document.trans.vat.value);
 				}
    		</script>"; 
		
		if($num)
		$listform = str_replace("{num}","<input type='text' name='num' value='$num' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{num}","<input type='text' name='num' placeholder='수량' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($prices)
		$listform = str_replace("{prices}","<input type='text' name='prices' value='$prices' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{prices}","<input type='text' name='prices' placeholder='단가' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($sum)
		$listform = str_replace("{sum}","<input type='text' name='sum' value='$sum' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{sum}","<input type='text' name='sum' placeholder='공급액' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($vat)
		$listform = str_replace("{vat}","<input type='text' name='vat' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{vat}","<input type='text' name='vat' placeholder='부가세' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($discount)
		$listform = str_replace("{discount}","<input type='text' name='discount' value='$discount' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{discount}","<input type='text' name='discount' placeholder='할인액' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($total)
		$listform = str_replace("{total}","<input type='text' name='total' value='$total' $CSS onChange=\"javascript:submit($vat)\">",$listform );
		else $listform = str_replace("{total}","<input type='text' name='total' placeholder='합계' $CSS onChange=\"javascript:submit($vat)\">",$listform );
		
		return $listform; 
	}
	
	
	
	//************************************
	//************************************
	
	
	
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
			$warehouse = $_POST['warehouse']; if(!$warehouse) $warehouse = $_GET['warehouse'];
			$manager = $_POST['manager']; if(!$manager) $manager = $_GET['manager'];
				
			$body = shopskin("sales_trans_buy"); // 템플릿 스킨을 읽어 옵니다.


			//# 거래처 화면 및 검색처리..
			$query = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
			// $result=mysql_db_query($mysql_dbname,$query,$connect);
			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){
    			$coms=mysql_fetch_array($result);
				$balance2 = $coms[balance2];
				$body = str_replace("{company}","$coms[company]",$body);
				$body = str_replace("{company_search}","<input type='text' name='company_search' value='$coms[company]' $CSS_search onChange=\"javascript:submit()\">",$body);
			} else {
				$body = str_replace("{company}","",$body);
				$body = str_replace("{company_search}","<input type='text' name='company_search' placeholder='거래처명 검색' $CSS_search onChange=\"javascript:submit()\">",$body);
			}
			

			// 상단 버튼 처리
		
			$script = "<script>
       			function trans_chkall(){
       				var submit = false;
       				var chk = document.getElementsByName('TID[]');
       				
       				for(var i=0;i<chk.length;i++){
       					if(document.trans.chk_all.checked == true) chk[i].checked = true;
       					else chk[i].checked = false;
       				}
 				}
    			</script>"; 
			$body = str_replace("{all}","$script <input type='checkbox' name='chk_all' onclick=\"javascript:trans_chkall()\">",$body);
		
		
			$script = "<script>
       			function trans_expert(mem){
       				var submit = false;
       				var chk = document.getElementsByName('TID[]');
       				var expert = document.getElementsByName('expert[]');
       				var chk_count = 0;
       				
       				if(!mem) {
       					alert(\"회원 거래처만 전표 전송이 가능합니다.\");
       					return;
       				}
       				
       				for(var i=0;i<chk.length;i++){
       					if(chk[i].checked) {
       						chk_count++;
       						if(expert[i].value) {
       							alert(\"이미 전송된 자료입니다.\");
       							return;
       						}
       					}
       				}
       				
					if(chk.length > 0){
						if(chk_count > 0){
 							document.trans.action = \"sales_trans_buy_expert.php\";
 							document.trans.submit();
 						} else alert(\"선택된 거래내역이 없습니다.\");
 					} else alert(\"기입된 거래전표 리스트가 없습니다.\");

 				}
    			</script>"; 
    		$body = str_replace("{new}","$script <input type='button' value='전표전송' $btn_style_gray onclick=\"javascript:trans_expert($coms[mem])\">",$body);	
		
		
		
		
			$script = "<script>
       			function trans_print(){
       				var submit = false;
       				var ilen = document.querySelectorAll('input[type=\"checkbox\"]:checked').length;
       				
					if(ilen>0){
 						document.trans.action = \"sales_trans_buy_report.php\";
 						document.trans.submit();
 					} else alert(\"선택된 거래내역이 없습니다.\");
 				}
    			</script>"; 
    		$body = str_replace("{print}","$script <input type='button' value='명세서' $btn_style_gray onclick=\"javascript:trans_print()\">",$body);	
			// $body = str_replace("{print}",skin_button("명세서","sales_trans_buy_report.php"),$body);
		
			$script = "<script>
       			function trans_del(){
       				var submit = false;
       				var chk = document.getElementsByName('TID[]');
       				var chk_count = 0;
       				
       				for(var i=0;i<chk.length;i++){
       					if(chk[i].checked) chk_count++;
       				}
       				
					if(chk.length > 0){
						if(chk_count > 0){
							var returnValue = confirm(\"선택한 거래를 삭제하겠습니까?\");
							if(returnValue == true){
 								document.trans.mode.value = \"delete\";
 								document.trans.submit();
 							}
 						} else alert(\"선택된 거래내역이 없습니다.\");
 					} else alert(\"기입된 거래전표 리스트가 없습니다.\");
 				}
    			</script>"; 
			$body = str_replace("{delete}","$script <input type='button' value='삭제' $btn_style_gray onclick=\"javascript:trans_del()\">",$body);
		
		
			$script = "<script>
       			function trans_payin(){
       				var submit = false;
       				var chk = document.getElementsByName('TID[]');
       				var pay = document.getElementsByName('pay[]');
       				var chk_count = 0;
       				
       				for(var i=0;i<chk.length;i++){
       					if(chk[i].checked) {
       						chk_count++;
       						if(pay[i].value) {
       							alert(\"출금된 전표는 선택할 수 없습니다.\");
       							return;
       						}
       					}
       				}
       				
					if(chk.length > 0){
						if(chk_count > 0){
 							document.trans.action = \"sales_trans_buy_pay.php\";
 							document.trans.submit();
 						} else alert(\"선택된 거래내역이 없습니다.\");
 					} else alert(\"기입된 거래전표 리스트가 없습니다.\");
 					
 				}
    			</script>"; 
    		$body = str_replace("{bank}","$script <input type='button' value='출금확인' $btn_style_gray onclick=\"javascript:trans_payin()\">",$body);		
		
			////////////////////////////////////////
			//# 창고리스트  처리
			$query1 = "select * from sales_warehouse_$MEM[Id] ";
			$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
			if( $total1=mysql_num_rows($result1) ) {
				$form_warehouse = "<select name='warehouse' $cssFormStyle onChange=\"javascript:submit()\">";
				for($ii=0;$ii<$total1;$ii++){
					$rows1=mysql_fetch_array($result1);
					if($warehouse == $rows1[Id]) $form_warehouse .= "<option value='$rows1[Id]' selected>$rows1[housename]</option>"; 
					else $form_warehouse .= "<option value='$rows1[Id]'>$rows1[housename]</option>";
				}
				$body = str_replace("{warehouse}","$form_warehouse",$body);
			} else $body = str_replace("{warehouse}","",$body);
			
			//////
			
			////////////////////////////////////////
			//# 담당자 목록
			$query1 = "SELECT * FROM `sales_manager` where members_id = '$MEM[Id]'";	
			$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
			if( $total1=mysql_num_rows($result1) ) {
				$form_manager = "<select name='manager' $cssFormStyle onChange=\"javascript:submit()\">";
				for($ii=0;$ii<$total1;$ii++){
					$rows1=mysql_fetch_array($result1);
					if($manager == $rows1[Id]) $form_manager .= "<option value='$rows1[Id]' selected>$rows1[name]</option>"; 
					else $form_manager .= "<option value='$rows1[Id]'>$rows1[name]</option>";
				}
				$body = str_replace("{manager}","$form_manager",$body);
			} else $body = str_replace("{manager}","",$body);
			
			
			
			
			
			//# 선택 전표 삭제
			if($mode == "delete"){
				$TID = $_POST['TID'];
    			for($i=0;$i<count($TID);$i++){
    			
    				$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID[$i]'";
					// $result=mysql_db_query($mysql_dbname,$query,$connect);
					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ){
    					$rows=mysql_fetch_array($result);
    					
    					//# 업체 미수금 
    					$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
						//$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ) {
    						$rows1 = mysql_fetch_array($result1);
    						$balance2 = $rows1[balance2] - $rows[prices_total];
							$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance2`= '$balance2' WHERE `Id`='$company_id'";
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
    							$rows=mysql_fetch_array($result);
    							
    							$stock = $rows[stock] - $rows[num];
								$query = "UPDATE `sales_goods_$MEM[Id]` SET `stock`= '$stock' WHERE `Id`='$goods'";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
							}
						}


						
						
    					
    					// 삭제 쿼리 전송
    					$query1 = "DELETE FROM `sales_trans_$MEM[Id]` WHERE `Id`='$TID[$i]'";
						// mysql_db_query($mysql_dbname,$query1,$connect);	
						mysql_db_query($server[dbname],$query1,$dbconnect);
					}
    			}
			}
			
			
		
			if($_POST['company_search']){
			//# 거래처 검색
				// $_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$query = "select * from `sales_company_$MEM[Id]` where company like '%".$_POST['company_search']."%'";
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    			$total = mysql_result($result,0,0);
    			
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
						$listform = bodyskin("sales_trans_buy_search",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{goodname}","<a href='".$_SERVER['PHP_SELF']."?company_id=$rows[Id]&warehouse=$warehouse&manager=$manager&transdate=$transdate&nonce=$nonce'>$rows[company]</a>","$listform");
						$companylist .= $listform;
					}
				}
				$companylist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
				$body = str_replace("{company_list}",$companylist,$body);
				

			} else $body = str_replace("{company_list}","",$body);
			
			
			
			// echo "goodname: ".$_POST['goodname'] ." num: ". $_POST['num'] ." prices: ". $_POST['prices'] ." total: ". $_POST['total'] ." nonece: ". $_SESSION['nonce'] ." == ". $_POST['nonce']. "<br>";
			
			
			if($_POST['goodname'] && $_POST['num'] && $_POST['prices'] && $_POST['total'] && $_SESSION['nonce'] == $_POST['nonce']){
			//# 신규 상품을 등록 처리합니다. 상품명/수량/단가/ 합계 가격이 다 입력이 된 경우는 정상적인 상품으로 등록 처리.
			
				$log .= "data saving... <br>";
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$goods = $_POST['goods'];
				$goodname = $_POST['goodname'];
				$spec = $_POST['spec'];
				$num = $_POST['num'];
				$currency = $_POST['currency'];
				$prices = $_POST['prices'];
				$vat = $_POST['vat'];
				$discount = $_POST['discount'];
				$prices_sum = $_POST['sum'];
				$prices_total = $_POST['total'];
				
				$COMB = $company_id;
				if($company_id){
					//# 매출 Balance 기록.
					$query = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
					// $result=mysql_db_query($mysql_dbname,$query,$connect);
					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ) {
    					$rows=mysql_fetch_array($result);
    					
    					$balance2 = $rows[balance2] + $prices_total;
						$query = "UPDATE `sales_company_$MEM[Id]` SET `balance2`= '$balance2' WHERE `Id`='$company_id'";
						// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
						
						// 전표 등록
						$manager = $_COOKIE[manager];
						$query = "INSERT INTO `sales_trans_$MEM[Id]` (`regdate`, `transdate`, `memid`, `trans`,  `UIDA`, `UIDB`,  
											`goods`,`goodname`, `spec`, `num`, `currency`, `prices`, `vat`, `discount`, `prices_sum`, `prices_total`,
											 `manager`, `auth`, `warehouse`) 
											VALUES ('$TODAYTIME', '$transdate', '$MEM[Id]', 'buy',  '$COMA', '$COMB',  
											'$goods', '$goodname', '$spec', '$num', '$currency', '$prices', '$vat', '$discount', '$prices_sum', '$prices_total',
											'$manager', '$TODAYTIME', '$warehouse')";
						// echo $query."<br>";				
						// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
						
						//상품 재고 입고 처리...
						if($goods){
							$query = "select * from `sales_goods_$MEM[Id]` where Id = '$goods'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ) {
    							$rows=mysql_fetch_array($result);
    							
    							$stock = $rows[stock] + $num;
								$query = "UPDATE `sales_goods_$MEM[Id]` SET `stock`= '$stock' WHERE `Id`='$goods'";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
							}
							
							
							//# 지점창고 : 재고 조정
							if($warehouse){
								$query = "select * from `sales_goodstock_$MEM[Id]` where warehouse = '$warehouse' and GID = '$goods'";
								
								$result=mysql_db_query($server[dbname],$query,$dbconnect);
    							if( mysql_num_rows($result) ) {
    								$rows=mysql_fetch_array($result);
    								
    								$stock = $rows[stock] + $num;
									$query = "UPDATE `sales_goodstock_$MEM[Id]` SET `stock`= '$stock' WHERE warehouse = '$warehouse' and GID = '$goods'";
									
									mysql_db_query($server[dbname],$query,$dbconnect);
    								
    							} else {
    							// 등록내용이 없을 경추 신규 추가...
    								$query = "INSERT INTO `sales_goodstock_$MEM[Id]` (`warehouse`, `GID`, `stock`) VALUES ('$warehouse', '$goods', '$num')";
    								
    								mysql_db_query($server[dbname],$query,$dbconnect);
    							}
    							
							}

							
							
							
						}
						
						
						
						
						
						//
							
					}
					
					
				} else {
					msg_alert("거래처가 선택되지 않았습니다.");
				}
				 
				//# 신규 자료 입력후, 다시 입력 할 수 있도록 초기화
				if($transdate) $transday=$transdate; else $transday=$TODAY;
				if($coms[vat]) $vat = $coms[vatrate];
				
				$listform = _form_newdata("",$transday,$goods,"","","","","",$vat,"","");
				$body = str_replace("{newdata}",$listform,"$body");
				
			} else if( $_GET['barcode'] ){
			// 바코드 검색
				// $_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$query = "select * from `sales_goods_$MEM[Id]` where barcode = '$barcode'";
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ) {
    				$bar=mysql_fetch_array($result);
    								
					// 1. 먼저 등록된 전표에서, 거래내역이 있는지 확인을 합니다.
					$query = "select * from `sales_trans_$MEM[Id]` where goods = '$bar[Id]' and trans = 'buy' and UIDB = '$company_id' order by transdate desc, Id desc";
					// echo $query."<br>";
					// $result=mysql_db_query($mysql_dbname,$query,$connect);
					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ) {
    					$rows=mysql_fetch_array($result);
    				
    					if($_POST['transdate']) $transday=$_POST['transdate']; else $transday=$TODAY;
    					$prices = $rows[prices_buy];
    					// $vat = $rows[prices_buy] * $MEM[vatrate];
    					if($coms[vat]) $vat = $coms[vatrate];
						$listform = _form_newdata("",$transdate,$rows[goods],$rows[goodname],$rows[spec],$num,$rows[prices],$sum,$vat,$discount,$total);
						$body = str_replace("{newdata}",$listform,"$body");
    				
					} else {
				
						//2. 전표에 거래내역이 없는 경우, 첫 상품거래로 인정하고 상품 목록에서 상품을 검색합니다.
						$query = "select * from `sales_goods_$MEM[Id]` where barcode = '$barcode'";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ) {
    						$rows=mysql_fetch_array($result);
    				
    						if($_POST['transdate']) $transday=$_POST['transdate']; else $transday=$TODAY;
    						$prices = $rows[prices_buy];
    						// $vat = $rows[prices_buy] * $MEM[vatrate];
    						if($coms[vat]) $vat = $coms[vatrate];
    						// echo "VAT is $vat<br>";
							$listform = _form_newdata("",$transdate,$rows[Id],$rows[name],$spec,$num,$prices,$sum,$vat,$discount,$total);
							$body = str_replace("{newdata}",$listform,"$body");
	    				} 
	    			}
	    			
	    			$barcode = $_GET['barcode'];
					$msg = "바코드 $barcode";
					echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       							<script> alert(\"$msg\"); </script>";
	    		
	    		} else {
	    			$barcode = $_GET['barcode'];
					$msg = "등록되지 않은 바코드 상품입니다.";
					echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       							<script> alert(\"$msg\"); </script>";
	    			
	    			$listform = _form_newdata("",$transdate,$rows[Id],$rows[name],$spec,$num,$prices,$sum,$vat,$discount,$total);
					$body = str_replace("{newdata}",$listform,"$body");
	    		
	    		}


	
			} else if($_GET['goods_id'] && $_SESSION['nonce'] == $_GET['nonce']){
			//# 검색상품 선택. 상품명만 입력후, 엔터를 누른경우 거래전표 / 상품 목록에서 상품을 검색하여 찾아 줍니다.
			
				$log .= "select goods_id<br>";
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				// 1. 먼저 등록된 전표에서, 거래내역이 있는지 확인을 합니다.
				$query = "select * from `sales_trans_$MEM[Id]` where goods = '".$_GET['goods_id']."' and trans = 'buy' and UIDB = '$company_id' order by transdate desc, Id desc";
				// echo $query."<br>";
				// $result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ) {
    				$rows=mysql_fetch_array($result);
    				
    				if($_POST['transdate']) $transday=$_POST['transdate']; else $transday=$TODAY;
    				$prices = $rows[prices_buy];
    				// $vat = $rows[prices_buy] * $MEM[vatrate];
    				if($coms[vat]) $vat = $coms[vatrate];
					$listform = _form_newdata("",$transdate,$rows[goods],$rows[goodname],$rows[spec],$num,$rows[prices],$sum,$vat,$discount,$total);
					$body = str_replace("{newdata}",$listform,"$body");
    				
				} else {
				
					//2. 전표에 거래내역이 없는 경우, 첫 상품거래로 인정하고 상품 목록에서 상품을 검색합니다.
					$query = "select * from `sales_goods_$MEM[Id]` where Id = '".$_GET['goods_id']."'";
					// $result=mysql_db_query($mysql_dbname,$query,$connect);
					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ) {
    					$rows=mysql_fetch_array($result);
    				
    					if($_POST['transdate']) $transday=$_POST['transdate']; else $transday=$TODAY;
    					$prices = $rows[prices_buy];
    					// $vat = $rows[prices_buy] * $MEM[vatrate];
    					if($coms[vat]) $vat = $coms[vatrate];
    					// echo "VAT is $vat<br>";
						$listform = _form_newdata("",$transdate,$rows[Id],$rows[name],$spec,$num,$prices,$sum,$vat,$discount,$total);
						$body = str_replace("{newdata}",$listform,"$body");
	    			}	
	    		
	    		}

	
			} else if( $_POST['goodname'] ){
			//# 상품명만 입력한 경우, 상품 목록에서 상품을 검색
				$log .= "search goods... <br>";
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());  
				
				$query = "select * from `sales_goods_$MEM[Id]` where name like '%".$_POST['goodname']."%'"; 
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    			$total = mysql_result($result,0,0);
    			
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
						$listform = bodyskin("sales_trans_buy_goods",$_SESSION['mobile'],$_SESSION['language']);
						
						if($rows[images]) $listform = str_replace("{img}","<img src='$rows[images]' border=0 width=50>","$listform");
						else $listform = str_replace("{img}","","$listform");
						
						$listform = str_replace("{goodname}","<a href='".$_SERVER['PHP_SELF']."?goods_id=$rows[Id]&company_id=$company_id&warehouse=$warehouse&manager=$manager&transdate=$transdate&nonce=$nonce'>$rows[name]</a>","$listform");
						$goodlist .= $listform;
					}
				}
				$goodlist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
				$body = str_replace("{search_result}",$goodlist,$body);
				$status = "good_search";
				
				//# 상품명으로 검색시, 검색키워드는 상품명으로 입력 남김
				if($transdate) $transday=$_POST['transdate']; else $transday=$TODAY;
				if($coms[vat]) $vat = $coms[vatrate];
				
				$listform = _form_newdata("",$transday,$goods,$_POST['goodname'],"","","","",$vat,"","");
				$body = str_replace("{newdata}",$listform,"$body");
				
			} else {
			//# 신규 자료 입력. Blank
				$log .= "ready to new data<br>";
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				if($transdate) $transday=$transdate; else $transday=$TODAY;
				if($coms[vat]) $vat = $coms[vatrate];
				
				$listform = _form_newdata("",$transday,$goods,"","","","","",$vat,"","");
				$body = str_replace("{newdata}",$listform,"$body");
			}
			
			// echo $log;
			

			/////////////////////////////////
			/////////////////////////////////
			
			$body = str_replace("{formstart}","<form name='trans' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						<input type='hidden' name='nonce' value='$nonce'>
					    						<input type='hidden' name='company_id' value='$company_id'>
					    						<input type='hidden' name='mode' >
					    						<input type='hidden' name='company' value='$company'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$body = str_replace("{submit}","<input type='submit' value='검색' $btn_style_blue>",$body);
			$body = str_replace("{search_result}","",$body);
			
			//# Balance 잔액표시
			$body = str_replace("{balance}","$balance2",$body);
			
			
			//# 전표 작성일자 설정
			if($transdate) $body = str_replace("{transdate}","<input type='date' name='transdate' value='$transdate' onChange=\"javascript:submit()\" $cssFormStyle>",$body);
			else $body = str_replace("{transdate}","<input type='date' name='transdate' value='$TODAY' onChange=\"javascript:submit()\" $cssFormStyle>",$body);
			
			/////////////////////////
			/////////////////////////
			
			//# 전표 자료 출력
			$query = "select * from sales_trans_$MEM[Id] where (trans = 'buy' or trans = 'buy_payin')"; //판매 전표출력
		    if($transdate){
		    	//# 지정날짜 해당월
		    	$start = substr($transdate,0,4)."-".substr($transdate,5,2)."-01";
		    	$end = substr($transdate,0,4)."-".substr($transdate,5,2)."-31";
		    	$query .= "and transdate >= '$start' and transdate <= '$end' ";
		    } else {
		    	//# 지정날짜가 없는경우, 이번달 xx.01 ~ xx.31 까지 자료 검색
		    	$start = substr($TODAY,0,4)."-".substr($TODAY,5,2)."-01";
		    	$end = substr($TODAY,0,4)."-".substr($TODAY,5,2)."-31";
		    	$query .= "and transdate >= '$start' and transdate <= '$end' ";
		    }
		    
			$query .= " and UIDB = '$company_id' ";	
		    $query .= " and auth IS NOT NULL ";	    	
			$query .= " order by transdate desc, Id desc";	
			// echo "<br>".$query."<br>";
			
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 
    			$prices = 0;
				$vat = 0;
				$tot = 0;
				$discount = 0;
				$pay = 0;					
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			if($rows[trans] == "buy"){
	    			$listform = bodyskin("sales_trans_buy_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$rows[Id]' >
													 <input type='hidden' name='pay[]' value='$rows[pay]' >
													 <input type='hidden' name='expert[]' value='$rows[expert]' >","$listform");
					
					$day=substr($rows[transdate],8,2);
					$listform = str_replace("{day}","$day","$listform");
				
					if($rows[expert]) $expert = "↗"; else $expert = ""; //마크: 외부 자료전송. 
					if($rows[pay]) $flag_pay = "$"; else $flag_pay = ""; //마크: 입금확인여부.
					if($rows[report]) $flag_report = "≡"; else $flag_report = ""; //마크: 명세서출력.
					if($expert || $flag_pay || $flag_report) $flag = "[".$flag_pay. $flag_report. $expert."]";				
					
 
					if($rows[memid] != $MEM[Id]){
						$import = "↘"; //외부에서 전표 입력시. 표기
						//외부에서 입력된 자료는 수정할 수 없음.
						$listform = str_replace("{goodname}","$import $rows[goodname] $flag","$listform"); 
					} else {
						$listform = str_replace("{goodname}","<a href='sales_trans_buy_edit.php?TID=$rows[Id]'>$rows[goodname]</a> $flag","$listform");	
					}
					
					$listform = str_replace("{spec}","$rows[spec]",$listform );
					$listform = str_replace("{num}","$rows[num]",$listform );
					$listform = str_replace("{prices}","$rows[prices]",$listform );
					$listform = str_replace("{sum}","$rows[prices_sum]",$listform );
					$listform = str_replace("{vat}","$rows[vat]",$listform );
					$listform = str_replace("{discount}","$rows[discount]",$listform );
					$listform = str_replace("{total}","$rows[prices_total]",$listform );
					
					$prices += $rows[prices];
					$vat += $rows[vat];
					$tot += $rows[prices_total];
					$discount += $rows[discount];
					$list .= $listform;	
					
					} else {
						$pay += $rows[paymoney];
					}
					
	    		}
	    	} 
			
			$body=str_replace("{datalist}",$list,$body);
			$body=str_replace("{prices}",$prices,$body);
			$body=str_replace("{vat}",$vat,$body);
			$body=str_replace("{discount}",$discount,$body);
			$body=str_replace("{tot}",$tot,$body);
			$body=str_replace("{pay}",$pay,$body);
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);
?>

