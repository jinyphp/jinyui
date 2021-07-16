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

		function setup(mode){
			var url = \"ajax_seller_setup.php\";
			var form = document.resale;
			// form.action = url;  //이동할 페이지
  			form.mode.value = mode;			
			ajax_html('#mainbody',url);
		}
	</script>";

	// ================	

	if(isset($_COOKIE['cookie_email'])){

		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		include ($_SERVER['DOCUMENT_ROOT']."/sales/sales_function.php");	
		
		$body = $javascript._theme_page($site_env->theme,"scm_seller_shop_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);	

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}


		$mode = _formdata("mode");
		// echo "mode = $mode <br>";

	
		$query1 = "select * from scm_shop where Id = '$uid'";
		if($scm_rows = _sales_query_rows($query1)){

			$query1 = "select * from seller where email = '".$scm_rows->shop_email."' and business = '".$scm_rows->shop_business."' ";
			if($rows = _sales_query_rows($query1)){

				$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
				$body=str_replace("{formstart}","<form id='data' name='resale' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    		<input type='hidden' name='mode' id=\"mode\">",$body);
				$body = str_replace("{formend}","</form>",$body);

		
				$body = str_replace("{logo}",$rows->logo,$body);
				$body = str_replace("{comission}",$rows->comission,$body);
				$body = str_replace("{description}",$rows->description,$body);

				$body = str_replace("{email}",$email,$body);
				$body = str_replace("{name}",$rows->name,$body);
				$body = str_replace("{domain}",$rows->domain,$body);

				$body = str_replace("{phone}",$rows->phone,$body);
				$body = str_replace("{fax}",$rows->fax,$body);

				$body = str_replace("{address_send}",$rows->address_send,$body);
				$body = str_replace("{address_return}",$rows->address_return,$body);	

				// $button ="<input type='button' value='설정' onclick=\"javascript:setup('setup')\" style=\"".$css_btn_gray."\" >";          
				$body = str_replace("{form_submit}",$button,$body);

				echo $body;

			}
		}	
	

		
		
	
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

		


?>