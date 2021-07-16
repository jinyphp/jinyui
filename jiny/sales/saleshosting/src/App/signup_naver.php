<?php
	// Openshopping V2.1
	// Program by : hojin lee

	// Naver Login callback
	// 2016.01.24

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

	//print_r($_POST);
	//print_r($_GET);

	//echo "--- callback --- <br>";
	//echo "--- 접근 토큰 요청 --- <br>";

	/*
	// saleshosting
	$client_id = "EoM6JC2xW28CmLMBMdn5";
	$client_secret = "yNw9oT4wwN";
	*/

	// dojangshop
	$client_id = "eePurwqdKc3PWEikw9xd";
	$client_secret = "P8RUOYAWBY";

	$query = "select * from `site_sns` where name='naver'";
    if( $sns = _mysqli_query_rows($query) ){
    }  

	$url = "https://nid.naver.com/oauth2.0/token?client_id=".$sns->naver_client."&client_secret=".$sns->naver_secret."&grant_type=authorization_code&state=".$_GET['state']."&code=".$_GET['code'];
	$response = curl_get($url);
	//echo $response."<br>";


	$token = json_decode($response);
	if($token->access_token){

		//echo "--- 프로필 정보 조회 --- <br>";
		//echo "access_token : ".$token->access_token."<br>";
		$url = "https://openapi.naver.com/v1/nid/getUserProfile.xml";
		$tokenArr = array( 'Authorization: '.$token->token_type.' '.$token->access_token );
		//print_r($tokenArr);

		$agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)"; 
    	
    	$ch = curl_init(); 
    
    	curl_setopt ($ch, CURLOPT_URL,             $url);
    	curl_setopt ($ch, CURLOPT_HTTPHEADER,	   $tokenArr);
    	
    	curl_setopt ($ch, CURLOPT_RETURNTRANSFER,  1); 
    	curl_setopt ($ch, CURLOPT_POST,            0); 
    	curl_setopt ($ch, CURLOPT_USERAGENT,       $agent); 
    	curl_setopt ($ch, CURLOPT_REFERER,         ""); 
    	curl_setopt ($ch, CURLOPT_TIMEOUT,         3); 

    	$buffer = curl_exec($ch); 
    	$cinfo = curl_getinfo($ch); 
    	curl_close($ch); 

    	if ($cinfo['http_code'] != 200){ 
       		echo "Error 200<br>";
       		echo "네이버 회원 프로필을 읽어올 수 없습니다.<br>";
       		return ""; 
    	} else {
    		$xml = simplexml_load_string($buffer);

			//echo "<br>--- xml --- <br>";
			//print_r($xml);

			//echo "<br>";
			//echo "email : ".$xml->response->email."<br>";
			$email = $xml->response->email;

			//echo "nickname : ".$xml->response->nickname."<br>";
			$lastname = $xml->response->nickname;

			//echo "age : ".$xml->response->age."<br>";
			//echo "birth : ".$xml->response->birthday."<br>";

			//echo "gender : ".$xml->response->gender."<br>";
			if($xml->response->gender == "M") $sex = "man"; else if($xml->response->gender == "W") $sex = "Woman"; else $sex = "Business";

			//echo "profImg : ".$xml->response->profile_image."<br>";
	
    		//echo $buffer;    

    		//echo "<br>--- logout --- <br>";

    		//$naver_logout_url = "https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=".$sns->client_id."&client_secret=".$sns->client_secret."&access_token=".$token->access_token."&service_provider=NAVER";

    		//echo "<a href='$naver_logout_url '>logout</a>";   
    
    		//echo "<a href='http://nid.naver.com/nidlogin.logout?returl=http://www.saleshosting.co.kr'>logout site</a>";

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
    	}

	} else {
		echo "Error : 네이버 Openapi 접속 오류.";
	}



    
    	$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
        if($rows->auth == 'on'){
                    
            if(!isset($_COOKIE['cookie_Session'])) setcookie("cookie_Session","login",0,"/");
            setcookie("cookie_login","naver",0,"/");
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

    

?>