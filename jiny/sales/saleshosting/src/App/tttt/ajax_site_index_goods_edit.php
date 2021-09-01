<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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
			var url = \"/ajax_site_index_goods_editup.php?mode=\"+mode+\"&uid=\"+uid;
			
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

	function _cate_type_select($name,$select){
		global $css_textbox;
		$cate_type = "<select name='$name' style=\"$css_textbox\">";
		if($select == "tile1") $cate_type .= "<option value='tile1' selected>세로형 타일방식</option>"; else $cate_type .= "<option value='tile1'>세로형 타일방식</option>";
		if($select == "tile2") $cate_type .= "<option value='tile2' selected>가로형 타일방식</option>"; else $cate_type .= "<option value='tile2'>가로형 타일방식</option>";
		if($select == "list") $cate_type .= "<option value='list' selected>리스트방식</option>"; else $cate_type .= "<option value='list'>리스트방식</option>";
		$cate_type .= "</select>";
		return $cate_type;
	}

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		include "./conf/sales.php";	// Sales 사용자 DB 접근.

    	$mode = _formmode();		// echo "mode is $mode <br>";
		$uid = _formdata("uid");	// echo "uid is $uid <br>";



		$body = $javascript._skin_page($skin_name,"site_index_goods_edit");

		$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		/*
		$eid = _formdata("eid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _sales_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);

		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);
		*/


		//////////////////
		$query = "select * from `site_index_goods` where Id =$uid";
		if($rows = _sales_query_rows($query)){
			// 인텍스 타이틀 수정모드
			$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		} else {
			$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_goods_submit('".$mode."','".$uid."')\" id=\"".$css_btn_gray."\" >",$body);
		}

		$css = "cssFormStyle";
		// 활성화 여부 체크 
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{code}",_form_text("code",$rows->code,$css_textbox),$body);
		$body = str_replace("{title}",_form_text("title",$rows->title,$css_textbox),$body);

		$body = str_replace("{cate_type}",_cate_type_select("cate_type",$rows->type),$body);
		$body = str_replace("{cate_rows}",_form_text("cate_rows",$rows->rows,$css_textbox),$body);
		$body = str_replace("{cate_cols}",_form_text("cate_cols",$rows->cols,$css_textbox),$body);
		// $body = str_replace("{cate_type}",_form_text("cate_type",$rows->type,$css_textbox),$body);
		$body = str_replace("{cate_imgsize}",_form_text("cate_imgsize",$rows->imgsize,$css_textbox),$body);

		$body = str_replace("{mobile_type}",_cate_type_select("mobile_type",$rows->mobile_type),$body);
		$body = str_replace("{mobile_rows}",_form_text("mobile_rows",$rows->mobile_rows,$css_textbox),$body);
		$body = str_replace("{mobile_cols}",_form_text("mobile_cols",$rows->mobile_cols,$css_textbox),$body);
		//$body = str_replace("{mobile_type}",_form_text("mobile_type",$rows->mobile_type,$css_textbox),$body);
		$body = str_replace("{mobile_imgsize}",_form_text("mobile_imgsize",$rows->mobile_imgsize,$css_textbox),$body);
		
		// $body = str_replace("{img_size}",_form_text("img_size",$rows->img_size,$css_textbox),$body);

		$body = str_replace("{sort}",_form_text("sort",$rows->sort,$css_textbox),$body);

		$body = str_replace("{cate_width}",_form_text("width",$rows->width,$css_textbox),$body);
		$body = str_replace("{cate_align}",_form_text("align",$rows->align,$css_textbox),$body);
		$body = str_replace("{cate_bgcolor}",_form_text("bgcolor",$rows->bgcolor,$css_textbox),$body);

		if(isset($rows->check_memprices)) $body = str_replace("{check_memprices}",_form_checkbox("check_memprices",$rows->check_memprices),$body);
		else $body = str_replace("{check_memprices}",_form_checkbox("check_memprices",""),$body);

		if(isset($rows->check_prices)) $body = str_replace("{check_prices}",_form_checkbox("check_prices",$rows->check_prices),$body);
		else $body = str_replace("{check_prices}",_form_checkbox("check_prices","on"),$body);

		if(isset($rows->check_usd)) $body = str_replace("{check_usd}",_form_checkbox("check_usd",$rows->check_usd),$body);
		else $body = str_replace("{check_usd}",_form_checkbox("check_usd","on"),$body);

		if(isset($rows->check_goodname)) $body = str_replace("{check_goodname}",_form_checkbox("check_goodname",$rows->check_goodname),$body);
		else $body = str_replace("{check_goodname}",_form_checkbox("check_goodname","on"),$body);

		if(isset($rows->check_subtitle)) $body = str_replace("{check_subtitle}",_form_checkbox("check_subtitle",$rows->check_subtitle),$body);
		else $body = str_replace("{check_subtitle}",_form_checkbox("check_subtitle","on"),$body);

		if(isset($rows->check_spec)) $body = str_replace("{check_spec}",_form_checkbox("check_spec",$rows->check_spec),$body);
		else $body = str_replace("{check_spec}",_form_checkbox("check_spec","on"),$body);

		if(isset($rows->check_images)) $body = str_replace("{check_images}",_form_checkbox("check_images",$rows->check_images),$body);
		else $body = str_replace("{check_images}",_form_checkbox("check_images","on"),$body);

		$body = str_replace("{cate_images}",_form_file("userfile1",$css_textbox),$body);
		if(isset($rows->title_images)) $body = str_replace("{cate_images_files}",$rows->title_images,$body);
		else $body = str_replace("{cate_images_files}","",$body);

		if(isset($rows->title_images_check)) $body = str_replace("{cate_images_check}",_form_checkbox("cate_images_check",$rows->title_images_check),$body);
		else $body = str_replace("{cate_images_check}",_form_checkbox("cate_images_check",""),$body);

		// 상품 기본 카테고리
		function _shop_category_select($sel,$site_language){
			global $css_textbox;
				$query = "select * from `shop_cate` ";
				$query .= "order by pos desc";	
				if($rowss = _sales_query_rowss($query)){

					$cate = "<select name='cate' style='$css_textbox'>";
					
					for($i=0;$i<count($rowss);$i++){
						
						$rows= $rowss[$i];
						$cate .= "<option value='".$rows->Id."' ";
						
						if($sel == $rows->Id) $cate .= "selected";
						
						$title = stripslashes($rows->title);
						$title_name = json_decode($title);
						$cate .= ">".$title_name->$site_language."</option>";

					}
					$cate .= "</select>";	
					
				}
				
				return $cate;
		} 

		$body = str_replace("{category}",_shop_category_select($rows->cate,$site_language),$body);

		if(isset($rows->html_apply)) $body = str_replace("{cate_html_apply}",_form_checkbox("html_apply",$rows->html_apply),$body);
		else $body = str_replace("{cate_html_apply}",_form_checkbox("html_apply",""),$body);

		$body = str_replace("{cate_html}",_form_textarea("cate_html",stripslashes($rows->html),"20",$css_textarea),$body);


		$body = str_replace("{cell_bgcolor}", _form_text("cell_bgcolor",$rows->cell_bgcolor,$css_textbox),$body);
		$body = str_replace("{cell_outline_width}", _form_text("cell_outline_width",$rows->cell_outline_width,$css_textbox),$body);
		$body = str_replace("{cell_outline_color}", _form_text("cell_outline_color",$rows->cell_outline_color,$css_textbox),$body);
		$body = str_replace("{cell_outline_hovercolor}", _form_text("cell_outline_hovercolor",$rows->cell_outline_hovercolo,$css_textbox),$body);
		$body = str_replace("{discount_color}", _form_text("cell_discount_color",$rows->cell_discount_color,$css_textbox),$body);
		$body = str_replace("{discount_bgcolor}", _form_text("cell_discount_bgcolor",$rows->cell_discount_bgcolor,$css_textbox),$body);			
		$body = str_replace("{freeshipping_color}", _form_text("cell_freeshipping_color",$rows->cell_freeshipping_color,$css_textbox),$body);
		$body = str_replace("{freeshipping_bgcolor}", _form_text("cell_freeshipping_bgcolor",$rows->cell_freeshipping_bgcolor,$css_textbox),$body);


		echo $body;

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>