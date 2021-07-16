<?
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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/sales/sales.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	// echo "ajaxkey = ".$ajaxkey."<br>";
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");	

		// 판매재고 관련 함수들
		include ($_SERVER['DOCUMENT_ROOT']."/sales/sales_function.php");
		

		$mode = _formmode();	
		// echo "mode = $mode <br>";
		
		$uid = _formdata("uid");	
		echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$house = _formdata("house");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		if($mode == "b2b_import"){
			// +++++++++++++++++++++++
			// 제품을 -> B2B 공유등록으로 복사
			// B2B 상품 공유등록

			if(isset($_COOKIE['cookie_email']))	{
				$email = $_COOKIE['cookie_email'];
			}


			$query = "select * from service.b2b_goods where Id = '".$uid."'";
			if($rows = _mysqli_query_rows($query)){	

				// ++ B2B 마켓상품을, 내상품으로 등록
				$query = new query;
				$query->table_name = "sales_goods";

				$query->insert("regdate",$TODAYTIME);
				$query->insert("enable", $rows->enable);
				$query->insert("bom",$rows->bom);
				$query->insert("company",$rows->company);
				$query->insert("business",$rows->business);
				$query->insert("cate",$rows->cate);
				$query->insert("name",$rows->name);
				$query->insert("option",$rows->option);
				$query->insert("barcode",$rows->barcode);
				$query->insert("goodcode",$rows->goodcode);
				$query->insert("model",$rows->model);
				$query->insert("brand",$rows->brand);
				$query->insert("country",$rows->country);
				$query->insert("sell_vat",$rows->sell_vat);
				$query->insert("b2b_vat",$rows->b2b_vat);
				$query->insert("buy_vat",$rows->buy_vat);
				$query->insert("sell_currency",$rows->sell_currency);
				$query->insert("prices_sell",$rows->prices_sell);
				$query->insert("buy_currency",$rows->buy_currency);
				$query->insert("prices_buy",$rows->prices_buy);
				$query->insert("b2b_currency",$rows->b2b_currency);
				$query->insert("prices_b2b",$rows->prices_b2b);
				$query->insert("stock_safe",$rows->stock_safe);
				$query->insert("stock_check",$rows->stock_check);
				$query->insert("stock_order",$rows->stock_order);
				$query->insert("timestamp",$TODAYTIME);
				$query->insert("email",$rows->email);
				$query->insert("b2b_uid",$rows->b2b_uid);
				$query->insert("b2b","on");
				$query->insert("b2b_margin",$rows->b2b_margin);
				$query->insert("shopping",$shopping);
				$query->insert("shopping_uid",$shop_uid); // 쇼핑몰 상품 ID 등록
				$query->insert("comment",$rows->comment);
				$query->insert("images",$rows->images);

				$_query = $query->insert_query();				
				echo $_query;
				$insert_uid = _sales_insert($_query);

				// ++ 상대방에게 상품 링크를 등록
				$query->clear();

				$query->table_name = "service.b2b_goods_links";
				$query->insert("regdate",$TODAYTIME);
				$query->insert("export_email",$rows->email);
				$query->insert("export_uid",$rows->b2b_uid);
				$query->insert("import_email",$email);
				$query->insert("import_uid",$insert_uid);

				$_query = $query->insert_query();				
				echo $_query;
				_mysqli_query($_query);



				
				// +++++++++++++++


			} // end of rows					
			
			$url = "b2b_goods.php"."?limit=$limit&searchkey=$search&house=".$house;    		
			// echo "<script> location.replace('$url'); </script>";

		} else if($mode == "edit"){
			echo "edit";

			$query = "UPDATE service.b2b_goods SET ";
					
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

			$b2b_margin = _formdata("b2b_margin"); $query .= "`b2b_margin`='$b2b_margin' ,";
			$prices_b2b = _formdata("prices_b2b"); $query .= "`prices_b2b`='$prices_b2b' ,";
			$b2b_comment = _formdata("b2b_comment"); $query .= "`b2b_comment`='$b2b_comment' ,";

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			echo $query;
			_mysqli_query($query);



			$url = "b2b_goods.php"."?limit=$limit&searchkey=$search&house=".$house;    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "delete"){
			echo "delete";

			$query = "DELETE FROM service.b2b_goods WHERE `Id`='$uid'";
    		_mysqli_query($query);

			$url = "b2b_goods.php"."?limit=$limit&searchkey=$search&house=".$house;    		
			echo "<script> location.replace('$url'); </script>";	

		} // 
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}





// $rows 데이터기준으로 $table에 $field값만 
// sales query를 작성하여 DB에 입력함
function _hostQuery_insertRows($table,$rows,$field){
	// $insert_filed = "";	$insert_value = "";	
	
	$_field = explode(",", $field);
	for($i=0;$i<count($_field);$i++){
		$insert_filed .= "`".$_field[$i]."`,";	
		$insert_value .= "'".$rows->$_field[$i]."',";
	}

	$query = "INSERT INTO $table ($insert_filed) VALUES ($insert_value)";
	$query = str_replace(",)",")",$query);
	echo $query;
	return _sales_query($query);
	
}

// $post 데이터기준으로 $table에 $field값만 
// sales query를 작성하여 DB에 입력함
function _hostQuery_insertPOST($table,$field){
	// $insert_filed = "";	$insert_value = "";	
	
	$_field = explode(",", $field);
	for($i=0;$i<count($_field);$i++){
		$insert_filed .= "`".$_field[$i]."`,";
		$value = _formdata($_field[$i]);
		$insert_value .= "'".$value."',";
	}

	$query = "INSERT INTO $table ($insert_filed) VALUES ($insert_value)";
	$query = str_replace(",)",")",$query);
	echo $query;
	return _sales_query($query);
	
}

	
?>