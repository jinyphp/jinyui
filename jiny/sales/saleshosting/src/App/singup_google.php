<?php

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	// update : 2016.01.26 = 구글 로그인

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

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/coupon.php";
	include "./func/css.php";

	include "./func/members.php";

	$query = "select * from `site_sns` where name='naver'";
    if( $sns = _mysqli_query_rows($query) ){
    }		

	########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
	$google_client_id 		= $sns->client;
	$google_client_secret 	= $sns->secret;
	$google_redirect_url 	= $sns->google_redirect;
	$google_developer_key 	= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

	//include google api files
	require_once './lib/google-login-api/src/Google_Client.php';
	require_once './lib/google-login-api/src/contrib/Google_Oauth2Service.php';


	//********************************
		// Google+ Login
		
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to saleshosting');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);

		$google_oauthV2 = new Google_Oauth2Service($gClient);

		//If user wish to log out, we just unset Session variable
		if (isset($_REQUEST['reset'])) {
  		
  			unset($_SESSION['token']);
  			$gClient->revokeToken();
  			header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
		}

		//If code is empty, redirect user to google authentication page for code.
		//Code is required to aquire Access Token from google
		//Once we have access token, assign token to session variable
		//and we can redirect user back to page and login.
		if (isset($_GET['code'])) {
	 
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			return;
		}


		if (isset($_SESSION['token'])) { 
			$gClient->setAccessToken($_SESSION['token']);
		}


		if ($gClient->getAccessToken()) {
	
	 		//For logged in user, get details from google using access token
	  		$user 				= $google_oauthV2->userinfo->get();
	  		$user_id 			= $user['id'];
	  		$user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  		$email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	  		$profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  		$profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	  		$personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
	  		$_SESSION['token'] 	= $gClient->getAccessToken();
	
		} else {
			//For Guest user, get google login url
			$authUrl = $gClient->createAuthUrl();
		}
	
	
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
                
                $insert_filed .= "`type`,"; $insert_value .= "'naver',";
                $insert_filed .= "`lastname`,"; $insert_value .= "'".$user_name."',";
                
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
            setcookie("cookie_login","google",0,"/");
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

        	$body = _skin_emptybody($skin_name);

       		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        	// $body = str_replace("<!--{skin_emptybody}-->","<script>"._javascript_ajax_html("#mainbody","/ajax_myinfo.php?ajaxkey=".$ajaxkey)."</script>",$body);

        	$login_success_msg = " 로그인 성공 : 환영합니다.";
        	$body = str_replace("<!--{skin_emptybody}-->","<script>
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


        	</script>",$body);

        	echo $body;



        } else {
            $error_message = "죄송합니다. 회원가입 승인이 대기중입니다. ";
            echo "<script>
                    alert(\"$error_message\");
                    "._javascript_ajax_html("#mainbody","/ajax_login.php?ajaxkey=$ajaxkey")." 
            </script>";       
        }  





		/*
		if(isset($authUrl)){ //user is not logged in, show login button
			echo "<meta http-equiv='refresh' content='0; url=./login2.php'>";

		} else {
			// user logged in 

			$query = "SELECT COUNT(google_id) as usercount FROM `shop_member_$COUNTRY` WHERE google_id='$user_id'";
			echo "$query<br>";
			$user_exist = $mysqli->query($query)->fetch_object()->usercount; 
			if($user_exist){
				// echo 'Welcome back '.$user_name.'!';
				
				
			} else { 
			
				$query = "INSERT INTO `shop_member_$COUNTRY` (`regdate`, `email`, `username`, `lastlog`, `google_id`, `google_link`, `google_picture_link`) 
					VALUES ('$TODAYTIME', '$email', '$user_name', '$TODAYTIME', '$user_id', '$profile_url', '$profile_image_url')";
				// echo "$query<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
			
			}

			if(!$_COOKIE[Session]) setcookie("Session","login",0,"/");
		   	if(!$_COOKIE[email]) setcookie("email",$email,0,"/");
		   	if(!$_COOKIE[google]) setcookie("google","login",0,"/");
		  
		   	
		   	// echo "<meta http-equiv='refresh' content='0; url=./index.php'>";
			// echo '<br /><a class="logout" href="?reset=1">Logout</a>';
	
		}
		*/
	

?>

