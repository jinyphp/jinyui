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
	include "./func/butten.php";
	include "./func/css.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$body = _skin_page($skin_name,"site_board_list");

		$button ="<input type='button' value='NEW' onclick=\"javascript:list_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$query = "select * from `site_boardlist` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
				$list .= "<td style='font-size:12px;padding:10px;' width=100><a href='#' onclick=\"javascript:list_edit('edit','".$rows->Id."')\" >".$rows->code."</a></td>";
				$list .= "<td style='font-size:12px;padding:10px;' width=100><a href='#' onclick=\"javascript:board_list('".$rows->Id."')\" >".$rows->title."</a></td>";
				$list .= "</tr></table>";
			}
			// echo $list;
			$body = str_replace("{board_list}",$list,$body);
		} else {
			$msg = "목록이 없습니다.";
			// echo $msg;
			$body = str_replace("{board_list}",$msg,$body);
		}	

		echo $body;
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}
	


?>
