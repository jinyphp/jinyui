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
			$query = "UPDATE `shop_bank` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);
		} else if($mode == "disable"){
			$query = "UPDATE `shop_bank` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($uid && $mode == "edit"){

			$query = "UPDATE `shop_bank` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

			$bankname = _formdata("bankname"); $query .= "`bankname`='$bankname' ,";

			$banknum = _formdata("banknum"); $query .= "`banknum`='$banknum' ,";
			$bankuser = _formdata("bankuser"); $query .= "`bankuser`='$bankuser' ,";
			$swiff = _formdata("swiff"); $query .= "`swiff`='$swiff' ,";

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

	

			if($bankname = _formdata("bankname")){
				$insert_filed .= "`bankname`,";
				$insert_value .= "'$bankname',";
			}

			if($banknum = _formdata("banknum")){
				$insert_filed .= "`banknum`,";
				$insert_value .= "'$banknum',";
			}

			if($bankuser = _formdata("bankuser")){
				$insert_filed .= "`bankuser`,";
				$insert_value .= "'$bankuser',";
			}

			if($swiff = _formdata("swiff")){
				$insert_filed .= "`swiff`,";
				$insert_value .= "'$swiff',";
			}

			if($descript = _formdata("descript")){
				$insert_filed .= "`descript`,";
				$descript = addslashes($descript);
				$insert_value .= "'$descript',";
			}


			$query = "INSERT INTO `shop_bank` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			//echo $query;

				

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_bank` WHERE `Id`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";



		}

		$url = "shop_bank.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>