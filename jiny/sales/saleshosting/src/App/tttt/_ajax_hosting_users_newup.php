<?

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


	include "./sales.php";
	include "./func/members.php";
	include "./func/hosting.php";

	$mode = _formmode();

  	// 팝업창
	$body = $javascript._skin_page($skin_name,"hosting_users_newup");
	$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

	$email = _formdata("email");
	if($members = _members_rows($email)) {
		if($hosting = _hosting_rows($email)) {
			$body = str_replace("{ifram}","가입된 중복 회원 입니다.",$body);
		} else {

			// database 중복여부 체크
			$db_database = _formdata("db_database");
			$query = "select * from `service_host` WHERE database = '$db_database'";
			if($user_db = _mysqli_query_rows($query)){
				$body = str_replace("{ifram}","중복된 데이터베이스 이름입니다.",$body);
			} else {
				// 회원 정보, db테이블 삽입
				_hosting_new();

				// 서버 처리 : ifram call 
				$ifram_url = "http://api.saleshosting.co.kr/curl_adduser.php?email=".$email;
				$body = str_replace("{ifram}","<iframe src=\"".$ifram_url."\" width=\"100%\" height=\"500\" scrolling=\"auto\"></iframe>",$body);

			}

		}
	} else {
		$body = str_replace("{ifram}","미등록 이메일, 먼저 회원가입을 해주세요.",$body);
	}

	echo $body;

	function _hosting_new(){
		global $TODAYTIME;

		// 신규모드
		$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
				
		if($enable = _formdata("enable")){
			$insert_filed .= "`enable`,";					
			$insert_value .= "'on',";
		}

		if($reseller = _formdata("reseller")) {
			$insert_filed .= "`reseller`,";					
			$insert_value .= "'$reseller',";
		}

		if($email = _formdata("email")) {
			$insert_filed .= "`email`,";					
			$insert_value .= "'$email',";
		}

		if($name = _formdata("name")) {
			$insert_filed .= "`name`,";						
			$insert_value .= "'$name',";
		}

		if($domain = _formdata("domain")) {
			$insert_filed .= "`domain`,";						
			$insert_value .= "'$domain',";
		}

		if($db_server = _formdata("db_server")) {
			$insert_filed .= "`server`,";					
			$insert_value .= "'$db_server',";
		}

		if($db_address = _formdata("db_address")) {
			$insert_filed .= "`hostname`,";					
			$insert_value .= "'$db_address',";
		}

		if($db_database = _formdata("db_database")) {
			$insert_filed .= "`database`,";					
			$insert_value .= "'$db_database',";
		}

		if($db_id = _formdata("db_id")) {
			$insert_filed .= "`user`,";						
			$insert_value .= "'$db_id',";
		}

		if($db_password = _formdata("db_password")) {
			$insert_filed .= "`password`,";					
			$insert_value .= "'$db_password',";
		}

		if($title = _formdata("title")) {
			$insert_filed .= "`title`,";					
			$insert_value .= "'$title',";
		}

		if($site = _formdata("site")) {
			$insert_filed .= "`site`,";						
			$insert_value .= "'$site',";
		}

		if($shop = _formdata("shop")) {
			$insert_filed .= "`shop`,";						
			$insert_value .= "'$shop',";
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

		if($quotation = _formdata("quotation")) {
			$insert_filed .= "`quotation`,";				
			$insert_value .= "'$quotation',";
		}

		if($house = _formdata("house")) {
			$insert_filed .= "`house`,";					
			$insert_value .= "'$house',";
		}

		if($manager = _formdata("manager")) {
			$insert_filed .= "`manager`,";					
			$insert_value .= "'$manager',";
		}

		if($taxprint = _formdata("taxprint")) {
			$insert_filed .= "`taxprint`,";					
			$insert_value .= "'$taxprint',";
		}

		if($description = _formdata("description")) {
			$insert_filed .= "`description`,";				
			$insert_value .= "'$description',";
		}

		if($setup = _formdata("setup")) {
			$insert_filed .= "`setup`,";					
			$insert_value .= "'$setup',";
		}

		if($charge = _formdata("charge")) {
			$insert_filed .= "`charge`,";					
			$insert_value .= "'$charge',";
		}


		$insert_filed .= "`expire`,";					
		$insert_value .= "'$TODAY',";

		// 어드민 토큰키
		$adminkey = md5('admin'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$insert_filed .= "`adminkey`,";					
		$insert_value .= "'$adminkey',";

		$query = "INSERT INTO `service_host` ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		echo $query."<br>";
		_mysqli_query($query);		

	}

?>