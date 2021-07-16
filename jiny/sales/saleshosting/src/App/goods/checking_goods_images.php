<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  
	//*
	// update : 2016.01.04 = 코드정리 

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

	include "./func/error.php";
	include "./func/goods.php";
	include "./func/butten.php";
	include "./func/css.php";


	

	// include "./conf/sales.php";

	$query = "select * from `shop_goods` ";
	if($rowss = _mysqli_query_rowss($query)){
		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];
			/*
			$images1 = str_replace("./","/",$rows->images1);
			$query = "UPDATE `shop_goods` SET `images1` = '$images1' WHERE `Id` = '".$rows->Id."'";
			echo $query."<br>";
			_mysqli_query($query);

			$query1 = "INSERT INTO `shop_goods_images` (`regdate`,`enable`,`gid`,`type`,`images`) 
					VALUES ('".$rows->regdate."','on','".$rows->Id."','images','".$rows->images1."')";
			_mysqli_query($query1);
			*/

			$goodname = json_decode($rows->goodname)->$site_language;
			$query = "INSERT INTO `sales_goods` (`regdate`,`shop`,`name`,`prices_buy`,`prices_b2b`,`prices_sell`) 
					VALUES ('".$rows->regdate."','".$rows->Id."','".$goodname."','".$rows->prices_buy."','".$rows->prices_b2b."','".$rows->prices_sell."')";
		_mysqli_query($query);
		}	
	}




?>