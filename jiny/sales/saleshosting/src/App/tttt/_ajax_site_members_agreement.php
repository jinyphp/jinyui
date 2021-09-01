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
			/*
			$total_list = intval( $total / $_list_num ); // 전페 리스트 수
			$total_block = intval( $total_list / $_block_num ); // 전체 블럭 수
			$pageMenu = "";
			$pre = ""; $next = "";

			if($limit != 0) $pageMenu .= "[<a href='#' onclick=\"javascript:agree_list('0')\">First</a>] "; // 처음 테이터

			$current_list = intval( $limit / $_list_num );
			$current_block = intval( $current_list / $_block_num );

			if( $current_block >1) {
				$pre = ($current_block - 1) * $_block_num * $_list_num; 
				$pageMenu .= "[<a href='#' onclick=\"javascript:agree_list('".$pre."')\">Pre</a>] "; // 이전 블럭 
			}

			$i = $current_block * $_list_num;
			$count = $i + $_block_num; if($count>$total_list) $count = $total_list;
			for(;$i<$count; $i++){
				$j = $i * $_list_num;
				// if($limit == $j) $pageMenu .= "[<b>$i</b>] "; else $pageMenu .= "[<a href='".$_SERVER['PHP_SELF']."?limit=$j'>$i</a>] ";
				//  
				if($limit == $j){
					$pageMenu .= "[<b>$i</b>] "; 
				} else {
					$pageMenu .= "[<a href='#' onclick=\"javascript:agree_list('".$j."')\">$i</a>] ";
				}
			}

			if( $current_block < $total_block) {
				$next = $pre + $_block_num * $_list_num * 2; 
				$pageMenu .= "[<a href='#' onclick=\"javascript:agree_list('".$next."')\">Next</a>] "; // 다음 블럭 
			}

			$last = $total_list * $_list_num;
			if($limit != $last) $pageMenu .= "[<a href='#' onclick=\"javascript:agree_list('".$last."')\">Last</a>]"; // 마지막 데이터

			return "<center>".$pageMenu."</center>";
			*/

		}


		


		$body = _skin_page($skin_name,"site_members_agreement");


		
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 

		//echo "limit : ".$limit;

		$ajaxkey = _formdata("ajaxkey");

		
		$body = str_replace("{formstart}","<form name='agreement' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:agree_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey'>",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:agree_list('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);
		

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `site_members_agree` ";
		// echo $query."<br>";
		if($searchkey) {
			$query .= " where title like '%".$searchkey."%' ";
		}
		
		$query .= "group by code ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);
			

			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					  <tr>";
			$list .= "<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\">사용</td>
					  <td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\">필수</td>";
							
			$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>코드명</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>제목</td>
							</tr>
						</table>";	

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];		

				$title_name = "<a href='#' onclick=\"javascript:agree_edit('edit','".$rows->Id."')\">".$rows->code."</a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				if($rows->enable) $list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:agree_mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:agree_mode('enable','".$rows->Id."')\">□</a></td>";
				
				$list .= "<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\">".$rows->require."</td>";
										
				$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$title_name."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->title."</td>
							</tr>
						</table>";				


			}


			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{agreement_list}",$list,$body);
			echo $body;
			//echo $list;
		} else {
			$msg = "정적 페이지가 없습니다.";
			$body = str_replace("{agreement_list}",$msg,$body);
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