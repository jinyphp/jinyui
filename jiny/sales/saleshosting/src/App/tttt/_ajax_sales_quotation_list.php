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

		$javascript = "<script>
    	</script>"; 

    	$mode = _formmode();
    	$trans = _formdata("trans");
    	$business = _formdata("business");
    	$transdate = _formdata("transdate");
    	$company_id = _formdata("company_id");
    	$company_search= _formdata("company_search");


    	//echo "mode = $mode <br>";
    	///////////////////////////////////////
		//# 선택 전표 삭제
		if($mode == "delete"){
			$TID = $_POST['TID'];
    		for($i=0;$i<count($TID);$i++){
    			
    			$query = "select * from `sales_quotation_data` where Id = '$TID[$i]'";
				if($rows = _sales_query_rows($query)){
	
    				// 삭제 쿼리 전송
    				$query1 = "DELETE FROM `sales_quotation_data` WHERE `Id`='$TID[$i]'";
					_sales_query($query1);
				}
    		}
		} 


    	$query = "select * from sales_quotation_data where quotation = '".$_SESSION['quotation_data']."' "; //판매 전표출력    	
		$query .= " order by transdate desc, Id desc";	

		// echo $query."<br>";
		
		if($rowss = _sales_query_rowss($query)){
			$list = "";
			$total_d = 0;
			$vat_d = 0;
			$discount_d = 0;
			$payment_d = 0;

			$total_m = 0;
			$vat_m = 0;
			$discount_m = 0;
			$payment_m = 0;

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$trans_day = substr($rows->transdate,8,2);
				$form_day = "<input type='text' name='day' value='$trans_day' style=\"$css_textbox\">";

				// 다아월 내역 정리				
				$total_m += $rows->total;
				$vat_m += $rows->vat;
				$discount_m += $rows->discount;
				$payment_m += $rows->paid;
			
				$trans_tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				// 결제 완료된 전표는 , 합계금액 가로줄 표시 
				if($rows->pay) $rows_total = "<span style=\"text-decoration:line-through;\">".$rows->total."</span>";
				else $rows_total = $rows->total;

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
				<tr>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"25\">$trans_tid</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' > ".$rows->goodname." </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> ".$rows->spec."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> ".$rows->num."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$rows->prices."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$rows->sum."   </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$rows->vat."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$rows->discount."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"80\"> ".$rows_total."  </td>
					<td style='font-size:12px;padding:10px;' width='40'>".$rows->status."</td>
				</tr>
				</table>";		

			}
			echo $javascript.$list;	

			echo "<script>
				$('#total_m').html(\"$total_m\");
				$('#vat_m').html(\"$vat_m\");
				$('#discount_m').html(\"$discount_m\");
				$('#payment_m').html(\"$payment_m\");				
			</script>";

		} else {
			echo "견적 내역이 없습니다.";
		}



		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>