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
	
	include "./func/orders.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");
	
	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}



	//$body = _skin_page($skin_name,"orderby_eximbay");
	$body = _theme_page($site_env->theme,"orderby_eximbay",$site_language,$site_mobile);

	$script = "<script>
	    function order_payEximbay(){
    		//Eximbay 팝업
    		//function payForm(){
        	var frm = document.regForm;

        	//필수 값 파라미터 체크
        
        	window.open(\"\", \"payment2\", \"scrollbars=yes,status=no,toolbar=no,resizable=yes,location=no,menu=no,width=800,height=470\");
        	frm.target = \"payment2\";
        	frm.submit();
    	}
	</script>";

	$mode = _formdata("mode");

	/////////////////////////
			// 장바구니 선택한 상품만 출력함.
			$TID = $_POST['TID'];
			if($TID){
				$query = "select * from `shop_cart` WHERE ";
				for($i=0;$i<count($TID);$i++) if($i == 0) $query .= "`Id`='$TID[$i]'"; else $query .= " or `Id`='$TID[$i]'";
				echo $query;

				if($rowss = _mysqli_query_rowss($query)){

					for($i=0,$total_prices=0,$list="";$i<count($rowss);$i++){
						$rows = $rowss[$i];

						$sum = $rows->prices * $rows->num;
						$total = $sum + $sum/100*$tax;
						$total_prices += $total;

						$list .= _formlist_bycart($rows,$num,$option,$shipping,$ordertext);	

					}
					$body = str_replace("{list}",$list,$body);
				} else {
					$msg = _string("장바구니 상품을 읽어올수 없습니다.",$site_language);
					$body = str_replace("{list}",$msg,$body);
				}	

			} else {
				$msg = _string("선택한 장바구니 상품이 없습니다.",$site_language);
				$body = str_replace("{list}",$msg,$body);
			}


	////////////////////////////////////////////////////
	////////////////////////////////////////////////////
	// 주문목록 저장

	$seller = _formdata("seller");
	$reseller = _formdata("reseller");
	$target = _formdata("target");
	$deliveryway = _formdata("deliveryway");

	$manager = _formdata("manager");
	$phone = _formdata("phone");
	$post = _formdata("post");
	$address = _formdata("address");

	$city = _formdata("city");
	$state = _formdata("state");
	$firstname = _formdata("firstname");

	$payment = _formdata("payment");

	$email = _formdata("email");
	$password = _formdata("password");

	$domain = $_SERVER['HTTP_HOST'];


	// 주문코드를 생성합
	$query = "select * from shop_orders order by Id desc";
    $rows = _mysqli_query_rows($query);
    $orercode = $rows->Id + 1;
	$ordercode_key = md5('orders'.$TODAYTIME.microtime())."-$orercode"; 

	
	$query = "select * from `shop_orders` WHERE `ordercode` = '$ordercode_key'";
	//echo $query."<br>";
	if($rows_orders = _mysqli_query_rows($query)){
		//echo "이미 저장된 주문 코드 입니다.";
	} else {	
		// 주문내용 저장
		$query ="INSERT INTO `shop_orders` (`regdate`,`seller`,`reseller`,`country`,`email`,`username`, `userphone`, `post`, `address`,`city`,`state`,`firstname`,
						`payment`, `bankid`,`status`, `adminmanager`,`domain`, `cartlog`,`ordercode`) 
					VALUES ('$TODAYTIME','$seller','$reseller','$target','$email', '$manager', '$phone', '$post', '$address','$city','$state','$firstname',
						'$payment', '$bankid','new', 'admin','$domain','$cartlog','$ordercode_key')";
		//echo $query."<br>";
		_mysqli_query($query);

		// 주문 배송 주소 입력
		$query = "select * from `shop_orders_address` WHERE `members` = '$email' and country = '$country' and city = '$city' and 
								firstname = '$firstname' and lastname = '$lastname' and phone = '$phone' and address = '$address'";
		if($address_rows = _mysqli_query_rows($query)){	
			$address_count = $address_rows->count + 1;
			$query ="UPDATE `shop_orders_address` SET `last` = '$TODAYTIME' , `count`='$address_count' where Id='".$address_rows->Id."'";
			_mysqli_query($query);
			//echo $query."<br>";

			$query ="UPDATE `shop_orders` SET `orders_address` = '".$address_rows->Id."' where ordercode='".$ordercode_key."'";
			_mysqli_query($query);

		} else {

			$query = "select * from shop_orders_address order by Id desc";
    		$rows = _mysqli_query_rows($query);
    		$address_code = $rows->Id + 1;
			$address_code_key = md5('address'.$TODAYTIME.microtime())."-$address_code"; 

			$query ="INSERT INTO `shop_orders_address` (`regdate`,`members`,`firstname`,`lastname`,`phone`,`fax`,`post`, `address`, `state`, `city`,`country`,`last`,`count`,`address_code`) 
					VALUES ('$TODAYTIME','$email','$firstname','$lastname','$phone', '$fax', '$post', '$address', '$state','$city','$address','$TODAYTIME','0','$address_code_key')";
			_mysqli_query($query);
			//echo $query."<br>";

			$query = "select * from shop_orders_address where address_code='".$address_code_key."'";
    		if($address_rows = _mysqli_query_rows($query)){
    			$query ="UPDATE `shop_orders` SET `orders_address` = '".$address_rows->Id."' where ordercode='".$ordercode_key."'";
				_mysqli_query($query);
    		}


		}


		// 장바구니 내용으로
				// 주문 상세 내역 저장
				if($TID = $_POST['TID']){
					$query = "select * from `shop_cart` WHERE ";
					for($i=0;$i<count($TID);$i++) if($i == 0) $query .= "`Id`='$TID[$i]'"; else $query .= " or `Id`='$TID[$i]'";
					if($rowss = _mysqli_query_rowss($query)){
						$amount = 0;
						$sub_shipping = 0;
						$sub_prices = 0;

						for($i=0;$i<count($rowss);$i++){
							$rows = $rowss[$i];
							$prices_usd = $rows->prices;
						
							$prices = $prices_usd + $prices_usd /100 *$rows->vat;
							$option = explode(";", $rows->option);
							for($k=0;$k<sizeof($option);$k++) { $option_prices = explode("=", $option[$k]); $prices += $option_prices[1]; }
							$numsum = $prices * $rows->num;
							$sub_prices += $numsum;

							$shipping = explode(":",$rows->shipping);
							if($sub_shipping_method != $shipping[0]){ // 같은 배송방식은 , 묾음으로 계산처리 하지 않음.
								$sub_shipping_method = $shipping[0];
								$sub_shipping += $shipping[1];
							}

							$query ="INSERT INTO `shop_orders_detail` (`regdate`,`order_id`,`GID`,`images`,`goodname`,`subtitle`,`currency`,`prices`,`option`,`num`,
							`vat`,`ordertext`,`upload`,`shipping`,`status`,`cartlog`,`ordercode`)
							VALUES ('$TODAYTIME','".$rows_orders->Id."','".$rows->GID."','".$rows->images."','".$rows->goodname."','".$rows->subtitle."','".$rows->currency."','".$rows->prices."','".$rows->option."','".$rows->num."',
							'".$rows->vat."','".$rows->ordertext."','".$rows->upload."','".$rows->shipping."','new','$cartlog','$ordercode_key')";
							_mysqli_query($query);

							// 주문 처리한 장바구니, 삭제 
							$query = "DELETE FROM `shop_cart` WHERE `Id`='".$rows->Id."'";
    						_mysqli_query($query);	

						}

						$amount = $sub_shipping + $sub_prices;
						$rows_orders->currency = $rows->currency;
						$Rows_orders->amount = $amount;
						$query = "UPDATE `shop_orders` SET `currency`='".$rows->currency."', `amount`='$amount' WHERE `Id`='".$rows_orders->Id."'";
						_mysqli_query($query);
							
					}
				}


	}






	///////////////////////////////////////////////////
	// Eximbay 결제 처리 구축 

	$query = "select * from shop_pg where pgname = 'eximbay' and country = '".$site_country."'";
    if( $eximbay = _mysqli_query_rows($query) ){
    }
    // 로고 출력
    $body = str_replace("{payment_logo}","<img src='http://www.saleshosting.co.kr/images/eximbay.jpg' border=0>",$body);

	// 요청 URL
	// 테스트용 : https://secureapi.test.eximbay.com/Gateway/BasicProcessor.krp
	// 서비스용 : https://secureapi.eximbay.com/Gateway/BasicProcessor.krp
	// Eximbay 결제요청 파라메터 설정<!-- 결제에 필요 한 필수 파라미터 -->
	$formstart = "<form name='regForm' method='post' action='eximbay_request.php'>";

	//<!-- 연동 버전 -->
	// Type : N , Length : 3 , Required : R , Description : 연동 버전 21	
	$formstart .= "<input type='hidden' name='ver' value='210' />"; 
	//<!-- 거래 타입 -->
	// Type : AN , Length : 210 , Required : R , Description : PAYMENT
	$formstart .= "<input type='hidden' name='txntype' value='PAYMENT' />"; 
	//<!-- 기본 값 : UTF-8 -->
	$formstart .= "<input type='hidden' name='charset' value='UTF-8' />";


	// 결제 통화 선택
	// KRW , USD, EUR, GBP, JYP,THB,SGD.HKD,CAD,AUD
	// <!-- 테스트 시 통화 USD 권장 -->
	$body = str_replace("{currency}","<input readonly type='text' readonly name='cur' value='$price_currency' style=\"$css_textbox\">",$body); 
	// 결제할 총금액
	// 결제구눔 3자리 "," 는 사용하지 않음.
	$body = str_replace("{amount}","<input type='text' readonly name='amt' value='$total_prices' style=\"$css_textbox\">",$body);
	

	// 가맹점에서 Transaction을 구분할 유일한 갑으로 거래래 설정, 실패시에도 새로운 값으로 세팅 요망
	$formstart .= "<input type='hidden' name='ref' value='$ordercode_key' />";

	// <!-- 결제 수단코드 -->
	// 결제수다이 지정된 경우, 해당 결제 수단 페이지로 바로 이동 
	// P000 : CreditCart, P101 : VISA, P102 : MasterCard, P103 : AMEX, P104:JCB, P001 : Paypal, P002 : CUP(unionPay) , P003 : Alipay, P004 : TenPay, P141 : WeVhat, P005: 99bill, P006: 일본ㅠ편의점, 인터넷뱅킹 
	$formstart .= "<input type='hidden' name='paymethod' value='' />";

	//<!-- 상점명 : 가맹점명과 다른 경우 사용 -->
	$formstart .= "<input type='hidden' name='shop' value='".$eximbay->shop."' />";


	// <!-- 결제에 필요한 필수 파라미터 -->
	// <!-- 추가 필수 파라미터 : Buyer, email, amt -->
	// 결제자명, 실명 사용 요망 
	$body = str_replace("{buyername}","<input type='text' readonly name='buyer' value='$manager $firstname' style=\"$css_textbox\">",$body); 
	// 결제자 연락처
	$body = str_replace("{buyertel}","<input type='text' readonly name='tel' value='$phone' style=\"$css_textbox\">",$body);
	// 결제자 이메일
	$body = str_replace("{buyeremail}","<input type='text' readonly name='email' value='".$email."' style=\"$css_textbox\">",$body);


	//<!-- 상품명  -->
	// $order_name 
	$formstart .= "<input type='hidden' name='product' value='".$order_name."' />";

	//<!-- 졀제정보 언어 타입  -->
	/*
	$eximbay_lang = array("kr"=>"KR","en"=>"EN","cn"=>"CN","jp"=>"JP","dk"=>"DK","nl"=>"NL","fi"=>"FI",
							"fr"=>"FR","de"=>"DE","it"=>"IT","no"=>"NO","pl"=>"PL","pt"=>"PT","ru"=>"RU",
							"es"=>"ES","se"=>"SE","th"=>"TH","tr"=>"TR");
	if($lang = $eximbay_lang[$site_language]) {} else  $lang="EN";
	*/
	$lang = strtoupper($site_language); // 대문자로 변환하여 전송
	$formstart .= "<input type='hidden' name='lang' value='$lang' />";


	$domain = $_SERVER['HTTP_HOST'];
	// 결제 결과 확인화면에서 사용자가 결제창을 종료할 경우 호출되는 가맹점 페이지 (returnurl은 고객 브라우저 기반으로 동작하므로, 브라우저 강제 종료시, 호출되지 않을 수 있습니다.)
	//<!--결제 완료 시 Front-end 방식으로 사용자 브라우저 상에 호출되어 보여질 가맹점 페이지 -->
	$formstart .= "<input type='hidden' name='returnurl' value='http://$domain/eximbay_return.php' />";

	// <!-- statusurl(필수 값) : 결제 완료 시 Back-end 방식으로 Eximbay 서버에서 statusurl에 지정된 가맹점 페이지를 Back-end로 호출하여 파라미터를 전송. -->
	// <!-- 스크립트, 쿠키, 세션 사용 불가 -->
	$formstart .= "<input type='hidden' name='statusurl' value='http://$domain/eximbay_status.php' />";

	//<!-- P : popup(기본값), I : iframe(layer), R : page redirect -->
	$formstart .= "<input type='hidden' name='displaytype' value='P' />";
	// 결제완료 화면에서 결제 성공/실패와 무관하게 처리 . Y: 바로 returnurl 호출  / N: 결제완료 화면 대기 (기본값)
	$formstart .= "<input type='hidden' name='autoclose' value='' />";
	
	// <!-- P: PC 버전(기본값), M : Mobile 버전-->
	if($site_mobile == "m") $formstart .= "<input type='hidden' name='ostype' value='M' />";
	else $formstart .= "<input type='hidden' name='ostype' value='P' />";


	// <!-- 한국 결제 수단 관련 변수 (선택) -->
	//<!-- KR 값 지정 시 한국 결제 수단 선택. 그 외 해외 결제 수단 -->
	$formstart .= "<input type='hidden' name='issuercountry' value='' />";
	//<!-- 전체 결제금액의 결제금액의 공급가액 issuercountry가 KR인 경우 필수 값 -->
	$formstart .= "<input type='hidden' name='supplyvalue' value='' />";
	//<!-- 전체 결제금액의 결제금액의 세액 issuercountry가 KR인 경우 필수 값 -->
	$formstart .= "<input type='hidden' name='taxamount' value='' />";	


	$formstart .= "<!-- 추가 항목 관련 파라미터 (선택) -->
						<input type='hidden' name='surcharge_0_name' value='' />
						<input type='hidden' name='surcharge_0_quantity' value='' />
						<input type='hidden' name='surcharge_0_unitPrice' value='' />
						
						<input type='hidden' name='mobiletype' value='' />
						<input type='hidden' name='appscheme' value='' />
						
						<input type='hidden' name='siteforeigncur' value='' />						

						<!-- 결제 응답 값 처리 파라미터 -->
						<input type='hidden' name='rescode' />
						<input type='hidden' name='resmsg' />
						<input type='hidden' name='authcode' />
						<input type='hidden' name='cardco' />";

		// <!-- 배송지 관련 파라미터(선택) -->
		// 배송국가 
		$body = str_replace("{dm_shipTo_country}","<input type='text' readonly name='shipTo_country' value='$country' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_country' value='$country' />"; // <!-- 청구지 관련 파라미터 (선택) -->

		// 도시 
		$body = str_replace("{dm_shipTo_city}","<input type='text' readonly name='shipTo_city' value='$city' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_city' value='$city' />"; // <!-- 청구지 관련 파라미터 (선택) -->

		// 주 : US , CA만 사용
		$body = str_replace("{dm_shipTo_state}","<input type='text' readonly name='shipTo_state' value='$state' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_state' value='$stat' />"; // <!-- 청구지 관련 파라미터 (선택) -->

		// 상세주소
		$body = str_replace("{dm_shipTo_street1}","<input type='text' readonly name='shipTo_street1' value='$address' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_street1' value='$address' />"; // <!-- 청구지 관련 파라미터 (선택) -->

		// 우편번호
		$body = str_replace("{dm_shipTo_postalCode}","<input type='text' readonly name='shipTo_postalCode' value='$post' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_postalCode' value='$post' />"; // <!-- 청구지 관련 파라미터 (선택) -->

		//  수령자 전화번호
		$body = str_replace("{dm_shipTo_phoneNumber}","<input type='text' readonly name='shipTo_phoneNumber' value='$userphone' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_phoneNumber' value='$userphone' />"; // <!-- 청구지 관련 파라미터 (선택) -->

		// 성
		$body = str_replace("{dm_shipTo_firstName}","<input type='text' readonly name='shipTo_firstName' value='$firstname' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_firstName' value='$firstname' />"; // <!-- 청구지 관련 파라미터 (선택) -->

		// 이름 
		$body = str_replace("{dm_shipTo_lastName}","<input type='text' readonly name='shipTo_lastName' value='$manager' style=\"$css_textbox\">",$body);
		$formstart .= "<input type='hidden' name='billTo_lastName' value='$manager' />"; // <!-- 청구지 관련 파라미터 (선택) -->
		



		// <!-- 가맹점 정의 파마리터 (선택) -->
		// 주문관련 추가 정보 설정 => 결제 성공시, 리턴값으로 읽어 올 수 있음.
		$formstart .= "<input type='hidden' name='param1' value='$mode' />"; // 주문방식 buynow , cart 
		$formstart .= "<input type='hidden' name='param2' value='$cartlog' />"; // 장바구니 번호
		$formstart .= "<input type='hidden' name='param3' value='$uid' />"; // 주문 상품 번호 



		$body = str_replace("{formstart}",$formstart,$body);

		$body = str_replace("{pay}","<input type='button' value='Pay by Eximbay' onclick=\"javascript:order_payEximbay()\" id=\"btn_eximbay\">",$body);
		$body = str_replace("{formend}","</form>",$body);

	

		echo $script.$body;

?>