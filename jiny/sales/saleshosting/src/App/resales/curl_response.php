<?
	@session_start();
    
    include "../conf/dbinfo.php";
    include "../func/mysql.php";

    include "../func/datetime.php";
    include "../func/file.php";
    include "../func/form.php";
    include "../func/string.php";
    include "../func/javascript.php";

	// CURL : 응답처리
	
	// 입점관리 등답
	// 전송방식 POST 데이터

    echo "<br>CURL_RESPONSE<br>";

    $mode = _formmode();
    echo "mode = $mode <br>";
    if($mode == "new_seller"){
    	// 신규 판매자 등록

    	if($email = _formdata("email")){

    		$insert_filed = "";	$insert_value = "";				
			$insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAYTIME."',";
			$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";

			$query = "INSERT INTO `shop_seller` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_mysqli_query($query);
			echo $query;
		
		} else {
			echo "판매자 이메일 주소가 없습니다.";
		}

    }

    /*
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
	*/
	
?>