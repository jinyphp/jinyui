<?php


	// ++ 도메인별 헤더정보를 읽어옵니다.
	function _env_header($domain){
		$query = "select * from site_header where domain = '$domain'";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		} else {
			$query = "select * from site_header ";
			if($rows = _mysqli_query_rows($query)){
				return $rows;
			} else {
				echo "Error! 헤더 환경설정(".$domain.")을 읽어올 수 없습니다.";
			}
		}		
	}


	// ++ 헤더 테마파일 이름을 확인합니다. 
	function _header_themeFileName($site_env){
		
		if($site_env->header_pages){
			// 사용자 지정파일명 
			return $site_env->header_pages;
		} else {
			// 기본 파일명
			return "header";
		}	
	}


	// ++ 테마 해더 HTML을 생성합니다.
	// 
	function _theme_header($theme_name){
		global $site_country, $site_language, $site_mobile;
		global $site_env;

		// 해더파일 이름
		$header_themeFileName = _header_themeFileName($site_env);

		// 데이터테이스에서 테마 html을 읽어옴
		if( $rows = _site_themeFilesHtml($site_env->theme, $header_themeFileName, $site_language, $site_mobile) ){	
			$body = stripslashes($rows->html);
		} else {
			return $header_themeFileName."(".$site_env->theme.") 스킨DB를 읽어 올 수 없습니다.";
		}

		// 해더테마  
		if($rows){

			// ++ 도메인 해더 환경설정
			$header_env = _env_header($_SERVER['HTTP_HOST']);

			// 치환처리 : 로고
			if(preg_match("{logo}", $body)){
				if($site_env->logo){
					if(_is_file($_SERVER['DOCUMENT_ROOT']."/images/".$site_env->logo)){
						$logo_url = "/images/".$site_env->logo;
						$logo_file = "<a href=\"/\"><img src='$logo_url' style=\"max-width:100%;height:auto;\"  border=0></a>";
						$body = str_replace("{logo}","<div id=\"header_logo\">".$logo_file."</div>",$body);
					} else {
						$body = str_replace("{logo}","<div id=\"header_logo\"><a href=\"/\">로고파일 없음</a></div>",$body);
					}
				} else {
					$body = str_replace("{logo}","",$body);
				}
			}
	
			// 치환처리 : 로그인 버튼 
			if(preg_match("{login}", $body)){
				if(isset($_COOKIE['cookie_email'])){
					// 로그인 상태
					$body = str_replace("{login}","<span id=\"header_login\">"._theme_header_login($header_env)."</span>",$body);
				} else {
					// 비로그인 상태 
					$body = str_replace("{login}","<span id=\"header_login\">"._theme_header_logout($header_env)."</span>",$body);
				}
			}

			// 치환처리 : 회원가입 
			if(preg_match("{member}", $body)){
				if(isset($_COOKIE['cookie_email'])){	
					$body = str_replace("{member}","<span id=\"header_member\">"._theme_header_members($header_env)."</span>",$body);
				} else {
					$body = str_replace("{member}","<span id=\"header_member\">"._theme_header_myinfo($header_env)."</span>",$body);
				}
			}

			// 치환처리 : 장바구니 
			if(preg_match("{cart}", $body)){
				$body = str_replace("{cart}","<span id=\"header_cart\">"._theme_header_cart($header_env)."</span>",$body);
			}

			// 치환처리 : 관심상품
			if(preg_match("{wish}", $body)){
				$body = str_replace("{wish}","<span id=\"header_wish\">"._theme_header_wish($header_env)."</span>",$body);
			}

			// 치환처리 : 주문목록
			if(preg_match("{order}", $body)){
				$body = str_replace("{order}","<span id=\"header_order\">"._theme_header_orderlist($header_env)."</span>",$body);
			}

			// 치환처리 : 국가선택
			if(preg_match("{country_bar}", $body)){
				$body = str_replace("{country_bar}","<span id=\"header_countrybar\">"._country_bar($site_country,$site_language)."</span>",$body);
			}

			// 치환처리 : 언어 링크
			if(preg_match("{language_bar}", $body)){
				$body = str_replace("{language_bar}","<span id=\"header_languagebar\">"._language_bar($site_language)."</span>",$body);
			}

			// 치환처리 : 메인서치 
			if(preg_match("{main_search}", $body)){
				$body = str_replace("{main_search}","<div id=\"header_search\">"._theme_header_search($site_language)."</div>",$body);
			}

			// 치환처리 : 모바일/PC 접속 스위치
			if(preg_match("{mobile}", $body)){
				if($site_mobile == "m") {
					$mobile_name = json_decode( $header_env->mobilepc )->$site_language;
					$url = "/index.php?mobile=pc";
				} else {
					$mobile_name = json_decode( $header_env->mobile )->$site_language;
					$url = "/index.php?mobile=m";
				}
				
				$order_link = "<a href='$url'>$mobile_name</a>";
				$body = str_replace("{mobile}","<span id=\"header_device\">".$order_link."</span>",$body);
			}

			// ++ adsense 광고처리
			$keyword = "adsense_";
			if($keyword_count = _keyword_count($body, "{".$keyword)){
				
				$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
				
				for($i=0;$i<count($rows);$i++){					
					$query = "select * from site_adsense where adsense ='".$rows[$i]."'";
					if($adsense_rows = _mysqli_query_rows($query)){
						$adsense_source = stripslashes($adsense_rows->source);
						$body = str_replace("{adsense_".$rows[$i]."}","<span id=\"adsense\">".$adsense_source."</span>",$body);
					}	
				}				

			}
			

			// 헤더 레이아웃 적용
			$header_body = "<div id=\"header_body\" ";
			if($site_mobile == "m"){
				// 모바일 경우 width 값은 적용하지 않음.
			} else {
				// pc접속일 경우 
				if($site_env->width) $style .= "width:".$site_env->width.";";
			
			}

			if($rows->bgcolor) $style .= "background-color:".$rows->bgcolor.";";

			if($style) $header_body .= "style=\"$style\" ";

			$header_body .= ">".$body."</div>";		

			if($site_env->align == "center") $header_body = "<div align=\"center\">$header_body</div>";

			// 해더를 리턴함.
			return "<header id=\"header\" class=\"".$site_env->theme."\">
						".$header_body."
					</header>";

		}

	}	


	function _theme_header_login($header_env){
		global $site_language;
		$email = $_COOKIE['cookie_email'];

		$login_name = "$email ".json_decode( $header_env->logout )->$site_language;
					
		if($header_env->logout_url) $login_link = "<a href='/".$header_env->logout_url."'>$login_name</a>";
		else $login_link = "<a href='/logout.php'>$login_name</a>";
		
		return $login_link;
	}

	function _theme_header_logout($header_env){
		global $site_language;
		
		$login_name = json_decode( $header_env->login )->$site_language;

		if($header_env->login_url) $login_link = "<a href='/".$header_env->login_url."'>$login_name</a>";
		else $login_link = "<a href='/login.php'>$login_name</a>";
		
		return $login_link;
	}

	function _theme_header_members($header_env){
		global $site_language;
		
		$member_name = json_decode( $header_env->myinfo )->$site_language;
					
		if($header_env->myinfo_url) $member_link = "<a href='/".$header_env->myinfo_url."'>$member_name</a>";
		else $member_link = "<a href='/myinfo.php'>$member_name</a>";
		
		return $member_link;
	}

	function _theme_header_myinfo($header_env){
		global $site_language;
		
		$member_name = json_decode( $header_env->member )->$site_language;

		if($header_env->member_url) $member_link = "<a href='/".$header_env->member_url."'>$member_name</a>";
		else $member_link = "<a href='/member.php'>$member_name</a>";
		
		return $member_link;
	}

	function _theme_header_cart($header_env){
		global $site_language;
		
		$cart_name = json_decode( $header_env->cart )->$site_language;
		if($header_env->cart_url) $cart_link = "<a href='/".$header_env->cart_url."'>$cart_name</a>";
		else $cart_link = "<a href='/cart.php'>$cart_name</a>";
		
		return $cart_link;
	}

	function _theme_header_wish($header_env){
		global $site_language;
		
		$wish_name = json_decode( $header_env->wish )->$site_language;

		if($header_env->wish_url) $wish_link = "<a href='/".$header_env->wish_url."'>$wish_name</a>";
		else $wish_link = "<a href='/wish.php'>$wish_name</a>";
		
		return $wish_link;
	}

	function _theme_header_orderlist($header_env){
		global $site_language;
		
		$order_name = json_decode( $header_env->orderlist )->$site_language;

		if($header_env->orderlist_url) $order_link = "<a href='/".$header_env->orderlist_url."'>$order_name</a>";
		else $order_link = "<a href='/orderlist.php'>$order_name</a>";
		
		return $order_link;
	}

	function _theme_header_search($header_env){

		$search_form = "<div id=\"main_search_box\" class=\"clearfix\">
				<form id='main_search' name='search' method='post' enctype='multipart/form-data' >
					<input type='text' name='main_search' id=\"main_search_value\">
					<input type='button' value='검색' id=\"main_search_btn\">
				</form>
			</div>";

		return $search_form;
	}


?>