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
    	// echo $query; 
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
			$company_id = $_POST['company_id']; if(!$company_id) $company_id = $_GET['company_id'];
			$start = $_POST['start'];  if(!$start) $start = $_GET['start'];
			$end = $_POST['end']; if(!$end) $end = $_GET['end'];
			
			$body = shopskin("sales_payment_in");
			$body = str_replace("{new1}",_button_blue("입금등록","sales_payment_edit.php?company_id=$company_id&paymode=1"),$body);
			$body = str_replace("{new2}",_button_blue("출금등록","sales_payment_edit.php?company_id=$company_id&paymode=2"),$body);
			
			$body = str_replace("{print}",_button_green("인쇄","sales_payment_print.php"),$body);
			$body = str_replace("{download}",_button_green("다운로드","sales_payment_download.php"),$body);
			

			
			if($_POST['company_search']){
			//# 거래처 검색
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$query = "select * from `sales_company_$MEM[Id]` where company like '%".$_POST['company_search']."%'";
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);

    			$total = mysql_result($result,0,0);
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
						$listform = bodyskin("sales_payment_search",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{companylist}","<a href='".$_SERVER['PHP_SELF']."?company_id=$rows[Id]&start=$start&end=$end'>$rows[company]</a>","$listform");
						$companylist .= $listform;
					}
				}
				// $companylist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
				$body = str_replace("{company_list}",$companylist,$body);
				

			} else {
				$listform = bodyskin("sales_payment_search",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{companylist}","검색된 거래처가 없습니다.","$listform");
				$body = str_replace("{company_list}",$listform,$body);		
			}
			
			if($company_id){
				$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
				// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
				$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    			if( mysql_num_rows($result) ){
    				$rows1=mysql_fetch_array($result1);
    				$body = str_replace("{company_name}","$rows1[company]",$body);
    			} else $body = str_replace("{company_name}","등록되지 않은 거래처 입니다.",$body);
			} else $body = str_replace("{company_name}","거래처를 검색 또는 선택해 주세요.",$body);
			
			///////////////////////////////
			
			$body = str_replace("{formstart}","<form name='payment' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='company_id' value='$company_id'>
					    						 <input type='hidden' name='mode' value=''>",$body);
			$body = str_replace("{formend}","</form>",$body);
			
			$body = str_replace("{company}","<input type='text' name='company_search' $cssFormStyle placeholder='거래처'>",$body);
			$body = str_replace("{search}","<input type='submit' name='reg' value='검색' $btn_style_gray>",$body);
			
			if($start){			
				$body = str_replace("{start}","<input type='date' name='start' value='$start' $cssFormStyle onChange=\"javascript:submit()\" >",$body);		
			} else $body = str_replace("{start}","<input type='date' name='start' value='$TODAY' $cssFormStyle onChange=\"javascript:submit()\" >",$body);
			
			if($end){
				$body = str_replace("{end}","<input type='date' name='end' value='$end' $cssFormStyle onChange=\"javascript:submit()\" >",$body);
			} else $body = str_replace("{end}","<input type='date' name='end' value='$TODAY' $cssFormStyle onChange=\"javascript:submit()\" >",$body);
			
			
			//# 입금내역 출력
			if($company_id) $query = "select * from sales_trans_$MEM[Id] where ( trans = 'sell_payin' or trans = 'buy_payin' ) and UIDB = '$company_id' "; //
			else $query = "select * from sales_trans_$MEM[Id] where ( trans = 'sell_payin' or trans = 'buy_payin' ) "; //
			
			if($start && $end)
			$query .= " and transdate >= '".$start."' and transdate <= '".$end."' ";
			else $query .= " and transdate >= '".$TODAY."' and transdate <= '".$TODAY."' ";
			
			$query .= " order by transdate desc, Id desc";
			// echo $query;
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 				
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_payment_in_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{paydate}","$rows[paydate]",$listform );
					
					$query1 = "select * from `sales_company_$MEM[Id]` where Id = '$rows[UIDB]'";
					// $result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					$result1 = mysql_db_query($server[dbname],$query1,$dbconnect);
    				if( mysql_num_rows($result1) ){
    					$rows1=mysql_fetch_array($result1);
    					$listform = str_replace("{company_name}","<a href='sales_payment_edit.php?mode=edit&TID=$rows[Id]'>$rows1[company]</a>",$listform );
    				} else $listform = str_replace("{company_name}","",$listform );
					
					$listform = str_replace("{payment}","$rows[payment]",$listform );
					
					if($rows[trans] == "sell_payin") $listform = str_replace("{balance1}","$rows[paymoney]",$listform );
					else $listform = str_replace("{balance1}","",$listform );
					
					if($rows[trans] == "buy_payin") $listform = str_replace("{balance2}","$rows[paymoney]",$listform );
					else $listform = str_replace("{balance2}","",$listform );
					
					$listform = str_replace("{balance}","",$listform );
					
					$list .= $listform;	
	    		}
	    		$body=str_replace("{datalist}",$list,$body);
	    		
	    	} else {
				$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","검색된 거래내역이 없습니다.",$listform);
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

