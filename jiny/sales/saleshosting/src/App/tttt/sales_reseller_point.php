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
			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
			
			switch($mode){
				case 'pay_auth':
					$query = "select * from sales_reseller_pointsave where Id = '$UID'";
					// echo $query."<br>";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					$rows=mysql_fetch_array($result);
    					
    					if($MEM[resellerpoint] <= $rows[money]) msg_alert("승인할 적립금액이 부족합니다.");
						else {
    						// 승인처리
    						$query = "UPDATE `sales_reseller_pointsave` SET `auth`='on' WHERE `Id`='$UID'";
    						//echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect);
    					
    					
    						$query = "select * from `sales_members` where Id = '$rows[mem]'";
    						$result=mysql_db_query($mysql_dbname,$query,$connect);
    						if( mysql_num_rows($result) ) {
    							$_mem = mysql_fetch_array($result);
    							// 리셀러 차감...
    							$point = $MEM[resellerpoint] - $rows[money];
    							$query = "UPDATE `sales_members` SET `resellerpoint`='$point' WHERE  email = '$_COOKIE[email]'";
    							//echo $query."<br>";
    							mysql_db_query($mysql_dbname,$query,$connect);
    					
    							$query = "INSERT INTO `sales_reseller_point` (`regdate`, `reseller`, `mem`, `subject`, `money_out`, `money_in`, `balance`) 
									VALUES ('$TODAYTIME', '$MEM[reseller]', '$rows[mem]', '리셀러 승인차감 / $_mem[company] $_mem[manager]', '$rows[money]', '', '$point')";
								//echo $query."<br>";
								mysql_db_query($mysql_dbname,$query,$connect);
							}	
							
    						$query = "select * from `sales_members` where Id = '$rows[mem]'";
    						$result=mysql_db_query($mysql_dbname,$query,$connect);
    						if( mysql_num_rows($result) ) {
    							$_mem = mysql_fetch_array($result);
    							// 입금 적립...
    							$_point = $_mem[resellerpoint] + $rows[money];
    							$query = "UPDATE `sales_members` SET `resellerpoint`='$_point' WHERE  Id = '$rows[mem]'";
    							//echo $query."<br>";
    							mysql_db_query($mysql_dbname,$query,$connect);
    						
    							$query = "INSERT INTO `sales_reseller_point` (`regdate`, `reseller`, `mem`, `subject`, `money_out`, `money_in`, `balance`) 
									VALUES ('$TODAYTIME', '$_mem[email]', '$rows[mem]', '입금', '', '$rows[money]', '$_point')";
								//echo $query."<br>";
								mysql_db_query($mysql_dbname,$query,$connect);
    					
    						}
    					
	    				}
	    			}	
	    			echo "<meta http-equiv='refresh' content='0; url=sales_reseller_point.php'>";	
					break;
				case 'pay_authlist':
					//# 스킨 레이아웃 	
					$body = shopskin("sales_reseller_point_authlist");
					$body = str_replace("{resellerpoint}","<a href='sales_reseller_point.php'>$MEM[resellerpoint]</a>",$body);
			
					$body = str_replace("{pay_in}",_button_blue("적립","sales_reseller_point.php?mode=pay_in"),$body); 
					$body = str_replace("{pay_out}",_button_blue("출금","sales_reseller_point.php?mode=pay_out"),$body); 
					$body = str_replace("{pay_auth}",_button_green("입금승인","sales_reseller_point.php?mode=pay_authlist"),$body); 
			
					/// 리셀러 적립금 사용내역
					$query = "select * from sales_reseller_pointsave where reseller = '$MEM[email]' and type ='in' order by regdate desc";
    				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
				
					//echo $query."<br>";
				
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					for($i=0;$i<$total;$i++){
	    					$rows=mysql_fetch_array($result);

							$listform = bodyskin("sales_reseller_point_authlist_list",$_SESSION['mobile'],$_SESSION['language']);
							$listform = str_replace("{regdate}","$rows[regdate]","$listform");
							
							
							$query1 = "select * from `sales_members` where Id = '$rows[mem]'";
    						$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
							if( mysql_affected_rows() ){ 
								$com=mysql_fetch_array($result1);
								$listform = str_replace("{company}","$com[company] $com[manager]","$listform");
							} else $listform = str_replace("{company}","","$listform");
							
							$listform = str_replace("{money}","$rows[money]","$listform");
							
							if($rows[auth]) $listform = str_replace("{auth}","승인완료","$listform");
							else $listform = str_replace("{auth}","<a href='sales_reseller_point.php?mode=pay_auth&UID=$rows[Id]'>승인대기</a>","$listform");
			
							$list .= $listform;	
								
								
	    				}
	  	
	  					$body = str_replace("{datalist}",$list,$body);
	    			} else {
	    				$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{nodata}","적립금 포인트 거래내역이 없습니다.",$listform);
	    				$body=str_replace("{datalist}",$listform,$body);
	    			}
				
					break;
				case 'pay_inup':
					$money = $_POST['money'];
					$name = $_POST['name'];
					if(!$money) msg_alert("입금금액이 없습니다.");
					else {
						$query = "INSERT INTO `sales_reseller_pointsave` (`regdate`, `reseller`, `mem`, `type`, `money`, `name`) 
							VALUES ('$TODAY', '$MEM[reseller]', '$MEM[Id]', 'in', '$money', '$name')";
						mysql_db_query($mysql_dbname,$query,$connect);
					}
					echo "<meta http-equiv='refresh' content='0; url=sales_reseller_point.php'>";
					break;
				case 'pay_in':
					//# 스킨 레이아웃 	
					$body = shopskin("sales_reseller_point_payin");
					
					$body=str_replace("{formstart}","<form name='point' method='post' enctype='multipart/form-data' action='sales_reseller_point.php'> 
					    				<input type='hidden' name='mode' value='pay_inup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
					
					// $body = str_replace("{banklist}","우리은행 560-273083-02-001 이호진",$body);
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
					///////////////		
					
					
					$body = str_replace("{money}","<input type='text' name='money' $cssFormStyle placeholder='입금금액'>",$body);
					$body = str_replace("{name}","<input type='text' name='name' $cssFormStyle placeholder='입금자명'>",$body);
					$body = str_replace("{submit}","<input type='submit' name='reg' value='입금확인' $btn_style_blue>",$body);
						
					break;
				default:
					//# 스킨 레이아웃 	
					$body = shopskin("sales_reseller_point");
					$body = str_replace("{resellerpoint}","<a href='sales_reseller_point.php'>$MEM[resellerpoint]</a>",$body);
			
					$body = str_replace("{pay_in}",_button_blue("입금","sales_reseller_point.php?mode=pay_in"),$body); 
					$body = str_replace("{pay_out}",_button_blue("출금","sales_reseller_point.php?mode=pay_out"),$body); 
					$body = str_replace("{pay_auth}",_button_green("입금승인","sales_reseller_point.php?mode=pay_authlist"),$body); 
			
					/// 리셀러 적립금 사용내역
					$query = "select * from sales_reseller_point where reseller = '$MEM[email]'  order by regdate desc";
    				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
				
					//echo $query."<br>";
				
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					for($i=0;$i<$total;$i++){
	    					$rows=mysql_fetch_array($result);

							$listform = bodyskin("sales_reseller_point_list",$_SESSION['mobile'],$_SESSION['language']);
							$listform = str_replace("{regdate}","$rows[regdate]","$listform");
							$listform = str_replace("{title}","$rows[subject]","$listform");
							$listform = str_replace("{point_in}","$rows[money_in]","$listform");
							$listform = str_replace("{point_out}","$rows[money_out]","$listform");
							$listform = str_replace("{point}","$rows[balance]","$listform");
			
							$list .= $listform;	
								
								
	    				}
	  	
	  					$body = str_replace("{datalist}",$list,$body);
	    			} else {
	    				$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{nodata}","적립금 포인트 거래내역이 없습니다.",$listform);
	    				$body=str_replace("{datalist}",$listform,$body);
	    			}
	    			
	    			break;

				
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
