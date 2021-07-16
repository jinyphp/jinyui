<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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

	include "./func/css.php";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		include "./conf/sales.php";	// Sales 사용자 DB 접근.


		$mode = _formmode();		//echo "mode is $mode <br>";
		$uid = _formdata("uid");	//echo "uid is $uid <br>";
		

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
		$url = "/site_index_goods.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";	

    		

	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
	function _index_goods_delete($uid){
		$query = "DELETE FROM `site_index_goods` WHERE `Id`='$uid'";
			// echo $query."<br>";
		_sales_query($query);

		echo "사이트 정보 삭제";
	}


?>