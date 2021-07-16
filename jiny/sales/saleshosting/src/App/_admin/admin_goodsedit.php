<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; 
	include "../mobile.php";

	include "./func_adminskin.php";
	include "./func_admingoods.php";
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	
	include "../thumbnail.php";
	
	include "./func_adminstring.php";
	
	
	if($_COOKIE[adminemail]){ ///////////////
	
		$limit = $_POST['limit']; if(!$limit) $limit = $_GET['limit'];
		$countrycode = $COUNTRY;
				
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
		$countryCode = $_GET['code']; if(!$countryCode) $countryCode = $_POST['code']; if(!$countryCode) $countryCode = $COUNTRY; 
				
		switch($mode){
			case 'del':
				$query = "DELETE FROM `shop_goods` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
				// echo "<meta http-equiv='refresh' content='0; url=admin_goods.php?cate=".$_GET['callcate']."&limit=$limit&code=$countryCode'>";
				page_back2();
				break;
				
			case 'editup':
			
				$enable = $_POST['enable'];
    			$barcode = $_POST['barcode'];
    			$goodcode = $_POST['goodcode'];
    			$name = $_POST['name'];
    						
    			$spec = $_POST['spec'];
    			$subtitle = $_POST['subtitle'];
    						
    			$optionitem = $_POST['optionitem'];
    						
    			$model = $_POST['model'];
    			$brand = $_POST['brand'];
    			$barcode = $_POST['barcode'];
    			$cate = $_POST['cate'];
    			$company = $_POST['company'];
    			$company1 = $_POST['company1'];
    						
    			$buy_currency = $_POST['buy_currency'];
    			$prices_buy = $_POST['prices_buy'];
    			$sell_currency = $_POST['sell_currency'];
    			$prices_sell = $_POST['prices_sell'];
    						
    			if($_POST['vat']) $vat="checked"; else $vat="";
    			$vatrate = $_POST['vatrate'];
    						
    			$stock = $_POST['stock'];
    						
    			$html_desktop = $_POST['html_desktop'];
    			$html_mobile = $_POST['html_mobile'];
    					
    			$detail1 = $_POST['detail1'];
    			$detail2 = $_POST['detail2'];
    			$detail3 = $_POST['detail3'];
    			
    			$form_ordertext = $_POST['form_ordertext'];
    				
							// if($name){ //언어별 상품등록으로, 스킵
    			$query = "UPDATE `shop_goods` SET `code`='$goodcode', `cate`='$cate', `goodname`='$name', `spec`='$spec', `subtitle`='$subtitle'
    						, `buy_currency`='$buy_currency', `prices_buy`='$prices_buy'
    						, `sell_currency`='$sell_currency', `prices_sell`='$prices_sell'
    						, `model`='$model', `brand`='$brand', `barcode`='$barcode', `enable`='$enable' , `optionitem`='$optionitem'
    						, `vat`='$vat', `vatrate`='$vatrate', `stock`='$stock', `blog`='$blog', 
    						`form_ordertext`='$form_ordertext',
    						`html_desktop`='$html_desktop', `html_mobile`='$html_mobile' WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    					
    							///////////////////
    					
    							if ($_FILES["userfile1"][tmp_name]){

    								if(!is_dir("../goodimgs")) $an = mkdir("../goodimgs");
  			
									$uploadfile1  = "../goodimgs/".$_FILES[userfile1][name];
					
									$i=1;
									if ($_FILES["userfile".$i][tmp_name]) {
   										$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   										if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   									}	
						
									if ($_FILES["userfile1"][tmp_name]) $filename1 = "../goodimgs/goodimgs1_$COUNTRY-$UID";
		
      								if ($_FILES["userfile".$i][tmp_name]) {
         								move_uploaded_file($_FILES["userfile".$i][tmp_name], "../goodimgs/goodimgs1_$COUNTRY-$UID.".$ext);
      								}
      							
      								thumbnail_squre($filename1.".".$ext,"../goodimgs/goodimgs1_$COUNTRY-$UID.s.".$ext,"100","100");
      						
      								$query = "UPDATE `shop_goods` SET `images1`='./goodimgs/goodimgs1_$COUNTRY-$UID.".$ext."'  WHERE `Id`='$UID'";
    								mysql_db_query($mysql_dbname,$query,$connect);
      						
      							}
    						
    							
    							///////////////////
    							
    							if ($_FILES["userfile4"][tmp_name]){

    								if(!is_dir("../goodimgs")) $an = mkdir("../goodimgs");
  			
									$uploadfile4  = "../goodimgs/".$_FILES[userfile4][name];
					
									$i=4;
									if ($_FILES["userfile".$i][tmp_name]) {
   										$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   										if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 	
   									}	
						
									if ($_FILES["userfile4"][tmp_name]) $filename4 = "../goodimgs/detail1_$COUNTRY-$UID";
		
						
      								if ($_FILES["userfile".$i][tmp_name]) {
         								move_uploaded_file($_FILES["userfile".$i][tmp_name], "../goodimgs/detail1_$COUNTRY-$UID.".$ext);
         							}
      							
      								// thumbnail_squre($filename4.".".$ext,"../goodimgs/detail1_$COUNTRY-$UID.s.".$ext,"100","100");
      						
      								$query = "UPDATE `shop_goods` SET `detail1`='./goodimgs/detail1_$COUNTRY-$UID.".$ext."'  WHERE `Id`='$UID'";
    								mysql_db_query($mysql_dbname,$query,$connect);
      						
      							}
    						
    							///////////////////
    						
    							if ($_FILES["userfile5"][tmp_name]){

    								if(!is_dir("../goodimgs")) $an = mkdir("../goodimgs");
  			
									$uploadfile5  = "../goodimgs/".$_FILES[userfile5][name];
					
									$i=5;
									if ($_FILES["userfile".$i][tmp_name]) {
   										$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   										if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 	
   									}	
						
									if ($_FILES["userfile5"][tmp_name]) $filename5 = "../goodimgs/detail2_$COUNTRY-$UID";
		
						
      								if ($_FILES["userfile".$i][tmp_name]) {
         								move_uploaded_file($_FILES["userfile".$i][tmp_name], "../goodimgs/detail2_$COUNTRY-$UID.".$ext);
         							}
      							
      								// thumbnail_squre($filename5.".".$ext,"../goodimgs/detail2_$COUNTRY-$UID.s.".$ext,"100","100");
      						
      								$query = "UPDATE `shop_goods` SET `detail2`='./goodimgs/detail2_$COUNTRY-$UID.".$ext."'  WHERE `Id`='$UID'";
    								mysql_db_query($mysql_dbname,$query,$connect);
      						
      							}
    							
    							///////////////////

    		 						


    						//}	
						
						
						//% 국가별 판매 세팅
							$query1 = "select * from `shop_country` ";	
							$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    						$total1 = mysql_result($result1,0,0);
		
							$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
							if(mysql_affected_rows()){
								$selling_country = "";
								for($i=0;$i<$total1;$i++){
									$rows1=mysql_fetch_array($result1);
									if($_POST[$rows1[code]]) $selling_country .= "$rows1[code];";	
								}
								
								$query = "UPDATE `shop_goods` SET `country`='$selling_country'  WHERE `Id`='$UID'";
    							mysql_db_query($mysql_dbname,$query,$connect);
							}						
					
						
						//# 언어별 상품정보 갱신
						$query1 = "select * from `shop_language` ";	
						$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    					$total1 = mysql_result($result1,0,0);
						
						
						$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
						if(mysql_affected_rows()){
							for($i=0;$i<$total1;$i++){
								$rows1=mysql_fetch_array($result1);
								$_goodname = "goodname_".$rows1[code];
								$_spec = "spec_".$rows1[code];
								$_subtitle = "subtitle_".$rows1[code];
								$_optionitem = "optionitem_".$rows1[code];
								
								$_html_desktop = "html_desktop_".$rows1[code];
								$_html_mobile = "html_mobile_".$rows1[code];
								
								$_seo_title = "seo_title_".$rows1[code];
								$_seo_description = "seo_description_".$rows1[code];
								$_seo_keyword = "seo_keyword_".$rows1[code];
								
								
								$query = "UPDATE `shop_goods` SET `$_goodname`='".$_POST[$_goodname]."'  WHERE `Id`='$UID'";
    							mysql_db_query($mysql_dbname,$query,$connect);
    							
    							_goodstring_update($UID,$rows1[code],"goodname",$_POST[$_goodname]);
    							
    							
    							$query = "UPDATE `shop_goods` SET `$_spec`='".$_POST[$_spec]."'  WHERE `Id`='$UID'";
    							mysql_db_query($mysql_dbname,$query,$connect);
    							
    							_goodstring_update($UID,$rows1[code],"spec",$_POST[$_spec]);
    							
    							$query = "UPDATE `shop_goods` SET `$_subtitle`='".$_POST[$_subtitle]."'  WHERE `Id`='$UID'";
    							mysql_db_query($mysql_dbname,$query,$connect);
    							
    							_goodstring_update($UID,$rows1[code],"subtitle",$_POST[$_subtitle]);
    							
    							$query = "UPDATE `shop_goods` SET `$_optionitem`='".$_POST[$_optionitem]."'  WHERE `Id`='$UID'";
    							mysql_db_query($mysql_dbname,$query,$connect);
    							
    							_goodstring_update($UID,$rows1[code],"optionitem",$_POST[$_optionitem]);
    							
    							$query = "UPDATE `shop_goods` SET `$_html_desktop`='".$_POST[$_html_desktop]."'  WHERE `Id`='$UID'";
    							mysql_db_query($mysql_dbname,$query,$connect);
    							
    							_goodstring_update($UID,$rows1[code],"desktop",$_POST[$_html_desktop]);
    							
    							$query = "UPDATE `shop_goods` SET `$_html_mobile`='".$_POST[$_html_mobile]."'  WHERE `Id`='$UID'";
    							mysql_db_query($mysql_dbname,$query,$connect);
    							
    							_goodstring_update($UID,$rows1[code],"mobile",$_POST[$_html_mobile]);
    							
    							
    							_goodstring_update($UID,$rows1[code],"seo_title",$_POST[$_seo_title]);
    							_goodstring_update($UID,$rows1[code],"seo_description",$_POST[$_seo_description]);
    							_goodstring_update($UID,$rows1[code],"seo_keyword",$_POST[$_seo_keyword]);
    							
								//}
							
							}
								
							
						}		
						
					
				if($_POST['call_ID']){
					page_back2();
					//echo "<meta http-equiv='refresh' content='0; url=../shop_goodview.php?UID=".$_POST['call_ID']."&code=$countryCode'>";
				} else { 
					page_back2();
					// echo "<meta http-equiv='refresh' content='0; url=admin_goods.php?cate=".$_POST['callcate']."&limit=$limit&code=$countryCode'>";
				}
			
					
				break;

		case 'edit':
		default:
			//# 화면 디자인 템플릿을 스킨 읽어옵니다.			 
    		$body = admin_shopskin("admin_goodsedit");   					
						
    		$result=mysql_db_query($mysql_dbname,"select * from `shop_goods` where Id = '$UID'",$connect);
			if( mysql_affected_rows() ){ 
		    	$GOO=mysql_fetch_array($result);

				$body=str_replace("{formstart}","<form name='good' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='code' value='$countryCode'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='call_ID' value='".$_GET['call_ID']."'>
										<input type='hidden' name='UID' value='$UID'>
										<input type='hidden' name='callcate' value='".$_GET['cate']."'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
							
							
				if($GOO[enable]){
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
				} else {
					$body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
				}
				
				if($GOO[form_ordertext]){
					$body = str_replace("{form_ordertext}","<input type='checkbox' name='form_ordertext' checked >",$body);
				} else {
					$body = str_replace("{form_ordertext}","<input type='checkbox' name='form_ordertext' >",$body);
				}


			
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
									
									$goodstring = _goodstring($UID,$rows1[code]);
									
									$products_forms .="<div class='tab-$i_content'>
													   
													   <table border='0' width='100%' cellspacing='5' cellpadding='5' 
																			style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
													<tr>
														<td width='110' align='right'><font size='2'>상품명<b>($rows1[code])</b></font></td>
														<td><textarea name='goodname_$rows1[code]' rows='2' style='width:100%'>$goodstring[goodname]</textarea></td>
													</tr>
													<tr>
													<td width='110' align='right'><font size='2'>스팩<b>($rows1[code])</b></font></td>
														<td><textarea name='spec_$rows1[code]' rows='2' style='width:100%'>$goodstring[spec]</textarea></td>
													</tr>
													<tr>
														<td width='110' align='right'><font size='2'>간략설명<b>($rows1[code])</b></font></td>
														<td><textarea name='subtitle_$rows1[code]' rows='2' style='width:100%'>$goodstring[subtitle]</textarea></td>
													</tr>
													<tr>
														<td width='110' align='right'><font size='2'>옵션<b>($rows1[code])</b></font></td>
														<td><textarea name='optionitem_$rows1[code]' rows='2' style='width:100%'>$goodstring[optionitem]</textarea></td>
													</tr>
													<tr>
														<td width='110' align='right' valign='top'><font size='2'>HTML PC</font></td>
														<td><textarea name='html_desktop_$rows1[code]' rows='10' style='width:100%'>$goodstring[desktop]</textarea></td>
													</tr>
													<tr>
														<td width='110' align='right' valign='top'><font size='2'>HTML MOBILE</font></td>
														<td><textarea name='html_mobile_$rows1[code]' rows='10' style='width:100%'>$goodstring[mobile]</textarea></td>
													</tr>
													</table>
													   
													   </div>";
									 
									
								}
								
								//$body = str_replace("{selling_language}","$products_language",$body);
								//$body = str_replace("{selling_language_form}","$products_forms",$body);
								
								$tabbar = "<div id='css_tabs'>
											$products_language
											$products_forms
											</div>";
								$body = str_replace("{selling_language_form}",$tabbar,$body);			
								
								
							}
    						

    						
    						
				$body = str_replace("{name}","<input type='text' name='name' value='$GOO[goodname]'$cssFormStyle >",$body);
				$body = str_replace("{spec}","<input type='text' name='spec' value='$GOO[spec]' $cssFormStyle >",$body);
				$body = str_replace("{subtitle}","<input type='text' name='subtitle' value='$GOO[subtitle]' $cssFormStyle >",$body);
				$body = str_replace("{option}","<input type='text' name='optionitem' value='$GOO[optionitem]' $cssFormStyle >",$body);
										
				$body = str_replace("{startselling}","<input type='date' name='startselling'  value='$GOO[startselling]' >",$body);
				$body = str_replace("{endselling}","<input type='date' name='startselling'  value='$GOO[endselling]' >",$body);
							
							
				$body = str_replace("{scan}",$barcodeScan,$body);
				$body = str_replace("{barcode}","<input type='text' name='barcode' id ='barcode' value='$GOO[barcode]' $cssFormStyle >",$body);			
				$body = str_replace("{goodcode}","<input type='text' name='goodcode' value='$GOO[code]' $cssFormStyle >",$body);			
				$body = str_replace("{model}","<input type='text' name='model' value='$GOO[model]' $cssFormStyle >",$body);
				$body = str_replace("{brand}","<input type='text' name='brand' value='$GOO[brand]' $cssFormStyle >",$body);
							

				//# 매입 통화설정
				$query1 = "select * from `shop_currency`";
				$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1=mysql_result($result1,0,0);
		
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$buy_currency = "<select name='buy_currency' $cssFormStyle>";
					for($ii=0;$ii<$total1;$ii++){
						$rows1=mysql_fetch_array($result1);
						if($GOO[buy_currency] == $rows1[currency]) $buy_currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
						else $buy_currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
					}
					$body = str_replace("{buy_currency}",$buy_currency,$body);
				}
						
				$body = str_replace("{prices_buy}","<input type='text' name='prices_buy' value='$GOO[prices_buy]' $cssFormStyle >",$body);
							
							
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
							
				$body = str_replace("{prices_sell}","<input type='text' name='prices_sell' value='$GOO[prices_sell]' $cssFormStyle >",$body);
				
				
				
				// 부가세, 부가세율, 재고			
				if($GOO[vat]) $body = str_replace("{vat}","<input type='checkbox' name='vat' checked>",$body);
				else $body = str_replace("{vat}","<input type='checkbox' name='vat' >",$body);
			
				$body = str_replace("{vatrate}","<input type='text' name='vatrate' value='$GOO[vatrate]' $cssFormStyle >",$body);
				$body = str_replace("{stock}","<input type='text' name='stock' value='$GOO[stock]' $cssFormStyle >",$body);

							
				//# 상품이미지
				$body = str_replace("{goodimg1}","<input type='file' name='userfile1' >",$body);
				if($GOO[images1]) $body = str_replace("{images1}","<img src='.$GOO[images1]' border='0' width='200'>",$body);
				else $body = str_replace("{images1}","&nbsp;",$body);
							
				$body = str_replace("{goodimg2}","<input type='file' name='userfile2' >",$body);
				if($GOO[images2]) $body = str_replace("{images2}","<img src='.$GOO[images2]' border='0' width='200'>",$body);
				else $body = str_replace("{images2}","&nbsp;",$body);			
		
				$body = str_replace("{goodimg3}","<input type='file' name='userfile3' >",$body);
				if($GOO[images3]) $body = str_replace("{images3}","<img src='.$GOO[images3]' border='0' width='200'>",$body);
				else $body = str_replace("{images3}","&nbsp;",$body);			
							
				//# 첨부파일 
				$body = str_replace("{filename1}","<input type='file' name='userfile4'>",$body);
				$body = str_replace("{filelink1}","&lt;img src='".$GOO[detail1]."' border=0&gt;",$body);
				
				$body = str_replace("{filename2}","<input type='file' name='userfile5'>",$body);
				$body = str_replace("{filelink1}","&lt;img src='".$GOO[detail2]."' border=0&gt;",$body);
				
				$body = str_replace("{filename3}","<input type='file' name='userfile6'>",$body);
				$body = str_replace("{filelink1}","&lt;img src='".$GOO[detail3]."' border=0&gt;",$body);
				
				$body = str_replace("{filename4}","<input type='file' name='userfile7'>",$body);
				$body = str_replace("{filelink1}","&lt;img src='".$GOO[detail4]."' border=0&gt;",$body);
				
				$body = str_replace("{filename5}","<input type='file' name='userfile8'>",$body);
				$body = str_replace("{filelink1}","&lt;img src='".$GOO[detail5]."' border=0&gt;",$body);

							
				////////////////						
				//# 카테고리 설정
				$body = str_replace("{cate}",_form_cate_select($GOO[cate]),$body);
		

				$body = str_replace("{quickedit}","<input type='button' name='quickedit' value='간편수정' onclick='quickedit()' style='font-size:9pt'>",$body);
				$body = str_replace("{blog}","<input type='text' name='blog' value='$GOO[blog]' $cssFormStyle >",$body);
							
				$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_goodsedit.php?mode=del&UID=$UID\")' $css_submit>",$body);
				$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit>",$body);
				
				//%%%%%%%%%
				//# 상품설명	
				/*		
				$body = str_replace("{html_desktop}","<textarea name='html_desktop' rows='10' style='width:100%'>$GOO[html_desktop]</textarea>",$body);
				$body = str_replace("{html_mobile}","<textarea name='html_mobile' rows='10' style='width:100%'>$GOO[html_desktop]</textarea>",$body);
				*/
				
				//# 번역스트링 처리
				$body = _adminstring_converting($body);	
				echo $body;
						
							
			} else echo "<meta http-equiv='refresh' content='0; url=admin_goods.php'>";
			
			break;		
							
		}
				
				
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
			
	

?>

