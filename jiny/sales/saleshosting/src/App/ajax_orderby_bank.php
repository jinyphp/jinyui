<?php
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";



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


	//$body = _skin_page($skin_name,"orderby_bank");
	$body = _theme_page($site_env->theme,"orderby_bank",$site_language,$site_mobile);
	$mode = _formdata("mode");
	// echo "mode is $mode <br>";


	/////////////////////////
	// 장바구니 선택한 상품만 출력함.
	$TID = $_POST['TID'];
	if($TID){
		$query = "select * from `shop_cart` WHERE ";
		for($i=0;$i<count($TID);$i++) if($i == 0) $query .= "`Id`='$TID[$i]'"; else $query .= " or `Id`='$TID[$i]'";
		//echo $query;

		if($rowss = _mysqli_query_rowss($query)){
			for($i=0,$sum=0,$list="";$i<count($rowss);$i++){
				$rows = $rowss[$i];				
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




	// ===============
	// 무통장 입금계좌 출력
	$bankid = _formdata("bankid");
	$bank = explode(":", $bankid);
	$query = "select * from `shop_bank` WHERE `Id` = '$bank[1]'";
	if( $rows = _mysqli_query_rows($query) ){
		$body = str_replace("{bank_name}",$rows->bankname,$body); 
		$body = str_replace("{bank_user}",$rows->bankuser,$body); 
		$body = str_replace("{bank_account}",$rows->banknum,$body); 
		$body = str_replace("{bank_swiff}",$rows->swiff,$body);
		$body = str_replace("{bank_country}",$rows->country,$body);
	} else {
		$body = str_replace("{bank_name}","-",$body); 
		$body = str_replace("{bank_user}","-",$body); 
		$body = str_replace("{bank_account}","-",$body); 
		$body = str_replace("{bank_swiff}","-",$body);
		$body = str_replace("{bank_country}","-",$body);
	}
	$body = str_replace("{bank_check}","입금확인 요청",$body);




	////////////////////////////////////////////////////
	////////////////////////////////////////////////////
	// 주문목록 저장

	$seller = _formdata("seller");
	$reseller = _formdata("reseller");
	$target = _formdata("target");
	$deliveryway = _formdata("deliveryway");

	$firstname = _formdata("firstname");
	$lastname = _formdata("lastname");
	$manager = $lastname;
	$phone = _formdata("phone");
	$post = _formdata("post");
	$address = _formdata("address");

	$city = _formdata("city");
	$state = _formdata("state");
	

	$bankid = _formdata("bankid");
	$payment = _formdata("payment");

	$email = _formdata("email");
	$password = _formdata("password");

	$domain = $_SERVER['HTTP_HOST'];
	
	
	// 주문코드를 생성합
	$query = "select * from shop_orders order by Id desc";
    $rows = _mysqli_query_rows($query);
    $orercode = $rows->Id + 1;
	$ordercode_key = md5('orders'.$TODAYTIME.microtime())."-$orercode"; 


	$query = "select * from `shop_orders` WHERE `ordercode` = '$ordercode_key'";	//echo $query."<br>";
	if($rows_orders = _mysqli_query_rows($query)){
		//echo "이미 저장된 주문 코드 입니다.";
	} else {	
		// 주문내용 저장
		// payment : 결제방식 (bank, eximbay, inipay ...)
		// bankid : 은행 선택시, 선택 은행 정보 (하나은행 , 우리은행 , 신한은행 ...) 
		$query ="INSERT INTO `shop_orders` (`regdate`,`seller`,`reseller`,`country`,`email`,`username`, `userphone`, `post`, `address`,`city`,`state`,`firstname`,
						`payment`, `bankid`,`status`, `adminmanager`,`domain`, `cartlog`,`ordercode`) 
					VALUES ('$TODAYTIME','$seller','$reseller','$target','$email', '$manager', '$phone', '$post', '$address','$city','$state','$firstname',
						'$payment', '$bankid','new', 'admin','$domain','$cartlog','$ordercode_key')";
		_mysqli_query($query);
		//echo $query."<br>";

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

					$query ="INSERT INTO `shop_orders_detail` (`regdate`,`order_id`,`GID`,`images`,`goodname`,`subtitle`,
							`currency`,`prices`,`option`,`num`,
							`vat`,`ordertext`,`upload`,`shipping`,`status`,`cartlog`,`ordercode`)
							VALUES ('$TODAYTIME','".$rows_orders->Id."','".$rows->GID."','".$rows->images."','".$rows->goodname."','".$rows->subtitle."',
							'".$rows->currency."','".$rows->prices."','".$rows->option."','".$rows->num."',
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
		

	echo $body;

?>