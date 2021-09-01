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
	
	
	if(!isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
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
			
			$body = shopskin("sales_trans_report");
			
			
			$search = $_POST['search']; $company = $_POST['company']; 
			$inout = $_GET['inout']; if(!$inout) $inout = $_POST['inout'];
			
			$body=str_replace("{formstart}","<form name='company' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='inout' value='$inout'>
					    						 <input type='hidden' name='mode' value='search'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$body = str_replace("{company}","<input type='text' name='company' $cssFormStyle placeholder='거래처 검색'>",$body);	
			$body = str_replace("{submit}","<input type='submit' name='reg' $cssFormStyle value='검색' >",$body);
				
						
			//# 검색 QUERY 작성....	
			$query = "SELECT * FROM `sales_trans_$MEM[Id]` where trans = 'sell' and report IS NOT NULL order by report desc";
			//$result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    		
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 				
	    		
	    		$amount = 0;
	    		$report="";
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			if($report == "" && $report != $rows[report] ){
	    				$report = $rows[report];
	    				$amount = $rows[prices_total];
	    				$trans_list = "$rows[goodname] / $rows[num] <br>";
	    			} else if($report == $rows[report] && $i < ($total-1)){
	    				// 마지막 자료 아닐때, 처리
	    				$trans_list .= "$rows[goodname] / $rows[num] <br>";
	    				$amount += $rows[prices_total];
	    			} else if($report != $rows[report] || $i == ($total-1)){
						// 리포트값이 다음으로 넘어갈때, 또는 마지막 자료일때는 표시
						$trans_list .= "$rows[goodname] / $rows[num] <br>";
	    				$amount += $rows[prices_total];
	    				
						$listform = bodyskin("sales_trans_report_list",$_SESSION['mobile'],$_SESSION['language']);
	
						$query1 = "SELECT * FROM `sales_company_$MEM[Id]` where Id='$rows[UIDB]'";
						// $result1=mysql_db_query($mysql_dbname,$query1,$connect);
						$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ){ 				
	    					$coms=mysql_fetch_array($result1);
							$listform = str_replace("{company}","$coms[company]",$listform);
						} else $listform = str_replace("{company}","",$listform);
						
						$listform = str_replace("{trans}","<a href='sales_trans_sell_report.php?company_id=$rows[UIDB]&report=$report'>$trans_list</a>",$listform);
						$listform = str_replace("{amount}","$amount",$listform);
					
						$list .= $listform;	
					}
	    			
	    		}
	    	
				$body=str_replace("{datalist}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","출력 내역이 없습니다.",$listform);
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
