<?

	// *********************************************************************************
	// Saleshosting ERP 2.0
	// programing by hojin lee
	// Lastdate : 2015-12-07
	//
	// ****************************************

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

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/css.php";


	//********** Ajax Process **********
	//echo "ajax Session :".$_SESSION['ajaxkey']."<br>";
	//echo "ajax key ====:"._formdata("ajaxkey")."<br>";
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

    	

		$javascript = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_shop_bank_editup.php?uid=\"+uid+\"&mode=\"+mode;
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
					var url = \"/ajax_shop_bank_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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

		$body = $javascript._skin_page($skin_name,"shop_bank_edit");

		$mode = _formmode();
		$uid = _formdata("uid");		

		$body = str_replace("{formstart}","<form id='data' name='bank' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////
		if($uid){
			$query = "select * from `shop_bank` where Id =$uid";
			$rows = _sales_query_rows($query);
			//echo "수정모드";
		} else {
			//echo "신규입력";
		}

		if(isset($block_rows->enable)) $body = str_replace("{enable}",_form_check_enable($block_rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		
		$body = str_replace("{bank_name}",_form_text("bankname",$rows->bankname,$css_textbox),$body);

		$body = str_replace("{bank_account}",_form_text("banknum",$rows->banknum,$css_textbox),$body);
		$body = str_replace("{bank_user}",_form_text("bankuser",$rows->bankuser,$css_textbox),$body);

		$body = str_replace("{bank_swiff}",_form_text("swiff",$rows->swiff,$css_textbox),$body);

		
		$body = str_replace("{descript}","<textarea name='descript' rows='20' style='$css_textarea'>".stripslashes($rows->descript)."</textarea>",$body);

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