<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	// update : 2016.01.25 = 수정편집 

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");	// Sales 사용자 DB 접근.

		// $cookie_email = _cookie_email();
		// $members = _members_rows($cookie_email);

		$mode = _formmode();	echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		
		if($uid && $mode == "edit"){
			
			$query = "select * from `site_pages` WHERE `Id`='".$uid."'";
			//echo $query."<br>";
			if($pages_rows = _sales_query_rows($query)){	

				$code = _formdata("code");
				if($pages_rows->code != $code){
					// 코드를 수정한 경우
					// 증복여부 체크
					$query = "select * from `site_pages` WHERE `code`='".$code."'";
					if($rows = _sales_query_rows($query)){	
						$duplicate = false;
						echo "중복된 코드로 수정이 불가능 합니다.";
					} else $duplicate = true;

				} else $duplicate = true;

				if($duplicate){
					// 모드값 변경
					$_POST['mode'] = "edit";
					$_POST['uid'] = "$uid";

					// CUTL POST 처리
					$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
					//echo "CURL : "."http://".$sales_db->domain."/pages/curl_pages.php";
					//echo 
					$curl_return = _curl_post("http://".$sales_db->domain."/pages/curl_pages.php",$_POST);
					echo $curl_return;
				}							
				
			} 
			

			$url = "site_pages.php?limit=$limit&searchkey=$search";    		
			// echo "<script> location.replace('$url'); </script>";	
			

		} else if($mode == "new"){
			$code = _formdata("code");
			$query = "select * from `site_pages` WHERE `code`='".$code."'";
			//echo $query."<br>";
			if($pages_rows = _sales_query_rows($query)){	
				echo "중복된 코드 입니다.";

			} else {
				// 모드값 변경
				$_POST['mode'] = "new";

				// CUTL POST 처리
				$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
				//echo "CURL : "."http://".$sales_db->domain."/pages/curl_pages.php";
				//echo 
				_curl_post("http://".$sales_db->domain."/pages/curl_pages.php",$_POST);			

				$url = "site_pages.php?limit=$limit&searchkey=$search";    		
				echo "<script> location.replace('$url'); </script>";	
			}
					

		} else if($mode == "delete"){
			// 모드값 변경
			$_POST['mode'] = "check_delete";

			// 선택한 항목을 스트링 처리함
			$_POST['uid'] = $uid.";";

			// CUTL POST 처리
			$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
			//echo "CURL : "."http://".$sales_db->domain."/pages/curl_pages.php";
			//echo 
			_curl_post("http://".$sales_db->domain."/pages/curl_pages.php",$_POST);

			// 목록 페이지로 이동
			$url = "site_pages.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "check_delete"){

			// 선택한값 모두 삭제			
			if($TID = $_POST['TID']){
				for($i=0,$_POST['uid']="";$i<count($TID);$i++){

					// 선택한 항목을 스트링 처리함
					$_POST['uid'] .= $TID[$i].";";


					// CUTL POST 처리
					$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
					//echo "CURL : "."http://".$sales_db->domain."/pages/curl_pages.php";
					//echo 
					_curl_post("http://".$sales_db->domain."/pages/curl_pages.php",$_POST);

				}
			}

			// 리스트 #mainbody 갱신
			echo "<script>
				$.ajax({
            		url:'ajax_site_pages.php?ajaxkey=$ajaxkey&limit=$limit&searchkey=$search',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
    		</script>";

		}

		
		

		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}


	
?>