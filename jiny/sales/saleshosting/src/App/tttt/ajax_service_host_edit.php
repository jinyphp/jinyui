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
	include "./func/orders.php";
	include "./func/butten.php";

	include "./func/css.php";
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$script = "<script>

				function form_submit(mode,uid){
					var url = \"/ajax_service_host_editup.php?uid=\"+uid+\"&mode=\"+mode;
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);

                        }
                    });
					
				}

				function form_delete(mode,uid){
					var url = \"/ajax_service_host_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);

                        }
                    });
				}
				</script>";

		$body = $script._skin_page($skin_name,"service_host_edit");


		$cookie_email = $_COOKIE['cookie_email']; // 로그인 이메일
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$cate = _formdata("cate");
		$ajaxkey = _formdata("ajaxkey");

		$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='searchkey' value='$search'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		
			
			
			$query = "select * from `service_host` WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){	
				$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			} else {
			// echo "상품 정보를 읽어 올수 없습니다.";
				$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
			}


			// 상품판매 활성화 : 비활성화시 상품노출 안됨
			if($rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);

			$body = str_replace("{email}",_form_text("email",$rows->email,$css_textbox),$body);
			$body = str_replace("{domain}",_form_text("domain",$rows->domain,$css_textbox),$body);
			$body = str_replace("{code}",_form_text("code",$rows->code,$css_textbox),$body);

			$body = str_replace("{server}",_form_text("server",$rows->server,$css_textbox),$body);
			$body = str_replace("{hostname}",_form_text("hostname",$rows->hostname,$css_textbox),$body);
			$body = str_replace("{database}",_form_text("database",$rows->database,$css_textbox),$body);
			$body = str_replace("{user}",_form_text("user",$rows->user,$css_textbox),$body);
			$body = str_replace("{password}",_form_text("password",$rows->password,$css_textbox),$body);

			$body = str_replace("{site}",_form_text("site",$rows->site,$css_textbox),$body);
			$body = str_replace("{shop}",_form_text("shop",$rows->shop,$css_textbox),$body);
			$body = str_replace("{sales}",_form_text("sales",$rows->sales,$css_textbox),$body);
			$body = str_replace("{company}",_form_text("company",$rows->company,$css_textbox),$body);
			$body = str_replace("{trans}",_form_text("trans",$rows->trans,$css_textbox),$body);

			$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->description)."</textarea>",$body);	

			echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>