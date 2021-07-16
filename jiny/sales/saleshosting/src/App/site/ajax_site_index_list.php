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

	include "./func/css.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$javascript = "<script>
				function board_edit(mode,uid){
                  	var url = \"/ajax_site_index_board_edit.php?uid=\"+uid+\"&mode=\"+mode;	
                  	$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#site_edit').html(data);
                        }
                    }); 	
                }


                function title_edit(mode,uid,eid){
                  	var url = \"/ajax_site_index_title_edit.php?uid=\"+uid+\"&mode=\"+mode+\"&eid=\"+eid;	
                  	// alert(url);
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
                  	var url = \"/ajax_site_index_goods_edit.php?uid=\"+uid+\"&mode=\"+mode;	
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
		$body = $javascript._skin_page("default","site_index_list");


		
		$eid = _formdata("uid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _sales_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);

		// ===================
		// 타이틀 이미지 
		$button ="<input type='button' value='타이틀이미지' onclick=\"javascript:title_edit('new','0','$eid')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new_title}",$button,$body);

		$body = str_replace("{list_title}","<span id=\"list_title\">
					<script>
						$.ajax({
            				url:'/ajax_site_index_title.php?eid=$eid',
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
		$button ="<input type='button' value='상품코드' onclick=\"javascript:goods_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new_goods}",$button,$body);

		$body = str_replace("{list_goods}","<span id=\"list_goods\">
					<script>
						$.ajax({
            				url:'/ajax_site_index_goods.php?eid=$eid',
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
		$button ="<input type='button' value='계시판생성' onclick=\"javascript:board_edit('new','0','".$eid."')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new_board}",$button,$body);
		
		$body = str_replace("{list_board}","<span id=\"list_board\">
					<script>
						$.ajax({
            				url:'/ajax_site_index_board.php?eid=$eid',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#list_board').html(data);
            				}
        				});
    				</script>
					</span>",$body);
		


		
		// ===================
		// 상품목록 
		$button ="<input type='button' value='블럭생성' onclick=\"javascript:html_edit('new','0','".$eid."')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new_html}",$button,$body);

		$body = str_replace("{list_html}","<span id=\"list_html\">
					<script>
						$.ajax({
            				url:'/ajax_site_index_html.php?eid='+eid,
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#list_html').html(data);
            				}
        				});
    				</script>
					</span>",$body);

	

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
											<tr><td style='font-size:12px;padding:10px;'>HTML PC</td></tr>
											<tr><td>"._form_textarea($rows1->code,$desktop_html,"25",$css_textarea)."</td></tr>
											<tr><td style='font-size:12px;padding:10px;'>HTML MOBILE</td></tr>
											<tr><td>"._form_textarea($rows1->code."_m",$mobile_html,"25",$css_textarea)."</td></tr>											
											</table>
													   
										</div>";									 
									
				}
								
			$body = str_replace("{language_html}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
								
		}

		$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_list_submit('edit','".$eid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_list_submit('delete','".$eid."')\" style=\"".$css_btn_gray."\" >",$body);

		echo $body;
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>