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
	include "./func/css.php";

	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$query = "select * from `site_members_black` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	
			

			$list  = "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>활성</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=150>등록일자</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>이메일</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";

				if($rows->enable) $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:balck_mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='50' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:balck_mode('enable','".$rows->Id."')\">□</a></td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=150>".$rows->regdate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>";
				$list .= "<a href='#' onclick=\"javascript:site_edit('edit','".$rows->Id."')\" >".$rows->email."</a>";
				$list .= "</td></tr></table>";
			}
			echo $list;

		} else {
			$msg = "목록이 없습니다.";
			echo $msg;
		}	
	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>