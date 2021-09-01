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
			
			if($mode == "renewal"){
				$REID = $_GET['REID'];
				
				$query = "select * from sales_reseller_order where Id = '$REID'";
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
    			if( mysql_num_rows($result) ){
    							
	    			$rows=mysql_fetch_array($result);
	    			
	    			// 주문 연장승인으로 변경..
	    			$query = "UPDATE `sales_reseller_order` SET `orderauth`='renewal' WHERE `Id`='$REID'";
					mysql_db_query($mysql_dbname,$query,$connect);
	    			
	    			// 연장비용 차감
	    			$resellerpoint = $MEM[resellerpoint] - $rows[prices] * 0.8;
					$query = "UPDATE `sales_members` SET `resellerpoint`='$resellerpoint' WHERE `email`='$MEM[email]'";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					// 연장비용 차감 내역 작성
					$money_out = $rows[prices] * 0.8;
					$query = "INSERT INTO `sales_reseller_point` (`regdate`, `reseller`, `mem`, `subject`, `money_out`, `money_in`, `balance`) 
								VALUES ('$TODAYTIME', '$rows[reseller]', '$rows[mem]', '$rows[title]', '$money_out', '', '$resellerpoint')";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					/*
					// 상위 리셀러 10% 적립금 지급...
					$result=mysql_db_query($mysql_dbname,"select * from `sales_members`  where email = '$rows[reseller]'",$connect);
					if(  mysql_num_rows($result)  ){ 
		    			$RRR1=mysql_fetch_array($result);
		    						
		    			$money_in = $rows[prices] * 0.1;
		    			$balancepoint = __sales_reseller_saveRebate($RRR1[reseller],$money_in);
		    						
		    			$query = "INSERT INTO `sales_reseller_point` (`regdate`, `reseller`, `albacode`, `subject`, `money_out`, `money_in`, `balance`) 
						VALUES ('$TODAYTIME', '$RRR1[reseller]', '$RRR1[albacode]', '리셀러 판매적립 from $RRR1[albacode]', '', '$money_in', '$balancepoint')";
						mysql_db_query($mysql_dbname,$query,$connect);
		    						
		    		}	
					*/
					
					// 고객부분 기간연장...
					// $priod = $rows[priod] * 30;
					// $expire = date('Y-m-d', strtotime("+$priod days"));
					$ex =  explode ("-",$MEM[expire]);
					$ex[1] += $rows[priod]; if($ex[1]>12) { $ex[1] -= 12; $ex[0] +=1; }
					$expire = "$ex[0]-$ex[1]-$ex[2] 00:00:00";	
							
					$query = "UPDATE `sales_members` SET `maxcompany`='$rows[comcount]', `maxtrans`='$rows[transcount]' , `paydate`='$TODAYTIME' , `expire`='$expire', `memtype`='$rows[title]' WHERE `Id`='$rows[mem]'";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					// echo $query."<br>";
					
						
				}
					
				
			
			}
			
			
			//# 스킨 레이아웃 	
			$body = shopskin("sales_reseller_order");
			$body = str_replace("{resellerpoint}","<a href='sales_reseller_point.php'>$MEM[resellerpoint]</a>",$body);
			
			/// 리셀러 가격표
			$query = "select * from sales_reseller_order where reseller = '$MEM[email]' order by regdate desc";
    		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
				
			//echo $query."<br>";
				
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){
    			for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);

					$listform = bodyskin("sales_members_renewal_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{regdate}","$rows[regdate]","$listform");
					
					$listform = str_replace("{service}","$rows[title] / $rows[priod] 개월/ $rows[comcount] / $rows[transcount]","$listform");
					$listform = str_replace("{prices}","$rows[prices]","$listform");
								
				
					if( $rows[orderauth] == "ordered" ) $listform = str_replace("{status}","<a href='sales_reseller_order.php?mode=renewal&REID=$rows[Id]&nonce=$nonce'>연장승인</a>","$listform");
					else if( $rows[orderauth] == "renewal" ) $listform = str_replace("{status}","승인완료","$listform");				

			
					$list .= $listform;	
								
								
	    		}
	  	
	  			$body = str_replace("{datalist}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","유료 연장내역이 없습니다.",$listform);
	    		$body=str_replace("{datalist}",$listform,$body);
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
