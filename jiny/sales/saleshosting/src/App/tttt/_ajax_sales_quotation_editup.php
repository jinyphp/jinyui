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
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$name = _formdata("name");
		//echo "uid = $uid <br>";

		
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

		if($mode == "delete"){
			
    		$query = "DELETE FROM `sales_quotation` WHERE `Id`='$uid'";
    		_sales_query($query);
    	

		} else {

			$query = "select * from `sales_quotation` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 

				$query = "UPDATE `sales_goods` SET ";
					
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					

				$title = _formdata("title"); $query .= "`title`='$title' ,";
				$quomemo = _formdata("quomemo"); $query .= "`quomemo`='$quomemo' ,";

				$business = _formdata("business"); $query .= "`business`='$business' ,";

				$company_id = _formdata("company_id"); $query .= "`company_id`='$company_id' ,";
				$company = _formdata("company_search"); $query .= "`company`='$company' ,";


				$customer = _formdata("customer"); $query .= "`customer`='$customer' ,";
				$phone = _formdata("phone"); $query .= "`phone`='$phone' ,";
				$email = _formdata("email"); $query .= "`email`='$email' ,";

				$currency = _formdata("currency"); $query .= "`currency`='$currency' ,";
				$tax = _formdata("tax"); $query .= "`tax`='$tax' ,";


				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query;
				_sales_query($query);

				$_SESSION['quotation_data'] = NULL;

			} else {
				// 삽입 
				
				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				if($enable = _formdata("enable")){
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				if($transdate = _formdata("transdate")){
					$insert_filed .= "`transdate`,";
					$insert_value .= "'$transdate',";
				}

				if($company = _formdata("company_search")){
					$insert_filed .= "`company`,";
					$insert_value .= "'$company',";
				}

				if($company_id = _formdata("company_id")){
						$insert_filed .= "`company_id`,";
						$insert_value .= "'$company_id',";
				}

				if($business = _formdata("business")){
					$insert_filed .= "`business`,";
					$insert_value .= "'$business',";
				}


				if($title = _formdata("title")){
					$insert_filed .= "`title`,";
					$insert_value .= "'$title',";
				}

				if($customer = _formdata("customer")){
					$insert_filed .= "`customer`,";
					$insert_value .= "'$customer',";
				}

				if($phone = _formdata("phone")){
					$insert_filed .= "`phone`,";
					$insert_value .= "'$phone',";
				}

				if($email = _formdata("email")){
					$insert_filed .= "`email`,";
					$insert_value .= "'$email',";
				}

				if($tax = _formdata("tax")){
					$insert_filed .= "`tax`,";
					$insert_value .= "'$tax',";
				}

				if($currency = _formdata("currency")){
					$insert_filed .= "`currency`,";
					$insert_value .= "'$currency',";
				}

				if($quomemo = _formdata("quomemo")){
					$insert_filed .= "`quomemo`,";
					$insert_value .= "'$quomemo',";
				}

				$insert_filed .= "`quotation`,";		$insert_value .= "'".$_SESSION['quotation_data']."',";	

				$query = "INSERT INTO `sales_quotation` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);
				//echo $query;
				$_SESSION['quotation_data'] = NULL;
				
			}	

			

		}

		
		$ajaxkey = _formdata("ajaxkey");
		$url = "/ajax_sales_quotation.php";
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
		

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>