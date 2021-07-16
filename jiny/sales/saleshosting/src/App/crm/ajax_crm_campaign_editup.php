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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");
	

	// 환경설정 읽어보기
	require_once ($_SERVER['DOCUMENT_ROOT']."/crm/crm_campaign.cfg.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// POST키값을 기준으로 변수 = 값 지정.
		$arr = array_keys($_POST);
		for($i=0;$i<count( $arr );$i++){
			$key_name = $arr[$i];
			${$key_name} = _formdata($key_name);		
		}

		$mode = _formdata("mode");

		if($mode == "enable"){
			$query = "UPDATE $_tableName SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE $_tableName SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "delete"){
			
			$query = "DELETE FROM $_tableName WHERE `Id`='$uid'";
    		_sales_query($query);    		
		
		} else if($mode == "edit"){
	
			$query = "select * from $_tableName where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 				
				$query = "UPDATE $_tableName SET ";

				require_once("inc.form_editup.php");

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query."<br>";
				_sales_query($query);

				
			}

			$url = $_tableName.".php"."?limit=$limit&searchkey=$search&list_num=".$list_num."&plan=".$plan;    		
			echo "<script> location.replace('$url'); </script>";			
		
		} else if($mode == "new"){
			// 삽입

			require_once("inc.form_newup.php");			

			$query = "INSERT INTO $_tableName ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_sales_query($query);
		
		}

		$url = $_tableName.".php"."?limit=$limit&searchkey=$search&list_num=".$list_num."&plan=".$plan;    		
		//echo "<script> location.replace('$url'); </script>";	
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>