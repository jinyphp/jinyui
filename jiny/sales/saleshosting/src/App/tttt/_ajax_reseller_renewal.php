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

	$javascript = "<script>

		function reseller_new(mode,uid){
            $.ajax({
                url:'/ajax_reseller_new.php?uid='+uid+'&mode='+mode,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 	
        }

		function edit(mode,uid){
			var url = \"/reseller_renewal_view.php?mode=\" + mode + \"&uid=\" + uid;
			location.replace(url);

			/*
            $.ajax({
                url:'/ajax_reseller_users_edit.php?uid='+uid+'&mode='+mode,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
            */ 	
        }
                
        function list(limit){
            var url = \"/ajax_reseller_users.php?limit=\"+limit;
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 	
        }
    </script>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		//include "./sales.php";

	
		
		
			
			$body = $javascript._skin_page($skin_name,"reseller_renewal");
		
			$_list_num = 10;
			$_block_num = 10;
			$mode = _formmode();
			$limit = _formdata("limit"); 

		
			$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$button ="<input type='button' value='신규고객' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);

		
			$searchkey = _formdata("searchkey");
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
			$body = str_replace("{search}",$button_search,$body);
		

			// 로그인 회원정보 읽어오기
			if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];	
			if($reseller = _is_reseller($email)){
				// 리셀러 : 하부 리셀러 관리
				$query = "select * from `service_reseller_renewal` where reseller = '$email' ";
			} else {
				// 미승인, 미가입 처리된 회원 = 자기 정보만 출력
				$query = "select * from `service_reseller_renewal` where email = '$email' ";
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
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>등록일자</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>구분</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' >이메일</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>수량</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>설정비용</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>유지비용</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>합계</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>처리결과</td>
							</tr>
						</table>";

				if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
				for($i=0;$i<$count;$i++){
					$rows = $rowss[$i];

					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->email."</a>";
					$users = _members_rows($rows->email);

					if($rows->auth) $auth = "승인"; else $auth ="미승인";

					// $prices = $rows->setup + $rows->charge;
					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->type."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->priod."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->setup."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->charge."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->pay_amount."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$auth."</td>
							</tr>
						</table>";

				}


			
				// $list .= _listbar($_list_num,$_block_num,$limit, $total);
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