<?php

	@session_start();

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

    include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");   // 사이트 환경 설정
        
    include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
    include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

    // 환경설정 
    include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
    include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");


    if(isset($_COOKIE['cookie_email'])){
        
        $body = _theme_emptybody();
        //$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body);
    
        $limit = _formdata("limit");
        $search = _formdata("searchkey");
        $theme = _formdata("theme");
        $list_num = _formdata("list_num");
    
        // Form and Ajax Process
        $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        $body = str_replace("<!--{skin_emptybody}-->","
                    <center><img src='../images/loading.gif' border='0'></center>
                    <form name='goods' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='ajaxkey' value='$ajaxkey'>
                        <input type='hidden' name='limit' value='$limit'>
                        <input type='hidden' name='searchkey' value='$search'>
                        <input type='hidden' name='theme' value='$theme'>
                        <input type='hidden' name='list_num' value='$list_num'>
                        <script>"._javascript_ajax_html("#mainbody","ajax_site_boardlist.php")."</script>               
                    </form>",$body);
        echo $body;

    } else {
        // 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
        $login_script = "<script>"._javascript_ajax_html("#mainbody",$path_ajax_login)."</script>"; 
        $body =  _theme_emptybody($skin_name);
        $body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
        echo $body;
    }

/*
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/css.php";
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

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";
		
		$body = _skin_body($skin_name,"site_boardlist");
		$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 

		$script = "
				<script>
				function list_edit(mode,uid){
                  	var url = \"/ajax_site_boardlist_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }

                function board_list(board){
                  	var url = \"/ajax_site_board.php?board=\"+board;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }


                function board_edit(mode,board,uid){
                  	var url = \"/ajax_site_board_edit.php?board=\"+board+\"&mode=\"+mode+\"&uid=\"+uid;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }

       

				function form_submit(mode,uid){
					var url = \"/ajax_site_boardlist_editup.php?mode=\"+mode+\"&uid=\"+uid;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});					
				}

				function form_board_submit(mode,board,uid){
					var url = \"/ajax_site_board_editup.php?mode=\"+mode+\"&uid=\"+uid+\"&board=\"+board;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});					
				}
				</script>";

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}",$script."<form id='data' name='board' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $button ="<input type='button' value='NEW' onclick=\"javascript:list_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		// $body = str_replace("{new}",$button,$body);

		// 최대 사이트 운영 갯수를 지정
		$body = str_replace("{site_num}",$sales_db->site,$body);

		// Form and Ajax Process
		$body = str_replace("{board_list}","
					<span id=\"site_list\">

					<script>
						$.ajax({
            				url:'/ajax_site_boardlist.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#site_list').html(data);
            				}
        				});
    				</script>

					</span>",$body);
		
		$body = str_replace("{edit}","<span id=\"site_edit\"></span>",$body);	
		
		echo $body;
	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$skin_name = "default";
		$body = _skin_body("default","login");
		
		$login_script = "<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
		</script>";  



		echo $body.$login_script;
	}

    */



?>