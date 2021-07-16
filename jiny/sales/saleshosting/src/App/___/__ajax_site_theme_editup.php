<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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

	include "./func/error.php";
	
	include "./func/css.php";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./conf/sales.php";

		$mode = _formmode();	//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$theme = _formdata("theme");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		


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

		


		if($uid && $mode == "edit"){

			$query = "select * from `site_theme` WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){

				$query = "UPDATE `site_theme` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
				if($theme = _formdata("theme")) $query .= "`theme`='$theme' ,";
				if($title = _formdata("title")) $query .= "`title`='$title' ,";

				
				if($width = _formdata("width")) $query .= "`width`='$width' ,";
				if($align = _formdata("align")) $query .= "`align`='$align' ,";
				if($bgcolor = _formdata("bgcolor")) $query .= "`bgcolor`='$bgcolor' ,";
				

				if($description = _formdata("description")) $query .= "`description`='".addslashes($description)."' ,";

				if($header = _formdata("header")) $query .= "`header`='$header' ,";
				if($footer = _formdata("footer")) $query .= "`footer`='$footer' ,";
				if($menu_code = _formdata("menu_code")) $query .= "`menu_code`='$menu_code' ,";
				if($menu_code_login = _formdata("menu_code_login")) $query .= "`menu_code_login`='$menu_code_login' ,";
				if($index = _formdata("index")) $query .= "`index`='$index' ,";


				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				echo $query;

				if($rows->theme != $theme){
					// 테마코드 수정됨
					$query1 = "select * from `site_theme` WHERE `theme`='$theme'";
					if($rows1 = _sales_query_rows($query1)){
						echo "오류, 중복된 테마코드 입니다.";
					} else {
						_sales_query($query);
						echo "테마 수정";

						// $old_dir = "./users/".$sales_db->Id."/theme/".$rows->theme;
						// $new_dir = "./users/".$sales_db->Id."/theme/$theme";
						// rename ($old_dir, $new_dir);

						// CURL 처리
						$query = "select * from `site_env`";
						if($site_env_rows = _sales_query_rows($query)){
							// **********************
							// CURL을 통하여, 해당 고객 계정 서버에 상품 설명 html 파일을 생성함.
							if($site_env_rows->domain){
								$curl_path = "http://".$site_env_rows->domain."/curl_theme.php";
								echo _curl_post($curl_path,"mode=rename&oldname=".$rows->theme."&newname=".$theme);
							} 
						} 




					}

				} else {
					_sales_query($query);
					echo "테마 수정";
				}
			}
			
		} else if($mode == "new"){

			$theme = _formdata("theme");
			
			$query = "select * from `site_theme` WHERE `theme`='$theme'";
			if($rows = _sales_query_rows($query)){
				echo "오류, 중복된 테마코드 입니다.";
			} else {	

				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				if($enable = _formdata("enable")){
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				$insert_filed .= "`theme`,";	$insert_value .= "'$theme',";
		

				if($title = _formdata("title")){
					$insert_filed .= "`title`,";
					$insert_value .= "'$title',";
				}

				if($description = _formdata("description")){
					$insert_filed .= "`description`,";
					$insert_value .= "'".addslashes($description)."',";
				}

				
				if($width = _formdata("width")){
					$insert_filed .= "`width`,";
					$insert_value .= "'$width',";
				}
				if($align = _formdata("align")){
					$insert_filed .= "`align`,";
					$insert_value .= "'$align',";
				}
				if($bgcolor = _formdata("bgcolor")){
					$insert_filed .= "`bgcolor`,";
					$insert_value .= "'$bgcolor',";
				}
				


				if($header = _formdata("header")){
					$insert_filed .= "`header`,";
					$insert_value .= "'$header',";
				}
				if($footer = _formdata("footer")){
					$insert_filed .= "`footer`,";
					$insert_value .= "'$footer',";
				}
				if($menu_code = _formdata("menu_code")){
					$insert_filed .= "`menu_code`,";
					$insert_value .= "'$menu_code',";
				}
				if($menu_code_login = _formdata("menu_code_login")){
					$insert_filed .= "`menu_code_login`,";
					$insert_value .= "'$menu_code_login',";
				}
				if($index = _formdata("index")){
					$insert_filed .= "`index`,";
					$insert_value .= "'$index',";
				}

				$query = "INSERT INTO `site_theme` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);

				/*
				$dir = "./users/".$sales_db->Id."/theme/$theme";
				if(_is_path($dir)){
					echo "테마 생성";
				}
				*/

			}
		} else if($mode == "delete"){
			$query = "DELETE FROM `site_theme` WHERE `Id`='$uid'";
    		_sales_query($query);

    		echo "테마 삭제";

		} 

		$url = "site_theme.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>