<?php

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


    $width = "400";

	$css_tabbar = "<style>    
        .slideshow {
            width: 400px;
            height: 400px;
            overflow: hidden;
            position: relative;
        }

        .slideshow-slides {            
            width: 100%;
            height: auto;
            position: absolute;            
        }

        .slideshow-slides .slide {       
            position: absolute;           
        }

        .slideshow-slides .slide img {   
            position: absolute;
        }


        .slideshow-nav a {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 25px;
            height: 25px;
            margin-top: -12px;
            color:#cccccc;
        }

        .slideshow-nav a.prev {
            margin-left: -200px;
            font-size:30px;
        }

        .slideshow-nav a.next {
            margin-left: 175px;
            font-size:30px;
        }

        .slideshow-nav a.disabled {
            display: none;
        }








        .slideshow-indicator a {
            background-color: rgba(0, 0, 0, 0); /* for IE9 */
            overflow: hidden;
        }

       

        .slideshow-indicator a:before {
            content: url(./images/sprites.png);
            display: inline-block;
            font-size: 0;
            line-height: 0;
        }

        .slideshow-indicator {
            bottom: 30px;
            height: 16px;
            left: 0;
            position: absolute;
            right: 0;
            text-align: center;
        }

        .slideshow-indicator a {
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-left: 3px;
            margin-right: 3px;
        }

        .slideshow-indicator a.active {
            cursor: default;
        }

        .slideshow-indicator a:before {
            margin-left: -110px;
        }

        .slideshow-indicator a.active:before {
            margin-left: -130px;
        }

    </style>";


		
	$body = _skin_emptybody($skin_name);
	$body = str_replace("</head>",$css_tabbar."</head>",$body);
    $body = str_replace("</head>","<script src=\"./js/jquery-ui-1.10.3.custom.min.js\"></script>\n"."</head>",$body);
	$body = str_replace("</head>","<script src=\"slide.js\"></script>\n"."</head>",$body);


    $html ="<div class=\"slideshow\">
        <div class=\"slideshow-slides\">
            <a href=\"#\" class=\"slide\" id=\"slide-1\"><img src=\"http://www.saleshosting.co.kr/images/images1-2.jpg\" width=\"400\"></a>
            <a href=\"#\" class=\"slide\" id=\"slide-2\"><img src=\"http://www.saleshosting.co.kr/images/images1-169.jpg\" width=\"400\"></a>
            <a href=\"#\" class=\"slide\" id=\"slide-3\"><img src=\"http://www.saleshosting.co.kr/images/images1-170.jpg\" width=\"400\"></a>
        </div>

        <div class=\"slideshow-nav\">
            <a href=\"#\" class=\"prev\"><i class=\"fa fa-chevron-left\"></i></a>
            <a href=\"#\" class=\"next\"><i class=\"fa fa-chevron-right\"></i></i></a>
        </div>

        <div class=\"slideshow-indicator\"></div>
    </div>";


 

        

	$body = str_replace("<!--{skin_emptybody}-->",$html,$body);
	echo $body;

		


?>