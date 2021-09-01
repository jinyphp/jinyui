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

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");


	$javascript = "<script>
		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

    	function form_trans(mode,uid){
    		var business_id = $('#select_business').val();
    		var company_id = $('#select_company').val();
    		var chk = $('#check_company_new').is(\":checked\");

            if(!business_id){
            	alert(\"사업자를 선택해 주세요\");
            } else if(!company_id){
            	if(chk) {
            		alert(\"전표입력\");
            		popup_submit(mode,uid);
            	} else {
            		alert(\"거래처를 선택해 주세요\");
            	}
            } else {
            	alert(\"전표입력\");	
            	popup_submit(mode,uid);
       		}
    	}

    	function popup_submit(mode,uid){
			
            var url = \"ajax_shop_orders_transup.php?mode=\"+mode+\"&uid=\"+uid;
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
			// popup_close();
            	
		}
    </script>";

    //********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		$uid = _formdata("uid");

		if($site_mobile == "m") $width = "300px"; else $width = "800px"; 		

		$title = "쇼핑몰 주문 : 전표입력 ";
		$body = $javascript._popup_body( $title, $width, _theme_page($site_env->theme,"shop_orders_trans",$site_language,$site_mobile) );


		$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$submit_button .= "<input type='button' value='전표입력' onclick=\"javascript:form_trans('transup','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$submit_button,$body);

		$body = str_replace("{business}",_businessRows_select($business),$body);
		$body = str_replace("{company}",_companyRows_select($company),$body);
		$body = str_replace("{company_new}","<input type='checkbox' name='company_new' id=\"check_company_new\">",$body);

		echo $body;

	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}

	
	function _businessRows_select($business){
		global $css_textbox;

		$form_business = "<select name='business' style=\"$css_textbox\" id=\"select_business\">";
		
		if($business) {
			$form_business .= "<option value=''>사업자 선택</option>"; 
		} else {
			$form_business .= "<option value='' selected>사업자 선택</option>";
		}

		$query = "select * from `sales_business`";
		if($rowss = _sales_query_rowss($query)){
			
			for($ii=0;$ii<count($rowss);$ii++){
				$rows1=$rowss[$ii];
				if($business == $rows1->Id) {
					$form_business .= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>"; 
				} else {
					$form_business .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
				}
			}
				
		}

		$form_business .= "</select>";	
		return $form_business;
	}

	function _companyRows_select($company){
		global $css_textbox;
		
		$form_company = "<select name='company' style=\"$css_textbox\" id=\"select_company\">";
		
		if($company) {
			$form_company .= "<option value=''>거래처 선택</option>"; 
		} else {
			$form_company .= "<option value='' selected>거래처 선택</option>";
		}
		
		$query = "select * from `sales_company`";
		if($rowss = _sales_query_rowss($query)){
			
			for($ii=0;$ii<count($rowss);$ii++){
				$rows1=$rowss[$ii];
				if($company == $rows1->Id) {
					$form_company .= "<option value='".$rows1->Id."' selected>".$rows1->company."</option>"; 
				} else {
					$form_company .= "<option value='".$rows1->Id."'>".$rows1->company."</option>";
				}
			}	
		}

		$form_company .= "</select>";	
		return $form_company;
	}


?>