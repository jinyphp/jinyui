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

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");

	$javascript = "<script>

		function form_submit(mode,uid){
			var url = \"ajax_b2b_goods_editup.php\";
			var form = document.sales;
			form.mode.value = mode;
  			form.uid.value = uid;

			ajax_html('#mainbody',url);
		}

	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	// echo $ajaxkey."<br>";
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		include ($_SERVER['DOCUMENT_ROOT']."/sales/sales_function.php");	
		
		$body = $javascript._theme_page($site_env->theme,"scm_b2b_goods_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);

		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];
		}


		$body=str_replace("{formstart}","<form id='data' name='sales' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='mode'>
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>		    				
										<input type='hidden' name='uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$uid = _formdata("uid");

		$query = "select * from service.b2b_goods WHERE `Id`='$uid'";
		if($rows = _mysqli_query_rows($query)){	
		

			$body = str_replace("{goodname}",$rows->name,$body);

			$body = str_replace("{sell_prices}",$rows->sell_prices,$body);
			
			


			if($email == $rows->email){
				// 본인 등록 상품일 경우 수정가능
				$form_submit = "<input type='button' value='수정' onclick=\"javascript:form_submit('edit','".$uid."')\" style=\"".$css_btn_gray."\" > ";
				$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";

				if($rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
				else $body = str_replace("{enable}",_form_check_enable(""),$body);

				
				$body = str_replace("{b2b_margin}","<input type='text' name='b2b_margin'  value='".$rows->b2b_margin."' style=\"$css_textbox\">",$body);
				$body = str_replace("{b2b_prices}","<input type='text' name='prices_b2b'  value='".$rows->prices_b2b."' style=\"$css_textbox\">",$body);

				$body = str_replace("{b2b_comment}",_form_textarea("b2b_comment",$rows->b2b_comment,"20",$css_textarea),$body);
			} else {
				$form_submit = "";

				$body = str_replace("{enable}",$rows->enable,$body);
				$body = str_replace("{b2b_margin}",$rows->b2b_margin,$body);
				$body = str_replace("{b2b_prices}",$rows->prices_b2b,$body);

				$body = str_replace("{b2b_comment}",$rows->b2b_comment,$body);
			}

			$body = str_replace("{form_submit}",$form_submit,$body);


		}		

		echo $body;

	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

		


?>