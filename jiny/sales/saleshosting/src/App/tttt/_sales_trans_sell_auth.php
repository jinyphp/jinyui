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
			
			
			if($mode == "auth"){
			
				for($i=0;$i<count($TID);$i++){
				
					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID[$i]'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ) {
    					$rows=mysql_fetch_array($result);
    					
    					$query = "UPDATE `sales_trans_$MEM[Id]` SET `auth`='$TODAYTIME' WHERE `Id`='$TID[$i]'";
        				// mysql_db_query($mysql_dbname,$query,$connect);
        				mysql_db_query($server[dbname],$query,$dbconnect);
        				//echo $query."<br>";
    					
						// 전표 승인과 동시에 거래처 미수금 Balance 조정
						
						//# 업체 미수금 
    					$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$rows[UIDB]'";
						//echo $query1."<br>";
						// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ) {
    						$rows1 = mysql_fetch_array($result1);
    						$balance1 = $rows1[balance1] + $rows[prices_total]; // Balance2 매입
							$query1 = "UPDATE `sales_company_$MEM[Id]` SET `balance1`= '$balance1' WHERE `Id`='$rows[UIDB]'";
							// echo $query1."<br>";
							// mysql_db_query($mysql_dbname,$query1,$connect);
							mysql_db_query($server[dbname],$query1,$dbconnect);
						}

						
 
					}

				}

				echo "<meta http-equiv='refresh' content='0; url=sales_trans_sell_auth.php'>";
			} else {
			
			
			
				$body = shopskin("sales_trans_sell_auth");
			
				$body = str_replace("{formstart}","<form name='auth' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='mode' value='auth'>",$body);
				$body = str_replace("{formend}","</form>",$body);
    			$body = str_replace("{confirm}","<input type='submit' value='승인' $butten_style >",$body);	
			
				//# 전표 자료 출력
				$query = "select * from sales_trans_$MEM[Id] where trans = 'sell' and memid != $MEM[Id] and auth IS NULL"; //판매 전표출력    	
				$query .= " order by transdate desc, Id desc";	
				// echo "<br>".$query."<br>";
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    			$total = mysql_result($result,0,0);
    
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
	    			
	    				$listform = bodyskin("sales_trans_sell_auth_list",$_SESSION['mobile'],$_SESSION['language']);
	
						$listform = str_replace("{tid}","<input type='checkbox' name='TID[]' value='$rows[Id]' >","$listform");
						
						$listform = str_replace("{regdate}","$rows[transdate]",$listform );
					
						$query1 = "select * from sales_company_$MEM[Id] where Id = '$rows[UIDB]'";
						// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
						$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ){ 
    						$coms=mysql_fetch_array($result1);
							$listform = str_replace("{company}","$coms[company]",$listform );
						} else $listform = str_replace("{company}","Error",$listform );
					
						$listform = str_replace("{goodname}","$rows[goodname]",$listform );
						$listform = str_replace("{num}","$rows[num]",$listform );
					
						$listform = str_replace("{total_prices}","$rows[prices_total]",$listform );
					
						$list .= $listform;	
	    			}
	    		} 
			
				$body=str_replace("{datalist}",$list,$body);


	
				
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

