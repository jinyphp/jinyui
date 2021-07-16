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
	
	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"ajax_site_language_editup.php?uid=\"+uid+\"&mode=\"+mode;
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
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


	function _language_tabbar($title,$site_language){
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

		


		// $skin_name = "default";
		// $body = _skin_page("default","site_language_edit");
		$body = $javascript._theme_page($site_env->theme,"site_language_edit",$site_language,$site_mobile);

		
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");
		
		// echo "category = $category <br>";
		$body=str_replace("{formstart}","<form id='data' name='sales' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>									    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" id=\"".$btn_style_gray."\" >
				",$body);

		if($mode == "new"){

			$body = str_replace("{language_name}", _language_tabbar("",$site_language),$body);
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);

			$body = str_replace("{code}","<input type='text' name='code' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{replace_code}","<input type='text' name='replace_code' id=\"cssFormStyle\" >",$body);

		} else if($mode == "edit"){
			
			$query = "select * from `site_language` where Id='$uid'";	
			//echo "$query <br>";
			if($lang = _sales_query_rows($query)){
				//echo $category->title;
				$title = stripslashes($lang->name);
				$title = json_decode($title);
			}

			$body = str_replace("{language_name}", _language_tabbar($title,$site_language),$body);
			
			if($lang->enable)
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
			else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);

			$body = str_replace("{code}","<input type='text' name='code' value='".$lang->code."' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{replace_code}","<input type='text' name='replace_code' value='".$lang->replace_code."' id=\"cssFormStyle\" >",$body);

		}

		echo $body;		
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>