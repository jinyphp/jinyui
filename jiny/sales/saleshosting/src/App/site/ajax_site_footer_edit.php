<?

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

	$javascript = "<script>
		
		function form_submit(mode,uid){
			var url = \"ajax_site_footer_editup.php?mode=\"+mode+\"&uid=\"+uid;
			
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


	</script>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

    	$body = $javascript._theme_page($site_env->theme,"site_footer_edit",$site_language,$site_mobile);

    	$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");

		$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>	
					    				<input type='hidden' name='list_num' value='$list_num'>									    					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		//////////////////
		if($uid){
			$query = "select * from `site_env` where Id =$uid";
			//echo $query."<br>";
			$site_env_rows = _sales_query_rows($query);

			$query = "select * from `site_footer` where eid =$uid";
			//echo $query."<br>";
			$footer_rows = _sales_query_rows($query);

		}



			
			
			
			if($footer_rows){
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
				",$body);
			} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
				$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
				",$body);
			
			}




			$css = "cssFormStyle";
			// 활성화 여부 체크 
			if(isset($footer_rows->enable)) $body = str_replace("{enable}",_form_check_enable($footer_rows->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

			$body = str_replace("{title}",_form_text("title",$footer_rows->title,$css_textbox),$body);

			$body = str_replace("{width}",_form_text("width",$footer_rows->width,$css),$body);
			$body = str_replace("{align}",_form_text("align",$footer_rows->align,$css),$body);
			$body = str_replace("{bgcolor}",_form_text("bgcolor",$footer_rows->bgcolor,$css),$body);

			$body = str_replace("{logo}",_form_file("logo",$css),$body);

			$body = str_replace("{login_images}",_form_file("login_images",$css),$body);
			if(isset($footer_rows->login_check)) $body = str_replace("{login_check}",_form_checkbox("login_check",$footer_rows->login_check),$body);
			else $body = str_replace("{login_check}",_form_checkbox("login_check",""),$body);

			$body = str_replace("{logout_images}",_form_file("logout_images",$css),$body);
			if(isset($footer_rows->logout_check)) $body = str_replace("{logout_check}",_form_checkbox("logout_check",$footer_rows->logout_check),$body);
			else $body = str_replace("{logout_check}",_form_checkbox("logout_check",""),$body);

			$body = str_replace("{member_images}",_form_file("member_images",$css),$body);
			if(isset($footer_rows->member_check)) $body = str_replace("{member_check}",_form_checkbox("member_check",$footer_rows->member_check),$body);
			else $body = str_replace("{member_check}",_form_checkbox("member_check",""),$body);

			$body = str_replace("{myinfo_images}",_form_file("myinfo_images",$css),$body);
			if(isset($footer_rows->myinfo_check)) $body = str_replace("{myinfo_check}",_form_checkbox("myinfo_check",$footer_rows->myinfo_check),$body);
			else $body = str_replace("{myinfo_check}",_form_checkbox("myinfo_check",""),$body);

			$body = str_replace("{wish_images}",_form_file("wish_images",$css),$body);
			if(isset($footer_rows->wish_check)) $body = str_replace("{wish_check}",_form_checkbox("wish_check",$footer_rows->wish_check),$body);
			else $body = str_replace("{wish_check}",_form_checkbox("wish_check",""),$body);

			$body = str_replace("{cart_images}",_form_file("cart_images",$css),$body);
			if(isset($footer_rows->cart_check)) $body = str_replace("{cart_check}",_form_checkbox("cart_check",$footer_rows->cart_check),$body);
			else $body = str_replace("{cart_check}",_form_checkbox("cart_check",""),$body);

			$body = str_replace("{orderlist_images}",_form_file("orderlist_images",$css),$body);
			if(isset($footer_rows->orderlist_check)) $body = str_replace("{orderlist_check}",_form_checkbox("orderlist_check",$footer_rows->orderlist_check),$body);
			else $body = str_replace("{orderlist_check}",_form_checkbox("orderlist_check",""),$body);



			$body = str_replace("{mobile_images}",_form_file("mobile_images",$css),$body);
			if(isset($footer_rows->mobile_check)) $body = str_replace("{mobile_check}",_form_checkbox("mobile_check",$footer_rows->mobile_check),$body);
			else $body = str_replace("{mobile_check}",_form_checkbox("mobile_check",""),$body);

			$body = str_replace("{mobilepc_images}",_form_file("mobilepc_images",$css),$body);
			if(isset($footer_rows->mobilepc_check)) $body = str_replace("{mobilepc_check}",_form_checkbox("mobilepc_check",$footer_rows->mobilepc_check),$body);
			else $body = str_replace("{mobilepc_check}",_form_checkbox("mobilepc_check",""),$body);



			function _site_skin_html($code,$uid,$lang,$mobile){
				
				$query = "select * from `site_skin_html` WHERE `code`='$code' and `eid`='$uid' and `language`='$lang' and `mobile`='$mobile'";
				//echo $query."<br>";
				if($rows = _sales_query_rows($query)){	
					return $rows;
				}	
		
			}


			//#언어별 상품명, 상품설명
			$query1 = "select * from `site_language` ";	
			if($rowss1 = _sales_query_rowss($query1)){

				$login = json_decode( stripslashes( $footer_rows->login));
				$logout = json_decode( stripslashes( $footer_rows->logout));
				$member = json_decode( stripslashes( $footer_rows->member));
				$myinfo = json_decode( stripslashes( $footer_rows->myinfo));
				$cart = json_decode( stripslashes( $footer_rows->cart));
				$wish = json_decode( stripslashes( $footer_rows->wish));
				$orderlist = json_decode( stripslashes( $footer_rows->orderlist));

				$smartphone = json_decode( stripslashes( $footer_rows->mobile));
				$mobilepc = json_decode( stripslashes( $footer_rows->mobilepc));
					
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
					//$desktop = ;
					$desktop_html = stripslashes(_site_skin_html("footer",$uid,$code,"pc")->html);

					//$mobile = ;
					$mobile_html = stripslashes(_site_skin_html("footer",$uid,$code,"m")->html);
									
							
					$products_forms .="<div class='tab-$i_content'>
						<table border='0' width='100%'' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>로그인:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("login_".$rows1->code,$login->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>로그아웃:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("logout_".$rows1->code,$logout->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>장바구니:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("cart_".$rows1->code,$cart->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>관심상품:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("wish_".$rows1->code,$wish->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>주문목록:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("orderlist_".$rows1->code,$orderlist->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>회원가입:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("member_".$rows1->code,$member->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>회원정보:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("myinfo_".$rows1->code,$myinfo->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>모바일전환:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("smartphone_".$rows1->code,$smartphone->$code,"2",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>PC전환:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("mobilepc_".$rows1->code,$mobilepc->$code,"2",$css_textarea)."</td>
						</tr>
						</table>

						<table border='0' width='100%' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>Desktop</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea($rows1->code,$desktop_html,"20",$css_textarea)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>Mobile</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea($rows1->code."_m",$mobile_html,"20",$css_textarea)."</td>
						</tr>
						</table>
													   
										</div>";

									
				}
								
				$body = str_replace("{language_html}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
			}		

		

		echo $body;

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>