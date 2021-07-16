<?
	// 판매관리 : 제품 관련 라이브러리
	// 2016.04.03

	// ******************************
	
	// 판매관리 상품 기본 테이블
	$table_sales_goods['goods'] = "sales_goods";

	// 제조상품 생산이력 기록
	$table_sales_goods['bom'] = "sales_goods_bom";

	// 제품 저장 창고목록
	$table_sales_goods['house'] = "sales_goods_house";		

	// 재고 사용이력
	$table_sales_goods['stock'] = "sales_goods_stock";
	

	//$table_sales_goods = array('house'=>'sales_goods_house');



	// ******************************

	// 상품처리 관련 php 파일들
	$sales_goods_phpPath['goods'] = "sales_goods.php";
	$sales_goods_phpPath['goods_edit'] = "sales_goods_edit.php";

	$sales_goods_phpPath['ajax_goods'] = "ajax_sales_goods.php";
	$sales_goods_phpPath['ajax_goods_edit'] = "ajax_sales_goods_edit.php";
	$sales_goods_phpPath['ajax_goods_editup'] = "ajax_sales_goods_editup.php";
	$sales_goods_phpPath['ajax_goods_list'] = "ajax_sales_goods_list.php";

	// 생산 관련 php 파일들
	$sales_goods_phpPath['goods_bom'] = "sales_goods_bom.php";
	$sales_goods_phpPath['goods_bom_edit'] = "sales_goods_bom_edit.php";

	$sales_goods_phpPath['ajax_goods_bom'] = "ajax_sales_goods_bom.php";
	$sales_goods_phpPath['ajax_goods_bom_edit'] = "ajax_sales_goods_bom_edit.php";
	$sales_goods_phpPath['ajax_goods_bom_editup'] = "ajax_sales_goods_bom_editup.php";
	$sales_goods_phpPath['ajax_goods_bom_list'] = "ajax_sales_goods_bom_list.php";

	// 동기화 관련 php 파일들
	$sales_goods_phpPath['goods_sync'] = "sales_goods_sync.php";

	$sales_goods_phpPath['ajax_goods_sync'] = "ajax_sales_goods_sync.php";
	$sales_goods_phpPath['ajax_goods_syncup'] = "ajax_sales_goods_syncup.php";

	// 창고 관련 php 파일들
	$sales_goods_phpPath['house'] = "sales_house.php";
	$sales_goods_phpPath['house_edit'] = "sales_house_edit.php";

	$sales_goods_phpPath['ajax_house'] = "ajax_sales_house.php";
	$sales_goods_phpPath['ajax_house_edit'] = "ajax_sales_house_edit.php";
	$sales_goods_phpPath['ajax_house_editup'] = "ajax_sales_house_editup.php";

	// ******************************

	

	function _sales_typeBom($bom){
		global $css_textbox;

		$form_bom = "<select name='bom' id=\"bom\" style=\"$css_textbox\">";
		if($bom  == "bom") $form_bom .= "<option value='bom' selected>제조생산</option>"; else $form_bom .= "<option value='bom'>제조생산</option>";
		if($bom  == "goods") $form_bom .= "<option value='goods' selected>매입상품</option>"; else $form_bom .= "<option value='goods'>매입상품</option>";
		if($bom  == "all" || $bom == NULL) $form_bom .= "<option value='all' selected>상품구분</option>"; else $form_bom .= "<option value='all'>상품구분</option>";
		$form_bom .= "</select>";

		return $form_bom;
	}

	function _sales_typeProducts($products){
		global $css_textbox;

		$form_products = "<select name='products' id=\"products\" style=\"$css_textbox\">";
		if($products  == "products") $form_products .= "<option value='products' selected>일반제품</option>"; else $form_products .= "<option value='products'>일반제품</option>";
		if($products  == "shopping") $form_products .= "<option value='shopping' selected>쇼핑몰상품</option>"; else $form_products .= "<option value='shopping'>쇼핑몰상품</option>";
		if($products  == "all" || $products == NULL) $form_products .= "<option value='all' selected>판매방식</option>"; else $form_products .= "<option value='all'>판매방식</option>";
		$form_products .= "</select>";

		return $form_products;
	}	

	function _sales_goodsHouse_select($house){
		
		global $css_textbox;
		global $table_sales_goods;

		$form_house = "<select name='house' id=\"house\" style=\"$css_textbox\" >";
		$query = "select * from ".$table_sales_goods['house']." where enable ='on'";
		// echo $query;

		if($house){ 
			$form_house .= "<option value=''>전체창고</option>"; 
		} else {
			$form_house .= "<option value='' selected>전체창고</option>";
		}

		if($rowss = _sales_query_rowss($query)){
			
			

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($house == $rows1->house){
					$form_house .= "<option value='".$rows1->name."' selected>".$rows1->name."</option>"; 
				} else {
					$form_house .= "<option value='".$rows1->name."'>".$rows1->name."</option>";
				}
			}
		}
		$form_house .= "</select>";

		return $form_house;

	}


?>