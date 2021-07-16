<?php

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

	// include "./func/currency.php";


	include "./func/datetime.php";
	include "./func/string.php";
	include "./func/currency.php";
	
	include "./func/error.php";
	include "./func/members.php";

	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	$javascript = "<script>
		function list(limit){
            var search = document.goods.searchkey.value;            
            var url = \"/ajax_search.php?limit=\"+limit+\"&search=\"+search; 
            ajax_html('#mainbody',url);
        }

		$('#btn_search').on('click',function(){
        	list(0);
    	});

		$('#cate_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	list(0);
        	}
    	});

		$('#listview').on('change',function(){
        	list(0);
    	});

		$('#listnum').on('change',function(){
        	list(0);
    	});
	</script>";


	// echo "상품검색 <br>";	
	if($search = _formdata("main_search")){

		$body = _theme_page($site_env->theme,"search",$site_language,$site_mobile);

		$query = "select * from shop_cate where Id='95' ";
		// echo $query;
		if($category_rows = _mysqli_query_rows($query)){
			// echo "catename = ".$category_rows->name."<br>";
		} else {
			// echo "cate error <br>";
		}

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='goods' method='post' enctype='multipart/form-data'>
												<input type='hidden' name='ajaxkey' value='$ajaxkey'>
												<input type='hidden' name='search' value='$search'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// 출력 갯수
		$_list_num = _formdata("list_num"); if(!$_list_num) $_list_num = "25";
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		// 정렬 상식		
		$sort = _formdata("sort"); if(!$sort) $sort = $category_rows->sort;						
		$body = str_replace("{sort}", _goodsSort_select($sort) ,$body);

		$viewCols = _goods_viewCols($category_rows);
		$viewRows = _goods_viewRows($category_rows);
		if($viewCols && $viewRows) $_list_num = $viewCols*$viewRows; else $_list_num = 10;
		$_block_num = 10;

		// View 출력 방식 설정
		$list_view = _formdata("view"); // 사용자 정의 view 모드 변경시 post값으로 읽어옴.
		if(!$list_view) $list_view = $category_rows->cate_type; // 초기 로딩시, 카테고리 설정정보로 읽어옴.
		if(!$list_view) $list_view = "tile2"; // 사용자 지정, 카테코리 설정 모두 없을경우 가로형(tile2) 으로 설정 
		$body = str_replace("{view}", _goods_viewType($list_view),$body);


		if($site_mobile == "m"){
			$cate_search_form = "
						<table border='0' cellpadding='0' cellspacing='0' width='100%'>
							<tr>
							<td><input type='text' name='searchkey' value='$search' id=\"cate_search\"></td>
							<td width='10'></td><td width='100'><input type='button' value='Search' id=\"btn_search\"></td>
							</tr>
						</table>";

		} else {
			$cate_search_form = "
						<table border='0' cellpadding='0' cellspacing='0' width='100%'>
							<tr>
							<td width='150' align='right'>상품명 검색</td>
							<td width='10'></td>
							<td><input type='text' name='searchkey' value='$search' id=\"cate_search\"></td>
							<td width='10'></td><td width='100'><input type='button' value='Search' id=\"btn_search\"></td>
							</tr>
						</table>";
		}	

		$body = str_replace("{cate_search}",$cate_search_form,$body);



		///////////////////
		// 상품 목록을 검색
		// 활성화된 상품만 출력  
		$query = "select * from shop_goods where enable='on' ";
		if($search) $query .= " and goodname like '%".$search."%' ";
		if($searchkey = _formdata("searchkey")) $query .= " and goodname like '%".$searchkey."%' ";
		$query .= "order by regdate desc ";		

		$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		$limit = _formdata("limit");
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// 검색된 데이터 내에서 , limit 설정 
		// echo $query."<br>";		
		if($goods_rowss = _mysqli_query_rowss($query)){						
					
			if($list_view == "list"){
				$divRows = _goods_listCell($category_rows, $goods_rowss);
				$list = _listView_bylisting($_list_num,"1", $divRows );

			} else if($list_view == "tile2"){ 
				$divRows = _goods_tileCell($category_rows, $goods_rowss);
				$list = _listView_byTileHorizontal($viewRows,$viewCols, $divRows );	

			} else if($list_view == "tile1"){
				$divRows = _goods_tileCell($category_rows, $goods_rowss);
				$list = _listView_byTileVertical($viewRows,$viewCols, $divRows );	

			}
								
			$list .= _pagination($_list_num,$_block_num,$limit,$total);	

			$body = str_replace("{good_list}", $list, $body);

		} else {
			if($cate_search){
				$msg = "상품 카테고리 내에 검색 키워드 \"".$cate_search."\" 상품이 없습니다.";
				$body = str_replace("{good_list}", $msg, $body);
			} else {
				$msg = "카테고리 상품이 없습니다.";
				$msg = _string($msg,$site_language);
				$body = str_replace("{good_list}", $msg, $body);
			}
		}

		echo $javascript.$body;

	} else {
		echo "<script> alert(\"검색명이 없습니다.\"); </script>";
	}



	



?>