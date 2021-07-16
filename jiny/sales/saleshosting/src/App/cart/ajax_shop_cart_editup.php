<?php
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
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();	echo "mode = ".$mode;

		$uid = _formdata("uid");		
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("lis_tnum");
	
		
		

		if($mode == "check_delete"){
			// 체크상품 모두 비황성화
			if($TID = $_POST['TID']){
				for($i=0,$amount=0;$i<count($TID);$i++){
					$query = "DELETE FROM `shop_cart` WHERE `Id`=".$TID[$i];	// echo $query."<br>";
					_sales_query($query);
				}
			}			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_cart` WHERE `Id`='$uid'";	// echo $query."<br>";
    		_sales_query($query);

			// 관련상품 연결부분 삭제
			$url = "shop_cart.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";
		
		} else if($mode == "edit"){
			$prices = _formdata("prices");	
			$num = _formdata("num");	
			$query = "UPDATE `shop_cart` SET `prices`='$prices' , `num`='$num' WHERE `Id`='$uid'";
			_sales_query($query);


			// 관련상품 연결부분 삭제
			$url = "shop_cart.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";
		} 
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>