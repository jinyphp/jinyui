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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");
	
	// include "./func/goods.php";
	// include "./func/members.php";


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


		// echo "mode = $mode <br>";
		// echo "uid = $uid <br>";


		if($mode == "scm_enable"){
			$query = "select * from `sales_business` where Id='$uid'";
			if($rows = _sales_query_rows($query)){

				$query = "UPDATE `sales_business` SET `scm`='on' WHERE `Id`='$uid'";
				_sales_query($query);

				$query = "UPDATE service.seller SET `enable`='on' WHERE `email`='".$rows->email."' and `business`='$uid'";
				_mysqli_query($query);
			}

			$url = "seller_setup.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "scm_disable"){
			$query = "select * from `sales_business` where Id='$uid'";
			if($rows = _sales_query_rows($query)){

				$query = "UPDATE `sales_business` SET `scm`='' WHERE `Id`='$uid'";
				_sales_query($query);
				
				$query = "UPDATE service.seller SET `enable`='' WHERE `email`='".$rows->email."' and `business`='$uid'";
				_mysqli_query($query);
			}

			$url = "seller_setup.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";
		
		} else if($mode == "scm"){
	
			$query = "select * from `sales_business` where Id='$uid'";
			echo $query."<br>";
			if($business_rows = _sales_query_rows($query)){

				// 수정 				
				$query = "UPDATE `sales_business` SET ";
				if($scm = _formdata("scm")) $query .= "`scm`='on' ,"; else $query .= "`scm`='' ,";

				$comission = _formdata("comission"); $query .= "`scm_comission`='$comission' ,";

				$description = _formdata("description"); $query .= "`scm_description`='$description' ,";
				$address_send = _formdata("address_send"); $query .= "`scm_address_send`='$address_send' ,";
				$address_refund = _formdata("address_refund"); $query .= "`scm_address_refund`='$address_refund' ,";

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query."<br>";
				_sales_query($query);

				///

				// 로고 파일 업로드 : CURL
				if(!is_dir("./upload")) mkdir("./upload"); // 업로드 임시 폴더 확인
				$filename = "logo_".$sales_db->Id."-".$uid;
				if($files = _html_form_uploadfile("userfile1","./upload/".$filename)) {
					// 로고 파일 업로드 성공시, query문 추가					
				}

				////

				$query = "select * from service.seller where email = '".$business_rows->email."' and business = '$uid'";
				if($rows = _mysqli_query_rows($query)){
				// Update

					$query = "UPDATE service.seller SET ";
				
					if($scm)$query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

					$comission = _formdata("comission"); $query .= "`comission`='$comission' ,";
					$description = _formdata("description"); $description = addslashes($description); $query .= "`description`='$description' ,";
			
					$email = _formdata("email"); $query .= "`email`='".$business_rows->email."' ,";
					$name = _formdata("name"); $query .= "`name`='".$business_rows->business."' ,";
					$domain = _formdata("domain"); $query .= "`domain`='".$sales_db->domain."' ,";
					$query .= "`business`='$uid' ,";

					$phone = _formdata("phone"); $query .= "`phone`='".$business_rows->phone."' ,";
					$fax = _formdata("fax"); $query .= "`fax`='".$business_rows->fax."' ,";
					$address_send = _formdata("address_send"); $query .= "`address_send`='$address_send' ,";
					$address_return = _formdata("address_return"); $query .= "`address_return`='$address_return' ,";

					$query .= "`country`='".$business_rows->country."' ,";

					if($files){
						$query .= "`logo`='"."./upload/".$filename.".".$files[ext]."' ,";
					}
					

					$query .= "WHERE `email`='".$rows->email."'";
					$query = str_replace(",WHERE","WHERE",$query);
					echo $query."<br>";
					_mysqli_query($query);

				} else {
					// Insert

					$insert_filed = "";	$insert_value = "";				
					$insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAYTIME."',";
					$insert_filed .= "`business`,";	$insert_value .= "'".$uid."',";
					$insert_filed .= "`email`,";	$insert_value .= "'".$business_rows->email."',";

					if($scm){
						$insert_filed .= "`enable`,";	$insert_value .= "'on',";
					}

					if($comission = _formdata("comission")){
						$insert_filed .= "`comission`,";	$insert_value .= "'".$comission."',";
					}

					if($description = _formdata("description")){
						$description = addslashes($description);
						$insert_filed .= "`description`,";	$insert_value .= "'".$description."',";
					}

				
					
					$insert_filed .= "`name`,";	$insert_value .= "'".$business_rows->business."',";
				
					
					$insert_filed .= "`domain`,";	$insert_value .= "'".$sales_db->domain."',";
					
					
					$insert_filed .= "`phone`,";	$insert_value .= "'".$business_rows->phone."',";
					
					
					$insert_filed .= "`fax`,";	$insert_value .= "'".$business_rows->fax."',";
					

					if($address_send = _formdata("address_send")){
						$insert_filed .= "`address_send`,";	$insert_value .= "'".$address_send."',";
					}
					if($address_return = _formdata("address_return")){
						$insert_filed .= "`address_return`,";	$insert_value .= "'".$address_return."',";
					}

					$insert_filed .= "`country`,";	$insert_value .= "'".$business_rows->country."',";

					$insert_filed .= "`host`,";	$insert_value .= "'".$sales_db->Id."',";

					if($files){
						$insert_filed .= "`logo`,";	
						$insert_value .= "'"."./upload/".$filename.".".$files[ext]."',";
					}

					$query = "INSERT INTO service.seller ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_mysqli_query($query);
					echo $query;

				}	


				/*
				// Master 비지니스 정보 갱신
				$_POST['mode'] = "edit";
				$_POST['code'] = "*".$sales_db->Id.":".$uid.";";

				$_POST['host_id'] = $sales_db->Id;
				$_POST['business_id'] = $rows->Id;

				// CUTL POST 처리
				$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
				// echo "CURL : "."http://www.saleshosting.co.kr/sales/curl_business_sync.php";
				// echo 
				_curl_post("http://www.saleshosting.co.kr/sales/curl_business_sync.php",$_POST);
				*/

				

			}

			$url = "seller_setup.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";			
		
		} 

		
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>