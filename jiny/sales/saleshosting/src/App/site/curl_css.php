<?
	// ============== 
	// CURL Pages 처리
	// 2016.03.25

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

				$menu_code = _formdata("menu_code");

				if($mode == "save"){
					// DB에 있는 메뉴 구조를 파일로 케싱 저장함.

					$query = "select * from `site_css` ";
					if($rowss = _mysqli_query_rowss($query)){
						for($i=0;$i<count($rowss);$i++){
						$rows = $rowss[$i];

						$css_file .= $rows->code." {
							".$rows->css."
						}; \n";
						}

					}	

					echo $css_file;
					

					//생성한 CSS를 케싱 저장합니다.
					// if(!is_dir("./".$menu_code)) mkdir("./".$menu_code);

					echo "css save <br>";
					_file_save("site.css", $css_file);

				

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