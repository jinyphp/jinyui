<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.29 : 코드수정

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
			/*
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
    		*/

            ajax_sync('#mainbody',url);
		}

		function reseller_renewal(mode,uid){
			var url = \"ajax_reseller_editup.php?uid=\"+uid+\"&mode=\"+mode;	
			// popup(url);
		
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 		

        }
	</script>";
		
	// echo "reseller_Edit_page<br>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

		$body = $javascript._theme_page($site_env->theme,"service_reseller_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);


		$cookie_email = $_COOKIE['cookie_email']; // 로그인 이메일
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$cate = _formdata("cate");
		$ajaxkey = _formdata("ajaxkey");

		// echo $ajaxkey;
		$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		// echo "mode = $mode <br>";

		if($mode == "edit"){
			$query = "select * from service.reseller WHERE `Id`='$uid'";
			if($reseller_rows = _mysqli_query_rows($query)){	
				$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			}

		} else if($mode == "sub"){
			$body = str_replace("{form_submit}","
				<input type='button' value='서브저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

		} else if($mode == "new"){
			$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

		}	
		
		$body = str_replace("{renewal}","<input type='button' value='연장주문' onclick=\"javascript:reseller_renewal('resellerRenewal','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

		$body = str_replace("{regdate}",$reseller_rows->regdate,$body);
		$body = str_replace("{emoney}",$reseller_rows->emoney,$body);
		$body = str_replace("{expire}",$reseller_rows->expire,$body);

		$body = str_replace("{email}",_form_text("email",$reseller_rows->email,$css_textbox),$body);
		$body = str_replace("{name}",_form_text("name",$reseller_rows->name,$css_textbox),$body);
		$body = str_replace("{code}",_form_text("code",$reseller_rows->code,$css_textbox),$body);
		$body = str_replace("{domain}",_form_text("domain",$reseller_rows->domain,$css_textbox),$body);


		if($reseller_rows->email == $_COOKIE['cookie_email']){
				// 자기 본인 정보는 승인 및 활성화 수정이 불가능함				
				if($reseller_rows->enable) {
					$body = str_replace("{enable}","<input type='checkbox' name='enable' readonly checked >",$body);
				} else {
					$body = str_replace("{enable}","<input type='checkbox' name='enable' readonly>",$body);
				}

				if($reseller_rows->auth_req) {
					$body = str_replace("{auth_req}","<input type='checkbox' name='auth_req' readonly checked >",$body);
				} else {
					$body = str_replace("{auth_req}","<input type='checkbox' name='auth_req' readonly>",$body);
				}

				$body = str_replace("{sub}","<input type='text' name='sub' value='".$reseller_rows->sub."' style=\"$css_textbox\" readonly>",$body);
				$body = str_replace("{margin}","<input type='text' name='margin' value='".$reseller_rows->margin."' style=\"$css_textbox\" readonly>",$body);

				$body = str_replace("{setup}","<input type='text' name='setup' value='".$reseller_rows->setup."' style=\"$css_textbox\" readonly>",$body);
				$body = str_replace("{charge}","<input type='text' name='charge' value='".$reseller_rows->charge."' style=\"$css_textbox\" readonly>",$body);
			

		} else {
				// 상품판매 활성화 : 비활성화시 상품노출 안됨
				if($reseller_rows->enable) {
					$body = str_replace("{enable}",_form_check_enable("on"),$body);
				} else {
					$body = str_replace("{enable}",_form_check_enable(""),$body);
				}

				if($reseller_rows->auth_req) {
					$body = str_replace("{auth_req}","<input type='checkbox' name='auth_req' checked >",$body);
				} else {
					$body = str_replace("{auth_req}","<input type='checkbox' name='auth_req' >",$body);
				}

				$body = str_replace("{sub}",_form_text("sub",$reseller_rows->sub,$css_textbox),$body);
				$body = str_replace("{margin}",_form_text("margin",$reseller_rows->margin,$css_textbox),$body);

				$body = str_replace("{setup}",_form_text("setup",$reseller_rows->setup,$css_textbox),$body);
				$body = str_replace("{charge}",_form_text("charge",$reseller_rows->charge,$css_textbox),$body);
				
		}

		$body = str_replace("{reseller_program}",_service_resellerProgramRows_OnSelect($reseller_rows->program),$body);

		$body = str_replace("{bankname}",_form_text("bankname",$reseller_rows->bankname,$css_textbox),$body);
		$body = str_replace("{bankswiff}",_form_text("bankswiff",$reseller_rows->bankswiff,$css_textbox),$body);
		$body = str_replace("{banknum}",_form_text("banknum",$reseller_rows->banknum,$css_textbox),$body);
		$body = str_replace("{bankuser}",_form_text("bankuser",$reseller_rows->bankuser,$css_textbox),$body);		

		$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($reseller_rows->description)."</textarea>",$body);	

		echo $body;


	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	



	
?>