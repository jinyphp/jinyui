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

		
			//////////////////////////////////////////////////////////////////
		
		
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    		
    	switch($mode){
    		case 'editup':
    				$company = $_POST['company'];
					$biznumber = $_POST['biznumber']; // $biznumber = str_replace("-","",$biznumber);
					$president = $_POST['president']; 
					$post = $_POST['post'];
					$address = $_POST['address']; 
					$subject = $_POST['subject']; 
					$item = $_POST['item'];
    					
					$tel = $_POST['tel']; 
					$fax = $_POST['fax']; 
					$phone = $_POST['phone']; //  $phone = str_replace("-","",$phone);
					$email = $_POST['email']; 
					$manager = $_POST['manager'];
					$password = $_POST['password'];
	
					$memtype = $_POST['memtype']; 
		
					$country = $_POST['country1']; 
					$language = $_POST['language1']; 
		
					$currency = $_POST['currency']; 
					$taxrate = $_POST['taxrate']; 
	
					if(!$email) { msg_alert("오류! 이메일이 없습니다."); $error = "true"; }
					else if(!$manager) { msg_alert("오류! 담당자명이 없습니다."); $error = "true"; }
					else if(!$password) { msg_alert("비밀번호 없습니다."); $error = "true"; }
					
					
					if($email != $MEM[email]){
						// 관리자 등록된 이메일을 이용하여, 전체 로그인 이메일 중복검사
						$query = "select * from sales_manager where email = '$email'";
						$result=mysql_db_query($mysql_dbname,$query,$connect);
						if(  mysql_num_rows($result)  ) {
							$msg = "이미 사용하고 있는 $email로 변경할 수 없습니다.";
							msg_alert("$msg");
							$error = "true";
						}
					}
						
					if(!$error){
						
							$query="UPDATE `sales_members` SET `password`='$password', 
    						`email`='$email', `tel`='$tel', `fax`='$fax', `phone`='$phone', `manager`='$manager' WHERE `email`='$MEM[email]'";
    						mysql_db_query($mysql_dbname,$query,$connect);

							$query="UPDATE `sales_members` SET `company`='$company', `biznumber`='$biznumber', `president`='$president', 
    						`post`='$post', `address`='$address', `subject`='$subject', `item`='$item' WHERE `email`='$MEM[email]'";
    						mysql_db_query($mysql_dbname,$query,$connect);
    					
    					
    						//# 회원정보 수정시, 거래처 모두 기본 정보 자동 수정.
    						$query = "SELECT * FROM `sales_company_$MEM[Id]`";
    						// echo $query."<br>";
    						// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    						$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    						$total = mysql_result($result,0,0);
    						// $result=mysql_db_query($mysql_dbname,$query,$connect);
    						$result=mysql_db_query($server[dbname],$query,$dbconnect);
    						if( mysql_num_rows($result) ){ 				
								for($i=0;$i<$total;$i++){
	    							$COM=mysql_fetch_array($result);
	    							
	    							// 거래처 DB접속 정보 
									$query2 = "select * from `sales_server` where Id = '$COM[mem]'";
    								$result2=mysql_db_query($mysql_dbname,$query2,$connect);
									if(  mysql_num_rows($result)  )	{
										$_server=mysql_fetch_array($result2);
										$_dbconnect=mysql_connect($_server[ip],$_server[userid],$_server[password]) or die("user database can not connect.");
										
										
										$query1="UPDATE `sales_company_$COM[mem]` SET  `company`='$company', `biznumber`='$biznumber', `president`='$president', 
    										`post`='$post', `address`='$address', `subject`='$subject', `item`='$item',   
    										`email`='$email', `tel`='$tel', `fax`='$fax', `phone`='$phone', 
    										`country`='$country', `currency`='$currency', `vatrate`='$vatrate' WHERE `email`='$MEM[email]'";
    									mysql_db_query($_server[dbname],$query1,$_dbconnect);
    							
    									// echo $query1."<br>";
										
									}

	    						
	    							
	    						
	    						
    							}
    						}
    					
    						// 이메일을 변경한 경우, 쿠키 다시 설정
    						if( $email != $MEM[email] ) {
    							// 관리자 이메일 부분 갱신
    							$query1="UPDATE `sales_manager` SET  `email`='$email' WHERE `email`='$MEM[email]'";
    							mysql_db_query($mysql_dbname,$query1,$connect);
    							
    							// 거래처 DB 도 갱신
    							$query1="UPDATE `sales_company` SET  `email`='$email' WHERE `email`='$MEM[email]'";
    							mysql_db_query($mysql_dbname,$query1,$connect);
    							
    							setcookie("email",$email,0,"/");
    						
    							if($_COOKIE[manager] == $MEM[email] ) setcookie("manager",$email,0,"/");
    						}
    		
    				}
    					
    				echo "<meta http-equiv='refresh' content='0; url=sales_main.php'>";
					break;
					
    				

    		default:
    			$body = shopskin("sales_member_edit");
    			
    			
			
    				$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_members_edit.php'> 
										<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
		
					$body=str_replace("{country}",form_country1($MEM['country']),$body);	
					$body = str_replace("{language}",form_language1($MEM['language']),$body);
		
		
					$query1 = "select * from `sales_currency`";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if( mysql_num_rows($result) ) {
						$currency = "<select name='currency' $cssFormStyle>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
							if($MEM[currency] == $rows1[currency]) $currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
							else $currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
						}
						$body = str_replace("{currency}",$currency,$body);
					}					
					//$body = str_replace("{currency}","<input type='text' name='currency' $cssFormStyle>",$body);
					$body = str_replace("{taxrate}","<input type='text' name='taxrate' value='$MEM[taxrate]' $cssFormStyle>",$body);
			
					$body = str_replace("{company}","<input type='text' name='company' value='$MEM[company]' $cssFormStyle>",$body);
					$body = str_replace("{biznumber}","<input type='text' name='biznumber' value='$MEM[biznumber]' $cssFormStyle>",$body);

					$body = str_replace("{president}","<input type='text' name='president' value='$MEM[president]' $cssFormStyle>",$body);
					$body = str_replace("{post}","<input type='text' name='post' value='$MEM[post]' $cssFormStyle>",$body);
					$body = str_replace("{address}","<input type='text' name='address' value='$MEM[address]' $cssFormStyle>",$body);
					$body = str_replace("{subject}","<input type='text' name='subject' value='$MEM[subject]' $cssFormStyle>",$body);
					$body = str_replace("{item}","<input type='text' name='item' value='$MEM[item]' $cssFormStyle>",$body);
							
					$body = str_replace("{email}","<input type='text' name='email' value='$MEM[email]' $cssFormStyle>",$body);					
					$body = str_replace("{tel}","<input type='text' name='tel' value='$MEM[tel]' $cssFormStyle>",$body);
					$body = str_replace("{fax}","<input type='text' name='fax' value='$MEM[fax]' $cssFormStyle>",$body);
					$body = str_replace("{phone}","<input type='text' name='phone' value='$MEM[phone]' $cssFormStyle>",$body);
					$body = str_replace("{manager}","<input type='text' name='manager' value='$MEM[manager]' $cssFormStyle>",$body);
					$body = str_replace("{password}","<input type='text' name='password' value='$MEM[password]' $cssFormStyle>",$body);
					$body = str_replace("{password2}","<input type='text' name='password2' value='$MEM[password2]' $cssFormStyle>",$body);
	
					$body = str_replace("{r1}","<input type=radio name=memtype value=1 checked>",$body);
					$body = str_replace("{r2}","<input type=radio name=memtype value=2>",$body);
												
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $butten_style >",$body);
    				
    				//////////////////////////////////////////////////////////////////		
		
				
		
		
					
    	}
		
		/////////////////////////
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		
		echo $body;
    				
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);

?>

