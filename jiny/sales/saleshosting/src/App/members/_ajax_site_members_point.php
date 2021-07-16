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

	// 카테고리에 대한 자바스크립트 함수 정의
	$javascript = "<script>
		function point_auth(mode,uid,limit){
			var url = \"ajax_site_members_point.php\";
			var form = document.site;
        	form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;	

			ajax_html('#mainbody',url);	
		}	

		function point_pay(mode,uid,limit){
			var url = \"ajax_site_members_point_edit\";
        	var form = document.site;
        	form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;

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

		// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.site.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});


    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

      
		// $body = $javascript._skin_page($skin_name,"site_members_point");
		$body = $javascript._theme_page($site_env->theme,"site_members_point",$site_language,$site_mobile);

		$email = $_COOKIE['cookie_email'];
		$emoney = _formdata("emoney");
	
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		$users = _formdata("users");
	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
								<input type='hidden' name='users' value='$users'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);
		

		//$mem_rows = _members_id_rows($uid);
		$query = "select * from `site_members` WHERE `Id`='$uid'";
		//echo $query."<br>";
		if($members_rows = _sales_query_rows($query)){	
		}	

		$body = str_replace("{email}",$members_rows->email,$body);
    
		$body = str_replace("{new}","<input type='button' value='NEW' onclick=\"javascript:point_edit('new','0','".$uid."')\" id=\"".$css_btn_gray."\" >",$body);

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$query = "select * from `site_members_point` WHERE `email`='".$members_rows->email."' order by Id desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
				$list .= "<td style='font-size:12px;padding:10px;' width=150>".$rows->regdate."</td>";
				$list .= "<td style='font-size:12px;padding:10px;'><a href='#' onclick=\"javascript:point_edit('edit','".$rows->Id."','".$uid."')\" >".$rows->title."</a></td>";
				$list .= "<td style='font-size:12px;padding:10px;' width=50>".$rows->point."</td>";
				$list .= "<td style='font-size:12px;padding:10px;' width=100>= ".$rows->balance."</td>";
				$list .= "</tr></table>";
				
			}
			// echo $list;
			$body = str_replace("{point_list}",$list,$body);

		} else {
			$msg = "포인트 내역이 없습니다.";
			$body = str_replace("{point_list}",$msg,$body);
		}	
		
		$body = str_replace("{point_edit}","<span id=\"point_edit\"></span>",$body);	

		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		$msg = _string($msg,$site_language);
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>