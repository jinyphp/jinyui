<?php
	//*  Openshopping V2.1
	//*  Program by : hojin lee
	//*  

	// update : 2016.01.04 = 코드정리 

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	
	$javascript = "<script>

		$('#btn_search').on('click',function(){
        	board_list(0);
    	});

		$('#goods_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		list(0);
        	}
    	});

    	function search(){
    		list(0);
    	}

        function list(limit){
			var url = \"ajax_board.php\";
        	var form = document.site;
        	form.limit.value = limit;

			ajax_html('#mainbody',url);
    	}

        function edit(mode,uid,limit){   	
        	var url = \"board_edit.php\";		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;			
			form.submit();	 	
        }

		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

	</script>";


	// ++ 계시판 관련 함수 라이브러리	
	// include ($_SERVER['DOCUMENT_ROOT']."/board/board.class.php");
	// include "./board/board.class.php";

	
	// POST키값을 기준으로 변수 = 값 지정.
	$arr = array_keys($_POST);
	for($i=0;$i<count( $arr );$i++){
		$key_name = $arr[$i];
		${$key_name} = _formdata($key_name);
	}

	if($board){
		$mainbody = _theme_popup($site_env->theme,"board",$site_language,$site_mobile);
		require_once("inc.board_list.php");
		echo $mainbody;
	} else {
		echo "<div id=\"error_massage\">Error! 계시판 코드가 없습니다.</div>";
	}

	




	/*

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		if($board=_formdata("board")){
			$body = _board($board);
			echo $body.$javascript;			

		} else {
			$msg = "오류. 게시판 코드번호가 없습니다..";
			$body_error = _error_page($skin_name,_string($msg,$site_language));
			echo $body_error;
		}

	} else {
		$msg = "접속 보안키값이 일치하지 않습니다.";
		$body_error = _error_page($skin_name,_string($msg,$site_language));
		echo $body_error;
	}


	$php_end = get_time();
	$php_time = $php_end - $php_start;
	echo "<!-- Second ".$php_time."-->";

	
	function _board($board){
		global $ajaxkey;
		global $site_env;
		global $site_language,$site_mobile;

		if($board_rows = _board_rows($board)){

			if($board_rows->themefiles_list) $themefiles_list = $board_rows->themefiles_list; else  $themefiles_list = "board";
			//echo $board_rows->themefiles_list."<br>";
			//echo $themefiles_list."<br>";
			$body = _theme_page($site_env->theme,$themefiles_list,$site_language,$site_mobile);

			$menu_id = _formdata("menu_id");
			$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,$menu_id),$body);
				

			if($board_rows->check_login){
				// 계시판 로그인 전용접속
				if(isset($_COOKIE['cookie_email'])){					
					$_board_enable = true; 

				} else {
					// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
					$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);
					$login_script = "<script>"._javascript_ajax_login($ajaxkey)."</script>";
					$body = str_replace("<!--{error_message}-->",$login_script,$body);
					// echo $body;
					$_board_enable = false; 
				}

			} else {					
				$_board_enable = true; 
			}

			//echo "_board_enable = ".$_board_enable;
			// echo $body;

				
			if($_board_enable){

				$mode = _formmode();
				$uid = _formdata("uid");
				$limit = _formdata("limit");					
				$search = _formdata("searchkey");
				$list_num = _formdata("list_num");		
					
				$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='mode'>
					    				<input type='hidden' name='uid'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='board' value='$board'>
					    				<input type='hidden' name='searchkey' value='$search'>
										<input type='hidden' name='list_num' value='$list_num'>",$body);
				$body = str_replace("{formend}","</form>",$body);					

				// 출력 목록수 지정
				$_block_num = 10;
				if($_list_num = _formdata("list_num")){} else $_list_num = 10;
				$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

				$searchkey = _formdata("searchkey");
				$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
				$button_search ="<input type='button' value='검색' onclick=\"javascript:search()\" style=\"".$css_btn_gray."\" >";           
				$body = str_replace("{search}",$button_search,$body);



				// 계시판 타이틀					
				$body = str_replace("{board_title}",stripslashes($board_rows->title),$body);
					

				if($board_rows->check_write){
					$butten_new = "<input type='button' value='글작성' onclick=\"javascript:edit('new','0','$limit')\" style=\"".$css_btn_gray."\" >"; 
					$body = str_replace("{new}",$butten_new,$body);
				} else {
					$butten_new = "";
					$body = str_replace("{new}",$butten_new,$body);
				}      
					

				$query = "select * from site_board where board = '$board' and enable='on' ";
				if($search) $query .= " and title like '%".$search."%' ";
				$query .= "order by pos desc ";

				$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.	
				$body = str_replace("{total}",$total,$body);

				if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// 검색된 데이터 내에서 , limit 설정 

				if($board_rows->type == "gallary") {

				} else {
					$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"50\" align=\"right\">글번호</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' valign=\"top\">글제목</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120 valign=\"top\">작성자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120>작성일자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=50>조회수</td>
							</tr>
							</table>";
				}

				if($rowss = _mysqli_query_rowss($query)){						

					for($i=0; $i<count($rowss); $i++,$j++){
						$rows = $rowss[$i];
						if($board_rows->type == "gallary") $list .= _gallary_list($board_rows,$rows); else $list .= _board_list($board_rows,$rows);
					}
		
					$list .= _pagination($_list_num,$_block_num,$limit,$total);
					$body = str_replace("{board_list}",$list,$body);

				} else {
					$msg = "글 목록이 없습니다.";
					$body = str_replace("{board_list}",$list."<div style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' align=\"center\">".$msg."</div>",$body);

				}


				

			}
				

			// echo $body;
			return $body;


		} else {
			$msg = "오류. 게시판 정보를 읽어 올 수 없습니다..";
			return  _string($msg,$site_language);
		}

	}

	*/


?>
