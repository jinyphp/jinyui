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
	include "./func/members.php";
	include "./func/css.php";
	

	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		$skin_name = "default";
		$body = _skin_page("default","site_boardlist_edit");


		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$cate = _formdata("cate");
		$ajaxkey = _formdata("ajaxkey");

		
	/*
			
			$body=str_replace("{formstart}","<form id='data' name='board' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
			$body = str_replace("{formend}","</form>",$body);
*/
			
				

		$query = "select * from `site_boardlist` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			$body = str_replace("{form_submit}",$script."
			<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" id=\"".$btn_style_gray."\" >
			",$body);
		} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
			$body = str_replace("{form_submit}",$script."
			<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
			",$body);
			
		}	
		

		
		
		if($rows->enable)
		$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
		else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);

		if(isset($rows->code)) $code = $rows->code; else $code ="";
		$body = str_replace("{code}",_form_text("code",$code,$css_textbox),$body);

		if(isset($rows->title)) $title = $rows->title; else $title ="";
		$body = str_replace("{title}",_form_text("title",$title,$css_textbox),$body);

		if(isset($rows->listnum)) $listnum = $rows->listnum; else $listnum ="";
		$body = str_replace("{listnum}",_form_text("listnum",$listnum,$css_textbox),$body);

		if(isset($rows->images)) $images = $rows->images; else $images ="";
		$body = str_replace("{images}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);

		$body = str_replace("{skin_check}",_form_checkbox("skin_check",$rows->skin_check),$body);
		$body = str_replace("{skin}",_form_textarea("skin",$rows->skin,"8",$css_textarea),$body);


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
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>