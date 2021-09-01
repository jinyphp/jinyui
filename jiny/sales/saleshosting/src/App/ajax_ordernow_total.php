<?php
	// openshoppping 2.1
	// 2015.12.12
	// program by hojinlee
	// history :
	// description :
	// 상품설명, 장바구니 구매버튼 선택시 상품을 주문하는 기능

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
	

	if($TID = $_POST['TID']){
		$query = "select * from `shop_cart` WHERE ";
		for($i=0;$i<count($TID);$i++) if($i == 0) $query .= "`Id`='$TID[$i]'"; else $query .= " or `Id`='$TID[$i]'";
		if($rowss = _mysqli_query_rowss($query)){

			for($i=0,$sum=0,$list="";$i<count($rowss);$i++){
				$rows = $rowss[$i];	
					
				$sum = $rows->prices * $rows->num;
				$total_prices += $sum + $sum/100*$tax;

				if($this_seller != $rows->seller){
					$shipping_prices = explode(":", $rows->shipping);
					$shipping_prices_total += $shipping_prices[1];
					$this_seller = $rows->seller;
				} else {
					$list .= "";
				}
					
			}

			$payment_total = $total_prices + $shipping_prices_total;		

		} 
	} 


	$total_prices = number_format($total_prices,0,'.',',')."원";
	$shipping_prices_total = number_format($shipping_prices_total,0,'.',',')."원";
	$payment_total = number_format($payment_total,0,'.',',')."원";
	
	$list = "<span id=\"orders_total\">
				<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>
					<tr>
						<td></td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>합계 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$total_prices</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>배송료 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$shipping_prices_total</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>결제금액 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$payment_total</td>
					</tr>
				</table>
			  </span>";

	echo $list;		  

/*

	include "./func/error.php";
	include "./func/css.php";
	include "./func/ajax.php";
	include "./func/members.php";
	include "./func/goods.php";
	include "./func/orders.php";

	include "./func/cart.php";


	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}


	$css_tabbar = "<style>    
    	ul.tabs {
    		margin: 0;
    		padding: 0;
   			float: left;
    		list-style: none;
    		height: 32px;
    		border-bottom: 1px solid #eee;
    		border-left: 1px solid #eee;
    		width: 100%;
    		font-family:\"dotum\";
    		font-size:12px;
		}

		ul.tabs li {
    		float: left;
    		text-align:center;
    		cursor: pointer;
    		width:110px;
    		height: 31px;
    		line-height: 31px;
    		border: 1px solid #eee;
    		border-left: none;
    		font-weight: bold;
    		background: #fafafa;
    		overflow: hidden;
   		 position: relative;
		}

		ul.tabs li.active {
    		background: #FFFFFF;
    		border-bottom: 1px solid #FFFFFF;
		}

		.tab_container {
    		border: 1px solid #eee;
    		border-top: none;
    		clear: both;
    		float: left;
    		width: 100%;
    		background: #FFFFFF;
		}

		.tab_content {
    		padding: 5px;
    		font-size: 12px;
    		display: none;
		}

		.tab_container .tab_content ul {
   			width:100%;
    		margin:0px;
    		padding:0px;
		}

		.tab_container .tab_content ul li {
    		padding:5px;
    		list-style:none;
		}

		#container {
    		width: 100%;
    		margin: 0 auto;
		}

	</style>";


	$order_javascript =  "<script>

		function check_bank(mode){
			var bankid = $('input:radio[name=bankid]:checked').val();
        	if(bankid){
        		$.ajax({
            		url:'./ajax_orderby_bank.php?mode='+mode,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
        	} else {
        		 alert(\"계좌은행을 선택해 주세요\");
        	}				
		}

		function check_payment(mode){
			// 결제모듈 선택
			var payment = $('input:radio[name=payment]:checked').val();
			// alert(payment);

			if(payment == 'bank'){
				alert(\"무통장 주문\");
				check_bank(mode);
			} else if(payment == 'eximbay'){
				alert(\"Payment By Eximbay\");

				$.ajax({
            		url:'./ajax_orderby_eximbay.php?mode='+mode,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});

			} else if(payment == 'uplus'){
				alert(\"Payment By Uplus\");

				$.ajax({
            		url:'./ajax_orderby_uplus.php?mode='+mode,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});


			} else if(payment == 'inicis'){
				alert(\"Payment By Inicis\");

				$.ajax({
            		url:'./ajax_orderby_inicis.php?mode='+mode,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});

			} else if(payment == 'allthegate'){
				alert(\"Payment By Allthegate\");

				$.ajax({
            		url:'./ajax_orderby_allthegate.php?mode='+mode,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});

			} else alert(\"결제 방식을 선택해 주세요.\");
		}


		function order_paynow(mode){
			
			var email = $('#email').val();
			var password = $('#password').val();
			var phone = $('#phone').val();
			var address = $('#address').val();

			if(!email){
				alert(\"주문자 이메일을 입력해 주세요.\");
				$('#email').focus();
			} else if(!password){
				alert(\"주문자 비밀번호를 입력해 주세요.\");
				$('#password').focus();
			} else if(!phone){
				alert(\"수령자 연락처 입력해 주세요.\");
				$('#phone').focus();
			} else if(!address){
				alert(\"수령자 주소를 입력해 주세요.\");
				$('#address').focus();
			} else {
				// 결제 항목 체크
				check_payment(mode);
			}
	
		}

	
    	// Tab BAR 처리		
    	$(function () {

    		$(\".tab_content\").hide();
    		$(\".tab_content:first\").show();

    		$(\"ul.tabs li\").click(function () {
        		$(\"ul.tabs li\").removeClass(\"active\").css(\"color\", \"#333\");
        		//$(this).addClass(\"active\").css({\"color\": \"darkred\",\"font-weight\": \"bolder\"});
        		$(this).addClass(\"active\").css(\"color\", \"darkred\");
        		$(\".tab_content\").hide()
        		var activeTab = $(this).attr(\"rel\");
        		$(\"#\" + activeTab).fadeIn();
    		});
		});
	

    </script>";


	
    $body = _theme_page($site_env->theme,"order",$site_language,$site_mobile);
	$body = str_replace("{formstart}",$order_javascript."<form name='orders' method='post' enctype='multipart/form-data'>",$body);
	$body = str_replace("{formend}","</form>",$body);

			// 장바구니 구매 or 바로 구매 리스트 표시
	$mode = _formmode();
	// echo "mode is $mode <br>";
	$ordertext = _formdata("ordertext");
	// $shipping = _formdata("shipping");
	$tax = _formdata("tax"); // $_POST['tax'];
	$num = _formdata("num");
	$optionitems = _selected_options( _formdata("optionitem") );


	// 국가별 : 지정 계좌번호를 읽어옴
	$query = "select * from `shop_bank` WHERE `code`='".$site_country."' and enable='on'";
	if( $rowss = _mysqli_query_rowss($query) ){	
		
		$banklist  = "<table border='0' width='100%'' cellspacing='0' cellpadding='0'  >
						<tr>
						<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' align='right'>선택</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>은행명</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>예금주</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>계좌번호</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>Swiff Code</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>지점국가</td>
						</tr>
					  </table>";

		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];

			$bank_select = "<input type=radio name=bankid value='bank:".$rows->Id."'>";

			$banklist .= "<table border='0' width='100%'' cellspacing='0' cellpadding='0'  >
						<tr>
						<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' align='right'>$bank_select</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>".$rows->bankname."</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->bankuser."</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->banknum."</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>".$rows->swiff."</td>
						<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->country."</td>
						</tr>
					  </table>";
		}
	}





	//#결제방식 선택 
	$query1 = "select * from `shop_payment` ";	
	if($rowss1 = _mysqli_query_rowss($query1)){

		$payment_select = "";
		$payment_descript = "";

		for($i=0,$j=1;$i<count($rowss1);$i++,$j++){
			$rows1=$rowss1[$i];

			if($rows1->code == "bank"){
				$payment_select .= "<li class=\"active\" rel=\"tab".$j."\"><input type='radio' name='payment' value='".$rows1->code."' id=\"order_payment\" checked>".$rows1->payment."</li>";
				$payment_descript .="<div id=\"tab".$j."\" class=\"tab_content\">
				<div style='font-size:12px;padding:10px;'>".$rows1->descript."</div>".$banklist."									   												   
				</div>";

			} else {
				$payment_select .= "<li rel=\"tab".$j."\"><input type='radio' name='payment' value='".$rows1->code."' id=\"order_payment\">".$rows1->payment."</li>";

				$payment_descript .="<div id=\"tab".$j."\" class=\"tab_content\">
				<div style='font-size:12px;padding:10px;'>".$rows1->descript."</div>									   												   
				</div>";
			}

		}	

		$payment_tab ="<div id=\"container\">
    		<ul class=\"tabs\">".$payment_select."</ul>
    		<div class=\"tab_container\">".$payment_descript."</div>
			</div>";								
		$body = str_replace("{payment}",$css_tabbar.$payment_tab,$body);					
	} else {
		$body = str_replace("{payment}","설치된 지불결제 모듈이 없습니다.",$body);	
	}




	if($shipping_country = _shipping_country($css_textbox)){
		$body = str_replace("{delivery_country}",$shipping_country,$body);
	} else {
		$body = str_replace("{delivery_country}","배송불가 국가입니다.",$body);	
	}
	$body = str_replace("{delivery_way}","<span id=\"delivery_ways\"></span>",$body); // AJAX 처리 
	



	if(isset($_COOKIE['cookie_email']))	$members_rows = _members_rows($_COOKIE['cookie_email']);

	$body = str_replace("{city}","<input type='text' name='city' value='".$members_rows->city."' style=\"$css_textbox\" id=\"city\">",$body);
	$body = str_replace("{state}","<input type='text' name='state' value='".$members_rows->state."' style=\"$css_textbox\" id=\"state\">",$body);
	
	$body = str_replace("{firstname}","<input type='text' name='firstname' value='".$members_rows->firstname."' style=\"$css_textbox\" id=\"firstname\">",$body);
	$body = str_replace("{lastname}","<input type='text' name='lastname' value='".$members_rows->lastname."' style=\"$css_textbox\" id=\"lastname\">",$body);
	$body = str_replace("{phone}","<input type='text' name='phone' value='".$members_rows->phone."' style=\"$css_textbox\" id=\"phone\">",$body);
	$body = str_replace("{post}","<input type='text' name='post' value='".$members_rows->post."' style=\"$css_textbox\" id=\"post\">",$body);
	$body = str_replace("{address}","<input type='text' name='address' value='".$members_rows->address."' style=\"$css_textbox\" id=\"address\">",$body);
	$body = str_replace("{email}","<input type='text' name='email' value='".$members_rows->email."' style=\"$css_textbox\" id=\"email\">",$body);
	$body = str_replace("{password}","<input type='text' name='password' value='".$members_rows->password."' style=\"$css_textbox\" id=\"password\">",$body);
	
	// 결제버튼
	$body = str_replace("{paynow}","<input type='button' name='paynow' value='바로결제' onclick=\"javascript:order_paynow('".$mode."')\" id=\"btn_paynow\">",$body);

	
		

	
	// 선택 옵션값 처리
	function _selected_options($option){
		if($option){
	 		for($i=0,$optionitems = "";$i<count($option);$i++) $optionitems .=  $option[$i].";";	
	 	} else $optionitems = "";
	 	return $optionitems;
	}
	

	
	if($mode == "buynow"){
		_cart_up();	

		$query = "select * from `shop_cart` where cartlog='$cartlog'";
		if($rowss = _mysqli_query_rowss($query)){

			for($i=0,$sum=0,$list="";$i<count($rowss);$i++){
				$rows = $rowss[$i];

				if($site_mobile == "m") $list .= _formlist_bycart_m($rows,$num,$option,$rows->shipping,$ordertext);
				else $list .= _formlist_bycart($rows,$num,$option,$rows->shipping,$ordertext);

				$sum = $rows->prices * $rows->num;
				$total_prices += $sum + $sum/100*$tax;

				if($this_seller != $rows->seller){
					$shipping_prices = explode(":", $rows->shipping);
					$shipping_prices_total += $shipping_prices[1];
					$this_seller = $rows->seller;
				} else {
					$list .= "";
				}


			}

			$payment_total = $total_prices + $shipping_prices_total;
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>
					<tr>
						<td></td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>합계 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$total_prices</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>배송료 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$shipping_prices_total</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>결제금액 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$payment_total</td>
					</tr>
					</table>";
					
			$body = str_replace("{datalist}",$list,$body);

		} else {
			$msg = _string("선택한 상품의 장바구니를 읽을 수 없습니다.",$site_language);
			$body = str_replace("{datalist}",$msg,$body);
		}	

	} else {

		// 장바구니 내용 구매처리.
		// 장바구니에서 주문 버튼 처리.
		if($TID = $_POST['TID']){
			$query = "select * from `shop_cart` WHERE ";
			for($i=0;$i<count($TID);$i++) if($i == 0) $query .= "`Id`='$TID[$i]'"; else $query .= " or `Id`='$TID[$i]'";
			if($rowss = _mysqli_query_rowss($query)){

				for($i=0,$sum=0,$list="";$i<count($rowss);$i++){
					$rows = $rowss[$i];	

					if($site_mobile == "m") $list .= _formlist_bycart_m($rows,$num,$option,$rows->shipping,$ordertext);
					else $list .= _formlist_bycart($rows,$num,$option,$rows->shipping,$ordertext);

					
					$sum = $rows->prices * $rows->num;
					$total_prices += $sum + $sum/100*$tax;

					if($this_seller != $rows->seller){
						$shipping_prices = explode(":", $rows->shipping);
						$shipping_prices_total += $shipping_prices[1];
						$this_seller = $rows->seller;
					} else {
						$list .= "";
					}
					

				}

				
				$payment_total = $total_prices + $shipping_prices_total;
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>
					<tr>
						<td></td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>합계 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$total_prices</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>배송료 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$shipping_prices_total</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>결제금액 :</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='70'>$payment_total</td>
					</tr>
					</table>";

				$body = str_replace("{datalist}",$list,$body);

			} else {
				$msg = _string("선택한 상품의 장바구니를 읽을 수 없습니다.",$site_language);
				$body = str_replace("{datalist}",$msg,$body);
			}	

		} else {
			$msg = "선택한 장바구니 상품이 없습니다.";
			$body =_error_page($skin_name,$msg);
		}	
			
	}

			
	echo $body;
*/


?>