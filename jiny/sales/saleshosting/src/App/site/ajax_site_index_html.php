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
	

	// echo "index goods";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$query = "select * from `site_block` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>";
				$list .= "<a href='#' onclick=\"javascript:block_edit('edit','".$rows->Id."')\" >{block_".$rows->code."}</a><br>";
				$list .= "</td>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=200>".$rows->title."</td>
				</tr></table>";
			}
			echo $list;

		} else {
			$msg = " 목록이 없습니다.";
			echo $msg;
		}	
	
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	
?>