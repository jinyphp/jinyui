<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	// update : 2016.01.25 = 수정편집 

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
			var url = \"ajax_shop_shipping_editup.php?uid=\"+uid+\"&mode=\"+mode;
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

    	$body = $javascript._theme_page($site_env->theme,"shop_shipping_edit",$site_language,$site_mobile);
		
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		
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
			$query = "select * from `shop_delivery` where Id =$uid";
			$rows = _sales_query_rows($query);
		}

		// 상품판매 여부 체크 
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable(""),$body);

		if(isset($rows->code)) $code = $rows->code; else $code ="";
		$body = str_replace("{depature_country}","<input type='text' name='depature_country' value='".$code."' style=\"$css_textbox\" >",$body);

		if(isset($rows->target)) $target = $rows->target; else $target ="";
		$body = str_replace("{arrive_country}","<input type='text' name='arrive_country' value='".$target."' style=\"$css_textbox\">",$body);


		if(isset($rows->name)) $name = $rows->name; else $name ="";
		$body = str_replace("{title}","<input type='text' name='title' value='".$name."' style=\"$css_textbox\" >",$body);

		if(isset($rows->charge)) $charge = $rows->charge; else $charge ="";
		$body = str_replace("{ship_cost}","<input type='text' name='ship_cost' value='".$charge."' style=\"$css_textbox\" >",$body);


		if(isset($rows->manager)) $manager = $rows->manager; else $manager ="";
		$body = str_replace("{manager}","<input type='text' name='manager' value='".$manager."' style=\"$css_textbox\" >",$body);

		if(isset($rows->phone)) $phone = $rows->phone; else $phone ="";
		$body = str_replace("{phone}","<input type='text' name='phone' value='".$phone."' style=\"$css_textbox\" >",$body);

		if(isset($rows->check_country)) $body = str_replace("{check_country}", _form_checkbox("check_country","on"),$body);
		else $body = str_replace("{check_country}", _form_checkbox("check_country",""),$body);

		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

		echo $body;

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>