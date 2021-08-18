<?php

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
    		case 'del':
    			$query = "DELETE FROM `sales_currency` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
    			// echo "<meta http-equiv='refresh' content='0; url=sales_currency.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    			
    			$currency = $_POST['currency'];
    			$currencyid = $_POST['currencyid'];
    			$currencyname = $_POST['currencyname'];
    			$enable = $_POST['enable'];
    			
				$currency_align = $_POST['currency_align'];
				$currency_mark = $_POST['currency_mark'];
				$currency_rate = $_POST['currency_rate'];			
				$dec_point = $_POST['dec_point'];
				
				if(!$currency) msg_alert("오류! 통화코드가 없습니다.");
    			else {

    				$query = "UPDATE `sales_currency` SET `currency`='$currency', `currencyid`='$currencyid', `name`='$currencyname', 
    				`currency_align`='$currency_align', `currency_mark`='$currency_mark', `currency_rate`='$currency_rate', `dec_point`='$dec_point',
    				`enable`='$enable'  WHERE `Id`='$UID'";
    				// echo $query ;
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}  
    			
    			// echo "<meta http-equiv='refresh' content='0; url=sales_currency.php'>";
    			page_back2();
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = shopskin("sales_currency_edit");
    			
						
    			$result=mysql_db_query($mysql_dbname,"select * from `sales_currency` where Id = '$UID'",$connect);
				if(  mysql_num_rows($result) ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='currency' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked  >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);
					
					$body = str_replace("{currency}","<input type='text' name='currency' value='$rows[currency]' $cssFormStyle >",$body);
					$body = str_replace("{currencyid}","<input type='text' name='currencyid' value='$rows[currencyid]'  $cssFormStyle >",$body);
					$body = str_replace("{currencyname}","<input type='text' name='currencyname' value='$rows[name]'  $cssFormStyle >",$body);
					
					$body = str_replace("{currency_align}","<input type='text' name='currency_align' value='$rows[currency_align]'  $cssFormStyle >",$body);
					$body = str_replace("{currency_mark}","<input type='text' name='currency_mark' value='$rows[currency_mark]'  $cssFormStyle >",$body);
					$body = str_replace("{currency_rate}","<input type='text' name='currency_rate' value='$rows[currency_rate]'  $cssFormStyle >",$body);
					$body = str_replace("{dec_point}","<input type='text' name='dec_point' value='$rows[dec_point]'  $cssFormStyle >",$body);
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $btn_style_blue >",$body);		
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_currencyedit.php?mode=del&UID=$UID\")' $btn_style_gray >",$body);
					
	
						
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

