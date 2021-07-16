<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee


	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/css.php";



	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...		
	
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode(); 		
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$code = _formdata("code");	echo "code= $code <br>";

		switch($mode){
			case 'disable':
				_menu_enable($uid);
				echo "<script>"._javascript_ajax_html("#mainbody","/ajax_site_menu.php?limit=".$limit."&ajaxkey=".$ajaxkey."&menu_code=".$menu_code)."</script>";
				break;

			case 'enable':
				_menu_disable($uid);
				echo "<script>"._javascript_ajax_html("#mainbody","/ajax_site_menu.php?limit=".$limit."&ajaxkey=".$ajaxkey."&menu_code=".$menu_code)."</script>";
				break;

			case 'down':
				_menu_down($uid);
				echo "<script>"._javascript_ajax_html("#mainbody","/ajax_site_menu.php?limit=".$limit."&ajaxkey=".$ajaxkey."&menu_code=".$menu_code)."</script>";
				break;

			case 'up':
				_menu_up($uid);
				echo "<script>"._javascript_ajax_html("#mainbody","/ajax_site_menu.php?limit=".$limit."&ajaxkey=".$ajaxkey."&menu_code=".$menu_code)."</script>";
				break;

			case 'delete':		
				$msg = _menu_delete($uid);
				/*
				if($msg) echo "<script> history.go(-1); alert(\"$msg\");  </script>";
				else echo "<script> history.go(-1); </script>";
				*/
				echo "<script> history.go(-1); </script>";
				break;

			case 'save':		
				_menu_save();
				echo "<script>"._javascript_ajax_html("#mainbody","/ajax_site_menu.php?limit=".$limit."&ajaxkey=".$ajaxkey."&menu_code=".$menu_code)."</script>";
				break;	

			case 'edit':		
				_menu_edit($uid);
				echo "<script> history.go(-1); </script>";
				break;	
			case 'new':
				_menu_new();
				echo "<script> history.go(-1); </script>";
				break;

			case 'sub':
				_menu_sub($uid);
				echo "<script> history.go(-1); </script>";
				break;	

			case 'move':
				_menu_move($uid);
				// echo "<script> history.go(-1); </script>";
				break;		

		}	
			
		
	} else {
		// echo "ssesion : ".$_SESSION['ajaxkey']."<br>";
		// echo "ajaxkey : ".$ajaxkey."<br>";

		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	function _menu_move($uid){
		$menu_code = _formdata("menu_code");
		$menu_move = _formdata("menu_move");
		
		$j=0;

		$query = "select * from `site_menu` where code = '$menu_code' and tree like '%>$uid;%' order by pos desc";
		if($rowss = _sales_query_rowss($query)){
			//선택한 트리의 크기를 계산
			$tree_size = count($rowss);

			// 타킷 , 선택 트리 크기값 많큼 pos 증가 
			$query = "select * from `site_menu` where code = '$menu_code' and Id = '$menu_move'"; 
			if( $target = _sales_query_rows($query) ){ 
			
				$query1 = "select * from `site_menu` where code = '$menu_code' and pos >= '".$target->pos."'"; 
				if( $target1 = _sales_query_rowss($query1) ){
					for($i=0;$i<count($target1);$i++){
						$rows3 = $target1[$i];
		    			$position = $rows3->pos + $tree_size; // 하위 카테고리 사이트 크기많큼 pos를 모두 감소. 
		    			$queryUp[$j++] = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
					}
				} 
			}

			// 트리 pos값 변경 
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];
				$position = $target->pos - $i;
				$queryUp[$j++] = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows->Id; 
			}	

			// 저장한 커리를 모두 실행
			for($j=0;$j<count($queryUp);$j++){
		    	echo "ex.. ".$queryUp[$j]."<br>";
		    			// mysql_db_query($master_mysql[dbname],$queryUp[$j],$master_dbconnect);
		    	//_sales_query($queryUp[$j]);
		    }



				
		}


	}



	// DB로 부터 메뉴트리를 읽어옴.
	function _load_menu_db($menu_code,$site_language){
		

		// 데이터베이스 내용을 기반으로, 메뉴 html 파일 생성
		$query = "select * from `site_menu` where enable = 'on' and code = '".$menu_code."' order by pos desc";
		if($rowss = _sales_query_rowss($query)){
			
			$menubar .= "<div id='cssmenu'>";
			$menubar .= "<ul>\n";
			
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
				if(_sales_query_rows($query1)) $hassub = true; else $hassub = false;

				// 서브메뉴가 있는 구조
				if($hassub) $menubar .= "<li class='has-sub'>"; else $menubar .= "<li>";	

				$menuname = json_decode(stripslashes($rows->title));
				switch($rows->urlmode){
					case 'category':
						if($rows->url) $url = "goodlist.php?cate=".$rows->url; else $url = "#";
						break;
					case 'pages':
						if($rows->url) $url = "pages.php?code=".$rows->url; else $url = "#";
						break;
					case 'board':
						if($rows->url) $url = "board.php?board=".$rows->url; else $url = "#";
						break;	
					default:
						if($rows->url) $url = $rows->url; else $url = "#";
						break;
				}
				
				if($menuname->$site_language) $menuname_lang = $menuname->$site_language; else $menuname_lang = $menuname->ko;
				$menubar .= "<a href='".$url."'>".$menuname_lang."</a>"; 

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
			$menubar .= "</div>\n";
		}

		return $menubar;
	}



		function _menu_enable($uid){
			$query = "UPDATE `site_menu` SET `enable` = '' WHERE `Id` like '$uid'";		// echo $query;
			_sales_query($query);

			$msg = "메뉴 비활성";
			echo $msg;
		}

		function _menu_disable($uid){
			$query = "UPDATE `site_menu` SET `enable` = 'on' WHERE `Id` like '$uid'";	// echo $query;
			_sales_query($query);

			$msg = "메뉴 활성";
			//echo $msg;
		}

		function _menu_down($uid){
			$menu_code = _formdata("menu_code");
		
			//% 해당 카테고리를 읽어옴.
			$query = "select * from `site_menu` where code = '$menu_code' and Id = '$uid'"; 
			echo $query."<br>";
			if( $menu = _sales_query_rows($query) ){ 
		    	
		    	// 현재 카테고리와 동일한 레벨의 하위 카테고리를 찾음.	
		    	$query1 = "select * from `site_menu` where code = '$menu_code' and level = '".$menu->level."' and pos < ".$menu->pos." and ref = ".$menu->ref." order by pos desc "; 
				if( $rows_down = _sales_query_rows($query1) ){  
		    		
		    		echo "하위 카테고리 ".$rows_down->Id."<br>";

		    		// 현재 카테고리의 deth,크기를 구함.
		    		$query = "select * from `site_menu` where code = '$menu_code' and tree like '%>$uid;%' order by pos desc";
		    		echo $query."<br>";
					$caterowss = _sales_query_rowss($query);
					echo "선택한 메뉴 depth :".count($caterowss)."<br>";


					// 상위 카테고리의 deth,크기를 구함.
					$query = "select * from `site_menu` where code = '$menu_code' and tree like '%>".$rows_down->Id.";%' order by pos desc";
					echo $query."<br>";
					$downrowss = _sales_query_rowss($query);  
					echo "하위  메뉴 depth :".count($downrowss)."<br>";

					$j=0;

					for($i=0;$i<count($caterowss);$i++){
						$rows3 = $caterowss[$i];
		    			$position = $rows3->pos - count($downrowss); // 하위 카테고리 사이트 크기많큼 pos를 모두 감소. 
		    			$queryUp[$j++] = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
					}

					for($i=0;$i<count($downrowss);$i++){
						$rows3 = $downrowss[$i];
		    			$position = $rows3->pos + count($caterowss); // 하위  카테고리 사이트 크기많큼 pos를 모두 증가. 
		    			$queryUp[$j++] = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
					}	

					// 저장한 커리를 모두 실행
					for($j=0;$j<count($queryUp);$j++){
		    			//echo "ex.. ".$queryUp[$j]."<br>";
		    			_sales_query($queryUp[$j]);
		    		}

		    		$msg = "하위이동";
    				echo $msg;

				} else {
		    		$msg = "최상의 메뉴 입니다.";
		    		echo $msg;
		    	}
			} else {
		    	$msg = "이동할 메뉴를 선택해 주세요.";
		    	echo $msg;
		    }
		}

		function _menu_up($uid){
			$menu_code = _formdata("menu_code");

			//% 해당 카테고리를 읽어옴.
			$query = "select * from `site_menu` where code = '$menu_code' and  Id = '$uid'"; 
			//echo $query."<br>";
			if( $menu = _sales_query_rows($query) ){ 
		    	
		    	// 현재 카테고리와 동일한 레벨의 상위 카테고리를 찾음.	
		    	$query1 = "select * from `site_menu` where code = '$menu_code' and level = '".$menu->level."' and pos > ".$menu->pos." and ref = ".$menu->ref." order by pos asc "; 
				//echo $query1."<br>";
				if( $rows_up = _sales_query_rows($query1) ){  
		    		
		    		//echo "상위 카테고리 ".$rows_up->Id."<br>";

		    		// 현재 카테고리의 deth,크기를 구함.
		    		$query = "select * from `site_menu` where code = '$menu_code' and tree like '%>$uid;%' order by pos desc";
					$caterowss = _sales_query_rowss($query);


					// 상위 카테고리의 deth,크기를 구함.
					$query = "select * from `site_menu` where code = '$menu_code' and tree like '%>".$rows_up->Id.";%' order by pos desc";
					$uprowss = _sales_query_rowss($query);  

					$j=0;

					for($i=0;$i<count($caterowss);$i++){
						$rows3 = $caterowss[$i];
		    			$position = $rows3->pos + count($uprowss); // 상위 카테고리 사이트 크기많큼 pos를 모두 증가. 
		    			$queryUp[$j++] = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
					}

					for($i=0;$i<count($uprowss);$i++){
						$rows3 = $uprowss[$i];
		    			$position = $rows3->pos - count($caterowss); // 상위 카테고리 사이트 크기많큼 pos를 모두 감소. 
		    			$queryUp[$j++] = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
					}	

					// 저장한 커리를 모두 실행
					for($j=0;$j<count($queryUp);$j++){
		    			//echo "ex.. ".$queryUp[$j]."<br>";
		    			// mysql_db_query($master_mysql[dbname],$queryUp[$j],$master_dbconnect);
		    			_sales_query($queryUp[$j]);
		    		}

		    		$msg = "상위이동";
    				//echo $msg;

				} else {
		    		$msg = "최상의 메뉴 입니다.";
		    		//echo $msg;
		    	}
			} else {
		    	$msg = "이동할 메뉴를 선택해 주세요.";
		    	//echo $msg;
		    }
		}

	function _menu_delete($uid){
		$menu_code = _formdata("menu_code");

		$query = "select * from `site_menu` where code = '$menu_code' and ref = '$uid'";
		//echo $query."<br>";
		if( $rows = _sales_query_rows($query) ){ 
			$msg = "오류! 하위 카테고리가 있어 삭제가 되지 않습니다.";
		} else {
			$query = "DELETE FROM `site_menu` WHERE `Id`='$uid'";
			//echo $query."<br>";
			_sales_query($query);
			// echo "삭제";

			// POS 값 재정럴
			$query = "select * from `site_menu` where code = '$menu_code' order by pos asc";
			if( $rowss = _sales_query_rowss($query) ){ 
				for($i=0,$j=1;$i<count($rowss);$i++,$j++){
					$rows = $rowss[$i];
					$query = "UPDATE `site_menu` SET `pos`=$j WHERE `Id`=".$rows->Id;
					_sales_query($query);
				}
			}

			$msg .= "삭제";
    		//echo $msg;	
		}
		return $msg;
	}


	// 메뉴 구조 tree 를 파일로 저장
	function _menu_save(){
		global $sales_db,$site_language;

		$menu_code = _formdata("menu_code");
		//echo $menu_code."<br>";

		//$dir = "./users/".$sales_db->Id."/data";
		$dir = "./data";
		//echo $dir."<br>";
		if(_is_path($dir)){
			$query = "select * from `site_language` ";	
			if( $rowss = _sales_query_rowss($query) ){ 
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					// $name = _formdata($rows->code);
					$menu_body = _load_menu_db($menu_code,$rows->code);
					//echo $menu_body;
					_file_save($dir."/menu_".$menu_code.".".$rows->code.".data",$menu_body);
				}
			}
		}
	}



	function _menu_json_encode(){
		$query = "select * from `site_language` ";	
		if( $rowss = _sales_query_rowss($query) ){ 
			$title = "{";
			//$flag = false;
			for($i=0;$i<count($rowss);$i++){
				$rows=$rowss[$i];				
				$name = _formdata($rows->code);
				//if(isset($name) && $name != "") $flag = true;
				$title .= "\"".$rows->code."\":\"".$name."\"";
				if($i<(count($rowss)-1)) $title .= ",";
			}
			$title .= "}"; 
		}
		return $title;
	}


	function _menu_new(){
		global $site_language;

		$query = "select * from `site_language` ";	
		if( $rowss = _sales_query_rowss($query) ){ 
			$title = "{";
			$flag = false;
			for($i=0;$i<count($rowss);$i++){
				$rows=$rowss[$i];				
				$name = _formdata($rows->code);
				if(isset($name) && $name != "") $flag = true;
				$title .= "\"".$rows->code."\":\"".$name."\"";
				if($i<(count($rowss)-1)) $title .= ",";
			}
			$title .= "}"; 
		}

		if($flag == false ){
			//echo $title;
			//echo "이름이 없습니다.";
		} else {
			$title = addslashes($title);
				
			$name = _formdata($site_language);
			$url = _formdata("url");
			$alt = _formdata("alt");
			$urlmode = _formdata("urlmode");
			$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

			$check_members = _formdata("check_members"); if($check_members) $check_members = "on"; else $check_members = "";

			$menu_code = _formdata("menu_code");

			// 최상위 Level 0 메뉴 추가   
    		$query = "select * from `site_menu` where code = '$menu_code' order by pos desc";
    		if( $rows = _sales_query_rows($query) ){
				$pos = $rows->pos+1;
    		} else $pos = 1;

    		$query = "INSERT INTO `site_menu` (`code`, `check_members`, `name`, `url`, `urlmode`, `alt`, `title`, `enable`, `level`, `pos`, `ref`) 
    									VALUES ('$menu_code', '$check_members', '$name', '$url', '$urlmode', '$alt', '$title', '$enable', '0', '$pos', '0')";
    		echo $query."<br>";						
    		_sales_query($query);

    		//% Id 번호 추출 및 Tree 추가...
			$query = "select * from `site_menu` where code = '$menu_code' and pos='$pos'";
    		if( $rows = _sales_query_rows($query) ){
				$tree = "0>".$rows->Id.";";
				$query = "UPDATE `site_menu` SET `tree`='$tree' WHERE `Id`=".$rows->Id;
    			//echo $query."<br>";
    			_sales_query($query);
    		}

    		$msg = "신규등록";
    		//echo $msg;
		}
	}

	function _menu_sub($uid){
		global $site_language;


		$query = "select * from `site_language` ";	
		if( $rowss = _sales_query_rowss($query) ){ 
			$title = "{";
			$flag = false;
			for($i=0;$i<count($rowss);$i++){
				$rows=$rowss[$i];				
				$name = _formdata($rows->code);
				if(isset($name) && $name != "") $flag = true;
				$title .= "\"".$rows->code."\":\"".$name."\"";
				if($i<(count($rowss)-1)) $title .= ",";
			}
			$title .= "}"; 
		}

		if($flag == false ){
			//echo $title;
			//echo "이름이 없습니다.";
		} else {
			$title = addslashes($title);
			
			$name = _formdata($site_language);
			$url = _formdata("url");
			$urlmode = _formdata("urlmode");
			$alt = _formdata("alt");
			$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

			$check_members = _formdata("check_members"); if($check_members) $check_members = "on"; else $check_members = "";

			$menu_code = _formdata("menu_code");

			// 삽입위치, pos값 전체 +1 씩 증가
    		$query = "select * from `site_menu` where code = '$menu_code' and `Id`=".$uid."";	
    		echo $query."<br>";
			if( $cate = _sales_query_rows($query) ){

				//$POS = $cate->pos + 1;
    			$LEVEL = $cate->level + 1;

				$query = "select * from `site_menu` where code = '$menu_code' and pos >= '".$cate->pos."' order by pos desc";	
    			if( $rowss = _sales_query_rowss($query) ){
					for($i=0;$i<count($rowss);$i++){
						$rows1=$rowss[$i];
						$position = $rows1->pos+1;
    					$queryUp = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows1->Id;
    					_sales_query($queryUp);
    					//echo "++ ".$queryUp."<br>";
    				}
    			}	
				
				// 카테고리 추가...
    			$query = "INSERT INTO `site_menu` (`code`, `check_members`, `name`, `url`, `urlmode`, `alt`, `title`, `enable`, `level`, `pos`, `ref`, `hassub`) 
    									VALUES ('$menu_code', '$check_members', '$name', '$url', '$urlmode', '$alt', '$title', '$enable', '$LEVEL', '".$cate->pos."', '$uid','hassub');";
				_sales_query($query);
				echo $query."<br>";

				//Tree값 분석 및 생성, 갱신
				$query = "select * from `site_menu` where code = '$menu_code' and  pos='".$cate->pos."'";
				if( $rows = _sales_query_rows($query) ){
					$tree = $cate->tree.">".$rows->Id.";";
					$queryUp = "UPDATE `site_menu` SET `tree`='$tree' WHERE pos=".$cate->pos."";
    				_sales_query($queryUp);
				}

	
				$msg = "서브등록";
    			//echo $msg;

			} else echo "상품을 찾을 수 없습니다.";


		}	
	}
		
	function _menu_edit($uid){
		global $site_language;
		/*
		$query = "select * from `site_language` ";	
		if( $rowss = _sales_query_rowss($query) ){ 
			$title = "{";
			$flag = false;
			for($i=0;$i<count($rowss);$i++){
				$rows=$rowss[$i];				
				$name = _formdata($rows->code);
				if(isset($name) && $name != "") $flag = true;
				$title .= "\"".$rows->code."\":\"".$name."\"";
				if($i<(count($rowss)-1)) $title .= ",";
			}
			$title .= "}"; 
		}
		*/

		$title = _menu_json_encode();
		/*
		if($flag == false ){
			//echo $title;
			$msg = "이름이 없습니다.";
		} else {
		*/
			$title = addslashes($title);
			$name = _formdata($site_language);
			$url = _formdata("url");
			$alt = _formdata("alt");
			$urlmode = _formdata("urlmode");
			$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

			$check_members = _formdata("check_members"); if($check_members) $check_members = "on"; else $check_members = "";

			$menu_code = _formdata("menu_code");

			$query = "UPDATE `site_menu` SET  `code`='$menu_code', `check_members`='$check_members', `name`='$name', `title`='$title', `url`='$url', `urlmode`='$urlmode', `alt`='$alt', `enable`='$enable' WHERE `Id`='$uid'";
    		//echo $query."<br>";
    		_sales_query($query);

    		$msg = "수정완료";
    	/*	
    		//echo $msg;
		}
		*/

		return $msg;
	}

	
?>