<?php

	//* ////////////////////////////////////////////////////////////
	//* OpenShopping V2.1 
	//* 2015.11.06
	//* Program By : hojin lee 
	//*

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


	include "./func/string.php";
	include "./func/currency.php";
	

	include "./func/members.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	// 카테고리 분류코드를 읽어옴.
	// $code = $_GET['code']; if(!$code) $code = $_POST['code'];

	if($code = _formdata("code")){
		if($index_goods = _index_goods_rows($code)){

			$list = _plug_goodlist_title($index_goods);

			$viewCols = _goods_viewCols($index_goods);
			$viewRows = _goods_viewRows($index_goods);
			if($viewCols && $viewRows) $_list_num = $viewCols*$viewRows; else $_list_num = 10;
			$_block_num = 10;

			//echo "viewCols = ".$viewCols."<br>";
			//echo "viewRows = ".$viewRows."<br>";

			if($site_mobile == "m") $list_view = $index_goods->mobile_type; else $list_view = $index_goods->type;

			$query = "select * from shop_goods where enable = 'on' and cate like '%*".$index_goods->cate.";%' ";
			$query .= "LIMIT 0 , $_list_num ";
			// echo $query."<br>";
			if($goods_rowss = _mysqli_query_rowss($query)){

				if($list_view == "list"){
					$divRows = _goods_listCell($index_goods, $goods_rowss);
					$list .= _listView_bylisting($_list_num,"1", $divRows );

				} else if($list_view == "tile2"){ 
					$divRows = _goods_tileCell($index_goods, $goods_rowss);
					$list .= _listView_byTileHorizontal($viewRows,$viewCols, $divRows );	

				} else if($list_view == "tile1"){
					$divRows = _goods_tileCell($index_goods, $goods_rowss);
					$list .= _listView_byTileVertical($viewRows,$viewCols, $divRows );	

				}

				$list = str_replace("id=\"goodshorizontal_rows\"","id=\"plug_goodshorizontal_rows\"",$list);

				echo "<div id=\"plug_goodlist\">".$list."</div>";

				/*
				$goods_list = _goodview_tile1($index_goods,$goods_rowss);

				if($site_mobile == "m") $list_view = $index_goods->mobile_type; else $list_view = $index_goods->type;
				//echo $list_view;

				if($list_view == "list"){
					$goods_list = _goodview_tile1($index_goods,$goods_rowss);
				} else if($list_view == "tile1"){ 
					$goods_list = _goodview_tile1($index_goods,$goods_rowss);
				} else if($list_view == "tile2"){	
					$goods_list = _goodview_tile2($index_goods,$goods_rowss);
				}
				*/

				// echo _index_goods_skin($index_goods,$goods_list);
			}

			

		} else echo "카테고리 상품이 없습니다.";
	} else echo "카테고리가 설정되지 않았습니다.";


	function _plug_goodlist_title($index_goods){
		$width = "100%";

		$title = "<a href='goodlist.php?cate=".$index_goods->cate."'>".$index_goods->title."</a>";

		// 디자인 스킨
		if($index_goods->html_apply){
			// 사용자 정의 스킨 적용 
			$body = stripslashes($index_goods->html);
			$body = str_replace("{more}","<a href='goodlist.php?cate=".$index_goods->cate."'>+more</a>",$body);
			return "<div id=\"plug_goodlist_title\">".$body."</div>";
			// return _html_div("index_goods","border-bottom:1px solid #E9E9E9;width:$width;background-color:#ffffff;padding:10px;",$body);

		} else {			
			$title = "<a href='goodlist.php?cate=".$index_goods->cate."'>".$index_goods->title."</a>";
			$more = "<a href='goodlist.php?cate=".$index_goods->cate."'> More+</a>";
			
			$body = "<table border=\"0\" width=\"98%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
						<td style=\"font-size:12px;padding:10px;\">$title</td>
						<td style=\"font-size:12px;padding:10px;\" width='50'>$more</td>
					</tr></table>";
			return "<div id=\"plug_goodlist_title\">".$body."</div>";
			//return _html_div("index_goods","border-bottom:1px solid #E9E9E9;width:$width;background-color:#ffffff;",$body);
		}
	}


	function _index_goods_skin($index_goods,$list){

		$width = "100%";

		// 디자인 스킨
		if($index_goods->html_apply){
			// 사용자 정의 스킨 적용 
			$body = stripslashes($index_goods->html);
			$body = str_replace("{list}",$list,$body);
			$body = str_replace("{more}","<a href='goodlist.php?cate=".$index_goods->cate."'>+more</a>",$body);
			return _html_div("index_goods","border:1px solid #E9E9E9;width:$width;background-color:#ffffff;padding:10px;",$body);

		} else {
			
			$title = "<a href='goodlist.php?cate=".$index_goods->cate."'>".$index_goods->title."</a>";
			//$title_body  = _html_div("goods_title","float:left;font-size:12px;padding:10px;", $title );

			$more = "<a href='goodlist.php?cate=".$index_goods->cate."'> More+</a>";
			//$title_body .= _html_div("goods_title","float:right;ont-size:12px;padding:10px;", $more );

			//$body  = _html_div_clearfix($title_body,"border-bottom:1px solid #E9E9E9;");
			$body = "<table border=\"0\" width=\"98%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
						<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\">$title</td>
						<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width='50'>$more</td>
					</tr></table>";

			$body .= _html_div("goods_list","width:100%", $list );

			return _html_div("index_goods","border:1px solid #E9E9E9;width:$width;background-color:#ffffff;",$body);
		}
		
	}




	// 출력 스타일 : 세로형 타일
	function _goodview_tile1($cate,$rowss){
		global $site_env,$site_language,$site_mobile;

		if($site_mobile == "m"){
			if($cate->mobile_cols) $cate_cols = $cate->mobile_cols; else $cate_cols = 2;
			if($cate->mobile_rows) $cate_rows = $cate->mobile_rows; else $cate_rows = 2;
		} else {
			if($cate->cols) $cate_cols = $cate->cols; else $cate_cols = 5;
			if($cate->rows) $cate_rows = $cate->rows; else $cate_rows = 2;
		}

		if($cate_cols && $cate_rows) $list_num = $cate_cols * $cate_rows; else $list_num = 10;
		$_block_num = 10;
		
		$total = count($rowss);
    	if( $total >= $list_num ) $count = $list_num; else $count = $total;
 		// echo "total = $total / count = $count <br>";

    	// list body 초기화 
    	for($i=0;$i<$count;$i++) ${"list".$i} = "";

		for($i=0;$i<$count;$i++){
			$rows = $rowss[$i];

			$j = $i % $cate_cols;
			${"list".$j} .= _goods_div_tile($cate,$rows,"width:100%");
		}

		$width = 100 / $cate_cols;	
		for($j=0;$j<$cate_cols;$j++) {			
			$list .= _html_div("goods_tile", "float:left;width:$width%;", ${"list".$j} );
		}

    	return _html_div_clearfix($list,$css);

	}


	// 출력 스타일 : 가로형 타일
	function _goodview_tile2($cate,$rowss){
		global $site_env,$site_language,$site_mobile;
	
		$total = count($rowss);
		$css = "padding-bottom:10px;";

		if($site_mobile == "m"){
			if($cate->mobile_cols) $cate_cols = $cate->mobile_cols; else $cate_cols = 2;
			if($cate->mobile_rows) $cate_rows = $cate->mobile_rows; else $cate_rows = 2;
		} else {
			if($cate->cols) $cate_cols = $cate->cols; else $cate_cols = 5;
			if($cate->rows) $cate_rows = $cate->rows; else $cate_rows = 2;
		}

		if($cate_cols && $cate_rows) $list_num = $cate_cols * $cate_rows; else $list_num = 10;
		$_block_num = 10;

    	if($total >= $list_num) $count = $list_num; else $count = $total;
 
		$width = 100 / $cate_cols;

		for($i=0,$j=1;$i<$count;$i++,$j++){
			$rows = $rowss[$i];

			$listline .= _goods_div_tile($cate,$rows,"float:left;width:$width%;");

			if($j%$cate_cols == 0){				
				$list .= _html_div_clearfix($listline,$css);
				$listline = "";
			}
		}

		$list .= _html_div_clearfix($listline,$css);

    	return $list;
		
	}


?>