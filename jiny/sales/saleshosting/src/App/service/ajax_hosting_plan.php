<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

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
	
	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/service/service.php");

	$javascript = "<script>

		function edit(mode,uid,limit){
			var url = \"hosting_plan_edit.php\";
			var form = document.hosting;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }

        function list(limit){
			var url = \"ajax_hosting_plan.php\";
        	var form = document.hosting;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);
    	}

    	// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.hosting.chk_all.checked == true) chk[i].checked = true;
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

		// 서비스 관련 함수들 
		include "service_function.php";
		
		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];	
		if($reseller = _service_resellerRows($email)){
			// $body = $javascript._skin_page($skin_name,"hosting_plan");
		$body = $javascript._theme_page($site_env->theme,"service_hosting_plan",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);	
		

		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form id=\"data\" name='hosting' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='uid' id=\"uid\">
					   			<input type='hidden' name='mode' id=\"mode\">
					   			<input type='hidden' name='limit' id=\"limit\">
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);
		





		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];	
		$query = "select * from service.hosting_plan where reseller = '$email' ";
		if($searchkey) $query .= " and title like '%".$searchkey."%' ";		
		$query .= "order by Id desc ";
		
		$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
			//echo $query;

			if($rowss = _mysqli_query_rowss($query)){

				$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>등록일자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >타이틀</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>설정비</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>유지비</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>회원수</td>
							</tr>
						</table>";

				if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
				for($i=0;$i<$count;$i++){
					$rows = $rowss[$i];

					$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->title."</a>";
					if(!$rows->enable) $title_name = "<span style=\"text-decoration:line-through;\">".$title_name."</span>";

					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='font-size:12px;padding:10px;' width='30'>".$tid."</td>
							<td style='font-size:12px;padding:10px;' width='100'>".$rows->regdate."</td>
							<td style='font-size:12px;padding:10px;'>".$title_name."</td>														
							<td style='font-size:12px;padding:10px;' width='80'>".$rows->setup."</td>
							<td style='font-size:12px;padding:10px;' width='80'>".$rows->charge."</td>
							<td style='font-size:12px;padding:10px;' width='80'>".$rows->count."</td>
							</tr>
						</table>";
					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>설명:</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->description."</td>
							</tr>
						</table>";	

				}


			
				$list .= _pagination($_list_num,$_block_num,$limit,$total);
				$body = str_replace("{list}",$list,$body);
		
			} else {
				$msg = "내역이 없습니다.";
				$body = str_replace("{list}",$msg,$body);		
			}	
			echo $body;

		} else {
			echo "서비스 구성은 리셀러 회원만 설정이 가능합니다. 지금 리셀러 프로그램에 가입하셔서 추가 기업수익을 만들어 보세요.";
		}
		
		
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody",$path_ajax_login)."</script>";	
		$body =  _theme_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
	}

	
?>