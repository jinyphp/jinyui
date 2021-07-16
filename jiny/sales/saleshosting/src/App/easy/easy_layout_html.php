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
            var url = \"/easy/easy_layout_html.php\";
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


	function _themefiles_html($uid,$lang,$mobile){
		if($uid>0){
			$query = "select * from site_themefiles_html WHERE `pid`='$uid' and `language`='$lang' and `mobile`='$mobile'";
			
			if($rows = _mysqli_query_rows($query)) return $rows;
		}
		
	}

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

			$filename = "layout";
			$query1 = "select * from `site_language`";
			if($rowss1 = _mysqli_query_rowss($query1)){
				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					$desktop =  addslashes( _formdata($rows1->code) );
					$query = "UPDATE site_themefiles_html SET `html` = '$desktop' where `filename` = '$filename' and `language`='".$rows1->code."' and `mobile`='pc'";
					//echo $query."<br>";
					_mysqli_query($query);

					$mobile =  addslashes( _formdata($rows1->code."_m") );
					$query = "UPDATE site_themefiles_html SET `html` = '$mobile' where `filename` = '$filename' and `language`='".$rows1->code."' and `mobile`='m'";
					//echo $query."<br>";
					_mysqli_query($query);			

				}
			}	

    	}




    	if($site_mobile == "m") $width = "300px"; else $width = $site_env->width."px";

		$title = "EASY 레이아웃 설정";
		$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"easy_layout_html",$site_language,$site_mobile) );


		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='easy' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='popup_mode'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$query = "select * from site_themefiles WHERE `filename`='layout' and `theme`='".$site_env->theme."'";
		// echo $query."<br>";
		if($themefiles_rows = _mysqli_query_rows($query)){
		}
			
		//#언어별 layout 템플릿
		$query1 = "select * from `site_language` ";	
		if($rowss1 = _mysqli_query_rowss($query1)){
					
			$products_language = "";
			$products_forms = "";
			for($i=0;$i<count($rowss1);$i++){
				$rows1=$rowss1[$i];

				if($rows1->code == $site_language){
					$products_language .= "<input id='tab-$i' type='radio' name='page_language' value='".$rows1->code."' checked=\"checked\">";
				} else {
					$products_language .= "<input id='tab-$i' type='radio' name='page_language' value='".$rows1->code."'>";
				}
									
				$products_language .= "<label for='tab-$i'>".$rows1->code."</label>";
									
				$code = $rows1->code;	
				$desktop = _themefiles_html($themefiles_rows->Id,$code,"pc");
				$desktop_html = stripslashes($desktop->html);

				$mobile = _themefiles_html($themefiles_rows->Id,$code,"m");
				$mobile_html = stripslashes($mobile->html);
									
							
				$products_forms .="<div class='tab-$i_content'>													   
					<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
					<tr>
					<td width='110' align='right' valign='top'>HTML PC</td>
					<td>"._form_textarea($rows1->code,$desktop_html,"20",$css_textarea)."</td>
					</tr>
					<tr>
					<td width='110' align='right' valign='top'>HTML MOBILE</td>
					<td>"._form_textarea($rows1->code."_m",$mobile_html,"20",$css_textarea)."</td>
					</tr>
					</table>													   
				</div>";									 
									
			}
								
			$body = str_replace("{language_html}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
								
		}
		
		$form_submit = "<input type='button' value='적용' onclick=\"javascript:popup_submit('edit')\" style=\"".$css_btn_gray."\" >  ";
		$body = str_replace("{form_submit}",$form_submit,$body);

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