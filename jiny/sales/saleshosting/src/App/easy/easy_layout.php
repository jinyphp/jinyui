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
            var url = \"/easy/easy_layout.php\";
            // var formData = new FormData($('#data')[0]);
            var form = document.easy;

            form.popup_mode.value = mode;

            ajax_async('#popup_body',url);
			
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

		$domain = $_SERVER['HTTP_HOST'];
    	$popup_mode = _formdata("popup_mode");
    	// echo "popup_mode = ".$popup_mode."<br>";

    	if($popup_mode == "edit"){

    		$query = "UPDATE `site_env` SET ";
		
			$align = _formdata("align"); $query .= "`align`='$align' ,";
			$width = _formdata("width"); $query .= "`width`='$width' ,";
			$bgcolor = _formdata("bgcolor"); $query .= "`bgcolor`='$bgcolor' ,";
			$left_margin = _formdata("left_margin"); $query .= "`left_margin`='$left_margin' ,";
			$top_margin = _formdata("top_margin"); $query .= "`top_margin`='$top_margin' ,";

			$query .= "WHERE `domain`='$domain'";
			$query = str_replace(",WHERE","WHERE",$query);
			// echo $query;
			_mysqli_query($query);



    	}


    	if($site_mobile == "m") $width = "300px"; else $width = "500px";

		$title = "EASY 레이아웃 설정";
		$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"easy_layout",$site_language,$site_mobile) );


		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='easy' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='popup_mode'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		$query = "select * from `site_env` where domain ='$domain';";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){

			// 사이트 가로크기
			if($rows->width) $layout_width = $rows->width; else $layout_width = "1000px";
			$body = str_replace("{width}",_form_text("width",$layout_width,$css_textbox),$body);

			// 상단여백
			if($rows->topMargin) $layout_topMargin = $rows->topMargin; else $layout_topMargin = "0";
			$body = str_replace("{top_margin}",_form_text("top_margin",$layout_topMargin,$css_textbox),$body);

			// 좌측여백
			if($rows->leftMargin) $layout_leftMargin = $rows->leftMargin; else $layout_leftMargin = "0";
			$body = str_replace("{left_margin}",_form_text("left_margin",$layout_leftMargin,$css_textbox),$body);

			// 사이트 정렬방식
			if($rows->align) $layout_align = $rows->align; else $layout_align = "center";
			$form_align = "<select name='align' id=\"align\" style=\"$css_textbox\">";
			if($layout_align == "center") $form_align .= "<option value='center' selected>Center</option>"; else $form_align .= "<option value='center'>Center</option>";
			if($layout_align == "left") $form_align .= "<option value='left' selected>Left</option>"; else $form_align .= "<option value='left'>Left</option>";
			if($layout_align == "right") $form_align .= "<option value='right' selected>Right</option>"; else $form_align .= "<option value='right'>Right</option>";
			$form_align .= "</select>";
			$body = str_replace("{align}", $form_align,$body);

			// 사이트 배경색 	
			if($rows->bgcolor) $bgcolor =$rows->bgcolor; else $bgcolor = "ffffff";
			$body = str_replace("{bgcolor}","<input type='color' name='bgcolor' value='$bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

			$form_submit = "<input type='button' value='적용' onclick=\"javascript:popup_submit('edit')\" style=\"".$css_btn_gray."\" >  ";
			$body = str_replace("{form_submit}",$form_submit,$body);

			///
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