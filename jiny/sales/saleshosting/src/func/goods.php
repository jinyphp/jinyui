<?php









	function _index_goods_rows($code){
		$query = "select * from `site_index_goods` where code='$code'";
		if($rows = _mysqli_query_rows($query)){	
			return $rows;
		}	
	}





		// 지정된 상품 하나를 읽어옴
		function _goods_rows($uid){
			$query = "select * from `shop_goods` WHERE `Id`='$uid'";
			if($rows = _mysqli_query_rows($query)){	
				return $rows;
			}	
		}

		// 상품 전체를 읽어옴
		function _goods_rowss_all(){
			$query = "select * from `shop_goods`";
			if($rowss = _mysqli_query_rowss($query)){	
				return $rows;
			}	
		}

		// 상품 카테고리를 읽어옴
		function _goods_rowss_bycate($cate){
			$query = "select * from `shop_goods` WHERE `cate` like '%$cate%'";
			if($rowss = _mysqli_query_rowss($query)){	
				return $rows;
			}	
		}

		// 상품 키워드로 읽어옴.
		function _goods_rowss_bykeyword($keyword){
			$query = "select * from `shop_goods` WHERE `goodname` like '%$keyword%'";
			if($rowss = _mysqli_query_rowss($query)){	
				return $rows;
			}	
		}



	//# *************************

	
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






	
?>