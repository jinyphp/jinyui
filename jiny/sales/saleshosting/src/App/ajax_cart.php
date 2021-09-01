<?php

	//*  WebLib V1.5
	//*  Program by : hojin lee
	//*  
	//*
	// update : 2016.01.04 = 코드정리 

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

	
	include "./func/members.php";
	
	include "./func/cart.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");
		
	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}

	if(isset($_COOKIE['cookie_email'])){
		$cookie_email = $_COOKIE['cookie_email'];
	} else {
		$cookie_email = "";
	}

	$javascript = "<script>

	function cart_delete(){
    	// document.cart.mode.value = \"delete\";
    	$.ajax({
        	url:'/ajax_cart.php?mode=delete',
        	type:'post',
        	data:$('form').serialize(),
        	success:function(data){
            	$('#mainbody').html(data);
        	}
    	});                             
	} 

	function cart_remove(uid){
    	// document.cart.mode.value = \"remove\";
    	//document.cart.UID.value = uid;
    	//alert(uid);
    	$.ajax({
        	url:'/ajax_cart.php?mode=remove&uid='+uid,
        	type:'post',
        	data:$('form').serialize(),
        	success:function(data){
            	$('#mainbody').html(data);
        	}
    	});                           
	} 


	function cart_seller(seller){
    	$.ajax({
            url:'/ajax_ordernow.php?mode=cart&seller='+seller,
            type:'post',
            type:'post',
            data:$('form').serialize(),
            success:function(data){
                $('#mainbody').html(data);
            }
        });                              
	}   

	function cart_order(){
   		$.ajax({
            url:'/ajax_ordernow.php?mode=cart',
            type:'post',
            type:'post',
            data:$('form').serialize(),
            success:function(data){
                $('#mainbody').html(data);
            }
        });                          
	} 

	function cart_num(uid){
    	//document.cart.mode.value = \"change\";
    	document.cart.UID.value = uid;
 		//alert(\"changed\");
    	$.ajax({
        	url:'/ajax_cart.php?mode=change',
        	type:'post',
        	data:$('form').serialize(),
        	success:function(data){
            	$('#mainbody').html(data);
        	}
    	});                     
	}

	</script>";

	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		$mode = _formmode(); // form mode value 값을 읽어옴.
		$uid = _formdata("uid");

		if( isset($_COOKIE['cookie_email']) ){
			$members_rows = _members_rows($_COOKIE['cookie_email']);
		}

		////////////////////
		// 장바구니 기능 처리
		//* 장바구니 내용 삽입처리...
		if( $mode == "cartup"  ){ 
			_cart_up();	
			$mode = NULL;			
		} else if( $mode == "delete" ){
			// 장바구니 선택상품 삭제 
			$TID = $_POST['TID']; 
    		for($i=0;$i<count($TID);$i++) _cart_delete($TID[$i]);

		} else if( $mode == "remove" ){
			 _cart_remove($uid);

		} else if( $mode == "change" ){
			_cart_change();
		}





		$body = "<form id=\"data\" name='cart' method='post' enctype='multipart/form-data' >
				<input type='hidden' name='ajaxkey' value='$ajaxkey'>				
				<input type='hidden' name='UID'>
				<input type='hidden' name='seller'>".
				_theme_page($site_env->theme,"cart",$site_language,$site_mobile)."</form>";	


		// 블럭코드 전처리기 코드를 처리하여, 상품을 진열함
		// 블럭리스트 출력, Body {blocklist_ 갯수를 분석, 갯수 많큼 처리
		$keyword = "block_";
		if($keyword_count = _keyword_count($body, "{".$keyword)){
			$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
			for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
				$class = $keyword.$rows[$i];
				$body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_blocklist.php?code=$rows[$i]")."</script>
					</article>\n",$body);
			}
		}



		






		///////////////////
		// 장바구니 출력  
		if($rowss = _cart_rowss($cartlog)){

			
			$seller="";
			$sub_shipping = 0;
			$sub_shipping_method = "";
			$list ="";
			for($i=0,$total_prices=0,$sub_prices=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				// 판매자가 틀릴 경우, Sub값 초기화
				if($seller != $rows->seller){

					$list .= "Seller: <strong>".$rows->seller."</strong>";
					
					if($i!=0) {
						
						$list .= _cartform_subtotal($sub_prices,$sub_shipping,$sub_total,$seller);
						/*
						$list .="</td></tr></table>";
						$list .="<br>					
					<table border='0' width='100%' cellspacing='5' cellpadding='5' style='font-size:12px;padding:10px;border:1px solid #E9E9E9;'>";
					$list .="<tr><td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;'>Seller: <strong>".$rows->seller."</strong></td></tr>";
					$list .="<tr><td>";

						//$list .="Seller : ".$rows->seller." and $i<br>";
						$list .="<br>";
						*/
					} else {
						//$list .="Seller : ".$rows->seller." and $i<br>";
						/*
						$list .="<br>					
					<table border='0' width='100%' cellspacing='5' cellpadding='5' style='font-size:12px;padding:10px;border:1px solid #E9E9E9;'>";
					$list .="<tr><td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;'>Seller: <strong>".$rows->seller."</strong></td></tr>";
					$list .="<tr><td>";
					*/
					}
					

					$sub_total = $sub_prices + $sub_shipping;
					$seller = $rows->seller;
					$sub_prices = 0;
					$sub_shipping = 0;
					$sub_shipping_method = "";
					
				}


				// Check Prices and Option , Tax
				$prices = $rows->prices + $rows->prices /100 * $rows->vat;
				$option = explode(";", $rows->option);
				for($k=0;$k<sizeof($option);$k++) { 
					$option_prices = explode("=", $option[$k]); 
					$prices += @$option_prices[1];  // 옵션 가격을 더람.
				}

				$numsum = $prices * $rows->num;
			
				$sub_prices += $numsum;

				$shipping = explode(":",$rows->shipping);
				if($sub_shipping_method != $shipping[0]){ // 같은 배송방식은 , 묾음으로 계산처리 하지 않음.
					$sub_shipping_method = $shipping[0];
					$sub_shipping += $shipping[1];
				}

				if($site_mobile == "m") $list .= _cartform_list_m($rows); else $list .= _cartform_list($rows);
				
			}


			$sub_total = $sub_prices + $sub_shipping;
			$total_prices += $sub_total;

			// 판매자 , 서브합계 
			$list .= _cartform_subtotal($sub_prices,$sub_shipping,$sub_total,$seller);
			// $list .="</td></tr></table>";
		
			// 제일 마지막, 정보 .
			$list .= _cartform_total($total_prices);

			$body = str_replace("{cart_list}",$list,$body);			

		

		} else {
			$msg = "장바구니 상품이 없습니다.";
			$body = str_replace("{cart_list}",$msg,$body);			
		}	
		
		echo $javascript.$body;



	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;
	}










	function _cart_remove($uid){
		// 장바구니 상품 제거 처리 ...
		//_cart_delete( _formmode("uid") );		
		// $uid = _formdata("uid");
		$query = "DELETE FROM `shop_cart` WHERE `Id`='$uid'";
		// echo $query."<br>";
    	_mysqli_query($query);
	}

	function _cart_change(){
		// 장바구니 수량 변경시 처리..
		$TID = $_POST['TID'];
		$UID = $_POST['UID'];
		$num = $_POST['num']; 					

    	for($i=0;$i<count($TID);$i++){
    		if($TID[$i] == $UID) {    				
    			$query = "UPDATE `shop_cart` SET `num`='$num[$i]' WHERE `Id`='$TID[$i]'";
    			_mysqli_query($query);	
    		}						
       	}	
	}


	// 장바구니 하나 표시할, 형태폼리턴.
	function _cartform_list($rows){
	// Check Prices and Option , Tax
		$prices = $rows->prices + $rows->prices /100 * $rows->vat;
		$option = explode(";", $rows->option);
		for($k=0;$k<sizeof($option);$k++) { 
			$option_prices = explode("=", $option[$k]); 
			$prices += @$option_prices[1];  // 옵션 가격을 더람.
		}

		$numsum = $prices * $rows->num;

		$shipping = explode(":",$rows->shipping);
				
		$prices_format = number_format($numsum,0,'.',',')."원";

		
		$images_src = $rows->images;
		$link = "./detail.php?uid=".$rows->GID;

		$body ="<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>";
		$body .="<tr>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' rowspan='3' width='100' valign='top'>
						<a href='$link'><img src='$images_src' border=0 width='100'></a>
					</td>
					<td style='font-size:12px;padding:10px;' width='20' valign='top'><input type='checkbox' name='TID[]' value='".$rows->Id."' checked></td>
					<td style='font-size:12px;padding:10px;' valign='top'><a href='$link'>".$rows->goodname."</a></td>
					<td style='font-size:12px;padding:10px;' width='100' valign='top'>
						<input type='text' name='num[]' min='1' max='1000' value='".$rows->num."' onchange=\"cart_num('".$rows->Id."')\" id=\"cart_num\"> 
						<br><a href='#' onclick=\"javascript:cart_num('".$rows->Id."')\">수량변경</a></td>
					<td style='font-size:12px;padding:10px;' width='130' valign='top'>".$rows->currency." : $prices_format</td>
					<td style='font-size:12px;padding:10px;' width='70' valign='top'><a href='#' onclick=\"javascript:cart_remove('".$rows->Id."')\">삭제</a></td>
					</tr>
					<tr>
					<td style='font-size:12px;padding:10px;' width='20' valign='top'>　</td>
					<td style='font-size:12px;padding:10px;' valign='top'>옵션: ".$rows->option."</td>
					<td style='font-size:12px;padding:10px;' width='300' valign='top' colspan='3'>배송방식: $shipping[0]-$shipping[1]</td>
					</tr>
					<tr>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='20' valign='top'>　</td>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' valign='top' colspan='4'>".$rows->ordertext."</td>
					</tr>";
		$body .="</table>";

		return $body;

	}


	// 장바구니 하나 표시할, 형태폼리턴.
	function _cartform_list_m($rows){
		// Check Prices and Option , Tax
		$prices = $rows->prices + $rows->prices /100 * $rows->vat;
		$option = explode(";", $rows->option);
		for($k=0;$k<sizeof($option);$k++) { 
			$option_prices = explode("=", $option[$k]); 
			$prices += @$option_prices[1];  // 옵션 가격을 더람.
		}

		$numsum = $prices * $rows->num;

		$shipping = explode(":",$rows->shipping);
				
		$prices_format = number_format($numsum,0,'.',',')."원";

		
		$images_src = $rows->images;
		$link = "./detail.php?uid=".$rows->GID;
			
		$body ="<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
				<tr>
				<td style='font-size:12px;padding:10px;' width=\"80\" rowspan=\"3\"><a href='$link'><img src='$images_src' border=0 width='80'></a></td>
				<td style='font-size:12px;padding:10px;' width=\"25\"><input type='checkbox' name='TID[]' value='".$rows->Id."' checked></td>
				<td style='font-size:12px;padding:10px;' ><a href='$link'>".$rows->goodname."</a></td>
				</tr>
				<tr>
				<td style='font-size:12px;padding:10px;' width=\"25\">&nbsp;</td>
				<td style='font-size:12px;padding:10px;' ><input type='text' name='num[]' min='1' max='1000' value='".$rows->num."' id=\"cart_num\"> 
															<br><a href='#' onclick=\"javascript:cart_num('".$rows->Id."')\">수량변경</a></td>
				</tr>
				<tr>
				<td style='font-size:12px;padding:10px;' width=\"25\">&nbsp;</td>
				<td style='font-size:12px;padding:10px;'>".$rows->currency." : $prices_format</td>
				</tr>
				<tr>
				<td style='font-size:12px;padding:10px;' width=\"80\"><a href='#' onclick=\"javascript:cart_remove('".$rows->Id."')\">삭제</a></td>
				<td style='font-size:12px;padding:10px;' width=\"25\">&nbsp;</td>
				<td style='font-size:12px;padding:10px;'>배송방식: $shipping[0]-$shipping[1]</td>
				</tr>
				<tr>
				<td style='font-size:12px;padding:10px;' colspan=\"3\">Option: ".$rows->option."</td>
				</tr>
				<tr>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' colspan=\"3\">".$rows->ordertext."</td>
				</tr>
				</table>";
	
		return $body;
	}


	function _cartform_subtotal($sub_prices,$sub_shipping,$sub_total,$seller){
			
		$prices_format = number_format($sub_total,0,'.',',')."원";

		$list ="<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
		$list .="<tr><td style='font-size:12px;padding:10px;'></td>";
		$list .="<td style='font-size:12px;padding:10px;' width='200'>구매가격: $sub_prices</td>";
		$list .="<td style='font-size:12px;padding:10px;' width='150'>배송: $sub_shipping</td>";
		$list .="</tr>";
		$list .="<tr><td style='font-size:12px;padding:10px;'></td>";
		$list .="<td style='font-size:12px;padding:10px;' width='200'><strong>소계(배송료 포함): $prices_format</strong></td>";
		$list .="<td style='font-size:12px;padding:10px;' width='150'>
					<input type='button' name='seller_order[]' value='구매주문' onclick=\"javascript:cart_seller('".$seller."')\" id=\"btn_cart_seller_order\"></td>";
		$list .= "</tr></table>";		
		return $list;
	}


	function _cartform_total($total_prices){

		$prices_format = number_format($total_prices,0,'.',',')."원";

		$list  ="<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
		$list .="<tr>
					<td style='font-size:12px;padding:10px;'></td>";
		$list .="	<td style='font-size:12px;padding:10px;' width='150'> </td>";
		$list .="	<td style='font-size:12px;padding:10px;' width='150'>합계 : $prices_format</td>";
		$list .="</tr>";
		$list .="<tr>
					<td style='font-size:12px;padding:10px;'><input type='button' name='delete' value='Delete' onclick=\"javascript:cart_delete()\" id=\"btn_cart_delete\"></td>";
		$list .="	<td style='font-size:12px;padding:10px;' width='150'></td>";
		$list .="	<td style='font-size:12px;padding:10px;' width='150'>
						<input type='button' name='all_order' value='전체주문' onclick=\"javascript:cart_order()\" id=\"btn_cart_all_order\"></td>";
		$list .="</tr>";
		$list .="</table>";
		return $list;
	}
	
?>