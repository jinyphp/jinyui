<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.18 = 코드정리 

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");


	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hoosting.php");



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

		$mode = _formmode();	// echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		
		if($mode == "enable"){
			$query = "UPDATE service.server SET `enable`='on' WHERE `Id`='$uid'";
			_mysqli_query($query);
		} else if($mode == "disable"){
			$query = "UPDATE service.server SET `enable`='' WHERE `Id`='$uid'";
			_mysqli_query($query);

		} else if($uid && $mode == "edit"){

			$query = "UPDATE service.server SET ";
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
			_mysqli_query($query);

			
		} else if($mode == "new"){

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAY',";

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


			$query = "INSERT INTO service.server ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_mysqli_query($query);
			//echo $query;

				

			

		} else if($mode == "delete"){
			$query = "DELETE FROM service.server WHERE `Id`='$uid'";
    		_mysqli_query($query);
		    //echo $query."<br>";



		}

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		$url = "service_server.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>