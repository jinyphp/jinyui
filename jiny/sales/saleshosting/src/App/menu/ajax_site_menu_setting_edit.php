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
	// include "./func/goods.php";

	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$javascript = "<script>
			function form_submit(mode,uid){
				var url = \"ajax_site_menu_setting_editup.php?mode=\"+mode+\"&uid=\"+uid;
				
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
				var url = \"ajax_site_menu_setting_editup.php?mode=\"+mode+\"&uid=\"+uid;
				var returnValue = confirm(\"삭제하겠습니까?\");
				if(returnValue == true){
					$.ajax({
                   		url:url,
                    	type:'post',
                    	data:$('form').serialize(),
                   		success:function(data){
                        	$('#mainbody').html(data);
                    	}
                	});
				}	
			}

			function load_skin(url){
				$.ajax({
                   	url:url,
                    type:'post',
                    data:$('form').serialize(),
                   	success:function(data){
                        $('#mainbody').val(data);
                    }
                });
			}
		</script>";

		// form 칼라 픽업 
		$javascript .= "<script src=\"../js/jscolor.js\"></script>\n";

		$body = _theme_page($site_env->theme,"site_menu_setting_edit",$site_language,$site_mobile).$javascript;
	
		$mode = _formmode();
		$uid = _formdata("uid");

		// echo "uid = $uid <br>";

		$body=str_replace("{formstart}","<form id='data' name='sales' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>									    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

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
		if($rows->bgcolor) $bgcolor = $rows->bgcolor; else $bgcolor = "6d6d6d";
		$body = str_replace("{bgcolor}","<input type='text' name='bgcolor' value='$bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);
		


		// 메뉴 정렬
		$body = str_replace("{align}","<input type='text' name='align' value='".$rows->align."' style=\"$css_textbox\" >",$body);

		$body = str_replace("{fontsize}","<input type='text' name='fontsize' value='".$rows->fontsize."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{gradation}","<input type='text' name='gradation' value='".$rows->gradation."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{radius}","<input type='text' name='radius' value='".$rows->radius."' style=\"$css_textbox\" >",$body);

		// 메뉴 셀 (padding)
		$body = str_replace("{padding}","<input type='text' name='padding' value='".$rows->padding."' style=\"$css_textbox\" >",$body);


		if($rows->bottom) $body = str_replace("{bottom}","<input type='checkbox' name='bottom' checked >",$body);
		else $body = str_replace("{bottom}","<input type='checkbox' name='bottom' >",$body);

		if($rows->bottom_mark) $body = str_replace("{bottom_mark}","<input type='checkbox' name='bottom_mark' checked >",$body);
		else $body = str_replace("{bottom_mark}","<input type='checkbox' name='bottom_mark' >",$body);

		$body = str_replace("{bottom_px}","<input type='text' name='bottom_px' value='".$rows->bottom_px."' style=\"$css_textbox\" >",$body);

		if($rows->bottom_color) $bottom_color = $rows->bottom_color; else $bottom_color = "009ae1";
		$body = str_replace("{bottom_color}","<input type='text' name='bottom_color' value='$bottom_color' class=\"jscolor\" style=\"$css_textbox\" >",$body);


		// ======================
		// 1차 메뉴 설정
		// 1차메뉴 : 글자색.
		if($rows->menu1_fontcolor) $menu1_fontcolor = $rows->menu1_fontcolor; else $menu1_fontcolor = "ffffff";
		$body = str_replace("{menu1_fontcolor}","<input type='text' name='menu1_fontcolor' value='$menu1_fontcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu1_fontcolor_hover) $menu1_fontcolor_hover = $rows->menu1_fontcolor_hover; else $menu1_fontcolor_hover = "ffffff";
		$body = str_replace("{menu1_fontcolor_hover}","<input type='text' name='menu1_fontcolor_hover' value='$menu1_fontcolor_hover' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu1_bgcolor) $menu1_bgcolor = $rows->menu1_bgcolor; else $menu1_bgcolor = "6d6d6d";
		$body = str_replace("{menu1_bgcolor}","<input type='text' name='menu1_bgcolor' value='$menu1_bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);
		
		if($rows->menu1_bgcolor_hover) $menu1_bgcolor_hover = $rows->menu1_bgcolor_hover; else $menu1_bgcolor_hover = "000000";
		$body = str_replace("{menu1_bgcolor_hover}","<input type='text' name='menu1_bgcolor_hover' value='$menu1_bgcolor_hover' class=\"jscolor\" style=\"$css_textbox\" >",$body);


		// ======================
		// 2차 메뉴 설정
		// 2차메뉴 : 글자색.
		if($rows->menu2_fontcolor) $menu2_fontcolor = $rows->menu2_fontcolor; else $menu2_fontcolor = "ffffff";
		$body = str_replace("{menu2_fontcolor}","<input type='text' name='menu2_fontcolor' value='$menu2_fontcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu2_fontcolor_hover) $menu2_fontcolor_hover = $rows->menu2_fontcolor_hover; else $menu2_fontcolor_hover = "ffffff";
		$body = str_replace("{menu2_fontcolor_hover}","<input type='text' name='menu2_fontcolor_hover' value='$menu2_fontcolor_hover' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu2_bgcolor) $menu2_bgcolor = $rows->menu2_bgcolor; else $menu2_bgcolor = "333333";
		$body = str_replace("{menu2_bgcolor}","<input type='text' name='menu2_bgcolor' value='$menu2_bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu2_bgcolor_hover) $menu2_bgcolor_hover = $rows->menu2_bgcolor_hover; else $menu2_bgcolor_hover = "000000";
		$body = str_replace("{menu2_bgcolor_hover}","<input type='text' name='menu2_bgcolor_hover' value='$menu2_bgcolor_hover' class=\"jscolor\" style=\"$css_textbox\" >",$body);


		// ======================
		// 3차 메뉴 설정
		// 3차메뉴 : 글자색.
		if($rows->menu3_fontcolor) $menu3_fontcolor = $rows->menu3_fontcolor; else $menu3_fontcolor = "ffffff";
		$body = str_replace("{menu3_fontcolor}","<input type='text' name='menu3_fontcolor' value='$menu3_fontcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu3_fontcolor_hover) $menu3_fontcolor_hover = $rows->menu3_fontcolor_hover; else $menu3_fontcolor_hover = "ffffff";
		$body = str_replace("{menu3_fontcolor_hover}","<input type='text' name='menu3_fontcolor_hover' value='$menu3_fontcolor_hover' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu3_bgcolor) $menu3_bgcolor = $rows->menu3_bgcolor; else $menu3_bgcolor = "333333";
		$body = str_replace("{menu3_bgcolor}","<input type='text' name='menu3_bgcolor' value='$menu3_bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		if($rows->menu3_bgcolor_hover) $menu3_bgcolor_hover = $rows->menu3_bgcolor_hover; else $menu3_bgcolor_hover = "000000";
		$body = str_replace("{menu3_bgcolor_hover}","<input type='text' name='menu3_bgcolor_hover' value='$menu3_bgcolor_hover' class=\"jscolor\" style=\"$css_textbox\" >",$body);


		




		if($rows->html_check) $body = str_replace("{html_check}","<input type='checkbox' name='html_check' checked >",$body);
		else $body = str_replace("{html_check}","<input type='checkbox' name='html_check' >",$body);
		$body = str_replace("{menu_width}","<input type='text' name='menu_width' value='".$rows->menu_width."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu_align}","<input type='text' name='menu_align' value='".$rows->menu_align."' style=\"$css_textbox\" >",$body);
		$body = str_replace("{menu_css}","<input type='text' name='menu_css' value='".$rows->menu_css."' style=\"$css_textbox\" >",$body);

		$body = str_replace("{html}","<textarea name='html' rows='10' style='$css_textarea' id=\"skin_html\">".stripslashes($rows->html)."</textarea>",$body);

		/*
		if($rows->code){
			$path = "./users/1/theme/menu_".$rows->code.".html";
			if(_is_file($path)){
				$body = str_replace("{skin_load}","<a href='#' onclick=\"javascript:load_skin('".$path."')\">스킨파일 읽기</a>",$body);
			} else $body = str_replace("{skin_load}","",$body);
		} else $body = str_replace("{skin_load}","",$body);
		*/
		

		echo $body;		
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>