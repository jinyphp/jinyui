<?php

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

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");

	$javascript = "<script>

		function setup(mode){
			var url = \"ajax_resale_setup.php\";
			var form = document.resale;
			// form.action = url;  //이동할 페이지
  			form.mode.value = mode;			
			ajax_html('#mainbody',url);
		}
	</script>";

	// ================	

	if(isset($_COOKIE['cookie_email'])){

		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");		
		
		$body = $javascript._theme_page($site_env->theme,"resale_setup",$site_language,$site_mobile);	

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}


		$mode = _formdata("mode");
		// echo "mode = $mode <br>";

		if($mode == "setup"){

			$query = "select * from `service_resales` where email = '$email'";
			if($rows = _mysqli_query_rows($query)){
				// Update

				$query = "UPDATE `service_resales` SET ";
				
				if($resales = _formdata("resales")) $query .= "`resales`='on' ,"; else $query .= "`resales`='' ,";

				$comission = _formdata("comission"); $query .= "`comission`='$comission' ,";
				$description = _formdata("description"); $description = addslashes($description); $query .= "`description`='$description' ,";
				$seller = _formdata("seller"); $query .= "`seller`='$seller' ,";
				$email = _formdata("email"); $query .= "`email`='$email' ,";
				$name = _formdata("name"); $query .= "`name`='$name' ,";
				$domain = _formdata("domain"); $query .= "`domain`='$domain' ,";
				$email = _formdata("email"); $query .= "`email`='$email' ,";

				$seller_phone = _formdata("seller_phone"); $query .= "`phone`='$seller_phone' ,";
				$seller_fax = _formdata("seller_fax"); $query .= "`fax`='$seller_fax' ,";
				$address_send = _formdata("address_send"); $query .= "`address_send`='$address_send' ,";
				$address_return = _formdata("address_return"); $query .= "`address_return`='$address_return' ,";


				$query .= "WHERE `email`='".$rows->email."'";
				$query = str_replace(",WHERE","WHERE",$query);
				echo $query."<br>";
				_mysqli_query($query);

			} else {
				// Insert

				$insert_filed = "";	$insert_value = "";				
				$insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAYTIME."',";
				$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";

				if($resales = _formdata("resales")){
					$insert_filed .= "`resales`,";	$insert_value .= "'on',";
				}

				if($comission = _formdata("comission")){
					$insert_filed .= "`comission`,";	$insert_value .= "'".$comission."',";
				}

				if($description = _formdata("description")){
					$description = addslashes($description);
					$insert_filed .= "`description`,";	$insert_value .= "'".$description."',";
				}

				if($seller = _formdata("seller")){
					$insert_filed .= "`seller`,";	$insert_value .= "'".$seller."',";
				}
				if($seller_email = _formdata("seller_email")){
					$insert_filed .= "`seller_email`,";	$insert_value .= "'".$seller_email."',";
				}
				if($name = _formdata("name")){
					$insert_filed .= "`name`,";	$insert_value .= "'".$name."',";
				}
				if($domain = _formdata("domain")){
					$insert_filed .= "`domain`,";	$insert_value .= "'".$domain."',";
				}
				if($seller_phone = _formdata("seller_phone")){
					$insert_filed .= "`phone`,";	$insert_value .= "'".$seller_phone."',";
				}
				if($seller_fax = _formdata("seller_fax")){
					$insert_filed .= "`fax`,";	$insert_value .= "'".$seller_fax."',";
				}

				if($address_send = _formdata("address_send")){
					$insert_filed .= "`address_send`,";	$insert_value .= "'".$address_send."',";
				}
				if($address_return = _formdata("address_return")){
					$insert_filed .= "`address_return`,";	$insert_value .= "'".$address_return."',";
				}


				$query = "INSERT INTO `service_resales` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_mysqli_query($query);
				echo $query;

			}	

		}

		



		$query = "select * from `service_resales` where email = '$email'";
		//echo $query;
		if($rows = _mysqli_query_rows($query)){
		}	
	

		
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body=str_replace("{formstart}","<form id='data' name='resale' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    		<input type='hidden' name='mode' id=\"mode\">",$body);
		$body = str_replace("{formend}","</form>",$body);

		$body = str_replace("{resales}",_form_checkbox("resales",$rows->resales),$body);
		$body = str_replace("{logo}","<input type='file' name='userfile1' id=\"cssFormStyle\" >",$body);
		$body = str_replace("{comission}",_form_text("comission",$rows->comission,$css_textbox),$body);
		$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->description)."</textarea>",$body);


		// 공급자 정보
		$body = str_replace("{seller}",_form_text("seller",$rows->seller,$css_textbox),$body);
		$body = str_replace("{email}",_form_text("email",$email,$css_textbox),$body);
		$body = str_replace("{name}",_form_text("name",$rows->name,$css_textbox),$body);
		$body = str_replace("{domain}",_form_text("domain",$rows->domain,$css_textbox),$body);

		$body = str_replace("{seller_phone}",_form_text("seller_phone",$rows->phone,$css_textbox),$body);
		$body = str_replace("{seller_fax}",_form_text("seller_fax",$rows->fax,$css_textbox),$body);

		$body = str_replace("{address_send}",_form_text("address_send",$rows->address_send,$css_textbox),$body);
		$body = str_replace("{address_return}",_form_text("address_return",$rows->address_return,$css_textbox),$body);	


		// $body = str_replace("{form_submit}","<input type='submit' name='setup' value='설정' style=\"$css_btn_gray\">",$body);
		// $body = str_replace("{form_submit}","<input type='button' value='설정' onclick=\"javascript:setup()\" style=\"".$css_btn_gray."\" >",$body);
		$button ="<input type='button' value='입점신청' onclick=\"javascript:setup('setup')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{form_submit}",$button,$body);

		echo $body;
	
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody",$path_ajax_login)."</script>";	
		$body =  _theme_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

		


?>