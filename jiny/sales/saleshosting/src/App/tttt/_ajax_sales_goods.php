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

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/pagination.php";

	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		include "./sales.php";


		$javascript = "<script>
			function bom_edit(mode,uid){
                  	$.ajax({
                        url:'/ajax_sales_goods_bom.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#goods').html(data);
                        }
                    }); 	
            }

			function edit(mode,uid){
                  	$.ajax({
                        url:'/ajax_sales_goods_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#goods').html(data);
                        }
                    }); 	
            }
                
            function list(limit){
                	var search = document.goods.searchkey.value;
                  	$.ajax({
                        url:'/ajax_sales_goods.php?limit='+limit+'&search='+search,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#goods').html(data);
                        }
                    }); 	
            }
        </script>";


		$body = $javascript._skin_page($skin_name,"sales_goods");

		$_list_num = 10;
		$_block_num = 10;


		$body = str_replace("{formstart}","<form name='goods' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='inout' value='$inout'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\"  >";          
		$body = str_replace("{new}",$button,$body);

		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\"  >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);

		// 창고별 재고 관리
		$query1 = "select * from `sales_goods_house` ";
		if($rowss1 = _sales_query_rowss($query1)){
			for($j=0;$j<count($rowss1);$j++) {
				$rows1 = $rowss1[$j];
				$stock_rowss[$j] = $rows1->Id;
			}
		}
	
		$house = _formdata("house");
		//echo "house = $house <br>";
		$query = "select * from `sales_goods` ";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";	// 검색된 데이터 내에서 , limit 설정 
		echo $query;

		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";				
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>제품명</td>";

			if($house){
				$query2 = "select * from `sales_goods_house` where Id='".$house."'";
				//echo $query1."<br>";
				if($rows2 = _sales_query_rows($query2)){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'><b>".$rows2->name."<b></td>";
				}	
			} else {
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>재고수량</td>";
			}
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>판매가격</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>B2B가격</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매입가격</td>";
			$list .= "</tr></table>";

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

			
				for($j=0,$stock=0;$j<count($stock_rowss);$j++){
					$stock_code = "stock_".$stock_rowss[$j];
					$stock += $rows->$stock_code;
				}
				
				if($rows->bom) $from_bom = "[<a href='#' onclick=\"javascript:bom_edit('bom','".$rows->Id."')\">생산+</a>]"; else $form_bom = "";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";	
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
								<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->name."</a> $from_bom </td>";
				if($house){
					$house_code = "stock_".$house;
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'><b>".$rows->$house_code."<b></td>";
				} else {				
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$stock."</td>";
				}
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->prices_sell."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->prices_b2b."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->prices_buy."</td>";
				$list .= "</tr></table>";

				
			}

			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{list}", $list, $body);

		} else {
			$msg = "상품 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$body = _skin_body($skin_name,"login");
		
		$login_script = "<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
		</script>";  

		echo $body.$login_script;
	}	


	
?>
