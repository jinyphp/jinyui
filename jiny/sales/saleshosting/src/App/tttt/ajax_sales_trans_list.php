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
			$('#_num').on('keyup',function(e){ 
				alert(\"num\");
    		});
			
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
    			
    			$query = "select * from `sales_trans` where Id = '$TID[$i]'";
				if($rows = _sales_query_rows($query)){
    					
    				//# 업체 미수금 
    				$query1 = "select * from `sales_company` where Id = '$company_id'";
					if($rows1 = _sales_query_rows($query)){
    					$balance1 = $rows1->balance1 - $rows->prices_total;
						$query1 = "UPDATE `sales_company` SET `balance1`= '$balance1' WHERE `Id`='$company_id'";
						_sales_query($query1);
					}
						
					//상품 재고수량 조정
					if($rows->gid){
						$query = "select * from `sales_goods` where Id = '".$rows->gid."'";
						if($rows = _sales_query_rows($query)){
    						$stock = $rows->stock + $rows->num;
							$query = "UPDATE `sales_goods` SET `stock`= '$stock' WHERE `Id`='".$rows->gid."'";
							_sales_query($query);
						}
					}
	
    				// 삭제 쿼리 전송
    				$query1 = "DELETE FROM `sales_trans` WHERE `Id`='$TID[$i]'";
					_sales_query($query1);
				}
    		}
		} else if($mode == "paynow"){
			$payment = _formdata("payment");
			//echo "payment = $payment <br>";

			$paydate = _formdata("paydate");
			//echo "paydate = $paydate <br>";

			$payment_manager = _formdata("payment_manager");
			//echo "payment_manager  = $payment_manager  <br>";

			$money = _formdata("money");
			//echo "money = $money <br>";

			$payment_memo = _formdata("pay_memo");
			//echo "payment_memo = $payment_memo <br>";

			// 결체 체크 목록
			$TID = $_POST['TID'];
			$MONEYS = $_POST['moneys'];
			//# 선택한 결제 전표 목록 출력.
			if($TID){
				$tid_string = "";
				for($i=0,$amount=0;$i<count($TID);$i++){
					//echo "TID = $TID[$i] , MONEYS = $MONEYS[$i]<br>";
					$query = "select * from `sales_trans` where Id = '$TID[$i]'";
					if($rows = _sales_query_rows($query)){

						// 전표상태 갱신
						$unpaid = $rows->unpaid - $MONEYS[$i];	// 일부결제, 미결제 잔액 
						$paid = $rows->total - $unpaid;			// 일부결제. 기 지불한 금액 
						$query = "UPDATE `sales_trans` SET `payment`='$payment', `paydate`='$paydate', 
									`paid`='$paid', `paymemo`='$payment_memo', `unpaid`='$unpaid' ";
						if($unpaid == 0) $query .= ", `pay`='on' ";
						$query .= "WHERE `Id`='$TID[$i]'";
						//echo $query."<br>";
						_sales_query($query);

						$tid_string .= $TID[$i].";";
								
					}
				}

				// 신규 결제 정보, 입력 
				$query = "INSERT INTO `sales_trans` (`regdate`, `transdate`, `trans`, `company`, `company_id`,  `payment`, `paydate`, `paid`, `paymemo`, `auth`,`TID`) 
											VALUES ('$TODAYTIME', '$paydate', 'sell_paid', '".$rows->company."', '".$rows->company_id."', '$payment', '$paydate', '$money', '$paymemo','on','".$tid_string."')";
				//echo $query."<br>";		
				_sales_query($query);


			}


		}








    	$query = "select * from sales_trans where trans = '$trans' and business = '$business' "; //판매 전표출력
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
		    
		if($company_id) $query .= " and company_id = '$company_id' "; // UIDB : 상대방 매출처 	
		// $query .= " and auth IS NOT NULL "; // 승인된 자료만 표시 	    	
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
				
				// 당일 거래 정리 
				if($trans_day == substr($TODAYTIME,8,2)){
					$total_d += $rows->total;
					$vat_d += $rows->vat;
					$discount_d += $rows->discount;
					$payment_d += $rows->paid;
				}

				
			
				$trans_tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
				$trans_tid .= "<input type='hidden' name='pay[]' value='".$rows->pay."' >";
				$trans_tid .= "<input type='hidden' name='expert[]' value='".$rows->expert."' >";

				/*
				$form_goodname = "<input type='hidden' name='gid'><input type='text' name='_goodname[]' value='".$rows->goodname."' style=\"$css_textbox\" id=\"_goodname\">";
				$form_spec = "<input type='text' name='_spec[]' value='".$rows->spec."' style=\"$css_textbox\" id=\"_spec\">";
				$form_num = "<input type='text' name='_num[]' value='".$rows->num."' style=\"$css_textbox\" id=\"_num\">";
				$form_prices ="<input type='text' name='_prices[]' value='".$rows->prices."' style=\"$css_textbox\" id=\"_prices\">";
				$form_sum = "<input type='text' name='_sum[]' value='".$rows->sum."' style=\"$css_textbox\" id=\"_sum\">";
				$form_vat = "<input type='text' name='_vat[]' value='".$rows->vat."' style=\"$css_textbox\" id=\"_vat\">";
				$form_discount = "<input type='text' name='_discount[]' value='".$rows->discount."' style=\"$css_textbox\" id=\"_discount\">";
				$form_total = "<input type='text' name='_total[]' value='".$rows->total."' style=\"$css_textbox\" id=\"_total\">";

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
				<tr>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"25\">$trans_tid</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"20\"> $form_day  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' > ".$form_goodname ." </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> ".$form_spec."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"50\"> ".$form_num."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$form_prices."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$form_sum."   </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$form_vat."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"60\"> ".$form_discount."  </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"80\"> ".$form_total."  </td>
					<td style='font-size:12px;padding:10px;' width='40'>".$rows->status."</td>
				</tr>
				</table>";

				*/

				// 결제 완료된 전표는 , 합계금액 가로줄 표시 
				if($rows->pay) $rows_total = "<span style=\"text-decoration:line-through;\">".$rows->total."</span>";
				else $rows_total = $rows->total;

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
				<tr>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"25\">$trans_tid</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:5px;' width=\"20\"> $trans_day </td>
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
				$('#total_d').html(\"$total_d\");
				$('#vat_d').html(\"$vat_d\");
				$('#discount_d').html(\"$discount_d\");
				$('#payment_d').html(\"$payment_d\");

				$('#total_m').html(\"$total_m\");
				$('#vat_m').html(\"$vat_m\");
				$('#discount_m').html(\"$discount_m\");
				$('#payment_m').html(\"$payment_m\");
				
			</script>";
		} else {
			echo "전표 내역이 없습니다.";
		}










		/*


    	$mode = _formdata("mode");
    	echo "mode = $mode <br>";
    	if($mode == "newdata"){
    		// 전표일자
    		
    		$insert_filed .= "`regdate`,"; $insert_value .= "'$TODAYTIME',";
    		if($transdate = _formdata("transdate")) { $insert_filed .= "`transdate`,"; $insert_value .= "'$transdate',"; }

    		// 거래유형 
    		if($trans = _formdata("trans")) { $insert_filed .= "`trans`,"; $insert_value .= "'$trans',"; }
    		
    		// 상품정보 
    		if($gid = _formdata("gid")) { $insert_filed .= "`gid`,"; $insert_value .= "'$gid',"; }
    		if($goodname = _formdata("goodname")) { $insert_filed .= "`goodname`,"; $insert_value .= "'$goodname',"; }
    		if($spec = _formdata("spec")) { $insert_filed .= "`spec`,"; $insert_value .= "'$spec',"; }
    		if($num = _formdata("num")) { $insert_filed .= "`num`,"; $insert_value .= "'$num',"; }
    		if($currency = _formdata("currency")) { $insert_filed .= "`currency`,"; $insert_value .= "'$currency',"; }
    		if($prices = _formdata("prices")) { $insert_filed .= "`prices`,"; $insert_value .= "'$prices',"; }
    		if($vat = _formdata("vat")) { $insert_filed .= "`vat`,"; $insert_value .= "'$vat',"; }
    		if($discount = _formdata("discount")) { $insert_filed .= "`discount`,"; $insert_value .= "'$discount',"; }
    		if($sum = _formdata("sum")) { $insert_filed .= "`sum`,"; $insert_value .= "'$sum',"; }
    		if($total = _formdata("total")) { $insert_filed .= "`total`,"; $insert_value .= "'$total',"; }


    		// 거래처 정보 
    		if($company = _formdata("company_search")) { $insert_filed .= "`company`,"; $insert_value .= "'$company',"; }
    		if($company_id = _formdata("company_id")) { $insert_filed .= "`company_id`,"; $insert_value .= "'$company_id',"; }

    		if($house = _formdata("house")) { $insert_filed .= "`house`,"; $insert_value .= "'$house',"; }

    		$insert_filed .= "`email`,"; $insert_value .= "'".$_COOKIE['cookie_email']."',"; 

    		$query = "INSERT INTO `sales_trans` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query;
			_sales_query($query);
			

       	}

    	$css_btn_save ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";

		$company_id = _formdata("company_id"); 
		$transdate = _formdata("transdate");
		
		$barcodeMode = "trans_sell"; 
		$url_return = "sales_trans_sell.php?company_id=$company_id&transdate=$transdate&";

		$form_barcode = "<butten onclick='showBarcode(\"$barcodeMode \",\" $url_return\")'><img src='./images/barcode.gif' width=20 border=0></butten>";


		// $body = _skin_page($skin_name,"sales_trans_form");
		
		$form_day = "<input type='text' name='day' value='$day' style=\"$css_textbox\">";


		$form_goodname = "<input type='hidden' name='gid'><input type='text' name='goodname' placeholder='상품명' autofocus style=\"$css_textbox\" id=\"goodname\">";
		$form_spec = "<input type='text' name='spec' placeholder='규격' style=\"$css_textbox\">";
		$form_num = "<input type='text' name='num' placeholder='수량' style=\"$css_textbox\" id=\"num\">";
		$form_prices ="<input type='text' name='prices' placeholder='단가' style=\"$css_textbox\" id=\"prices\">";
		$form_sum = "<input type='text' name='sum' placeholder='공급액' style=\"$css_textbox\" onChange=\"javascript:trans_sum($vat)\">";
		$form_vat = "<input type='text' name='vat' placeholder='부가세' style=\"$css_textbox\" onChange=\"javascript:trans_sum($vat)\">";
		$form_discount = "<input type='text' name='discount' placeholder='할인액' style=\"$css_textbox\" onChange=\"javascript:trans_sum($vat)\">";
		$form_total = "<input type='text' name='total' placeholder='합계' style=\"$css_textbox\" onChange=\"javascript:submit($vat)\">";
	*/
		
	

	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>