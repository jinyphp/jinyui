<?php


	// 서브메뉴 ID기준 서브메뉴 Tree를 출력합니다.
	function _subcate($menu_code,$site_language,$mid){

		// ++ 선택한 카테고리 정보를 체크
		$query = "select * from shop_cate where Id = '".$mid."' order by pos desc";
		if($subrows = _mysqli_query_rows($query)){

			$tree = explode(">", $subrows->tree);
			
			// ++ 카테고리 타이틀 
			$query = "select * from shop_cate where enable = 'on' and tree like '%>".$tree[1]."%' order by pos desc";
			if($top_rows = _mysqli_query_rows($query)){
				$catebar = "<div id=\"subcate_title\"><a href='"._cate_url($top_rows)."'>"._cate_nameString($top_rows->title,$site_language)."</a></div>";
			}	

			// ++ 카테고리 트리 
			$catebar .= "<div id=\"subcate_tree\">";			
			$query = "select * from shop_cate where enable = 'on' and tree like '%>".$tree[1]."%' and pos < ".$top_rows->pos." order by pos desc";
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
					 
					if($mid == $rows->Id){
						$cate_name = "<b>"._cate_nameString($rows->title,$site_language)."</b>";
					} else {
						$cate_name = _cate_nameString($rows->title,$site_language);
					}
					$catebar .= "<div id=\"subcate_items".$rows->level."\">".$space."&nbsp;<a href='"._cate_url($rows)."'>".$cate_name."</a></div>";
				}
				 
			}

			$catebar .= "</div>";


			return $catebar;
		} else {
			return "no category";
		}	

		

		/*
		// ++ url 정보로, 선택 메뉴 읽기
		$query = "select * from shop_cate where Id = '".$mid."' order by pos desc";
		if($subrows = _mysqli_query_rows($query)){
			// ++ 선택한 메뉴 타이틀을 출력 
			$menubar = "<div id=\"submenu_title\"><a href='"._menu_url($rows)."'>"._menu_nameString($subrows->title,$site_language)."</a></div>"; 
			
			$menubar .= "<div id=\"submenu_tree\">";
			// 서브 메뉴를 출력함
			$query = "select * from shop_cate where enable = 'on' and tree like '%>".$mid.";%' and pos < ".$subrows->pos." order by pos desc";
			// echo $query."<br>";
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
		*/

	}

	// 메뉴이름 json 처리 
	function _cate_nameString($json,$lang){
		$title = json_decode(stripslashes($json));
		if($title->$lang) 
			return $title->$lang; 
		else 
			return $title->ko;
	}

	function _cate_url($rows){

		$url = "/goodlist.php?cate=".$rows->Id;
		return $url;

		/*
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
		
		*/
	}


?>