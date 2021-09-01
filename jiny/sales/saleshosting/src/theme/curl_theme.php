<?php
	// CURL Cross 처리

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");

	echo "Openshopping V2.1";
	//print_r($_POST);
	//print "</pr" . "e>\n";

	$mode = _formdata("mode");
	echo $mode."<br>";

	$filename = _formdata("filename");
	$theme = _formdata("theme");

	if($mode == "rename"){
		// 테마 이름 변경
		// 테마 폴더 변경
		$oldname = _formdata("oldname");
		$newname = _formdata("newname");

		$old_dir = $oldname;
		$new_dir = $newname;
		rename ($old_dir, $new_dir);

		$query = "UPDATE site_themefiles SET `theme`='$newname' where `theme`='$oldname' ";
		echo $query."<br>";
		_mysqli_query($query);

		$query = "UPDATE site_themefiles_html SET `theme`='$newname' where `theme`='$oldname' ";
		echo $query."<br>";
		_mysqli_query($query);


	} else if($mode == "html"){
		// 테마 html 파일 생성
		//# 언어별 , 테마페이지 저장 	
		$query = "select * from `site_language` ";
		if($rowss = _mysqli_query_rowss($query)){

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				// pc용 테마 저장
				$query1 = "select * from site_themefiles_html WHERE `filename`='$filename' and `language`='".$rows->code."' and mobile='pc'";
				echo $query1."<br>";			
				if($goods_rows = _mysqli_query_rows($query1)){
					$html = stripslashes($goods_rows->html);
					_is_path("./".$goods_rows->theme); // 저장 디렉토리 확인 및 디렉토리 생성 
					_file_save("./".$goods_rows->theme."/$filename.".$rows->code.".htm",$html);
				}

				// 모바일용 테마 저장
				$query1 = "select * from site_themefiles_html WHERE `filename`='$filename' and `language`='".$rows->code."' and mobile='m'";
				echo $query1."<br>";			
				if($goods_rows = _mysqli_query_rows($query1)){
					$html = stripslashes($goods_rows->html);
					_is_path("./".$goods_rows->theme); // 저장 디렉토리 확인 및 디렉토리 생성 
					_file_save("./".$goods_rows->theme."/$filename.".$rows->code.".m.htm",$html);
				}


			}
		}
	} else if($mode == "delete"){
		// 테마 html 파일 생성
		//# 언어별 , 테마페이지 저장 	
		$query = "select * from `site_language`";
		if($rowss = _mysqli_query_rowss($query)){

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];
				//echo "rm ./".$theme."/$filename.".$rows->code.".htm";

				exec("rm ./".$theme."/$filename.".$rows->code.".htm",$output);
				exec("rm ./".$theme."/$filename.".$rows->code.".m.htm",$output);

			}
		}

	} else if($mode == "upload"){
		// 테마 폴더가 없는 경우 폴더 생성
		if(!is_dir($theme)) mkdir($theme);

		$filename = _formdata("filename");
		$uploaddir = realpath('./') . '/';
		$uploadfile = $uploaddir."$theme/". basename($filename);

		if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	    	echo "파일 업로드 성공.\n";
		} else {
	    	echo "업로드 실패!\n";
		}	
		
	} else if($mode == "files"){
		echo "curl files update...<br>";

		// 테이블 내용 복사
		// insert into `site_themefiles_html`( filename,theme ) select filename,'aaaa' from `site_themefiles_html` where theme='default';

		$query = "select * from site_themefiles where theme = '$theme' ";
		if($rows = _mysqli_query_rows($query)){
			$themefiles_json = json_encode($rows);
			_file_save("./$theme.json",$themefiles_json);
		}
			
		$query = "select * from site_themefiles_html where theme = '$theme' ";
		echo $query."<br>";
			
		// 테마 폴더가 없는 경우 폴더 생성
		if(!is_dir($theme)) mkdir($theme);

		if($rowss = _mysqli_query_rowss($query)){
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];
				echo $rows->filename."<br>";

				$div = stripslashes($rows->html);
				_file_save("./$theme/".$rows->filename.".".$rows->language.".".$rows->mobile.".htm",$div);
				// ******
			}
		}
			

	} else if($mode == "copy"){
		echo "Theme Copying... <br>";

		// 테마 폴더가 없는 경우 폴더 생성
		if(!is_dir($theme."_copy")) mkdir($theme."_copy");

		// 테마 코드 복사
		$query = "select * from site_theme where theme = '$theme' ";
		if($rows = _mysqli_query_rows($query)){
			$query = "INSERT INTO site_theme (`regdate`,`enable`,`theme`,`title`,`description`,`width`,`align`,`bgcolor`,
								`header`,`footer`,`menu_code`,`menu_code_login`,`index`) 
							VALUES ('$TODAYTIME','on','".$theme."_copy"."','".$rows->title."','".addslashes($rows->description)."','".$rows->width."','".$rows->align."','".$rows->bgcolor."',
								'".$rows->header."','".$rows->footer."','".$rows->menu_code."','".$rows->menu_code_login."','".$rows->index."')";
			_mysqli_query($query);

			$themefiles_json = json_encode($rows);
			_file_save("./$theme"."_copy".".json",$themefiles_json);
		}

		// 테마 파일목록 복사
		$query = "select * from site_themefiles where theme = '$theme' ";
		if($rowss = _mysqli_query_rowss($query)){
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$query = "INSERT INTO site_themefiles (`regdate`,`enable`,`theme`,`filename`,`comment`,`width`,`align`,`bgcolor`,`header`,`footer`,`menu`) 
					VALUES ('$TODAYTIME','on','$theme"."_copy"."','".$rows->filename."','".$rows->comment."','".$rows->width."','".$rows->align."','".$rows->bgcolor."','on','on','on')";
				echo $query."<br>";
				$insert_id = _mysqli_insert($query);



		// 테마 실제 파일 복사
		$query1 = "select * from site_themefiles_html where theme = '$theme' and pid = '".$rows->Id."'";
		echo $query1."<br>";	
		if($files_rowss = _mysqli_query_rowss($query1)){
			for($j=0;$j<count($files_rowss);$j++){
				$files_rows = $files_rowss[$j];
				echo $files_rows->filename."<br>";

				$div = stripslashes($files_rows->html);
				_file_save("./$theme"."_copy"."/".$files_rows->filename.".".$files_rows->language.".".$files_rows->mobile.".htm",$div);
				// ******

				$query = "INSERT INTO site_themefiles_html (`pid`,`theme`,`language`,`mobile`,`filename`,`html`,`title`,`keyword`,`description`,`width`,`bgcolor`,`align`) 
						VALUES ('".$insert_id."','$theme"."_copy"."','".$files_rows->language."','".$files_rows->mobile."','".$files_rows->filename."','".$files_rows->html."','".$files_rows->seo_title."','".$files_rows->seo_keyword."','".$files_rows->seo_description."','".$files_rows->width."','".$files_rows->bgcolor."','".$files_rows->align."')";
				echo $query."<br>";
				_mysqli_query($query);

			}
		}






			}
		}		




		
	}


	



				

				

					

	
?>