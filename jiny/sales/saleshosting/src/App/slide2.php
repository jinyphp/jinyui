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

    /*

    $width = "400";

	$css_imagesbar = "<style>    
        ul.images_navtab {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul.images_navtab:after {
            content:\"\";
            display:block;
            clear:both;
        }

        ul.images_navtab li {
            float: left;
            cursor: pointer;
            padding:5px;    
        }

        ul.images_navtab li.active {
            //background: #FFFFFF;
            //border-bottom: 1px solid #FFFFFF;
        }

        .images_container {
            clear: both;
            float: left;
            width: 100%;
            background: #FFFFFF;
        }

        .images_content {
            //padding: 5px;
            //font-size: 12px;
            display: none;
        }

        .images_container .images_content ul {
            width:100%;
            margin:0px;
            padding:0px;
        }

        .images_container .images_content ul li {
            //padding:5px;
            //list-style:none;
        }



    </style>";

    $javascript = "<script>
        // images BAR 처리       
        $(function () {

            $(\".images_content\").hide();
            $(\".images_content:first\").show();

            $(\"ul.images_navtab li\").click(function () {
                $(\"ul.images_navtab li\").removeClass(\"active\").css(\"color\", \"#333\");
                //$(this).addClass(\"active\").css({\"color\": \"darkred\",\"font-weight\": \"bolder\"});
                $(this).addClass(\"active\").css(\"color\", \"darkred\");
                $(\".images_content\").hide()
                var activeimages = $(this).attr(\"rel\");
                $(\"#\" + activeimages).fadeIn();
            });




        });
    </script>";
	*/

	$body = _skin_emptybody($skin_name);
	//$body = str_replace("</head>",$css_imagesbar."</head>",$body);
    //$body = str_replace("</head>","<script src=\"./js/jquery-ui-1.10.3.custom.min.js\"></script>\n"."</head>",$body);
	// $body = str_replace("</head>","<script src=\"slide.js\"></script>\n"."</head>",$body);


    $html ="
        <div id=\"goods_container\">
           
            <div class=\"images_container\">
                <div id=\"images1\" class=\"images_content\">
                    
                    <img src=\"http://www.saleshosting.co.kr/images/images1-2.jpg\" width=\"400\">                                                                                                          
                </div>

                <div id=\"images2\" class=\"images_content\">
                 
                    <img src=\"http://www.saleshosting.co.kr/images/images1-169.jpg\" width=\"400\">                                                                                                          
                </div>

                <div id=\"images3\" class=\"images_content\">
                    
                    <img src=\"http://www.saleshosting.co.kr/images/images1-170.jpg\" width=\"400\">                                                                                                          
                </div>

            </div>

            <ul class=\"images_navtab\">
                <li class=\"active\" rel=\"images1\"><img src=\"http://www.saleshosting.co.kr/images/images1-2.jpg\" width=\"40\"></li>
                <li rel=\"images2\"><img src=\"http://www.saleshosting.co.kr/images/images1-169.jpg\" width=\"40\"></li>
                <li rel=\"images3\"><img src=\"http://www.saleshosting.co.kr/images/images1-170.jpg\" width=\"40\"></li>
            </ul>

        </div>";


	$body = str_replace("<!--{skin_emptybody}-->",$html,$body);
	echo $body;

		


?>