<?php

	@session_start();

	include "./conf/dbinfo.php";

	include "./func/mysql.php";
	include "./func/file.php";
	include "./func/form.php";

    $email = _formdata("email");
    if(filter_var($email,FILTER_VALIDATE_EMAIL) == "" ){
        echo "정확한 형태의 회원 이메일 주소를 입력해 주세요.";
        echo "<script>$('#email_check').val(\"false\");</script>";
    } else {
        $query = "select * from `site_members` where email='$email'";
        if( $rows = _mysqli_query_rows($query) ){
            echo "이미 가입된 중복 이메일 입니다.";
            echo "<script>$('#email_check').val(\"false\");</script>";
        } else  {
            $query = "select * from `site_members_reserved` where email='$email'";
            if( $rows = _mysqli_query_rows($query) ){
                echo "예약된, 이메일 주소는 가입이 불가능 합니다.";
                echo "<script>$('#email_check').val(\"false\");</script>";
            } else {
                echo "회원 가입 가능한 이메일 입니다.";
                echo "<script>$('#email_check').val(\"true\");</script>";
            }    
        }
    }
	
?>
