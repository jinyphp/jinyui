<?

	@session_start();
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		include "./conf/dbinfo.php";
		include "./func/mysql.php";

		include "./func/file.php";
		include "./func/form.php";
		include "./func/skin.php";
		include "./func/datetime.php";
		include "./func/goods.php";
		include "./func/orders.php";
		include "./func/butten.php";
	
		// Sales 사용자 DB 접근.
		include "./sales.php";

		
		if(isset($_SESSION['language'])){
			$site_language = $_SESSION['language'];
		} else {
			$site_language = "ko";
		}


		// 장바구니 섹션 존재 유무를 검사.
		if(isset($_SESSION['cartlog'])){
			$cartlog = $_SESSION['cartlog'];
		} else {
			$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
			$_SESSION['cartlog'] = $cartlog;			
		}

		if(isset($_COOKIE['cookie_email'])){
			$cookie_email = $_COOKIE['cookie_email'];
		} else {
			$cookie_email = "";
		}

		/////////////
		$skin_name = "default";
		$body = _skin_page("default","shop_menu_edit");
		


		echo $body;
	} else {
			$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
			echo $msg;
	}

	
?>