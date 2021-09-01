<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");
		

		if($mode=="edit"){

			$query = "select * from `site_index_goods` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){

				$query = new query;
				$query->table_name = "site_index_goods";
				$query->where = " Id ='$uid'";

				$query->update("enable",_formdata("enable"));
				$query->update("code",_formdata("code"));
				$query->update("title",_formdata("title"));
				$query->update("cate",_formdata("cate"));
				$query->update("domain",$site_env->domain);
				$query->update("sort",_formdata("sort"));

				$query->update("width",_formdata("width"));
				$query->update("align",_formdata("align"));
				$query->update("bgcolor",_formdata("bgcolor"));


				$query->update("check_members",_formdata("check_members"));
				$query->update("check_goodname",_formdata("check_goodname"));
				$query->update("check_images",_formdata("check_images"));
				$query->update("check_subtitle",_formdata("check_subtitle"));
				$query->update("check_spec",_formdata("check_spec"));
				$query->update("check_prices",_formdata("check_prices"));
				$query->update("check_usd",_formdata("check_usd"));
				$query->update("check_memprices",_formdata("check_memprices"));

				$query->update("type",_formdata("cate_type"));
				$query->update("cols",_formdata("cate_cols"));
				$query->update("rows",_formdata("cate_rows"));
				$query->update("imgsize",_formdata("cate_imgsize"));

				$query->update("mobile_type",_formdata("mobile_type"));
				$query->update("mobile_cols",_formdata("mobile_cols"));
				$query->update("mobile_rows",_formdata("mobile_rows"));
				$query->update("mobile_imgsize",_formdata("mobile_imgsize"));

				$query->update("html_apply",_formdata("html_apply"));				
				$query->update("html", addslashes( _formdata("html") ) );
			
								

				$query->update("cell_bgcolor",_formdata("cell_bgcolor"));
				$query->update("cell_outline_width",_formdata("cell_outline_width"));
				$query->update("cell_outline_color",_formdata("cell_outline_color"));
				$query->update("cell_outline_hovercolor",_formdata("cell_outline_hovercolor"));
				$query->update("cell_discount_bgcolor",_formdata("cell_discount_bgcolor"));
				$query->update("cell_discount_color",_formdata("cell_discount_color"));
				$query->update("cell_freeshipping_color",_formdata("cell_freeshipping_color"));
				$query->update("cell_freeshipping_bgcolor",_formdata("cell_freeshipping_bgcolor"));

				$query->update("title_images_check",_formdata("title_images_check"));

				$_query = $query->update_query();
				_sales_query($_query);
				echo $_query;
			}

			echo "사이트 정보가 갱신되었습니다.";	



		} else if($mode=="new"){


			$query = new query;
			$query->table_name = "site_index_goods";
			
			$query->insert("enable",_formdata("enable"));
			$query->insert("code",_formdata("code"));
			$query->insert("title",_formdata("title"));
			$query->insert("cate",_formdata("cate"));
			$query->insert("domain",$site_env->domain);
			$query->insert("sort",_formdata("sort"));

			$query->insert("width",_formdata("width"));
			$query->insert("align",_formdata("align"));
			$query->insert("bgcolor",_formdata("bgcolor"));


			$query->insert("check_members",_formdata("check_members"));
			$query->insert("check_goodname",_formdata("check_goodname"));
			$query->insert("check_images",_formdata("check_images"));
			$query->insert("check_subtitle",_formdata("check_subtitle"));
			$query->insert("check_spec",_formdata("check_spec"));
			$query->insert("check_prices",_formdata("check_prices"));
			$query->insert("check_usd",_formdata("check_usd"));
			$query->insert("check_memprices",_formdata("check_memprices"));

			$query->update("type",_formdata("cate_type"));
			$query->update("cols",_formdata("cate_cols"));
			$query->update("rows",_formdata("cate_rows"));
			$query->update("imgsize",_formdata("cate_imgsize"));

			$query->insert("mobile_type",_formdata("mobile_type"));
			$query->insert("mobile_cols",_formdata("mobile_cols"));
			$query->insert("mobile_rows",_formdata("mobile_rows"));
			$query->insert("mobile_imgsize",_formdata("mobile_imgsize"));

			$query->insert("html_apply",_formdata("html_apply"));				
			$query->insert("html", addslashes( _formdata("html") ) );
	
								

			$query->insert("cell_bgcolor",_formdata("cell_bgcolor"));
			$query->insert("cell_outline_width",_formdata("cell_outline_width"));
			$query->insert("cell_outline_color",_formdata("cell_outline_color"));
			$query->insert("cell_outline_hovercolor",_formdata("cell_outline_hovercolor"));
			$query->insert("cell_discount_bgcolor",_formdata("cell_discount_bgcolor"));
			$query->insert("cell_discount_color",_formdata("cell_discount_color"));
			$query->insert("cell_freeshipping_color",_formdata("cell_freeshipping_color"));
			$query->insert("cell_freeshipping_bgcolor",_formdata("cell_freeshipping_bgcolor"));

			$query->insert("title_images_check",_formdata("title_images_check"));

			$_query = $query->insert_query();
			_sales_query($_query);


		} else if($mode == "delete"){
			_index_goods_delete($uid);
		}



		// 페이지 이동 
		$url = "site_index_goods.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";	

    		

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
	function _index_goods_delete($uid){
		$query = "DELETE FROM `site_index_goods` WHERE `Id`='$uid'";
			// echo $query."<br>";
		_sales_query($query);

		echo "사이트 정보 삭제";
	}


?>