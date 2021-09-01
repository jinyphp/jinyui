<?php
	// Eximbay 결제 완료시 주줌처리 저장.
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";


	include "./func/string.php";
	include "./func/datetime.php";
	include "./func/error.php";
	include "./func/css.php";
	include "./func/ajax.php";
	include "./func/members.php";
	include "./func/goods.php";
	include "./func/orders.php";
	

	$body = _skin_body($skin_name,"eximbay");

	
	$query = "SELECT * FROM `eximbay_trans` where ref = '".$_POST['ref']."'";
	// echo $query."<br>";
	if($rows = _mysqli_query_rows($query)){	

		//기본 응답 파라미터
		$ver = $_POST['ver'];//연동 버전
		$mid = $_POST['mid'];//가맹점 아이디
		$txntype = $_POST['txntype'];//거래 타입
		$ref = $_POST['ref'];//가맹점 지정에서 지정한 거래 아이디 
		$cur = $_POST['cur'];//통화 
		$amt = $_POST['amt'];//결제 금액
		$shop = $_POST['shop'];//가맹점명

		$buyer = $_POST['buyer'];//결제자명
		$tel = $_POST['tel'];//결제자 전화번호
		$email = $_POST['email'];//결제자 이메일
		$lang = $_POST['lang'];//결제정보 언어 타입

		$transid = $_POST['transid'];//Eximbay 내부 거래 아이디
		$rescode = $_POST['rescode'];//0000 : 정상 
		$resmsg = $_POST['resmsg'];//결제 결과 메세지
		$authcode = $_POST['authcode'];//승인번호, PayPal, Alipay, Tenpay등 일부 결제수단은 승인번호가 없습니다.
		$cardco = $_POST['cardco'];//카드 타입
		$resdt = $_POST['resdt'];//결제 시간 정보 YYYYMMDDHHSS
		$paymethod = $_POST['paymethod'];//결제수단 코드 (연동문서 참고)

		$accesscountry = $_POST['accesscountry'];//결제자 접속 국가
		$allowedpvoid = $_POST['allowedpvoid'];//Y: 부분취소 가능. N: 부분취소 불가
		$fgkey = $_POST['fgkey'];//검증키, rescode=0000인 경우에만 값 세팅 됨
		$payto = $_POST['payto'];//청구 가맹점명

		//가맹점 지정 파라미터
		$param1 = $_POST['param1'];
		$param2 = $_POST['param2'];
		$param3 = $_POST['param3'];

		//카드 결제 정보 파라미터
		$cardholder = $_POST['cardholder'];//결제자가 입력한 카드 명의자 영문명
		$cardno1 = $_POST['cardno1'];
		$cardno4 = $_POST['cardno4'];

		//DCC 파라미터
		$foreigncur = $_POST['foreigncur'];//고객 선택 통화
		$foreignamt = $_POST['foreignamt'];//고객 선택 통화 금액
		$convrate = $_POST['convrate'];//적용 환율
		$rateid = $_POST['rateid'];//적용 환율 아이디
		

		$product = $_POST['product'];
	
	
		$dm_shipTo_city = $_POST['dm_shipTo_city'];
		$dm_shipTo_country = $_POST['dm_shipTo_country'];
		$dm_shipTo_firstName = $_POST['dm_shipTo_firstName'];
		$dm_shipTo_lastName = $_POST['dm_shipTo_lastName'];
		$dm_shipTo_phoneNumber = $_POST['dm_shipTo_phoneNumber'];
		$dm_shipTo_postalCode = $_POST['dm_shipTo_postalCode'];
		$dm_shipTo_state = $_POST['dm_shipTo_state'];
		$dm_shipTo_street1 = $_POST['dm_shipTo_street1'];


		//주문 상품 파라미터
		$item_0_product = $_POST['item_0_product'];
		$item_0_quantity = $_POST['item_0_quantity'];
		$item_0_unitPrice = $_POST['item_0_unitPrice'];

		//추가 항목 파라미터
		$surcharge_0_name = $_POST['surcharge_0_name'];
		$surcharge_0_quantity = $_POST['surcharge_0_quantity'];
		$surcharge_0_unitPrice = $_POST['surcharge_0_unitPrice'];


		//배송지 파라미터 
		$shipTo_city = $_POST['shipTo_city'];
		$shipTo_country = $_POST['shipTo_country'];
		$shipTo_firstName = $_POST['shipTo_firstName'];
		$shipTo_lastName = $_POST['shipTo_lastName'];
		$shipTo_phoneNumber = $_POST['shipTo_phoneNumber'];
		$shipTo_postalCode = $_POST['shipTo_postalCode'];
		$shipTo_state = $_POST['shipTo_state'];
		$shipTo_street1 = $_POST['shipTo_street1'];


		//CyberSource의 DM을 사용 하는 경우 받는 파라미터
		$dm_decision = $_POST['dm_decision'];
		$dm_reject = $_POST['dm_reject'];
		$dm_review = $_POST['dm_review'];

		//PayPal 거래 아이디
		$pp_transid = $_POST['pp_transid'];

		//일본 결제 파라미터
		$status = $_POST['status'];//(일본결제)Registered or Sale // Sale은 입금완료 시, statusurl로만 전송됨 일본 편의점/온라인뱅킹 후불결제 이용 시, 결제정보 등록에 대한 통지가 설정된 경우 발송됩니다.
		$paymentURL = $_POST['paymentURL'];//일본결제의 편의점/온라인뱅킹 후불 결제 이용시 고객에게 결제 방법을 안내하는 URL


		$query = "INSERT INTO `eximbay_trans` (`regdate`,`ver`,`mid`,`txntype`,`ref`,`cur`,`amt`,`shop`,
		`buyer`,`tel`,`email`,`product`,`lang`,`param1`,`param2`,`param3`,`transid`,`rescode`,`resmsg`,
		`authcode`,`cardco`,`resdt`,`cardholer`,`accesscountry`,`allowedpvoid`,`fgkey`,`cardno1`,`cardno4`,
		`foreigncur`,`foreinamt`,`convrate`,`rateid`,`status`,`paymentURL`,`payto`,
		`dm_shipTo_city`,`dm_shipTo_country`,`dm_shipTo_firstName`,`dm_shipTo_lastName`,`dm_shipTo_phoneNumber`,
		`dm_shipTo_postalCode`,`dm_shipTo_state`,`dm_shipTo_street1`,`dm_decision`,`dm_reject`,`dm_review`,`pp_transid`,`paymethod`)

		VALUES (`$TODAYTIME`,`$ver`,`$mid`,`$txntype`,`$ref`,`$cur`,`$amt`,`$shop`,
		`$buyer`,`$tel`,`$email`,`$product`,`$lang`,`$param1`,`$param2`,`$param3`,`$transid`,`$rescode`,`$resmsg`,
		`$authcode`,`$cardco`,`$resdt`,`$cardholer`,`$accesscountry`,`$allowedpvoid`,`$fgkey`,`$cardno1`,`$cardno4`,
		`$foreigncur`,`$foreinamt`,`$convrate`,`$rateid`,`$status`,`$paymentURL`,`$payto`,
		`$dm_shipTo_city`,`$dm_shipTo_country`,`$dm_shipTo_firstName`,`$dm_shipTo_lastName`,`$dm_shipTo_phoneNumber`,
		`$dm_shipTo_postalCode`,`$dm_shipTo_state`,`$dm_shipTo_street1`,`$dm_decision`,`$dm_reject`,`$dm_review`,`$pp_transid`,`$paymethod`)";

		/*
		// POST 값을 query 형태로 묽음 
		$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
		foreach($_POST as $Key=>$value) { $insert_filed .= "`$Key`,";	$insert_value .= "'$value',"; }

		$query = "INSERT INTO `eximbay_trans` ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		echo $query."<br>";
		_mysqli_query($query);
		echo "trans 갑 저장 ";
		*/

	} else {
		//echo "중복 저장된 trans ";
	}

	

	// 결제 성공, 주문 DB 갱신
	if($_POST['rescode'] == "0000") {
		
		$body = str_replace("{rescode}","Pay success! Thank you.",$body); 

		$query = "UPDATE `shop_orders` SET `status`='paid',`pay`='eximbay',`paymethod`='$paymethod',`rescode`='$rescode',`pay_authcode`='$authcode',`pay_cardco`='$cardco',`pay_regdate`='$TODAYTIME' WHERE `ref`='$ref'";
		_mysqli_query_rows($query);

		$query = "UPDATE `shop_orders_detail` SET `status`='paid',`pay`='eximbay',`paymethod`='$paymethod',`rescode`='$rescode' WHERE `ref`='$ref'";
		_mysqli_query_rows($query);
			
		$body = str_replace("{retry}", "", $body);
	
	} else {
	//결제 실패 

		$query = "UPDATE `shop_orders` SET `status`='fail',`pay`='eximbay',`paymethod`='$paymethod',`rescode`='$rescode' WHERE `ref`='$ref'";
		_mysqli_query_rows($query);

		$query = "UPDATE `shop_orders_detail` SET `status`='fail',`pay`='eximbay',`paymethod`='$paymethod',`rescode`='$rescode' WHERE `ref`='$ref'";
		_mysqli_query_rows($query);

		$body = str_replace("{rescode}","Pay Error :".$rescode,$body);
		$body = str_replace("{retry}", "<input type=button value='Retry' onclick=\"javascript:document.location.href='orders_byeximbay.php';\" id=\"btn_eximbay_retry\">", $body);
	}
	
	
	$body = str_replace("{resmsg}", $resmsg,$body);
	$body = str_replace("{authcode}",$authcode,$body);
	$body = str_replace("{cardco}",$cardco,$body);
 

 	echo $body;


?>