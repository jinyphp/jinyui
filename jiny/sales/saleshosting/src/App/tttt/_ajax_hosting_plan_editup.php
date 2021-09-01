<?

	//*  OpenShopping V2.1
	//*  programing by hojin lee

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

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

	include "./func/css.php";

	include "./func/reseller.php";
	include "./func/hosting.php";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		//include "./sales.php";

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$reseller = $_COOKIE['cookie_email'];	


		$mode = _formmode();
		echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");

		if($mode == "enable"){
			//$query = "UPDATE `service_products` SET `enable`='on' WHERE Id =$uid";
			//_mysqli_query($query);
			_hosting_plan_enable_byId($uid);

		} else if($mode == "disable"){
			//$query = "UPDATE `service_products` SET `enable`='' WHERE Id =$uid";
			//_mysqli_query($query);
			_hosting_plan_disable_byId($uid);
		} else if($mode=="edit"){

			// $query = "select * from `service_products` WHERE Id =$uid";
			if($rows = _hosting_plan_rows_byId($uid)){
				// 수정모드
				$query = "UPDATE `service_products` SET ";

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
								
				if($description = _formdata("description")) $query .= "`description`='$description' ,";				

				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				//echo $query;
				_mysqli_query($query);

			}

	


		} else if($mode=="new"){
				// 신규모드
				$insert_filed = "";
				$insert_value = "";
				
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
				

				

				if($description = _formdata("description")) {
					$insert_filed .= "`description`,";
					$insert_value .= "'$description',";
				}

				

				$query = "INSERT INTO `service_products` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				//echo $query;
				_mysqli_query($query);		

			

		} else if($mode == "delete"){
			// $query = "DELETE FROM `service_products` WHERE `Id`='$uid'";
			// _mysqli_query($query);
			_hosting_plan_delete_byId($uid);
		}

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		// echo "<script>"._javascript_ajax_html("#mainbody","/ajax_service_products.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";

		// 페이지 이동 
		$url = "/hosting_plan.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";


		echo "editup";
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>