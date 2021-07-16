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


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		if($mode == "check_delete"){

			// 선택한값 모두 삭제			
			if($TID = $_POST['TID']){
				for($i=0;$i<count($TID);$i++){			
					$query = "DELETE FROM `sales_quotation` WHERE `Id`='".$TID[$i]."'";
    				_sales_query($query);
				}
			}			

		} else if($mode == "delete"){
			
    		$query = "DELETE FROM `sales_quotation` WHERE `Id`='$uid'";
    		_sales_query($query);

    	} else if($mode == "edit"){

    		$query = "select * from `sales_quotation` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 

				$query = "UPDATE `sales_quotation` SET ";
					
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					

				$title = _formdata("title"); $query .= "`title`='$title' ,";
				$quomemo = _formdata("quomemo"); $query .= "`quomemo`='$quomemo' ,";

				$business_id = _formdata("business_id"); $query .= "`business_id`='$business_id' ,";
				$query1 = "select * from sales_business where Id ='$business_id'";
				if($business_rows = _sales_query_rows($query1)){
					$query .= "`business`='".$business_rows->business."' ,";
				}

				$company_id = _formdata("company_id"); $query .= "`company_id`='$company_id' ,";
				$company = _formdata("company_search"); $query .= "`company`='$company' ,";


				$customer = _formdata("customer"); $query .= "`customer`='$customer' ,";
				$phone = _formdata("phone"); $query .= "`phone`='$phone' ,";
				$email = _formdata("email"); $query .= "`email`='$email' ,";

				$currency = _formdata("currency"); $query .= "`currency`='$currency' ,";
				$tax = _formdata("tax"); $query .= "`tax`='$tax' ,";

				// $data = _formdata("data"); $query .= "`data`='$data' ,";
				// 견적 상품 스트링커리
				if($_goodname = $_POST['_goodname']){
					$_gid = $_POST['_gid'];
					$_spec = $_POST['_spec'];
					$_num = $_POST['_num'];
					$_prices = $_POST['_prices'];
					// $_num = $_POST['_num'];
					$_sum = $_POST['_sum'];
					$_vat = $_POST['_vat'];
					$_discount = $_POST['_discount'];
					$_total = $_POST['_total'];

					for($i=0;$i<count($_goodname);$i++){
						$data .= $_gid[$i].":".$_goodname[$i].":".$_spec[$i].":".$_num[$i].":".$_prices[$i].":".$_sum[$i].":".$_vat[$i].":".$_discount[$i].":".$_total[$i].";";
					}
					$query .= "`data`='$data' ,";
				}	
				


				$quo_sum = _formdata("quo_sum"); $query .= "`quo_sum`='$quo_sum' ,";
				$quo_vat = _formdata("quo_vat"); $query .= "`quo_vat`='$quo_vat' ,";
				$quo_total = _formdata("quo_total"); $query .= "`quo_total`='$quo_total' ,";

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				echo $query;
				_sales_query($query);

				// $_SESSION['quotation_data'] = NULL;

			}

		} else if($mode == "new"){

			 // 삽입 
				
				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				if($enable = _formdata("enable")){
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				if($transdate = _formdata("transdate")){
					$insert_filed .= "`transdate`,";
					$insert_value .= "'$transdate',";
				}

				if($company = _formdata("company_search")){
					$insert_filed .= "`company`,";
					$insert_value .= "'$company',";
				}

				if($company_id = _formdata("company_id")){
						$insert_filed .= "`company_id`,";
						$insert_value .= "'$company_id',";
				}

				if($business = _formdata("business")){
					$insert_filed .= "`business`,";
					$insert_value .= "'$business',";
				}


				if($title = _formdata("title")){
					$insert_filed .= "`title`,";
					$insert_value .= "'$title',";
				}

				if($customer = _formdata("customer")){
					$insert_filed .= "`customer`,";
					$insert_value .= "'$customer',";
				}

				if($phone = _formdata("phone")){
					$insert_filed .= "`phone`,";
					$insert_value .= "'$phone',";
				}

				if($email = _formdata("email")){
					$insert_filed .= "`email`,";
					$insert_value .= "'$email',";
				}

				if($tax = _formdata("tax")){
					$insert_filed .= "`tax`,";
					$insert_value .= "'$tax',";
				}

				if($currency = _formdata("currency")){
					$insert_filed .= "`currency`,";
					$insert_value .= "'$currency',";
				}

				if($quomemo = _formdata("quomemo")){
					$insert_filed .= "`quomemo`,";
					$insert_value .= "'$quomemo',";
				}

				/*
				if($data = _formdata("data")){
					$insert_filed .= "`data`,";
					$insert_value .= "'$data',";
				}
				*/
				if($_goodname = $_POST['_goodname']){
					$_gid = $_POST['_gid'];
					$_spec = $_POST['_spec'];
					$_num = $_POST['_num'];
					$_prices = $_POST['_prices'];
					// $_num = $_POST['_num'];
					$_sum = $_POST['_sum'];
					$_vat = $_POST['_vat'];
					$_discount = $_POST['_discount'];
					$_prices = $_POST['_prices'];

					for($i=0;$i<count($_goodname);$i++){
						$data .= $_gid[$i].":".$_goodname[$i].":".$_spec[$i].":".$_num[$i].":".$_prices[$i].":".$_sum[$i].":".$_vat[$i].":".$_discount[$i].":".$_prices[$i].";";
					}

					$insert_filed .= "`data`,";
					$insert_value .= "'$data',";
					
				}	
				


				if($quo_sum = _formdata("quo_sum")){
					$insert_filed .= "`quo_sum`,";
					$insert_value .= "'$quo_sum',";
				}

				if($quo_vat = _formdata("quo_vat")){
					$insert_filed .= "`quo_vat`,";
					$insert_value .= "'$quo_vat',";
				}

				if($quo_total = _formdata("quo_total")){
					$insert_filed .= "`quo_total`,";
					$insert_value .= "'$quo_total',";
				}

				// $insert_filed .= "`quotation`,";		$insert_value .= "'".$_SESSION['quotation_data']."',";	

				$query = "INSERT INTO `sales_quotation` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);
				//echo $query;
				// $_SESSION['quotation_data'] = NULL;

			

		}

		
		$url = "sales_quotation.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>