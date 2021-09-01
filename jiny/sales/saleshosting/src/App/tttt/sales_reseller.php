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
			
			//# 스킨 레이아웃 	
			$body = shopskin("sales_reseller");
			
			$body = str_replace("{new}",_button_blue("상품설계","sales_reseller_new.php"),$body); 

			
			
			/// 리셀러 가격표
			$body = str_replace("{reseller}","<a href='sales_membersedit.php?mode=service'>$MEM[company]</a>",$body);
			$body = str_replace("{resellerpoint}","적립금 <a href='sales_reseller_point.php'>$MEM[resellerpoint]</a>",$body);		
					
				
				
			$query = "select * from sales_reseller where mem = '$MEM[email]' order by title desc, priod asc";
    		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
				
			//echo $query."<br>";
				
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){
    			for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_reseller_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{service_name}","<a href='sales_reseller_new.php?mode=edit&UID=$rows[Id]'><b>$rows[title]</b></a>","$listform");
					$listform = str_replace("{service_priod}","$rows[priod]","$listform");
					$listform = str_replace("{max_company}","$rows[comcount]","$listform");
					$listform = str_replace("{max_trans}","$rows[transcount]","$listform");
								
					$listform = str_replace("{chargeprices}","$rows[chargeprices]","$listform");
					$discount = str_replace("%","",$rows[discount]);
					$listform = str_replace("{discount}","할인율:$discount%","$listform");
					$prices = $rows[chargeprices] * (100-$discount)/100;
					$listform = str_replace("{prices}","$prices","$listform");
													
					$list .= $listform;	
	    			
	    			
					/*
					$listform = bodyskin("sales_members_renewal_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{regdate}","$rows[regdate]","$listform");
					
					$listform = str_replace("{service}","$rows[title] / $rows[priod] 개월/ $rows[comcount] / $rows[transcount]","$listform");
					$listform = str_replace("{prices}","$rows[prices]","$listform");
								
					$listform = str_replace("{status}","$rows[orderauth]","$listform");
								
					$list .= $listform;	
					*/
					
					// 리셀러 상품만들기
					/*
					$list = "<table border='0' cellspacing='2' cellpadding='2' width=100%><tr>
							  <td width='30'><img src='./images/service.gif' border=0 width=30></td><td>";
							
								$list .= "<table border='0' cellspacing='2' cellpadding='2' width=100%><tr>";
								$list .=  "<td><font size='2'><a href='sales_reseller_new.php?mode=edit&UID=$rows[Id]'><b>$rows[title]</b></a> $rows[priod]".multiString_conv("ko","개월",$LANG)."</font></td>";
							
								$list .=  "</td></tr></table>";
							
								$list .=  "<table border='0' cellspacing='2' cellpadding='2'>";
								$list .=  "<tr><td width='100'><font size='2'>".multiString_conv("ko","최대 거래처수",$LANG)." :</font></td><td><font size='2'>$rows[comcount] 건</font></td></tr>";
								$list .=  "<tr><td width='100'><font size='2'>".multiString_conv("ko","월 전표거래수",$LANG)." :</font></td><td><font size='2'>$rows[transcount] 건</font></td></tr>";
								$list .=  "</table>";
							
								if($rows[comment]){
									$list .=  "<table border='0' cellspacing='2' cellpadding='2' width=100%><tr>";
									$list .=  "<td><font size='2'>$rows[comment]</font></td>";
									$list .=  "</td></tr></table>";
								}
							
								$list .=  "</td><td width='100'>";
						
								$list .=  "<table border='0' cellspacing='2' cellpadding='2' width=100%>";

								if($rows[discount]) {
									$discount = str_replace("%","",$rows[discount]);
									$list .=  "<tr><td width='100'><font size='2'>$rows[chargeprices]</font></td></tr>";
									$list .=  "<tr><td width='100'><font size='2'>(".multiString_conv("ko","할인율",$LANG).":$discount%)</font></td></tr>";
									$prices = $rows[chargeprices] * (100-$discount)/100;
									$list .=  "<tr><td width='100'><font color='#FF0000' size='2'><b>$prices</b></font></td></tr>";
								} else $list .=  "<tr><td width='100'><font color='#FF0000' size='2'><b>$rows[chargeprices]</b></font></td></tr>";
						
								$list .=  "</table>";
							
							$list .=  "</td></tr></table>";
							
							$databody .= "<table border='0' cellspacing='1' cellpadding='1' width=100% bgcolor='#ffffff'><tr><td>$list</td></tr></table>";
							$databody .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";			
						*/		
	    		}
	  	
	  			$body = str_replace("{databody}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","서비스 판매 상품이 업습니다.",$listform);
	    		$body=str_replace("{databody}",$listform,$body);
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
