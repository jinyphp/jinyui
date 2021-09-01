<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  
	//*
	// update : 2016.01.12 = 코드정리 

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

	include "./func/currency.php";
	include "./func/members.php";
	
	include "./func/prices.php";
	include "./func/error.php";

	include "./func/css.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");
	
	// 배송국가 설정
	$site_shipping = "kr";

	$javascript="<script>
		function goodedit(mode,uid){
			/*
			var url = \"/ajax_goods_edit.php?uid=\"+uid+\"&mode=\"+mode;
            alert(url);

            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 
            */
            
            var url = \"ajax_goods_edit.php?uid=\"+uid+'&mode='+mode;
			popup_ajax(url);

        }
	</script>";


	// echo "width = ".$site_env->width;


	if($uid = _formdata("uid")){
		if($rows=_goods_rows($uid)){
			
			if( isset($_COOKIE['cookie_email']) ) $members = _members_rows($_COOKIE['cookie_email']);
			
			
			$body = _theme_emptybody();
			$body = str_replace("<!--{skin_emptybody}-->",_theme_page($site_env->theme,"detail",$site_language,$site_mobile),$body);
			// $body = _skin_body("default","detail");

			// 상품 설명에 관련된 자바스크립트 및 CSS 코드 삽입.
			$body = str_replace("</head>","<script src=\"/js/shop_good_detail.js?cashing=".microtime()."\"></script></head>",$body); 
			$body = str_replace("</head>","<link href='/css/shop_goods_detail.css' rel='stylesheet' type='text/css'></link></head>",$body); 

			$body=str_replace("{uid}","$uid",$body);

			$body=str_replace("{images}",_detail_goods_images($rows),$body);
			$body=str_replace("{goodname}",_detail_goodsname($rows),$body);// 상품명 출력
			$body=str_replace("{subtitle}",_detail_subtitle($rows),$body);// 상품 서브 타이틀
			$body=str_replace("{spec}",_detail_spec($rows),$body);// 상품 스택


			// 상품 가격
			if($rows->check_prices){
				if(isset($site_env->members_prices) && $site_env->members_prices){
					$goodsprices = "회원가격전용";
					$goodsprices_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$goodsprices."</td></tr></table>";

					$body=str_replace("{prices}",$goodsprices_skin,$body);	
					$body = str_replace("{vat}","",$body);
					$body = str_replace("{total}","",$body);
					$body = str_replace("{num}","",$body);

				} else {

					$price = _prices_dome($rows,$site_env->dome);
					$price_currency = __prices_currency($rows,$site_env->dome);
					$price = _prices_mem_discount($price,$members->discount); // 회원 개별 할인 적용
	
	

					$prices_string = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
										<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>"._prices_type($site_env->dome,$members->discount)."</td>
										<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">"._prices_check_currency($price_currency,$rows->check_currency).
										" "._prices_string($price).
										" ".__prices_usd($price,$price_currency,$rows->check_usd)."</td>
									</tr></table>";
					$body=str_replace("{prices}",$prices_string."<input type='hidden' name='prices' value='".$price."'>",$body);


					// ===========
					// VAT Process
					if(isset($_SESSION['country'])) $site_country = $_SESSION['country']; $site_country = "kr";

					$vat_rate = _prices_vat_rate($site_country);
					$vat_prices = _prices_vat($price, $vat_rate );
					$body = str_replace("{vat}",_prices_vat_string($rows->vat,$vat_rate,$vat_prices),$body);

					// =============							
					$body = str_replace("{num}",_detail_num($rows),$body);	// 주문 수량 저보 입력

					// =====
					if($rows->vat) $total_prices = $price;
					else  $total_prices = $price + $vat_prices;	// 합계금액								
					$body = str_replace("{total}",_prices_total($rows->check_usd, $price_currency, $total_prices),$body);	// 합계출력
					

				}


			} else {
				$body=str_replace("{prices}","",$body);
				$body = str_replace("{total}","",$body);
				$body = str_replace("{vat}","",$body);
				$body = str_replace("{num}","",$body);
			}

			

			// *******************************************
			// 옵션부분 처리
			function _detail_options($optionitem){
				// 옵션명1: 선택1 = 선택값1, 선택2 = 선택값2 ; 옵션명2: 선택A = 선택값A, 선택B = 선택값B 
				$options = explode(";",$optionitem);

				$form_options = "<table border='0' cellpadding='1' cellspacing='1' width='100%'>";
				for($i=0;$i<sizeof($options);$i++){
					$option_name = explode(":",$options[$i]);
					$form_options .= "<tr><td style='font-size:12px;padding:10px;' width='100' align='right' bgcolor='#F1F1F1'>
										<input type='text' name='_optionitem_name[]' value='$option_name[0]' readonly style='border:0px solid;background:#F1F1F1;width:100%'></td>";
					$form_options .= "<td style='font-size:12px;padding:10px;' bgcolor='#F1F1F1'>";
			
					$option_value = explode(",",$option_name[1]); 
					$select = "<select name='optionitem[]' id=\"detail_option$i\" style='width:100%;height:28px;font-size:12px;border:1px solid #d8d8d8;'> ";
					// $_option_name[$i] = $option_name[0];
					$select .= "<option value=''>옵션 선택</option>";
					for($j=0;$j<sizeof($option_value);$j++){
						$value = explode("=",$option_value[$j]); 
						$select .= "<option value='$option_name[0]:$value[0]=$value[1]'>$value[0] $value[1]</option>";
					}
					$select .= "</select>";
			
					$form_options .= $select."</td></tr>";
				}

				$form_options .= "</table>";

				return $form_options;
			}

			// *******************************************
			// 상품설명에 {option} 치환코드가 있는경우, 옵션 부분 처리하여 표시함.
			if(preg_match("{options}", $body)){
				if($rows->optionitem){
					$optionitem = stripslashes($rows->optionitem);
					$options_language = json_decode($optionitem)->$site_language;
					
					if($options_language){
						$form_options = _detail_options($options_language);
						$body = str_replace("{options}",$form_options,$body);	
					} else $body = str_replace("{options}","",$body);

					$body = str_replace("{options}",$options_language,$body);
				} else $body = str_replace("{options}","",$body);

			}


			$body = str_replace("{shipping}",_detail_free_shipping($rows),$body);

			// 주문문구
			$body = str_replace("{ordertext}",_detail_ordertext($rows),$body);

			// 첨부파일 
			$body = str_replace("{attach}",_detail_attach($rows),$body);
			
			$body = str_replace("{stock}",_detail_stock($rows),$body);
			$body = str_replace("{selling}",_detail_selling($rows),$body);


			// *******************************************
			// 입력폼
    		$_SESSION['nonce'] = $nonce = md5('shop'.microtime());
   			$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
			$body = str_replace("{form_start}","<form id=\"data\" name='detail' method='post' enctype='multipart/form-data' > 
										<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='nonce' value='$nonce'>
										<input type='hidden' name='UID' value='$uid'>
										<input type='hidden' name='seller' value='".$rows->seller."'>",$body);
			$body = str_replace("{form_end}","</form>",$body);





			/////
			// 재고별 상품 판매 가능 여부 설정.
			if($rows->stock_sold){
			// 주문상품 재고 연동
				

			} else {
			// 주문 재고 체크하지 않음.
				if($rows->stock<=0){
					$body = str_replace("{cart}","<b>Sold Out</b>",$body);
					$body = str_replace("{order}","",$body);
				} else if(!$rows->prices_sell){
					$body = str_replace("{cart}","<b>Ready</b>",$body);
					$body = str_replace("{order}","",$body);
				}

			}	

			if(!$rows->stock){
				$body = str_replace("{cart}","<b>Sold Out</b>",$body);
				$body = str_replace("{order}","",$body);

			} else if(!$rows->prices_sell){
				$body = str_replace("{cart}","<b>Ready</b>",$body);
				$body = str_replace("{order}","",$body);

			} else {
				if(isset($site_env->members_prices) && $site_env->members_prices){
					// 회원 가격 표시 제한 시 장바구니, 바로주문 비활성화 
					$body = str_replace("{cart}","",$body);
					$body = str_replace("{order}","",$body);
				} else {	
					// Cart 버튼 클릭시, 자바스크립트 실행
					$body = str_replace("{cart}","<input type='button' name='cart' value='장바구니' id=\"btn_detail_cart\">",$body);
			
					// 주문 버튼 클릭시, 자바스크립트 실행 
					$body = str_replace("{order}","<input type='button' name='order' value='바로구매' id=\"btn_detail_buynow\">",$body);
				}
			}

			$body = str_replace("{wish}","<input type='button' name='wish' value='관심상품' id=\"btn_detail_wish\">",$body);
			$body = str_replace("{reseller}","<input type='button' name='reseller' value='Reseller' onClick=\"javascript:_good_reselling_add()\" id=\"btn_detail_reseller\">",$body);

			$body=str_replace("{quotation}","견적요청",$body);
			$body=str_replace("{reselling}","리셀링",$body);
			//$body=str_replace("{order}","바로주문",$body);

			// 상품설명
			$description = "<span id=\"detail_description\">
					<script>"._javascript_ajax_html("#detail_description","/ajax_detail_description.php?uid=$uid")."</script>
					</span>";
			$body=str_replace("{description}",$description,$body);

			// 관련상품
			$relation = "<span id=\"detail_relation\">
					<script>"._javascript_ajax_html("#detail_relation","/ajax_detail_relation.php?uid=$uid")."</script>
					</span>";
			$body=str_replace("{relation}",$relation,$body);

			// 판매자 정보
			$seller_infomation = "<span id=\"seller_infomation\">
					<script>"._javascript_ajax_html("#seller_infomation","/ajax_detail_seller.php?uid=$uid")."</script>
					</span>";
			$body=str_replace("{seller}",$seller_infomation,$body);


			if($_SESSION['session_admin']){
				// 관리자 접속시, 상품 정보 직접 수정 가능
				$body = str_replace("{edit}","<input type='button' name='edit' value='상품수정' onclick=\"javascript:goodedit('edit','$uid')\" style=\"$css_btn_gray\">",$body);
				$body = str_replace("</head>","<link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link></head>",$body); 
			} else $body = str_replace("{edit}","",$body);


			echo $javascript.$body;



		} else {
			$skin_name = "default";
			$msg = "상품을 찾을 수 없습니다.";
			$body = _skin_body("default","error");
			$body = str_replace("{error_message}",$msg,$body);
			echo $body;
		}

	} else {
		$body =  _skin_emptybody($skin_name);
		$msg = "상품코드가 없습니다.";
		$body_error = _error_page($skin_name,$msg);
		$body = str_replace("<!--{skin_emptybody}-->",$body_error,$body);
		echo $body;
	}








	// 상품 사진 출력
	function _detail_goods_images($rows){


		if($rows->images1){
			$img_div .= "<div id=\"images1\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images1."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>";
        	$img_nav .= "<li class=\"active\" rel=\"images1\"><img src=\"".$rows->images1."\" width=\"40\"></li>";        
    	}

    	if($rows->images2){
       	 $img_div .= "<div id=\"images2\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images2."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>";
        	$img_nav .= "<li rel=\"images2\"><img src=\"".$rows->images2."\" width=\"40\"></li>";
        }

        if($rows->images3){
       		$img_div .= "<div id=\"images3\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images3."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>"; 
       	 $img_nav .= "<li rel=\"images3\"><img src=\"".$rows->images3."\" width=\"40\"></li>";
    	}

    	if($rows->images4){
        	$img_div .= "<div id=\"images4\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images4."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>"; 
        	$img_nav .= "<li rel=\"images4\"><img src=\"".$rows->images4."\" width=\"40\"></li>";
    	}

    	if($rows->images5){
        	$img_div .= "<div id=\"images5\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images5."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>"; 
        	$img_nav .= "<li rel=\"images5\"><img src=\"".$rows->images5."\" width=\"40\"></li>";
    	}

    	if($rows->images6){
        	$img_div .= "<div id=\"images6\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images6."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>"; 
        	$img_nav .= "<li rel=\"images6\"><img src=\"".$rows->images6."\" width=\"40\"></li>";
    	}

    	if($rows->images7){
       		$img_div .= "<div id=\"images7\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images7."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>"; 
       		$img_nav .= "<li rel=\"images7\"><img src=\"".$rows->images7."\" width=\"40\"></li>";
    	}

    	if($rows->images8){
        	$img_div .= "<div id=\"images8\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images8."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>"; 
        	$img_nav .= "<li rel=\"images8\"><img src=\"".$rows->images8."\" width=\"40\"></li>";
    	}

    	if($rows->images9){
        	$img_div .= "<div id=\"images9\" class=\"images_content\" style=\"width:100%\">
                    <img src=\"".$rows->images9."\" border='0' style=\"max-width:100%;height:auto;\"> 
                </div>"; 
        	$img_nav .= "<li rel=\"images9\"><img src=\"".$rows->images9."\" width=\"40\"></li>";
    	}

    	if($rows->images_watermark){
    		$watermark = _html_div("watermark","position:absolute;".$rows->images_watermark_css, $rows->images_watermark);
    	}

    	$body ="<div id=\"goods_container\">
            <div class=\"images_container\" style=\"position:relative;width:100%;\"> 
            $img_div 
            $watermark
            </div>
            <ul class=\"images_navtab\">$img_nav</ul>
        </div>";

        return $body;

	}

	function _detail_goodsname($rows){
		global $site_language;
		if($rows->check_goodname){
			$goodname = _goods_name($rows,$site_language);
			
			$goodname_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
								<td style=\"border-bottom:1px solid #E9E9E9;font-size:15px;padding:10px;\"><b>".$goodname."</b></td>
							</tr>
							</table>";
			
			// $goodname_skin = "<div style=\"width:100%;border-bottom:1px solid #E9E9E9;font-size:15px;padding:10px;\"><b>".$goodname."</b></div>";						
			return $goodname_skin;
		} 
	}

	function _detail_subtitle($rows){
		global $site_language;
		if($rows->check_subtitle){
				$goodsubtitle = _goods_subtitle($rows,$site_language);
				
				$goodsubtitle_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
								<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$goodsubtitle."</td>
							</tr>
							</table>";
				
				//$goodsubtitle_skin = "<div style=\"width:100%;border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$goodsubtitle."</div>";
			return $goodsubtitle_skin;			
		} 
	}

	function _detail_spec($rows){
		global $site_language;
		if($rows->check_spec){
				$goodspec = _goods_spec($rows,$site_language);
				$goodspec_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>스팩</td>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$goodspec."</td></tr></table>";
			return $goodspec_skin;
		} 
	}


	// 해당국가, 배송방법 설정
	function _detail_shipping($shipto){

		// 해당국가, 배송방법 설정
		$query1 = "select * from shop_delivery where target = '".$shipto."' and (enable = 'on' or enable = 'checked')";
    	if($rowss = _mysqli_query_rowss($query1)){	
    		$shipping = "<select name='shipping' id=\"shipping\"> ";
    		$shipping .= "<option value='' >배송방식 및 운임선택</option>";
		
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				$shipping .= "<option value='".$rows1->name.":".$rows1->charge."' >".$shipto.":".$rows1->name." - ".$rows1->charge." (".$rows1->priod.")</option>";
			}
			$shipping .= "</select>";
			
		} else {
			$shipping = "Sorry! Can't delivery (".$shipto.") country.";
		}

		return $shipping;
	}

	function _detail_free_shipping($rows){
		if($rows->free_shipping){
			$goodshipping_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>배송방법</td>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\"> 무료배송 <input type=hidden name shipping id=\"shipping\" value=\"0\"></td>
									</tr></table>";
			//$body = str_replace("{shipping}",$goodshipping_skin,$body);
		} else {
			if(isset($_SESSION['shippingto'])) $site_shippingto = $_SESSION['shippingto']; else $site_shippingto = "kr";
			$goodshipping = _detail_shipping($site_shippingto);
			$goodshipping_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>배송방법</td>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$goodshipping."</td>
									</tr></table>";
			//$body = str_replace("{shipping}",$goodshipping_skin,$body);
		}

		return $goodshipping_skin;
	}


	function _detail_ordertext($rows){
		// 사용자 주문문구 입력 여부 체크
		if($rows->ordertext){
			$goodsordertext_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">
										<textarea name='ordertext' rows='8' style='width:100%'>문구를 상세히 적어주세요...</textarea></td>
									</tr></table>";
			return $goodsordertext_skin;				
		} 
	}


	function _detail_attach($rows){
		//주문 첨부파일 부분 체크
		if($rows->attach){
			
			$label = explode(";", $rows->attach_label);
			for($i=0,$j=1;$i<count($label);$i++,$j++){
				$goodsattach_skin .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>".$label[$i]."</td>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">
										<input type='file' name='userfile$j'></td>
									</tr></table>";
			}
			
			return $goodsattach_skin;


		} 
	}

	function _detail_stock($rows){
		//재고 출력 
		if($rows->check_stock){
			$goodstock_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>재고수량</td>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$rows->stock."</td>
									</tr></table>";
			return $goodstock_skin;
		} 
	}

	function _detail_selling($rows){
		//판매수량
		if($rows->check_selling){
			$goodselling_skin = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>판매수량</td>
									<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$rows->selling."</td>
									</tr></table>";
			return $goodselling_skin;
		} 
	}


	function _detail_num($rows){
		// 주문수량 설정
		// 수량 변경시 자바스크립트를 통하여 금액 자졍 변경
		$body = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
							<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=100>주문 수량</td>
							<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">
								<input type='number' name='num' value='1' min='1' max='100' id=\"detail_num\"></td>
							</tr></table>";
		return $body;							
	}



?>