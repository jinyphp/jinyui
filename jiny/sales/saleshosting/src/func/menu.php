<?php

	// ++ 현재 상태의 메뉴코드
	$_current_menuCode = _menu_code();

	// ++ 현재 접속 도메인 , site_env 값 분석 
	function _menu_code(){
		global $site_env;

		//로그인 전 / 후 메뉴값을 분라해서 운영 가능.
		if(isset($_COOKIE['cookie_email'])){
			// 만일 로그인후 , 메뉴값이 없는 경우
			// 로그인 전 메뉴와 동일 
			if($site_env->menu_code_login){
				$menu_code = $site_env->menu_code_login;
			} else {
				// 기본 메뉴값이 없는 경우, default로 처리
				if($site_env->menu_code){
					$menu_code = $site_env->menu_code;
				} else $menu_code = "default";
			}
		} else {
			// 기본 메뉴값이 없는 경우, default로 처리
			if($site_env->menu_code){
				$menu_code = $site_env->menu_code;
			} else $menu_code = "default";
		}
		return $menu_code;
	}

	// 메튜 트리 읽어옴.
	function _theme_menu($skin_name){
		global $site_country, $site_language, $site_mobile;
		global $site_env;

		global $header_env;
		
		$menu_code = _menu_code();		
	
		// 메뉴 스킨
		$theme_skinfile = "./theme/menu_".$menu_code.".html";
		if(_is_file($theme_skinfile)){
			$body = _file_load($theme_skinfile);
		} else {
			// 
			$body = _theme_page_db($site_env->theme, "menu_".$menu_code, $site_language, $site_mobile);
			if($body) $body = str_replace("theme_pages","menu_body",$body);
			else $body = "{menu}";
		}

		if($site_mobile == "m"){
			// 모바일 접속시 메뉴 데이터 
			$body = _menu($menu_code,$site_language);
		} else {	
			// pc용 접속시 스킨을 적용
			$menubar = _menu($menu_code,$site_language);
			$body = str_replace("{menu}","".$menubar."",$body);


			/*
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
			*/





		}	
	
		return $body;
	}


	// ++ 메뉴 
	function _menu($menu_code,$site_language){
		// 테이터 파일 캐싱 체크...
		$filename = "./menu/$menu_code/$menu_code.".$site_language.".htm";
		if(_is_file($filename)){
			$body = "<div id='cssmenu'>"._file_load($filename)."</div>";
		} else {
			$body = "<div id='cssmenu'>"._menu_db($menu_code,$site_language)."</div>\n";
		}

		$body = "<form name='menu' method='post' enctype='multipart/form-data'>
					<input type='hidden' name='menu_mode'>
					<input type='hidden' name='menu_value'>".$body."</form>";

		return $body; 
	}

	// ++ 메뉴트리(DB)를 생성.
	function _menu_db($menu_code,$site_language){
		
		// 데이터베이스 내용을 기반으로, 메뉴 html 파일 생성
		$query = "select * from `site_menu` where enable = 'on' and code = '".$menu_code."' order by pos desc";
		if($rowss = _mysqli_query_rowss($query)){

			$menubar .= "<ul>\n";
			
			for($i=0,$level=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];	
				
				// 상위 level로 탈출할때, /li /ul
				if($rows->level < $level) {
					$menubar .= "</li>\n</ul>\n</li>\n";
					for($j=$rows->level;$j<($level-1);$j++) $menubar .= "</li>\n</ul>\n</li>\n";
				} 

				// 하부 메뉴 구조가 있는지 검사.
				$query1 = "select * from `site_menu` where enable = 'on' and ref = '".$rows->Id."' and pos < '".$rows->pos."'";
				if(_mysqli_query_rows($query1)) $hassub = true; else $hassub = false;

				// 서브메뉴가 있는 구조
				if($hassub) $menubar .= "<li class='has-sub'>"; else $menubar .= "<li>";	
				$menubar .= "<a href='"._menu_url($rows)."'>"._menu_nameString($rows->title,$site_language)."</a>"; 				
				// $menubar .= "<a "._menu_onclick($rows).">"._menu_nameString($rows->title,$site_language)."</a>";

				if($hassub) $menubar .= "<ul>"; 
				else {
					if($rows->level == $level) $menubar .= "</li>";
				}	

				$level = $rows->level;
			}
			
			if($level>0){
				$menubar .= "</li>\n</ul>\n</li>\n";
				for($j=0;$j<($level-1);$j++) $menubar .= "</li>\n</ul>\n</li>\n";
			} else $menubar .= "</li>";

			$menubar .= "</ul>\n";

			return $menubar;
		
		} else {
			return "메뉴구조가 없습니다.";
		}
		
	}






	// 서브메뉴 ID기준 서브메뉴 Tree를 출력합니다.
	function _submenu($menu_code,$site_language,$mid){
		// ++ url 정보로, 선택 메뉴 읽기
		$query = "select * from `site_menu` where Id = '".$mid."' order by pos desc";
		//echo $query."<br>";
		if($subrows = _mysqli_query_rows($query)){
			// ++ 선택한 메뉴 타이틀을 출력 
			$menubar = "<div id=\"submenu_title\"><a href='"._menu_url($rows)."'>"._menu_nameString($subrows->title,$site_language)."</a></div>"; 
			
			$menubar .= "<div id=\"submenu_tree\">";
			// 서브 메뉴를 출력함
			$query = "select * from `site_menu` where enable = 'on' and code = '$menu_code' and tree like '%>".$mid.";%' and pos < ".$subrows->pos." order by pos desc";
			//echo $query."<br>";
			if($rowss = _mysqli_query_rowss($query)){
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];

					for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;"; 
					switch($rows->level){
						case "2":
							$space .= "<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>";
							break;

						case "1":
							$space .= "<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>";
							break;

						case "0":
							$space .= "<i class=\"fa fa fa-chevron-right\" aria-hidden=\"true\"></i>";
							break;

						default:
							$space .= "&nbsp;&nbsp;"; 
					}
					 
					// if($rows->hassub) $hassub = " class=\"hassub\" "; else $hassub = "";
					$menubar .= "<div id=\"submenu_items".$rows->level."\">".$space."&nbsp;<a href='"._menu_url($rows)."'>"._menu_nameString($rows->title,$site_language)."</a></div>";
				}
				 
			}

			$menubar .= "</div";

			return $menubar;
		}

	}

	// 메뉴이름 json 처리 
	function _menu_nameString($json,$lang){
		$title = json_decode(stripslashes($json));
		if($title->$lang) 
			return $title->$lang; 
		else 
			return $title->ko;
	}

	function _menu_url($rows){
		switch($rows->urlmode){
			case 'category':
				if($rows->url) $url = "/goodlist.php?cate=".$rows->url; else $url = "#";
				break;
			
			case 'pages':
				if($rows->url) $url = "/pages.php?code=".$rows->url; else $url = "#";
				break;
			
			case 'board':
				if($rows->url) $url = "/board.php?board=".$rows->url; else $url = "#";
				break;	
			
			default:
				if($rows->url) $url = $rows->url; else $url = "#";
				break;
		}
		return $url;
	}

	function _menu_onclick($rows){
		switch($rows->urlmode){
			case 'category':
				if($rows->url) $onclick = "onclick=\"javascript:menu_url('/goodlist.php','cate','".$rows->url."')\""; 
					// $onclick = "/goodlist.php?cate=".$rows->url; else $onclick = "#";
				break;
			
			case 'pages':
				if($rows->url) $onclick = "onclick=\"javascript:menu_url('/pages.php','code','".$rows->url."')\""; 
					// $onclick = "/pages.php?code=".$rows->url; else $onclick = "#";
				break;
			
			case 'board':
				if($rows->url) $onclick = "onclick=\"javascript:menu_url('/board.php','board','".$rows->url."')\""; 
					// $onclick = "/board.php?board=".$rows->url; else $onclick = "#";
				break;	
			
			default:
				if($rows->url) $onclick = "onclick=\"javascript:url_replace('".$rows->url."')\"";
					// $onclick = $rows->url; else $onclick = "#";
				break;
		}
		return $onclick;
	}


	function _menu_subtree($menu_code,$site_language,$url){

		// ++ url 정보로, 선택 메뉴 읽기
		$query = "select * from `site_menu` where enable = 'on' and code = '".$menu_code."' and url = '".$url."' order by pos desc";
		//echo $query."<br>";
		if($subrows = _mysqli_query_rows($query)){

			$menuname = json_decode(stripslashes($subrows->title));
			if($menuname->$site_language) $menuname_lang = $menuname->$site_language; else $menuname_lang = $menuname->ko;
			$menubar = "<div id=\"submenu_title\"><a href='"._menu_url($rows)."'>".$menuname_lang."</a></div>"; 

			// and pos > ".$subrows->pos."
			$tree = explode(">",$subrows->tree);
			$query = "select * from `site_menu` where enable = 'on' and code = '".$menu_code."' and tree like '%>".$tree[1]."%'  order by pos desc";
			//echo $query."<br>";
			if($rowss = _mysqli_query_rowss($query)){
			
			
				$menubar .= "<div id=\"submenu_tree\"><ul>\n";
			
				for($i=0,$level=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];	

					// for($j=0,$space="";$j<$rows->level;$j++) $space .= "___"; 
				
					// 상위 level로 탈출할때, /li /ul
					if($rows->level < $level) {
						$menubar .= "</li>\n</ul>\n</li>\n";
						for($j=$rows->level;$j<($level-1);$j++) $menubar .= "</li>\n</ul>\n</li>\n";
					} 

					// 하부 메뉴 구조가 있는지 검사.
					$query1 = "select * from `site_menu` where ref = '".$rows->Id."' and pos < '".$rows->pos."'";
					if(_mysqli_query_rows($query1)) $hassub = true; else $hassub = false;

					// 서브메뉴가 있는 구조
					if($hassub) $menubar .= "<li class='has-sub'>"; else $menubar .= "<li>";	

					
					$menubar .= "<a href='"._menu_url($rows)."'>"._menu_nameString($rows->title,$site_language)."</a>"; 

					if($hassub) $menubar .= "<ul>"; 
					else {
						if($rows->level == $level) $menubar .= "</li>";
					}	

					$level = $rows->level;
				}
			
				if($level>0){
					$menubar .= "</li>\n</ul>\n</li>\n";
					for($j=0;$j<($level-1);$j++) $menubar .= "</li>\n</ul>\n</li>\n";
				} else $menubar .= "</li>";

				$menubar .= "</ul>\n</div>";
				
			}

			return $menubar;


		}	

	}


	// ++ URI 기준으로 Level 0 menuId 값을 리턴
	function _submenuId_byurl($REQUEST_URI){
		global $_current_menuCode;
		//echo $REQUEST_URI."<br>";

		$query = "select * from `site_menu` where enable = 'on' and code = '".$_current_menuCode."' and url like '".$REQUEST_URI."' order by pos desc";
		//echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			if($rows->level == 0) {
				//echo "submenu is = ".$rows->Id;
				return $rows->Id;
			} else {
				$tree = explode(">",$rows->tree);
				//echo "tree = ".$rows->tree;
				$id = str_replace(";", "", $tree[1]);
				//echo "submenu is = ".$id;
				return $id;
			}
		}
	}



	


	











	//
	//
	// DB로 부터 메뉴 CSS를 읽어옴.
	//
	function _menu_css_db($skin_name){
		global $site_country, $site_language, $site_mobile;

		$query = "select * from `site_menu_setting`";
		// echo $query."<br>";	
		$rows = _mysqli_query_rows($query);

		
		
		
		// 
		if($rows->menu_color) $menu_color = $rows->menu_color; else $menu_color = "#ffffff"; // #141414

		if($rows->menu_border_bgcolor) $menu_border_bgcolor = $rows->menu_border_bgcolor; else $menu_border_bgcolor = "#474747"; // #333333
		if($rows->menu_border_bottom) $menu_border_bottom = $rows->menu_border_bottom; else $menu_border_bottom = "#0fa1e0"; // #0fa1e0
		
		if($rows->menu_radius) $menu_radius = $rows->menu_radius."px"; else $menu_radius = "0px"; // #0fa1e0

		// 메뉴바 선택시 배경색
		if($rows->menu_font_bgcolor) $menu_font_bgcolor = $rows->menu_font_bgcolor; else $menu_font_bgcolor = "#474747"; // #141414
		
		if($rows->menu_fontsize) $menu_fontsize = $rows->menu_fontsize; else $menu_fontsize = "12px"; // #141414

		if($rows->menu1_font_bgcolor) $menu1_font_bgcolor = $rows->menu1_font_bgcolor; else $menu1_font_bgcolor = "#31b7f1"; // #141414
		if($rows->menu1_color) $menu1_color = $rows->menu1_color; else $menu1_color = "#ffffff"; // #141414
		if($rows->menu1_font_bgcolor1) $menu1_font_bgcolor1 = $rows->menu1_font_bgcolor1; else $menu1_font_bgcolor1 = "#31b7f1"; // #141414
		if($rows->menu1_color1) $menu1_color1 = $rows->menu1_color1; else $menu1_color1 = "#ffffff"; // #141414

		// 메뉴바 선택시 배경색
		if($rows->menu_font_bgcolor1) $menu_font_bgcolor1 = $rows->menu_font_bgcolor1; else $menu_font_bgcolor1 = "#474747"; // #141414
		if($rows->menu_color1) $menu_color1 = $rows->menu_color1; else $menu_color1 = "#ffffff"; // #141414


		$style1  = "@import url(http://fonts.googleapis.com/css?family=Open+Sans);";
		$style1 .= "#cssmenu,
					#cssmenu ul,
					#cssmenu ul li,
					#cssmenu ul li a,
					#cssmenu #menu-button {
						margin: 0;
						padding: 0;
						border: 0;
						list-style: none;
						line-height: 1;
						display: block;
						position: relative;
                        -webkit-box-sizing: border-box;
	                    -moz-box-sizing: border-box;
						box-sizing: border-box;
						z-index: 100;
					}";

		$style1 .= "#cssmenu:after,
					#cssmenu > ul:after {
						content: \".\";
						display: block;
						clear: both;
						visibility: hidden;
						line-height: 0;
						height: 0;
					}";

		$style1 .= "#cssmenu #menu-button {
						display: none;
					}";

		// 메뉴 배셩색
		// 메뉴바 배경색
		if($rows->bgcolor) $bgcolor = "#".$rows->bgcolor; else $bgcolor = "#6d6d6d"; // #141414
		$style1 .= "#cssmenu {
						width: auto;
						font-family: 'Open Sans', sans-serif;
						line-height: 1;
						background: $bgcolor;
					}";


		if($rows->menu1_mark){
			// 1차메뉴 호버시, 밑줄표시
			if($rows->menu1_markcolor) $menu1_markcolor = "#".$rows->menu1_markcolor; else $menu1_markcolor = "#009ae1"; // #141414
			$style1 .= "#menu-line {
						position: absolute;
						top: 0;
						left: 0;
						height: 3px;
						background: $menu1_markcolor;
						  -webkit-transition: all 0.25s ease-out;
						  -moz-transition: all 0.25s ease-out;
						  -ms-transition: all 0.25s ease-out;
						  -o-transition: all 0.25s ease-out;
						transition: all 0.25s ease-out;
					}";
		}
		


		$style1 .= "#cssmenu > ul > li {
					  float: left;
					}";

		$style1 .= "#cssmenu.align-center > ul {
						  font-size: 0;
					  text-align: center;
					}";

		$style1 .= "#cssmenu.align-center > ul > li {
					  display: inline-block;
					  float: none;
					}";

		$style1 .= "#cssmenu.align-center ul ul {
						  text-align: left;
					}";

		$style1 .= "#cssmenu.align-right > ul > li {
						  float: right;
					}";
		
		$style1 .= "#cssmenu.align-right ul ul {
						  text-align: right;
					}";

		// *******
		// 1차 메뉴 

		// 1차메뉴 : 메뉴글자 색상
		// 메뉴1차: 마우스 호버시 글자색
		if($rows->menu1_fontcolor) $menu1_fontcolor = "#".$rows->menu1_fontcolor; else $menu1_fontcolor = "#ffffff";
		$menu_padding = "15px";	// 메뉴 페팅값으로, 메뉴 옾이 및 크기 지정
		$style1 .= "#cssmenu > ul > li > a {
						  padding: $menu_padding;
						  font-size: 12px;
						  text-decoration: none;
						  text-transform: uppercase;
						  color: $menu1_fontcolor;
						  -webkit-transition: color .2s ease;
						  -moz-transition: color .2s ease;
						  -ms-transition: color .2s ease;
						  -o-transition: color .2s ease;						
						  transition: color .2s ease;
						}";


		// 메뉴1차: 마우스 호버시 글자색
		if($rows->menu1_fontcolor_hover) $menu1_fontcolor_hover = "#".$rows->menu1_fontcolor_hover; else $menu1_fontcolor_hover = "#f09ae1";

		// 메뉴1차: 마우스 호버시 선택배경색
		if($rows->menu1_bgcolor_hover) $menu1_bgcolor_hover = "#".$rows->menu1_bgcolor_hover; else $menu1_bgcolor_hover = "#000000";
		$style1 .= "#cssmenu > ul > li:hover > a,
					#cssmenu > ul > li.active > a {
  						color: $menu1_fontcolor_hover ;	
  						background: $menu1_bgcolor_hover;
					}";


		$style1 .= "#cssmenu > ul > li.has-sub > a {
					padding-right: 25px;
					}";


		// 메뉴1차 : 상단 메뉴옆 화살표 색상
		// 000000
		$style1 .= "#cssmenu > ul > li.has-sub > a::after {
  						position: absolute;
  						top: 21px;
  						right: 10px;
  						width: 4px;
  						height: 4px;
  						border-bottom: 1px solid $menu1_fontcolor;
  						border-right: 1px solid $menu1_fontcolor;
						content: '';
						-webkit-transform: rotate(45deg);
						-moz-transform: rotate(45deg);
						-ms-transform: rotate(45deg);
						-o-transform: rotate(45deg);
						transform: rotate(45deg);
						-webkit-transition: border-color 0.2s ease;
						-moz-transition: border-color 0.2s ease;
						-ms-transition: border-color 0.2s ease;
						-o-transition: border-color 0.2s ease;
						transition: border-color 0.2s ease;
					}";

		// 메뉴1차 : 상단 메뉴옆 화살표 마우스 호버시 색상
		// #009ae1
		$style1 .= "#cssmenu > ul > li.has-sub:hover > a::after {
						border-color: $menu1_fontcolor_hover;
					}";

		$style1 .= "#cssmenu ul ul {
  						position: absolute;
  						left: -9999px;
					}";

		$style1 .= "#cssmenu li:hover > ul {
  						left: auto;
					}";

		$style1 .= "#cssmenu.align-right li:hover > ul {
						right: 0;
					}";

		$style1 .= "#cssmenu ul ul ul {
						margin-left: 100%;
						top: 0;
					}";

		
		$style1 .= "#cssmenu.align-right ul ul ul {
  						margin-left: 0;
  						margin-right: 100%;
					}";

		$style1 .= "#cssmenu ul ul li {
						height: 0;
						-webkit-transition: height .2s ease;
						-moz-transition: height .2s ease;
						-ms-transition: height .2s ease;
						-o-transition: height .2s ease;
						transition: height .2s ease;
					}";

		$style1 .= "#cssmenu ul li:hover > ul > li {
  							height: 32px;
					}";


		// ******
		// 2차메뉴 

		// 메뉴2차: 드롭다운메뉴 배경색
		if($rows->menu2_bgcolor) $menu2_bgcolor = "#".$rows->menu2_bgcolor; else $menu2_bgcolor = "#333333";

		// 메뉴2차: 드롭다운메뉴 글자색
		if($rows->menu2_fontcolor) $menu2_fontcolor = "#".$rows->menu2_fontcolor; else $menu2_fontcolor = "#dddddd";

		$style1 .= "#cssmenu ul ul li a {
						padding: 10px 20px;
						width: 160px;
						font-size: 12px;
						background: $menu2_bgcolor;
  						text-decoration: none;
						color: $menu2_fontcolor;
						-webkit-transition: color .2s ease;
						-moz-transition: color .2s ease;
						-ms-transition: color .2s ease;
						-o-transition: color .2s ease;
						transition: color .2s ease;
					}";

		// 메뉴2차: 드롭다운메뉴 선택시 호버 글자색
		if($rows->menu2_fontcolor_hover) $menu2_fontcolor_hover = "#".$rows->menu2_fontcolor_hover; else $menu2_fontcolor_hover = "#dddddd";

		// 메뉴2차: 드롭다운메뉴 선택시 호버 선택배경색
		if($rows->menu2_bgcolor_hover) $menu2_bgcolor_hover = "#".$rows->menu2_bgcolor_hover; else $menu2_bgcolor_hover = "#000000";

		$style1 .= "#cssmenu ul ul li:hover > a,
					#cssmenu ul ul li a:hover {
						color: $menu2_fontcolor_hover;
						background: $menu2_bgcolor_hover;
					}";

		// 메뉴2차 : 메뉴옆 화살표 색상
		$style1 .= "#cssmenu ul ul li.has-sub > a::after {
						position: absolute;
						top: 13px;
						right: 10px;
						width: 4px;
						height: 4px;
						border-bottom: 1px solid $menu2_fontcolor;
						border-right: 1px solid $menu2_fontcolor;
						content: '';
						-webkit-transform: rotate(-45deg);
						-moz-transform: rotate(-45deg);
						-ms-transform: rotate(-45deg);
						-o-transform: rotate(-45deg);
						transform: rotate(-45deg);
						-webkit-transition: border-color 0.2s ease;
						-moz-transition: border-color 0.2s ease;
						-ms-transition: border-color 0.2s ease;
						-o-transition: border-color 0.2s ease;
						transition: border-color 0.2s ease;
					}";

		// 메뉴2차 : 메뉴옆 화살표 마우스 호버시 색상
		$style1 .= "#cssmenu.align-right ul ul li.has-sub > a::after {
						right: auto;
						left: 10px;
						border-bottom: 0;
						border-right: 0;
						border-top: 1px solid $menu2_fontcolor_hover;
						border-left: 1px solid $menu2_fontcolor_hover;
					}";

		$style1 .= "#cssmenu ul ul li.has-sub:hover > a::after {
						border-color: #ffffff;
					}";


		// ******
		// 3차메뉴 

		// 메뉴3차: 드롭다운메뉴 배경색
		if($rows->menu3_bgcolor) $menu3_bgcolor = "#".$rows->menu3_bgcolor; else $menu3_bgcolor = "#333333";

		// 메뉴3차: 드롭다운메뉴 글자색
		if($rows->menu3_fontcolor) $menu3_fontcolor = "#".$rows->menu3_fontcolor; else $menu3_fontcolor = "#dddddd";

		$style1 .= "#cssmenu ul ul ul li a {
						padding: 10px 20px;
						width: 160px;
						font-size: 12px;
						background: $menu3_bgcolor;
  						text-decoration: none;
						color: $menu3_fontcolor;
						-webkit-transition: color .2s ease;
						-moz-transition: color .2s ease;
						-ms-transition: color .2s ease;
						-o-transition: color .2s ease;
						transition: color .2s ease;
					}";


		// 메뉴3차: 드롭다운메뉴 선택시 호버 글자색
		if($rows->menu3_fontcolor_hover) $menu3_fontcolor_hover = "#".$rows->menu3_fontcolor_hover; else $menu3_fontcolor_hover = "#dddddd";

		// 메뉴3차: 드롭다운메뉴 선택시 호버 선택배경색
		if($rows->menu3_bgcolor_hover) $menu3_bgcolor_hover = "#".$rows->menu3_bgcolor_hover; else $menu3_bgcolor_hover = "#000000";

		$style1 .= "#cssmenu ul ul ul li:hover > a,
					#cssmenu ul ul ul li a:hover {
						color: $menu3_fontcolor_hover;
						background: $menu3_bgcolor_hover;
					}";





		






				
		$style1_mobile = "@media all and (max-width: 768px), 
				only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: 1024px), 
				only screen and (min--moz-device-pixel-ratio: 2) and (max-width: 1024px), 
				only screen and (-o-min-device-pixel-ratio: 2/1) and (max-width: 1024px), 
				only screen and (min-device-pixel-ratio: 2) and (max-width: 1024px), 
				only screen and (min-resolution: 192dpi) and (max-width: 1024px), 
				only screen and (min-resolution: 2dppx) and (max-width: 1024px) {
					
					#cssmenu {
						width: 100%;
					}

					#cssmenu ul {
						width: 100%;
						display: none;
					}

					#cssmenu.align-center > ul,
					#cssmenu.align-right ul ul {
    					text-align: left;
					}

  					#cssmenu ul li,
					#cssmenu ul ul li,
					#cssmenu ul li:hover > ul > li {
    					width: 100%;
    					height: auto;
    					border-top: 1px solid rgba(120, 120, 120, 0.15);
					}

					#cssmenu ul li a,
					#cssmenu ul ul li a {
						width: 100%;
					}

					#cssmenu > ul > li,
					#cssmenu.align-center > ul > li,
					#cssmenu.align-right > ul > li {
    					float: none;
    					display: block;
					}

					#cssmenu ul ul li a {
    					padding: 20px 20px 20px 30px;
    					font-size: 12px;
    					color: #000000;
    					background: none;
					}

					#cssmenu ul ul li:hover > a,
					#cssmenu ul ul li a:hover {
    					color: #000000;
					}

					#cssmenu ul ul ul li a {
    					padding-left: 40px;
					}

					#cssmenu ul ul,
					#cssmenu ul ul ul {
						position: relative;
    					left: 0;
    					right: auto;
    					width: 100%;
    					margin: 0;
					}

					#cssmenu > ul > li.has-sub > a::after,
					#cssmenu ul ul li.has-sub > a::after {
						display: none;
					}

					#menu-line {
						display: none;
					}

					#cssmenu #menu-button {
    					display: block;
    					padding: 20px;
    					color: #000000;
    					cursor: pointer;
    					font-size: 12px;
    					text-transform: uppercase;
  					}
  
  					#cssmenu #menu-button::after {
    					content: '';
    					position: absolute;
    					top: 20px;
    					right: 20px;
    					display: block;
    					width: 15px;
    					height: 2px;
    					background: #000000;
  					}

  					#cssmenu #menu-button::before {
    					content: '';
    					position: absolute;
    					top: 25px;
    					right: 20px;
    					display: block;
    					width: 15px;
    					height: 3px;
    					border-top: 2px solid #000000;
    					border-bottom: 2px solid #000000;
  					}

  					#cssmenu .submenu-button {
    					position: absolute;
    					z-index: 100;
    					right: 0;
    					top: 0;
    					display: block;
    					border-left: 1px solid rgba(120, 120, 120, 0.15);
    					height: 52px;
    					width: 52px;
    					cursor: pointer;
  					}

  					#cssmenu .submenu-button::after {
    					content: '';
    					position: absolute;
    					top: 21px;
    					left: 26px;
    					display: block;
    					width: 1px;
    					height: 11px;
    					background: #000000;
    					z-index: 990;
  					}

  					#cssmenu .submenu-button::before {
    					content: '';
    					position: absolute;
    					left: 21px;
    					top: 26px;
    					display: block;
    					width: 11px;
    					height: 1px;
    					background: #000000;
    					z-index: 990;
  					}

  					#cssmenu .submenu-button.submenu-opened:after {
    					display: none;
  					}

				}";
			

		$CSS_STYLE = "<style>";
		// if($site_mobile == "m") $CSS_STYLE .= $style1_mobile; else 
		$CSS_STYLE .= $style1;
		$CSS_STYLE .= "</style>";

		return $CSS_STYLE;
	}	



?>