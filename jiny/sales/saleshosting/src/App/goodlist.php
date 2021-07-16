<?php
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


	include "./func/datetime.php";
	include "./func/error.php";
	include "./func/ajax.php";

	$body =  _skin_emptybody($skin_name);

	if($code = _formdata("cate")){
		$limit = _formdata("limit");
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("<!--{skin_emptybody}-->","<center><img src='./images/loading.gif' border='0'></center>
			<script>"._ajax_script(".mainbody","/ajax_goodlist.php?ajaxkey=".$ajaxkey."&cate=".$code)."</script>",$body);

		if($_SESSION['session_admin']){
			// 관리자 접속시, 상품 정보 직접 수정 가능
			$body = str_replace("{edit}","<input type='button' name='edit' value='상품수정' onclick=\"javascript:goodedit('edit','$uid')\" style=\"$css_btn_gray\">",$body);
			$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 
		} else $body = str_replace("{edit}","",$body);

	} else {
		$msg = "선택된 카테고리가 없습니다.";
		$body_error = _error_page($skin_name,$msg);
		$body = str_replace("<!--{skin_emptybody}-->",$body_error,$body);
	}

	echo $body;


?>