<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";

	include "./func_adminstring.php";
		
	////////////////////////
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
	
	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_country` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    				
    				$flag_cart = NULL;
    				$flag_goods = NULL;
    				$flag_member = NULL;
    				
    				$query = "select * from `shop_cart_$rows[code]`";	
					$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
    				if($total){
    					msg_alert("오류! $rows[code] 장바구니 내용이 있어 삭제가 되지 안습니다.");
    				} else {
    					$flag_cart =TRUE;
    					$query = "DROP TABLE `shop_cart_$rows[code]`";
    					mysql_db_query($mysql_dbname,$query,$connect);
    				}
    				
    				////////////////////////
    				
    				$query = "select * from `shop_goods_$rows[code]`";	
					$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
    				if($total){
    					msg_alert("오류! $rows[code] 상품 내용이 있어 삭제가 되지 안습니다.");
    				} else {
    					$flag_goods = TRUE;
    					$query = "DROP TABLE `shop_goods_$rows[code]`";
    					mysql_db_query($mysql_dbname,$query,$connect);
    				}

    				////////////////
    				
    				$query = "select * from `shop_member_$rows[code]`";	
					$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
    				if($total){
    					msg_alert("오류! $rows[code] 회원이 있어 삭제가 되지 안습니다.");
    				} else {
    					$flag_member = TRUE;
    					$query = "DROP TABLE `shop_member_$rows[code]`";
    					mysql_db_query($mysql_dbname,$query,$connect);
    				}
    				//////////////////////
    				
    				if( $flag_cart && $flag_goods && $flag_member ){
    					$query = "DELETE FROM `shop_country` WHERE `Id`='$UID'";
    					mysql_db_query($mysql_dbname,$query,$connect);
    				}
    				// echo "<meta http-equiv='refresh' content='0; url=admin_country.php'>";
    				page_back2();
    			}
    			break;
    			
    		case 'editup':
    		
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_country` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
		    		
    				$code = $_POST['code'];
    				$countryname = $_POST['countryname'];
    				$language1 = $_POST['language1'];
    				$enable = $_POST['enable'];
    				
    				$currency = $_POST['currency'];
    				$tax = $_POST['tax'];
    				
    				$address = $_POST['address'];
    				$phone = $_POST['phone'];
    				$fax = $_POST['fax'];
    				$email = $_POST['email'];
    			
    				if(!$code) msg_alert("오류! 국가코드 없습니다.");
    				else if(!$countryname) msg_alert("오류! 국가명 없습니다.");
    				else if(!$language1) msg_alert("오류! 언어설정이 없습니다.");
    				else {
    					$query = "UPDATE `shop_country` SET `code`='$code', `name`='$countryname', `language`='$language1', 
    					`currency`='$currency', `tax`='$tax', 
    					`address`='$address', `phone`='$phone', `fax`='$fax', `email`='$email', 
    					`enable`='$enable'  WHERE `Id`='$UID'";
    					// echo $query ;
    					mysql_db_query($mysql_dbname,$query,$connect);
    				} 
    				
					if($code != $rows[code]){
						$query = "ALTER TABLE `shop_cart_$rows[code]` RENAME TO `shop_cart_$code`";
						mysql_db_query($mysql_dbname,$query,$connect);
						
						$query = "ALTER TABLE `shop_goods_$rows[code]` RENAME TO `shop_goods_$code`";
						mysql_db_query($mysql_dbname,$query,$connect);
						
						$query = "ALTER TABLE `shop_member_$rows[code]` RENAME TO `shop_member_$code`";
						mysql_db_query($mysql_dbname,$query,$connect);
					}
 
    			}
    			// echo "<meta http-equiv='refresh' content='0; url=admin_country.php'>";
    			page_back2();
    			break;
    			
    		default:
    	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_countryredit"); 		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_country` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='country1' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);
					
					$body = str_replace("{code}","<input type='text' name='code' value='$rows[code]' $cssFormStyle >",$body);
					$body = str_replace("{country}","<input type='text' name='countryname' value='$rows[name]'  $cssFormStyle >",$body);
					
					//////////////////////
					// $body = str_replace("{language}","<input type='text' name='language1' value='$rows[language]'  $cssFormStyle >",$body);
					
					$query1 = "select * from shop_language where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$body1 = "<select size='1' name='language1' $cssFormStyle> ";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);
				
							if($rows[language] == $rows1[code]) 
							$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[language]</option>";
							else $body1 .= "<option value='$rows1[code]' >$rows1[language]</option>";
						}
						$body1 .= "</select>";
					}
					$body = str_replace("{language}",$body1,$body);

					///////////////////////
					
					//# 통화표시
					$query1 = "select * from shop_currency where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$body1 = "<select size='1' name='currency' $cssFormStyle> ";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);
				
							if($rows[currency] == $rows1[currency]) 
							$body1 .= "<option value='$rows1[currency]' selected=\"selected\">$rows1[currency]</option>";
							else $body1 .= "<option value='$rows1[currency]' >$rows1[currency]</option>";
						}
						$body1 .= "</select>";
					}
					$body = str_replace("{currency}",$body1,$body);
					// $body = str_replace("{currency}","<input type='text' name='currency' value='$rows[currency]'  $cssFormStyle >",$body);
					
					$body = str_replace("{tax}","<input type='text' name='tax' value='$rows[tax]'  $cssFormStyle >",$body);
					
					$body = str_replace("{address}","<input type='text' name='address' value='$rows[address]'  $cssFormStyle >",$body);
					$body = str_replace("{phone}","<input type='text' name='phone' value='$rows[phone]'  $cssFormStyle >",$body);
					$body = str_replace("{fax}","<input type='text' name='fax' value='$rows[fax]'  $cssFormStyle >",$body);
					$body = str_replace("{email}","<input type='text' name='email' value='$rows[email]'  $cssFormStyle >",$body);
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);		
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_countryedit.php?mode=del&UID=$UID\")' $css_submit >",$body);
							
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

