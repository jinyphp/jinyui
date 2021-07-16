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

	

		$mode = _formmode();
		echo "mode = $mode <br>";
		$uid = _formdata("uid");
		echo "uid = $uid <br>";
		

		
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


		
		if($mode == "delete"){
			$query = "select * from `site_members_black` where Id='$uid'";
			echo $query."<br>";
			if($rows = _sales_query_rows($query)){
				$query = "DELETE FROM `site_members_black` WHERE Id='".$uid."'";
    			_sales_query($query);
		    	//echo $query."<br>";
    		}
		} else {

			if($enable = _formdata("enable")) $enable = "on"; else $enable = "";	
			$black_email = _formdata("email");
			$black_description = _formdata("description");


			$query = "select * from `site_members_black` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				$query = "UPDATE `site_members_black` SET  `enable`='$enable' , `email`='$black_email' , `description` = '$black_description' where Id='".$uid."'";
				_sales_query($query);
			} else {
				$query = "INSERT INTO `site_members_black` (`regdate`,`enable`,`email`,`description`) 
										VALUES ('$TODAYTIME','$enable','".$black_email."','".$black_description."')";
				_sales_query($query);
			}

		}

			echo "<script>
				$.ajax({
            		url:'/ajax_site_members_blacklist.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#site_list').html(data);
            		}
        		});
    			</script>";

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>