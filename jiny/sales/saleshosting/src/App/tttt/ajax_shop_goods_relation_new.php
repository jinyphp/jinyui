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

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";


		$javascript = "<script>
			function relation_select(uid){
				var goods = $('#relation_goods').val();
				var result = goods + uid + ';';
				$('#relation_goods').val(result);


				$.ajax({
            		url:'/ajax_shop_goods_relation.php?relation='+result,
               		type:'post',
	               	data:$('form').serialize(),
	               	success:function(data){
                   		$('#relation_list').html(data);
               		}
            	});

				popup_close();
			}

			$('#goods_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	popup_list(0);
        	}
    		});

			// 팝업바디, 페이지 이동
			function popup_list(limit2){
              	//alert(limit2);
              	var goods_search = $('#goods_search').val();
              	goods_search = encodeURI(goods_search,'UTF-8')
                $.ajax({
                    url:'/ajax_shop_goods_relation_new.php?limit2='+limit2+'&goods_search='+goods_search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#popup_body').html(data);
                    }
                });
            }

            // 팝업창 닫기
    		$('#popup_close').on('click',function(){
        		popup_close();
    		});

    		 

        </script>";

        // 팝업창
		$body = $javascript._skin_page($skin_name,"shop_goods_relation_new");
		// $body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"X\" style=\"".$css_btn_gray."\"/>",$body);
		$body = str_replace("{close}",_html_div("popup_close","width:30px;height:30px; text-align:center; vertical-align: middle;","X"),$body);
		

		$goods_search = _formdata("goods_search");
		$body = str_replace("{searchkey}","<input type='text' name='goods_search' value='".$goods_search."' id=\"goods_search\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:popup_list('0')\" style=\"".$css_btn_gray."\" >";
		$body = str_replace("{btn_search}",$button_search,$body);



		$_list_num = 4;
		$_block_num = 10;
		$limit2 = _formdata("limit2");
		//echo "limit2 = ".$limit2."<br>";
		
		
		$query = "select * from `shop_goods` ";
		if($goods_search) $query .= "where goodname like '%$goods_search%'";
		$query .= " order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit2 설정 
		if($limit2) $query .= "LIMIT $limit2 , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;
		if($rowss = _sales_query_rowss($query)){

			if( ($total - $limit2) < $_list_num ) $count = $total - $limit2; else $count = $_list_num;

			//$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			//$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이미지</td>";
			//$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>상품명</td>";
			//$list .= "</tr></table>";
			//echo "count = ".count($rowss);
			for($i=0; $i<$count; $i++){
				$rows = $rowss[$i];	

				$goodname = _goods_name($rows,$site_language);

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>
								<a href='#' onclick=\"javascript:relation_select('".$rows->Id."')\"><img src=\"".$rows->images1."\" boarder=0 width=100></a></td>";
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> 
								<a href='#' onclick=\"javascript:relation_select('".$rows->Id."')\">".$goodname."</a></td>";
				
				$list .= "</tr></table>";

				
			}

			//# 페이지 이동 스크립트 함수를 list() -> popup_list()로 변경 
			$list .= str_replace(":list", ":popup_list", _listbar($_list_num,$_block_num,$limit2, $total));
			$body = str_replace("{list}", $list, $body);
		
		} else {
			$msg = "거래처 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
