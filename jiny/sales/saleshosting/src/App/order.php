<?php
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

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

	if(isset($_COOKIE['cookie_email'])){
		$skin_name = "default";
		$body = _skin_body("default","order");
		
		$body = str_replace("</head>","<script src=\"/js/order.js?cashing=".microtime()."\"></script></head>",$body); 
		// $body_skin = "<script src=\"/js/wish.js\"></script>".$body_skin; 

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