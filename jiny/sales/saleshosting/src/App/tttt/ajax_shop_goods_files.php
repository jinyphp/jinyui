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
	include "./func/orders.php";
	include "./func/butten.php";

	include "./func/css.php";
	include "./func/curl.php";

	/////////////

    function _form_uploadfile($formname,$filename){
    	if($_FILES[$formname]['tmp_name']){
    		// 파일 확장자 검사
    			
    		$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    		if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    		else {
    			if($filename == ""){
    				// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    				if(_is_file($_FILES[$formname]['name'])) _file_delete($_FILES[$formname]['name']);
    				move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    			} else {
    				// 기존파일 삭제 
    				if(_is_file($filename.".".$ext)) _file_delete($filename.".".$ext);    					
    				move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    			}
    			$files['filename'] = $filename;
    			$files['name'] = $_FILES[$formname]['name'];
    			$files['ext'] = $ext;
    			return $files;
    		}  
			
    	} else return NULL;
	}

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

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

			//echo "filename = ".$_FILES['userfile9']['name']."<br>";
			if($files = _form_uploadfile("userfile","./upload/".$_FILES['userfile']['name'])) {
				$file = "./upload/".$_FILES['userfile']['name'].".".$files[ext];
				//echo 
				echo "curl upload : "."http://".$sales_db->domain."/curl_upload.php";
				// echo _curl_filecopy("http://".$sales_db->domain."/curl_upload.php",".".$dir,$file);
				
				
				echo _curl_upload("upload","http://".$sales_db->domain."/curl_file.php",".".$dir,$file);

				// 임시 업로드 파일 삭제
				_file_delete($file);
			}	
			
			$query = "INSERT INTO `shop_goods_files` (`gid`,`files`) VALUES ('$gid','.".$dir."/".$_FILES['userfile']['name'].".".$files[ext]."')";
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
				$list .= "<td>&lt;img src=&#39;".$rows->files."&#39; border=&#39;0&#39;&gt;</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
								<a href='#' onclick=\"javascript:image_remove('remove','$gid','".$rows->Id."')\">제거</a></td>";
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
		$body = _skin_page($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>