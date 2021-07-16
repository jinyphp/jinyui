<?php

	// update = 2016-02-15

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

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");
	
	$javascript = "<script>

		function form_submit(mode,uid){
					var url = \"ajax_site_boardlist_editup.php?uid=\"+uid+\"&mode=\"+mode;
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
					var url = \"ajax_site_boardlist_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);

                        }
                    });
				}

			


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
			var tagId = $(this).attr('id');
			
			// ckeditor
			CKEDITOR.replace(tagId,{
				filebrowserUploadUrl: '/topic/upload'
			});
		})

	



	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		$body = $javascript._theme_page($site_env->theme,"site_boardlist_edit",$site_language,$site_mobile);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		// $theme = _formdata("board");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");


		//echo "site_boardlist_Edit";


		$body=str_replace("{formstart}","<form id='data' name='theme' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='board' value='$board'>
					    				<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>",$body);
		$body = str_replace("{formend}","</form>",$body);



		$query = "select * from `site_boardlist` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			$body = str_replace("{form_submit}",$script."
			<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
			",$body);
		} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
			$body = str_replace("{form_submit}",$script."
			<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			",$body);
			
		}

		if($mode == "new"){
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);

			$body = str_replace("{check_login}",_form_checkbox("check_login",$rows->check_login),$body);
			$body = str_replace("{check_reply}",_form_checkbox("check_reply","on"),$body);
			$body = str_replace("{check_write}",_form_checkbox("check_write","on"),$body);
			$body = str_replace("{check_comment}",_form_checkbox("check_comment","on"),$body);

			$body = str_replace("{check_attach}",_form_checkbox("check_attach","on"),$body);
			$body = str_replace("{attach_label}",_form_text("attach_label","file1;file2;file3",$css_textbox),$body);

			$body = str_replace("{view_secure}",_form_checkbox("view_secure",$rows->view_secure),$body);
			$body = str_replace("{view_reply}",_form_checkbox("view_reply","on"),$body);
			$body = str_replace("{view_content}",_form_checkbox("view_content","on"),$body);

			// 본문 작성자 표기 : {view_writer} 
			$body = str_replace("{view_writer}",_form_checkbox("view_writer",$rows->view_writer),$body);

			// 본문 작성일자 표기 : {view_regdate}
			$body = str_replace("{view_regdate}",_form_checkbox("view_regdate",$rows->view_regdate),$body);

			// 본문 첨부파일 이미지 표기 : {view_images}
			$body = str_replace("{view_images}",_form_checkbox("view_images","on"),$body);

			// 첨부 이미지 최대 크기 : {view_images_maxsize} 
			$body = str_replace("{view_images_maxsize}",_form_text("view_images_maxsize","1000",$css_textbox),$body);

			// 첨부 이미지 출력방식 :  {view_images_type} 
			$body = str_replace("{view_images_type}",_form_text("view_images_type","",$css_textbox),$body);

			// 본문 첨부파일 정보 표기 : {view_attach_view} 
			$body = str_replace("{view_attach_view}",_form_checkbox("view_attach_view","on"),$body);

			// 본문 첨부파일 다운로드 링크 허용: {view_attach_down} 
			$body = str_replace("{view_attach_down}",_form_checkbox("view_attach_down","on"),$body);


		} else if($mode == "edit"){
			if($rows->enable)
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
			else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);

			$body = str_replace("{check_login}",_form_checkbox("check_login",$rows->check_login),$body);
			$body = str_replace("{check_reply}",_form_checkbox("check_reply",$rows->check_reply),$body);
			$body = str_replace("{check_write}",_form_checkbox("check_write",$rows->check_write),$body);
			$body = str_replace("{check_comment}",_form_checkbox("check_comment",$rows->check_comment),$body);

			$body = str_replace("{check_attach}",_form_checkbox("check_attach",$rows->check_attach),$body);
			$body = str_replace("{attach_label}",_form_text("attach_label",$rows->attach_label,$css_textbox),$body);

			$body = str_replace("{view_secure}",_form_checkbox("view_secure",$rows->view_secure),$body);
			$body = str_replace("{view_reply}",_form_checkbox("view_reply",$rows->view_reply),$body);
			$body = str_replace("{view_content}",_form_checkbox("view_content",$rows->view_content),$body);

			// 본문 작성자 표기 : {view_writer} 
			$body = str_replace("{view_writer}",_form_checkbox("view_writer",$rows->view_writer),$body);

			// 본문 작성일자 표기 : {view_regdate}
			$body = str_replace("{view_regdate}",_form_checkbox("view_regdate",$rows->view_regdate),$body);

			// 본문 첨부파일 이미지 표기 : {view_images}
			$body = str_replace("{view_images}",_form_checkbox("view_images",$rows->view_images),$body);

			// 첨부 이미지 최대 크기 : {view_images_maxsize} 
			$body = str_replace("{view_images_maxsize}",_form_text("view_images_maxsize",$rows->view_images_maxsize,$css_textbox),$body);

			// 첨부 이미지 출력방식 :  {view_images_type} 
			$body = str_replace("{view_images_type}",_form_text("view_images_type",$rows->view_images_type,$css_textbox),$body);

			// 본문 첨부파일 정보 표기 : {view_attach_view} 
			$body = str_replace("{view_attach_view}",_form_checkbox("view_attach_view",$rows->view_attach_view),$body);

			// 본문 첨부파일 다운로드 링크 허용: {view_attach_down} 
			$body = str_replace("{view_attach_down}",_form_checkbox("view_attach_down",$rows->view_attach_down),$body);
		
		}

		

		$form_type = "<select name='type' id=\"type\" style=\"$css_textbox\">";
		if($rows->type == "board") $form_type .= "<option value='board' selected>Board</option>"; else $form_type .= "<option value='board'>Board</option>";
		if($rows->type == "gallary") $form_type .= "<option value='gallary' selected>Gallary</option>"; else $form_type .= "<option value='gallary'>Gallary</option>";
		$form_type .= "</select>";
		$body = str_replace("{type}", $form_type,$body);


		if(isset($rows->code)) $code = $rows->code; else $code ="";
		$body = str_replace("{code}",_form_text("code",$code,$css_textbox),$body);

		if(isset($rows->title)) $title = $rows->title; else $title ="";
		$body = str_replace("{title}",_form_textarea("title",$rows->title,"8",$css_textarea),$body);

		if(isset($rows->listnum)) $listnum = $rows->listnum; else $listnum ="";
		$body = str_replace("{listnum}",_form_text("listnum",$listnum,$css_textbox),$body);

		if(isset($rows->images)) $images = $rows->images; else $images ="";
		$body = str_replace("{images}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);

		$body = str_replace("{skin_check}",_form_checkbox("skin_check",$rows->skin_check),$body);
		$body = str_replace("{skin}",_form_textarea("skin",$rows->skin,"8",$css_textarea),$body);

		

		$body = str_replace("{str}",_form_text("str",$rows->str,$css_textbox),$body);
		$body = str_replace("{bgcolor}",_form_text("bgcolor",$rows->bgcolor,$css_textbox),$body);
		$body = str_replace("{index_listnum}",_form_text("index_listnum",$rows->index_listnum,$css_textbox),$body);

		$body = str_replace("{themefiles_list}",_form_text("themefiles_list",$rows->themefiles_list,$css_textbox),$body);
		$body = str_replace("{themefiles_view}",_form_text("themefiles_view",$rows->themefiles_view,$css_textbox),$body);
		$body = str_replace("{themefiles_edit}",_form_text("themefiles_edit",$rows->themefiles_edit,$css_textbox),$body);

		

		$body = str_replace("{relation_goods}",_form_checkbox("relation_goods",$rows->relation_goods),$body);
		$body = str_replace("{relation_type}",_form_text("relation_type",$rows->relation_type,$css_textbox),$body);
		$body = str_replace("{relation_cols}",_form_text("relation_cols",$rows->relation_cols,$css_textbox),$body);
		$body = str_replace("{relation_rows}",_form_text("relation_rows",$rows->relation_rows,$css_textbox),$body);



		





		//#언어별 상품명, 상품설명
		$query1 = "select * from `site_language` ";	
		if($rowss1 = _sales_query_rowss($query1)){

			$seo_title = json_decode( stripslashes( $rows->seo_title));
			$seo_keyword = json_decode( stripslashes( $rows->seo_keyword));
			$seo_description = json_decode( stripslashes( $rows->seo_description));
					
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
				$products_forms .="<div class='tab-$i_content'>
						<table border='0' width='100%'' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>SEO 타이틀:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("seo_title_".$rows1->code,$seo_title->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>SEO 키워드:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("seo_keyword_".$rows1->code,$seo_keyword->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>SEO 설명:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("seo_description_".$rows1->code,$seo_description->$code,"2",$css_textarea)."</td>
						</tr>
						</table>										   
						</div>";

									
			}
								
			$body = str_replace("{seo_language}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
		}

		echo $body;


	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");		
	}


	
?>