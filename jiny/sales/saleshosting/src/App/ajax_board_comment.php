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

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		$mode = _formdata("mode");
		//echo "$mode <br>";
		$uid = _formdata("uid");

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}


		if($mode == "comment_up"){
			
			$comment = addslashes( _formdata("comment") );
			$email = _formdata("email");
			$password = _formdata("password");
			$query = "INSERT INTO `site_board_comment` (`enable`,`board_uid`,`regdate`,`comment`,`email`,`password`) VALUES ('on','$uid','$TODAYTIME','$comment','$email','$password')";
			// echo $query."<br>";
			_mysqli_query($query);
			
		} else if($mode == "comment_delete"){
			$comment_id = _formdata("comment_id");
			$query = "DELETE FROM `site_board_comment` WHERE `Id`='$comment_id'";
			//echo $query."<br>";
    		_mysqli_query($query);

    	} else if($mode == "comment_editup"){
    		$comment = addslashes( _formdata("comment") );
    		$comment_id = _formdata("comment_id");
    		$query = "UPDATE `site_board_comment` SET `comment`='$comment' WHERE `Id`='$comment_id'";
    		//echo $query."<br>";
			_mysqli_query($query);
		}	



		$query = "select * from `site_board_comment` where board_uid = '$uid' and enable='on' ";
		// echo $query."<br>";
		if($rowss = _mysqli_query_rowss($query)){						
			for($i=0; $i<count($rowss); $i++,$j++){
				$rows = $rowss[$i];
				if($members->email == $rows->email){
					$comment_delete = "<a href='#' onclick=\"javascript:form_comment_delete('comment_delete','$uid','".$rows->Id."')\" >삭제</a> ";
					
					$comment_edit = "<a href='#' onclick=\"javascript:form_comment_delete('comment_edit','$uid','".$rows->Id."')\" >수정</a> ";

					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td style=\"border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">".stripslashes($rows->comment)."</td>
					</tr>
					<tr>
						<td style=\"font-size:12px;padding:10px;\" align=\"right\">".$rows->regdate."/".$rows->email." $comment_edit $comment_delete </td>
					</tr>
					</table>";
				} else {
					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td style=\"border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">".stripslashes($rows->comment)."</td>
					</tr>
					<tr>
						<td style=\"font-size:12px;padding:10px;\" align=\"right\">".$rows->regdate."/".$rows->email."</td>
					</tr>
					</table>";
				}			
				
			}
		}



		$form_list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
			<tr>
				<td style=\"font-size:12px;padding:10px;\" valign=\"top\">
				{comment}</td>
				</tr>
			</table>

		<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
			<tr>
				<td style=\"font-size:12px;padding:10px;\" valign=\"top\">　</td>
				<td style=\"font-size:12px;padding:10px;\" width=\"50\">이메일:</td>
				<td style=\"font-size:12px;padding:10px;\" width=\"200\">{email}</td>
				</tr>
			<tr>
				<td style=\"font-size:12px;padding:10px;\" valign=\"top\">　</td>
				<td style=\"font-size:12px;padding:10px;\" width=\"50\">암호:</td>
				<td style=\"font-size:12px;padding:10px;\" width=\"200\">{password}</td>
				</tr>
			<tr>
				<td style=\"font-size:12px;padding:10px;\" valign=\"top\">　</td>
				<td style=\"font-size:12px;padding:10px;\" width=\"50\">　</td>
				<td style=\"font-size:12px;padding:10px;\" width=\"200\" align=\"right\">{comment_submit}</td>
				</tr>
		</table>";


		if($mode == "comment_edit"){
			$comment_id = _formdata("comment_id");
			$query = "select * from `site_board_comment` where Id = '$comment_id' ";
			$rows = _mysqli_query_rows($query);
			
			$form_list = str_replace("{comment}",_form_textarea("comment",stripslashes($rows->comment),"5",$css_textarea),$form_list);
			$form_list = str_replace("{email}","<input type='email' require name='email' value='".$members->email."' placeholder='작성자' style=\"$css_textbox\" id=\"email\">",$form_list);
			$form_list = str_replace("{password}","<input type='password' require name='password' value='".$members->password."' placeholder='암호' style=\"$css_textbox\" id=\"password\">",$form_list);
			$form_list = str_replace("{comment_submit}","<input type='button' value='수정' onclick=\"javascript:form_comment_delete('comment_editup','$uid','".$rows->Id."')\" style=\"".$css_btn_gray."\" >",$form_list);
			$list .= $form_list;

		} else {			
			$form_list = str_replace("{comment}",_form_textarea("comment","","5",$css_textarea),$form_list);
			$form_list = str_replace("{email}","<input type='email' require name='email' value='".$members->email."' placeholder='작성자' style=\"$css_textbox\" id=\"email\">",$form_list);
			$form_list = str_replace("{password}","<input type='password' require name='password' value='".$members->password."' placeholder='암호' style=\"$css_textbox\" id=\"password\">",$form_list);
			$form_list = str_replace("{comment_submit}","<input type='button' value='코멘트' onclick=\"javascript:form_comment('comment_up','$uid')\" style=\"".$css_btn_gray."\" >",$form_list);
			$list .= $form_list;
		}

		

		echo $list;				
	
	}
		
	/*

	function _board_rows($code){
		$query = "select * from `site_boardlist` where code='$code'";
		if($rows = _mysqli_query_rows($query)){ 
			// 카테고리 스타일 정보
			return $rows;
		}
	}


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


        function list(limit){
			var url = \"ajax_board.php\";
        	var form = document.site;
        	form.limit.value = limit;

			ajax_html('#mainbody',url);
    	}


        function edit(mode,uid,limit){
        	// alert(\"aaa\");

        	
        	var url = \"board_edit.php\";		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;			
			form.submit();	
			

       	
        }

  		function form_board_submit(mode,board,uid){
			var url = \"ajax_board_editup.php?mode=\"+mode+\"&uid=\"+uid+\"&board=\"+board;
			var formData = new FormData($('#data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#mainbody').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});					
		}

		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

	</script>";


	echo "comment<br>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		if($board=_formdata("board")){
			//echo "Board = ".$board."<br>";
			if($board_rows = _board_rows($board)){

				if($board_rows->themefiles_list) $themefiles_list = $board_rows->themefiles_list; else  $themefiles_list = "board";

				$body = _theme_page($site_env->theme,$themefiles_list,$site_language,$site_mobile).$javascript;
				

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
					if($_list_num = _formdata("list_num")){
					} else $_list_num = 10;

					$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
					if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
					if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
					if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
					if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
					$form_num .= "</select>";
					$body = str_replace("{list_num}", $form_num,$body);

					$searchkey = _formdata("searchkey");
					$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
					$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
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
					

					$query = "select * from `site_board` where board = '$board' and enable='on' ";
					if($search) $query .= " and title like '%".$search."%' ";
					$query .= "order by pos desc ";

					$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.	
					$body = str_replace("{total}",$total,$body);

					if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// 검색된 데이터 내에서 , limit 설정 
					// echo $query;
					



					if($board_rows->type == "gallary") {

					} else {
						$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"50\" align=\"right\">글번호</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' valign=\"top\">글제목</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120 valign=\"top\">작성자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120>작성일자</td>
							</tr>
							</table>";
					}

					if($rowss = _mysqli_query_rowss($query)){						

						for($i=0; $i<count($rowss); $i++,$j++){
							$rows = $rowss[$i];
							if($board_rows->type == "gallary") $list .= _gallary_list($rows); else $list .= _board_list($rows);
						}
		
						$list .= _pagination($_list_num,$_block_num,$limit,$total);
						$body = str_replace("{board_list}",$list,$body);

					} else {
						$msg = "글 목록이 없습니다.";
						$body = str_replace("{board_list}",$list."<div style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' align=\"center\">".$msg."</div>",$body);

					}


					

				}

				echo $body;



			} else {
				$msg = "오류. 게시판 정보를 읽어 올 수 없습니다..";
				$msg_string = _string($msg,$site_language);
				$body_error = _error_page($skin_name,$msg_string);
				echo $body_error;
			}

		} else {
			$msg = "오류. 게시판 코드번호가 없습니다..";
			$msg_string = _string($msg,$site_language);
			$body_error = _error_page($skin_name,$msg_string);
			echo $body_error;
		}

	} else {
		$msg = "접속 보안키값이 일치하지 않습	니다.";
		$msg_string = _string($msg,$site_language);
		$body_error = _error_page($skin_name,$msg_string);
		echo $body_error;
	}


	$php_end = get_time();
	$php_time = $php_end - $php_start;
	echo "<!-- Second ".$php_time."-->";

	function _board_list($rows){
		$level_tree = "";
		// 답변글 Reply 체크
		if($rows->level>0){
			for($j=0;$j<$rows->level;$j++) $level_tree .= "&nbsp;&nbsp;";
			$level_tree .= "└";
		}

		$writer = explode("@",$rows->email);
		$writer = $writer[0]."@*****";

		if($rows->check_secure && $rows->email != $_COOKIE['cookie_email']){
			$title = $rows->title." ";
		} else {
			$title = "<a href='#' onclick=\"javascript:edit('view','".$rows->Id."','$limit')\" >".$rows->title."</a>";
		}

		if($rows->check_secure) $title .= "  <i class=\"fa fa-unlock-alt\" style=\"color:#333333;\"></i>";

		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
			<tr>
				
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"50\" align=\"right\">".$rows->pos."</td>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' valign=\"top\">$level_tree $title</td>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120 valign=\"top\">".$writer."</td>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=120>".$rows->regdate."</td>
			</tr>
			</table>";
			
		return $list;
	}

	function _gallary_list($rows){
		$level_tree = "";
		// 답변글 Reply 체크
		if($rows->level>0){
			for($j=0;$j<$rows->level;$j++) $level_tree .= "&nbsp;&nbsp;";
			$level_tree .= "└";
		}

		$writer = explode("@",$rows->email);
		$writer = $writer[0]."@*****";

		if($rows->check_secure && $rows->email != $_COOKIE['cookie_email']){
			$title = $rows->title." ";
		} else {
			$title = "<a href='#' onclick=\"javascript:edit('view','".$rows->Id."','$limit')\" >".$rows->title."</a>";
		}

		if($rows->check_secure) $title .= "  <i class=\"fa fa-unlock-alt\" style=\"color:#333333;\"></i>";

		$attach_files = explode(";", $rows->attach_files);
		for($i=0,$j=1;$i<count($attach_files);$i++){
			if($attach_files[$i]){
				$data = getimagesize($attach_files[$i]);
				$tot_width += $data[0];
				$img_width[$j] = $data[0];
				$key = "_width_".$j."_";
				// $key / $j / $img_width[$j] $attach_files[$i] $data[0]
				$images .= "<div style=\"float:left;$key\"><img src=\"$attach_files[$i]\" border=\"0\" style=\"max-width:100%;height:auto;\"></div>";
				$j++;			
			}			
		}

		for($k=1;$k<$j;$k++){
			$width = 100 / $tot_width * $img_width[$k];
			$key = "_width_".$k."_";
			$images = str_replace($key,"width:$width%",$images);
		}
		// $width = 100/$j;
		

		//$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >";
		// $list .= "<tr> $images </tr>";
		//$list .= "</table>";
		$list .= _html_div_clearfix($images,"text-align:center");

		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >";	
		$list .= "<tr><td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' align=\"center\">$title</td></tr>";
		$list .= "</table>";
			
		return $list;
	}	

	*/

?>
