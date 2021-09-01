<?php
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";

	echo "OpenSales V2.1 API<br>";

	$mode = _formdata("mode");

	if($mode == "add_seller"){
		$email = _formdata("email");
		$domain = _formdata("domain");
		$query1 = "select * from `resales_seller` WHERE email ='".$email."'";
		echo $query1."<br>";
		if($rows1 = _mysqli_query_rows($query1)){
			echo "중복 등록";
		} else {
			$insert_filed = "";	$insert_value = "";				
			$insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAY."',";
			$insert_filed .= "`name`,";	$insert_value .= "'".$rows->name."',";
			$insert_filed .= "`domain`,";	$insert_value .= "'".$domain."',";
			$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";

			$query = "INSERT INTO `resales_seller` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_mysqli_query($query);
			echo $query."<br>";
			
		}

	} else if($mode == "goods"){

		// seller : 판매 공급자 이메일 
		// seller_gid : 판매공급자 의 상품 shop_goods id번호 
		$query = "select * from `shop_goods` WHERE seller = '"._formdata("seller")."' and seller_gid ='"._formdata("Id")."'";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			// update
			echo "입점 상품 갱신 <br>";
	
		} else {
			// insert
			echo "입점 상품 삽입 <br>";

			$insert_filed  = "`regdate`,";		$insert_value = "'$TODAYTIME',";
		
			$insert_filed .= "`seller_gid`,";	$insert_value .= "'"._formdata("Id")."',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";	$insert_value .= "'on',";
			}

			if($check_priod = _formdata("check_priod")){	$insert_filed .= "`check_priod`,";	$insert_value .= "'on',";	}
			if($startselling = _formdata("startselling")){	$insert_filed .= "`startselling`,";	$insert_value .= "'$startselling',";	}
			if($endselling = _formdata("endselling")){	$insert_filed .= "`endselling`,";	$insert_value .= "'$endselling',";	}

			// 선택한 다수의 카테고리를 체크
			if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ 
				$cate_select .= "$value;"; 
			}
			$insert_filed .= "`cate`,";
			$insert_value .= "'$cate_select',";

			if($pos = _formdata("pos")) {
				$insert_filed .= "`pos`,";			$insert_value .= "'$pos',";
			}

			if($prices_buy = _formdata("prices_buy")) {
				$insert_filed .= "`prices_buy`,";			$insert_value .= "'$prices_buy',";
			}

			if($prices_b2b = _formdata("prices_b2b")) {
				$insert_filed .= "`prices_b2b`,";			$insert_value .= "'$prices_b2b',";
			}

			if($sell_currency = _formdata("sell_currency")) {
				$insert_filed .= "`sell_currency`,";			$insert_value .= "'$sell_currency',";
			}

			if($prices_sell = _formdata("prices_sell")) {
				$insert_filed .= "`prices_sell`,";			$insert_value .= "'$prices_sell',";
			}

			if($country = _formdata("country")) {
				$insert_filed .= "`country`,";			$insert_value .= "'$country',";
			}

			if($sales_countrys = _formdata("sales_countrys")) {
				$insert_filed .= "`sales_country`,";			$insert_value .= "'$sales_countrys',";
			}

			if($goodcode = _formdata("goodcode")) {
				$insert_filed .= "`code`,";			$insert_value .= "'$goodcode',";
			}

			if($model = _formdata("model")) {
				$insert_filed .= "`model`,";			$insert_value .= "'$model',";
			}

			if($brand = _formdata("brand")) {
				$insert_filed .= "`brand`,";			$insert_value .= "'$brand',";
			}

			if($barcode = _formdata("barcode")) {
				$insert_filed .= "`barcode`,";			$insert_value .= "'$barcode',";
			}

			if($name = _formdata("name")) {
				$insert_filed .= "`name`,";			$insert_value .= "'$name',";
			}

			if($seller = _formdata("seller")) { $insert_filed .= "`seller`,";	$insert_value .= "'$seller',";	}
			// if($seller_auth = _formdata("seller_auth")){ $insert_filed .= "`seller_auth`,";	$insert_value .= "'on',";	}
			if($seller_order = _formdata("seller_order")){ $insert_filed .= "`seller_order`,";	$insert_value .= "'on',";	}

			if($vat = _formdata("vat")) {
				$insert_filed .= "`vat`,";			$insert_value .= "'$vat',";
			}

			if($vatrate = _formdata("vatrate")) {
				$insert_filed .= "`vatrate`,";		$insert_value .= "'$vatrate',";
			}

			if($check_prices = _formdata("check_prices")){ $insert_filed .= "`check_prices`,";	$insert_value .= "'on',";	}
			if($check_memprices = _formdata("check_memprices")){ $insert_filed .= "`check_memprices`,";	$insert_value .= "'on',";	}
			if($check_spec = _formdata("check_spec")){ $insert_filed .= "`check_spec`,";	$insert_value .= "'on',";	}
			if($check_subtitle = _formdata("check_subtitle")){ $insert_filed .= "`check_subtitle`,";	$insert_value .= "'on',";	}
			if($check_usd = _formdata("check_usd")){ $insert_filed .= "`check_usd`,";	$insert_value .= "'on',";	}
			if($check_goodname = _formdata("check_goodname")){ $insert_filed .= "`check_goodname`,";	$insert_value .= "'on',";	}

			
			if($discount = _formdata("discount")){ $insert_filed .= "`discount`,";	$insert_value .= "'on',";	}
			if($discount_rate = _formdata("discount_rate")) {	$insert_filed .= "`discount_rate`,";	$insert_value .= "'$discount_rate',";	}
			if($discount_endpriod = _formdata("discount_endpriod")) {	$insert_filed .= "`discount_endpriod`,";	$insert_value .= "'$discount_endpriod',";	}


			if($soldout = _formdata("soldout")){ $insert_filed .= "`soldout`,";	$insert_value .= "'on',";	}
			if($stock_check = _formdata("stock_check")){ $insert_filed .= "`stock_check`,";	$insert_value .= "'on',";	}
			if($stock = _formdata("stock")) { $insert_filed .= "`stock`,";	$insert_value .= "'$stock',";	}
			if($safe_stock = _formdata("safe_stock")) {	$insert_filed .= "`safe_stock`,";	$insert_value .= "'$safe_stock',";	}


			if($free_shipping = _formdata("free_shipping")){ $insert_filed .= "`free_shipping`,";	$insert_value .= "'on',";	}
			if($ordertext = _formdata("ordertext")) { $insert_filed .= "`ordertext`,"; 	$insert_value .= "'on',"; 	}
			if($attach = _formdata("attach")) { $insert_filed .= "`attach`,"; $insert_value .= "'on',"; 	}

			if($blog = _formdata("$blog")) {
				$insert_filed .= "`blog`,";			$insert_value .= "'$blog',";
			}

			if($youtube = _formdata("youtube")) {
				$insert_filed .= "`youtube`,";		$insert_value .= "'$youtube',";
			}

			if($relation_check = _formdata("relation_check")){ $insert_filed .= "`relation_check`,";	$insert_value .= "'on',";	}
			if($relation_type = _formdata("relation_type")) {	$insert_filed .= "`relation_type`,";	$insert_value .= "'$relation_type',";	}
			if($relation_cols = _formdata("relation_cols")) {	$insert_filed .= "`relation_cols`,";	$insert_value .= "'$relation_cols',";	}
			if($relation_rows = _formdata("relation_rows")) {	$insert_filed .= "`relation_rows`,";	$insert_value .= "'$relation_rows',";	}

			if($imgsize = _formdata("imgsize")) {	$insert_filed .= "`imgsize`,";	$insert_value .= "'$imgsize',";	}
			if($mobile_imgsize = _formdata("mobile_imgsize")) {	$insert_filed .= "`mobile_imgsize`,";	$insert_value .= "'$mobile_imgsize',";	}


			$query = "select * from `shop_goods` order by Id desc";
			$goods_rows = _mysqli_query_rows($query);
			$max_id = $goods_rows->Id +1;

		
			$insert_filed .= "`goodname`,";	$insert_value .= "'".addslashes(_formdata("goodname"))."',";
			$insert_filed .= "`spec`,";	$insert_value .= "'".addslashes(_formdata("spec"))."',";
			$insert_filed .= "`subtitle`,";	$insert_value .= "'".addslashes(_formdata("subtitle"))."',";
			$insert_filed .= "`optionitem`,";	$insert_value .= "'".addslashes(_formdata("optionitem"))."',";

			$insert_filed .= "`seo_title`,";	$insert_value .= "'".addslashes(_formdata("seo_title"))."',";
			$insert_filed .= "`seo_description`,";	$insert_value .= "'".addslashes(_formdata("seo_description"))."',";
			$insert_filed .= "`seo_keyword`,";	$insert_value .= "'".addslashes(_formdata("seo_keyword"))."',";
	
			$insert_filed .= "`images1`,";	$insert_value .= "'"._formdata("images1")."',";
			$insert_filed .= "`images2`,";	$insert_value .= "'"._formdata("images2")."',";
			$insert_filed .= "`images3`,";	$insert_value .= "'"._formdata("images3")."',";

		



			$query = "INSERT INTO `shop_goods` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_mysqli_query($query);
			echo $query;

		}
	}












	
?>