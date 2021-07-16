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
			$query = "UPDATE `service_reseller_program` SET `enable`='on' WHERE Id =$uid";
			_mysqli_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE `service_reseller_program` SET `enable`='' WHERE Id =$uid";
			_mysqli_query($query);

		} else if($mode=="edit"){

			$query = "select * from `service_reseller_program` WHERE Id =$uid";
			if($rows = _mysqli_query_rows($query)){
				// 수정모드
				$query = "UPDATE `service_reseller_program` SET ";

				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

			
				$query .= "`reseller`='$reseller' ,";
				if($title = _formdata("title")) $query .= "`title`='$title' ,";

				if($sub = _formdata("sub")) $query .= "`level`='$sub' ,";
				if($margin = _formdata("margin")) $query .= "`margin`='$margin' ,";
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

				if($sub = _formdata("sub")) {
					$insert_filed .= "`level`,";
					$insert_value .= "'$sub',";
				}
				if($margin = _formdata("margin")) {
					$insert_filed .= "`margin`,";
					$insert_value .= "'$margin',";
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

				

				$query = "INSERT INTO `service_reseller_program` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				//echo $query;
				_mysqli_query($query);		

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `service_reseller_program` WHERE `Id`='$uid'";
			_mysqli_query($query);
			
		}

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		echo "<script>"._javascript_ajax_html("#mainbody","/ajax_reseller_program.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";



		echo "editup";
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>