<?
	// ============== 
	// CURL Pages 처리
	// 2016.03.25

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/conf/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");

	echo "<br>SALESHosting API<br>";

	if($adminkey = _formdata("adminkey")){
		$query = "select * from `site_env`";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
			if($rows->adminkey == $adminkey){

				// ====== CURL 접속 체크 성공 ======

				$mode = _formdata("mode");
				echo "curl mode: $mode<br>";
				if($mode == "check_delete"){
					// 선택한 항목을 삭제합니다.
					//echo "선택한 항목을 삭제합니다. <br>"; 
					$uid = explode(";", _formdata("uid"));
					for($i=0;$i<count($uid)-1;$i++){
						$query = "select * from `site_pages` WHERE `Id`='".$uid[$i]."'";
						//echo $query."<br>";
						if($pages_rows = _mysqli_query_rows($query)){	
							$query = "DELETE FROM `site_pages` WHERE `Id`='".$uid[$i]."'";
    						_mysqli_query($query);
		    				//echo $query."<br>";

		    				$query = "DELETE FROM `site_pages_html` WHERE `code`='".$pages_rows->code."'";
    						_mysqli_query($query);
    						//echo $query."<br>";

    						$query = "DELETE FROM `site_pages_files` WHERE `code`='".$pages_rows->code."'";
    						_mysqli_query($query);
    						//echo $query."<br>";

    						// pages 디렉토리 삭제
    						exec("rm -rf ./".$pages_rows->code,$output);

						}
					}

				} else if($mode == "upload"){
					// 페이지 코드 디렉토리 생성
					$code = _formdata("code");
					if(!is_dir("./".$code)) mkdir("./".$code);

					$filename = _formdata("filename");
					$uploaddir = realpath('./') . '/';
					$uploadfile = $uploaddir."$code/". basename($filename);

					if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	    				echo "파일 업로드 성공.\n";
					} else {
	    				echo "업로드 실패!\n";
					}

					$query = "INSERT INTO `site_pages_files` (`code`,`files`) VALUES ('$code','$filename')";
					//echo $query."<br>";
					_mysqli_query($query);					

				} else if($mode == "new"){
					//echo "신규생성 <br>";			

					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";

					if($enable = _formdata("enable")){
						$insert_filed .= "`enable`,";
						$insert_value .= "'on',";
					}

					if($title = _formdata("title")){
						$insert_filed .= "`title`,";
						$insert_value .= "'$title',";
					}

					if($code = _formdata("code")){
						$insert_filed .= "`code`,";
						$insert_value .= "'$code',";
					}

					if($width = _formdata("width")){
						$insert_filed .= "`width`,";
						$insert_value .= "'$width',";
					}

					if($align = _formdata("align")){
						$insert_filed .= "`align`,";
						$insert_value .= "'$align',";
					}

					if($bgcolor = _formdata("bgcolor")){
						$insert_filed .= "`bgcolor`,";
						$insert_value .= "'$bgcolor',";
					}

					if($header = _formdata("header")){
						$insert_filed .= "`header`,";
						$insert_value .= "'on',";
					}

					if($footer = _formdata("footer")){
						$insert_filed .= "`footer`,";
						$insert_value .= "'on',";
					}

					if($menu = _formdata("menu")){
						$insert_filed .= "`menu`,";
						$insert_value .= "'on',";
					}

					// ++ 서브메뉴 
					if($sub_menu = _formdata("sub_menu")){
						$insert_filed .= "`sub_menu`,";
						$insert_value .= "'on',";
					}

					if($sub_align = _formdata("sub_align")){
						$insert_filed .= "`sub_align`,";
						$insert_value .= "'$sub_align',";
					}

					if($sub_width = _formdata("sub_width")){
						$insert_filed .= "`sub_width`,";
						$insert_value .= "'$sub_width',";
					}

					if($title_enable = _formdata("title_enable")){
						$insert_filed .= "`title_enable`,";
						$insert_value .= "'on',";
					}


					$query = "INSERT INTO `site_pages` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					$iid = _mysqli_insert($query);
					//echo $query."<br>";

					// 언어별 HTML 파일 저장
					if(!is_dir("./".$code)) mkdir("./".$code);
					$query1 = "select * from `site_language`";
					if($rowss1 = _mysqli_query_rowss($query1)){
						for($i=0;$i<count($rowss1);$i++){
							$rows1 = $rowss1[$i];

							$seo_title = _formdata("title_".$rows1->code);
							$seo_keyword = _formdata("keyword_".$rows1->code);
							$seo_description = _formdata("description_".$rows1->code);

							$desktop =  addslashes( _formdata($rows1->code) );
							_file_save("./$code/page.".$rows1->code.".htm",_formdata($rows1->code));

							$query = "INSERT INTO `site_pages_html` (`regdate`,`enable`,`code`,`language`,`mobile`,`html`,`title`,`keyword`,`description`) 
							VALUES ('$TODAYTIME','on','$code','".$rows1->code."','pc','$desktop','$seo_title','$seo_keyword','$seo_description')";
							_mysqli_query($query);
							echo $query."<br>";

							$mobile =  addslashes( _formdata($rows1->code."_m") );
							_file_save("./$code/page.".$rows1->code.".m.htm",_formdata($rows1->code."_m"));

							$query = "INSERT INTO `site_pages_html` (`regdate`,`enable`,`code`,`language`,`mobile`,`html`,`title`,`keyword`,`description`) 
							VALUES ('$TODAYTIME','on','$code','".$rows1->code."','m','$mobile','$seo_title','$seo_keyword','$seo_description')";
							_mysqli_query($query);
							echo $query."<br>";
						}
					}

					// 수정한 page목록을 json 형태로 저장함.
					$query = "select * from `site_pages` WHERE `Id`='".$iid."'";
					//echo $query."<br>";
					if($rows = _mysqli_query_rows($query)){
						$json = json_encode($rows);
						_file_save("./$code/$code.json", $json);
					}


				

				} else if($mode == "edit"){
					// page 내용 수정
					$uid = _formdata("uid");
					$query = "select * from `site_pages` WHERE `Id`='".$uid."'";
					//echo $query."<br>";
					if($pages_rows = _mysqli_query_rows($query)){
						
						// 페이지 목록 수정
						$query = "UPDATE `site_pages` SET ";
						if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
						if($title = _formdata("title")) $query .= "`title`='$title' ,";
						if($code = _formdata("code")) $query .= "`code`='$code' ,";
						if($header = _formdata("header")) $query .= "`header`='on' ,"; else $query .= "`header`='' ,";
						if($footer = _formdata("footer")) $query .= "`footer`='on' ,"; else $query .= "`footer`='' ,";
						if($menu = _formdata("menu")) $query .= "`menu`='on' ,"; else $query .= "`menu`='' ,";
						if($width = _formdata("width")) $query .= "`width`='$width' ,";
						if($align = _formdata("align")) $query .= "`align`='$align' ,";
						if($bgcolor = _formdata("bgcolor")) $query .= "`bgcolor`='$bgcolor' ,";
						// ++ 서브메뉴 
						if($sub_menu = _formdata("sub_menu")) $query .= "`sub_menu`='$sub_menu' ,";
						if($sub_align = _formdata("sub_align")) $query .= "`sub_align`='$sub_align' ,";
						if($sub_width = _formdata("sub_width")) $query .= "`sub_width`='$sub_width' ,";

						if($title_enable = _formdata("title_enable")) $query .= "`title_enable`='on' ,"; else $query .= "`title_enable`='' ,";

						$query .= "WHERE `Id`='$uid'";
						$query = str_replace(",WHERE","WHERE",$query);	//echo $query."<br>";
						//echo $query."<br>";
						_mysqli_query($query);


						if($pages_rows->code != $code){
							// 페이지 코드가 변경한 경우, 폴더 이름을 변경
							rename ($pages_rows->code, $code);
						}

						// 언어별 페이지 저장
						if(!is_dir("./".$code)) mkdir("./".$code);
						$query1 = "select * from `site_language`";
						if($rowss1 = _mysqli_query_rowss($query1)){
							for($i=0;$i<count($rowss1);$i++){
								$rows1 = $rowss1[$i];

								$seo_title = _formdata("title_".$rows1->code);
								$seo_keyword = _formdata("keyword_".$rows1->code);
								$seo_description = _formdata("description_".$rows1->code);

								$desktop =  addslashes( _formdata($rows1->code) );
								_file_save("./$code/$code.".$rows1->code.".htm", _formdata($rows1->code));

								$query = "UPDATE `site_pages_html` SET  `code`='$code', `html` = '$desktop', `title` = '$seo_title',`keyword` = '$seo_keyword', `description` = '$seo_description' 
									where `code`='".$pages_rows->code."' and `language`='".$rows1->code."' and `mobile`='pc'";
								//echo $query."<br>";
								_mysqli_query($query);

								$mobile =  addslashes( _formdata($rows1->code."_m") );
								_file_save("./$code/$code.".$rows1->code.".m.htm", _formdata($rows1->code."_m"));

								$query = "UPDATE `site_pages_html` SET  `code`='$code', `html` = '$mobile', `title` = '$seo_title',`keyword` = '$seo_keyword', `description` = '$seo_description' 
									where `code`='".$pages_rows->code."' and `language`='".$rows1->code."' and `mobile`='m'";
								//echo $query."<br>";
								_mysqli_query($query);
							}
						}

						// 수정한 page목록을 json 형태로 저장함.
						$query = "select * from `site_pages` WHERE `Id`='".$uid."'";
						//echo $query."<br>";
						if($rows = _mysqli_query_rows($query)){
							$json = json_encode($rows);
							_file_save("./$code/$code.json", $json);
						}

					}
					

				} else if($mode == "remove"){
					// 관련 이미지를 삭제합니다.
					$img = _formdata("img");
					$query = "select * from site_pages_files where Id = '$img'"; 
    				// echo $query;
					if($rows = _mysqli_query_rows($query)){
						unlink("./".$rows->code."/".$rows->files);

						$query = "DELETE FROM site_pages_files WHERE `Id`='".$img."'";
    					_mysqli_query($query);
    					//echo $query."<br>";
					}					

				}	




				// =============================

			} else {
				echo "비정상 접속! adminkey 값이 일치하지 않습니다. 해당 접속IP를 차단합니다. 해제방법은 관리자에게 문의 바랍니다. <br>";
			}

		} else {
			echo "site_env 환경 설정값을 읽어올수 없습니다. <br>";
		}
	} else {
		echo "adminkey 값이 없습니다. <br>";
	}

	

	
?>