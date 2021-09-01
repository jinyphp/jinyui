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

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";


		$javascript = "<script>
			function goods_select(uid,name,prices){
				// alert(company);
				// document.trans.goodname.value = name;
				$('input:text[name=goodname]').val(name);

				// document.trans.gid.value = uid;
				$('#gid').val(uid);

				// document.trans.prices.value = prices;
				$('input:text[name=prices]').val(prices);

				popup_close();
			}
        </script>";

        // 팝업창
		$body = $javascript._skin_page($skin_name,"sales_goods_list");
		$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

		
		$goodname = _formdata("goodname");
		$query = "select * from `sales_goods` ";
		if($goodname) $query .= "where name like '%$goodname%'";
		$query .= " order by regdate desc";
		// echo $query;
		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>제품명</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>창고</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>재고</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>판매가격</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>도매가격</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매입가격</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	


				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->name."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->house."</td>";				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->stock."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_sell."')\">".$rows->prices_sell."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_b2b."')\">".$rows->prices_b2b."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_buy."')\">".$rows->prices_buy."</a></td>";

				$list .= "</tr></table>";

				$body = str_replace("{list}", $list, $body);
			}
		} else {
			$msg = "상품 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
