<?

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
		//include "./sales.php";

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
		echo "uid is $uid <br>";
		$ajaxkey = _formdata("ajaxkey");

		$eid = _formdata("eid");
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _mysqli_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);


		if($mode == "delete"){
			$query = "DELETE FROM `site_index_title` WHERE `Id`='$uid'";
			echo $query."<br>";
			_mysqli_query($query);
			echo "이미지 삭제";
		} else {

			$enable = _formdata("enable");
			$code = _formdata("code");
			$pos = _formdata("pos");
			$url = _formdata("url");
			$alt = _formdata("alt");

			$query = "select * from `site_index_title` WHERE Id =$uid";
			if($rows = _mysqli_query_rows($query)){
				// 수정모드
				$mydir="./users"; _mkdir($mydir);
				$mydir .= "/".$sales_db->Id; _mkdir($mydir);
				$mydir .= "/images"; _mkdir($mydir);
				$files = _form_uploadfile("userfile1","$mydir/index_title-".$sales_db->Id."-$uid");

				$query = "UPDATE `site_index_title` SET ";
				$query .= "`enable`='$enable',`code`='$code',`pos`='$pos',`url`='$url',`alt`='$alt',`domain`='".$site_env_rows->domain."',`host_id`='".$sales_db->Id."'";
				if($files) {
					$query .= ",`images`='/images/"."index_title-".$sales_db->Id."-$uid.".$files[ext]."'";
				}
				$query .= " WHERE Id =$uid";
				echo $query."<br>";
				_mysqli_query($query);
				echo "사이트 정보가 갱신되었습니다.";	
			} else {
				// 신규모드
				
				$query = "select * from `site_index_title` order by Id desc";
				if($rows = _mysqli_query_rows($query)) $max_id = $rows->Id + 1;

				$mydir="./users"; _mkdir($mydir);
				$mydir .= "/".$sales_db->Id; _mkdir($mydir);
				$mydir .= "/images"; _mkdir($mydir);
				$files = _form_uploadfile("userfile1","$mydir/index_title-".$sales_db->Id."-$max_id");

				$query = "INSERT INTO `site_index_title` (`enable`,`code`,`pos`,`url`,`alt`,`domain`,`host_id`,`images`) 
							VALUES ('$enable','$code','$pos','$url','$alt','".$site_env_rows->domain."','".$sales_db->Id."','/images/"."index_title-".$sales_db->Id."-$max_id.".$files[ext]."')";
				echo $query."<br>";
				_mysqli_query($query);
				echo "이미지 정보가 추가되었습니다.";

			}

		}

		/*
		echo "<script>
				$.ajax({
            		url:'/ajax_site_index.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#site_list').html(data);
            		}
        		});
    			</script>";
		*/

    		

	} else {
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>