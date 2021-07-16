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


	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hoosting.php");
	
	$javascript = "<script>
		function form_delete(mode,uid){
			var returnValue = confirm(\"삭제하겠습니까?\");
			if(returnValue == true) form_submit(mode,uid);
		}

		function form_submit(mode,uid){
			var url = \"ajax_hosting_users_editup.php?mode=\"+mode+\"&uid=\"+uid;
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

		function form_renewal(mode,uid){
			var url = \"ajax_hosting_renewal_editup.php?mode=\"+mode+\"&uid=\"+uid;
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
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		// $body = $javascript._skin_page($skin_name,"hosting_renewal_view");
		$body = $javascript._theme_page($site_env->theme,"service_hosting_renewal_view",$site_language,$site_mobile);	

		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='reseller' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////
		if($uid){
			$query = "select * from `service_host_renewal` where Id =$uid";
			$rows = _mysqli_query_rows($query);
			//echo "수정모드";
		} else {

		}

		$members = _members_rows($rows->email);

		$body = str_replace("{type}",$rows->type,$body);

		$query = "select * from `service_products` WHERE `Id`='".$rows->plan."'";
		if($grade_rows = _mysqli_query_rows($query)){
			$body = str_replace("{plan}",$grade_rows->title,$body);
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


		function _server_select($server,$reseller){
			global $css_textbox;

			$server_select = "<select name='server' style=\"$css_textbox\">";
			$server_select .= "<option value=''>서버선택</option>";
				
			$query = "select * from `service_server` where reseller='$reseller'";
			if($rowss = _mysqli_query_rowss($query)){	
					
				for($i=0;$i<count($rowss);$i++){
					$rows1 = $rowss[$i];
					if($server == $rows1->name){
						$server_select .= "<option value='".$rows1->name."' selected>".$rows1->name."</option>";
					} else $server_select .= "<option value='".$rows1->name."'>".$rows1->name."</option>";
				}		
				
			}

			$server_select .= "</select>";
			return $server_select;
		}
		
		$body = str_replace("{server}",_server_select($rows->server,$rows->reseller),$body);



		// 승인 버튼 처리 화면
		if($rows->auth){
			// 승인된 자료 처리 ...
			if($rows->reseller == $_COOKIE['cookie_email']){
				// 리셀러 권한자만 승인 / 취소할 수 있음.
				$form_submit .= "<input type='button' value='승인취소' onclick=\"javascript:form_renewal('regauth_cencel','".$uid."')\" style=\"".$css_btn_gray."\" >  ";
				
			} else if($rows->email == $_COOKIE['cookie_email']){
				// 승인된, 본인 계정은 취소가 되지 않음.
				$form_submit .= "승인된 내역은 취소할 수 없습니다.  ";
			}

			$form_submit .= "<input type='button' value='기록삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >  "; 
			$body = str_replace("{form_submit}","승인된 내역은 취소할 수 없습니다.",$body);

		} else {
			// 미승인 처리...
			// 주문/연장 

			$form_submit = "";

			if($rows->reseller == $_COOKIE['cookie_email']){
				// 리셀러 권한자만 승인 / 취소할 수 있음.
				
				if($members->emoney <= $rows->pay_amount){
					$form_submit .= "이머니 적립금이 부족합니다. 이미니 충전후 가입승인 해주시 길 바랍니다. (<a href='reseller_emoney.php'>입출금확인</a>) ";
				}
					
				if($rows->type == "regist"){
					// 가입승인
					$form_submit .= "<input type='button' value='가입승인' onclick=\"javascript:form_renewal('reg_auth','".$uid."')\" style=\"".$css_btn_gray."\" > ";
				
				} else {
					// 연장모드 
					$form_submit .= "<input type='button' value='연장승인' onclick=\"javascript:form_renewal('renewal_auth','".$uid."')\" style=\"".$css_btn_gray."\" > ";
				
				}
				
				// 신청 취소	
				$form_submit .= "<input type='button' value='취소' onclick=\"javascript:form_renewal('cancel','".$uid."')\" style=\"".$css_btn_gray."\" > ";


			} else if($rows->email == $_COOKIE['cookie_email']){
				// 본인 계정일 경우, 리셀러 신청 취소가 가능합
				// 신청 취소 
				$form_submit .= "<input type='button' value='취소' onclick=\"javascript:form_submit('cancel','".$uid."')\" style=\"".$css_btn_gray."\" > ";

				
		
			}

			// 기록삭제
			$form_submit .= "<input type='button' value='기록삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			
			$body = str_replace("{form_submit}",$form_submit,$body);

		}


		echo $body;
		
	} else {
		// Ajax 오류 메세지 출력
		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;	
	}

	
?>