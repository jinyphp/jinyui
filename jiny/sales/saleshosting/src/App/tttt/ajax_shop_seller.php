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

		/////////////
		
		function _listbar($_list_num,$_block_num,$limit,$total){


		}

	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$javascript = "<script>

			$('#btn_search').on('click',function(){
        		sellerlist(0);
    		});

			$('#seller_search').on('keydown',function(e){         
        		if(e.keyCode == 13){
            		e.preventDefault();
            		sellerlist(0);
        		}
    		});

        	function sellerlist(limit){
           		var url = \"/ajax_shop_seller.php?limit=\"+limit;	
            	$.ajax({
                	url:url,
                	type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('.mainbody').html(data);
                	}
           		}); 	
        	}


        	function seller_edit(mode,uid){
            	var url = \"/ajax_shop_seller_edit.php?mode=\"+mode+\"&uid=\"+uid;	
            	// alert(url);
            	$.ajax({
                	url:url,
               		type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('.mainbody').html(data);
                	}
            	}); 	
        	}

        	function seller_mode(mode,uid){
            	var url = \"/ajax_shop_seller_editup.php?mode=\"+mode+\"&uid=\"+uid;	
            	// alert(url);
            	$.ajax({
                	url:url,
               		type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('.mainbody').html(data);
                	}
            	}); 	
        	}

			</script>";

		$body = $javascript._skin_page($skin_name,"shop_seller");


		
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 

		//echo "limit : ".$limit;

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='seller' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:seller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey'>",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:sellerlist('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);
		

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `shop_seller` ";

		if($searchkey) {
			$query .= " where seller like '%".$searchkey."%' ";
		}
		
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0,$list ="";$i<$count;$i++){
				$rows = $rowss[$i];

				$seller_email= "<a href='#' onclick=\"javascript:seller_edit('edit','".$rows->Id."')\">".$rows->email."</a>";

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
				
				if($rows->enable) $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:seller_mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='20' id=\"table_td\"> <a href='#' onclick=\"javascript:seller_mode('enable','".$rows->Id."')\">□</a></td>";

				$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->seller."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$seller_email."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->title."</td>";

				$list .= "</tr>
						</table>";
			}


			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{seller_list}",$list,$body);
			echo $body;
			//echo $list;
		} else {
			$msg = "입점 판매자가 없습니다.";
			$body = str_replace("{seller_list}",$msg,$body);
			echo $body;
			// echo $msg;
		}	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>