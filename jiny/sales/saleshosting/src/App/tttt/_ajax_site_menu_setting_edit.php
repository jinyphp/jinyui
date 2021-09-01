<?
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";

	include "./func/css.php";
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$javascript = "<script>
			function form_submit(mode,uid){
				var url = \"/ajax_site_menu_setting_editup.php?mode=\"+mode+\"&uid=\"+uid;
				// alert(url);
				//$('#site_edit').html(data);
				
				$.ajax({
                    url:url,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#site_edit').html(data);
                    }
                });

				
			}

			function form_delete(mode,uid){
				var url = \"/ajax_site_menu_setting_editup.php?mode=\"+mode+\"&uid=\"+uid;
				var returnValue = confirm(\"삭제하겠습니까?\");
				if(returnValue == true){
					$.ajax({
                   		url:url,
                    	type:'post',
                    	data:$('form').serialize(),
                   		success:function(data){
                        	$('#site_edit').html(data);
                    	}
                	});
				}	
			}

			function load_skin(url){
				// alert(url);
				$.ajax({
                   	url:url,
                    type:'post',
                    data:$('form').serialize(),
                   	success:function(data){
                        $('#skin_html').val(data);
                    }
                });
			}
		</script>";


		$body = $javascript._skin_page($skin_name,"site_menu_setting_edit");

		$mode = _formmode();
		$uid = _formdata("uid");

		// echo "uid = $uid <br>";

		$body=str_replace("{formstart}","",$body);
		$body=str_replace("{formend}","",$body);

		$query = "select * from `site_menu_setting` where Id='$uid'";
		if($rows = _sales_query_rows($query)){

			$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:form_submit('edit','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
		} else {
			$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_submit('new','0')\" style=\"".$css_btn_gray."\" >
				",$body);
		}

		// 활성화 체크 선택
		if($rows->enable) $body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
		else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
		
		// 메뉴코드
		$body = str_replace("{code}","<input type='text' name='code' value='".$rows->code."' style=\"$css_textbox\" >",$body);

		// 메뉴타입
		$form_menutype  = "<select name='menu_type' style='$css_textbox' id=\"menu_type\" style=\"$css_textbox\" >";
		$form_menutype .= "<option value='topdown' selected>상단 풀다운 스타일1</option>";
		$form_menutype .= "<option value='leftdown' selected>좌측 풀다운 스타일1</option>";
		$form_menutype .= "</select>";
		$body = str_replace("{menu_type}",$form_menutype,$body);


		// 메뉴바 가로 / 세로크기 
		$body = str_replace("{width}","<input type='text' name='width' value='".$rows->width."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{height}","<input type='text' name='height' value='".$rows->height."' style=\"$css_textbox\" >",$body);

		// 메뉴, 배경색 
		$body = str_replace("{bgcolor}","<input type='text' name='bgcolor' value='".$rows->bgcolor."' style=\"$css_textbox\" >",$body);
		// 메뉴 정렬
		$body = str_replace("{align}","<input type='text' name='align' value='".$rows->align."' style=\"$css_textbox\" >",$body);

		$body = str_replace("{fontsize}","<input type='text' name='fontsize' value='".$rows->fontsize."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{gradation}","<input type='text' name='gradation' value='".$rows->gradation."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{radius}","<input type='text' name='radius' value='".$rows->radius."' style=\"$css_textbox\" >",$body);

		// 메뉴 셀 (padding)
		$body = str_replace("{padding}","<input type='text' name='padding' value='".$rows->padding."' style=\"$css_textbox\" >",$body);

		// ======================
		// 1차 메뉴 설정
		// 1차메뉴 : 글자색.
		$body = str_replace("{menu1_fontcolor}","<input type='text' name='menu1_fontcolor' value='".$rows->menu1_fontcolor."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu1_fontcolor_hover}","<input type='text' name='menu1_fontcolor_hover' value='".$rows->menu1_fontcolor_hover."' style=\"$css_textbox\" >",$body);

		$body = str_replace("{menu1_bgcolor}","<input type='text' name='menu1_bgcolor' value='".$rows->menu1_bgcolor."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu1_bgcolor_hover}","<input type='text' name='menu1_bgcolor_hoverr' value='".$rows->menu1_bgcolor_hover."' style=\"$css_textbox\" >",$body);


		// ======================
		// 2차 메뉴 설정
		// 2차메뉴 : 글자색.
		$body = str_replace("{menu2_fontcolor}","<input type='text' name='menu2_fontcolor' value='".$rows->menu2_fontcolor."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu2_fontcolor_hover}","<input type='text' name='menu2_fontcolor_hover' value='".$rows->menu2_fontcolor_hover."' style=\"$css_textbox\" >",$body);

		$body = str_replace("{menu2_bgcolor}","<input type='text' name='menu2_bgcolor' value='".$rows->menu2_bgcolor."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu2_bgcolor_hover}","<input type='text' name='menu2_bgcolor_hoverr' value='".$rows->menu2_bgcolor_hover."' style=\"$css_textbox\" >",$body);


		// ======================
		// 3차 메뉴 설정
		// 3차메뉴 : 글자색.
		$body = str_replace("{menu3_fontcolor}","<input type='text' name='menu3_fontcolor' value='".$rows->menu3_fontcolor."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu3_fontcolor_hover}","<input type='text' name='menu3_fontcolor_hover' value='".$rows->menu3_fontcolor_hover."' style=\"$css_textbox\" >",$body);

		$body = str_replace("{menu3_bgcolor}","<input type='text' name='menu3_bgcolor' value='".$rows->menu3_bgcolor."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu3_bgcolor_hover}","<input type='text' name='menu3_bgcolor_hoverr' value='".$rows->menu3_bgcolor_hover."' style=\"$css_textbox\" >",$body);


		if($rows->bottom) $body = str_replace("{bottom}","<input type='checkbox' name='bottom' checked >",$body);
		else $body = str_replace("{bottom}","<input type='checkbox' name='bottom' >",$body);

		if($rows->bottom_mark) $body = str_replace("{bottom_mark}","<input type='checkbox' name='bottom_mark' checked >",$body);
		else $body = str_replace("{bottom_mark}","<input type='checkbox' name='bottom_mark' >",$body);

		$body = str_replace("{bottom_px}","<input type='text' name='bottom_px' value='".$rows->bottom_px."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{bottom_color}","<input type='text' name='bottom_color' value='".$rows->bottom_color."' style=\"$css_textbox\" >",$body);


		if($rows->html_check) $body = str_replace("{html_check}","<input type='checkbox' name='html_check' checked >",$body);
		else $body = str_replace("{html_check}","<input type='checkbox' name='html_check' >",$body);
		$body = str_replace("{menu_width}","<input type='text' name='menu_width' value='".$rows->menu_width."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu_align}","<input type='text' name='menu_align' value='".$rows->menu_align."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu_css}","<input type='text' name='menu_css' value='".$rows->menu_css."' style=\"$css_textbox\" >",$body);

		$body = str_replace("{html}","<textarea name='html' rows='10' style='$css_textarea' id=\"skin_html\">".stripslashes($rows->html)."</textarea>",$body);

		if($rows->code){
			$path = "./users/1/theme/menu_".$rows->code.".html";
			if(_is_file($path)){
				$body = str_replace("{skin_load}","<a href='#' onclick=\"javascript:load_skin('".$path."')\">스킨파일 읽기</a>",$body);
			} else $body = str_replace("{skin_load}","",$body);
		} else $body = str_replace("{skin_load}","",$body);
		

		echo $body;		
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>