<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	//*  세일즈호스팅 서비스 정보 표시

	// update : 2016.01.15 = 생성

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

	include "./func/css.php";


	$css_tabbar = "<style>
    	.tab-menu {
    		margin:0;
    		padding:0;
    		list-style: none;
    		background-color:#cccccc;
    	}

    	.tab-menu li {
        	padding:10px;
        	//background-color:#cccccc;
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
       		height:200px;
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




	include "./sales.php";
		
	$body = _skin_emptybody($skin_name);
	$body = str_replace("</head>",$css_tabbar."</head>",$body);
	$body = str_replace("</head>","<script src=\"/js/tabbar.js?cash=x\"></script>\n"."</head>",$body);

	$html = "

		<ul class=\"tab-menu\" id=\"tabMenu1\">
        	<li class=\"menuitem1\">google</li>
        	<li class=\"menuitem2\">facebook</li>
        	<li class=\"menuitem3\">pinterest</li>
        	<li class=\"menuitem4\">twitter</li>
        	<li class=\"menuitem5\">path</li>
        	<li class=\"menuitem6\">path1</li>
    	</ul>
  
    		
    <div class=\"tab-contents\">
         <div class=\"content\">
            content1
        </div>
        <div class=\"content\">
            content2
        </div>     
        <div class=\"content\">
            content3
        </div>
        <div class=\"content\">
            content4
        </div>
        <div class=\"content\">
            content5
        </div>
        <div class=\"content\">
            content6
        </div>
    </div>
	";

	$body = str_replace("<!--{skin_emptybody}-->",$javascript.$html,$body);
	echo $body;

		


?>