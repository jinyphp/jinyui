<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.29 : 코드수정

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
	
	// 카테고리에 대한 자바스크립트 함수 정의
	$javascript = "<script>
		function reseller_mode(mode,uid){
			var url = \"ajax_reseller_editup.php?uid=\"+uid+\"&mode=\"+mode;
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
		}

        // 리셀러 생성 및 수정
        function reseller_edit(mode,uid){
        	var url = \"reseller_edit.php\";
			var form = document.reseller;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			form.submit();	
        }

        // 리셀러 가입이동
        function reseller_reg(mode,uid){
        	location.replace(\"reseller_regist.php\");
        }

        // 리셀러 승인
        function reseller_renewal(mode){
        	var url = \"reseller_renewal.php?mode=\"+mode;
        	location.replace(url);
        }

        // 회원 이머니 목록
        function emoney_list(email){
        	var url = \"/members/site_members_emoney.php?email=\"+email;
        	location.replace(url);	
        }
        </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

		$body = $javascript._theme_page($site_env->theme,"service_reseller",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,158),$body);

		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);

		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","국가별 체널프로그램") ,$body);
		

		
		// $query = "select * from service.reseller where email = '".$_COOKIE['cookie_email']."'";
		if($myinfo_rows = _service_resellerRows($_COOKIE['cookie_email'])){

			$members = _members_rows($_COOKIE['cookie_email']); //회원 정보 

			// 리셀러 이름
			$body = str_replace("{name}","<a href='#' onclick=\"javascript:reseller_edit('edit','".$myinfo_rows->Id."')\" >".$myinfo_rows->name."</a> ( <a href='#' onclick=\"javascript:reseller_edit('edit','".$myinfo_rows->Id."')\" >".$myinfo_rows->email."</a>  )",$body);

			// 리셀러 보유 이머니
			$body = str_replace("{emoney}","<a href='#' onclick=\"javascript:emoney_list('".$members->email."')\" >".number_format($members->emoney,0,'.',',')."</a>원",$body);

			if($myinfo_rows->auth_req){
				// 신규리셀러 : 현재 리셀러의 서브로 생김
				$button ="<input type='button' value='리셀러추가' onclick=\"javascript:reseller_edit('sub','".$myinfo_rows->Id."')\" style=\"".$css_btn_gray."\" >";          
				$body = str_replace("{new}",$button,$body);
				
			} else {
				// 현재 내 리셀러가 미승인 경우에는, 신규서브 리셀러를 생성할 수 없음.
				$body = str_replace("{new}","<input type='button' value='승인대기중' style=\"".$css_btn_gray."\" >",$body);
			}

		} else {
			$body = str_replace("{name}","",$body);
			$body = str_replace("{emoney}","0원",$body);

			// 리셀러가 없는 경우, 리셀러 가입으로 처리
			$button ="<input type='button' value='리셀러가입' onclick=\"javascript:reseller_reg('reseller','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);
		}


		$button ="<input type='button' value='가입승인' onclick=\"javascript:reseller_renewal('resellerRegist')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{regist_check}",$button,$body);

		$button ="<input type='button' value='연장승인' onclick=\"javascript:reseller_renewal('resellerRenewal')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{renewal_check}",$button,$body);

	
		///////////////////////////////


		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30' >승인</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='10' ></td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>리셀러(이메일)</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150' >프로그램</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >등급</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >마진율</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >적립금</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>상태</td>";
		$list .= "</tr></table>";

		$body = str_replace("{reseller_list}",$list."{reseller_list}",$body);		


		$query = "select * from service.reseller where tree like '%".$_COOKIE['cookie_email']."%' order by pos desc";
		// echo $query."<br>";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$reseller = $rowss[$i];

				



				$LevelSpace = NULL;
				for($j=$myinfo_rows->level;$j<$reseller->level;$j++) $LevelSpace .= "&nbsp;&nbsp;&nbsp;";				
	
				//*** 트리모양 만들기
				if($reseller->level == 0) {
					$query1 = "select * from `service_reseller` where ref = '0' and pos > '".$reseller->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
								
				} else {
					$query1 = "select * from `service_reseller` where ref = '0' and pos > '".$reseller->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth = "┃"; else $depth = "&nbsp;&nbsp;&nbsp;";

					for($k=0;$k<$reseller->level;$k++) $depth .= "&nbsp;&nbsp;&nbsp;";
						
					$query1 = "select * from `service_reseller` where ref = '".$reseller->ref."' and pos > '".$reseller->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
				}			

				$sub_new = "<a href='#' onclick=\"javascript:reseller_edit('sub','".$reseller->Id."')\" > <i class=\"fa fa-plus-square-o\" aria-hidden=\"true\"></i> </a>";
				$reseller_name = "$depth $sub_new <a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller->Id."')\" >".$reseller->name." (".$reseller->email.")</a>";
				

				$members = _members_rows($reseller->email); //회원 정보 
				$emoney = "<a href='#' onclick=\"javascript:emoney_list('".$members->email."')\">".$members->emoney."</a>";

				if($reseller->auth_req){
					// 입금 승인 요청건 검사
					$query1 = "select * from `service_reseller_emoney` where email = '".$reseller->email."' and check_auth ='on'";
					if($reseller1 = _mysqli_query_rows($query1)){
						$status = "<b> <a href='#' onclick=\"javascript:emoney_check('check','".$reseller1->Id."')\">입출금 확인</a> </b>";						
					} else {
						$status = $reseller->expire;
					}			

				} else {
					$status = "<b>승인요청</b>";
				}

				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				
				if($reseller->enable) $list .= "<td width='10' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> <a href='#' onclick=\"javascript:reseller_mode('disable','".$reseller->Id."')\">▣</a></td>";
				else $list .= "<td width='10' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> <a href='#' onclick=\"javascript:reseller_mode('enable','".$reseller->Id."')\">□</a></td>";

				if($program_rows = _service_resellerProgramRows_Id($reseller->program)){
					$program_name = $program_rows->title;
				} else {
					$program_name = "unknown";
				}


				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='10'>".$reseller->pos."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> $reseller_name </td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$program_name."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$reseller->level."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$reseller->margin."%</td>";				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>$emoney</td>";				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> $status </td>";			
				$list .= "</tr></table>";

				
			}
			// echo $list;
			$body = str_replace("{reseller_list}",$list,$body);
			
		} else {
			$msg = "리셀러 목록 없습니다.";
			$body = str_replace("{reseller_list}",$msg,$body);

		}	
	
		
		echo $body;
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>