<?php

    //*  OpenShopping V2.1
    //*  Program by : hojin lee
    //*  2016.01.11 
    //*


    // update : 2016.01.11 = 코드정리 

    @session_start();
    
    include "./conf/dbinfo.php";
    include "./func/mysql.php";

    include "./func/datetime.php";
    include "./func/file.php";
    include "./func/form.php";
    include "./func/string.php";
    include "./func/javascript.php";
    
    include "./func/mobile.php";
    include "./func/language.php";
    include "./func/country.php";

    include "./func/site.php";  // 사이트 환경 설정

    include "./func/layout.php";
    include "./func/header.php";
    include "./func/footer.php";
    include "./func/menu.php";
    include "./func/category.php";
    include "./func/skin.php";

    include "./func/css.php";
    include "./func/error.php"; 
    include "./func/members.php";
  


    //********** Ajax Process **********
    //echo "section : ".$_SESSION['ajaxkey']."<br>";
    //echo "ajaxkey : "._formdata("ajaxkey")."<br>";
    $ajaxkey = _formdata("ajaxkey");
    if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
	
        $mode = _formmode();
        $cookie_email = _cookie_email();
        if(!$cookie_email && $mode == "login" ){
            if($email = _formdata("email"));
            $password = _formdata("password");

            if($email && $password){

    			if(_is_members($email)){
                    $rows = _members_rows($email);
                    if( $email == $rows->email && $password == $rows->password ){
                        if($rows->auth == 'on'){
                    
                           if(!isset($_COOKIE['cookie_Session'])) setcookie("cookie_Session","login",0,"/");
                           setcookie("cookie_login","self",0,"/");
                           setcookie("cookie_email",$rows->email,0,"/");
                           
                           // 마지막 접속 기록음 남김. 
                           _member_lastlog($email);

                            
                            // $menu_code = _menu_code();
                            if($site_env->menu_code_login){
                                $menu_code = $site_env->menu_code_login;
                            } else {
                                // 기본 메뉴값이 없는 경우, default로 처리
                                if($site_env->menu_code){
                                    $menu_code = $site_env->menu_code;
                                } else $menu_code = "default";
                            }
                           $menu_data = "/data/menu_".$menu_code.".".$site_language.".data";


                           if($site_env->afterlogin){
                                $afterlogin = $site_env->afterlogin;
                           } else $afterlogin = "/ajax_myinfo.php";
                    
                            $login_success_msg = " 로그인 성공 : 환영합니다.";
                            echo "<script>
                                alert(\"$login_success_msg\");

                                "._javascript_ajax_html("#mainbody","$afterlogin?ajaxkey=$ajaxkey")."                                 

                              
                                $.ajax({
                                url:'/ajax_header.php',
                                type:'post',
                                data:$('form').serialize(),
                                success:function(data){
                                    $('#header').html(data);
                                }
                                });

                                // 메뉴 갱신
                                 $.ajax({
                                url:'/ajax_menu.php',
                                type:'post',
                                data:$('form').serialize(),
                                success:function(data){
                                    $('#menu').html(data);
                                }
                                });


                            </script>";
                         

                            // echo "<meta http-equiv='refresh' content='0; url=myinfo.php'>"; 

                        } else {
                            $error_message = "죄송합니다. 회원가입 승인이 대기중입니다. ";
                           // _ajax_alert(".mainbody","/ajax_login.php",$error_message)
                           
                            echo "<script>
                                alert(\"$error_message\");
                                "._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")." 
                            </script>";
                         
                        
                        }
                    } else {
                        $error_message = "오류! 비밀번호가 일치하지 않습니다.";
                        // _ajax_alert(".mainbody","/ajax_login.php",$error_message)
                      
                        echo "<script>
                                alert(\"$error_message\");
                                "._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")." 
                            </script>"; 
                    
                    }
                } else {
                    $error_message =  "회원 정보를 찾을 수 없습니다.";
                   // _ajax_alert(".mainbody","/ajax_login.php",$error_message)
                 
                    echo "<script>
                                alert(\"$error_message\");
                                "._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")." 
                            </script>"; 
                      
                }

            } else if(!$email) {
                $error_message = "오류! 이메일 주소가 없습니다.";
               // _ajax_alert(".mainbody","/ajax_login.php",$error_message)
              
                echo "<script>
                                alert(\"$error_message\");
                                "._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")."
                            </script>"; 
                        
            } else if(!$password) {
                $error_message = "오류! 암호가 입력되지 않습니다.";	
                //_ajax_alert(".mainbody","/ajax_login.php",$error_message)
             
                echo "<script>
                                alert(\"$error_message\");
                                "._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")." 
                            </script>";
                       
            }

        } else {
            $skin_name = "default";
            $body = _skin_page($skin_name,"error");
        
            $msg = "오류. 정상적인 로그인 접속을 해주세요.";
            $body = str_replace("{error_message}",$msg,$body);
            echo $body;
        }

    } else {
        $body = _skin_page($skin_name,"error");
        
        $msg = "오류. ajax_singup 페이지 접근 보안키값이 일치하지 않습니다.";
        $body = str_replace("<!--{error_message}-->",$msg,$body);
        echo $body; 
    }

?>

