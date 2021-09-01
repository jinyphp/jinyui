<?php
	//# OpenShopping V.21
	//#

	// Update : 2016.1.20 코드정리
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	
	include "./func/orders.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	function _order_detail_list($ordercode){

		$query = "select * from `shop_orders_detail` WHERE ordercode = '".$ordercode."' order by regdate desc";
		// $list .= $query."<br>";
		if($rowss_orders_detail = _mysqli_query_rowss($query)){	
			for($j=0;$j<count($rowss_orders_detail);$j++){
				$rows2 = $rowss_orders_detail[$j];
						
				$goods = _goods_rows($rows2->GID);
						
				$numsum = $rows2->prices * $rows2->num;		// 수량별 가격 
				$numsum += $numsum / 1000 * $rows2->vat;	// 부가세 부분 추가 4

				$tid = "<input type='checkbox' name='TID[]' value='".$rows2->Id."' checked>";
				$images = "<div><img src='".$goods->images1."' width='100'></div>";

				$goodsname = "<div>".$rows2->goodname."</div>";
				$goodsname .= "<div>옵션 : ".$rows2->option."</div>";
				$goodsname .= "<div>주문문구 : ".$rows2->ordertext."</div>";

				$prices = "<div>".$rows2->currency." : $numsum</div>";
				$prices .= "<div>수량 ".$rows2->num."</div>";
				$prices .= "<div>배송방식: ". $rows2->shipping ."</div>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>								
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\" valign=\"top\">".$images."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"20\" valign=\"top\">".$tid."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' valign=\"top\">".$goodsname."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\" valign=\"top\">".$prices."</td>
							</tr>
						</table>";			
			}
				
		}

		return $list;
	}




	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		

		if(isset($_COOKIE['cookie_email'])){
			$cookie_email = $_COOKIE['cookie_email'];
		} else {
			$cookie_email = "";
		}

		$mode = _formmode();

		///////////////////
		// 주문목록 및 이력 출력 		
		$query = "select * from `shop_orders` WHERE email = '".$_COOKIE['cookie_email']."' order by regdate desc";
		if($rowss = _mysqli_query_rowss($query)){	

			$seller="";
			$sub_shipping = 0;
			$sub_shipping_method = "";
			$list ="";
			for($i=0,$total_prices=0,$sub_prices=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				$list .= "<!-- Order -->
				<div style='border:1px solid #E9E9E9;font-size:12px;padding:5px;'>
					<!-- 기본정보 -->
					<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\"><a href='#' onclick=\"javascript:orders_edit('edit','".$rows->Id."')\" >".$rows->regdate."</a></td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;'>".$rows->username." ".$rows->firstname." / ".$rows->email."</td>				
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">".$rows->status."</td>
					</tr>
					</table>

					<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->country."/ ".$rows->city."/ ".$rows->address."</td>				
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">".$rows->payment."</td>
					</tr>
					</table>

					<!-- 주문상품 -->

					"._order_detail_list($rows->ordercode)."
				</div><br>";

			}

	
			echo $list;
		} else {
			$msg = "주문 내역이 없습니다.";
			echo $msg;
		}
		
		
	} else {
			$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
			echo $msg;
	}

	
?>