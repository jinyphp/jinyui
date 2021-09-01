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
				case 'del':
					$query ="DELETE FROM `sales_reseller` WHERE mem = '$MEM[email]' and `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    				echo "<meta http-equiv='refresh' content='0; url=sales_reseller.php'>";
					break;
					
				case 'editup':
					$title = $_POST['title'];
    				$priod = $_POST['priod']; 
    				$comcount = $_POST['comcount']; 
    				$transcount = $_POST['transcount']; 
    				$prices = $_POST['prices']; 
    				$discount = $_POST['discount'];
    				$comment = $_POST['comment']; 
    						
    				if(!$title) msg_alert("서비스 제목명이 없습니다.");
    				else if(!$comcount) msg_alert("최대 거래처 보유수 설정이 없습니다.");
    				else if(!$transcount) msg_alert("월 거래전표 입력건수 설정이 없습니다.");
    				else if(!$prices) msg_alert("서비스 가격 설정이 없습니다.");
					else {
    					$query ="UPDATE `sales_reseller` SET `title`='$title', `priod`='$priod', `comcount`='$comcount', `transcount`='$transcount', 
													`chargeprices`='$prices', `discount`='$discount', `comment`='$comment' WHERE `Id`='$UID'";
						mysql_db_query($mysql_dbname,$query,$connect);
					}
					echo "<meta http-equiv='refresh' content='0; url=sales_reseller.php'>";
				
					break;
					
				case 'edit':

					$query = "select * from sales_reseller where Id = '$UID'";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){ 
	    				$rows=mysql_fetch_array($result);
	    				
						//# 스킨 레이아웃 	
						$body = shopskin("sales_reseller_new");
						
	    				$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_reseller_new.php'> 
										<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);
						
						$FORM_priod ="<select name='priod' id='priod' $cssFormStyle>
									  <option value='1'>1개월</option>
									  <option value='3'>3개월</option>
									  <option value='6'>6개월</option>
									  <option value='12'>12개월</option>
									  <option value='24'>24개월</option>
									  <option value='36'>36개월</option>
									  </select>"; 
						$FORM_priod = str_replace("'$rows[priod]'","'$rows[priod]' selected=\"selected\"",$FORM_priod);		  
						$body = str_replace("{priod}",$FORM_priod,$body);
						$body = str_replace("{title}","<input type='text' name='title' value='$rows[title]' $cssFormStyle placeholder='서비스명'>",$body);
						
						$body = str_replace("{comcount}","<input type='text' name='comcount' value='$rows[comcount]' $cssFormStyle placeholder='총 거래처 보유수'>",$body);
						$body = str_replace("{transcount}","<input type='text' name='transcount' value='$rows[transcount]' $cssFormStyle placeholder='월 거래횟수'>",$body);

						$body = str_replace("{prices}","<input type='text' name='prices' value='$rows[chargeprices]' $cssFormStyle placeholder='서비스가격'>",$body);
						$body = str_replace("{discount}","<input type='text' name='discount' value='$rows[discount]' $cssFormStyle placeholder='할인금액%'>",$body);
						
						$body = str_replace("{comment}","<textarea name='comment' rows='4' cols='35'>$rows[comment]</textarea>",$body);
						
						
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $btn_style_blue>",$body);
						$body = str_replace("{delete}",_button_gray("삭제","sales_reseller_new.php?mode=del&UID=$rows[Id]"),$body); 
						// $body = str_replace("{delete}","<a href='sales_reseller_new.php?mode=del&UID=$rows[Id]'>삭제</a>",$body);
						// $body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"sales_reseller_new.php?mode=del&UID=$rows[Id]\")' style='font-size:9pt'>",$body);
					}
					break;
							
				case 'newup':
					if($_SESSION['nonce'] == $_POST['nonce']){
    					$title = $_POST['title'];
    					$priod = $_POST['priod']; 
    					$comcount = $_POST['comcount']; 
    					$transcount = $_POST['transcount']; 
    					$prices = $_POST['prices']; 
    					$discount = $_POST['discount'];
    					$comment = $_POST['comment']; 
    						
    					if(!$title) msg_alert("서비스 제목명이 없습니다.");
    					else if(!$comcount) msg_alert("최대 거래처 보유수 설정이 없습니다.");
    					else if(!$transcount) msg_alert("월 거래전표 입력건수 설정이 없습니다.");
    					else if(!$prices) msg_alert("서비스 가격 설정이 없습니다.");
						else {
    						$query ="INSERT INTO `sales_reseller` (`regdate`, `mem`, `title`, `priod`, `comcount`, `transcount`, `chargeprices`, `discount`, `comment`) 
    						VALUES ('$TODAYTIME', '$MEM[email]', '$title', '$priod', '$comcount', '$transcount', '$prices', '$discount', '$comment')";
							
							// echo "$query <br>";
							
							mysql_db_query($mysql_dbname,$query,$connect);
						}
						

    				}
    				echo "<meta http-equiv='refresh' content='0; url=sales_reseller.php'>";
    				$_SESSION['nonce'] = NULL;
					break;
					
				default:
					$_SESSION['nonce'] = $nonce = md5('salt'.microtime());
					
					//# 스킨 레이아웃 	
					$body = shopskin("sales_reseller_new");
					
					$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_reseller_new.php'> 
										<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
						
					$FORM_priod ="<select name='priod' id='priod' $cssFormStyle >
									  <option value='1'>1개월</option>
									  <option value='3'>3개월</option>
									  <option value='6'>6개월</option>
									  <option value='12'>12개월</option>
									  <option value='24'>24개월</option>
									  <option value='36'>36개월</option>
									  </select>"; 
					$body = str_replace("{priod}",$FORM_priod,$body);
					$body = str_replace("{title}","<input type='text' name='title' $cssFormStyle placeholder='서비스명'>",$body);
						
					$body = str_replace("{comcount}","<input type='text' name='comcount' $cssFormStyle  placeholder='총 거래처 보유수'>",$body);
					$body = str_replace("{transcount}","<input type='text' name='transcount' $cssFormStyle  placeholder='월 거래횟수'>",$body);

					$body = str_replace("{prices}","<input type='text' name='prices' $cssFormStyle  placeholder='서비스가격'>",$body);
					$body = str_replace("{discount}","<input type='text' name='discount' $cssFormStyle  placeholder='할인금액%'>",$body);
						
					$body = str_replace("{comment}","<textarea name='comment' rows='4' cols='35'></textarea>",$body);
						
						
					$body = str_replace("{submit}","<input type='submit' name='reg' value='등록' $btn_style_blue>",$body);
					$body = str_replace("{delete}","",$body);
					
			
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

