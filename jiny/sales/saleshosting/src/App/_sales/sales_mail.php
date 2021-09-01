<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
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
	
	
	// echo "sales main<br>";
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
		// echo $query."<br>";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if( mysql_affected_rows() ){ 
			$MEM=mysql_fetch_array($result);
			
			///////////////////////////
			
			$a = mail("infohojin@naver.com","제목","내용");
			
			/*
			$limit = 10;  // 첨부파일 제한 용량 (단위:MB)
 			//#### 에러 발생시 back("에러문",이동할 페이지수) 함수를 사용하여 에러출력 후 지정한 페이지 수만큼 뒤로 이동함 ###
 		

 	
 						// $to 값이 공백일 경우 에러출력 후 한페이지 뒤로 이동
 						if(!ereg("([^[:space:]]+)",$to)) {
  							back("메일을 받는사람의 메일주소가 필요합니다.");
  							exit;
 						}
 	
	 					// $to 값이 정확한 이메일 주소가 아닐 경우 에러출력 후 한페이지 뒤로 이동
	 					if(!ereg("([a-zA-Z0-9,_]{2,15})@([a-zA-Z0-9]{2,15}).([a-zA-Z0-9]{2,15})", $to, $regs)) {
	  						back("받는사람의 Email 주소 형식이 틀립니다. [예] yourmail@server.domain");
	  						exit;
	 					}
 	
	 					// $subject 값이 공백일 경우 에러출력 후 한페이지 뒤로 이동
	 					if(!ereg("([^[:space:]]+)",$subject)) {
	  						back("메일 제목이 없습니다. 메일 제목을 입력해 주십시오.");
	  						exit;
	 					}
 

	
	 					$boundary = "----".uniqid("part"); // 이메일 내용 구분자 설정
						//## 헤더생성 ##
	 					$header .= "Return-Path: $from\r\n";    // 반송 이메일 주소
	 					$header .= "From: $from\r\n";      // 보내는 사람 이메일 주소
	 					$header .= "MIME-Version: 1.0\r\n";    // MIME 버전 표시
	 					$header .= "Content-Type: Multipart/mixed; boundary = \"$boundary\"";  // 구분자가 $boundary 임을 알려줌

						//## 여기부터는 이메일 본문 생성 ##
	 					$mailbody .= "This is a multi-part message in MIME format.\r\n\r\n";  // 메세지
	 					$mailbody .= "--$boundary\r\n";               // 내용 구분 시작
						//내용이 일반 텍스트와 html 을 사용하며 한글이라고 알려줌
	 					$mailbody .= "Content-Type: text/html; charset=\"ks_c_5601-1987\"\r\n";
						//암호화 방식을 알려줌
	 					$mailbody .= "Content-Transfer-Encoding: base64\r\n\r\n";
						//이메일 내용을 암호화 해서 추가
	 					$mailbody .= base64_encode(nl2br($body))."\r\n\r\n";


					//## 첨부 파일 개수만큼 루프를 돌면서 본문에 추가함 ##
 					for($i=1;$i<=5;$i++) {
 						

  						if($rows["filename".$i]) {
  
	   						$file = FileLoad($rows["filename".$i]);
	   						
	   						$filename = basename($rows["filename".$i]); 
   
	   						// 파일첨부파트
	   						$mailbody .= "--$boundary\r\n";     // 내용 구분자 추가
	 						// 여기부터는 어떤 내용이라는 것을 알려줌
	   						$mailbody.= "Content-Type: ".$rows["filename".$i]."; name=\"".$filename."\"\r\n";
	 						//암호화 방식을 알려줌
	   						$mailbody .= "Content-Transfer-Encoding: base64\r\n";
	 						// 첨부파일임을 알려줌
	   						$mailbody .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	 						// 파일 내요을 암호화 하여 추가
	   						$mailbody .= base64_encode($file)."\r\n\r\n";
	  					}
	 				}

					


					
					// ## 첨부 파일 개수만큼 루프를 돌면서 본문에 추가함 ##
 					for($i=0;$i<count($userfile);$i++) {
  						if($userfile[$i]) {
 			
	 						// $limit 으로 설정한 용량 보다 클경우 에러 출력 후 뒤로 이동
	   						if($userfile_size[$i] > ($limit * 1024 * 1024)) {
	    						back(($i+1)."번째 첨부파일이 제한용량(".$limit."MB)을 초과하였습니다.");
	    						exit;
	   						}
   
	   						$filename = basename($userfile_name[$i]);  // 파일명만 추출 후 $filename에 저장
	   						$fp = fopen($userfile[$i], "r");     // 파일 open
	   						$file = fread($fp, $userfile_size[$i]);  // 파일 내용을 읽음
	   						fclose($fp);           // 파일 close
	   						
	   						echo " filetype $userfile_type[$i]<br>";
   
	   						// 파일첨부파트
	   						$mailbody .= "--$boundary\r\n";     // 내용 구분자 추가
	 						// 여기부터는 어떤 내용이라는 것을 알려줌
	   						$mailbody.= "Content-Type: ".$userfile_type[$i]."; name=\"".$filename."\"\r\n";
	 						//암호화 방식을 알려줌
	   						$mailbody .= "Content-Transfer-Encoding: base64\r\n";
	 						// 첨부파일임을 알려줌
	   						$mailbody .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	 						// 파일 내요을 암호화 하여 추가
	   						$mailbody .= base64_encode($file)."\r\n\r\n";
	  					}
	 				}
	 				
	 				
 
 
				

 					if(!mail($to,addslashes($subject),$mailbody,$header)) back("이메일 발송해 실패 하였습니다.");
 					else echo "<script>alert('메일을 발송하였습니다.');</script>";
 					
 					
 				*/	
 					
 					
			
			
			
			
			
			/*
			
			$customer = $_GET['customer']; if(!$customer) $customer = $_POST['customer'];
				$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
				$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];

				if($mode=='mailsend') { // $mode 값이 mailsend 일 경우 아래 내용 실행
				$result=mysql_db_query($mysql_dbname,"select * from `phone_customer_phone` where Id = '$UID'",$connect);
					if( mysql_affected_rows() ){ 
					   	$rows=mysql_fetch_array($result);
					   	
						
 					

					echo "<meta http-equiv='refresh' content='0; url=phone_customer_phonenew.php?mode=paper&customer=$customer&UID=$UID'>";
				}
				} else {  // $mode 값이 mailsend 가 아닐경우 아래 내용 실행
				
					$result=mysql_db_query($mysql_dbname,"select * from `phone_customer_phone` where Id = '$UID'",$connect);
					if( mysql_affected_rows() ){ 
					   	$rows=mysql_fetch_array($result);
					    	
						$body = FileLoad("phone_order_mail.htm");
			    		$body=str_replace("{logout}","<a href='logout.php'>Logout</a>",$body);
			    		
			    		$result=mysql_db_query($mysql_dbname,"select * from `phone_customer` where Id = '$customer'",$connect);
							if( mysql_affected_rows() ){ 
					    		$CUSTOMER=mysql_fetch_array($result);
					    	
								$title = "<a href='phone_customer_new.php?mode=edit&UID=$customer'>$CUSTOMER[name]</a> | ";
								$title .= "<a href='phone_customer_phone.php?customer=$customer'>휴대폰정보</a></a> | ";
								$title .= "<a href='phone_customer_phonenew.php?mode=paper&customer=$customer&UID=$UID'>개통서류</a></a> |";
    							$body = str_replace("{title}","$title",$body);
							}

			    		
			    		
			    		$body=str_replace("{formstart}","<form name='form' method='post' enctype='multipart/form-data' action=''> 
										<input type='hidden' name='customer' value='$customer'>
										<input type='hidden' name='UID' value='$UID'>				    				
					    				<input type='hidden' name='mode' value='mailsend'>",$body);
						$body = str_replace("{formend}","</form>",$body);
							
			    		
			    		$body=str_replace("{to}","<input type='text' name='to' value='infohojin@naver.com' style='width:100%;margin:-3px;border:2px inset #eee'>",$body);
			    		$body=str_replace("{from}","<input type='text' name='from' value='infohojin@naver.com' style='width:100%;margin:-3px;border:2px inset #eee'>",$body);
			    		$body=str_replace("{subject}","<input type='text' name='subject' value='[개통서류접수] ***고객건.' style='width:100%;margin:-3px;border:2px inset #eee'>",$body);
			    		$body=str_replace("{body}","<textarea name='body' rows='10' style='width:100%;margin:-3px;border:2px inset #eee'></textarea>",$body);
			    		
			    		$body = str_replace("{submit}","<input type='submit' name='reg' value='메일발송' >",$body);
			    		$body = str_replace("{cancel}","<input type='reset' name='cancel' value='내용지우기'>",$body);
			    		
			    		echo $body;
			    		
					}
	
				}
	
	
	
			*/
			
			
			
			//////////////////////////////////////////////////////////////////		
		
		} else {
			// msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		}
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	
	
	
	
	
	

	
?>
