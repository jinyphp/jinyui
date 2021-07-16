<?
	// ============== 
	// CURL Pages 처리
	// 2016.03.25

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/conf/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");

	echo "<br>SALESHosting API<br>";

	if($adminkey = _formdata("adminkey")){
		$query = "select * from `site_env`";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
			if($rows->adminkey == $adminkey){

				// ====== CURL 접속 체크 성공 ======
				$mode = _formdata("mode");
				echo "curl mode: $mode<br>";

				$code = _formdata("code");
				if($mode == "edit"){
					$query = "select * from service.business where code='$code'";
					if($rows = _mysqli_query_rows($query)){

						$query = "UPDATE service.business SET ";

						$business = $_POST['business'];	$query .= "`name`='$business' ,";
    					$biznumber = $_POST['biznumber']; $biznumber = str_replace("-","",$biznumber);	$query .= "`license`='$biznumber' ,";
    					$president = $_POST['president']; $query .= "`president`='$president' ,";
    					$post = $_POST['post'];	$query .= "`post`='$post' ,";
    					$address = $_POST['address']; $query .= "`address`='$address' ,";
    					$subject = $_POST['subject']; $query .= "`subject`='$subject' ,";
    					$item = $_POST['item'];	$query .= "`item`='$item' ,";
    					$email = $_POST['email'];	$query .= "`email`='$email' ,";
    					$tel = $_POST['tel']; $query .= "`tel`='$tel' ,";
    					$fax = $_POST['fax']; $fax = str_replace("-","",$fax);	$query .= "`fax`='$fax' ,";
    					$phone = $_POST['phone']; $phone = str_replace("-","",$phone);	$query .= "`phone`='$phone' ,";
				
						$business_country = _formdata("business_country"); $query .= "`country`='$business_country' ,";
						$currency = $_POST['currency'];	$query .= "`currency`='$currency' ,";    

						$host_id = $_POST['host_id'];	$query .= "`host_id`='$host_id' ,";  
						$business_id = $_POST['business_id'];	$query .= "`business_id`='$business_id' ,";  	

						$query .= "`linkTimes`='$TODAYTIME' ,";  		

						$query .= "WHERE `code`='$code'";
						$query = str_replace(",WHERE","WHERE",$query);
						echo $query."<br>";
						_mysqli_query($query);

					} else {
						// 등록된 내용이 없음.
						// 신규 등록이 필요함
						$mode = "new";
					}
				}

				// 수정 부분 실페시, mode 변경 처리를 위하여 if/else 부분을 분리해 놓음.
				if($mode == "new"){
					$insert_filed .= "`regdate`,";	$insert_value .= "'$TODAYTIME',";
					$insert_filed .= "`code`,";	$insert_value .= "'$code',";

					if($business= _formdata("business")){	$insert_filed .= "`name`,"; $insert_value .= "'$business',"; }
					if($biznumber = _formdata("biznumber")){
    					$biznumber = str_replace("-","",$biznumber);
						$insert_filed .= "`license`,";
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

    				if($country = _formdata("business_country")){	$insert_filed .= "`country`,"; $insert_value .= "'$country',"; }
					if($currency = _formdata("currency")){	$insert_filed .= "`currency`,"; $insert_value .= "'$currency',"; }

					if($host_id = _formdata("host_id")){	$insert_filed .= "`host_id`,"; $insert_value .= "'$host_id',"; }
					if($business_id = _formdata("business_id")){	$insert_filed .= "`business_id`,"; $insert_value .= "'$business_id',"; }

					$insert_filed .= "`linkTimes`,"; $insert_value .= "'$TODAYTIME',";
					
					$query = "INSERT INTO service.business ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					echo $query."<br>";
					_mysqli_query($query);

				} else if($mode == "delete"){

					$query = "DELETE FROM service.business WHERE `code`='$code'";
    				_mysqli_query($query);

				}	

				if($mode == "links_update"){

					$query = "select * from service.business where code='$code'";
					if($rows = _mysqli_query_rows($query)){

						$links = str_replace($_POST['links_old'], "", $rows->links); // 삭제 
						$links .= $_POST['links_new']; // 추가

						$query = "UPDATE service.business SET `links`='$links' WHERE `code`='$code'";
						_mysqli_query($query);

					}	

				} else if($mode == "links_delete"){

					$query = "select * from service.business where code='$code'";
					if($rows = _mysqli_query_rows($query)){

						$links = str_replace($_POST['links_old'], "", $rows->links); // 삭제 

						$query = "UPDATE service.business SET `links`='$links' WHERE `code`='$code'";
						_mysqli_query($query);

					}	

				}

				// =============================

			} else {
				echo "비정상 접속! adminkey 값이 일치하지 않습니다. 해당 접속IP를 차단합니다. 해제방법은 관리자에게 문의 바랍니다. <br>";
			}

		} else {
			echo "site_env 환경 설정값을 읽어올수 없습니다. <br>";
		}
	} else {
		echo "adminkey 값이 없습니다. <br>";
	}


	
?>