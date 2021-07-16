<?
	//*  OpenShopping V2.1
	//*  programing by hojin lee

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hosting.php");
	
	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/service/service.php");
	
	

	

	$javascript = "<script>
		function hosting_new(){
			var email = $('#email').val();

			var db_address = $('#db_address').val();
			var db_database = $('#db_database').val();
			var db_id = $('#db_id').val();
			var db_password = $('#db_password').val();


			if(!email){
				alert(\"서비스 가입 이메일이 없습니다.\");
			} else if(!db_address){
				alert(\"테이터베이스 서버 주소를 입력해 주세요.\");
			} else if(!db_database){
				alert(\"테이터베이스 이름을 입력해 주세요.\");
			} else if(!db_id){
				alert(\"테이터베이스 계정ID 입력해 주세요.\");
			} else if(!db_password){
				alert(\"테이터베이스 계정암호를 입력해 주세요.\");		
			} else {
				var url = \"ajax_hosting_users_newup.php\";

				var maskHeight = $(document).height();  
				var maskWidth = $(window).width();

				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
				// 팡법창 크기 계산
				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				// popup_size(1000,500);
				var width = 800;
				var height = 300;
				var left = ($(window).width() - width )/2;
				var top = ( $(window).height() - height )/2;			
				$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 			  
    
    			//마스크의 투명도 처리
    			$('#popup_mask').fadeTo(\"slow\",0.8); 
				$('#popup_body').show();

				// 팝업 내용을 Ajax로 읽어옴				
				$.ajax({
            		url:url,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#popup_body').html(data);

                		var maskHeight1 = $(document).height();  
						var maskWidth1 = $(window).width();

						//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
						$('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
            		}
        		}); 
			}
		}

		function form_submit(mode,uid){
			var url = \"ajax_hosting_users_editup.php?mode=\"+mode+\"&uid=\"+uid;
			var email = $('#email').val();			
			if(email){
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
			} else {
				alert(\"서비스 가입 이메일이 없습니다.\");
			}					
		}

		function user_renewal(mode,uid){
			var url = \"ajax_hosting_users_editup.php?mode=\"+mode+\"&uid=\"+uid;
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

    	
		// $body = $javascript._skin_page($skin_name,"hosting_users_edit");
		$body = $javascript._theme_page($site_env->theme,"service_hosting_users_edit",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);

	
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");


		$body=str_replace("{formstart}","<form id='data' name='reseller' method='post' enctype='multipart/form-data'> 							
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);




		if($uid) {
			$query = "select * from service.service_host WHERE Id = $uid";
			$rows = _mysqli_query_rows($query);
			
			$body = str_replace("{btn_renewal}","<input type='button' value='연장신청' onclick=\"javascript:user_renewal('hostingRenewal','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);
			
			$form_submit .= "<input type='button' value='수정' onclick=\"javascript:form_submit('edit','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" > ";
			$body = str_replace("{form_submit}",$form_submit,$body);

		} else {
			$body = str_replace("{btn_renewal}","",$body);
			
			$form_submit .= "<input type='button' value='생성' onclick=\"javascript:hosting_new()\" style=\"".$css_btn_gray."\" >  ";
			$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);
		}


		
		// 만기 연장 버튼
		$body = str_replace("{expire}",$rows->expire,$body);
		$body = str_replace("{renewal}",$rows->renewal,$body);
		$body = str_replace("{paydate}",$rows->paydate,$body);
		$body = str_replace("{payway}",$rows->payway,$body);
		$body = str_replace("{paymoney}",$rows->paymoney,$body);
		



		if($rows->reseller) {
			$body = str_replace("{reseller}",$rows->reseller."<input type='hidden' name='reseller' value='".$rows->reseller."'>",$body);
		} else {
			$body = str_replace("{reseller}",$_COOKIE['cookie_email']."<input type='hidden' name='reseller' value='".$_COOKIE['cookie_email']."'>",$body);
		}

		$body = str_replace("{secure_key}",$rows->adminkey,$body);

		
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);


		$body = str_replace("{email}","<input type='text' name='email' value='".$rows->email."' style=\"$css_textbox\" id=\"email\">",$body);
		$body = str_replace("{name}",_form_text("name",$rows->name,$css_textbox),$body);
		$body = str_replace("{domain}",_form_text("domain",$rows->domain,$css_textbox),$body);


		
		
		$body = str_replace("{db_server}",_service_serverRows_OnSelect($rows->server,$rows->reseller),$body);
		// $body = str_replace("{db_server}",_form_text("db_server",$rows->server,$css_textbox),$body);

		$body = str_replace("{db_address}","<input type='text' name='db_address' value='".$rows->hostname."' style=\"$css_textbox\" id=\"db_address\">",$body);
		$body = str_replace("{db_database}","<input type='text' name='db_database' value='".$rows->database."' style=\"$css_textbox\" id=\"db_database\">",$body);
		$body = str_replace("{db_id}","<input type='text' name='db_id' value='".$rows->user."' style=\"$css_textbox\" id=\"db_id\">",$body);
		$body = str_replace("{db_password}","<input type='text' name='db_password' value='".$rows->password."' style=\"$css_textbox\" id=\"db_password\">",$body);


		// $body = str_replace("{title}",_form_text("title",$rows->title,$css_textbox),$body);
		$body = str_replace("{hostingPlan}", _service_hostingPlanRows_OnSelect($rows->plan),$body);

		$body = str_replace("{site}",_form_text("site",$rows->site,$css_textbox),$body);
		$body = str_replace("{shop}",_form_text("shop",$rows->shop,$css_textbox),$body);
		$body = str_replace("{sales}",_form_text("sales",$rows->sales,$css_textbox),$body);
		$body = str_replace("{company}",_form_text("company",$rows->company,$css_textbox),$body);
		$body = str_replace("{business}",_form_text("business",$rows->business,$css_textbox),$body);
		$body = str_replace("{trans}",_form_text("trans",$rows->trans,$css_textbox),$body);
		$body = str_replace("{house}",_form_text("house",$rows->house,$css_textbox),$body);
		$body = str_replace("{manager}",_form_text("manager",$rows->manager,$css_textbox),$body);
		$body = str_replace("{taxprint}",_form_text("taxprint",$rows->taxprint,$css_textbox),$body);
		$body = str_replace("{quotation}",_form_text("quotation",$rows->quotation,$css_textbox),$body);

		$body = str_replace("{setup}",_form_text("setup",$rows->setup,$css_textbox),$body);
		$body = str_replace("{charge}",_form_text("charge",$rows->charge,$css_textbox),$body);
		
		// $body = str_replace("{description}",_form_text("description",$rows->description,$css_textbox),$body);
		$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->description)."</textarea>",$body);	


		echo $body;

		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	

?>