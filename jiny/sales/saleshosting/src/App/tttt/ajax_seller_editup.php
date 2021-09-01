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
	include "./func/members.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		
		function _ajax_pagecall_script($url,$ajaxkey){
			
			echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
    			</script>";
    		
    	}		

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


		$query = "select * from `shop_seller` WHERE `email`='$seller_email'";
		if($rows = _mysqli_query_rows($query)){
			// echo "이미 가입요청한 셀러 이메일 입니다.";
			$body = _skin_body($skin_name,"seller_duplicate");
			echo $body;
		} else {

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($seller = _formdata("seller")){
				$insert_filed .= "`seller`,";
				$insert_value .= "'$seller',";
			}

			if($seller_email = _formdata("seller_email")){
				$insert_filed .= "`email`,";
				$insert_value .= "'$seller_email',";
			}

			if($seller_password = _formdata("seller_password")){
				$insert_filed .= "`password`,";
				$insert_value .= "'$seller_password',";
			}

			if($seller_site = _formdata("seller_site")){
				$insert_filed .= "`site`,";
				$insert_value .= "'$seller_site',";
			}

			if($seller_title = _formdata("seller_title")){
				$insert_filed .= "`title`,";
				$insert_value .= "'$seller_title',";
			}

			if($seller_phone = _formdata("seller_phone")){
				$insert_filed .= "`phone`,";
				$insert_value .= "'$seller_phone',";
			}

			if($seller_post = _formdata("seller_post")){
				$insert_filed .= "`post`,";
				$insert_value .= "'$seller_post',";
			}

			if($seller_address = _formdata("seller_address")){
				$insert_filed .= "`address`,";
				$insert_value .= "'$seller_address',";
			}

			if($seller_manager = _formdata("seller_manager")){
				$insert_filed .= "`manager`,";
				$insert_value .= "'$seller_manager',";
			}

			if($seller_comment = _formdata("seller_comment")){
				$insert_filed .= "`comment`,";
				$comment = addslashes($seller_comment);
				$insert_value .= "'$comment',";
			}

			$query = "INSERT INTO `shop_seller` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_mysqli_query($query);

			// echo "가입신청 요청하였습니다.";
			$body = _skin_body($skin_name,"seller_success");
			echo $body;
		}	


		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>