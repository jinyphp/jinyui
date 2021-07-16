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
			var url = \"ajax_seller_setup_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#data')[0]);

			alert(url);

			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#mainbody').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});		
		}

		function youtube_manual(code){
			var url = \"manual_youtube.php?code=\"+code;
			popup_ajax(url);				
		}
	</script>";

	// ================	

	if(isset($_COOKIE['cookie_email'])){

		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// include ($_SERVER['DOCUMENT_ROOT']."/sales/sales_function.php");	
		
		$body = $javascript._theme_page($site_env->theme,"scm_seller_setup_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);

		// 로그인 회원정보 읽어오기
		/*
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}
		*/


		$mode = _formdata("mode");
		// echo "mode = $mode <br>";
		$uid = _formdata("uid");
		/*
		if($mode == "setup"){

			$business = _formdata("business");
			$business_rows = _sales_businessRows_Id($business);

			

		}
		*/


		$query = "select * from sales_business where Id = '$uid'";
		//echo $query;

		if($rows = _sales_query_rows($query)){

			$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
			$body=str_replace("{formstart}","<form id='data' name='resale' method='post' enctype='multipart/form-data' > 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$body = str_replace("{scm}",_form_checkbox("scm",$rows->scm),$body);
			$body = str_replace("{logo}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{comission}",_form_text("comission",$rows->scm_comission,$css_textbox),$body);
			$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->scm_description)."</textarea>",$body);

			$body = str_replace("{business}", $rows->business ,$body);

			// 공급자 정보
			$body = str_replace("{seller}",_form_text("seller",$rows->seller,$css_textbox),$body);
			$body = str_replace("{email}",$email,$body);
			$body = str_replace("{name}",_form_text("name",$rows->business,$css_textbox),$body);
			$body = str_replace("{domain}",_form_text("domain",$rows->domain,$css_textbox),$body);

			$body = str_replace("{phone}",_form_text("phone",$rows->phone,$css_textbox),$body);
			$body = str_replace("{fax}",_form_text("fax",$rows->fax,$css_textbox),$body);

			$body = str_replace("{address_send}",_form_text("address_send",$rows->scm_address_send,$css_textbox),$body);
			$body = str_replace("{address_return}",_form_text("address_return",$rows->scm_address_return,$css_textbox),$body);	


			$form_submit  = "<input type='button' value='설정' onclick=\"javascript:form_submit('scm','".$uid."')\" style=\"".$css_btn_gray."\" >";
    		$body = str_replace("{form_submit}",$form_submit,$body);


			echo $body;

		} else {
			echo "SCM 사업자 정보가 없습니다.";
		}
	

		
		
	
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

		


?>