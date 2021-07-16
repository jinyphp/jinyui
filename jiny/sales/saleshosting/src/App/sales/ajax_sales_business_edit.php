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
	include ($_SERVER['DOCUMENT_ROOT']."/func/currency.php");

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
			var url = \"ajax_sales_business_editup.php?uid=\"+uid+\"&mode=\"+mode;
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

		function youtube_manual(code){
			var url = \"manual_youtube.php?code=\"+code;
			popup_ajax(url);				
		}
	</script>";



	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");
	
		// 템플릿 디자인 읽기
		$body = $javascript._theme_page($site_env->theme,"sales_business_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");
		
		// echo "category = $category <br>";
		$body=str_replace("{formstart}","<form id='data' name='sales' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>									    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
    	$body = str_replace("{youtube_manual}","<a href='#' onclick=\"javascript:youtube_manual('sales_business_edit')\"><img src='../images/youtube.jpg' border='0' width='30'> 메뉴얼</a>",$body);

		$query = "select * from `sales_business` where Id = '$uid'"; // echo $query."<br>";
    	if($rows= _sales_query_rows($query)){
    		// ******
    		// 수정모드

    		$form_submit  = "<input type='button' value='수정' onclick=\"javascript:form_submit('edit','".$uid."')\" id=\"css_btn_edit\"> &nbsp;&nbsp;";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" id=\"css_btn_delete\" >";
    		$body = str_replace("{form_submit}",$form_submit,$body);

    		
    		if($rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);


    	} else {
    		// ******
    		// 신규모드

    		$form_submit  = "<input type='button' value='저장' onclick=\"javascript:form_submit('new','".$uid."')\" id=\"css_btn_edit\">";
    		$body = str_replace("{form_submit}",$form_submit,$body);
    		
    		$body = str_replace("{enable}",_form_check_enable("on"),$body);

    	}	
		
		


				
		$body = str_replace("{balance_sell}","<input type='text' name='balance_sell'  value='".$rows->balance_sell."' style=\"$css_textbox\"  placeholder='매출액 미수금'>",$body);
		$body = str_replace("{balance_buy}","<input type='text' name='balance_buy'  value='".$rows->balance_buy."' style=\"$css_textbox\"  placeholder='매입액 미수금'>",$body);
    		

		//$body = str_replace("{limit}","<input type='text' name='limitation'  value='".$rows->limit."' style=\"$css_textbox\" placeholder='거래한도'>",$body);
				
		$body = str_replace("{business}","<input type='text' name='business'  value='".$rows->business."' style=\"$css_textbox\"  placeholder='회사명'>",$body);
		$body = str_replace("{biznumber}","<input type='text' name='biznumber'  value='".$rows->biznumber."' style=\"$css_textbox\" placeholder='사업자번호'>",$body);

		$body = str_replace("{president}","<input type='text' name='president'  value='".$rows->president."' style=\"$css_textbox\"  placeholder='대표자명'>",$body);
		$body = str_replace("{post}","<input type='text' name='post'  value='".$rows->post."' style=\"$css_textbox\"  placeholder='우편번호'>",$body);
		$body = str_replace("{address}","<input type='text' name='address'  value='".$rows->address."' style=\"$css_textbox\"  placeholder='주소'>",$body);
		$body = str_replace("{subject}","<input type='text' name='subject'  value='".$rows->subject."' style=\"$css_textbox\"  placeholder='업태'>",$body);
		$body = str_replace("{item}","<input type='text' name='item'  value='".$rows->item."' style=\"$css_textbox\" placeholder='업종'>",$body);
		$body = str_replace("{email}","<input type='text' name='email'  value='".$rows->email."' style=\"$css_textbox\"  placeholder='이메일'>",$body);
		//$body = str_replace("{password}","<input type='text' name='password'  value='".$rows->password."' style=\"$css_textbox\"  placeholder='회원 비밀번호'>",$body);

				
		//$body = str_replace("{discount}","<input type='text' name='discount'  value='".$rows->discount."' style=\"$css_textbox\"  placeholder='할인율'>",$body);
						
		if($rows->vat) $body = str_replace("{vat}","<input type='checkbox' name='vat' checked>",$body);
		else $body = str_replace("{vat}","<input type='checkbox' name='vat'>",$body);
		$body = str_replace("{vatrate}","<input type='text' name='vatrate' value='".$rows->vatrate."' style=\"$css_textbox\"  placeholder='부가세율'>",$body);
						
		$body = str_replace("{tel}","<input type='text' name='tel'  value='".$rows->tel."' style=\"$css_textbox\"  placeholder='전화'>",$body);
		$body = str_replace("{fax}","<input type='text' name='fax'  value='".$rows->fax."' style=\"$css_textbox\"  placeholder='팩스'>",$body);
		$body = str_replace("{phone}","<input type='text' name='phone'  value='".$rows->phone."' style=\"$css_textbox\"  placeholder='핸드폰'>",$body);
		$body = str_replace("{group}","<input type='text' name='group'  value='".$rows->group."' style=\"$css_textbox\"  placeholder='그룹'>",$body);

		$body = str_replace("{country}",_form_select_country("business_country","",$rows->country,$css_textbox),$body);

		$body = str_replace("{city}","<input type='text' name='city'  value='".$rows->city."' style=\"$css_textbox\"  placeholder='도시'>",$body);
		$body = str_replace("{state}","<input type='text' name='state'  value='".$rows->state."' style=\"$css_textbox\"  placeholder='주'>",$body);

		$body = str_replace("{currency}",_currencyRows_selelct($rows->currency),$body);

			
		//# 담당자 처리
		$form_manager = "<select name='manager' style=\"$css_textbox\" >";
		$form_manager .= "<option value=''>관리자</option>";
		$query = "select * from sales_manager where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->manager == $rows1->Id) $form_manager .= "<option value='".$rows1->Id."' selected>".$rows1->lastname."</option>"; 
				else $form_manager .= "<option value='".$rows1->Id."'>".$rows1->lastname."</option>";
			}
		}
		$form_manager .= "</select>";
		$body = str_replace("{manager}",$form_manager,$body);
			
		$body = str_replace("{comment}","<textarea name='comment' rows='10' style='$css_textarea'>".stripslashes($rows->comment)."</textarea>",$body);			
						
		echo $body;

	} else {
		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}	

	
?>

