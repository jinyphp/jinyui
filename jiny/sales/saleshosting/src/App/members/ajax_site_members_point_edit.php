<?
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
	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");
		
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


	$javascript = "<script>
		function form_submit(mode,uid){
			var email = $('#email').val();
			var point = $('#point').val();

			if(!email){
				alert(\"회원이메일이 없습니다.\");
			} else if(!point){
				alert(\"포인트가 없습니다.\");
			} else {

				var url = \"ajax_site_members_point.php?uid=\"+uid+\"&mode=\"+mode;
				var formData = new FormData($('#popup_data')[0]);
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

				popup_close();	
			}
		}

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});
			
    </script>";

    //********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		include "site_members_function.php";

	
        $mode = _formdata("mode");	//echo "mode = ".$mode;
        $uid = _formdata("uid");
        $users = _formdata("users");

        if($site_mobile == "m") $width = "300px"; else $width = "500px";
		$title = "포인트";
		$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"site_members_point_edit",$site_language,$site_mobile) );

       

        $body = str_replace("{formstart}","<form id=\"popup_data\" name='point' method='post' enctype='multipart/form-data' >
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='uid' value='$uid'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);


        if($mode == "edit"){
        	$query = "select * from `site_members_point` where Id = '".$uid."' order by regdate desc";
			if($rows = _sales_query_rows($query)){	
			
				$body = str_replace("{email}","<input type='text' name='pay_email' value='".$rows->email."' style=\"$css_textbox\" id=\"email\">",$body);
				$body = str_replace("{point}","<input type='text' name='point' value='".$rows->point."' style=\"$css_textbox\" id=\"point\">",$body);

				if($rows->auth){
					$body = str_replace("{form_submit}","승인된 내역은 수정할 수 없습니다.",$body);
				} else {
					$form_submit = "<input type='button' value='포인트수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
					$body = str_replace("{form_submit}",$form_submit,$body);
				}

			}

        } else if($mode == "payin"){
			// 팝업창


			$body = str_replace("{email}","<input type='text' name='pay_email' value='$users' style=\"$css_textbox\" id=\"email\">",$body);
			$body = str_replace("{point}","<input type='text' name='point' style=\"$css_textbox\" id=\"point\">",$body);
	
			$form_submit = "<input type='button' value='적립' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);

        } else if($mode == "payout"){
        	// 팝업창


			$body = str_replace("{email}","<input type='text' name='pay_email' value='$users' style=\"$css_textbox\" id=\"email\">",$body);
			$body = str_replace("{point}","<input type='text' name='point' style=\"$css_textbox\" id=\"point\">",$body);

			$form_submit = "<input type='button' value='사용' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >";
			$body = str_replace("{form_submit}",$form_submit,$body);

        }

        
       
        

		echo $body;
	
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}	


	
?>
