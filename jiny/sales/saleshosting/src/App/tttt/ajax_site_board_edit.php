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
		$body = _skin_page("default","site_board_edit");


		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$board = _formdata("board");
		$ajaxkey = _formdata("ajaxkey");
		
		if(isset($_COOKIE['cookie_email'])) $email = $_COOKIE['cookie_email'];	

		$query = "select * from `site_board` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			/*
			$body = str_replace("{form_submit}",$script."
			<input type='button' value='수정' onclick=\"javascript:form_board_submit('edit','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >
			<input type='button' value='답변' onclick=\"javascript:form_board_submit('reply','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_board_submit('delete','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >
			",$body);
			*/
		} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
			/*
			
			*/
		}	

		if($mode == "view"){
		
			
			$body = str_replace("{title}",$rows->title,$body);

			$html = stripslashes($rows->html);

			if($rows->reply){
				$html .= "<br>----------- reply ----------<br>";
				$html .= stripslashes($rows->reply);
			}

			$body = str_replace("{html}",$html,$body);

			// if(isset($rows->file1)) $file1 = $rows->file1; else $images ="";
			$body = str_replace("{file1}",$rows->file1,$body);
			$body = str_replace("{file2}",$rows->file2,$body);


			$butten = "";
			
			if($email == $rows->email)
			$butten .= "<input type='button' value='수정' onclick=\"javascript:board_edit('edit','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			
			$butten .= "<input type='button' value='답변' onclick=\"javascript:board_edit('reply','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			
			if($email == $rows->email)
			$butten .= "<input type='button' value='삭제' onclick=\"javascript:form_board_submit('delete','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";

			$body = str_replace("{form_submit}",$script.$butten,$body);

		} else if($mode == "edit"){
			if(isset($rows->title)) $title = $rows->title; else $title ="";
			$body = str_replace("{title}",_form_text("title",$title,$css_textbox),$body);

			$body = str_replace("{html}",_form_textarea("html",stripslashes($rows->html),"15",$css_textarea),$body);

			// if(isset($rows->file1)) $file1 = $rows->file1; else $images ="";
			$body = str_replace("{file1}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{file2}","<input type='file' name='userfile2' id=\"cssFormStyle\" >",$body);

			$butten = "";
			$butten .= "<input type='button' value='수정' onclick=\"javascript:form_board_submit('edit','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			$butten .= "<input type='button' value='답변' onclick=\"javascript:form_board_submit('reply','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			$butten .= "<input type='button' value='삭제' onclick=\"javascript:form_board_submit('delete','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			$body = str_replace("{form_submit}",$script.$butten,$body);

		} else if($mode == "new"){
			if(isset($rows->title)) $title = $rows->title; else $title ="";
			$body = str_replace("{title}",_form_text("title",$title,$css_textbox),$body);

			$body = str_replace("{html}",_form_textarea("html",stripslashes($rows->html),"15",$css_textarea),$body);

			// if(isset($rows->file1)) $file1 = $rows->file1; else $images ="";
			$body = str_replace("{file1}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{file2}","<input type='file' name='userfile2' id=\"cssFormStyle\" >",$body);

			$body = str_replace("{form_submit}",$script."
			<input type='button' value='저장' onclick=\"javascript:form_board_submit('new','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >
			",$body);
		} else if($mode == "reply"){
			$body = str_replace("{title}",_form_text("title","re:".$rows->title,$css_textbox),$body);
			// $body = str_replace("{title}",$rows->title,$body);
			$reply = "\n<----- reply ----->\n".stripslashes($rows->html);
			$body = str_replace("{html}",_form_textarea("html",stripslashes($rows->reply).$reply,"15",$css_textarea),$body);

			// if(isset($rows->file1)) $file1 = $rows->file1; else $images ="";
			$body = str_replace("{file1}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{file2}","<input type='file' name='userfile2' id=\"cssFormStyle\" >",$body);

			$butten = "";
			if($email == $rows->email)
			$butten .= "<input type='button' value='수정' onclick=\"javascript:form_board_submit('edit','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			
			$butten .= "<input type='button' value='답변' onclick=\"javascript:form_board_submit('reply','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			
			if($email == $rows->email)
			$butten .= "<input type='button' value='삭제' onclick=\"javascript:form_board_submit('delete','".$board."','".$uid."')\" id=\"".$btn_style_gray."\" >";
			
			$body = str_replace("{form_submit}",$script.$butten,$body);

		}
		
		echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>