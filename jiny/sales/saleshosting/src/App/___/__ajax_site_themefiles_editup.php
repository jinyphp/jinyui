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
		
		include "./conf/sales.php";	// Sales 사용자 DB 접근.

		echo "editup <br>";

		// $cookie_email = _cookie_email();
		// $members = _members_rows($cookie_email);

		$mode = _formmode();	//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$theme = _formdata("theme");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");



		if($uid && $mode == "edit"){

			$query = "UPDATE `site_themefiles` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
			if($theme = _formdata("theme")) $query .= "`theme`='$theme' ,";
			if($filename = _formdata("filename")) $query .= "`filename`='$filename' ,";
			if($comment = _formdata("comment")) $query .= "`comment`='$comment' ,";

			if($header = _formdata("header")) $query .= "`header`='on' ,"; else $query .= "`header`='' ,";
			if($enable = _formdata("footer")) $query .= "`footer`='on' ,"; else $query .= "`footer`='' ,";
			if($enable = _formdata("menu")) $query .= "`menu`='on' ,"; else $query .= "`menu`='' ,";

			if($width = _formdata("width")) $query .= "`width`='$width' ,";
			if($align = _formdata("align")) $query .= "`align`='$align' ,";
			if($bgcolor = _formdata("bgcolor")) $query .= "`bgcolor`='$bgcolor' ,";

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);	//echo $query;
			_sales_query($query);


			$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){
				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					$seo_title = _formdata("title_".$rows1->code);
					$seo_keyword = _formdata("keyword_".$rows1->code);
					$seo_description = _formdata("description_".$rows1->code);


					$desktop =  addslashes( _formdata($rows1->code) );
					$query = "UPDATE `site_themefiles_html` SET  `filename` = '$filename',`html` = '$desktop',`title` = '$seo_title',`keyword` = '$seo_keyword',`description` = '$seo_description' 
								where `pid`='$uid' and `language`='".$rows1->code."' and `mobile`='pc'";
					_sales_query($query);



					$mobile =  addslashes( _formdata($rows1->code."_m") );
					$query = "UPDATE `site_themefiles_html` SET  `filename` = '$filename',`html` = '$mobile',`title` = '$seo_title',`keyword` = '$seo_keyword',`description` = '$seo_description' 
								where `pid`='$uid' and `language`='".$rows1->code."' and `mobile`='m'";
					_sales_query($query);

			

				}
			}	

			// _ajax_pagecall_script("/ajax_site_themefiles.php",_formdata("ajaxkey"));
			$url = "site_themefiles.php?limit=$limit&searchkey=$search";    		
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
				$insert_value .= "'on',";
			}

			if($footer = _formdata("footer")){
				$insert_filed .= "`footer`,";
				$insert_value .= "'on',";
			}

			if($menu = _formdata("menu")){
				$insert_filed .= "`menu`,";
				$insert_value .= "'on',";
			}

			$query = "INSERT INTO `site_themefiles` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			echo $query."<br>";

			$query = "select * from `site_themefiles` WHERE `filename`='$filename' and `regdate`='$TODAYTIME' ";
			if($rows = _sales_query_rows($query)){	
				
				$query1 = "select * from `site_language`";
				if($rowss1 = _sales_query_rowss($query1)){
					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];

						$seo_title = _formdata("title_".$rows1->code);
						$seo_keyword = _formdata("keyword_".$rows1->code);
						$seo_description = _formdata("description_".$rows1->code);

						//$desktop =  addslashes( _formdata($rows1->code) );
						$desktop =  addslashes( _formdata($rows1->code) );
						$query = "INSERT INTO `site_themefiles_html` (`pid`,`theme`,`language`,`mobile`,`filename`,`html`,`title`,`keyword`,`description`) 
						VALUES ('".$rows->Id."','$theme','".$rows1->code."','pc','$filename','$desktop','$seo_title','$seo_keyword','$seo_description')";
						echo $query."<br>";
						_sales_query($query);

						// $mobile =  addslashes( _formdata($rows1->code."_m") );
						$mobile =  addslashes( _formdata($rows1->code."_m") );
				

						$query = "INSERT INTO `site_themefiles_html` (`pid`,`theme`,`language`,`mobile`,`filename`,`html`,`title`,`keyword`,`description`) 
						VALUES ('".$rows->Id."','$theme','".$rows1->code."','m','$filename','$mobile','$seo_title','$seo_keyword','$seo_description')";

						echo $query."<br>";
						_sales_query($query);
				
					}
				}	


			}	

			$url = "site_themefiles.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "delete"){
			$query = "DELETE FROM `site_themefiles` WHERE `Id`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";

		    $query = "DELETE FROM `site_themefiles_html` WHERE `pid`='$uid'";
    		_sales_query($query);
		    //echo $query."<br>";

    		$url = "site_themefiles.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "upload"){

		}


		/*
		// CURL 처리
		$query = "select * from `site_env`";
		if($site_env_rows = _sales_query_rows($query)){
			// **********************
			// CURL을 통하여, 해당 고객 계정 서버에 상품 설명 html 파일을 생성함.
			if($site_env_rows->domain){
				$curl_path = "http://".$site_env_rows->domain."/curl_theme.php";
				echo _curl_post($curl_path,"mode=html&filename=$filename");
			} 
		} 
		*/




		/*
		echo "<script>
				$.ajax({
            		url:'/ajax_site_themefiles_body.php?theme=$theme&ajaxkey=$ajaxkey&limit=$limit',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
    	</script>";
    	*/
    	


		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>