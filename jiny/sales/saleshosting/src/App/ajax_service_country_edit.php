<?php

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

	include "./func/css.php";



	function _country_tabbar($title,$site_language){
		//#언어별 메뉴명 설정
		$query = "select * from `site_language` ";	
		if($rowss = _sales_query_rowss($query)){
			$skin_language = "";
			$skin_forms = "";
			for($i=0,$j=1;$i<count($rowss);$i++,$j++){
				$rows= $rowss[$i];
				$code = $rows->code;

				//탭라벨 이름표기
				if($site_language == $rows->code){
					$skin_language .= "<input id='tab-".$i."' type='radio' name='skin_language' value='".$rows->code."' checked=\"checked\">";
				} else {								
					$skin_language .= "<input id='tab-".$i."' type='radio' name='skin_language' value='".$rows->code."'>";
				}

				$skin_language .= "<label for='tab-".$i."'>".$code."</label>";
						
				if(isset($title->$code)) $lang_text = $title->$code; else $lang_text = "";
				$skin_forms .="<div class='tab-$j"."_content'>				   
										<table border='0' width='100%' cellspacing='2' cellpadding='2'  bgcolor='#FAFAFA'>			
											<tr>
											<td><textarea name='".$code."' rows='5' style='width:100%'>".$lang_text."</textarea></td>
											</tr>
										</table>
										</div>";
			}
								
			$tabbar = "<div id='css_tabs'> $skin_language $skin_forms </div>";
		}	

		return $tabbar;
	}


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
	
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$body = _skin_page($skin_name,"service_country_edit");

		
		$ajaxkey = _formdata("ajaxkey");
		$mode = _formmode();
		$uid = _formdata("uid");


		$body=str_replace("{formstart}","",$body);
		$body=str_replace("{formend}","",$body);


		$body = str_replace("{form_submit}","
				<script>
				function form_submit(mode,uid){
					var url = \"/ajax_service_country_editup.php?uid=\"+uid+\"&mode=\"+mode;
				
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#country_edit').html(data);
                        }
                    });
				}

				function form_delete(mode,uid){
					var url = \"/ajax_service_country_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#country_edit').html(data);

                        }
                    });
				}
				</script>
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

		if($mode == "new"){

			$body = str_replace("{country_name}", _country_tabbar("",$site_language),$body);
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);

			$body = str_replace("{code}","<input type='text' name='code' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{replace_code}","<input type='text' name='replace_code' style=\"$css_textboxe\" >",$body);

			$body = str_replace("{tax}","<input type='text' name='tax' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{language}","<input type='text' name='language' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{currency}","<input type='text' name='currency' style=\"$css_textboxe\" >",$body);

			$body = str_replace("{address}","<input type='text' name='address' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{phone}","<input type='text' name='phone' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{fax}","<input type='text' name='fax' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{email}","<input type='text' name='email' style=\"$css_textboxe\" >",$body);

		} else if($mode == "edit"){
			
			$query = "select * from `country` where Id='$uid'";	
			//echo "$query <br>";
			if($rows = _sales_query_rows($query)){
				//echo $category->title;
				$title = stripslashes($rows->name);
				$title = json_decode($title);
			}

			$body = str_replace("{country_name}", _country_tabbar($title,$site_language),$body);
			
			if($rows->enable)
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
			else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);

			$body = str_replace("{code}","<input type='text' name='code' value='".$rows->code."' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{replace_code}","<input type='text' name='replace_code' value='".$rows->replace_code."' style=\"$css_textboxe\" >",$body);

			$body = str_replace("{tax}","<input type='text' name='tax' value='".$rows->tax."' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{language}","<input type='text' name='language' value='".$rows->language."' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{currency}","<input type='text' name='currency' value='".$rows->currency."' style=\"$css_textboxe\" >",$body);
			

			$body = str_replace("{country_address}","<input type='text' name='address' value='".$rows->address."' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{country_phone}","<input type='text' name='phone' value='".$rows->phone."' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{country_fax}","<input type='text' name='fax' value='".$rows->fax."' style=\"$css_textboxe\" >",$body);
			$body = str_replace("{country_email}","<input type='text' name='email' value='".$rows->email."' style=\"$css_textboxe\" >",$body);

		}

		echo $body;		
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>