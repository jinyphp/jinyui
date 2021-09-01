<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  
	//*
	// update : 2016.01.04 = 코드정리 

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
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

	echo "goods cate test <br>";
	$query = "select * from `shop_goods` ";
	if($rowss = _sales_query_rowss($query)){
		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];
			
			
			$cate = "";
			$categories = explode(";", $rows->cate);
			for($j=0;$j<count($categories)-1;$j++){
				$cate .= "*".str_replace("*", "", $categories[$j]).";";
			}
			echo "$i ".$cate."<br>";

			$query = "UPDATE `shop_goods` SET `cate`='$cate' WHERE `Id`=".$rows->Id;
			_sales_query($query);
			
		}	
	} 




?>