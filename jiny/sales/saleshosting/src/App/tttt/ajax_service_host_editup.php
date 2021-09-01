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
	//echo "section : ".$_SESSION['ajaxkey']."<br>";
	//echo "post : == ".$_POST['ajaxkey']."<br>";
	//echo _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		//$skin_name = "default";
		//$body = _skin_page("default","shop_cate_edit");

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		$limit = _formdata("limit");

		

		if($uid && $mode == "edit"){

			$query = "select * from `service_host` WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){

				$query = "UPDATE `service_host` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

				if($email = _formdata("email")) $query .= "`email`='$email' ,";
				if($domain = _formdata("domain")) $query .= "`domain`='$domain' ,";
				if($code = _formdata("code")) $query .= "`code`='$code' ,";

				if($description = _formdata("description")) $query .= "`description`='".addslashes($description)."' ,";


				if($hostname = _formdata("hostname")) $query .= "`hostname`='$hostname' ,";
				if($database = _formdata("database")) $query .= "`database`='$database' ,";
				if($user = _formdata("user")) $query .= "`user`='$user' ,";
				if($password = _formdata("password")) $query .= "`password`='$password' ,";

				if($site = _formdata("site")) $query .= "`site`='$site' ,";
				if($shop = _formdata("shop")) $query .= "`shop`='$shop' ,";
				if($sales = _formdata("sales")) $query .= "`sales`='$sales' ,";
				if($company = _formdata("company")) $query .= "`company`='$company' ,";
				if($trans = _formdata("trans")) $query .= "`trans`='$trans' ,";


				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query;

				if($rows->code != $code){
					// 테마코드 수정됨
					$query1 = "select * from `service_host` WHERE `code`='$code'";
					if($rows1 = _sales_query_rows($query1)){
						echo "오류, 중복된 테마코드 입니다.";
					} else {
						_sales_query($query);
						echo "테마 수정";

						$old_dir = "./users/".$rows->code;
						$new_dir = "./users/".$code;
						rename ($old_dir, $new_dir);

					}

				} else {
					_sales_query($query);
					echo "테마 수정";
				}
			}
			
		} else if($mode == "new"){

			$code = _formdata("code");
			
			$query = "select * from `service_host` WHERE `code`='$code'";
			if($rows = _sales_query_rows($query)){
				echo "오류, 중복된 코드 입니다.";
			} else {	

				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				if($enable = _formdata("enable")){
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				$insert_filed .= "`code`,";	$insert_value .= "'$code',";
		

				if($email = _formdata("email")){
					$insert_filed .= "`email`,";
					$insert_value .= "'$email',";
				}

				if($domain = _formdata("domain")){
					$insert_filed .= "`domain`,";
					$insert_value .= "'$domain',";
				}

				if($description = _formdata("description")){
					$insert_filed .= "`description`,";
					$insert_value .= "'".addslashes($description)."',";
				}


				if($hostname = _formdata("hostname")){
					$insert_filed .= "`hostname`,";
					$insert_value .= "'$hostname',";
				}
				if($database = _formdata("database")){
					$insert_filed .= "`database`,";
					$insert_value .= "'$database',";
				}
				if($user = _formdata("user")){
					$insert_filed .= "`user`,";
					$insert_value .= "'$user',";
				}
				if($password = _formdata("password")){
					$insert_filed .= "`password`,";
					$insert_value .= "'$password',";
				}

				if($site = _formdata("site")){
					$insert_filed .= "`site`,";
					$insert_value .= "'$site',";
				}
				if($shop = _formdata("shop")){
					$insert_filed .= "`shop`,";
					$insert_value .= "'$shop',";
				}
				if($sales = _formdata("sales")){
					$insert_filed .= "`sales`,";
					$insert_value .= "'$sales',";
				}
				if($company = _formdata("company")){
					$insert_filed .= "`company`,";
					$insert_value .= "'$company',";
				}
				if($trans = _formdata("trans")){
					$insert_filed .= "`trans`,";
					$insert_value .= "'$trans',";
				}

				$query = "INSERT INTO `service_host` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);

				// 기본 디렉토리 생성
				_is_path("./users/".$code."/theme");
				_is_path("./users/".$code."/data");
				_is_path("./users/".$code."/images");
				_is_path("./users/".$code."/goods");
				_is_path("./users/".$code."/orders");
				_is_path("./users/".$code."/gallary");
				_is_path("./users/".$code."/board");
				

			}
		} else if($mode == "delete"){
			$query = "DELETE FROM `service_host` WHERE `Id`='$uid'";
    		_sales_query($query);

    		echo "테마 삭제";

		} 


		echo "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		<form id='data' name='service' method='post' enctype='multipart/form-data'> 
		<input type='hidden' name='searchkey' value='$searchkey'>
		<script>
			$.ajax({
            	url:'/ajax_service_host.php?limit=".$limit."&ajaxkey=".$ajaxkey."',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('.mainbody').html(data);
            	}
        	});
    	</script>
		</form>
    	";
    	

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>