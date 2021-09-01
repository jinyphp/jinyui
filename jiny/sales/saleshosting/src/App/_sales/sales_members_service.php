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
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
			
			if($mode == "renewaldel"){
					$SOID = $_GET['SOID'];
					
					$query ="DELETE FROM `sales_reseller_order` WHERE `Id`='$SOID'";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					// GCM_SenderByPhone("01039113106","연장취소:$ALBA[company] 취소신청 되었습니다.","sales",$mysql_dbname,$connect);
					
					echo "<meta http-equiv='refresh' content='0; url=sales_members_service.php'>";
				
			} else if($mode == "editup3"){
					if($_SESSION['nonce'] == $_POST['nonce']){
					
						$SID = $_POST['SID'];
						$query = "select * from sales_reseller where Id = '$SID'";
    					$result=mysql_db_query($mysql_dbname,$query,$connect);
    					if( mysql_num_rows($result) ){ 
					
	    					$rows=mysql_fetch_array($result);
	    					
	    					
	    					$query ="INSERT INTO `sales_reseller_order` (`regdate`, `reseller`, `mem`, `serviceID`, `title`, `priod`, `comcount`, `transcount`, `prices`, `discount`, `orderauth`, `expire`) 
	    					VALUES ('$TODAYTIME', '$MEM[reseller]', '$MEM[Id]', '$SID', '$rows[title]', '$rows[priod]', '$rows[comcount]', '$rows[transcount]', '$rows[chargeprices]', '$rows[discount]', 'ordered', '$MEM[expire]');";
							// echo "$query <br>";
							mysql_db_query($mysql_dbname,$query,$connect);
						}
						
						// GCM_SenderByPhone("01039113106","연장접수 결제확인:$ALBA[company] 연장신청이 접수되었습니다.","sales",$mysql_dbname,$connect);
					
					}
					$_SESSION['nonce'] = NULL;
					echo "<meta http-equiv='refresh' content='0; url=sales_memberservice.php'>";
					
			}
			
			
			
			//# 스킨 레이아웃 	
			$body = shopskin("sales_members_service");
			
			$body = str_replace("{memtype}","$MEM[memtype]",$body);
			
			$body = str_replace("{max_company}","$MEM[maxcompany]",$body);
			$body = str_replace("{max_trans}","$MEM[maxtrans]",$body);			
			$body = str_replace("{renewal}","$MEM[paydate]",$body);
			$body = str_replace("{expire}","$MEM[expire]",$body);
    				
			
			/// 은행 계좌번호 표시
			$query = "select * from sales_members_bank where mem = '$MEM[Id]' order by bankname desc";
    		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
						
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){		
							
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);

					$banklist = "<table border='0' cellspacing='5' cellpadding='5'><tr>";
					
					if($rows[defaultbank]){	
						  $banklist .= "<td ><b><font size=2>$rows[bankname]</font></b></td><td>";
						 $banklist .= "<td ><b><font size=2>$rows[banknum]</font></b></td><td>";
						 $banklist .= "<td ><b><font size=2>$rows[bankuser]</font></b></td><td>";
					} else {
							  	
						 $banklist .= "<td ><font size=2>$rows[bankname]</font></td><td>";
						$banklist .= "<td ><font size=2>$rows[banknum]</font></td><td>";
						$banklist .= "<td ><font size=2>$rows[bankuser]</font></td><td>";
					}
							
					$banklist .= "</tr></table>";
							
	    	
	    		}
	    					
	    	} 
			$body = str_replace("{banklist}",$banklist,$body);
			
			
			
			
			/// 리셀러 가격표
			$query = "select * from sales_reseller_order where mem = '$MEM[Id]' and orderauth = 'ordered' order by title desc, priod asc";
    		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
    					
    		if($total>0){
    			$body = str_replace("{formstart}","","$body");
    			$body = str_replace("{formend}","","$body");
    			$body = str_replace("{submit}","","$body");
    			
    			// 연장 신청 내역이 있는 경우
				$result=mysql_db_query($mysql_dbname,$query,$connect);
    			if( mysql_num_rows($result) ){
    				
					/*							    				
					$list = "<table border='0' cellspacing='5' cellpadding='5' width=100%><tr><td align='center'>
					  		 <font size=2>미승인 연장 내역이 존재합니다. * 모든 신청서 삭제후, 신규 연장 가능합니다.</font>
					    	 </td></tr></table>";			
					*/
												
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
	    				$listform = bodyskin("sales_members_service_list",$_SESSION['mobile'],$_SESSION['language']);
	
						$listform = str_replace("{img}","<a href='sales_members_service.php?mode=renewaldel&SOID=$rows[Id]'><img src='./images/delete.jpg' border=0 width=20></a>","$listform");
								
						$listform = str_replace("{service_name}","<a href='sales_reseller_new.php?mode=edit&UID=$rows[Id]'><b>$rows[title]</b></a>","$listform");
						$listform = str_replace("{max_company}","최대 거래처수:","$listform");
						$listform = str_replace("{month_trans}","월 거래전표수","$listform");
								
						$listform = str_replace("{service_priod}","$rows[priod] 개월","$listform");
						$listform = str_replace("{max_count}","$rows[comcount] 건","$listform");
						$listform = str_replace("{trans_count}","$rows[transcount] 건","$listform");
								
						$listform = str_replace("{chargeprices}","","$listform");
						$discount = str_replace("%","",$rows[discount]);
						$listform = str_replace("{discount}","할인율:$discount%","$listform");
						
						$listform = str_replace("{prices}","$rows[prices]","$listform");
						$listform = str_replace("{select}","","$listform");
							
						$listform = str_replace("{comment}","$rows[comment]","$listform");
								
						$list .= $listform;	
										
	    			}	
				}
							
			} else {
			// 신규 연장 신청
						
				if($MEM[reseller]) $reseller = $MEM[reseller]; else $reseller = "default";
				$query = "select * from sales_reseller where mem = '$reseller' order by title desc, priod asc";
    			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    			$total=mysql_result($result,0,0);
				
				// echo $query."<br>";
				
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
    			if( mysql_num_rows($result) ){
    						$_SESSION['nonce'] = $nonce = md5('renewal'.microtime());
    						
					    	$body = str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_members_service.php'> 
										<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='editup3'>","$body");
							$body = str_replace("{submit}","<input type='submit' name='reg' value='연장신청&결제확인' >","$body");			
					    	$body = str_replace("{formend}","</form>","$body");				
							
							for($i=0;$i<$total;$i++){
	    						$rows=mysql_fetch_array($result);

								$listform = bodyskin("sales_members_service_list",$_SESSION['mobile'],$_SESSION['language']);
	
								$listform = str_replace("{img}","<img src='./images/service.gif' border=0 width=30>","$listform");
								
								$listform = str_replace("{service_name}","<a href='sales_reseller_new.php?mode=edit&UID=$rows[Id]'><b>$rows[title]</b></a>","$listform");
								$listform = str_replace("{max_company}","최대 거래처수:","$listform");
								$listform = str_replace("{month_trans}","월 거래전표수","$listform");
								
								$listform = str_replace("{service_priod}","$rows[priod] 개월","$listform");
								$listform = str_replace("{max_count}","$rows[comcount] 건","$listform");
								$listform = str_replace("{trans_count}","$rows[transcount] 건","$listform");
								
								$listform = str_replace("{chargeprices}","$rows[chargeprices]","$listform");
								$discount = str_replace("%","",$rows[discount]);
								$listform = str_replace("{discount}","할인율:$discount%","$listform");
								$prices = $rows[chargeprices] * (100-$discount)/100;
								$listform = str_replace("{prices}","$prices","$listform");
								$listform = str_replace("{select}","<input type='radio' name='SID' value='$rows[Id]'>","$listform");
								
								$listform = str_replace("{comment}","$rows[comment]","$listform");
								
								$list .= $listform;	
								
								
	    					}
	  	
	    		} // no data

					
					
			}
			
			
			
				
			$body = str_replace("{list}",$list,$body);
			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	mysql_close($connect);
	mysql_close($dbconnect);	

?>

