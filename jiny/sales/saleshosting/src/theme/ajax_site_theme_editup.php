<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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

	// 환경설정 
	// include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 테마관련 함수들
		include "theme_function.php";

		$mode = _formmode();	//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$theme = _formdata("theme");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");


		if($uid && $mode == "edit"){

			$query = "select * from site_theme WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){

   				
				$query = "UPDATE site_theme SET ";
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

				//# 
				$uploadfile = $_FILES['userfile']['name'];
   				$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   				if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   					echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   				} else {
   					$file_name_with_full_path = $_FILES['userfile']['tmp_name'];

   					$post = array('mode'=>"upload",
							'adminkey'=>$sales_db->adminkey, 
							'theme'=>$theme, 
							'filename'=>$_FILES['userfile']['name'], 
							'file_contents'=>'@'.$file_name_with_full_path);
   					
   					$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
   					$curl_return = _curl_post($curl_path,$post);
   					echo $curl_return;

   					$query .= "`screenshot`='".$_FILES['userfile']['name']."' ,";
   				}







				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query;

				if($rows->theme != $theme){
					// 테마코드 수정됨
					$query1 = "select * from site_theme WHERE `theme`='$theme'";
					if($rows1 = _sales_query_rows($query1)){
						$msg = "오류, 중복된 테마코드 입니다.";
						msg_alert($msg);
						//echo "오류, 중복된 테마코드 입니다.";
					} else {
						_sales_query($query);
						//echo "테마 수정";

						// $curl_path = "http://".$sales_db->domain."/curl_theme.php";
						$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
						$curl_return = _curl_post($curl_path,"mode=rename&oldname=".$rows->theme."&newname=".$theme);
						echo $curl_return;
					}

				} else {
					_sales_query($query);
					//echo "테마 수정";
				}

				//# 이미지 업로드

				

			}

			$url = "site_theme.php"."?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";
			
		} else if($mode == "new"){

			$theme = _formdata("theme");
			
			$query = "select * from site_theme WHERE `theme`='$theme'";
			if($rows = _sales_query_rows($query)){
				//echo "오류, 중복된 테마코드 입니다.";
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


				//# 
				$uploadfile = $_FILES['userfile']['name'];
   				$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   				if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   					echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   				} else {
   					$file_name_with_full_path = $_FILES['userfile']['tmp_name'];

   					$post = array('mode'=>"upload",
							'adminkey'=>$sales_db->adminkey, 
							'theme'=>$theme, 
							'filename'=>$_FILES['userfile']['name'], 
							'file_contents'=>'@'.$file_name_with_full_path);
   					
   					$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
   					$curl_return = _curl_post($curl_path,$post);
   					echo $curl_return;

   		
   					$insert_filed .= "`screenshot`,";
					$insert_value .= "'".$_FILES['userfile']['name']."',";
   				}


				$query = "INSERT INTO site_theme ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);

				/*
				$dir = "./users/".$sales_db->Id."/theme/$theme";
				if(_is_path($dir)){
					echo "테마 생성";
				}
				*/

			}

			$url = "site_theme.php"."?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "delete"){

			$query = "select * from site_theme WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){

				$query = "DELETE FROM site_theme WHERE `Id`='$uid'";
    			_sales_query($query);

    			$query = "DELETE FROM site_themefiles WHERE `theme`='".$rows->theme."'";
    			_sales_query($query);

    			$query = "DELETE FROM site_themefiles_html WHERE `theme`='".$rows->theme."'";
    			_sales_query($query);

    			// 호스팅서비 : html 파일 생성 by CURL
				$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
				$curl_return = _curl_post($curl_path,"mode=theme_delete&theme=".$rows->theme);
				echo $curl_return;

			}

			




    		$url = "site_theme.php"."?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";



    	} else if($mode == "copy"){
    		echo "Theme copy<br>";
    		
    		$TID = $_POST['TID'];		
			if($TID){
				$query = "select * from site_theme WHERE `Id`='$TID[0]'";
				if($rows = _sales_query_rows($query)){
					$theme = $rows->theme;

					// 호스팅서비 : html 파일 생성 by CURL
					$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
					$curl_return = _curl_post($curl_path,"mode=copy&theme=".$theme);
					echo $curl_return;

				}
			}		

    		

		} 

		
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>