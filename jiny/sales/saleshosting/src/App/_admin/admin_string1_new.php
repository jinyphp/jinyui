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
	
	if($_COOKIE[adminemail]){ ///////////////
	
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    			$TRANS = $_POST['trans']; if(!$TRANS) $TRANS = $_GET['trans'];
    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    			
    			
    			
    			switch($mode){

    				case 'del':
    						$UID = $_GET['UID'];
    						
    						$query = "DELETE FROM `shop_string` where Id = '$UID'";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
							
							echo "<meta http-equiv='refresh' content='0; url=admin_string.php'>";
							
    						break;
    						    			
    				case 'editup':
    						$UID = $_POST['UID'];
    						
    						$code = $_POST['code'];
							$ko = $_POST['ko'];
							$en = $_POST['en'];
							$jp = $_POST['jp'];
							$cn = $_POST['cn'];
							$fr = $_POST['fr'];
							$de = $_POST['de'];
							$ru = $_POST['ru'];
							$sp = $_POST['sp'];
							$pt = $_POST['pt'];
							$ar = $_POST['ar'];

							if($code){
								$query = "select * from `shop_string` where code = '$code' and Id != '$UID'";
								$result=mysql_db_query($mysql_dbname,$query,$connect);
								if(mysql_affected_rows()) {
									msg_alert("以묐났??肄붾뱶?낅땲??");

								} else {

									$query = "UPDATE `shop_string` SET `code`='$code',`ko`='$ko',`en`='$en',`jp`='$jp',`cn`='$cn',`fr`='$fe',`de`='$de',`ru`='$ru',`sp`='$sp',`pt`='$pt',`ar`='$ar' WHERE `Id`='$UID'";
    								mysql_db_query($mysql_dbname,$query,$connect);
    							}
    						} else msg_alert("肄붾뱶媛 ?놁뒿?덈떎.");	
							echo "<meta http-equiv='refresh' content='0; url=admin_string.php'>";
							
    						break;
    					
    				case 'edit':
    						$UID = $_GET['UID'];
    						
    						// if($MOBILE == "mobile") $body = admin_skinLoad("admin_string1_new.htm"); else $body = admin_skinLoad("admin_string1_new_pc.htm");		
							$body = admin_shopskin("admin_string1_new");
							
							////////////////////
		
							include "admin_design_left.php";
		
							//////////////////////
    						
							$query = "select * from `shop_string` where Id = '$UID'";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if(mysql_affected_rows()) {
								$rows=mysql_fetch_array($result);
								
								
								
								
								$body=str_replace("{formstart}","<form name='lang' method='post' enctype='multipart/form-data' action='admin_string_new.php'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					
							
								
								$query1 = "select * from `shop_language` ";
								$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    							$total1=mysql_result($result1,0,0);
		
								$result1=mysql_db_query($mysql_dbname,$query1,$connect);
								if(mysql_affected_rows()) {
									
									$list = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
									
									$list .="<tr>";
									$list .= "<td width='50'><font size='2'>CODE</font></td>";
									$list .= "<td><input type='text' name='code' value='$rows[code]' $cssFormStyle ></td>";
									$list .= "<td width='50'></td>";
									$list .="</tr>";
									
									
									for($i=0;$i<$total1;$i++){
										$rows1=mysql_fetch_array($result1);
										
										$languageCode = $rows1[code];
										$source = "ko";
										
										$list .="<tr>";
										$list .= "<td width='50'><font size='2'>$languageCode</font></td>";
										$list .= "<td><input type='text' name='$languageCode' value='$rows[$languageCode]' $cssFormStyle ></td>";
										$list .= "<td width='50'><input type='button' name='reg' value='번역' onclick='translateGoogle(\"$languageCode\",\"$source\",\"$rows[ko]\")' ></td>";
										$list .="</tr>";
										
    
			
										
									}
									
									$list .= "</table>";
									$body=str_replace("{datalist}",$list,$body);
								}
								/*
					
								$body=str_replace("{code}","<input type='text' name='code' value='$rows[code]' $cssFormStyle >",$body);
								$body=str_replace("{ko}","<input type='text' name='ko' value='$rows[ko]' $cssFormStyle >",$body);
								$body=str_replace("{en}","<input type='text' name='en' value='$rows[en]' $cssFormStyle >",$body);
								$body=str_replace("{jp}","<input type='text' name='jp' value='$rows[jp]' $cssFormStyle >",$body);
								$body=str_replace("{cn}","<input type='text' name='cn' value='$rows[cn]' $cssFormStyle >",$body);
								$body=str_replace("{fr}","<input type='text' name='fr' value='$rows[fr]' $cssFormStyle >",$body);
								$body=str_replace("{de}","<input type='text' name='de' value='$rows[de]' $cssFormStyle >",$body);
								$body=str_replace("{sp}","<input type='text' name='sp' value='$rows[sp]' $cssFormStyle >",$body);
								$body=str_replace("{pt}","<input type='text' name='pt' value='$rows[pt]' $cssFormStyle >",$body);
								$body=str_replace("{ru}","<input type='text' name='ru' value='$rows[ru]' $cssFormStyle >",$body);
								$body=str_replace("{ar}","<input type='text' name='ar' value='$rows[ar]' $cssFormStyle >",$body);
							
								*/
							
							
					
								$body=str_replace("{submit}","<input type='submit' name='reg' value='수정' >",$body);
							
								$body=str_replace("{formend}","</form>",$body);
								
								// $body=str_replace("{delete}","<a href='sales_trans_payment_new.php?mode=del&TID=$rows[Id]&startdate=$startdate&enddate=$enddate'>??젣</a>",$body);
								$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"shop_string_new.php?mode=del&UID=$rows[Id]\")' style='font-size:9pt'>",$body);
					
								echo $body;
								include "../copyright.php";
					
							}
    					break;
    				
    				case 'newup':
    					if($_SESSION['nonce'] == $_POST['nonce']){
    					
							$code = $_POST['code']; // echo "code is $code";
							
							$ko = $_POST['ko'];
							$en = $_POST['en'];
							$jp = $_POST['jp'];
							$cn = $_POST['cn'];
							$fr = $_POST['fr'];
							$de = $_POST['de'];
							$ru = $_POST['ru'];
							$sp = $_POST['sp'];
							$pt = $_POST['pt'];
							$ar = $_POST['ar'];
							
							if($code){
								$query = "select * from `shop_string` where code = '$code'";
								$result=mysql_db_query($mysql_dbname,$query,$connect);
								if(mysql_affected_rows()) {
									msg_alert("중복된 문자열코드 입니다.");

								} else {
    								$query ="INSERT INTO `shop_string` (`albacode`, `code`, `ko`, `en`, `jp`, `cn`, `fr`, `de`, `ru`, `sp`, `pt`, `ar`) 
    								VALUES ('00000000', '$code', '$ko', '$en', '$jp', '$cn', '$fr', '$de', '$ru', '$sp', '$pt', '$ar')";
									// echo $query;
									mysql_db_query($mysql_dbname,$query,$connect);
								}
							} else msg_alert("문자열 코드가 없습니다.");
						
						}
						
    					echo "<meta http-equiv='refresh' content='0; url=admin_string.php'>";
    					break;
    				default:
    						
    						// if($MOBILE == "mobile") $body = admin_skinLoad("admin_string_new.htm"); else $body = admin_skinLoad("admin_string_new_pc.htm");		
							$body = admin_shopskin("admin_string_new");
							
							////////////////////
		
							include "admin_design_left.php";
		
							//////////////////////
    						  						
    						
    						if(!$_SESSION['nonce']) $_SESSION['nonce'] = $nonce = md5('new_$TODAYTIME'.microtime()); else $nonce = $_SESSION['nonce'];
    			
    			
    						$body = str_replace("{formstart}","<form name='lang' method='post' enctype='multipart/form-data' action='admin_string_new.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
					
							$body = str_replace("{code}","<input type='text' name='code' $cssFormStyle >",$body);
							$body = str_replace("{ko}","<input type='text' name='ko'  $cssFormStyle >",$body);
							$body = str_replace("{en}","<input type='text' name='en'  $cssFormStyle >",$body);
							$body = str_replace("{jp}","<input type='text' name='jp'  $cssFormStyle >",$body);
							$body = str_replace("{cn}","<input type='text' name='cn'  $cssFormStyle >",$body);
							$body = str_replace("{fr}","<input type='text' name='fr'  $cssFormStyle >",$body);
							$body = str_replace("{de}","<input type='text' name='de'  $cssFormStyle >",$body);
							$body = str_replace("{sp}","<input type='text' name='sp'  $cssFormStyle >",$body);
							$body = str_replace("{pt}","<input type='text' name='pt'  $cssFormStyle >",$body);
							$body = str_replace("{ru}","<input type='text' name='ru'  $cssFormStyle >",$body);
							$body = str_replace("{ar}","<input type='text' name='ar'  $cssFormStyle >",$body);
							
					
							$body = str_replace("{submit}","<input type='submit' name='reg' value='저장' >",$body);
							$body = str_replace("{delete}","",$body);
							$body = str_replace("{formend}","</form>",$body);
							
							
							echo $body;
							
							include "./admin_copyright.php";
					
    			}
	

		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
	
	
	
		

?>

