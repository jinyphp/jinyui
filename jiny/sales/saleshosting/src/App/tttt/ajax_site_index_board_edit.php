<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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

	$javascript = "<script>
		
		function form_submit(mode,uid){
			var url = \"/ajax_site_index_board_editup.php?mode=\"+mode+\"&uid=\"+uid;
			
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
		
		include "./conf/sales.php";	// Sales 사용자 DB 접근.

    	$mode = _formmode();		// echo "mode is $mode <br>";
		$uid = _formdata("uid");	// echo "uid is $uid <br>";


		$body = $javascript._skin_page($skin_name,"site_index_board_edit");

		$body=str_replace("{formstart}","<form id='data' name='site' method='post' enctype='multipart/form-data'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		/*
		$eid = _formdata("eid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _sales_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);

		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);
		*/


		//////////////////
		// $query = "select * from `site_index_board` where Id =$uid";
		if($rows = _sales_rows_id("site_index_board",$uid)){
			// 인텍스 타이틀 수정모드
			$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		} else {
			$body = str_replace("{form_submit}","
			<input type=hidden name=eid value=$eid>
			<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		}

		//$css = "cssFormStyle";
		// 활성화 여부 체크 
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{code}",_form_text("code",$rows->code,$css_textbox ),$body);
		// $body = str_replace("{board}",_form_text("board",$rows->board,$css),$body);

		$body = str_replace("{listnum}",_form_text("listnum",$rows->listnum,$css_textbox ),$body);
		$body = str_replace("{title_size}",_form_text("title_size",$rows->title_size,$css_textbox ),$body);


		if(isset($rows->check_regdate)) $body = str_replace("{check_regdate}",_form_checkbox("check_regdate",$rows->check_regdate),$body);
		else $body = str_replace("{check_regdate}",_form_checkbox("check_regdate",""),$body);

		if(isset($rows->check_title)) $body = str_replace("{check_title}",_form_checkbox("check_title",$rows->check_title),$body);
		else $body = str_replace("{check_title}",_form_checkbox("check_title","on"),$body);

		if(isset($rows->check_email)) $body = str_replace("{check_email}",_form_checkbox("check_email",$rows->check_email),$body);
		else $body = str_replace("{check_email}",_form_checkbox("check_email","on"),$body);

		

		// 상품 기본 카테고리
		function _shop_board_select($sel){
			global $css_textbox;	
				$query = "select * from `site_boardlist` ";
				$query .= "order by regdate desc";	
				if($rowss = _sales_query_rowss($query)){

					$cate = "<select name='board' style='$css_textbox'>";
					for($i=0;$i<count($rowss);$i++){
						
						$rows= $rowss[$i];
						$cate .= "<option value='".$rows->Id."' ";						
						if($sel == $rows->board) $cate .= "selected";
						$cate .= ">".$rows->title."</option>";

					}
					$cate .= "</select>";						
				}				
				return $cate;
		} 

		$body = str_replace("{board}",_shop_board_select($rows->board),$body);

		if(isset($rows->html_apply)) $body = str_replace("{cate_html_apply}",_form_checkbox("cate_html_apply",$rows->html_apply),$body);
		else $body = str_replace("{cate_html_apply}",_form_checkbox("cate_html_apply",""),$body);

		$body = str_replace("{html}",_form_textarea("html",stripslashes($rows->html),"25",$css_textarea),$body);

	


		echo $body;

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>