<?php
	// ********************
	// SEO Meta 설정
	$seo_title = json_decode($site_env->seo_title);
	$body = str_replace("<!-- meta title -->","<meta name=\"title\" content=\"".$seo_title->$site_language."\" />\n",$body);

	$seo_keyword = json_decode($site_env->seo_keyword);
	$body = str_replace("<!-- meta keyword -->","<meta name=\"keyword\" content=\"".$seo_keyword->$site_language."\" />\n",$body);

	$seo_description = json_decode($site_env->seo_description);
	$body = str_replace("<!-- meta description -->","<meta name=\"description\" content=\"".$seo_description->$site_language."\" />\n",$body);
	
?>