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
	include ($_SERVER['DOCUMENT_ROOT']."/func/currency.php");

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
		function list(limit){
			var url = \"ajax_site_members_emoney.php\";
        	var form = document.site;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);
    	}

		function emoney_auth(mode,uid,limit){
			var url = \"ajax_site_members_emoney.php\";
			var form = document.site;
        	form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;	

			ajax_html('#mainbody',url);	
		}	

		function emoney_pay(mode,uid,limit){
			var url = \"ajax_site_members_emoney_edit.php\";
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

		
		// $body = $javascript._skin_page($skin_name,"site_members_emoney");
		$body = $javascript._theme_page($site_env->theme,"site_members_emoney",$site_language,$site_mobile);

	
		$email = $_COOKIE['cookie_email'];
		$emoney = _formdata("emoney");
	
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
		$users = _formdata("users");
		$email = _formdata("email");
	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
								<input type='hidden' name='users' value='$users'>
								<input type='hidden' name='email' value='$email'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);


		if($mode == "auth") {
			$uid = _formdata("uid");
			// $query = "select * from `site_members_emoney` where Id='$uid'";
			if($rows = _site_memberEmoneyRows_Id($uid)){
				if($members_rows = _site_memberRows($rows->email)){	

					$balance = $members_rows->emoney + $rows->emoney;
					$query = "UPDATE `site_members` SET `emoney`='$balance' where email='".$rows->email."'";
					_sales_query($query);

					$query = "UPDATE `site_members_emoney` SET `auth`='on', `balance`='$balance' where Id='$uid'";
					_sales_query($query);
				}
			}

		} else if($mode == "disauth") {	
			$uid = _formdata("uid");
			// $query = "select * from `site_members_emoney` where Id='$uid'";
			if($rows = _site_memberEmoneyRows_Id($uid)){
				if($members_rows = _site_memberRows($rows->email)){	

					$balance = $members_rows->emoney - $rows->emoney;
					$query = "UPDATE `site_members` SET `emoney`='$balance' where email='".$rows->email."'";
					_sales_query($query);

					$query = "UPDATE `site_members_emoney` SET `auth`='', `balance`='$balance' where Id='$uid'";
					_sales_query($query);
				}
			}


		} else if($mode == "delete") {
			$uid = _formdata("uid"); 
			$query = "DELETE FROM site_members_emoney WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "edit") {
			if($members_rows = _site_memberRows($email)){
				$bankname = _formdata("bankname");
				$banknum = _formdata("banknum");
				$bankuser = _formdata("bankuser");
				$query = "UPDATE `site_members_emoney` SET `emoney`='$emoney',`bankname`='$bankname',`banknum`='$banknum',`bankuser`='$bankuser' where Id='$uid'";
				//echo $query."<br>";
			_sales_query($query);
			} else {
				$msg = "미등록 회원 이메일 입니다.";
				msg_alert($msg);
			}

		} else if($mode == "payin") {
			if($members_rows = _site_memberRows($email)){
				$pay_email = _formdata("pay_email");
				$query = "INSERT INTO `site_members_emoney` (`regdate`, `email`, `type`, `title`, `emoney`, `balance`) 
						VALUES ('$TODAYTIME', '$pay_email', 'payin', '입금확인', '$emoney', '');";
				echo $query."<br>";
				_sales_query($query);
			} else {
				$msg = "미등록 회원 이메일 입니다.";
				msg_alert($msg);
			}
			
		} else if($mode == "payout") {
			if($members_rows = _site_memberRows($email)){
				$pay_email = _formdata("pay_email");
				$emoney = "-".$emoney;
				$bankname = _formdata("bankname");
				$banknum = _formdata("banknum");
				$bankuser = _formdata("bankuser");

				$query = "INSERT INTO `site_members_emoney` (`regdate`, `email`, `type`, `title`, `emoney`, `balance`, `bankname`, `banknum`, `bankuser`) 
						VALUES ('$TODAYTIME', '$pay_email', 'payout', '출금요청', '$emoney', '', '$bankname', '$banknum', '$bankuser');";
				//echo $query."<br>";
				_sales_query($query);
			} else {
				$msg = "미등록 회원 이메일 입니다.";
				msg_alert($msg);
			}				
		}


		$body = str_replace("{pay_out}","<input type='button' value='출금신청' onclick=\"javascript:emoney_pay('payout','0','$limit')\" style=\"".$css_btn_gray."\" >",$body);
		$body = str_replace("{pay_in}","<input type='button' value='입금확인' onclick=\"javascript:emoney_pay('payin','0','$limit')\" style=\"".$css_btn_gray."\" >",$body);



		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"$css_btn_gray\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);

			


		$query = "select * from `site_members_emoney` ";
		
		// if($users) $query .= "where email='$users' ";
		if($email) {
			$query .= "where email='$email' ";
			$body = str_replace("{email}",$email,$body);
		} else {
			$body = str_replace("{email}","전체목록 ",$body);

		}

		$query .= "order by regdate desc ";
		// echo $query;

		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";

		if($rowss = _sales_query_rowss($query)){	

			$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>일자</td>";

			if($email){

			} else {
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>회원</td>";
			}

			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>구분</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>항목</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>적립금</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>잔액</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>승인</td>";
			$list .= "</tr></table>";
			
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
				// for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";

				if($rows->name == "system"){
					// 시스템 처리 이메일의 경우에는 승인처리를 할 수 없습니다.
					$status = "system";
					$title = $rows->title;

				} else {
					// 승인처리 버튼 생성
					if($rows->auth){
						$status = "<a href='#' onclick=\"javascript:emoney_auth('disauth','".$rows->Id."','$limit')\" >승인취소</a>";					
					} else {
						$status =  "<a href='#' onclick=\"javascript:emoney_auth('auth','".$rows->Id."','$limit')\" >미승인</a>";						
					}

					$title = "<a href='#' onclick=\"javascript:emoney_pay('edit','".$rows->Id."','$limit')\" >".$rows->title."</a>";
				}

				$emoney = _currency_format($site_currency,$rows->emoney);
				$balance = _currency_format($site_currency,$rows->balance);


				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>".$rows->regdate."</td>";

				if($email){
				} else {
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->email."</td>";
				}
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->type."</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>$title</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$emoney."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$balance."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>$status</td>";
				$list .= "</tr></table>";

				
			}
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{emoney_list}",$list,$body);
			
		} else {
			$msg = "적립금 사용목록 없습니다.";
			$body = str_replace("{emoney_list}",$msg,$body);

		}		
		
		echo $body;

	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>