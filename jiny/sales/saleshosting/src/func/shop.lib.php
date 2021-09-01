<?php

	// ++ 카테고리 경로 주소 url 표시
	function _category_pathname($tree,$lang){		
		$category = explode(">", $tree);
		$category_name="<a href='index.php'>Home</a>";
		for($k=0;$k<count($category);$k++){
			// $category_name .= $category
			$query = "select * from `shop_cate` where Id='$category[$k]'";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){
				$name = json_decode($rows->title);
				$category_name .= "><a href='goodlist.php?cate=".$rows->Id."'>".$name->$lang."</a>";
				//$category_name .= $rows->title;
			}	
		}
		return $category_name;
	}


	// +++++++
	function _goods_viewCols($cate){
		global $site_mobile;
		if($site_mobile == "m"){
			if($cate->mobile_cols) return $cate->mobile_cols; else return "2";
		} else {	
			if($cate->cols) return $cate->cols; else return "5";
		}		
	}

	function _goods_viewRows($cate){
		global $site_mobile;
		if($site_mobile == "m"){
			if($cate->mobile_rows) return $cate->mobile_rows; else return "2";
		} else {	
			if($cate->rows) return $cate->rows; else return "5";
		}		
	}

	function _goods_viewType($list_view){
		$form_view = "<select name='view' id=\"listview\">";
		if($list_view == "tile1") {
			$form_view .= "<option value='tile1' selected>세로형타일</option>"; 			
		} else $form_view .= "<option value='tile1'>세로형타일</option>";

		if($list_view == "tile2") {
			$form_view .= "<option value='tile2' selected>가로형타일</option>"; 			
		} else $form_view .= "<option value='tile2'>가로형타일</option>";

		if($list_view == "list") {
			$form_view .= "<option value='list' selected>List</option>"; 
		} else $form_view .= "<option value='list'>List</option>"; 
		$form_view .= "</select>";

		return $form_view;
	}

	function _goodsSort_select($sort){
		
		$form_sort = "<select name='sort' id=\"sort\" style=\"$css_textbox\">";
		if($sort == "regdate") $form_sort .= "<option value='regdate' selected>등록순</option>"; else $form_sort .= "<option value='regdate'>등록순</option>";
		if($sort == "pos") $form_sort .= "<option value='pos' selected>사용자지정</option>"; else $form_sort .= "<option value='pos'>사용자지정</option>";
		if($sort == "orders") $form_sort .= "<option value='orders' selected>주문건수</option>"; else $form_sort .= "<option value='orders'>주문건수</option>";
		if($sort == "click") $form_sort .= "<option value='click' selected>조회순</option>"; else $form_sort .= "<option value='click'>조회순</option>";
		$form_sort .= "</select>";
		
		return 	$form_sort;

	}

	function _listView_byTileHorizontal($viewRows,$viewCols,$divRows){
		$total = count($divRows); // 데이터 갯수
		$list_num = $viewRows * $viewCols; // 출력 표시수
		if($total >= $list_num) $count = $list_num; else $count = $total;

		$width = 100 / $viewCols;

		for($i=0;$i<$count;$i++){
			// $j = $i%$viewCols;
			// echo $j."<br>";
			if( $i>0 && ($i%$viewCols) == 0){
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%' id=\"goodshorizontal_rows\"><tr>".$data."</tr></table>"; // ++ 한중 완성, 출력 처리
				$data = NULL; // 초기화 
			}

			$data .= "<td width=\"".$width."%\" valign=\"top\">".$divRows[$i]."</td>"; // cell 추가 
		}

		
		$j = $i%$viewCols;
		if($j>0){
			// ++ 자투리 존채, 이후 셀 추가 처리
			for(;$j<$viewCols;$j++) $data .= "<td width=\"".$width."%\"></td>"; // cell 추가 
		} 

		if($data) $list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%' id=\"goodshorizontal_rows\"><tr>".$data."</tr></table>"; // ++ 한중 완성, 출력 처리
		
		return $list;
	}

	function _listView_byTileVertical($viewRows,$viewCols,$divRows){
		$total = count($divRows); // 데이터 갯수
		$list_num = $viewRows * $viewCols; // 출력 표시수
		if($total >= $list_num) $count = $list_num; else $count = $total;

		$width = 100 / $viewCols;

		for($i=0;$i<$count;$i++){
			$j = $i%$viewCols;
			${"list".$j} .= $divRows[$i];
		}

		for($j=0;$j<$viewCols;$j++) {
			$list .= "<td valign='top' width='$width%' id=\"goodsvertical_rows\">".${"list".$j}."</td>";
		}			

		$list  = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>".$list."</tr></table>";
		
		return $list;
		
	}

	function _listView_bylisting($viewRows,$viewCols,$divRows){
		$total = count($divRows); // 데이터 갯수

		for($i=0;$i<$total;$i++){
			$list .= $divRows[$i];
		}
		
		return $list;
	}

	// ++ 상품셀 생성 (타일)
	function _goods_tileCell($cate, $rowss){
		global $site_env,$site_language,$site_mobile;

		// ++ 회원 로그인 경우, 체크
		if( isset($_COOKIE['cookie_email']) ){
			$members_rows = _members_rows($_COOKIE['cookie_email']);
		}
		

		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];
			$div = NULL;

			if($cate->check_images){
				$link = "detail.php?uid=".$rows->Id;

				if($rows->images1) {					
					$images_src = ".".$rows->images1;
					$div .= "<div id=\"images\">"."<a href='$link'><img src='$images_src' border='0' style=\"width:100%;\"></a>"."</div>";
				} else {
					$div .= "<div id=\"images\">"."<a href='$link'>no images</a>"."</div>";
				}
			} 

			
			if($cate->check_goodname) $div .= "<div id=\"goodname\">"._goods_name($rows,$site_language)."</div>";		
			if($cate->check_spec) $div .= "<div id=\"spec\">"._goods_spec($rows,$site_language)."</div>";		
			if($cate->check_subtitle) $div .= "<div id=\"subtitle\">"._goods_subtitle($rows,$site_language)."</div>";

			if($cate->check_prices){
				if($site_env->members_prices){
					// ++ 전체 도멩인 환경설정 에서 회원가격 전용
					$div .= "<div id=\"prices\">"."회원가격전용"."</div>";
				} else {
					// ++ 타입에 따른 가격설정
					if($site_env->dome){
						$price_currency = $rows->b2b_currency;
						$prices = $rows->prices_b2b;
					} else {
						$price_currency = $rows->sell_currency;
						$prices = $rows->prices_sell;
					}
					
					// ++ 회원 할인 가격 적용
					if(isset($members_rows->discount)){
						// 할인전 가격 포맷
						$original_format = _currency_format($price_currency, $prices);
						if($cate->check_usd) $original_format .= " ("._currency_format("USD", $prices).")"; // ++ USD 가격 표시 
						$div .= "<div id=\"original\"> <span style=\"text-decoration:line-through;\">".$original_format."</span> </div>";

						$prices = $prices/100 * (100-intval($members_rows->discount));
					}

					$prices_format = _currency_format($price_currency, $prices);					
					if($cate->check_usd) $prices_format .= " ("._currency_format("USD", $prices).")"; // ++ USD 가격 표시 					

					// $div .= "currency : ".$price_currency;
					// $div .= "prices : ".$price;
					$div .= "<div id=\"prices\">".$prices_format."</div>";
			
					///
				}
			}	

			$dataBody[$i] = "<div id=\"goods\">".$div."</div>";
		}

		return $dataBody;
	}


	function _goods_listCell($cate, $rowss){
		global $site_env,$site_language,$site_mobile;

		// ++ 회원 로그인 경우, 체크
		if( isset($_COOKIE['cookie_email']) ){
			$members_rows = _members_rows($_COOKIE['cookie_email']);
		}
		

		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];
			$div_prices = NULL;
			$div_images = NULL;
			$div_name = NULL;

			if($cate->check_images){
				$link = "detail.php?uid=".$rows->Id;

				if($rows->images1) {					
					$images_src = ".".$rows->images1;
					$div_images = "<div id=\"images\">"."<a href='$link'><img src='$images_src' border='0' style=\"width:100%;\"></a>"."</div>";
				} else {
					$div_images .= "<div id=\"images\">"."<a href='$link'>no images</a>"."</div>";
				}
			} 

			
			if($cate->check_goodname) $div_name .= "<div id=\"goodname\">"._goods_name($rows,$site_language)."</div>";		
			if($cate->check_spec) $div_name .= "<div id=\"spec\">"._goods_spec($rows,$site_language)."</div>";		
			if($cate->check_subtitle) $div_name .= "<div id=\"subtitle\">"._goods_subtitle($rows,$site_language)."</div>";

			if($cate->check_prices){
				if($site_env->members_prices){
					// ++ 전체 도멩인 환경설정 에서 회원가격 전용
					$div_prices .= "<div id=\"prices\">"."회원가격전용"."</div>";
				} else {
					// ++ 타입에 따른 가격설정
					if($site_env->dome){
						$price_currency = $rows->b2b_currency;
						$price = $rows->prices_b2b;
					} else {
						$price_currency = $rows->sell_currency;
						$price = $rows->prices_sell;
					}
					
					// ++ 회원 할인 가격 적용
					if(isset($members_rows->discount)){
						// 할인전 가격 포맷
						$original_format = _currency_format($price_currency, $prices);
						if($cate->check_usd) $original_format .= " ("._currency_format("USD", $prices).")"; // ++ USD 가격 표시 
						$div_prices .= "<div id=\"original\"> <span style=\"text-decoration:line-through;\">".$original_format."</span> </div>";

						$price = $price/100 * (100-intval($members_rows->discount));
					}

					$prices_format = _currency_format($price_currency, $prices);					
					if($cate->check_usd) $prices_format .= " ("._currency_format("USD", $prices).")"; // ++ USD 가격 표시 					

					$div_prices .= "<div id=\"prices\">".$prices_format."</div>";
			
					///
				}
			}	

			$dataBody[$i] = "<table border='0' cellpadding='0' cellspacing='0' width='100%' id=\"goodslist_rows\">
								<tr>
								<td width=\"150\" valign=\"top\">$div_images</td>
								<td valign=\"top\">$div_name</td>
								<td width=\"150\" valign=\"top\">$div_prices</td>
								</tr>
							</table>";
			// "<div id=\"goods\">".."</div>";
		}

		return $dataBody;
	}


		function _goods_images_html($images,$size){
			if($images){
				if(!$size) $size="320";
				return "<img src='$images' border='0' width='$size'>";
			} else {
				return "<div style='width:".$size."px;height:".$size."px;background:#ffffff;' align='center' valign='center'>
						no image
						</div>";
			}
		
		}
			
		// 상품 이미지를 html코드로 리턴
		function _goods_images_tag($rows){
			$image_size = _formdata("image_size"); if(!$image_size) $image_size = "400";
			if(isset($rows->images1)) {
				// $images_src = $rows->images1;
				$images_src = "http://www.saleshosting.co.kr/".$rows->images1;
				return "<img src='$images_src' border='0' width='$image_size'>";
			} else {
				return "<div style='width:".$image_size."px;height:".$image_size."px;background:#cccccc;' align='center' valign='center'>no image</div>";
			}
		}

		// 상품명을 리턴
		function _goods_name($rows,$lang){
			if(isset($rows->goodname) && $lang){
				// iconv('CP949','UTF-8',) 
				$string = json_decode( $rows->goodname );
				if($lang) return $string->$lang; else $string->{'ko'}; 
			} else {
				$msg = "오류: 데이터 레코드 필드가 없습니다.";
				return $msg;
			}
		}

		// 서브타이틀을 리턴
		function _goods_subtitle($rows,$lang){
			if(isset($rows->subtitle) && $lang){
				// iconv('CP949','UTF-8',)
				$string = json_decode( $rows->subtitle );
				if($lang) return $string->$lang; else $string->{'ko'}; 
			} else {
				$msg = "오류: 데이터 레코드 필드가 없습니다.";
				return $msg;
			}
		}

		// 상품 스팩을 리턴 
		function _goods_spec($rows,$lang){
			if(isset($rows->spec) && $lang){
				// iconv('CP949','UTF-8',)
				$string = json_decode( $rows->spec );
				if($lang) return $string->$lang; else $string->{'ko'}; 
			} else {
				$msg = "오류: 데이터 레코드 필드가 없습니다.";
				return $msg;
			}
		}



		// 상품 선택옵션의 합계금액을 계산, 리턴.
		function _goods_option_prices($option_string){
			$prices = 0;
			$option = explode(";", $option_string);
			for($k=0;$k<sizeof($option);$k++) { 
				$option_prices = explode("=", $option[$k]); 
				$prices += @$option_prices[1];  // 옵션 가격을 더람.
			}
		}

		// 상품 선택옵션, 배송가격 리턴.
		function _goods_shipping_prices($shipping_string){
			$shipping = explode(":",$shipping_string);
			return @$shipping[1];
		}


		function _prices_discount($prices,$discount){
			if($discount && $discoint >0) return $price = $price/100 * (100-$discount); else return $prices;
		}

		function _prices_goods($goods,$dome){
			if($dome){
				//도매가격 사이트
				$price['currency'] = $goods->b2b_currency;
				$price['price'] = $goods->prices_b2b;
			} else {
				// 일반 사이트 
				$price['currency'] = $goods->sell_currency;
				$price['price'] = $goods->prices_sell;
			}
			return $price;
		}


			// 지정된 상품 하나를 읽어옴
	function _shop_goods_rows($uid){
		$query = "select * from `shop_goods` WHERE `Id`='$uid'";
		if($rows = _sales_query_rows($query)){	
			return $rows;
		}	
	}


	//
	//
	//
	// 상품 타일 객체
	function _goods_div_tile($cate,$rows,$css){
		// border:1px solid #E9E9E9;margin:-2px;
		if($rows){
			// $goods_body  = _html_div("discount", "position:absolute;top:0;left:0;", "25%");
			// $goods_body .= _goods_images($cate,$rows);			// 상품이미지 출력,
			$img_body = _goods_images($cate,$rows);

			if($rows->discount){
				// echo "cate Id = ".$cate->Id;
				// echo "discount bgcolor = ".$cate->cell_discount_bgcolor."<br>";
				if($cate->cell_discount_bgcolor) $cell_discount_bgcolor = $cate->cell_discount_bgcolor; else $cell_discount_bgcolor = "#000000";
				if($cate->cell_discount_color) $cell_discount_color = $cate->cell_discount_color; else $cell_discount_color = "#ffffff";

				$img_body .= _html_div("discount", "position:absolute;top:5px;left:5px;background-color:".$cell_discount_bgcolor.";color:".$cell_discount_color.";padding:2px;", $rows->discount_rate." Off");
			}
			

			if($rows->free_shipping){
				if($cate->cell_freeshipping_bgcolor) $cell_freeshipping_bgcolor = $cate->cell_freeshipping_bgcolor; else $cell_freeshipping_bgcolor = "#000000";
				if($cate->cell_freeshipping_color) $cell_freeshipping_color = $cate->cell_freeshipping_color; else $cell_freeshipping_color = "#ffffff";

				$img_body .= _html_div("freeshipping", "position:absolute;top:25px;left:5px;background-color:".$cell_freeshipping_bgcolor.";color:".$cell_freeshipping_color.";padding:2px;", "Free Shipping");
			}
			

			$goods_body = _html_div("goods_img", "position:relative;", $img_body);

			$goods_body .= _goods_div_name($cate,$rows);		// 상품명 출력,
			$goods_body .= _goods_div_spec($cate,$rows);		// 상품 스팩,
			$goods_body .= _goods_div_subtitle($cate,$rows);	// 상품 간략설명,
			$goods_body .= _goods_div_prices($cate,$rows);		// 가격 표시 처리 

			return _html_div("goods", $css, $goods_body );
			//$cell = _html_div("goods", "margin:-2px", $goods_body );

			//return _html_div("cell", $css, $cell);
		}
		
	}


	function _html_div_multi($width,$width_array){
		$_width = explode(",", $width_array);
		//echo $_width[0];

		// echo "count = ".count($_width);

		for($i=0;$i<count($_width);$i++) $body .= _html_div("", "float:left;width:".$_width[$i]."px;", "{div".$_width[$i]."}");

		return _html_div_clearfix($body,$css);
		
	}




	function _goods_div_list($cate,$rows,$css){
		if($rows){

			$img_body = _goods_images($cate,$rows);
			if($rows->discount)
			$img_body .= _html_div("discount", "position:absolute;top:5px;left:5px;background-color:#0f0f0f;color:#ffffff;padding:2px;", $rows->discount_rate." Off");

			if($rows->free_shipping)
			$img_body .= _html_div("discount", "position:absolute;top:25px;left:5px;background-color:#0f0f0f;color:#ffffff;padding:2px;", "Free Shipping");
	
			$table = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" ><tr>";
			$table .= "<td width='150' >"._html_div("goods_img", "width:150px;", _html_div("goods_img", "position:relative;", $img_body))."</td>";
			$table .= "<td >"._goods_div_name($cate,$rows)._goods_div_spec($cate,$rows)._goods_div_subtitle($cate,$rows)."</td>";
			$table .= "<td width='150' >"._goods_div_prices($cate,$rows)."</td>";
			$table .= "</tr></table>";
		
			// return $table;
			return _html_div("goods", $css, $table );
		}
	}

	function _goods_div_list_m($cate,$rows,$css){
		if($rows){
			$table = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
			<tr>
				<td width='150' >"._html_div("goods", "width:150px;", _goods_images($cate,$rows))."</td>
				<td >"._goods_div_name($cate,$rows)._goods_div_spec($cate,$rows)._goods_div_subtitle($cate,$rows)."</td>
			</tr>
			</table>"._goods_div_prices($cate,$rows);
		
			return $table;
		}
	}

	function _goods_images($cate,$rows){
		global $site_mobile;

		if($site_mobile == "m"){
			if($cate->mobile_imgsize) $img_size=$cate->mobile_imgsize; else $img_size = "130";
		} else {
			if($cate->cate_imgsize) $img_size=$cate->cate_imgsize; else $img_size = "180";
		}

		// 상품이미지 출력여부 체크 
		if($cate->check_images){
			return _html_div("goods_images", "padding:2px;", _goods_div_images($rows) );
		}	
	}

	// 
	// 상품 이미지 Div박스 생성
	function _goods_div_images($rows){
		$bgcolor = "#cccccc";

		// 상품 연결 링크
		$link = "detail.php?uid=".$rows->Id;

		if($rows->images1){	// 이미지가 있는 경우 

			// 이미지 파일 존재 여부를 체크해서 이미지를 표시함.
			if( _is_file(".".$rows->images1) ){
				// div 90%로 이미지를 표시.
				return "<a href='$link'> <img src='".$rows->images1."' border='0' style='width:90%;height:auto;'> </a>";		
			} else {
				// 이미지 파일 오류ㅣ 실제 파일이 존재하지 않는 경우 
				$error = "images Error <br>".$rows->images1;
				return _goods_div_noimages($bgcolor,"<a href='$link'> $error </a>");
			}

		} else {	// 이미지 파일이 없는 경우 
			return _goods_div_noimages($bgcolor,"<a href='$link'>no image</a>");
		}
			
	}



	function _goods_div_noimages($bgcolor,$content){
		return "<div style='width:100%; min-height:160px; background:$bgcolor;' align='center' valign='center'> $content </div>";
	}


	function _goods_div_name($cate,$rows){
		global $site_language;

		$link = "detail.php?uid=".$rows->Id;

		if($cate->check_goodname){ //# 상품명
			$goodname = _goods_name($rows,$site_language);
			return _html_div("goods_name", "padding:2px;", "<a href='$link'>".$goodname."</a>" );
		}
	}

	function _goods_div_spec($cate,$rows){
		global $site_language;
		
		// 상품 스팩정보 출력
		if($cate->check_spec){ // SPEC 출력 
			$goodspec = _goods_spec($rows,$site_language);
			return _html_div("goods_spec", "padding:2px;", $goodspec );
		}
	}

	function _goods_div_subtitle($cate,$rows){
		global $site_language;
		
		// 상품 스팩정보 출력
		if($cate->check_subtitle){ // SPEC 출력 
			$goods_subtitle = _goods_subtitle($rows,$site_language);
			return _html_div("goods_subtitle", "padding:2px;", $goods_subtitle );
		}
	}


	function _goods_div_prices($cate,$rows){
		global $site_env,$site_language,$site_mobile;

		if($cate->check_prices){
			if(isset($site_env->members_prices) && $site_env->members_prices){				
				$prices_string = "회원가격전용";		// 전체 도멩인 환경설정 에서 회원가격 전용
			
			} else {
				//
				if($cate->check_memprices){
					
					$prices_string = "회원가격전용";		// 카테고리 회원 가격 전용 체크
				
				} else {

					if(isset($site_env->dome) && $site_env->dome){
						$prices_string = _goods_div_prices_dome($cate,$rows);
					} else {
						$prices_string = _goods_div_prices_retail($cate,$rows);
					}
				}
			}
			 
			return _html_div("goods_prices", "", $prices_string );
		}

	}

	//도매가격 사이트 가격 
	function _goods_div_prices_dome($cate,$rows){	

		if( isset($_COOKIE['cookie_email']) ) $members = _members_rows($_COOKIE['cookie_email']);
		
		$price_currency = $rows->b2b_currency;
		$price = $rows->prices_b2b;
						
		if($cate->check_currency){
			if($rows->check_currency){
				$prices_string = "<div>$price_currency</div>";
			} else $prices_string  = "";
		} else $prices_string  = "";

		// 회원 할인적용, 
		if(isset($members->discount)){
			$format = number_format($price,0,'.',',')."원";
			if($cate->check_usd){
				$prices_usd = _prices_USD($price_currency ,$price);
				$string_usd = "(USD ".number_format($prices_usd['prices'],2,'.',',').")";
			} else $string_usd ="";
			$prices_string .= "<div> 도매가격 <span style=\"text-decoration:line-through;\">$format $string_usd</span> </div>";

			$price = $price/100 * (100-intval($members->discount));
			$format = number_format($price,0,'.',',')."원";
			if($cate->check_usd){
				$prices_usd = _prices_USD($price_currency ,$price);
				$string_usd = "(USD ".number_format($prices_usd['prices'],2,'.',',').")";
			} else $string_usd ="";
				$prices_string .= "<div> 회원가격 $format $string_usd</div>";
			} else {
				$format = number_format($price,0,'.',',')."원";
				if($cate->check_usd){
					$prices_usd = _prices_USD($price_currency ,$price);
					$string_usd = "(USD ".number_format($prices_usd['prices'],2,'.',',').")";
				} else $string_usd ="";
			$prices_string .= "<div> 도매가격 $format $string_usd</div>";
		}

		return $prices_string;
	}

	function _goods_div_prices_retail($cate,$rows){
		if( isset($_COOKIE['cookie_email']) ) $members = _members_rows($_COOKIE['cookie_email']);

		// 일반 사이트 
		$price_currency = $rows->sell_currency;
		$price = $rows->prices_sell;

		// 회원 할인적용, 
		if(isset($members->discount)){
			if($cate->check_currency){
				if($rows->check_currency){
					$prices_string = "<div>$price_currency</div>";
				} else $prices_string  = "";
			} else $prices_string  = "";

			$format = number_format($price,0,'.',',')."원";
			if($cate->check_usd){
				$prices_usd = _prices_USD($price_currency ,$price);
				$string_usd = "(USD ".number_format($prices_usd['prices'],2,'.',',').")";
			} else $string_usd ="";
			$prices_string .= "<div> <span style=\"text-decoration:line-through;\">$format $string_usd</span> </div>";

			$price = $price/100 * (100-intval($members->discount));
			$format = number_format($price,0,'.',',')."원";
			if($cate->check_usd){
				$prices_usd = _prices_USD($price_currency ,$price);
				$string_usd = "(USD ".number_format($prices_usd['prices'],2,'.',',').")";
			} else $string_usd ="";
			$prices_string .= "<div> 회원가격 $format $string_usd</div>";

		} else {
			$format = number_format($price,0,'.',',')."원";
			if($cate->check_usd){
				$prices_usd = _prices_USD($price_currency ,$price);
				$string_usd = "(USD ".number_format($prices_usd['prices'],2,'.',',').")";
			} else $string_usd ="";

			if($cate->check_currency){
				//$prices_string = "<tr><td>$price_currency</td></tr>";
				$prices_string = "<div>$price_currency: $format $string_usd</div>";
			} else $prices_string = "<div> $format $string_usd</div>";	
		}

		return $prices_string;

	}	


/*

	// 출력 스타일 : 세로형 타일
	function _goodlist_tile1($cate,$rowss){
		global $site_env,$site_language,$site_mobile;	
	
		$cate_cols = _cate_cols($cate,$site_mobile);
		$cate_rows = _cate_rows($cate,$site_mobile);
		$list_num = $cate_cols*$cate_rows;
		$_block_num = 10;
		
		$total = count($rowss);
    	if( $total >= $list_num ) $count = $list_num; else $count = $total;
 		// echo "total = $total / count = $count <br>";

    	// list body 초기화 
    	for($i=0;$i<$count;$i++) ${"list".$i} = "";

		for($i=0;$i<$count;$i++){
			$rows = $rowss[$i];

			$j = $i % $cate_cols;

			$cell = _goods_div_tile($cate,$rows,"max-width:100%;");
			${"list".$j} .= _html_div("tile1", "", $cell);; //_goods_div_tile($cate,$rows,"max-width:100%");
		}

		$width = 100 / $cate_cols;	
		for($j=0;$j<$cate_cols;$j++) {	
			if($j<($cate_cols-1)){
				$list .= _html_div("goods_tile", "float:left;width:$width%;border-right:2px solid #E9E9E9;margin-right:-2px;", ${"list".$j} );
			} else {
				$list .= _html_div("goods_tile", "float:left;width:$width%;", ${"list".$j} );
			}	
			
		}

    	return _html_div_clearfix($list,$css);
	}



	// 출력 스타일 : 가로형 타일
	function _goodlist_tile2($cate,$rowss){
		global $site_env,$site_language,$site_mobile;

		$cate_cols = _cate_cols($cate,$site_mobile);
		$cate_rows = _cate_rows($cate,$site_mobile);
		$list_num = $cate_cols*$cate_rows;
		$_block_num = 10;

		$total = count($rowss);
    	if($total >= $list_num) $count = $list_num; else $count = $total;
 
		$width = 100 / $cate_cols;
		// echo "width(%) = $width";

		for($i=0,$j=1;$i<$count;$i++,$j++){
			$rows = $rowss[$i];

			$cell = _goods_div_tile($cate,$rows,"max-width:100%;");
			$listline .= _html_div("tile2", "float:left;width:$width%;", $cell);
			if($j%$cate_cols == 0){				
				$list .= _html_div_clearfix($listline,"width:100%;border-bottom:2px solid #E9E9E9;");
				// $list .= _html_div("", "width:100%;border-bottom:1px solid #E9E9E9;padding:1px;", "000");
				$listline = "";
			}
		}

		$list .= _html_div_clearfix($listline,"width:100%;border-bottom:2px solid #E9E9E9;padding-bottom:10px;");

    	return $list;
	}



	function _cate_cols($cate,$mobile){
		if($mobile == "m"){
			if($cate->mobile_cols) $cate_cols = $cate->mobile_cols; else $cate_cols = 2;
		} else {
			if($cate->cols) $cate_cols = $cate->cols; else $cate_cols = 5;
		}
		return $cate_cols;
	}

	function _cate_rows($cate,$mobile){
		if($mobile == "m"){
			if($cate->mobile_rows) $cate_rows = $cate->mobile_rows; else $cate_rows = 5;
		} else {
			if($cate->rows) $cate_rows = $cate->rows; else $cate_rows = 5;
		}
		return $cate_rows;
	}	


	// 출력 스타일 : 리스트
	function _goodlist_list($cate,$rowss){
		global $site_env,$site_language,$site_mobile;

		$cate_cols = _cate_cols($cate,$site_mobile);
		$cate_rows = _cate_rows($cate,$site_mobile);
		$list_num = $cate_cols*$cate_rows;
		$_block_num = 10;

		$total = count($rowss);
    	if($total >= $list_num) $count = $list_num; else $count = $total;

		for($i=0,$j=1;$i<$count;$i++,$j++){
			$rows = $rowss[$i];
			$list .= _goods_div_list($cate,$rows,"width:100%;border-bottom:2px solid #E9E9E9;");			
		}	

    	return $list;
	}


	function _goodlist_list_m($cate,$rowss){
		global $site_env,$site_language,$site_mobile;	

		$cate_cols = _cate_cols($cate,$site_mobile);
		$cate_rows = _cate_rows($cate,$site_mobile);
		$list_num = $cate_cols*$cate_rows;
		$_block_num = 10;

		$total = count($rowss);
    	if($total >= $list_num) $count = $list_num; else $count = $total;

		for($i=0,$j=1;$i<$count;$i++,$j++){
			$rows = $rowss[$i];
			$list .= _goods_div_list_m($cate,$rows,"width:100%;");			
		}	

    	return $list;
	}

*/


?>