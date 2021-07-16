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

	/////////////



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$javascript = "<script>

    	</script>"; 

    	$mode = _formmode();
    	

    	$query = "select * from sales_trans ";

    	$business = _formdata("business");
    	$query .= "where business = '$business' ";

    	$start = _formdata("start");
    	$end = _formdata("end");
    	$query .= "and transdate >= '$start' and transdate <= '$end' ";

    	// 거래처 선택시 
    	$company_id = _formdata("company_id");
    	$company_search= _formdata("company_search");
    	if($company_id) $query .= " and company_id = '$company_id' "; // UIDB : 상대방 매출처 	

    	$trans = _formdata("trans");
    	if($trans == "all"){

    	} else if($trans == "buysell"){
    		$query .= "and ( trans = 'buy' or trans = 'sell' ) ";

    	} else if($trans == "buy"){
    		$query .= "and trans = 'buy' ";

    	} else if($trans == "sell"){
    		$query .= "and trans = 'sell' ";

    	} else if($trans == "sell_paid"){
    		$query .= "and trans = 'sell_paid' ";
    	
    	} else if($trans == "buy_paid"){
    		$query .= "and trans = 'buy_paid' ";

    	} else if($trans == "paid"){
    		$query .= "and ( trans = 'buy_paid' or trans = 'sell_paid' ) ";
		
    	} 

    	/*
    	$query .= "where trans = '$trans' and business = '$business' "; //판매 전표출력
		if($transdate){
		    //# 지정날짜 해당월
		    $start = substr($transdate,0,4)."-".substr($transdate,5,2)."-01";
		    $end = substr($transdate,0,4)."-".substr($transdate,5,2)."-31";
		    $query .= "and transdate >= '$start' and transdate <= '$end' ";
		} else {
		    //# 지정날짜가 없는경우, 이번달 xx.01 ~ xx.31 까지 자료 검색
		    $start = substr($TODAY,0,4)."-".substr($TODAY,5,2)."-01";
		    $end = substr($TODAY,0,4)."-".substr($TODAY,5,2)."-31";
		    $query .= "and transdate >= '$start' and transdate <= '$end' ";
		}
		    
		
		// $query .= " and auth IS NOT NULL "; // 승인된 자료만 표시 	    	
		*/
		$query .= " order by transdate desc, Id desc";	


		echo "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border:1px solid #D2D2D2;'>
				<tr>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"100\">일자</td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"40\"> 구분</td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' > 거래명 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 스팩 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 수량 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 단가 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 합계 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 부가세 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> 할인액 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"80\"> 금액 </td>
					<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' width='80'> 잔액 </td>
				</tr>
				</table>";

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
				
				// 당일 거래 정리 
				if($trans_day == substr($TODAYTIME,8,2)){
					$total_d += $rows->total;
					$vat_d += $rows->vat;
					$discount_d += $rows->discount;
					$payment_d += $rows->paid;
				}

				// 결제 완료된 전표는 , 합계금액 가로줄 표시 
				if($rows->pay) $rows_total = "<span style=\"text-decoration:line-through;\">".$rows->total."</span>";
				else $rows_total = $rows->total;

				if($trans == "sell") $balance = $rows->balance_sell; 
				else if($trans == "buy") $balance = $rows->balance_buy;
				else if($trans == "buysell") $balance = $rows->balance_sell - $rows->balance_buy;


				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
				<tr>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"100\">".$rows->transdate."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"40\">".$rows->trans."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' >".$rows->goodname."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\">".$rows->spec."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\">".$rows->num."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\">".$rows->prices."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\">".$rows->sum."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\">".$rows->vat."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\">".$rows->discount."</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"80\">".$rows->total."</td>
					<td style='font-size:12px;padding:5px;' width='80'>".$rows->balance_sell."</td>
				</tr>
				</table>";
			

		

			}
			echo $javascript.$list;	


		} else {
			echo "전표 내역이 없습니다.";
		}



		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>