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

	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		//include "./sales.php";



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

		//$skin_name = "default";
		//$body = _skin_page("default","shop_cate_edit");

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";

		function _language_enable($uid){
			$query = "UPDATE `site_language` SET `enable` = '' WHERE `Id` like '$uid'";
			_mysqli_query($query);

			$msg = "언어 비활성";
			echo $msg;
		}

		function _language_disable($uid){
			$query = "UPDATE `site_language` SET `enable` = 'on' WHERE `Id` like '$uid'";
			_mysqli_query($query);

			$msg = "언어 활성";
			echo $msg;
		}

		

		function _language_delete($uid){
			$query = "DELETE FROM `site_language` WHERE `Id`='$uid'";
			_mysqli_query($query);

			$msg = "언어삭제";
    		echo $msg;	
		}

		

		switch($mode){
			case 'disable':
				_language_enable($uid);
				break;
			case 'enable':
				_language_disable($uid);
				break;
		case 'delete':		
				_language_delete($uid);
				break;
		}	
			


		if($mode == "edit"){
			
			// 언어별 json 처리
    		$query = "select * from `site_language` ";	
			if( $rowss = _mysqli_query_rowss($query) ){ 
				$title = "{";
				$flag = false;
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					$name = _formdata($rows->code);
					if(isset($name) && $name != "") $flag = true;
					$title .= "\"".$rows->code."\":\"".$name."\"";
					if($i<(count($rowss)-1)) $title .= ",";
				}
					$title .= "}"; 
			}

			if($flag == false ){
				//echo $title;
				echo "이름이 없습니다.";
			} else {
				$title = addslashes($title);
				// $name = _formdata($site_language);
				$code = _formdata("code");
				$replace_code = _formdata("replace_code");
				$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

				$query = "UPDATE `site_language` SET  `name`='$title', `code`='$code', `replace_code`='$replace_code', `enable`='$enable' WHERE `Id`='$uid'";
    			// echo $query."<br>";
    			_mysqli_query($query);

    			$msg = "수정완료";
    			echo $msg;
			}

		} else if($mode == "new"){

			// 언어별 json 처리
			$query = "select * from `site_language` ";	
			if( $rowss = _mysqli_query_rowss($query) ){ 
				$title = "{";
				$flag = false;
				for($i=0;$i<count($rowss);$i++){
					$rows=$rowss[$i];				
					$name = _formdata($rows->code);
					if(isset($name) && $name != "") $flag = true;
					$title .= "\"".$rows->code."\":\"".$name."\"";
					if($i<(count($rowss)-1)) $title .= ",";
				}
					$title .= "}"; 
			}

			if($flag == false ){
				//echo $title;
				echo "이름이 없습니다.";
			} else {
				$title = addslashes($title);
				
				$code = _formdata("code");
				$replace_code = _formdata("replace_code");
				$enable = _formdata("enable"); if($enable) $enable = "on"; else $enable = "";

    			$query = "INSERT INTO `site_language` (`name`, `code`, `replace_code`, `enable`) 
    									VALUES ('$title', '$code', '$replace_code', '$enable')";					
    			_mysqli_query($query);

    			$msg = "신규등록";
    			echo $msg;
			}


		} 

		echo "<script>
				$.ajax({
            		url:'/ajax_admin_language.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#language_list').html(data);
            		}
        		});
    			</script>";

		
	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
		/*
		$skin_name = "default";
		$body = _skin_page($skin_name,"error"); // 스킨 읽어오기

    	$body = str_replace("{error_message}",$error_message,$body);
    	echo $body;
    	*/

	}




	
?>