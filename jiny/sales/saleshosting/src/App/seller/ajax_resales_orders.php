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
	include "./func/members.php";
	include "./func/orders.php";

	function _listbar($_list_num,$_block_num,$limit,$total){
		$status = _formdata("status");

		$total_list = intval( $total / $_list_num ); // 전페 리스트 수
		$total_block = intval( $total_list / $_block_num ); // 전체 블럭 수
		$pageMenu = "";
		$pre = ""; $next = "";

		if($limit != 0) $pageMenu .= "[<a href='#' onclick=\"javascript:mem_list('0','$status')\">First</a>] "; // 처음 테이터

		$current_list = intval( $limit / $_list_num );
		$current_block = intval( $current_list / $_block_num );

		if( $current_block >1) {
			$pre = ($current_block - 1) * $_block_num * $_list_num; 
			$pageMenu .= "[<a href='#' onclick=\"javascript:mem_list('".$pre."','$status')\">Pre</a>] "; // 이전 블럭 
		}

		$i = $current_block * $_list_num;
		$count = $i + $_block_num; if($count>$total_list) $count = $total_list;
		for(;$i<$count; $i++){
			$j = $i * $_list_num;
			// if($limit == $j) $pageMenu .= "[<b>$i</b>] "; else $pageMenu .= "[<a href='".$_SERVER['PHP_SELF']."?limit=$j'>$i</a>] ";
			//  
			if($limit == $j){
				$pageMenu .= "[<b>$i</b>] "; 
			} else {
				$pageMenu .= "[<a href='#' onclick=\"javascript:mem_list('".$j."','$status')\">$i</a>] ";
			}
		}

		if( $current_block < $total_block) {
			$next = $pre + $_block_num * $_list_num * 2; 
			$pageMenu .= "[<a href='#' onclick=\"javascript:mem_list('".$next."','$status')\">Next</a>] "; // 다음 블럭 
		}

		$last = $total_list * $_list_num;
		if($limit != $last) $pageMenu .= "[<a href='#' onclick=\"javascript:mem_list('".$last."','$status')\">Last</a>]"; // 마지막 데이터

		return "<center>".$pageMenu."</center>";
	}





	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		// 내부 스크립트 설정
		
		$javascript = "<script>
			function orders_edit(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_shop_orders_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
                
            function orders_list(limit,status){
                	var search = document.members.searchkey.value;
                  	$.ajax({
                        url:'/ajax_shop_orders.php?limit='+limit+'&search='+search+'&status='+status,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
        </script>";
	


		// 스킨템플릿 읽어오기
		$body = $javascript._skin_page($skin_name,"shop_orders");
		
	
		// POST / GET 값 읽어오기 
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 
		$cate = _formdata("cate");
		$country = _formdata("country");
		$ajaxkey = _formdata("ajaxkey");
		$searchkey = _formdata("searchkey");
		$status = _formdata("status");

		// Form 설정
		$body = str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey'>",$body);
		$body = str_replace("{search}","<input type='button' value='검색' onclick=\"javascript:orders_list('0','$status')\" id=\"".$css_btn_gray."\" >",$body);
	
		if(!$status)
		$body = str_replace("{s0}","<input type='radio' name='status' value='' checked>",$body); // 신규주문
		else $body = str_replace("{s0}","<input type='radio' name='status' value='' onclick=\"javascript:orders_list('0','$status')\">",$body); // 신규주문
	
		if($status == "new")
		$body = str_replace("{s1}","<input type='radio' name='status' value='new' checked>",$body); // 신규주문
		else $body = str_replace("{s1}","<input type='radio' name='status' value='new' onclick=\"javascript:orders_list('0','$status')\">",$body); // 신규주문

		if($status == "banking")
		$body = str_replace("{s2}","<input type='radio' name='status' value='banking' checked>",$body); // 입금중
		else $body = str_replace("{s2}","<input type='radio' name='status' value='banking' onclick=\"javascript:orders_list('0','$status')\">",$body); // 입금중
		//if($rows->status != "banking") $submit_button .= "<input type='button' value='입금중' onclick=\"javascript:form_submit('banking','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "bank")
		$body = str_replace("{s3}","<input type='radio' name='status' value='bank' checked>",$body); // 입금요청
		else $body = str_replace("{s3}","<input type='radio' name='status' value='bank' onclick=\"javascript:orders_list('0','$status')\">",$body); // 입금요청
		//if($rows->status != "bank") $submit_button .= "<input type='button' value='입금요청' onclick=\"javascript:form_submit('bank','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "banked")
		$body = str_replace("{s4}","<input type='radio' name='status' value='banked' checked>",$body); // 입금완료
		else $body = str_replace("{s4}","<input type='radio' name='status' value='banked' onclick=\"javascript:orders_list('0','$status')\">",$body); // 입금완료 
		//if($rows->status != "banked") $submit_button .= "<input type='button' value='입금완료' onclick=\"javascript:form_submit('banked','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "paid")
		$body = str_replace("{s5}","<input type='radio' name='status' value='paid' checked>",$body); // 결제완료
		else $body = str_replace("{s5}","<input type='radio' name='status' value='paid' onclick=\"javascript:orders_list('0','$status')\">",$body); // 결제완료
		//if($rows->status != "paid") $submit_button .= "<input type='button' value='결제완료' onclick=\"javascript:form_submit('paid','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "fail")
		$body = str_replace("{s6}","<input type='radio' name='status' value='fail' checked>",$body); // 결제실페
		else $body = str_replace("{s6}","<input type='radio' name='status' value='fail' onclick=\"javascript:orders_list('0','$status')\">",$body); // 결제실페
		// $submit_button .= "<input type='button' value='결제실페' onclick=\"javascript:form_submit('fail','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "parepare")
		$body = str_replace("{s7}","<input type='radio' name='status' value='prepare' checked>",$body); // 배송준비
		else $body = str_replace("{s7}","<input type='radio' name='status' value='prepare' onclick=\"javascript:orders_list('0','$status')\">",$body); // 배송준비
		// if($rows->status != "parepare") $submit_button .= "<input type='button' value='배송준비' onclick=\"javascript:form_submit('prepare','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "shipping")
		$body = str_replace("{s8}","<input type='radio' name='status' value='shipping' checked>",$body); // 배송중
		else $body = str_replace("{s8}","<input type='radio' name='status' value='shipping' onclick=\"javascript:orders_list('0','$status')\">",$body); // 배송중
		//if($rows->status != "shipping") $submit_button .= "<input type='button' value='배송중' onclick=\"javascript:form_submit('shipping','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "shipped")
		$body = str_replace("{s9}","<input type='radio' name='status' value='shipped' checked>",$body); // 배송완료
		else $body = str_replace("{s9}","<input type='radio' name='status' value='shipped' onclick=\"javascript:orders_list('0','$status')\">",$body); // 배송완료
		//if($rows->status != "shipped") $submit_button .= "<input type='button' value='배송완료' onclick=\"javascript:form_submit('shipped','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "finish")
		$body = str_replace("{s10}","<input type='radio' name='status' value='finish' checked>",$body); // 주문와료
		else $body = str_replace("{s10}","<input type='radio' name='status' value='finish' onclick=\"javascript:orders_list('0','$status')\">",$body); // 주문와료
		//if($rows->status != "finish") $submit_button .= "<input type='button' value='주문완료' onclick=\"javascript:form_submit('finish','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "canceling")
		$body = str_replace("{s11}","<input type='radio' name='status' value='canceling' checked>",$body); // 취소요청
		else $body = str_replace("{s11}","<input type='radio' name='status' value='canceling' onclick=\"javascript:orders_list('0','$status')\">",$body); // 취소요청
		//if($rows->status != "canceling") $submit_button .= "<input type='button' value='취소요청' onclick=\"javascript:form_submit('canceling','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "canceled")
		$body = str_replace("{s12}","<input type='radio' name='status' value='canceled' checked>",$body); // 취소승인
		else $body = str_replace("{s12}","<input type='radio' name='status' value='canceled' onclick=\"javascript:orders_list('0','$status')\">",$body); // 취소승인
		//if($rows->status != "canceled") $submit_button .= "<input type='button' value='취소승인' onclick=\"javascript:form_submit('canceled','".$uid."')\" id=\"".$css_btn_gray."\" >";
			
		if($status == "refunding")
		$body = str_replace("{s13}","<input type='radio' name='status' value='refunding' checked>",$body); // 환불요청
		else $body = str_replace("{s13}","<input type='radio' name='status' value='refunding' onclick=\"javascript:orders_list('0','$status')\">",$body); // 환불요청
		//if($rows->status != "refunding") $submit_button .= "<input type='button' value='환불요청' onclick=\"javascript:form_submit('refunding','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "refunded")
		$body = str_replace("{s14}","<input type='radio' name='status' value='refunded' checked>",$body); // 환불완료 
		else $body = str_replace("{s14}","<input type='radio' name='status' value='refunded' onclick=\"javascript:orders_list('0','$status')\">",$body); // 환불완료 
		//if($rows->status != "refunded") $submit_button .= "<input type='button' value='환불완료' onclick=\"javascript:form_submit('refunded','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "disputing")
		$body = str_replace("{s15}","<input type='radio' name='status' value='disputing' checked>",$body); // 분쟁중
		else $body = str_replace("{s15}","<input type='radio' name='status' value='disputing' onclick=\"javascript:orders_list('0','$status')\">",$body); // 분쟁중
		//if($rows->status != "disputing") $submit_button .= "<input type='button' value='분쟁중' onclick=\"javascript:form_submit('disputing','".$uid."')\" id=\"".$css_btn_gray."\" >";

		if($status == "disputed")
		$body = str_replace("{s16}","<input type='radio' name='status' value='disputed' checked>",$body); // 분쟁완료 
		else $body = str_replace("{s16}","<input type='radio' name='status' value='disputed' onclick=\"javascript:orders_list('0','$status')\">",$body); // 분쟁완료 
		//if($rows->status != "disputed") $submit_button .= "<input type='button' value='분쟁완료' onclick=\"javascript:form_submit('disputed','".$uid."')\" id=\"".$css_btn_gray."\" >";
	


		///////////////////
		// 주문목록 및 이력 출력  
		
		$query = "select * from `shop_orders` ";
		if($status) $query .= " where status = '$status' ";
		$query .="order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	

			$seller="";
			$sub_shipping = 0;
			$sub_shipping_method = "";
			$list ="";
			for($i=0,$total_prices=0,$sub_prices=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				$url_link = "<a href='#' onclick=\"javascript:orders_edit('edit','".$rows->Id."')\" >".$rows->cartlog."</a>";
				$list .="<table border='0' width='100%' cellspacing='5' cellpadding='5' style='font-size:12px;padding:10px;border:1px solid #E9E9E9;'>";
				$list .="<tr><td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;'>Seller: <strong>".$url_link."</strong> ". $rows->regdate ."</td></tr>";
				$list .="<tr><td>";

				$query = "select * from `shop_orders_detail` WHERE ordercode = '".$rows->ordercode."' order by regdate desc";
				if($rowss_orders_detail = _sales_query_rowss($query)){	
					for($j=0;$j<count($rowss_orders_detail);$j++){
						$rows2 = $rowss_orders_detail[$j];
						
						$goods = _goods_rows($rows2->GID);
						
						//$images_location = _goods_images($goods);
						//$link = "./detail.php?uid=".$rows2->GID;

						$numsum = $rows2->prices * $rows2->num;		// 수량별 가격 
						$numsum += $numsum / 1000 * $rows2->vat;	// 부가세 부분 추가 

						$list .="<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>";
						$list .="<tr>
					
						<td style='font-size:12px;padding:10px;' width='20' valign='top'><input type='checkbox' name='TID[]' value='".$rows2->Id."' checked></td>
						<td style='font-size:12px;padding:10px;' valign='top'>".$rows2->goodname."</td>
						<td style='font-size:12px;padding:10px;' width='100' valign='top'>".$rows2->num."</td>
						<td style='font-size:12px;padding:10px;' width='130' valign='top'>".$rows2->currency." : $numsum</td>
						<td style='font-size:12px;padding:10px;' width='70' valign='top'>".$rows2->status."</td>
						</tr>
						<tr>
						<td style='font-size:12px;padding:10px;' width='20' valign='top'>　</td>
						<td style='font-size:12px;padding:10px;' valign='top'>Option: ".$rows2->option."</td>
						<td style='font-size:12px;padding:10px;' width='300' valign='top' colspan='3'>Delivery Shipping: ". $rows2->shipping ."</td>
						</tr>
						<tr>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' width='20' valign='top'>　</td>
						<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' valign='top' colspan='4'>".$rows2->ordertext."</td>
						</tr>";
						$list .="</table>";


					}
				
				}

				$list .="</td></tr>";
				$list .="</table> <br>";



			}

			$body = str_replace("{orders_list}",$list,$body);
			// echo $body;
			

		} else {
			$msg = "주문 내역이 없습니다.";
			$body = str_replace("{orders_list}",$msg,$body);
			// echo $msg;
		}
		
		echo $body;	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


?>