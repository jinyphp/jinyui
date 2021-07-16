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
				if($mode == "syncNewRe"){
					// businesss 정보로 company 연결
					// ajax_sales_company_editup.php 에서 호출되는 기능
					$company = _formdata("link_company");
					$email = _formdata("link_email");
					$code = _formdata("code");

					$query = "select * from sales_company where company = '$company' and email = '$email' "; 
    				echo $query."<br>";
    				if($rows= _mysqli_query_rows($query)){
    					$query = "UPDATE sales_company SET `link`='$code', `link_auth`='$code', `link_times`='$TODAYTIME' WHERE company = '$company' and email = '$email'";
						echo $query."<br>";
						_mysqli_query($query);
    				}
					
				} else if($mode == "new"){
					

				} else if($mode == "delete"){

					//$query = "DELETE FROM service.business WHERE `code`='$code'";
    				//_mysqli_query($query);

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