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
            var url = \"/easy/easy_title_inner.php?popup_mode=\" + mode;
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

			$query = "select * from site_index_title WHERE code = '$code'";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){
				
				$query = new query;
				$query->table_name = "site_index_title";
				$query->where = " code ='$code'";

				if(_formdata("inner")) $query->update("inner","on"); else $query->update("inner",""); 
				$query->update("inner_width",_formdata("inner_width"));
				$query->update("inner_height",_formdata("inner_height"));
				$query->update("inner_top",_formdata("inner_top"));
				$query->update("inner_left",_formdata("inner_left"));
				$query->update("inner_title",_formdata("inner_title"));
				$query->update("inner_html", addslashes( _formdata("inner_html") ) );
				
				$_query = $query->update_query();
				_mysqli_query($_query);
				// echo $_query;
			}
    	}


    	if($site_mobile == "m") $width = "300px"; else $width = "800px";

		$title = "EASY 타이틀 Inner HTML 설정";
		$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"easy_title_inner",$site_language,$site_mobile) );


		$title_code = explode(" ", $class);
		$plug = explode("_", $title_code[0]);
		$code = $plug[1];


		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='easy' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='code' value='$code'>
								<input type='hidden' name='class' value='$class'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		$query = "select * from site_index_title where code ='$code';";
		//echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){

			if(isset($rows->inner)) {
				$body = str_replace("{inner}",_form_checkbox("inner","on"),$body);
			} else {
				$body = str_replace("{inner}",_form_checkbox("inner",""),$body);
			}

			$body = str_replace("{inner_width}",_form_text("inner_width",$rows->inner_width,$css_textbox),$body);
			$body = str_replace("{inner_height}",_form_text("inner_height",$rows->inner_height,$css_textbox),$body);
			$body = str_replace("{inner_top}",_form_text("inner_top",$rows->inner_top,$css_textbox),$body);
			$body = str_replace("{inner_left}",_form_text("inner_left",$rows->inner_left,$css_textbox),$body);

			$body = str_replace("{inner_title}",_form_text("inner_title",$rows->inner_title,$css_textbox),$body);
			$body = str_replace("{inner_html}",_form_textarea("inner_html",$rows->inner_html,"30",$css_textarea),$body);
			

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