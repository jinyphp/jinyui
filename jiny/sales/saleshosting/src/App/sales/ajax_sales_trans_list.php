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
	include ($_SERVER['DOCUMENT_ROOT']."/func/currency.php");

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

	$javascript = "<script>
		$('#_num').on('keyup',function(e){ 
			alert(\"num\");
    	});

    	// 전표 수정
		function edit(uid){
			var url = \"ajax_sales_trans_edit.php?uid=\"+uid;
			popup_ajax(url);
		}

		// 팝업창: 전표전송 취소
		function export_cancel(uid){
			// alert(uid);
			var url = \"ajax_sales_trans_export.php?uid=\" + uid + \"&mode=export_cancel\";
			popup_ajax(url);
		}

		// 팝업창: 전표승인 취소
		function import_cancel(uid){
			var url = \"ajax_sales_trans_export.php?uid=\" + uid + \"&mode=import_cancel\";
			// alert(url);
			popup_ajax(url);
		}
			
    </script>"; 

	// 지정한 날자의 01월을 리턴함
	function _startMonthDay($transdate){
		if($transdate){
			$start = substr($transdate,0,4)."-".substr($transdate,5,2)."-01";
		} else {
			//# 지정날짜가 없는경우, 이번달 xx.01 ~ xx.31 까지 자료 검색
	    	$start = substr($TODAY,0,4)."-".substr($TODAY,5,2)."-01";
		}
		return $start;			
	}

	function _endMonthDay($transdate){
		if($transdate){
			$end = substr($transdate,0,4)."-".substr($transdate,5,2)."-31";
		} else {
			//# 지정날짜가 없는경우, 이번달 xx.01 ~ xx.31 까지 자료 검색
			$end = substr($TODAY,0,4)."-".substr($TODAY,5,2)."-31";
		}
		return $end;			
	}

	function _trans_goodsname($rows){
		

		// 상품명 처리 
		if($rows->goodname) $goodname = $rows->goodname; else $goodname = "상품명이 없습니다.";

		if($rows->export == "on"){				
			if($rows->import == "on"){
				// Export한 자료를 상대방이 import승인
				$goodname .= "&nbsp; <i class=\"fa fa-link\"></i> &nbsp; <i class=\"fa fa-sign-in\"></i> "; 
			} else {
				// Export 전송된 전표
				$goodname .= "&nbsp; 
							  <a href='#' onclick=\"javascript:export_cancel('".$rows->Id."')\" title='Export 취소' > 
								<i class=\"fa fa-chain-broken\"></i>
							  </a> &nbsp; <i class=\"fa fa-sign-out\"></i>"; 
			}	

		} else {
			if($rows->import == "on"){
				// import 자료 
				$goodname .= "&nbsp;&nbsp; <i class=\"fa fa-sign-in\"></i>
								  <a href='#' onclick=\"javascript:import_cancel('".$rows->Id."')\" title='자료승인 취소' > 
									<i class=\"fa fa-link\"></i> 
								  </a>  "; 
			} else {
				if($rows->export_tid){
					// 외부에서 입력된 데이터
					if($rows->trans == "buy") {
						$goodname = "<i class=\"fa fa-sign-in\"></i>&nbsp;&nbsp;".$goodname."&nbsp;&nbsp;<i class=\"fa fa-link\"></i> ";
					} else if($rows->trans == "sell") {
						$goodname = "<i class=\"fa fa-sign-out\"></i>&nbsp;&nbsp;".$goodname."&nbsp;&nbsp;<i class=\"fa fa-link\"></i> ";
					}
				} else {
					// 미전송 전표는 수정할 수 있습니다.
					$href_alt = "미전송 전표는 수정할 수 있습니다.";
					$goodname = "<a href='#' onclick=\"javascript:edit('".$rows->Id."')\" title='$href_alt' >".$goodname."</a>";						
				}
			}
		}

		if($rows->print == "on"){
			$goodname .= "&nbsp;&nbsp;<i class=\"fa fa-print\"></i>";
		}

		return $goodname;	
	}


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 판매재고 관련 함수들...
		include "sales_function.php";

	
    	$mode = _formmode();
    	$trans = _formdata("trans");
    	$business = _formdata("business");
    	$transdate = _formdata("transdate");
    	$company_id = _formdata("company_id");
    	$company_search= _formdata("company_search");
		
		





		if($mode == "edit"){
			// ++ 거래전표를 수정합니다.
			$uid = _formdata("uid");
			if($rows = _sales_transRows_Id($uid)){

				$gid = _formdata("gid1");
				$goodname = _formdata("goodname1");

				$spec = _formdata("spec1");
				$num = _formdata("num1");
				$prices = _formdata("prices1");
				$vat = _formdata("vat1");
				$discount = _formdata("discount1");
				$sum = _formdata("sum1");
				$total = _formdata("total1");
				$transdate1 = _formdata("transdate1");

				$unpaid = $total - $rows->paid;
				if($unpaid == 0) $pay = "on"; else  $pay = ""; 

				$query1 = "UPDATE `sales_trans` SET  `transdate`= '$transdate1', `spec`= '$spec', `num`= '$num', `prices`= '$prices', `vat`= '$vat', 
								`discount`= '$discount', `sum`= '$sum', `total`= '$total', `unpaid`= '$unpaid', `pay`= '$pay' WHERE `Id`='$uid'";
				//echo $query1."<br>";
				_sales_query($query1);

				// 거래처 금액 수정 
				//$query1 = "select * from `sales_company` where Id = '".$rows->company_id."'";
				//echo $query1."<br>";
				if($company_rows = _sales_companyRows_Id($rows->company_id)){
					if($rows->trans == "sell"){
						$balance_sell = $company_rows->balance_sell - $rows->total + $total;
						$query1 = "UPDATE `sales_company` SET `balance_sell`= '$balance_sell' WHERE `Id`='$company_id'";
					} else if($rows->trans == "buy"){
						$balance_buy = $company_rows->balance_buy - $rows->total + $total;
						$query1 = "UPDATE `sales_company` SET `balance_buy`= '$balance_buy' WHERE `Id`='$company_id'";
					}
					//echo $query1."<br>";
					_sales_query($query1);
				}	



				// 재고 수량 변경
				$query1 = "select * from `sales_goods` where Id='".$rows->gid."'";
				//echo $query1."<br>";
				if($goods_rows = _sales_query_rows($query1)){
					if($rows->warehouse) $house_code = "stock_".$rows->warehouse; else $house_code = "stock";
					if($trans == "sell") {
						$stock = $goods_rows->$house_code + $rows->num - $num; 
					} else if($trans == "buy") {
						$stock = $goods_rows->$house_code - $rows->num + $num;
					}

					$query1 = "UPDATE `sales_goods` SET `$house_code`='$stock' where Id='".$rows->gid."'";
					//echo $query1."<br>";
					_sales_query($query1);
				}

			}




		} else if($mode == "delete"){
			
			//# 선택 전표 삭제
			$TID = $_POST['TID'];
    		for($i=0;$i<count($TID);$i++){
    	
				if($rows = _sales_transRows_Id($TID[$i])){
    					
    				// ++ 업체 미수금 차감     				
					if($rows1 = _sales_companyRows_Id($rows->company_id)){
						_sales_companyRows_balance($rows1, $rows->trans, "-".$rows->total);

					}
						
					//상품 재고수량 조정
					if($rows->gid){
						// ++ 창고 위치 및 입출력 수량 조절     		
    					if($trans == "sell") {
    						_sales_goodStock($rows->gid,"stock_".$rows->warehouse,$rows->num);
    			
    					} else if($trans == "buy") {
    						_sales_goodStock($rows->gid,"stock_".$rows->warehouse, "-".$rows->num);
    			
    					}
    					// echo "stock_".$rows->warehouse."<br>";

						/*
						if($rows1 = _sales_goodsRows_Id($rows->gid)){
    						if($rows->trans == "sell") $stock = $rows1->stock + $rows->num;
    						else if($rows->trans == "buy") $stock = $rows1->stock - $rows->num;

    						if($rows->warehouse) $house_code = "stock_".$rows->warehouse; else $house_code = "stock";
							$query = "UPDATE sales_goods SET `$house_code`= '$stock' WHERE `Id`='".$rows->gid."'";
							echo $query."<br>";
							_sales_query($query);
						}
						*/
					}
	
					_sales_transDelete_Id($TID[$i]);
				}
				
    		}
    		




		} else if($mode == "paynow"){

			$payment = _formdata("payment");					//echo "payment = $payment <br>";
			$paydate = _formdata("paydate");					//echo "paydate = $paydate <br>";
			$payment_manager = _formdata("payment_manager");	//echo "payment_manager  = $payment_manager  <br>";
			$money = _formdata("money");						//echo "money = $money <br>";
			$payment_memo = _formdata("pay_memo");				//echo "payment_memo = $payment_memo <br>";

			// 결체 체크 목록
			$TID = $_POST['TID1'];
			$moneys = $_POST['moneys'];

			//# 선택한 결제 전표 목록 출력.
			if($TID){
				$tid_string = "";
				for($i=0,$amount=0;$i<count($TID);$i++){
					//echo "TID = $TID[$i] , moneys = $moneys[$i]<br>";
					$query = "select * from `sales_trans` where Id = '$TID[$i]'";
					if($rows = _sales_query_rows($query)){

						// 전표상태 갱신
						$unpaid = $rows->unpaid - $moneys[$i];	// 일부결제, 미결제 잔액 
						$paid = $rows->total - $unpaid;			// 일부결제. 기 지불한 금액 
						$query = "UPDATE `sales_trans` SET `payment`='$payment', `paydate`='$paydate', 
									`paid`='$paid', `paymemo`='$payment_memo', `unpaid`='$unpaid' ";
						if($unpaid == 0) $query .= ", `pay`='on' ";
						$query .= "WHERE `Id`='$TID[$i]'";
						//echo $query."<br>";
						_sales_query($query);

						$tid_string .= $TID[$i].";";

						// $business = $rows->business;		
					}
				}

				if($money){
					if($trans == "sell") $trans_paid = "sell_paid"; else if($trans == "buy") $trans_paid = "buy_paid";
					// 신규 결제 정보, 입력 
					$query = "INSERT INTO `sales_trans` (`regdate`, `transdate`, `trans`, `company`, `company_id`, `business`,
					`payment`, `paydate`, `paid`, `paymemo`, `auth`,`TID`) 
											VALUES ('$TODAYTIME', '$paydate', '$trans_paid', '".$rows->company."', '".$rows->company_id."', '".$rows->business."', 
											'$payment', '$paydate', '$money', '$paymemo','on','".$tid_string."')";
					//echo $query."<br>";		
					_sales_query($query);
				}

				// 거래처 금액 수정 
				// $query1 = "select * from `sales_company` where Id = '".$rows->company_id."'";
				//echo $query1."<br>";
				if($company_rows = _sales_companyRows_Id($rows->company_id)){
					/*
					if($rows->trans == "sell"){
						$balance_sell = $company_rows->balance_sell - $money;
						$query1 = "UPDATE `sales_company` SET `balance_sell`= '$balance_sell' WHERE `Id`='$company_id'";
					} else if($rows->trans == "buy"){
						$balance_buy = $company_rows->balance_buy - $money;
						$query1 = "UPDATE `sales_company` SET `balance_buy`= '$balance_buy' WHERE `Id`='$company_id'";
					}
					//echo $query1."<br>";
					_sales_query($query1);
					*/

					_sales_companyRows_balance($company_rows, $rows->trans, "-".$money);
				}	
				


			}

		}

		$start = _startMonthDay($transdate);
		$end = _endMonthDay($transdate);

		// ++ 
		// ++ 거래내역을 출력합니다.
		if(!$business){
			$msg = "내역을 출력할 수 없습니다.사업자을 선택해 주세요.";
			echo _msg_tableCell( _string($msg,$site_language) );

		} else if(!$trans){
			$msg = "매입 또는 매출 전표구분이 설정되니 않았습니다.";
			echo _msg_tableCell( _string($msg,$site_language) );

		} else if(!$transdate){
			$msg = "전표 작성일자가 없습니다..";
			echo _msg_tableCell( _string($msg,$site_language) );

		} else if(!$company_id){
			$msg = "거래처가 선택되지 않았습니다. 거래처를 선택해 주세요.";
			echo _msg_tableCell( _string($msg,$site_language) );

		} else {		
			
			
			// ++ 조회 쿼리 실행
			$query = "select * from sales_trans where trans = '$trans' and business = '$business' "; //판매 전표출력
    		if($start) $query .= "and transdate >= '$start' ";
    		if($end) $query .= "and transdate <= '$end' ";  
			$query .= " and company_id = '$company_id' "; 	   	
			$query .= " order by transdate desc, Id desc";	

			if($rowss = _sales_query_rowss($query)){
			
				$total_d = 0;
				$vat_d = 0;
				$discount_d = 0;
				$payment_d = 0;

				$total_m = 0;
				$vat_m = 0;
				$discount_m = 0;
				$payment_m = 0;

				// echo "count = ".count($rowss)."<br>";
				$day = "";
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];					

					// 다아월 내역 정리				
					$total_m += $rows->total;
					$vat_m += $rows->vat;
					$discount_m += $rows->discount;
					$payment_m += $rows->paid;
				
					// 당일 거래 정리 
					$trans_day = substr($rows->transdate,8,2);
					if($trans_day == substr($TODAYTIME,8,2)){
						$total_d += $rows->total;
						$vat_d += $rows->vat;
						$discount_d += $rows->discount;
						$payment_d += $rows->paid;
					}

					$form_day = "<input type='text' name='day' value='$trans_day' style=\"$css_textbox\">";

										
					$trans_tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
					$trans_tid .= "<input type='hidden' name='pay[]' value='".$rows->pay."' >";
					$trans_tid .= "<input type='hidden' name='export[]' value='".$rows->export."' >";
					$trans_tid .= "<input type='hidden' name='import[]' value='".$rows->import."' >";

					$goodname = _trans_goodsname($rows);

					// 결제 완료된 전표는 , 합계금액 가로줄 표시 
					if($rows->pay) {
						// 100% 완전 결제
						$rows_total = "<span style=\"text-decoration:line-through;\">".$rows->total."</span>";
					} else if($rows->paid){
						// 불완전 결제, 일부분
						$rows_total = "<i class=\"fa fa-pause-circle\"></i> ".$rows->total;
					} else {
						// 미결제 
						$rows_total = $rows->total;
					}
					
					// ++ 날짜가 변경된 경우 스타일 밑줄
					if($day == $rows->transdate){
						$style = "style='font-size:12px;padding:5px;'";
					} else {
						$style = "style='border-top:1px solid #E9E9E9;font-size:12px;padding:5px;'";
					}
					$day = $rows->transdate;
					

					if($rows->discount) $_discount = _currency_format($rows->currency,$rows->discount); else $_discount = NULL;
					if($rows->vat) $_vat = _currency_format($rows->currency,$rows->vat); else $_vat = NULL;

					$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
						<tr>
							<td $style width=\"25\">$trans_tid</td>
							<td $style width=\"20\"> $trans_day </td>
							<td $style >$goodname</td>
							<td $style width=\"50\">".$rows->spec."</td>
							<td $style width=\"50\" align=\"right\">".$rows->num."</td>
							<td $style width=\"60\" align=\"right\">"._currency_format($rows->currency,$rows->prices)."</td>
							<td $style width=\"60\" align=\"right\">"._currency_format($rows->currency,$rows->sum)."</td>
							<td $style width=\"60\" align=\"right\">".$_vat."</td>
							<td $style width=\"60\" align=\"right\">".$_discount."</td>
							<td $style width=\"80\" align=\"right\">"._currency_format($rows->currency,$rows_total)."</td>
							<td $style width='40' align=\"right\">".$rows->status."</td>
						</tr>
						</table>";		

				}		


			} else {
				$msg = "전표 내역이 없습니다.";
				$list .= _msg_tableCell( _string($msg,$site_language) );
			}

			echo $javascript.$list;	

			// ++ 
			// ++ 거래처 balance를 출력함
			if($company_rows = _sales_companyRows_Id($company_id)){

				if($trans == "sell") $balance_y = $company_rows->balance_sell;
				else if($trans == "buy") $balance_y = $company_rows->balance_buy;

				// ++ 거래처 전체 잔액표시
				echo "<script> $('#balance_y').html(\"".$balance_y."\"); </script>";

				if($trans == "sell"){
					$query = "select SUM(total) AS trans_total, SUM(vat) AS trans_vat, SUM(discount) AS trans_discount, SUM(paid) AS paid_total from sales_trans 
					where (trans = 'sell' or trans = 'sell_paid') and business = '$business' and company_id = '$company_id' ";
					//echo $query."<br>";
					$year_rows = _sales_query_rows($query);



					$query = "select SUM(total) AS trans_total, SUM(vat) AS trans_vat, SUM(discount) AS trans_discount, SUM(paid) AS paid_total from sales_trans 
					where (trans = 'sell' or trans = 'sell_paid') and business = '$business' and transdate = '$transdate' and company_id = '$company_id' ";
					//echo $query."<br>";
					$day_rows = _sales_query_rows($query);

					$query = "select SUM(total) AS trans_total, SUM(vat) AS trans_vat, SUM(discount) AS trans_discount, SUM(paid) AS paid_total from sales_trans 
						where (trans = 'sell' or trans = 'sell_paid') and business = '$business' and transdate >= '$start' and transdate <= '$end' and company_id = '$company_id' ";
					// echo $query."<br>";
					$month_rows = _sales_query_rows($query);
	
					$query = "select * from `sales_company` where Id = '".$rows->company_id."'";
    				//echo $query1."<br>";
					$company_rows = _sales_query_rows($query);

					$blance_d = $company_rows->balance_sell;
		
				} if($trans == "buy"){
					$query = "select SUM(total) AS trans_total, SUM(vat) AS trans_vat, SUM(discount) AS trans_discount, SUM(paid) AS paid_total from sales_trans 
					where (trans = 'buy' or trans = 'buy_paid') and business = '$business' and company_id = '$company_id' ";
					//echo $query."<br>";
					$year_rows = _sales_query_rows($query);


					$query = "select SUM(total) AS trans_total, SUM(vat) AS trans_vat, SUM(discount) AS trans_discount, SUM(paid) AS paid_total from sales_trans 
					where (trans = 'buy' or trans = 'buy_paid') and business = '$business' and transdate = '$transdate' and company_id = '$company_id' ";
					//echo $query."<br>";
					$day_rows = _sales_query_rows($query);

					$query = "select SUM(total) AS trans_total, SUM(vat) AS trans_vat, SUM(discount) AS trans_discount, SUM(paid) AS paid_total from sales_trans 
					where (trans = 'buy' or trans = 'buy_paid') and business = '$business' and transdate >= '$start' and transdate <= '$end' and company_id = '$company_id' ";
					//echo $query."<br>";
					$month_rows = _sales_query_rows($query);
	
					$query = "select * from `sales_company` where Id = '".$rows->company_id."'";
    				//echo $query1."<br>";
					$company_rows = _sales_query_rows($query);

					$blance_d = $company_rows->balance_buy;

				}



				// 전표 내역 금액 요약본을 표시 
				// $('#balance_d').html(\"".$blance_d."\");
				echo "<script>

				$('#total_d').html(\"".$day_rows->trans_total."\");
				$('#vat_d').html(\"".$day_rows->trans_vat."\");
				$('#discount_d').html(\"".$day_rows->trans_discount."\");
				$('#payment_d').html(\"".$day_rows->paid_total."\");

				$('#total_m').html(\"".$month_rows->trans_total."\");
				$('#vat_m').html(\"".$month_rows->trans_vat."\");
				$('#discount_m').html(\"".$month_rows->trans_discount."\");
				$('#payment_m').html(\"".$month_rows->paid_total."\");

				$('#total_y').html(\"".$year_rows->trans_total."\");
				$('#vat_y').html(\"".$year_rows->trans_vat."\");
				$('#discount_y').html(\"".$year_rows->trans_discount."\");
				$('#payment_m').html(\"".$year_rows->paid_total."\");
				
				</script>";
			}	
			
			// echo "company balance = $balance_y <br>";


		} // end 	
		
	} else {		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $msg;	
	}

	
?>