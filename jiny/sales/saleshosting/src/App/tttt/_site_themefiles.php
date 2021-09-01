<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		
        $body =  _skin_emptybody($skin_name);
        $body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$theme = _formdata("theme");
		$list_num = _formdata("list_num");
	
		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("<!--{skin_emptybody}-->","
					<form name='goods' method='post' enctype='multipart/form-data'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='theme' value='$theme'>
						<input type='hidden' name='list_num' value='$list_num'>
						<script>"._javascript_ajax_html("#mainbody","/ajax_site_themefiles.php")."</script>				
					</form>",$body);

		echo $body;




	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php")."</script>";	
		$body =  _skin_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

		


?>