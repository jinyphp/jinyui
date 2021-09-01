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

	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");



		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");		

		if($uid && $mode == "edit"){

			$query = "UPDATE `site_env` SET ";
		
			$align = _formdata("align"); $query .= "`align`='$align' ,";
			$width = _formdata("width"); $query .= "`width`='$width' ,";
			$bgcolor = _formdata("bgcolor"); $query .= "`bgcolor`='$bgcolor' ,";
			$left_margin = _formdata("left_margin"); $query .= "`left_margin`='$left_margin' ,";
			$top_margin = _formdata("top_margin"); $query .= "`top_margin`='$top_margin' ,";

			// $html = _formdata("html"); $query .= "`html`='".addslashes($html)."' ,";


			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			//echo $query;
			_sales_query($query);

			$url = "site_layout.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";
		
		} 
		/*
		else if($mode == "new"){

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";
				$insert_value .= "'on',";
			}

			if($title = _formdata("domain")){
				$insert_filed .= "`domain`,";
				$insert_value .= "'$domain',";
			}

			if($code = _formdata("code")){
				$insert_filed .= "`code`,";
				$insert_value .= "'$code',";
			}

			if($html = _formdata("html")){
				$insert_filed .= "`html`,";
				$insert_value .= "'". addslashes($html)."',";
			}

			$query = "INSERT INTO `site_layout` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			//echo $query;

		} else if($mode == "delete"){
			$query = "DELETE FROM `site_layout` WHERE `Id`='$uid'";
    		_sales_query($query);
		   
		} else if($mode == "upload"){

		}

		_ajax_pagecall_script("/ajax_site_layout.php",_formdata("ajaxkey"));
		*/

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>