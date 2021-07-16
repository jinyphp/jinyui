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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");

	$javascript = "<script>
		function goods_select(uid,name,prices){				
			$('#goodname').val(name);
			$('#gid').val(uid);			
			$('#prices').val(prices);
			$('#num').focus();

			popup_close();
		}

		$('#goods_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		popup_list(0);
        	}
    	});

		// ++ 팝업바디, 페이지 이동
		function popup_list(limit2){
			var url = \"ajax_sales_trans_goods.php?limit2=\" + limit2;
			ajax_async('#popup_body',url);   
        }

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

    	$('#popup_close').hover(function() {
        	$(this).css('cursor','pointer');
    	});

    	// 팝업창 리스트 변경
 		$('#popupListNum').on('change',function(){

        	// 목록 데이터 변경
        	popup_list(0);

        	// 팝업창 세로크기 가변으로 변경 처리
        	$('#popup_body').css('height','auto');

        	// 팝업창 생성으로 늘아난 윈도우 크기, 사이즈 재조정
            popup_maskSize();              

    	});

    	function popup_submit(mode){
			
            var url = \"ajax_sales_trans_goods.php?mode=\"+mode;
			$.ajax({
            	url:url,
            	type:'post',
            	async:false,
            	data:$('form').serialize(),
            	success:function(data){
            		$('#popup_body').html(data);
            	}
        	});

        	// 팝업창 종료
			// popup_close();
            	
		}		

    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 판매재고 관련 함수들...
		include "sales_function.php";

		$mode = _formdata("mode");
		if($mode == "newGoods"){
			// ++ 검색한 상품을 신규 등록합니다.
			echo $mode."<br>";
			
			$goods_search = _formdata("goods_search");
			echo "$goods_search <br>";

			$query = new query;
			$query->table_name = "sales_goods";

			$query->insert("regdate",$TODAYTIME);
			$query->insert("enable","on");
			$query->insert("name",$goods_search);

			$query->insert("prices_sell", "0");
			$query->insert("prices_buy", "0");
			$query->insert("prices_b2b", "0");
			
			$_query = $query->insert_query();				
			echo $_query;
			$gid = _sales_insert($_query);	

			// ++ 상품등록 gid 값을 입력
			echo "<script> 
				$('#gid').val(\"$gid\");
				$('#num').focus();

				popup_close();
			</script>";
		
		} else if($mode == "pricesTrans"){
			// ++ 상품목록을 출력합니다.
			if($site_mobile == "m") $width = "300px"; else $width = "1000px"; 		

			$title = "최근 거래가격";
			$body = $javascript._popup_body($title,$width, _theme_popup($site_env->theme,"sales_goods_list",$site_language,$site_mobile) );

			$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			echo $body;


		} else {
			// ++ 상품목록을 출력합니다.
			if($site_mobile == "m") $width = "300px"; else $width = "1000px"; 		

			$title = "전표 제품선택";
			$body = $javascript._popup_body($title,$width, _theme_popup($site_env->theme,"sales_goods_list",$site_language,$site_mobile) );

			$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>",$body);
			$body = str_replace("{formend}","</form>",$body);


			// 출력 목록수 지정
			$_block_num = 10;
			if($popupListNum = _formdata("popupListNum")){ } else $popupListNum = 10;
			$limit2 = _formdata("limit2");

			$form_num = str_replace("name='list_num'","name='popupListNum'",_listnum_select($popupListNum));
			$body = str_replace("{list_num}", $form_num,$body);


			if(_formdata("goods_search")) $goods_search = _formdata("goods_search"); else if(_formdata("goodname")) $goods_search = _formdata("goodname"); 
			$body = str_replace("{searchkey}","<input type='text' name='goods_search' value='".$goods_search."' id=\"goods_search\" style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:popup_list('0')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{btn_search}",$button_search,$body);


	
			$query = "select * from `sales_goods` ";
			if($goods_search) $query .= "where name like '%$goods_search%'";
			$query .= " order by regdate desc ";

			$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

			// 검색된 데이터 내에서 , limit2 설정 
			if($limit2) $query .= "LIMIT $limit2 , $popupListNum"; else $query .= "LIMIT 0 , $popupListNum ";		
			// echo $query;

			$datalist_width = array(0, 100, 50, 80, 80, 80, 80);
			$list = _table_datalist($datalist_width, array("제품명", "창고", "재고", "최근가격", "판매가격", "도매가격", "매입가격"));

			//++ 검색명으로 신규등록
			if($goods_search){
				$list .= "<div style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;text-align:left;'>".
							"[신규등록] <a href='#' onclick=\"javascript:popup_submit('newGoods')\">".$goods_search."</a></div>";
			}

			if($rowss = _sales_query_rowss($query)){
				$trans = _formdata("trans");
				$company_id = _formdata("company_id");
				
				$warehouse = _formdata("warehouse");
				$query = "select * from sales_goods_house where enable ='on'";
				if($house_rowss = _sales_query_rowss($query)){
				}

				if( ($total - $limit2) < $popupListNum ) $count = $total - $limit2; else $count = $popupListNum;

				for($i=0; $i<$count; $i++){
					$rows = $rowss[$i];	

					$query1 = "select * from sales_trans where gid='".$rows->Id."' and company_id = '".$company_id."' and trans = '$trans' order by transdate desc ";
					// echo $query1."<br>";
					if($pricesTrans_rows = _sales_query_rows($query1)){
						$transPrices = $pricesTrans_rows->prices;
						
					} else {
						$transPrices = 0;
					}

					$stock = _sales_totalStockHouse($rows,$house_rowss);

					$list .= _table_datalist($datalist_width, 
								array(
									$rows->name, 
									$rows->house, 
									$stock, 
									"<b><a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$transPrices."')\"> $transPrices </a></b>", 
									"<a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_sell."')\">".$rows->prices_sell."</a>", 
									"<a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_b2b."')\">".$rows->prices_b2b."</a>", 
									"<a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_buy."')\">".$rows->prices_buy."</a>"));
					/*
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->name."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->house."</td>";				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->stock."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_sell."')\">".$rows->prices_sell."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_b2b."')\">".$rows->prices_b2b."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$rows->prices_buy."')\">".$rows->prices_buy."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<b><a href='#' onclick=\"javascript:goods_select('".$rows->Id."','".$rows->name."','".$transPrices."')\"> $transPrices </a></b></td>";			
				$list .= "</tr></table>";
					*/
				
				}

				//# 코드재사용: 페이지 이동 스크립트 함수를 list() -> popup_list()로 변경 
				$list .= str_replace(":list", ":popup_list", _pagination($popupListNum,$_block_num,$limit,$total) );
				$body = str_replace("{list}", $list, $body);


			} else {
				$msg = "상품 목록이 없습니다.";
				$list .= _msg_tableCell( _string($msg, $site_language) );
				$body = str_replace("{list}", $list, $body);
			}	

			echo $body;

		}		
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
