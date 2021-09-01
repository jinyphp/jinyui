<?php
	// ++ 타이틀 이미지 전처리기 코드를 처리하여, 이미지를 진열함
	// ++ 출력, Body {titleimg_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "titleimg_";
	if($keyword_count = _keyword_count($index_body, "{".$keyword)){
		$rows = _keyword_rows($index_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
			$class = $keyword.$rows[$i];
			// CSS id = 기능구분
			// CSS class = 세부 설정값 
			$index_body = str_replace("{".$class."}","<article class=\"$class\" id=\"title_images\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_titleimg.php?code=$rows[$i]")."</script>
					</article>\n",$index_body);
		}
	}
			


	// 상품진열 전처리기 코드를 처리하여, 상품을 진열함
	//상품리스트 출력, Body {goodlist_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "goodlist_";
	if($keyword_count = _keyword_count($index_body, "{".$keyword)){
		$rows = _keyword_rows($index_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
			$class = $keyword.$rows[$i];
			$index_body = str_replace("{".$class."}","<article  class=\"$class\" style='width:100%;z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_goodlist.php?code=$rows[$i]")."</script>
					</article>\n",$index_body);
		}
	}
	


	// 계시물 전처리기 코드를 처리하여, 계시판 내용 표시
	// 보드리스트 출력, Body {board_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "board_";
	if($keyword_count = _keyword_count($index_body, "{".$keyword)){
		$rows = _keyword_rows($index_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
			$class = $keyword.$rows[$i];
			$index_body = str_replace("{".$class."}","<article  class=\"$class\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_boardlist.php?board=$rows[$i]")."</script>
					</article>\n",$index_body);
		}
	}



	// 블럭코드 전처리기 코드를 처리하여, 상품을 진열함
	// 블럭리스트 출력, Body {blocklist_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "block_";
	if($keyword_count = _keyword_count($index_body, "{".$keyword)){
		$rows = _keyword_rows($index_body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
			$class = $keyword.$rows[$i];
			$index_body = str_replace("{".$class."}","<article class=\"$class\" id=\"block_html\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_blocklist.php?code=$rows[$i]")."</script>
					</article>\n",$index_body);
		}
	}




	// {category} 처릭코드가 있는경우
   	if(preg_match("{category}", $index_body)){
   		$index_body = str_replace("{category}", _skin_category($skin_name)."\n</body>", $index_body);
   	}
   	
?>