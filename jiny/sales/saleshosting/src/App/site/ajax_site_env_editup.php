<?

	// update : 2016.01.31 = 코드정리 및 함수처리

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

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");	

		if($mode=="edit"){
			_site_env_edit($uid);

		} else if($mode=="new"){
			_site_env_new();

		} else if($mode == "delete"){
			_site_env_delete_byId($uid);
		}

		// 페이지 이동 
		$url = "site_env.php?limit=".$limit."&ajaxkey=".$ajaxkey;
		echo "<script> url_replace(\"$url\") </script>";
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	// ***************************
	// 수정모드
	function _site_env_edit($uid){
		global $sales_db;

		$query = "select * from `site_env` WHERE Id =$uid";
		if($rows = _sales_query_rows($query)){
			
			$query = "UPDATE `site_env` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,"; 

			$code = _formdata("code"); $query .= "`code`='$code' ,"; 
			$afterlogin = _formdata("afterlogin"); $query .= "`afterlogin`='$afterlogin' ,"; 
			$dome = _formdata("dome"); $query .= "`dome`='$dome' ,"; 

			$type = _formdata("type"); $query .= "`type`='$type' ,";
			$process = _formdata("process"); $query .= "`process`='$process' ,";
			$domain = _formdata("domain"); $query .= "`domain`='$domain' ,";
			
			$language = _formdata("language1"); $query .= "`language`='$language' ,";
			$country = _formdata("country1"); $query .= "`country`='$country' ,";
			$adult_check = _formdata("adult_check"); $query .= "`adult_check`='$adult_check' ,";

			$menu_code = _formdata("menu_code"); $query .= "`menu_code`='$menu_code' ,";
			$menu_code_login = _formdata("menu_code_login"); $query .= "`menu_code_login`='$menu_code_login' ,";

			if($members_prices = _formdata("members_prices")) $query .= "`members_prices`='on' ,"; else $query .= "`members_prices`='' ,"; 
			if($members_auth = _formdata("members_auth")) $query .= "`members_auth`='on' ,"; else $query .= "`members_auth`='on' ,";
			if($members_point = _formdata("members_point")) $query .= "`members_point`='$members_point' ,";
			if($members_point = _formdata("members_point")) $query .= "`members_point`='$members_point' ,";

			$theme = _formdata("theme"); $query .= "`theme`='$theme' ,";

			$align = _formdata("align"); $query .= "`align`='$align' ,";
			$width = _formdata("width"); $query .= "`width`='$width' ,";
			$bgcolor = _formdata("bgcolor"); $query .= "`bgcolor`='$bgcolor' ,";
			$left_margin = _formdata("left_margin"); $query .= "`left_margin`='$left_margin' ,";
			$top_margin = _formdata("top_margin"); $query .= "`top_margin`='$top_margin' ,";

			$insert_filed .= "`index_pages`,";
			if($index_pages = _formdata("index_pages")){
				$query .= "`index_pages`='$index_pages' ,";
			} else $query .= "`index_pages`='index' ,";

			$insert_filed .= "`header_pages`,";
			if($header_pages = _formdata("header_pages")){
				$query .= "`header_pages`='$header_pages' ,";
			} else $query .= "`header_pages`='header' ,";

			$insert_filed .= "`footer_pages`,";
			if($footer_pages = _formdata("footer_pages")){
				$query .= "`footer_pages`='$footer_pages' ,";
			} else $query .= "`footer_pages`='footer' ,";



			//# 언어별 상품정보 갱신
			$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){

				// JSOM
				$seo_title = "{";
				$seo_keyword = "{";
				$seo_description = "{";				

				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					//$_seo_title = "seo_title_".$rows1->code;
					$seo_title .= "\"$rows1->code\":\"".addslashes( _formdata("seo_title_".$rows1->code) )."\"";
					
					//$_seo_description = "seo_description_".$rows1->code;
					$seo_description .= "\"$rows1->code\":\"".addslashes( _formdata("seo_description_".$rows1->code) )."\"";
						
					//$_seo_keyword = "seo_keyword_".$rows1->code;
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

			// 로고 파일 업로드 : CURL
			if(!is_dir("./upload")) mkdir("./upload"); // 업로드 임시 폴더 확인
			if($files = _html_form_uploadfile("userfile1","./upload/logo-$uid")) {
				// 로고 파일 업로드 성공시, query문 추가					
				$query .= "`logo`='"."logo-$uid.".$files[ext]."' ,";
					
				if($sales_db->domain){	// curl 방식으로, 사용자 서버로 로고파일 복사					
					echo _curl_upload("upload","http://".$sales_db->domain."/curl_upload.php","./images","./upload/logo-$uid.".$files[ext]);
					_file_delete($file); // 임시 업로드 파일 삭제
				} 
			}

			$query .= "WHERE Id =$uid";
			$query = str_replace(",WHERE","where ",$query);
			// echo $query;
			_sales_query($query);

			//도메인 주소가 변경된 경우, 관련 정보들 모두 갱신.
			if($rows->domain && $rows->domain != $domain) _domain_update($rows->domain,$domain);
	
		}

	}
	




	function _domain_update($src,$dst){
		
		$query = "UPDATE `site_header` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_footer` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_files` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_board` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_html` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_index` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_index_goods` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_index_title` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_members` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_members_agree` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_menu` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_menu_setting` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);


		$query = "UPDATE `site_skin_html` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_pages` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `site_pages_html` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);

		$query = "UPDATE `shop_cate` SET `domain`='$domain' WHERE domain ='$src'";
		_sales_query($query);
	}


	function _site_env_new(){
		global $TODAYTIME;
		global $sales_db;

		

		$domain = _formdata("domain");
		if($rows = _site_env_domain($domain) ){
			$msg = "$domain 중복된 도메인 입니다.";
		} else {
			// 신규모드
			$insert_filed = ""; $insert_value = "";
			$insert_filed = "`regdate`,"; $insert_value = "'".$TODAYTIME."',";
				
			$insert_filed .= "`enable`,";
			if($enable = _formdata("code")) { $insert_value .= "'on',"; } else { $insert_value .= "'',"; }

			$insert_filed .= "`code`,";	$insert_value .= "'"._formdata("code")."',";			
			$insert_filed .= "`domain`,";	$insert_value .= "'".$domain."',";		
			$insert_filed .= "`language`,";	$insert_value .= "'"._formdata("language1")."',";
			$insert_filed .= "`country`,";	$insert_value .= "'"._formdata("country1")."',";

			$insert_filed .= "`adult_check`,";
			if($enable = _formdata("adult_check")) $insert_value .= "'on',"; else $insert_value .= "'',";

			$insert_filed .= "`menu_code`,";	$insert_value .= "'"._formdata("menu_code")."',";
			$insert_filed .= "`menu_code_login`,";	$insert_value .= "'"._formdata("menu_code_login")."',";


			$insert_filed .= "`members_prices`,";
			if($enable = _formdata("members_prices")) $insert_value .= "'on',"; else $insert_value .= "'',";

			$insert_filed .= "`members_auth`,";	$insert_value .= "'"._formdata("members_auth")."',";					
			$insert_filed .= "`dome`,";	$insert_value .= "'"._formdata("dome")."',";					
			$insert_filed .= "`members_point`,";	$insert_value .= "'"._formdata("members_point")."',";					
			$insert_filed .= "`members_emoney`,";	$insert_value .= "'"._formdata("members_emoney")."',";	
			$insert_filed .= "`adminkey`,"; $insert_value .= "'".$sales_db->adminkey."',";
			$insert_filed .= "`theme`,";	$insert_value .= "'"._formdata("theme")."',";	


			$insert_filed .= "`align`,";	$insert_value .= "'"._formdata("align")."',";	
			$insert_filed .= "`width`,";	$insert_value .= "'"._formdata("width")."',";	
			$insert_filed .= "`bgcolor`,";	$insert_value .= "'"._formdata("bgcolor")."',";	
			$insert_filed .= "`top_margin`,";	$insert_value .= "'"._formdata("top_margin")."',";	
			$insert_filed .= "`left_margin`,";	$insert_value .= "'"._formdata("left_margin")."',";	


			$insert_filed .= "`index_pages`,";
			if($index_pages = _formdata("index_pages")){
				$insert_value .= "'".$index_pages ."',";
			} else $insert_value .= "'index',";

			$insert_filed .= "`header_pages`,";
			if($header_pages = _formdata("header_pages")){
				$insert_value .= "'".$header_pages ."',";
			} else $insert_value .= "'header',";

			$insert_filed .= "`footer_pages`,";
			if($footer_pages = _formdata("footer_pages")){
				$insert_value .= "'".$footer_pages ."',";
			} else $insert_value .= "'footer',";


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

			$query = "INSERT INTO `site_env` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);


			// ***** Logo File Upload : CURL ***************************
			$query1 = "select * from `site_env` WHERE domain = '".$domain."'";
			$rows = _sales_query_rows($query1);
			$uid = $rows->Id;

			// 로고 파일 업로드 : CURL
			if(!is_dir("./upload")) mkdir("./upload"); // 업로드 임시 폴더 확인
			if($files = _html_form_uploadfile("userfile1","./upload/logo-$uid")) { // 로고 파일 업로드 성공시						
				if($sales_db->domain){	// curl 방식으로, 사용자 서버로 로고파일 복사					
					echo _curl_filecopy("http://".$sales_db->domain."/curl_upload.php","./images","./upload/logo-$uid.".$files[ext]);
					_file_delete($file); // 임시 업로드 파일 삭제
				} 
			}

			$query = "UPDATE `site_env` SET `logo`='"."logo-$uid.".$files[ext]."' WHERE domain = '".$domain."'";
			_sales_query($query);

		}			
			
	}

	function _site_env_domain($domain){
		$query1 = "select * from `site_env` WHERE domain = '".$domain."'";
		return _sales_query_rows($query1);
	}

	function _site_env_delete_byId($uid){
		$query = "DELETE FROM `site_env` WHERE `Id`='$uid'";
		_sales_query($query);
	}
	
?>