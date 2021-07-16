<?

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	include "./func/skin.php";
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";


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



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		// include "./sales.php";

		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		$query = "select * from `site_menu` order by pos desc";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='2' cellspacing='2' width='100%'><tr>";
				
				if($rows->enable) $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:menu_mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:menu_mode('enable','".$rows->Id."')\">□</a></td>";
					
				//*** 트리모양 만들기
				if($rows->level == 0) {
					$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
								
				} else {
					$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth = "┃"; else $depth = "&#4515;";

					for($k=0;$k<$rows->level;$k++) $depth .= "&#4515;";
						
					$query1 = "select * from `site_menu` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
				}
			
				$list .= "<td id=\"table_td\"> $depth <a href='#' onclick=\"javascript:menu_edit('sub','".$rows->Id."')\" >+</a>";
				$list .= "<a href='#' onclick=\"javascript:menu_mode('up','".$rows->Id."')\">▲</a>";
				$list .= "<a href='#' onclick=\"javascript:menu_mode('down','".$rows->Id."')\">▼</a>";
				$list .= "<a href='#' onclick=\"javascript:menu_edit('edit','".$rows->Id."')\" >".$rows->name."</a> ".$rows->url."</td>";

				$list .= "<td width='50' id=\"table_td\"> ".$rows->tree."</td>";
				/*
				
				$list .= "<td width='80' id=\"table_td\"> LEVEL: ".$rows->level."</td>";
				$list .= "<td width='80' id=\"table_td\"> REF: ".$rows->ref."</td>";
				*/
				$list .= "<td width='50' id=\"table_td\"> POS: ".$rows->pos."</td>";
				
				$list .= "</tr></table>";
				
			}
			echo $list;

		} else {
			$msg = "메뉴가 없습니다.";
			echo $msg;
		}	
		
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>