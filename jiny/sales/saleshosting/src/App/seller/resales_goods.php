<?

    //*  WebLib V1.5
    //*  Program by : hojin lee
    //*  
    //*
    // update : 2016.01.04 = 코드정리 

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

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";

		$javascript = "<script>	
		</script>";

        $body = _skin_emptybody($skin_name);

        $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        $body = str_replace("<!--{skin_emptybody}-->","
            <script>"._javascript_ajax_html("#mainbody","/ajax_resales_goods.php?ajaxkey=".$ajaxkey)."</script>",$body);

        echo $body;
	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
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