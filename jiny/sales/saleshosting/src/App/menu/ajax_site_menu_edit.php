<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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

	function _menu_tabbar($title,$site_language){
		global $css_textbox;

		//echo $title;
		$title = stripslashes($title);
		$_title = json_decode($title);

		//echo $_title->$site_language;

		//#언어별 메뉴명 설정
		$query = "select * from `site_language` ";	
		if($rowss = _sales_query_rowss($query)){
			$skin_language = "";
			$skin_forms = "";
			for($i=0,$j=1;$i<count($rowss);$i++,$j++){
				$rows= $rowss[$i];
				$code = $rows->code;

				if($code == $site_language){
					$skin_language .= "<li class=\"active\" rel=\"tab".$j."\">".$code."</li>";
					$skin_forms .="<div id=\"tab".$j."\" class=\"tab_content\">
					<div style='font-size:12px;padding:10px;'> <input type='text' name=\"".$code."\" value=\"".$_title->$code."\" style=\"$css_textbox\"> </div>									   												   
					</div>";

				} else {
					$skin_language .= "<li rel=\"tab".$j."\">".$code."</li>";
					$skin_forms .="<div id=\"tab".$j."\" class=\"tab_content\">
						<div style='font-size:12px;padding:10px;'> <input type='text' name=\"".$code."\" value=\"".$_title->$code."\" style=\"$css_textbox\"> </div>									   												   
					</div>";
				}

			}
								
			$tabbar = "<div id=\"container\">
    		<ul class=\"tabs\">".$skin_language."</ul>
    		<div class=\"tab_container\">".$skin_forms."</div>
			</div>";
		}	

		return $tabbar;
	}
	


	$css_tabbar = "";


	$javascript = "<script>
		// 연결 방식 설정을 바꾼경우, 새롭게 목록 표시
		function urlmode_change(){
			var select = document.getElementById('urlmode');
 			var option_value = select.options[select.selectedIndex].value;
 			var option_text   = select.options[select.selectedIndex].text;
					
			var url_value = document.getElementsByName('url');
					
			$.ajax({
               	url:'ajax_site_menu_url.php?mode='+option_value+'&url_value=url_value',
               	type:'post',
               	data:$('form').serialize(),
               	success:function(data){
                   	$('#url_list').html(data);
               	}
            });
					
		}

		function form_submit(mode,uid){
			var url = \"ajax_site_menu_editup.php?uid=\"+uid+\"&mode=\"+mode;
				
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
			var url = \"ajax_site_menu_editup.php?uid=\"+uid+\"&mode=\"+mode;
			// alert(url);

			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);

                }
            });
		}
	
	
		// Tab BAR 처리		
    	$(function () {

    		$(\".tab_content\").hide();
    		$(\".tab_content:first\").show();

    		$(\"ul.tabs li\").click(function () {
        		$(\"ul.tabs li\").removeClass(\"active\").css(\"color\", \"#333\");
        		//$(this).addClass(\"active\").css({\"color\": \"darkred\",\"font-weight\": \"bolder\"});
        		$(this).addClass(\"active\").css(\"color\", \"darkred\");
        		$(\".tab_content\").hide()
        		var activeTab = $(this).attr(\"rel\");
        		$(\"#\" + activeTab).fadeIn();
    		});
		});
	
	</script>";


	//echo "menu edit<br>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// $body = $css_tabbar.$javascript._skin_page($skin_name,"site_menu_edit");
		$body = $css_tabbar.$javascript._theme_page($site_env->theme,"site_menu_edit",$site_language,$site_mobile);

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$menu_code = _formdata("menu_code");
		//echo "menu_code = $menu_code<br>";
		
		$body=str_replace("{formstart}","<form name='menu' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='uid' value='$uid'>
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		



		if($mode == "new"){
			$body = str_replace("{formmode}","신규등록",$body);
			$body = str_replace("{menu_code}",$menu_code."<input type='hidden' name='menu_code' value='$menu_code'>",$body);

			$body = str_replace("{menu_name}", _menu_tabbar("",$site_language),$body);
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);

			$urlmode = "<select name='urlmode' id=\"urlmode\" onchange=\"javascript:urlmode_change()\" style=\"$css_textbox\">
			<option value='direct'>직접입력</option>
			<option value='pages'>정적페이지</option>
			<option value='board'>계시판</option>
			<option value='category'>카테고리</option>
			</select>";
			$body = str_replace("{urlmode}",$urlmode,$body);
			$body = str_replace("{url}","<span id=\"url_list\"><input type='text' name='url' style=\"$css_textbox\"></span>",$body);

			$body = str_replace("{check_members}",_form_checkbox("check_members",""),$body);

			$form_submit  = "<input type='button' value='생성' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >  ";
			$body = str_replace("{form_submit}",$form_submit,$body);

		} else if($mode == "sub"){
			$query = "select * from `site_menu` where Id='$uid'";	
			//echo "$query <br>";
			if($menu = _sales_query_rows($query)){
				$body = str_replace("{menu_code}",$menu_code."<input type='hidden' name='menu_code' value='$menu_code'>",$body);

				$sub = stripslashes($menu->title);
				$sub = json_decode($title);
				$body = str_replace("{formmode}","서브등록:".$sub->$site_language,$body);
				$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
				
				$urlmode = "<select name='urlmode' id=\"urlmode\" onchange=\"javascript:urlmode_change()\" style=\"$css_textbox\">
					<option value='direct'>직접입력</option>
					<option value='pages'>정적페이지</option>
					<option value='board'>계시판</option>
					<option value='category'>카테고리</option>
					</select>";
				$body = str_replace("{urlmode}",$urlmode,$body);
				$body = str_replace("{url}","<span id=\"url_list\"><input type='text' name='url' style=\"$css_textbox\"></span>",$body);

			}

			$body = str_replace("{menu_name}", _menu_tabbar("",$site_language),$body);	
			$body = str_replace("{check_members}",_form_checkbox("check_members",""),$body);

			$form_submit  = "<input type='button' value='추가' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >  ";
			$body = str_replace("{form_submit}",$form_submit,$body);

		} else if($mode == "edit"){

			$query = "select * from `site_menu` where Id='$uid'";	
			//echo "$query <br>";
			if($menu = _sales_query_rows($query)){
				$body = str_replace("{menu_code}",$menu->code."<input type='hidden' name='menu_code' value='".$menu->code."'>",$body);

				$body = str_replace("{formmode}","수정",$body);

				if($menu->enable)
				$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
				else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);

				$urlmode = "<select name='urlmode' id=\"urlmode\" onchange=\"javascript:urlmode_change()\" style=\"$css_textbox\">
					<option value='direct'>직접입력</option>
					<option value='pages'>정적페이지</option>
					<option value='board'>계시판</option>
					<option value='category'>카테고리</option>
					</select>";
				$urlmode = str_replace($menu->urlmode."'>",$menu->urlmode."' selected>",$urlmode);
				$body = str_replace("{urlmode}",$urlmode,$body);

				$body = str_replace("{check_members}",_form_checkbox("check_members",$menu->check_members),$body);


				//echo $category->title;
				// $title = stripslashes($menu->title);
				// $title = json_decode($title);
				$body = str_replace("{menu_name}", _menu_tabbar($menu->title,$site_language),$body);

				$form_submit  = "<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >  ";
				$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";

				$body = str_replace("{form_submit}",$form_submit,$body);


				// 메뉴 이동
				$query = "select * from `site_menu` where code='".$menu->code."'";
				$query .= "order by pos desc";	
				if($rowss = _sales_query_rowss($query)){

					$menu_directory = "<select name='menu_move'>";					
					for($i=0;$i<count($rowss);$i++){
						
						$rows= $rowss[$i];
						$menu_directory .= "<option value='".$rows->Id."' ";						
				
						$title = stripslashes($rows->title);
						$title_name = json_decode($title);

						for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;└"; 

						$menu_directory .= ">$space".$title_name->$site_language."</option>";

					}
					$menu_directory .= "</select>";	
					
				}

				$body = str_replace("{menu_directory}",$menu_directory,$body);
				$body = str_replace("{menu_move}","<input type='button' value='이동' onclick=\"javascript:form_submit('move','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
			





			switch($menu->urlmode){
				case 'category':
				$query = "select * from `shop_cate` ";
				$query .= "order by pos desc";	
				if($rowss = _sales_query_rowss($query)){

					$cate = "<select name='url' size='5' style='width:100%' >";
					
					for($i=0;$i<count($rowss);$i++){
						$rows= $rowss[$i];
						$cate .= "<option value='".$rows->Id."' ";

						if($menu->url == $rows->Id) $cate .= "selected";
				
						$title = stripslashes($rows->title);
						$title_name = json_decode($title);
						for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;└";
						$cate .= ">$space".$title_name->$site_language."</option>";

					}
					$cate .= "</select>";	
					
				}
				$body = str_replace("{url}","<span id=\"url_list\">$cate</span>",$body);
				break;
				case 'board':
					//echo "계시판 선택";
					// $body = str_replace("{url}","<span id=\"url_list\"><input type='text' name='url'value='".$menu->url."'  id=\"cssFormStyle\"></span>",$body);
					$query = "select * from `site_boardlist` ";
					$query .= "order by Id desc";	
					if($rowss = _sales_query_rowss($query)){

						$cate = "<select name='url' size='5' style='width:100%' >";
					
						for($i=0;$i<count($rowss);$i++){
							$rows= $rowss[$i];
							$cate .= "<option value='".$rows->code."' ";

							if($menu->url == $rows->Id) $cate .= "selected";
				
							//$title = stripslashes($rows->title);
							//$title_name = json_decode($title);
							//$cate .= ">".$title_name->$site_language."</option>";
							$cate .= ">".$rows->title."</option>";

						}
						$cate .= "</select>";	
					
					}
					$body = str_replace("{url}","<span id=\"url_list\">$cate</span>",$body);
				break;
				case 'pages':
					//echo "페이지 선택";
					// $body = str_replace("{url}","<span id=\"url_list\"><input type='text' name='url'value='".$menu->url."'  id=\"cssFormStyle\"></span>",$body);
					$query = "select * from `site_pages` ";
					$query .= "order by Id desc";	
					if($rowss = _sales_query_rowss($query)){

						$cate = "<select name='url' size='5' style='width:100%' >";
					
						for($i=0;$i<count($rowss);$i++){
							$rows= $rowss[$i];
							$cate .= "<option value='".$rows->code."' ";

							if($menu->url == $rows->code) $cate .= "selected";
				
							//$title = stripslashes($rows->title);
							//$title_name = json_decode($title);
							//$cate .= ">".$title_name->$site_language."</option>";
							$cate .= ">".$rows->title."</option>";

						}
						$cate .= "</select>";	
					
					}
					$body = str_replace("{url}","<span id=\"url_list\">$cate</span>",$body);
				break;
				case 'direct':
					//echo "직접입력";
					$body = str_replace("{url}","<span id=\"url_list\"><input type='text' name='url'value='".$menu->url."'  id=\"cssFormStyle\"></span>",$body);
				break;
				default:
					$body = str_replace("{url}","<span id=\"url_list\"></span>",$body);

			}



			}

			



		}

		echo $body;	

		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>