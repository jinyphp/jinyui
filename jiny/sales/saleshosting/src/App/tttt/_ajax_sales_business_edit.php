<?

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";
		
		$script = "<script>

		</script>";
	


		$body = $script._skin_page($skin_name,"sales_business_edit");
		// $body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
		/*
		$body=str_replace("{formstart}","<form id='data' name='business' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		*/

		$query = "select * from `sales_business` where Id = '$uid'";
		// echo $query."<br>";
    	if($rows= _sales_query_rows($query)){
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_business_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_business_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	} else {
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_business_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	}	
		
			if($rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);


				
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

			$body = str_replace("{currency}","<input type='text' name='currency'  value='".$rows->currency."' style=\"$css_textbox\"  placeholder='거래통화'>",$body);

			
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
			
		
			
			
						
			//$body = str_replace("{mail}",_button_green("추천메일","sales_business_mail.php?UID=$UID"),$body); 	
			$body = str_replace("{comment}","<textarea name='comment' rows='10' style='$css_textarea'>".stripslashes($rows->comment)."</textarea>",$body);			
						
			

		echo $body;		
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	

	
?>

