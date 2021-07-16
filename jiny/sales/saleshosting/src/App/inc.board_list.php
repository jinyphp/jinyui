<?php

	// + 계시판 목록 처리
	if($board_rows->check_login){
		// 로그인 전용접속
		if(isset($_COOKIE['cookie_email'])){					
			// 로그인 상태
			$_board_enable = true;
		} else {
			// 로그인 접속 			
			$mainbody = _theme_page($site_env->theme,"error",$site_language,$site_mobile);
			$login_script = "<script>"._javascript_ajax_login($ajaxkey)."</script>";
			$mainbody = str_replace("<!--{error_message}-->",$login_script,$mainbody);
			
			$_board_enable = false; 
		}

	} else {
		// 모든 접속		
		$_board_enable = true; 
	}


	if($_board_enable){
		
		$limit = _formdata("limit");					
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");		
					
		$mainbody=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='mode'>
					    				<input type='hidden' name='uid'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='board' value='$board'>
					    				<input type='hidden' name='searchkey' value='$search'>
										<input type='hidden' name='list_num' value='$list_num'>",$mainbody);
		$mainbody = str_replace("{formend}","</form>",$mainbody);					

		// 출력 목록수 지정
		$_block_num = 10;
		if($_list_num = _formdata("list_num")){} else $_list_num = 10;
		$mainbody = str_replace("{list_num}", _listnum_select($_list_num),$mainbody);

		$searchkey = _formdata("searchkey");
		$mainbody = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$mainbody);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:search()\" style=\"".$css_btn_gray."\" >";           
		$mainbody = str_replace("{search}",$button_search,$mainbody);



		// 계시판 이름
		$mainbody = str_replace("{board_name}","<div id=\"board_name\">".stripslashes($board_rows->title)."</div>",$mainbody);
					
		// 글쓰기 권환 체크
		if($board_rows->check_write){
			$butten_new = "<input type='button' value='글작성' onclick=\"javascript:newEdit('new','0','$limit')\" style=\"".$css_btn_gray."\" >"; 
			$mainbody = str_replace("{new}",$butten_new,$mainbody);
		} else {
			$mainbody = _str_remove("{new}",$mainbody);
		}      
				


		$query = "select * from site_board where board = '$board' and enable='on' ";
		if($search) $query .= " and title like '%".$search."%' ";
		$query .= "order by pos desc ";

		$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.	
		$mainbody = str_replace("{total}",$total,$mainbody);

		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// 검색된 데이터 내에서 , limit 설정 

		// 계시판 리스트 제목
		if($board_rows->type == "gallary") {

		} else {
			$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"50\" align=\"right\">글번호</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' valign=\"top\">글제목</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120 valign=\"top\">작성자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120>작성일자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=50>조회수</td>
							</tr>
							</table>";
		}

		// 글 리스트
		if($rowss = _mysqli_query_rowss($query)){						

			for($i=0; $i<count($rowss); $i++,$j++){
				$rows = $rowss[$i];
				if($board_rows->type == "gallary") $list .= _gallary_list($board_rows,$rows); else $list .= _board_list($board_rows,$rows);
			}
		
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$mainbody = str_replace("{board_list}",$list,$mainbody);

		} else {
			$msg = "글 목록이 없습니다.";
			$mainbody = str_replace("{board_list}",$list."<div style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' align=\"center\">".$msg."</div>",$mainbody);

		}


				

	}
?>