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
    	$body = admin_shopskin("admin_catenew");
    			
		include "admin_goods_left.php";
		
    	$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='admin_catenewup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='UID' value='".$_GET['UID']."'>
					    				<input type='hidden' name='POS' value='".$_GET['pos']."'>
					    				<input type='hidden' name='LEVEL' value='".$_GET['level']."'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
		$body = str_replace("{formend}","</form>",$body);
											
		$body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);
		$body = str_replace("{cate_name}","<input type='text' name='catecode' $cssFormStyle >",$body);
		
		/////////////		
							
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
									
				$products_forms .="<div class='tab-$i_content'>
								  <table border='0' width='100%' cellspacing='5' cellpadding='5' 
																			style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
								<tr>
								<td width='110' align='right'><font size='2'>메뉴명<b>($rows1[code])</b></font></td>
								<td><textarea name='catename_$rows1[code]' rows='2' style='width:100%'>$GOO[$_goodname]</textarea></td>
								</tr>
								<tr>
								<td width='110' align='right'><font size='2'>스킨이름<b>($rows1[code])</b></font></td>
								<td><textarea name='skinname_$rows1[code]' rows='2' style='width:100%'>$GOO[$_spec]</textarea></td>
								</tr>
								<tr>
									<td width='110' align='right' valign='top'><font size='2'>스킨 HTML PC</font></td>
									<td><textarea name='html_desktop_$rows1[code]' rows='10' style='width:100%'>$GOO[$_html_desktop]</textarea></td>
								</tr>
								<tr>
									<td width='110' align='right' valign='top'><font size='2'>스킨 HTML MOBILE</font></td>
									<td><textarea name='html_mobile_$rows1[code]' rows='10' style='width:100%'>$GOO[$_html_mobile]</textarea></td>
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
    				
		////////////
		

		$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
							
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		
		echo $body;
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";


?>

