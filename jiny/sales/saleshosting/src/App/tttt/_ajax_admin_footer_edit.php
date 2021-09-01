<?

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	include "./func/skin.php";
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";


	if(isset($_SESSION['language'])){
		$site_language = $_SESSION['language'];
	} else {
		$site_language = "ko";
	}

	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}

	if(isset($_COOKIE['cookie_email'])){
		$cookie_email = $_COOKIE['cookie_email'];
	} else {
		$cookie_email = "";
	}



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		//include "./sales.php";

    	$mode = _formmode();
		//echo "mode is $mode <br>";
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		$skin_name = "default";
		$body = _skin_page("default","site_footer_edit");

		//////////////////
		if($uid){
			$query = "select * from `site_env` where Id =$uid";
			//echo $query."<br>";
			$site_env_rows = _mysqli_query_rows($query);

			$query = "select * from `site_footer` where eid =$uid";
			//echo $query."<br>";
			$header_rows = _mysqli_query_rows($query);

		}


			$script = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_admin_footer_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#site_edit').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

				function form_delete(mode,uid){
					var url = \"/ajax_admin_footer_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);

                        }
                    });
				}
				</script>";
			
			
			
			if($header_rows){
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
			if(isset($header_rows->enable)) $body = str_replace("{enable}",_form_check_enable($header_rows->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

			$body = str_replace("{title}",_form_text("title",$header_rows->title,$css),$body);

			$body = str_replace("{width}",_form_text("width",$header_rows->width,$css),$body);
			$body = str_replace("{align}",_form_text("align",$header_rows->align,$css),$body);
			$body = str_replace("{bgcolor}",_form_text("bgcolor",$header_rows->bgcolor,$css),$body);

			$body = str_replace("{logo}",_form_file("logo",$css),$body);

			$body = str_replace("{login_images}",_form_file("login_images",$css),$body);
			if(isset($header_rows->login_check)) $body = str_replace("{login_check}",_form_checkbox("login_check",$header_rows->login_check),$body);
			else $body = str_replace("{login_check}",_form_checkbox("login_check",""),$body);

			$body = str_replace("{logout_images}",_form_file("logout_images",$css),$body);
			if(isset($header_rows->logout_check)) $body = str_replace("{logout_check}",_form_checkbox("logout_check",$header_rows->logout_check),$body);
			else $body = str_replace("{logout_check}",_form_checkbox("logout_check",""),$body);

			$body = str_replace("{member_images}",_form_file("member_images",$css),$body);
			if(isset($header_rows->member_check)) $body = str_replace("{member_check}",_form_checkbox("member_check",$header_rows->member_check),$body);
			else $body = str_replace("{member_check}",_form_checkbox("member_check",""),$body);

			$body = str_replace("{myinfo_images}",_form_file("myinfo_images",$css),$body);
			if(isset($header_rows->myinfo_check)) $body = str_replace("{myinfo_check}",_form_checkbox("myinfo_check",$header_rows->myinfo_check),$body);
			else $body = str_replace("{myinfo_check}",_form_checkbox("myinfo_check",""),$body);

			$body = str_replace("{wish_images}",_form_file("wish_images",$css),$body);
			if(isset($header_rows->wish_check)) $body = str_replace("{wish_check}",_form_checkbox("wish_check",$header_rows->wish_check),$body);
			else $body = str_replace("{wish_check}",_form_checkbox("wish_check",""),$body);

			$body = str_replace("{cart_images}",_form_file("cart_images",$css),$body);
			if(isset($header_rows->cart_check)) $body = str_replace("{cart_check}",_form_checkbox("cart_check",$header_rows->cart_check),$body);
			else $body = str_replace("{cart_check}",_form_checkbox("cart_check",""),$body);

			$body = str_replace("{orderlist_images}",_form_file("orderlist_images",$css),$body);
			if(isset($header_rows->orderlist_check)) $body = str_replace("{orderlist_check}",_form_checkbox("orderlist_check",$header_rows->orderlist_check),$body);
			else $body = str_replace("{orderlist_check}",_form_checkbox("orderlist_check",""),$body);



			function _site_skin_html($code,$uid,$lang,$mobile){
				
				$query = "select * from `site_skin_html` WHERE `code`='$code' and `eid`='$uid' and `language`='$lang' and `mobile`='$mobile'";
				//echo $query."<br>";
				if($rows = _mysqli_query_rows($query)){	
					return $rows;
				}	
		
			}


			//#언어별 상품명, 상품설명
			$query1 = "select * from `site_language` ";	
			if($rowss1 = _mysqli_query_rowss($query1)){

				$login = json_decode( stripslashes( $header_rows->login));
				$logout = json_decode( stripslashes( $header_rows->logout));
				$member = json_decode( stripslashes( $header_rows->member));
				$myinfo = json_decode( stripslashes( $header_rows->myinfo));
				$cart = json_decode( stripslashes( $header_rows->cart));
				$wish = json_decode( stripslashes( $header_rows->wish));
				$orderlist = json_decode( stripslashes( $header_rows->orderlist));
					
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
					$desktop = _site_skin_html("footer",$uid,$code,"pc");
					$desktop_html = stripslashes($desktop->html);

					$mobile = _site_skin_html("footer",$uid,$code,"mobile");
					$mobile_html = stripslashes($mobile->html);
									
							
					$products_forms .="<div class='tab-$i_content'>
						<table border='0' width='100%'' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>로그인:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("login_".$rows1->code,$login->$code,"2",$css)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>로그아웃:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("logout_".$rows1->code,$logout->$code,"2",$css)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>장바구니:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("cart_".$rows1->code,$cart->$code,"2",$css)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>관심상품:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("wish_".$rows1->code,$wish->$code,"2",$css)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>주문목록:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("orderlist_".$rows1->code,$orderlist->$code,"2",$css)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>회원가입:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("member_".$rows1->code,$member->$code,"2",$css)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>회원정보:</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea("myinfo_".$rows1->code,$myinfo->$code,"2",$css)."</td>
						</tr>
						</table>

						<table border='0' width='100%' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>Desktop</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea($rows1->code,$desktop_html,"10",$css)."</td>
						</tr>
						<tr>
							<td style='font-size:12px;padding:10px;' width='80' valign='top'>Mobile</td>
							<td style='font-size:12px;padding:10px;' valign='top'>"._form_textarea($rows1->code."_m",$mobile_html,"10",$css)."</td>
						</tr>
						</table>
													   
										</div>";

									
				}
								
				$body = str_replace("{language_html}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
			}		

		

		echo $body;

		
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>