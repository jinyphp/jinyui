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

    	$mode = _formmode();
		//echo "mode is $mode <br>";
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		$skin_name = "default";
		$body = _skin_page("default","site_members_reserved_edit");
		
		//////////////////
		if($uid){
			$query = "select * from `site_members_reserved` where Id =$uid";
			//echo $query."<br>";
			$rows = _sales_query_rows($query);
		}

		$css = "cssFormStyle";
		
		// 상품판매 여부 체크 
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{regdate}",$rows->regdate,$body);

		$body = str_replace("{email}",_form_text("email",$rows->email,$css_textbox),$body);

		$body = str_replace("{description}",_form_text("description",$rows->description,$css_textbox),$body);


		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
		
		echo $body;


	

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>