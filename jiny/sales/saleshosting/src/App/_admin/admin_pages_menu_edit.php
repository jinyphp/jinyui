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
	
	$_SESSION['nonce'] = $nonce = md5('pagemenu'.microtime());

	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			$query1 = "select * from `pages_menu` where ref = '$UID'"; 
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if( mysql_affected_rows() ){ 
		    		msg_alert("오류! 하위 카테고리가 있어 삭제가 되지 않습니다.");
		    	} else { 
    				$query = "DELETE FROM `pages_menu` WHERE `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_pages_menu.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    			
    			$menucode = $_POST['menucode'];
    			$enable = $_POST['enable'];
    			
    			$menu_skin = $_POST['menu_skin'];
    			$menu_skinhtml = $_POST['menu_skinhtml']; $menu_skinhtml = addslashes($menu_skinhtml);
    			$menu_skinmobile = $_POST['menu_skinmobile']; $menu_skinmobile = addslashes($menu_skinmobile);			
	
				$link = $_POST['link'];
				$link_pages = $_POST['link_pages'];
				$link_board = $_POST['link_board'];
				$link_cate = $_POST['link_cate'];
				$link_download = $_POST['link_download'];
				$link_url = $_POST['link_url'];
				
				$menu_color = $_POST['menu_color'];
				$menu_size = $_POST['menu_size'];
				
				if(!$menucode) msg_alert("오류! 메뉴 코드명이 없습니다.");
    			else {
    				
    				if(!$link) msg_alert("오류! 메뉴 연결설정이 없습니다.");
					else {
    					$query = "UPDATE `pages_menu` SET `code`='$menucode', `menuname`='$menucode', 
    								`enable`='$enable', `menu_color`='$menu_color', `menu_size`='$menu_size',
    								`menu_skin`='$menu_skin', `menu_skinhtml`='$menu_skinhtml', `menu_skinmobile`='$menu_skinmobile',  
    								`link`='$link', `link_pages`='$link_pages', `link_board`='$link_board',
    								`link_cate`='$link_cate', `link_download`='$link_download', `link_url`='$link_url'
    								WHERE `Id`='$UID'";
    					echo $query ;
    					mysql_db_query($mysql_dbname,$query,$connect);
    				}
    			
    			}  
    			
    			
				 //# 언어별 카테고리 메뉴명 처리...
				$query1 = "select * from `shop_language` ";	
				$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1 = mysql_result($result1,0,0);
			
				$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()){
					for($i=0;$i<$total1;$i++){
						$rows1=mysql_fetch_array($result1);
					
						$_catename = "catename_".$rows1[code];
					
						$query = "UPDATE `pages_menu` SET `$rows1[code]`='".$_POST[$_catename]."'  WHERE `Id`='$UID'";
    					echo $query."<br>"; 	
    					mysql_db_query($mysql_dbname,$query,$connect);
							
					}				
				}	
    			
    			
    			
    			page_back2();
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_pages_menu_edit");
    					
    			include "admin_goods_left.php";
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `pages_menu` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked  >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);				
					
					$body = str_replace("{menu_code}","<input type='text' name='menucode' value='$rows[menuname]' $cssFormStyle >",$body);
					
					$body = str_replace("{menu_size}","<input type='text' name='menu_size' value='$rows[menu_size]' $cssFormStyle >",$body);
					$body = str_replace("{menu_color}","<input type='text' name='menu_color' value='$rows[menu_color]' $cssFormStyle >",$body);
					
					
					//# 메뉴링크 구성
					if($rows[link] == "pages") $body = str_replace("{link1}","<input type='radio' name='link' value='pages' checked>",$body);
					$body = str_replace("{link1}","<input type='radio' name='link' value='pages' >",$body);
					
					$query1 = "select * from `shop_pages` ";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$link_pages = "<select name='link_pages' $cssFormStyle>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
							if($rows[link_pages] == $rows1[code]) $link_pages .= "<option value='$rows1[code]' selected>$rows1[code]</option>"; 
							else $link_pages .= "<option value='$rows1[code]'>$rows1[code]</option>";
						}
						$body = str_replace("{link_page}",$link_pages,$body);
					}
					
					
					if($rows[link] == "board") $body = str_replace("{link2}","<input type='radio' name='link' value='board' checked >",$body);
					$body = str_replace("{link2}","<input type='radio' name='link' value='board' >",$body);
					
					$query1 = "select * from `shop_boardlist` ";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$link_board = "<select name='link_board' $cssFormStyle>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
							if($rows[link_board] == $rows1[code]) $link_board .= "<option value='$rows1[code]' selected>$rows1[code] - $rows1[title]</option>"; 
							else $link_board .= "<option value='$rows1[code]'>$rows1[code] - $rows1[title]</option>";
						}
						$body = str_replace("{link_board}",$link_board,$body);
					}
					
					
					if($rows[link] == "cate") $body = str_replace("{link3}","<input type='radio' name='link' value='cate' checked>",$body);
					$body = str_replace("{link3}","<input type='radio' name='link' value='cate' >",$body);
					
					$query1 = "select * from `shop_cate` order by pos asc";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$link_cate = "<select size='1' name='link_cate' $cssFormStyle> ";
						$link_cate .= "<option value='' >상품 카테고리</option>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
				
							for($jj=0,$level="";$jj<$rows1[level];$jj++) $level .= "&nbsp;";
				
							$language = $_SESSION['language']; //해당언어 상품명, 없으면 기본이름 적용
							if($rows1[$language]) $catename = $rows1[$language]; else $catename = $rows1[catename];
									
							if($rows[link_cate] == $rows1[Id]) 
								$link_cate .= "<option value='$rows1[Id]' selected=\"selected\">$level $catename</option>";
							else $link_cate .= "<option value='$rows1[Id]' >$level $catename</option>";
						}
						$link_cate .= "</select>";
						$body = str_replace("{link_cate}",$link_cate,$body);
					}


					if($rows[link] == "download") $body = str_replace("{link4}","<input type='radio' name='link' value='download' checked>",$body);
					$body = str_replace("{link4}","<input type='radio' name='link' value='download' >",$body);
					
					$query1 = "select * from `shop_download` ";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$link_download = "<select name='link_download' $cssFormStyle>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
							if($rows[link_download] == $rows1[Id]) $link_download .= "<option value='$rows1[Id]' selected>$rows1[title]</option>"; 
							else $link_download .= "<option value='$rows1[Id]'>$rows1[title]</option>";
						}
						$body = str_replace("{link_download}",$link_download,$body);
					}


					if($rows[link] == "url") $body = str_replace("{link5}","<input type='radio' name='link' value='url' checked>",$body);
					$body = str_replace("{link5}","<input type='radio' name='link' value='url' >",$body);
					$body = str_replace("{link_url}","<input type='text' name='link_url' value='$rows[link_url]' $cssFormStyle >",$body);
					
					
				
			
					if($rows[menu_skin])
					$body = str_replace("{menu_skin}","<input type='checkbox' name='menu_skin' checked >",$body);
					else $body = str_replace("{menu_skin}","<input type='checkbox' name='menu_skin' >",$body);
	
					$menu_skinhtml = stripslashes($rows[menu_skinhtml]);
					$body = str_replace("{menu_skinhtml}","<textarea name='menu_skinhtml' rows='10' style='width:100%'>$menu_skinhtml</textarea>",$body);
					
					$menu_skinmobile = stripslashes($rows[menu_skinmobile]);
					$body = str_replace("{menu_skinmobile}","<textarea name='menu_skinmobile' rows='10' style='width:100%'>$menu_skinmobile</textarea>",$body);
	
	
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
									
							$_name = "goodname_".$rows1[code];
							$_spec = "spec_".$rows1[code];
							$_subtitle = "subtitle_".$rows1[code];
							$_optionitem = "optionitem_".$rows1[code];
							$_html_desktop = "html_desktop_".$rows1[code];
							$_html_mobile = "html_mobile_".$rows1[code];
				
							$language_code = $rows1[code];
					
							$products_forms .="<div class='tab-$i_content'>
								  <table border='0' width='100%' cellspacing='5' cellpadding='5' 
																			style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
								<tr>
								<td width='110' align='right'><font size='2'>메뉴명<b>($rows1[code])</b></font></td>
								<td><textarea name='catename_$rows1[code]' rows='2' style='width:100%'>$rows[$language_code]</textarea></td>
								</tr>
								</table>
								</div>";
									 
									
						}
					
						$tabbar = "<div id='css_tabs'>
									$products_language
									$products_forms
								</div>";
						$body = str_replace("{selling_language_form}",$tabbar,$body);								
					}

					///////////
	
	
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);		
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_pages_menu_edit.php?mode=del&UID=$UID\")' $css_submit >",$body);
							

					
						
				}
			//# 번역스트링 처리
			$body = _adminstring_converting($body);
		
			echo $body;
			break;
	
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

