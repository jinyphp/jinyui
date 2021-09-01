<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	//*  세일즈호스팅 서비스 정보 표시

	// update : 2016.01.15 = 생성

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

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/login/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/orders.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/butten.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/members.php");	

	
	$javascript = "<script>

		function form_submit(mode,uid){
			var url = \"ajax_site_members_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#mainbody').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});		
		}

		function form_delete(mode,uid){
			var url = \"ajax_site_members_editup.php?uid=\"+uid+\"&mode=\"+mode;
			ajax_html('#mainbody',url);	
		}
	</script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		/////////////
		// $body = $javascript._skin_page($skin_name,"site_members_edit");
		$body = $javascript._theme_page($site_env->theme,"site_members_edit",$site_language,$site_mobile);

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		
		$body=str_replace("{formstart}","<form id='data' name='members' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>
										<input type='hidden' name='list_num' value='$list_num'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		$query = "select * from `site_members` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			$form_submit = "<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >  ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit ,$body);
		} else {
			$form_submit = "<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$script.$form_submit,$body);
			
		}	
		

		
		
		if($rows->auth)
		$body = str_replace("{enable}","<input type='checkbox' name='enable' checked>",$body);
		else $body = str_replace("{enable}","<input type='checkbox' name='enable'>",$body);



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

		$body = str_replace("{email}",_form_text("email",$rows->email,$css_textbox),$body);

		$body = str_replace("{phone}",_form_text("phone",$rows->phone,$css_textbox),$body);

		$body = str_replace("{password}",_form_text("password",$rows->password,$css_textbox),$body);

		$body = str_replace("{manager}",_form_text("manager",$rows->username,$css_textbox),$body);
		$body = str_replace("{firstname}",_form_text("firstname",$rows->firstname,$css_textbox),$body);

		$body = str_replace("{city}",_form_text("city",$rows->city,$css_textbox),$body);
		$body = str_replace("{state}",_form_text("state",$rows->state,$css_textbox),$body);
		$body = str_replace("{post}",_form_text("post",$rows->post,$css_textbox),$body);
		$body = str_replace("{address}",_form_text("address",$rows->address,$css_textbox),$body);

		
		///
	
		$body = str_replace("{country}",_form_select_country("members_country","",$rows->country,$css_textbox),$body);
		$body = str_replace("{language}",_form_select_language("members_language",$rows->language,$css_textbox),$body);

		$body = str_replace("{discount}",_form_text("dicount",$rows->discount,$css_textbox),$body);

		$body = str_replace("{point}",_form_text("point",$rows->point,$css_textbox),$body);
		$body = str_replace("{emoney}",_form_text("emoney",$rows->emoney,$css_textbox),$body);

		$body = str_replace("{regref}",_form_text("regref",$rows->regref,$css_textbox),$body);

		$body = str_replace("{regdate}",$rows->regdate,$body);
		$body = str_replace("{lastlog}",$rows->lastlog,$body);

		echo $body;


	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}


	
?>