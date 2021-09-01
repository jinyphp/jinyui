<?php
    //*  WebLib V1.5
    //*  Program by : hojin lee
    //*  
    //*
    // update : 2016.01.08 = 코드정리 

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

    include "./func/site.php";  // 사이트 환경 설정

    include "./func/layout.php";
    include "./func/header.php";
    include "./func/footer.php";
    include "./func/menu.php";
    include "./func/category.php";
    include "./func/skin.php";

    include "./func/members.php";
    include "./func/css.php";
    include "./func/curl.php";


	if(isset($_COOKIE['cookie_email'])){

		
		$javascript = "<script>	
		</script>";

        $body = _skin_emptybody($skin_name);

        $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        $body = str_replace("<!--{skin_emptybody}-->","
            <center><img src='./images/loading.gif' border='0'></center>
            <script>"._javascript_ajax_html("#mainbody","/ajax_myinfo.php?ajaxkey=".$ajaxkey)."</script>",$body);

        echo $body;
	
	} else {
		// 관심상품 로그인 
		// $body = str_replace("{wish_list}","로그인이 필요합니다.",$body);
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




?>