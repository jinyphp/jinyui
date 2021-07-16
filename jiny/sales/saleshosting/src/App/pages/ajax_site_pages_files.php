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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");


	//echo "files...";
	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

    	$mode = _formmode();
    	$code = _formdata("code");
		$img = _formdata("img");
    	//echo "mode = $mode / code = $code / images = $images <br>";
    	///////////////////////////////////////
		//# 선택 전표 삭제
		

		if($mode == "upload"){
			// 페이지 이미지등록
			// echo "이미지를 등록합니다.";

			$uploadfile = $_FILES['userfile']['name'];
   			$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   				echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   			} else {

   				$file_name_with_full_path = $_FILES['userfile']['tmp_name'];

   				$post = array('mode'=>"upload",
							'adminkey'=>$sales_db->adminkey, 
							'code'=>$code, 
							'filename'=>$_FILES['userfile']['name'], 
							'file_contents'=>'@'.$file_name_with_full_path);
   				// print_r($post);

   				// echo 
   				_curl_post("http://".$sales_db->domain."/pages/curl_pages.php",$post);

   			}

		} else if($mode == "remove"){
			// 이미지 삭제
			// echo "이미지 삭제 <br>";

			$post = array('mode'=>"remove",
							'adminkey'=>$sales_db->adminkey, 
							'code'=>$code, 
							'img'=>$img);
   			// print_r($post);

   			// echo 
   			_curl_post("http://".$sales_db->domain."/pages/curl_pages.php",$post);

		}


    	$query = "select * from site_pages_files where code = '$code'"; 
    	// echo $query;
		if($rowss = _sales_query_rowss($query)){

			$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			$list .= "<tr><td style='font-size:12px;padding:10px;' width='20'>$tid</td>";
			$list .= "<td style='font-size:12px;padding:10px;' width='200'>파일명</td>";				
			$list .= "<td style='font-size:12px;padding:10px;'>html 이미지 테크</td>";
			$list .= "<td style='font-size:12px;padding:10px;' width='100'></td>";
			$list .= "</tr></table>";					
			

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
				$list .= "<tr><td style='font-size:12px;padding:10px;' width='20'>$tid</td>";
				$list .= "<td style='font-size:12px;padding:10px;' width='200'>".$rows->files."</td>";				
				$list .= "<td style='font-size:12px;padding:10px;'>&lt;img src=\"/pages/".$rows->code."/".$rows->files."\" border=\"0\" style=\"max-width:100%;height:auto;\" &gt;</td>";
				$list .= "<td style='font-size:12px;padding:10px;' width='100'> 
								<a href='#' onclick=\"javascript:file_remove('remove','".$rows->Id."')\">제거</a></td>";
				$list .= "</tr></table>";					
					
			}
			echo $list;
		} else {
			$msg = "첨부된 이미지 파일이 없습니다.";
			echo $msg;
		}

	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		echo "오류! 처리KEY 값이 일치하지 않습니다.";
	}

	

	
?>