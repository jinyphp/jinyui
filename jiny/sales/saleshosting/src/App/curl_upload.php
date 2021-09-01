<?php

	// CURL: Server
	// 전송된 파일을 업로드 합니다.
	echo "Openshopping V2.1 API";
	
	$uploaddir = realpath('./') . '/';
	$uploadfile = $uploaddir . $_POST['path']."/". basename($_FILES['file_contents']['name']);

	if($_POST['mode'] == "upload"){
		unlink($uploadfile);
		echo $uploadfile."<br>";
		
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

	} else if($_POST['mode'] == "delete"){

		unlink($uploadfile);

	}
	
	
?>