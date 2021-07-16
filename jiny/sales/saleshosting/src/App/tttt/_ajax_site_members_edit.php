<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	//*  세일즈호스팅 서비스 정보 표시

	// update : 2016.01.15 = 생성

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

	include "./func/error.php";	
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/members.php";


	
	$javascript = "<script>

		function form_submit(mode,uid){
			var url = \"/ajax_site_members_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#data')[0]);
			//alert(url);
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
			var url = \"/ajax_site_members_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('3mainbody').html(data);
                }
            });
		}
	</script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		
		$body = $javascript._skin_page($skin_name,"site_members_edit");

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$cate = _formdata("cate");
		

		
		$body=str_replace("{formstart}","<form id='data' name='members' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		$query = "select * from `site_members` where Id='$uid'";
		if($rows = _sales_query_rows($query)){
			$body = str_replace("{form_submit}","
			<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
			",$body);
		} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
			$body = str_replace("{form_submit}",$script."
			<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
			",$body);
			
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
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>