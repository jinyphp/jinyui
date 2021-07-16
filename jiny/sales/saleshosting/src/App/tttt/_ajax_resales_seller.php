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

    include "./func/members.php";
    include "./func/css.php";
    include "./func/curl.php";

	function _listbar($_list_num,$_block_num,$limit,$total){
		$total_list = intval( $total / $_list_num ); // 전페 리스트 수
		$total_block = intval( $total_list / $_block_num ); // 전체 블럭 수
		$pageMenu = "";
		$pre = ""; $next = "";

		$pageMenu = "";
	   
		// 처음 데이터가 아닌경우, 처음으로 이동 버튼 생성.
		if($limit != 0) $pageMenu .= "[<a href='#' onclick=\"javascript:list('0')\">First</a>] "; // 처음 테이터

		// 현재 위치의 list 값 체크
		$current_list = intval( $limit / $_list_num );
		// 현제 위치의 block값 체크
		$current_block = intval( $current_list / $_block_num );

		if( $current_block >0) {
			// $pre = ($current_block - 1) * $_block_num * $_list_num; 
			$pre = $current_block * $_block_num * $_list_num - $_list_num; 
			$pageMenu .= "[<a href='#' onclick=\"javascript:list('".$pre."')\">Pre($pre)</a>] "; // 이전 블럭 
		}

		
		$i = $current_block * $_block_num; //현재 블럭의 시작
		$count = $i + $_block_num; // 블럭 크기많큼 표기 loop
		if($count>$total_list) $count = $total_list; // 만일 제일 마지막 loop가, total보다 적을때, 마지막을 total로 지정 
		for(;$i<$count; $i++){
			$j = $i * $_list_num;
				// if($limit == $j) $pageMenu .= "[<b>$i</b>] "; else $pageMenu .= "[<a href='".$_SERVER['PHP_SELF']."?limit=$j'>$i</a>] ";
				//  
			if($limit == $j){
				$pageMenu .= "[<b>$j</b>] "; 
			} else {
				$pageMenu .= "[<a href='#' onclick=\"javascript:list('".$j."')\">$j</a>] ";
			}
		}


		if( ($j + $_list_num) < $total) {
			$next = $j + $_list_num;
			//$next = $pre + $_block_num * $_list_num * 2; 
			//$next = $current_block + $_list_num*$_block_num;
			$pageMenu .= "[<a href='#' onclick=\"javascript:list('".$next."')\">Next($next)</a>] "; // 다음 블럭 
		}

		$last = $total_list * $_list_num;
		if($limit != $last) $pageMenu .= "[<a href='#' onclick=\"javascript:list('".$last."')\">Last</a>]"; // 마지막 데이터

		return "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				<tr><td style='font-size:12px;padding:10px;' align=center>".$pageMenu."</td></tr></table>";

	}
	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		$javascript = "<script>
			function auth(mode,uid,limit){
       
                alert(\"resales\");
                $.ajax({
                    url:'/ajax_resales_seller.php?limit='+limit+'&uid='+uid+'&mode='+mode,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#mainbody').html(data);
                    }
                }); 

            }
		</script>";

		$body = $javascript._skin_page($skin_name,"resales_seller");

		$body = str_replace("{formstart}","<form name='manager' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='입점신청' onclick=\"javascript:resales('0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{resales}",$button,$body);
	
		$_list_num = 10;
		$_block_num = 10;
		
		$limit = _formdata("limit"); 

		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}

		$mode = _formmode();
		// echo "mode = $mode <br>";
		if($mode == "auth"){
		
			// 셀러 승인
			$uid = _formdata("uid");
			$query = "UPDATE `resales_seller` SET ";
			$query .= "`auth`='on' ,";
			$query .= "WHERE `Id`='$uid'";
			$query = str_replace(",WHERE","WHERE",$query);
			echo $query."<br>";
			_mysqli_query($query);

			// curl : 상대방에 resales_shop 입점 승인
			$postfild = array('mode' => 'auth','email' => $members->email);
			$curl_response = _curl_post("http://www.saleshosting.co.kr/resales/curl_resales_shop.php",$postfild);
			echo $curl_response;



			
		}
		

		///////////////////
		// 입점 : 판매업체 목록 
		$query = "select * from `resales_seller` ";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>등록일</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='250'>공급자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >사이트</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>상품수</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>적립금</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>승인</td>
							</tr>
						</table>";

		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				if($rows->auth) $status = "<a href='#' onclick=\"javascript:auth('disauth','".$rows->Id."','$limit')\">승인</a>"; 
				else $status = "<a href='#' onclick=\"javascript:auth('auth','".$rows->Id."','$limit')\">미승인</a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='250'>".$rows->name." ".$rows->email."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->domain."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->goods."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->emoney."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$status."</td>
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