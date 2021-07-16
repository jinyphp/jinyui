<?php

	// 플러그인 타이틀 이미지 처리
	function _plugIn_title($code){

		$query = "select * from site_index_title where code='$code' and enable='on'";
		if($rowss = _mysqli_query_rowss($query)){
			// 이미지가 여러개 일때는 슬라이트 처리 
			if(count($rowss)>1){
				// 슬라이드로 처리
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];
					$body = "<div id=\"title_$code\"> <img src='/images/".$rows->images."' boarder='0' style='max-width:100%;height:auto;'> </div>";
				}
			} else {
				$rows = $rowss[0];
				$body ="<div class=\"title_images\" style=\"position:relative;z-index:3;\" align=\"left\"> 
							<img src='/images/".$rows->images."' boarder='0' style='max-width:100%;height:auto;'>";
                // 이미지 내부 글자 오버레이 html 처리
                if($rows->inner){
                	$body .= "<div class=\"inner\" style=\"position:absolute;width:".$rows->inner_width."px;top:".$rows->inner_top."px;left:".$rows->inner_left."px;z-index:3;\">";
                   if($rows->inner_title) $body .= "<h3 class=\"title\">".$rows->inner_title."</h3>";
                   if($rows->inner_html) $body .= "<p class=\"description\">".$rows->inner_html."</p>";
                   $body .= "</div>";
                }

                $body .= "</div>";                
			}

			return $body;

		} else {
			$msg = "$code 는 잘못된 코드값 입니다. 정보를 읽을 수 없습니다.";
			$msg_string = _string($msg,$site_language);
			return $msg;
		}
	}


?>	