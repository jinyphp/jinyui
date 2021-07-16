<?
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

		// $cookie_email = _cookie_email();
		// $members = _members_rows($cookie_email);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");

		if($mode == "enable"){
			$query = "UPDATE site_css_files SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);

			$url = "site_cssfile.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "disable"){
			$query = "UPDATE site_css_files SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

			$url = "site_cssfile.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "save"){

			

			// echo $curl_return;
			// 페이지 이동 
			$url = "site_cssfile.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
			

		} else if($uid && $mode == "edit"){

			$query = "UPDATE `site_css_files` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
			$title = _formdata("title"); $query .= "`title`='$title' ,";

			// ++ CUTL POST 처리
			// ++ css 파일을 고객서버로 업록드 합니다.
			if($_FILES['userfile']['name']){
				$uploadfile = $_FILES['userfile']['name'];
   				$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   				if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   					echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   				} else {

   					$file_name_with_full_path = $_FILES['userfile']['tmp_name'];
   					$query .= "`css_file`='".$_FILES['userfile']['name']."' ,";

   					$post = array('mode'=>"upload",
							'adminkey'=>$sales_db->adminkey, 
							'filename'=>$_FILES['userfile']['name'], 
							'file_contents'=>'@'.$file_name_with_full_path);
   					
   					$curl_return = _curl_post("http://".$sales_db->domain."/css/curl_css.php",$post);
   					//echo $curl_return;
   				}
			}			

   			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			//echo $query;
			_sales_query($query);


			// 페이지 이동 
			$url = "site_cssfile.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
		
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

			// ++ CUTL POST 처리
			// ++ css 파일을 고객서버로 업록드 합니다.
			if($_FILES['userfile']['name']){
				$uploadfile = $_FILES['userfile']['name'];
   				$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   				if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   					echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   				} else {

   					$file_name_with_full_path = $_FILES['userfile']['tmp_name'];
   					//$query .= "`css_file`='".$_FILES['userfile']['name']."' ,";
   					$insert_filed .= "`css_file`,";
					$insert_value .= "'".$_FILES['userfile']['name']."',";

   					$post = array('mode'=>"upload",
							'adminkey'=>$sales_db->adminkey, 
							'filename'=>$_FILES['userfile']['name'], 
							'file_contents'=>'@'.$file_name_with_full_path);
   					
   					$curl_return = _curl_post("http://".$sales_db->domain."/css/curl_css.php",$post);
   					//echo $curl_return;
   				}
			}	

			$query = "INSERT INTO `site_css_files` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_sales_query($query);
			// echo $query."<br>";

			// 페이지 이동 
			$url = "site_cssfile.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "delete"){
			$query = "DELETE FROM `site_css_files` WHERE `Id`='$uid'";
    		_sales_query($query);

    		// 페이지 이동 
			$url = "site_cssfile.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
		   
		} 

			
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>