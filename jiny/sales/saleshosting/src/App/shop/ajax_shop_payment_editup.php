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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");

		
		if($mode == "enable"){
			$query = "UPDATE `shop_payment` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);
		} else if($mode == "disable"){
			$query = "UPDATE `shop_payment` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($uid && $mode == "edit"){

			$query = "UPDATE `shop_payment` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
			if($test = _formdata("test")) $query .= "`test`='on' ,"; else $query .= "`test`='' ,";

			$code = _formdata("code"); $query .= "`code`='$code' ,";
			$payment = _formdata("payment"); $query .= "`payment`='$payment' ,";

			$pg_id = _formdata("pg_id"); $query .= "`pg_id`='$pg_id' ,";
			$pg_password = _formdata("pg_password"); $query .= "`pg_password`='$pg_password' ,";
			$pg_key = _formdata("pg_key"); $query .= "`pg_key`='$pg_key' ,";

			$pg_url = _formdata("pg_url"); $query .= "`pg_url`='$pg_url' ,";
			$pg_url_test = _formdata("pg_url_test"); $query .= "`pg_url_test`='$pg_url_test' ,";
			

			$descript = _formdata("descript"); $query .= "`descript`='".addslashes( $descript)."' ,";

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

			if($test = _formdata("test")){
				$insert_filed .= "`test`,";
				$insert_value .= "'on',";
			}

			if($code = _formdata("code")){
				$insert_filed .= "`code`,";
				$insert_value .= "'$code',";
			}

			if($payment = _formdata("payment")){
				$insert_filed .= "`payment`,";
				$insert_value .= "'$payment',";
			}

			if($pg_id = _formdata("pg_id")){
				$insert_filed .= "`pg_id`,";
				$insert_value .= "'$pg_id',";
			}

			if($pg_password = _formdata("pg_password")){
				$insert_filed .= "`pg_password`,";
				$insert_value .= "'$pg_password',";
			}

			if($pg_key = _formdata("pg_key")){
				$insert_filed .= "`pg_key`,";
				$insert_value .= "'$pg_key',";
			}

			if($pg_url = _formdata("pg_url")){
				$insert_filed .= "`pg_url`,";
				$insert_value .= "'$pg_url',";
			}

			if($pg_url_test = _formdata("pg_url_test")){
				$insert_filed .= "`pg_url_test`,";
				$insert_value .= "'$pg_url_test',";
			}
			

			if($descript = _formdata("descript")){
				$insert_filed .= "`descript`,";
				$descript = addslashes($descript);
				$insert_value .= "'$descript',";
			}


			$query = "INSERT INTO `shop_payment` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			//echo $query;

				

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_payment` WHERE `Id`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";



		}

		$url = "shop_payment.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>