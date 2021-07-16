<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.18 = 코드정리 

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



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode();
		$uid = _formdata("uid");

		
		if($mode == "enable"){
			$query = "UPDATE `service_server` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);
		} else if($mode == "disable"){
			$query = "UPDATE `service_server` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($uid && $mode == "edit"){

			$query = "UPDATE `service_server` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

			$reseller = _formdata("reseller"); $query .= "`reseller`='$reseller' ,";
			$name = _formdata("name"); $query .= "`name`='$name' ,";

			$host = _formdata("host"); $query .= "`host`='$host' ,";
			$ip = _formdata("ip"); $query .= "`ip`='$ip' ,";
			$dbname = _formdata("dbname"); $query .= "`dbname`='$dbname' ,";

			$root = _formdata("root"); $query .= "`root`='$root' ,";
			$password = _formdata("password"); $query .= "`password`='$password' ,";

			$location = _formdata("location"); $query .= "`location`='$location' ,";
			$user_id = _formdata("user_id"); $query .= "`user_id`='$user_id' ,";
			$user_password = _formdata("user_password"); $query .= "`user_password`='$user_password' ,";

			$description = _formdata("description"); $query .= "`description`='".addslashes( $description)."' ,";

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			echo $query;
			_sales_query($query);

			
		} else if($mode == "new"){

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";
				$insert_value .= "'on',";
			}

	

			if($reseller = _formdata("reseller")){
				$insert_filed .= "`reseller`,";
				$insert_value .= "'$reseller',";
			}

			if($name = _formdata("name")){
				$insert_filed .= "`name`,";
				$insert_value .= "'$name',";
			}

			if($host = _formdata("host")){
				$insert_filed .= "`host`,";
				$insert_value .= "'$host',";
			}

			if($ip = _formdata("ip")){
				$insert_filed .= "`ip`,";
				$insert_value .= "'$ip',";
			}

			if($dbname = _formdata("dbname")){
				$insert_filed .= "`dbname`,";
				$insert_value .= "'$dbname',";
			}

			if($root = _formdata("root")){
				$insert_filed .= "`root`,";
				$insert_value .= "'$root',";
			}

			if($password = _formdata("password")){
				$insert_filed .= "`password`,";
				$insert_value .= "'$password',";
			}

			if($location = _formdata("location")){
				$insert_filed .= "`location`,";
				$insert_value .= "'$location',";
			}

			if($user_id = _formdata("user_id")){
				$insert_filed .= "`user_id`,";
				$insert_value .= "'$user_id',";
			}

			if($user_password = _formdata("user_password")){
				$insert_filed .= "`user_password`,";
				$insert_value .= "'$user_password',";
			}

			if($descript = _formdata("descript")){
				$insert_filed .= "`descript`,";
				$descript = addslashes($descript);
				$insert_value .= "'$descript',";
			}


			$query = "INSERT INTO `service_server` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			//echo $query;

				

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `service_server` WHERE `Id`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";



		}

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		echo "<script>"._javascript_ajax_html("#mainbody","/ajax_service_server.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>