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

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hosting.php");


	$mode = _formmode();
	if($mode == "regist"){

		// 서비스 관련 함수들 
		include "service_function.php";
		
		// +++
		// 서비스 가입 처리 신청

		$reseller = _formdata("reseller");
		$email = _formdata("email");
		$password = _formdata("password");
		$phone = _formdata("phone");
		$name = _formdata("name");
		$domain = _formdata("domain");
		$service_code = _formdata("service_code");

		$plan = _formdata("plan");
		$priod = _formdata("priod");
		$setup = _formdata("setup");
		$charge = _formdata("charge");
	

		$body = $javascript._theme_page($site_env->theme,"service_newup",$site_language,$site_mobile);

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$body = str_replace("{email}",$email,$body);



		$amount = _formdata("amount");
			
		// 리셀러 입금 계좌번호 
		$query = "select * from service.reseller WHERE `email`= '".$reseller."' ";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	

			// 간략 회원 가입처리
			if(_is_members($email)){

				// ++ 중복된 회원 메세지
				/*
				$body = $javascript._theme_page($site_env->theme,"error",$site_language,$site_mobile);
			
				$msg = "이미 가입된 이메일 주소 회원 입니다. 다른 이메일로 신청해 주십시요.";
			
				$body = str_replace("{message}",_string($msg, $site_language),$body);
				echo $body;
				*/

			} else {

				// ++ 회원가입을 처리합니다.
				$insert_filed .= "`regdate`,";	$insert_value .= "'$TODAYTIME',";
				$insert_filed .= "`email`,";	$insert_value .= "'$email',";
				$insert_filed .= "`password`,";	$insert_value .= "'$password',";
				$insert_filed .= "`username`,";	$insert_value .= "'$name',";
				$insert_filed .= "`userphone`,";$insert_value .= "'$phone',";

				$insert_filed .= "`reseller`,";$insert_value .= "'$reseller',";
				$insert_filed .= "`auth`,";$insert_value .= "'',";	// 미승인 회원
		
				$query = "INSERT INTO `site_members` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);	// echo $query."<br>";
				_mysqli_query($query);

			}
				

			// 신청정보 입력 
			$query = "select * from service.service_host WHERE `code`= '".$service_code."' or `email`= '".$email."'";
			if($rows = _mysqli_query_rows($query)){	
					// echo "중복된 서비스코드/ 신청 입니다.";
					// ++ 중복된 회원 메세지
					$body = $javascript._theme_page($site_env->theme,"error",$site_language,$site_mobile);
			
					$msg = "중복된 서비스코드/ 신청 입니다.";
			
					$body = str_replace("{message}",_string($msg, $site_language),$body);
					echo $body;


			} else {

				// ++ 선택한 호스팅 플랜을 확인합니다.
				$plan_rows = _service_hostingPlanRows_Id($plan);


				// ++ service_host_renewal 신규 신청 고객 정보 입력
				$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
				$insert_filed .= "`type`,";		$insert_value .= "'hostingRegist',";
				
				$insert_filed .= "`reseller`,";	$insert_value .= "'".$reseller."',"; // 상위 리셀러 (이메일) 
				$insert_filed .= "`email`,";	$insert_value .= "'".$email."',"; // 신청자 이메일 

				$insert_filed .= "`service_code`,";	$insert_value .= "'".$service_code."',"; 
				$insert_filed .= "`domain`,";	$insert_value .= "'".$domain."',";  

				$insert_filed .= "`name`,";		$insert_value .= "'".$name."',"; 

				$insert_filed .= "`plan`,";		$insert_value .= "'".$plan."',";
				$insert_filed .= "`priod`,";	$insert_value .= "'".$priod."',"; 
				$insert_filed .= "`setup`,";	$insert_value .= "'".$plan_rows->setup."',";
				$insert_filed .= "`charge`,";	$insert_value .= "'".$plan_rows->charge."',";

				$insert_filed .= "`pay_amount`,";	$insert_value .= "'".$amount."',";

				$title = "서비스 신규가입 신청 (Plan:".$plan."".$plan_rows->title.")";
				$insert_filed .= "`title`,";	$insert_value .= "'$title',";
		
				$query = "INSERT INTO service.service_host_renewal ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);	
				// echo $query."<br>";
				_mysqli_query($query);


				// ++ 무통장 입금 내역 
				$body = str_replace("{bank_name}",$rows->bankname,$body);
				$body = str_replace("{bank_swiff}",$rows->bankswiff,$body);
				$body = str_replace("{bank_num}",$rows->banknum,$body);
				$body = str_replace("{bank_user}",$rows->bankuser,$body);
				$body = str_replace("{amount}",$amount,$body);

				$body = str_replace("{form_submit}","<input type='button' value='입금완료' onclick=\"javascript:form_submit('regist_pay','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);


				// ++ 성공 메세지를 출력합
				echo $body;

			}

			

		} else {
			// ++ 리셀러 정보가 없는 경우 에러 메세지
			$body = $javascript._theme_page($site_env->theme,"error",$site_language,$site_mobile);
			
			$msg = "리셀러 정보가 없습니다.";
			
			$body = str_replace("{message}",_string($msg, $site_language),$body);
			echo $body;

		}	

	}



?>