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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");

	$javascript = "<script>

		function form_submit(mode,uid){
			var url = \"ajax_shop_orders_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#mainbody').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});		
		}

		function form_delete(mode,uid){
			var returnValue = confirm(\"삭제하겠습니까?\");
			if(returnValue == true){
				var url = \"ajax_shop_orders_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
				$.ajax({
                	url:url,
                	type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('#mainbody').html(data);
                	}
            	});
			}

			
		}

		function order_trans(uid){
			var url = \"shop_orders_trans.php?uid=\"+uid;
			popup_ajax(url);
		}




	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		/////////////
		// $skin_name = "default";
		// $body = _skin_page($skin_name,"shop_orders_detail");
		$body = $javascript._theme_page($site_env->theme,"shop_orders_detail",$site_language,$site_mobile);


		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");		

		$body=str_replace("{formstart}","<form id='data' name='shop' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		$body = str_replace("{delete}","<input type='button' value='주문삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		$body = str_replace("{print}","<input type='button' value='인쇄' onclick=\"javascript:order_print('".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		$body = str_replace("{trans}","<input type='button' value='매출전표' onclick=\"javascript:order_trans('".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

		// 주문처리 버튼
		$submit_button = $script;
		$query = "select * from `shop_orders` where Id='$uid'";
		if($rows = _sales_query_rows($query)){

			$body = str_replace("{regdate}",$rows->regdate,$body);		// 주문일자
			$body = str_replace("{ordercode}",$rows->ordercode,$body);	// 주문번호 (장바구니 번호 동일)

			$body = str_replace("{payment}",$rows->payment,$body);		// 주문방법 표기
			if($rows->payment == "bank"){
				// 무통장 입금일 경우, 선택 은행 표기
				$bank = explode(":", $rows->bankid);
				$query = "select * from `shop_bank` WHERE `Id`='".$bank[1]."'";
				if($bank_rows = _sales_query_rows($query)){
					$body = str_replace("{payment_info}",$bank_rows->bankname." / ".$bank_rows->banknum." / ".$bank_rows->bankuser,$body);
				} else $body = str_replace("{payment_info}","-",$body);
				
			} else {
				// 신용카드등 결제방식 부분 선택
				$body = str_replace("{payment_info}","",$body);
			}

			$body = str_replace("{order_status}",$rows->status,$body);	// 주문 상태 표기

			// *** 주문자 접보 표기
			$body = str_replace("{order_name}",$rows->username."".$rows->firstname,$body);
			$body = str_replace("{email}",$rows->email,$body);
			$body = str_replace("{phone}",$rows->puserhone,$body);
			$body = str_replace("{domain}",$rows->domain,$body);


			$order_status = "<select name='status' style=\"$css_textbox\">";
			$order_status .= "<option value='new'>신규주문</option>";
			$order_status .= "<option value='banking'>입금중</option>";
			$order_status .= "<option value='bank'>입금요청</option>";
			$order_status .= "<option value='banked'>입금완료</option>";
			$order_status .= "<option value='paid'>결제완료</option>";
			$order_status .= "<option value='fail'>결제실페</option>";
			$order_status .= "<option value='prepare'>배송준비</option>";
			$order_status .= "<option value='shipping'>배송중</option>";
			$order_status .= "<option value='shipped'>배송완료</option>";
			$order_status .= "<option value='finish'>주문완료</option>";
			$order_status .= "<option value='canceling'>주문취소</option>";
			$order_status .= "<option value='canceled'>취소승인</option>";
			$order_status .= "<option value='refunding'>환불요청</option>";
			$order_status .= "<option value='refunded'>환불완료</option>";
			$order_status .= "<option value='disputing'>분쟁중</option>";
			$order_status .= "<option value='disputed'>분쟁완료</option>";			
			$order_status .= "</select>";

			$order_status = str_replace($rows->status."'",$rows->status."' selected",$order_status);
			$body = str_replace("{status}",$order_status,$body);

			$submit_button .= "<input type='button' value='상태저장' onclick=\"javascript:form_submit('editup','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$submit_button,$body);

			// 주문자 , 제품수령 주소
			$query = "select * from `shop_orders_address` WHERE Id = '".$rows->orders_address."' order by regdate desc";
			$address_rows = _sales_query_rows($query);

			$body = str_replace("{receive_country}",$address_rows->country,$body);
			$body = str_replace("{receive_city}",$address_rows->city,$body);
			$body = str_replace("{receive_state}",$address_rows->state,$body);
			$body = str_replace("{receive_firstname}",$address_rows->firstname,$body);
			$body = str_replace("{receive_lastname}",$address_rows->lastname,$body);
			$body = str_replace("{receive_phone}",$address_rows->phone,$body);
			$body = str_replace("{receive_post}",$address_rows->post,$body);
			$body = str_replace("{receive_address}",$address_rows->address,$body);
			
			
			// ************
			// 주문 상품 리스트 
			$query = "select * from `shop_orders_detail` WHERE ordercode = '".$rows->ordercode."' order by regdate desc";
			if($rowss_orders_detail = _sales_query_rowss($query)){	
				for($j=0;$j<count($rowss_orders_detail);$j++){
					$rows2 = $rowss_orders_detail[$j];

					// $goods = _goods_rows($rows2->GID);
						
					$numsum = $rows2->prices * $rows2->num;		// 수량별 가격 
					$numsum += $numsum / 100 * $rows2->vat;	// 부가세 부분 추가 4
					
					$images = "<div><img src='http://".$sales_db->domain.$rows2->images."' width='100'></div>";

					$goodsname = "<div>".$rows2->goodname."</div>";
					$goodsname .= "<div>선택옵션 : ".$rows2->option."</div>";
					$goodsname .= "<div>주문문구 : ".$rows2->ordertext."</div>";
					if($rows->upload) $goodsname .= "<div>첨부파일 : <a href=\"http://".$sales_db->domain."/".$rows->upload."\">".$rows->upload."</a></div>";

					$prices = "<div>".$rows2->currency." : $numsum</div>";
					$prices .= "<div>수량 ".$rows2->num."</div>";
					$prices .= "<div>배송방식: ". $rows2->shipping ."</div>";

					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>								
						<td style='font-size:12px;padding:10px;' width=\"100\" valign=\"top\">".$images."</td>
						<td style='font-size:12px;padding:10px;' valign=\"top\">".$goodsname."</td>
						<td style='font-size:12px;padding:10px;' width=\"150\" valign=\"top\">".$prices."</td>
						<td style='font-size:12px;padding:10px;' width=\"150\" valign=\"top\">".$tid."</td>
						</tr>
					</table>";	

				}
			
				$body = str_replace("{order_detail_list}",$list,$body);
			} else {
				$body = str_replace("{order_detail_list}","주문 상품목록이 없습니다.",$body);
			}
		}		

		// ************
		// 배송정보 입력
	
		$query = "select * from `shop_orders_shipping` WHERE ordercode = '".$rows->ordercode."'";
		$shipping_rows = _sales_query_rows($query);
		
		$body = str_replace("{shipping_company}",_form_text("shipping_company",$shipping_rows->company,$css_textbox),$body);
		
		$body = str_replace("{shipping_datetime}",_form_text("shipping_datetime",$shipping_rows->regdate,$css_textbox),$body);
		
		$body = str_replace("{shipping_invoice}",_form_text("shipping_invoice",$shipping_rows->invoice,$css_textbox),$body);
	
		$body = str_replace("{shipping_firstname}",_form_text("shipping_firstname",$shipping_rows->firstname,$css_textbox),$body);
		$body = str_replace("{shipping_lastname}",_form_text("shipping_lastname",$shipping_rows->lastname,$css_textbox),$body);
		$body = str_replace("{shipping_phone}",_form_text("shipping_phone",$shipping_rows->phone,$css_textbox),$body);
		

		echo $body;


	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	
?>