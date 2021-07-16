<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	// update : 2016.01.22 = 페이스북 로그인
	// update : 2016.01.23 = 네이버 로그인
	// update : 2016.01.24 = sns table 및 처리
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

	$login_script = "<script>
		function login_submit(){
			var email = document.login.email.value;
			alert(\"login\");
			$.ajax({
           		url:'/ajax_signup.php',
           		type:'post',
           		data:$('form').serialize(),
           		success:function(data){
           			$('#mainbody').html(data);
           		}
       		});
		
		}
	</script>"; 

	if( isset($_COOKIE['cookie_email']) ){
		// 로그인 상태인 경우, myinfo 페이지로 이동
		$javascript = "<script>	
		</script>";

        $body = _skin_emptybody($skin_name);

        $_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        $body = str_replace("<!--{skin_emptybody}-->","
            <script>"._javascript_ajax_html("#mainbody","/ajax_myinfo.php?ajaxkey=".$ajaxkey)."</script>",$body);

        echo $body;


	} else {

		// $skin_name = "default";
		// $body = _skin_page($skin_name,"login");
		$body = _theme_page($site_env->theme,"login",$site_language,$site_mobile);

		//* 로그인 화면 출력
		$call = _formdata("call");
		$cate = _formdata("cate");

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		// $ajaxkey = _formdata("ajaxkey");

		$secure = _securekey_gen(6);
		$body=str_replace("{formstart}","<form name='login' method='post' enctype='multipart/form-data'> 
										<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='call' value='".$call."'>
					    				<input type='hidden' name='cate' value='".$cate."'>
					    				<input type='hidden' name='secure' value='".$secure."'>
					    				<input type='hidden' name='mode' value='login'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$body = str_replace("{email}","<input type='email' name='email' autofocus required id=\"input_login_email\">",$body);    
		$body = str_replace("{password}","<input type='password' name='password' required id=\"input_login_password\" >",$body);
		$body = str_replace("{secure}","<b>".$secure."</b>",$body);
		$body = str_replace("{secure_key}","<input type='text name='securekey' placeholder='상기 Secure 키를 입력해주세요' required id=\"input_login_securekey\" >",$body);
				
		$body = str_replace("{login_submit}","<input type='button' name='reg' value='Signin' onClick=\"javascript:login_submit()\" style=\"$css_btn_gray\">",$body);

		$body = str_replace("{member}","<a href='member.php'>New Register</a>",$body);
		$body = str_replace("{login}","",$body);


		$query = "select * from `site_sns` where name='naver'";
    	if( $sns = _mysqli_query_rows($query) ){
    		// SNS 계정 정보 읽어옴
    	}

    	if($sns->facebook){
    		//$facebook_id = "948775305217180";
			$facebook_javascript = "<script>

  				// This is called with the results from from FB.getLoginStatus().
  				function statusChangeCallback(response) {

    				// console.log('statusChangeCallback');
    				console.log(response);

    				// The response object is returned with a status field that lets the
    				// app know the current login status of the person.
    				// Full docs on the response object can be found in the documentation
    				// for FB.getLoginStatus().
    				if (response.status === 'connected') {
      					// Logged into your app and Facebook.
      					testAPI();

    				} else if (response.status === 'not_authorized') {
      					// The person is logged into Facebook, but not your app.
      					document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
    				} else {
      					// The person is not logged into Facebook, so we're not sure if
      					// they are logged into this app or not.
      					document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
    				}
  				}

  				// This function is called when someone finishes with the Login
  				// Button.  See the onlogin handler attached to it in the sample
  				// code below.
  				function checkLoginState() {
    				FB.getLoginStatus(function(response) {
      					statusChangeCallback(response);
    				});
  				}

  				function facebook_login(){
  					FB.login(function(response) {
  						if (response.status === 'connected') {
    						// Logged into your app and Facebook.
  							FB.api('/me',{local:'en_US',fields:'name,email'},function(response){
  								//alert(response.email);

								//console.log(response.email);
								//document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!' + ' / id: ' + response.id + ' / email : ' + response.email;
						
  								$.post('signup_facebook',{ email:response.email}, function(data){
  									$('#mainbody').html(data);
  								});
						


							});


    				
  						} else if (response.status === 'not_authorized') {
    						// The person is logged into Facebook, but not your app.
  						} else {
   							// The person is not logged into Facebook, so we're not sure if
    						// they are logged into this app or not.
  						}
					});
  				}


  				function facebook_logout(){
  					FB.logout(function(response) {
   						// Person is now logged out
					});
  				}


  				window.fbAsyncInit = function() {
  					FB.init({
    					appId      : '".$sns->facebook."',
    					cookie     : true,  // enable cookies to allow the server to access 
                        					// the session
    					xfbml      : true,  // parse social plugins on this page
    					version    : 'v2.2' // use version 2.2
  					});

  					// Now that we've initialized the JavaScript SDK, we call 
  					// FB.getLoginStatus().  This function gets the state of the
  					// person visiting this page and can return one of three states to
  					// the callback you provide.  They can be:
  					//
  					// 1. Logged into your app ('connected')
  					// 2. Logged into Facebook, but not your app ('not_authorized')
  					// 3. Not logged into Facebook and can't tell if they are logged into
  					//    your app or not.
  					//
  					// These three cases are handled in the callback function.

  					FB.getLoginStatus(function(response) {
    					statusChangeCallback(response);
  					});

  				};


  				// Load the SDK asynchronously
  				(function(d, s, id) {
    				var js, fjs = d.getElementsByTagName(s)[0];
	    			if (d.getElementById(id)) return;
	    			js = d.createElement(s); js.id = id;
    				js.src = '//connect.facebook.net/en_US/sdk.js';
    				fjs.parentNode.insertBefore(js, fjs);
  				}(document, 'script', 'facebook-jssdk'));


  				// Here we run a very simple test of the Graph API after login is
  				// successful.  See statusChangeCallback() for when this call is made.
  				function testAPI() {		
					FB.api('/me',{local:'en_US',fields:'name,email'},function(response){
						console.log(response.email);
						document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!' + ' / id: ' + response.id + ' / email : ' + response.email;
					});
  				}


			</script>";  

			$form_facebook = "<div style='background-color:#3b5998;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			if( isset($_COOKIE['cookie_email']) ){
				$form_facebook .= "<a href='#' onClick=\"javascript:facebook_logout()\" style=\"color:#ffffff;\">Facebook Login</a>";
			} else {
				$form_facebook .= "<a href='#' onClick=\"javascript:facebook_login()\" style=\"color:#ffffff;\">Facebook Login</a>";
			}		
			$form_facebook .= "</div>";
			$body = str_replace("{facebook}",$form_facebook,$body);

    	}  else {

    		$form_facebook = "<div style='background-color:#3b5998;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			$form_facebook .= "<a href='#' style=\"color:#ffffff;\">Facebook Login</a>";		
			$form_facebook .= "</div>";
			$body = str_replace("{facebook}",$form_facebook,$body);
    	}

 

   		if($sns->naver_client){
    		//# 네이버로그인 처리 파트
			// 상태토큰 생성 
			function generate_state(){
				$mt = microtime();
				$rand = mt_rand();
				return md5($mt.$rand);
			}

			$state = generate_state();
			$naver_javascript = "<script>
				function naver_login(){
					var url = \"https://nid.naver.com/oauth2.0/authorize?client_id=".$sns->naver_client."&response_type=code&redirect_uri=".$sns->naver_callback."&state=$state\";
					//window.open(url,'aaa','scrollbars=yes,toolbar=yes,resizable=yes,width=800,height=600,left=0,top=0'); 
					href.location(url); 			
				}
			</script>";

			// *******************************************************

			$url = "https://nid.naver.com/oauth2.0/authorize?client_id=".$sns->naver_client."&response_type=code&redirect_uri=".$sns->naver_callback."&state=$state";
			//echo $url."<br>";
			$form_naver = "<div style='background-color:#1ec800;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			// $form_naver .= "<a href='#' onClick=\"javascript:naver_login()\" style=\"color:#ffffff;\">Naver Login</a>";
			$form_naver .= "<a href='$url' style=\"color:#ffffff;\">Naver Login</a>";
			$form_naver .= "</div>";
			$body = str_replace("{naver}",$form_naver,$body);

		} else {
			$form_naver = "<div style='background-color:#1ec800;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			// $form_naver .= "<a href='#' onClick=\"javascript:naver_login()\" style=\"color:#ffffff;\">Naver Login</a>";
			$form_naver .= "<a href='#' style=\"color:#ffffff;\">Naver Login</a>";
			$form_naver .= "</div>";
			$body = str_replace("{naver}",$form_naver,$body);
		}
		

		/////////////////////////////////////////////////////////////////////////////////
		// Google+ Login
		// Google+
		if($sns->client){
			
			$google_client_id = "620607710617-1mgm9jtmsvo5m5g6c20notsnubmukj2g.apps.googleusercontent.com ";
	
	
			########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
			$google_client_id 		= $sns->client;
			$google_client_secret 	= $sns->secret;
			$google_redirect_url 	= $sns->google_redirect;
			$google_developer_key 	= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

			//include google api files
			require_once './lib/google-login-api/src/Google_Client.php';
			require_once './lib/google-login-api/src/contrib/Google_Oauth2Service.php';
	

			$gClient = new Google_Client();
			$gClient->setApplicationName('Login with saleshosting');
			$gClient->setClientId($google_client_id);
			$gClient->setClientSecret($google_client_secret);
			$gClient->setRedirectUri($google_redirect_url);
			$gClient->setDeveloperKey($google_developer_key);

			$google_oauthV2 = new Google_Oauth2Service($gClient);

			//If user wish to log out, we just unset Session variable
			if (isset($_REQUEST['reset'])) {
  		
  				if($_COOKIE[Session]) setcookie("Session",NULL,0,"/");
				if($_COOKIE[email]) setcookie("email",NULL,0,"/");  
  				if(!$_COOKIE[google]) setcookie("google",NULL,0,"/");
  		
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
	  			$user_id 				= $user['id'];
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
			
			// $body = str_replace("{google}","<a class='login' href='$authUrl'><img src='google-login-api/images/google-login-button.png'></a>",$body);
		
			$form_google = "<div style='background-color:#dd4b39;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			$form_google .= "<a class='login' href='$authUrl' style=\"color:#ffffff;\">Google Login</a>";
			$form_google .= "</div>";
			$body = str_replace("{google}",$form_google,$body);


		} else {
			$form_google = "<div style='background-color:#dd4b39;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			$form_google .= "<a href='#' style=\"color:#ffffff;\">Google Login</a>";
			$form_google .= "</div>";
			$body = str_replace("{google}",$form_google,$body);

		}


	
		

		if($sns->twitter){
			$form_twitter = "<div style='background-color:#55acee;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			$form_twitter .= "<a href='#' onClick=\"javascript:twitter_login()\" style=\"color:#ffffff;\">Twitter Login</a>";
			$form_twitter .= "</div>";
			$body = str_replace("{twitter}",$form_twitter,$body);

		} else {
			$form_twitter = "<div style='background-color:#55acee;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			$form_twitter .= "<a href='#' style=\"color:#ffffff;\">Twitter Login</a>";
			$form_twitter .= "</div>";
			$body = str_replace("{twitter}",$form_twitter,$body);

		}



		if($sns->kakao){
			$form_kakao = "<div style='background-color:#ffef3f;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			$form_kakao .= "<a href='#' onClick=\"javascript:kakao_login()\" style=\"color:#393939;\">Kakao Login</a>";
			$form_kakao .= "</div>";
			$body = str_replace("{kakao}",$form_kakao,$body);

		} else {
			$form_kakao = "<div style='background-color:#ffef3f;font-size:12px;padding:7px;text-decoration:none;border-radius:4px;'>";
			$form_kakao .= "<a href='#'  style=\"color:#393939;\">Kakao Login</a>";
			$form_kakao .= "</div>";
			$body = str_replace("{kakao}",$form_kakao,$body);

		} 

		echo $login_script.$facebook_javascript.$naver_javascript.$body;

	}

	

	


?>