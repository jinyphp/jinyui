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
	include "./func_admingoods.php";
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	
	include "./func_curl.php";
	
	include "./func_adminstring.php";
    
	if($_COOKIE[adminemail]){ ///////////////
	
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
		
		switch($mode){
    		case 'saveup':
    			$rows = json_decode($_POST['json'],true);
    			
    			//# 서버에 입점판매자 정보 삽입
    			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);
    			$language = $_SESSION['language'];
    			
    			$query = "select * from `shop_seo` where domain = '$domain' and language ='$language'";
				echo $query."<br>";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					$seo=mysql_fetch_array($result);
				}
		
    			$post_value  = "domain=$domain&";
    			$post_value .= "reseller=$seo[title]&";
    			$post_value .= "GID=".$_POST['GID']."&";
    			$post_value .= "sell_prices=".$_POST['prices_sell']."&";
    			$post_value .= "buy_prices=".$_POST['prices_buy']."&";
    			
    			$post_value .= "sell_currency=".$_POST['sell_currency']."&";
    			$post_value .= "buy_currency=".$_POST['buy_currency']."&";

    			$aaa = fetch_page("http://www.dojangshop.co.kr/admin/server_goods_seller.php",$post_value,$cookies,$referer_url);
    		
    		
    		
    			page_back2();
    			break;
			default:
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
				$body = admin_shopskin("admin_api_goodsave");
		
				$MID = $_GET['MID'];
				$json = fetch_page("http://www.dojangshop.co.kr/admin/server_good_info.php","MID=$MID",$cookies,$referer_url);
				$rows = json_decode($json,true);
			
				$body=str_replace("{formstart}","<form name='skin' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='GID' value='$rows[GID]'>
					    				<input type='hidden' name='mode' value='saveup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
		
		
				$body = str_replace("{images}","<img src='$rows[images]' border='0' width='100'>",$body);
				$body = str_replace("{description}","$rows[description]",$body);
				
				$body = str_replace("{autoorder}","<input type='checkbox' name='autoorder' >",$body);
				
				//%%%%%%%%%%%%%
				//% 판매국가 설정
				$body = str_replace("{#selling_country}","<font size=2><a href='admin_country.php' title='판매국가'>판매국가 설정 •</a></font>",$body);
							
				$query1 = "select * from `shop_country` ";	
				$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1 = mysql_result($result1,0,0);
		
				$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()){
					$country_check = explode(";",$GOO[country]);

					$selling_country = "";
					for($i=0;$i<$total1;$i++){
						$rows1=mysql_fetch_array($result1);
						for($country_flag = "", $k=0;$k<count($country_check); $k++){
							if($country_check[$k] == $rows1[code]) $country_flag = "TRUE";
						} 
									
						if($country_flag) $selling_country .= "<b>$rows1[code]</b> <input type='checkbox' name='$rows1[code]' checked> /";
						else $selling_country .= "$rows1[code] <input type='checkbox' name='$rows1[code]' > / ";	
					}
					$body = str_replace("{selling_country}","$selling_country",$body);
				}

		
				////////////////						
				//# 카테고리 설정
				$body = str_replace("{cate}",_form_cate_select($GOO[cate]),$body);
		
				
				//# 매입 통화설정
				$query1 = "select * from `shop_currency`";
				$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1=mysql_result($result1,0,0);
		
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$buy_currency = "<select name='buy_currency' $cssFormStyle>";
					for($ii=0;$ii<$total1;$ii++){
						$rows1=mysql_fetch_array($result1);
						if($rows[currency] == $rows1[currency]) $buy_currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
						else $buy_currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
					}
					$body = str_replace("{buy_currency}",$buy_currency,$body);
				}
						
				
							
							
				//# 판매 통화설정
				$query1 = "select * from `shop_currency`";
				$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1=mysql_result($result1,0,0);
		
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$sell_currency = "<select name='sell_currency' $cssFormStyle>";
					for($ii=0;$ii<$total1;$ii++){
						$rows1=mysql_fetch_array($result1);
						if($GOO[sell_currency] == $rows1[currency]) $sell_currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
						else $sell_currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
					}
					$body = str_replace("{sell_currency}",$sell_currency,$body);
				}			
							
				
				
				$body = str_replace("{sell_prices}","<input type='text' name='prices_sell' id ='barcode' value='$rows[sell_prices]' $cssFormStyle >",$body);			
				$body = str_replace("{supply_prices}","<input type='text' readonly name='prices_buy' value='$rows[supply_prices]' $cssFormStyle >",$body);
				
				
				$body = str_replace("{barcode}","<input type='text' name='barcode'  $cssFormStyle >",$body);			
				$body = str_replace("{goodcode}","<input type='text' name='goodcode' $cssFormStyle >",$body);			
				$body = str_replace("{model}","<input type='text' name='model'  $cssFormStyle >",$body);
				$body = str_replace("{brand}","<input type='text' name='brand' $cssFormStyle >",$body);
				

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
									
						$_goodname = "goodname_".$rows1[code];
						$_spec = "spec_".$rows1[code];
						$_subtitle = "subtitle_".$rows1[code];
						$_optionitem = "optionitem_".$rows1[code];
						$_html_desktop = "html_desktop_".$rows1[code];
						$_html_mobile = "html_mobile_".$rows1[code];
						
						$language = $rows1[code];			
						$goodname = json_decode($rows[goodname],true);
						$spec = json_decode($rows[spec],true);
						$subtitle = json_decode($rows[subtitle],true);
						$option = json_decode($rows[option],true);
						$desktop = json_decode($rows[desktop],true);
						$mobile = json_decode($rows[mobile],true);
	
						$products_forms .="<div class='tab-$i_content'>
				  
										   <table border='0' width='100%' cellspacing='5' cellpadding='5' 
																style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
											<tr>
											<td width='110' align='right'><font size='2'>상품명<b>($rows1[code])</b></font></td>
											<td><textarea name='goodname_$rows1[code]' rows='2' style='width:100%'>$goodname[$language]</textarea></td>
											</tr>
											<tr>
											<td width='110' align='right'><font size='2'>스팩<b>($rows1[code])</b></font></td>
											<td><textarea name='spec_$rows1[code]' rows='2' style='width:100%'>$spec[$language]</textarea></td>
											</tr>
											<tr>
											<td width='110' align='right'><font size='2'>간략설명<b>($rows1[code])</b></font></td>
											<td><textarea name='subtitle_$rows1[code]' rows='2' style='width:100%'>$subtitle[$language]</textarea></td>
											</tr>
											<tr>
											<td width='110' align='right'><font size='2'>옵션<b>($rows1[code])</b></font></td>
											<td><textarea name='optionitem_$rows1[code]' rows='2' style='width:100%'>$option[$language]</textarea></td>
											</tr>
											<tr>
											<td width='110' align='right' valign='top'><font size='2'>HTML PC</font></td>
											<td><textarea name='html_desktop_$rows1[code]' rows='10' style='width:100%'>$desktop[$language]</textarea></td>
											</tr>
											<tr>
											<td width='110' align='right' valign='top'><font size='2'>HTML MOBILE</font></td>
											<td><textarea name='html_mobile_$rows1[code]' rows='10' style='width:100%'>$mobile[$language]</textarea></td>
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



				$body = str_replace("{submit}","<input type='submit' name='reg' value='입점승인' $css_submit >",$body);
		
		}
		
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";

?>
