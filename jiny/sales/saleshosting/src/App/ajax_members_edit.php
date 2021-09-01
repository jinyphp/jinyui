<?php

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

	include "./func/members.php";

	include "./func/css.php";


	$javascript = "<script>
		$('#email').on('keyup',function(e){ 
			// 이메일 중복 여부 체크
            	$.ajax({
            		url:'/ajax_members_email_check.php?mode=new',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#email_message').html(data);
            		}
        		});       
        	if(e.keyCode == 13){ // 엔터입력.
            	e.preventDefault();            	
        	}
    	});

		function members_submit(){
				var email_check = $('#email_check').val();
				var email = $('#email').val();
				var password = $('#password').val();

				if(email_check == \"false\") alert(\"정상적인 이메일 주소가 아닙니다.\");
				else if(!email) alert(\"please, input email\");
				else if(!password) alert(\"please, input password\");
				else {
					$.ajax({
            			url:'/ajax_members_editup.php?mode=edit',
            			type:'post',
            			data:$('form').serialize(),
            			success:function(data){
            				$('#mainbody').html(data);
            			}
        			});
				}				
			}

	</script>";
	$body = $javascript ._skin_page("default","member_edit");

	$body = str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data'>
					<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
	$body = str_replace("{formend}","</form>",$body);

		$email = $_COOKIE['cookie_email'];	
		$query = "select * from `site_members` where email='$email'";
		if($rows = _mysqli_query_rows($query)){

			// 회원 가입정보 입력  
			$radio_sex = "Man ";
			if($rows->sex == "man") $radio_sex .= "<input type='radio' name='sex' value='man' $cssFormStyle checked>";
			else $radio_sex .= "<input type='radio' name='sex' value='man' $cssFormStyle>";

			$radio_sex .= "Woman ";
			if($rows->sex == "woman") $radio_sex .= "<input type='radio' name='sex' value='woman' $cssFormStyle checked>";
			else $radio_sex .= "<input type='radio' name='sex' value='woman' $cssFormStyle>";

			$radio_sex .= "business ";
			if($rows->sex == "business") $radio_sex .= "<input type='radio' name='sex' value='business' $cssFormStyle checked>";
			else $radio_sex .= "<input type='radio' name='sex' value='business' $cssFormStyle>";

			$body = str_replace("{sex}",$radio_sex,$body);

			$body = str_replace("{email}","<input type='email' name='email' readonly value='".$rows->email."' style=\"$css_textbox\" id=\"email\">",$body);
			$body = str_replace("{email_message}","<input type='hidden' name='email_check' id=\"email_check\"><span id=\"email_message\"></span>",$body);

			$body = str_replace("{phone}","<input type='text' name='phone' required  value='".$rows->userphone."' style=\"$css_textbox\">",$body);
			$body = str_replace("{password}","<input type='password' name='password' required  value='".$rows->password."' style=\"$css_textbox\" id=\"password\">",$body);
			$body = str_replace("{manager}","<input type='text' name='manager' required  value='".$rows->manager."' style=\"$css_textbox\">",$body);
			$body = str_replace("{firstname}","<input type='text' name='firstname' required  value='".$rows->firstname."' style=\"$css_textbox\">",$body);
			$body = str_replace("{lastname}","<input type='text' name='lastname' required  value='".$rows->lastname."' style=\"$css_textbox\">",$body);
		
			$body = str_replace("{city}","<input type='text' name='city' value='".$rows->city."' style=\"$css_textbox\">",$body);
			$body = str_replace("{state}","<input type='text' name='state' value='".$rows->state."' style=\"$css_textbox\">",$body);	
			$body = str_replace("{post}","<input type='text' name='post' value='".$rows->post."' style=\"$css_textbox\">",$body);
			$body = str_replace("{address}","<input type='text' name='address' value='".$rows->address."' style=\"$css_textbox\">",$body);

			$body = str_replace("{company}","<input type='text' name='company' value='".$rows->company."' style=\"$css_textbox\">",$body);
			$body = str_replace("{company_num}","<input type='text' name='company_num' value='".$rows->company_num."' style=\"$css_textbox\">",$body);
			$body = str_replace("{company_item}","<input type='text' name='company_item' value='".$rows->company_item."' style=\"$css_textbox\">",$body);
			$body = str_replace("{company_subject}","<input type='text' name='company_subject' value='".$rows->company_subject."' style=\"$css_textbox\">",$body);

			$body = str_replace("{bankname}","<input type='text' name='bankname' value='".$rows->bankname."' style=\"$css_textbox\">",$body);
			$body = str_replace("{bankuser}","<input type='text' name='bankuser' value='".$rows->bankuser."' style=\"$css_textbox\">",$body);
			$body = str_replace("{banknum}","<input type='text' name='banknum' value='".$rows->banknum."' style=\"$css_textbox\">",$body);
			///
	
			$body = str_replace("{country}",_form_select_country("members_country","",$rows->country,$css_textbox),$body);
			$body = str_replace("{language}",_form_select_language("members_language",$rows->language,$css_textbox),$body);



		}

	

	$body = str_replace("{members_submit}","<input type='button' name='reg' value='수정' onClick=\"javascript:members_submit()\" style=\"$css_btn_gray\">",$body);
		

		echo $body;



?>
