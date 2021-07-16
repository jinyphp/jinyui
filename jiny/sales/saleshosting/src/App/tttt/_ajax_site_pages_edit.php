<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
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
	
	$javascript = "<script>

		function form_submit(mode,uid){
					var url = \"/ajax_site_pages_editup.php?uid=\"+uid+\"&mode=\"+mode;
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
					var url = \"/ajax_site_pages_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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
		include "./sales.php";

		// 지정된 상품 하나를 읽어옴
		function _site_pages_rows($uid){
			$query = "select * from `site_pages` WHERE `Id`='$uid'";
			//echo $query;
			if($rows = _sales_query_rows($query)){	
				return $rows;
			}	
		}

		/////////////
		$body = $javascript._skin_page($skin_name,"site_pages_edit");

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
		
		$body=str_replace("{formstart}","<form id='data' name='pages' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		
			
			
			
			if($pages = _site_pages_rows($uid)){
				$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
				$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			
			}

			
		   
			$css = "cssFormStyle";
			// 상품판매 여부 체크 
			if(isset($pages->enable)) $body = str_replace("{enable}",_form_check_enable($pages->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

			$body = str_replace("{code}",_form_text("code",$pages->code,$css_textbox),$body);
			$body = str_replace("{title}",_form_text("title",$pages->title,$css_textbox),$body);

			if(isset($pages->header)) $body = str_replace("{header}",_form_checkbox("header",$pages->header),$body);
			else $body = str_replace("{header}",_form_checkbox("header","on"),$body);

			if(isset($pages->footer)) $body = str_replace("{footer}",_form_checkbox("footer",$pages->footer),$body);
			else $body = str_replace("{footer}",_form_checkbox("footer","on"),$body);

			if(isset($pages->menu)) $body = str_replace("{menu}",_form_checkbox("menu",$pages->menu),$body);
			else $body = str_replace("{menu}",_form_checkbox("menu","on"),$body);
			

			$body = str_replace("{width}",_form_text("width",$pages->width,$css_textbox),$body);
			$body = str_replace("{align}",_form_text("align",$pages->align,$css_textbox),$body);
			$body = str_replace("{bgcolor}",_form_text("bgcolor",$pages->bgcolor,$css_textbox),$body);


			function _page_html($uid,$lang,$mobile){
				
				$query = "select * from `site_pages_html` WHERE `pid`='$uid' and `language`='$lang' and `mobile`='$mobile'";
				//echo $query."<br>";
				if($rows = _sales_query_rows($query)){	
					return $rows;
				}	
		
			}





		//#결제방식 선택 
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
			$desktop = _page_html($uid,$code,"pc");
			$desktop_html = stripslashes($desktop->html);

			$mobile = _page_html($uid,$code,"mobile");
			$mobile_html = stripslashes($mobile->html);


			$payment_descript .="<div id=\"tab".$j."\" class=\"tab_content\">
				<div style='font-size:12px;padding:10px;background-color:#FAFAFA;'>
					<table border='0' width='100%' cellspacing='5' cellpadding='5'>
						<tr>
							<td width='110' align='right'>SEO 타이틀(".$rows1->code.")</td>
							<td>"._form_text("title_".$rows1->code,$seo_title->$code,$css_textbox)."</td>
						</tr>
						<tr>
							<td width='110' align='right'>SEO 키워드(".$rows1->code.")</td>
							<td>"._form_text("keyword_".$rows1->code,$seo_keyword->$code,$css_textbox)."</td>
						</tr>
						<tr>
							<td width='110' align='right'>SEO 설명(".$rows1->code.")</td>
							<td>"._form_text("description_".$rows1->code,$seo_description->$code,$css_textbox)."</td>
						</tr>
					</table>

					<div style='font-size:12px;padding:10px;'>HTML PC</div>
					<textarea name='".$rows1->code."' rows='30'  style=\"$css_textarea\">".$desktop_html."</textarea>

					<div style='font-size:12px;padding:10px;'>HTML MOBILE</div>
					<textarea name='".$rows1->code."_m' rows='30'  style=\"$css_textarea\">".$mobile_html."</textarea>
						
					
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


/*
			//#언어별 상품명, 상품설명
			$query1 = "select * from `site_language` ";	
			if($rowss1 = _sales_query_rowss($query1)){
					
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
									
					
									
							
					$products_forms .="<div class='tab-$i_content'>
													   
											<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
											<tr>
												<td width='110' align='right'>SEO 타이틀(".$rows1->code.")</td>
												<td>"._form_textarea("title_".$rows1->code,stripslashes($desktop->title),"2",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right'>SEO 키워드(".$rows1->code.")</td>
												<td>"._form_textarea("keyword_".$rows1->code,stripslashes($desktop->keyword),"2",$css_textarea)."</td>
											</tr>
											<tr>
												<td width='110' align='right'>SEO 설명(".$rows1->code.")</td>
												<td>"._form_textarea("description_".$rows1->code,stripslashes($desktop->description),"3",$css_textarea)."</td>
											</tr>
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
			
			*/
			
			echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>