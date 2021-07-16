<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.25 

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

	include "./func/css.php";

	include "./func/error.php";
	include "./func/goods.php";
	include "./func/members.php";
	include "./func/orders.php";

	


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		// 내부 스크립트 설정
		
		$javascript = "<script>
			function cart_edit(mode,uid){
			
				$.ajax({
                    url:'/ajax_shop_cart_edit.php?uid='+uid+'&mode='+mode,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                       $('#mainbody').html(data);
                    }
                });
            
            }
                

            function list(limit){
                var search = document.cart.searchkey.value;
                $.ajax({
                    url:'/ajax_shop_cart.php?limit='+limit+'&search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#mainbody').html(data);
                    }
                }); 	
            }

        </script>";
	


		// 스킨템플릿 읽어오기
		$body = $javascript._skin_page($skin_name,"shop_cart");
		
	
		// POST / GET 값 읽어오기 
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 
		$country = _formdata("country");
		$ajaxkey = _formdata("ajaxkey");
		$searchkey = _formdata("searchkey");


		// Form 설정
		$body = str_replace("{formstart}","<form name='cart' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);
		$body = str_replace("{search}","<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >",$body);
	
		

		function _cart_detail_list($rows){
			global $sales_db;

			$goods = _goods_rows($rows->GID);
						
			$numsum = $rows->prices * $rows->num;		// 수량별 가격 
			$numsum += $numsum / 1000 * $rows->vat;	// 부가세 부분 추가 4

			$tid = "<input type='checkbox' name='TID[]' value='".$rows2->Id."' >";
			$images = "<div><img src='".$goods->images1."' width='100'></div>";

			$goodsname = "<div>".$rows->goodname."</div>";
			$goodsname .= "<div>옵션 : ".$rows->option."</div>";
			$goodsname .= "<div>주문문구 : ".$rows->ordertext."</div>";

			$prices = "<div>".$rows->currency." : $numsum</div>";
			$prices .= "<div>수량 ".$rows->num."</div>";
			$prices .= "<div>배송방식: ". $rows->shipping ."</div>";

			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>								
						<td style='font-size:12px;padding:10px;' width=\"100\" valign=\"top\">".$images."</td>
						<td style='font-size:12px;padding:10px;' width=\"20\" valign=\"top\">".$tid."</td>
						<td style='font-size:12px;padding:10px;' valign=\"top\">".$goodsname."</td>
						<td style='font-size:12px;padding:10px;' width=\"150\" valign=\"top\">".$prices."</td>
						</tr>
					</table>";	


			return $list;
		}

		///////////////////
		// 주문목록 및 이력 출력  
		
		$query = "select * from `shop_cart` ";
		$query .="order by regdate desc ";

		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){	

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0,$list ="";$i<$count;$i++){
				$rows = $rowss[$i];

				$list .= "<!-- CARTLIST -->
				<div style='border:1px solid #E9E9E9;font-size:12px;padding:5px;'>
					<!-- 기본정보 -->
					<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\"><a href='#' onclick=\"javascript:cart_edit('edit','".$rows->Id."')\" >".$rows->regdate."</a></td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;'>".$rows->username." ".$rows->firstname." / ".$rows->email."</td>				
					</tr>
					</table>

					<!-- 주문상품 -->

					"._cart_detail_list($rows)."
				</div><br>";

			}
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{cart_list}",$list,$body);		

		} else {
			$msg = "장바구니 내역이 없습니다.";
			$body = str_replace("{cart_list}",$msg,$body);
		}
		
		echo $body;	
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


?>