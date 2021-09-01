<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	// update : 2016.01.25 = 수정편집 

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




	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";


		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		if($mode=="edit"){

			$query = "select * from `shop_delivery` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){
				// 수정모드
				$query = "UPDATE `shop_delivery` SET ";

				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

			
				if($code = _formdata("depature_country")) $query .= "`code`='$code' ,";
				if($target = _formdata("arrive_country")) $query .= "`target`='$target' ,";
				if($name = _formdata("title")) $query .= "`name`='$name' ,";
				if($charge = _formdata("ship_cost")) $query .= "`charge`='$charge' ,";

				if($manager = _formdata("manager")) $query .= "`manager`='$manager' ,";
				if($phone = _formdata("phone")) $query .= "`phone`='$phone' ,";

				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				echo $query;
				_sales_query($query);

			}

			//echo "사이트 정보가 갱신되었습니다.";	


		} else if($mode=="new"){
				// 신규모드
				$insert_filed = "";
				$insert_value = "";
				
				if($enable = _formdata("enable")) {
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				if($code = _formdata("depature_country")) {
					$insert_filed .= "`code`,";
					$insert_value .= "'$code',";
				}

				if($target = _formdata("arrive_country")) {
					$insert_filed .= "`target`,";
					$insert_value .= "'$target',";
				}

				if($name = _formdata("title")) {
					$insert_filed .= "`name`,";
					$insert_value .= "'$name',";
				}

				if($charge = _formdata("ship_cost")) {
					$insert_filed .= "`charge`,";
					$insert_value .= "'$charge',";
				}

				if($manager = _formdata("manager")) {
					$insert_filed .= "`manager`,";
					$insert_value .= "'$manager',";
				}

				if($phone = _formdata("phone")) {
					$insert_filed .= "`phone`,";
					$insert_value .= "'$phone',";
				}

		

				$query = "INSERT INTO `shop_delivery` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);
				
				//echo "사이트 정보가 추가되었습니다.";

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_delivery` WHERE `Id`='$uid'";
				// echo $query."<br>";
			_sales_query($query);

			//echo "사이트 정보 삭제";
		}


		// 회원 정보 갱신후, 리스트 페이지로 재출력
		//echo "<script>"._javascript_ajax_html("#mainbody","/ajax_shop_shipping.php?limit=".$limit."&ajaxkey=".$ajaxkey)."</script>";





	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>