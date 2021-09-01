<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*



	// update : 2016.01.11 = 코드정리 

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

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		$body =  _skin_emptybody($skin_name);
		$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$javascript = "<script>"._javascript_ajax_html("#mainbody","/ajax_site_block.php?ajaxkey=$ajaxkey")."</script>";	
		$body = str_replace("<!--{skin_emptybody}-->",$javascript,$body);
		echo $body;

		/*
		$skin_name = "default";
		$body = _skin_body("default","site_block");
		// $body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

		$body .= "<script>

				function block_edit(mode,uid){
                  	$.ajax({
                        url:'/ajax_site_block_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
                }
                
                function blocklist(limit){
                	var url = \"/ajax_site_block.php?limit=\"+limit;
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
                  }
                  </script>";

		
		// $body = str_replace("</head>","<script src=\"/js/wish.js?cashing=".microtime()."\"></script></head>",$body); 
		// $body_skin = "<script src=\"/js/wish.js\"></script>".$body_skin; 

		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 	
		$body = str_replace("{block_list}","
					<form name='block' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>
					<span id=\"page_list\">
					
					<script>
						$.ajax({
            				url:'/ajax_site_block.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('.mainbody').html(data);
            				}
        				});
    				</script>

					</span>
					</form>",$body);

		echo $body;
		*/

	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php")."</script>";	
		$body =  _skin_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

		


?>