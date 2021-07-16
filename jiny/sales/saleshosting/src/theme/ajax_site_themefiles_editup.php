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
		
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");	// Sales 사용자 DB 접근.

		// 테마관련 함수들
		include "theme_function.php";

		$mode = _formmode();	//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$theme = _formdata("theme");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");



		if($uid && $mode == "edit"){

			$query = "UPDATE site_themefiles SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
			if($theme = _formdata("theme")) $query .= "`theme`='$theme' ,";
			if($filename = _formdata("filename")) $query .= "`filename`='$filename' ,";
			if($comment = _formdata("comment")) $query .= "`comment`='$comment' ,";

			if($header = _formdata("header")) $query .= "`header`='on' ,"; else $query .= "`header`='' ,";
			if($enable = _formdata("footer")) $query .= "`footer`='on' ,"; else $query .= "`footer`='' ,";
			
			if($bgcolor = _formdata("bgcolor")) $query .= "`bgcolor`='$bgcolor' ,";

			if($sub_menu = _formdata("sub_menu")) $query .= "`sub_menu`='on' ,"; else $query .= "`sub_menu`='' ,";
			if($sub_width = _formdata("sub_width")) $query .= "`sub_width`='$sub_width' ,";
			if($sub_align = _formdata("sub_align")) $query .= "`sub_align`='$sub_align' ,";

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);	
			//echo $query."<br>";
			_sales_query($query);


			$query1 = "select * from site_language ";
			if($rowss1 = _sales_query_rowss($query1)){
				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					$seo_title = _formdata("title_".$rows1->code);
					$seo_keyword = _formdata("keyword_".$rows1->code);
					$seo_description = _formdata("description_".$rows1->code);


					$desktop =  addslashes( _formdata($rows1->code) );
					$query = "UPDATE site_themefiles_html SET  `filename` = '$filename',`html` = '$desktop',`title` = '$seo_title',`keyword` = '$seo_keyword',`description` = '$seo_description' 
								,`sub_width` = '$sub_width' ,`sub_align` = '$sub_align' ,`sub_menu` = '$sub_menu' ,`bgcolor` = '$bgcolor'
								where `pid`='$uid' and `language`='".$rows1->code."' and `mobile`='pc'";
					//echo $query."<br>";
					_sales_query($query);



					$mobile =  addslashes( _formdata($rows1->code."_m") );
					$query = "UPDATE site_themefiles_html SET  `filename` = '$filename',`html` = '$mobile',`title` = '$seo_title',`keyword` = '$seo_keyword',`description` = '$seo_description' 
								,`sub_width` = '$sub_width' ,`sub_align` = '$sub_align' ,`sub_menu` = '$sub_menu' ,`bgcolor` = '$bgcolor'
								where `pid`='$uid' and `language`='".$rows1->code."' and `mobile`='m'";
					//echo $query."<br>";
					_sales_query($query);

			

				}
			}	

			
			// 호스팅서비 : html 파일 생성 by CURL
			// $curl_path = "http://".$sales_db->domain."/theme/curl_theme.php?theme=$theme";
			
			// $curl_return = _curl_post($curl_path,"mode=html&filename=$filename");
			

			$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
			//echo "path: ".$curl_path."<br>";
			$curl_return = _curl_post($curl_path,"mode=html&filename=$filename&theme=$theme");
			//echo $curl_return;


			$url = "site_themefiles.php"."?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";


			
		} else if($mode == "new"){

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";
				$insert_value .= "'on',";
			}

			if($theme = _formdata("theme")){
				$insert_filed .= "`theme`,";
				$insert_value .= "'$theme',";
			}

			if($filename = _formdata("filename")){
				$insert_filed .= "`filename`,";
				$insert_value .= "'$filename',";
			}

			if($comment = _formdata("comment")){
				$insert_filed .= "`comment`,";
				$insert_value .= "'$comment',";
			}



			if($bgcolor = _formdata("bgcolor")){
				$insert_filed .= "`bgcolor`,";
				$insert_value .= "'$bgcolor',";
			}

			if($header = _formdata("header")){
				$insert_filed .= "`header`,";
				$insert_value .= "'on',";
			}

			if($footer = _formdata("footer")){
				$insert_filed .= "`footer`,";
				$insert_value .= "'on',";
			}

			if($sub_menu = _formdata("sub_menu")){
				$insert_filed .= "`sub_menu`,";
				$insert_value .= "'on',";
			}

			if($sub_width = _formdata("sub_width")){
				$insert_filed .= "`sub_width`,";
				$insert_value .= "'$sub_width',";
			}

			if($sub_align = _formdata("sub_align")){
				$insert_filed .= "`sub_align`,";
				$insert_value .= "'$sub_align',";
			}

			$query = "INSERT INTO site_themefiles ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			$insert_id = _sales_insert($query);
			//echo $query."<br>";

			//echo "insert id = ".$insert_id."<br>";
			//$query = "select * from site_themefiles WHERE `filename`='$filename' and `regdate`='$TODAYTIME' ";
			//if($rows = _sales_query_rows($query)){	
				
				$query1 = "select * from `site_language`";
				if($rowss1 = _sales_query_rowss($query1)){
					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];

						$seo_title = _formdata("title_".$rows1->code);
						$seo_keyword = _formdata("keyword_".$rows1->code);
						$seo_description = _formdata("description_".$rows1->code);

						//$desktop =  addslashes( _formdata($rows1->code) );
						$desktop =  addslashes( _formdata($rows1->code) );
						$query = "INSERT INTO site_themefiles_html (`pid`,`theme`,`language`,`mobile`,`filename`,`html`,`title`,`keyword`,`description`,`sub_menu`,`sub_width`,`bgcolor`,`sub_align`) 
						VALUES ('".$insert_id."','$theme','".$rows1->code."','pc','$filename','$desktop','$seo_title','$seo_keyword','$seo_description','$sub_menu','$sub_width','$bgcolor','$sub_align')";
						//echo $query."<br>";
						_sales_query($query);

						// $mobile =  addslashes( _formdata($rows1->code."_m") );
						$mobile =  addslashes( _formdata($rows1->code."_m") );
				

						$query = "INSERT INTO site_themefiles_html (`pid`,`theme`,`language`,`mobile`,`filename`,`html`,`title`,`keyword`,`description`,`sub_menu`,`sub_width`,`bgcolor`,`sub_align`) 
						VALUES ('".$insert_id."','$theme','".$rows1->code."','m','$filename','$mobile','$seo_title','$seo_keyword','$seo_description','$sub_menu','$sub_width','$bgcolor','$sub_align')";

						//echo $query."<br>";
						_sales_query($query);
				
					}
				}	


			//}	

			// 호스팅서비 : html 파일 생성 by CURL
			$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
			_curl_post($curl_path,"mode=html&filename=$filename&theme=$theme");

			$url = "site_themefiles.php"."?limit=$limit&searchkey=$search&theme=$theme";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "delete"){
			$query = "select * from site_themefiles WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){	
				
				$query = "DELETE FROM site_themefiles WHERE `Id`='$uid'";
    			_sales_query($query);

		    	$query = "DELETE FROM site_themefiles_html WHERE `pid`='$uid'";
    			_sales_query($query);

    			// 호스팅서비 : html 파일 생성 by CURL
				$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
				_curl_post($curl_path,"mode=delete&filename=".$rows->filename."&theme=".$rows->theme);

    			$url = "site_themefiles.php"."?limit=$limit&searchkey=$search&theme=".$rows->theme;    		
				echo "<script> location.replace('$url'); </script>";
			}
			
		} else if($mode == "upload"){

		} else if($mode == "files"){
			echo "themefiles files <br>";
			echo $theme."<br>";

			// 호스팅서비 : html 파일 생성 by CURL
			$curl_path = "http://".$sales_db->domain."/theme/curl_theme.php";
			$curl_return = _curl_post($curl_path,"mode=files&theme=".$theme);
			echo $curl_return;
		}

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>