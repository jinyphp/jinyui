<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	$css_tabbar = "<style>
    	.tab-menu {
    		margin:0;
    		padding:0;
    		list-style: none;
    		background-color:#cccccc;
    	}

    	.tab-menu li {
    		width:75px;
    		background-color:#f3f3f3; 	
			font-size:12px;	
			border:1px solid #d8d8d8;
        	padding:5px;
        	text-align:center;
			text-valign:center;
			margin-right:5px;
        	float:left;
    	}

    	.tab-menu li:hover {
    		color:#ff0000;
    		//background-color:#f2f2f2;
      	}

    	.tab-menu li.select {
    		color:#ff0000;
    		// border-top:1px solid #ffffff;
    	}
    
    	.tab-contents {
        	width:100%;
       		// height:200px;
        	overflow:hidden;
        	background-color:#ffffff;
    	}
    
    	.tab-contents .content{
        	display:none;
    	}
    
    	.tab-contents .content.select{
        	display:block;
    	}
	</style>";

	if(isset($_COOKIE['cookie_email'])){
		
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		$body =  _skin_emptybody($skin_name);
		$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 
		$body = str_replace("</head>",$css_tabbar."</head>",$body);

		$mode = _formmode();    	
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$category = _formdata("category");
		$_enable = _formdata("_enable");
		$lis_tnum = _formdata("lis_tnum");
		$_soldout = _formdata("_soldout");
		
		// Form and Ajax Process
		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("<!--{skin_emptybody}-->","
					<center><img src='../images/loading.gif' border='0'></center>
					<form name='goods' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>
					   <input type='hidden' name='mode' value='$mode'>
					   <input type='hidden' name='uid' value='$uid'>
					   <input type='hidden' name='searchkey' value='$search'>
					   <input type='hidden' name='limit' value='$limit'>
					   <input type='hidden' name='category' value='$category'>
					   <input type='hidden' name='_enable' value='$_enable'>
						<input type='hidden' name='list_num' value='$list_num'>
						<input type='hidden' name='_soldout' value='$_soldout'>
					<script>"._javascript_ajax_html("#mainbody","ajax_shop_goods_edit.php")."</script>
					</form>",$body);

		echo $body;

	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody",$path_ajax_login)."</script>";	
		$body =  _theme_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

		


?>