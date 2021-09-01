<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  
	//*

	// update : 2016.01.09 = 코드정리 

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

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");
	

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");

	$css_tabbar = "<style>    
    	ul.tabs {
    		margin: 0;
    		padding: 0;
   			float: left;
    		list-style: none;
    		height: 32px;
    		border-bottom: 1px solid #eee;
    		border-left: 1px solid #eee;
    		width: 100%;
    		font-family:\"dotum\";
    		font-size:12px;
		}

		ul.tabs li {
    		float: left;
    		text-align:center;
    		cursor: pointer;
    		width:50px;
    		height: 31px;
    		line-height: 31px;
    		border: 1px solid #eee;
    		border-left: none;
    		font-weight: bold;
    		background: #fafafa;
    		overflow: hidden;
   		 position: relative;
		}

		ul.tabs li.active {
    		background: #FFFFFF;
    		border-bottom: 1px solid #FFFFFF;
		}

		.tab_container {
    		border: 1px solid #eee;
    		border-top: none;
    		clear: both;
    		float: left;
    		width: 100%;
    		background: #FFFFFF;
		}

		.tab_content {
    		padding: 5px;
    		font-size: 12px;
    		display: none;
		}

		.tab_container .tab_content ul {
   			width:100%;
    		margin:0px;
    		padding:0px;
		}

		.tab_container .tab_content ul li {
    		padding:5px;
    		list-style:none;
		}

		#container {
    		width: 100%;
    		margin: 0 auto;
		}

	</style>";
	
	// ++ javascript
	$javascript = "<script>
		function popup_submit(mode,uid){
			var url = \"ajax_pages_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#popup_data')[0]);
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

		function form_delete(mode){	
			var returnValue = confirm(\"삭제하겠습니까?\");
			if(returnValue == true){
				var url = \"ajax_pages_editup.php?mode=\"+mode;
				var form = document.goods;
				ajax_html('#mainbody',url);
			}
		}		

		

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

    	$('#popup_close').hover(function() {
        	$(this).css('cursor','pointer');
    	});

    	// Tab BAR 처리		
    	$(function () {
    		$(\".tab_content\").hide();
    		$(\".tab_content:first\").show();

    		$(\"ul.tabs li\").click(function () {
        		$(\"ul.tabs li\").removeClass(\"active\").css(\"color\", \"#333\");
        		//$(this).addClass(\"active\").css({\"color\": \"darkred\",\"font-weight\": \"bolder\"});
        		$(this).addClass(\"active\").css(\"color\", \"darkred\");
        		$(\".tab_content\").hide()
        		var activeTab = $(this).attr(\"rel\");
        		$(\"#\" + activeTab).fadeIn();
    		});
		});
	
		
		$('textarea').each(function(){
			var tagId = \"#\"+$(this).attr('id');
			
			/*
			// ckeditor
			CKEDITOR.replace(tagId,{
				filebrowserUploadUrl: '/topic/upload'
			});
			*/

			/*
			tinymce.init({
    			selector: tagId
			});
			*/

			/*
			tinymce.init({
				selector: tagId,
				height: 500,
				theme: 'modern',
				plugins: [
					'advlist autolink lists link image charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen',
					'insertdatetime media nonbreaking save table contextmenu directionality',
					'emoticons template paste textcolor colorpicker textpattern imagetools'
				],
				toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				toolbar2: 'print preview media | forecolor backcolor emoticons',
				image_advtab: true,
				templates: [
					{ title: 'Test template 1', content: 'Test 1' },
					{ title: 'Test template 2', content: 'Test 2' }
				],
				content_css: [
					'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
					'//www.tinymce.com/css/codepen.min.css'
				]
			});
			*/


		});


		function editor(code){
			var tagId = \"#\"+code;
			tinymce.init({
				selector: tagId,
				height: 500,
				theme: 'modern',
				plugins: [
					'advlist autolink lists link image charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen',
					'insertdatetime media nonbreaking save table contextmenu directionality',
					'emoticons template paste textcolor colorpicker textpattern imagetools'
				],
				toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				toolbar2: 'print preview media | forecolor backcolor emoticons',
				image_advtab: true,
				templates: [
					{ title: 'Test template 1', content: 'Test 1' },
					{ title: 'Test template 2', content: 'Test 2' }
				],
				content_css: [
					'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
					'//www.tinymce.com/css/codepen.min.css'
				]
			});

		}

		function undo_editor(code){
			// alert(code);
			var tagId = \"#\"+code;
			tinymce.remove(tagId);
		}	

	</script>";

	// form 칼라 픽업 
	$javascript .= "<script src=\"../js/jscolor.js\"></script>\n";
	// $javascript .= "<script src=\"//cdn.ckeditor.com/4.5.6/standard/ckeditor.js\"></script>\n";


	// 지정된 상품 하나를 읽어옴
	function _site_pages_rows($uid){
		$query = "select * from `site_pages` WHERE `Id`='$uid'";
		//echo $query;
		if($rows = _mysqli_query_rows($query)){	
			return $rows;
		}	
	}

	function _page_html($code,$lang,$mobile){				
		$query = "select * from `site_pages_html` WHERE `code`='$code' and `language`='$lang' and `mobile`='$mobile'";
		//echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
			return $rows;
		}		
	}


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		if($site_mobile == "m") $width = "300px"; else $width = "1100px"; 		

		$title = "페이지수정";
		$body = "<script src=\"/js/tabbar.js\"></script>\n".$javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"pages_edit",$site_language,$site_mobile) );

		/////////////
		
		// 서브메뉴 출력 
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,185),$body);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		// echo $mode;
		
		$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'>										
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>
										<input type='hidden' name='list_num' value='$list_num'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
	
		if($pages = _site_pages_rows($uid)){
			// 수정모드
			$form_submit = "<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);
		} else {
			// 신규모드 
			$form_submit = "<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);		
		}

		$body = str_replace("{help}","<i class=\"fa fa-info-circle\" style=\"font-size:18;color:#333333\"></i>",$body);	

		// === 이미지 등록 팝업 ===
		$body = str_replace("{images_upload}","<input type='button' value='이미지등록' onclick=\"javascript:popup_upload()\" style=\"".$css_btn_gray."\" >",$body);



		//# ***********************************************************************************************************
		// 관련 이미지 ajax로 출력
		$code = $pages->code;
		$body = str_replace("{html_images_upload}","<input type='file' name='userfile' id=\"input_upload\">",$body);	
		$body = str_replace("{upload}","<input type='button' value='업로드' onclick=\"javascript:image_upload('upload','".$pages->code."')\" style=\"".$css_btn_gray."\" >",$body);	
		
		/*
		$body = str_replace("{images_files}","
					<span id=\"images_files\">
					<center><img src='../images/loading.gif' border='0'></center>
					
					<script>									
						var url = \"ajax_site_pages_files.php\";
					
						$.ajax({
               				url:url,
                			type:'post',
                			data:$('form').serialize(),
                			success:function(data){
                				$('#images_files').html(data);
                			}
            			});
					</script>
				
					</span>",$body);
		*/			

			
		   
		$css = "cssFormStyle";
		// 상품판매 여부 체크 
		if(isset($pages->enable)) $body = str_replace("{enable}",_form_check_enable($pages->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{code}","<input type='text' name='code' value='".$pages->code."' style=\"$css_textbox\" id=\"input_code\">",$body);
		$body = str_replace("{title}",_form_text("title",$pages->title,$css_textbox),$body);

		if(isset($pages->header)) $body = str_replace("{header}",_form_checkbox("header",$pages->header),$body);
		else $body = str_replace("{header}",_form_checkbox("header","on"),$body);

		if(isset($pages->footer)) $body = str_replace("{footer}",_form_checkbox("footer",$pages->footer),$body);
		else $body = str_replace("{footer}",_form_checkbox("footer","on"),$body);

		if(isset($pages->menu)) $body = str_replace("{menu}",_form_checkbox("menu",$pages->menu),$body);
		else $body = str_replace("{menu}",_form_checkbox("menu","on"),$body);
			

		$body = str_replace("{width}",_form_text("width",$pages->width,$css_textbox),$body);


		$form_align = "<select name='align' id=\"align\" style=\"$css_textbox\">";
		if($pages->align == "center") $form_align .= "<option value='center' selected>Center</option>"; else $form_align .= "<option value='center'>Center</option>";
		if($pages->align == "left") $form_align .= "<option value='left' selected>Left</option>"; else $form_align .= "<option value='left'>Left</option>";
		if($pages->align == "right") $form_align .= "<option value='right' selected>Right</option>"; else $form_align .= "<option value='right'>Right</option>";
		$form_align .= "</select>";
		$body = str_replace("{align}", $form_align,$body);

		// $body = str_replace("{align}",_form_text("align",$pages->align,$css_textbox),$body);
		
		if($pages->bgcolor) $bgcolor =$pages->bgcolor; else $bgcolor = "ffffff";
		$body = str_replace("{bgcolor}","<input type='color' name='bgcolor' value='$bgcolor' class=\"jscolor\" style=\"$css_textbox\" >",$body);

		// ++ 서브메뉴 출력설정
		if(isset($pages->sub_menu)) $body = str_replace("{sub_menu}",_form_checkbox("sub_menu",$pages->sub_menu),$body);
		else $body = str_replace("{sub_menu}",_form_checkbox("sub_menu","on"),$body);

		$body = str_replace("{sub_width}",_form_text("sub_width",$pages->sub_width,$css_textbox),$body);

		$form_align = "<select name='sub_align' id=\"align\" style=\"$css_textbox\">";
		if($pages->sub_align == "left") $form_align .= "<option value='left' selected>Left</option>"; else $form_align .= "<option value='left'>Left</option>";
		if($pages->sub_align == "right") $form_align .= "<option value='right' selected>Right</option>"; else $form_align .= "<option value='right'>Right</option>";
		$form_align .= "</select>";
		$body = str_replace("{sub_align}", $form_align,$body);

		if(isset($pages->title_enable)) $body = str_replace("{title_enable}",_form_checkbox("title_enable",$pages->title_enable),$body);
		else $body = str_replace("{title_enable}",_form_checkbox("title_enable","on"),$body);

	$query1 = "select * from `site_language` ";	
	if($rowss1 = _mysqli_query_rowss($query1)){

		$payment_select = "";
		$payment_descript = "";

		for($i=0,$j=1;$i<count($rowss1);$i++,$j++){
			$rows1=$rowss1[$i];

			if($rows1->code == $site_language){
				$payment_select .= "<li class=\"active\" rel=\"tab".$j."\">".$rows1->code."</li>";
			} else {
				$payment_select .= "<li rel=\"tab".$j."\">".$rows1->code."</li>";
			}

			$code = $rows1->code;
			
			if($mode == "edit"){
				// 수정모드일 경우, 언어별/기기별 내용을 읽어옴.
				$desktop = _page_html($pages->code,$code,"pc");
				$desktop_html = stripslashes($desktop->html);

				$mobile = _page_html($pages->code,$code,"m");
				$mobile_html = stripslashes($mobile->html);


			}
				
			


			$payment_descript .="<div id=\"tab".$j."\" class=\"tab_content\">
				<div style='font-size:12px;padding:10px;background-color:#FAFAFA;'>
					<table border='0' width='100%' cellspacing='5' cellpadding='5'>
						<tr>
							<td width='110' align='right'>SEO 타이틀(".$rows1->code.")</td>
							<td>"._form_text("title_".$rows1->code,$desktop->title,$css_textbox)."</td>
						</tr>
						<tr>
							<td width='110' align='right'>SEO 키워드(".$rows1->code.")</td>
							<td>"._form_text("keyword_".$rows1->code,$desktop->keyword,$css_textbox)."</td>
						</tr>
						<tr>
							<td width='110' align='right'>SEO 설명(".$rows1->code.")</td>
							<td>"._form_text("description_".$rows1->code,$desktop->description,$css_textbox)."</td>
						</tr>
					</table>

					<table border='0' width='100%' cellspacing='5' cellpadding='5'>
						<tr>
							<td style='font-size:12px;padding:10px;'>PC용</td>
							<td width='100'> <input type='button' value='HTML' onclick=\"javascript:undo_editor('".$rows1->code."_pc')\" style=\"".$css_btn_gray."\" > </td>
							<td width='100'> <input type='button' value='EDITOR' onclick=\"javascript:editor('".$rows1->code."_pc')\" style=\"".$css_btn_gray."\" > </td>
						</tr>
					</table>	
					<textarea name='".$rows1->code."' rows='30' style=\"$css_textarea\" id=\"".$rows1->code."_pc\">".$desktop_html."</textarea>


					<table border='0' width='100%' cellspacing='5' cellpadding='5'>
						<tr>
							<td style='font-size:12px;padding:10px;'>모바일용</td>
							<td width='100'> <input type='button' value='HTML' onclick=\"javascript:undo_editor('".$rows1->code."_m')\" style=\"".$css_btn_gray."\" > </td>
							<td width='100'> <input type='button' value='EDITOR' onclick=\"javascript:editor('".$rows1->code."_m')\" style=\"".$css_btn_gray."\" > </td>
						</tr>
					</table>
					<textarea name='".$rows1->code."_m' rows='30' style=\"$css_textarea\" id=\"".$rows1->code."_m\">".$mobile_html."</textarea>
						
					
				</div>									   												   
			</div>";

			// id=\"editor_".$rows1->code."\"
			// id=\"editor_".$rows1->code."_m\"

		}	

		$payment_tab ="<div id=\"container\">
    		<ul class=\"tabs\">".$payment_select."</ul>
    		<div class=\"tab_container\">".$payment_descript."</div>
			</div>";								
		$body = str_replace("{language_html}",$css_tabbar.$payment_tab,$body);					
	} else {
		$body = str_replace("{language_html}","설치된 지불결제 모듈이 없습니다.",$body);	
	}

			


		
	
		echo $body;

	} else {
		/*
		$body = _theme_pages($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;
		*/
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo "$msg";
	}


	
?>