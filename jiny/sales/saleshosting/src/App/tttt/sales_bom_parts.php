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
		
		$listform = bodyskin("sales_bom_parts_list",$_SESSION['mobile'],$_SESSION['language']);

		$listform = str_replace("{TID}","","$listform");
					
		if($goodname) 
		$listform = str_replace("{goodname}","<input type='hidden' name='goods' value='$goods'><input type='text' name='goodname' value='$goodname' autofocus $CSS onChange=\"javascript:submit()\">","$listform");	
		else $listform = str_replace("{goodname}","<input type='hidden' name='goods' value='$goods'><input type='text' name='goodname' placeholder='부품명' autofocus $CSS onChange=\"javascript:submit()\">","$listform");
		
		if($num)
		$listform = str_replace("{num}","<input type='text' name='num' value='$num' $CSS onChange=\"javascript:submit()\">",$listform );
		else $listform = str_replace("{num}","<input type='text' name='num' placeholder='수량' $CSS onChange=\"javascript:submit()\">",$listform );
		
		if($prices)
		$listform = str_replace("{prices}","<input type='text' name='prices' value='$prices' $CSS >",$listform );
		else $listform = str_replace("{prices}","<input type='text' name='prices' placeholder='단가' $CSS >",$listform );
		
		return $listform; 
	}
	

	//
	//
	
	
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
		if( mysql_num_rows($result) ){ 
			$MEM=mysql_fetch_array($result);
			
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_num_rows($result) )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}


			//////////////////////////////////////////////////////////////////
			$company = $_GET['company']; if(!$company) $company = $_POST['company'];
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
			
			$body = shopskin("sales_bom_parts");
			include "sales_bom_left.php";
			
			
		    $query = "select * from `sales_goods_$MEM[Id]` where Id = '$UID'";		
			// $result=mysql_db_query($mysql_dbname,$query,$connect);
			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){
	    		$bom=mysql_fetch_array($result);
	    		$body = str_replace("{goodname}","$bom[name]",$body);
	    		
	    		
	    		if($mode == "delete" && $_SESSION['nonce'] == $_POST['nonce']){
	    			$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
	    			if( $bom[bom_parts] ){
						$TID = $_POST['TID'];
						$_bom = explode(";",$bom[bom_parts]);
						$bbb = "";
						for($i=0;$i<count($_bom);$i++){
							$bom_part = explode(":",$_bom[$i]);
    						for($j=0;$j<count($TID);$j++) {
    							if($TID[$j] == $i) $delete = "true"; else $delete = "false";
    							//echo "is $TID[$j] == $i <br>";
							}
							if($delete == "false" && $_bom[$i] ) 
								if($bbb) $bbb .= ";".$_bom[$i]; else  $bbb = $_bom[$i];
						}
						
						$query = "UPDATE `sales_goods_$MEM[Id]` SET `bom_parts`= '$bbb' WHERE `Id`='$UID'";
						// echo $query."<br>";
						// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
					}
	    		} else if($mode == "assem" && $_SESSION['nonce'] == $_POST['nonce']){
	    			$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
	    			$assem_num = $_POST['assem_num'];
	    			
	    			if($bom[bom_parts]){
						$_bom = explode(";",$bom[bom_parts]);
						//echo "assem : $assem_num <br>";
						for($i=0;$i<count($_bom);$i++){
							$bom_part = explode(":",$_bom[$i]);
							
							//echo "- $assem_num: $bom_part[0] / $bom_part[1]/ $bom_part[2]/ $bom_part[3] <br>";
							
							$query = "select * from `sales_goods_$MEM[Id]` where Id = '$bom_part[0]'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ) {
    							$rows=mysql_fetch_array($result);
    							
    							$stock = $rows[stock] - $bom_part[3] * $assem_num;
    							//echo "$rows[stock] - $bom_part[3] * $assem_num <br>";
								$query = "UPDATE `sales_goods_$MEM[Id]` SET `stock`= '$stock' WHERE `Id`='$bom_part[0]'";
								//echo $query."<br>";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
							}
						}
						
						$bom_stock = $bom[stock] + $assem_num;
						$query = "UPDATE `sales_goods_$MEM[Id]` SET `stock`= '$bom_stock' WHERE `Id`='$UID'";
						//echo $query."<br>";
						// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
						
						$query = "INSERT INTO `sales_bom_$MEM[Id]` (`regdate`, `type`, `GID`, `num`) VALUES ('$TODAYTIME', 'assm', '$UID', '$assem_num')";
						mysql_db_query($server[dbname],$query,$dbconnect);
						
					}
	    			
				} else if($mode == "disassem" && $_SESSION['nonce'] == $_POST['nonce']){
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
					$assem_num = $_POST['assem_num'];
	    			
	    			if($bom[bom_parts]){
						$_bom = explode(";",$bom[bom_parts]);
						//echo "assem : $assem_num <br>";
						for($i=0;$i<count($_bom);$i++){
							$bom_part = explode(":",$_bom[$i]);
							
							//echo "- $assem_num: $bom_part[0] / $bom_part[1]/ $bom_part[2]/ $bom_part[3] <br>";
							
							$query = "select * from `sales_goods_$MEM[Id]` where Id = '$bom_part[0]'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ) {
    							$rows=mysql_fetch_array($result);
    							
    							$stock = $rows[stock] + $bom_part[3] * $assem_num;
    							//echo "$rows[stock] + $bom_part[3] * $assem_num <br>";
								$query = "UPDATE `sales_goods_$MEM[Id]` SET `stock`= '$stock' WHERE `Id`='$bom_part[0]'";
								//echo $query."<br>";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
							}

														
							
						}
						
						$bom_stock = $bom[stock] - $assem_num;
						$query = "UPDATE `sales_goods_$MEM[Id]` SET `stock`= '$bom_stock' WHERE `Id`='$UID'";
						//echo $query."<br>";
						// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
						
						$query = "INSERT INTO `sales_bom_$MEM[Id]` (`regdate`, `type`, `GID`, `num`) VALUES ('$TODAYTIME', 'disassem', '$UID', '$assem_num')";
						mysql_db_query($server[dbname],$query,$dbconnect);
						
					}
					
	    		}
			
		
				// 전체 선택버튼
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
       			function parts_assem(){
       				document.parts.mode.value = \"assem\";
 					document.parts.submit();	
 				}
    			</script>"; 
				$body = str_replace("{assem}","$script <input type='button' value='생산' $btn_style_green onclick=\"javascript:parts_assem()\">",$body);
				
				$script = "<script>
       			function parts_disassem(){
       				document.parts.mode.value = \"disassem\";
 					document.parts.submit();	
 				}
    			</script>"; 
				$body = str_replace("{disassem}","$script <input type='button' value='분해' $btn_style_green onclick=\"javascript:parts_disassem()\">",$body);
				
				$script = "<script>
       			function parts_del(){
       				var submit = false;
       				var chk = document.getElementsByName('TID[]');
       				var chk_count = 0;
       				
       				for(var i=0;i<chk.length;i++){
       					if(chk[i].checked) chk_count++;
       				}
       				
					if(chk.length > 0){
						if(chk_count > 0){
							var returnValue = confirm(\"선택한 부품을 삭제하겠습니까?\");
							if(returnValue == true){
 								document.parts.mode.value = \"delete\";
 								document.parts.submit();
 							}
 						} else alert(\"삭제할 부품이 없습니다.\");
 					} else alert(\"부품 리스트가 없습니다.\");
 				}
    			</script>"; 
				$body = str_replace("{delete}","$script <input type='button' value='삭제' $btn_style_gray onclick=\"javascript:parts_del()\">",$body);
			
				$body = str_replace("{save}",_button_blue("확인","sales_bom.php"),$body);
			
				
			
				//echo $_SESSION['nonce'] ."==". $_GET['nonce'] ."<br>";
		
				if( $_POST['goodname'] && $_POST['num'] && $_POST['goods'] && $_SESSION['nonce'] == $_POST['nonce']){
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
					
					if($bom[bom_parts])
					$parts = $bom[bom_parts] .";". $_POST['goods'] .":". $_POST['goodname'] .":". $_POST['prices'] .":". $_POST['num'];
					else $parts = $_POST['goods'] .":". $_POST['goodname'] .":". $_POST['prices'] .":". $_POST['num'];
					
					
					echo $parts."<br>";
					$query = "UPDATE `sales_goods_$MEM[Id]` SET `bom_parts`= '$parts' WHERE `Id`='$UID'";
					//echo $query."<br>";
					// mysql_db_query($mysql_dbname,$query,$connect);
					mysql_db_query($server[dbname],$query,$dbconnect);
					
					$listform = _form_newdata("",$transday,$goods,"","","","","",$vat,"","");
					$body = str_replace("{newdata}",$listform,"$body");
					
				} else if($_GET['goods_id'] && $_SESSION['nonce'] == $_GET['nonce']){
				//# 검색상품 선택. 상품명만 입력후, 엔터를 누른경우 거래전표 / 상품 목록에서 상품을 검색하여 찾아 줍니다.
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
					
					//상품 목록에서 상품을 검색합니다.
					$query = "select * from `sales_goods_$MEM[Id]` where Id = '".$_GET['goods_id']."'";
					// $result=mysql_db_query($mysql_dbname,$query,$connect);
					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ) {
    					$rows=mysql_fetch_array($result);
	    			
						$listform = _form_newdata("",$transdate,$rows[Id],$rows[name],$spec,$num,$rows[prices_buy],$sum,$vat,$discount,$total);
						$body = str_replace("{newdata}",$listform,"$body");
					}	
				} else if( $_POST['goodname'] ){
				//# 상품명만 입력한 경우, 상품 목록에서 상품을 검색
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());  
				
					$query = "select * from `sales_goods_$MEM[Id]` where name like '%".$_POST['goodname']."%'"; 
					// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
					$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    				$total = mysql_result($result,0,0);
    				//$result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ){ 				
						for($i=0;$i<$total;$i++){
	    					$rows=mysql_fetch_array($result);
							$listform = bodyskin("sales_trans_sell_goods",$_SESSION['mobile'],$_SESSION['language']);
						
							if($rows[images]) $listform = str_replace("{img}","<img src='$rows[images]' border=0 width=50>","$listform");
							else $listform = str_replace("{img}","","$listform");
						
							$listform = str_replace("{goodname}","<a href='".$_SERVER['PHP_SELF']."?goods_id=$rows[Id]&UID=$UID&nonce=$nonce'>$rows[name]</a>","$listform");
							$goodlist .= $listform;
						}
					}
					$goodlist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
					$body = str_replace("{search_result}",$goodlist,$body);
					
					$listform = _form_newdata("",$transday,$goods,$_POST['goodname'],"","","","",$vat,"","");
					$body = str_replace("{newdata}",$listform,"$body");
				
				} else {
					$listform = _form_newdata("",$transday,$goods,"","","","","",$vat,"","");
					$body = str_replace("{newdata}",$listform,"$body");
				}
				
				//////////////////////////////
				$body = str_replace("{formstart}","<form name='parts' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						<input type='hidden' name='nonce' value='$nonce'>
					    						<input type='hidden' name='UID' value='$UID'>
					    						<input type='hidden' name='mode' >",$body);
				$body = str_replace("{formend}","</form>",$body);
				$body = str_replace("{assem_num}","<input type='text' name='assem_num' placeholder='수량' $CSS_search>",$body);
				$body = str_replace("{search_result}","",$body);
				
				//////////////////////////////
				// 리스트 표시...
				
				
				
				$query = "select * from `sales_goods_$MEM[Id]` where Id = '$UID'";		
				// $result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){
	    			$bom=mysql_fetch_array($result);
	    			
					if($bom[bom_parts]){
						$_bom = explode(";",$bom[bom_parts]);
						//echo "<br> bom count ".count($_bom);
						for($i=0,$prices_buy=0;$i<count($_bom);$i++){
							$listform = bodyskin("sales_bom_parts_list",$_SESSION['mobile'],$_SESSION['language']);
						
							$bom_part = explode(":",$_bom[$i]);
							$listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$i'>",$listform);
							$listform = str_replace("{goodname}","$bom_part[1]",$listform);
							$listform = str_replace("{prices}","$bom_part[2]",$listform);
							$listform = str_replace("{num}","$bom_part[3]",$listform);
							$prices_buy += $bom_part[2] * $bom_part[3]; 
							$list .= $listform; 
						}
						$body = str_replace("{databody}",$list,"$body");
						
						$query = "UPDATE `sales_goods_$MEM[Id]` SET `prices_buy`= '$prices_buy' WHERE `Id`='$UID'";
						// echo $query."<br>";
						// mysql_db_query($mysql_dbname,$query,$connect);
						mysql_db_query($server[dbname],$query,$dbconnect);
					} else $body = str_replace("{databody}","","$body");
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
