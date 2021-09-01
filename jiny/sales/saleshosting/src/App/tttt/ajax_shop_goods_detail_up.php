<?
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

	include "./func/error.php";

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/members.php";

	include "./func/curl.php";



    	function _form_uploadfile($formname,$filename){
    		if($_FILES[$formname]['tmp_name']){
    			// 파일 확장자 검사
    			
    			$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    			else {
    				if($filename == ""){
    					// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {
    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();
		$uid = _formdata("uid");		
		$limit = _formdata("limit");
		

		if($mode == "enable"){
			// 상품 판매 활성화
			$query = "UPDATE `shop_goods` SET `enable`='on' WHERE `Id`=$uid";
			_sales_query($query);

		} else if($mode == "disable"){
			// 상품 판매 비활성화
			$query = "UPDATE `shop_goods` SET `enable`='' WHERE `Id`=$uid";
			_sales_query($query);

		} else if($uid && $mode == "edit"){
			$_POST['mode'] = $mode; // GET 으로 넘겨옴 mode 값을, post 값으로 재정장
			// 상품 정보 수정 
			$query = "select * from `shop_goods` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				/*
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

				// 선택한 다수의 카테고리를 체크
				if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ 
					$cate_select .= "$value;"; 
				}
				$query .= "`cate`='$cate_select' ,";
				*/

				// 파일 업로드
				$path = substr($rows->regdate,0,10);
				$path = explode("-",$path);
				_is_path("./goods/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$rows->Id);
				$dir = "./goods/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$rows->Id;

				// 이미지 파일1, 서버로 업로드 
		
				if($files = _form_uploadfile("userfile1",$dir."/images1-".$uid)) {
					$query .= "`images1`='".$dir."/images1-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images1-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images1'] = '@'.$file_name_with_full_path;
				}

				if($files = _form_uploadfile("userfile2",$dir."/images2-".$uid)) {
					$query .= "`images2`='".$dir."/images2-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images2-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images2'] = '@'.$file_name_with_full_path;
				}

				if($files = _form_uploadfile("userfile3",$dir."/images3-".$uid)) {
					$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images3-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images3'] = '@'.$file_name_with_full_path;
				}


				/*
				if($files = _form_uploadfile("userfile6",$dir."/file6-".$uid)) $query .= "`filename1`='".$dir."/file6-".$uid.".".$files[ext]."' ,";
				if($files = _form_uploadfile("userfile7",$dir."/file7-".$uid)) $query .= "`filename2`='".$dir."/file7-".$uid.".".$files[ext]."' ,";
				if($files = _form_uploadfile("userfile8",$dir."/file8-".$uid)) $query .= "`filename3`='".$dir."/file8-".$uid.".".$files[ext]."' ,";



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

			*/

			echo "curl calling ... <br>";
			echo "http://".$sales_db->domain."/curl_goods.php"."<br>";
			print_r($_POST);
			echo "<br> ***************************** <br>";

			$_POST['adminkey'] = $sales_db->adminkey;
			echo _curl_post("http://".$sales_db->domain."/curl_goods.php",$_POST);




			}



		} else if($mode == "new"){

			$query = "select * from `shop_goods` order by Id desc";
			if($goods_rows = _mysqli_query_rows($query)){
				$max_id = $goods_rows->Id +1;

				$_POST['mode'] = $mode; // GET 으로 넘겨옴 mode 값을, post 값으로 재정장
				
				// 파일 업로드 경로
				$dir = "./goods/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$max_id;
				_is_path($dir);
				

				// 이미지 파일1, 서버로 업로드
				// 임시 폴더로 업로드 후, curl로 고객 서버에 전송	
				if($files = _form_uploadfile("userfile1",$dir."/images1-".$max_id)) {
					//$query .= "`images1`='".$dir."/images1-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images1-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images1'] = '@'.$file_name_with_full_path;
				}

				if($files = _form_uploadfile("userfile2",$dir."/images2-".$max_id)) {
					//$query .= "`images2`='".$dir."/images2-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images2-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images2'] = '@'.$file_name_with_full_path;
				}

				if($files = _form_uploadfile("userfile3",$dir."/images3-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images3-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images3'] = '@'.$file_name_with_full_path;
				}

			}


			echo "curl calling ... <br>";
			echo "http://".$sales_db->domain."/curl_goods.php"."<br>";
			print_r($_POST);
			echo "<br> ***************************** <br>";

			$_POST['adminkey'] = $sales_db->adminkey;
			echo _curl_post("http://".$sales_db->domain."/curl_goods.php",$_POST);


			/*
			$insert_filed = "";
			$insert_value = "";


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

			$query = "select * from `shop_goods` order by Id desc";
			$goods_rows = _sales_query_rows($query);
			$max_id = $goods_rows->Id +1;

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
		    		
		    		$query = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$max_id','".$rows1->code."','pc','$html','$TODAYTIME')";
		    		_sales_query($query);

		    		$query = "INSERT INTO `shop_goods_html` (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$maxid','".$rows1->code."','m','$html_m','$TODAYTIME')";
		    		_sales_query($query);
		
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

			if($files = _form_uploadfile("userfile1","abcd")){
				$insert_filed .= "`images1`,";
				$insert_value .= "'./".$files[filename].".".$files[ext]."',";
			}

			if($files = _form_uploadfile("userfile2","abcd")) {
				$insert_filed .= "`images2`,";
				$insert_value .= "'./".$files[filename].".".$files[ext]."',";
			}

			if($files = _form_uploadfile("userfile3","abcd")) {
				$insert_filed .= "`images3`,";
				$insert_value .= "'./".$files[filename].".".$files[ext]."',";
			}

			if($files = _form_uploadfile("userfile6","abcd")) {
				$insert_filed .= "`filename1`,";
				$insert_value .= "'./".$files[filename].".".$files[ext]."',";
			}

			if($files = _form_uploadfile("userfile7","abcd")) {
				$insert_filed .= "`filename2`,";
				$insert_value .= "'./".$files[filename].".".$files[ext]."',";
			}

			if($files = _form_uploadfile("userfile8","abcd")) {
				$insert_filed .= "`filename3`,";
				$insert_value .= "'./".$files[filename].".".$files[ext]."',";
			}

			$query = "INSERT INTO `shop_goods` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			// echo $query;
			//_ajax_pagecall_script("/ajax_shop_goods.php",_formdata("ajaxkey"));
			*/

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_goods` WHERE `Id`='$uid'";
    		_sales_query($query);
		    // echo $query."<br>";


		} 

		
		// **********************
		// CURL을 통하여, 해당 고객 계정 서버에 상품 설명 html 파일을 생성함.
		// CURL 처리
		//$curl_path = "http://".$sales_db->domain."/curl_goods.php";
		// echo _curl_post($curl_path,"mode=html&uid=$uid");






		








		$searchkey = _formdata("searchkey");

		/*
		
		echo "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		<form id='data' name='good' method='post' enctype='multipart/form-data'> 
		<input type='hidden' name='searchkey' value='$searchkey'>
		<script>
			$.ajax({
            	url:'/ajax_shop_goods.php?limit=".$limit."&ajaxkey=".$ajaxkey."',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('.mainbody').html(data);
            	}
        	});
    	</script>
		</form>
    	";
    	*/
    
    	
    			


		
	} else {
		$body = _skin_page($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>