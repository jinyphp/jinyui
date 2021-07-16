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
	// include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");


	$javascript = "<script>

		function form_submit(mode,uid){
			var url = \"ajax_site_themefiles_editup.php?uid=\"+uid+\"&mode=\"+mode;
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

		function form_delete(mode,uid){
			var url = \"ajax_site_themefiles_editup.php?uid=\"+uid+\"&mode=\"+mode;					
			ajax_html('#mainbody',url);
		}
	</script>";

	// form 칼라 픽업 
	$javascript .= "<script src=\"../js/jscolor.js\"></script>\n";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 테마관련 함수들
		include "theme_function.php";

		

		/////////////
		$body = $javascript._theme_page($site_env->theme,"site_themefiles_edit",$site_language,$site_mobile);

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
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
			
			
		if($themefiles_rows = _site_themefiles_rows($uid)){
			$form_submit = "<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			
			$body = str_replace("{form_submit}",$form_submit,$body);
		} else {
			$form_submit = "<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);
			
		}

	
		   
		$css = "cssFormStyle";
		// 상품판매 여부 체크 
		if(isset($themefiles_rows->enable)) $body = str_replace("{enable}",_form_check_enable($themefiles_rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{filename}",_form_text("filename",$themefiles_rows->filename,$css_textbox),$body);
		$body = str_replace("{comment}",_form_text("comment",$themefiles_rows->comment,$css_textbox),$body);

		if(isset($themefiles_rows->header)) $body = str_replace("{header}",_form_checkbox("header",$themefiles_rows->header),$body);
		else $body = str_replace("{header}",_form_checkbox("header","on"),$body);

		if(isset($themefiles_rows->footer)) $body = str_replace("{footer}",_form_checkbox("footer",$themefiles_rows->footer),$body);
		else $body = str_replace("{footer}",_form_checkbox("footer","on"),$body);

		
			

		

		if($themefiles_rows->bgcolor) $bgcolor =$themefiles_rows->bgcolor; else $bgcolor = "ffffff";
		$body = str_replace("{bgcolor}","<input type='color' name='bgcolor' value='$bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		// ++ 서브메뉴 출력설정
		if(isset($themefiles_rows->sub_menu)) $body = str_replace("{sub_menu}",_form_checkbox("sub_menu",$themefiles_rows->sub_menu),$body);
		else $body = str_replace("{sub_menu}",_form_checkbox("sub_menu","on"),$body);

		$body = str_replace("{sub_width}",_form_text("sub_width",$themefiles_rows->sub_width,$css_textbox),$body);

		$form_align = "<select name='sub_align' id=\"align\" style=\"$css_textbox\">";
		// if($pages->align == "center") $form_align .= "<option value='center' selected>Center</option>"; else $form_align .= "<option value='center'>Center</option>";
		if($themefiles_rows->sub_align == "left") $form_align .= "<option value='left' selected>Left</option>"; else $form_align .= "<option value='left'>Left</option>";
		if($themefiles_rows->sub_align == "right") $form_align .= "<option value='right' selected>Right</option>"; else $form_align .= "<option value='right'>Right</option>";
		$form_align .= "</select>";
		$body = str_replace("{sub_align}", $form_align,$body);


	
			
		//#언어별 상품명, 상품설명
		$query1 = "select * from `site_language` ";	
		if($rowss1 = _sales_query_rowss($query1)){
					
			$products_language = "";
			$products_forms = "";
			for($i=0;$i<count($rowss1);$i++){
				$rows1=$rowss1[$i];

				if($rows1->code == $site_language){
					$products_language .= "<input id='tab-$i' type='radio' name='page_language' value='".$rows1->code."' checked=\"checked\">";
				} else {
					$products_language .= "<input id='tab-$i' type='radio' name='page_language' value='".$rows1->code."'>";
				}
									
				$products_language .= "<label for='tab-$i'>".$rows1->code."</label>";
									
				$code = $rows1->code;	
				$desktop = _themefiles_html($uid,$code,"pc");
				$desktop_html = stripslashes($desktop->html);

				$mobile = _themefiles_html($uid,$code,"m");
				$mobile_html = stripslashes($mobile->html);
									
							
				$products_forms .="<div class='tab-$i_content'>
													   
										<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
										<tr>
											<td width='110' align='right' valign='top'>HTML PC</td>
											<td>"._form_textarea($rows1->code,$desktop_html,"20",$css_textarea)."</td>
										</tr>
										<tr>
											<td width='110' align='right' valign='top'>HTML MOBILE</td>
											<td>"._form_textarea($rows1->code."_m",$mobile_html,"20",$css_textarea)."</td>
										</tr>
										</table>
													   
									</div>";									 
									
			}
								
			$body = str_replace("{language_html}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
								
		}
		
	
		echo $body;


	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");		
	}


	
?>