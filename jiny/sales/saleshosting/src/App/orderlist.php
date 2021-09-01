<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*

	// update : 2016.01.11 = 코드정리 
	// update : 2016.01.20 = 회원정보 및 포인트 정보 표시  

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

	include "./func/members.php";
	
	$javascript = "<script>
		function orders_edit(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_orders_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);
                        }
                    }); 	
        }
                
        function orders_list(limit,status){
            var search = document.members.searchkey.value;
            $.ajax({
                        url:'/ajax_orderlist.php?limit='+limit+'&search='+search+'&status='+status,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);
                        }
            }); 	
        }
    </script>";

	if(isset($_COOKIE['cookie_email'])){
		
		// _theme_page($site_env->theme,"orderlist",$site_language,$site_mobile); //
		$body = $javascript._theme_body($site_env->theme,"orderlist",$site_language,$site_mobile);
		
		$body = str_replace("</head>","<script src=\"/js/orderlist.js?cashing=".microtime()."\"></script></head>",$body); 

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);
		
		$body = str_replace("{member_name}",$members->username." ".$members->firstname,$body);
		$body = str_replace("{member_email}",$members->email,$body);

		$body = str_replace("{members_emoney}",$members->emoney,$body);
		$body = str_replace("{members_point}",$members->point,$body);
		
		

		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 	
		$body = str_replace("{order_list}","
					<form name='order' method='post' enctype='multipart/form-data' >
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>
					   <input type='hidden' name='mode' >
					<span id=\"order_list\">
					
					<center><img src='./images/loading.gif' border='0'></center>

					<script>
						$.ajax({
            				url:'/ajax_orderlist.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#order_list').html(data);
            				}
        				});
    				</script>

					</span>
					</form>",$body);


		// 블럭코드 전처리기 코드를 처리하여, 상품을 진열함
		// 블럭리스트 출력, Body {blocklist_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "block_";
		if($keyword_count = _keyword_count($body, "{".$keyword)){
			$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_blocklist.php?code=$rows[$i]")."</script>
					</article>\n",$body);
			}
		}

		echo $body;
	
	} else {
		// 로그인 
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")."</script>";	
		$body =  _skin_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

?>