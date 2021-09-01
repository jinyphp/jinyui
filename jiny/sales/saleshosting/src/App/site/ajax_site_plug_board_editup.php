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
		$list_num = _formdata("list_num");

		if($mode=="edit"){

			$query = "select * from `site_plug_board` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){
				
				$query = new query;
				$query->table_name = "site_plug_board";
				$query->where = " Id ='$uid'";

				$query->update("enable",_formdata("enable"));
				$query->update("code",_formdata("code"));
				$query->update("board",_formdata("board"));
				
				$query->update("pc_cols",_formdata("pc_cols"));
				$query->update("pc_rows",_formdata("pc_rows"));
				$query->update("pc_maxstr",_formdata("pc_maxstr"));
				$query->update("pc_listnum",_formdata("pc_listnum"));
				$query->update("pc_label",_formdata("pc_label"));

				$query->update("mobile_cols",_formdata("mobile_cols"));
				$query->update("mobile_rows",_formdata("mobile_rows"));
				$query->update("mobile_maxstr",_formdata("mobile_maxstr"));
				$query->update("mobile_listnum",_formdata("mobile_listnum"));
				$query->update("mobile_label",_formdata("mobile_label"));

				$_query = $query->update_query();
				_sales_query($_query);

			}

			// 페이지 이동 
			$url = "site_plug_board.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";	



		} else if($mode=="new"){

			$query = new query;
			$query->table_name = "site_plug_board";

			$query->insert("regdate",$TODAYTIME);
			$query->insert("enable",_formdata("enable"));
			$query->insert("code",_formdata("code"));
			$query->insert("board",_formdata("board"));

			$query->insert("pc_cols",_formdata("pc_cols"));
			$query->insert("pc_rows",_formdata("pc_rows"));
			$query->insert("pc_maxstr",_formdata("pc_maxstr"));
			$query->insert("pc_listnum",_formdata("pc_listnum"));
			$query->insert("pc_label",_formdata("pc_label"));

			$query->insert("mobile_cols",_formdata("mobile_cols"));
			$query->insert("mobile_rows",_formdata("mobile_rows"));
			$query->insert("mobile_maxstr",_formdata("mobile_maxstr"));
			$query->insert("mobile_listnum",_formdata("mobile_listnum"));
			$query->insert("mobile_label",_formdata("mobile_label"));
							
			$_query = $query->insert_query();
			_sales_query($_query);
			echo $_query;

			// 페이지 이동 
			$url = "site_plug_board.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			// echo "<script> url_replace(\"$url\") </script>";


		} else if($mode == "delete"){
			$query = "DELETE FROM `site_plug_board` WHERE `Id`='$uid'";
			_sales_query($query);
			// echo "사이트 정보 삭제";

			// 페이지 이동 
			$url = "site_plug_board.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
		}    		

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>