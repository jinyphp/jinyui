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
			function emoney_auth(mode,uid){
            	var url = \"/ajax_service_emoney_auth.php?uid=\"+uid+\"&mode=\"+mode;	
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
		$body = $javascript._skin_page($skin_name,"service_emoney_auth");

		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		$limit = _formdata("limit");

		//echo "mode = $mode <br>";

		if($mode == "auth"){
			$query = "select * from `service_emoney` where Id = '".$uid."' ";
			echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){	
				
				$query = "select * from `service_reseller` where email = '".$rows->email."'";
				echo $query."<br>";
				if($reseller_rows = _mysqli_query_rows($query)){
					if($rows->type == "in") $emoney = $reseller_rows->emoney + $rows->emoney;
					else if($rows->type == "out") $emoney = $reseller_rows->emoney - $rows->emoney;
					$query = "UPDATE `service_reseller` SET `emoney`='$emoney', `in_check`='' where email = '".$rows->email."'";
					echo $query."<br>";
					_mysqli_query($query);

				}

				$query = "UPDATE `service_emoney` SET `check_auth`='on', `balance`='$emoney', `auth_date`='$TODAYTIME', `status`='입금완료'  where Id = '".$uid."'";
				echo $query."<br>";
				_mysqli_query($query);
			}

		} else if($mode == "cancel"){
			$query = "select * from `service_emoney` where Id = '".$uid."' ";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){	
				
				$query = "select * from `service_reseller` where email = '".$rows->email."'";
				//echo $query."<br>";
				if($reseller_rows = _mysqli_query_rows($query)){
					if($rows->type == "in") $emoney = $reseller_rows->emoney - $rows->emoney;
					else if($rows->type == "out") $emoney = $reseller_rows->emoney + $rows->emoney;

					$query = "UPDATE `service_reseller` SET `emoney`='$emoney', `in_check`='' where email = '".$rows->email."'";
					//echo $query."<br>";
					_mysqli_query($query);

				}

				$query = "UPDATE `service_emoney` SET `check_auth`='', `balance`='$emoney', `auth_date`='$TODAYTIME', `status`='출금완료'  where Id = '".$uid."'";
				//echo $query."<br>";
				_mysqli_query($query);
			}


		}


		$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data' >
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		
		$query = "select * from `service_reseller` where email = '".$_COOKIE['cookie_email']."'";
		if($reseller_rows = _mysqli_query_rows($query)){
			$body = str_replace("{name}","<a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->name."</a> ( <a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->email."</a>  )",$body);
			$body = str_replace("{emoney}",$format = number_format($reseller_rows->emoney,0,'.',',')."원",$body);
		} 
	
		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130' >일자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'width='150' >리셀러(이메일)</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >항목</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >구분</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >입금자명</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >금액</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>승인</td>";
		$list .= "</tr></table>";

		$body = str_replace("{emoney_list}",$list."{emoney_list}",$body);		

		// 승인 처리해야 할 이머니 리스트
		$query = "select * from `service_emoney` where reseller = '".$_COOKIE['cookie_email']."' order by regdate desc";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='130'>".$rows->regdate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->email."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> ";
				$list .= "<a href='#' onclick=\"javascript:emoney_edit('edit','".$rows->Id."')\" >".$rows->title."</a></td>";

				if($rows->type == "in"){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >입금</td>";
				} else if($rows->type == "out"){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >출금</td>";
				}	
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->name."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".number_format($rows->emoney,0,'.',',')."</td>";

				if($rows->manual == "on"){
					// 수동 입금 / 출금 일경우만 , 승인 및 취소가 가능함.
					if($rows->check_auth){
						if($rows->type == "in"){
							$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<a href='#' onclick=\"javascript:emoney_auth('cancel','".$rows->Id."')\" >입금취소</a> 
							</td>";
						} else if($rows->type == "out"){
							$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<a href='#' onclick=\"javascript:emoney_auth('cancel','".$rows->Id."')\" >출금취소</a> 
							</td>";
						}	
					
					} else {
						if($rows->type == "in"){
							$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<b><a href='#' onclick=\"javascript:emoney_auth('auth','".$rows->Id."')\" >입금승인</a></b> 
							</td>";
						} else if($rows->type == "out"){
							$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'> 
							<b><a href='#' onclick=\"javascript:emoney_auth('auth','".$rows->Id."')\" >출금승인</a></b> 
							</td>";
						}	
					
					}
				} else {
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80' ></td>";
				}

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