<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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

	include "./func/error.php";
	
	include "./func/css.php";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./conf/sales.php";

		// 지정된 상품 하나를 읽어옴
		function _site_themefiles_rows($uid){
			$query = "select * from `site_themefiles` WHERE `Id`='$uid'";
			//echo $query;
			if($rows = _sales_query_rows($query)){	
				return $rows;
			}	
		}

		$javascript = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_site_themefiles_editup.php?uid=\"+uid+\"&mode=\"+mode;
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
					var url = \"/ajax_site_themefiles_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);

                        }
                    });
				}
				</script>";

		/////////////
		// $skin_name = "default";
		// $body = $javascript._skin_page($skin_name,"site_themefiles_edit");
		$body = $javascript._theme_page($site_env->theme,"site_themefiles_edit",$site_language,$site_mobile);

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
	
		$theme = _formdata("theme");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		// echo $mode;
		
		// echo "limit = ".$limit;

		$body=str_replace("{formstart}","<form id='data' name='theme' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='theme' value='$theme'>
					    				<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
			
			
			
			
		if($theme = _site_themefiles_rows($uid)){
				$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
		} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
				$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			
		}

		
		   
		$css = "cssFormStyle";
		// 상품판매 여부 체크 
		if(isset($theme->enable)) $body = str_replace("{enable}",_form_check_enable($theme->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{filename}",_form_text("filename",$theme->filename,$css_textbox),$body);
		$body = str_replace("{comment}",_form_text("comment",$theme->comment,$css_textbox),$body);

		if(isset($theme->header)) $body = str_replace("{header}",_form_checkbox("header",$theme->header),$body);
		else $body = str_replace("{header}",_form_checkbox("header","on"),$body);

		if(isset($theme->footer)) $body = str_replace("{footer}",_form_checkbox("footer",$theme->footer),$body);
		else $body = str_replace("{footer}",_form_checkbox("footer","on"),$body);

		if(isset($theme->menu)) $body = str_replace("{menu}",_form_checkbox("menu",$theme->menu),$body);
		else $body = str_replace("{menu}",_form_checkbox("menu","on"),$body);
			

		$body = str_replace("{width}",_form_text("width",$theme->width,$css_textbox),$body);
		$body = str_replace("{align}",_form_text("align",$theme->align,$css_textbox),$body);
		$body = str_replace("{bgcolor}",_form_text("bgcolor",$theme->bgcolor,$css_textbox),$body);



			function _themefiles_html($uid,$lang,$mobile){
				if($uid>0){
					$query = "select * from `site_themefiles_html` WHERE `pid`='$uid' and `language`='$lang' and `mobile`='$mobile'";
					if($rows = _sales_query_rows($query)){	
						return $rows;
					}
				}
		
			}

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
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>