<?php
	// CURL Cross 처리

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";


	
	echo "OpenSales V2.1 API<br>";

	$mode = _formdata("mode");
	if($mode == "remove"){
		$file = _formdata("file");
		if(_is_file($file)){
			_file_delete($file);
		}

	} else if($mode == "upload"){
		$uploaddir = realpath('./') . '/';
		$uploadfile = $uploaddir . $_POST['path']."/". basename($_FILES['file_contents']['name']);
		echo "uploadfile : $uploadfile <br>";
		echo '<pre>';


		if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	    	echo "File is valid, and was successfully uploaded.\n";
		} else {
	    	echo "Possible file upload attack!\n";
		}
		echo 'Here is some more debugging info:';
		print_r($_FILES);
		echo "\n<hr />\n";
		print_r($_POST);
		print "</pr" . "e>\n";
	}

	
	
?>