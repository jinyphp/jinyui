<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	// update : 2016.01.25 = 수정편집 

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


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

    	$mode = _formmode();
		$uid = _formdata("uid");

		$script = "
				<script>

				function form_submit(mode,uid){
					var url = \"/ajax_shop_shipping_editup.php?mode=\"+mode+\"&uid=\"+uid;
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

		$body = $script._skin_page($skin_name,"shop_shipping_edit");
		$body=str_replace("{formstart}",$script."<form id='data' name='env' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
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


		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

		echo $body;

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>