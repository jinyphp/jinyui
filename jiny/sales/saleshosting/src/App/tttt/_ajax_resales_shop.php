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

	include "./func/listbar.php";
	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		$javascript = "<script>
			function resales(limit){
       			
       			var maskHeight = $(document).height();  
				var maskWidth = $(window).width();

				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
				// 팡법창 크기 계산
				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				// popup_size(1000,500);
				var width = 800;
				var height = 500;
				var left = ($(window).width() - width )/2;
				var top = ( $(window).height() - height )/2;			
				$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 			  
    
    			//마스크의 투명도 처리
    			$('#popup_mask').fadeTo(\"slow\",0.8); 
				$('#popup_body').show();

				// 팝업 내용을 Ajax로 읽어옴
				var url = \"/ajax_resales_shop_list.php\";
				$.ajax({
            		url:url,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
                		$('#popup_body').html(data);

                		var maskHeight1 = $(document).height();  
						var maskWidth1 = $(window).width();

						//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
						$('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
            		}
        		}); 



            }
			
		</script>";

		$body = $javascript._skin_page($skin_name,"resales_shop");

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
		//echo "mode = $mode <br>";
		if($mode == "add"){
			// 입점 추가
			$uid = _formdata("uid");
			$query = "select * from `service_resales` WHERE Id =$uid";
			echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){

				$query1 = "select * from `resales_shop` WHERE email ='".$rows->email."'";
				echo $query1."<br>";
				if($rows1 = _sales_query_rows($query1)){
					echo "중복 등록";
				} else {
					$insert_filed = "";	$insert_value = "";				
					$insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAY."',";
					$insert_filed .= "`name`,";	$insert_value .= "'".$rows->name."',";
					$insert_filed .= "`domain`,";	$insert_value .= "'".$rows->domain."',";
					$insert_filed .= "`email`,";	$insert_value .= "'".$rows->email."',";

					$query = "INSERT INTO `resales_shop` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);
					echo $query."<br>";
				}


			}

			// curl : 상대방에 판매자 등록 신청 
			$postfild = array('mode' => 'add_seller','email' => $email,'domain' => $sales_db->domain);
			echo "http://".$rows->domain."/curl_resales.php"."<br>";
			$curl_response = _curl_post("http://".$rows->domain."/curl_resales.php",$postfild);
			echo $curl_response;



			
		}
		

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `resales_shop` ";
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