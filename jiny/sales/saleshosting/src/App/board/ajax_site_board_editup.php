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

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();    // echo $mode;	
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$list_num = _formdata("list_num");
		$board = _formdata("board");

	

		if(isset($_COOKIE['cookie_email'])) $email = $_COOKIE['cookie_email'];

	

    	function _form_uploadfile($formname,$filename){
    		if($_FILES[$formname]['tmp_name']){
    			// 파일 확장자 검사
    			
    			$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    			else {
    				if($filename == ""){
    					// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename);
    					//echo $filename."<br>";
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}	

		if($mode == "new"){
			// ======================
			// 신규 계시물 작성
			$query = "select * from `site_boardlist` where code='$board'";
			$board_rows = _sales_query_rows($query); 

			if($title = _formdata("title")){

				$insert_filed .= "`regdate`,";	$insert_value .= "'$TODAYTIME',";	// 작성일자 및 시간
				$insert_filed .= "`enable`,";	$insert_value .= "'on',";	// 글 보이기 
				
				if($board = _formdata("board")){	// 계시판 코드 
					$insert_filed .= "`board`,";
					$insert_value .= "'$board',";
				}

				$insert_filed .= "`title`,";	$insert_value .= "'$title',";	// 글 제목
				
				if($html = _formdata("html")){	// 글 내용 
					$insert_filed .= "`html`,";
					$insert_value .= "'". addslashes($html) ."',";
				}

				if($email = _formdata("email")){	// 작성자 이메일
					$insert_filed .= "`email`,";	
					$insert_value .= "'$email',";
				}

				if($password = _formdata("password")){	// 작성자 이메일
					$insert_filed .= "`password`,";	
					$insert_value .= "'$password',";
				}

				// 답변글 허용
				if($check_reply = _formdata("check_reply")){	
					$insert_filed .= "`check_reply`,";	
					$insert_value .= "'$check_reply',";
				}

				// 코멘트 작성 허용 
				if($check_comment = _formdata("check_comment")){	
					$insert_filed .= "`check_comment`,";	
					$insert_value .= "'$check_comment',";
				}

				// 보완(비밀글) 작성 허용 
				if($check_secure = _formdata("check_secure")){	
					$insert_filed .= "`check_secure`,";	
					$insert_value .= "'$check_secure',";
				}


				if($tag = _formdata("tag")){	// 작성자 이메일
					$insert_filed .= "`tag`,";	
					$insert_value .= "'$tag',";
				}

				// 신규 pos / level / ref 계산
				$ref = 0;
				$level = 0;
				// $pos = _mysqli_query_count("select * from `site_board` where board='$board'") + 1;
				$query = "select * from `site_board` where board='$board' order by pos desc";
    			if( $rows = _sales_query_rows($query) ){
					$pos = $rows->pos+1;
    			} else $pos = 1;

				$insert_filed .= "`ref`,";	$insert_value .= "'$ref',";
				$insert_filed .= "`level`,"; $insert_value .= "'$level',";
				$insert_filed .= "`pos`,";	$insert_value .= "'$pos',";

				$query = "INSERT INTO `site_board` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				//echo $query."<br>";
				_sales_query($query);
				
				//첨부파일
				$query = "select * from `site_board` where board='$board' and pos = '$pos'";
    			if( $rows = _sales_query_rows($query) ){
					// $uid = $rows->Id+1;

    				$files_label = explode(";", $board_rows->attach_label);
					for($i=0,$j=1;$i<count($files_label);$i++,$j++){
						$userfile = "userfile".$j;
						if($_FILES[$userfile]['tmp_name']){
							_is_path("./board/$board/".$rows->Id);					
							if($files = _form_uploadfile($userfile,"./$board/".$rows->Id."/".$_FILES[$userfile]['name'])) {
								$attach_files .= "./board/$board/".$rows->Id."/".$_FILES[$userfile]['name'].";";
							} else $attach_files .= ";";
						}
					
					}
					$insert_filed .= "`attach_files`,";	$insert_value .= "'$attach_files',";

					$query = "UPDATE `site_board` SET `attach_files`='$attach_files' WHERE `Id`='".$rows->Id."'";
					_sales_query($query);

    			} 		

				

			} else echo "글 제목이 없습니다."; 

		} else if($mode == "reply"){
			// ======================
			// 답변 계시물 작성

			$query = "select * from `site_boardlist` where code='$board'";
			$board_rows = _sales_query_rows($query); 

			$query = "select * from `site_board` where Id='$uid'";
			if($rows = _sales_query_rows($query)){

				if($title = _formdata("title")){

					$insert_filed .= "`regdate`,";	$insert_value .= "'$TODAYTIME',";	// 작성일자 및 시간
					$insert_filed .= "`enable`,";	$insert_value .= "'on',";	// 글 보이기 
				
					if($board = _formdata("board")){	// 계시판 코드 
						$insert_filed .= "`board`,";
						$insert_value .= "'$board',";
					}

					$insert_filed .= "`title`,";	$insert_value .= "'$title',";	// 글 제목
				
					if($html = _formdata("html")){	// 글 내용 
						$insert_filed .= "`html`,";
						$insert_value .= "'". addslashes($html) ."',";
					}

					if($email = _formdata("email")){	// 작성자 이메일
						$insert_filed .= "`email`,";	
						$insert_value .= "'$email',";
					}

					if($password = _formdata("password")){	// 작성자 이메일
						$insert_filed .= "`password`,";	
						$insert_value .= "'$password',";
					}

					// 답변글 허용
					if($check_reply = _formdata("check_reply")){	
						$insert_filed .= "`check_reply`,";	
						$insert_value .= "'$check_reply',";
					}

					// 코멘트 작성 허용 
					if($check_comment = _formdata("check_comment")){	
						$insert_filed .= "`check_comment`,";	
						$insert_value .= "'$check_comment',";
					}

					// 보완(비밀글) 작성 허용 
					if($check_secure = _formdata("check_secure")){	
						$insert_filed .= "`check_secure`,";	
						$insert_value .= "'$check_secure',";
					}


					if($tag = _formdata("tag")){	// 작성자 이메일
						$insert_filed .= "`tag`,";	
						$insert_value .= "'$tag',";
					}

					// 답변 pos / level / ref 계산
					$ref = $uid;					
					$insert_filed .= "`ref`,";	$insert_value .= "'$uid',";

					$level = $rows->level +1;
					$insert_filed .= "`level`,"; $insert_value .= "'$level',";

					$pos = $rows->pos;
					$insert_filed .= "`pos`,";	$insert_value .= "'$pos',";

					// 전체 pos값 +1 증가
					$query1 = "select * from `site_board` where board = '$board' and pos >= '".$rows->pos."'";
					//echo $query1."<br>";
					if($rowss1 = _sales_query_rowss($query1)){
						for($i=0;$i<count($rowss1);$i++){
							$rows1 = $rowss1[$i];
							$pos1 = $rows1->pos +1;
							$query2 = "UPDATE `site_board` SET pos='$pos1' where Id='".$rows1->Id."'";
							//echo $query2."<br>";
							_sales_query($query2);
						}
					}					

					$query = "INSERT INTO `site_board` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					//echo $query."<br>";
					_sales_query($query);

					//첨부파일
					$query = "select * from `site_board` where board='$board' and pos = '$pos'";
    				if( $rows = _sales_query_rows($query) ){
						// $uid = $rows->Id+1;

    					$files_label = explode(";", $board_rows->attach_label);
						for($i=0,$j=1;$i<count($files_label);$i++,$j++){
							$userfile = "userfile".$j;
							if($_FILES[$userfile]['tmp_name']){
								_is_path("./board/$board/".$rows->Id);					
								if($files = _form_uploadfile($userfile,"./$board/".$rows->Id."/".$_FILES[$userfile]['name'])) {
									$attach_files .= "./board/$board/".$rows->Id."/".$_FILES[$userfile]['name'].";";
								} else $attach_files .= ";";
							}
					
						}
						$insert_filed .= "`attach_files`,";	$insert_value .= "'$attach_files',";

						$query = "UPDATE `site_board` SET `attach_files`='$attach_files' WHERE `Id`='".$rows->Id."'";
						_sales_query($query);

    				} 

				} else echo "글 제목이 없습니다."; 
			}

		} else if($mode == "edit"){

			// ======================
			// 계시물 관리자 수정
			$query = "select * from `site_boardlist` where code='$board'";
			$board_rows = _sales_query_rows($query); 
			
			$query = "select * from `site_board` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				if($title = _formdata("title")){
					$query = "UPDATE `site_board` SET ";

					$title = _formdata("title"); $query .= "`title`='$title' ,";
					$html = _formdata("html"); $query .= "`html`='". addslashes($html) ."' ,";

					$tag = _formdata("tag"); $query .= "`tag`='$tag' ,";

					$check_reply = _formdata("check_reply"); $query .= "`check_reply`='$check_reply' ,";
					$check_comment = _formdata("check_comment"); $query .= "`check_comment`='$check_comment' ,";
					$check_secure = _formdata("check_secure"); $query .= "`check_secure`='$check_secure' ,";

					$enable = _formdata("enable"); $query .= "`enable`='$enable' ,";

					//
					//첨부파일 : attach_label 수량많큼 loop 실행
					$files_label = explode(";", $board_rows->attach_label);
					$_attach_files = explode(";", $rows->attach_files);
					for($i=0,$j=1;$i<count($files_label);$i++,$j++){

						$userfile = "userfile".$j;

						if($_FILES[$userfile]['tmp_name']){
							_is_path("./board/$board/".$uid);					
							if($files = _form_uploadfile($userfile,"./$board/".$uid."/".$_FILES[$userfile]['name'])) {
								
								// 파일 업록드
								$attach_files .= "./board/$board/".$uid."/".$_FILES[$userfile]['name'].";";

								echo _curl_upload("upload","http://".$sales_db->domain."/board/curl_board_file.php",".".$dir,$file);

							} else {
								// 업로드 실패시 공란으로 설정
								$attach_files .= ";";
							}

						} else {
							// 업로드 파일이 없을 경우 기존 파일을 저장 
							$attach_files .= $_attach_files[$i].";";
						}

					}
					$query .= "`attach_files`='$attach_files' ,";
				


					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					//echo $query."<br>";
					_sales_query($query);
				} else echo "글 제목이 없습니다."; 

			}

		} else if($mode == "check_delete"){	
			// echo "check_delete";
			// 체크상품 모두 비황성화
			if($TID = $_POST['TID']){
				for($i=0,$amount=0;$i<count($TID);$i++){
					$query = "DELETE FROM `site_board` WHERE `Id`=".$TID[$i];	// echo $query."<br>";
					_sales_query($query);

					// 계시판 파일자료 삭제
					exec("rm -rf ./$board/$uid",$output);   	
    				//echo "rm -rf ./board/$board/$uid";

				}
			}	



		} else if($mode == "delete"){
			//echo "delete <br>";
			$query = "select * from `site_boardlist` where code='$board'";
			//echo $query."<br>";
			$board_rows = _sales_query_rows($query); 
			
			$query = "select * from `site_board` where ref='$uid'";
			//echo $query."<br>";
			if($rows = _sales_query_rows($query)){
		   	} else {
		   		// 답변글이 없을 경우 계시판 삭제
		   		$query = "DELETE FROM `site_board` WHERE `Id`='$uid'";
    			_sales_query($query);

    			// 계시판 파일자료 삭제
				exec("rm -rf ./$board/$uid",$output);   	
    			//echo "rm -rf ./board/$board/$uid";
    		}

		} 

		// AJAX : 페이지 목록 이동 
		$url = "site_board.php"."?limit=$limit&searchkey=$search&board=".$board;    		
		echo "<script> location.replace('$url'); </script>";



	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>