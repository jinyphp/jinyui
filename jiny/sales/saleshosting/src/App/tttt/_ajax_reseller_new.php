<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

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
	

	$script = "<script>

		function form_submit(mode,uid){

			var program = $('input:radio[name=reseller_program]:checked').val();
        	if(program){

        		var code = $('#service_code').val();
        		if(code){
        			var url = \"/ajax_reseller_editup.php?uid=\"+uid+\"&mode=\"+mode;
					$.ajax({
               			url:url,
                		type:'post',
                		data:$('form').serialize(),
                		success:function(data){
                    		$('#mainbody').html(data);

                		}
            		});
        		} else {
        			alert(\"리셀러 아이디를 입력해 주세요.\");
        		}
				
			} else {
				alert(\"리셀러 프로그램을 선택해 주세요.\");
			}
					
		}

	</script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];	
		if($reseller = _is_reseller($email)){
		//이미 가입된 회원
			echo "가입된 회원 입니다.";
			
		} else {
		// 가입 되지 않은 회원만 처리

			$query = "select * from `service_reseller_renewal` where email ='$email'";
			if($rows = _mysqli_query_rows($query)){
				echo "이미 리셀러 신청된 회원 입니다.";
			} else {

				$body = $script._skin_page($skin_name,"reseller_new");

				$members= _members_rows($_COOKIE['cookie_email']);


				$ajaxkey = _formdata("ajaxkey");
				$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
				$body = str_replace("{formend}","</form>",$body);

				// 파트너 프로그램 표시 
				$query = "select * from `service_reseller_program` where reseller = '".$members->reseller."' order by level asc";
				if($rowss = _mysqli_query_rowss($query)){	
			
					$width = 100 / count($rowss);
			
					for($i=0; $i<count($rowss); $i++){
						$rows = $rowss[$i];
						$from_reseller_grade = "<input type=radio name=reseller_program value='".$rows->Id."'  id=\"reseller_grade\">";

						$list .= "<div style=\"float:left;width:$width%;\">";

						if($i == 0) $list .= "<div style=\"border:1px solid #DDDCD8;\">";
						else $list .= "<div style=\"border-top:1px solid #DDDCD8;border-bottom:1px solid #DDDCD8;border-right:1px solid #DDDCD8;\">";		
				
						$list .= "<div style=\"background-color:#EAE9E4;
										height:50px;
										color:#989A8F;
										text-align:center;
										text-valign:center;
										padding-top:20px;
										font-size:15px\">
							".$rows->title."
							</div>";
				
						$list .= "<div style=\"height:40px;text-align:center;padding-top:10px;\">파트너레벨 ".$rows->level."</div>";
						$list .= "<div style=\"height:40px;text-align:center;padding-top:10px;\">마진율 ".$rows->margin."%</div>";
						$list .= "<div style=\"height:40px;text-align:center;padding-top:10px;\">계약비용 ".number_format($rows->setup,0,'.',',')."원"."</div>";
						$list .= "<div style=\"height:40px;text-align:center;padding-top:10px;\">월 비용 ".number_format($rows->charge,0,'.',',')."원"."</div>";
						$list .= "<div style=\"height:40px;text-align:center;padding-top:10px;\">신청 ".$from_reseller_grade."</div>";
						$list .= "</div>";
						$list .= "</div>";
				
					}
					// echo $list;
					$body = str_replace("{partner_program}","<div id=\"partner_program\">".$list."</div>",$body);

				} else {
					$msg = "리셀러 level 목록 없습니다.";
					$body = str_replace("{partner_program}",$msg,$body);

				}
	


				$css_btn_reseller_reg ="width:200px; 
				font-size:12px; 
				color:#000000; 
				font-weight:bold; 
				background-color:#f3f3f3; 
				height:28px;	
				font-size:12px;	
				border:1px solid #d8d8d8;";
				$body = str_replace("{form_submit}","
					<input type='button' value='가입신청 & 입금확인 요청' onclick=\"javascript:form_submit('regist','".$uid."')\" style=\"".$css_btn_reseller_reg."\" >
					",$body);

				
				$query = "select * from `service_reseller` WHERE `reseller`= '".$members->reseller."' ";
				if($rows = _mysqli_query_rows($query)){	
					$body = str_replace("{bankname}",$rows->bankname,$body);
					$body = str_replace("{bankswiff}",$rows->bankswiff,$body);
					$body = str_replace("{banknum}",$rows->banknum,$body);
					$body = str_replace("{bankuser}",$rows->bankuser,$body);
				}
		
			
				$body = str_replace("{reseller_bankname}",_form_text("bankname","",$css_textbox),$body);
				$body = str_replace("{reseller_bankuser}",_form_text("bankuser","",$css_textbox),$body);
				$body = str_replace("{reseller_banknum}",_form_text("banknum","",$css_textbox),$body);


				$body = str_replace("{service_code}","<input type='text' name='service_code' value='' style=\"$css_textbox\" id=\"service_code\">"."<input type='hidden' name='reseller' value='".$rows->reseller."'>",$body);
				$body = str_replace("{domain}",_form_text("domain","",$css_textbox),$body);
				$body = str_replace("{name}",_form_text("name","",$css_textbox),$body);
				$body = str_replace("{code_check}","<input type='hidden' name='code_check' id=\"code_check\"><span id=\"code_message\"></span>",$body);
				$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->description)."</textarea>",$body);	

				echo $body;


			}

		}


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>