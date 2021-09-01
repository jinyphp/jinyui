<?
	@session_start();

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");

		


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
					$part = _formdata("part"); $query .= "`part`='$part' ,";
					$level = _formdata("level"); $query .= "`level`='$level' ,";


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

					if($part = _formdata("part")){
						$insert_filed .= "`part`,";
						$insert_value .= "'$part',";
					}

					if($level = _formdata("level")){
						$insert_filed .= "`level`,";
						$insert_value .= "'$level',";
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

			

		}

		$url = "sales_manager.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";

		
	} else {
		$body = _theme_page($skin_name,"error");		
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

