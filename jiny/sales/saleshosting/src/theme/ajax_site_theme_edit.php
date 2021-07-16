<?php

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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

	// 환경설정 
	//include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	$javascript = "<script>

		function form_submit(mode,uid){
			var url = \"ajax_site_theme_editup.php?uid=\"+uid+\"&mode=\"+mode;
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


	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 테마관련 함수들
		include "theme_function.php";

		/////////////
		// $body = $javascript._skin_page($skin_name,"site_theme_edit");
		$body = $javascript._theme_page($site_env->theme,"site_theme_edit",$site_language,$site_mobile);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$theme = _formdata("theme");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		

		$body=str_replace("{formstart}","<form id='data' name='theme' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='theme' value='$theme'>
					    				<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		if($rows = _site_theme_rows($uid)){
			$form_submit = "<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"css_btn_edit\" > ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" id=\"css_btn_delete\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);

		} else {
			$form_submit = "<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"css_btn_edit\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);			
		}			
		   

		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{theme}",_form_text("theme",$rows->theme,$css_textbox),$body);
		$body = str_replace("{title}",_form_text("title",$rows->title,$css_textbox),$body);

		$body = str_replace("{width}",_form_text("width",$rows->width,$css_textbox),$body);
		$body = str_replace("{align}",_form_text("align",$rows->align,$css_textbox),$body);
		$body = str_replace("{bgcolor}",_form_text("bgcolor",$rows->bgcolor,$css_textbox),$body);

		$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->description)."</textarea>",$body);

		$body = str_replace("{upload}","<input type='file' name='userfile' id=\"input_upload\">",$body);		
	

		//# 테마 header
		$form_header = "<select name='header' id=\"header\" style=\"$css_textbox\" >";
		$query = "select * from site_header where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->header == $rows1->header) $form_header .= "<option value='".$rows1->Id."' selected>".$rows1->title."</option>"; 
				else $form_header .= "<option value='".$rows1->Id."'>".$rows1->title."</option>";
			}
		}
		$form_header .= "</select>";
		$body = str_replace("{header}",$form_header,$body);

		//# 테마 footer
		$form_footer = "<select name='footer' id=\"footer\" style=\"$css_textbox\" >";
		$query = "select * from site_footer where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->footer == $rows1->footer) $form_footer .= "<option value='".$rows1->Id."' selected>".$rows1->title."</option>"; 
				else $form_footer .= "<option value='".$rows1->Id."'>".$rows1->title."</option>";
			}
		}
		$form_footer .= "</select>";
		$body = str_replace("{footer}",$form_footer,$body);


		$form_menucode = "<select name='menu_code' style=\"$css_textbox\" >";
		$form_menucode_login = "<select name='menu_code_login' style=\"$css_textbox\" >";
		$query1 = "select * from site_menu_setting";
		if($rowss1 = _sales_query_rowss($query1)){	
			for($i=0;$i<count($rowss1);$i++){
				$rows1 = $rowss1[$i];

				if($rows->menu_code == $rows1->code) $form_menucode .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>"; 
				else $form_menucode .= "<option value='".$rows1->code."'>".$rows1->code."</option>";

				if($rows->menu_code_login == $rows1->code) $form_menucode_login .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>"; 
				else $form_menucode_login .= "<option value='".$rows1->code."'>".$rows1->code."</option>";
			}
		} else {
			$form_menucode .= "<option value='default'>기본메뉴</option>";
			$form_menucode_login .= "<option value='default'>기본메뉴</option>";
		}
		$form_menucode .= "</select>";
		$form_menucode_login .= "</select>";

		$body = str_replace("{menu_code}",$form_menucode,$body);
		$body = str_replace("{menu_code_login}",$form_menucode_login,$body);


		//# 테마 index
		$form_index = "<select name='index' id=\"index\" style=\"$css_textbox\" >";
		$query = "select * from site_index where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->index == $rows1->code) $form_index .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>"; 
				else $form_index .= "<option value='".$rows1->code."'>".$rows1->code."</option>";
			}
		}
		$form_index .= "</select>";
		$body = str_replace("{index}",$form_index,$body);


		echo $body;


	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}


	
?>