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
    	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_domainnew");
    					
    			$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='admin_domain_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
											
				$body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);
					
				$body = str_replace("{domain}","<input type='text' name='domain' value='$rows[domain]' $cssFormStyle >",$body);
				
				// $body = str_replace("{country}","<input type='text' name='country1' value='$rows[country]'  $cssFormStyle >",$body);
					$query1 = "select * from shop_country where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$body1 = "<select size='1' name='country1' $cssFormStyle> ";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);
				
							if($rows[country] == $rows1[code]) 
							$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[name]</option>";
							else $body1 .= "<option value='$rows1[code]' >$rows1[name]</option>";
						}
						$body1 .= "</select>";
					}
					$body = str_replace("{country}",$body1,$body);
				
				
				// $body = str_replace("{language}","<input type='text' name='language1' value='$rows[language]'  $cssFormStyle >",$body);
				//////////////////
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


					//* 스킨 레이아웃 설정
					$query1 = "select * from shop_skin where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$body1 = "<select size='1' name='layout' $cssFormStyle> ";
    					$body1 .= "<option value='' >사이트 스킨 레이아웃 선택</option>";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);
							if($rows[layout] == $rows1[Id]) 
							$body1 .= "<option value='$rows1[Id]' selected=\"selected\">$rows1[skinname]</option>";
							else $body1 .= "<option value='$rows1[Id]' >$rows1[skinname]</option>";
						}
						$body1 .= "</select>";
					}
					$body = str_replace("{skin_layout}",$body1,$body);	
	
	
				//////////////////////////
					//SEO
					$query1 = "select * from `shop_language` ";	
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
    						
    				$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()){
						$seo_language = "";
						$seo_forms = "";
						for($i=0;$i<$total1;$i++){
							$rows1=mysql_fetch_array($result1);

							if($rows1[code] == $_SESSION['language']){
								$seo_language .= "<input id='tab-$i' type='radio' name='goods_language' value='$rows1[code]' checked=\"checked\">";
							} else {
								$seo_language .= "<input id='tab-$i' type='radio' name='goods_language' value='$rows1[code]'>";
							}
									
							$seo_language .= "<label for='tab-$i'>$rows1[language]</label>";
									
							// $_title = "title_".$rows1[code];
							// $_keyword = "keyword_".$rows1[code];
							// $_description = "description_".$rows1[code];
							
							
    						$query2 = "select * from `shop_seo` where domain = '$rows[domain]' and language = '$rows1[code]'";		
    						$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
							if(mysql_affected_rows()){
								$rows2=mysql_fetch_array($result2);
							}
							
							$seo_forms .="<div class='tab-$i_content'>
										<table border='0' width='100%' cellspacing='5' cellpadding='5' 
																			style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
										<tr>
										<td width='110' align='right'><font size='2'>타이틀<b>($rows1[code])</b></font></td>
										<td><textarea name='title_$rows1[code]' rows='2' style='width:100%'>$rows2[title]</textarea></td>
										</tr>
										<tr>
										<td width='110' align='right'><font size='2'>키워드<b>($rows1[code])</b></font></td>
										<td><textarea name='keyword_$rows1[code]' rows='2' style='width:100%'>$rows2[keyword]</textarea></td>
										</tr>
										<tr>
										<td width='110' align='right'><font size='2'>설명<b>($rows1[code])</b></font></td>
										<td><textarea name='description_$rows1[code]' rows='2' style='width:100%'>$rows2[description]</textarea></td>
										</tr>
										</table>
													   
										</div>";
									 
									
						}
								
								
						$tabbar = "<div id='css_tabs'>
									$seo_language
									$seo_forms
									</div>";
						$body = str_replace("{seo_language_form}",$tabbar,$body);			
								
								
					}
    						

					//////////////////////////

	
	
	
	
				$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
							
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
			
		echo $body;
		
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

