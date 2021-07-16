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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	
	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"ajax_hosting_plan_editup.php?mode=\"+mode+\"&uid=\"+uid;
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

    	$body = $javascript._theme_page($site_env->theme,"service_hosting_plan_edit",$site_language,$site_mobile);
    	$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		$body=str_replace("{formstart}","<form id='data' name='hosting' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>
										<input type='hidden' name='list_num' value='$list_num'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		


		//////////////////
		$query = "select * from service.hosting_plan where Id =$uid";
		if($rows = _mysqli_query_rows($query)){
			
			$body = str_replace("{form_submit}","<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

		} else {
			$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

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
		
		// $body = str_replace("{description}",_form_text("description",$rows->description,$css_textbox),$body);
		$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->description)."</textarea>",$body);	


		echo $body;

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>