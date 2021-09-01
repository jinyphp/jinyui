<?php
	// CURL Cross 처리

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";

	print_r($_POST);
	print "</pr" . "e>\n";

	$mode = _formdata("mode");
	$filename = _formdata("filename");

	if($mode == "rename"){

		$oldname = _formdata("oldname");
		$newname = _formdata("newname");

		$old_dir = "./theme/".$oldname;
		$new_dir = "./theme/".$newname;
		rename ($old_dir, $new_dir);


	} else if($mode == "html"){
		//# 언어별 , 테마페이지 저장 	
		$query = "select * from `site_language`";
		echo $query."<br>";
		if($rowss = _mysqli_query_rowss($query)){
			/*
			echo "regdate = ".$goods->regdate."<br>";
			$path = substr($goods->regdate,0,10);
			echo "path == ".$path."<br>";
			$path = explode("-",$path);

			echo "./goods/Y".$path[0]."/M".$path[1]."/D".$path[2];
			_is_path("./goods/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$uid);
			*/
		
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				// pc용 테마 저장
				$query1 = "select * from `shop_themefiles_html` WHERE `filename`='$filename' and `language`='".$rows->code."' and mobile='pc'";
				echo $query1."<br>";			
				if($goods_rows = _mysqli_query_rows($query1)){
					$html = stripslashes($goods_rows->html);
					_is_path("./theme/".$rows->theme); // 저장 디렉토리 확인 및 디렉토리 생성 
					_file_save("./theme/".$rows->theme."/$filename.".$rows->code.".htm",$html);
				}

				// 모바일용 테마 저장
				$query1 = "select * from `shop_themefiles_html` WHERE `filename`='$filename' and `language`='".$rows->code."' and mobile='m'";
				echo $query1."<br>";			
				if($goods_rows = _mysqli_query_rows($query1)){
					$html = stripslashes($goods_rows->html);
					_is_path("./theme/".$rows->theme); // 저장 디렉토리 확인 및 디렉토리 생성 
					_file_save("./theme/".$rows->theme."/$filename.".$rows->code.".m.htm",$html);
				}


			}
		}
	}
	



				

				

					

	
?>