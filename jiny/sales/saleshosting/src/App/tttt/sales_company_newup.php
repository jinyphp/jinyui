<?
	@session_start();
	if($_SESSION['nonce'] != $_POST['nonce']){
		$_SESSION['nonce'] = NULL;	
	} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능

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
			
    			$albaCode = $_COOKIE[albaCode];
    			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    			$REF = $_GET['REF']; if(!$REF) $REF = $_POST['REF'];
    			
				$country = $_POST['country1'];
				$currency = $_POST['currency'];
				$limitation = $_POST['limitation'];

    			$inout = $_POST['inout'];
    			$company = $_POST['company'];
    			$biznumber = $_POST['biznumber']; $biznumber = str_replace("-","",$biznumber);
    			$president = $_POST['president']; 
    			$post = $_POST['post'];
    			$address = $_POST['address']; 
    			$subject = $_POST['subject']; 
    			$item = $_POST['item'];
    			$email = $_POST['email'];
    			$comment = $_POST['comment']; 
    					
    			$tel = $_POST['tel']; 
    			$fax = $_POST['fax']; $fax = str_replace("-","",$fax);
    			$phone = $_POST['phone']; $phone = str_replace("-","",$phone);

    			$group = $_POST['group']; 
    			$com_manager = $_POST['com_manager']; 
    					
    			$discount = $_POST['discount'];
    			if($_POST['vat']) $vat = "checked"; else $vat ="";  // $vat = $_POST['vat'];
    			$vatrate = $_POST['vatrate'];
    				
    			if($bizcode && !is_numeric($bizcode)) msg_alert("거래처 코드는 숫자만 가능합니다.");
    
    			
    			if(!$company) msg_alert("오류! 회사명 없습니다.");
    			else {
					
					//# 중복검사
					if($rows[biznumber]) {
						$query = "select * from sales_company_$MEM[Id] where biznumber = '$biznumber'";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
						if( mysql_num_rows($result) ) msg_alert("이미 등록된 사업자번호 입니다.");
					} 
					
					if($rows[email]) {
						$query = "select * from sales_company_$MEM[Id] where email = '$email'";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
						if( mysql_num_rows($result) ) msg_alert("이미 등록된 이메일주소 입니다.");
					} 
					
					
					
					//# Master DB 거래처 목록에 등록...
					if($email){
					
						$query = "select * from sales_company where email = '$email'";
						$result=mysql_db_query($mysql_dbname,$query,$connect);
						if( mysql_num_rows($result) ){
							// 기존 DB, Tree 정보만 갱신
							$rows = mysql_fetch_array($result);
							$tree = $rows[tree]."$MEM[Id];";
							$query="UPDATE `sales_company` SET `tree`='$tree' WHERE `email`='$email'";
    						mysql_db_query($mysql_dbname,$query,$connect);
						} else {
							// 신규추가
							$tree = "$MEM[Id];";
							$query = "INSERT INTO `sales_company` (`regdate`,  
    										`company`, `biznumber`, `president`, `post`, `address`, `subject`, `item`, 
    										`email`, `tel`, `fax`, `phone`, `country`,`currency`,`vat`,`vatrate`,`tree`) 
    								VALUES ('$TODAY', 
    								'$company', '$biznumber', '$president', '$post', '$address', '$subject', '$item', 
    								'$email', '$tel', '$fax', '$phone',  '$country', '$currency',  '$vat', '$vatrate', '$tree')";
    						mysql_db_query($mysql_dbname,$query,$connect);
						}
					}
					
					//# 상대방 거래처에, 내정보 등록
					if($email){
						// 신규로 등록한, 거래처가, 서비스 회원인지를 검사.
						$query = "select * from sales_members where email = '$email'";
						$result=mysql_db_query($mysql_dbname,$query,$connect);
						if( mysql_num_rows($result) ){
							//# 같은 서비스를 받고 있는 회원.
							$COM = mysql_fetch_array($result);
							
							// 거래처 DB접속 정보 
							$query = "select * from `sales_server` where Id = '$COM[server]'";
    						$result=mysql_db_query($mysql_dbname,$query,$connect);
							if( mysql_num_rows($result) )	{
								$_server=mysql_fetch_array($result);
								$_dbconnect=mysql_connect($_server[ip],$_server[userid],$_server[password]) or die("user database can not connect.");
							}

							
							// 거래처 구분 전환
							if($inout == "1") $_inout = "2"; else if($inout == "2") $_inout = "1";
							
							$query = "select * from sales_company_$COM[Id] where email = '$MEM[email]'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($_server[dbname],$query,$_dbconnect);
							if( mysql_num_rows($result) ){
								//기존에 등록된 경우, 재등록... 수정
								
							} else {
								// 내정보를 상대방, 거래처 테이블로 삽입.
								$query = "INSERT INTO `sales_company_$COM[Id]` (`regdate`, `regcode`, `inout`, 
    										`company`, `biznumber`, `president`, `post`, `address`, `subject`, `item`, 
    										`email`, `tel`, `fax`, `phone`, `manager`,`country`,`currency`,`limitation`,`vat`,`vatrate`) 
    								VALUES ('$TODAY', '$MEM[Id]', '$_inout', 
    								'$MEM[company]', '$MEM[biznumber]', '$MEM[president]', '$MEM[post]', '$MEM[address]', '$MEM[subject]', '$MEM[item]', 
    								'$MEM[email]', '$MEM[tel]', '$MEM[fax]', '$MEM[phone]', '$MEM[manager]', '$MEM[country]', '$MEM[currency]', '$MEM[limitation]', 
    								'$MEM[vat]', '$MEM[vatrate]')";
    							// mysql_db_query($mysql_dbname,$query,$connect);
    							mysql_db_query($_server[dbname],$query,$_dbconnect);
							}
						
						}
					}
					
					///
    				
					$query = "INSERT INTO `sales_company_$MEM[Id]` (`regdate`, `regcode`, `inout`, `mem`, 
    										`company`, `biznumber`, `president`, `post`, `address`, `subject`, `item`, 
    										`email`, `tel`, `fax`, `phone`, `manager`,`country`,`currency`,`limitation`,`vat`,`vatrate`) 
    								VALUES ('$TODAY', '$MEM[Id]', '$inout', '$COM[Id]', 
    								'$company', '$biznumber', '$president', '$post', '$address', '$subject', '$item', 
    								'$email', '$tel', '$fax', '$phone', '$manager', '$country', '$currency', '$limitation', '$vat', '$vatrate')";
    				// mysql_db_query($mysql_dbname,$query,$connect);	
    				mysql_db_query($server[dbname],$query,$dbconnect);
    					
    		
						
				} 
    			
    			echo "<script> history.go(-2); </script>";	
		
				//////////////////////////////////////////////////////////////////		
		
			} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
	
		}
	

	} ///// ##### SESSION END ##### /////
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	
	
?>

