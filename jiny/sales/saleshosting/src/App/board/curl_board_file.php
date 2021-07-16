<?php
	// CURL Cross 처리

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/conf/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	
	//echo "OpenSales V2.1 API<br>";
	$mode = _formdata("mode");
	
	//echo "curl Mode : $mode <br>";

	if($mode == "rmdir"){
		// $code = _formdata("code");

		// exec("rm -rf ./$code",$output);  

	} else if($mode == "remove"){
		$file = _formdata("file");
		//echo "file checking : ".".".$file;
		if( file_exists(".".$file) ){
			//echo "remove : ";
			//echo ".".$file;
			unlink(".".$file);
		} else {
			echo "Error! files is not exits. can not delete this. .$file <br>";
		}

	} else if($mode == "upload"){
		
		//
		// 요청한 파일을 업로드 합니다.

		$uploaddir = realpath('./') . '/';	// 업로드 파일의 절대 경로를 구함
		$uploadfile = $uploaddir . $_POST['path']."/". basename($_FILES['file_contents']['name']);
		//echo "uploadfile : $uploadfile <br>";
		//echo '<pre>';


		if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	    	//echo "File is valid, and was successfully uploaded.\n";
		} else {
	    	///echo "Possible file upload attack!\n";
		}
		//echo 'Here is some more debugging info:';
		//print_r($_FILES);
		//echo "\n<hr />\n";
		//print_r($_POST);
		//print "</pr" . "e>\n";
	}

	
	
?>