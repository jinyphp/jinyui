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

	include "./func/error.php";
	
	include "./func/datetime.php";
	
	include "./func/orders.php";
	include "./func/butten.php";

	include "./func/css.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	/////////////
		
	function _listbar($_list_num,$_block_num,$limit,$total){


	}



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$body = _skin_page($skin_name,"sales_bank");

		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 

		$ajaxkey = _formdata("ajaxkey");


		///////////////////
		// 상품 목록을 검색
		$query = "select * from `shop_bank` ";
		$query .= "order by Id desc ";
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0,$list ="";$i<$count;$i++){
				$rows = $rowss[$i];
			
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";

				if($rows->enable) $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:bank_mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:bank_mode('enable','".$rows->Id."')\">□</a></td>";
					

				//$title_name = "<a href='#' onclick=\"javascript:page_edit('edit','".$rows->Id."')\">".$rows->title."</a>";
				$title_name = "<a href='#' onclick=\"javascript:bank_edit('edit','".$rows->Id."')\">".$rows->bankname."</a>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->country."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->banknum."</td>
							</tr>
						</table>";				


			}
			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			// $body = str_replace("{bank_list}",$list,$body);
			// echo $body;
			echo $list;
		} else {
			$msg = "은행 목록이 없습니다.";
			// $body = str_replace("{bank_list}",$msg,$body);
			// echo $body;
			echo $msg;
		}	

	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>