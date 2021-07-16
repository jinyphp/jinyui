<?
	@session_start();
	
	include "../conf/dbinfo.php";
	include "../func/mysql.php";

	include "../func/datetime.php";
	include "../func/file.php";
	include "../func/form.php";
	include "../func/string.php";
	include "../func/javascript.php";

	
	

	print_r($_POST);

	echo "<br>gsdfgdsgsdfg";

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



/*

if($mode == "enable"){
			// $query = "UPDATE `shop_goods` SET `enable`='on' WHERE `Id`='$uid";
			$query = "UPDATE `shop_goods` SET `enable`='on' WHERE `Id`=$uid";
			_sales_query($query);

		} else if($mode == "disable"){
			// $query = "UPDATE `shop_goods` SET `enable`='' WHERE `Id`='$uid";
			$query = "UPDATE `shop_goods` SET `enable`='' WHERE `Id`=$uid";
			_sales_query($query);

		} else if($uid && $mode == "edit"){
			// ===========
			// 상품 정보 수정 
			$query = "UPDATE `shop_goods` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,"; 

			if($check_priod = _formdata("check_priod")) $query .= "`check_priod`='on' ,"; else $query .= "`check_priod`='' ,"; 
			if($startselling = _formdata("startselling")) $query .= "`startselling`='$startselling' ,";
			if($endselling = _formdata("endselling")) $query .= "`endselling`='$endselling' ,";

			if($seller = _formdata("seller")) $query .= "`seller`='$seller' ,";
			if($seller_auth = _formdata("seller_auth")) $query .= "`seller_auth`='on' ,"; else $query .= "`seller_auth`='' ,"; 
			if($seller_order = _formdata("seller_order")) $query .= "`seller_order`='on' ,"; else $query .= "`seller_order`='' ,"; 
			
			//if($sell_cate = _formdata("sell_cate")) $query .= "`seller_cate`='$sell_cate' ,";
			if($pos = _formdata("pos")) $query .= "`pos`='$pos' ,";
			
			if($prices_buy = _formdata("prices_buy")) $query .= "`prices_buy`='$prices_buy' ,";
			if($prices_b2b = _formdata("prices_b2b")) $query .= "`prices_b2b`='$prices_b2b' ,";
			if($sell_currency = _formdata("sell_currency")) $query .= "`sell_currency`='$sell_currency' ,";
			if($prices_sell = _formdata("prices_sell")) $query .= "`prices_sell`='$prices_sell' ,";
			if($country = _formdata("country")) $query .= "`country`='$country' ,";
			if($sales_countrys = _formdata("sales_countrys")) $query .= "`sales_country`='$sales_countrys'  ,";
			
			if($goodcode = _formdata("goodcode")) $query .= "`code`='$goodcode' ,";
			if($model = _formdata("model")) $query .= "`model`='$model' ,";
			if($brand = _formdata("brand")) $query .= "`brand`='$brand', ,";
			if($barcode = _formdata("barcode")) $query .= "`barcode`='$barcode' ,";
			if($name = _formdata("name")) $query .= "`name`='$name' ,";
		
			if($vat = _formdata("vat")) $query .= "`vat`='$vat' ,";
			if($vatrate = _formdata("vatrate")) $query .= "`vatrate`='$vatrate' ,";


			if($check_prices = _formdata("check_prices")) $query .= "`check_prices`='on' ,"; else $query .= "`check_prices`='' ,";
			if($check_memprices = _formdata("check_memprices")) $query .= "`check_memprices`='on' ,"; else $query .= "`check_memprices`='' ,"; 
			if($check_spec = _formdata("check_spec")) $query .= "`check_spec`='on' ,"; else $query .= "`check_spec`='' ,"; 
			if($check_subtitle = _formdata("check_subtitle")) $query .= "`check_subtitle`='on' ,"; else $query .= "`check_subtitle`='' ,"; 
			if($check_usd = _formdata("check_usd")) $query .= "`check_usd`='on' ,"; else $query .= "`check_usd`='' ,"; 
			if($check_goodname = _formdata("check_goodname")) $query .= "`check_goodname`='on' ,"; else $query .= "`check_usd`='' ,"; 

	
			if($discount = _formdata("discount")) $query .= "`discount`='on' ,"; else $query .= "`discount`='' ,"; 
			$discount_rate = _formdata("discount_rate"); $query .= "`discount_rate`='$discount_rate' ,";
			$discount_endpriod = _formdata("discount_endpriod"); $query .= "`discount_endpriod`='$discount_endpriod' ,";


			$imgsize = _formdata("imgsize"); $query .= "`imgsize`='$imgsize' ,";
			$mobile_imgsize = _formdata("mobile_imgsize"); $query .= "`mobile_imgsize`='$mobile_imgsize' ,";

			
			if($free_shipping = _formdata("free_shipping")) $query .= "`free_shipping`='on' ,"; else $query .= "`free_shipping`='' ,"; 
			if($ordertext = _formdata("ordertext")) $query .= "`ordertext`='on' ,"; else $query .= "`ordertext`='' ,";
			if($attach = _formdata("attach")) $query .= "`attach`='on' ,"; else $query .= "`attach`='' ,";
			$blog = _formdata("blog"); $query .= "`blog`='$blog' ,";
			$youtube = _formdata("youtube"); $query .= "`youtube`='$youtube' ,";

			if($soldout = _formdata("soldout")) $query .= "`soldout`='on' ,"; else $query .= "`soldout`='' ,"; 
			if($stock_check = _formdata("stock_check")) $query .= "`stock_check`='on' ,"; else $query .= "`stock_check`='' ,"; 
			$stock = _formdata("stock"); $query .= "`stock`='$stock' ,";
			$safe_stock = _formdata("safe_stock"); $query .= "`safe_stock`='$safe_stock' ,";


			if($relation_check = _formdata("relation_check")) $query .= "`relation_check`='on' ,"; else $query .= "`relation_check`='' ,"; 
			$relation_type = _formdata("relation_type"); $query .= "`relation_type`='$relation_type' ,";
			$relation_cols = _formdata("relation_cols"); $query .= "`relation_cols`='$relation_cols' ,";
			$relation_rows = _formdata("relation_rows"); $query .= "`relation_rows`='$relation_rows' ,";

			// 선택한 다수의 카테고리를 체크
			if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ 
				$cate_select .= "$value;"; 
			}
			$query .= "`cate`='$cate_select' ,";


			// 파일 업로드
			$mydir = "./goods";			_mkdir($mydir);
			$mydir .= "/$THIS_YEAR";	_mkdir($mydir);
			$mydir .= "/$THIS_MONTH";	_mkdir($mydir);
			$mydir .= "/$THIS_DAY";		_mkdir($mydir);
			$filename = $mydir."/".$members->Id."_".$uid;

			if($files = _form_uploadfile("userfile1",$filename."-1")) $query .= "`images1`='".$files[filename].".".$files[ext]."' ,";
			if($files = _form_uploadfile("userfile2",$filename."-2")) $query .= "`images2`='".$files[filename].".".$files[ext]."' ,";
			if($files = _form_uploadfile("userfile3",$filename."-3")) $query .= "`images3`='".$files[filename].".".$files[ext]."' ,";

			if($files = _form_uploadfile("userfile6",$filename."-6")) $query .= "`filename1`='".$files[filename].".".$files[ext]."' ,";
			if($files = _form_uploadfile("userfile7",$filename."-7")) $query .= "`filename2`='".$files[filename].".".$files[ext]."' ,";
			if($files = _form_uploadfile("userfile8",$filename."-8")) $query .= "`filename3`='".$files[filename].".".$files[ext]."' ,";

			//# 언어별 상품정보 갱신
			$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){

				// JSOM
				$goodname = "{";
				$spec = "{";
				$subtitle = "{";
				$optionitem = "{";
				$seo_title = "{";
				$seo_description = "{";
				$seo_keyword = "{";

				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					$_goodname = "goodname_".$rows1->code;
					$goodname .= "\"$rows1->code\":\"".addslashes( _formdata("goodname_".$rows1->code) )."\"";

					$_spec = "spec_".$rows1->code;
					$spec .= "\"$rows1->code\":\"".addslashes( _formdata("spec_".$rows1->code) )."\"";

					$_subtitle = "subtitle_".$rows1->code;
					$subtitle .= "\"$rows1->code\":\"".addslashes( _formdata("subtitle_".$rows1->code) )."\"";

					$_optionitem = "optionitem_".$rows1->code;
					$optionitem .= "\"$rows1->code\":\"".addslashes( _formdata("optionitem_".$rows1->code) )."\"";
						
					$_seo_title = "seo_title_".$rows1->code;
					$seo_title .= "\"$rows1->code\":\"".addslashes( _formdata("seo_title_".$rows1->code) )."\"";
					
					$_seo_description = "seo_description_".$rows1->code;
					$seo_description .= "\"$rows1->code\":\"".addslashes( _formdata("seo_description_".$rows1->code) )."\"";
						
					$_seo_keyword = "seo_keyword_".$rows1->code;
					$seo_keyword .= "\"$rows1->code\":\"".addslashes( _formdata("seo_keyword_".$rows1->code) )."\"";

					if($i<(count($rowss1)-1)) {
						$goodname .= ",";
						$spec .= ",";
						$subtitle .= ",";
						$optionitem .= ",";
						$seo_title .= ",";
						$seo_description .= ",";
						$seo_keyword .= ",";
					}	

					// 상품설명 내용 저장 
    				$_keyfeild =  $rows1->code; $_keyfeild_m =  $rows1->code."_m";
						
					$html =  _formdata($_keyfeild); $html = addslashes($html);
					$html_m = _formdata($_keyfeild_m); $html_m = addslashes($html_m);
					$uid = _formdata("uid");

					$query1 = "select * from `shop_goods_html` WHERE `goods`='$uid' and `language`='".$rows1->code."'";
					if($goods_rows = _sales_query_rows($query1)){
						// 갱신 
						$query1 ="UPDATE `shop_goods_html` SET `html`='$html', `timestamp`='$TODAYTIME' WHERE `goods`='$uid' and `mobile`='pc' and `language`='".$rows1->code."'";
						//echo $query1."<br>";
						_sales_query($query1);

						$query1 ="UPDATE `shop_goods_html` SET `html`='$html_m', `timestamp`='$TODAYTIME' WHERE `goods`='$uid' and `mobile`='m' and `language`='".$rows1->code."'";
						//echo $query1."<br>";
						_sales_query($query1);

					} else {
						// 삽입
						$query1 = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$uid','".$rows1->code."','pc','$html','$TODAYTIME')";
		    			//echo $query1."<br>";
		    			_sales_query($query1);

		    			$query1 = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$uid','".$rows1->code."','m','$html_m','$TODAYTIME')";
		    			//echo $query1."<br>";
		    			_sales_query($query1);
					}	


				}

				$goodname .= "}";
				$query .= "`goodname`='$goodname' ,";

				$spec .= "}";
				$query .= "`spec`='$spec' ,";

				$subtitle .= "}";
				$query .= "`subtitle`='$subtitle' ,";

				$optionitem .= "}";
				$query .= "`optionitem`='$optionitem' ,";

				$seo_title .= "}";
				$query .= "`seo_title`='$seo_title' ,";

				$seo_description .= "}";
				$query .= "`seo_description`='$seo_description' ,";

				$seo_keyword .= "}";
				$query .= "`seo_keyword`='$seo_keyword' ,";

			}

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			// echo $query;
			_sales_query($query);

			//_ajax_pagecall_script("/ajax_shop_goods.php",_formdata("ajaxkey"));
			
		} else if($mode == "new"){

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_goods` WHERE `Id`='$uid'";
    		_sales_query($query);
		    // echo $query."<br>";
			//_ajax_pagecall_script("/ajax_shop_goods.php",_formdata("ajaxkey"));

		} 

*/
	
?>