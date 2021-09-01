<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	//*  세일즈호스팅 서비스 정보 표시

	// update : 2016.01.15 = 생성

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();	//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		$email = _formdata("email");
		


		if($mode == "disable"){
			$query = "UPDATE `site_members` SET `auth`='' WHERE `Id`='$uid'";
			_sales_query($query);	//echo $query."<br>";

		} else if($mode == "enable"){
			$query = "UPDATE `site_members` SET `auth`='on' WHERE `Id`='$uid'";
			_sales_query($query);	//echo $query."<br>";

		} else if($mode == "delete"){
			$query = "DELETE FROM `site_members` WHERE `Id`='$uid'";
    		_sales_query($query);	//echo $query."<br>";
    	
    	} else if($mode == "edit"){

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

					$emoney = _formdata("emoney"); $query .= "`emoney`='$emoney' ,";
					$point = _formdata("point"); $query .= "`point`='$point' ,";

					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					//echo $query;
					_sales_query($query);

				}
			}

		} else if($mode == "new"){
		
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

    	$url = "site_members.php"."?limit=$limit&searchkey=$search";    		
		echo "<script> location.replace('$url'); </script>";
	

	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>