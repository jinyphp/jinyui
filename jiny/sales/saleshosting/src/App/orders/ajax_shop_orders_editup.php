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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");




	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$email = _formdata("email");
		$limit = _formdata("limit");
		$status = _formdata("status");


		if($mode == "delete"){
			$query = "select * from `shop_orders` where Id='$uid'";
			if($rows = _sales_query_rows($query)){

				$query = "DELETE FROM `shop_orders` WHERE `Id`='$uid'";
    			_sales_query($query);
		    	//echo $query."<br>";

		    	$query = "DELETE FROM `shop_orders_detail` WHERE `cartlog`='".$rows->cartlog."'";
    			_sales_query($query);
		    	//echo $query."<br>";

		    	$url = "shop_orders.php?limit=$limit&searchkey=$search&ajaxkey=ajaxkey";    		
				echo "<script> location.replace('$url'); </script>";
    		}
		

		} else {
		
			$company = _formmode("shipping_company");
			$regdate = _formmode("shipping_regdate");
			$invoice = _formmode("shipping_invoice");
			$firstname = _formmode("shipping_firstname");
			$lastname = _formmode("shipping_lastname");
			$phone = _formmode("shipping_phone");

			$query = "select * from `shop_orders` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				$query = "UPDATE `shop_orders` SET `status`='".$status."' WHERE `Id`='$uid'";
				echo $query."<br>";
				_sales_query($query);

				$query = "UPDATE `shop_orders_detail` SET `status`='".$status."' WHERE `ordercode`='".$rows->ordercode."'";
				echo $query."<br>";
				_sales_query($query);

				// 주문 배송 정보 입력
				$query = "select * from `shop_orders_shipping` where ordercode='".$rows->ordercode."'";
				if($rows = _sales_query_rows($query)){
					$query = "UPDATE `shop_orders_shipping` SET `invoice`='".$invoice."',`company`='".$company."',`regdate`='".$regdate."',
								`firstname`='".$firstname."',`lastname`='".$lastname."',`phone`='".$phone."' WHERE `ordercode`='".$rows->ordercode."'";
				echo $query."<br>";
				_sales_query($query);
				} else {
					$query ="INSERT INTO `shop_orders_shipping` (`regdate`,`ordercode`,`email`,`invoice`,`company`,`firstname`,`lastname`,`phone`) 
									VALUES ('".$TODAYTIME."','".$rows->ordercode."','".$rows->email."','".$invoice."','".$company."','".$firstname."','".$lastname."','".$phone."')";
					_sales_query($query);
				}
					
			}
			
			$url = "shop_orders_edit.php?uid=$uid&limit=$limit&searchkey=$search&ajaxkey=ajaxkey";    		
			echo "<script> location.replace('$url'); </script>";
			

		}

		
		
		

	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>