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

		if($mode == "enable"){
			$query = "UPDATE `sales_business` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE `sales_business` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "delete"){
			
			$query = "DELETE FROM `sales_business` WHERE `Id`='$uid'";
    		_sales_query($query);

    		// Master 비지니스 정보 갱신
			$_POST['mode'] = "delete";
			$_POST['code'] = "*".$sales_db->Id.":".$uid.";";

			// CUTL POST 처리
			$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
			//echo "CURL : "."http://www.saleshosting.co.kr/sales/curl_business_sync.php";
			//echo 
			_curl_post("http://www.saleshosting.co.kr/sales/curl_business_sync.php",$_POST);

			$url = "sales_business.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";
		
		} else if($mode == "edit"){
	
			$query = "select * from `sales_business` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 				
				$query = "UPDATE `sales_business` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
				//if($auth = _formdata("auth")) $query .= "`auth`='on' ,"; else $query .= "`auth`='' ,";
				$business_country = _formdata("business_country"); $query .= "`country`='$business_country' ,";

				$currency = $_POST['currency'];	$query .= "`currency`='$currency' ,";
				$limitation = $_POST['limitation'];	$query .= "`limitation`='$limitation' ,";

   	 			//$inout = $_POST['inout'];	$query .= "`inout`='$inout' ,";
    			$business = $_POST['business'];	$query .= "`business`='$business' ,";
    			$biznumber = $_POST['biznumber']; $biznumber = str_replace("-","",$biznumber);	$query .= "`biznumber`='$biznumber' ,";
    			$president = $_POST['president']; $query .= "`president`='$president' ,";
    			$post = $_POST['post'];	$query .= "`post`='$post' ,";
    			$address = $_POST['address']; $query .= "`address`='$address' ,";
    			$subject = $_POST['subject']; $query .= "`subject`='$subject' ,";
    			$item = $_POST['item'];	$query .= "`item`='$item' ,";
    			$email = $_POST['email'];	$query .= "`email`='$email' ,";
    			//$password = $_POST['password'];	$query .= "`password`='$password' ,";
    			
    					
    			$tel = $_POST['tel']; $query .= "`tel`='$tel' ,";
    			$fax = $_POST['fax']; $fax = str_replace("-","",$fax);	$query .= "`fax`='$fax' ,";
    			$phone = $_POST['phone']; $phone = str_replace("-","",$phone);	$query .= "`phone`='$phone' ,";

    			$group = $_POST['group']; $query .= "`group`='$group' ,";
    			$manager = $_POST['manager']; $query .= "`manager`='$manager' ,";
    					
    			//$discount = $_POST['discount'];$query .= "`discount`='$discount' ,";
    			if($_POST['vat']) $vat = "checked"; else $vat ="";  $query .= "`vat`='$vat' ,";
    			$vatrate = $_POST['vatrate'];	$query .= "`vatrate`='$vatrate' ,";
    
    			//$balance_sell = $_POST['balance_sell'];	$query .= "`balance_sell`='$balance_sell' ,";
				//$balance_buy = $_POST['balance_buy'];	$query .= "`balance_buy`='$balance_buy' ,";

				$comment = $_POST['comment'];	$query .= "`comment`='". addslashes($comment) ."' ,";

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query."<br>";
				_sales_query($query);

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
			}

			$url = "sales_business.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";			
		
		} else if($mode == "new"){
			// 삽입				
				
			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAY',";

			if($enable = _formdata("enable")){ $insert_filed .= "`enable`,"; $insert_value .= "'on',"; }
	   		if($auth = _formdata("auth")){	$insert_filed .= "`auth`,"; $insert_value .= "'on',"; }    			
			if($country = _formdata("business_country")){	$insert_filed .= "`country`,"; $insert_value .= "'$country',"; }
			if($currency = _formdata("currency")){	$insert_filed .= "`currency`,"; $insert_value .= "'$currency',"; }
			if($limitation = _formdata("limitation")){	$insert_filed .= "`limitation`,"; $insert_value .= "'$limitation',"; }
   	 		if($inout = _formdata("inout")){	$insert_filed .= "`inout`,"; $insert_value .= "'$inout',"; }
    		if($business= _formdata("business")){	$insert_filed .= "`business`,"; $insert_value .= "'$business',"; }

    		if($biznumber = _formdata("biznumber")){
    			$biznumber = str_replace("-","",$biznumber);
				$insert_filed .= "`biznumber`,";
				$insert_value .= "'$biznumber',";
			}

    		if($president = _formdata("president")){	$insert_filed .= "`president`,"; $insert_value .= "'$president',"; }
    		if($post = _formdata("post")){	$insert_filed .= "`post`,"; $insert_value .= "'$post',"; }
    		if($address = _formdata("address")){	$insert_filed .= "`address`,"; $insert_value .= "'$address',"; }
    		if($subject = _formdata("subject")){ $insert_filed .= "`subject`,"; $insert_value .= "'$subject',"; }
    		if($item = _formdata("item")){ $insert_filed .= "`item`,"; $insert_value .= "'$item',"; }
    		if($email = _formdata("email")){ $insert_filed .= "`email`,"; $insert_value .= "'$email',"; }    					
    		if($tel = _formdata("tel")){ $insert_filed .= "`tel`,"; $insert_value .= "'$tel',"; }
    		if($fax = _formdata("fax")){ $insert_filed .= "`fax`,"; $insert_value .= "'$fax',"; }
    		if($phone = _formdata("phone")){ $insert_filed .= "`phone`,"; $insert_value .= "'$phone',"; }
    		if($group = _formdata("group")){ $insert_filed .= "`group`,"; $insert_value .= "'$group',"; }
    		if($manager = _formdata("manager")){ $insert_filed .= "`manager`,"; $insert_value .= "'$manager',"; }    					
    		if($discount = _formdata("discount")){ $insert_filed .= "`discount`,"; $insert_value .= "'$discount',"; }

    		$insert_filed .= "`vat`,";
    		if($vat = _formdata("vat")) $insert_value .= "'on',"; else $insert_value .= "'',";					
    				
    		if($balance_sell = _formdata("balance_sell")){ $insert_filed .= "`balance_sell`,"; $insert_value .= "'$balance_sell',";}
			if($balance_buy = _formdata("balance_buy")){ $insert_filed .= "`balance_buy`,"; $insert_value .= "'$balance_buy',";}
			if($comment = _formdata("comment")){ $insert_filed .= "`comment`,"; $insert_value .= "'".addslashes($comment)."',";}

			$query = "INSERT INTO `sales_business` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			// echo $query."<br>";
			_sales_query($query);

			$query = "select MAX(Id) AS max_id from `sales_business` where regdate='$TODAY' and business = '$business'";
			// echo $query."<br>";
			if($rows = _sales_query_rows($query)){
				// Master 비지니스 정보 갱신
				$_POST['mode'] = "new";
				$_POST['code'] = "*".$sales_db->Id.":".$rows->max_id.";";

				$_POST['host_id'] = $sales_db->Id;
				$_POST['business_id'] = $rows->max_id;

				// CUTL POST 처리
				$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
				// echo "CURL : "."http://www.saleshosting.co.kr/sales/curl_business_sync.php";
				//echo 
				_curl_post("http://www.saleshosting.co.kr/sales/curl_business_sync.php",$_POST);

			}	
		}

		$url = "sales_business.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";	
		
	} else {
		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>