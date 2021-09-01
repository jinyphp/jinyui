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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

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

			// alert(url);
        	popup_ajax(url);
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

		include "site_members_function.php";

		
		// $body = $javascript._skin_page($skin_name,"site_members_point");
		$body = $javascript._theme_page($site_env->theme,"site_members_point",$site_language,$site_mobile);

	
		$email = $_COOKIE['cookie_email'];
		$point = _formdata("point");
	
		$_block_num = 10;
		$mode = _formmode();	//echo "mode = ".$mode."<br>";
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		$email = _formdata("email");
	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
								<input type='hidden' name='email' value='$email'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);


		if($mode == "auth") {
			$uid = _formdata("uid");
			if($rows = _site_memberPointRows_Id($uid)){
				if($members_rows = _site_memberRows($rows->email)){

					$balance = $members->point + $rows->point;
					$query = "UPDATE `site_members` SET `point`='$balance' where email='".$rows->email."'";
					//echo $query."<br>";
					_sales_query($query);

					$query = "UPDATE `site_members_point` SET `auth`='on', `balance`='$balance' where Id='$uid'";
					//echo $query."<br>";
					_sales_query($query);
				}
			}

		} else if($mode == "disauth") {	
			$uid = _formdata("uid");
			if($rows = _site_memberPointRows_Id($uid)){
				if($members_rows = _site_memberRows($rows->email)){

					$balance = $members->point - $rows->point;
					$query = "UPDATE `site_members` SET `point`='$balance' where email='".$rows->email."'";
					_sales_query($query);

					$query = "UPDATE `site_members_point` SET `auth`='', `balance`='$balance' where Id='$uid'";
					_sales_query($query);
				}
			}




		} else if($mode == "edit") {
			if($members_rows = _site_memberRows($email)){
				$query = "UPDATE `site_members_point` SET `point`='$point' where Id='$uid'";
				//echo $query."<br>";
				_sales_query($query);
			} else {
				$msg = "미등록 회원 이메일 입니다.";
				msg_alert($msg);
			}

		} else if($mode == "payin") {
			if($members_rows = _site_memberRows($email)){
				$email = _formdata("pay_email");
				$query = "INSERT INTO `site_members_point` (`regdate`, `email`, `type`, `title`, `point`, `balance`) 
						VALUES ('$TODAYTIME', '$pay_email', 'payin', '적립확인', '$point', '');";
				//echo $query."<br>";
				_sales_query($query);
			} else {
				$msg = "미등록 회원 이메일 입니다.";
				msg_alert($msg);
			}
		} else if($mode == "payout") {
			if($members_rows = _site_memberRows($email)){
				$email = _formdata("pay_email");
				$query = "INSERT INTO `site_members_point` (`regdate`, `email`, `type`, `title`, `point`, `balance``) 
						VALUES ('$TODAYTIME', '$pay_email', 'payout', '차감요청', '$point', '');";
				//echo $query."<br>";
				_sales_query($query);
			} else {
				$msg = "미등록 회원 이메일 입니다.";
				msg_alert($msg);
			}
		}


		$body = str_replace("{pay_out}","<input type='button' value='차감신청' onclick=\"javascript:point_pay('payout','0')\" style=\"".$css_btn_gray."\" >",$body);
		$body = str_replace("{pay_in}","<input type='button' value='적립확인' onclick=\"javascript:point_pay('payin','0')\" style=\"".$css_btn_gray."\" >",$body);


		$query = "select * from `site_members_point` ";
		
		if($email) {
			$query .= "where email='$email' ";
			$body = str_replace("{email}",$email,$body);
		} else {
			$body = str_replace("{email}","전체목록 ",$body);
		}

		$query .= "order by regdate desc ";

		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";

		if($rowss = _sales_query_rowss($query)){	

			$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>일자</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>회원</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>구분</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>항목</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>포인트</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>잔액</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>승인</td>";
			$list .= "</tr></table>";
			
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
				if($rows->auth){
					$status = "<a href='#' onclick=\"javascript:point_auth('disauth','".$rows->Id."','$limit')\" >승인취소</a>";					
				} else {
					$status = "<a href='#' onclick=\"javascript:point_auth('auth','".$rows->Id."','$limit')\" >미승인</a>";											
				}

				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>";
				if($email){
				} else {
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->email."</td>";
				}
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->type."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> $depth ";
				$list .= "<a href='#' onclick=\"javascript:point_pay('edit','".$rows->Id."','$limit')\" >".$rows->title."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->point."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->balance."</td>";				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>$status</td>";
				$list .= "</tr></table>";				
			}
			// echo $list;
			$body = str_replace("{point_list}",$list,$body);
			
		} else {
			$msg = "포인트 사용목록 없습니다.";
			$body = str_replace("{point_list}",$msg,$body);

		}		
		
		echo $body;

	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>