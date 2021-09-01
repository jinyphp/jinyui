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
    			$query1 = "select * from `shop_cate` where ref = '$UID'"; 
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if( mysql_affected_rows() ){ 
		    		msg_alert("오류! 하위 카테고리가 있어 삭제가 되지 않습니다.");
		    	} else { 
    				$query = "DELETE FROM `shop_cate` WHERE `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_cate.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    			
    			$catecode = $_POST['catecode'];
    			$enable = $_POST['enable'];
    			
    			$cate_skin = $_POST['cate_skin'];
    			$cate_skinhtml = $_POST['cate_skinhtml']; $cate_skinhtml = addslashes($cate_skinhtml);
    			$cate_skinmobile = $_POST['cate_skinmobile']; $cate_skinmobile = addslashes($cate_skinmobile);			
				
				$imageview = $_POST['imageview'];
				$imagesize = $_POST['imagesize'];
				
				$viewspec = $_POST['viewspec'];
				$viewsubtitle = $_POST['viewsubtitle'];
				
				$viewtype = $_POST['viewtype'];
				$cols = $_POST['cols'];
				$rows = $_POST['rows'];
				
				$linkurl = $_POST['linkurl'];
				$linkurl_page = $_POST['linkurl_page'];
				
				if(!$catecode) msg_alert("오류! 카테고리 코드명이 없습니다.");
				// else if($linkurl && !$$linkurl_page) msg_alert("오류! 연결할 URL 값을 입력해 주세요.");
    			else {
    				
    			

    				$query = "UPDATE `shop_cate` SET `code`='$catecode', `catename`='$catecode', 
    								`enable`='$enable',
    								`cate_skin`='$cate_skin', `cate_skinhtml`='$cate_skinhtml', `cate_skinmobile`='$cate_skinmobile',  
    								`linkurl`='$linkurl', `linkurl_page`='$linkurl_page',
    								`imageview`='$imageview', `imagesize`='$imagesize',
    								`viewspec`='$viewspec', `viewsubtitle`='$viewsubtitle',
    								`viewtype`='$viewtype', `cols`='$cols', `rows`='$rows'  
    								WHERE `Id`='$UID'";
    				// echo $query ;
    				mysql_db_query($mysql_dbname,$query,$connect);
    			
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
					
						$query = "UPDATE `shop_cate` SET `$rows1[code]`='".$_POST[$_catename]."'  WHERE `Id`='$UID'";
    					echo $query."<br>"; 	
    					mysql_db_query($mysql_dbname,$query,$connect);
							
					}				
				}	
    			
    			
    			
    			page_back2();
    			// echo "<meta http-equiv='refresh' content='0; url=admin_cate.php'>";
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_cateedit");
    					
    			include "admin_goods_left.php";
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_cate` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked $cssFormStyle >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);
					
					// $body = str_replace("{domain}","<input type='text' name='domain' value='$rows[domain]' $cssFormStyle >",$body);
					$body = str_replace("{cate_name}","<input type='text' name='catecode' value='$rows[catename]' $cssFormStyle >",$body);
	
					if($rows[linkurl])
					$body = str_replace("{linkurl}","<input type='checkbox' name='linkurl' checked $cssFormStyle >",$body);
					else $body = str_replace("{linkurl}","<input type='checkbox' name='linkurl' $cssFormStyle >",$body);
					
					$body = str_replace("{linkurl_page}","<input type='text' name='linkurl_page' value='$rows[linkurl_page]' $cssFormStyle >",$body);
					
					
					if($rows[imageview])
					$body = str_replace("{imageview}","<input type='checkbox' name='imageview' checked $cssFormStyle >",$body);
					else $body = str_replace("{imageview}","<input type='checkbox' name='imageview' $cssFormStyle >",$body);
					
					$body = str_replace("{imagesize}","<input type='text' name='imagesize' value='$rows[imagesize]' $cssFormStyle >",$body);
	
	
					if($rows[viewspec])
					$body = str_replace("{spec}","<input type='checkbox' name='viewspec' checked $cssFormStyle >",$body);
					else $body = str_replace("{spec}","<input type='checkbox' name='viewspec' $cssFormStyle >",$body);
					
					if($rows[viewsubtitle])
					$body = str_replace("{subtitle}","<input type='checkbox' name='viewsubtitle' checked $cssFormStyle >",$body);
					else $body = str_replace("{subtitle}","<input type='checkbox' name='viewsubtitle' $cssFormStyle >",$body);
					
	
	
					$body = str_replace("{viewtype}","<input type='text' name='viewtype' value='$rows[viewtype]' $cssFormStyle >",$body);
					$body = str_replace("{cols}","<input type='text' name='cols' value='$rows[cols]' $cssFormStyle >",$body);
					$body = str_replace("{rows}","<input type='text' name='rows' value='$rows[rows]' $cssFormStyle >",$body);
	
					if($rows[cate_skin])
					$body = str_replace("{cate_skin}","<input type='checkbox' name='cate_skin' checked $cssFormStyle >",$body);
					else $body = str_replace("{cate_skin}","<input type='checkbox' name='cate_skin' $cssFormStyle >",$body);
	
					$cate_skinhtml = stripslashes($rows[cate_skinhtml]);
					$body = str_replace("{cate_skinhtml}","<textarea name='cate_skinhtml' rows='10' style='width:100%'>$cate_skinhtml</textarea>",$body);
					
					$cate_skinmobile = stripslashes($rows[cate_skinmobile]);
					$body = str_replace("{cate_skinmobile}","<textarea name='cate_skinmobile' rows='10' style='width:100%'>$cate_skinmobile</textarea>",$body);
	
	
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

	
	
	
				
			
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);		
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_cateedit.php?mode=del&UID=$UID\")' $css_submit >",$body);
							

					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


	
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

