<?php
	//* ///////////////////////
	//* OpenShopping V2.1 
	//* Program By : hojin lee 
	//*
	
	// update : 2016.01.06 = 코드정리 

	// body내에서 키워드 갯수를 검색.
	// 리턴 : 키워드 갯수 
	function _keyword_count($body, $keyword){
    	$count = substr_count($body, $keyword);
    	return $count;
    }

    // Body네에서 키워드값을 배열로 읽어온다.
    // 리턴 : 배열값
    function _keyword_rows($body,$keyword,$count){
    	for($pos=0,$j=0,$i=0;$i<$count;$i++){
			$pos = strpos($body,$keyword,$pos);
			if ($pos !== false) {
    			// echo "'bodyindex' 문자열을 '{slider' 문자열에서 찾았습니다.";
    			// echo "위치 $pos 에 존재합니다.<br>";
    			$pos += strlen($keyword);
    			$num = "";
    			while(1){
    				if($body[$pos]=="}") break; 
    				else {
    					$num .= $body[$pos];
    					$pos++;
    				}
    			}
    				
    			if($num){
    				$rows[$j] = $num;
    				$j++;
    			} 
			}
		}

		return $rows;
    }



	// body 페이지 처리, 해더 / 풋터 / 메뉴등 모든 프레임을 포함한 스킨으로 처리하여 리턴.
	function _skin_body($skin_name,$html_code){
		global $site_country, $site_language, $site_mobile;	

		$body = _skin_emptybody($skin_name);

		if($site_mobile == "m"){
			// 모든바일 페이지 읽어옴.
			if(_is_file("./skin/$skin_name/$html_code.".$site_language.".m.htm")){
				// 모바일용으로 읽어옴.
				$code_body = _file_load("./skin/$skin_name/$html_code.".$site_language.".m.htm");
			} else {
				// 모바일 스킨 페이지가 없을 경우, PC용으로 읽어옴
				$code_body = _file_load("./skin/$skin_name/$html_code.".$site_language.".htm");
			}
		} else {
			$code_body = _file_load("./skin/$skin_name/$html_code.".$site_language.".htm");
		}

		$body = str_replace("<!--{skin_emptybody}-->",$code_body,$body);

		

		// {category} 처릭코드가 있는경우
   		if(preg_match("{category}", $body)){
   			$body = str_replace("{category}", _skin_category($skin_name)."\n</body>", $body);
   		}
		return $body;
	}





	// body 페이지 처리, 해더 / 풋터 / 메뉴등 모든 프레임을 포함한 스킨으로 처리하여 리턴.
	function _skin_emptybody($skin_name){
		global $site_country, $site_language, $site_mobile;	

		if($site_mobile == "m"){
			$body = _skin_emptybody_m($skin_name);
		} else {
			$body = _skin_emptybody_pc($skin_name);
		}

		// {category} 처릭코드가 있는경우
   		if(preg_match("{category}", $body)){
   			$body = str_replace("{category}", _skin_category($skin_name)."\n</body>", $body);
   		}
   		
		return $body;
	}

	function _skin_emptybody_pc($skin_name){
		global $site_country, $site_language, $site_mobile;	

		// pc 접혹 할때만 레이아웃 저장 
		$body = _html_layout($skin_name);
		
		$_body  = _theme_header($skin_name)."\n";;
		$_body .= "<div class='menu' id='menu' style='z-index:100;'>"._theme_menu($skin_name)."</div>\n";
		$code_body = "<!--{skin_emptybody}-->";
		$_body .= "<div class='mainbody' id='mainbody'>".$code_body."</div>"."\n";
		$_body .= _theme_footer($skin_name)."\n";

		/*
		if($_SESSION['session_admin']){
			$__body = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
							<td width='150' valign='top' bgcolor='#ffffff'>admin</td>
							<td valign='top'>$_body</td>
						</tr>
					   </table>";
			$body = str_replace("</body>", $__body, $body);
		} else 
		*/

		$body = str_replace("</body>", $_body, $body);

		/*
		$body = str_replace("</body>", _theme_header($skin_name)."\n</body>", $body);
		$body = str_replace("</body>", "<div class='menu' id='menu' style='z-index:100;'>"._theme_menu($skin_name)."</div>\n</body>", $body);	

		// $code_body = _file_load("./skin/$skin_name/$html_code.ko.htm");
		$code_body = "<!--{skin_emptybody}-->";
		$body = str_replace("</body>", "<div class='mainbody' id='mainbody'>".$code_body."</div>"."\n</body>", $body);
		
		$body = str_replace("</body>", _theme_footer($skin_name)."\n</body>", $body);
		*/
		
   		
		return $body;
	}


	function _skin_emptybody_m($skin_name){
		global $site_country, $site_language, $site_mobile;	
		global $site_env;

		$body = _html_layout($skin_name);

		$title_header = json_decode($site_env->seo_title)->$site_language;
		if(!$title_header || $title_header == "") {
			if($site_env->code) $title_header = $site_env->code;
			else $title_header = $site_env->domain;
		}

		$code_body = "<!--{skin_emptybody}-->";
		$body = str_replace("</body>", "<div id=\"page\">
			<!-- Header Title-->
			<div class=\"header\"><a href=\"#menu\"></a>".$title_header."</div>
			"._theme_header($skin_name)."
			<div class=\"content\">
				<!-- mainbody -->
				<div class='mainbody' id='mainbody'>".$code_body."</div>
				<!-- footer -->
				"._theme_footer($skin_name)."
			</div>

			<nav id=\"menu\">"._theme_menu($skin_name)."</nav>

			</div>"."\n</body>", $body);
		
		return $body;
	}


	// 프레인을 포함하지 않은 스킨 페이지만 일어옴
	// 주로 AJAX 결과물 적용시 사용
	function _skin_page($skin_name,$html_code){
		global $site_country, $site_language, $site_mobile;	

		if($site_mobile == "m"){
			// 모든바일 페이지 읽어옴.
			if(_is_file("./skin/$skin_name/$html_code.ko.m.htm")){
				// 모바일용으로 읽어옴.
				$body = _file_load("./skin/$skin_name/$html_code.ko.m.htm");
			} else {
				// 모바일 스킨 페이지가 없을 경우, PC용으로 읽어옴
				$body = _file_load("./skin/$skin_name/$html_code.ko.htm");
			}
		} else {
			$body = _file_load("./skin/$skin_name/$html_code.ko.htm");
		}

		return "<article id=\"theme\" class=\"$html_code\">".$body."</article>";
	}








	// *************************************
	// 사이트 테마관련 함수
	// 테마폴더에 디자인 파일 있는 경우 우선 적용, 없는 경우 DB에서 읽어옴
	//

	// body 페이지 처리, 해더 / 풋터 / 메뉴등 모든 프레임을 포함한 스킨으로 처리하여 리턴.

	// body 페이지 처리, 해더 / 풋터 / 메뉴등 모든 프레임을 포함한 스킨으로 처리하여 리턴.

	function _theme_layout($theme,$mobile){
		if($mobile == "m"){
			$body = _skin_emptybody_m($skin_name);
		} else {
			$body = _skin_emptybody_pc($skin_name);
		}
	}



	

// index 테마 스킨을 읽어옴
// ++ index 테마파일 이름을 확인합니다. 
function _index_themeFileName($site_env){
    
    if($site_env->index_pages){
        // 사용자 지정파일명 
        return $site_env->index_pages;
    } else {
        // 기본 파일명
        return "index";
    }	
}


	// #####
	// 테마 페이지를 읽어, 리턴함
	// DB 속도개선을 위하여, 테마 html 페이지가 있으면 먼저 읽어 처리함. 파일이 없는경우 에는 _theme_page_db 로 읽어 처리함   
	function _theme_page($theme, $code, $lang, $mobile){
        
        //echo "테마=".$theme;
        //echo "코드=".$code;
        //echo "언어=".$lang;
        //echo "모바일=".$mobile;
        //exit;


		if($mobile == "m"){
			// 모바일 페이지로 처리함
			if(_is_file("./theme/$theme/$code.$lang.m.htm")){
				$body = _file_load("./theme/$theme/$code.$lang.m.htm");
			} else {
				// html 파일이 없는 경우, DB에서 자료를 읽어옴
				$body = _theme_page_db($theme,$code,$lang,$mobile);
			}

		} else {
			// PC용으로 페이지를 처리함
			if(_is_file("./theme/$theme/$code.$lang.htm")){
				$body = _file_load("./theme/$theme/$code.$lang.htm");
			} else {
				// html 파일이 없는 경우, DB에서 자료를 읽어옴
				$body = _theme_page_db($theme,$code,$lang,$mobile);
			}
		}
		

		$body = _theme_page_db($theme,$code,$lang,$mobile);
        return "<div id=\"theme\" class=\"$code\">".$body."</div>";

	}



	// DB에서 테마파일을 읽어옴니다.
	function _theme_page_db($theme,$code,$lang,$mobile){
		global $site_env;  // 사이트 환경설정값

		if( $rows = _site_themeFilesHtml($theme, $code, $lang, $mobile) ){	
			if($mobile == "m"){
				//++ 모바일 접속일 경우 스타일 처리 하지 않고 출력
				$div = "<div class=\"$code\" id=\"theme_pages\" ";

				//if($site_env->width) $style .= "width:".$site_env->width."px;";
				if($rows->bgcolor) $style .= "background-color:".$rows->bgcolor.";";

				if($style) $div .= "style=\"$style\" ";

				$div .= ">".stripslashes($rows->html)."</div>";		

				if($site_env->align == "center") $div = "<div align=\"center\">$div</div>";

				return $div;

			} else {
				// ++html 페이지 스타일을 조합합니다.
				if($rows->sub_menu){
					if($submenu = _site_themeFilesHtml($theme,"submenu",$lang,$mobile)){
						$submenu_body = stripslashes($submenu->html);
					} else {
						$submenu_body = "<!--{#side_menu}-->";
					}

					if($rows->sub_align == "left"){
						$div ="<table border=\"0\" width='".$site_env->width."' cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
								<td id=\"submenu\" width='".$rows->sub_width."' valign=top> $submenu_body </td>
								<td class=\"$code\" id=\"main-content\" bgcolor=".$rows->bgcolor."  valign=top> ".stripslashes($rows->html)." </td>
							</tr></table>";
					} else  if($rows->sub_align == "right"){
						$div ="<table border=\"0\" width='".$site_env->width."' cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
								<td class=\"$code\" id=\"main-content\" bgcolor=".$rows->bgcolor."  valign=top> ".stripslashes($rows->html)." </td>
								<td id=\"submenu\" width='".$rows->sub_width."' valign=top> $submenu_body </td>
							</tr></table>";
					}

					if($site_env->align == "center") $div = "<div align=\"center\">$div</div>";

					return $div;

				} else {

					$div = "<div class=\"$code\" id=\"theme_pages\" ";

					if($site_env->width) $style .= "width:".$site_env->width."px;";
					if($rows->bgcolor) $style .= "background-color:".$rows->bgcolor.";";

					if($style) $div .= "style=\"$style\" ";

					$div .= ">".stripslashes($rows->html)."</div>";		

					if($site_env->align == "center") $div = "<div align=\"center\">$div</div>";

					return $div;

				}

				/*
				
				*/
			}

		} else {
			return "$theme 테마목록 에서 $code 페이지를 읽어 올 수 없습니다. $lang / $mobile";
		}
	}



	// DB에서 테마파일을 팝업형태로 읽어옴니다.
	function _theme_popup($theme,$code,$lang,$mobile){

		if($rows = _site_themeFilesHtml($theme,$code,$lang,$mobile) ){	
			return stripslashes($rows->html);
		} else {
			return "<div id=\"error_massage\">$theme 테마목록 에서 $code 페이지를 읽어 올 수 없습니다. $lang / $mobile</div>";
		}
	}


	function _site_themeFilesHtml($theme,$code,$lang,$mobile){
		$query = "select * from site_themefiles_html WHERE `theme`='$theme' and `filename`='$code' ";
		if($lang) $query .= "and `language`='$lang' "; else $query .= "and `language`='ko' "; 
		if($mobile) $query .= "and `mobile`='$mobile' "; else $query .= "and `mobile`='pc' ";
		$query .= "order by regdate desc";

		if($rows = _mysqli_query_rows($query)){	
			return $rows;
		}	
	}


	


	// 상단/하단/메뉴플 포함한 테마 페이지를 읽어 옵니다.
	function _theme_body($theme, $code, $lang, $mobile){
		global $site_country, $site_language, $site_mobile;	

		$body = _skin_emptybody($skin_name);

		// 본문 내용을 스타일에서 삽입합니다.
		$code_body = _theme_page($theme,$code,$lang,$mobile);
		$body = str_replace("<!--{skin_emptybody}-->",$code_body,$body);
		

		// {category} 처릭코드가 있는경우
   		if(preg_match("{category}", $body)){
   			$body = str_replace("{category}", _skin_category($skin_name)."\n</body>", $body);
   		}
   		
		return $body;
	}



