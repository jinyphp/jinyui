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
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
			
			switch($mode){
				case 'auth':
					$query = "select * from `sales_b2b` where b2b = 'on' and mem = '".$_GET['mem']."' and GID = '".$_GET['GID']."'";
					// echo $query."<br>";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){ 
	    				$rows=mysql_fetch_array($result);
	    			
	    				$query = "select * from `sales_b2b_$MEM[Id]` where b2b = '$rows[mem]' and GID = '$rows[GID]'";
						// echo $query."<br>"; 						
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ){ 
	    					
	    					// 내 리스트에 등록...
							$query = "UPDATE `sales_b2b_$MEM[Id]` SET `auth`='on'  where b2b = '$rows[mem]' and GID = '$rows[GID]' and type = 'in'";							
							// echo $query."<br>";
							// mysql_db_query($mysql_dbname,$query,$connect);
							mysql_db_query($server[dbname],$query,$dbconnect);
							
							// 상대방 승인 요청...
							$query = "UPDATE `sales_b2b_$rows[mem]` SET `auth`='on'  where b2b = '$rows[mem]' and GID = '$rows[GID]' and type = 'out'";
							//echo $query."<br>";
							// mysql_db_query($mysql_dbname,$query,$connect);
							mysql_db_query($server[dbname],$query,$dbconnect);
							
							// 상품등록...
							$query ="INSERT INTO `sales_goods_$MEM[Id]` (`regdate`, `mem`, `auth`, `GOODID`,  `name`,  `prices_buy`, `prices_sell`, `images`) 
    							VALUES ('$TODAY', '$rows[mem]', 'on', '$rows[mem]-$rows[GID]', '$rows[name]', '$rows[prices_buy]', '$rows[prices_sell]', '$rows[images]')";
    						//mysql_db_query($mysql_dbname,$query,$connect);			
							mysql_db_query($server[dbname],$query,$dbconnect);
						}
						
					}			
					
					echo "<meta http-equiv='refresh' content='0; url=".$_SERVER['PHP_SELF']."?mode=out'>";	
				
					break;
				case 'out':			
					$body = shopskin("sales_b2b_in_list");
					
					$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='company' value='$company'>
					    						 <input type='hidden' name='mode' value='search'>",$body);
					$body = str_replace("{formend}","</form>",$body);
				
					$body = str_replace("{goods}","<input type='text' name='goods' $cssFormStyle placeholder='검색 상품명'>",$body);	
					$body = str_replace("{submit}","<input type='submit' name='reg' $btn_style_gray value='검색' >",$body);
					$body = str_replace("{scan}",_button_green("바코드",""),$body);
					
					$body = str_replace("{b2b}",_button_gray("B2B","sales_b2b.php"),$body);
					$body = str_replace("{auth}",_button_gray("승인","sales_b2b_in.php?mode=out"),$body);
					$body = str_replace("{list}",_button_gray("목록","sales_b2b_in.php?mode=list"),$body);	
					
					$query = "select * from `sales_b2b_$MEM[Id]` where type = 'out' ";					
					$query .= " order by  Id desc";
					// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
					$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    				$total = mysql_result($result,0,0);
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ){ 
    				
						for($i=0;$i<$total;$i++){
	    					$rows=mysql_fetch_array($result);
	    			
	    					$listform = bodyskin("sales_b2b_list",$_SESSION['mobile'],$_SESSION['language']);
	
							if($rows[images]) $listform = str_replace("{images}","<img src='$rows[images]' border=0 width=50>","$listform");
							else $listform = str_replace("{images}","","$listform");
					
							$query1 = "select * from `sales_members` where Id = '$rows[b2b]'";
							$result1=mysql_db_query($mysql_dbname,$query1,$connect);
							if( mysql_num_rows($result1) ){
								$_mems=mysql_fetch_array($result1);
								if($_mems[company]) $listform = str_replace("{company}","$_mems[company]","$listform");
								else $listform = str_replace("{company}","$_mems[manager]","$listform");
							} else $listform = str_replace("{company}","","$listform");
					
							$listform = str_replace("{goodname}","$rows[goodname]",$listform);
							$listform = str_replace("{sell}","$rows[prices_sell]","$listform");
							$listform = str_replace("{buy}","$rows[prices_buy]","$listform");
							
							if($rows[auth]) $listform = str_replace("{b2b}","승인","$listform");
							else $listform = str_replace("{b2b}","<a href='".$_SERVER['PHP_SELF']."?mode=auth&mem=$rows[mem]&GID=$rows[GID]'>미승인</a>","$listform");
							
	    					$list .= $listform;
	    			
	    	
	    				}
	    		
	    				$body=str_replace("{databody}",$list,$body);
					} else {
	    				$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{nodata}","요청된 상품 승인이 없습니다.",$listform);
	    				$body=str_replace("{databody}",$listform,$body);
	    			}

					break;	
					
				case 'list':			
					$body = shopskin("sales_b2b_in_list");
					
					$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='company' value='$company'>
					    						 <input type='hidden' name='mode' value='search'>",$body);
					$body = str_replace("{formend}","</form>",$body);
				
					$body = str_replace("{goods}","<input type='text' name='goods' $cssFormStyle placeholder='검색 상품명'>",$body);	
					$body = str_replace("{submit}","<input type='submit' name='reg' $btn_style_gray value='검색' >",$body);
					$body = str_replace("{scan}",_button_green("바코드",""),$body);
					
					$body = str_replace("{b2b}",_button_gray("B2B","sales_b2b.php"),$body);
					$body = str_replace("{auth}",_button_gray("승인","sales_b2b_in.php?mode=out"),$body);
					$body = str_replace("{list}",_button_gray("목록","sales_b2b_in.php?mode=list"),$body);	
					
					$query = "select * from `sales_b2b_$MEM[Id]` where type = 'in' ";					
					$query .= " order by  Id desc";
					// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
					$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    				$total = mysql_result($result,0,0);
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ){ 
    				
						for($i=0;$i<$total;$i++){
	    					$rows=mysql_fetch_array($result);
	    			
	    					$listform = bodyskin("sales_b2b_list",$_SESSION['mobile'],$_SESSION['language']);
	
							if($rows[images]) $listform = str_replace("{images}","<img src='$rows[images]' border=0 width=50>","$listform");
							else $listform = str_replace("{images}","","$listform");
					
							$query1 = "select * from `sales_members` where Id = '$rows[b2b]'";
							$result1=mysql_db_query($mysql_dbname,$query1,$connect);
							if( mysql_num_rows($result1) ){
								$_mems=mysql_fetch_array($result1);
								if($_mems[company]) $listform = str_replace("{company}","$_mems[company]","$listform");
								else $listform = str_replace("{company}","$_mems[manager]","$listform");
							} else $listform = str_replace("{company}","","$listform");
					
							$listform = str_replace("{goodname}","$rows[goodname]",$listform);
							$listform = str_replace("{sell}","$rows[prices_sell]","$listform");
							$listform = str_replace("{buy}","$rows[prices_buy]","$listform");
							
							if($rows[auth]) $listform = str_replace("{b2b}","상품등록","$listform");
							else $listform = str_replace("{b2b}","승인대기","$listform");
							
	    					$list .= $listform;
	    			
	    	
	    				}
	    		
	    				$body=str_replace("{databody}",$list,$body);
					} else {
	    				$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{nodata}","입점된 상품이 없습니다.",$listform);
	    				$body=str_replace("{databody}",$listform,$body);
	    			}

					break;			
				case 'in_up':
			
					$query = "select * from `sales_b2b` where b2b = 'on' and Id = '$UID'";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){ 
	    				$rows=mysql_fetch_array($result);
	    				
	    				if($rows[mem] != $MEM[Id]){
	    			
	    					$query = "select * from `sales_b2b_$MEM[Id]` where b2b = '$rows[mem]' and GID = '$rows[GID]'";
							//echo $query."<br>"; 						
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ){ 
	    						msg_alert("오류! 등록 요청된 입점 상품 입니다.");
	    					} else {
	    						// 내 리스트에 등록...
								$query = "INSERT INTO `sales_b2b_$MEM[Id]` (`regdate`, `type`, `mem`, `b2b`, `GID`, `auth`, `goodname`,  `prices_sell`, `prices_buy`) 
									VALUES ('$TODAY', 'in', '$MEM[Id]', '$rows[mem]', '$rows[GID]', '', '$rows[name]',  '$rows[prices_sell]', '$rows[prices_buy]');";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);
								
								// 상대방 승인 요청...
								$query = "INSERT INTO `sales_b2b_$rows[mem]` (`regdate`, `type`, `mem`, `b2b`, `GID`, `auth`, `goodname`,  `prices_sell`, `prices_buy`) 
									VALUES ('$TODAY', 'out', '$MEM[Id]', '$rows[mem]', '$rows[GID]', '', '$rows[name]',  '$rows[prices_sell]', '$rows[prices_buy]');";
								// mysql_db_query($mysql_dbname,$query,$connect);
								mysql_db_query($server[dbname],$query,$dbconnect);						
						
							}
						
						} else msg_alert("오류! 자기상품은 입점할수 없습니다.");
						
						
					}			
					
					echo "<meta http-equiv='refresh' content='0; url=".$_SERVER['PHP_SELF']."?mode=list'>";					
					
					break;
				default:
			
				$body = shopskin("sales_b2b_in");
			
				$body = str_replace("{list}",_button_blue("입점목록","sales_b2b_in.php?mode=list"),$body);

				$query = "select * from `sales_b2b` where b2b = 'on' and Id = '$UID'";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
    			if( mysql_num_rows($result) ){ 
	    			$rows=mysql_fetch_array($result);
	    		
	    			if($rows[images]) $body = str_replace("{img}","<img src='$rows[images]' border=0 width=50>","$body");
					else $body = str_replace("{img}","","$body");
					
					$query1 = "select * from `sales_members` where Id = '$rows[mem]'";
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if( mysql_num_rows($result1) ){
						$_mems=mysql_fetch_array($result1);
						if($_mems[company]) $body = str_replace("{company}","$_mems[company]","$body");
						else $body = str_replace("{company}","$_mems[manager]","$body");
					} else $body = str_replace("{company}","","$body");
					
					$body = str_replace("{goodname}","$rows[name]",$body);
					$body = str_replace("{sell}","$rows[prices_sell]","$body");
					$body = str_replace("{buy}","$rows[prices_buy]","$body");

				}
				
				$body = str_replace("{submit}",_button_blue("승인요청",$_SERVER['PHP_SELF']."?mode=in_up&UID=$UID"),$body);
			
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
