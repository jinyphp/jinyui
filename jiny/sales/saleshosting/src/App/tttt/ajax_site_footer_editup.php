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
		include "./sales.php";

		//$skin_name = "default";
		//$body = _skin_page("default","shop_cate_edit");

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		
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

		$query = "select * from `site_env` where id =$uid";
		$site_env_rows = _sales_query_rows($query);

		$query = "select * from `site_footer` where eid =$uid";
		if($header_rows = _sales_query_rows($query)){
			// Header 정보 갱신

			$query = "UPDATE `site_footer` SET ";
			if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
			if($title = _formdata("title")) $query .= "`title`='$title' ,";

			// if($header = _formdata("header")) $query .= "`header`='on' ,"; else $query .= "`header`='' ,";

			if($width = _formdata("width")) $query .= "`width`='$width' ,";
			if($align = _formdata("align")) $query .= "`align`='$align' ,";
			if($bgcolor = _formdata("bgcolor")) $query .= "`bgcolor`='$bgcolor' ,";

			// 로고파일
			if($files = _form_uploadfile("logo","./logo/logo-".$sales_db->Id."-$uid")){
				$query .= "`logo` = './logo/"."logo-".$sales_db->Id."-$uid.".$files[ext]."',";
			}


			
			if($login_check = _formdata("login_check")){
				$query .= "`login_check` = 'on',";
			}
			if($files = _form_uploadfile("login_images","./users/login_images-".$sales_db->Id."-$uid")){
				$query .= "`login_images` = './users/"."login_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}


			if($logout_check = _formdata("logout_check")){
				$query .= "`logout_check` = 'on',";
			}
			if($files = _form_uploadfile("logout_images","./users/logout_images-".$sales_db->Id."-$uid")){
				$query .= "`logout_images` = './users/"."logout_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($member_check = _formdata("member_check")){
				$query .= "`member_check` = 'on',";
			}
			if($files = _form_uploadfile("member_images","./users/member_images-".$sales_db->Id."-$uid")){
				$query .= "`member_images` = './users/"."member_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($myinfo_check = _formdata("myinfo_check")){
				$query .= "`myinfo_check` = 'on',";
			}
			if($files = _form_uploadfile("myinfo_images","./users/myinfo_images-".$sales_db->Id."-$uid")){
				$query .= "`myinfo_images` = './users/"."myinfo_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($cart_check = _formdata("cart_check")){
				$query .= "`cart_check` = 'on',";
			}
			if($files = _form_uploadfile("cart_images","./users/cart_images-".$sales_db->Id."-$uid")){
				$query .= "`car_images` = './users/"."cart_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($wish_check = _formdata("wish_check")){
				$query .= "`wish_check` = 'on',";
			}
			if($files = _form_uploadfile("wish_images","./users/wish_images-".$sales_db->Id."-$uid")){
				$query .= "`wish_images` = './users/"."wish_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($orderlist_check = _formdata("orderlist_check")){
				$query .= "`orderlist_check` = 'on',";
			}
			if($files = _form_uploadfile("orderlist_images","./users/orderlist_images-".$sales_db->Id."-$uid")){
				$query .= "`orderlist_images` = './users/"."orderlist_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){
				$login = "{";
				$logout = "{";
				$member = "{";
				$myinfo = "{";
				$cart = "{";
				$wish = "{";
				$orderlist = "{";

				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					$_login = "login_".$rows1->code;
					$login .= "\"$rows1->code\":\"".addslashes( _formdata("login_".$rows1->code) )."\"";

					$_logout = "logout_".$rows1->code;
					$logout .= "\"$rows1->code\":\"".addslashes( _formdata("logout_".$rows1->code) )."\"";

					$_member = "member_".$rows1->code;
					$member .= "\"$rows1->code\":\"".addslashes( _formdata("member_".$rows1->code) )."\"";

					$_myinfo = "myinfo_".$rows1->code;
					$myinfo .= "\"$rows1->code\":\"".addslashes( _formdata("myinfo_".$rows1->code) )."\"";
						
					$_cart = "cart_".$rows1->code;
					$cart .= "\"$rows1->code\":\"".addslashes( _formdata("cart_".$rows1->code) )."\"";
					
					$_wish = "wish_".$rows1->code;
					$wish .= "\"$rows1->code\":\"".addslashes( _formdata("wish_".$rows1->code) )."\"";
						
					$_orderlist = "orderlist_".$rows1->code;
					$orderlist .= "\"$rows1->code\":\"".addslashes( _formdata("orderlist_".$rows1->code) )."\"";

					if($i<(count($rowss1)-1)) {
						$login .= ",";
						$logout .= ",";
						$member .= ",";
						$myinfo .= ",";
						$cart .= ",";
						$wish .= ",";
						$orderlist .= ",";
					}	


					$desktop =  addslashes( _formdata($rows1->code) );
					$query1 = "UPDATE `site_skin_html` SET  `html` = '$desktop' where `code`='footer' and  `eid`='$uid' and `language`='".$rows1->code."' and `mobile`='pc'";
					_sales_query($query1);

					$mobile =  addslashes( _formdata($rows1->code."_m") );
					$query1 = "UPDATE `site_skin_html` SET  `html` = '$mobile' where `code`='footer' and  `eid`='$uid' and `language`='".$rows1->code."' and `mobile`='m'";
					_sales_query($query1);
				}

				$login .= "}";
				$query .= "`login`='$login',";

				$logout .= "}";
				$query .= "`logout`='$logout',";

				$member .= "}";
				$query .= "`member`='$member',";

				$myinfo .= "}";
				$query .= "`myinfo`='$myinfo',";

				$cart .= "}";
				$query .= "`cart`='$cart',";

				$wish .= "}";
				$query .= "`wish`='$wish',";

				$orderlist .= "}";
				$query .= "`orderlist`='$orderlist',";

			}

			$query .= "`domain`='".$site_env_rows->domain."',";

			

			$query .= "WHERE `eid`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			_sales_query($query);

			echo "수정완료 ";



		} else {
			// Footer 신규 삽입 

			$insert_filed .= "`eid`,";
			$insert_value .= "'$uid',";

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			$insert_filed .= "`code`,";
			$insert_value .= "'footer',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";
				$insert_value .= "'on',";
			}

			if($title = _formdata("title")){
				$insert_filed .= "`title`,";
				$insert_value .= "'$title',";
			}

			if($width = _formdata("width")){
				$insert_filed .= "`width`,";
				$insert_value .= "'$width',";
			}

			if($align = _formdata("align")){
				$insert_filed .= "`align`,";
				$insert_value .= "'$align',";
			}

			if($bgcolor = _formdata("bgcolor")){
				$insert_filed .= "`bgcolor`,";
				$insert_value .= "'$bgcolor',";
			}

			// 로고파일
			if($files = _form_uploadfile("logo","./logo/logo-".$sales_db->Id."-$uid")){
				$insert_filed .= "`logo`,";
				$insert_value .= "'./logo/"."logo-".$sales_db->Id."-$uid.".$files[ext]."',";
			}


			
			if($login_check = _formdata("login_check")){
				$insert_filed .= "`login_check`,";
				$insert_value .= "'on',";
			}
			if($files = _form_uploadfile("login_images","./users/login_images-".$sales_db->Id."-$uid")){
				$insert_filed .= "`login_images`,";
				$insert_value .= "'./users/"."login_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}


			if($logout_check = _formdata("logout_check")){
				$insert_filed .= "`logout_check`,";
				$insert_value .= "'on',";
			}
			if($files = _form_uploadfile("logout_images","./users/logout_images-".$sales_db->Id."-$uid")){
				$insert_filed .= "`logout_images`,";
				$insert_value .= "'./users/"."logout_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($member_check = _formdata("member_check")){
				$insert_filed .= "`member_check`,";
				$insert_value .= "'on',";
			}
			if($files = _form_uploadfile("member_images","./users/member_images-".$sales_db->Id."-$uid")){
				$insert_filed .= "`member_images`,";
				$insert_value .= "'./users/"."member_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($myinfo_check = _formdata("myinfo_check")){
				$insert_filed .= "`myinfo_check`,";
				$insert_value .= "'on',";
			}
			if($files = _form_uploadfile("myinfo_images","./users/myinfo_images-".$sales_db->Id."-$uid")){
				$insert_filed .= "`myinfo_images`,";
				$insert_value .= "'./users/"."myinfo_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($cart_check = _formdata("cart_check")){
				$insert_filed .= "`cart_check`,";
				$insert_value .= "'on',";
			}
			if($files = _form_uploadfile("cart_images","./users/cart_images-".$sales_db->Id."-$uid")){
				$insert_filed .= "`car_images`,";
				$insert_value .= "'./users/"."cart_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($wish_check = _formdata("wish_check")){
				$insert_filed .= "`wish_check`,";
				$insert_value .= "'on',";
			}
			if($files = _form_uploadfile("wish_images","./users/wish_images-".$sales_db->Id."-$uid")){
				$insert_filed .= "`wish_images`,";
				$insert_value .= "'./users/"."wish_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}

			if($orderlist_check = _formdata("orderlist_check")){
				$insert_filed .= "`orderlist_check`,";
				$insert_value .= "'on',";
			}
			if($files = _form_uploadfile("orderlist_images","./users/orderlist_images-".$sales_db->Id."-$uid")){
				$insert_filed .= "`orderlist_images`,";
				$insert_value .= "'./users/"."orderlist_images-".$sales_db->Id."-$uid.".$files[ext]."',";
			}
			



	

			$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){
				$login = "{";
				$logout = "{";
				$member = "{";
				$myinfo = "{";
				$cart = "{";
				$wish = "{";
				$orderlist = "{";

				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];

					$_login = "login_".$rows1->code;
					$login .= "\"$rows1->code\":\"".addslashes( _formdata("login_".$rows1->code) )."\"";

					$_logout = "logout_".$rows1->code;
					$logout .= "\"$rows1->code\":\"".addslashes( _formdata("logout_".$rows1->code) )."\"";

					$_member = "member_".$rows1->code;
					$member .= "\"$rows1->code\":\"".addslashes( _formdata("member_".$rows1->code) )."\"";

					$_myinfo = "myinfo_".$rows1->code;
					$myinfo .= "\"$rows1->code\":\"".addslashes( _formdata("myinfo_".$rows1->code) )."\"";
						
					$_cart = "cart_".$rows1->code;
					$cart .= "\"$rows1->code\":\"".addslashes( _formdata("cart_".$rows1->code) )."\"";
					
					$_wish = "wish_".$rows1->code;
					$wish .= "\"$rows1->code\":\"".addslashes( _formdata("wish_".$rows1->code) )."\"";
						
					$_orderlist = "orderlist_".$rows1->code;
					$orderlist .= "\"$rows1->code\":\"".addslashes( _formdata("orderlist_".$rows1->code) )."\"";

					if($i<(count($rowss1)-1)) {
						$login .= ",";
						$logout .= ",";
						$member .= ",";
						$myinfo .= ",";
						$cart .= ",";
						$wish .= ",";
						$orderlist .= ",";
					}	


					$desktop =  addslashes( _formdata($rows1->code) );
					$query1 = "INSERT INTO `site_skin_html` (`eid`,`language`,`mobile`,`html`,`code`,`domain`) 
					VALUES ('".$uid."','".$rows1->code."','pc','$desktop','footer','".$site_env_rows->domain."')";
					_sales_query($query1);

					$mobile =  addslashes( _formdata($rows1->code."_m") );
					$query1 = "INSERT INTO `site_skin_html` (`eid`,`language`,`mobile`,`html`,`code`,`domain`) 
					VALUES ('".$uid."','".$rows1->code."','m','$mobile','footer','".$site_env_rows->domain."')";
					_sales_query($query1);
				}

				$login .= "}";
				//$query .= "`goodname`='$goodname' ,";
				$insert_filed .= "`login`,";
				$insert_value .= "'$login',";

				$logout .= "}";
				//$query .= "`spec`='$spec' ,";
				$insert_filed .= "`logout`,";
				$insert_value .= "'$logout',";

				$member .= "}";
				//$query .= "`subtitle`='$subtitle' ,";
				$insert_filed .= "`member`,";
				$insert_value .= "'$member',";

				$myinfo .= "}";
				//$query .= "`optionitem`='$optionitem' ,";
				$insert_filed .= "`myinfo`,";
				$insert_value .= "'$myinfo',";

				$cart .= "}";
				//$query .= "`seo_title`='$seo_title' ,";
				$insert_filed .= "`cart`,";
				$insert_value .= "'$cart',";

				$wish .= "}";
				//$query .= "`seo_description`='$seo_description' ,";
				$insert_filed .= "`wish`,";
				$insert_value .= "'$wish',";

				$orderlist .= "}";
				//$query .= "`seo_keyword`='$seo_keyword' ,";
				$insert_filed .= "`orderlist`,";
				$insert_value .= "'$orderlist',";

			}

			$insert_filed .= "`domain`,";
			$insert_value .= "'".$site_env_rows->domain."',";
			

			$query = "INSERT INTO `site_footer` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			//echo $query;
			_sales_query($query);

			echo "신규설정 ";
				

			// 



		}

		// _ajax_pagecall_script("/ajax_site_header.php",_formdata("ajaxkey"));



		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>