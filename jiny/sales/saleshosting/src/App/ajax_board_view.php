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
		function form_comment_delete(mode,uid,comment_id){
			var url = \"ajax_board_comment.php?mode=\"+mode+\"&uid=\"+uid+\"&comment_id=\"+comment_id;
			//alert(comment_id);
  			$.ajax({
                	url:url,
                	type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('#comment').html(data);
                	}
            });	
		}

		function form_comment(mode,uid){
			var url = \"ajax_board_comment.php?mode=\"+mode+\"&uid=\"+uid;
			var email = $('#email').val();
  			var password = $('#password').val();

  			if(!email){
  				alert(\"작성자 이메일이 없습니다.\");
  			} else if(!password){
  				alert(\"글 비밀번호가 없습니다.\");
  			} else {
				$.ajax({
                	url:url,
                	type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('#comment').html(data);
                	}
            	});
    		}	
		}

        function board_list(board){
            // var url = \"ajax_board.php\";	
            // alert(url);
            /*
            
            */
            
            var url = \"board.php?board=\"+board;		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			//form.mode.value = mode;
  			//form.uid.value = uid;
  			//form.limit.value = limit;			
			form.submit();	
            
        }

        function attach_remove(mode,file){
        	var returnValue = confirm(\"삭제하겠습니까?\");
			if(returnValue == true){
				var url = \"ajax_board_edit.php?mode=\"+mode;

           		var form = document.site;
  				form.file.value = file;

           		$.ajax({
               		url:url,
           			type:'post',
               		data:$('form').serialize(),
               		success:function(data){
                   		$('#main-content').html(data);
               		}
           		}); 
			}           		
        }

        function edit(mode,board,uid){
           	var url = \"ajax_board_edit.php?board=\"+board+\"&mode=\"+mode+\"&uid=\"+uid;	
        	alert(url);
           	$.ajax({
               	url:url,
           		type:'post',
               	data:$('form').serialize(),
               	success:function(data){
                   	$('#main-content').html(data);
               	}
           	}); 	
        }

        function reply(board,uid){
           	var url = \"ajax_board_reply.php?board=\"+board+\"&uid=\"+uid;	
        	alert(url);
           	$.ajax({
               	url:url,
           		type:'post',
               	data:$('form').serialize(),
               	success:function(data){
                   	$('#main-content').html(data);
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
				var url = \"ajax_board_editup.php?mode=\"+mode+\"&uid=\"+uid+\"&board=\"+board;
				var formData = new FormData($('#data')[0]);
				$.ajax({
					url:url,
        			type: 'POST',
        			data: formData,
        			async: false,
        			success: function (data) {
        				$('#main-content').html(data);
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
		if($rows = _mysqli_query_rows($query)){ 
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
			$title = "<a href='#' onclick=\"javascript:edit('view','".$rows->Id."','$limit')\" >".$rows->title."</a>";
		}

		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" >
			<tr>
				<td style='font-size:12px;padding:10px;' width=\"10\">".$rows->pos."</td>
				<td style='font-size:12px;padding:10px;' valign=\"top\">$level_tree $title</td>
				
			</tr>
			</table>";
			
		return $list;
	}

	// POST키값을 기준으로 변수 = 값 지정.
	$arr = array_keys($_POST);
	for($i=0;$i<count( $arr );$i++){
		$key_name = $arr[$i];
		${$key_name} = _formdata($key_name);
	}

	//********** Ajax Process **********
	// $ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}



		$board_rows = _board_rows($board);
		

		$query = "select * from `site_board` where Id='$uid'";
		if($rows = _mysqli_query_rows($query)){

			// 계시물글 읽기
			if($board_rows->themefiles_view) $themefiles_view = $board_rows->themefiles_view; else  $themefiles_view = "board_view";
			$body = _theme_popup($site_env->theme,$themefiles_view,$site_language,$site_mobile);

			// ++ 계시판 이름
			$board_name = json_decode($board_rows->seo_title)->$site_language;
			$body = str_replace("{board_name}","<div id=\"board_name\"><a href='board.php?board=$board'>".$board_name."</a></div>",$body);
			
			// ++ 계시물 제목
			$body = str_replace("{title}","<div id=\"board_title\">".$rows->title."</div>",$body);

			if($board_rows->view_writer){
				$writer = explode("@",$rows->email);
				$writer = $writer[0]."@*****";
				$body = str_replace("{email}",$writer,$body);
			} else {
				$body = str_replace("{email}","",$body);
			}
			
			// ++ 계시물 작성일자
			if($board_rows->view_regdate){
				$body = str_replace("{regdate}",$rows->regdate,$body);
			} else {
				$body = str_replace("{regdate}","",$body);
			}	
			

			// ++ 계시물 내용
			$html = str_replace("\n", "<br>", stripslashes($rows->html));
			$body = str_replace("{board_content}","<div id=\"board_content\">".$html."</div>",$body);


			$butten = "";
			
			if($email == $rows->email)
			$butten .= "<input type='button' value='수정' onclick=\"javascript:edit('edit','".$board."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			
			if($board_rows->check_reply)
			if($rows->check_reply)
				$butten .= "<input type='button' value='답변' onclick=\"javascript:reply('".$board."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			
			if($board_rows->check_comment){
				if($rows->check_comment){
					// $body = str_replace("{comment}","Comment",$body);
					$body = str_replace("{comment}","<span id=\"comment\">
					<script>
						$.ajax({
            				url:'ajax_board_comment.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#comment').html(data);
            				}
        				});
    				</script>
					</span>",$body);

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

						if($board_rows->view_images){
							$ext = substr($attach_files[$i], strrpos($attach_files[$i], '.') + 1); 
    						if ($ext == "JPG" || $ext == "jpg" || $ext == "GIF" || $ext == "gif" || $ext == "PNG" || $ext == "png" || $ext == "BMP" || $ext == "bmp"){
    							$data = getimagesize($attach_files[$i]);

    							if( $site_mobile == "m"){

    								if($data[0] >= 320){
    									$images .= "<img src='$attach_files[$i]' border=\"0\" style=\"width:100%;height:auto;\"> <br>";
    								} else {
    									$images .= "<img src='$attach_files[$i]' border=\"0\" > <br>";
    								}
    								

    							} else if($board_rows->view_images_type == "withall" ){
    								// 한줄에 여러개 이미지 표시
    								//$data = getimagesize($attach_files[$i]);
									$tot_width += $data[0];
									$img_width[$j] = $data[0];
									$key = "_width_".$j."_";
									// $key / $j / $img_width[$j] $attach_files[$i] $data[0]
									$images .= "<div style=\"float:left;$key\"><img src=\"$attach_files[$i]\" border=\"0\" style=\"width:100%;height:auto;\"></div>";
									$j++;

    							} else {
    								// 한줄에 한개씩 이미지 표시
    								if($board_rows->view_images_maxsize && $data[0] >= $board_rows->view_images_maxsize){
    									$images .= "<img src='$attach_files[$i]' border=\"0\" style=\"width:100%;height:auto;\"> <br>";
    								} else {
										$images .= "<img src='$attach_files[$i]' border=\"0\" > <br>";
									}  

    							}	



    						}
    						
    					}

    					if($board_rows->view_attach_view){

							$form_files .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
							$form_files .= "<td style=\"border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=\"100\">".$files_label[$i]." : </td>"; 

							if($board_rows->view_attach_down){
								$form_files .= "<td style=\"border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\" >
													<a href='filelink.php?pathfile=$attach_files[$i]'>".$filename[4]."</a>
												</td>";
							} else {
								$form_files .= "<td style=\"border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\" >".$filename[4]."</td>";
							}

							$form_files .= "</tr></table>";
						}


					} // 첨부파일 있음
					
				} // 첨부파일 횟수 많큼 루프 

				// 한줄에 여러개 이미지 표시, 가로 비율 계산처리 적용.
				if($board_rows->view_images_type == "withall"){
					for($k=1;$k<$j;$k++){
						$width = 100 / $tot_width * $img_width[$k];
						$key = "_width_".$k."_";
						$images = str_replace($key,"width:$width%",$images);
					}
				}

				$body = str_replace("{files}",$form_files,$body);

			} else {
				// 첨부파일 표시 없음.
				$body = str_replace("{files}","",$body);
			}

			$body = str_replace("{images}",$images,$body);


			$click = $rows->click +1;
			$query = "UPDATE `site_board` SET `click`='$click' WHERE `Id`='".$uid."'";
			_mysqli_query($query);


			



		

			
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
			echo $uid." 선택한 글번호가 없습니다.";
		}		


	} else {
		// echo "error";
		$msg = "AJAX 접속 보안키값이 일치하지 않습니다.";
		echo $msg;
	}




	
?>