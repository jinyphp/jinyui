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


	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hoosting.php");

	$javascript = "<script>

		function edit(mode,uid){

			var url = \"hosting_renewal_view.php\";
			var form = document.hosting;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			form.submit();
        }
                
        function list(limit){
            var url = \"ajax_hosting_renewal.php?limit=\"+limit;
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
			
		// $body = $javascript._skin_page($skin_name,"hosting_renewal");
		$body = _theme_page($site_env->theme,"service_hosting_renewal",$site_language,$site_mobile).$javascript;	
		
	
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);

		
			$body = str_replace("{formstart}","<form name='hosting' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='uid' id=\"uid\">
					   			<input type='hidden' name='mode' id=\"mode\">
					   			<input type='hidden' name='limit' id=\"limit\">",$body);
			$body = str_replace("{formend}","</form>",$body);

			$button ="<input type='button' value='선택삭제' onclick=\"javascript:delete('delete','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{delete}",$button,$body);

			$button ="<input type='button' value='선택승인' onclick=\"javascript:auth('auth','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{auth}",$button,$body);

			$button ="<input type='button' value='선택삭제' onclick=\"javascript:disauth('disauth','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{disauth}",$button,$body);

		
			$searchkey = _formdata("searchkey");
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
			$body = str_replace("{search}",$button_search,$body);
		

			// 로그인 회원정보 읽어오기
			if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];	
			if($reseller = _is_reseller($email)){
				// 리셀러 : 하부 리셀러 관리
				$query = "select * from `service_host_renewal` where reseller = '$email' ";
			} else {
				// 미승인, 미가입 처리된 회원 = 자기 정보만 출력
				$query = "select * from `service_host_renewal` where email = '$email' ";
			}

			
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
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>등록일자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>구분</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >이메일</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>기간(M)</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>설정비용</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>유지비용</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>합계</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>처리결과</td>
							</tr>
						</table>";

				if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
				for($i=0;$i<$count;$i++){
					$rows = $rowss[$i];

					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->email."</a>";
					$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
					$users = _members_rows($rows->email);

					if($rows->auth) $auth = "승인"; else $auth ="미승인";

					// $prices = $rows->setup + $rows->charge;
					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->type."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->priod."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->setup."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->charge."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->pay_amount."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$auth."</td>
							</tr>
						</table>";

				}


			
				$list .= _pagination($_list_num,$_block_num,$limit,$total);
				$body = str_replace("{list}",$list,$body);
		
			} else {
				$msg = "신청 내역이 없습니다.";
				$body = str_replace("{list}",$msg,$body);		
			}	

		echo $body;
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>