<?

	//*  OpenShopping V2.1
	//*  programing by hojin lee

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

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

	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");


	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		//include "./sales.php";

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$reseller = $_COOKIE['cookie_email'];	


		$mode = _formmode();	// echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");
		$limit = _formdata("limit");

		if($mode == "enable"){
			$query = "UPDATE service.hosting_plan SET `enable`='on' WHERE Id =$uid";
			_mysqli_query($query);

		} else if($mode == "disable"){
			
			$query = "UPDATE service.hosting_plan SET `enable`='' WHERE Id =$uid";
			_mysqli_query($query);

		} else if($mode=="edit"){

			$query = "select * from `service_products` WHERE Id =$uid";
			if($rows = _mysqli_query_rows($query)){
				// 수정모드
				$query = "UPDATE service.hosting_plan SET ";

				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

				$query .= "`reseller`='$reseller' ,";
				if($title = _formdata("title")) $query .= "`title`='$title' ,";

				if($shop = _formdata("shop")) $query .= "`shop`='$shop' ,";
				if($site = _formdata("site")) $query .= "`site`='$site' ,";
				if($sales = _formdata("sales")) $query .= "`sales`='$sales' ,";
				if($company = _formdata("company")) $query .= "`company`='$company' ,";
				if($business = _formdata("business")) $query .= "`business`='$business' ,";
				if($trans = _formdata("trans")) $query .= "`trans`='$trans' ,";
				if($house = _formdata("house")) $query .= "`house`='$house' ,";
				if($manager = _formdata("manager")) $query .= "`manager`='$manager' ,";
				if($quotation = _formdata("quotation")) $query .= "`quotation`='$quotation' ,";
				if($taxprint = _formdata("taxprint")) $query .= "`taxprint`='$taxprint' ,";

				if($setup = _formdata("setup")) $query .= "`setup`='$setup' ,";
				if($charge = _formdata("charge")) $query .= "`charge`='$charge' ,";
								
				if($description = _formdata("description")) $query .= "`description`='$description' ,";				

				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				//echo $query;
				_mysqli_query($query);

			}

		} else if($mode=="new"){
				// 신규모드
				$insert_filed = "`regdate`,";
				$insert_value = "'$TODAYTIME',";
				
				if($enable = _formdata("enable")) {
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}
				
				$insert_filed .= "`reseller`,";
				$insert_value .= "'$reseller',";
			

				if($title = _formdata("title")) {
					$insert_filed .= "`title`,";
					$insert_value .= "'$title',";
				}

				if($shop = _formdata("shop")) {
					$insert_filed .= "`shop`,";
					$insert_value .= "'$shop',";
				}
				if($site = _formdata("site")) {
					$insert_filed .= "`site`,";
					$insert_value .= "'$site',";
				}
				if($sales = _formdata("sales")) {
					$insert_filed .= "`sales`,";
					$insert_value .= "'$sales',";
				}
				if($company = _formdata("company")) {
					$insert_filed .= "`company`,";
					$insert_value .= "'$company',";
				}
				if($business = _formdata("business")) {
					$insert_filed .= "`business`,";
					$insert_value .= "'$business',";
				}
				if($trans = _formdata("trans")) {
					$insert_filed .= "`trans`,";
					$insert_value .= "'$trans',";
				}
				if($house = _formdata("house")) {
					$insert_filed .= "`house`,";
					$insert_value .= "'$house',";
				}
				if($manager = _formdata("manager")) {
					$insert_filed .= "`manager`,";
					$insert_value .= "'$manager',";
				}
				if($quotation = _formdata("quotation")) {
					$insert_filed .= "`quotation`,";
					$insert_value .= "'$quotation',";
				}
				if($taxprint = _formdata("taxprint")) {
					$insert_filed .= "`taxprint`,";
					$insert_value .= "'$taxprint',";
				}
				

				if($setup = _formdata("setup")) {
					$insert_filed .= "`setup`,";
					$insert_value .= "'$setup',";
				}

				if($charge = _formdata("charge")) {
					$insert_filed .= "`charge`,";
					$insert_value .= "'$charge',";
				}
				

				if($description = _formdata("description")) {
					$insert_filed .= "`description`,";
					$insert_value .= "'$description',";
				}

				

				$query = "INSERT INTO service.hosting_plan ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				//echo $query;
				_mysqli_query($query);		

		} else if($mode == "delete"){
			$query = "DELETE FROM service.hosting_plan WHERE `Id`='$uid'";
			_mysqli_query($query);
		}

		// 페이지 이동 
		$url = "hosting_plan.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";


	
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>