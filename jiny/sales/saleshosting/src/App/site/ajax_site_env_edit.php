<?
	//*  OpenShopping V2.1
	//*  programing by hojin lee
	//*  2016.01.11 
	//*

	//* 사이트 환경 설정 및 도메인
	//* 복수의 도메인으로 사이트를 운영할 수 있음

	// update : 2016.01.11 = 코드정리 

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
	
	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"ajax_site_env_editup.php?mode=\"+mode+\"&uid=\"+uid;
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

	// form 칼라 픽업 
	$javascript .= "<script src=\"../js/jscolor.js\"></script>\n";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"site_env_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,185),$body);

    	$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");




		$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>									    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		


		//////////////////
		$query = "select * from `site_env` where Id =$uid";
		if($rows = _sales_query_rows($query)){
			//echo "수정모드";
			$form_submit = "<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);


		} else {
			//echo "신규입력";
			$rows = NULL;

			$form_submit = "<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			// $form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);


		}

		$body = str_replace("{index_pages}",_form_text("index_pages",$rows->index_pages,$css_textbox),$body);
		$body = str_replace("{header_pages}",_form_text("header_pages",$rows->header_pages,$css_textbox),$body);
		$body = str_replace("{footer_pages}",_form_text("footer_pages",$rows->footer_pages,$css_textbox),$body);

		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		if(isset($rows->code)) $code = $rows->code; else $code ="";
		$body = str_replace("{code}",_form_text("code",$code,$css_textbox),$body);


		//# 테마 
		$form_theme = "<select name='theme' id=\"theme\" style=\"$css_textbox\" >";
		$query = "select * from site_theme where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->theme == $rows1->theme) $form_theme .= "<option value='".$rows1->theme."' selected>".$rows1->theme."</option>"; 
				else $form_theme .= "<option value='".$rows1->theme."'>".$rows1->theme."</option>";
			}
		}
		$form_theme .= "</select>";
		$body = str_replace("{theme}",$form_theme,$body);



		if(isset($rows->afterlogin)) $afterlogin = $rows->afterlogin; else $afterlogin ="";
		$body = str_replace("{afterlogin}",_form_text("afterlogin",$afterlogin,$css_textbox),$body);

		if($rows->dome){
			$body = str_replace("{shop_type_dome}","<input type='radio' name='dome' value='on' checked>",$body);
			$body = str_replace("{shop_type_sell}","<input type='radio' name='dome' value=''>",$body);
		} else {
			$body = str_replace("{shop_type_dome}","<input type='radio' name='dome' value='on'>",$body);
			$body = str_replace("{shop_type_sell}","<input type='radio' name='dome' value='' checked>",$body);
		}

		if(isset($rows->process)) $process = $rows->process; else $process ="";
		$body = str_replace("{process}",_form_text("process",$process,$css_textbox),$body);

		if(isset($rows->logo)) $logo = $rows->logo; else $logo ="";
		$body = str_replace("{logofile}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{logofile_name}",$logo,$body);

		if(isset($rows->type)) $type = $rows->type; else $type ="";
		$body = str_replace("{type}",_form_text("type",$type,$css_textbox),$body);

		if(isset($rows->domain)) $domain = $rows->domain; else $domain ="";
		$body = str_replace("{domain}",_form_text("domain",$domain,$css_textbox),$body);


		if(isset($rows->language)) $language = $rows->language; else $language ="ko";
		$body = str_replace("{language}",_form_text("language1",$language,$css_textbox),$body);

		if(isset($rows->country)) $country = $rows->country; else $country ="kr";
		$body = str_replace("{country}",_form_text("country1",$country,$css_textbox),$body);
		
		$body = str_replace("{adult_check}",_form_checkbox("adult_check",$rows->adult_check),$body);
		
		$body = str_replace("{members_prices}",_form_checkbox("members_prices",$rows->members_prices),$body);
		
		$body = str_replace("{members_auth}",_form_checkbox("members_auth",$rows->members_auth),$body);

		if(isset($rows->members_point)) $members_point = $rows->members_point; else $members_point ="";
		$body = str_replace("{members_point}",_form_text("members_point",$members_point,$css_textbox),$body);

		if(isset($rows->members_emoney)) $members_emoney = $rows->members_emoney; else $members_emoney ="";
		$body = str_replace("{members_emoney}",_form_text("members_emoney",$members_emoney,$css_textbox),$body);

		if(isset($rows->layout)) $layout = $rows->layout; else $layout ="";
		$body = str_replace("{layout}",_form_text("layout",$layout,$css_textbox),$body);

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


		//#언어별 상품명, 상품설명
			$query1 = "select * from `site_language` ";	
			if($rowss1 = _sales_query_rowss($query1)){

				$seo_title = json_decode( stripslashes( $rows->seo_title));
				$seo_keyword = json_decode( stripslashes( $rows->seo_keyword));
				$seo_description = json_decode( stripslashes( $rows->seo_description));
					
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
					$products_forms .="<div class='tab-$i_content'>
						<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>SEO 타이틀:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("seo_title_".$rows1->code,$seo_title->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>SEO 키워드:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("seo_keyword_".$rows1->code,$seo_keyword->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>SEO 설명:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("seo_description_".$rows1->code,$seo_description->$code,"2",$css_textarea)."</td>
						</tr>
						</table>										   
						</div>";

									
				}
								
				$body = str_replace("{seo_language}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
			}	

		

		if($rows->width) $layout_width = $rows->width; else $layout_width = "1000px";
		$body = str_replace("{width}",_form_text("width",$layout_width,$css_textbox),$body);

		if($rows->topMargin) $layout_topMargin = $rows->topMargin; else $layout_topMargin = "0";
		$body = str_replace("{top_margin}",_form_text("top_margin",$layout_topMargin,$css_textbox),$body);

		if($rows->leftMargin) $layout_leftMargin = $rows->leftMargin; else $layout_leftMargin = "0";
		$body = str_replace("{left_margin}",_form_text("left_margin",$layout_leftMargin,$css_textbox),$body);

		if($rows->align) $layout_align = $rows->align; else $layout_align = "center";
		$form_align = "<select name='align' id=\"align\" style=\"$css_textbox\">";
		if($layout_align == "center") $form_align .= "<option value='center' selected>Center</option>"; else $form_align .= "<option value='center'>Center</option>";
		if($layout_align == "left") $form_align .= "<option value='left' selected>Left</option>"; else $form_align .= "<option value='left'>Left</option>";
		if($layout_align == "right") $form_align .= "<option value='right' selected>Right</option>"; else $form_align .= "<option value='right'>Right</option>";
		$form_align .= "</select>";
		$body = str_replace("{align}", $form_align,$body);

		// $body = str_replace("{align}",_form_text("align",$rows->align,$css_textbox),$body);
		
		if($rows->bgcolor) $bgcolor =$rows->bgcolor; else $bgcolor = "ffffff";
		$body = str_replace("{bgcolor}","<input type='color' name='bgcolor' value='$bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		

		echo $body;

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>