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

	if($_COOKIE[adminemail]){ ///////////////
	
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$TRANS = $_POST['trans']; if(!$TRANS) $TRANS = $_GET['trans'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    				
    	switch($mode){

    		case 'del':
    			$code = $_GET['code'];
    						
    			$query = "DELETE FROM `shop_string` where code = '$code'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
							
				//echo "<meta http-equiv='refresh' content='0; url=admin_string.php'>";
				page_back2();
    			break;
    						    			
			case 'editup':
    			$code = $_POST['code'];
				$link = $_POST['link'];
				
				$string_size = $_POST['string_size'];
    			$string_color = $_POST['string_color'];
				
	
    				//# 언어별 상품정보 갱신
					$query1 = "select * from `shop_language` ";	
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
						
					$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()){
						for($i=0;$i<$total1;$i++){
							$rows1=mysql_fetch_array($result1);
							$_string = "string_".$rows1[code];
							$string = $_POST[$_string];
							
							$query = "UPDATE `shop_string` SET `string_size`='$string_size', `string_color`='$string_color', `string`='$string', `link`='$link' where code = '$code' and language = '$rows1[code]'";
							
							echo $query."<br>";
							mysql_db_query($mysql_dbname,$query,$connect);
							
							   						
						}
					}	
									
				page_back2();			
    			break;
    					
			case 'edit':
    			$code = $_GET['code'];
    			
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_string_new"); 
							
				$query = "select * from `shop_string` where code = '$code'";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					$rows=mysql_fetch_array($result);
								
					$body=str_replace("{formstart}","<form name='lang' method='post' enctype='multipart/form-data' action='admin_string_new.php'> 
					    				<input type='hidden' name='code' value='$code'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body=str_replace("{formend}","</form>",$body);
						
					$body = str_replace("{code}","{@$code}",$body);
					$body = str_replace("{link}","<input type='text' name='link' value='$rows[link]' $cssFormStyle >",$body);
					
					$body = str_replace("{string_size}","<input type='text' name='string_size' value='$rows[string_size]' $cssFormStyle >",$body);
					$body = str_replace("{string_color}","<input type='text' name='string_color' value='$rows[string_color]' $cssFormStyle >",$body);
					
					////////////////////////////////
					//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
					//#언어별 상품명, 상품설명
					$query1 = "select * from `shop_language` ";	
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
		    		$total1 = mysql_result($result1,0,0);
		    						
		    		$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()){
						$products_language = "";
						$products_forms = "";
						for($i=0;$i<$total1;$i++){
							$rows1=mysql_fetch_array($result1);
		
							if($rows1[code] == $_SESSION['language']){
								$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='$rows1[code]' checked=\"checked\">";
							} else {
								$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='$rows1[code]'>";
							}
											
							$products_language .= "<label for='tab-$i'>$rows1[language]</label>";
											
							$_string = "string_".$rows1[code];
							// $_language = $rows1[code];
							 
							$query2 = "select * from `shop_string` where code = '$code' and language = '$rows1[code]'";
							$result2=mysql_db_query($mysql_dbname,$query2,$connect);
							if(mysql_affected_rows()) $rows2=mysql_fetch_array($result2);
					
							
											
							$products_forms .="<div class='tab-$i_content'>
											   <table border='0' width='100%' cellspacing='5' cellpadding='5' 
															style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
											   <tr>
												<td><textarea name='string_$rows1[code]' rows='10' style='width:100%'>$rows2[string]</textarea></td>
											   </tr>
											   </table>
											   </div>";
											 
											
						}
										
						$tabbar = "<div id='css_tabs'>
										$products_language
										$products_forms
									</div>";
						$body = str_replace("{seo_language_form}",$tabbar,$body);			
													
					}
	    			
					////////////////////////////////
					$body=str_replace("{submit}","<input type='submit' name='reg' value='수정' >",$body);
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_string_new.php?mode=del&code=$code\")' style='font-size:9pt'>",$body);
			
				}
				echo $body;
    			break;
    				
			case 'newup':
    			if($_SESSION['nonce'] == $_POST['nonce']){
    				$link = $_POST['link'];
    				$string_size = $_POST['string_size'];
    				$string_color = $_POST['string_color'];
    				
    				$query = "select * from `shop_string` order by code desc";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(mysql_affected_rows()) {
						$rows=mysql_fetch_array($result);
						$code = $rows[code] +1;
					} else $code = "1";
	
    				//# 언어별 상품정보 갱신
					$query1 = "select * from `shop_language` ";	
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
						
					$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()){
						for($i=0;$i<$total1;$i++){
							$rows1=mysql_fetch_array($result1);
							$_string = "string_".$rows1[code];
							$string = $_POST[$_string];
							
							$query = "INSERT INTO `shop_string` (`regdate`, `code`, `language`, `string_size`, `string_color`, `string`, `rev`, `trans`, `link`) 
							VALUES ('$TODAYTIME', '$code', '$rows1[code]', '$string_size', '$string_color', '$string', '1', '', '$link');";
							mysql_db_query($mysql_dbname,$query,$connect);
							
    						echo $query."<br>";
						}
					}		
    					
				}
						
				page_back2();		
    			break;
			default:		
				$body = admin_shopskin("admin_string_new"); 
							
				if(!$_SESSION['nonce']) $_SESSION['nonce'] = $nonce = md5('new_$TODAYTIME'.microtime()); else $nonce = $_SESSION['nonce'];
    			
    			
    			$body = str_replace("{formstart}","<form name='string' method='post' enctype='multipart/form-data' action='admin_string_new.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
				
				$query = "select * from `shop_string` order by code desc";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					$rows=mysql_fetch_array($result);
					$code = $rows[code] + 1;
				} else $code = "1";
				
				$body = str_replace("{code}","{@$code}",$body);
				$body = str_replace("{link}","<input type='text' name='link' $cssFormStyle >",$body);
				
				$body = str_replace("{string_size}","<input type='text' name='string_size' $cssFormStyle >",$body);
				$body = str_replace("{string_color}","<input type='text' name='string_color' $cssFormStyle >",$body);
				
				////////////////////////////////
				//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
				//#언어별 상품명, 상품설명
				$query1 = "select * from `shop_language` ";	
				$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1 = mysql_result($result1,0,0);
    						
    			$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()){
					$products_language = "";
					$products_forms = "";
					for($i=0;$i<$total1;$i++){
						$rows1=mysql_fetch_array($result1);
	
						if($rows1[code] == $_SESSION['language']){
							$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='$rows1[code]' checked=\"checked\">";
						} else {
							$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='$rows1[code]'>";
						}
										
						$products_language .= "<label for='tab-$i'>$rows1[language]</label>";
										
						$_string = "string_".$rows1[code];
										
						$products_forms .="<div class='tab-$i_content'>
										   <table border='0' width='100%' cellspacing='5' cellpadding='5' 
														style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
										   <tr>
											<td><textarea name='string_$rows1[code]' rows='10' style='width:100%'></textarea></td>
										   </tr>
										   </table>
										   </div>";
										 
										
					}
									
					$tabbar = "<div id='css_tabs'>
									$products_language
									$products_forms
								</div>";
					$body = str_replace("{seo_language_form}",$tabbar,$body);			
											
			}
    						

	
			////////////////////////////////
					
			$body = str_replace("{submit}","<input type='submit' name='reg' value='저장' $css_submit >",$body);
			$body = str_replace("{delete}","",$body);
			
			//# 번역스트링 처리
			$body = _adminstring_converting($body);
			
			echo $body;		
    	}
	

		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
	
	
	
		

?>

