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

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		include "./sales.php";


		$javascript = "<script>
			function popup_submit(){
				// 카테고리 설정 처리 
				var url = \"/ajax_shop_goods_prices_setup.php\";
				$.ajax({
            		url:url,
               		type:'post',
	               	data:$('form').serialize(),
	               	success:function(data){
                   		//$('#popup_body').html(data);
               		}
            	});

				// 팝업창 종료
				popup_close();

				// 갱신
				var url = \"/ajax_shop_goods.php\";
            	ajax_html('#mainbody',url); 	
			}

            // 팝업창 닫기
    		$('#popup_close').on('click',function(){
        		popup_close();
    		});    		 

        </script>";

        // 팝업창
        function _popup_div($title,$width){
        	$title_width = $width - 42;

        	$popup_header  = _html_div("popup_title","float:left;width:".$title_width."px; height:30px;display:table-cell;vertical-align:middle;padding:5px;",$title);
        	$popup_header .= _html_div("popup_close","width:30px;text-align:center; height:30px;display:table-cell;vertical-align:middle;","X");

        	$width = $width -2;
			return _html_div_clearfix($popup_header,"width:".$width."px;border-bottom:1px solid #E9E9E9;");
        }
        
        $title = "Quick 가격 설정 ";
		$body = $javascript._html_div("popup","border:1px solid #5f5f5f;width:800px",
					_popup_div($title,"800")._skin_page($skin_name,"shop_goods_pricesset") );
		
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$category = _formdata("category");
		$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='category' value='$category'>	
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		//# 매입 / B2B / 판매 가격 설정
			$query = "select * from `shop_currency`";
			if($rowss = _sales_query_rowss($query)){
				$buy_currency = "<select name='buy_currency' style=\"$css_textbox\" >";
				$b2b_currency = "<select name='b2b_currency' style=\"$css_textbox\" >";
				$sell_currency = "<select name='sell_currency' style=\"$css_textbox\" >";

				for($ii=0;$ii<count($rowss);$ii++){
					$rows1=$rowss[$ii];

					if($goods->buy_currency == $rows1->currency) {
						$buy_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
					} else {
						$buy_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
					}

					if($goods->b2b_currency == $rows1->currency) {
						$b2b_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
					} else {
						$b2b_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
					}

					if($goods->sell_currency == $rows1->currency) {
						$sell_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
					} else {
						$sell_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
					}
				}

				$buy_currency .= "</select>";
				$b2b_currency .= "</select>";
				$sell_currency .= "</select>";

				$body = str_replace("{buy_currency}",$buy_currency,$body);
				$body = str_replace("{b2b_currency}",$b2b_currency,$body);
				$body = str_replace("{sell_currency}",$sell_currency,$body);

				//$body = str_replace("{prices_buy}","<input type='text' name='prices_buy' value='".$goods->prices_buy."' id=\"cssFormStyle\" >",$body);
				$body = str_replace("{prices_buy}",_form_text("prices_buy",$goods->prices_buy,$css_textbox),$body);
				//$body = str_replace("{prices_b2b}","<input type='text' name='prices_b2b' value='".$goods->prices_b2b."' id=\"cssFormStyle\" >",$body);
				$body = str_replace("{prices_b2b}",_form_text("prices_b2b",$goods->prices_b2b,$css_textbox),$body);
				//$body = str_replace("{prices_sell}","<input type='text' name='prices_sell' value='".$goods->prices_sell."' id=\"cssFormStyle\"  >",$body);
				$body = str_replace("{prices_sell}",_form_text("prices_sell",$goods->prices_sell,$css_textbox),$body);
			}




		if($TID = $_POST['TID']){
			for($i=0,$amount=0;$i<count($TID);$i++){
    			// echo $TID[$i]."/ ";
				echo "<input type='hidden' name='TID[]' value='".$TID[$i]."'>";
			}
		}

		$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:popup_submit()\" style=\"".$css_btn_gray."\" >
				",$body);	
		

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
