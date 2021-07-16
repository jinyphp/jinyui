<?
	$body = _theme_page($skin_name,"error");
		
	$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
	$body = str_replace("<!--{error_message}-->",$msg,$body);

	echo $body;
?>