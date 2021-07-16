<?php

	function _error_page($skin_name,$msg){
		global $site_env,$site_language,$site_mobile;
		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);
		// $body = _skin_page($skin_name,"error");
		$body = str_replace("<!--{error_message}-->", $msg, $body);
		return $body;
	}

?>