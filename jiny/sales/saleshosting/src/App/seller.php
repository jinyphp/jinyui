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


	include "./func/string.php";
	include "./func/currency.php";
	include "./func/members.php";
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/error.php";

	include "./func/css.php";

	$javascript = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_seller_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('.mainbody').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

	</script>";
	$body = $javascript._skin_body($skin_name,"seller");

	$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
	$body=str_replace("{formstart}","<form id='data' name='pages' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
	$body = str_replace("{formend}","</form>",$body);

	$body = str_replace("{form_submit}","
				<input type='button' value='입점요청' onclick=\"javascript:form_submit('new','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

	$body = str_replace("{seller}",_form_text("seller","",$css_textbox),$body);
	$body = str_replace("{seller_email}",_form_text("seller_email","",$css_textbox),$body);
	$body = str_replace("{seller_password}",_form_text("seller_password","",$css_textbox),$body);
	$body = str_replace("{seller_site}",_form_text("seller_site","",$css_textbox),$body);
	$body = str_replace("{seller_title}",_form_text("seller_title","",$css_textbox),$body);
	$body = str_replace("{seller_comment}",_form_textarea("seller_comment","","20",$css_textarea),$body);

	$body = str_replace("{seller_phone}",_form_text("seller_phone",$seller_rows->phone,$css_textbox),$body);
			$body = str_replace("{seller_post}",_form_text("seller_post",$seller_rows->post,$css_textbox),$body);
			$body = str_replace("{seller_address}",_form_text("seller_address",$seller_rows->address,$css_textbox),$body);
			$body = str_replace("{seller_manager}",_form_text("seller_manager",$seller_rows->manager,$css_textbox),$body);


	echo $body;


?>