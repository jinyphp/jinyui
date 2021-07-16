<?php

    // ++ 계시판 관련 함수들

    $_table_site_boardlist = "site_boardlist";
    
    // ++ 계시판 목록을 읽어 옵니다.
    function _board_rows($code){
        global $_table_site_boardlist;

        $query = "select * from $_table_site_boardlist where code='$code'";
        // echo $query;
        if($rows = _mysqli_query_rows($query)) return $rows;
    }

  
    // ++ 계시판 목록을 리스트 형태로 출력
	function _board_list($board_rows,$rows){
		// global $board_rows;

		$level_tree = "";
		// 답변글 Reply 체크
		if($rows->level>0){
			for($j=0;$j<$rows->level;$j++) $level_tree .= "&nbsp;&nbsp;";
			$level_tree .= "└";
		}

		$writer = explode("@",$rows->email);
		$writer = $writer[0]."@*****";

		if($rows->check_secure && $rows->email != $_COOKIE['cookie_email']){
			// 비밀글
			$title = $rows->title." ";
		} else {
			// 비밀금 아니거나 , 본인 작성일 경우 수정 버튼 생성
			$title = "<a href='#' onclick=\"javascript:view('view','".$rows->Id."','$limit')\" >".$rows->title."</a>";
		}

		if($rows->check_secure) {
			// 비밀글 아이콘 표시 
			$title .= "  <i class=\"fa fa-unlock-alt\" style=\"color:#333333;\"></i>";
		}

		// ++ 제목만 출력함.
		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
			<tr>				
				<td style='font-size:16px;padding:10px;' valign=\"top\">$level_tree <b>$title</b></td>
				<td style='font-size:12px;padding:10px;' width=120 valign=\"top\">".$writer."</td>
				<td style='font-size:12px;padding:10px;' width=120>".$rows->regdate."</td>
				<td style='font-size:12px;padding:10px;' width=50>".$rows->click."</td>
			</tr>
			</table>";

		// 목록 본문 내용 표시..	
		if($board_rows->view_content){		

			$html = str_replace("\n", "<br>", stripslashes($rows->html));
			$list .= "<div id=\"board_listcontent\">$html</div>";

		} 

			
		return $list;
	}


	// ++ 계시판 목록을 갤러리 형태로 출력
	function _gallary_list($board_rows,$rows){
		// global $board_rows;
		global $site_mobile;

		
		$level_tree = "";
		// 답변글 Reply 체크
		if($rows->level>0){
			for($j=0;$j<$rows->level;$j++) $level_tree .= "&nbsp;&nbsp;";
			$level_tree .= "└";
		}

		$writer = explode("@",$rows->email);
		$writer = $writer[0]."@*****";

		if($rows->check_secure && $rows->email != $_COOKIE['cookie_email']){
			$title = $rows->title." ";
		} else {
			$title = "<a href='#' onclick=\"javascript:view('view','".$rows->Id."','$limit')\" >".$rows->title."</a>";
		}

		if($rows->check_secure) $title .= "  <i class=\"fa fa-unlock-alt\" style=\"color:#333333;\"></i>";

		$attach_files = explode(";", $rows->attach_files);
		for($i=0,$j=1;$i<count($attach_files);$i++){
			if($attach_files[$i]){
				$data = getimagesize($attach_files[$i]);

				if($board_rows->view_images_type == "withall" ){
    				// 한줄에 여러개 이미지 표시

    				if($site_mobile == "m"){
    					// 모바일 접속일 경우, 한개 이미지씩 표시

    					if($data[0] >= 320){
    						// 이미지 크기가 320보다 큰경우, 가로 스크롤 방지를 위하여 브라우져 100%로 처리
    						$images .= "<img src='$attach_files[$i]' border=\"0\" style=\"width:100%;height:auto;\"> <br>";
    					} else {
    						// 이미지가 320보다 작은 경우, 확대 출력 되지 않도록 원본 사이즈로 출력
    						$images .= "<img src='$attach_files[$i]' border=\"0\" > <br>";
    					}
    					
    					
    				} else {
    					// PC접속 

    					$tot_width += $data[0];
						$img_width[$j] = $data[0];
						$key = "_width_".$j."_";
						// $key / $j / $img_width[$j] $attach_files[$i] $data[0]
						$images .= "<div style=\"float:left;$key\"><img src=\"$attach_files[$i]\" border=\"0\" style=\"width:100%;height:auto;\"></div>";
						$j++;
    				}
					

    			} else {
    				// 한줄에 한개씩 이미지 표시

    				if($site_mobile == "m"){
    					// 모바일 접속일 경우
    					
    					if($data[0] >= 320){
    						// 이미지 크기가 320보다 큰경우, 가로 스크롤 방지를 위하여 브라우져 100%로 처리
    						$images .= "<img src='$attach_files[$i]' border=\"0\" style=\"width:100%;height:auto;\"> <br>";
    					} else {
    						// 이미지가 320보다 작은 경우, 확대 출력 되지 않도록 원본 사이즈로 출력
    						$images .= "<img src='$attach_files[$i]' border=\"0\" > <br>";
    					}

    				} else if( $board_rows->view_images_maxsize && $data[0] >= $board_rows->view_images_maxsize ){
    					// 출력할 이미지가 PC웹사이트 최대 가로사이즈 이상 큰경우, 100%로 출력
    					$images .= "<img src='$attach_files[$i]' border=\"0\" style=\"width:100%;height:auto;\"> <br>";

    				} else {
    					// 출력할 이미지가, 최대 사이즈 보다 작은 경우, 원본 사이즈로 출력 
						$images .= "<img src='$attach_files[$i]' border=\"0\" > <br>";

					}  
					

    			}

    				
			}			
		}

		for($k=1;$k<$j;$k++){
			$width = 100 / $tot_width * $img_width[$k];
			$key = "_width_".$k."_";
			$images = str_replace($key,"width:$width%",$images);
		}
		
		if($board_rows->view_content){
			
			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >";	
			$list .= "<tr><td style='font-size:16px;padding:10px;'><b>$title</b></td></tr>";
			$list .= "</table>";

			$list .= _html_div_clearfix($images,"text-align:center");

			$html = str_replace("\n", "<br>", stripslashes($rows->html));
			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
						<tr><td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>$html</td></tr></table>";

		} else {
			$list .= _html_div_clearfix($images,"text-align:center");

			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >";	
			$list .= "<tr><td style='border-bottom:1px solid #E9E9E9;font-size:16px;padding:10px;'><b>$title</b></td></tr>";
			$list .= "</table>";
		}	
		
		
			
		return $list;
	}	



?>