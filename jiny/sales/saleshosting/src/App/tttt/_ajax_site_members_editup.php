<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	//*  세일즈호스팅 서비스 정보 표시

	// update : 2016.01.15 = 생성

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

	include "./func/css.php";

	include "./func/error.php";
	include "./func/goods.php";
	include "./func/members.php";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$email = _formdata("email");
		

		
	

    	function _form_uploadfile($formname,$filename){
    		if($_FILES[$formname]['tmp_name']){
    			// 파일 확장자 검사
    			
    			$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    			else {
    				if($filename == ""){
    					// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {
    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}

		if($mode == "disable"){
			$query = "UPDATE `site_members` SET `auth`='' WHERE `Id`='$uid'";
			_sales_query($query);
		} else if($mode == "enable"){
			$query = "UPDATE `site_members` SET `auth`='on' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "delete"){
			$query = "DELETE FROM `site_pages` WHERE `Id`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";

		    $query = "DELETE FROM `site_pages_html` WHERE `pid`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";

			// _ajax_pagecall_script("/ajax_shop_goods.php",_formdata("ajaxkey"));

		} else {
		
			$query = "select * from `site_members` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				// 이메일 중복여부 체크
				$query1 = "select * from `site_members` where email='$email'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query1)){
					echo "이미 가입, 중복된 이메일 입니다.";
				} else {
					$query = "UPDATE `site_members` SET ";
					if($enable = _formdata("enable")) $query .= "`auth`='on' ,"; else $query .= "`auth`='' ,";

					$email = _formdata("email"); $query .= "`email`='$email' ,";
					$password = _formdata("password"); $query .= "`password`='$password' ,";

					$manager = _formdata("manager"); $query .= "`username`='$manager' ,";
					$firstname = _formdata("firstname"); $query .= "`firstname`='$firstname' ,";

					$phone = _formdata("phone"); $query .= "`userphone`='$phone' ,";

					$sex = _formdata("sex"); $query .= "`sex`='$sex' ,";
					$post = _formdata("post"); $query .= "`post`='$post' ,";
					$address = _formdata("address"); $query .= "`address`='$address' ,";

					$country = _formdata("members_country"); $query .= "`country`='$country' ,";
					$language = _formdata("members_language"); $query .= "`language`='$language' ,";

					$discount = _formdata("discount"); $query .= "`discount`='$discount' ,";

					$city = _formdata("city"); $query .= "`city`='$city' ,";
					$state = _formdata("state"); $query .= "`state`='$state' ,";

					$regref = _formdata("regref"); $query .= "`regref`='$regref' ,";

					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					//echo $query;
					_sales_query($query);

				}
			} else {
				// 삽입 
				$query1 = "select * from `site_members` where email='$email'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query1)){
					echo "이미 가입, 중복된 이메일 입니다.";
				} else {
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";

					if($enable = _formdata("enable")){
						$insert_filed .= "`auth`,";
						$insert_value .= "'on',";
					}

					if($email = _formdata("email")){
						$insert_filed .= "`email`,";
						$insert_value .= "'$email',";
					}

					if($password = _formdata("password")){
						$insert_filed .= "`password`,";
						$insert_value .= "'$password',";
					}

					if($manager = _formdata("manager")){
						$insert_filed .= "`username`,";
						$insert_value .= "'$manager',";
					}

					if($firstname = _formdata("firstname")){
						$insert_filed .= "`firstname`,";
						$insert_value .= "'$dirstname',";
					}

					if($phone = _formdata("phone")){
						$insert_filed .= "`userphone`,";
						$insert_value .= "'$userphone',";
					}

					if($sex = _formdata("sex")){
						$insert_filed .= "`sex`,";
						$insert_value .= "'$sex',";
					}

					if($post = _formdata("post")){
						$insert_filed .= "`post`,";
						$insert_value .= "'$post',";
					}

					if($address = _formdata("address")){
						$insert_filed .= "`address`,";
						$insert_value .= "'$address',";
					}

					if($country = _formdata("members_country")){
						$insert_filed .= "`country`,";
						$insert_value .= "'$country',";
					}

					if($language = _formdata("members_language")){
						$insert_filed .= "`language`,";
						$insert_value .= "'$language',";
					}

					if($discount = _formdata("discount")){
						$insert_filed .= "`discount`,";
						$insert_value .= "'$discount',";
					}

					if($city = _formdata("city")){
						$insert_filed .= "`city`,";
						$insert_value .= "'$city',";
					}

					if($state = _formdata("state")){
						$insert_filed .= "`state`,";
						$insert_value .= "'$state',";
					}

					if($regref = _formdata("refref")){
						$insert_filed .= "`regref`,";
						$insert_value .= "'$regref',";
					}

					$query = "INSERT INTO `site_members` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);
				}	
			}	

		}

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		echo "<script>"._javascript_ajax_html("#mainbody","/ajax_site_members.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";
    		
	

	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>