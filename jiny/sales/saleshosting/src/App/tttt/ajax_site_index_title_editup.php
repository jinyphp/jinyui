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

	include "./func/curl.php";

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
    					if(_is_file($_FILES[$formname]['name'])) _file_delete($_FILES[$formname]['name']);
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {
    					// 기존파일 삭제 
    					if(_is_file($filename.".".$ext)) _file_delete($filename.".".$ext);    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}


		$mode = _formmode();				echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		$eid = _formdata("eid");

		/*
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _sales_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);
		*/


		if($mode == "delete"){
			$query = "select * from `site_index_title` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){
				if(_is_file("/users/".$rows->host_id.$rows->images)){
					_file_delete("/users/".$rows->host_id.$rows->images);
					echo "파일 삭제성공 <br>";
				}
				$query = "DELETE FROM `site_index_title` WHERE `Id`='$uid'";
				echo $query."<br>";
				_sales_query($query);
				echo "삭제 <br>";
			}
		} else if($mode == "edit"){


			$query = "select * from `site_index_title` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){

				$query = new query;
				$query->table_name = "site_index_title";
				$query->where = " Id ='$uid'";

				$query->update("enable",_formdata("enable"));
				$query->update("code",_formdata("code"));
				$query->update("pos",_formdata("pos"));
				$query->update("url",_formdata("url"));
				$query->update("alt",_formdata("alt"));

				if(_formdata("inner")) $query->update("inner","on"); else $query->update("inner",""); 
				$query->update("inner_width",_formdata("inner_width"));
				$query->update("inner_height",_formdata("inner_height"));
				$query->update("inner_top",_formdata("inner_top"));
				$query->update("inner_left",_formdata("inner_left"));
				$query->update("inner_title",_formdata("inner_title"));
				$query->update("inner_html", addslashes( _formdata("inner_html") ) );


				// 로고 파일 업로드 : CURL
				if(!is_dir("./upload")) mkdir("./upload"); // 업로드 임시 폴더 확인
				if($files = _html_form_uploadfile("userfile1","./upload/index_title-$uid")) {
					// 로고 파일 업로드 성공시, query문 추가					
					// $query .= "`images`='index_title-$uid.".$files[ext]."'";	
					$query->update("images","index_title-$uid.".$files[ext]);

					if($sales_db->domain){	// curl 방식으로, 사용자 서버로 로고파일 복사					
						echo _curl_upload("upload","http://".$sales_db->domain."/curl_upload.php","./images","./upload/index_title-$uid.".$files[ext]);
						_file_delete($file); // 임시 업로드 파일 삭제
					} 
				}

				$_query = $query->update_query();
				_sales_query($_query);
				echo $_query;

			}
			

			

		} else if($mode == "new"){

			
			
			$query = new query;
			$query->table_name = "site_index_title";

			$query->insert("regdate",$TODAYTIME);
			$query->insert("enable",_formdata("enable"));
			$query->insert("code",_formdata("code"));
			$query->insert("pos",_formdata("pos"));
			$query->insert("url",_formdata("url"));
			$query->insert("alt",_formdata("alt"));

			if(_formdata("inner")) $query->insert("inner","on"); else $query->insert("inner",""); 
			$query->insert("inner_width",_formdata("inner_width"));
			$query->insert("inner_height",_formdata("inner_height"));
			$query->insert("inner_top",_formdata("inner_top"));
			$query->insert("inner_left",_formdata("inner_left"));
			$query->insert("inner_title",_formdata("inner_title"));
			$query->insert("inner_html", addslashes( _formdata("inner_html") ) );
			

			$query1 = "select * from `site_index_title` order by Id desc";
			if($rows1 = _sales_query_rows($query1)) $max_id = $rows1->Id + 1;

			// 로고 파일 업로드 : CURL
			if(!is_dir("./upload")) mkdir("./upload"); // 업로드 임시 폴더 확인
			if($files = _html_form_uploadfile("userfile1","./upload/index_title-$max_id")) {
				// 로고 파일 업로드 성공시, query문 추가					
				// $query .= "`images`='index_title-$uid.".$files[ext]."'";	
				$query->insert("images","index_title-$max_id.".$files[ext]);

				if($sales_db->domain){	// curl 방식으로, 사용자 서버로 로고파일 복사					
					echo _curl_upload("upload","http://".$sales_db->domain."/curl_upload.php","./images","./upload/index_title-$max_id.".$files[ext]);
					_file_delete($file); // 임시 업로드 파일 삭제
				} 
			}

			$_query = $query->insert_query();
			
			echo $_query;
			_sales_query($_query);

		}

		// 페이지 이동 
		//$url = "/site_index_title.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		//echo "<script> url_replace(\"$url\") </script>";	

    		

	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>