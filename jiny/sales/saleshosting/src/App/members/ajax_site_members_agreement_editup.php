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

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");

	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

	

		$mode = _formmode();	//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		$email = _formdata("email");
		

		$agree_code = _formdata("code");
		
		if($mode == "disable"){
			$query = "UPDATE `site_members_agree` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);	//echo $query."<br>";

		} else if($mode == "enable"){
			$query = "UPDATE `site_members_agree` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);	//echo $query."<br>";

		} else if($mode == "delete"){
			$query = "select * from `site_members_agree` where Id='$uid'";
			echo $query."<br>";
			if($rows = _sales_query_rows($query)){
				$query = "DELETE FROM `site_members_agree` WHERE `code`='".$rows->code."'";
    			_sales_query($query);
		    	//echo $query."<br>";
    		}
    	} else if($mode == "edit"){
    		$query = "select * from `site_members_agree` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				$query1 = "select * from `site_language`";

				if($rowss1 = _sales_query_rowss($query1)){
					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];

						// 수정 모드 
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
						
						_sales_query($query);	//echo $query."<br>";

					}
				}

			}

    	} else if($mode == "new"){	
    		$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){
				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					//신규 삽입 
					if($enable = _formdata("enable")) $enable = "on"; else $enable = "";
					if($require = _formdata("require")) $require = "on"; else $require = "";

					$title = _formdata("title_".$rows1->code);

					$agree_text =  addslashes( _formdata($rows1->code) );

					$query = "INSERT INTO `site_members_agree` (`enable`,`language`,`require`,`title`,`agreement`,`code`) 
										VALUES ('$enable','".$rows1->code."','$require','$title','$agree_text','$agree_code')";
						
					_sales_query($query);	//echo $query."<br>";

				}
			}


		} 

		$url = "site_members_agreement.php"."?limit=$limit&searchkey=$search";    		
		echo "<script> location.replace('$url'); </script>";
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>