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
	include "./func/butten.php";

	include "./func/css.php";

	

	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";
		/////////////
		
		$body = $javascript._skin_page($skin_name,"site_themefiles");
		$limit = _formdata("limit"); 

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 	
		$body = str_replace("{formstart}","<form name='theme' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='limit' value='".$limit."'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

	
		$button ="<input type='button' value='NEW' onclick=\"javascript:themefiles_edit('new','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);
		

		//# 테마 목록 
		$theme = _formdata("theme");
		$form_theme = "<select name='theme' id=\"theme\" style=\"$css_textbox\" >";
		$query = "select * from site_theme where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($theme == $rows1->theme) $form_theme .= "<option value='".$rows1->theme."' selected>".$rows1->theme."</option>"; 
				else $form_theme .= "<option value='".$rows1->theme."'>".$rows1->theme."</option>";
			}
		}
		$form_theme .= "</select>";
		$body = str_replace("{theme}",$form_theme,$body);

		
		$body = str_replace("{theme_list}","
			
					<span id=\"theme_list\">
					
					<script>
						$.ajax({
            				url:'/ajax_site_themefiles.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#theme_list').html(data);
            				}
        				});
    				</script>

					</span>
					",$body);

		echo $body;
	
	} else {
		$body = _skin_pages($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>