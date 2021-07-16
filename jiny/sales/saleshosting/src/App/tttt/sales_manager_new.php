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
	
	
	if( !isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {    
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
			$body = shopskin("sales_manager_new");
		
			//# 좌측 메뉴 트리구조 표시
			$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			$query = "select * from `sales_manager` group by part desc";
			$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){
    		
    			while(1){
    				$rows=mysql_fetch_array($result);
    				if($rows[part]) {

    					$query = "select count(*) from `sales_manager` where members_id = '$MEM[Id]' and `part` = '$rows[part]' ";
						$result1=mysql_db_query($mysql_dbname,$query,$connect);
    					$total=mysql_result($result1,0,0); 
    					if($total >0){
    						$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_manager.php?part=$rowscpart]'>$rows[part]</a> ($total)</font></td></tr>";
    					} else {
    						$leftBody .= "<tr><td width='5' valign='top'><font color='#3B5998' size='2'>▪</font></td>
    							  <td><font size=2><a href='sales_manager.php?part=$rows[part]'>$rows[part]</a></font></td></tr>";	
						}
    				} else break;
    			}
    						
    		}
			$leftBody .= "</table>";
			$body = str_replace("{manager_parts}","$leftBody ",$body);
			

    		$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());   		
    		$body=str_replace("{formstart}","<form name='manager' method='post' enctype='multipart/form-data' action='sales_manager_newup.php'> 
										<input type='hidden' name='nonce' value='$nonce'>					    				
					    				<input type='hidden' name='mode' value='new'>",$body);
			$body = str_replace("{formend}","</form>",$body);
				
			
			$body = str_replace("{email}","<input type='text' name='email' $cssFormStyle placeholder='이메일'>",$body);	
			$body = str_replace("{password}","<input type='text' name='password' $cssFormStyle placeholder='암호'>",$body);
			
			$body = str_replace("{manager}","<input type='text' name='manager' $cssFormStyle placeholder='담당자'>",$body);
			$body = str_replace("{phone}","<input type='text' name='phone' $cssFormStyle placeholder='전화번호'>",$body);
			$body = str_replace("{fax}","<input type='text' name='fax' $cssFormStyle placeholder='팩스'>",$body);
			$body = str_replace("{mobile}","<input type='text' name='mobile' $cssFormStyle placeholder='핸드폰'>",$body);
			$body = str_replace("{parts}","<input type='text' name='part' $cssFormStyle placeholder='부서'>",$body);
			
			$body = str_replace("{comment}","<textarea name='comment' rows='10' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='메모'></textarea>",$body);
		
			$body = str_replace("{chk_goods}","<input type='checkbox' name='chk_goods' $rows[chk_goods]>",$body);
			$body = str_replace("{chk_com}","<input type='checkbox' name='chk_com' $rows[chk_com]>",$body);
			$body = str_replace("{chk_sell}","<input type='checkbox' name='chk_sell' $rows[chk_sell]>",$body);
			$body = str_replace("{chk_sell_auth}","<input type='checkbox' name='chk_sell_auth' $rows[chk_sell_auth]>",$body);
			$body = str_replace("{chk_buy}","<input type='checkbox' name='chk_buy' $rows[chk_buy]>",$body);
			$body = str_replace("{chk_buy_auth}","<input type='checkbox' name='chk_buy_auth' $rows[chk_buy_auth]>",$body);
			$body = str_replace("{chk_pay}","<input type='checkbox' name='chk_pay' $rows[chk_pay]>",$body);
			$body = str_replace("{chk_user}","<input type='checkbox' name='chk_user' $rows[chk_user]>",$body);
			$body = str_replace("{chk_b2b}","<input type='checkbox' name='chk_b2b' $rows[chk_b2b]>",$body);
			$body = str_replace("{chk_report}","<input type='checkbox' name='chk_report' $rows[chk_report]>",$body);		
			
						
			$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $butten_style >",$body);
			$body = str_replace("{login}","",$body);			
			$body = str_replace("{delete}","",$body);
    			
		
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);	

?>

