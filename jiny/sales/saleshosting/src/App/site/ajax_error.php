<?
	$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php")."</script>";	
	$body =  _skin_emptybody($skin_name);
	$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
	echo $body;

	
?>