<?

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";

	include "./func/css.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		// include "./sales.php";

		// 카테고리에 대한 자바스크립트 함수 정의
		$javascript = "<script>
			function emoney_pay(mode,uid){
				// alert(mode);
            	var url = \"/ajax_service_emoney_edit.php?uid=\"+uid+\"&mode=\"+mode;	
           		$.ajax({
                	url:url,
                	type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('.mainbody').html(data);
                	}
            	}); 	
        	}

        </script>";
		$body = $javascript._skin_page($skin_name,"service_emoney");

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");

		//echo "mode = $mode <br>";

		if($mode == "payin_up"){
			// 입금 기록 삽입
			$query = "select * from `service_reseller` where Id = '".$uid."'";
			echo $query."<br>";
			if($reseller_rows = _mysqli_query_rows($query)){

				$insert_filed = "`regdate`,"; $insert_value = "'$TODAYTIME',";
				$insert_filed .= "`email`,";	$insert_value .= "'".$reseller_rows->email."',";
				$insert_filed .= "`title`,";	$insert_value .= "'입금 결제',";
				$insert_filed .= "`type`,";	$insert_value .= "'in',";

				$emoney = _formdata("emoney");
				$insert_filed .= "`emoney`,";	$insert_value .= "'$emoney',";
				
				//$insert_filed .= "`balance`,";	$insert_value .= "'$balance',";
				$insert_filed .= "`reseller`,"; $insert_value .= "'".$reseller_rows->reseller."',";

				$paydate = _formdata("paydate");
				$insert_filed .= "`paydate`,";	$insert_value .= "'$paydate',";

				$name = _formdata("name");
				$insert_filed .= "`name`,";	$insert_value .= "'$name',";
				
				// 입춞금 : 수동모드  
				$insert_filed .= "`manual`,";	$insert_value .= "'on',";

				$insert_filed .= "`status`,";	$insert_value .= "'확인요청',";

				$query = "INSERT INTO `service_emoney` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				_mysqli_query($query);

			}	

		} else if($mode == "payout_up"){
			// 출금 기록 삽입
			$query = "select * from `service_reseller` where Id = '".$uid."'";
			echo $query."<br>";
			if($reseller_rows = _mysqli_query_rows($query)){

				$insert_filed = "`regdate`,"; $insert_value = "'$TODAYTIME',";
				$insert_filed .= "`email`,";	$insert_value .= "'".$reseller_rows->email."',";
				$insert_filed .= "`title`,";	$insert_value .= "'출금요청',";
				$insert_filed .= "`type`,";	$insert_value .= "'out',";

				$emoney = _formdata("emoney");
				$insert_filed .= "`emoney`,";	$insert_value .= "'$emoney',";
				
				//$insert_filed .= "`balance`,";	$insert_value .= "'$balance',";
				$insert_filed .= "`reseller`,"; $insert_value .= "'".$reseller_rows->reseller."',";

				// $paydate = _formdata("paydate");
				// $insert_filed .= "`paydate`,";	$insert_value .= "'$paydate',";

				$name = _formdata("name");
				$insert_filed .= "`name`,";	$insert_value .= "'$name',";
				
				// 입춞금 : 수동모드  
				$insert_filed .= "`manual`,";	$insert_value .= "'on',";

				$insert_filed .= "`status`,";	$insert_value .= "'출금요청',";

				$query = "INSERT INTO `service_emoney` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				_mysqli_query($query);

			}	

		}

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data' >
											<input type='hidden' name='limit' value='$limit'>
											<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		
		$query = "select * from `service_reseller` where Id = '".$uid."'";
		// echo $query."<br>";
		if($reseller_rows = _mysqli_query_rows($query)){
			$body = str_replace("{name}","<a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->name."</a> ( <a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->email."</a>  )",$body);
			$body = str_replace("{emoney}",$format = number_format($reseller_rows->emoney,0,'.',',')."원",$body);
		} 

		$button ="<input type='button' value='출금요청' onclick=\"javascript:emoney_pay('pay_out','".$reseller_rows->Id."')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{pay_out}",$button,$body);

		$button ="<input type='button' value='입금처리' onclick=\"javascript:emoney_pay('pay_in','".$reseller_rows->Id."')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{pay_in}",$button,$body);

		// $body = str_replace("{pay_out}","<input type='button' value='출금' onclick=\"javascript:emoeny_pay('pay_out','".$reseller_rows->Id."')\" style=\"".$css_btn_gray."\" >",$body);
		// $body = str_replace("{pay_in}","<input type='button' value='입금' onclick=\"javascript:emoeny_pay('pay_in','".$reseller_rows->Id."')\" style=\"".$css_btn_gray."\" >",$body);




	
		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130' >일자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >항목</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >구분</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >입금자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >금액</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>상태</td>";
		$list .= "</tr></table>";

		$body = str_replace("{emoney_list}",$list."{emoney_list}",$body);		

		// 승인 처리해야 할 이머니 리스트
		$query = "select * from `service_emoney` where email = '".$reseller_rows->email."' order by regdate desc";
		// echo $query."<br>";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>".$rows->regdate."</td>";
				//$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->email."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> ";
				$list .= "".$rows->title."</td>";

				if($rows->type == "in"){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >입금</td>";
				} else if($rows->type == "out"){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >출금</td>";
				}	
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >".$rows->name."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".number_format($rows->emoney,0,'.',',')."</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >".$rows->status."</td>";

				/*
				if($rows->check_auth){
					if($rows->type == "in"){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
						<a href='#' onclick=\"javascript:emoney_auth('cancel','".$rows->Id."')\" >입금취소</a> 
					</td>";
					} else if($rows->type == "out"){
						$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
						<a href='#' onclick=\"javascript:emoney_auth('cancel','".$rows->Id."')\" >출금취소</a> 
					</td>";
					}	
					
				} else {
					if($rows->type == "in"){
						$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
							<b><a href='#' onclick=\"javascript:emoney_auth('auth','".$rows->Id."')\" >입금승인</a></b> 
						</td>";
					} else if($rows->type == "out"){
						$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
							<b><a href='#' onclick=\"javascript:emoney_auth('auth','".$rows->Id."')\" >출금승인</a></b> 
						</td>";
					}	
					
				}
				*/

				$list .= "</tr></table>";

				
			}
			// echo $list;
			$body = str_replace("{emoney_list}",$list,$body);
			
		} else {
			$msg = "획인목록이 없습니다.";
			$body = str_replace("{emoney_list}",$msg,$body);

		}	
	
		
		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>