<?
	// ============== 
	// CURL Company 처리
	// 2016.04.03

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/conf/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");

	echo "<br>SALESHosting API<br>";

	if($adminkey = _formdata("adminkey")){
		$query = "select * from `site_env`";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
			if($rows->adminkey == $adminkey){

				// ====== CURL 접속 체크 성공 ======
				$mode = _formdata("mode");
				echo "curl mode: $mode<br>";

				$code = _formdata("code");
				if($mode == "edit"){
					
				} else if($mode == "new"){


				} else if($mode == "upload"){
					// 페이지 코드 디렉토리 생성
					$code = _formdata("code");

					$YEAR = date("Y",time());
    				$MONTH = date("m",time());
    				$DAY = date("d",time());

					// if(!is_dir("./".$code)) mkdir("./".$code);
					$dir = "../goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$code;
					if(!is_dir("../goods")) mkdir("../goods");
					if(!is_dir("../goods/Y".$YEAR)) mkdir("../goods/Y".$YEAR);
					if(!is_dir("../goods/Y".$YEAR."/M".$MONTH)) mkdir("../goods/Y".$YEAR."/M".$MONTH);
					if(!is_dir("../goods/Y".$YEAR."/M".$MONTH."/D".$DAY)) mkdir("../goods/Y".$YEAR."/M".$MONTH."/D".$DAY);
					if(!is_dir("../goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/goods_".$code)) mkdir("../goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/g".$code);

					// _is_path($dir);

					$filename = _formdata("filename");
					$uploaddir = realpath('./') . '/';
					// $uploadfile = $uploaddir."$code/". basename($filename);
					$uploadfile = $dir."/".basename($filename);
					echo $uploadfile."<br>";

					if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	    				echo "파일 업로드 성공.\n";
					} else {
	    				echo "업로드 실패!\n";
					}

					//$query = "INSERT INTO `site_pages_files` (`code`,`files`) VALUES ('$code','$filename')";
					//echo $query."<br>";
					//_mysqli_query($query);						

				} else if($mode == "delete"){

					$query = "DELETE FROM service.business WHERE `code`='$code'";
    				_mysqli_query($query);

				}				

				// =============================

			} else {
				echo "비정상 접속! adminkey 값이 일치하지 않습니다. 해당 접속IP를 차단합니다. 해제방법은 관리자에게 문의 바랍니다. <br>";
			}

		} else {
			echo "site_env 환경 설정값을 읽어올수 없습니다. <br>";
		}
	} else {
		echo "adminkey 값이 없습니다. <br>";
	}


	
?>