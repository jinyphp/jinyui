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

	include "./func/goods.php";
	

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		/////////////
		$javascript = "<script>
			function resales(mode,shop,gid){
				var url = \"/ajax_shop_goods_resales.php?shop=\"+shop+\"&mode=\"+mode+\"&gid=\"+gid;
				alert(url);
			
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#resales_goods').html(data);

                        }
                    });				
			}
			
		</script>";

		$body = $javascript._skin_page($skin_name,"shop_goods_resales");

		$gid = _formdata("gid");
		$shop = _formdata("shop");
		$email = $_COOKIE['cookie_email'];

		$mode = _formmode();
		if($mode == "add_goods"){
			//echo "add goods <br>";
			// 상품 추가 			

			$query = "select * from `resales_shop` WHERE Id ='$shop'";
			//echo $query."<br>";
			if($shop_rows = _sales_query_rows($query)){

				$query = "select * from `shop_goods` WHERE Id =$gid";
				//echo $query."<br>";
				if($rows = _sales_query_rows($query)){

					$goodname = addslashes($rows->goodname);
					// 입점상품 : 기록 저장
					$query1 = "select * from `resales_goods` WHERE gid ='$gid' and shop = '$shop'";
					if($rows1 = _sales_query_rows($query1)){

					} else {
						$insert_filed = "";	$insert_value = "";				
						$insert_filed .= "`regdate`,";	$insert_value .= "'".$TODAY."',";
						$insert_filed .= "`shop`,";	$insert_value .= "'".$shop."',";
						$insert_filed .= "`shop_name`,";	$insert_value .= "'".$shop_rows->name."',";
				
						$insert_filed .= "`seller`,";	$insert_value .= "'".$email."',";
						$insert_filed .= "`gid`,";	$insert_value .= "'".$gid."',";
						$insert_filed .= "`goodname`,";	$insert_value .= "'".$goodname."',";

						$query = "INSERT INTO `resales_goods` ($insert_filed) VALUES ($insert_value)";
						$query = str_replace(",)",")",$query);
						_sales_query($query);
						//echo $query."<br>";
					}

					// CURL 상품 정보 전송					
					$rows->seller = $email;	// 판매자 정보를 바꿈 : 로그인 아이디
					$rows['mode'] = "goods";
					// 상품 이미지 경로 : 판매자 이미지 url
					$rows->images1 = "http://".$shop_rows->domain.str_replace("./","/",$rows->images1);
					$postfild = $rows;
				
					$curl_response = _curl_post("http://".$shop_rows->domain."/curl_resales.php",$postfild);
					echo $curl_response;
					


				}			

			}

		} else if($mode == "remove_goods"){

			$query = "DELETE FROM `resales_goods` WHERE `gid`='$gid' and `shop`='$shop' ";
			//echo $query."<br>";
			_sales_query($query);
		}


		// 로그인 회원정보 읽어오기
		if(isset($_COOKIE['cookie_email']))	{
			$email = $_COOKIE['cookie_email'];	
			$members = _members_rows($email);
		}

		///////////////////
	
		$query = "select * from `resales_shop` ";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >사이트</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'></td>
							</tr>
						</table>";

		if($rowss = _sales_query_rowss($query)){
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$query = "select * from `resales_goods` where gid='$gid' and shop = '".$rows->Id."'";
				if($rows1 = _sales_query_rows($query)){
					// 입점 등록된 상품일 경우, 출력하지 않음.
				} else {
					$status = "<a href='#' onclick=\"javascript:resales('add_goods','".$rows->Id."','".$gid."')\">상품입점</a>";
					$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>							
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='250'>".$rows->name." ".$rows->domain."</td>
						
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$status."</td>
							</tr>
						</table>";
				}	
				
			}


			
			//$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{resales_shop}",$list,$body);
			// echo $body;
			//echo $list;

		} else {
			$msg = "입점 쇼핑몰이 없습니다.";
			$body = str_replace("{resales_shop}",$list.$msg,$body);
			// echo $body;
			//echo $msg;
		}	

		// ****************

		$query = "select * from `resales_goods` where gid='$gid'";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >사이트</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'></td>
							</tr>
						</table>";

		if($rowss = _sales_query_rowss($query)){
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$status = "<a href='#' onclick=\"javascript:resales('remove_goods','".$rows->shop."','".$gid."')\">입점취소</a>";
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>								
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->shop_name."</td>						
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$status."</td>
							</tr>
						</table>";
			}


			
			//$list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{resales_goods}",$list,$body);
			// echo $body;
			//echo $list;

		} else {
			$msg = "입점 쇼핑몰이 없습니다.";
			$body = str_replace("{resales_goods}",$list.$msg,$body);
			// echo $body;
			// echo $msg;
		}

		echo $body;

	} else {
		$body = _skin_pages($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>