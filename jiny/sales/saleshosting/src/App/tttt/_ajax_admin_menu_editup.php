<?

	@session_start();
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		include "./conf/dbinfo.php";
		include "./func/mysql.php";

		include "./func/file.php";
		include "./func/form.php";
		include "./func/skin.php";
		include "./func/datetime.php";
		include "./func/goods.php";
		include "./func/orders.php";
	
		// Sales 사용자 DB 접근.
		//include "./sales.php";


		if(isset($_SESSION['language'])){
			$site_language = $_SESSION['language'];
		} else {
			$site_language = "ko";
		}

		// 장바구니 섹션 존재 유무를 검사.
		if(isset($_SESSION['cartlog'])){
			$cartlog = $_SESSION['cartlog'];
		} else {
			$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
			$_SESSION['cartlog'] = $cartlog;			
		}

		if(isset($_COOKIE['cookie_email'])){
			$cookie_email = $_COOKIE['cookie_email'];
		} else {
			$cookie_email = "";
		}

		//$skin_name = "default";
		//$body = _skin_page("default","shop_cate_edit");

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";

		function _menu_enable($uid){
			$query = "UPDATE `site_menu` SET `enable` = '' WHERE `Id` like '$uid'";
				// echo $query;
				_mysqli_query($query);

				$msg = "메뉴 비활성";
				echo $msg;
				//echo "<script> $('#cate_edit').html('$msg'); <script>";
		}

		function _menu_disable($uid){
			$query = "UPDATE `site_menu` SET `enable` = 'on' WHERE `Id` like '$uid'";
				// echo $query;
				_mysqli_query($query);

				$msg = "메뉴 활성";
				echo $msg;
				//echo "<script> $('#cate_edit').html('$msg'); <script>";
		}

		function _menu_down($uid){
			

			//% 해당 카테고리를 읽어옴.
			$query = "select * from `site_menu` where Id = '$uid'"; 
			//echo $query."<br>";
			if( $menu = _mysqli_query_rows($query) ){ 
		    	
		    	// 현재 카테고리와 동일한 레벨의 상위 카테고리를 찾음.	
		    	$query1 = "select * from `site_menu` where level = '".$menu->level."' and pos < ".$menu->pos." and ref = ".$menu->ref." order by pos desc "; 
				//echo $query1."<br>";
				if( $rows_down = _mysqli_query_rows($query1) ){  
		    		
		    		//echo "하위 카테고리 ".$rows_down->Id."<br>";

		    		// 현재 카테고리의 deth,크기를 구함.
		    		$query = "select * from `site_menu` where tree like '%$uid%' order by pos desc";
					$caterowss = _mysqli_query_rowss($query);


					// 상위 카테고리의 deth,크기를 구함.
					$query = "select * from `site_menu` where tree like '%".$rows_down->Id."%' order by pos desc";
					$downrowss = _mysqli_query_rowss($query);  

					$j=0;

					for($i=0;$i<count($caterowss);$i++){
						$rows3 = $caterowss[$i];
		    			$position = $rows3->pos - count($downrowss); // 하위 카테고리 사이트 크기많큼 pos를 모두 감소. 
		    			$queryUp[$j++] = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id; 
		    			//echo "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows3->Id."<br>";
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
		    			// mysql_db_query($master_mysql[dbname],$queryUp[$j],$master_dbconnect);
		    			_mysqli_query($queryUp[$j]);
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
			//% 해당 카테고리를 읽어옴.
			$query = "select * from `site_menu` where Id = '$uid'"; 
			//echo $query."<br>";
			if( $menu = _mysqli_query_rows($query) ){ 
		    	
		    	// 현재 카테고리와 동일한 레벨의 상위 카테고리를 찾음.	
		    	$query1 = "select * from `site_menu` where level = '".$menu->level."' and pos > ".$menu->pos." and ref = ".$menu->ref." order by pos asc "; 
				//echo $query1."<br>";
				if( $rows_up = _mysqli_query_rows($query1) ){  
		    		
		    		//echo "상위 카테고리 ".$rows_up->Id."<br>";

		    		// 현재 카테고리의 deth,크기를 구함.
		    		$query = "select * from `site_menu` where tree like '%$uid%' order by pos desc";
					$caterowss = _mysqli_query_rowss($query);


					// 상위 카테고리의 deth,크기를 구함.
					$query = "select * from `site_menu` where tree like '%".$rows_up->Id."%' order by pos desc";
					$uprowss = _mysqli_query_rowss($query);  

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
		    			_mysqli_query($queryUp[$j]);
		    		}

		    		$msg = "상위이동";
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

		function _menu_delete($uid){
			$query = "select * from `site_menu` where ref = '$uid'";
			// echo $query."<br>";
			if( $rows = _mysqli_query_rows($query) ){ 
				//echo "오류! 하위 카테고리가 있어 삭제가 되지 않습니다.";
			} else {
				$query = "DELETE FROM `site_menu` WHERE `Id`='$uid'";
				// echo $query."<br>";
				_mysqli_query($query);
				// echo "삭제";

				// POS 값 재정럴
				$query = "select * from `site_menu` order by pos asc";
				if( $rowss = _mysqli_query_rowss($query) ){ 
					for($i=0,$j=1;$i<count($rowss);$i++,$j++){
						$rows = $rowss[$i];
						$query = "UPDATE `site_menu` SET `pos`=$j WHERE `Id`=".$rows->Id;
						_mysqli_query($query);
					}
				}

				$msg = "삭제";
    			echo $msg;	

			}
		}

		switch($mode){
			case 'disable':
				_menu_enable($uid);
				break;
			case 'enable':
				_menu_disable($uid);
				break;
			case 'down':
				_menu_down($uid);
				break;
			case 'up':
				_menu_up($uid);
				break;
			case 'delete':		
				_menu_delete($uid);
				break;	
		}	
			


		if($mode == "edit"){
			// Langauge Json Save
			
    		$query = "select * from `site_language` ";	
			if( $rowss = _mysqli_query_rowss($query) ){ 
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
				echo "이름이 없습니다.";
			} else {
				$title = addslashes($title);
				$name = _formdata($site_language);
				$url = _formdata("url");
				$alt = _formdata("alt");
				$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

				$query = "UPDATE `site_menu` SET  `name`='$name', `title`='$title', `url`='$url', `alt`='$alt', `enable`='$enable' WHERE `Id`='$uid'";
    			// echo $query."<br>";
    			_mysqli_query($query);

    			$msg = "수정완료";
    			echo $msg;
			}

		} else if($mode == "new"){

			$query = "select * from `site_language` ";	
			if( $rowss = _mysqli_query_rowss($query) ){ 
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
				echo "이름이 없습니다.";
			} else {
				$title = addslashes($title);
				
				$name = _formdata($site_language);
				$url = _formdata("url");
				$alt = _formdata("alt");
				$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

				// 최상위 Level 0 메뉴 추가   
    			$query = "select * from `site_menu` order by pos desc";
    			if( $rows = _mysqli_query_rows($query) ){
					$pos = $rows->pos+1;
    			} else $pos = 1;

    			$query = "INSERT INTO `site_menu` (`name`, `url`, `alt`, `title`,  `enable`, `level`, `pos`, `ref`) 
    									VALUES ('$name', '$url', '$alt', '$title', '$enable', '0', '$pos', '0')";
    			//echo $query."<br>";						
    			_mysqli_query($query);

    			//% Id 번호 추출 및 Tree 추가...
				$query = "select * from `site_menu` where pos='$pos'";
    			if( $rows = _mysqli_query_rows($query) ){
					$tree = "0>".$rows->Id;
					$query = "UPDATE `site_menu` SET `tree`='$tree' WHERE `Id`=".$rows->Id;
    				//echo $query."<br>";
    				_mysqli_query($query);
    			}

    			$msg = "신규등록";
    			echo $msg;
			}


		} else if($mode == "sub"){
			$query = "select * from `site_language` ";	
			if( $rowss = _mysqli_query_rowss($query) ){ 
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
				echo "이름이 없습니다.";
			} else {
				$title = addslashes($title);
				
				$name = _formdata($site_language);
				$url = _formdata("url");
				$alt = _formdata("alt");
				$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

				// 삽입위치, pos값 전체 +1 씩 증가
    			$query = "select * from `site_menu` where `Id`=".$uid."";	
				//echo $query."<br>";	
				if( $cate = _mysqli_query_rows($query) ){

					//$POS = $cate->pos + 1;
    				$LEVEL = $cate->level + 1;

					$query = "select * from `site_menu` where pos >= '".$cate->pos."' order by pos desc";
    				//echo $query."<br>";	
    				if( $rowss = _mysqli_query_rowss($query) ){
						for($i=0;$i<count($rowss);$i++){
							$rows1=$rowss[$i];
							$position = $rows1->pos+1;
    						$queryUp = "UPDATE `site_menu` SET `pos`=$position WHERE `Id`=".$rows1->Id;
    						_mysqli_query($queryUp);
    						//echo "++ ".$queryUp."<br>";
    					}
    				}	
				
					// 카테고리 추가...
    				$query = "INSERT INTO `site_menu` (`name`, `url`, `alt`, `title`, `enable`, `level`, `pos`, `ref`, `hassub`) 
    									VALUES ('$name', '$url', '$alt', '$title', '$enable', '$LEVEL', '".$cate->pos."', '$uid','hassub');";
					_mysqli_query($query);
					//echo $query."<br>";

					//Tree값 분석 및 생성, 갱신
					$query = "select * from `site_menu` where pos='".$cate->pos."'";
					if( $rows = _mysqli_query_rows($query) ){
						$tree = $cate->tree.">".$rows->Id;
						$queryUp = "UPDATE `site_menu` SET `tree`='$tree' WHERE pos=".$cate->pos."";
    					_mysqli_query($queryUp);
					}

					$msg = "서브등록";
    				echo $msg;

				} else echo "상품을 찾을 수 없습니다.";


			}	

		} 


		// 화면 갱신...
		/*<form name='cate' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
			<input type='hidden' name='ajaxkey' value='$ajaxkey'>
		</form>	*/

		echo "<script>
				$.ajax({
            		url:'/ajax_admin_menu.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#menu_list').html(data);
            		}
        		});
    			</script>";

		
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
		/*
		$skin_name = "default";
		$body = _skin_page($skin_name,"error"); // 스킨 읽어오기

    	$body = str_replace("{error_message}",$error_message,$body);
    	echo $body;
    	*/

	}




	
?>