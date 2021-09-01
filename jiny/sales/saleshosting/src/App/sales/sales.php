<?
	// sales Goods

	// $table_sales_goods = "sales_goods";

	$path_sales_goods = "sales_goods.php";
	$path_ajax_sales_goods = "ajax_sales_goods.php";

	$path_sales_goods_edit = "sales_goods_edit.php";
	$path_ajax_sales_goods_edit = "ajax_sales_goods_edit.php";
	$path_ajax_sales_goods_editup = "ajax_sales_goods_editup.php";

	// 지정된 상품 하나를 읽어옴
	function _sales_goods_rows($uid){
		global $table_sales_goods;
		$query = "select * from sales_goods WHERE `Id`='$uid'";
		if($rows = _sales_query_rows($query)) return $rows;
	}



?>