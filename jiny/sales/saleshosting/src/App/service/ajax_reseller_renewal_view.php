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
	
	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"ajax_reseller_editup.php?mode=\"+mode+\"&uid=\"+uid;
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
		
		// 서비스 관련 함수들 
		include "service_function.php";


    	$mode = _formmode();
		$uid = _formdata("uid");
		// $body = $javascript._skin_page($skin_name,"reseller_renewal_view");
		$body = $javascript._theme_page($site_env->theme,"service_reseller_renewal_view",$site_language,$site_mobile);

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='reseller' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////

		if($rows = _service_resellerRenewalRows_Id($uid)){
			$members = _members_rows($rows->email);

			$body = str_replace("{type}",$rows->type,$body);

		
			if($program_rows = _service_resellerProgramRows_Id($rows->program)){
				$body = str_replace("{program}",$program_rows->title,$body);
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


			if($rows->auth){
				// 승인된 신청건

				// 승인완료
				
				if($rows->reseller == $_COOKIE['cookie_email']){
					// 리셀러 권한자만 승인 / 취소할 수 있음.
					if($rows->type == "resellerRegist"){
						$form_submit = "<input type='button' value='승인취소' onclick=\"javascript:form_submit('resellerRegist_cancel','".$uid."')\" style=\"".$css_btn_gray."\" >";
					} else if($rows->type == "resellerRenewal"){
						$form_submit = "<input type='button' value='승인취소' onclick=\"javascript:form_submit('resellerRenewal_cancel','".$uid."')\" style=\"".$css_btn_gray."\" >";
					}
					

					$body = str_replace("{form_submit}",$form_submit,$body);

				} else if($rows->email == $_COOKIE['cookie_email']){
					// 승인된, 본인 계정은 취소가 되지 않음.
					$body = str_replace("{form_submit}","승인된 내역은 취소할 수 없습니다.",$body);
				} 

			} else {
				// 미승인된 신청건						
				if($rows->reseller == $_COOKIE['cookie_email']){
					// 리셀러 권한자만 승인처리 할 수 있습니다.
					
					if($members->emoney >= $rows->pay_amount){

						if($rows->type == "resellerRegist"){
							$form_submit = "<input type='button' value='가입승인' onclick=\"javascript:form_submit('resellerRegist_auth','".$uid."')\" style=\"".$css_btn_gray."\" >";
						} else {
							$form_submit = "<input type='button' value='연장승인' onclick=\"javascript:form_submit('resellerRenewal_auth','".$uid."')\" style=\"".$css_btn_gray."\" >";
						
						}
				
					} else {
						$form_submit = "이머니 적립금이 부족합니다. 이미니 충전후 가입승인 해주시 길 바랍니다.";
						
					}


					$body = str_replace("{form_submit}",$form_submit,$body);

				} else if($rows->email == $_COOKIE['cookie_email']){
					// 본인 계정 주문건.
					// 자기자체 신청 취소
					$body = str_replace("{form_submit}","<input type='button' value='신청취소' onclick=\"javascript:form_submit('cancel','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
				} 
			}


			echo $body;




		} else {
			echo "신청 오류";

		}

		


		

		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>