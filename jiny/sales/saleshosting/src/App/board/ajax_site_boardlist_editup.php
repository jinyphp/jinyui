<?php
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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");	// Sales 사용자 DB 접근.


		$mode = _formmode();	//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");


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
					$type = _formdata("type"); $query .= "`type`='$type' ,";
					$title = _formdata("title"); $query .= "`title`='". addslashes($title) ."' ,";


					$listnum = _formdata("listnum"); $query .= "`listnum`='$listnum' ,";

					if($skin_check = _formdata("skin_check")) $query .= "`skin_check`='on' ,"; else $query .= "`skin_check`='' ,";

					$skin = _formdata("skin"); $query .= "`skin`='". addslashes($skin) ."' ,";

					if($check_attach = _formdata("check_attach")) $query .= "`check_attach`='on' ,"; else $query .= "`check_attach`='' ,";
					$attach_label = _formdata("attach_label"); $query .= "`attach_label`='$attach_label' ,";

					if($check_login = _formdata("check_login")) $query .= "`check_login`='on' ,"; else $query .= "`check_login`='' ,";
					if($check_reply = _formdata("check_reply")) $query .= "`check_reply`='on' ,"; else $query .= "`check_reply`='' ,";
					if($check_write = _formdata("check_write")) $query .= "`check_write`='on' ,"; else $query .= "`check_write`='' ,";
					if($check_comment = _formdata("check_comment")) $query .= "`check_comment`='on' ,"; else $query .= "`check_comment`='' ,";

					$str = _formdata("str"); $query .= "`str`='$str' ,";
					$bgcolor = _formdata("bgcolor"); $query .= "`bgcolor`='$bgcolor' ,";
					$index_listnum = _formdata("index_listnum"); $query .= "`index_listnum`='$index_listnum' ,";

					$themefiles_list = _formdata("themefiles_list"); $query .= "`themefiles_list`='$themefiles_list' ,";
					$themefiles_view = _formdata("themefiles_view"); $query .= "`themefiles_view`='$themefiles_view' ,";
					$themefiles_edit = _formdata("themefiles_edit"); $query .= "`themefiles_edit`='$themefiles_edit' ,";

					if($view_secure = _formdata("view_secure")) $query .= "`view_secure`='on' ,"; else $query .= "`view_secure`='' ,";
					if($view_reply = _formdata("view_reply")) $query .= "`view_reply`='on' ,"; else $query .= "`view_reply`='' ,";
					if($view_content = _formdata("view_content")) $query .= "`view_content`='on' ,"; else $query .= "`view_content`='' ,";

					if($relation_goods = _formdata("relation_goods")) $query .= "`relation_goods`='on' ,"; else $query .= "`relation_goods`='' ,";
					$relation_type = _formdata("relation_type"); $query .= "`relation_type`='$relation_type' ,";
					$relation_cols = _formdata("relation_cols"); $query .= "`relation_cols`='$relation_cols' ,";
					$relation_rows = _formdata("relation_rows"); $query .= "`relation_rows`='$relation_rows' ,";

					// 본문 작성자 표기 : {view_writer} 
					$view_writer = _formdata("view_writer"); $query .= "`view_writer`='$view_writer' ,";

					// 본문 작성일자 표기 : {view_regdate}
					$view_regdate = _formdata("view_regdate"); $query .= "`view_regdate`='$view_regdate' ,";

					// 본문 첨부파일 이미지 표기 : {view_images}
					$view_images = _formdata("view_images"); $query .= "`view_images`='$view_images' ,";

					// 첨부 이미지 최대 크기 : {view_images_maxsize} 
					$view_images_maxsize = _formdata("view_images_maxsize"); $query .= "`view_images_maxsize`='$view_images_maxsize' ,";

					// 첨부 이미지 출력방식 :  {view_images_type} 
					$view_images_type = _formdata("view_images_type"); $query .= "`view_images_type`='$view_images_type' ,";

					// 본문 첨부파일 정보 표기 : {view_attach_view} 
					$view_attach_view = _formdata("view_attach_view"); $query .= "`view_attach_view`='$view_attach_view' ,";

					// 본문 첨부파일 다운로드 링크 허용: {view_attach_down} 
					$view_attach_down = _formdata("view_attach_down"); $query .= "`view_attach_down`='$view_attach_down' ,";



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

					if($type = _formdata("type")){
						$insert_filed .= "`type`,";
						$insert_value .= "'$type',";
					}

					if($title = _formdata("title")){
						$insert_filed .= "`title`,";
						// $insert_value .= "'$title',";
						$insert_value .= "'". addslashes($title) ."',";
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

					$insert_filed .= "`check_attach`,";
					if($check_attach = _formdata("check_attach")) $insert_value .= "'on',"; else $insert_value .= "'',";

					if($attach_label = _formdata("attach_label")){
						$insert_filed .= "`attach_label`,";
						$insert_value .= "'$attach_label',";
					}


					$insert_filed .= "`check_login`,";
					if($check_login = _formdata("check_login")) $insert_value .= "'on',"; else $insert_value .= "'',";

					$insert_filed .= "`check_reply`,";
					if($check_reply = _formdata("check_reply")) $insert_value .= "'on',"; else $insert_value .= "'',";

					$insert_filed .= "`check_write`,";
					if($check_write = _formdata("check_write")) $insert_value .= "'on',"; else $insert_value .= "'',";

					$insert_filed .= "`check_comment`,";
					if($check_comment = _formdata("check_comment")) $insert_value .= "'on',"; else $insert_value .= "'',";

					if($str = _formdata("str")){
						$insert_filed .= "`str`,";
						$insert_value .= "'$str',";
					}

					if($bgcolor = _formdata("bgcolor")){
						$insert_filed .= "`bgcolor`,";
						$insert_value .= "'$bgcolor',";
					}

					if($index_listnum = _formdata("index_listnum")){
						$insert_filed .= "`index_listnum`,";
						$insert_value .= "'$index_listnum',";
					}

					if($themefiles_list = _formdata("themefiles_list")){
						$insert_filed .= "`themefiles_list`,";
						$insert_value .= "'$themefiles_list',";
					}

					if($themefiles_edit = _formdata("themefiles_edit")){
						$insert_filed .= "`themefiles_edit`,";
						$insert_value .= "'$themefiles_edit',";
					}

					if($themefiles_view = _formdata("themefiles_view")){
						$insert_filed .= "`themefiles_view`,";
						$insert_value .= "'$themefiles_view',";
					}

					$insert_filed .= "`view_secure`,";
					if($view_secure = _formdata("view_secure")) $insert_value .= "'on',"; else $insert_value .= "'',";

					$insert_filed .= "`view_reply`,";
					if($view_reply = _formdata("view_reply")) $insert_value .= "'on',"; else $insert_value .= "'',";

					$insert_filed .= "`view_content`,";
					if($view_content = _formdata("view_content")) $insert_value .= "'on',"; else $insert_value .= "'',";

					$insert_filed .= "`relation_goods`,";
					if($relation_goods = _formdata("relation_goods")) $insert_value .= "'on',"; else $insert_value .= "'',";

					if($relation_type = _formdata("relation_type")){
						$insert_filed .= "`relation_type`,";
						$insert_value .= "'$relation_type',";
					}

					if($relation_cols = _formdata("relation_cols")){
						$insert_filed .= "`relation_cols`,";
						$insert_value .= "'$relation_cols',";
					}

					if($relation_rows = _formdata("relation_rows")){
						$insert_filed .= "`relation_rows`,";
						$insert_value .= "'$relation_rows',";
					}


					// 본문 작성자 표기 : {view_writer} 
					$insert_filed .= "`view_writer`,";
					if($view_writer = _formdata("view_writer")) $insert_value .= "'on',"; else $insert_value .= "'',";

					// 본문 작성일자 표기 : {view_regdate}
					$insert_filed .= "`view_regdate`,";
					if($view_regdate = _formdata("view_regdate")) $insert_value .= "'on',"; else $insert_value .= "'',";

					// 본문 첨부파일 이미지 표기 : {view_images}
					$insert_filed .= "`view_images`,";
					if($view_images = _formdata("view_images")) $insert_value .= "'on',"; else $insert_value .= "'',";

					// 첨부 이미지 최대 크기 : {view_images_maxsize} 
					if($view_images_maxsize = _formdata("view_images_maxsize")){
						$insert_filed .= "`view_images_maxsize`,";
						$insert_value .= "'$view_images_maxsize',";
					}

					// 첨부 이미지 출력방식 :  {view_images_type} 
					if($view_images_type = _formdata("view_images_type")){
						$insert_filed .= "`view_images_type`,";
						$insert_value .= "'$view_images_type',";
					}
					

					// 본문 첨부파일 정보 표기 : {view_attach_view} 
					$insert_filed .= "`view_attach_view`,";
					if($view_attach_view = _formdata("view_attach_view")) $insert_value .= "'on',"; else $insert_value .= "'',";

					// 본문 첨부파일 다운로드 링크 허용: {view_attach_down} 
					$insert_filed .= "`view_attach_down`,";
					if($view_attach_down = _formdata("view_attach_down")) $insert_value .= "'on',"; else $insert_value .= "'',";


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


		$url = "site_boardlist.php?limit=$limit&searchkey=$search";    		
		echo "<script> location.replace('$url'); </script>";


	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>