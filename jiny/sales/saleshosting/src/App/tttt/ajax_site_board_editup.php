<?
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/members.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";


		$mode = _formmode();
		$uid = _formdata("uid");
		$board = _formdata("board");

		if(isset($_COOKIE['cookie_email'])) $email = $_COOKIE['cookie_email'];

		echo "mode = $mode, Board = $board, uid = $uid <br>";

	
		function _ajax_pagecall_script($url,$ajaxkey){
			
			echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
    			</script>";
    		
    	}		

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
    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}	


		if($mode == "delete"){
			$query = "select * from `site_board` where ref='$uid'";
			if($rows = _sales_query_rows($query)){
		   	} else {
		   		// 답변글이 없을 경우 계시판 삭제
		   		$query = "DELETE FROM `site_board` WHERE `Id`='$uid'";
    			_sales_query($query);
    		
    		}

    	} else if($mode == "reply"){

    		/*
    		$query = "UPDATE `site_board` SET ";

			$reply = _formdata("reply"); $query .= "`reply`='". addslashes($reply) ."' ,";

			$query .= "`reply_email`='". $email ."' ,";

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			echo $query."<br>";
			_sales_query($query);

			*/

			if($title = _formdata("title")){
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";
				
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				
					if($title = _formdata("title")){
						$insert_filed .= "`title`,";
						$insert_value .= "'$title',";
					}

					if($html = _formdata("html")){
						$insert_filed .= "`html`,";
						$insert_value .= "'". addslashes($html) ."',";
					}

					$insert_filed .= "`board`,";
					$insert_value .= "'$board',";

					$insert_filed .= "`email`,";	$insert_value .= "'$email',";


					$query = "select * from `site_board` where Id='$uid'";
					if($rows = _sales_query_rows($query)){
						$ref = $uid;
						$level = $rows->level + 1 ;
						$pos = $rows->pos;

						$query1 = "select * from `site_board` where pos>'$pos'";
						if($rowss1 = _sales_query_rowss($query)){
							for($i=0;$i<count($rowss1);$i++){
								$rows1 = $rowss1[$i];
								$pos1 = $rows1->pos +1;
								$query2 = "UPDATE `site_board` SET pos='$pos1' where Id='".$rows1->Id."'";
								_sales_query($query2);
							}
						}
					}
					$insert_filed .= "`ref`,";	$insert_value .= "'$ref',";
					$insert_filed .= "`level`,"; $insert_value .= "'$level',";
					$insert_filed .= "`pos`,";	$insert_value .= "'$pos',";

					$query = "INSERT INTO `site_board` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					echo $query."<br>";
					_sales_query($query);
			} else echo "글 제목이 없습니다."; 


		} else {
			$query = "select * from `site_board` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				
				if($title = _formdata("title")){
					$query = "UPDATE `site_board` SET ";

					$title = _formdata("title"); $query .= "`title`='$title' ,";
					$html = _formdata("html"); $query .= "`html`='". addslashes($html) ."' ,";

					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					echo $query."<br>";
					_sales_query($query);
				} else echo "글 제목이 없습니다."; 
								
			} else {
				//삽입 
				if($title = _formdata("title")){
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";
				
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				
					if($title = _formdata("title")){
						$insert_filed .= "`title`,";
						$insert_value .= "'$title',";
					}

					if($html = _formdata("html")){
						$insert_filed .= "`html`,";
						$insert_value .= "'". addslashes($html) ."',";
					}

					$insert_filed .= "`board`,";
					$insert_value .= "'$board',";

					$insert_filed .= "`email`,";	$insert_value .= "'$email',";


					$query = "select * from `site_board` where board='$board' order by pos desc";
					if($rows = _sales_query_rows($query)){
						$pos = $rows->pos + 1;
					}
					$insert_filed .= "`ref`,";	$insert_value .= "'0',";
					$insert_filed .= "`level`,";	$insert_value .= "'0',";
					$insert_filed .= "`pos`,";	$insert_value .= "'$pos',";

					$query = "INSERT INTO `site_board` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					echo $query."<br>";
					_sales_query($query);
				} else echo "글 제목이 없습니다."; 

			}	

		
		}

		/*
		echo "<script>
				$.ajax({
            		url:'/ajax_site_board.php?board=$board',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#site_edit').html(data);
            		}
        		});
    			</script>";
		*/


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>