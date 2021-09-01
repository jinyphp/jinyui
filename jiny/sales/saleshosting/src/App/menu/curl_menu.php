<?
	// ============== 
	// CURL Pages 처리
	// 2016.03.25

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/conf/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");

	echo "<br>SALESHosting API<br>";

	

	if($adminkey = _formdata("adminkey")){
		$query = "select * from `site_env`";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
			if($rows->adminkey == $adminkey){

				// ====== CURL 접속 체크 성공 ======

				$mode = _formdata("mode");
				echo "curl mode: $mode<br>";

				$menu_code = _formdata("menu_code");

				if($mode == "save"){
					// DB에 있는 메뉴 구조를 파일로 케싱 저장함.

					// 데이터베이스 내용을 기반으로, 메뉴 html 파일 생성
					$query = "select * from site_menu where enable = 'on' and code = '".$menu_code."' order by pos desc";
					echo $query."<br>";
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
							// 서브메뉴가 있는 구조
							$hassub = _menu_hassub($rows->Id, $rows->pos);
							if($hassub) $menubar .= "<li class='has-sub'>"; else $menubar .= "<li>\n";	

							$url = _menu_url($rows->urlmode,$rows->url);
							
							$menuname = json_decode(stripslashes($rows->title));
							$site_language = "ko";
							if($menuname->$site_language) $menuname_lang = $menuname->$site_language; else $menuname_lang = $menuname->ko;
							$menubar .= "<a href='".$url."'>".$menuname_lang."</a>"; 

							if($hassub) {
								$menubar .= "<ul>\n"; 
							} else {
								if($rows->level == $level) $menubar .= "</li>\n";
							}	

							$level = $rows->level;
						}
			
						if($level>0){
							$menubar .= "</li>\n</ul>\n</li>\n";
							for($j=0;$j<($level-1);$j++) $menubar .= "</li>\n</ul>\n</li>\n";
						} else $menubar .= "</li>\n";

						$menubar .= "</ul>\n";
					}

					echo $menubar;

					// 생성한 메뉴를 케싱 저장합니다.
					if(!is_dir("./".$menu_code)) mkdir("./".$menu_code);
					_file_save("./$menu_code/$menu_code."."ko".".htm", $menubar);



				}


				// =============================

			} else {
				echo "비정상 접속! adminkey 값이 일치하지 않습니다. 해당 접속IP를 차단합니다. 해제방법은 관리자에게 문의 바랍니다. <br>";
			}

		} else {
			echo "site_env 환경 설정값을 읽어올수 없습니다. <br>";
		}
	} else {
		echo "adminkey 값이 없습니다. <br>";
	}

	
	function _menu_url($urlmode,$url){
		switch($urlmode){
			case 'category':
				if($url) $_url = "/goodlist.php?cate=".$url;
				break;
			case 'pages':
				if($url) $_url = "/pages.php?code=".$url;
				break;
			case 'board':
				if($url) $_url = "/board.php?board=".$url;
				break;	
			default:
				if($url) $_url = $url;
				break;
		}

		if($_url) return $_url; else return "#";
	}

	function _menu_hassub($Id,$pos){
		// 하부 메뉴 구조가 있는지 검사.
		$query1 = "select * from `site_menu` where ref = '".$Id."' and pos < '".$pos."'";
		echo $query1."<br>";
		if( _mysqli_query_rows($query1) ) return true; else return false;
	}







	
?>