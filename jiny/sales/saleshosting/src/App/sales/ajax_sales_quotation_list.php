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


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// echo _formdata("data");
		$data = explode(";", _formdata("data") );


		$list = "";
		$total_d = 0;
		$vat_d = 0;
		$discount_d = 0;
		$payment_d = 0;

		$total_m = 0;
		$vat_m = 0;
		$discount_m = 0;
		$payment_m = 0;

		for($i=0;$i<count($data)-1;$i++){
			// $rows = $rowss[$i];
			$_data = explode(":", $data[$i]);
			$trans_tid = "<input type='checkbox' name='TID[]' value='".$i."'>";

			$form_goodname = "<input type='hidden' name='_gid[]' value='".$_data[0]."' id=\"_gid\">
								<input type='text' name='_goodname[]' value='".$_data[1]."' placeholder='상품명' autofocus style=\"$css_textbox\" id=\"_goodname\">";
			$form_spec = "<input type='text' name='_spec[]' value='".$_data[2]."' placeholder='규격' style=\"$css_textbox\">";
			$form_num = "<input type='number' name='_num[]' value='".$_data[3]."' onkeyup='list_prices()' placeholder='수량' style=\"$css_textbox\" id=\"_num\">";
			$form_prices ="<input type='number' name='_prices[]' value='".$_data[4]."' onkeyup='list_prices()' placeholder='단가' style=\"$css_textbox\" id=\"_prices\">";
			$form_sum = "<input type='number' name='_sum[]' value='".$_data[5]."' placeholder='공급액' style=\"$css_textbox\" id=\"_sum\">";
			$form_vat = "<input type='number' name='_vat[]' value='".$_data[6]."' onkeyup='list_vat()' placeholder='부가세' style=\"$css_textbox\" id=\"_vat\">";
			$form_discount = "<input type='number' name='_discount[]' value='".$_data[7]."' onkeyup='list_prices()' placeholder='할인액' style=\"$css_textbox\" id=\"_discount\">";
			$form_total = "<input type='number' name='_total[]' value='".$_data[8]."' placeholder='합계' style=\"$css_textbox\" id=\"_total\">";

		
			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
					<tr>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"25\"> $trans_tid </td>
					<td style='font-size:12px;padding:5px;' align=\"center\"> $form_goodname </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"50\"> $form_spec </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"50\"> $form_num </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_prices </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_sum  </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_vat </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_discount </td>
					<td style='font-size:12px;padding:5px;padding-right:10px;' align=\"center\" width=\"145\"> $form_total </td>
					</tr>
					</table>";

		}

		echo $list;

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>