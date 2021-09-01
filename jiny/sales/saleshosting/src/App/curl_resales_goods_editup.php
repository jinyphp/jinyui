<?php
	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

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










































		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		$limit = _formdata("limit");
		

		
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


		

		// 목록 페이지 복귀.
		//echo "/ajax_shop_goods.php?limit=".$limit."&ajaxkey=".$ajaxkey."&search=".$search;
		
		$searchkey = _formdata("searchkey");
		// $search = iconv('UTF-8','CP949',$search);

	
		
		echo "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		<form id='data' name='good' method='post' enctype='multipart/form-data'> 
		<input type='hidden' name='searchkey' value='$searchkey'>
		<script>
			$.ajax({
            	url:'/ajax_shop_goods.php?limit=".$limit."&ajaxkey=".$ajaxkey."',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('.mainbody').html(data);
            	}
        	});
    	</script>
		</form>
    	";
    




	
?>