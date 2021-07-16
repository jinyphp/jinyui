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
	
		$limit = $_POST['limit']; if(!$limit) $limit = $_GET['limit'];
		$countrycode = $COUNTRY;

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	$countryCode = $_GET['code']; if(!$countryCode) $countryCode = $_POST['code']; if(!$countryCode) $countryCode = $COUNTRY; 
    			
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    	$body = admin_shopskin("admin_goodsnew");		
    					
    			include "admin_goods_left.php";
    		
				$body=str_replace("{formstart}","<form name='good' method='post' enctype='multipart/form-data' action='admin_goodsnewup.php'>
										<input type='hidden' name='code' value='$countryCode'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='nonce' value='$nonce'>
										<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
							
				$body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);
				
				$body = str_replace("{scan}",$barcodeScan,$body);
				$body = str_replace("{barcode}","<input type='text' name='barcode' id ='barcode' value='$GOO[barcode]' $cssFormStyle >",$body);
							
							
				$body = str_replace("{goodcode}","<input type='text' name='goodcode' value='$GOO[code]' $cssFormStyle >",$body);
				$body = str_replace("{name}","<input type='text' name='name' value='$GOO[goodname]'$cssFormStyle >",$body);
							
				$body = str_replace("{spec}","<input type='text' name='spec' value='$GOO[spec]' $cssFormStyle >",$body);
				$body = str_replace("{subtitle}","<input type='text' name='subtitle' value='$GOO[subtitle]' $cssFormStyle >",$body);
				
				$body = str_replace("{option}","<input type='text' name='optionitem' value='$GOO[optionitem]' $cssFormStyle >",$body);
							
				$body = str_replace("{model}","<input type='text' name='model' value='$GOO[model]' $cssFormStyle >",$body);
				$body = str_replace("{brand}","<input type='text' name='brand' value='$GOO[brand]' $cssFormStyle >",$body);
							
							
							$buy_currency = "<select name='buy_currency' $cssFormStyle>";
							if($GOO[buy_currency] == "KRW") $buy_currency .= "<option value='KRW' selected>KRW</option>"; else $buy_currency .= "<option value='KRW'>KRW</option>";
							if($GOO[buy_currency] == "USD") $buy_currency .= "<option value='USD' selected>USD</option>"; else $buy_currency .= "<option value='USD'>USD</option>";
							if($GOO[buy_currency] == "JYP") $buy_currency .= "<option value='JYP' selected>JYP</option>"; else $buy_currency .= "<option value='JYP'>JYP</option>";
							if($GOO[buy_currency] == "CNY") $buy_currency .= "<option value='CNY' selected>CNY</option>"; else $buy_currency .= "<option value='CNY'>CNY</option>";
							if($GOO[buy_currency] == "SGD") $buy_currency .= "<option value='SGD' selected>SGD</option>"; else $buy_currency .= "<option value='SGD'>SGD</option>";
							$buy_currency .= "</select>";
							
							$body = str_replace("{buy_currency}",$buy_currency,$body);
							
							
							$body = str_replace("{prices_buy}","<input type='text' name='prices_buy' value='$GOO[prices_buy]' $cssFormStyle >",$body);
							
							
							
							$sell_currency = "<select name='sell_currency' $cssFormStyle>";
							if($GOO[sell_currency] == "KRW") $sell_currency .= "<option value='KRW' selected>KRW</option>"; else $sell_currency .= "<option value='KRW'>KRW</option>";
							if($GOO[sell_currency] == "USD") $sell_currency .= "<option value='USD' selected>USD</option>"; else $sell_currency .= "<option value='USD'>USD</option>";
							if($GOO[sell_currency] == "JYP") $sell_currency .= "<option value='JYP' selected>JYP</option>"; else $sell_currency .= "<option value='JYP'>JYP</option>";
							if($GOO[sell_currency] == "CNY") $sell_currency .= "<option value='CNY' selected>CNY</option>"; else $sell_currency .= "<option value='CNY'>CNY</option>";
							if($GOO[sell_currency] == "SGD") $sell_currency .= "<option value='SGD' selected>SGD</option>"; else $sell_currency .= "<option value='SGD'>SGD</option>";
							$sell_currency .= "</select>";
							$body = str_replace("{sell_currency}",$sell_currency,$body);
							$body = str_replace("{prices_sell}","<input type='text' name='prices_sell' value='$GOO[prices_sell]' $cssFormStyle >",$body);
							
							if($GOO[vat]){
								$body = str_replace("{vat}","<input type='checkbox' name='vat' checked>",$body);
							} else {
								$body = str_replace("{vat}","<input type='checkbox' name='vat' >",$body);
							}
							
							$body = str_replace("{vatrate}","<input type='text' name='vatrate' value='$GOO[vatrate]' $cssFormStyle >",$body);
							$body = str_replace("{stock}","<input type='text' name='stock' value='$GOO[stock]' $cssFormStyle >",$body);

							$body = str_replace("{goodimg1}","<input type='file' name='userfile1' >",$body);
							$body = str_replace("{goodimg2}","<input type='file' name='userfile2' >",$body);
							$body = str_replace("{goodimg3}","<input type='file' name='userfile3' >",$body);
							
							$body = str_replace("{filename1}","<input type='file' name='userfile4' >",$body);
							$body = str_replace("{filename2}","<input type='file' name='userfile5' >",$body);
							$body = str_replace("{filename3}","<input type='file' name='userfile6' >",$body);
							
							
							////////////////
							
							$query = "select * from `shop_goods`";
							$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    						$total=mysql_result($result,0,0);
		
							// Caterory1
							$query = "select * from `shop_goods` group by cate desc";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
    						if(mysql_affected_rows()){
    							$cate1_form = "<select name='cate1' onChange=\"javascript:setCate(this)\" $cssFormStyle>";
    							$cate1_form .= "<option value=''>카테고리 선택</option>";

    							while(1){
    								$rows=mysql_fetch_array($result);
    								if($rows[cate]) $cate1_form .= "<option value='$rows[cate]' >$rows[cate]</option>";
    								else break;
    							}
    							$cate1_form .= "</select>";
    		
    						}
							$body = str_replace("{cate1}","$cate1_form",$body);
							
							
							$body = str_replace("{cate}","<input type='text' name='cate' value='$GOO[cate]' $cssFormStyle >",$body);
							
							
							$body = str_replace("{comment}","<textarea name='description' rows='4' style='width:100%' >$GOO[description]</textarea>",$body);
		
							
							
							$body = str_replace("{submit}","<input type='submit' name='reg' value='저장' $css_submit >",$body);
							
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
			
		echo $body;
			
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

