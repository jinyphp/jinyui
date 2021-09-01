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
	
	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"/ajax_reseller_program_editup.php?mode=\"+mode+\"&uid=\"+uid;
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
		//include "./sales.php";

    	$mode = _formmode();
    	//echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");
		//echo "uid = ".$uid."<br>";
		$body = $javascript._skin_page($skin_name,"reseller_program_edit");
		$body=str_replace("{formstart}",$script."<form id='data' name='reseller' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);


		//////////////////
		if($uid){
			$query = "select * from `service_reseller_program` where Id =$uid";
			//echo $query."<br>";
			$rows = _mysqli_query_rows($query);
			//echo "수정모드";
		} else {

		}

		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{title}",_form_text("title",$rows->title,$css_textbox),$body);
		$body = str_replace("{sub}",_form_text("sub",$rows->level,$css_textbox),$body);
		$body = str_replace("{margin}",_form_text("margin",$rows->margin,$css_textbox),$body);
		$body = str_replace("{setup}",_form_text("setup",$rows->setup,$css_textbox),$body);
		$body = str_replace("{charge}",_form_text("charge",$rows->charge,$css_textbox),$body);


	
		
		$body = str_replace("{description}",_form_text("description",$rows->description,$css_textbox),$body);


		echo $body;

		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$msg_string = _string($msg,$site_language);
		$body = str_replace("<!--{error_message}-->",$msg_string,$body);
		echo $body;	
	}

	
?>