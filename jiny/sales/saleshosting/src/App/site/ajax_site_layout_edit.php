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

	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"ajax_site_layout_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#data')[0]);
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
	
	// form 칼라 픽업 
	$javascript .= "<script src=\"../js/jscolor.js\"></script>\n";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		/////////////
		$body = $javascript._theme_page($site_env->theme,"site_layout_edit",$site_language,$site_mobile);


		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");
		
		// echo "category = $category <br>";
		$body=str_replace("{formstart}","<form id='data' name='sales' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>									    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

			
			
			
		$query = "select * from `site_env` where Id = '$uid'"; // echo $query."<br>";
    	if($layout_rows= _sales_query_rows($query)){
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
		} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			
		}

		
		if(isset($layout_rows->enable)) $body = str_replace("{enable}",_form_check_enable($layout_rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{code}",_form_text("code",$layout_rows->code,$css_textbox),$body);
		// $body = str_replace("{domain}",_form_text("domain",$layout_rows->domain,$css_textbox),$body);
		$body = str_replace("{domain}",$layout_rows->domain,$body);
			
		// $body = str_replace("{html}","<textarea name='html' rows='20' style='$css_textarea'>".stripslashes($layout_rows->html)."</textarea>",$body);
			
		//$body = str_replace("{align}",_form_text("align",$layout_rows->align,$css_textbox),$body);
		$body = str_replace("{width}",_form_text("width",$layout_rows->width,$css_textbox),$body);
		//$body = str_replace("{bgcolor}",_form_text("bgcolor",$layout_rows->bgcolor,$css_textbox),$body);
		$body = str_replace("{top_margin}",_form_text("top_margin",$layout_rows->top_margin,$css_textbox),$body);
		$body = str_replace("{left_margin}",_form_text("left_margin",$layout_rows->left_margin,$css_textbox),$body);

		$form_align = "<select name='align' id=\"align\" style=\"$css_textbox\">";
		if($layout_rows->align == "center") $form_align .= "<option value='center' selected>Center</option>"; else $form_align .= "<option value='center'>Center</option>";
		if($layout_rows->align == "left") $form_align .= "<option value='left' selected>Left</option>"; else $form_align .= "<option value='left'>Left</option>";
		if($layout_rows->align == "right") $form_align .= "<option value='right' selected>Right</option>"; else $form_align .= "<option value='right'>Right</option>";
		$form_align .= "</select>";
		$body = str_replace("{align}", $form_align,$body);

		// $body = str_replace("{align}",_form_text("align",$layout_rows->align,$css_textbox),$body);
		
		if($layout_rows->bgcolor) $bgcolor =$layout_rows->bgcolor; else $bgcolor = "ffffff";
		$body = str_replace("{bgcolor}","<input type='color' name='bgcolor' value='$bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);
	

		echo $body;

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	
?>