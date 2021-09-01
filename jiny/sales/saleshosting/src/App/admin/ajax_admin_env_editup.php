<?php

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	include "./func/skin.php";
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";


	if(isset($_SESSION['language'])){
		$site_language = $_SESSION['language'];
	} else {
		$site_language = "ko";
	}

	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}

	if(isset($_COOKIE['cookie_email'])){
		$cookie_email = $_COOKIE['cookie_email'];
	} else {
		$cookie_email = "";
	}



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		// include "./sales.php";

    	function _form_uploadfile($formname,$filename){
    		if($_FILES[$formname]['tmp_name']){
    			// 파일 확장자 검사
    			
    			$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    			else {
    				if($filename == ""){
    					// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {
    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}


		$mode = _formmode();
		echo "mode is $mode <br>";
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		if($mode=="edit"){

			$query = "select * from `site_env` WHERE Id =$uid";
			if($rows = _mysqli_query_rows($query)){
				// 수정모드
				$query = "UPDATE `site_env` SET ";
				if($code = _formdata("code")) $query .= "`code`='$code' ,";
				if($type = _formdata("type")) $query .= "`type`='$type' ,";
				if($process = _formdata("process")) $query .= "`process`='$process' ,";
				if($domain = _formdata("domain")) $query .= "`domain`='$domain' ,";
			
				if($language = _formdata("language")) $query .= "`language`='$language' ,";
				if($country = _formdata("country")) $query .= "`country`='$country' ,";
				if($adult_check = _formdata("adult_check")) $query .= "`adult_check`='$adult_check' ,";

				if($members_prices = _formdata("members_prices")) $query .= "`members_prices`='$members_prices' ,";
				if($members_auth = _formdata("members_auth")) $query .= "`members_auth`='$v' ,";
				if($members_point = _formdata("members_point")) $query .= "`members_point`='$members_point' ,";
				if($members_point = _formdata("members_point")) $query .= "`members_point`='$members_point' ,";

				$mydir="./logo"; _mkdir($mydir);
				// $filename = $mydir."/logo-".$sales_db->Id;
				if($files = _form_uploadfile("userfile1","./logo/admin-$uid")) $query .= "`logo`='"."./logo/admin-$uid.".$files[ext]."' ,";

				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				// echo $query;
				_mysqli_query($query);

			}

			echo "사이트 정보가 갱신되었습니다.";	


		} else if($mode=="new"){
				// 신규모드
				$insert_filed = "";
				$insert_value = "";
				
				if($code = _formdata("code")) {
					$insert_filed .= "`code`,";
					$insert_value .= "'$code',";
				}

				if($type = _formdata("type")) {
					$insert_filed .= "`type`,";
					$insert_value .= "'$type',";
				}

				if($process = _formdata("process")) {
					$insert_filed .= "`process`,";
					$insert_value .= "'$process',";
				}

				if($domain = _formdata("domain")) {
					$insert_filed .= "`domain`,";
					$insert_value .= "'$domain',";
				}

				if($language = _formdata("language")) {
					$insert_filed .= "`language`,";
					$insert_value .= "'$language',";
				}

				if($country = _formdata("country")) {
					$insert_filed .= "`country`,";
					$insert_value .= "'$country',";
				}

				if($adult_check = _formdata("adult_check")) {
					$insert_filed .= "`adult_check`,";
					$insert_value .= "'$adult_check',";
				}

				if($members_prices = _formdata("members_prices")) {
					$insert_filed .= "`members_prices`,";
					$insert_value .= "'$members_prices',";
				}

				if($members_auth = _formdata("members_auth")) {
					$insert_filed .= "`members_auth`,";
					$insert_value .= "'$members_auth',";
				}

				if($members_point = _formdata("members_point")) {
					$insert_filed .= "`members_point`,";
					$insert_value .= "'$members_point',";
				}

				if($members_emoney = _formdata("members_emoney")) {
					$insert_filed .= "`members_emoney`,";
					$insert_value .= "'$members_emoney',";
				}

				
				echo "사이트 정보가 추가되었습니다.";

			
			$query1 = "select * from `site_env` WHERE domain = '".$domain."'";
			echo $query1;
			$rows = _mysqli_query_rows($query1);
			if($rows){
				echo "$domain 중복된 도메인 입니다.";
			} else {
				$mydir="./logo"; _mkdir($mydir);
				// $filename = $mydir."/logo-".$sales_db->Id;

				$query = "INSERT INTO `site_env` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_mysqli_query($query);

				$query1 = "select * from `site_env` WHERE domain = '".$domain."'";
				$rows = _sales_query_rows($query1);

				if($files = _form_uploadfile("userfile1","./logo/admin-".$rows->Id)){
					$insert_filed .= "`logo`,";
					$insert_value .= "'./logo/"."admin-".$rows->Id.".".$files[ext]."',";
				}

				// 로고 파일명 기준
				// logo - membersid - siteid
				$query = "UPDATE `site_env` SET `logo` = './logo/admin-".$rows->Id.".".$files[ext]."' WHERE Id =$uid";
				_mysqli_query($query);

				// echo $query;
				echo "사이트 정보가 추가되었습니다.";
			}

		/*
			if($rows = _sales_query_rows($query1)){

				
			} else {
				
				

			}*/

		} else if($mode == "delete"){
			$query = "DELETE FROM `site_env` WHERE `Id`='$uid'";
				// echo $query."<br>";
			_mysqli_query($query);

			echo "사이트 정보 삭제";
		}




		echo "<script>
				$.ajax({
            		url:'/ajax_admin_env.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#site_list').html(data);
            		}
        		});
    			</script>";



	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>