<?

		@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";

		$script = "<script>
			
		</script>";


		$body = $script._skin_page($skin_name,"sales_company_edit");

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
		
		$body=str_replace("{formstart}","<form id='data' name='company' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		$query = "select * from `sales_company` where Id = '$uid'";
		//echo $query."<br>";
    	if($rows= _sales_query_rows($query)){
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	} else {
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	}	
		
			if($rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);

			if($rows->auth) $body = str_replace("{auth}",_form_checkbox("auth","on"),$body);
			else $body = str_replace("{auth}",_form_checkbox("auth",""),$body);


			//echo "회사명 ".$rows->company; 
    		// 매출
			if($rows->inout == "sell")	$body = str_replace("{r1}","<input type=radio name=inout value='sell' checked='checked'>",$body);
			else $body = str_replace("{r1}","<input type=radio name=inout value='sell'>",$body);
			
			// 매입					
			if($rows->inout == "buy")	$body = str_replace("{r2}","<input type=radio name=inout value='buy' checked='checked'>",$body);
			else $body = str_replace("{r2}","<input type=radio name=inout value='buy'>",$body);
			
			// 매입매출 				
			if($rows->inout == "buysell")	$body = str_replace("{r3}","<input type=radio name=inout value='buysell' checked='checked'>",$body);
			else $body = str_replace("{r3}","<input type=radio name=inout value='buysell'>",$body);
			
			// 일반				
			if($rows->inout == "personal")	$body = str_replace("{r4}","<input type=radio name=inout value='personal' checked='checked'>",$body);
			else $body = str_replace("{r4}","<input type=radio name=inout value='personal'>",$body);
				
			$body = str_replace("{balance_sell}","<input type='text' name='balance_sell'  value='".$rows->balance_sell."' style=\"$css_textbox\"  placeholder='매출액 미수금'>",$body);
			$body = str_replace("{balance_buy}","<input type='text' name='balance_buy'  value='".$rows->balance_buy."' style=\"$css_textbox\"  placeholder='매입액 미수금'>",$body);
    		

			$body = str_replace("{limit}","<input type='text' name='limitation'  value='".$rows->limit."' style=\"$css_textbox\" placeholder='거래한도'>",$body);
				
			$body = str_replace("{company}","<input type='text' name='company'  value='".$rows->company."' style=\"$css_textbox\"  placeholder='회사명'>",$body);
			$body = str_replace("{biznumber}","<input type='text' name='biznumber'  value='".$rows->biznumber."' style=\"$css_textbox\" placeholder='사업자번호'>",$body);

			$body = str_replace("{president}","<input type='text' name='president'  value='".$rows->president."' style=\"$css_textbox\"  placeholder='대표자명'>",$body);
			$body = str_replace("{post}","<input type='text' name='post'  value='".$rows->post."' style=\"$css_textbox\"  placeholder='우편번호'>",$body);
			$body = str_replace("{address}","<input type='text' name='address'  value='".$rows->address."' style=\"$css_textbox\"  placeholder='주소'>",$body);
			$body = str_replace("{subject}","<input type='text' name='subject'  value='".$rows->subject."' style=\"$css_textbox\"  placeholder='업태'>",$body);
			$body = str_replace("{item}","<input type='text' name='item'  value='".$rows->item."' style=\"$css_textbox\" placeholder='업종'>",$body);
			$body = str_replace("{email}","<input type='text' name='email'  value='".$rows->email."' style=\"$css_textbox\"  placeholder='이메일'>",$body);
			$body = str_replace("{password}","<input type='text' name='password'  value='".$rows->password."' style=\"$css_textbox\"  placeholder='회원 비밀번호'>",$body);

				
			$body = str_replace("{discount}","<input type='text' name='discount'  value='".$rows->discount."' style=\"$css_textbox\"  placeholder='할인율'>",$body);
						
			if($rows->vat) $body = str_replace("{vat}","<input type='checkbox' name='vat' checked>",$body);
			else $body = str_replace("{vat}","<input type='checkbox' name='vat'>",$body);
			$body = str_replace("{vatrate}","<input type='text' name='vatrate' value='".$rows->vatrate."' style=\"$css_textbox\"  placeholder='부가세율'>",$body);
						
			$body = str_replace("{tel}","<input type='text' name='tel'  value='".$rows->tel."' style=\"$css_textbox\"  placeholder='전화'>",$body);
			$body = str_replace("{fax}","<input type='text' name='fax'  value='".$rows->fax."' style=\"$css_textbox\"  placeholder='팩스'>",$body);
			$body = str_replace("{phone}","<input type='text' name='phone'  value='".$rows->phone."' style=\"$css_textbox\"  placeholder='핸드폰'>",$body);
			$body = str_replace("{group}","<input type='text' name='group'  value='".$rows->group."' style=\"$css_textbox\"  placeholder='그룹'>",$body);

			$body = str_replace("{country}",_form_select_country("company_country","",$rows->country,$css_textbox),$body);

			$body = str_replace("{city}","<input type='text' name='city'  value='".$rows->city."' style=\"$css_textbox\"  placeholder='도시'>",$body);
			$body = str_replace("{state}","<input type='text' name='state'  value='".$rows->state."' style=\"$css_textbox\"  placeholder='주'>",$body);

			$body = str_replace("{currency}","<input type='text' name='currency'  value='".$rows->currency."' style=\"$css_textbox\"  placeholder='거래통화'>",$body);

			
			//# 담당자 처리
			$form_manager = "<select name='manager' style=\"$css_textbox\" >";
			$form_manager .= "<option value=''>관리자</option>";
			$query = "select * from sales_manager where enable ='on'";
			if($rowss = _sales_query_rowss($query)){	
				for($i=0;$i<count($rowss);$i++){
					$rows1 = $rowss[$i];
					if($rows->manager == $rows1->Id) $form_manager .= "<option value='".$rows1->Id."' selected>".$rows1->lastname."</option>"; 
					else $form_manager .= "<option value='".$rows1->Id."'>".$rows1->lastname."</option>";
				}
			}
			$form_manager .= "</select>";
			$body = str_replace("{manager}",$form_manager,$body);
			
		
			//# 사업장 선택 
			$form_business = "<select name='business' style=\"$css_textbox\" >";
			$form_business .= "<option value=''>사업장</option>";
			$query = "select * from sales_business where enable ='on'";
			if($rowss = _sales_query_rowss($query)){	
				for($i=0;$i<count($rowss);$i++){
					$rows1 = $rowss[$i];
					if($rows->business == $rows1->Id) $form_business .= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>"; 
					else $form_business .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
				}
			}
			$form_business .= "</select>";
			$body = str_replace("{business}",$form_business,$body);
			
			
						
			//$body = str_replace("{mail}",_button_green("추천메일","sales_company_mail.php?UID=$UID"),$body); 	
			$body = str_replace("{comment}","<textarea name='comment' rows='10' style='$css_textarea'>".stripslashes($rows->comment)."</textarea>",$body);			
						
			

		echo $body;		
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	

	/*
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
    				

    				page_back2();
    				
    				break;
    			case 'editup':
   		
	    			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
	    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
	 
    			
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
	*/
?>

