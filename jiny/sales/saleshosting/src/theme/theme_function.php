<?php
		// 지정된 상품 하나를 읽어옴
	function _site_theme_rows($uid){
		//global $table_site_theme;
		$query = "select * from site_theme WHERE `Id`='$uid'";
		if($rows = _sales_query_rows($query)) return $rows;
	}

	// 지정된 상품 하나를 읽어옴
	function _site_themefiles_rows($uid){
		//global $table_site_themefiles;
		$query = "select * from site_themefiles WHERE `Id`='$uid'";
		if($rows = _sales_query_rows($query)) return $rows;
	}

	function _themefiles_html($uid,$lang,$mobile){
		//global $table_site_themefiles_html;
		global $theme;

		if($uid>0){
			$query = "select * from site_themefiles_html WHERE `theme`='$theme' and `pid`='$uid' and `language`='$lang' and `mobile`='$mobile'";
			if($rows = _sales_query_rows($query)) return $rows;
		}
		
	}

	function _site_theme_onSelect($theme){
		global $css_textbox;
		
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

		return $form_theme;
	}
	

?>