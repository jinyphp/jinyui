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
	include "./func/members.php";
	
	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"/ajax_reseller_editup.php?mode=\"+mode+\"&uid=\"+uid;
			var formData = new FormData($('#data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#mainbody').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});
					
		}
	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		


    	$mode = _formmode();
		$uid = _formdata("uid");
		$body = $javascript._skin_page($skin_name,"reseller_renewal_view");

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='reseller' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////
		if($uid){
			$query = "select * from `service_reseller_renewal` where Id =$uid";
			$rows = _mysqli_query_rows($query);
			//echo "수정모드";
		} else {

		}

		$members = _members_rows($rows->email);

		$body = str_replace("{type}",$rows->type,$body);

		$query = "select * from `service_reseller_program` WHERE `Id`='".$rows->program."'";
		if($grade_rows = _mysqli_query_rows($query)){
			$body = str_replace("{program}",$grade_rows->title,$body);
		}
		
		$body = str_replace("{setup}",$rows->setup,$body);
		$body = str_replace("{charge}",$rows->charge,$body);

		$body = str_replace("{service_code}",$rows->service_code,$body);
		$body = str_replace("{domain}",$rows->domain,$body);
		$body = str_replace("{reseller}",$rows->reseller,$body);
		$body = str_replace("{email}",$rows->email,$body);

		$body = str_replace("{description}",$rows->description,$body);

		$body = str_replace("{auth}",$rows->auth,$body);

		$body = str_replace("{emoney}",$members->emoney,$body);


		// 승인 버튼 처리 화면
		if($rows->auth){
			// 승인완료
			if($rows->reseller == $_COOKIE['cookie_email']){
				// 리셀러 권한자만 승인 / 취소할 수 있음.
				$body = str_replace("{form_submit}","<input type='button' value='승인취소' onclick=\"javascript:form_submit('authcencel','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
			} else if($rows->email == $_COOKIE['cookie_email']){
				// 승인된, 본인 계정은 취소가 되지 않음.
				$body = str_replace("{form_submit}","승인된 내역은 취소할 수 없습니다.",$body);
			} 
		} else {
			// 미승인			
			if($rows->reseller == $_COOKIE['cookie_email']){
				// 리셀러 권한자만 승인 / 취소할 수 있음.
				// $prices = $rows->setup + $rows->charge;
				if($members->emoney >= $rows->pay_amount){
					if($rows->type == "new"){
						$body = str_replace("{form_submit}","<input type='button' value='가입승인' onclick=\"javascript:form_submit('reg_auth','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
					} else {
						$body = str_replace("{form_submit}","<input type='button' value='연장승인' onclick=\"javascript:form_submit('renewal_auth','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
					}
				
				} else {
					$body = str_replace("{form_submit}","이머니 적립금이 부족합니다. 이미니 충전후 가입승인 해주시 길 바랍니다. < <a href='reseller_emoney.php'>입출금확인</a> >",$body);
				}

			} else if($rows->email == $_COOKIE['cookie_email']){
				// 본인 계정일 경우, 리셀러 신청 취소가 가능합
				$body = str_replace("{form_submit}","<input type='button' value='신청취소' onclick=\"javascript:form_submit('cancel','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
			} 
		}


		echo $body;

		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$msg_string = _string($msg,$site_language);
		$body = str_replace("<!--{error_message}-->",$msg_string,$body);
		echo $body;	
	}

	
?>