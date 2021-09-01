<?
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

	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// $cookie_email = _cookie_email();
		// $members = _members_rows($cookie_email);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");

		if($mode == "enable"){
			$query = "UPDATE site_css SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);

			$url = "site_css.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "disable"){
			$query = "UPDATE site_css SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

			$url = "site_css.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "save"){

			// CUTL POST 처리
			$_POST['mode'] = "save";
			$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
			$curl_return = _curl_post("http://".$sales_db->domain."/css/curl_css.php",$_POST);

			// echo $curl_return;
			// 페이지 이동 
			$url = "site_css.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
			

		} else if($uid && $mode == "edit"){

			$query = "UPDATE `site_css` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
			$title = _formdata("title"); $query .= "`title`='$title' ,";
			$code = _formdata("code"); $query .= "`code`='$code' ,";

			$css = _formdata("css"); $query .= "`css`='".$css."' ,";

			if($check_title = _formdata("check_title")) $query .= "`check_title`='on' ,"; else $query .= "`check_title`='' ,";
			$tag = _formdata("tag"); $query .= "`tag`='".$tag."' ,";

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			echo $query;
			_sales_query($query);

			// 페이지 이동 
			$url = "site_css.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
		
		} else if($mode == "new"){

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";
				$insert_value .= "'on',";
			}

			if($title = _formdata("title")){
				$insert_filed .= "`title`,";
				$insert_value .= "'$title',";
			}

			if($code = _formdata("code")){
				$insert_filed .= "`code`,";
				$insert_value .= "'$code',";
			}

			if($css = _formdata("css")){
				$insert_filed .= "`css`,";
				$insert_value .= "'".$css."',";
			}

			if($check_title = _formdata("check_title")){
				$insert_filed .= "`check_title`,";
				$insert_value .= "'on',";
			}

			if($tag = _formdata("tag")){
				$insert_filed .= "`tag`,";
				$insert_value .= "'".$tag."',";
			}

			$query = "INSERT INTO `site_css` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			echo $query;

			// 페이지 이동 
			$url = "site_css.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "delete"){
			$query = "DELETE FROM `site_css` WHERE `Id`='$uid'";
    		_sales_query($query);

    		// 페이지 이동 
			$url = "site_css.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
		   
		} else if($mode == "upload"){

		}

			
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>