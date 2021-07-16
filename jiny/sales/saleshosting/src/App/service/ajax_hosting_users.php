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

		function edit(mode,uid){

			var url = \"hosting_users_edit.php\";
			var form = document.hosting;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			form.submit();
	
        }
                
        function list(limit){
            var url = \"ajax_hosting_users.php?limit=\"+limit;
            ajax_html(\"#mainbody\",url);
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
			// 리셀러 : 서비스 고객 
			$body = $javascript._theme_page($site_env->theme,"service_hosting_users",$site_language,$site_mobile);
			$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);	

			$mode = _formmode();
			$limit = _formdata("limit"); 

			$_block_num = 10;
			if(!$_list_num = _formdata("list_num")) $_list_num = 10;
			$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
			$body = str_replace("{formstart}","<form id=\"data\" name='hosting' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='uid' id=\"uid\">
					   			<input type='hidden' name='mode' id=\"mode\">
					   			<input type='hidden' name='limit' id=\"limit\">",$body);
			$body = str_replace("{formend}","</form>",$body);

			$button ="<input type='button' value='신규고객' onclick=\"javascript:edit('new','0')\" id=\"css_btn_gray\">";          
			$body = str_replace("{new}",$button,$body);

		
			$searchkey = _formdata("searchkey");
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
			$body = str_replace("{search}",$button_search,$body);
		

			$query = "select * from service.service_host where reseller = '$email' ";
			if($searchkey) $query .= " and email like '%".$searchkey."%' ";		
			$query .= "order by Id desc ";
		
			$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

			// 검색된 데이터 내에서 , limit 설정 
			if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
			// echo $query;

			if($rowss = _mysqli_query_rowss($query)){

				$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>등록일자</td>
							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>서비스</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이름</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >이메일</td>							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>적립금</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>서버</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>만기일</td>
							</tr>
						</table>";

				if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
				for($i=0;$i<$count;$i++){
					$rows = $rowss[$i];

					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->email."</a>";
					$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
					$users = _members_rows($rows->email);

					$hostingPlan = _service_hostingPlanRows_Id($rows->plan);
					$hostingPlanTitle = $hostingPlan->title;

					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>".$rows->regdate."</td>
							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$hostingPlanTitle."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->name."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>
							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$users->emoney."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->hostname."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->expire."</td>
							</tr>
						</table>";

				}

				$list .= _pagination($_list_num,$_block_num,$limit,$total);
				$body = str_replace("{list}",$list,$body);
		
			} else {
				$msg = "서비스 고객이 없습니다.";
				$body = str_replace("{list}",$msg,$body);		
			}	

		} else {
			/*
			$body = $javascript._skin_page($skin_name,"reseller_users");

			$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$button ="<input type='button' value='리셀러 신청' onclick=\"javascript:reseller_new('new','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);


			$msg = "리셀러 회원만 고객관리가 가능합니다.";
			$body = str_replace("{list}",$msg,$body);
			*/	
		}

		echo $body;
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	function _service_hostingUsers_listHeader(){
		global $site_mobile;

		if($site_mobile == "m"){
			$header = _service_hostingUsers_listHeader_m();
		} else {
			$header = _service_hostingUsers_listHeader_pc();
		}

		return $header;
	}

	function _service_hostingUsers_listHeader_pc(){
		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>등록일자</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>서버</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이름</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >이메일</td>							
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>적립금</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>만기일</td>
					</tr>
				</table>";
		return $list;				
	}

	function _service_hostingUsers_listHeader_m(){
		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>등록일자</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>서버</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이름</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >이메일</td>							
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>적립금</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>만기일</td>
					</tr>
				</table>";
		return $list;				
	}

	
?>