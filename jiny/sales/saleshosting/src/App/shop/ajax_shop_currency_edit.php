<?

	// *********************************************************************************
	// Saleshosting ERP 2.0
	// programing by hojin lee
	// Lastdate : 2015-12-07
	//
	// ****************************************

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$javascript = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_shop_currency_editup.php?uid=\"+uid+\"&mode=\"+mode;
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

				function form_delete(mode,uid){
					var url = \"/ajax_shop_currency_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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

		$body = $javascript._theme_page($site_env->theme,"shop_currency_edit",$site_language,$site_mobile);

		$mode = _formmode();
		$uid = _formdata("uid");		

		$body = str_replace("{formstart}","<form id='data' name='shop' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////
		if($uid){
			$query = "select * from `shop_currency` where Id =$uid";
			$rows = _sales_query_rows($query);
			//echo "수정모드";
		} else {
			//echo "신규입력";
		}

		if(isset($block_rows->enable)) $body = str_replace("{enable}",_form_check_enable($block_rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		
		$body = str_replace("{currencyname}",_form_text("currencyname",$rows->name,$css_textbox),$body);

		$body = str_replace("{currency}",_form_text("currency",$rows->currency,$css_textbox),$body);
		$body = str_replace("{currencyid}",_form_text("currencyid",$rows->currencyid,$css_textbox),$body);

		$body = str_replace("{currency_align}",_form_text("currency_align",$rows->currency_align,$css_textbox),$body);

		$body = str_replace("{currency_mark}",_form_text("currency_mark",$rows->currency_mark,$css_textbox),$body);
		$body = str_replace("{currency_rate}",_form_text("currency_rate",$rows->currency_rate,$css_textbox),$body);
		$body = str_replace("{dec_point}",_form_text("dec_point",$rows->dec_point,$css_textbox),$body);
	


		
		// $body = str_replace("{descript}","<textarea name='descript' rows='20' style='$css_textarea'>".stripslashes($rows->descript)."</textarea>",$body);

		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

		echo $body;

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>