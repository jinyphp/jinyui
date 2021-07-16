<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.18 = 코드정리 

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



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

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

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		echo "<script>"._javascript_ajax_html("#mainbody","/ajax_shop_bank.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>