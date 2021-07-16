<?

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
	include "./func/butten.php";
	include "./func/css.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

	

		/////////////
		$skin_name = "default";
		$body = _skin_page("default","site_members_agreement_edit");

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
		
			$script = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_site_members_agreement_editup.php?uid=\"+uid+\"&mode=\"+mode;
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

				function form_delete(mode,uid){
					var url = \"/ajax_site_members_agreement_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);

                        }
                    });
				}
				</script>";
			
			// 동의서 코드를 읽어옴 
			function _site_members_agreement_rows($uid){
				$query = "select * from `site_members_agree` WHERE `Id`='$uid'";
				//echo $query;
				if($rows = _sales_query_rows($query)){	
					return $rows;
				}	
			}
			
			if($agreement = _site_members_agreement_rows($uid)){
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

			
		   
			$css = "cssFormStyle";
			// 상품판매 여부 체크 
			if(isset($agreement->enable)) $body = str_replace("{enable}",_form_check_enable($agreement->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

			if(isset($agreement->require)) $body = str_replace("{require}",_form_checkbox("require",$agreement->require),$body);
			else $body = str_replace("{require}",_form_checkbox("require",""),$body);

			$body = str_replace("{code}",_form_text("code",$agreement->code,$css_textbox),$body);

			function _agreement_Text($code,$lang){
				
				$query = "select * from `site_members_agree` WHERE `code`='$code' and `language`='$lang'";
				//echo $query."<br>";
				if($rows = _sales_query_rows($query)){	
					return $rows;
				}	
		
			}

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
									
					$code = $rows1->code;	
					$agree_rows = _agreement_text($agreement->code,$rows1->code);
					$text = stripslashes($agree_rows->agreement);
									
							
					$products_forms .="<div class='tab-$i_content'>
													   
											<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
											<tr>
												<td width='110' align='right'>타이틀(".$rows1->code.")</td>
												<td>"._form_textarea("title_".$rows1->code,stripslashes($agree_rows->title),"2",$css_textbox)."</td>
											</tr>
											<tr>
												<td width='110' align='right' valign='top'>Agreement</td>
												<td>"._form_textarea($rows1->code,$text,"30",$css_textarea)."</td>
											</tr>
											</table>
													   
										</div>";									 
									
				}
								
				$body = str_replace("{language_html}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
								
			}
			
			
			
			echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>