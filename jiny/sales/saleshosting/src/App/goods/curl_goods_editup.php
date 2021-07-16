<?
	// CURL Cross 처리

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");


	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	


	echo "OpenSales V2.1 API<br>";
	if($adminkey = $_POST['adminkey']){	// CURL API 접속 권환 체크 // adminkey 값

		echo "Checking adminkey... ";
		$query = "select * from `site_env` where adminkey='$adminkey'";
		if($rows = _mysqli_query_rowss($query)){
			echo " = ok<br>";

			$mode = _formmode();
			echo "mode is $mode <br>";

			$uid = _formdata("uid");
			//$dir = _check_goods_dir($uid);
			//echo "goods path is $dir <br>";


			// CURL POST 파일 업로드 처리

			$uploaddir = realpath('./') . '/';

			if($_FILES['images1']){
				$uploadfile1 = $uploaddir.$dir."/". basename($_FILES['images1']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images1']['tmp_name'], $uploadfile1)) {
	   				echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images2']){
				$uploadfile2 = $uploaddir.$dir."/". basename($_FILES['images2']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images2']['tmp_name'], $uploadfile2)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images3']){
				$uploadfile3 = $uploaddir.$dir."/". basename($_FILES['images3']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images3']['tmp_name'], $uploadfile3)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images4']){
				$uploadfile4 = $uploaddir.$dir."/". basename($_FILES['images4']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images4']['tmp_name'], $uploadfile4)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images5']){
				$uploadfile5 = $uploaddir.$dir."/". basename($_FILES['images5']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images5']['tmp_name'], $uploadfile5)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images6']){
				$uploadfile6 = $uploaddir.$dir."/". basename($_FILES['images6']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images6']['tmp_name'], $uploadfile6)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images7']){
				$uploadfile7 = $uploaddir.$dir."/". basename($_FILES['images7']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images7']['tmp_name'], $uploadfile7)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images8']){
				$uploadfile8 = $uploaddir.$dir."/". basename($_FILES['images8']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images8']['tmp_name'], $uploadfile8)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}

			if($_FILES['images9']){
				$uploadfile9 = $uploaddir.$dir."/". basename($_FILES['images9']['name']);
				echo "uploadfile : $uploadfile <br>";
				echo '<pre>';
				if (move_uploaded_file($_FILES['images9']['tmp_name'], $uploadfile9)) {
	    			echo "File is valid, and was successfully uploaded.\n";
				} else {
	    			echo "Possible file upload attack!\n";
				}
			}


			echo 'Here is some more debugging info:';
			print_r($_FILES);

			echo "\n<hr />\n";
			print_r($_POST);
			print "</pr" . "e>\n<br>";

			
			if($mode == "edit"){
				// _goods_edit($dir,$uid);

			} else if($mode == "new"){
				// _goods_new($dir);
			} else if($mode == "upload"){

				// uid
				$code = _formdata("code");

				$YEAR = date("Y",time());
    			$MONTH = date("m",time());
    			$DAY = date("d",time());

				$dir = "./Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$code;
				if(!is_dir("./Y".$YEAR)) mkdir("./Y".$YEAR);
				if(!is_dir("./Y".$YEAR."/M".$MONTH)) mkdir("./Y".$YEAR."/M".$MONTH);
				if(!is_dir("./Y".$YEAR."/M".$MONTH."/D".$DAY)) mkdir("./Y".$YEAR."/M".$MONTH."/D".$DAY);
				if(!is_dir("./Y".$YEAR."/M".$MONTH."/D".$DAY."/goods_".$code)) mkdir("./Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$code);

				$uploaddir = realpath('./') . '/';
				for($i=1;$i<=10;$i++){
					$userfile = "userfile".$i;
					if($file = _formdata($userfile)){
						$uploadfile = $dir."/".basename( $file );
						$userfile1_path = $userfile."_path";
						if (move_uploaded_file($_FILES[$userfile1_path]['tmp_name'], $uploadfile)) {
	    					echo "파일 업로드 성공.\n";
						} else {
	    					echo "업로드 실패!\n";
						}
					}
				}

			} else if($mode == "delete"){
				// 상품 디렉토리 삭제
				exec("rm -rf .$dir",$output);
			}

		} else echo "Error! invaild adminkey";	
	} else echo "Error! No adminkey.<br>";
	


	function _goods_new($dir){
		global $TODAYTIME;
		global $site_language;

		$insert_filed = "`regdate`,";		$insert_value = "'$TODAYTIME',";

		if($enable = _formdata("enable")){
			$insert_filed .= "`enable`,";	$insert_value .= "'on',";
		}

		if($check_priod = _formdata("check_priod")){	$insert_filed .= "`check_priod`,";	$insert_value .= "'on',";	}
		if($startselling = _formdata("startselling")){	$insert_filed .= "`startselling`,";	$insert_value .= "'$startselling',";	}
		if($endselling = _formdata("endselling")){	$insert_filed .= "`endselling`,";	$insert_value .= "'$endselling',";	}



		$insert_filed .= "`cate`,";	$insert_value .= "'"._formdata("cate")."',";
		$insert_filed .= "`master_cate`,";	$insert_value .= "'"._formdata("master_cate")."',";

		$insert_filed .= "`sales_country`,";	$insert_value .= "'"._formdata("sales_country")."',";
			

		if($pos = _formdata("pos")) {
			$insert_filed .= "`pos`,";
			$insert_value .= "'$pos',";
		}		

		if($prices_buy = _formdata("prices_buy")) {
			$insert_filed .= "`prices_buy`,";
			$insert_value .= "'$prices_buy',";
		}


		if($prices_b2b = _formdata("prices_b2b")) {
			$insert_filed .= "`prices_b2b`,";
			$insert_value .= "'$prices_b2b',";
		}

		if($sell_currency = _formdata("sell_currency")) {
			$insert_filed .= "`sell_currency`,";
			$insert_value .= "'$sell_currency',";
		}

		if($prices_sell = _formdata("prices_sell")) {
			$insert_filed .= "`prices_sell`,";
			$insert_value .= "'$prices_sell',";
		}

		if($country = _formdata("country")) {
			$insert_filed .= "`country`,";
			$insert_value .= "'$country',";
		}

		if($sales_countrys = _formdata("sales_countrys")) {
			$insert_filed .= "`sales_country`,";
			$insert_value .= "'$sales_countrys',";
		}

		if($goodcode = _formdata("goodcode")) {
			$insert_filed .= "`code`,";
			$insert_value .= "'$goodcode',";
		}

		if($model = _formdata("model")) {
			$insert_filed .= "`model`,";
			$insert_value .= "'$model',";
		}

		if($brand = _formdata("brand")) {
			$insert_filed .= "`brand`,";
			$insert_value .= "'$brand',";
		}

		if($barcode = _formdata("barcode")) {
			$insert_filed .= "`barcode`,";
			$insert_value .= "'$barcode',";
		}

		if($name = _formdata("name")) {
			$insert_filed .= "`name`,";
			$insert_value .= "'$name',";
		}

		if($seller = _formdata("seller")) { $insert_filed .= "`seller`,";	$insert_value .= "'$seller',";	}
		if($seller_auth = _formdata("seller_auth")){ $insert_filed .= "`seller_auth`,";	$insert_value .= "'on',";	}
		if($seller_order = _formdata("seller_order")){ $insert_filed .= "`seller_order`,";	$insert_value .= "'on',";	}

		if($vat = _formdata("vat")) {
			$insert_filed .= "`vat`,";
			$insert_value .= "'$vat',";
		}

		if($vatrate = _formdata("vatrate")) {
			$insert_filed .= "`vatrate`,";
			$insert_value .= "'$vatrate',";
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

		if($$blog = _formdata("$blog")) {
			$insert_filed .= "`blog`,";
			$insert_value .= "'$blog',";
		}

		if($youtube = _formdata("youtube")) {
			$insert_filed .= "`youtube`,";
			$insert_value .= "'$youtube',";
		}

		if($relation_check = _formdata("relation_check")){ $insert_filed .= "`relation_check`,";	$insert_value .= "'on',";	}
		if($relation_type = _formdata("relation_type")) {	$insert_filed .= "`relation_type`,";	$insert_value .= "'$relation_type',";	}
		if($relation_cols = _formdata("relation_cols")) {	$insert_filed .= "`relation_cols`,";	$insert_value .= "'$relation_cols',";	}
		if($relation_rows = _formdata("relation_rows")) {	$insert_filed .= "`relation_rows`,";	$insert_value .= "'$relation_rows',";	}

		if($imgsize = _formdata("imgsize")) {	$insert_filed .= "`imgsize`,";	$insert_value .= "'$imgsize',";	}
		if($mobile_imgsize = _formdata("mobile_imgsize")) {	$insert_filed .= "`mobile_imgsize`,";	$insert_value .= "'$mobile_imgsize',";	}

		if(isset($_COOKIE['cookie_email'])){
			$insert_filed .= "`email`,";
			$insert_value .= "'".$_COOKIE['cookie_email']."',";
		}

		if($attach_label = _formdata("attach_label")) {
			$insert_filed .= "`attach_label`,";
			$insert_value .= "'$attach_label',";
		}

		$query = "select * from `shop_goods` order by Id desc";
		$goods_rows = _mysqli_query_rows($query);
		$max_id = $goods_rows->Id +1;

			//# 언어별 상품정보 갱신
			$query1 = "select * from `site_language`";
			if($rowss1 = _mysqli_query_rowss($query1)){

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
    				$_keyfeild = $rows1->code;						
					$html =  _formdata($_keyfeild); $html = addslashes($html);

					$_keyfeild_m = $rows1->code."_m";
					$html_m = _formdata($_keyfeild_m); $html_m = addslashes($html_m);
		    		
		    		$query = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$max_id','".$rows1->code."','pc','$html','$TODAYTIME')";
		    		_mysqli_query($query);

		    		$query = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$max_id','".$rows1->code."','m','$html_m','$TODAYTIME')";
		    		_mysqli_query($query);
		
				}

				$goodname .= "}";
				
				$insert_filed .= "`goodname`,";
				$insert_value .= "'$goodname',";

				$spec .= "}";
				
				$insert_filed .= "`spec`,";
				$insert_value .= "'$spec',";

				$subtitle .= "}";
				
				$insert_filed .= "`subtitle`,";
				$insert_value .= "'$subtitle',";

				$optionitem .= "}";
				
				$insert_filed .= "`optionitem`,";
				$insert_value .= "'$optionitem',";

				$seo_title .= "}";
				
				$insert_filed .= "`seo_title`,";
				$insert_value .= "'$seo_title',";

				$seo_description .= "}";
				
				$insert_filed .= "`seo_description`,";
				$insert_value .= "'$seo_description',";

				$seo_keyword .= "}";
				$insert_filed .= "`seo_keyword`,";
				$insert_value .= "'$seo_keyword',";

			}

		// 파일 업로드
		// 이미지 파일1, 서버로 업로드 
		if($_FILES['images1']){
			$ext = substr($_FILES['images1']['name'], strrpos($_FILES['images1']['name'], '.') + 1);
			$insert_filed .= "`images1`,";
			$insert_value .= "'/goods".$dir."/images1-".$max_id.".".$ext."' ,";
		}

		if($_FILES['images2']){
			$ext = substr($_FILES['images2']['name'], strrpos($_FILES['images2']['name'], '.') + 1);
			$insert_filed .= "`images2`,";
			$insert_value .= "'/goods".$dir."/images2-".$max_id.".".$ext."' ,";
		}

		if($_FILES['images3']){
			$ext = substr($_FILES['images3']['name'], strrpos($_FILES['images3']['name'], '.') + 1);
			$insert_filed .= "`images3`,";
			$insert_value .= "'/goods".$dir."/images3-".$max_id.".".$ext."' ,";			
		}

		if($_FILES['images4']){
			$ext = substr($_FILES['images4']['name'], strrpos($_FILES['images4']['name'], '.') + 1);
			$insert_filed .= "`images4`,";
			$insert_value .= "'/goods".$dir."/images4-".$max_id.".".$ext."' ,";			
		}

		if($_FILES['images5']){
			$ext = substr($_FILES['images5']['name'], strrpos($_FILES['images5']['name'], '.') + 1);
			$insert_filed .= "`images5`,";
			$insert_value .= "'/goods".$dir."/images5-".$max_id.".".$ext."' ,";			
		}

		if($_FILES['images6']){
			$ext = substr($_FILES['images6']['name'], strrpos($_FILES['images6']['name'], '.') + 1);
			$insert_filed .= "`images6`,";
			$insert_value .= "'/goods".$dir."/images6-".$max_id.".".$ext."' ,";			
		}

		if($_FILES['images7']){
			$ext = substr($_FILES['images7']['name'], strrpos($_FILES['images7']['name'], '.') + 1);
			$insert_filed .= "`images7`,";
			$insert_value .= "'/goods".$dir."/images7-".$max_id.".".$ext."' ,";			
		}

		if($_FILES['images8']){
			$ext = substr($_FILES['images8']['name'], strrpos($_FILES['images8']['name'], '.') + 1);
			$insert_filed .= "`images8`,";
			$insert_value .= "'/goods".$dir."/images8-".$max_id.".".$ext."' ,";			
		}

		if($_FILES['images9']){
			$ext = substr($_FILES['images9']['name'], strrpos($_FILES['images9']['name'], '.') + 1);
			$insert_filed .= "`images9`,";
			$insert_value .= "'/goods".$dir."/images9-".$max_id.".".$ext."' ,";			
		}


		$query = "INSERT INTO `shop_goods` ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		echo $query."<br>";
		$insert_id = _mysqli_insert($query);


		// ++ 판매재고 상품연동 등록
		$goodname = _formdata("goodname_".$site_language);
		$cate = _formdata("cate");
		$query = "INSERT INTO sales_goods (`regdate`,`shop`,`name`,`prices_buy`,`prices_b2b`,`prices_sell`,`shopping`,`shopping_uid`,`cate`) 
					VALUES ('$TODAYTIME','$max_id','$goodname','$prices_buy','$prices_b2b','$prices_sell','on','$insert_id','$cate')";
		_mysqli_query($query);

	}



	function _goods_edit($dir,$uid){
		global $site_language;


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
		
		//if($prices_sell = _formdata("prices_sell")) $query .= "`prices_sell`='$prices_sell' ,";
		$prices_sell = _formdata("prices_sell");
		$query .= "`prices_sell`='$prices_sell' ,";

		if($country = _formdata("country")) $query .= "`country`='$country' ,";
		if($sales_countrys = _formdata("sales_countrys")) $query .= "`sales_country`='$sales_countrys' ,";
			
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

		$relation_goods = _formdata("relation_goods"); $query .= "`relation_goods`='$relation_goods' ,";
		$relation_imgsize = _formdata("relation_imgsize"); $query .= "`relation_imgsize`='$relation_imgsize' ,";

				/*
				// 선택한 다수의 카테고리를 체크
				if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ 
					$cate_select .= "$value;"; 
				}
				$query .= "`cate`='$cate_select' ,";


				// Master 카테
				if($_POST['master_cate'] ) foreach ($_POST['master_cate'] as $value){ 
					$master_cate_select .= "$value;"; 
				}
				$query .= "`master_cate`='$master_cate_select' ,";
				*/
		$cate = _formdata("cate"); $query .= "`cate`='$cate' ,";
		$master_cate = _formdata("master_cate"); $query .= "`master_cate`='$master_cate' ,";

		$attach_label = _formdata("attach_label"); $query .= "`attach_label`='$attach_label' ,";

				// 파일 업로드
				// 이미지 파일1, 서버로 업로드 
				if($_FILES['images1']){
					$ext = substr($_FILES['images1']['name'], strrpos($_FILES['images1']['name'], '.') + 1);
					$query .= "`images1`='/goods".$dir."/images1-".$uid.".".$ext."' ,";
					// $query .= "`images1`='$uploadfile1' ,";
					
				}

				if($_FILES['images2']){
					$ext = substr($_FILES['images2']['name'], strrpos($_FILES['images2']['name'], '.') + 1);
					$query .= "`images2`='/goods".$dir."/images2-".$uid.".".$ext."' ,";
				}

				if($_FILES['images3']){
					$ext = substr($_FILES['images3']['name'], strrpos($_FILES['images3']['name'], '.') + 1);
					$query .= "`images3`='/goods".$dir."/images3-".$uid.".".$ext."' ,";
				}


				if($_FILES['images4']){
					$ext = substr($_FILES['images4']['name'], strrpos($_FILES['images4']['name'], '.') + 1);
					$query .= "`images4`='/goods".$dir."/images4-".$uid.".".$ext."' ,";
				}


				if($_FILES['images5']){
					$ext = substr($_FILES['images5']['name'], strrpos($_FILES['images5']['name'], '.') + 1);
					$query .= "`images5`='/goods".$dir."/images5-".$uid.".".$ext."' ,";
				}


				if($_FILES['images6']){
					$ext = substr($_FILES['images6']['name'], strrpos($_FILES['images6']['name'], '.') + 1);
					$query .= "`images6`='/goods".$dir."/images6-".$uid.".".$ext."' ,";
				}


				if($_FILES['images7']){
					$ext = substr($_FILES['images7']['name'], strrpos($_FILES['images7']['name'], '.') + 1);
					$query .= "`images7`='/goods".$dir."/images7-".$uid.".".$ext."' ,";
				}


				if($_FILES['images8']){
					$ext = substr($_FILES['images8']['name'], strrpos($_FILES['images8']['name'], '.') + 1);
					$query .= "`images8`='/goods".$dir."/images8-".$uid.".".$ext."' ,";
				}


				if($_FILES['images9']){
					$ext = substr($_FILES['images9']['name'], strrpos($_FILES['images9']['name'], '.') + 1);
					$query .= "`images9`='/goods".$dir."/images9-".$uid.".".$ext."' ,";
				}

				





		//# 언어별 상품정보 갱신
		$query1 = "select * from `site_language`";
		if($rowss1 = _mysqli_query_rowss($query1)){

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
    			$_keyfeild = $rows1->code; 					
				$html = _formdata($_keyfeild); $html = addslashes($html);

				$_keyfeild_m = $rows1->code."_m";
				$html_m = _formdata($_keyfeild_m); $html_m = addslashes($html_m);
				

				$query1 = "select * from `shop_goods_html` WHERE `goods`='$uid' and `language`='".$rows1->code."'";
				if($goods_rows = _mysqli_query_rows($query1)){
					// 갱신 
					$query1 ="UPDATE `shop_goods_html` SET `html`='$html', `timestamp`='$TODAYTIME' WHERE `goods`='$uid' and `mobile`='pc' and `language`='".$rows1->code."'";
					//echo $query1."<br>";
					_mysqli_query($query1);

					$query1 ="UPDATE `shop_goods_html` SET `html`='$html_m', `timestamp`='$TODAYTIME' WHERE `goods`='$uid' and `mobile`='m' and `language`='".$rows1->code."'";
					//echo $query1."<br>";
					_mysqli_query($query1);

				} else {
					// 삽입
					$query1 = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$uid','".$rows1->code."','pc','$html','$TODAYTIME')";
		    		//echo $query1."<br>";
		    		_mysqli_query($query1);

		    		$query1 = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$uid','".$rows1->code."','m','$html_m','$TODAYTIME')";
		    		//echo $query1."<br>";
		    		_mysqli_query($query1);
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
		echo $query."<br>";
		_mysqli_query($query);


		

	}


	function _check_goods_dir($uid){
		
		if($uid){
			echo "등록상품의 path 경로";
			$query = "select * from `shop_goods` where Id='$uid'";
			if($rows = _mysqli_query_rows($query)){
				$path = substr($rows->regdate,0,10);
				$path = explode("-",$path);
				$dir = "/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$rows->Id;
				_is_path(".".$dir);
			}	
		} else {
			$YEAR = date("Y",time());
    		$MONTH = date("m",time());
    		$DAY = date("d",time());


			echo "미등록 신규상품의 path 경로";
			$query = "select * from `shop_goods` order by Id desc";
			$goods_rows = _mysqli_query_rows($query);
			$max_id = $goods_rows->Id +1;
			$dir = "/Y".$YEAR."/M".$MONTH."/D".$DAY."/goods_".$max_id;
			_is_path(".".$dir);
		}

		return $dir;
	}

			
			

	

			

	
?>