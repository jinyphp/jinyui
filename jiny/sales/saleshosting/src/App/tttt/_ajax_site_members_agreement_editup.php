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
	include "./func/members.php";

	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

	

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		// echo "uid = $uid <br>";
		$ajaxkey = _formdata("ajaxkey");
		

		
		function _ajax_pagecall_script($url,$ajaxkey){
			
			echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
    			</script>";
    		
    	}		

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

		
		if($mode == "delete"){
			$query = "select * from `site_members_agree` where Id='$uid'";
			echo $query."<br>";
			if($rows = _sales_query_rows($query)){
				$query = "DELETE FROM `site_members_agree` WHERE `code`='".$rows->code."'";
    			_sales_query($query);
		    	//echo $query."<br>";
    		}
		} else {

			$query = "select * from `site_members_agree` where Id='$uid'";
			//echo $query."<br>";
			if($rows = _sales_query_rows($query)){
			}
				
			$agree_code = _formdata("code");
			//echo "agree_code = $agree_code<br>";

			$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){
				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					if($agree_code == $rows->code){
						$query = "select * from `site_members_agree` where language='".$rows1->code."' and code='$agree_code'";
					} else {
						$query = "select * from `site_members_agree` where language='".$rows1->code."' and code='".$rows->code."'";
					}
					//echo $query."<br>";
					if($rows3 = _sales_query_rows($query)){
						// 수정 모드 
						/*
						$query = "UPDATE `site_members_agree` SET ";
						if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
						if($require = _formdata("require")) $query .= "`require`='on' ,"; else $query .= "`require`='' ,";
						$query .= "`code`='$agree_code' ,";
						*/

						if($enable = _formdata("enable")) $enable = "on"; else $enable = "";
						if($require = _formdata("require")) $require = "on"; else $require = "";

						$title = _formdata("title_".$rows1->code);

						$agree_text =  addslashes( _formdata($rows1->code) );

						$query = "UPDATE `site_members_agree` SET  `enable`='$enable' , `require`='$require' , `agreement` = '$agree_text', 
											`title` = '$title', `code` = '$agree_code' where `language`='".$rows1->code."' ";
						if($agree_code == $rows->code){
							$query .= "and `code`='$agree_code'";
						} else {
							$query .= "and `code`='".$rows->code."'";
						}					
						//echo $query."<br>";
						_sales_query($query);

					} else {
						//신규 삽입 

						if($enable = _formdata("enable")) $enable = "on"; else $enable = "";
						if($require = _formdata("require")) $require = "on"; else $require = "";

						$title = _formdata("title_".$rows1->code);

						$agree_text =  addslashes( _formdata($rows1->code) );

						/*
						$query = "UPDATE `site_members_agree` SET  `enable`='$enable' , `require`='$require' , `agreement` = '$agree_text', 
											`title` = '$title' where `language`='".$rows1->code."' and `code`='$agree_code'";
						*/
						$query = "INSERT INTO `site_members_agree` (`enable`,`language`,`require`,`title`,`agreement`,`code`) 
										VALUES ('$enable','".$rows1->code."','$require','$title','$agree_text','$agree_code')";
						//echo $query."<br>";
						_sales_query($query);



					}

				}
			}			

		}

/*

		if($uid && $mode == "edit"){

			$query = "UPDATE `site_pages` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
			if($title = _formdata("title")) $query .= "`title`='$title' ,";

			if($header = _formdata("header")) $query .= "`header`='on' ,"; else $query .= "`header`='' ,";
			if($enable = _formdata("footer")) $query .= "`footer`='on' ,"; else $query .= "`footer`='' ,";
			if($enable = _formdata("menu")) $query .= "`menu`='on' ,"; else $query .= "`menu`='' ,";

			if($width = _formdata("width")) $query .= "`width`='$width' ,";
			if($align = _formdata("align")) $query .= "`align`='$align' ,";
			if($bgcolor = _formdata("bgcolor")) $query .= "`bgcolor`='$bgcolor' ,";

			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			//echo $query;
			_sales_query($query);

				$query1 = "select * from `site_language`";
				if($rowss1 = _sales_query_rowss($query1)){
					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];

						$seo_title = _formdata("title_".$rows1->code);
						$seo_keyword = _formdata("keyword_".$rows1->code);
						$seo_description = _formdata("description_".$rows1->code);


						$desktop =  addslashes( _formdata($rows1->code) );

						$query = "UPDATE `site_pages_html` SET  `html` = '$desktop',`title` = '$seo_title',`keyword` = '$seo_keyword',`description` = '$seo_description' 
									where `pid`='$uid' and `language`='".$rows1->code."' and `mobile`='pc'";
						_sales_query($query);

						$mobile =  addslashes( _formdata($rows1->code."_m") );

						$query = "UPDATE `site_pages_html` SET  `html` = '$mobile',`title` = '$seo_title',`keyword` = '$seo_keyword',`description` = '$seo_description' 
									where `pid`='$uid' and `language`='".$rows1->code."' and `mobile`='mobile'";
						_sales_query($query);
					}
				}	


			_ajax_pagecall_script("/ajax_site_pages.php",_formdata("ajaxkey"));


			
		} else if($mode == "new"){

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";
				$insert_value .= "'on',";
			}

			if($title = _formdata("title")){
				$insert_filed .= "`title`,";
				$insert_value .= "'$title',";
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

			$query = "INSERT INTO `site_pages` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			//echo $query;

			$query = "select * from `site_pages` WHERE `title`='$title' and `regdate`='$TODAYTIME' ";
			if($rows = _sales_query_rows($query)){	
				
				$query1 = "select * from `site_language`";
				if($rowss1 = _sales_query_rowss($query1)){
					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];

						$seo_title = _formdata("title_".$rows1->code);
						$seo_keyword = _formdata("keyword_".$rows1->code);
						$seo_description = _formdata("description_".$rows1->code);

						$desktop =  addslashes( _formdata($rows1->code) );

						$query = "INSERT INTO `site_pages_html` (`pid`,`language`,`mobile`,`html`,`title`,`keyword`,`description`) 
						VALUES ('".$rows->Id."','".$rows1->code."','pc','$desktop','$seo_title','$seo_keyword','$seo_description')";
						_sales_query($query);

						$mobile =  addslashes( _formdata($rows1->code."_m") );

						$query = "INSERT INTO `site_pages_html` (`pid`,`language`,`mobile`,`html`,`title`,`keyword`,`description`) 
						VALUES ('".$rows->Id."','".$rows1->code."','mobile','$mobile','$seo_title','$seo_keyword','$seo_description')";
						_sales_query($query);
					}
				}	


			}	

				

			_ajax_pagecall_script("/ajax_site_pages.php",_formdata("ajaxkey"));

		} 
*/
		echo "<script>
				$.ajax({
            		url:'/ajax_site_members_agreement.php?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
    			</script>";
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>