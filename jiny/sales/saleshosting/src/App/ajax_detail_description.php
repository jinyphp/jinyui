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




	function _detail_load($filename){
		if(_is_file($filename)){
			$fp = fopen($filename, "r");
			$buffer = "";
		
			if($fp){
	    		while (!feof ($fp)) $buffer .= fgets($fp, 4096);
	    		fclose($fp);
	    		return $buffer;
			} else {
	    		echo "Can not open $filename.\n";
	    		fclose($fp);
	    		return "";
			}
		} else {
			return "설명 내용이 없습니다.";
		}
	}

	$uid = _formdata("uid");
	$filename = "./goods/".$uid."/detail.htm";
	
	// $body = _detail_load($filename);
	
	$query1 = "select * from `shop_goods_html` WHERE `goods`='$uid' and `language`='".$site_language."' ";
	if($site_mobile == "m") $query1 .= " and `mobile`='m'"; else $query1 .= " and `mobile`='pc'"; 
	// echo $query1;
	if($goods_rows = _mysqli_query_rows($query1)){
		$html = stripslashes($goods_rows->html);
	} else $html = "상품 설명이 없습니다.";

	echo $html;

?>