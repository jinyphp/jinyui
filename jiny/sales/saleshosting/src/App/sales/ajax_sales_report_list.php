<?

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");
		
		//echo "report";
	
		// 거래처 선택 조건 Query
		$query = "select * from `sales_company` ";
		if($company_id = _formdata("company_id")){
			$company=explode(";", $company_id);
			$query .= "where ";
			for($i=0;$i<count($company)-1;$i++){
				$query .= "Id='".$company[$i]."' or ";
			}
			$query .= ";";
			$query = str_replace("or ;","",$query);
		} else if($company_search= _formdata("company_search")){
			if($company) $query .= "where company like '%$company_search%' ;";
		} 
		//echo $query."<br>";
		
		// 선택 거래처 목록 
		if($company_rowss = _sales_query_rowss($query)){
			for($i=0;$i<count($company_rowss);$i++){
				$company_rows = $company_rowss[$i];
				// 거래처별 내역 표시 
				$list .= "<br>".$company_rows->company."<br>";

				// 거래 전표 Query
				$query1 = "select * from sales_trans where company_id = '".$company_rows->Id."' ";

				$start = _formdata("start");
    			$end = _formdata("end");
    			$query1 .= "and transdate >= '$start' and transdate <= '$end' ";

    			if($business = _formdata("business")) $query1 .= "and business = '$business' ";

    			$trans = _formdata("trans");
    			if($trans == "all"){

    			} else if($trans == "buysell"){
    				$query1 .= "and ( trans = 'buy' or trans = 'sell' ) ";

    			} else if($trans == "buy"){
    				$query1 .= "and trans = 'buy' ";

    			} else if($trans == "sell"){
    				$query1 .= "and trans = 'sell' ";

    			} else if($trans == "sell_paid"){
    				$query1 .= "and trans = 'sell_paid' ";
    	
    			} else if($trans == "buy_paid"){
    				$query1 .= "and trans = 'buy_paid' ";

    			} else if($trans == "paid"){
    				$query1 .= "and ( trans = 'buy_paid' or trans = 'sell_paid' ) ";
		
    			} 

    			$query1 .= " order by transdate desc, Id desc";	

    			//echo $query1."<br>";

    			// Report Header
    			$table_css = "background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;";
    			$table_data[0] = array('width' => 100, 'value' => "일자",'css' => $table_css);
				$table_data[1] = array('width' => 40, 'value' => "구분",'css' => $table_css);
				$table_data[2] = array('width' => NULL, 'value' => "거래명",'css' => $table_css);
				$table_data[3] = array('width' => 50, 'value' => "스팩",'css' => $table_css);
				$table_data[4] = array('width' => 50, 'value' => "수량",'css' => $table_css);
				$table_data[5] = array('width' => 50, 'value' => "단가",'css' => $table_css);
				$table_data[6] = array('width' => 50, 'value' => "합계",'css' => $table_css);
				$table_data[7] = array('width' => 50, 'value' => "부가세",'css' => $table_css);
				$table_data[8] = array('width' => 50, 'value' => "할인액",'css' => $table_css);
				$table_data[9] = array('width' => 80, 'value' => "금액",'css' => $table_css);
				$table_data[10] = array('width' => 80, 'value' => "잔액",'css' => $table_css);

				$list .= _table_array($table_data);

				/*
    			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border:1px solid #D2D2D2;'>
				<tr>
					<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"100\">일자</td>";
				$list .= "<td style='background-color:#DEDEDF;border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"40\"> 구분</td>
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
				*/


				$total_d = 0;
				$vat_d = 0;
				$discount_d = 0;
				$payment_d = 0;

				$total_m = 0;
				$vat_m = 0;
				$discount_m = 0;
				$payment_m = 0;


				if($rowss = _sales_query_rowss($query1)){
			
					

					for($k=0;$k<count($rowss);$k++){
						$rows = $rowss[$k];

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

						if($rows->trans == "sell") $transType = "매출";
						else if($rows->trans == "sell_paid") $transType = "입금";
						else if($rows->trans == "buy") $transType = "매입";
						else if($rows->trans == "buy_paid") $transType = "출금";

						$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
							<tr>
							<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"100\">".$rows->transdate."</td>";

						$list .= "<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"40\">".$transType."</td>
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

					
			
			

				} else {
					//$list .= "전표 내역이 없습니다.<br>";
				}

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border:1px solid #D2D2D2;'>
						<tr>
						<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' > *** 소계 ***</td>
						<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> $total_m </td>
						<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> $vat_m </td>
						<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> $discount_m </td>
						<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"80\"> $total_m </td>
						<td style='font-size:12px;padding:5px;' width='80'> ".$company_rows->balance_sell." </td>
					</tr>
					</table>";


				///////////////////

			}
		}

		echo $javascript.$list;	
	

		/*

		$javascript = "<script>

    	</script>"; 

    	$mode = _formmode();
    	

    	

    	// 거래처 선택시 
    	$company_id = _formdata("company_id");
    	$company_search= _formdata("company_search");
    	if($company_id) $query .= " and  "; // UIDB : 상대방 매출처 	

    	
    	*/


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
		/*
		


		

		// echo $query."<br>";
		

*/

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>