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

		function _language_enable($uid){
			$query = "UPDATE `site_language` SET `enable` = '' WHERE `Id` like '$uid'";
			_sales_query($query);

			$msg = "언어 비활성";
			echo $msg;
		}

		function _language_disable($uid){
			$query = "UPDATE `site_language` SET `enable` = 'on' WHERE `Id` like '$uid'";
			_sales_query($query);

			$msg = "언어 활성";
			echo $msg;
		}

		

		function _language_delete($uid){
			$query = "DELETE FROM `site_language` WHERE `Id`='$uid'";
			_sales_query($query);

			$msg = "언어삭제";
    		echo $msg;	
		}

		

		switch($mode){
			case 'disable':
				_language_enable($uid);
				break;
			case 'enable':
				_language_disable($uid);
				break;
		case 'delete':		
				_language_delete($uid);
				break;
		}	
			


		if($mode == "edit"){
			
			// 언어별 json 처리
    		$query = "select * from `site_language` ";	
			if( $rowss = _sales_query_rowss($query) ){ 
				$title = "{";
				$flag = false;
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					$name = _formdata($rows->code);
					if(isset($name) && $name != "") $flag = true;
					$title .= "\"".$rows->code."\":\"".$name."\"";
					if($i<(count($rowss)-1)) $title .= ",";
				}
					$title .= "}"; 
			}

			if($flag == false ){
				//echo $title;
				echo "이름이 없습니다.";
			} else {
				$title = addslashes($title);
				// $name = _formdata($site_language);
				$code = _formdata("code");
				$replace_code = _formdata("replace_code");
				$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

				$query = "UPDATE `site_language` SET  `name`='$title', `code`='$code', `replace_code`='$replace_code', `enable`='$enable' WHERE `Id`='$uid'";
    			// echo $query."<br>";
    			_sales_query($query);

    			$msg = "수정완료";
    			echo $msg;
			}

		} else if($mode == "new"){

			// 언어별 json 처리
			$query = "select * from `site_language` ";	
			if( $rowss = _sales_query_rowss($query) ){ 
				$title = "{";
				$flag = false;
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					$name = _formdata($rows->code);
					if(isset($name) && $name != "") $flag = true;
					$title .= "\"".$rows->code."\":\"".$name."\"";
					if($i<(count($rowss)-1)) $title .= ",";
				}
					$title .= "}"; 
			}

			if($flag == false ){
				//echo $title;
				echo "이름이 없습니다.";
			} else {
				$title = addslashes($title);
				
				$code = _formdata("code");
				$replace_code = _formdata("replace_code");
				$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

    			$query = "INSERT INTO `site_language` (`name`, `code`, `replace_code`, `enable`) 
    									VALUES ('$title', '$code', '$replace_code', '$enable')";					
    			_sales_query($query);

    			$msg = "신규등록";
    			echo $msg;
			}


		} 

		$url = "site_language.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";

		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}




	
?>