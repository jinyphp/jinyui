<?

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

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		$query = "select * from `shop_cate` order by pos desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='2' cellspacing='2' width='100%'><tr>";
				
				if($rows->enable) $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:cate_mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:cate_mode('enable','".$rows->Id."')\">□</a></td>";
					
				//*** 트리모양 만들기
				if($rows->level == 0) {
					$query1 = "select * from `shop_cate` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
								
				} else {
					$query1 = "select * from `shop_cate` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth = "┃"; else $depth = "&#4515;";

					for($k=0;$k<$rows->level;$k++) $depth .= "&#4515;";
						
					$query1 = "select * from `shop_cate` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
				}
			
				$list .= "<td id=\"table_td\"> $depth <a href='#' onclick=\"javascript:cate_edit('sub','".$rows->Id."')\" >+</a>";
				$list .= "<a href='#' onclick=\"javascript:cate_mode('up','".$rows->Id."')\">▲</a>";
				$list .= "<a href='#' onclick=\"javascript:cate_mode('down','".$rows->Id."')\">▼</a>";
				$list .= "<a href='#' onclick=\"javascript:cate_edit('edit','".$rows->Id."')\" >".$rows->name."</a> ".$rows->url."</td>";

				$list .= "<td width='150' id=\"table_td\"> ".$rows->tree."</td>";
				/*
				
				$list .= "<td width='80' id=\"table_td\"> LEVEL: ".$rows->level."</td>";
				$list .= "<td width='80' id=\"table_td\"> REF: ".$rows->ref."</td>";
				*/
				$list .= "<td width='80' id=\"table_td\"> POS: ".$rows->pos."</td>";
				
				$list .= "</tr></table>";
				
			}
			echo $list;

		} else {
			$msg = "카테고리가 없습니다.";
			echo $msg;
		}	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>