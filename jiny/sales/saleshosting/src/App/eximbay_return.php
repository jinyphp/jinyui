<?php
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

	$query = "select * from shop_pg where pgname = 'eximbay' and country = '".$site_country."'";
    if( $eximbay = _mysqli_query_rows($query) ){
		/*
		아래 설정 된 값은 테스트용 secretKey입니다.	테스트로만 진행하시고 발급 받으신 값으로 변경하셔야 됩니다.
		*/
		// $secretKey = "289F40E6640124B2628640168C3C5464";//가맹점 secretkey
		$secretKey = $eximbay->secretKey;

	}	

	

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

	//주문 상품 파라미터
	$item_0_product = $_POST['item_0_product'];
	$item_0_quantity = $_POST['item_0_quantity'];
	$item_0_unitPrice = $_POST['item_0_unitPrice'];

	//추가 항목 파라미터
	$surcharge_0_name = $_POST['surcharge_0_name'];
	$surcharge_0_quantity = $_POST['surcharge_0_quantity'];
	$surcharge_0_unitPrice = $_POST['surcharge_0_unitPrice'];

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

	//rescode=0000 일때 fgkey 확인
	if($rescode == "0000"){
		//fgkey 검증키 생성
		$linkBuf = $secretKey. "?mid=" . $mid ."&ref=" . $ref ."&cur=" .$cur ."&amt=" .$amt ."&rescode=" .$rescode ."&transid=" .$transid;
		
		$newFgkey = hash("sha256", $linkBuf);

		echo "link : ". $linkBuf;
		echo "<br/>fgkey :". $fgkey;
		echo "<br/>newFgkey :". $newFgkey;
		
		//fgkey 검증 실패 시 에러 처리
		if(strtolower($fgkey) != $newFgkey){
			$rescode = "ERROR";
			$resmsg = "Invalid transaction";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type ="text/javascript">
<!--
	//opener창에 결제 응답 값 세팅 후 finish.php로 submit, 현재 팝업 창 close 
	function loadForm(){
		if(opener && opener.document.regForm){
			var frm = opener.document.regForm;
			frm.rescode.value = "<?php echo $rescode; ?>";
			frm.resmsg.value = "<?php echo $resmsg; ?>";
			frm.authcode.value = "<?php echo $authcode; ?>";
			frm.cardco.value = "<?php echo $cardco; ?>";
			
			frm.target = "";
			frm.action = "eximbay_finish.php";
			
			frm.submit();
		}
		self.close();
	}
//-->
</script>
</head>
<body onload="javascript:loadForm();">
<?php
	//전체 파라미터 출력
	echo "--------all return parameter-------------<br/>";
	foreach($_POST as $Key=>$value) {
		echo $Key." : ".$value."<br/>" ; 
	}
	echo "----------------------------------------<br/>";
?>
</body>
</html>
