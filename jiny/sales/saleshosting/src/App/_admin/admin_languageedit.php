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
    			//% 언어코드 필드명 삭제
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_language` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
					$query = "ALTER TABLE `shop_language` DROP `$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					/*
					//% 상품목록 언어별 필드삭제
					$query = "ALTER TABLE `shop_goods` DROP `goodname_$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					$query = "ALTER TABLE `shop_goods` DROP `spec_$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					$query = "ALTER TABLE `shop_goods` DROP `subtitle_$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					$query = "ALTER TABLE `shop_goods` DROP `optionitem_$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					$query = "ALTER TABLE `shop_goods` DROP `html_desktop_$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					$query = "ALTER TABLE `shop_goods` DROP `html_mobile_$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					*/
					
					$query = "ALTER TABLE `shop_cate` DROP `$rows[code]`;";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					
		    	}
		    	
		
    			$query = "DELETE FROM `shop_language` WHERE `Id`='$UID'";
    			// echo $query."<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			
    			
    						
    			// echo "<meta http-equiv='refresh' content='0; url=admin_language.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    			$code = $_POST['code'];
    			
    			$language1 = $_POST['language1'];
    			$enable = $_POST['enable'];
    			
    			if(!$code) msg_alert("오류! 언어코드 없습니다.");
    		
    			else if(!$language1) msg_alert("오류! 언어명이 없습니다.");
    			else {
    				
    				//% 언어코드가 변경될 경우, 언어명 필드명 변경
    				$result=mysql_db_query($mysql_dbname,"select * from `shop_language` where Id = '$UID'",$connect);
					if( mysql_affected_rows() ){ 
		    			$rows=mysql_fetch_array($result);
    					if($code != $rows[code]) {
    						//% 언어명 코드 변경
    						$query ="ALTER TABLE `shop_language` CHANGE COLUMN `$rows[code]` `$code` varchar(255) NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						/*
    						//% 상품목록 언어설정 코드 변경
    						$query ="ALTER TABLE `shop_goods` CHANGE COLUMN `goodname_$rows[code]` `goodname_$code` text NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
    						$query ="ALTER TABLE `shop_goods` CHANGE COLUMN `spec_$rows[code]` `spec_$code` text NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
    						$query ="ALTER TABLE `shop_goods` CHANGE COLUMN `subtitle_$rows[code]` `subtitle_$code` text NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
    						$query ="ALTER TABLE `shop_goods` CHANGE COLUMN `optionitem_$rows[code]` `optionitem_$code` text NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
    						$query ="ALTER TABLE `shop_goods` CHANGE COLUMN `html_desktop_$rows[code]` `html_desktop_$code` text NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
    						$query ="ALTER TABLE `shop_goods` CHANGE COLUMN `html_mobile_$rows[code]` `html_mobile_$code` text NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						*/
    						
    						$query ="ALTER TABLE `shop_cate` CHANGE COLUMN `$rows[code]` `$code` varchar(255) NULL;";
    						mysql_db_query($mysql_dbname,$query,$connect);
    					}
    				}
    			
    			
    				$query = "UPDATE `shop_language` SET `code`='$code', `language`='$language1', `enable`='$enable'  WHERE `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    				
    				
    				//% 언어별 언어이름 설정저장
					$query = "select * from `shop_language` ";
					$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
		
					$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(mysql_affected_rows()) {
						for($i=0;$i<$total;$i++){
							$rows=mysql_fetch_array($result);
    						$codetext = $rows[code];
    						$codetext1 = "name_".$rows[code];
    						$query1 = "UPDATE `shop_language` SET `$codetext`='".$_POST[$codetext1]."'  WHERE `Id`='$UID'";
    						//echo $query1."<br>"; 
    						mysql_db_query($mysql_dbname,$query1,$connect);
    						
    					}
    				}
    				
    			}  
    			
    			
    			page_back2();
    			break;
    			
    		default:
    			
    			
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_languageedit");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_language` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='country1' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
					$body = str_replace("{code}","<input type='text' name='code' value='$rows[code]' $cssFormStyle >",$body);
					$body = str_replace("{language}","<input type='text' name='language1' value='$rows[language]'  $cssFormStyle >",$body);
					
					//% 언어별 언어이름 설정
					$query1 = "select * from `shop_language` ";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						
						$language_text = "<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>";
						
						for($i=0;$i<$total1;$i++){
							$rows1=mysql_fetch_array($result1);
							$codetext = $rows1[code];
							$language_text .= "<tr>
								<td width='110' align='right'><font size=2>$rows1[code] of $rows1[language]</font></td>
								<td><input type='text' name='name_$rows1[code]' value='$rows[$codetext]' $cssFormStyle></td>
								</tr>";
							
						}
						$language_text .= "</table>";
						$body = str_replace("{language_text}","$language_text",$body);
					}			
					
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_languageedit.php?mode=del&UID=$UID\")' $css_submit>",$body);
							
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}

		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>