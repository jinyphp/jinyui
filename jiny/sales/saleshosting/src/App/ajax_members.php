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
			$('input:radio[name=sex]').change(function(){
		 		var sex = $('input:radio[name=sex]:checked').val();
        		
        		if(sex == \"business\"){
        			$('#company_form').show();
        			// alert(sex);
        		} else $('#company_form').hide();
    		}); 

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

	</script>";
	// $body = $javascript ._skin_page("default","member_new");
	$body = $javascript._theme_popup($site_env->theme,"member_new",$site_language,$site_mobile);


	// 회원 가입정보 입력  
	$form_sex = "<input type='radio' name='sex' value='man' $cssFormStyle> Man /";
	$form_sex .= "<input type='radio' name='sex' value='woman' $cssFormStyle> Woman /";
	$form_sex .= "<input type='radio' name='sex' value='business' $cssFormStyle>Business ";
	$body = str_replace("{sex}",$form_sex,$body);

	$body = str_replace("{email}","<input type='email' name='email' autofocus required style=\"$css_textbox\" id=\"email\">",$body);
	$body = str_replace("{email_message}","<input type='hidden' name='email_check' id=\"email_check\"><span id=\"email_message\"></span>",$body);

	$body = str_replace("{phone}","<input type='text' name='phone' required  style=\"$css_textbox\">",$body);
	$body = str_replace("{password}","<input type='password' name='password' required  style=\"$css_textbox\" id=\"password\">",$body);
	$body = str_replace("{manager}","<input type='text' name='manager' required  style=\"$css_textbox\">",$body);
	$body = str_replace("{firstname}","<input type='text' name='firstname' required  style=\"$css_textbox\">",$body);
	$body = str_replace("{lastname}","<input type='text' name='lastname' required  style=\"$css_textbox\">",$body);
		
	$body = str_replace("{city}","<input type='text' name='city' style=\"$css_textbox\">",$body);
	$body = str_replace("{state}","<input type='text' name='state' style=\"$css_textbox\">",$body);	
	$body = str_replace("{post}","<input type='text' name='post' style=\"$css_textbox\">",$body);
	$body = str_replace("{address}","<input type='text' name='address' style=\"$css_textbox\">",$body);

	$body = str_replace("{company}","<input type='text' name='company' style=\"$css_textbox\">",$body);
	$body = str_replace("{company_num}","<input type='text' name='company_num' style=\"$css_textbox\">",$body);
	$body = str_replace("{company_item}","<input type='text' name='company_item' style=\"$css_textbox\">",$body);
	$body = str_replace("{company_subject}","<input type='text' name='company_subject' style=\"$css_textbox\">",$body);

	///
	
	

	$body = str_replace("{country}",_form_select_country("members_country","",$site_country,$css_textbox),$body);
	

	$body = str_replace("{language}",_form_select_language("members_language",$site_language,$css_textbox),$body);

	$body = str_replace("{members_submit}","<input type='button' name='reg' value='가입' onClick=\"javascript:members_submit()\" style=\"$css_btn_gray\">",$body);
		

		echo $body;



?>
