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


	$javascript = "<script>
		function form_submit(mode,uid){
			var url = \"ajax_shop_payment_editup.php?uid=\"+uid+\"&mode=\"+mode;
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
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

    	

		// $body = $javascript._skin_page($skin_name,"shop_payment_edit");
		$body = $javascript._theme_page($site_env->theme,"shop_payment_edit",$site_language,$site_mobile);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");
		
		// echo "category = $category <br>";
		$body=str_replace("{formstart}","<form id='data' name='shop' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>									    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////
		if($uid){
			$query = "select * from `shop_payment` where Id =$uid";
			$rows = _sales_query_rows($query);
			//echo "수정모드";
		} else {
			//echo "신규입력";
		}

		if(isset($block_rows->enable)) $body = str_replace("{enable}",_form_check_enable($block_rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		if($goods->test) $body = str_replace("{test}",_form_checkbox("test","on"),$body);
			else $body = str_replace("{test}",_form_checkbox("test",""),$body);
			
		$body = str_replace("{code}",_form_text("code",$rows->code,$css_textbox),$body);
		$body = str_replace("{payment}",_form_text("payment",$rows->payment,$css_textbox),$body);

		$body = str_replace("{pg_id}",_form_text("pg_id",$rows->pg_id,$css_textbox),$body);
		$body = str_replace("{pg_password}",_form_text("pg_password",$rows->pg_password,$css_textbox),$body);

		$body = str_replace("{pg_key}",_form_text("pg_key",$rows->pg_key,$css_textbox),$body);

		$body = str_replace("{pg_url}",_form_text("pg_url",$rows->pg_url,$css_textbox),$body);
		$body = str_replace("{pg_url_test}",_form_text("pg_url_test",$rows->pg_url_test,$css_textbox),$body);

		$body = str_replace("{descript}","<textarea name='descript' rows='20' style='$css_textarea'>".stripslashes($rows->descript)."</textarea>",$body);

		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

		echo $body;

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>