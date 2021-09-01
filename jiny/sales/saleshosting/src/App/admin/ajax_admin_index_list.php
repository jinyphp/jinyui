<?php

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

		$body = _skin_page("default","site_index_list");
		$body .= "<script>

                function title_edit(mode,uid,eid){
                  	var url = \"/ajax_admin_index_title_edit.php?uid=\"+uid+\"&mode=\"+mode+\"&eid=\"+eid;	
                  	alert(url);
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }

                function goods_edit(mode,uid){
                  	var url = \"/ajax_admin_index_goods_edit.php?uid=\"+uid+\"&mode=\"+mode;	
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

        /*
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 

		$body = str_replace("{formstart}","<form name='menu' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		*/
		
		$eid = _formdata("uid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _mysqli_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);

		// ===================
		// 타이틀 이미지 
		$button ="<input type='button' value='타이틀이미지' onclick=\"javascript:title_edit('new','0','$eid')\" id=\"".$btn_style_gray."\" >";          
		$body = str_replace("{new_title}",$button,$body);

		$body = str_replace("{list_title}","<span id=\"list_title\">
					<script>
						$.ajax({
            				url:'/ajax_mysqli_index_title.php?eid=$eid',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#list_title').html(data);
            				}
        				});
    				</script>
					</span>",$body);

		// ===================
		// 상품목록 
		$button ="<input type='button' value='상품코드' onclick=\"javascript:goods_edit('new','0')\" id=\"".$btn_style_gray."\" >";          
		$body = str_replace("{new_goods}",$button,$body);

		$body = str_replace("{list_goods}","<span id=\"list_goods\">
					<script>
						$.ajax({
            				url:'/ajax_mysqli_index_goods.php?eid=$eid',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#list_goods').html(data);
            				}
        				});
    				</script>
					</span>",$body);


		/*
		// ===================
		// 상품목록 
		$button ="<input type='button' value='NEW' onclick=\"javascript:board_edit('new','0','".$eid."')\" id=\"".$btn_style_gray."\" >";          
		$body = str_replace("{new_board}",$button,$body);

		$body = str_replace("{list_board}","<span id=\"list_goods\">
					<script>
						$.ajax({
            				url:'/ajax_site_index_board.php?eid='+eid,
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#list_goods').html(data);
            				}
        				});
    				</script>
					</span>",$body);

	
		// ===================
		// 상품목록 
		$button ="<input type='button' value='NEW' onclick=\"javascript:html_edit('new','0','".$eid."')\" id=\"".$btn_style_gray."\" >";          
		$body = str_replace("{new_html}",$button,$body);

		$body = str_replace("{list_html}","<span id=\"list_goods\">
					<script>
						$.ajax({
            				url:'/ajax_site_index_html.php?eid='+eid,
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#list_goods').html(data);
            				}
        				});
    				</script>
					</span>",$body);

		*/

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
					
				$products_language = "";
				$products_forms = "";
				for($i=0;$i<count($rowss1);$i++){
					$rows1=$rowss1[$i];

					if($rows1->code == $site_language){
						$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='".$rows1->code."' checked=\"checked\">";
					} else {
						$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='".$rows1->code."'>";
					}
									
					$products_language .= "<label for='tab-$i'>".$rows1->code."</label>";
									
					$desktop = _site_skin_html("index",$eid,$rows1->code,"pc");
					$desktop_html = stripslashes($desktop->html);

					//echo "DEsktop : $desktop_html<br>";

					$mobile = _site_skin_html("index",$eid,$rows1->code,"m");
					$mobile_html = stripslashes($mobile->html);

					// $desktop = $rows1->code;
					// $mobile = $rows1->code."_m";
									
					//$goodstring = _goodstring($UID,$rows1[code]);
					$code = $rows1->code;		
					$products_forms .="<div class='tab-$i_content'>
											<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
											<tr>
												<td width='110' align='right' valign='top'>HTML PC</td>
												<td>"._form_textarea($rows1->code,$desktop_html,"10",$css)."</td>
											</tr>
											<tr>
												<td width='110' align='right' valign='top'>HTML MOBILE</td>
												<td>"._form_textarea($rows1->code."_m",$mobile_html,"10",$css)."</td>
											</tr>
											</table>
													   
										</div>";									 
									
				}
								
			$body = str_replace("{language_html}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
								
		}

		$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_list_submit('edit','".$eid."')\" id=\"".$btn_style_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_list_submit('delete','".$eid."')\" id=\"".$btn_style_gray."\" >",$body);

		echo $body;
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>