<?
    //*  WebLib V1.5
    //*  Program by : hojin lee
    //*  
    //*
    // update : 2016.01.04 = 코드정리 

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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");
	
	/////////////
	$javascript = "<script>
		function auth(mode,uid,limit){
            var url = \"ajax_seller_company.php\";
			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);  
        
        }

		function edit(mode,uid,limit){
            var url = \"seller_company_edit.php\";		
			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }

        function list(limit){
			var url = \"ajax_seller_company.php\";
        	var form = document.site;
        	form.limit.value = limit;

			ajax_html('#mainbody',url);
    	}

    	// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.sales.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

    	// 국가
 		$('#country').on('change',function(){
        	list(0);
    	});
			
	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 판매재고 관련 함수들...
		include ($_SERVER['DOCUMENT_ROOT']."/sales/sales_function.php");


		$body = $javascript._theme_page($site_env->theme,"scm_seller_company",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);

		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];
		}
				
		$mode = _formmode();
		$uid = _formdata("uid");

		if($mode == "auth"){
			// 입점 승인
			$query = "UPDATE service.scm_shop SET `auth`='on' WHERE `Id`='$uid'";
			_mysqli_query($query);

			// 신규 거래처 증록
			$query = "select * from service.scm_shop WHERE `Id`='$uid'";
			if($scm_rows = _mysqli_query_rows($query)){
				
				$query1 = "select * from `sales_company` where email='".$scm_rows->seller_email."'";
				if($rows1 = _sales_query_rows($query1)){
					echo "이미 가입, 중복된 이메일 입니다.";
				} else {

					$insert_filed .= "`regdate`,";					$insert_value .= "'$TODAYTIME',";
					$insert_filed .= "`enable`,";					$insert_value .= "'on',";			
					$insert_filed .= "`auth`,";						$insert_value .= "'on',";			
    				$insert_filed .= "`business`,";					$insert_value .= "'$business',";					
					$insert_filed .= "`country`,";					$insert_value .= "'".$scm_rows->seller_country."',";					
					$insert_filed .= "`currency`,";					$insert_value .= "'$currency',";				
					$insert_filed .= "`limitation`,";				$insert_value .= "'$limitation',";					
					$insert_filed .= "`inout`,";					$insert_value .= "'buy',";				
					$insert_filed .= "`company`,";					$insert_value .= "'".$scm_rows->seller_name."',";					

    				$biznumber = _sales_CompanyLicense_POST("kr");
    				$insert_filed .= "`biznumber`,";				$insert_value .= "'$biznumber',";    				
	
					$insert_filed .= "`president`,";				$insert_value .= "'$president',";					
					$insert_filed .= "`post`,";						$insert_value .= "'$post',";					
					$insert_filed .= "`address`,";					$insert_value .= "'$address',";					
					$insert_filed .= "`subject`,";					$insert_value .= "'$subject',";			
					$insert_filed .= "`item`,";						$insert_value .= "'$item',";				
					$insert_filed .= "`email`,";					$insert_value .= "'".$scm_rows->seller_email."',";					
					$insert_filed .= "`tel`,";						$insert_value .= "'$tel',";				
					$insert_filed .= "`fax`,";						$insert_value .= "'$fax',";				
					$insert_filed .= "`phone`,";					$insert_value .= "'$phone',";				
					$insert_filed .= "`group`,";					$insert_value .= "'$group',";				
					$insert_filed .= "`manager`,";					$insert_value .= "'$manager',";			
					$insert_filed .= "`discount`,";					$insert_value .= "'$discount',";				

    				$insert_filed .= "`vat`,";
    				if($vat) $insert_value .= "'on',"; else $insert_value .= "'',";
					
					$insert_filed .= "`comment`,";					$insert_value .= "'".addslashes($comment)."',";			

					$query = "INSERT INTO `sales_company` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);

				
					// 링크코드 삽입
					// Master 비지니스 , Links 갱신
					/*
					if($scm_rows->seller_business){
						$_POST['mode'] = "links_update";
						$_POST['code'] = "*".$sales_db->Id.":".$scm_rows->seller_business.";";

						// 링크코드 *회사이름:사업자번호;
						$_POST['links_old'] = "*".$rows->inout.":".$rows->company.":".$rows->biznumber.":".$rows->email.";";
						$_POST['links_new'] = "*".$inout.":".$company.":".$biznumber.":".$email.";";

						//$_POST['host_id'] = $sales_db->Id;
						//$_POST['business_id'] = $rows->Id;

						// CUTL POST 처리
						$_POST['adminkey'] = $sales_db->adminkey; // CURL 콜처리를 위한 adminkey값 적용
						// echo "CURL : "."http://www.saleshosting.co.kr/sales/curl_business_sync.php";
						$curl_result = _curl_post("http://www.saleshosting.co.kr/sales/curl_business_sync.php",$_POST);
					}
					*/
				}
			}

		} else if($mode == "disauth"){
			// 임점 승인 취소
			$query = "UPDATE service.scm_shop SET `auth`='' WHERE `Id`='$uid'";
			_mysqli_query($query);
		}



		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form name='sales' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='입점망' onclick=\"javascript:location.replace('seller_list.php')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);

		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","국가별 창고위치") ,$body);

		///////////////////
		// 상품 목록을 검색
		$query = "select * from service.scm_shop where seller_email = '$email'";
		if($searchkey) {
			$query .= " and business like '%".$searchkey."%' ";
		}
		
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";				
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>등록일자</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>국가</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>사업장</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='200'>도메인</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>승인</td>
					  </tr>
					</table>";


		if($rowss = _sales_query_rowss($query)){

			

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				// 거래처: 활성화 체크
				if($rows->auth) {
					$authlink = "<a href='#' onclick=\"javascript:auth('disauth','".$rows->Id."','".$limit."')\">"."승인취소"."</a>";

					$title_name = "<a href='#' onclick=\"javascript:edit('seller','".$rows->Id."','".$limit."')\">".$rows->shop_name."</a>";
				} else {
					$title_name = "<a href='#' onclick=\"javascript:edit('seller','".$rows->Id."','".$limit."')\">
									<span style=\"text-decoration:line-through;\">".$rows->shop_name."</span></a>";

					$authlink = "<a href='#' onclick=\"javascript:auth('auth','".$rows->Id."','".$limit."')\">"."승인"."</a>";				
				}

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
				
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'>".$tid."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->shop_country."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='200'>".$rows->shop_domain."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$authlink."</td>
							</tr>
						</table>";				


			}
			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}",$list,$body);
		
		} else {
			$msg = "사업자 목록이 없습니다.";
			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>
					  <td style='font-size:12px;padding:10px;' align='center'>"._string($msg,$site_language)."</td>
					  </tr>
					</table>";
			$body = str_replace("{datalist}",$list,$body);
			
		}

		echo $body;	




	
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>