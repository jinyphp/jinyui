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



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$javascript = "<script>
    	</script>"; 

    	$mode = _formmode();
    	$gid = _formdata("gid");
		$images = _formdata("images");
    	//echo "mode = $mode / gid = $gid / images = $images <br>";
    	///////////////////////////////////////
		//# 선택 전표 삭제
		
		if($mode == "upload"){

			$goods = _shop_goods_rows($gid);
			$path = substr($goods->regdate,0,10);
			$path = explode("-",$path);
			$dir = "/goods/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$goods->Id;
			_is_path(".".$dir);
			_is_path("./upload");

			//echo "filename = ".$_FILES['userfile9']['name']."<br>";
			if($files = _html_form_uploadfile("userfile","./upload/".$_FILES['userfile']['name'])) {
				$file = "./upload/".$_FILES['userfile']['name'].".".$files[ext];
				
				echo _curl_upload("upload","http://".$sales_db->domain."/curl_file.php",".".$dir,$file);

				// 임시 업로드 파일 삭제
				_file_delete($file);
			}	
			
			$query = "INSERT INTO `shop_goods_files` (`gid`,`files`) VALUES ('$gid','".$dir."/".$_FILES['userfile']['name'].".".$files[ext]."')";
			$query = str_replace(",)",")",$query);
			//echo $query."<br>";
			_sales_query($query);

		} else if($mode == "remove"){
			$query = "select * from shop_goods_files WHERE `Id`='$images' and `gid` = '$gid'";
			if($rows = _sales_query_rows($query)){
				$query1 = "DELETE FROM `shop_goods_files` WHERE `Id`='$images' and `gid` = '$gid'";
				_sales_query($query1);
				//echo "remove : $query1";

				echo _curl_post("http://".$sales_db->domain."/curl_file.php","mode=remove&file=".$rows->files);
			}

		}


    	$query = "select * from shop_goods_files where gid = '$gid'"; 
		if($rowss = _sales_query_rowss($query)){

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
				$list .= "<tr><td width='20'>$tid</td>";					
				$list .= "<td>&lt;img src=\"".$rows->files."\" border=\"0\" style=\"max-width:100%;height:auto;\" &gt;</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
								<a href='#' onclick=\"javascript:file_remove('remove','$gid','".$rows->Id."')\">제거</a></td>";
				$list .= "</tr></table>";					
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";	
			}
			//$body = str_replace("{relations}", $list, $body);
			echo $list;
		} else {
			$msg = "이미지파일이 없습니다.";
			// $body = str_replace("{relations}", $msg, $body);
			echo $msg;
		}
		
		
		// echo $body;
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		echo "Error! can't display files ...";
	}

	
?>