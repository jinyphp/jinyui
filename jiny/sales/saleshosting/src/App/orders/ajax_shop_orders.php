<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.18 = 코드정리 

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");


	$javascript = "<script>
		function check_action(mode){
			var url = \"ajax_shop_orders_editup.php\";
			var form = document.shop;
  			form.mode.value = mode;
            ajax_none(url);
        	ajax_html('#mainbody',\"ajax_shop_orders.php\");
        }

		function orders_edit(mode,uid,limit){
			var url = \"shop_orders_edit.php\";		
			var form = document.shop;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
	
        }

        $('#search_keyword').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	list(0);
        	}
    	}); 
                
        function orders_list(limit,status){
        	var url = \"ajax_shop_orders.php\";
       		var form = document.shop;
       		form.limit.value = limit;
			
			ajax_html('#mainbody',url);	
        }

        // 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.shop.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		}

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});
    </script>";
	


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		
		$body = $javascript._theme_page($site_env->theme,"shop_orders",$site_language,$site_mobile);
		
	
		// POST / GET 값 읽어오기 
		
		$mode = _formmode();
		$limit = _formdata("limit");
		$status = _formdata("status"); 		
		$searchkey = _formdata("searchkey");

		// Form 설정
		$body = str_replace("{formstart}","<form name='shop' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);
		$body = str_replace("{search}","<input type='button' value='검색' onclick=\"javascript:orders_list('0','$status')\" style=\"".$css_btn_gray."\" >",$body);

		$button ="<input type='button' value='선택삭제' onclick=\"javascript:check_action('check_delete')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{delete}",$button,$body);

		$button ="<input type='button' value='선택인쇄' onclick=\"javascript:check_action('check_print')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{print}",$button,$body);

		$button ="<input type='button' value='선택엑셀' onclick=\"javascript:check_action('check_excel')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{excel}",$button,$body);



		$body = str_replace("{checkall}","<input type='checkbox' name='chk_all' id=\"check_all\">",$body);

		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","판매자국가") ,$body);


	
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
	

		$_block_num = 10;
		if($_list_num = _formdata("list_num")){ 
		} else $_list_num = 10;

		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);


		function _order_detail_list($ordercode){
			global $sales_db;

			$query = "select * from `shop_orders_detail` WHERE ordercode = '".$ordercode."' order by regdate desc";
			if($rowss_orders_detail = _sales_query_rowss($query)){	
				for($j=0;$j<count($rowss_orders_detail);$j++){
					$rows2 = $rowss_orders_detail[$j];
						
					$goods = _goods_rows($rows2->GID);
						
					$numsum = $rows2->prices * $rows2->num;		// 수량별 가격 
					$numsum += $numsum / 1000 * $rows2->vat;	// 부가세 부분 추가 4
					/*
					$list .="<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
					$list .="<tr><td width='100'><img src='http://".$sales_db->domain."/".$goods->images1."' width='100'></td>
					<td></td></tr>";
					$list .="</table>";
					*/

					
					$images = "<div><img src='http://".$sales_db->domain.$rows2->images."' width='100'></div>";

					$goodsname = "<div>".$rows2->goodname."</div>";
					$goodsname .= "<div>옵션 : ".$rows2->option."</div>";
					$goodsname .= "<div>주문문구 : ".$rows2->ordertext."</div>";

					$prices = "<div>".$rows2->currency." : $numsum</div>";
					$prices .= "<div>수량 ".$rows2->num."</div>";
					$prices .= "<div>배송방식: ". $rows2->shipping ."</div>";
					$prices .= "<div>주문상태: ". $rows2->status ."</div>";

					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>								
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\" valign=\"top\">".$images."</td>					
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' valign=\"top\">".$goodsname."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\" valign=\"top\">".$prices."</td>
						</tr>
					</table>";	
					
				}
				
			}

			return $list;
		}

		///////////////////
		// 주문목록 및 이력 출력  
		$query = "select * from `shop_orders` ";
		// if($searchkey) $query .= "where goodname like '%$searchkey%' or email like '%$searchkey%' ";
		if($status) $query .= " where status = '$status' ";
		
		$query .="order by regdate desc ";
		//echo $query;

		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){	

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0,$list ="";$i<$count;$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows2->Id."' >";

				$list .= "<!-- Order -->
				<div style='border:1px solid #E9E9E9;font-size:12px;padding:5px;'>
					<!-- 기본정보 -->
					<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"20\" valign=\"top\">".$tid."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\">
							<a href='#' onclick=\"javascript:orders_edit('edit','".$rows->Id."','$limit')\" >".$rows->regdate."</a>
						</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;'>주문자 정보: ".$rows->username." ".$rows->firstname." / ".$rows->email."</td>				
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">주문상태 : ".$rows->status."</td>
					</tr>
					</table>

					<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>배송국가: ".$rows->country."/  도시: ".$rows->city."/  주소: ".$rows->address."</td>				
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">결제방법 : ".$rows->payment."</td>
					</tr>
					</table>

					<!-- 주문상품 -->

					"._order_detail_list($rows->ordercode)."
				</div><br>";

				
			}
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{orders_list}",$list,$body);		

		} else {
			$msg = "주문 내역이 없습니다.";
			$body = str_replace("{orders_list}",$msg,$body);
		}
		
		echo $body;	
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}


?>