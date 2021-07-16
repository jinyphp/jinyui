<?

	@session_start();
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
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
	
		// Sales 사용자 DB 접근.
		include "./sales.php";


	function _menu_tabbar($title,$site_language){
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
											<td><textarea name='".$code."' rows='5' style='width:100%'>".$lang_text."</textarea></td>
											</tr>
										</table>
										</div>";
			}
								
			$tabbar = "<div id='css_tabs'> $skin_language $skin_forms </div>";
		}	

		return $tabbar;
	}

		
		if(isset($_SESSION['language'])){
			$site_language = $_SESSION['language'];
		} else {
			$site_language = "ko";
		}

		// 장바구니 섹션 존재 유무를 검사.
		if(isset($_SESSION['cartlog'])){
			$cartlog = $_SESSION['cartlog'];
		} else {
			$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
			$_SESSION['cartlog'] = $cartlog;			
		}

		if(isset($_COOKIE['cookie_email'])){
			$cookie_email = $_COOKIE['cookie_email'];
		} else {
			$cookie_email = "";
		}

		$skin_name = "default";
		$body = _skin_page("default","site_menu_set");

		
		// $ajaxkey = _formdata("ajaxkey");
		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";

		$body=str_replace("{formstart}","",$body);
		$body=str_replace("{formend}","",$body);


		$body = str_replace("{form_submit}","
				<script>
				function form_submit(mode,uid){
					var url = \"/ajax_site_menu_editup.php?mode=\"+mode;
				
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#menu_edit').html(data);
                        }
                    });
				}
				</script>
				<input type='button' value='저장' onclick=\"javascript:form_submit('setting')\" id=\"".$btn_style_gray."\" >
				",$body);


		$query = "select * from `site_menu_setting`";
		$rows = _sales_query_rows($query);

		if(isset($rows->width)) $width = $rows->width; else $width ="";
		$body = str_replace("{width}","<input type='text' name='width' value='".$width."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->height)) $height = $rows->height; else $height ="";
		$body = str_replace("{height}","<input type='text' name='height' value='".$height."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->bgcolor)) $bgcolor = $rows->bgcolor; else $bgcolor ="";
		$body = str_replace("{bgcolor}","<input type='text' name='bgcolor' value='".$bgcolor."' id=\"cssFormStyle\" >",$body);

		
		// 최상위 메뉴설정
		if(isset($rows->menu_width)) $menu_width = $rows->menu_width; else $menu_width ="";
		$body = str_replace("{menu_width}","<input type='text' name='menu_width' value='".$menu_width."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_align)) $menu_align = $rows->menu_align; else $menu_align ="";
		$body = str_replace("{menu_align}","<input type='text' name='menu_align' value='".$menu_align."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_bgcolor)) $menu_bgcolor = $rows->menu_bgcolor; else $menu_bgcolor ="";
		$body = str_replace("{menu_bgcolor}","<input type='text' name='menu_bgcolor' value='".$menu_bgcolor."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_fontsize)) $menu_fontsize = $rows->menu_fontsize; else $menu_fontsize ="";
		$body = str_replace("{menu_fontsize}","<input type='text' name='menu_fontsize' value='".$menu_fontsize."' id=\"cssFormStyle\" >",$body);
				
		if(isset($rows->menu_gradation)) $menu_gradation = $rows->menu_gradation; else $menu_gradation ="";
		$body = str_replace("{menu_gradation}","<input type='text' name='menu_gradation' value='".$menu_gradation."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_radius)) $menu_radius = $rows->menu_radius; else $menu_radius ="";
		$body = str_replace("{menu_radius}","<input type='text' name='menu_radius' value='".$menu_radius."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_color)) $menu_color = $rows->menu_color; else $menu_color ="";
		$body = str_replace("{menu_color}","<input type='text' name='menu_color' value='".$menu_color."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_color1)) $menu_color1 = $rows->menu_color1; else $menu_color1 ="";
		$body = str_replace("{menu_color1}","<input type='text' name='menu_color1' value='".$menu_color1."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_font_bgcolor)) $menu_font_bgcolor = $rows->menu_font_bgcolor; else $menu_font_bgcolor ="";
		$body = str_replace("{menu_font_bgcolor}","<input type='text' name='menu_font_bgcolor' value='".$menu_font_bgcolor."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu_font_bgcolor1)) $menu_font_bgcolor1 = $rows->menu_font_bgcolor1; else $menu_font_bgcolor1 ="";
		$body = str_replace("{menu_font_bgcolor1}","<input type='text' name='menu_font_bgcolor1' value='".$menu_font_bgcolor1."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu1_color)) $menu1_color = $rows->menu1_color; else $menu1_color ="";
		$body = str_replace("{menu1_color}","<input type='text' name='menu1_color' value='".$menu1_color."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu1_color1)) $menu1_color1 = $rows->menu1_color1; else $menu1_color1 ="";
		$body = str_replace("{menu1_color1}","<input type='text' name='menu1_color1' value='".$menu1_color1."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu1_font_bgcolor)) $menu1_font_bgcolor = $rows->menu1_font_bgcolor; else $menu1_font_bgcolor ="";
		$body = str_replace("{menu1_font_bgcolor}","<input type='text' name='menu1_font_bgcolor' value='".$menu1_font_bgcolor."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->menu1_font_bgcolor1)) $menu1_font_bgcolor1 = $rows->menu1_font_bgcolor1; else $menu1_font_bgcolor1 ="";
		$body = str_replace("{menu1_font_bgcolor1}","<input type='text' name='menu1_font_bgcolor1' value='".$menu1_font_bgcolor1."' id=\"cssFormStyle\" >",$body);

		if($rows->bottom)
			$body = str_replace("{bottom}","<input type='checkbox' name='bottom' checked >",$body);
		else $body = str_replace("{bottom}","<input type='checkbox' name='bottom' >",$body);

		if($rows->bottom_mark)
			$body = str_replace("{bottom_mark}","<input type='checkbox' name='bottom_mark' checked >",$body);
		else $body = str_replace("{bottom_mark}","<input type='checkbox' name='bottom_mark' >",$body);

		if(isset($rows->bottom_px)) $bottom_px = $rows->bottom_px; else $bottom_px ="";
		$body = str_replace("{bottom_px}","<input type='text' name='bottom_px' value='".$bottom_px."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->bottom_color)) $bottom_color = $rows->bottom_color; else $bottom_color ="";
		$body = str_replace("{bottom_color}","<input type='text' name='bottom_color' value='".$bottom_color."' id=\"cssFormStyle\" >",$body);
	

		echo $body;		
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>