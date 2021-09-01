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
		// include "./sales.php";

		//$skin_name = "default";
		//$body = _skin_page("default","shop_cate_edit");

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		$limit = _formdata("limit");

		

		if($uid && $mode == "edit"){
			/*
			$query = "select * from `service_reseller` WHERE `Id`='$uid'";
			if($rows = _mysqli_query_rows($query)){

				$query = "UPDATE `service_reseller` SET ";

				// 자기 본인 정보는 승인 및 활성화 수정이 불가능함		
				if($rows->email != $_COOKIE['cookie_email']){
					if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					if($auth_req = _formdata("auth_req")) $query .= "`auth_req`='on' ,"; else $query .= "`auth_req`='' ,";

					if($grade = _formdata("grade")) $query .= "`grade`='$grade' ,";
					if($margin = _formdata("margin")) $query .= "`margin`='$margin' ,";

					if($setup = _formdata("setup")) $query .= "`setup`='$setup' ,";
					if($charge = _formdata("charge")) $query .= "`charge`='$charge' ,";
					if($expire = _formdata("expire")) $query .= "`expire`='$expire' ,";
				}

				if($email = _formdata("email")) $query .= "`email`='$email' ,";
				if($name = _formdata("name")) $query .= "`name`='$name' ,";
				if($code = _formdata("code")) $query .= "`code`='$code' ,";
				if($domain = _formdata("domain")) $query .= "`domain`='$domain' ,";

				

				if($bankname = _formdata("bankname")) $query .= "`bankname`='$bankname' ,";
				if($bankswiff = _formdata("bankswiff")) $query .= "`bankswiff`='$bankswiff' ,";
				if($banknum = _formdata("banknum")) $query .= "`banknum`='$banknum' ,";
				if($bankuser = _formdata("bankuser")) $query .= "`bankuser`='$bankuser' ,";
			
				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				_mysqli_query($query);
				//echo $query;

			
			}
			*/
			
		} else if($mode == "new"){
			/*
			$email = _formdata("email");
			$reseller = $_COOKIE['cookie_email'];
			
			$query = "select * from `service_reseller` WHERE `email`='$email'";
			if($rows = _mysqli_query_rows($query)){
				echo "오류, 중복된 코드 입니다.";
			} else {	

				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				if($enable = _formdata("enable")){
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}


				if($auth_req = _formdata("auth_req")){
					$insert_filed .= "`auth_req`,";
					$insert_value .= "'on',";
				}

				$insert_filed .= "`email`,";	$insert_value .= "'$email',";
				$insert_filed .= "`reseller`,";	$insert_value .= "'$reseller',";

				if($name = _formdata("name")){
					$insert_filed .= "`name`,";
					$insert_value .= "'$name',";
				}


				if($code = _formdata("code")){
					$insert_filed .= "`code`,";
					$insert_value .= "'$code',";
				}


				if($domain = _formdata("domain")){
					$insert_filed .= "`domain`,";
					$insert_value .= "'$domain',";
				}

				if($grade = _formdata("grade")){
					$insert_filed .= "`grade`,";
					$insert_value .= "'$grade',";
				}
				if($margin = _formdata("margin")){
					$insert_filed .= "`margin`,";
					$insert_value .= "'$margin',";
				}

				if($setup = _formdata("setup")){
					$insert_filed .= "`setup`,";
					$insert_value .= "'$setup',";
				}
				if($charge = _formdata("charge")){
					$insert_filed .= "`charge`,";
					$insert_value .= "'$charge',";
				}
				if($expire = _formdata("expire")){
					$insert_filed .= "`expire`,";
					$insert_value .= "'$expire',";
				}

				if($bankname = _formdata("bankname")){
					$insert_filed .= "`bankname`,";
					$insert_value .= "'$bankname',";
				}
				if($bankswiff = _formdata("bankswiff")){
					$insert_filed .= "`bankswiff`,";
					$insert_value .= "'$bankswiff',";
				}
				if($banknum = _formdata("banknum")){
					$insert_filed .= "`banknum`,";
					$insert_value .= "'$banknum',";
				}
				if($bankuser = _formdata("bankuser")){
					$insert_filed .= "`bankuser`,";
					$insert_value .= "'$bankuser',";
				}

				$query = "INSERT INTO `service_reseller` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_mysqli_query($query);

			}
			*/

		} else if($mode == "check"){

			// 입금확인 
			$query = "select * from `service_reseller_emoney` WHERE `Id`='$uid'";
			if($rows = _mysqli_query_rows($query)){

				$query = "UPDATE `service_reseller_emoney` SET ";
				$query .= "`check_auth`='' ,";
			
				// 입금자 금액 수정 승인 갱신
				$query1 = "select * from `service_reseller` WHERE `email`='".$rows->email."'";
				if($rows1 = _mysqli_query_rows($query1)){
					$balance = $rows1->emoney + $rows->emoney;
					$query .= "`balance`='$balance' ,";
				}

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				_mysqli_query($query);

				// 

				$query = "UPDATE `service_reseller` SET `emoney`='$balance' WHERE `email`='".$rows->email."'";
				_mysqli_query($query);

			}


		} else if($mode == "delete"){
			// $query = "DELETE FROM `service_reseller` WHERE `Id`='$uid'";
    		// _mysqli_query($query);

    		// echo "테마 삭제";

		} 

		//echo "리셀러 갱신....";


		echo "<script>
			$.ajax({
            	url:'/ajax_service_reseller.php?limit=".$limit."&ajaxkey=".$ajaxkey."',
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