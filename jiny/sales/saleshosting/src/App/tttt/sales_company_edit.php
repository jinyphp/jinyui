<?
	@session_start();
	
	
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; 
	include "mobile.php";
	
	include "./func_skin.php"; 
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

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
    			case 'del':
    				$query = "select * from sales_trans_$MEM[Id] where UIDA = '$UID' or UIDB = '$UID'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if( mysql_num_rows($result) ) {
						$FlagTRANS = FALSE; 
						msg_alert("거래전표가 남아있는 거래처는 삭제가 되지 않습니다.");
						break;
					} else $FlagTRANS = TRUE;
    				
					$query = "select * from sales_goods_$MEM[Id] where CID = '$UID'";	
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if( mysql_num_rows($result) ) {
						$FlagGOODS = FALSE; 
						msg_alert("거래 상품이 있는 거래처는 삭제가 되지 않습니다.");
						break;	
					} else $FlagGOODS = TRUE;
    					
    				if($FlagTRANS && $FlagGOODS){
    					$query = "DELETE FROM `sales_company_$MEM[Id]` WHERE `Id`='$UID'";
    					//mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    				}

    				page_back2();
    				
    				break;
    			case 'editup':
   		
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
    				$manager = $_POST['manager']; 
    					
    				$discount = $_POST['discount'];
    				if($_POST['vat']) $vat = "checked"; else $vat ="";  // $vat = $_POST['vat'];
    				$vatrate = $_POST['vatrate'];
    				
    				//if($bizcode && !is_numeric($bizcode)) msg_alert("거래�?코드???�자�?�&#65533;?�합?�다.");
    
    				$balance1 = $_POST['balance1'];
					$balance2 = $_POST['balance2'];
    			
    				if(!$company) msg_alert("오류! 회사명이 없습니다.");
    				else {

						//# 사업자 번호 중복 검사
						if($rows[biznumber]) {
							$query = "select * from sales_company_$MEM[Id] where biznumber = '$biznumber'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if( mysql_num_rows($result) ) msg_alert("중복된 사업자 번호입니다.");
						} 
					
						if($rows[email]) {
							$query = "select * from sales_company_$MEM[Id] where email = '$email'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if( mysql_num_rows($result) ) msg_alert("중복된 이메일 주소 입니다.");
						} 
					
						$query = "UPDATE `sales_company_$MEM[Id]` SET `inout`='$inout', `company`='$company', `biznumber`='$biznumber', `president`='$president', 
    						`post`='$post', `address`='$address', `subject`='$subject', `item`='$item', `comment`='$comment', `discount`='$discount', `vat`='$vat', 
    						`email`='$email', `tel`='$tel', `fax`='$fax', `phone`='$phone', `group`='$group', `manager`='$manager',
    						`country`='$country', `currency`='$currency', `limitation`='$limitation' , `vat`='$vat', `vatrate`='$vatrate' WHERE `Id`='$UID'";
    					// echo $query."<br>";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					$query = "UPDATE `sales_company_$MEM[Id]` SET `balance1`='$balance1', `balance2`='$balance2' WHERE `Id`='$UID'";
    					// echo $query."<br>";
    					//mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					//# 마스터 업체목록 수정
    					if($email){
							$query = "select * from sales_company where email = '$email'";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if( mysql_num_rows($result) ){
								// 기존 DB, Tree 정보만 갱신
								$rows = mysql_fetch_array($result);
								$tree = $rows[tree]."$MEM[Id];";
								$query="UPDATE `sales_company` SET `company`='$company', `biznumber`='$biznumber', `president`='$president', 
										`post`='$post', `address`='$address', `subject`='$subject', `item`='$item', `tel`='$tel', `fax`='$fax', `phone`='$phone',
										 `country`='$country',`email`='$email'  WHERE `email`='$email'";
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

    					//#
    					
    					
    					
    					///////////
    					
    					
					 
					}
    			
    				page_back2(); 
    			
    				break;
    			default:
    				
    			
    				$query = "select * from `sales_company_$MEM[Id]` where Id = '$UID'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if( mysql_num_rows($result) ){ 
		    			$COM=mysql_fetch_array($result);
		    			
		    			$body = shopskin("sales_company_edit");
    				
    					//# 좌측 메뉴 표시
						include "sales_company_left.php";
						
						$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_company_edit.php'> 
										<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);
						
						
						if($COM[inout] == "1")	$body = str_replace("{r1}","<input type=radio name=inout value=1 checked='checked'>",$body);
						else $body = str_replace("{r1}","<input type=radio name=inout value=1>",$body);
							
						if($COM[inout] == "2")	$body = str_replace("{r2}","<input type=radio name=inout value=2 checked='checked'>",$body);
						else $body = str_replace("{r2}","<input type=radio name=inout value=2>",$body);
							
						if($COM[inout] == "3")	$body = str_replace("{r3}","<input type=radio name=inout value=3 checked='checked'>",$body);
						else $body = str_replace("{r3}","<input type=radio name=inout value=3>",$body);
							
						if($COM[inout] == "4")	$body = str_replace("{r4}","<input type=radio name=inout value=4 checked='checked'>",$body);
						else $body = str_replace("{r4}","<input type=radio name=inout value=4>",$body);
				
						$body = str_replace("{balance1}","<input type='text' name='balance1'  value='$COM[balance1]' $cssFormStyle placeholder='매출액 미수금'>",$body);
						$body = str_replace("{balance2}","<input type='text' name='balance2'  value='$COM[balance2]' $cssFormStyle placeholder='매입액 미수금'>",$body);
    		
						$body=str_replace("{country}",form_country1($COM[country]),$body);
			
						$query1 = "select * from `sales_currency`";
						$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    					$total1=mysql_result($result1,0,0);	
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_num_rows($result1) ) {
							$currency = "<select name='currency' $cssFormStyle>";
							for($ii=0;$ii<$total1;$ii++){
								$rows1=mysql_fetch_array($result1);
								if($COM[currency] == $rows1[currency]) $currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
								else $currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
							}
							$body = str_replace("{currency}",$currency,$body);
						}	
						// $body = str_replace("{currency}","<input type='text' name='currency'  value='$COM[president]' $cssFormStyle placeholder='통화'>",$body);
						$body = str_replace("{limit}","<input type='text' name='limitation'  value='$COM[limit]' $cssFormStyle placeholder='거래한도'>",$body);
				
						$body = str_replace("{company}","<input type='text' name='company'  value='$COM[company]' $cssFormStyle placeholder='회사명'>",$body);
						$body = str_replace("{biznumber}","<input type='text' name='biznumber'  value='$COM[biznumber]' $cssFormStyle placeholder='사업자번호'>",$body);

						$body = str_replace("{president}","<input type='text' name='president'  value='$COM[president]' $cssFormStyle placeholder='대표자명'>",$body);
						$body = str_replace("{post}","<input type='text' name='post'  value='$COM[post]' $cssFormStyle placeholder='우편번호'>",$body);
						$body = str_replace("{address}","<input type='text' name='address'  value='$COM[address]' $cssFormStyle placeholder='주소'>",$body);
						$body = str_replace("{subject}","<input type='text' name='subject'  value='$COM[subject]' $cssFormStyle placeholder='업태'>",$body);
						$body = str_replace("{item}","<input type='text' name='item'  value='$COM[item]' $cssFormStyle placeholder='업종'>",$body);
						$body = str_replace("{email}","<input type='text' name='email'  value='$COM[email]' $cssFormStyle placeholder='이메일'>",$body);

				
						$body = str_replace("{discount}","<input type='text' name='discount'  value='$COM[discount]' $cssFormStyle placeholder='할인율'>",$body);
						
						if($COM[vat]) $body = str_replace("{vat}","<input type='checkbox' name='vat' checked>",$body);
						else $body = str_replace("{vat}","<input type='checkbox' name='vat'>",$body);
						$body = str_replace("{vatrate}","<input type='text' name='vatrate' value='$COM[vatrate]' $cssFormStyle placeholder='부가세율'>",$body);
						
						$body = str_replace("{tel}","<input type='text' name='tel'  value='$COM[tel]' $cssFormStyle placeholder='전화'>",$body);
						$body = str_replace("{fax}","<input type='text' name='fax'  value='$COM[fax]' $cssFormStyle placeholder='팩스'>",$body);
						$body = str_replace("{phone}","<input type='text' name='phone'  value='$COM[phone]' $cssFormStyle placeholder='핸드폰'>",$body);
						$body = str_replace("{group}","<input type='text' name='group'  value='$COM[group]' $cssFormStyle placeholder='그룹'>",$body);
						
						$query1 = "select * from sales_manager where members_id = '$MEM[Id]'";
						// echo $query1;
						$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    					$total1=mysql_result($result1,0,0);	
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_num_rows($result1) ) {
							$manager = "<select name='manager' $cssFormStyle >";
							for($ii=0;$ii<$total1;$ii++){
								$rows1=mysql_fetch_array($result1);
								if($GOO[manager] == $rows1[Id]) $manager .= "<option value='$rows1[Id]' selected>$rows1[name]</option>"; 
								else $manager .= "<option value='$rows1[Id]'>$rows1[name]</option>";
							}
							$body = str_replace("{manager}","$manager",$body);
						}
						// $body = str_replace("{manager}","<input type='text' name='manager'  value='$COM[manager]' $cssFormStyle placeholder='담당자'>",$body);
			
						$body = str_replace("{comment}","<textarea name='comment' rows='5' $cssFormStyle placeholder=''>$COM[comment]</textarea>",$body);
							
			
						
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $btn_style_blue>",$body);
						$body = str_replace("{login}","",$body);			
					
						$body = str_replace("{delete}",_button_gray("삭제","sales_companyedit.php?mode=del&UID=$UID"),$body); 
						
						$body = str_replace("{mail}",_button_green("추천메일","sales_company_mail.php?UID=$UID"),$body); 	
						
						
					}		
    				break;
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

