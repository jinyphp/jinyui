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
	include "./func/orders.php";




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
            		url:'".$url."ajaxkey=".$ajaxkey."',
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
			$query = "select * from `shop_orders` where Id='$uid'";
			if($rows = _sales_query_rows($query)){

				$query = "DELETE FROM `shop_orders` WHERE `Id`='$uid'";
    			_sales_query($query);
		    	//echo $query."<br>";

		    	$query = "DELETE FROM `shop_orders_detail` WHERE `cartlog`='".$rows->cartlog."'";
    			_sales_query($query);
		    	//echo $query."<br>";
    		}
			// _ajax_pagecall_script("/ajax_shop_goods.php",_formdata("ajaxkey"));

		} else {
		
			$company = _formmode("shipping_company");
			$regdate = _formmode("shipping_regdate");
			$invoice = _formmode("shipping_invoice");
			$firstname = _formmode("shipping_firstname");
			$lastname = _formmode("shipping_lastname");
			$phone = _formmode("shipping_phone");

			$query = "select * from `shop_orders` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				$query = "UPDATE `shop_orders` SET `status`='".$mode."' WHERE `Id`='$uid'";
				echo $query."<br>";
				_sales_query($query);

				$query = "UPDATE `shop_orders_detail` SET `status`='".$mode."' WHERE `ordercode`='".$rows->ordercode."'";
				echo $query."<br>";
				_sales_query($query);

				// 주문 배송 정보 입력
				$query = "select * from `shop_orders_shipping` where ordercode='".$rows->ordercode."'";
				if($rows = _sales_query_rows($query)){
					$query = "UPDATE `shop_orders_shipping` SET `invoice`='".$invoice."',`company`='".$company."',`regdate`='".$regdate."',
								`firstname`='".$firstname."',`lastname`='".$lastname."',`phone`='".$phone."' WHERE `ordercode`='".$rows->ordercode."'";
				echo $query."<br>";
				_sales_query($query);
				} else {
					$query ="INSERT INTO `shop_orders_shipping` (`regdate`,`ordercode`,`email`,`invoice`,`company`,`firstname`,`lastname`,`phone`) 
									VALUES ('".$TODAYTIME."','".$rows->ordercode."','".$rows->email."','".$invoice."','".$company."','".$firstname."','".$lastname."','".$phone."')";
					_sales_query($query);
				}
					
			}
			

			/*
			$query = "select * from `site_members` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				// 이메일 중복여부 체크
				$query1 = "select * from `site_members` where email='$email'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query)){
					echo "이미 가입, 중복된 이메일 입니다.";
				} else {
					$query = "UPDATE `site_members` SET ";
					if($enable = _formdata("enable")) $query .= "`auth`='on' ,"; else $query .= "`auth`='' ,";

					if($email = _formdata("email")) $query .= "`email`='$email' ,";
					if($password = _formdata("password")) $query .= "`password`='$password' ,";

					if($manager = _formdata("manager")) $query .= "`username`='$manager' ,";
					if($firstname = _formdata("firstname")) $query .= "`firstname`='$firstname' ,";

					if($phone = _formdata("phone")) $query .= "`userphone`='$phone' ,";

					if($sex = _formdata("sex")) $query .= "`sex`='$sex' ,";
					if($post = _formdata("post")) $query .= "`post`='$post' ,";
					if($address = _formdata("address")) $query .= "`address`='$address' ,";

					if($country = _formdata("members_country")) $query .= "`country`='$country' ,";
					if($language = _formdata("members_language")) $query .= "`language`='$language' ,";

					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					//echo $query;
					_sales_query($query);

				}
			} else {
				// 삽입 
				$query1 = "select * from `site_members` where email='$email'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query)){
					echo "이미 가입, 중복된 이메일 입니다.";
				} else {
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";

					if($enable = _formdata("enable")){
						$insert_filed .= "`auth`,";
						$insert_value .= "'on',";
					}

					if($email = _formdata("email")){
						$insert_filed .= "`email`,";
						$insert_value .= "'$email',";
					}

					if($password = _formdata("password")){
						$insert_filed .= "`password`,";
						$insert_value .= "'$password',";
					}

					if($manager = _formdata("manager")){
						$insert_filed .= "`username`,";
						$insert_value .= "'$manager',";
					}

					if($firstname = _formdata("firstname")){
						$insert_filed .= "`firstname`,";
						$insert_value .= "'$dirstname',";
					}

					if($phone = _formdata("phone")){
						$insert_filed .= "`userphone`,";
						$insert_value .= "'$userphone',";
					}

					if($sex = _formdata("sex")){
						$insert_filed .= "`sex`,";
						$insert_value .= "'$sex',";
					}

					if($post = _formdata("post")){
						$insert_filed .= "`post`,";
						$insert_value .= "'$post',";
					}

					if($address = _formdata("address")){
						$insert_filed .= "`address`,";
						$insert_value .= "'$address',";
					}

					if($country = _formdata("members_country")){
						$insert_filed .= "`country`,";
						$insert_value .= "'$country',";
					}

					if($language = _formdata("members_language")){
						$insert_filed .= "`language`,";
						$insert_value .= "'$language',";
					}

					$query = "INSERT INTO `site_members` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);
				}	
			}	
			*/
			// 

		}

		$limit = _formdata("limit");
		_ajax_pagecall_script("/ajax_shop_orders_edit.php?uid=$uid&limit=$limit&",_formdata("ajaxkey"));

	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>