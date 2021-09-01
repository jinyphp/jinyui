<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.29 : 코드수정

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");


	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hoosting.php");
	
	$javascript = "<script>

		function form_submit(mode,uid){
			var url = \"ajax_service_server_editup.php?uid=\"+uid+\"&mode=\"+mode;
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
			var url = \"ajax_service_server_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

		$body = $javascript._theme_page($site_env->theme,"service_server_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);


		$cookie_email = $_COOKIE['cookie_email']; // 로그인 이메일
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		$members = _members_rows($_COOKIE['cookie_email']);

		// echo $ajaxkey;
		$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>		    				
										<input type='hidden' name='uid' value='$uid'>
										<input type='hidden' name='list_num' value='$list_num'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		// echo "mode = $mode <br>";

		if($server_rows = _service_serverRows_Id($uid)){
			$form_submit = "<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);
			

		} else {
			$form_submit = "<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);

		}	
		
	

		$body = str_replace("{regdate}",$server_rows->regdate,$body);
		
		if(isset($server_row->enable)) $body = str_replace("{enable}",_form_check_enable($block_rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		if($server_rows->reseller){
			$body = str_replace("{reseller}",_form_text("reseller",$server_rows->reseller,$css_textbox),$body);
		} else {
			$body = str_replace("{reseller}",_form_text("reseller",$members->email,$css_textbox),$body);
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
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	
?>