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
	include "./func/orders.php";
	include "./func/butten.php";

	include "./func/css.php";
	include "./func/curl.php";
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		// 지정된 상품 하나를 읽어옴
		function _shop_goods_rows($uid){
			$query = "select * from `shop_goods` WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){	
				return $rows;
			}	
		}


		/////////////
		$skin_name = "default";
		$body = _skin_page("default","resales_goods_edit");


		$cookie_email = $_COOKIE['cookie_email']; // 로그인 이메일
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$cate = _formdata("cate");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;

		
			
			$body=str_replace("{formstart}","<form id='data' name='good' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
			$body = str_replace("{formend}","</form>",$body);
		
			$script = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_sales_goods_editup.php?uid=\"+uid+\"&mode=\"+mode;
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

			</script>";
			
			
			
			if($goods = _shop_goods_rows($uid)){
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			
			}


			// 상품판매 활성화 : 비활성화시 상품노출 안됨
			if($goods->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);

			// 판매기간 설정
			if($goods->check_priod) $body = str_replace("{check_priod}",_form_checkbox("check_priod","on"),$body);
			else $body = str_replace("{check_priod}",_form_checkbox("check_priod",""),$body);

			if($goods->startselling){
				$body = str_replace("{startselling}",_form_date("start",$goods->startselling,$css_textbox),$body);
				$body = str_replace("{endselling}",_form_date("end",$goods->endselling,$css_textbox),$body);
			} else {
				$body = str_replace("{startselling}",_form_date("start",$TODAY,$css_textbox),$body);
				$body = str_replace("{endselling}",_form_date("end",$goods->endselling,$css_textbox),$body);
			}

			// 상품노출 우선순위
			$body = str_replace("{pos}",_form_number("pos",$goods->pos,$css_textbox),$body);


			//====================================
			// 판매자, 상품등록자 
			function _shop_seller_select($seller){
				global $css_textbox;
				$query = "select * from `resales_seller` ";
				//echo $query;
				if($rowss = _sales_query_rowss($query)){	
					$seller_select = "<select name='seller' style=\"$css_textbox\">";
					$seller_select .= "<option value='".$cookie_email."'>직접등록</option>";
					for($i=0;$i<count($rowss);$i++){
						$rows1 = $rowss[$i];
						if($seller == $rows1->email){
							$seller_select .= "<option value='".$rows1->email."' selected>".$rows1->name."</option>";
						} else $seller_select .= "<option value='".$rows1->email."'>".$rows1->name."</option>";
					}
					
					$seller_select .= "</select>";
				
				}
				return $seller_select;
			}

			$body = str_replace("{seller}",_shop_seller_select($goods->seller),$body);

			// 입점상품 : 승인여부 체크
			if($goods->seller_auth) $body = str_replace("{seller_auth}",_form_checkbox("seller_auth","on"),$body);
			else $body = str_replace("{seller_auth}",_form_checkbox("seller_auth",""),$body);

			// 입점상품 : 대리배송, 대리배송은 기존 재고량과 상관이 없습 
			if($goods->seller_order) $body = str_replace("{seller_order}",_form_checkbox("seller_order","on"),$body);
			else $body = str_replace("{seller_order}",_form_checkbox("seller_order",""),$body);


		
			// 상품별 판매국가 : 수동으로 지정 가능 , multi select 문으로 작성	
			function _shop_country_select($goods){
				global $css_multiselect;
				$query = "select * from `shop_country` ";	
				if($rowss = _sales_query_rowss($query)){	
					$country_check = explode(";",$goods->sales_country);
					
					$sales_country = "<select multiple name='sales_country[]' size='10' style='$css_multiselect'>";
			
					for($i=0;$i<count($rowss);$i++){
						$rows1 = $rowss[$i];
						
						if($goods->sales_country){ //배송 가능 지역
							for($country_flag = NULL, $k=0;$k<count($country_check); $k++) if($country_check[$k] == $rows1->code) $country_flag = "TRUE";
							if($country_flag) $sales_country .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>";
							else $sales_country .= "<option value='".$rows1->code."'>".$rows1->code."</option>";
						} else $sales_country .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>";
					}
					$sales_country .= "</select>";
				}
				return $sales_country;
			}

			$body = str_replace("{sales_country}",_shop_country_select($goods),$body);

			function _shop_salescountry_select($goods){
				global $css_textbox;
				$query = "select * from `shop_country` ";	
				if($rowss = _sales_query_rowss($query)){					
					$seller_country = "<select name='country' style=\"$css_textbox\">";
					for($i=0;$i<count($rowss);$i++){
						$rows1 = $rowss[$i];
						if($goods->country == $rows1->code){
							$seller_country .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>";
						} else $seller_country .= "<option value='".$rows1->code."'>".$rows1->code."</option>";
					}
					
					$seller_country .= "</select>";
				}

				return $seller_country; 
			}
				
			$body = str_replace("{country}",_shop_salescountry_select($goods),$body);
			

			$master_cate = _curl_post("http://www.saleshosting.co.kr/master_cate.php","postvar1=value1&postvar2=value2&postvar3=value3");
			$body = str_replace("{main_cate}",$master_cate,$body);



			// 상품 기본 카테고리
			function _shop_category_select($goods,$site_language){
				global $css_multiselect;

				$query = "select * from `shop_cate` ";
				// $query .= "where code = 'default' ";
				$query .= "order by pos desc";	
				if($rowss = _sales_query_rowss($query)){

					$check = explode(";",$goods->cate);
					$cate = "<select multiple name='cate[]' size='10' style='$css_multiselect'>";
					
					for($i=0;$i<count($rowss);$i++){
						
						$rows= $rowss[$i];
						$cate .= "<option value='".$rows->Id."' ";
					
						for($k=0;$k<count($check); $k++){
							if($check[$k] == $rows->Id) $cate .= "selected";
						}
				
						$title = stripslashes($rows->title);
						$title_name = json_decode($title);

						for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;└"; 

						$cate .= ">$space".$title_name->$site_language."</option>";

					}
					$cate .= "</select>";	
					
				}
				
				return $cate;
			} 

			$body = str_replace("{cate}",_shop_category_select($goods,$site_language),$body);
			// $body = str_replace("{cate}",$cate,$body);



			// 무료배송 
			if($goods->free_shipping) $body = str_replace("{free_shipping}",_form_checkbox("free_shipping","on"),$body);
			else $body = str_replace("{free_shipping}",_form_checkbox("free_shipping",""),$body);

			// 주문 문구 입력
			$body = str_replace("{ordertext}",_form_checkbox("ordertext",$goods->ordertext),$body);

			// 주문 문구 입력
			$body = str_replace("{attach}",_form_checkbox("attach",$goods->attach),$body);

			// 블로그 주소 입력
			$body = str_replace("{blog}",_form_text("blog",$goods->blog,$css_textbox),$body);

			// 유트브 주소입력
			$body = str_replace("{youtube}",_form_textarea("youtube",$goods->youtube,"5",$css_textbox),$body);


			// 싱품 바코드 
			// $body = str_replace("{barcode}","<input type='text' name='barcode' value='".$goods->barcode."' id=\"cssFormStyle\" >",$body);			
			$body = str_replace("{barcode}",_form_text("barcode",$goods->barcode,$css_textbox),$body);

			// 상품코드 
			// $body = str_replace("{goodcode}","<input type='text' name='goodcode' value='".$goods->code."' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{goodcode}",_form_text("goodcode",$goods->goodcode,$css_textbox),$body);

			// 모델명
			// $body = str_replace("{model}","<input type='text' name='model' value='".$goods->model."' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{model}",_form_text("model",$goods->model,$css_textbox),$body);

			// 브랜드
			// $body = str_replace("{brand}","<input type='text' name='brand' value='".$goods->brand."' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{brand}",_form_text("brand",$goods->brand,$css_textbox),$body);


			// =============
			// 상품설명 : 가격표시
			if($goods->check_prices) $body = str_replace("{check_prices}",_form_checkbox("check_prices","on"),$body);
			else $body = str_replace("{check_prices}",_form_checkbox("check_prices",""),$body);
			
			// 상품설명 : 회원가격전용
			if($goods->check_memprices) $body = str_replace("{check_memprices}",_form_checkbox("check_memprices","on"),$body);
			else $body = str_replace("{check_memprices}",_form_checkbox("check_memprices",""),$body);
			
			// 상품설명 : 스팩표시
			if($goods->check_spec) $body = str_replace("{check_spec}",_form_checkbox("check_spec","on"),$body);
			else $body = str_replace("{check_spec}",_form_checkbox("check_spec",""),$body);
			
			// 상품설명 : 서브타이틀 표시
			if($goods->check_subtitle) $body = str_replace("{check_subtitle}",_form_checkbox("check_subtitle","on"),$body);
			else $body = str_replace("{check_subtitle}",_form_checkbox("check_subtitle",""),$body);
			
			// 상품설명 : USD 가격표시
			if($goods->check_usd) $body = str_replace("{check_usd}",_form_checkbox("check_usd","on"),$body);
			else $body = str_replace("{check_usd}",_form_checkbox("check_usd",""),$body);
			
			if($goods->check_goodname) $body = str_replace("{check_goodname}",_form_checkbox("check_goodname","on"),$body);
			else $body = str_replace("{check_goodname}",_form_checkbox("check_goodname",""),$body);

			
			// ***** ***** ***** *****
			
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
					

					
							
			// 부가세, 부가세율, 재고	
			/*		
			if($goods->vat) {
				$body = str_replace("{vat}","<input type='checkbox' name='vat' checked>",$body);
			} else {
				$body = str_replace("{vat}","<input type='checkbox' name='vat' >",$body);
			}

			*/
			$body = str_replace("{vat}",_form_checkbox("vat",$goods->vat),$body);

			// $body = str_replace("{vatrate}","<input type='text' name='vatrate' value='".$goods->vatrate."' id=\"cssFormStyle\"  >",$body);
			$body = str_replace("{vatrate}",_form_text("vatrate",$goods->vatrate,$css_textbox),$body);

			// 재고수량 및 판매체크
			// ========================
			// 품절표시 : 체크시 상품 품절, 주문 방지
			if($goods->soldout) $body = str_replace("{soldout}",_form_checkbox("soldout","on"),$body);
			else $body = str_replace("{soldout}",_form_checkbox("soldout",""),$body);
			
			// 재고 주문연동 : 재고 부족시에도 주문 가능
			if($goods->stock_check) $body = str_replace("{stock_check}",_form_checkbox("stock_check","on"),$body);
			else $body = str_replace("{stock_check}",_form_checkbox("stock_check",""),$body);

			$body = str_replace("{stock}",_form_text("stock",$goods->stock,$css_textbox),$body);
			$body = str_replace("{safe_stock}",_form_text("safe_stock",$goods->safe_stock,$css_textbox),$body);

			// ===========================
			// 할인
			if($goods->discount) $body = str_replace("{discount}",_form_checkbox("discount","on"),$body);
			else $body = str_replace("{discount}",_form_checkbox("discount",""),$body);

			$body = str_replace("{discount_rate}",_form_text("discount_rate",$goods->discount_rate,$css_textbox),$body);
			$body = str_replace("{discount_endpriod}",_form_date("discount_endpriod",$goods->discount_endpriod,$css_textbox),$body);


			if($goods->relation_check) $body = str_replace("{relation_check}",_form_checkbox("relation_check","on"),$body);
			else $body = str_replace("{relation_check}",_form_checkbox("relation_check",""),$body);

			$body = str_replace("{relation_type}",_form_text("relation_type",$goods->relation_type,$css_textbox),$body);
			$body = str_replace("{relation_cols}",_form_text("relation_cols",$goods->relation_cols,$css_textbox),$body);
			$body = str_replace("{relation_rows}",_form_text("relation_rows",$goods->relation_rows,$css_textbox),$body);

			// ***** ***** ***** *****
							
			//# 상품이미지	
			$body = str_replace("{imgsize}",_form_text("imgsize",$goods->imgsize,$css_textbox),$body);
			$body = str_replace("{mobile_imgsize}",_form_text("mobile_imgsize",$goods->mobile_imgsize,$css_textbox),$body);

			if($goods->images1) {
				$img_url = "http://www.saleshosting.co.kr/".$goods->images1;
				$body = str_replace("{goodimg1}","<img src='".$img_url."' border='0' width='300'>",$body);
				$body = str_replace("{goodimg1_upload}",_form_file("userfile1",$css),$body);
				$body = str_replace("{goodimg1_filename}",$img_url,$body);

			} else {
				$body = str_replace("{goodimg1}","이미지1",$body);
				$body = str_replace("{goodimg1_upload}",_form_file("userfile1",$css),$body);
				$body = str_replace("{goodimg1_filename}","",$body);
			}

				
			if($goods->images2) {
				$img_url = "http://".$sales_db->domain."/".$goods->images2;
				$body = str_replace("{goodimg2}","<img src='".$goods->images2."' border='0' width='300'>",$body);
				$body = str_replace("{goodimg2_upload}",_form_file("userfile2",$css),$body);
				$body = str_replace("{goodimg2_filename}",$img_url,$body);
			} else {
				$body = str_replace("{goodimg2}","이미지2",$body);
				$body = str_replace("{goodimg2_upload}",_form_file("userfile2",$css),$body);
				$body = str_replace("{goodimg2_filename}","",$body);		
			}

				
			if($goods->images3) {
				$img_url = "http://".$sales_db->domain."/".$goods->images3;
				$body = str_replace("{goodimg3}","<img src='".$goods->images3."' border='0' width='300'>",$body);
				$body = str_replace("{goodimg3_upload}",_form_file("userfile3",$css),$body);
				$body = str_replace("{goodimg3_filename}",$img_url,$body);
			} else {
				$body = str_replace("{goodimg3}","이미지3",$body);
				$body = str_replace("{goodimg3_upload}",_form_file("userfile3",$css),$body);
				$body = str_replace("{goodimg3_filename}","",$body);
			}


			//# 첨부파일 
			$body = str_replace("{filename1}",_form_file("userfile6",$css),$body);
			if($goods->detail1){
				$body = str_replace("{filelink1}","&lt;img src='".$goods->detail1."' border=0&gt;",$body);
				$body = str_replace("{filename1_upload}","",$body);
			} else {
				$body = str_replace("{filelink1}","",$body);
				$body = str_replace("{filename1_upload}","",$body);
			}

			$body = str_replace("{filename2}",_form_file("userfile7",$css),$body);
			if($goods->detail2){
				$body = str_replace("{filelink2}","&lt;img src='".$goods->detail2."' border=0&gt;",$body);
				$body = str_replace("{filename2_upload}","",$body);
			} else {
				$body = str_replace("{filelink2}","",$body);
				$body = str_replace("{filename2_upload}","",$body);
			}

			$body = str_replace("{filename3}",_form_file("userfile8",$css),$body);
			if($goods->detail3){
				$body = str_replace("{filelink3}","&lt;img src='".$goods->detail3."' border=0&gt;",$body);
				$body = str_replace("{filename3_upload}","",$body);
			} else {
				$body = str_replace("{filelink3}","",$body);
				$body = str_replace("{filename3_upload}","",$body);
			}


			//#언어별 상품명, 상품설명
			$query1 = "select * from `site_language` ";	
			if($rowss1 = _sales_query_rowss($query1)){
					
				$products_language = "";
				$products_forms = "";
				for($i=0;$i<count($rowss1);$i++){
					$rows1=$rowss1[$i];

					if($rows1->code == $site_language){
						$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='".$rows1->code."' checked=\"checked\">";
					} else {
						$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='".$rows1->code."'>";
					}
									
					$products_language .= "<label for='tab-$i'>".$rows1->code."</label>";
									
						
					$desktop = $rows1->code;
					$mobile = $rows1->code."_m";
									
					$query1 = "select * from `shop_goods_html` WHERE `goods`='$uid' and `mobile`='pc' and `language`='".$rows1->code."'";
					if($goods_rows = _sales_query_rows($query1)){
						$desktop_html = stripslashes($goods_rows->html);
					} else $desktop_html = "";

					$query1 = "select * from `shop_goods_html` WHERE `goods`='$uid' and `mobile`='m' and `language`='".$rows1->code."'";
					if($goods_rows = _sales_query_rows($query1)){
						$mobile_html = stripslashes($goods_rows->html);
					} else $mobile_html = "";

					//$goodstring = _goodstring($UID,$rows1[code]);
					$code = $rows1->code;		
					$products_forms .="<div class='tab-$i_content' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
													   
											<table border='0' width='100%' cellspacing='5' cellpadding='5' >
											<tr>
												<td width='110' align='right'>상품명(".$rows1->code.")</td>
												<td>"._form_textarea("goodname_".$rows1->code,stripslashes(json_decode($goods->goodname)->$code),"2",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right'>스팩(".$rows1->code.")</td>
												<td>"._form_textarea("spec_".$rows1->code,stripslashes(json_decode($goods->spec)->$code),"2",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right'>간략설명(".$rows1->code.")</td>
												<td>"._form_textarea("subtitle_".$rows1->code,stripslashes(json_decode($goods->subtitle)->$code),"3",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right'>옵션(".$rows1->code.")</td>
												<td>"._form_textarea("optionitem_".$rows1->code,stripslashes(json_decode($goods->optionitem)->$code),"2",$css_textarea)."</td>
											</tr>
											
											</table>

											<table border='0' width='100%' cellspacing='5' cellpadding='5' >
											<tr><td valign='top'>HTML PC</td></tr>
											<tr><td>"._form_textarea($rows1->code,$desktop_html,"25",$css_textarea)."</td></tr>
											<tr><td valign='top'>HTML MOBILE</td></tr>
											<tr><td>"._form_textarea($rows1->code."_m",$mobile_html,"25",$css_textarea)."</td></tr>
											</table>
													   
										</div>";									 
									
				}
								
				$body = str_replace("{selling_language_form}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
								
			}
			

			echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>