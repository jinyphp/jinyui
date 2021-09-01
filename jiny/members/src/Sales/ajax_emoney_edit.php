<?php
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
	
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";
	include "./func/members.php";

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");


	$javascript = "<script>
			function form_submit(mode,uid){
				var url = \"/ajax_emoney.php?uid=\"+uid+\"&mode=\"+mode;
				var formData = new FormData($('#popup_data')[0]);
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

				popup_close();	
			}

			
        </script>";


	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		include "./sales.php";


		

        // 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}

        $mode = _formdata("mode");
        $uid = _formdata("uid");
        if($mode == "edit"){
        	$query = "select * from `site_members_emoney` where Id = '".$uid."' order by regdate desc";
			if($rows = _mysqli_query_rows($query)){	
				if($rows->type == "payin"){
					$body = $javascript._skin_page($skin_name,"emoney_payin");
					$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

					$body = str_replace("{emoney}","<input type='text' name='emoney' value='".$rows->emoney."' style=\"$css_textbox\">",$body);


					$query = "select * from `shop_bank` where enable = 'on'";
					if($bank = _mysqli_query_rows($query)){
					}	
					$body = str_replace("{bankname}",$bank->bankname,$body);
					$body = str_replace("{banknum}",$bank->banknum,$body);
					$body = str_replace("{bankuser}",$bank->bankuser,$body);

					if($rows->auth){
						$body = str_replace("{form_submit}","승인된 내역은 수정할 수 없습니다.",$body);
					} else {
						$body = str_replace("{form_submit}","
						<input type='button' value='입금수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
						",$body);
					}
				} else if($rows->type == "payout"){
					$body = $javascript._skin_page($skin_name,"emoney_payout");
					$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

					$body = str_replace("{emoney}","<input type='text' name='emoney' value='".$rows->emoney."' style=\"$css_textbox\">",$body);

					$body = str_replace("{bankname}","<input type='text' name='bankname' value='".$rows->bankname."' style=\"$css_textbox\">",$body);
					$body = str_replace("{banknum}","<input type='text' name='banknum' value='".$rows->banknum."' style=\"$css_textbox\">",$body);
					$body = str_replace("{bankuser}","<input type='text' name='bankuser' value='".$rows->bankuser."' style=\"$css_textbox\">",$body);

					if($rows->auth){
						$body = str_replace("{form_submit}","승인된 내역은 수정할 수 없습니다.",$body);
					} else {
						$body = str_replace("{form_submit}","
						<input type='button' value='출금수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
						",$body);
					}


				}

			}

        } else if($mode == "payin"){
			// 팝업창
			$body = $javascript._skin_page($skin_name,"emoney_payin");
			$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

			$body = str_replace("{emoney}","<input type='text' name='emoney' style=\"$css_textbox\">",$body);


			$query = "select * from `shop_bank` where enable = 'on'";
			if($bank = _mysqli_query_rows($query)){
			}	
				$body = str_replace("{bankname}",$bank->bankname,$body);
				$body = str_replace("{banknum}",$bank->banknum,$body);
				$body = str_replace("{bankuser}",$bank->bankuser,$body);
			
			$body = str_replace("{form_submit}","
				<input type='button' value='입금' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

        } else if($mode == "payout"){
        	// 팝업창
			$body = $javascript._skin_page($skin_name,"emoney_payout");
			$body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

			$body = str_replace("{emoney}","<input type='text' name='emoney' style=\"$css_textbox\">",$body);

			$body = str_replace("{bankname}","<input type='text' name='bankname' value='".$members->bankname."' style=\"$css_textbox\">",$body);
			$body = str_replace("{banknum}","<input type='text' name='banknum' value='".$members->banknum."' style=\"$css_textbox\">",$body);
			$body = str_replace("{bankuser}","<input type='text' name='bankuser' value='".$members->bankuser."' style=\"$css_textbox\">",$body);

			$body = str_replace("{form_submit}","
				<input type='button' value='출금' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

        }

        
       
        $body = str_replace("{formstart}","<form id=\"popup_data\" name='emoney' method='post' enctype='multipart/form-data' >
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='uid' value='$uid'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
