<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	// update : 2016.01.25 = 수정편집 

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
		$list_num = _formdata("list_num");

		if($mode=="edit"){

			$query = "select * from `shop_delivery` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){
				// 수정모드
				$query = "UPDATE `shop_delivery` SET ";

				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

			
				if($code = _formdata("depature_country")) $query .= "`code`='$code' ,";
				if($target = _formdata("arrive_country")) $query .= "`target`='$target' ,";
				if($name = _formdata("title")) $query .= "`name`='$name' ,";
				if($charge = _formdata("ship_cost")) $query .= "`charge`='$charge' ,";

				if($manager = _formdata("manager")) $query .= "`manager`='$manager' ,";
				if($phone = _formdata("phone")) $query .= "`phone`='$phone' ,";

				if($check_country = _formdata("check_country")) $query .= "`check_country`='$check_country' ,";

				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				echo $query;
				_sales_query($query);

			}

			$url = "shop_shipping.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";


		} else if($mode=="new"){
				// 신규모드
				$insert_filed = "";
				$insert_value = "";
				
				if($enable = _formdata("enable")) {
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				if($code = _formdata("depature_country")) {
					$insert_filed .= "`code`,";
					$insert_value .= "'$code',";
				}

				if($target = _formdata("arrive_country")) {
					$insert_filed .= "`target`,";
					$insert_value .= "'$target',";
				}

				if($name = _formdata("title")) {
					$insert_filed .= "`name`,";
					$insert_value .= "'$name',";
				}

				if($charge = _formdata("ship_cost")) {
					$insert_filed .= "`charge`,";
					$insert_value .= "'$charge',";
				}

				if($manager = _formdata("manager")) {
					$insert_filed .= "`manager`,";
					$insert_value .= "'$manager',";
				}

				if($phone = _formdata("phone")) {
					$insert_filed .= "`phone`,";
					$insert_value .= "'$phone',";
				}

				if($check_country = _formdata("check_country")) {
					$insert_filed .= "`check_country`,";
					$insert_value .= "'$check_country',";
				}

		

				$query = "INSERT INTO `shop_delivery` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);
				
				$url = "shop_shipping.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_delivery` WHERE `Id`='$uid'";
				// echo $query."<br>";
			_sales_query($query);

			$url = "shop_shipping.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";
		}


		







	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>