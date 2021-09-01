<?php
	


	// 주문자 이메일 데이터 리턴
	function _orderlist_rowss($email){
		$query = "select * from `shop_orders` WHERE email = '$email' order by regdate desc";
		if($rowss = _mysqli_query_rowss($query)){
			return $rowss;
		}	
	}


	// 주문목록 내역 한개를 리턴
	function _orderlist_row($uid){

	}

	// 주문목록 내역 한개를 리턴
	function _orderlist_detail_rows($order_id){

	}

	// 주문목록 내역 한개를 리턴
	function _orderlist_detail_row($order_id){

	}


	// new : 신규
	// banking
	// order
	// ordering
	// ordered
	// shipping
	// finish
	// cancel
	// canceling
	// refunding
	// refund
	// dispute
	function _order_status_string($status,$lang){
		switch ($status) {
			case 'refunding':
				return _order_status_string_canceling($lang);
				break;

			case 'refund':
				return _order_status_string_refund($lang);
				break;

			case 'dispute':
				return _order_status_string_dispute($lang);
				break;

			case 'canceling':
				return _order_status_string_canceling($lang);
				break;

			case 'cancel':
				return _order_status_string_cancel($lang);
				break;

			case 'finish':
				return _order_status_string_finish($lang);
				break;

			case 'shipping':
				return _order_status_string_shipping($lang);
				break;

			case 'ordered':
				return _order_status_string_ordered($lang);
				break;

			case 'ordering':
				return _order_status_string_ordering($lang);
				break;		

			case 'order':
				return _order_status_string_order($lang);
				break;

			case 'banking':
				return _order_status_string_banking($lang);
				break;	

			case 'new':
				return _order_status_string_new($lang);
				break;
			
			default:
				# code...
				break;
		}

	}

	function _order_status_string_dispute($lang){
		switch ($lang) {
			case 'en':
				return "dispute";
				break;

			case 'ko':
				return "분쟁";
				break;
			
			default:
				return "분쟁";
				break;
		}
	}

	function _order_status_string_refund($lang){
		switch ($lang) {
			case 'en':
				return "refund";
				break;

			case 'ko':
				return "환불";
				break;
			
			default:
				return "환불";
				break;
		}
	}

	function _order_status_string_refunding($lang){
		switch ($lang) {
			case 'en':
				return "refunding";
				break;

			case 'ko':
				return "환불중";
				break;
			
			default:
				return "환불중";
				break;
		}
	}	

	function _order_status_string_canceling($lang){
		switch ($lang) {
			case 'en':
				return "canceling";
				break;

			case 'ko':
				return "취소중";
				break;
			
			default:
				return "취소중";
				break;
		}
	}

	function _order_status_string_cancel($lang){
		switch ($lang) {
			case 'en':
				return "cancel";
				break;

			case 'ko':
				return "최소";
				break;
			
			default:
				return "취소";
				break;
		}
	}

	function _order_status_string_finish($lang){
		switch ($lang) {
			case 'en':
				return "Finish";
				break;

			case 'ko':
				return "완료";
				break;
			
			default:
				return "완료";
				break;
		}
	}

	function _order_status_string_shipping($lang){
		switch ($lang) {
			case 'en':
				return "Shipping";
				break;

			case 'ko':
				return "배송중";
				break;
			
			default:
				return "배송중";
				break;
		}
	}

	function _order_status_string_ordered($lang){
		switch ($lang) {
			case 'en':
				return "Order";
				break;

			case 'ko':
				return "주문";
				break;
			
			default:
				return "주문";
				break;
		}
	}

	function _order_status_string_ordering($lang){
		switch ($lang) {
			case 'en':
				return "Order";
				break;

			case 'ko':
				return "주문";
				break;
			
			default:
				return "주문";
				break;
		}
	}

	function _order_status_string_order($lang){
		switch ($lang) {
			case 'en':
				return "Order";
				break;

			case 'ko':
				return "주문";
				break;
			
			default:
				return "주문";
				break;
		}
	}	


	function _order_status_string_banking($lang){
		switch ($lang) {
			case 'en':
				return "New";
				break;

			case 'ko':
				return "입금중";
				break;
			
			default:
				return "입금중";
				break;
		}
	}	

	function _order_status_string_new($lang){
		switch ($lang) {
			case 'en':
				return "New";
				break;

			case 'ko':
				return "입금중";
				break;
			
			default:
				return "입금중";
				break;
		}
	}	






	// 결제 방식선택 : 은행입금 / 신용카드 
	function _payment_list($css){
		global $site_country;
		// 결제방식 모듈 체크
		$payment = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
		$payment .= "<tr>
						<td width='10'><input type=radio name=payment value='bank' id=\"order_payment\"></td>
						<td>은행 계좌이체</td>
					 </tr>"; // 기본 설정 은행이체
		
		$query = "select * from `shop_pg` WHERE `country`='".$site_country."' and enable='on'"; //쇼핑몰 결제 가능한 리스트를 체크
		if( $rowss = _mysqli_query_rowss($query) ){
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];	
				$payment .= "<tr>";	
				$payment .= "<td width='10'> <input type=radio name=payment value='".$rows->pgname."' id=\"order_payment\"></td>";
				$payment .= "<td>신용카드(".$rows->pgname.")</td>";
				$payment .= "</tr>";	
			}
				
		}

		$payment .= "</table>";	

		return $payment;
	}

	function _shipping_country($css){
		global $site_country;
		// 배송정보 입력 받음.
		// 배송가능 국가 및 배송방식 선택 
		$query = "select * from shop_delivery where code = '".$site_country ."' and (enable = 'on' or enable = 'checked') group by target desc";
    	if( $rowss = _mysqli_query_rowss($query) ){
    		$select_country = "<select name='target' style=\"$css\"> ";
    		$select_country .= "<option value='' selected=\"selected\">수령받으실 국가를 선택하세요</option>";
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];
				if($rows->target){
					if($site_country == $rows->target) {
						$select_country .= "<option value='".$rows->target."' selected>".$rows->targetName."</option>";
					} else {	
						$select_country .= "<option value='".$rows->target."' >".$rows->targetName."</option>";
					}
				} else break;
			}
			$select_country .= "</select>";
			return $select_country;
				
    	} 
	}


	function _formlist_bycart($rows,$num,$option,$shipping,$ordertext){
		$url = $rows->images;
		$sum = $rows->prices * $rows->num;
		$total = $sum + $sum/100*$tax;

		$total = number_format($total,0,'.',',')."원";

		$list ="<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>
				<tr>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' rowspan='3' width='100' valign='top'>
						<img src='$url' border=0 width='100'></td>
					<td style='font-size:12px;padding:10px;' width='20' valign='top'>
						<input type='checkbox' name='TID[]' value='".$rows->Id."' checked onClick=\"javascript:check_select()\">
					</td>
					<td style='font-size:12px;padding:10px;' valign='top'>".$rows->goodname."</td>
					<td style='font-size:12px;padding:10px;' width='100' valign='top'> 수량 : ".$rows->num."</td>
					<td style='font-size:12px;padding:10px;' width='100' valign='top'> 통화 : ".$rows->currency."</td>
					<td style='font-size:12px;padding:10px;' width='100' valign='top'> 금액 : ".$total."</td>
				</tr>
				<tr>
					<td style='font-size:12px;padding:10px;' width='20' valign='top'>　</td>
					<td style='font-size:12px;padding:10px;' valign='top'>옵션: ".$option."</td>
					<td style='font-size:12px;padding:10px;' width='300' valign='top' colspan='3'> 배송방식 : ".$shipping."</td>
				</tr>
				<tr>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='20' valign='top'>　</td>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' valign='top' colspan='4'>".$ordertext."</td>
				</tr>
				</table>";
				
		return $list;					
	}

	function _formlist_bycart_m($rows,$num,$option,$shipping,$ordertext){
		$url = $rows->images;
		$sum = $rows->prices * $rows->num;
		$total = $sum + $sum/100*$tax;

		$total = number_format($total,0,'.',',')."원";

		$title = $rows->goodname;
		$title .= "수량 : ".$rows->num."<br>";
		$title .= "통화 : ".$rows->currency."<br>";
		$title .= "굼액 : ".$total."<br>";

		$list ="<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>
				<tr>
					<td style='font-size:12px;padding:10px;' width='100' valign='top'>
						<img src='$url' border=0 width='100'></td>
					<td style='font-size:12px;padding:10px;' width='20' valign='top'>
						<input type='checkbox' name='TID[]' value='".$rows->Id."' checked onClick=\"javascript:check_select()\">
					</td>
					<td style='font-size:12px;padding:10px;' valign='top'>".$title."</td>
				</tr>
				
				</table>";

		$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>
				<tr>
					<td style='font-size:12px;padding:10px;'>옵션: ".$option."</td>
				</tr>
				<tr>	
					<td style='font-size:12px;padding:10px;'>배송방식: ".$shipping."</td>
				</tr>
				<tr>	
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>주문문구: ".$ordertext."</td>
				</tr>
				</table>";		
				
		return $list;					
	}


?>