<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

	// update : 2016.01.15 = 생성
	// update : 2016.03.10 = 상품설정 가격 표시 부분 및 입력란 정리


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

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");


	$javascript = "<script>
		
		$('input:radio[name=plan]').change(function(){
		 	var plan = $('input:radio[name=plan]:checked').val();
		 	var setup_id = \"#setup\" + plan;
		 	// alert(setup_id);

		 	var setup = $(setup_id).val();
		 	$('#plan_setup').val(setup);

		 	var charge_id = \"#charge\" + plan;
		 	var charge = $(charge_id).val();
		 	$('#plan_charge').val(charge);

		 	var priod = $('#priod').val();
		 	if(priod == '1' ) {
		 		var amount = Number(setup) + Number(charge) * Number(priod) ;
		 	} else if(priod == '3' ) {
		 		var amount = Number(setup) + Number(charge) * Number(priod) * 0.95;
		 	} else if(priod == '6' ) {
		 		var amount = Number(setup) + Number(charge) * Number(priod) * 0.9;
		 	} else if(priod == '12' ) {
		 		var amount = Number(setup) + Number(charge) * Number(priod) * 0.85;
		 	}	
		 	
		 	$('#amount').val(amount);

    	});
    	

    	
		$('#priod').on('change',function(){
			var plan = $('input:radio[name=plan]:checked').val();
			var priod = $('#priod').val();
			var charge = $('#plan_charge').val();
			// alert(charge);
			var setup = $('#plan_setup').val();
			if(plan){
				if(priod == '1' ) {
					var amount = Number(setup) + Number(charge) * Number(priod) ;
					$('#discount').html(\"\");

				} else if(priod == '3' ) {
					var amount = Number(setup) + Number(charge) * Number(priod) * 0.95;
					$('#discount').html(\"5%\");

				} else if(priod == '6' ) {
					var amount = Number(setup) + Number(charge) * Number(priod) * 0.9;
					$('#discount').html(\"10%\");

				} else if(priod == '12' ) {
					var amount = Number(setup) + Number(charge) * Number(priod) * 0.85;
					$('#discount').html(\"15%\");

				}

				$('#amount').val(amount);
			} else {
				alert(\"서비스 호스팅 타입을 선택해 주세요.\");
			}
			
		});
		

		
		function form_submit(mode,uid){

			var program = $('input:radio[name=plan]:checked').val();
			var code = $('#service_code').val();
        	var email = $('#email').val();
        	var password = $('#password').val();
        	var phone = $('#phone').val();

        	if(!program){
        		alert(\"서비스를 선택해 주세요.\");	
        	} else if(!code){
				alert(\"아이디를 입력해 주세요.\");
			} else if(!email){
				alert(\"이메일을 입력해 주세요.\");
			} else if(!password){
				alert(\"패스워드를 입력해 주세요.\");
			} else if(!phone){
				alert(\"연락처를 입력해 주세요.\");
        	} else {	
        		var url = \"ajax_service_newup.php?uid=\"+uid+\"&mode=\"+mode;
				$.ajax({
            		url:url,
              		type:'post',
              		data:$('form').serialize(),
               		success:function(data){
                   		$('#mainbody').html(data);
               		}
           		});
       		} 
	 					
		}		

	</script>";

	
	$title_bgcolor = "#8f44ad";
	$site_reseller = "infohojin@naver.com";
	$body = $javascript._theme_page($site_env->theme,"service_new",$site_language,$site_mobile);
	$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);

	$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
	$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'>
										<input type='hidden' name='reseller' value='".$site_reseller."'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
	$body = str_replace("{formend}","</form>",$body);


	//
	// 서비스 호스팅 플랜 목록을 출력함. 
	
	$query = "select * from service.hosting_plan where reseller = '".$site_reseller."'"; //" order by level asc";
	if($rowss = _mysqli_query_rowss($query)){	
			
		$width = 100 / count($rowss);
			
		for($i=0; $i<count($rowss); $i++){
			$rows = $rowss[$i];
			
			$from_reseller_grade = "<input type='radio' name='plan' value='".$rows->Id."' >";
			$from_reseller_grade .= "<input type=hidden name='setup".$rows->Id."' value='".$rows->setup."'  id=\"setup".$rows->Id."\">";
			$from_reseller_grade .= "<input type=hidden name='charge".$rows->Id."' value='".$rows->charge."'  id=\"charge".$rows->Id."\">";

			// 타이틀 이미지
			// $id,$css,$content
			$cell  = _html_div("serviceNew_title","",$rows->title);

			// 설명
			$cell .= _html_div("","background-color:#bec3c7;height:50px;padding-left:25px;padding-right:25px;padding-top:10px;padding-bottom:10px;",$rows->description);
			$cell .= _html_div("","background-color:#bec3c7;text-align:center;padding-top:5px;padding-bottom:5px;","선택 ".$from_reseller_grade);			
			$cell .= _html_div("","background-color:#bec3c7;text-align:center;padding-top:5px;padding-bottom:5px;","가입비용 ".number_format($rows->setup,0,'.',',')."원");
			$cell .= _html_div("","background-color:#bec3c7;text-align:center;padding-top:5px;padding-bottom:20px;","월 비용 ".number_format($rows->charge,0,'.',',')."원");
			

			if($i == 0) $list .= _html_div("","float:left;width:$width%;",_html_div("","border:1px solid #DDDCD8;",$cell));
			else $list .= _html_div("","float:left;width:$width%;",_html_div("","border-top:1px solid #DDDCD8;border-bottom:1px solid #DDDCD8;border-right:1px solid #DDDCD8",$cell));	
			
				
		}
		// echo $list;
		$body = str_replace("{hosting_plan}","
			<center>
				<div style=\"width:1150px\" id=\"partner_program\">".$list."</div>
			</center>",$body);

	} else {
		$msg = "서비스 플랜이 없습니다.";
		$body = str_replace("{hosting_plan}",$msg,$body);
	}
	
	
	// ++ 신청 정보 

				
	$body = str_replace("{form_submit}","<input type='button' value='가입신청' onclick=\"javascript:form_submit('regist','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

	$priod = "<select name='priod' id=\"priod\" style=\"$css_textbox\">
				<option value='1'>1개월</option>
				<option value='3'>3개월(5%할인)</option>
				<option value='6'>6개월(10%할인)</option>
				<option value='12'>12개월(15%할인)</option>
			</select>";
	$body = str_replace("{priod}",$priod,$body);

	$body = str_replace("{setup}","<input type='text' name='setup' readonly value='' style=\"$css_textbox\" id=\"plan_setup\">",$body);
	$body = str_replace("{charge}","<input type='text' name='charge' readonly style=\"$css_textbox\" id=\"plan_charge\">",$body);
	$body = str_replace("{amount}","<input type='test' name='amount' readonly value='' style=\"$css_textbox\" id=\"amount\">",$body);

	$body = str_replace("{email}","<input type='email' name='email' value='' style=\"$css_textbox\" id=\"email\">",$body);
	$body = str_replace("{password}","<input type='password' name='password' value='' style=\"$css_textbox\" id=\"password\">",$body);
	$body = str_replace("{phone}","<input type='text' name='phone' value='' style=\"$css_textbox\" id=\"phone\">",$body);
		
	$body = str_replace("{service_code}","<input type='text' name='service_code' value='' style=\"$css_textbox\" id=\"service_code\">",$body);
	$body = str_replace("{domain}",_form_text("domain","",$css_textbox),$body);
	$body = str_replace("{name}",_form_text("name","",$css_textbox),$body);
	$body = str_replace("{code_check}","<input type='hidden' name='code_check' id=\"code_check\"><span id=\"code_message\"></span>",$body);
	$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'></textarea>",$body);	

	$body = str_replace("{partner}",_form_text("partner","",$css_textbox),$body);
		



	// ++ 타이틀 이미지 전처리기 코드를 처리하여, 이미지를 진열함
	// ++ 출력, Body {titleimg_ 갯수를 분석, 갯수 많큼 처리
	$keyword = "titleimg_";
	if($keyword_count = _keyword_count($body, "{".$keyword)){
		$rows = _keyword_rows($body, "{".$keyword, $keyword_count);	// Body 에서 코드값을 파싱하여 읽어옴.
		for($i=0;$i<count($rows);$i++){		// 전처리 코드값 많큼 Ajax 처리..
			$class = $keyword.$rows[$i];
			// CSS id = 기능구분
			// CSS class = 세부 설정값 
			$body = str_replace("{".$class."}","<article class=\"$class\" id=\"title_images\" style='z-index:3;'>
					<center><img src='./images/loading.gif' border='0'></center>
					<script>"._javascript_ajax_html(".".$class,"/ajax_index_titleimg.php?code=$rows[$i]")."</script>
					</article>\n",$body);
		}
	}


	echo $body;

	
		


?>