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


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		include "./conf/sales.php";	// Sales 사용자 DB 접근.

    	function _form_uploadfile($formname,$filename){
    		if($_FILES[$formname]['tmp_name']){
    			// 파일 확장자 검사
    			
    			$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    			else {
    				if($filename == ""){
    					// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {
    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}


		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		$eid = _formdata("eid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _sales_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);


		if($mode=="edit"){

			$query = "select * from `site_index_board` WHERE Id =$uid";
			//echo $query."<br>";
			if($rows = _sales_query_rows($query)){
				
				$query = new query;
				$query->table_name = "site_index_board";
				$query->where = " Id ='$uid'";

				$query->update("code",_formdata("code"));
				$query->update("board",_formdata("board"));
				$query->update("listnum",_formdata("listnum"));
				$query->update("title_size",_formdata("title_size"));
				$query->update("check_title",_formdata("check_title"));
				$query->update("check_regdate",_formdata("check_regdate"));
				$query->update("check_email",_formdata("check_email"));

				$query->update("html", addslashes( _formdata("html") ) );

				$_query = $query->update_query();
				_sales_query($_query);
				echo $_query;

				/*
				// 수정모드
				
				$query = "UPDATE `site_index_board` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
				if($code = _formdata("code")) $query .= "`code`='$code' ,"; else $query .= "`code`='' ,";

				if($board = _formdata("board")) $query .= "`board`='$board' ,"; else $query .= "`board`='' ,";
				if($listnum = _formdata("listnum")) $query .= "`listnum`='$listnum' ,"; else $query .= "`listnum`='' ,";
				if($title_size = _formdata("title_size")) $query .= "`title_size`='$title_size' ,"; else $query .= "`title_size`='' ,";

				

				if($check_title = _formdata("check_title")) $query .= "`check_title`='$check_title' ,"; else $query .= "`check_title`='' ,";
				if($check_regdate = _formdata("check_regdate")) $query .= "`check_regdate`='$check_regdate' ,"; else $query .= "`check_regdate`='' ,";
				if($check_email = _formdata("check_email")) $query .= "`check_email`='$check_email' ,"; else $query .= "`check_email`='' ,";
				
				if($html = _formdata("html")) $query .= "`html`='".addslashes($html)."' ,";


				$query .= "`domain`='".$site_env_rows->domain."' ,";

				$query .= "`host_id`='".$sales_db->Id."' ,";
				


				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				echo $query;
				_sales_query($query);
				*/


			}

			echo "사이트 정보가 갱신되었습니다.";	



		} else if($mode=="new"){

			$query = new query;
			$query->table_name = "site_index_board";

			$query->insert("regdate",$TODAYTIME);
			$query->insert("enable",_formdata("enable"));

			$query->insert("code",_formdata("code"));
			$query->insert("board",_formdata("board"));
			$query->insert("listnum",_formdata("listnum"));
			$query->insert("title_size",_formdata("title_size"));
			$query->insert("check_title",_formdata("check_title"));
			$query->insert("check_regdate",_formdata("check_regdate"));
			$query->insert("check_email",_formdata("check_email"));

			$query->insert("html", addslashes( _formdata("html") ) );

							
			$_query = $query->insert_query();
			_sales_query($_query);
			echo $_query;


		} else if($mode == "delete"){
			$query = "DELETE FROM `site_index_board` WHERE `Id`='$uid'";
				// echo $query."<br>";
			_sales_query($query);

			echo "사이트 정보 삭제";
		}



		// 페이지 이동 
		$url = "/site_index_board.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";	

    		

	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>