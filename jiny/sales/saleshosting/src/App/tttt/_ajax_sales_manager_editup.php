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

		if($mode == "delete"){
			
    		$query = "DELETE FROM `sales_manager` WHERE `Id`='$uid'";
    		_sales_query($query);
    	

		} else {

			$REF = $_GET['REF']; if(!$REF) $REF = $_POST['REF'];
    			
		
			$query = "select * from `sales_manager` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				// 이메일 중복여부 체크
				$query1 = "select * from `sales_manager` where email='$email'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query1)){
					echo "중복된 담당자 입니다.";
				} else {
					$query = "UPDATE `sales_manager` SET ";
					
					if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					
					$firstname = _formdata("firstname"); $query .= "`firstname`='$firstname' ,";
					$lastname = _formdata("lastname"); $query .= "`lastname`='$lastname' ,";
					$email = _formdata("email"); $query .= "`email`='$email' ,";
					$password = _formdata("password"); $query .= "`password`='$password' ,";
					$phone = _formdata("phone"); $query .= "`phone`='$phone' ,";
					$fax = _formdata("fax"); $query .= "`fax`='$fax' ,";
					$comment = _formdata("comment"); $query .= "`comment`='$comment' ,";
					$parts = _formdata("parts"); $query .= "`parts`='$parts' ,";


					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					_sales_query($query);

				}
			} else {
				// 삽입 
				
				$query1 = "select * from `sales_manager` where email='$email'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query1)){
					echo "중복된 상품 입니다.";
				} else {
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";

					if($enable = _formdata("enable")){
						$insert_filed .= "`enable`,";
						$insert_value .= "'on',";
					}

					if($firstname = _formdata("firstname")){
						$insert_filed .= "`firstname`,";
						$insert_value .= "'$firstname',";
					}

					if($lastname = _formdata("lastname")){
						$insert_filed .= "`lastname`,";
						$insert_value .= "'$lastname',";
					}

					if($email = _formdata("email")){
						$insert_filed .= "`email`,";
						$insert_value .= "'$email',";
					}

					if($phone = _formdata("phone")){
						$insert_filed .= "`phone`,";
						$insert_value .= "'$phone',";
					}

					if($fax = _formdata("fax")){
						$insert_filed .= "`fax`,";
						$insert_value .= "'$fax',";
					}

					if($password = _formdata("password")){
						$insert_filed .= "`password`,";
						$insert_value .= "'$password',";
					}

					if($parts = _formdata("parts")){
						$insert_filed .= "`parts`,";
						$insert_value .= "'$parts',";
					}

					if($comment = _formdata("comment")){
						$insert_filed .= "`comment`,";
						$insert_value .= "'$comment',";
					}

					

					$query = "INSERT INTO `sales_manager` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);
				}	
				
			}	

			_ajax_pagecall_script("/ajax_sales_manager.php",_formdata("ajaxkey"));

		}

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}





	/*
	if($_SESSION['nonce'] != $_POST['nonce']){
		$_SESSION['nonce'] = NULL;	
	} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능

		include "./dbinfo.php";
		$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

		include "language.php"; //# 사이트 언어, 지역 설정
		include "mobile.php";
	
		include "./func_skin.php"; //# 스킨 레이아웃 함수들...
		include "./func_files.php"; 
		include "./func_datetime.php";
		include "./func_javascript.php";
		include "./func_log.php";
	
		include "./func_string.php";
	
	
		if( !isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
		  	$msg = "회원 로그인이 필요합니다.";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";
		} else { //////////////////////////////////////////
		
			$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    		// echo $query; 
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(  mysql_num_rows($result)  ){ 
				$MEM=mysql_fetch_array($result);
				
				//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
				$query = "select * from `sales_server` where Id = '$MEM[server]'";
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(  mysql_num_rows($result)  )	{
					$server=mysql_fetch_array($result);
					$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
				} else {
					$dbconnect = $connect;
					$server[dbname] = $mysql_dbname;
				}

		
				//////////////////////////////////////////////////////////////////
			
    			$email = $_POST['email'];
				$password = $_POST['password'];
    			
    			$manager = $_POST['manager'];
    			$phone = $_POST['phone']; 
    			$fax = $_POST['fax']; $fax = str_replace("-","",$fax);
    			$mobile = $_POST['mobile']; $mobile = str_replace("-","",$mobile);
    			$part = $_POST['part']; 
    			
    			$comment = $_POST['comment'];
    			
    		
    			if(!$email) msg_alert("오류! 이메일이 없습니다.");
    			else if(!$password) msg_alert("오류! 비밀번호가 없습니다.");
    			else if(!$manager) msg_alert("오류! 직원 이름이 없습니다.");
    			else {
					 
					$query = "select * from sales_manager where email = '$email'";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(  mysql_num_rows($result)  ) msg_alert("중복된 이메일주소 입니다.");
					else {
						$query = "INSERT INTO sales_manager (`regdate`, `members_id`, `part`, `name`, `email`, `password`, `fax`, `phone`, `mobile`,`memo`) 
    								VALUES ('$TODAY', '$MEM[Id]', '$part', '$manager', '$email', '$password', '$fax', '$phone', '$mobile', '$comment')";
    					mysql_db_query($mysql_dbname,$query,$connect);
					
					}
				}	
				
    			echo "<script> history.go(-2); </script>";	
		
				//////////////////////////////////////////////////////////////////		
		
			} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
	
		}
	

	} ///// ##### SESSION END ##### /////
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	*/
	
?>

