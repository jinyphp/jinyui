<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.29 : 코드수정

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/css.php";
	include "./func/members.php";
	include "./func/reseller.php";
	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		//include "./sales.php";

		$script = "<script>

		function form_submit(mode,uid){
			var url = \"/ajax_service_server_editup.php?uid=\"+uid+\"&mode=\"+mode;
			$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);

                        }
            });
					
		}

		function form_delete(mode,uid){
			var url = \"/ajax_service_server_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
			$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);

                        }
            });
		}
		
		</script>";

		$body = $script._skin_page($skin_name,"service_server_edit");


		$cookie_email = $_COOKIE['cookie_email']; // 로그인 이메일
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");

		$members = _members_rows($_COOKIE['cookie_email']);

		// echo $ajaxkey;
		$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		// echo "mode = $mode <br>";

		if($mode == "edit"){
			$query = "select * from `service_server` WHERE `Id`='$uid'";
			if($server_rows = _mysqli_query_rows($query)){	
				$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			}

		} else {
			$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);

		}	
		
	

		$body = str_replace("{regdate}",$server_rows->regdate,$body);
		
		if(isset($server_row->enable)) $body = str_replace("{enable}",_form_check_enable($block_rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		if($server_rows->reseller){
			$body = str_replace("{reseller}",_form_text("reseller",$server_rows->reseller,$css_textbox),$body);
		} else {
			$body = str_replace("{reseller}",_form_text("reseller",$members->reseller,$css_textbox),$body);
		}
		


		$body = str_replace("{name}",_form_text("name",$server_rows->name,$css_textbox),$body);
		$body = str_replace("{host}",_form_text("host",$server_rows->host,$css_textbox),$body);
		$body = str_replace("{ip}",_form_text("ip",$server_rows->ip,$css_textbox),$body);

		$body = str_replace("{root}",_form_text("root",$server_rows->root,$css_textbox),$body);
		$body = str_replace("{password}",_form_text("password",$server_rows->password,$css_textbox),$body);
		$body = str_replace("{dbname}",_form_text("dbname",$server_rows->dbname,$css_textbox),$body);
		
		$body = str_replace("{location}",_form_text("location",$server_rows->location,$css_textbox),$body);
		$body = str_replace("{user_id}",_form_text("user_id",$server_rows->user_id,$css_textbox),$body);
		$body = str_replace("{user_password}",_form_text("user_password",$server_rows->user_password,$css_textbox),$body);

		$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($server_rows->description)."</textarea>",$body);	

		echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>