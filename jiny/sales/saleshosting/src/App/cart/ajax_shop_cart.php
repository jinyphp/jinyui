<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.25 

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


	// 내부 스크립트 설정		
	$javascript = "<script>
		function check_action(mode){
			var url = \"ajax_shop_cart_editup.php\";
			var form = document.shop;
  			form.mode.value = mode;
            ajax_none(url);
            
        	ajax_html('#mainbody',\"ajax_shop_cart.php\");
        }

		function cart_edit(mode,uid,limit){
			var url = \"shop_cart_edit.php\";		
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

        function list(limit){
           	var url = \"ajax_shop_cart.php\";
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

		$body = $javascript._theme_page($site_env->theme,"shop_cart",$site_language,$site_mobile);
		

		// POST / GET 값 읽어오기 
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$searchkey = _formdata("searchkey");


		// Form 설정
		$body = str_replace("{formstart}","<form name='shop' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);
		$body = str_replace("{search}","<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >",$body);
	
		$button ="<input type='button' value='선택삭제' onclick=\"javascript:check_action('check_delete')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{delete}",$button,$body);

		$body = str_replace("{checkall}","<input type='checkbox' name='chk_all' id=\"check_all\">",$body);

		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);


		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","판매자국가") ,$body);

		function _cart_detail_list($rows){
			global $sales_db;

			// $goods = _goods_rows($rows->GID);
						
			$numsum = $rows->prices * $rows->num;		// 수량별 가격 
			$numsum += $numsum / 1000 * $rows->vat;	// 부가세 부분 추가 4

			$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."' >";
			$images = "<div><img src='http://".$sales_db->domain.$rows->images."' width='100'></div>";

			$goodsname = "<div>".$rows->goodname."</div>";
			$goodsname .= "<div>옵션 : ".$rows->option."</div>";
			$goodsname .= "<div>주문문구 : ".$rows->ordertext."</div>";

			// if($rows->upload) $goodsname .= "<div>첨부파일 : <a href=\"http://www.dojangshop.com/download.php?file_name=".$rows->upload."\">".$rows->upload."</a></div>";
			if($rows->upload) {
				$upload = explode(";", $rows->upload);
				for($i=0;$i<count($upload);$i++){
					$goodsname .= "<div>첨부파일 : <a href=\"http://".$sales_db->domain."/".$upload[$i]."\">".$upload[$i]."</a></div>";
				}				
			}

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
		
		$query = "select * from shop_cart ";
		if($searchkey) $query .= "where goodname like '%$searchkey%' or email like '%$searchkey%' ";
		$query .="order by regdate desc ";
		//echo $query;

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
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\"><a href='#' onclick=\"javascript:cart_edit('edit','".$rows->Id."','$limit')\" >".$rows->regdate."</a></td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;'>".$rows->username." ".$rows->firstname." / ".$rows->email."</td>				
					</tr>
					</table>

					<!-- 주문상품 -->

					"._cart_detail_list($rows)."
				</div><br>";

			}
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{cart_list}",$list,$body);		

		} else {
			$msg = "장바구니 내역이 없습니다.";
			$body = str_replace("{cart_list}", _msg_tableCell( _string($msg, $site_language) ), $body);
		}
		

		
		echo $body;	
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}


?>