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

		$domain = _formdata("domain");
		$client_id = _formdata("client_id");
		$client_secret = _formdata("client_secret");
		$callback = _formdata("callback");
		$facebook = _formdata("facebook");
		

		
		if($mode == "disable"){
			$query = "UPDATE `site_sns` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);	//echo $query."<br>";

		} else if($mode == "enable"){
			$query = "UPDATE `site_sns` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);	//echo $query."<br>";

		} else if($mode == "delete"){
			$query = "select * from `site_sns` where Id='$uid'";
		
			if($rows = _sales_query_rows($query)){
				$query = "DELETE FROM `site_sns` WHERE Id='".$uid."'";
    			_sales_query($query);   	//echo $query."<br>";
    		}
		} else {

			if($enable = _formdata("enable")) $enable = "on"; else $enable = "";	
			$black_email = _formdata("email");
			$black_description = _formdata("description");

			$query = "select * from `site_sns` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				$query = "UPDATE `site_sns` SET  `enable`='$enable' ,`domain`='$domain' ,`client_id`='$client_id' ,`client_secret`='$client_secret', `callback`='$callback',
								`facebook`='$facebook' where Id='".$uid."'";
				_sales_query($query);
			} else {
				$query = "INSERT INTO `site_sns` (`regdate`,`enable`,`domain`,`client_id`,`client_secret`,`callback`,`facebook`) 
										VALUES ('$TODAYTIME','$enable','".$domain."','".$client_id."','".$client_secret."','".$callback."','".$facebook."')";
				_sales_query($query);
			}

		}

		$url = "site_sns.php"."?limit=$limit&searchkey=$search";    		
		echo "<script> location.replace('$url'); </script>";
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>