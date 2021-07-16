<?

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	include "./func/skin.php";
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";


	if(isset($_SESSION['language'])){
		$site_language = $_SESSION['language'];
	} else {
		$site_language = "ko";
	}

	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}

	if(isset($_COOKIE['cookie_email'])){
		$cookie_email = $_COOKIE['cookie_email'];
	} else {
		$cookie_email = "";
	}



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		//include "./sales.php";

    	$mode = _formmode();
		echo "mode is $mode <br>";
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		$skin_name = "default";
		$body = _skin_page("default","site_env_edit");

		//////////////////
		if($uid){
			$query = "select * from `site_env` where Id =$uid";
			$rows = _mysqli_query_rows($query);
		}

		if(isset($rows->code)) $code = $rows->code; else $code ="";
		$body = str_replace("{code}","<input type='text' name='code' value='".$code."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->process)) $process = $rows->process; else $process ="";
		$body = str_replace("{process}","<input type='text' name='process' value='".$process."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->logo)) $logo = $rows->logo; else $logo ="";
		$body = str_replace("{logofile}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{logofile_name}",$logo,$body);

		if(isset($rows->type)) $type = $rows->type; else $type ="";
		$body = str_replace("{type}","<input type='text' name='type' value='".$type."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->domain)) $domain = $rows->domain; else $domain ="";
		$body = str_replace("{domain}","<input type='text' name='domain' value='".$domain."' id=\"cssFormStyle\" >",$body);


		if(isset($rows->language)) $language = $rows->language; else $language ="";
		$body = str_replace("{language}","<input type='text' name='language' value='".$language."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->country)) $country = $rows->country; else $country ="";
		$body = str_replace("{country}","<input type='text' name='country' value='".$country."' id=\"cssFormStyle\" >",$body);

		// if(isset($rows->adult_check)) $adult_check = $rows->adult_check; else $adult_check ="";
		// $body = str_replace("{adult_check}","<input type='text' name='adult_check' value='".$adult_check."' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{adult_check}",_form_checkbox("adult_check",$rows->adult_check),$body);

		// if(isset($rows->members_prices)) $members_prices = $rows->members_prices; else $members_prices ="";
		// $body = str_replace("{members_prices}","<input type='text' name='members_prices' value='".$members_prices."' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{members_prices}",_form_checkbox("members_prices",$rows->members_prices),$body);

		// if(isset($rows->members_auth)) $members_auth = $rows->members_auth; else $members_auth ="";
		// $body = str_replace("{members_auth}","<input type='text' name='members_auth' value='".$members_auth."' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{members_auth}",_form_checkbox("members_auth",$rows->members_auth),$body);

		if(isset($rows->members_point)) $members_point = $rows->members_point; else $members_point ="";
		$body = str_replace("{members_point}","<input type='text' name='members_point' value='".$members_point."' id=\"cssFormStyle\" >",$body);

		if(isset($rows->members_emoney)) $members_emoney = $rows->members_emoney; else $members_emoney ="";
		$body = str_replace("{members_emoney}","<input type='text' name='members_emoney' value='".$members_emoney."' id=\"cssFormStyle\" >",$body);


		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" id=\"".$btn_style_gray."\" >",$body);

		echo $body;

		
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>