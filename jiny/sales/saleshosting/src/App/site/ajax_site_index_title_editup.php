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

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

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


		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");



		if($mode == "delete"){
			$query = "select * from `site_index_title` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){
				
				$query = "DELETE FROM `site_index_title` WHERE `Id`='$uid'";
				//echo $query."<br>";
				_sales_query($query);
				//echo "삭제 <br>";
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
				//echo $_query;

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
			
			//echo $_query;
			_sales_query($_query);

		}

		// 페이지 이동 
		$url = "site_index_title.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";	

    		

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>