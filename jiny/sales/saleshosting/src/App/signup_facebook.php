<?php
	// Openshopping V2.1
	// Program by : hojin lee

	// Facebook callback
	// 2016.01.25

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

	include "./func/curl.php";
	include "./func/members.php";


	//echo "--- facebook login ---  <br>";
	//print_r($_POST);

	$query = "select * from `site_sns` where name='naver'";
    if( $sns = _mysqli_query_rows($query) ){
    } 

    $email = _formdata("email");

    //********************************************************************************
    // 회원 로그인 처리

    		if(_is_members($email)){
        		$rows = _members_rows($email);

        	} else {
        		// 신규 회원 가입 처리 

        		$TODAYTIME = date("Y-m-d H:i:s",time());
                $domain = $_SERVER['HTTP_HOST'];

                $insert_filed .= "`regdate`,"; $insert_value .= "'".$TODAYTIME."',";
                $insert_filed .= "`email`,"; $insert_value .= "'".$email."',";
                
                $insert_filed .= "`type`,"; $insert_value .= "'facebook',";
                $insert_filed .= "`lastname`,"; $insert_value .= "'".$lastname."',";
                
                $insert_filed .= "`sex`,"; $insert_value .= "'".$sex."',";

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
               // echo $query;
                _mysqli_query($query);  

                $rows = _members_rows($email);
        	                  
    		}


    		//********************************************************************************


    $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        if($rows->auth == 'on'){
                    
            if(!isset($_COOKIE['cookie_Session'])) setcookie("cookie_Session","login",0,"/");
            setcookie("cookie_login","facebook",0,"/");
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

            
            // ****************
            $javascript = "<script>	
			</script>";

        	//$body = _skin_emptybody($skin_name);

       		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        	// $body = str_replace("<!--{skin_emptybody}-->","<script>"._javascript_ajax_html("#mainbody","/ajax_myinfo.php?ajaxkey=".$ajaxkey)."</script>",$body);

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



        } else {
            $error_message = "죄송합니다. 회원가입 승인이 대기중입니다. ";
            echo "<script>
                    alert(\"$error_message\");
                    "._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")." 
            </script>";       
        }  


?>