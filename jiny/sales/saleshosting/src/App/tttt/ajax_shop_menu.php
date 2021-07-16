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
		include "./func/butten.php";
	
		// Sales 사용자 DB 접근.
		include "./sales.php";

		
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

		/////////////
		
		$skin_name = "default";
		$body = _skin_page("default","shop_goods");
		$body .= "<script>
				  function menuedit(uid){
                  	$.ajax({
                        url:'/ajax_shop_menu_edit.php?uid='+uid,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
                  }
                  
                  </script>";

		

		$mode = _formmode();
		$type = _formdata("type"); if(!$type) $type="menu";
		//$body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		
		///////////////////
		// 상품 목록을 검색

		$query = "select * from `site_nav` where type='$type' ";
		if($rowss = _sales_query_rowss($query)){
			for($i=0,$list ="";$i<count($rowss);$i++){
				$rows = $rowss[$i];

				// $list .= "<a href='#' onclick=\"javascript:gooddetail('".$rows->Id."')\">".$rows->title."</a><br>";

				for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='2' cellspacing='2' width='100%'><tr>";
					
				if($rows->enable) $list .= "<td width='20' id=\"table_td\"> <a href='".$_SERVER['PHP_SELF']."?mode=disable&UID=".$rows->Id."'>▣</a></td>";
				else $list .= "<td width='20' id=\"table_td\"> <a href='".$_SERVER['PHP_SELF']."?mode=enable&UID=".$rows->Id."'>□</a></td>";
					
				//*** 트리모양 만들기
				if($rows->level == 0) {
					$query1 = "select * from `site_nav` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _sales_query($query1) )	$depth = "┣"; else $depth = "┗";
								
				} else {	
						
						$query1 = "select * from `site_nav` where ref = '0' and pos > '".$rows->pos."'"; 
						if( _sales_query($query1) )	$depth = "┃"; else $depth = "&#4515;";

						for($k=0;$k<$rows->level;$k++) $depth .= "&#4515;";
						
						$query1 = "select * from `site_nav` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
						//$result1=mysql_db_query($master_mysql[dbname],$query1,$master_dbconnect);
						if( _sales_query($query1)  ) $depth .= "┣"; else $depth .= "┗";
				}
					
					
				// 서브 메뉴 생성 버튼
				$url = "/scm/scm_skin_nav_new.php?type=$type&UID=".$rows->Id."&pos=".$rows->pos."&level=".$rows->level;
				$list .= "<td id=\"table_td\"> $depth <a href='#' onclick=\"javascript:popup_admin_ajax('$url')\">+</a>";


				$list .= "<a href='#' onclick=\"javascript:ajax_call('/scm/scm_skin_nav_ajax.php?mode=up&UID=".$rows->Id."&type=$type')\">▲</a>";
				$list .= "<a href='#' onclick=\"javascript:ajax_call('/scm/scm_skin_nav_ajax.php?mode=down&UID=".$rows->Id."&type=$type')\">▼</a>";
					
				// 수정 모드
				// $url = "/scm/scm_skin_nav_edit.php?popup=yes&UID=".$rows->Id;
				$list .= "<a href='#' onclick=\"javascript:menuedit('".$rows->Id."')\">".$rows->name."</a> ".$rows->url."</td>";

				//$list .= "<td width='150' bgcolor='ffffff'> <font size=2> $rows[code]</font></td>";
				$list .= "<td width='150' id=\"table_td\"> TREE: ".$rows->tree."</td>";
				$list .= "<td width='70' id=\"table_td\"> LEVEL: ".$rows->level."</td>";
				$list .= "<td width='70' id=\"table_td\"> REF: ".$rows->ref."</td>";
				$list .= "<td width='70' id=\"table_td\"> POS: ".$rows->pos."</td>";
				$list .= "</tr></table>";


			}
		
			$body = str_replace("{goods_list}",
								"<form name='goods' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
					   			<input type='hidden' name='ajaxkey' value='".$_POST['ajaxkey']."'>".$list."</form>",$body);
			echo $body;
			

		} else {
			$msg = "메뉴 내용이 없습니다.";
			echo $msg;
		}	
		
	} else {
			$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
			echo $msg;
	}

	
?>