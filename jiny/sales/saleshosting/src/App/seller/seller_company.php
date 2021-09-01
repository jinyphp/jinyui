<?

    //*  WebLib V1.5
    //*  Program by : hojin lee
    //*  
    //*
    // update : 2016.01.04 = 코드정리 

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

    include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	// ================
	// 쇼핑몰 주문 확인 처리
	// ================	

	if(isset($_COOKIE['cookie_email'])){

		// Sales 사용자 DB 접근.
        include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

        $body = _skin_emptybody($skin_name);

        $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        $body = str_replace("<!--{skin_emptybody}-->","
            <script>"._javascript_ajax_html("#mainbody","ajax_seller_company.php?ajaxkey=".$ajaxkey)."</script>",$body);

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