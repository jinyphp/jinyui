<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	//# 2014.12.28 hojin lee
	//# 로그인 버튼 / 신규등록 페이지
	//# 
	
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
	
	

	if($_COOKIE[adminemail]){ ///////////////
    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	$GID = $_GET['GID']; if(!$GID) $GID = $_POST['GID'];
    	
    	switch($mode){
    		case 'del':
    			$query = "DELETE FROM `shop_goods_apiset` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			page_back2();
    			break;
    			
    		case 'editup':
    			$currency = $_POST['currency'];
				$sell_prices = $_POST['sell_prices'];
				$supply_prices = $_POST['supply_prices'];
				$margin = $_POST['margin'];
				$margin_rate = $_POST['margin_rate'];
					
				$reseller = $_POST['reseller']; if(!$reseller) $reseller = "default";
				$reseller_domain = $_POST['reseller_domain'];
					
					
					
				if(!$supply_prices) msg_alert("오류! 공급단가를 입력해주세요");
    			else {
    				$query = "UPDATE `shop_goods_apiset` SET `reseller`='$reseller',`reseller_domain`='$reseller_domain',
    				`currency`='$currency', `sell_prices`='$sell_prices', `supply_prices`='$supply_prices',
    				`margin`='$margin',`margin_rate`='$margin_rate' WHERE `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
					echo $query;
				}    		
				
    			page_back2();
    			break;
    			
    		case 'edit':
    			$body = admin_shopskin("admin_goods_apiset_new");    			
				
				$query = "select * from `shop_goods_apiset` where Id = '$UID'";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()){
					$rows=mysql_fetch_array($result);
					
					$body=str_replace("{formstart}","<form name='skins' method='post' enctype='multipart/form-data' action='admin_goods_apiset_new.php'>
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					
					//# 판매 통화설정
					$query1 = "select * from `shop_currency`";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
			
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$sell_currency = "<select name='currency' $cssFormStyle>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
							if($rows[currency] == $rows1[currency]) $sell_currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
							else $sell_currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
						}
						$body = str_replace("{currency}",$sell_currency,$body);
					}
							
					// $body = str_replace("{currency}","<input type='text' name='currency'>",$body);
				
					$body = str_replace("{sell_prices}","<input type='text' name='sell_prices' value='$rows[sell_prices]' $cssFormStyle >",$body);
					$body = str_replace("{supply_prices}","<input type='text' name='supply_prices' value='$rows[supply_prices]' $cssFormStyle >",$body);
					$body = str_replace("{margin}","<input type='text' name='margin' value='$rows[margin]' $cssFormStyle >",$body);
					$body = str_replace("{margin_rate}","<input type='text' name='margin_rate' value='$rows[margin_rate]' $cssFormStyle >",$body);
				
					$body = str_replace("{reseller}","<input type='text' name='reseller' value='$rows[reseller]' $cssFormStyle >",$body);
					$body = str_replace("{reseller_domain}","<input type='text' name='reseller_domain' value='$rows[reseller_domain]' $cssFormStyle >",$body);
					
					
							
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_goods_apiset_new.php?mode=del&UID=$UID\")' $css_submit >",$body);
							
					
				
				}
				echo $body;
    			
    			break;
    			
    		case 'newup':
    			if($_SESSION['nonce'] != $_POST['nonce']){
					$_SESSION['nonce'] = NULL;	
					page_back1();

				} else {
				///////////////////////////
				// 섹션 중복처리 방지 기능
	
					$_SESSION['nonce'] = NULL;
			
					$currency = $_POST['currency'];
					$sell_prices = $_POST['sell_prices'];
					$supply_prices = $_POST['supply_prices'];
					$margin = $_POST['margin'];
					$margin_rate = $_POST['margin_rate'];
					
					$reseller = $_POST['reseller']; if(!$reseller) $reseller = "default";
					$reseller_domain = $_POST['reseller_domain'];
					
					
					
					if(!$supply_prices) msg_alert("오류! 공급단가를 입력해주세요");
    				else {
    					if($reseller == "default" ) {
    						
    						$query = "UPDATE `shop_goods_apiset` SET `reseller`='$reseller',`reseller_domain`='$reseller_domain',
    						`currency`='$currency', `sell_prices`='$sell_prices', `supply_prices`='$supply_prices',
    						`margin`='$margin',`margin_rate`='$margin_rate' WHERE reseller = 'default'";
    						mysql_db_query($mysql_dbname,$query,$connect);
    					} else {
    					
    						

    						$query = "INSERT INTO `shop_goods_apiset` (`regdate`,`GID`, `currency`,  `sell_prices`, `supply_prices`,  `margin`, `margin_rate`,  `reseller`, `reseller_domain`) 
    						VALUES ( '$TODAYTIME','$GID', '$currency', '$sell_prices', '$supply_prices', '$margin', '$margin_rate', '$reseller', '$reseller_domain');";
							mysql_db_query($mysql_dbname,$query,$connect);  
							echo $query;
						}
					
					}    		
							    			
    				page_back2();				    			
    				

				///// ##### SESSION END ##### /////
				}
		
				break;
    	
    	
    	
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
				$body = admin_shopskin("admin_goods_apiset_new"); 
				
				$result=mysql_db_query($mysql_dbname,"select * from `shop_goods` where Id = '$GID'",$connect);
				if( mysql_affected_rows() ){ 
		    	$GOO=mysql_fetch_array($result);
		    	   			
				
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
				
    				$body=str_replace("{formstart}","<form name='skins' method='post' enctype='multipart/form-data' action='admin_goods_apiset_new.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='GID' value='$GID'>
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
				

					//# 판매 통화설정
					$query1 = "select * from `shop_currency`";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
			
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$sell_currency = "<select name='currency' $cssFormStyle>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
							if($GOO[sell_currency] == $rows1[currency]) $sell_currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
							else $sell_currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
						}
						$body = str_replace("{currency}",$sell_currency,$body);
					}
							
					// $body = str_replace("{currency}","<input type='text' name='currency'>",$body);
				
					$body = str_replace("{sell_prices}","<input type='text' name='sell_prices' value='$GOO[prices_sell]' $cssFormStyle >",$body);
					$body = str_replace("{supply_prices}","<input type='text' name='supply_prices' $cssFormStyle >",$body);
					$body = str_replace("{margin}","<input type='text' name='margin' $cssFormStyle >",$body);
					$body = str_replace("{margin_rate}","<input type='text' name='margin_rate' $cssFormStyle >",$body);
				
					$body = str_replace("{reseller}","<input type='text' name='reseller' $cssFormStyle >",$body);
					$body = str_replace("{reseller_domain}","<input type='text' name='reseller_domain' $cssFormStyle >",$body);
				
					$body = str_replace("{delete}","",$body);		
					$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
				
				}
				
				//# 번역스트링 처리
				$body = _adminstring_converting($body);
						
				echo $body;
		}
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

