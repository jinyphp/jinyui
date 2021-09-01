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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		$uid = _formdata("uid");

		
		if($mode == "enable"){
			$query = "UPDATE `shop_currency` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);
		} else if($mode == "disable"){
			$query = "UPDATE `shop_currency` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($uid && $mode == "edit"){

			$query = "UPDATE `shop_currency` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

			$currency = _formdata("currency"); $query .= "`currency`='$currency' ,";

			$currencyid = _formdata("currencyid"); $query .= "`currencyid`='$currencyid' ,";
			$currencyname = _formdata("currencyname"); $query .= "`name`='$currencyname' ,";
			$currency_align = _formdata("currency_align"); $query .= "`currency_align`='$currency_align' ,";

			$currency_mark = _formdata("currency_mark"); $query .= "`currency_mark`='$currency_mark' ,";
			$currency_rate = _formdata("currency_rate"); $query .= "`currency_rate`='$currency_rate' ,";
			$dec_point = _formdata("dec_point"); $query .= "`dec_point`='$dec_point' ,";


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

	

			if($currency = _formdata("currency")){
				$insert_filed .= "`currency`,";
				$insert_value .= "'$currency',";
			}

			if($currencyid = _formdata("currencyid")){
				$insert_filed .= "`currencyid`,";
				$insert_value .= "'$currencyid',";
			}

			if($currencyname = _formdata("currencyname")){
				$insert_filed .= "`name`,";
				$insert_value .= "'$currencyname',";
			}

			if($currency_align = _formdata("currency_align")){
				$insert_filed .= "`currency_align`,";
				$insert_value .= "'$currency_align',";
			}

			if($currency_mark = _formdata("currency_mark")){
				$insert_filed .= "`currency_mark`,";
				$insert_value .= "'$currency_mark',";
			}

			if($currency_rate = _formdata("currency_rate")){
				$insert_filed .= "`currency_rate`,";
				$insert_value .= "'$currency_rate',";
			}

			if($dec_point = _formdata("dec_point")){
				$insert_filed .= "`dec_point`,";
				$insert_value .= "'$dec_point',";
			}

	


			$query = "INSERT INTO `shop_currency` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			//echo $query;

				

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_currency` WHERE `Id`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";



		}

		$url = "shop_currency.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>