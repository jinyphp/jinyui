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

    		// 입점 판매자 목록 
    		$query = "select * from `service_resales` where email='$email'";
            echo $query;
    		if($rows = _mysqli_query_rows($query)){


                $query1 = "select * from `service_resales` where email='$email'";
                echo $query1;
                if($rows1 = _mysqli_query_rows($query1)){
                    echo "중복 등록";
                } else {

                    $insert_filed = "";	$insert_value = "";				
				    $insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAYTIME."',";
				    $insert_filed .= "`email`,";	$insert_value .= "'".$email."',";

				    $insert_filed .= "`name`,";	$insert_value .= "'".$rows->name."',";
				    $insert_filed .= "`domain`,";	$insert_value .= "'".$rows->domain."',";



				    $query = "INSERT INTO `resales_seller` ($insert_filed) VALUES ($insert_value)";
				    $query = str_replace(",)",")",$query);
				    _mysqli_query($query);
				    echo $query;
                }
		
			}


		} else {
			echo "판매자 이메일 주소가 없습니다.";
		}

    } else if($mode == "update"){
    	if($email = _formdata("email")){

    	} else {
			echo "판매자 이메일 주소가 없습니다.";
		}

    }
    

?>