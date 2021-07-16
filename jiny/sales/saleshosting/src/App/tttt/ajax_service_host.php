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
		

	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		
		function _listbar($_list_num,$_block_num,$limit,$total){
			$total_list = intval( $total / $_list_num ); // 전페 리스트 수
		$total_block = intval( $total_list / $_block_num ); // 전체 블럭 수
		$pageMenu = "";
		$pre = ""; $next = "";

		$pageMenu = "";
	   
		// 처음 데이터가 아닌경우, 처음으로 이동 버튼 생성.
		if($limit != 0) $pageMenu .= "[<a href='#' onclick=\"javascript:list('0')\">First</a>] "; // 처음 테이터

		// 현재 위치의 list 값 체크
		$current_list = intval( $limit / $_list_num );
		// 현제 위치의 block값 체크
		$current_block = intval( $current_list / $_block_num );

		if( $current_block >0) {
			// $pre = ($current_block - 1) * $_block_num * $_list_num; 
			$pre = $current_block * $_block_num * $_list_num - $_list_num; 
			$pageMenu .= "[<a href='#' onclick=\"javascript:list('".$pre."')\">Pre($pre)</a>] "; // 이전 블럭 
		}

		
		$i = $current_block * $_block_num; //현재 블럭의 시작
		$count = $i + $_block_num; // 블럭 크기많큼 표기 loop
		if($count>$total_list) $count = $total_list; // 만일 제일 마지막 loop가, total보다 적을때, 마지막을 total로 지정 
		for(;$i<$count; $i++){
			$j = $i * $_list_num;
				// if($limit == $j) $pageMenu .= "[<b>$i</b>] "; else $pageMenu .= "[<a href='".$_SERVER['PHP_SELF']."?limit=$j'>$i</a>] ";
				//  
			if($limit == $j){
				$pageMenu .= "[<b>$j</b>] "; 
			} else {
				$pageMenu .= "[<a href='#' onclick=\"javascript:list('".$j."')\">$j</a>] ";
			}
		}


		if( ($j + $_list_num) < $total) {
			$next = $j + $_list_num;
			//$next = $pre + $_block_num * $_list_num * 2; 
			//$next = $current_block + $_list_num*$_block_num;
			$pageMenu .= "[<a href='#' onclick=\"javascript:list('".$next."')\">Next($next)</a>] "; // 다음 블럭 
		}

		$last = $total_list * $_list_num;
		if($limit != $last) $pageMenu .= "[<a href='#' onclick=\"javascript:list('".$last."')\">Last</a>]"; // 마지막 데이터

		return "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				<tr><td style='font-size:12px;padding:10px;' align=center>".$pageMenu."</td></tr></table>";

		

		}



		$body = _skin_page($skin_name,"service_host");
		$body .= "<script>
			function host_mode(mode,uid){
                $.ajax({
                    url:'/ajax_service_host_editup.php?uid='+uid+'&mode='+mode,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('.mainbody').html(data);
                    }
                }); 	
            }

        	$('#search_keyword').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	list(0);
        	}
    		});

			function edit(mode,uid,limit){
				var search = document.service.searchkey.value;
                $.ajax({
                    url:'/ajax_service_host_edit.php?uid='+uid+'&mode='+mode+'&limit='+limit,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('.mainbody').html(data);
                    }
                }); 	
            }
                
            function list(limit){
                var search = document.service.searchkey.value;
                $.ajax({
                    url:'/ajax_service_host.php?limit='+limit+'&search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('.mainbody').html(data);
                    }
                }); 	
            }
        </script>";

		
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 
		//echo "limit = $limit<br>";
		$cate = _formdata("cate");
		$country = _formdata("country");
		$ajaxkey = _formdata("ajaxkey");

		$body = str_replace("{formstart}","<form name='service' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:edit('new','0','$limit')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_keyword\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:list('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);





		///////////////////
		// 상품 목록을 검색
		$query = "select * from `service_host` ";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.


		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){
			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' > 이메일 </td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'> 도메인</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'> 호스트</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'> 데이터베이스 </td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'> db계정</td>
							</tr>
						</table>";	

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' ><a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->email."</a></td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->domain."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->hostname."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->database."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->user."</td>
							</tr>
						</table>";	
				
				
			}
			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{host_list}",$list,$body);
			echo $body;
			
		} else {
			$msg = "상품 내역이 없습니다.";
			$body = str_replace("{host_list}",$msg,$body);
			echo $body;
		}	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

?>