<?php

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

	/////////////
	$javascript = "<script>
        function board_list(board){
                       
            var url = \"site_board.php?board=\"+board;		
			var form = document.site;
			form.action = url;  //이동할 페이지		
			form.submit();	
            
        }

        function attach_remove(mode,file){
        	var returnValue = confirm(\"삭제하겠습니까?\");
			if(returnValue == true){
				var url = \"ajax_site_board_edit.php?mode=\"+mode;

           		var form = document.site;
  				form.file.value = file;

           		$.ajax({
               		url:url,
           			type:'post',
               		data:$('form').serialize(),
               		success:function(data){
                   		$('#mainbody').html(data);
               		}
           		}); 
			}           		
        }

        function edit(mode,board,uid){
           	var url = \"ajax_site_board_edit.php?board=\"+board+\"&mode=\"+mode+\"&uid=\"+uid;	
           	$.ajax({
               	url:url,
           		type:'post',
               	data:$('form').serialize(),
               	success:function(data){
                   	$('#mainbody').html(data);
               	}
           	}); 	
        }


        function form_board_delete(mode,board,uid){
			var returnValue = confirm(\"삭제하겠습니까?\");
			if(returnValue == true) form_board_submit(mode,board,uid);
		}

  		function form_board_submit(mode,board,uid){
  			var title = $('#title').val();
  			var email = $('#email').val();
  			var password = $('#password').val();

  			if(!title){
  				alert(\"글 제목이 없습니다.\");
  			} else if(!email){
  				alert(\"작성자 이메일이 없습니다.\");
  			} else if(!password){
  				alert(\"글 비밀번호가 없습니다.\");
  			} else {
				var url = \"ajax_site_board_editup.php?mode=\"+mode+\"&uid=\"+uid+\"&board=\"+board;
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
		}
	</script>";


	function _board_rows($code){
		$query = "select * from `site_boardlist` where code='$code'";
		if($rows = _sales_query_rows($query)){ 
			// 카테고리 스타일 정보
			return $rows;
		}
	}

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
			$title = "* ".$rows->title." ";
		} else {
			$title = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\" >".$rows->title."</a>";
		}

		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
			<tr>
				<td style='font-size:12px;padding:10px;' width=\"10\">".$rows->pos."</td>
				<td style='font-size:12px;padding:10px;' valign=\"top\">$level_tree $title</td>
				
			</tr>
			</table>";
			
		return $list;
	}	


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		$mode = _formmode();			echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$board = _formdata("board");	//echo "board = ".$board."<br>";
	
		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}

		$board_rows = _board_rows($board);
		

		$query = "select * from `site_board` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
		
		} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
		
		}	

		// 첨부파일 삭제 
		if($mode == "remove"){
			$file = _formdata("file");

			unlink($file);
			$attach_files = str_replace($file, "", $rows->attach_files);
			$rows->attach_files = $attach_files;
			$query = "UPDATE `site_board` SET `attach_files`='$attach_files' WHERE `Id`='$uid'";
			_sales_query($query);

			$mode = "edit";
		}	




		if($mode == "view"){
			// =====================
			// 계시물글 읽기
			/*
			$body = _theme_page($site_env->theme,"board_view",$site_language,$site_mobile);
			
			$body = str_replace("{title}","<h1>".$rows->title."</h1>",$body);
			
			$writer = explode("@",$rows->email);
			$writer = $writer[0]."@*****";
			$body = str_replace("{email}",$writer,$body);
			$body = str_replace("{regdate}",$rows->regdate,$body);


			$html = str_replace("\n", "<br>", stripslashes($rows->html));
			$body = str_replace("{html}",$html,$body);

			
			$butten = "";
			
			if($email == $rows->email)
			$butten .= "<input type='button' value='수정' onclick=\"javascript:edit('edit','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			
			if($board_rows->check_reply)
			if($rows->check_reply)
				$butten .= "<input type='button' value='답변' onclick=\"javascript:edit('reply','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			
			if($board_rows->check_comment){
				if($rows->check_comment){
					$body = str_replace("{comment}","Comment",$body);
				} else {
					$body = str_replace("{comment}","",$body);
				}
			} else {
				$body = str_replace("{comment}","",$body);
			}	

			// if($email == $rows->email)
			// $butten .= "<input type='button' value='삭제' onclick=\"javascript:form_board_submit('delete','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" >";

			$body = str_replace("{form_submit}",$butten,$body);

			
			$body = str_replace("{listback}","<input type='button' value='글목록' onclick=\"javascript:board_list('$board')\" style=\"".$css_btn_gray."\" >",$body);

			//첨부파일
			if($board_rows->check_attach){
				$files_label = explode(";", $board_rows->attach_label);
				$attach_files = explode(";", $rows->attach_files);
				for($i=0,$j=1;$i<count($files_label);$i++,$j++){
					
					if($attach_files[$i]){
						$filename = explode("/",$attach_files[$i]);	

						$ext = substr($attach_files[$i], strrpos($attach_files[$i], '.') + 1); 
    					if ($ext == "jpg" || $ext == "gif" || $ext == "png" || $ext == "bmp"){
    						$images .= "<img src='$attach_files[$i]' board=0> <br>";
    					}


						$form_files .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
						$form_files .= "<td style=\"border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=\"100\">".$files_label[$i]." : </td>"; 
						$form_files .= "<td style=\"border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\" ><a href='filelink.php?pathfile=$attach_files[$i]'>".$filename[4]."</a> 
										</td>";
						$form_files .= "</tr></table>";
					}
					
				}
				$body = str_replace("{files}",$form_files,$body);
			} else $body = str_replace("{files}","",$body);
			
			$body = str_replace("{images}",$images,$body);
			*/


		} else if($mode == "edit"){

			
			$body = _theme_page($site_env->theme,"site_board_edit",$site_language,$site_mobile);

			if(isset($rows->title)) $title = $rows->title; else $title ="";
			$body = str_replace("{title}","<input type='text' require name='title' value='".$title."' placeholder='글 제목' style=\"$css_textbox\" id=\"title\">",$body);

			$html = str_replace("<br>", "\n", stripslashes($rows->html));
			$body = str_replace("{html}",_form_textarea("html",$html,"25",$css_textarea),$body);

			$body = str_replace("{email}","<input type='email' require name='email' value='".$rows->email."' placeholder='작성자' style=\"$css_textbox\" id=\"email\">",$body);
			$body = str_replace("{password}","<input type='password' require name='password' value='".$rows->password."' placeholder='암호' style=\"$css_textbox\" id=\"password\">",$body);


			if($rows->check_secure) $body = str_replace("{secure}","<input type='checkbox' name='check_secure' checked>",$body);
			else $body = str_replace("{secure}","<input type='checkbox' name='check_secure'>",$body);

			if($rows->check_reply) $body = str_replace("{reply}","<input type='checkbox' name='check_reply' checked>",$body);
			else $body = str_replace("{reply}","<input type='checkbox' name='check_reply'>",$body);

			if($rows->check_comment) $body = str_replace("{comment}","<input type='checkbox' name='check_comment' checked>",$body);
			else $body = str_replace("{comment}","<input type='checkbox' name='check_comment'>",$body);

			if($rows->enable) $body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
			else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);
			
			$butten .= "<input type='button' value='수정' onclick=\"javascript:form_board_submit('edit','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$butten .= "<input type='button' value='답변' onclick=\"javascript:edit('reply','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$butten .= "<input type='button' value='삭제' onclick=\"javascript:form_board_delete('delete','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" > ";

			$body = str_replace("{form_submit}",$butten,$body);

			//첨부파일
			if($board_rows->check_attach){
				$files_label = explode(";", $board_rows->attach_label);
				$attach_files = explode(";", $rows->attach_files);
				for($i=0,$j=1;$i<count($files_label);$i++,$j++){
					$form_files .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
					$form_files .= "<td style=\"font-size:12px;padding:10px;\" width=\"100\">".$files_label[$i]." : </td>"; 
					$form_files .= "<td style=\"font-size:12px;padding:10px;\" ><input type='file' name='userfile".$j."' id=\"cssFormStyle\" >"."</td>";


					if($attach_files[$i]){
						$form_files .= "<td style=\"font-size:12px;padding:10px;\" >".$attach_files[$i]."  <a href='#' onclick=\"javascript:attach_remove('remove','".$attach_files[$i]."')\">제거</a> </td>";
					} else {
						$form_files .= "<td style=\"font-size:12px;padding:10px;\" > </td>";
					}
					


					$form_files .= "</tr></table>";
				}
				$body = str_replace("{files}",$form_files,$body);
			} else $body = str_replace("{files}","",$body);


		} else if($mode == "new"){
			// ===================
			// 계시판 : 새글 쓰기
			
		
			$body = _theme_page($site_env->theme,"site_board_edit",$site_language,$site_mobile);
			

			if(isset($rows->title)) $title = $rows->title; else $title ="";
			// $body = str_replace("{title}","<input type='text' require name='title' value='".$title."' placeholder='제목' style=\"$css_textbox\" >",$body);
			$body = str_replace("{title}","<input type='text' require name='title' value='' placeholder='글 제목' style=\"$css_textbox\" id=\"title\">",$body);

			$body = str_replace("{html}",_form_textarea("html","","25",$css_textarea),$body);

			$body = str_replace("{email}","<input type='email' require name='email' value='".$members->email."' placeholder='작성자' style=\"$css_textbox\" id=\"email\">",$body);
			$body = str_replace("{password}","<input type='password' require name='password' value='".$members->password."' placeholder='암호' style=\"$css_textbox\" id=\"password\">",$body);

			// 새글 작성시 , 기본 계산판 환경 설정값으로 초기화
			if($board_rows->check_secure) $body = str_replace("{secure}","<input type='checkbox' name='check_secure' checked>",$body);
			else $body = str_replace("{secure}","<input type='checkbox' name='secure'>",$body);

			if($board_rows->check_reply) $body = str_replace("{reply}","<input type='checkbox' name='check_reply' checked>",$body);
			else $body = str_replace("{reply}","<input type='checkbox' name='reply'>",$body);

			if($board_rows->check_comment) $body = str_replace("{comment}","<input type='checkbox' name='check_comment' checked>",$body);
			else $body = str_replace("{comment}","<input type='checkbox' name='comment'>",$body);

			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
			

			$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_board_submit('new','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" >
			",$body);

			//첨부파일
			if($board_rows->check_attach){
				$files_label = explode(";", $board_rows->attach_label);
				for($i=0,$j=1;$i<count($files_label);$i++,$j++){
					$form_files .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
					$form_files .= "<td style=\"font-size:12px;padding:10px;\" width=\"100\">".$files_label[$i]." : </td>"; 
					$form_files .= "<td style=\"font-size:12px;padding:10px;\" ><input type='file' name='userfile".$j."' id=\"cssFormStyle\" >"."</td>";
					$form_files .= "</tr></table>";
				}
				$body = str_replace("{files}",$form_files,$body);
			} else $body = str_replace("{files}","",$body);

			
			

			

		} else if($mode == "reply"){
			// ===================
			// 계시판 : 답장 쓰기

			
			$body = _theme_page($site_env->theme,"site_board_edit",$site_language,$site_mobile);

			if(isset($rows->title)) $title = $rows->title; else $title ="";
			//$body = str_replace("{title}","<input type='text' require name='title' value='RE:".$title."' placeholder='제목' style=\"$css_textbox\" >",$body);
			$body = str_replace("{title}","<input type='text' require name='title' value='RE:".$title."' placeholder='글 제목' style=\"$css_textbox\" id=\"title\">",$body);

			$html = str_replace("\n", "<br>", stripslashes($rows->html));
			$html .= "<center> ---------- reply ---------- </center><br>";
			$body = str_replace("{html}",$html._form_textarea("html","","15",$css_textarea),$body);

			$body = str_replace("{email}","<input type='email' require name='email' value='".$members->email."' placeholder='작성자' style=\"$css_textbox\" id=\"email\">",$body);
			$body = str_replace("{password}","<input type='password' require name='password' value='".$members->password."' placeholder='암호' style=\"$css_textbox\" id=\"password\">",$body);

			if($rows->check_secure) $body = str_replace("{secure}","<input type='checkbox' name='check_secure' checked>",$body);
			else $body = str_replace("{secure}","<input type='checkbox' name='check_secure'>",$body);

			if($rows->check_reply) $body = str_replace("{reply}","<input type='checkbox' name='check_reply' checked>",$body);
			else $body = str_replace("{reply}","<input type='checkbox' name='check_reply'>",$body);

			if($rows->check_comment) $body = str_replace("{comment}","<input type='checkbox' name='check_comment' checked>",$body);
			else $body = str_replace("{comment}","<input type='checkbox' name='check_comment'>",$body);

			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);

			$body = str_replace("{form_submit}","
				<input type='button' value='답장' onclick=\"javascript:form_board_submit('reply','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" >
			",$body);

			//첨부파일
			if($board_rows->check_attach){
				$files_label = explode(";", $board_rows->attach_label);
				for($i=0,$j=1;$i<count($files_label);$i++,$j++){
					$form_files .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
					$form_files .= "<td style=\"font-size:12px;padding:10px;\" width=\"100\">".$files_label[$i]." : </td>"; 
					$form_files .= "<td style=\"font-size:12px;padding:10px;\" ><input type='file' name='userfile".$j."' id=\"cssFormStyle\" >"."</td>";
					$form_files .= "</tr></table>";
				}
				$body = str_replace("{files}",$form_files,$body);
			} else $body = str_replace("{files}","",$body);



		}

		$board_name = json_decode($board_rows->seo_title)->$site_language;
		$body = str_replace("{board_title}","<a href='site_board.php?board=$board'>".$board_name."</a>",$body);
		$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>
					    				<input type='hidden' name='board' value='$board'>
					    				<input type='hidden' name='file'>								    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		echo $javascript.$tinyMCD.$body;


	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>