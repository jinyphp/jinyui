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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");


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
    	
    	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.class.php");
		$goods = new goods;
		
		if($mode == "upload"){

			// $goods = _shop_goods_rows($gid);
			if($goods_rows = _mysqli_query_rows($goods->byrows($gid))){
				$path = substr($goods_rows->regdate,0,10);
				$path = explode("-",$path);

				$YEAR = $path[0];
				$MONTH = $path[1];
				$DAY = $path[2];
			} else {
				$YEAR = date("Y",time());
    			$MONTH = date("m",time());
    			$DAY = date("d",time());
			}

			if($uploadfile = $_FILES['userfile']['name']){
				$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   				if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
   					echo "스크리트 및 실행파일은 등록할 수 업습니다.";
   				} else {
   					$img_path = "/goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$gid."/".$uploadfile;
   					//echo "temp_name = ".$_FILES['userfile']['tmp_name']."<br>";
   					//echo "path ".$img_path."<br>";
   					move_uploaded_file($_FILES['userfile']['tmp_name'], ".".$img_path);

   				}

   				$query = "INSERT INTO shop_goods_files (`gid`,`files`) VALUES ('$gid','$img_path')";
				$query = str_replace(",)",")",$query);
				//echo $query."<br>";
				_mysqli_query($query);
			}
			

		} else if($mode == "remove"){
			$query = "select * from shop_goods_files WHERE `Id`='$images' and `gid` = '$gid'";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){

				$query1 = "DELETE FROM shop_goods_files WHERE `Id`='$images' and `gid` = '$gid'";
				//echo $query1."<br>";
				_mysqli_query($query1);
				
				//echo ".".$rows->files."<br>";
				_file_delete(".".$rows->files);
			}

		}


    	$query = "select * from shop_goods_files where gid = '$gid'"; 
		if($rowss = _mysqli_query_rowss($query)){

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
				$list .= "<tr style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'><td width='20'>$tid</td>";					
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>&lt;img src=\".".$rows->files."\" border=\"0\" style=\"max-width:100%;height:auto;\" &gt;</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
								<a href='#' onclick=\"javascript:file_remove('remove','$gid','".$rows->Id."')\">제거</a></td>";
				$list .= "</tr></table>";					
				// $list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";	
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