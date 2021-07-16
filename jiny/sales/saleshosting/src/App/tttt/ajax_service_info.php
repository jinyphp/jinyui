<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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

	include "./func/error.php";	
	include "./func/members.php";

	include "./func/reseller.php";
	include "./func/hosting.php";


	$javascript = "<script>


		function user_renewal(mode,uid){
			var url = \"/ajax_hosting_service_renewal.php?mode=\"+mode+\"&uid=\"+uid;
			alert(url);
			//ajax_html_form(\"#mainbody\",url,\"data\");

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
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$body = $javascript._skin_page($skin_name,"service_info");
		$body=str_replace("{formstart}","<form id='data' name='hosting' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$members = _members_rows($_COOKIE['cookie_email']);

		// 회원 정보 표시
		$body = str_replace("{member_name}",$members->username." ".$members->firstname,$body);
		$body = str_replace("{member_email}",$members->email,$body);
		$body = str_replace("{members_emoney}",$members->emoney,$body);
		$body = str_replace("{members_point}",$members->point,$body);

		$body = str_replace("{edit}","<input type='button' value='회원수정' onclick=\"javascript:members_edit('edit','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		
		// $body = str_replace("{renewal}","<input type='button' value='연장신청' onclick=\"javascript:service('renewal','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		$hosting = _hosting_rows($members->email);
		$body = str_replace("{renewal}","<input type='button' value='연장신청' onclick=\"javascript:user_renewal('renewal','".$hosting->Id."')\" style=\"".$css_btn_gray."\" >",$body);


		$body = str_replace("{host_code}",$sales_db->code,$body);
		$body = str_replace("{host_domain}","<a href='http://".$sales_db->domain."/?admin=".$sales_db->adminkey."'>".$sales_db->domain."</a>",$body);


		$body = str_replace("{site}",$sales_db->site,$body);
		$body = str_replace("{shop}",$sales_db->shop,$body);
		$body = str_replace("{sales}",$sales_db->sales,$body);
		$body = str_replace("{business}",$sales_db->business,$body);
		$body = str_replace("{company}",$sales_db->company,$body);
		$body = str_replace("{trans}",$sales_db->trans,$body);
		$body = str_replace("{manager}",$sales_db->manager,$body);
		$body = str_replace("{house}",$sales_db->house,$body);
		$body = str_replace("{quotation}",$sales_db->quotation,$body);
		$body = str_replace("{taxprint}",$sales_db->taxprint,$body);

		$body = str_replace("{expire}",$sales_db->expire,$body);
		$body = str_replace("{service_type}",$sales_db->service_type,$body);

		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다. ajax_service_info";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

?>