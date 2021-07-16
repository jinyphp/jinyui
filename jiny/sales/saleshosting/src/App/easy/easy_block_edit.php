<?
	//*  OpenShopping V2.1
	//*  programing by hojin lee

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	$javascript = "<script>
		function popup_submit(mode){
            var url = \"/easy/easy_block_edit.php?popup_mode=\" + mode;
            var formData = new FormData($('#data')[0]);
            // var form = document.easy;
            // form.popup_mode.value = mode;

            // ajax_async('#popup_body',url);

            $.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#popup_body').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});

			
        	// 팝업창 종료
			popup_close();
            	
		}		

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

	</script>";

	// form 칼라 픽업 
	$javascript .= "<script src=\"../js/jscolor.js\"></script>\n";

	/*
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
	*/

		// 서비스 관련 함수들 
		include "service_function.php";

		// $domain = $_SERVER['HTTP_HOST'];
    	$popup_mode = _formdata("popup_mode");
    	//echo "popup_mode = ".$popup_mode."<br>";
    	
    	$code = _formdata("code");
    	$class = _formdata("class");

    	if($popup_mode == "edit"){

			$query = "select * from site_block WHERE code = '$code'";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){
				
				$query = "UPDATE `site_block` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
				$title = _formdata("title"); $query .= "`title`='$title' ,";
				$code = _formdata("code"); $query .= "`code`='$code' ,";

				$html = _formdata("html"); $query .= "`html`='".addslashes($html)."' ,";


				$query .= "WHERE `code`='$code'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query;
				_mysqli_query($query);
			}
    	}


    	if($site_mobile == "m") $width = "300px"; else $width = "800px";

		$title = "EASY 블럭 HTML 설정";
		$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"easy_block_edit",$site_language,$site_mobile) );


		$title_code = explode(" ", $class);
		$plug = explode("block_", $title_code[0]);
		$code = $plug[1];


		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='easy' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='code' value='$code'>
								<input type='hidden' name='class' value='$class'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		$query = "select * from site_block where code ='$code';";
		// echo $query."<br>";
		if($block_rows = _mysqli_query_rows($query)){

			if(isset($block_rows->enable)) $body = str_replace("{enable}",_form_check_enable($block_rows->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

			$body = str_replace("{code}",_form_text("code",$block_rows->code,$css_textbox),$body);
			$body = str_replace("{title}",_form_text("title",$block_rows->title,$css_textbox),$body);
			
			$body = str_replace("{html}","<textarea name='html' rows='20' style='$css_textarea'>".stripslashes($block_rows->html)."</textarea>",$body);
			

			$form_submit = "<input type='button' value='저장' onclick=\"javascript:popup_submit('edit')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);
		}

		echo $body;
	
	/*
	} else {
		// Ajax 오류 메세지 출력
		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;	
	}
	*/

	
?>