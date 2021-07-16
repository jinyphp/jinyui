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

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		echo "<script>"._javascript_ajax_html("#mainbody","/ajax_shop_payment.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>