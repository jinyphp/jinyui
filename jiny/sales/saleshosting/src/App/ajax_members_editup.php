<?php

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

	include "./func/members.php";

	$mode = _formmode();
    //echo "mode = $mode <br>";
	if( $mode == "regist"){

		$sex =_formdata("sex"); 
        $city = _formdata("city"); 
        $state = _formdata("state"); 
		$post = _formdata("post"); 
		$address = _formdata("address"); 
		$phone = _formdata("phone"); 
		$email = _formdata("email"); 

        $firstname = _formdata("firstname"); 
        $lastname = _formdata("lastname"); 

		$manager = _formdata("manager"); 
		$password = _formdata("password"); 
		$country1 = _formdata("country1"); 
		$language1 = _formdata("language1"); 

        $company = _formdata("company"); 
        $company_num = _formdata("company_num"); 
        $company_item = _formdata("company_item"); 
        $company_subject = _formdata("company_subject"); 




        $query = "select * from `site_members` where email='$email'";
        if( $rows = _mysqli_query_rows($query) ){
            $error_message = "중복된 이메일 주소 입니다."; 
            echo "<script>
                alert(\"$error_message\");  
                $.ajax({
                    url:'/ajax_members.php',
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#members').html(data);
                    }
                });
            </script>";
        } else {
            $query = "select * from `site_members_reserved` where email='$email'";
            if( $rows = _mysqli_query_rows($query) ){
                $error_message =  "예약된, 이메일 주소는 가입이 불가능 합니다.";
            echo "<script>
                alert(\"$error_message\");  
                $.ajax({
                    url:'/ajax_members.php',
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#members').html(data);
                    }
                });
            </script>";
            } else if(!$password){
                $error_message =  "페스워드가 없습니다.";
            echo "<script>
                alert(\"$error_message\");  
                $.ajax({
                    url:'/ajax_members.php',
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#members').html(data);
                    }
                });
            </script>";

            } else {
                    $TODAYTIME = date("Y-m-d H:i:s",time());
                    $domain = $_SERVER['HTTP_HOST'];
        
                    if(isset($_SESSION['http_ref'])) $http_ref = $_SESSION['http_ref']; else $http_ref = "";

                    $insert_filed .= "`regdate`,"; $insert_value .= "'".$TODAYTIME."',";

                    $insert_filed .= "`email`,"; $insert_value .= "'".$email."',";
                    $insert_filed .= "`password`,"; $insert_value .= "'".$password."',";
                    
                    $insert_filed .= "`firstname`,"; $insert_value .= "'".$firstname."',";
                    $insert_filed .= "`lastname`,"; $insert_value .= "'".$lastname."',";
                    $insert_filed .= "`username`,"; $insert_value .= "'".$lastname." ".$firstname."',";

                    $insert_filed .= "`userphone`,"; $insert_value .= "'".$phone."',";
                    $insert_filed .= "`sex`,"; $insert_value .= "'".$sex."',";

                    $insert_filed .= "`city`,"; $insert_value .= "'".$city."',";
                    $insert_filed .= "`state`,"; $insert_value .= "'".$state."',";

                    $insert_filed .= "`post`,"; $insert_value .= "'".$post."',";
                    $insert_filed .= "`address`,"; $insert_value .= "'".$address."',";
                    $insert_filed .= "`country`,"; $insert_value .= "'"._formdata("country1")."',";
                    $insert_filed .= "`language`,"; $insert_value .= "'"._formdata("language1")."',";
                    $insert_filed .= "`currency`,"; $insert_value .= "'".$currency."',";

                    $insert_filed .= "`company`,"; $insert_value .= "'".$company."',";
                    $insert_filed .= "`company_num`,"; $insert_value .= "'".$company_num."',";
                    $insert_filed .= "`company_item`,"; $insert_value .= "'".$company_item."',";
                    $insert_filed .= "`company_subject`,"; $insert_value .= "'".$company_subject."',";


                    $insert_filed .= "`lastlog`,"; $insert_value .= "'".$TODAYTIME."',";
                    $insert_filed .= "`domain`,"; $insert_value .= "'".$domain."',";

                    $insert_filed .= "`reseller`,"; $insert_value .= "'".$site_reseller."',";
                    

                    // 환경설정, 회원가입 축하 이머니 
                    if($site_env->members_emoeny){
                        $insert_filed .= "`emoney`,"; $insert_value .= "'".$site_env->members_emoeny."',";
                    }

                    // 환경설정, 회원가입 축하 포인트 
                    if($site_env->members_point){
                        $insert_filed .= "`point`,"; $insert_value .= "'".$site_env->members_point."',";
                    }

                    // 회원 자동 승인 체크 여부 
                    if($site_env->members_auth){
                        $insert_filed .= "`auth`,"; $insert_value .= "'".$site_env->members_auth."',";
                    }

                    $query = "INSERT INTO `site_members` ($insert_filed) VALUES ($insert_value)";
                    $query = str_replace(",)",")",$query);
                    //echo $query;
                    _mysqli_query($query);  

                   
                    // 회원 로그인 쿠키 생성
                        if(!isset($_COOKIE['cookie_Session'])) setcookie("cookie_Session","login",0,"/");
                        setcookie("cookie_email",$email,0,"/");
                           
                        // 마지막 접속 기록음 남김. 
                        // _member_lastlog($email);

                        // 
                        //회원가입 성공 AJAX 화면 전환
                        // 회원 가입 완료후, 성공 페이지 출력

                        $url = $site_env->afterlogin; // 회원 로그인 페이지로 이동
                        echo "<script>

                            $.ajax({
                                url:'$url',
                                type:'post',
                                data:$('form').serialize(),
                                success:function(data){
                                    $('.mainbody').html(data);
                                }
                            });

                            $.ajax({
                                url:'/ajax_header.php',
                                type:'post',
                                data:$('form').serialize(),
                                success:function(data){
                                    $('#header').html(data);
                                }
                            });

                            </script>";
                   
                    ///////////////////////////////////        

            }
        }


	} else if( $mode == "edit"){
        

        $email = $_COOKIE['cookie_email'];  
      
        $query = "UPDATE `site_members` SET ";
        if($password = _formdata("password")) $query .= "`password`='$password' ,";

        if($sex =_formdata("sex")) $query .= "`sex`='$sex' ,";
        if($city = _formdata("city")) $query .= "`city`='$city' ,";
        if($state = _formdata("state")) $query .= "`state`='$state' ,";
        if($post = _formdata("post")) $query .= "`post`='$post' ,";
        if($address = _formdata("address")) $query .= "`address`='$address' ,";
        if($phone = _formdata("phone")) $query .= "`userphone`='$phone' ,";
        

        if($firstname = _formdata("firstname")) $query .= "`firstname`='$firstname' ,";
        if($lastname = _formdata("lastname")) $query .= "`lastname`='$lastname' ,";

        if($manager = _formdata("manager")) $query .= "`username`='$manager' ,";
        if($country1 = _formdata("country1")) $query .= "`country`='$country1' ,";
        if($language1 = _formdata("language1")) $query .= "`language`='$language1' ,";

        if($company = _formdata("company")) $query .= "`company`='$company' ,";
        if($company_num = _formdata("company_num")) $query .= "`company_num`='$company_num' ,";
        if($company_item = _formdata("company_item")) $query .= "`company_item`='$company_item' ,";
        if($company_subject = _formdata("company_subject")) $query .= "`company_subject`='$company_subject' ,";

        if($bankname = _formdata("bankname")) $query .= "`bankname`='$bankname' ,";
        if($banknum = _formdata("banknum")) $query .= "`banknum`='$banknum' ,";
        if($bankuser = _formdata("bankuser")) $query .= "`bankuser`='$bankuser' ,";


        $query .= "WHERE `email`='$email'";
        $query = str_replace(",WHERE","WHERE",$query);
        echo $query;
        _mysqli_query($query);

        /*
        $msg = "정보수정";
        echo "<script>
                alert(\"$msg\");  
                $.ajax({
                    url:'/ajax_myinfo.php',
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#members').html(data);
                    }
                });
            </script>";
        */
		
	} else {
       echo "정상적인 회원 가입 요청이 아닙니다."; 
    }
	
?>
