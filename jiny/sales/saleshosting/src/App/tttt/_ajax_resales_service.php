<?
    //*  WebLib V1.5
    //*  Program by : hojin lee
    //*  
    //*
    // update : 2016.01.04 = 코드정리 

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

    include "./func/site.php";  // 사이트 환경 설정

    include "./func/layout.php";
    include "./func/header.php";
    include "./func/footer.php";
    include "./func/menu.php";
    include "./func/category.php";
    include "./func/skin.php";

    include "./func/css.php";

    include "./func/listbar.php";
	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		$javascript = "<script>
			function add_sales(mode,uid,limit){
                $.ajax({
                    url:'/ajax_resales_shop.php?limit='+limit+'&mode='+mode+'&uid='+uid,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#mainbody').html(data);
                    }
                }); 	
            }
		</script>";

		$body = $javascript._skin_page($skin_name,"service_resales");

		$body = str_replace("{formstart}","<form name='resales' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='입점신청' onclick=\"javascript:resales('0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{resales}",$button,$body);
	
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 

		
		

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `service_resales` ";
		$query .= "order by Id desc ";
		
		$total = _mysqli_query_count($query); // 고객 서버가 아닌, 관리자 메인 서버 테이블로 작업

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>등록일</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>샵이름</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>도메인</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>상품수</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >설명</td>
							</tr>
						</table>";

		if($rowss = _mysqli_query_rowss($query)){
			// $total = count($rowss);

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$add_sales = "<a href='#' onclick=\"javascript:add_sales('add','".$rows->Id."','$limit')\">입점신청</a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->name."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->domain."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->commission."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$add_sales."</td>
							</tr>
						</table>";
			}


			
			$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{list}",$list,$body);
			echo $body;
			
		} else {
			$msg = "입점 쇼핑몰이 없습니다.";
			$body = str_replace("{list}",$list.$msg,$body);
			echo $body;
		}	
	
	} else {
		$body = _skin_pages($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>