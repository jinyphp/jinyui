<?php

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	$query = "select * from eximbay";
    if( $eximbay = _mysqli_query_rows($query) ){
    
    	// $secretKey = "289F40E6640124B2628640168C3C5464";	//set merchant's secretkey
		$secretKey = $eximbay->secretKey;

		// $mid = "1849705C64";			//set merchant's mid
		$mid = $eximbay->mid;

		// 결제승인 유일도유키값 생성
		/*
		$query = "select * from eximbay_trans order by Id desc";
    	$rows = _mysqli_query_rows($query);
    	$rows_id = $rows->Id + 1;
		$trans_ref = md5('eximbay'.$TODAYTIME.microtime())."-$rows_id"; 
		*/

		$ref = $_POST['ref'];
  	
	
		$shop = $_POST['shop'];
		$lang = $_POST['lang'];

		$returnurl = $_POST['returnurl'];
		$statusurl = $_POST['statusurl'];

		$charset = $_POST['charset'];

		$param1 = $_POST['param1'];
		$param2 = $_POST['param2'];
		$param3 = $_POST['param3'];

		$displaytype = $_POST['displaytype'];

		$cur = $_POST['cur'];
		$product = $_POST['product'];
		$buyer = $_POST['buyer'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$amt = $_POST['amt'];

		$dm_item_0_product = $_POST['dm_item_0_product'];
		$dm_item_0_quantity = $_POST['dm_item_0_quantity'];
		$dm_item_0_unitPrice = $_POST['dm_item_0_unitPrice'];


		$dm_shipTo_country = $_POST['dm_shipTo_country'];
		$dm_shipTo_city = $_POST['dm_shipTo_city'];
		$dm_shipTo_state = $_POST['dm_shipTo_state'];
		$dm_shipTo_street1 = $_POST['dm_shipTo_street1'];
		$dm_shipTo_postalCode = $_POST['dm_shipTo_postalCode'];
		$dm_shipTo_phoneNumber = $_POST['dm_shipTo_phoneNumber'];
		$dm_shipTo_firstName = $_POST['dm_shipTo_firstName'];
		$dm_shipTo_lastName = $_POST['dm_shipTo_lastName'];

		$visitorid = $_POST['visitorid'];
		
	
		$linkBuf = $secretKey. "?mid=" . $mid ."&ref=" . $ref ."&cur=" .$cur ."&amt=" .$amt;
	
		//echo "link : " . $linkBuf;
	
		$fgkey = hash("sha256", $linkBuf);
	
		//echo "<br>fgkey :" . $fgkey;
	

		/*
		$body  ="<html>";
		$body .="<body leftmargin=\"0\" topmargin=\"0\" align=\"center\" onload=\"javascript:document.regForm.submit();\">";

		if($eximbay->check_test){
			$body .="<form name=\"regForm\" method=\"post\" action=\"https://secureapi.test.eximbay.com/Gateway/BasicProcessor.krp\">";
		} else {
			$body .="<form name=\"regForm\" method=\"post\" action=\"https://secureapi.test.eximbay.com/Gateway/BasicProcessor.krp\">";
		}

		$body .="<input type=\"hidden\" name=\"ver\" value=\"200\" />";
		$body .="<input type=\"hidden\" name=\"txntype\" value=\"PAYMENT\" />";

		$body .="<input type=\"hidden\" name=\"mid\" value=\"$mid\" />";
		$body .="<input type=\"hidden\" name=\"ref\" value=\"$ref\" />";
		$body .="<input type=\"hidden\" name=\"fgkey\" value=\"$fgkey\" />";

		$body .="<input type=\"hidden\" name=\"cur\" value=\"$cur\" />";	
		$body .="<input type=\"hidden\" name=\"amt\" value=\"$amt\" />";
		$body .="<input type=\"hidden\" name=\"product\" value=\"$product\" />";
		$body .="<input type=\"hidden\" name=\"buyer\" value=\"$buyer\" />";
		$body .="<input type=\"hidden\" name=\"tel\" value=\"$tel\" />";			
		$body .="<input type=\"hidden\" name=\"email\" value=\"$email\" />";	

		$body .="<input type=\"hidden\" name=\"dm_item_0_product\" value=\"$dm_item_0_product\" />";
		$body .="<input type=\"hidden\" name=\"dm_item_0_quantity\" value=\"$dm_item_0_quantity\" />";	 
		$body .="<input type=\"hidden\" name=\"dm_item_0_unitPrice\" value=\"$dm_item_0_unitPrice\" />";

		$body .="<input type=\"hidden\" name=\"dm_shipTo_country\" value=\"$dm_shipTo_country\" />";
		$body .="<input type=\"hidden\" name=\"dm_shipTo_city\" value=\"$dm_shipTo_city\" />";				
		$body .="<input type=\"hidden\" name=\"dm_shipTo_state\" value=\"$dm_shipTo_state\" />";		
		$body .="<input type=\"hidden\" name=\"dm_shipTo_street1\" value=\"$dm_shipTo_street1\" />";	
		$body .="<input type=\"hidden\" name=\"dm_shipTo_postalCod\e" value=\"$dm_shipTo_postalCode\" />";	
		$body .="<input type=\"hidden\" name=\"dm_shipTo_phoneNumber\" value=\"$dm_shipTo_phoneNumber\" />"; 
		$body .="<input type=\"hidden\" name=\"dm_shipTo_firstName\" value=\"$dm_shipTo_firstName\" />";	
		$body .="<input type=\"hidden\" name=\"dm_shipTo_lastName\" value=\"$dm_shipTo_lastName\" />";	

		$body .="<input type=\"hidden\" name=\"visitorid\" value=\"$visitorid\" />";

		$body .="<input type=\"hidden\" name=\"shop\" value=\"$shop\" />";
		$body .="<input type=\"hidden\" name=\"lang\" value=\"$lang\" />";			
		$body .="<input type=\"hidden\" name=\"returnurl\" value=\"$returnurl\" />";
		$body .="<input type=\"hidden\" name=\"statusurl\" value=\"$statusurl\" />";	 
		$body .="<input type=\"hidden\" name=\"charset\" value=\"$charset\" />";
		$body .="<input type=\"hidden\" name=\"param1\" value=\"$param1\" />";
		$body .="<input type=\"hidden\" name=\"param2\" value=\"$param2\" />";
		$body .="<input type=\"hidden\" name=\"param3\" value=\"$param3\" />";
		$body .="<input type=\"hidden\" name=\"title1\" value='' />";
		$body .="<input type=\"hidden\" name=\"title2\" value='' />";
		$body .="<input type=\"hidden\" name=\"title3\" value='' />";
		$body .="<input type=\"hidden\" name=\"title4\" value='' />";
		$body .="<input type=\"hidden\" name=\"displaytype\" value=\"$displaytype\" />";
		$body .="<input type=\"hidden\" name=\"directToReturn\" value=\"N\" />";
		$body .="</form>";
		$body .="</body>";
		$body .="</html>";

		echo $body;
		*/

	} else {
		echo "can not load Eximbay, Please set up!";
	}
	


?>


<html>
<body leftmargin="0" topmargin="0" align="center" onload="javascript:document.regForm.submit();">
<form name="regForm" method="post" action="https://secureapi.test.eximbay.com/Gateway/BasicProcessor.krp">
<input type="hidden" name="ver" value="200" />			<!--mandatory-->
<input type="hidden" name="txntype" value="PAYMENT" />	<!--mandatory-->

<input type="hidden" name="mid" value="<?php echo $mid; ?>" /> <!--mandatory(for test)-->
<input type="hidden" name="ref" value="<?php echo $ref; ?>" />	<!--mandatory-->
<input type="hidden" name="fgkey" value="<?php echo $fgkey; ?>" />	<!--mandatory-->

<input type="hidden" name="cur" value="<?php echo $cur; ?>" />		<!--mandatory-->
<input type="hidden" name="amt" value="<?php echo $amt; ?>" />	<!--mandatory-->
<input type="hidden" name="product" value="<?php echo $product; ?>" />
<input type="hidden" name="buyer" value="<?php echo $buyer; ?>" />	<!--mandatory-->
<input type="hidden" name="tel" value="<?php echo $tel; ?>" />				<!--mandatory-->
<input type="hidden" name="email" value="<?php echo $email; ?>" />	<!--mandatory-->

<input type="hidden" name="dm_item_0_product" value="<?php echo $dm_item_0_product; ?>" />	<!--mandatory-->
<input type="hidden" name="dm_item_0_quantity" value="<?php echo $dm_item_0_quantity; ?>" />	 <!--mandatory-->
<input type="hidden" name="dm_item_0_unitPrice" value="<?php echo $dm_item_0_unitPrice; ?>" />	<!--mandatory-->

<input type="hidden" name="dm_shipTo_country" value="<?php echo $dm_shipTo_country; ?>" />	<!--mandatory-->
<input type="hidden" name="dm_shipTo_city" value="<?php echo $dm_shipTo_city; ?>" />					<!--mandatory-->
<input type="hidden" name="dm_shipTo_state" value="<?php echo $dm_shipTo_state; ?>" />			<!--mandatory-->
<input type="hidden" name="dm_shipTo_street1" value="<?php echo $dm_shipTo_street1; ?>" />		<!--mandatory-->
<input type="hidden" name="dm_shipTo_postalCode" value="<?php echo $dm_shipTo_postalCode; ?>" />	<!--mandatory-->
<input type="hidden" name="dm_shipTo_phoneNumber" value="<?php echo $dm_shipTo_phoneNumber; ?>" />	 <!--mandatory-->
<input type="hidden" name="dm_shipTo_firstName" value="<?php echo $dm_shipTo_firstName; ?>" />		<!--mandatory-->
<input type="hidden" name="dm_shipTo_lastName" value="<?php echo $dm_shipTo_lastName; ?>" />		<!--mandatory-->

<input type="hidden" name="visitorid" value="<?php echo $visitorid; ?>" />	 <!--mandatory-->

<input type="hidden" name="shop" value="<?php echo $shop; ?>" />
<input type="hidden" name="lang" value="<?php echo $lang; ?>" />				<!--mandatory-->
<input type="hidden" name="returnurl" value="<?php echo $returnurl; ?>" />
<input type="hidden" name="statusurl" value="<?php echo $statusurl; ?>" />	 <!--mandatory-->
<input type="hidden" name="charset" value="" />
<input type="hidden" name="param1" value="<?php echo $param1; ?>" />
<input type="hidden" name="param2" value="<?php echo $param2; ?>" />
<input type="hidden" name="param3" value="<?php echo $param3; ?>" />
<input type="hidden" name="title1" value="" />
<input type="hidden" name="title2" value="" />
<input type="hidden" name="title3" value="" />
<input type="hidden" name="title4" value="" />
<input type="hidden" name="displaytype" value="P" /> <!-- P: popup (default)/ I: iframe(layer)-->
<input type="hidden" name="directToReturn" value="N" />
</form>
</body>
</html>

