<?php
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	$uid = _formdata("uid");
	$query = "select * from `shop_goods` where Id = '$uid'";
	if($rows = _mysqli_query_rows($query)){

    	$rows = explode(";",$rows->relation_goods);
    	for($i=0;$i<count($rows)-1;$i++){

			$rows1 = _goods_rows($rows[$i]);
			$goodname = _goods_name($rows1,$site_language);

			$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			$list .= "<tr><td><a href='detail.php?uid=".$rows1->Id."'><img src='".$rows1->images1."' border='0' width='180'></a></td></tr>";						
			$list .= "<tr><td style=\"font-size:12px;padding:10px;\"><a href='detail.php?uid=".$rows1->Id."'>$goodname</a></td></tr></table>";					
			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";	
    	}

    	echo $list;
    
    }

	/*

	if($uid = _formdata("uid")){
		//# 관련상품 출력처리
		$query = "select * from `shop_goods_relation` where GID = '$uid'";
		if($rowss = _mysqli_query_rowss($query)){
			for($list="",$i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$rows1 = _goods_rows($rows->RID);
				$goodname = _goods_name($rows1,$site_language);
				// $goodname = $rows1->goodname;

				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
				$list .= "<tr><td><a href='detail.php?uid=".$rows1->Id."'><img src='http://www.saleshosting.co.kr".$rows1->images1."' border='0' width='180'></a></td></tr>";						
				$list .= "<tr><td><a href='detail.php?uid=".$rows1->Id."'>$goodname</a></td></tr></table>";					
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";	
			}
			echo $list;
		} else {
			echo "관련상품이 없습니다.";
		}
	}
	*/



?>