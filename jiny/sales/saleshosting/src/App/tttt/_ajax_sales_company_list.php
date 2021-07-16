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
			function company_select(uid,company,tax,currency){
				//alert(company);
				// var company_id = document.getElementsByName('company_id');
				// company_id.value = uid;
				$('#company_id').val(uid);

				//var company_search = document.getElementsByName('company_search');
				//company_search.value = company;
				$('input:text[name=company_search]').val(company);


				// var company_tax = document.getElementsByName('tax');
				// company_tax.value = tax;
				$('input:hidden[name=tax]').val(tax);

				// document.trans.company_search.value = company;
				// document.trans.company_id.value = uid;				

				//document.trans.tax.value = tax;
				$('#tax').html(tax);
				$('#currency').html(currency);
				popup_close();
			}
        </script>";

        // 팝업창
		$body = $javascript._skin_page($skin_name,"sales_company_list");
		$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

		
		$company = _formdata("company_search");
		$query = "select * from `sales_company` ";
		if($company) $query .= "where company like '%$company%'";
		$query .= " order by regdate desc";
		// echo $query;
		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>거래처</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>대표자</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>연락처</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>부가세율</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>통화</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매출액</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매입액</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	

				if($rows->inout == "sell") $comtype = "←";
				else if($rows->inout == "buy") $comtype = "→";
				else if($rows->inout == "buysell") $comtype = "↔";
				else if($rows->inout == "personal") $comtype = "☺";

				if($rows->vat) $tax = $rows->vatrate; else $tax = 0;

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
								$comtype  <a href='#' onclick=\"javascript:company_select('".$rows->Id."','".$rows->company."','".$tax."','".$rows->currency."')\">".$rows->company."</a> $master_link $auth</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->president."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->vatrate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->currency."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_sell.php?company_id=".$rows->Id."'>".$rows->balance1."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_buy.php?company_id=".$rows->Id."'>".$rows->balance2."</a></td>";
				
				$list .= "</tr></table>";

				$body = str_replace("{list}", $list, $body);
			}
		} else {
			$msg = "거래처 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
