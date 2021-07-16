<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  
	//*

	// update : 2016.01.09 = 코드정리 

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

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");
	

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	// ++ javascript
	$javascript = "<script>
		function popup_submit(mode,uid){
			var url = \"ajax_goods_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#popup_data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#popup_body').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});

    		// 팝업창 종료
			popup_close();

			if(mode == \"new\"){
				var cate = $('#category').val();
				var url2 = \"ajax_goodlist.php?cate=\"+cate;
				ajax_html('#mainbody',url2);
			} else if(mode == \"edit\"){
				var url2 = \"detail.php?uid=\"+uid;
				location.replace(url2);
			}

		}

		function form_delete(mode){	
			var returnValue = confirm(\"삭제하겠습니까?\");
			if(returnValue == true){
				var url = \"ajax_goods_editup.php?mode=\"+mode;
				var form = document.goods;
				ajax_html('#mainbody',url);
			}
		}		

		function image_upload(mode,gid){
			var url = \"ajax_goods_files.php?gid=\"+gid+\"&mode=\"+mode;
			var formData = new FormData($('#popup_data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#images_files').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});
		}

		function file_remove(mode,gid,images){
			var url = 'ajax_goods_files.php?gid='+gid+'&mode='+mode+'&images='+images;
			alert(url);
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                   	$('#images_files').html(data);
                }
            });
		}

		function image_remove(mode,gid,images){
			var url = 'ajax_goods_images.php?gid='+gid+'&mode='+mode+'&images='+images;
			var img_id = \"#images\"+images;
			// alert(img_id);
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                   	$(img_id).html(data);
                }
            });
		}

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

    	$('#popup_close').hover(function() {
        	$(this).css('cursor','pointer');
    	});

	</script>";




	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// echo "new add";
		// $body = "<script src=\"/js/tabbar.js\"></script>\n".$javascript._theme_page($site_env->theme,"shop_goods_edit",$site_language,$site_mobile);
		if($site_mobile == "m") $width = "300px"; else $width = "1100px"; 		

		$title = "상품등록";
		$body = "<script src=\"/js/tabbar.js\"></script>\n".$javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"goods_edit",$site_language,$site_mobile) );



		include ($_SERVER['DOCUMENT_ROOT']."/func/goods.class.php");
		$goods = new goods;



		/////////////
		

		$cookie_email = $_COOKIE['cookie_email']; // 로그인 이메일
		$mode = _formmode();

		$uid = _formdata("uid");
		// $uid = 67;

		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$category = _formdata("category");
		$_enable = _formdata("_enable");
		$list_num = _formdata("list_num");
		$_soldout = _formdata("_soldout");
		
		// echo "category = $category <br>";
		$body=str_replace("{formstart}","<form id='popup_data' name='popup' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='category' value='$category' id=\"category\">
					    				<input type='hidden' name='_enable' value='$_enable'>
										<input type='hidden' name='list_num' value='$list_num'>
										<input type='hidden' name='_soldout' value='$_soldout'>	    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		

		
		

		if($goods_rows = _mysqli_query_rows($goods->byrows($uid))){
			// ++ 상품 수정모드
			$form_submit  = "<input type='button' value='수정' onclick=\"javascript:popup_submit('edit','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_delete('delete')\" style=\"".$css_btn_gray."\" >  ";
			
			/*
			if(isset($goods_rows->sales_gid)){
			} else {	
				$form_submit  .= "<input type='button' value='관리연동' onclick=\"javascript:sales_submit('new','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			}
			*/

			$body = str_replace("{form_submit}",$form_submit,$body);


			// 상품판매 활성화 : 비활성화시 상품노출 안됨
			if($goods_rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);

			// =============
			// ++ 상품설명 : 가격표시
			if($goods_rows->check_prices) $body = str_replace("{check_prices}",_form_checkbox("check_prices","on"),$body);
			else $body = str_replace("{check_prices}",_form_checkbox("check_prices",""),$body);
			
			// ++ 상품설명 : 회원가격전용
			if($goods_rows->check_memprices) $body = str_replace("{check_memprices}",_form_checkbox("check_memprices","on"),$body);
			else $body = str_replace("{check_memprices}",_form_checkbox("check_memprices",""),$body);
			
			// ++ 상품설명 : 스팩표시
			if($goods_rows->check_spec) $body = str_replace("{check_spec}",_form_checkbox("check_spec","on"),$body);
			else $body = str_replace("{check_spec}",_form_checkbox("check_spec",""),$body);
			
			// ++ 상품설명 : 서브타이틀 표시
			if($goods_rows->check_subtitle) $body = str_replace("{check_subtitle}",_form_checkbox("check_subtitle","on"),$body);
			else $body = str_replace("{check_subtitle}",_form_checkbox("check_subtitle",""),$body);
			
			// ++ 상품설명 : USD 가격표시
			if($goods_rows->check_usd) $body = str_replace("{check_usd}",_form_checkbox("check_usd","on"),$body);
			else $body = str_replace("{check_usd}",_form_checkbox("check_usd",""),$body);
			
			if($goods_rows->check_goodname) $body = str_replace("{check_goodname}",_form_checkbox("check_goodname","on"),$body);
			else $body = str_replace("{check_goodname}",_form_checkbox("check_goodname",""),$body);


		} else {
			// ++ 상품 신규모드
			$form_submit = "<input type='button' value='저장' onclick=\"javascript:popup_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);	

			// ++ 신규등록 : 활성화 체크 
			$body = str_replace("{enable}",_form_check_enable("on"),$body);

			// 상품판매 활성화 : 비활성화시 상품노출 안됨
			if($goods_rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);

			// =============
			// ++ 상품설명 : 가격표시
			$body = str_replace("{check_prices}",_form_checkbox("check_prices","on"),$body);
			
			// ++ 상품설명 : 회원가격전용
			if($goods_rows->check_memprices) $body = str_replace("{check_memprices}",_form_checkbox("check_memprices","on"),$body);
			else $body = str_replace("{check_memprices}",_form_checkbox("check_memprices",""),$body);
			
			// ++ 상품설명 : 스팩표시
			$body = str_replace("{check_spec}",_form_checkbox("check_spec","on"),$body);
			
			// ++ 상품설명 : 서브타이틀 표시
			$body = str_replace("{check_subtitle}",_form_checkbox("check_subtitle","on"),$body);
			
			// ++ 상품설명 : USD 가격표시
			$body = str_replace("{check_usd}",_form_checkbox("check_usd","on"),$body);
			
			$body = str_replace("{check_goodname}",_form_checkbox("check_goodname","on"),$body);


		}
			

		// 판매기간 설정
		if($goods_rows->check_priod) $body = str_replace("{check_priod}",_form_checkbox("check_priod","on"),$body);
		else $body = str_replace("{check_priod}",_form_checkbox("check_priod",""),$body);

		if($goods_rows->startselling){
			$body = str_replace("{startselling}",_form_date("start",$goods_rows->startselling,$css_textbox),$body);
			$body = str_replace("{endselling}",_form_date("end",$goods_rows->endselling,$css_textbox),$body);
		} else {
			$body = str_replace("{startselling}",_form_date("start",$TODAY,$css_textbox),$body);
			$body = str_replace("{endselling}",_form_date("end",$goods_rows->endselling,$css_textbox),$body);
		}

		// 상품노출 우선순위
		$body = str_replace("{pos}",_form_number("pos",$goods_rows->pos,$css_textbox),$body);


		// ++ 판매자, 상품등록자 
		function _seller_select($seller){
			global $css_textbox;
			global $cookie_email;
			$query = "select * from scm_seller ";
			$seller_select = "<select name='seller' style=\"$css_textbox\">";
			$seller_select .= "<option value='".$_COOKIE['cookie_email']."'>직접등록</option>";
			if($rowss = _mysqli_query_rowss($query)){	
					
				for($i=0;$i<count($rowss);$i++){
					$rows1 = $rowss[$i];
					if($seller == $rows1->email){
						$seller_select .= "<option value='".$rows1->email."' selected>".$rows1->name."</option>";
					} else $seller_select .= "<option value='".$rows1->email."'>".$rows1->name."</option>";
				}				
			}
			$seller_select .= "</select>";
			return $seller_select;
		}

		$body = str_replace("{seller}", _seller_select($goods_goods->seller),$body);


		// 입점상품 : 승인여부 체크
		if($goods_rows->seller_auth) $body = str_replace("{seller_auth}",_form_checkbox("seller_auth","on"),$body);
		else $body = str_replace("{seller_auth}",_form_checkbox("seller_auth",""),$body);

		// 입점상품 : 대리배송, 대리배송은 기존 재고량과 상관이 없습 
		if($goods_rows->seller_order) $body = str_replace("{seller_order}",_form_checkbox("seller_order","on"),$body);
		else $body = str_replace("{seller_order}",_form_checkbox("seller_order",""),$body);


		// 상품별 판매국가 : 수동으로 지정 가능 , multi select 문으로 작성	
		function _country_select($goods){
			global $css_multiselect;
			
			$query = "select * from shop_country ";	
			if($rowss = _mysqli_query_rowss($query)){	
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

		$body = str_replace("{sales_country}", _country_select($goods),$body);



		function _salescountry_select($goods){
			global $css_textbox;
			$query = "select * from shop_country ";	
			if($rowss = _mysqli_query_rowss($query)){					
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

		$body = str_replace("{country}",_salescountry_select($goods_rows),$body);


		// ++ 마스터 카테고리 출력
		$master_cate = _curl_post("http://www.saleshosting.co.kr/service_goods_cate.php",$goods->master_cate);
		$body = str_replace("{main_cate}",$master_cate,$body);

		// 상품 기본 카테고리
		function _category_select($goods,$site_language){
			$css_multiselect = "width:100%;
				height:400px;	
				font-size:12px;	
				border:1px solid #d8d8d8;";


			$query = "select * from `shop_cate` ";
			// $query .= "where code = 'default' ";
			$query .= "order by pos desc";	
			if($rowss = _mysqli_query_rowss($query)){

				$check = explode(";",$goods->cate);
				$cate = "<select multiple name='cate[]' size='30' style='$css_multiselect'>";
					
				for($i=0;$i<count($rowss);$i++){
						
					$rows= $rowss[$i];
					$cate .= "<option value='".$rows->Id."' ";
					
					for($k=0;$k<count($check); $k++){
						$cate_select = str_replace("*", "", $check[$k]);
						if($cate_select == $rows->Id) $cate .= "selected";
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
		$body = str_replace("{cate}", _category_select($goods_rows,$site_language),$body);
		// $body = str_replace("{cate}",$cate,$body);


		// ++ 무료배송 
		if($goods_rows->free_shipping) $body = str_replace("{free_shipping}",_form_checkbox("free_shipping","on"),$body);
		else $body = str_replace("{free_shipping}",_form_checkbox("free_shipping",""),$body);

		// ++ 주문 문구 입력
		$body = str_replace("{ordertext}",_form_checkbox("ordertext",$goods_rows->ordertext),$body);

		// ++ 주문 문구 입력
		$body = str_replace("{attach}",_form_checkbox("attach",$goods_rows->attach),$body);

		// ++ 블로그 주소 입력
		$body = str_replace("{blog}",_form_text("blog",$goods_rows->blog,$css_textbox),$body);

		// ++ 유트브 주소입력
		$body = str_replace("{youtube}",_form_textarea("youtube",$goods_rows->youtube,"5",$css_textbox),$body);


		// ++ 싱품 바코드 
		// $body = str_replace("{barcode}","<input type='text' name='barcode' value='".$goods->barcode."' id=\"cssFormStyle\" >",$body);			
		$body = str_replace("{barcode}",_form_text("barcode",$goods_rows->barcode,$css_textbox),$body);

		// ++ 상품코드 
		// $body = str_replace("{goodcode}","<input type='text' name='goodcode' value='".$goods->code."' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{goodcode}",_form_text("goodcode",$goods_rows->goodcode,$css_textbox),$body);

		// ++ 모델명
		// $body = str_replace("{model}","<input type='text' name='model' value='".$goods->model."' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{model}",_form_text("model",$goods_rows->model,$css_textbox),$body);

		// ++ 브랜드
		// $body = str_replace("{brand}","<input type='text' name='brand' value='".$goods->brand."' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{brand}",_form_text("brand",$goods_rows->brand,$css_textbox),$body);

		


		// ++ 매입 / B2B / 판매 가격 설정
		$query = "select * from `shop_currency`";
		if($rowss = _mysqli_query_rowss($query)){
			$buy_currency = "<select name='buy_currency' style=\"$css_textbox\" >";
			$b2b_currency = "<select name='b2b_currency' style=\"$css_textbox\" >";
			$sell_currency = "<select name='sell_currency' style=\"$css_textbox\" >";

			for($ii=0;$ii<count($rowss);$ii++){
				$rows1=$rowss[$ii];

				if($goods_rows->buy_currency == $rows1->currency) {
					$buy_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$buy_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}

				if($goods_rows->b2b_currency == $rows1->currency) {
					$b2b_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$b2b_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}

				if($goods_rows->sell_currency == $rows1->currency) {
					$sell_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$sell_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}
			}
		
			$buy_currency .= "</select>";
			$b2b_currency .= "</select>";
			$sell_currency .= "</select>";
		}

		$body = str_replace("{buy_currency}",$buy_currency,$body);
		$body = str_replace("{b2b_currency}",$b2b_currency,$body);
		$body = str_replace("{sell_currency}",$sell_currency,$body);



		$body = str_replace("{prices_buy}",_form_text("prices_buy",$goods_rows->prices_buy,$css_textbox),$body);		
		$body = str_replace("{prices_b2b}",_form_text("prices_b2b",$goods_rows->prices_b2b,$css_textbox),$body);		
		$body = str_replace("{prices_sell}",_form_text("prices_sell",$goods_rows->prices_sell,$css_textbox),$body);		
										
		// ++ 부가세, 부가세율, 재고	
		$body = str_replace("{vat}",_form_checkbox("vat",$goods_rows->vat),$body);
		$body = str_replace("{vatrate}",_form_text("vatrate",$goods_rows->vatrate,$css_textbox),$body);


		// ++ 재고수량 및 판매체크
		// ========================
		// 품절표시 : 체크시 상품 품절, 주문 방지
		if($goods_rows->soldout) $body = str_replace("{soldout}",_form_checkbox("soldout","on"),$body);
		else $body = str_replace("{soldout}",_form_checkbox("soldout",""),$body);
			
		// ++ 재고 주문연동 : 재고 부족시에도 주문 가능
		if($goods_rows->stock_check) $body = str_replace("{stock_check}",_form_checkbox("stock_check","on"),$body);
		else $body = str_replace("{stock_check}",_form_checkbox("stock_check",""),$body);

		$body = str_replace("{stock}",_form_text("stock",$goods_rows->stock,$css_textbox),$body);
		$body = str_replace("{safe_stock}",_form_text("safe_stock",$goods_rows->safe_stock,$css_textbox),$body);

		// ===========================
		// ++ 할인
		if($goods_rows->discount) $body = str_replace("{discount}",_form_checkbox("discount","on"),$body);
		else $body = str_replace("{discount}",_form_checkbox("discount",""),$body);

		$body = str_replace("{discount_rate}",_form_text("discount_rate",$goods_rows->discount_rate,$css_textbox),$body);
		$body = str_replace("{discount_endpriod}",_form_date("discount_endpriod",$goods_rows->discount_endpriod,$css_textbox),$body);

		
		// ++ 상품이미지	
		$body = str_replace("{imgsize}",_form_text("imgsize",$goods_rows->imgsize,$css_textbox),$body);
		$body = str_replace("{mobile_imgsize}",_form_text("mobile_imgsize",$goods_rows->mobile_imgsize,$css_textbox),$body);

		if($goods_rows->images_outline) $body = str_replace("{images_outline}",_form_checkbox("images_outline","on"),$body);
		else $body = str_replace("{images_outline}",_form_checkbox("images_outline",""),$body);
		$body = str_replace("{outline_color}",_form_text("outline_color",$goods_rows->images_outline_color,$css_textbox),$body);
		$body = str_replace("{outline_width}",_form_text("outline_width",$goods_rows->images_outline_width,$css_textbox),$body);

		$body = str_replace("{watermark}",_form_text("watermark",$goods_rows->watermark,$css_textbox),$body);


		$body = str_replace("{attach_label}",_form_text("attach_label",$goods_rows->attach_label,$css_textbox),$body);


		// *****************
		// ++ 이미지 정보 포시

		for($k=1;$k<10;$k++){
			$img = "images".$k;
			$userfile = "userfile".$k;
			if($goods_rows->$img) {
				$img_url = ".".$goods_rows->$img;
				$images_body .="<div style=\"font-size:12px;padding:10px;\" id=\"images$k\">
						<div> <img src='".$img_url."' border='0' width='150'> </div>
						<div><a href='#' onclick=\"javascript:image_remove('remove','$uid','$k')\">이미지 제거</a></div>
						<div>"._form_file($userfile,$css)."</div>
						
					</div>";
			} else {
				$images_body .="<div style=\"font-size:12px;padding:10px;\">"._form_file($userfile,$css)."</div>";
			}
		}
		$body = str_replace("{goods_images}",$images_body,$body);


		// ++ 관련 이미지 ajax로 출력
		if($uid){
			$body = str_replace("{html_images_upload}",_form_file("userfile",$css),$body);	
			$body = str_replace("{upload}","<input type='button' value='업로드' onclick=\"javascript:image_upload('upload','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);	
			$body = str_replace("{images_files}","
					<span id=\"images_files\">
					<center><img src='./images/loading.gif' border='0'></center>		
					<script>						
						var url = \"ajax_goods_files.php?gid=$uid\";
                    	ajax_async('#images_files',url);
					</script>
					</span>",$body);
		} else {
			$body = str_replace("{html_images_upload}","",$body);	
			$body = str_replace("{upload}","",$body);
			$body = str_replace("{images_files}","",$body);
		}
		


		//#언어별 상품명, 상품설명
		$query1 = "select * from site_language ";	
		if($rowss1 = _mysqli_query_rowss($query1)){
					
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
									
				$query1 = "select * from shop_goods_html WHERE `goods`='$uid' and `mobile`='pc' and `language`='".$rows1->code."'";
				if($goods_html = _mysqli_query_rows($query1)){
					$desktop_html = stripslashes($goods_html->html);
				} else $desktop_html = "";

				$query1 = "select * from `shop_goods_html` WHERE `goods`='$uid' and `mobile`='m' and `language`='".$rows1->code."'";
				if($goods_html = _mysqli_query_rows($query1)){
					$mobile_html = stripslashes($goods_html->html);
				} else $mobile_html = "";

				//$goodstring = _goodstring($UID,$rows1[code]);
				$code = $rows1->code;		
				$products_forms .="<div class='tab-$i_content' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
													   
											<table border='0' width='100%' cellspacing='5' cellpadding='5' >
											<tr>
												<td width='110' align='right' style='font-size:12px;padding:10px;'>상품명(".$rows1->code.")</td>
												<td>"._form_textarea("goodname_".$rows1->code,stripslashes(json_decode($goods_rows->goodname)->$code),"2",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right' style='font-size:12px;padding:10px;'>스팩(".$rows1->code.")</td>
												<td>"._form_textarea("spec_".$rows1->code,stripslashes(json_decode($goods_rows->spec)->$code),"2",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right' style='font-size:12px;padding:10px;'>간략설명(".$rows1->code.")</td>
												<td>"._form_textarea("subtitle_".$rows1->code,stripslashes(json_decode($goods_rows->subtitle)->$code),"3",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right' style='font-size:12px;padding:10px;'>옵션(".$rows1->code.")</td>
												<td>"._form_textarea("optionitem_".$rows1->code,stripslashes(json_decode($goods_rows->optionitem)->$code),"2",$css_textarea)."</td>
											</tr>
											
											</table>

											<table border='0' width='100%' cellspacing='5' cellpadding='5' >
											<tr><td valign='top' style='font-size:12px;padding:10px;'>HTML PC</td></tr>
											<tr><td>"._form_textarea($rows1->code,$desktop_html,"25",$css_textarea)."</td></tr>
											<tr><td valign='top' style='font-size:12px;padding:10px;'>HTML MOBILE</td></tr>
											<tr><td>"._form_textarea($rows1->code."_m",$mobile_html,"25",$css_textarea)."</td></tr>
											</table>
													   
										</div>";									 
									
			}					
								
		}
		$body = str_replace("{selling_language_form}","<div id='css_tabs'> $products_language $products_forms </div>",$body);


		




		
	
		echo $body;

	} else {
		$body = _theme_pages($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;
	}


	
?>