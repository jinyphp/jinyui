<?php
	@session_start();

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");
	
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();
		echo "mode = ".$mode;

		$uid = _formdata("uid");		
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$category = _formdata("category");
		echo "category = $category <br>";
		
		$_enable = _formdata("_enable");
		$lis_tnum = _formdata("lis_tnum");
		$_soldout = _formdata("_soldout");
		
		

		if($mode == "enable"){
			// 상품 판매 활성화
			$query = "UPDATE shop_goods SET `enable`='on' WHERE `Id`=$uid";
			_mysqli_query($query);
		
		} else if($mode == "check_enable"){
			// 체크상품 모두 황성화
			if($TID = $_POST['TID']){
				for($i=0,$amount=0;$i<count($TID);$i++){
					$query = "UPDATE shop_goods SET `enable`='on' WHERE `Id`=".$TID[$i];
					_mysqli_query($query);
				}
			}
		
		} else if($mode == "disable"){
			// 상품 판매 비활성화
			$query = "UPDATE shop_goods SET `enable`='' WHERE `Id`=$uid";
			_mysqli_query($query);

		} else if($mode == "check_disable"){
			// 체크상품 모두 비황성화
			if($TID = $_POST['TID']){
				for($i=0,$amount=0;$i<count($TID);$i++){
					$query = "UPDATE shop_goods SET `enable`='' WHERE `Id`=".$TID[$i];
					_mysqli_query($query);
				}
			}

		} else if($mode == "check_delete"){
			// 체크상품 모두 비황성화
			if($TID = $_POST['TID']){
				for($i=0,$amount=0;$i<count($TID);$i++){
					$query = "DELETE FROM shop_goods WHERE `Id`=".$TID[$i];	// echo $query."<br>";
					_mysqli_query($query);
				}
			}			

		} else if($uid && $mode == "edit"){
			$_POST['mode'] = $mode; // GET 으로 넘겨옴 mode 값을, post 값으로 재정장

			// ++ 상품 정보 수정 
			$query = "select * from shop_goods where Id='$uid'";
			if($rows = _mysqli_query_rows($query)){

				$query = new query;
				$query->table_name = "shop_goods";
				$query->where = " Id ='$uid'";

				$query->update("enable",_formdata("enable"));
				$query->update("check_priod",_formdata("check_priod"));
				$query->update("startselling",_formdata("startselling"));
				$query->update("endselling",_formdata("endselling"));
				$query->update("seller",_formdata("seller"));
				$query->update("seller_auth",_formdata("seller_auth"));
				$query->update("seller_order",_formdata("seller_order"));
				$query->update("pos",_formdata("pos"));
				$query->update("prices_buy",_formdata("prices_buy"));
				$query->update("prices_b2b",_formdata("prices_b2b"));
				$query->update("sell_currency",_formdata("sell_currency"));
				$query->update("prices_sell",_formdata("prices_sell"));
				$query->update("country",_formdata("country"));
				$query->update("code",_formdata("goodcode"));
				$query->update("model",_formdata("model"));
				$query->update("brand",_formdata("brand"));
				$query->update("barcode",_formdata("barcode"));
				$query->update("name",_formdata("name"));
				$query->update("vat",_formdata("vat"));
				$query->update("vatrate",_formdata("vatrate"));

				$query->update("check_prices",_formdata("check_prices"));
				$query->update("check_memprices",_formdata("check_memprices"));
				$query->update("check_spec",_formdata("check_spec"));
				$query->update("check_subtitle",_formdata("check_subtitle"));
				$query->update("check_usd",_formdata("check_usd"));
				$query->update("check_goodname",_formdata("check_goodname"));
				$query->update("discount",_formdata("discount"));
				$query->update("discount_rate",_formdata("discount_rate"));
				$query->update("discount_endpriod",_formdata("discount_endpriod"));
				$query->update("imgsize",_formdata("imgsize"));
				$query->update("mobile_imgsize",_formdata("mobile_imgsize"));
				$query->update("free_shipping",_formdata("free_shipping"));
				$query->update("ordertext",_formdata("ordertext"));
				$query->update("attach",_formdata("attach"));
				$query->update("blog",_formdata("blog"));
				$query->update("youtube",_formdata("youtube"));
				$query->update("soldout",_formdata("soldout"));
				$query->update("stock_check",_formdata("stock_check"));
				$query->update("stock",_formdata("stock"));
				$query->update("safe_stock",_formdata("safe_stock"));
				$query->update("relation_check",_formdata("relation_check"));
				$query->update("relation_type",_formdata("relation_type"));
				$query->update("relation_cols",_formdata("relation_cols"));
				$query->update("relation_rows",_formdata("relation_rows"));
				$query->update("relation_goods",_formdata("relation_goods"));
				$query->update("relation_imgsize",_formdata("relation_imgsize"));

				// ++ 선택한 다수의 카테고리를 체크
				if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ $cate_select .= "*$value;"; }
				$query->update("cate",$cate_select);

				// ++ Master 카테
				if($_POST['master_cate'] ) foreach ($_POST['master_cate'] as $value){ $master_cate_select .= "*$value;"; }
				$query->update("master_cate",_formdata("$master_cate_select"));

				if($_POST['sales_country'] ) foreach ($_POST['sales_country'] as $value){ $sales_country_select .= "*$value;"; }
				$query->update("sales_country",$sales_country_select);
			
				$query->update("attach_label",_formdata("attach_label"));

				

				$YEAR = date("Y",time());
    			$MONTH = date("m",time());
    			$DAY = date("d",time());

    			if(!is_dir("./goods/Y".$YEAR)) mkdir("./goods/Y".$YEAR);
				if(!is_dir("./goods/Y".$YEAR."/M".$MONTH)) mkdir("./goods/Y".$YEAR."/M".$MONTH);
				if(!is_dir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY)) mkdir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY);
				if(!is_dir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$uid)) mkdir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$uid);

				// ++ 이미지 업로드 및 갱신, 상품정보 uid 설정
				$post = array('mode'=>"upload", 'code'=>$uid, 'adminkey'=>$sales_db->adminkey);

				for($i=1;$i<=10;$i++){
					$userfile = "userfile".$i;
					if($uploadfile = $_FILES[$userfile]['name']){
						$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   						if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   							echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   						} else {
   							//$file_name_with_full_path = $_FILES[$userfile]['tmp_name'];
   						   						
   							//$post[$userfile] = $_FILES[$userfile]['name'];
   							//$userfile_path = $userfile."_path";
   							//$post[$userfile_path] = '@'.$file_name_with_full_path;
   							$img_path = "/goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$uid."/".$uploadfile;
   							echo "temp_name = ".$_FILES[$userfile]['tmp_name']."<br>";
   							echo "path ".$img_path."<br>";
   							move_uploaded_file($_FILES[$userfile]['tmp_name'], ".".$img_path);

   							$query->update("images".$i,$img_path);
   						}
					}
				}			

   				//$curl_return = _curl_post("./goods/curl_goods_editup.php",$post);
   				//echo $curl_return;
		
   				//# 언어별 상품정보 갱신
				$query1 = "select * from site_language ";
				if($language_rows = _mysqli_query_rowss($query1)){

					for($i=0;$i<count($language_rows);$i++){
						$rows1 = $language_rows[$i];
					
						$code = $rows1->code;

						$_goodname = "goodname_".$code;
						$goodname .= "\"$code\":\"".addslashes( _formdata("goodname_".$code) )."\"";

						$_spec = "spec_".$code;
						$spec .= "\"$code\":\"".addslashes( _formdata("spec_".$code) )."\"";

						$_subtitle = "subtitle_".$code;
						$subtitle .= "\"$code\":\"".addslashes( _formdata("subtitle_".$code) )."\"";

						$_optionitem = "optionitem_".$code;
						$optionitem .= "\"$code\":\"".addslashes( _formdata("optionitem_".$code) )."\"";
						
						$_seo_title = "seo_title_".$code;
						$seo_title .= "\"$code\":\"".addslashes( _formdata("seo_title_".$code) )."\"";
					
						$_seo_description = "seo_description_".$code;
						$seo_description .= "\"$code\":\"".addslashes( _formdata("seo_description_".$code) )."\"";
						
						$_seo_keyword = "seo_keyword_".$code;
						$seo_keyword .= "\"$code\":\"".addslashes( _formdata("seo_keyword_".$code) )."\"";

						if($i<(count($language_rows)-1)) {
							$goodname .= ",";
							$spec .= ",";
							$subtitle .= ",";
							$optionitem .= ",";
							$seo_title .= ",";
							$seo_description .= ",";
							$seo_keyword .= ",";
						}	    		
		
					}

					$query->update("goodname","{".$goodname."}");
					$query->update("spec","{".$spec."}");
					$query->update("subtitle","{".$subtitle."}");
					$query->update("optionitem","{".$optionitem."}");
					$query->update("seo_title","{".$seo_title."}");
					$query->update("seo_description","{".$seo_description."}");
					$query->update("seo_keyword","{".$seo_keyword."}");

				}

				// ++ 상품설명 저장
				
				for($i=0;$i<count($language_rows);$i++){
					$rows1 = $language_rows[$i];					
					$code = $rows1->code;

					// 상품설명 내용 저장 				
					$html = _formdata($code); $html = addslashes($html);
					$html_m = _formdata($code."_m"); $html_m = addslashes($html_m);

					$query1 = "select * from shop_goods_html WHERE `goods`='$uid' and `language`='".$code."'";
					if($goods_rows = _mysqli_query_rows($query1)){
						
						$query1 ="UPDATE shop_goods_html SET `html`='$html', `timestamp`='$TODAYTIME' WHERE `goods`='$uid' and `mobile`='pc' and `language`='".$code."'";
						_mysqli_query($query1);

						$query1 ="UPDATE shop_goods_html SET `html`='$html_m', `timestamp`='$TODAYTIME' WHERE `goods`='$uid' and `mobile`='m' and `language`='".$code."'";
						_mysqli_query($query1);
						
		    		} else {
		    			
		    			$query = "INSERT INTO shop_goods_html (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$uid','".$code."','pc','$html','$TODAYTIME')";
		    			_mysqli_query($query);

		    			$query = "INSERT INTO shop_goods_html (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$uid','".$code."','m','$html_m','$TODAYTIME')";
		    			_mysqli_query($query);
		    			

		    		}
		    		
		    		
				}


				$_query = $query->update_query();
				_mysqli_query($_query);
				echo $_query;	


				
				// ++ 판매관리 상품정보 수정
				$query = "UPDATE `sales_goods` SET ";

				$sell_currency = _formdata("sell_currency");
				$query .= "`sell_currency`='$sell_currency' ,";

				$prices_sell = _formdata("prices_sell");
				$query .= "`prices_sell`='$prices_sell' ,";

				$buy_currency = _formdata("buy_currency");
				$query .= "`buy_currency`='$buy_currency' ,";

				$prices_buy = _formdata("prices_buy");
				$query .= "`prices_buy`='$prices_buy' ,";

				$b2b_currency = _formdata("b2b_currency");
				$query .= "`b2b_currency`='$b2b_currency' ,";

				$prices_b2b = _formdata("prices_b2b");
				$query .= "`prices_b2b`='$prices_b2b' ,";

				$query .= "`cate`='$cate_select' ,";

				$goodsName_code = "goodname_".$site_language;
				echo $goodsName_code."<br>";
				$query .= "`name`='"._formdata($goodsName_code)."' ,";	

				// ++ 상품정보 이미지 파일 갱신
				if($uploadfile = $_FILES['userfile1']['name']){
					$img_path = "/goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$uid."/".$uploadfile;
					$query .= "`images`='$img_path' ,";
				}		

				$query .= "WHERE `Id`='".$rows->sales."'";
				$query = str_replace(",WHERE","WHERE",$query);
				echo $query;
				_mysqli_query($query);
				

			}
			// $url = "shop_goods.php?limit=$limit&searchkey=$search&category=$category&_enable=$_enable&_soldout=$_soldout";    		
			// echo "<script> location.replace('$url'); </script>";
			
		} else if($mode == "new"){
			// ++ 쇼핑몰 상품을 등록합니다.

			$query = new query;
			$query->table_name = "shop_goods";

			$query->insert("regdate",$TODAYTIME);
			$query->insert("enable",_formdata("enable"));

			$query->insert("check_priod",_formdata("check_priod"));
			$query->insert("startselling",_formdata("startselling"));
			$query->insert("endselling",_formdata("endselling"));

			// 선택한 다수의 카테고리를 체크
			if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ $cate_select .= "*$value;"; }
			$query->insert("cate", $cate_select);

			// Master 카테
			if($_POST['master_cate'] ) foreach ($_POST['master_cate'] as $value){ $master_cate_select .= "*$value;"; }
			$query->insert("master_cate", $master_cate_select);

			if($_POST['sales_country'] ) foreach ($_POST['sales_country'] as $value){ $sales_country_select .= "*$value;"; }
			$query->insert("sales_country", $sales_country_select);

			$query->insert("pos",_formdata("pos"));
			$query->insert("prices_buy",_formdata("prices_buy"));
			$query->insert("prices_b2b",_formdata("prices_b2b"));
			$query->insert("sell_currency",_formdata("sell_currency"));
			$query->insert("prices_sell",_formdata("prices_sell"));
			$query->insert("country",_formdata("country"));


			$query->insert("code",_formdata("goodcode"));
			$query->insert("model",_formdata("model"));
			$query->insert("brand",_formdata("brand"));
			$query->insert("barcode",_formdata("barcode"));
			$query->insert("name",_formdata("name"));
			$query->insert("seller",_formdata("seller"));
			$query->insert("seller_auth",_formdata("seller_auth"));
			$query->insert("seller_order",_formdata("seller_order"));

			$query->insert("vat",_formdata("vat"));
			$query->insert("vatrate",_formdata("vatrate"));
			$query->insert("check_prices",_formdata("check_prices"));
			$query->insert("check_memprices",_formdata("check_memprices"));
			$query->insert("check_spec",_formdata("check_spec"));
			$query->insert("check_subtitle",_formdata("check_subtitle"));
			$query->insert("check_usd",_formdata("check_usd"));
			$query->insert("check_goodname",_formdata("check_goodname"));

			$query->insert("discount",_formdata("discount"));
			$query->insert("discount_rate",_formdata("discount_rate"));
			$query->insert("discount_endpriod",_formdata("discount_endpriod"));
			$query->insert("soldout",_formdata("soldout"));
			$query->insert("stock_check",_formdata("stock_check"));
			$query->insert("stock",_formdata("stock"));
			$query->insert("safe_stock",_formdata("safe_stock"));
			$query->insert("free_shipping",_formdata("free_shipping"));
			$query->insert("ordertext",_formdata("ordertext"));
			$query->insert("attach",_formdata("attach"));
			$query->insert("blog",_formdata("blog"));
			$query->insert("youtube",_formdata("youtube"));

			$query->insert("relation_check",_formdata("relation_check"));
			$query->insert("relation_type",_formdata("relation_type"));
			$query->insert("relation_cols",_formdata("relation_cols"));
			$query->insert("relation_rows",_formdata("relation_rows"));
			$query->insert("imgsize",_formdata("imgsize"));
			$query->insert("mobile_imgsize",_formdata("mobile_imgsize"));
			$query->insert("email",$_COOKIE['cookie_email']);
			$query->insert("attach_label",_formdata("attach_label"));

			//# 언어별 상품정보 갱신
			$query1 = "select * from site_language ";
			if($language_rows = _mysqli_query_rowss($query1)){

				for($i=0;$i<count($language_rows);$i++){
					$rows1 = $language_rows[$i];
					
					$code = $rows1->code;

					$_goodname = "goodname_".$code;
					$goodname .= "\"$code\":\"".addslashes( _formdata("goodname_".$code) )."\"";

					$_spec = "spec_".$code;
					$spec .= "\"$code\":\"".addslashes( _formdata("spec_".$code) )."\"";

					$_subtitle = "subtitle_".$code;
					$subtitle .= "\"$code\":\"".addslashes( _formdata("subtitle_".$code) )."\"";

					$_optionitem = "optionitem_".$code;
					$optionitem .= "\"$code\":\"".addslashes( _formdata("optionitem_".$code) )."\"";
						
					$_seo_title = "seo_title_".$code;
					$seo_title .= "\"$code\":\"".addslashes( _formdata("seo_title_".$code) )."\"";
					
					$_seo_description = "seo_description_".$code;
					$seo_description .= "\"$code\":\"".addslashes( _formdata("seo_description_".$code) )."\"";
						
					$_seo_keyword = "seo_keyword_".$code;
					$seo_keyword .= "\"$code\":\"".addslashes( _formdata("seo_keyword_".$code) )."\"";

					if($i<(count($language_rows)-1)) {
						$goodname .= ",";
						$spec .= ",";
						$subtitle .= ",";
						$optionitem .= ",";
						$seo_title .= ",";
						$seo_description .= ",";
						$seo_keyword .= ",";
					}	    		
		
				}

				$query->insert("goodname","{".$goodname."}");
				$query->insert("spec","{".$spec."}");
				$query->insert("subtitle","{".$subtitle."}");
				$query->insert("optionitem","{".$optionitem."}");
				$query->insert("seo_title","{".$seo_title."}");
				$query->insert("seo_description","{".$seo_description."}");
				$query->insert("seo_keyword","{".$seo_keyword."}");

			}
			
			$_query = $query->insert_query();				
			echo $_query;
			$insert_id = _mysqli_insert($_query);	

			// ++ 상품설명 저장
			for($i=0;$i<count($language_rows);$i++){
				$rows1 = $language_rows[$i];					
				$code = $rows1->code;

				// 상품설명 내용 저장 				
				$html = _formdata($code); $html = addslashes($html);
				$html_m = _formdata($code."_m"); $html_m = addslashes($html_m);
		    		
		    	$query = "INSERT INTO shop_goods_html (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$insert_id','".$code."','pc','$html','$TODAYTIME')";
		    	_mysqli_query($query);

		    	$query = "INSERT INTO shop_goods_html (`goods`,`language`,`mobile`,`html`,`timestamp`) VALUES ('$insert_id','".$code."','m','$html_m','$TODAYTIME')";
		    	_mysqli_query($query);
			}		

			// ++ 판매재고 상품연동 등록
			$goodname = _formdata("goodname_".$site_language);
			$query = "INSERT INTO sales_goods (`regdate`,`name`,`prices_buy`,`prices_b2b`,`prices_sell`,`shopping`,`shopping_uid`,`cate`) 
					VALUES ('$TODAYTIME','$goodname','$prices_buy','$prices_b2b','$prices_sell','on','$insert_id','$cate_select')";
			//echo $query."<br>";
			$uid = _mysqli_insert($query);

			

			$YEAR = date("Y",time());
    		$MONTH = date("m",time());
    		$DAY = date("d",time());

    		if(!is_dir("./goods/Y".$YEAR)) mkdir("./goods/Y".$YEAR);
			if(!is_dir("./goods/Y".$YEAR."/M".$MONTH)) mkdir("./goods/Y".$YEAR."/M".$MONTH);
			if(!is_dir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY)) mkdir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY);
			if(!is_dir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$insert_id)) mkdir("./goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$insert_id);


			// ++ 이미지 업로드 및 갱신, 상품정보 uid 설정
			$post = array('mode'=>"upload", 'code'=>$insert_id, 'adminkey'=>$sales_db->adminkey);
			$query = "UPDATE shop_goods SET `sales`='$uid' ,";

			for($i=1;$i<=10;$i++){
				$userfile = "userfile".$i;
				if($uploadfile = $_FILES[$userfile]['name']){
					$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   					if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   						echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   					} else {
   						//$file_name_with_full_path = $_FILES[$userfile]['tmp_name'];
   						   						
   						//$post[$userfile] = $_FILES[$userfile]['name'];
   						//$userfile_path = $userfile."_path";
   						//$post[$userfile_path] = '@'.$file_name_with_full_path;
   						$img_path = "/goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$insert_id."/".$uploadfile;
   						move_uploaded_file($_FILES[$userfile]['tmp_name'], ".".$img_path);
   						$query .= "`images".$i."`='$img_path' ,";
   					}
				}
			}			

   			//$curl_return = _curl_post("http://".$sales_db->domain."/goods/curl_goods_editup.php",$post);

			$query .= "WHERE `Id`='$insert_id'";
			$query = str_replace(",WHERE","WHERE",$query);
			echo $query."<br>";
			_mysqli_query($query);





			
			// ++ 상품정보 이미지 파일 갱신
			if($uploadfile = $_FILES['userfile1']['name']){
				$img_path = "/goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$insert_id."/".$uploadfile;
				$query = "UPDATE sales_goods SET `images`='$img_path' WHERE `Id`='$uid' ";
				_mysqli_query($query);
			}

			//$url = "shop_goods.php?limit=$limit&searchkey=$search&category=$category&_enable=$_enable&_soldout=$_soldout";    		
			//echo "<script> location.replace('$url'); </script>";



		} else if($mode == "delete"){
			// ++ 선택한 판매 상품을 삭제합니다.
			$query = "DELETE FROM `shop_goods` WHERE `Id`='$uid'";	// echo $query."<br>";
    		_mysqli_query($query);

    		$_POST['uid'] = $uid;
    		$_POST['mode'] = $mode; // GET 으로 넘겨옴 mode 값을, post 값으로 재정장
    		$_POST['adminkey'] = $sales_db->adminkey;
			echo _curl_post("./goods/curl_goods_editup.php",$_POST);

			// 관련상품 연결부분 삭제
			//$url = "shop_goods.php?limit=$limit&searchkey=$search&category=$category&_enable=$_enable&_soldout=$_soldout";    		
			//echo "<script> location.replace('$url'); </script>";
		} 
		
	} else {
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $msg;

	}




	
?>