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

		function edit(mode,uid){
			var url = \"/service_server_edit.php?mode=\" + mode + \"&uid=\" + uid;
			location.replace(url);
        }
                
        function list(limit){
            var url = \"/ajax_service_server.php?limit=\"+limit;
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
			
			$body = $javascript._skin_page($skin_name,"service_server");
		
			$_list_num = 10;
			$_block_num = 10;
			$mode = _formmode();
			$limit = _formdata("limit"); 

		
			$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$button ="<input type='button' value='서버추가' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);

		
			$searchkey = _formdata("searchkey");
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
			$body = str_replace("{search}",$button_search,$body);
		

			// 로그인 회원정보 읽어오기
			if(isset($_COOKIE['cookie_email']))	$email = $_COOKIE['cookie_email'];	
			$query = "select * from `service_server` where reseller = '$email' ";
			if($searchkey) $query .= " and title like '%".$searchkey."%' ";		
			$query .= "order by Id desc ";
		
			$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

			// 검색된 데이터 내에서 , limit 설정 
			if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
			// echo $query;

			if($rowss = _mysqli_query_rowss($query)){

				$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>등록일자</td>
							<td style='border-bottom:bottom solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이름</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>호스트</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>root</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>IP</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>서버위치</td>
							</tr>
						</table>";

				if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
				for($i=0;$i<$count;$i++){
					$rows = $rowss[$i];

					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->name."</a>";
				
					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$title_name."</td>				
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->host."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->root."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->ip."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->location."</td>
							</tr>
						</table>";

				}


			
				// $list .= _listbar($_list_num,$_block_num,$limit, $total);
				$body = str_replace("{server_list}",$list,$body);
		
			} else {
				$msg = "내역이 없습니다.";
				$body = str_replace("{server_list}",$msg,$body);		
			}	

			


	

		echo $body;
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>