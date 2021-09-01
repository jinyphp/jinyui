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
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";


		$mode = _formmode();
		$uid = _formdata("uid");
		$code = _formdata("code");


		echo "fafvads";

	
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



		echo "abcdefg";

		if($mode == "delete"){
			$query = "DELETE FROM `site_boardlist` WHERE `Id`='$uid'";
    		_sales_query($query);

		    $query = "DELETE FROM `site_board` WHERE `board`='$uid'";
    		_sales_query($query);

		} else {
			$query = "select * from `site_boardlist` where Id='$uid'";
			echo $query."<br>";
			if($rows = _sales_query_rows($query)){
				// 수정 
				// 이메일 중복여부 체크
				$code = _formdata("code");
				$query1 = "select * from `site_boardlist` where code='$code'";
				echo $query1."<br>";
				if($rows->code != $code && $rows1 = _sales_query_rows($query1)){
					echo "중복된 코드 입니다.";
				} else {
					$query = "UPDATE `site_boardlist` SET ";
					if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

					$code = _formdata("code"); $query .= "`code`='$code' ,";
					$title = _formdata("title"); $query .= "`title`='$title' ,";
					$listnum = _formdata("listnum"); $query .= "`listnum`='$listnum' ,";

					if($skin_check = _formdata("skin_check")) $query .= "`skin_check`='on' ,"; else $query .= "`skin_check`='' ,";

					$skin = _formdata("skin"); $query .= "`skin`='". addslashes($skin) ."' ,";


					//# 언어별 상품정보 갱신
					$query1 = "select * from `site_language`";
					if($rowss1 = _sales_query_rowss($query1)){

						// JSOM
						$seo_title = "{";
						$seo_keyword = "{";
						$seo_description = "{";				

						for($i=0;$i<count($rowss1);$i++){
							$rows1 = $rowss1[$i];

							$seo_title .= "\"$rows1->code\":\"".addslashes( _formdata("seo_title_".$rows1->code) )."\"";
							$seo_description .= "\"$rows1->code\":\"".addslashes( _formdata("seo_description_".$rows1->code) )."\"";
							$seo_keyword .= "\"$rows1->code\":\"".addslashes( _formdata("seo_keyword_".$rows1->code) )."\"";

							if($i<(count($rowss1)-1)) {
								$seo_title .= ",";
								$seo_description .= ",";
								$seo_keyword .= ",";
							}	

						}

						$seo_title .= "}";				$query .= "`seo_title`='$seo_title' ,";
						$seo_description .= "}";		$query .= "`seo_description`='$seo_description' ,";
						$seo_keyword .= "}";			$query .= "`seo_keyword`='$seo_keyword' ,";
					}

					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					echo $query."<br>";
					_sales_query($query);

				}


			} else {
				//삽입 
				// 삽입 
				$query1 = "select * from `site_boardlist` where code='$code'";
				if($rows->code != $code && $rows1 = _sales_query_rows($query1)){
					echo "중복된 코드 입니다.";
				} else {
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";

					if($enable = _formdata("enable")){
						$insert_filed .= "`enable`,";
						$insert_value .= "'on',";
					}

					if($code = _formdata("code")){
						$insert_filed .= "`code`,";
						$insert_value .= "'$code',";
					}

					if($title = _formdata("title")){
						$insert_filed .= "`title`,";
						$insert_value .= "'$title',";
					}

					if($listnum = _formdata("listnum")){
						$insert_filed .= "`listnum`,";
						$insert_value .= "'$listnum',";
					}

					if($skin_check = _formdata("skin_check")){
						$insert_filed .= "`skin_check`,";
						$insert_value .= "'on',";
					}

					if($skin = _formdata("skin")){
						$insert_filed .= "`skin`,";
						$insert_value .= "'". addslashes($skin) ."',";
					}

				//# 언어별 상품정보 갱신
				$query1 = "select * from `site_language`";
				if($rowss1 = _sales_query_rowss($query1)){

					// JSOM
					$seo_title = "{";
					$seo_keyword = "{";
					$seo_description = "{";				

					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];

						$seo_title .= "\"$rows1->code\":\"".addslashes( _formdata("seo_title_".$rows1->code) )."\"";
						$seo_description .= "\"$rows1->code\":\"".addslashes( _formdata("seo_description_".$rows1->code) )."\"";
						$seo_keyword .= "\"$rows1->code\":\"".addslashes( _formdata("seo_keyword_".$rows1->code) )."\"";

						if($i<(count($rowss1)-1)) {
							$seo_title .= ",";
							$seo_description .= ",";
							$seo_keyword .= ",";
						}	

					}

					$seo_title .= "}";
					$insert_filed .= "`seo_title`,"; $insert_value .= "'$seo_title',";
				
					$seo_description .= "}";
					$insert_filed .= "`seo_description`,"; $insert_value .= "'$seo_description',";

					$seo_keyword .= "}";
					$insert_filed .= "`seo_keyword`,"; $insert_value .= "'$seo_keyword',";
				}

						

					$query = "INSERT INTO `site_boardlist` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					echo $query."<br>";
					_sales_query($query);


					$query1 = "select * from `site_boardlist` where code='$code'";
					if($rows1 = _sales_query_rows($query1)){
					// 계시판 데이터베이스 생성
					$query = "CREATE TABLE `site_board".$rows1->Id."` (
  						`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  						`enable` tinyint(4) DEFAULT NULL,
  						`board` varchar(10) DEFAULT NULL,
  						`domain` varchar(255) DEFAULT NULL,
  						`email` varchar(255) DEFAULT NULL,
  						`password` varchar(255) DEFAULT NULL,
  						`regdate` datetime DEFAULT NULL,
  						`code` varchar(255) DEFAULT NULL,
 						`title` varchar(255) DEFAULT NULL,
  						`html` text,
  						`reply` text,
 						`reply_email` varchar(255) DEFAULT NULL,
  						`click` int(6) DEFAULT NULL,
  						`file1` varchar(255) DEFAULT NULL,
  						`file2` varchar(255) DEFAULT NULL,
  						`pos` varchar(10) DEFAULT NULL,
  						`ref` varchar(20) DEFAULT NULL,
 						`level` varchar(10) DEFAULT '0',
  						PRIMARY KEY (`Id`)
						) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
					_sales_query($query);
					}

				}	

			}	

		
		}


			echo "<script>
				$.ajax({
            		url:'/ajax_site_boardlist.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#site_list').html(data);
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