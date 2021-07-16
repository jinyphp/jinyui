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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	
	function _cate_tabbar($title,$site_language){
		global $css_textarea;
		//#언어별 메뉴명 설정
		$query = "select * from `site_language` ";	
		if($rowss = _sales_query_rowss($query)){
			$skin_language = "";
			$skin_forms = "";
			for($i=0,$j=1;$i<count($rowss);$i++,$j++){
				$rows= $rowss[$i];
				$code = $rows->code;

				//탭라벨 이름표기
				if($site_language == $rows->code){
					$skin_language .= "<input id='tab-".$i."' type='radio' name='skin_language' value='".$rows->code."' checked=\"checked\">";
				} else {								
					$skin_language .= "<input id='tab-".$i."' type='radio' name='skin_language' value='".$rows->code."'>";
				}

				$skin_language .= "<label for='tab-".$i."'>".$code."</label>";
						
				if(isset($title->$code)) $lang_text = $title->$code; else $lang_text = "";
				$skin_forms .="<div class='tab-$j"."_content'>				   
										<table border='0' width='100%' cellspacing='2' cellpadding='2'  bgcolor='#FAFAFA'>			
											<tr>
											<td><textarea name='".$code."' rows='5' style='$css_textarea'>".$lang_text."</textarea></td>
											</tr>
										</table>
										</div>";
			}
								
			$tabbar = "<div id='css_tabs'> $skin_language $skin_forms </div>";
		}	

		return $tabbar;
	}

	function _cate_type_select($name,$select){
		global $css_textbox;
		$cate_type = "<select name='$name' style=\"$css_textbox\">";
		if($select == "tile1") $cate_type .= "<option value='tile1' selected>세로형 타일방식</option>"; else $cate_type .= "<option value='tile1'>세로형 타일방식</option>";
		if($select == "tile2") $cate_type .= "<option value='tile2' selected>가로형 타일방식</option>"; else $cate_type .= "<option value='tile2'>가로형 타일방식</option>";
		if($select == "list") $cate_type .= "<option value='list' selected>리스트방식</option>"; else $cate_type .= "<option value='list'>리스트방식</option>";
		$cate_type .= "</select>";
		return $cate_type;
	}


	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"ajax_shop_cate_editup.php?uid=\"+uid+\"&mode=\"+mode;
				
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
		}

		function form_delete(mode,uid){
			var url = \"ajax_shop_cate_editup.php?uid=\"+uid+\"&mode=\"+mode;					
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


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// $body = $css_tabbar.$javascript._skin_page($skin_name,"site_menu_edit");
		$body = $css_tabbar.$javascript._theme_page($site_env->theme,"shop_cate_edit",$site_language,$site_mobile);

		// $body = _skin_page($skin_name,"shop_cate_edit");		
		// $ajaxkey = _formdata("ajaxkey");		

		$mode = _formmode();
		$uid = _formdata("uid");

		$body=str_replace("{formstart}","<form name='cate' method='post' enctype='multipart/form-data' > 
					    		<input type='hidden' name='uid' value='$uid'>
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$body = str_replace("{form_submit}","
				
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

		if($mode == "new"){
			$body = str_replace("{formmode}","신규등록",$body);

			$body = str_replace("{category_name}", _cate_tabbar("",$site_language),$body);
			$body = str_replace("{enable}", _form_checkbox("enable","on"),$body);
			$body = str_replace("{url}","<input type='text' name='url' style=\"$css_textbox\" >",$body);
			$body = str_replace("{alt}","<input type='text' name='alt' style=\"$css_textbox\" >",$body);

			$body = str_replace("{check_members}", _form_checkbox("check_members",""),$body);
			$body = str_replace("{check_goodname}", _form_checkbox("check_goodname","on"),$body);
			$body = str_replace("{check_images}", _form_checkbox("check_images","on"),$body);
			$body = str_replace("{check_subtitle}", _form_checkbox("check_subtitle","on"),$body);
			$body = str_replace("{check_spec}", _form_checkbox("check_spec","on"),$body);
			$body = str_replace("{check_prices}", _form_checkbox("check_prices","on"),$body);
			$body = str_replace("{check_usd}", _form_checkbox("check_usd",""),$body);
			$body = str_replace("{check_memprices}", _form_checkbox("check_memprices",""),$body);

			// 정렬 상식
			$sort = $category->sort;
			$form_sort = "<select name='sort' id=\"sort\" style=\"$css_textbox\">";
			if($sort == "regdate") $form_sort .= "<option value='regdate' selected>등록순</option>"; else $form_sort .= "<option value='regdate'>등록순</option>";
			if($sort == "pos") $form_sort .= "<option value='pos' selected>사용자지정</option>"; else $form_sort .= "<option value='pos'>사용자지정</option>";
			if($sort == "orders") $form_sort .= "<option value='orders' selected>주문건수</option>"; else $form_sort .= "<option value='orders'>주문건수</option>";
			if($sort == "click") $form_sort .= "<option value='click' selected>조회순</option>"; else $form_sort .= "<option value='click'>조회순</option>";
			$form_sort .= "</select>";
			$body = str_replace("{orderby}", $form_sort,$body);

			

			// PC접속형태 설정 
			$body = str_replace("{cate_type}",_cate_type_select("cate_type","tile2"),$body);
			$body = str_replace("{cate_cols}", _form_text("cate_cols","5",$css_textbox),$body);
			$body = str_replace("{cate_rows}", _form_text("cate_rows","5",$css_textbox),$body);
			$body = str_replace("{cate_imgsize}", _form_text("cate_imgsize","5",$css_textbox),$body);

			// 모바일 접혹형태 설정
			$body = str_replace("{mobile_type}",_cate_type_select("mobile_type","tile2"),$body);
			$body = str_replace("{mobile_cols}", _form_text("mobile_cols","2",$css_textbox),$body);
			$body = str_replace("{mobile_rows}", _form_text("mobile_rows","5",$css_textbox),$body);
			$body = str_replace("{mobile_imgsize}", _form_text("mobile_imgsize","5",$css_textbox),$body);

			$body = str_replace("{cate_title}",_form_file("userfile1",$css),$body);

			$body = str_replace("{apply_html}", _form_checkbox("apply_html",""),$body);
			$body = str_replace("{html}","<textarea name='html' rows='20' style='$css_textarea'></textarea>",$body);

			$body = str_replace("{cell_bgcolor}", _form_text("cell_bgcolor","",$css_textbox),$body);
			$body = str_replace("{cell_outline_width}", _form_text("cell_outline_width","",$css_textbox),$body);
			$body = str_replace("{cell_outline_color}", _form_text("cell_outline_color","",$css_textbox),$body);
			$body = str_replace("{cell_outline_hovercolor}", _form_text("cell_outline_hovercolor","",$css_textbox),$body);
			$body = str_replace("{discount_color}", _form_text("cell_discount_color","",$css_textbox),$body);
			$body = str_replace("{discount_bgcolor}", _form_text("cell_discount_bgcolor","",$css_textbox),$body);			
			$body = str_replace("{freeshipping_color}", _form_text("cell_freeshipping_color","",$css_textbox),$body);
			$body = str_replace("{freeshipping_bgcolor}", _form_text("cell_freeshipping_bgcolor","",$css_textbox),$body);


		} else if($mode == "edit"){
			$body = str_replace("{formmode}","수정",$body);

			$query = "select * from shop_search where Id='$uid'";	
			//echo "$query <br>";
			if($category = _sales_query_rows($query)){
				//echo $category->title;
				$title = stripslashes($category->title);
				$title = json_decode($title);
			}

			$body = str_replace("{category_name}", _cate_tabbar($title,$site_language),$body);
			
			if($category->enable)
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
			else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);

			$body = str_replace("{url}","<input type='text' name='url' value='".$category->url."' style=\"$css_textbox\" >",$body);
			$body = str_replace("{alt}","<input type='text' name='alt' value='".$category->alt."' style=\"$css_textbox\" >",$body);

			$body = str_replace("{check_members}", _form_checkbox("check_members",$category->check_members),$body);
			$body = str_replace("{check_goodname}", _form_checkbox("check_goodname",$category->check_goodname),$body);
			$body = str_replace("{check_images}", _form_checkbox("check_images",$category->check_images),$body);
			$body = str_replace("{check_subtitle}", _form_checkbox("check_subtitle",$category->check_subtitle),$body);
			$body = str_replace("{check_spec}", _form_checkbox("check_spec",$category->check_spec),$body);
			$body = str_replace("{check_prices}", _form_checkbox("check_prices",$category->check_prices),$body);
			$body = str_replace("{check_usd}", _form_checkbox("check_usd",$category->check_usd),$body);
			$body = str_replace("{check_memprices}", _form_checkbox("check_memprices",$category->check_memprices),$body);

			// 정렬 상식
			$sort = $category->sort;
			$form_sort = "<select name='sort' id=\"sort\" style=\"$css_textbox\">";
			if($sort == "regdate") $form_sort .= "<option value='regdate' selected>등록순</option>"; else $form_sort .= "<option value='regdate'>등록순</option>";
			if($sort == "pos") $form_sort .= "<option value='pos' selected>사용자지정</option>"; else $form_sort .= "<option value='pos'>사용자지정</option>";
			if($sort == "orders") $form_sort .= "<option value='orders' selected>주문건수</option>"; else $form_sort .= "<option value='orders'>주문건수</option>";
			if($sort == "click") $form_sort .= "<option value='click' selected>조회순</option>"; else $form_sort .= "<option value='click'>조회순</option>";
			$form_sort .= "</select>";
			$body = str_replace("{orderby}", $form_sort,$body);


			// PC접속형태 설정 
			$body = str_replace("{cate_type}",_cate_type_select("cate_type",$category->cate_type),$body);
			$body = str_replace("{cate_cols}", _form_text("cate_cols",$category->cols,$css_textbox),$body);
			$body = str_replace("{cate_rows}", _form_text("cate_rows",$category->rows,$css_textbox),$body);
			$body = str_replace("{cate_imgsize}", _form_text("cate_imgsize",$category->cate_imgsize,$css_textbox),$body);

			// 모바일 접혹형태 설정
			$body = str_replace("{mobile_type}",_cate_type_select("mobile_type",$category->mobile_type),$body);
			$body = str_replace("{mobile_cols}", _form_text("mobile_cols",$category->mobile_cols,$css_textbox),$body);
			$body = str_replace("{mobile_rows}", _form_text("mobile_rows",$category->mobile_rows,$css_textbox),$body);
			$body = str_replace("{mobile_imgsize}", _form_text("mobile_imgsize",$category->mobile_imgsize,$css_textbox),$body);

			$body = str_replace("{cate_title}",_form_file("userfile1",$css),$body);

			$body = str_replace("{apply_html}", _form_checkbox("apply_html",$category->apply_html),$body);

			$html = stripslashes($category->html);
			$body = str_replace("{html}","<textarea name='html' rows='20' style='$css_textarea'>".$html."</textarea>",$body);

			$body = str_replace("{cell_bgcolor}", _form_text("cell_bgcolor",$category->cell_bgcolor,$css_textbox),$body);
			$body = str_replace("{cell_outline_width}", _form_text("cell_outline_width",$category->cell_outline_width,$css_textbox),$body);
			$body = str_replace("{cell_outline_color}", _form_text("cell_outline_color",$category->cell_outline_color,$css_textbox),$body);
			$body = str_replace("{cell_outline_hovercolor}", _form_text("cell_outline_hovercolor",$category->cell_outline_hovercolo,$css_textbox),$body);
			$body = str_replace("{discount_color}", _form_text("cell_discount_color",$category->cell_discount_color,$css_textbox),$body);
			$body = str_replace("{discount_bgcolor}", _form_text("cell_discount_bgcolor",$category->cell_discount_bgcolor,$css_textbox),$body);			
			$body = str_replace("{freeshipping_color}", _form_text("cell_freeshipping_color",$category->cell_freeshipping_color,$css_textbox),$body);
			$body = str_replace("{freeshipping_bgcolor}", _form_text("cell_freeshipping_bgcolor",$category->cell_freeshipping_bgcolor,$css_textbox),$body);

		}

		echo $body;		
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>