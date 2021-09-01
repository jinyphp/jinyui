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
    if($mode == "auth"){
    	// 승인

    	if($email = _formdata("email")){

            $query = "UPDATE `resales_shop` SET ";
            $query .= "`auth`='on' ,";
            $query .= "WHERE `email`='$email'";
            $query = str_replace(",WHERE","WHERE",$query);
            echo $query."<br>";
            _mysqli_query($query);


		} else {
			echo "판매자 이메일 주소가 없습니다.";
		}

    } else if($mode == "disauth"){
    	if($email = _formdata("email")){

            $query = "UPDATE `resales_shop` SET ";
            $query .= "`auth`='' ,";
            $query .= "WHERE `email`='$email'";
            $query = str_replace(",WHERE","WHERE",$query);
            echo $query."<br>";
            _mysqli_query($query);


        } else {
            echo "판매자 이메일 주소가 없습니다.";
        }

    }
    

?>