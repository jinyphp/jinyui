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
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$email = _formdata("email");
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




		if($mode == "enable"){
			$query = "UPDATE `sales_business` SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE `sales_business` SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "delete"){
			
			$query = "DELETE FROM `sales_business` WHERE `Id`='$uid'";
    		_sales_query($query);
		
		} else if($mode == "edit"){
	
			$query = "select * from `sales_business` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				
				$query = "UPDATE `sales_business` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
				//if($auth = _formdata("auth")) $query .= "`auth`='on' ,"; else $query .= "`auth`='' ,";
				$business_country = _formdata("business_country"); $query .= "`country`='$business_country' ,";

				$currency = $_POST['currency'];	$query .= "`currency`='$currency' ,";
				$limitation = $_POST['limitation'];	$query .= "`limitation`='$limitation' ,";

   	 			//$inout = $_POST['inout'];	$query .= "`inout`='$inout' ,";
    			$business = $_POST['business'];	$query .= "`business`='$business' ,";
    			$biznumber = $_POST['biznumber']; $biznumber = str_replace("-","",$biznumber);	$query .= "`biznumber`='$biznumber' ,";
    			$president = $_POST['president']; $query .= "`president`='$president' ,";
    			$post = $_POST['post'];	$query .= "`post`='$post' ,";
    			$address = $_POST['address']; $query .= "`address`='$address' ,";
    			$subject = $_POST['subject']; $query .= "`subject`='$subject' ,";
    			$item = $_POST['item'];	$query .= "`item`='$item' ,";
    			$email = $_POST['email'];	$query .= "`email`='$email' ,";
    			//$password = $_POST['password'];	$query .= "`password`='$password' ,";
    			
    					
    			$tel = $_POST['tel']; $query .= "`tel`='$tel' ,";
    			$fax = $_POST['fax']; $fax = str_replace("-","",$fax);	$query .= "`fax`='$fax' ,";
    			$phone = $_POST['phone']; $phone = str_replace("-","",$phone);	$query .= "`phone`='$phone' ,";

    			$group = $_POST['group']; $query .= "`group`='$group' ,";
    			$manager = $_POST['manager']; $query .= "`manager`='$manager' ,";
    					
    			//$discount = $_POST['discount'];$query .= "`discount`='$discount' ,";
    			if($_POST['vat']) $vat = "checked"; else $vat ="";  $query .= "`vat`='$vat' ,";
    			$vatrate = $_POST['vatrate'];	$query .= "`vatrate`='$vatrate' ,";
    
    			//$balance_sell = $_POST['balance_sell'];	$query .= "`balance_sell`='$balance_sell' ,";
				//$balance_buy = $_POST['balance_buy'];	$query .= "`balance_buy`='$balance_buy' ,";

				$comment = $_POST['comment'];	$query .= "`comment`='". addslashes($comment) ."' ,";

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query."<br>";
				_sales_query($query);
			}
			
		
		} else if($mode == "new"){
				// 삽입 
				
				
			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($enable = _formdata("enable")){ $insert_filed .= "`enable`,"; $insert_value .= "'on',"; }
	   		if($auth = _formdata("auth")){	$insert_filed .= "`auth`,"; $insert_value .= "'on',"; }    			
			if($country = _formdata("business_country")){	$insert_filed .= "`country`,"; $insert_value .= "'$country',"; }
			if($currency = _formdata("currency")){	$insert_filed .= "`currency`,"; $insert_value .= "'$currency',"; }
			if($limitation = _formdata("limitation")){	$insert_filed .= "`limitation`,"; $insert_value .= "'$limitation',"; }
   	 		if($inout = _formdata("inout")){	$insert_filed .= "`inout`,"; $insert_value .= "'$inout',"; }
    		if($business= _formdata("business")){	$insert_filed .= "`business`,"; $insert_value .= "'$business',"; }

    		if($biznumber = _formdata("biznumber")){
    					$biznumber = str_replace("-","",$biznumber);
						$insert_filed .= "`biznumber`,";
						$insert_value .= "'$biznumber',";
			}

    		if($president = _formdata("president")){	$insert_filed .= "`president`,"; $insert_value .= "'$president',"; }
    		if($post = _formdata("post")){	$insert_filed .= "`post`,"; $insert_value .= "'$post',"; }
    		if($address = _formdata("address")){	$insert_filed .= "`address`,"; $insert_value .= "'$address',"; }
    		if($subject = _formdata("subject")){ $insert_filed .= "`subject`,"; $insert_value .= "'$subject',"; }
    		if($item = _formdata("item")){ $insert_filed .= "`item`,"; $insert_value .= "'$item',"; }
    		if($email = _formdata("email")){ $insert_filed .= "`email`,"; $insert_value .= "'$email',"; }    					
    		if($tel = _formdata("tel")){ $insert_filed .= "`tel`,"; $insert_value .= "'$tel',"; }
    		if($fax = _formdata("fax")){ $insert_filed .= "`fax`,"; $insert_value .= "'$fax',"; }
    		if($phone = _formdata("phone")){ $insert_filed .= "`phone`,"; $insert_value .= "'$phone',"; }
    		if($group = _formdata("group")){ $insert_filed .= "`group`,"; $insert_value .= "'$group',"; }
    		if($manager = _formdata("manager")){ $insert_filed .= "`manager`,"; $insert_value .= "'$manager',"; }    					
    		if($discount = _formdata("discount")){ $insert_filed .= "`discount`,"; $insert_value .= "'$discount',"; }

    		$insert_filed .= "`vat`,";
    		if($vat = _formdata("vat")) $insert_value .= "'on',"; else $insert_value .= "'',";					
    				
    		if($balance_sell = _formdata("balance_sell")){ $insert_filed .= "`balance_sell`,"; $insert_value .= "'$balance_sell',";}
			if($balance_buy = _formdata("balance_buy")){ $insert_filed .= "`balance_buy`,"; $insert_value .= "'$balance_buy',";}
			if($comment = _formdata("comment")){ $insert_filed .= "`comment`,"; $insert_value .= "'".addslashes($comment)."',";}

			$query = "INSERT INTO `sales_business` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			//echo $query."<br>";
			_sales_query($query);
			
				
	


		}


		$ajaxkey = _formdata("ajaxkey");
		$url = "/ajax_sales_business.php";
		echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#business').html(data);
            		}
        		});
    			</script>";

    	$ajaxkey = _formdata("ajaxkey");
		$url = "/ajax_sales_company.php";
		echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#company').html(data);
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