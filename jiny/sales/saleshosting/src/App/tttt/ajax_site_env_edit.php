<?
	//*  OpenShopping V2.1
	//*  programing by hojin lee
	//*  2016.01.11 
	//*

	//* 사이트 환경 설정 및 도메인
	//* 복수의 도메인으로 사이트를 운영할 수 있음

	// update : 2016.01.11 = 코드정리 

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
	
	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"/ajax_site_env_editup.php?mode=\"+mode+\"&uid=\"+uid;
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
		include "./sales.php";

    	$mode = _formmode();
		$uid = _formdata("uid");
		$body = $javascript._skin_page($skin_name,"site_env_edit");
		$body=str_replace("{formstart}",$script."<form id='data' name='env' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);


		//////////////////
		if($uid){
			$query = "select * from `site_env` where Id =$uid";
			$rows = _sales_query_rows($query);
			//echo "수정모드";
		} else {
			//echo "신규입력";
			$rows = NULL;
		}

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



		

		echo $body;

		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$msg_string = _string($msg,$site_language);
		$body = str_replace("<!--{error_message}-->",$msg_string,$body);
		echo $body;	
	}

	
?>