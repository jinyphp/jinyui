<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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

	$javascript = "<script>
		
		function form_submit(mode,uid){
			var url = \"/ajax_site_index_title_editup.php?mode=\"+mode+\"&uid=\"+uid;
			
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
	if( isset($_SESSION['ajaxkey']) == $ajaxkey ) { // Ajax CallKey Securities Checking...
		
		include "./conf/sales.php";	// Sales 사용자 DB 접근.

    	$mode = _formmode();		// echo "mode is $mode <br>";
		$uid = _formdata("uid");	// echo "uid is $uid <br>";


		$body = $javascript._skin_page($skin_name,"site_index_title_edit");
		
		$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		/*
		$eid = _formdata("eid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _sales_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);
		*/

		//////////////////
		if($uid){
			$rows = _sales_rows_id("site_index_title",$uid);

			// $query = "select * from `site_index_title` where Id ='$uid'";
			//$rows = _sales_query_rows($query);
		}

		$css = "cssFormStyle";
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{pos}",_form_text("pos",$rows->pos,$css_textbox),$body);
		$body = str_replace("{code}",_form_text("code",$rows->code,$css_textbox),$body);

		$body = str_replace("{url}",_form_text("url",$rows->url,$css_textbox),$body);
		$body = str_replace("{alt}",_form_text("alt",$rows->alt,$css_textbox),$body);

		$body = str_replace("{images}",_form_file("userfile1",$css),$body);
		if($rows->images){
			$body = str_replace("{images_files}",$rows->images,$body);	
		} else $body = str_replace("{images_files}","등록됨 파일이 없습니다.",$body);
	

		if(isset($rows->inner)) $body = str_replace("{inner}",_form_checkbox("inner","on"),$body);
		else $body = str_replace("{inner}",_form_checkbox("inner",""),$body);

		$body = str_replace("{inner_width}",_form_text("inner_width",$rows->inner_width,$css_textbox),$body);
		$body = str_replace("{inner_height}",_form_text("inner_height",$rows->inner_height,$css_textbox),$body);
		$body = str_replace("{inner_top}",_form_text("inner_top",$rows->inner_top,$css_textbox),$body);
		$body = str_replace("{inner_left}",_form_text("inner_left",$rows->inner_left,$css_textbox),$body);

		$body = str_replace("{inner_title}",_form_text("inner_title",$rows->inner_title,$css_textbox),$body);
		$body = str_replace("{inner_html}",_form_textarea("inner_html",$rows->inner_html,"30",$css_textarea),$body);

		$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		
		echo $body;

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>