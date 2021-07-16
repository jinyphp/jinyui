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
	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");
		
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
			if(returnValue == true) form_renewal(mode,uid);
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
        		beforeSend:function(){
        			//var maskHeight = $(document).height();  
    				//var maskWidth = $(window).width();

    				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
    				//$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
    				//$('#popup_mask').fadeTo(\"slow\",0.8);

        		},
        		complete:function(){

        		},
        		error:function(e){

        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});			
		}

		// 이머니 리스트로 이동
		function emoney_list(email){
			var url = \"/members/site_members_emoney.php?email=\"+email;
			url_replace(url);
		}

		//
		function popup_auth(mode,uid){
			var server_id = $('#server').val();
           	if(!server_id ){
           		alert(\"설치할 분산서버를 선택해 주세요.\");
           	} else {
           		popup_submit(mode,uid);
           	}
		}






		//
		function popup_submit(mode,uid){
            var url = \"ajax_hosting_renewal_editup.php?mode=\"+mode+\"&uid=\"+uid;
			$.ajax({
            	url:url,
            	type:'post',
            	async:false,
            	data:$('form').serialize(),
            	success:function(data){
            		$('#popup_body').html(data);
            	}
        	});

        	// 팝업창 종료
			popup_close();
            	
		}		

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

    	$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");


    	if($site_mobile == "m") $width = "300px"; else $width = "500px";

		$title = "호스팅 승인";
		$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"service_hosting_renewal_view",$site_language,$site_mobile) );


		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='reseller' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////
		//$query = "select * from service.service_host_renewal where Id =$uid";
		//echo $query."<br>";
		if($rows = _service_hostingRenewalRows_Id($uid)){

			$members = _members_rows($rows->email);

			$body = str_replace("{type}",$rows->type,$body);

			// $query = "select * from service.hosting_plan WHERE `Id`='".$rows->plan."'";
			if($grade_rows = _service_hostingPlanRows_Id($rows->plan)){
				$body = str_replace("{plan}",$grade_rows->title,$body);
			}
		
			$body = str_replace("{setup}",$rows->setup,$body);
			$body = str_replace("{charge}",$rows->charge,$body);
			$body = str_replace("{pay_amount}",$rows->pay_amount,$body);

			$body = str_replace("{service_code}",$rows->service_code,$body);
			$body = str_replace("{domain}",$rows->domain,$body);
			$body = str_replace("{reseller}",$rows->reseller,$body);
			$body = str_replace("{email}",$rows->email,$body);

			$body = str_replace("{description}",$rows->description,$body);

			$body = str_replace("{auth}",$rows->auth,$body);

			$body = str_replace("{emoney}",$members->emoney,$body);

			if($rows->type == "hostingRegist"){
				$body = str_replace("{server}",_service_serverRows_OnSelect($rows->server,$rows->reseller),$body);
			} else if($rows->type == "hostingRenewal"){
				$body = str_replace("{server}",_service_serverRows_OnSelect($rows->server,$rows->reseller),$body);
			}


			// 승인 버튼 처리 화면
			if($rows->auth){
				// 승인된 자료 처리 ...
				if($rows->reseller == $_COOKIE['cookie_email']){
					// 리셀러 권한자만 승인 / 취소할 수 있음.
					if($rows->type == "hostingRegist"){
						$form_submit .= "<input type='button' value='가입승인 취소' onclick=\"javascript:form_renewal('hostingRegist_cancel','".$uid."')\" style=\"".$css_btn_gray."\" >  ";

					} else if($rows->type == "hostingRenewal"){
						$form_submit .= "<input type='button' value='연장승인 취소' onclick=\"javascript:form_renewal('hostingRenewal_cancel','".$uid."')\" style=\"".$css_btn_gray."\" >  ";

					}

					
				
				} else if($rows->email == $_COOKIE['cookie_email']){
					// 승인된, 본인 계정은 취소가 되지 않음.
					$form_submit .= "승인된 내역은 취소할 수 없습니다.  ";
				}

				// $form_submit .= "<input type='button' value='기록삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >  "; 
				$body = str_replace("{form_submit}",$form_submit,$body);

			} else {
			// 미승인 처리...
			// 주문/연장 

				// 이머니 적립금 체크
				if($members->emoney <= $rows->pay_amount){	

					$form_submit .= "승인을 위한 이머니 적립금이 부족합니다.<br>";
					$form_submit .= "<input type='button' value='적립금보기' onclick=\"javascript:emoney_list('".$rows->email."')\" style=\"".$css_btn_gray."\" > ";
					$form_submit .= "<input type='button' value='신청취소' onclick=\"javascript:popup_submit('cancel','".$uid."')\" style=\"".$css_btn_gray."\" > ";

				} else {
					
					// 리셀러 권한자만 승인 / 취소할 수 있음.
					if($rows->reseller == $_COOKIE['cookie_email']){					
						if($rows->type == "hostingRegist"){
							// 가입승인
							$form_submit .= "<input type='button' value='가입승인' onclick=\"javascript:popup_auth('hostingRegist_auth','".$uid."')\" style=\"".$css_btn_gray."\" > ";
							$form_submit .= "<input type='button' value='신청취소' onclick=\"javascript:popup_submit('cancel','".$uid."')\" style=\"".$css_btn_gray."\" > ";
						} else if($rows->type == "hostingRenewal"){
							// 연장모드 
							$form_submit .= "<input type='button' value='연장승인' onclick=\"javascript:popup_auth('hostingRenewal_auth','".$uid."')\" style=\"".$css_btn_gray."\" > ";
							$form_submit .= "<input type='button' value='신청취소' onclick=\"javascript:popup_submit('cancel','".$uid."')\" style=\"".$css_btn_gray."\" > ";
						}
					} 

				}

				/*
				
				// 신청 취소	
				$form_submit .= "<input type='button' value='신청취소' onclick=\"javascript:form_renewal('cancel','".$uid."')\" style=\"".$css_btn_gray."\" > ";

				// 기록삭제
				$form_submit .= "<input type='button' value='기록삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
				*/

				$body = str_replace("{form_submit}",$form_submit,$body);

			}

			///
		}
		


		echo $body;
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>