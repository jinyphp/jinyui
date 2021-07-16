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

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$reseller = $_COOKIE['cookie_email'];	


		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");

		if($mode == "enable"){
			$query = "UPDATE service.reseller_program SET `enable`='on' WHERE Id =$uid";
			_mysqli_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE service.reseller_program SET `enable`='' WHERE Id =$uid";
			_mysqli_query($query);

		} else if($mode=="edit"){

			if($reseller_rows = _service_resellerRows($reseller)){
				if(_formdata("margin") > $reseller_rows->margin){
					$msg = "본인 자체의 마진보다 더 큰 마진으로 체널 프로그램을 생성할 수 는 없습니다.";
					msg_alert($msg);
				} else {
					$query = "select * from service.reseller_program WHERE Id =$uid";
					if($rows = _mysqli_query_rows($query)){
						// 수정모드
						$query = "UPDATE service.reseller_program SET ";

						if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";			
						$query .= "`reseller`='$reseller' ,";
						if($title = _formdata("title")) $query .= "`title`='$title' ,";
						if($sub = _formdata("sub")) $query .= "`level`='$sub' ,";
						if($margin = _formdata("margin")) $query .= "`margin`='$margin' ,";
						if($setup = _formdata("setup")) $query .= "`setup`='$setup' ,";
						if($charge = _formdata("charge")) $query .= "`charge`='$charge' ,";				
						if($country = _formdata("country")) $query .= "`country`='$country' ,";				
								
						if($description = _formdata("description")) $query .= "`description`='".addslashes($description)."' ,";				

						$query .= "WHERE Id =$uid";
						$query = str_replace(",WHERE","where ",$query);
						//echo $query;
						_mysqli_query($query);
					}

				}
			}
				
			


		} else if($mode=="new"){
			if($reseller_rows = _service_resellerRows($reseller)){
				if(_formdata("margin") > $reseller_rows->margin){
					$msg = "본인 자체의 마진보다 더 큰 마진으로 체널 프로그램을 생성할 수 는 없습니다.";
					msg_alert($msg);
				} else {
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

					if($country = _formdata("country")) {
						$insert_filed .= "`country`,";
						$insert_value .= "'$country',";
					}

					$query = "INSERT INTO service.reseller_program ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					//echo $query;
					_mysqli_query($query);
					
				}

			}

						

			

		} else if($mode == "delete"){
			$query = "DELETE FROM service.reseller_program WHERE `Id`='$uid'";
			_mysqli_query($query);
			
		}

		// 회원 정보 갱신후, 리스트 페이지로 재출력
		// echo "<script>"._javascript_ajax_html("#mainbody","/ajax_reseller_program.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";

		$url = "reseller_program.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";


		// echo "editup";
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>