<?

	@session_start();
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		include "./conf/dbinfo.php";
		include "./func/mysql.php";

		include "./func/file.php";
		include "./func/form.php";
		include "./func/skin.php";
		include "./func/datetime.php";
		include "./func/goods.php";
		include "./func/orders.php";
	
		// Sales 사용자 DB 접근.
		// include "./sales.php";


	function _menu_tabbar($title,$site_language){
		//#언어별 메뉴명 설정
		$query = "select * from `site_language` ";	
		if($rowss = _mysqli_query_rowss($query)){
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

		$skin_name = "default";
		$body = _skin_page("default","site_menu_edit");

		
		$ajaxkey = _formdata("ajaxkey");
		

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";


		//echo "mode is $mode <br>";
		/*
		$body=str_replace("{formstart}","<form name='menu' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='uid' value='$uid'>
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    		<input type='hidden' name='mode' value='$mode'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		*/
		$body=str_replace("{formstart}","",$body);
		$body=str_replace("{formend}","",$body);


		$body = str_replace("{form_submit}","
				<script>
				function form_submit(mode,uid){
					var url = \"/ajax_admin_menu_editup.php?uid=\"+uid+\"&mode=\"+mode;
				
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#menu_edit').html(data);
                        }
                    });
				}

				function form_delete(mode,uid){
					var url = \"/ajax_admin_menu_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#menu_edit').html(data);

                        }
                    });
				}
				</script>
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" id=\"".$btn_style_gray."\" >
				",$body);

		if($mode == "new"){
			$body = str_replace("{formmode}","신규등록",$body);

			$body = str_replace("{menu_name}", _menu_tabbar("",$site_language),$body);
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);

			$urlmode = "<select name='urlmode'>
			<option value='direct'>직접입력</option>
			<option value='pages'>정적페이지</option>
			<option value='board'>계시판</option>
			<option value='category'>카테고리</option>
			</select>";
			$body = str_replace("{urlmode}",$urlmode,$body);
			$body = str_replace("{url}","<input type='text' name='url' id=\"cssFormStyle\" >",$body);

		} else if($mode == "sub"){
			$query = "select * from `site_menu` where Id='$uid'";	
			//echo "$query <br>";
			if($menu = _mysqli_query_rows($query)){
				$sub = stripslashes($menu->title);
				$sub = json_decode($title);
				$body = str_replace("{formmode}","서브등록:".$sub->$site_language,$body);
				$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
				$body = str_replace("{url}","<input type='text' name='url' id=\"cssFormStyle\" >",$body);
			}

			$body = str_replace("{menu_name}", _menu_tabbar("",$site_language),$body);	

		} else if($mode == "edit"){
			$body = str_replace("{formmode}","수정",$body);

			$query = "select * from `site_menu` where Id='$uid'";	
			//echo "$query <br>";
			if($menu = _mysqli_query_rows($query)){
				//echo $category->title;
				$title = stripslashes($menu->title);
				$title = json_decode($title);
			}

			$body = str_replace("{menu_name}", _menu_tabbar($title,$site_language),$body);
			
			if($menu->enable)
			$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
			else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);

			$body = str_replace("{url}","<input type='text' name='url' value='".$category->url."' id=\"cssFormStyle\" >",$body);

		}

		echo $body;		
		
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";

		$skin_name = "default";
		$body = _skin_page($skin_name,"error"); // 스킨 읽어오기

    	$body = str_replace("{error_message}",$error_message,$body);
    	echo $body;
	}




	
?>