<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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
			var url = \"ajax_site_plug_board_editup.php?mode=\"+mode+\"&uid=\"+uid;
			
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

	include "site_function.php";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"site_plug_board_edit",$site_language,$site_mobile);

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
		if($rows = _sales_rows_id("site_plug_board",$uid)){
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


		// 상품 기본 카테고리
		/*
		function _shop_board_select($sel){
			global $css_textbox;	
			
			$query = "select * from `site_boardlist` ";
			$query .= "order by regdate desc";	
			if($rowss = _sales_query_rowss($query)){

				$cate = "<select name='board' style='$css_textbox'>";
				for($i=0;$i<count($rowss);$i++){
						
					$rows= $rowss[$i];
					$cate .= "<option value='".$rows->Id."' ";						
					if($sel == $rows->Id) $cate .= "selected";
					$cate .= ">".$rows->Id." ".$rows->title."</option>";

				}
				$cate .= "</select>";						
			}				
			return $cate;
		} 

		$body = str_replace("{board}",_shop_board_select($rows->board),$body);
		*/
		$body = str_replace("{board}", _shop_boardRows_select($rows->board) ,$body);
		


		/*
		if(isset($rows->html_apply)) $body = str_replace("{cate_html_apply}",_form_checkbox("cate_html_apply",$rows->html_apply),$body);
		else $body = str_replace("{cate_html_apply}",_form_checkbox("cate_html_apply",""),$body);

		$body = str_replace("{html}",_form_textarea("html",stripslashes($rows->html),"25",$css_textarea),$body);
		*/

		$body = str_replace("{pc_cols}",_form_text("pc_cols",$rows->pc_cols,$css_textbox ),$body);
		$body = str_replace("{pc_rows}",_form_text("pc_rows",$rows->pc_rows,$css_textbox ),$body);
		$body = str_replace("{pc_maxstr}",_form_text("pc_maxstr",$rows->pc_maxstr,$css_textbox ),$body);
		$body = str_replace("{pc_listnum}",_form_text("pc_listnum",$rows->pc_listnum,$css_textbox ),$body);
		$body = str_replace("{pc_label}",_form_text("pc_label",$rows->pc_label,$css_textbox ),$body);

		$body = str_replace("{mobile_cols}",_form_text("mobile_cols",$rows->mobile_cols,$css_textbox ),$body);
		$body = str_replace("{mobile_rows}",_form_text("mobile_rows",$rows->mobile_rows,$css_textbox ),$body);
		$body = str_replace("{mobile_maxstr}",_form_text("mobile_maxstr",$rows->mobile_maxstr,$css_textbox ),$body);
		$body = str_replace("{mobile_listnum}",_form_text("mobile_listnum",$rows->mobile_listnum,$css_textbox ),$body);
		$body = str_replace("{mobile_label}",_form_text("mobile_label",$rows->mobile_label,$css_textbox ),$body);
		

	


		echo $body;

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>