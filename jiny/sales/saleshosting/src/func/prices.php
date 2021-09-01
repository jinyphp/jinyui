<?php
	function _prices_dome($rows,$dome){
		if($dome){
			return $rows->prices_b2b; //도매가격 사이트
		} else {
			return $rows->prices_sell; // 일반가격 
		}
	}

	function __prices_currency($rows,$dome){
		if($dome){
			return $rows->b2b_currency; //도매가격 사이트
		} else {
			return $rows->sell_currency; // 일반가격 
		}
	}

	function _prices_mem_discount($price,$discount){
		if($discount) $mem_prices = $price/100 * (100-intval($discount));
		else $mem_prices = $price;
		return $mem_prices;
	}

	function _prices_type($dome,$discount){
		if($dome) {
			if($discount) return "도매가격 :"; else return "회원가격 :";	 
		} else {
			if($discount) return "가격 :"; else return "회원가격 :";
		}
	}
			

	function _prices_string($price){
		$format = number_format($price,0,'.',',')."원";
		return $format;
	}

	function _prices_check_currency($price_currency,$check_currency){
		if($check_currency) return $price_currency;
	}

	function __prices_usd($price,$price_currency,$check_usd){
		if($check_usd){
			$prices_usd = _prices_USD($price_currency ,$price);
			$string_usd = "(USD ".number_format($prices_usd['prices'],2,'.',',').")";
			return $string_usd;
		}
	}

	function _prices_vat_rate($site_country){
		$query1 = "select * from shop_country where code = '".$site_country."'";
		if($rows_country = _mysqli_query_rows($query1)) 
			return $rows_country->tax;
		else
			return 0;
	}

	function _prices_vat($prices,$vat){
		if($vat){
			// 부가세 포함가격
			$prices_vat = $prices / 100 * $vat;
			return $prices_vat;
		} else {
			// 부가세 별도
			return "0";
		}
	}

	function _prices_vat_string($check_vat,$vat_rate,$vat_prices){
		if($check_vat){
			$form_vat = "<input type='hidden' name='tax' value='$vat'>";
		} else {
			if( $vat_prices > 0){
				$vat_format = number_format($vat_prices,0,'.',',')."원";
				$form_vat  = "<input type='hidden' name='tax' value='$vat'>";
				$form_vat .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
								<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100> 부가세 </td>
								<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\"> $vat_format (세울:".$vat_rate."%) </td>
							</tr></table>";
			} 
		}
		
		return $form_vat;
	}

	function _prices_total($check_usd, $price_currency, $total_prices){
						$total_prices_format = number_format($total_prices,0,'.',',')."원";

						if($check_usd){
							$total_prices_usd = _prices_USD($price_currency ,$total_prices);
							$string_usd = "(USD ".number_format($total_prices_usd['prices'],2,'.',',').")";
						} else $string_usd ="";


						$prices_format = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100> 주문합계 </td>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:15px;padding:10px;\">
										<b><span id=\"total_sum\"> ".$total_prices_format." $string_usd</span></b> </td>
									</tr></table>";
						$prices_format .= "<input type='hidden' name='total_prices' value='$total_prices'>";
						$prices_format .= "<input type='hidden' name='currency' value='".$price_currency."'>";

		return $prices_format;
	}

?>