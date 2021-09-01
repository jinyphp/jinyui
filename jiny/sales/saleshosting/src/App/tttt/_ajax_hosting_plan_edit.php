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
			var url = \"/ajax_hosting_plan_editup.php?mode=\"+mode+\"&uid=\"+uid;
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
		$body = $javascript._skin_page($skin_name,"hosting_plan_edit");
		$body=str_replace("{formstart}",$script."<form id='data' name='reseller' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);


		//////////////////
		if($uid){
			$query = "select * from `service_products` where Id =$uid";
			//echo $query."<br>";
			$rows = _mysqli_query_rows($query);
			//echo "수정모드";
		} else {

		}

		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{title}",_form_text("title",$rows->title,$css_textbox),$body);
		
		$body = str_replace("{site}",_form_text("site",$rows->site,$css_textbox),$body);
		$body = str_replace("{shop}",_form_text("shop",$rows->shop,$css_textbox),$body);
		$body = str_replace("{sales}",_form_text("sales",$rows->sales,$css_textbox),$body);
		$body = str_replace("{company}",_form_text("company",$rows->company,$css_textbox),$body);
		$body = str_replace("{business}",_form_text("business",$rows->business,$css_textbox),$body);
		$body = str_replace("{trans}",_form_text("trans",$rows->trans,$css_textbox),$body);
		$body = str_replace("{house}",_form_text("house",$rows->house,$css_textbox),$body);
		$body = str_replace("{manager}",_form_text("manager",$rows->manager,$css_textbox),$body);
		$body = str_replace("{taxprint}",_form_text("taxprint",$rows->taxprint,$css_textbox),$body);
		$body = str_replace("{quotation}",_form_text("quotation",$rows->quotation,$css_textbox),$body);




		$body = str_replace("{site_setup1}",_form_text("site_setup1",$rows->site_setup1,$css_textbox),$body);
		$body = str_replace("{shop_setup1}",_form_text("shop_setup1",$rows->shop_setup1,$css_textbox),$body);
		$body = str_replace("{sales_setup1}",_form_text("sales_setup1",$rows->sales_setup1,$css_textbox),$body);
		$body = str_replace("{company_setup1}",_form_text("company_setup1",$rows->company_setup1,$css_textbox),$body);
		$body = str_replace("{business_setup1}",_form_text("business_setup1",$rows->business_setup1,$css_textbox),$body);
		$body = str_replace("{trans_setup1}",_form_text("trans_setup1",$rows->trans_setup1,$css_textbox),$body);
		$body = str_replace("{house_setup1}",_form_text("house_setup1",$rows->house_setup1,$css_textbox),$body);
		$body = str_replace("{manager_setup1}",_form_text("manager_setup1",$rows->manager_setup1,$css_textbox),$body);
		$body = str_replace("{taxprint_setup1}",_form_text("taxprint_setup1",$rows->taxprint_setup1,$css_textbox),$body);
		$body = str_replace("{quotation_setup1}",_form_text("quotation_setup1",$rows->quotation_setup1,$css_textbox),$body);

		$body = str_replace("{site_charge1}",_form_text("site_charge1",$rows->site_charge1,$css_textbox),$body);
		$body = str_replace("{shop_charge1}",_form_text("shop_charge1",$rows->shop_charge1,$css_textbox),$body);
		$body = str_replace("{sales_charge1}",_form_text("sales_charge1",$rows->sales_charge1,$css_textbox),$body);
		$body = str_replace("{company_charge1}",_form_text("company_charge1",$rows->company_charge1,$css_textbox),$body);
		$body = str_replace("{business_charge1}",_form_text("business_charge1",$rows->business_charge1,$css_textbox),$body);
		$body = str_replace("{trans_charge1}",_form_text("trans_charge1",$rows->trans_charge1,$css_textbox),$body);
		$body = str_replace("{house_charge1}",_form_text("house_charge1",$rows->house_charge1,$css_textbox),$body);
		$body = str_replace("{manager_charge1}",_form_text("manager_charge1",$rows->manager_charge1,$css_textbox),$body);
		$body = str_replace("{taxprint_charge1}",_form_text("taxprint_charge1",$rows->taxprint_charge1,$css_textbox),$body);
		$body = str_replace("{quotation_charge1}",_form_text("quotation_charge1",$rows->quotation_charge1,$css_textbox),$body);



		$body = str_replace("{site_setup2}",_form_text("site_setup2",$rows->site_setup2,$css_textbox),$body);
		$body = str_replace("{shop_setup2}",_form_text("shop_setup2",$rows->shop_setup2,$css_textbox),$body);
		$body = str_replace("{sales_setup2}",_form_text("sales_setup2",$rows->sales_setup2,$css_textbox),$body);
		$body = str_replace("{company_setup2}",_form_text("company_setup2",$rows->company_setup2,$css_textbox),$body);
		$body = str_replace("{business_setup2}",_form_text("business_setup2",$rows->business_setup2,$css_textbox),$body);
		$body = str_replace("{trans_setup2}",_form_text("trans_setup2",$rows->trans_setup2,$css_textbox),$body);
		$body = str_replace("{house_setup2}",_form_text("house_setup2",$rows->house_setup2,$css_textbox),$body);
		$body = str_replace("{manager_setup2}",_form_text("manager_setup2",$rows->manager_setup2,$css_textbox),$body);
		$body = str_replace("{taxprint_setup2}",_form_text("taxprint_setup2",$rows->taxprint_setup2,$css_textbox),$body);
		$body = str_replace("{quotation_setup2}",_form_text("quotation_setup2",$rows->quotation_setup2,$css_textbox),$body);

		$body = str_replace("{site_charge2}",_form_text("site_charge2",$rows->site_charge2,$css_textbox),$body);
		$body = str_replace("{shop_charge2}",_form_text("shop_charge2",$rows->shop_charge2,$css_textbox),$body);
		$body = str_replace("{sales_charge2}",_form_text("sales_charge2",$rows->sales_charge2,$css_textbox),$body);
		$body = str_replace("{company_charge2}",_form_text("company_charge2",$rows->company_charge2,$css_textbox),$body);
		$body = str_replace("{business_charge2}",_form_text("business_charge2",$rows->business_charge2,$css_textbox),$body);
		$body = str_replace("{trans_charge2}",_form_text("trans_charge2",$rows->trans_charge2,$css_textbox),$body);
		$body = str_replace("{house_charge2}",_form_text("house_charge2",$rows->house_charge2,$css_textbox),$body);
		$body = str_replace("{manager_charge2}",_form_text("manager_charge2",$rows->manager_charge2,$css_textbox),$body);
		$body = str_replace("{taxprint_charge2}",_form_text("taxprint_charge2",$rows->taxprint_charge2,$css_textbox),$body);
		$body = str_replace("{quotation_charge2}",_form_text("quotation_charge2",$rows->quotation_charge2,$css_textbox),$body);



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