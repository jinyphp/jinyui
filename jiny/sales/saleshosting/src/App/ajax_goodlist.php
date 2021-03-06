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


	include "./func/datetime.php";
	include "./func/string.php";
	include "./func/currency.php";
	include "./func/goods.php";
	include "./func/error.php";
	include "./func/members.php";

	include "./func/css.php";

	include "./func/category.class.php";

	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	$javascript = "<script>
		function list(limit){

            var search = document.goods.searchkey.value;
            var url = \"/ajax_goodlist.php?limit=\"+limit+\"&search=\"+search;
            
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 
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
    	
    	$('#sort').on('change',function(){
        	list(0);
    	});

		$('#listview').on('change',function(){
        	list(0);
    	});

		$('#listnum').on('change',function(){
        	list(0);
    	});

		function goodedit(mode,uid){
			var url = \"ajax_goods_edit.php?uid=\"+uid+'&mode='+mode;
			popup_ajax(url);
			// ajax_html('#mainbody',url); 	
        }

	</script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey ) { // Ajax CallKey Securities Checking...
		
		if($code = _formdata("cate")){
			$query = "select * from shop_cate where Id='$code'";
			if($category_rows = _mysqli_query_rows($query)){// ???????????? ????????? ??????
	
				if($category_rows->check_members){
					$msg = "????????? ????????? ?????? ????????????.";
					$body_error = _error_page($skin_name,$msg);
					echo $body_error;

				} else {
					//$body = _skin_page($skin_name,"goodlist");
					$body = _theme_page($site_env->theme,"goodlist",$site_language,$site_mobile);
					$body = str_replace("<!--{#side_menu}-->", _subcate("default",$site_language,$code), $body);

					$body = str_replace("{formstart}","<form name='goods' method='post' enctype='multipart/form-data'>
														<input type='hidden' name='ajaxkey' value='$ajaxkey'>
														<input type='hidden' name='cate' value='$code'>",$body);
					$body = str_replace("{formend}","</form>",$body);


					// ?????? ??????
					$_list_num = _formdata("list_num"); if(!$_list_num) $_list_num = "25";
					$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

					// ?????? ??????		
					$sort = _formdata("sort"); if(!$sort) $sort = $category_rows->sort;						
					$body = str_replace("{sort}", _goodsSort_select($sort) ,$body);

					$viewCols = _goods_viewCols($category_rows);
					$viewRows = _goods_viewRows($category_rows);
					if($viewCols && $viewRows) $_list_num = $viewCols*$viewRows; else $_list_num = 10;
					$_block_num = 10;


					// View ?????? ?????? ??????
					$list_view = _formdata("view"); // ????????? ?????? view ?????? ????????? post????????? ?????????.
					if(!$list_view) $list_view = $category_rows->cate_type; // ?????? ?????????, ???????????? ??????????????? ?????????.
					if(!$list_view) $list_view = "tile2"; // ????????? ??????, ???????????? ?????? ?????? ???????????? ?????????(tile2) ?????? ?????? 
					$body = str_replace("{view}", _goods_viewType($list_view),$body);


					if($site_mobile == "m"){
						$cate_search_form = "
						<table border='0' cellpadding='0' cellspacing='0' width='100%'>
							<tr>
							<td><input type='text' name='searchkey' id=\"cate_search\"></td>
							<td width='10'></td><td width='100'><input type='button' value='Search' id=\"btn_search\"></td>
							</tr>
						</table>";

					} else {
						$cate_search_form = "
						<table border='0' cellpadding='0' cellspacing='0' width='100%'>
							<tr>
							<td width='150' align='right'>????????? ??????</td>
							<td width='10'></td>
							<td><input type='text' name='searchkey' id=\"cate_search\"></td>
							<td width='10'></td><td width='100'><input type='button' value='Search' id=\"btn_search\"></td>
							</tr>
						</table>";
					}	

					$body = str_replace("{cate_search}",$cate_search_form,$body);

				



					// ???????????? ?????? path ?????? ?????? 
					$body = str_replace("{category_url}", _category_pathname($category_rows->tree,$site_language) ,$body);


					

					///////////////////
					// ?????? ????????? ??????
					// ???????????? ????????? ??????  
					$query = "select * from `shop_goods` where enable='on' and cate like '%*".$code.";%' ";
					if($searchkey = _formdata("searchkey")) $query .= " and goodname like '%".$searchkey."%' ";
					switch($sort){
						case 'regdate':	$query .= "order by regdate desc ";	break;
						case 'pos':		$query .= "order by pos desc ";		break;
						case 'orders':	$query .= "order by orders_num desc ";	break;
						case 'click':	$query .= "order by click desc ";	break;
						case 'prices':	$query .= "order by prices_sell desc ";	break;
						default:		$query .= "order by regdate desc ";
					}
					
					//echo $query."<br>";

					$total = _mysqli_query_count($query); // ?????? ?????? ????????? ????????? ????????? ??????.

					$limit = _formdata("limit");
					if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// ????????? ????????? ????????? , limit ?????? 
					//echo $query."<br>";
				
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

						/*
						$listbar = _listbar($_list_num,$_block_num,$limit,$total);
						
						if($list_view == "list"){
							if($site_mobile == "m") $goods_list = _goodlist_list_m($cate, $goods_rowss); else $goods_list = _goodlist_list($cate, $goods_rowss);
							//echo $goods_list;
						} else if($list_view == "tile1"){ 
							$goods_list = _goodlist_tile1($cate, $goods_rowss);
						} else if($list_view == "tile2"){	
							$goods_list = _goodlist_tile2($cate, $goods_rowss);
							// echo $goods_list;
						}
						
						
						$body = str_replace("{good_list}",$listbar.$goods_list.$listbar, $body);
						*/

					} else {
						if($cate_search){
							$msg = "?????? ???????????? ?????? ?????? ????????? \"".$cate_search."\" ????????? ????????????.";
							$body = str_replace("{good_list}", $msg, $body);
						} else {
							$msg = "???????????? ????????? ????????????.";
							$msg = _string($msg,$site_language);
							$body = str_replace("{good_list}", $msg, $body);
						}
					}

					if($_SESSION['session_admin']){
						// ????????? ?????????, ?????? ?????? ?????? ?????? ??????
						// ++ ????????? ??????????????????
						$body = str_replace("{new}","<input type='button' name='edit' value='????????????' onclick=\"javascript:goodedit('new','')\" style=\"$css_btn_gray\">",$body);					
						$body = str_replace("{cate}","<input type='button' name='edit' value='????????????' onclick=\"javascript:cateedit('edit','')\" style=\"$css_btn_gray\">",$body);

					} else {
						$body = str_replace("{new}","",$body);
						$body = str_replace("{cate}","",$body);
					}

					if($category_rows->cell_outline_width && $category_rows->cell_outline_hovercolor){
						echo "<style>
							#goods:hover {
							border:".$category_rows->cell_outline_width." solid ".$category_rows->cell_outline_hovercolor.";
							margin:4px;
							}

							#goods {
								margin:5px;
							}
						</style>";
					}
					

					echo $javascript.$body;

				}

			} else {
				$msg = "???????????? ????????? ????????? ??? ????????????.";
				$body_error = _error_page($skin_name,_string($msg,$site_language));
				echo $body_error;
			}

		} else {
			$msg = "????????? ??????????????? ????????????.";
			$body_error = _error_page($skin_name,_string($msg,$site_language));
			echo $body_error;
		}	

	} else {
		$msg = "??????! ????????? ?????? ???????????? ???????????? ???????????? ?????? ???????????????. ????????? ?????? ??????????????? ?????? ????????????.";
		$body_error = _error_page($skin_name,_string($msg,$site_language));
		echo $body_error;
	}	

?>