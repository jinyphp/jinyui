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

		// 자바스크립트 함수 정의
		$javascript = "<script>

        function order_auth(mode,uid){
            var url = \"/ajax_service_orders.php?uid=\"+uid+\"&mode=\"+mode;	
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
		$body = $javascript._skin_page($skin_name,"service_orders");

		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		$limit = _formdata("limit");

		function _reseller_rows($email){
			$query1 = "select * from `service_reseller` where email = '".$email."'";
			if($reseller_rows = _mysqli_query_rows($query1)){
				return $reseller_rows;
			}	
		}

		function _reseller_id_rows($uid){
			$query1 = "select * from `service_reseller` where Id = '".$uid."'";
			if($reseller_rows = _mysqli_query_rows($query1)){
				return $reseller_rows;
			}	
		}

		function _reseller_emoney_up($emoney,$email,$title){
			global $TODAYTIME;

			$query1 = "select * from `service_reseller` where email = '".$email."'";
			if($reseller_rows = _mysqli_query_rows($query1)){
				$balance = $reseller_rows->emoney + $emoney;

				$query = "UPDATE `service_reseller` SET `emoney`='$balance' where email = '".$email."'";
				_mysqli_query($query);

				// 기록
				$insert_filed = "`regdate`,"; $insert_value = "'$TODAYTIME',";
				$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";
				$insert_filed .= "`title`,";	$insert_value .= "'$title',";
				$insert_filed .= "`type`,";	$insert_value .= "'in',";
				$insert_filed .= "`emoney`,";	$insert_value .= "'$emoney',";
				$insert_filed .= "`balance`,";	$insert_value .= "'$balance',";

				$insert_filed .= "`reseller`,"; $insert_value .= "'".$reseller_rows->reseller."',";

				$query = "INSERT INTO `service_emoney` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				_mysqli_query($query);

				return $balance;
			}
		}

		function _reseller_emoney_down($emoney,$email,$title){
			global $TODAYTIME;

			$query1 = "select * from `service_reseller` where email = '".$email."'";
			if($reseller_rows = _mysqli_query_rows($query1)){
				$balance = $reseller_rows->emoney - $emoney;

				$query = "UPDATE `service_reseller` SET `emoney`='$balance' where email = '".$email."'";
				_mysqli_query($query);

				// 기록
				$insert_filed = "`regdate`,"; $insert_value = "'$TODAYTIME',";
				$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";
				$insert_filed .= "`title`,";	$insert_value .= "'$title',";
				$insert_filed .= "`type`,";	$insert_value .= "'out',";
				$insert_filed .= "`emoney`,";	$insert_value .= "'$emoney',";
				$insert_filed .= "`balance`,";	$insert_value .= "'$balance',";

				$insert_filed .= "`reseller`,"; $insert_value .= "'".$reseller_rows->reseller."',";

				$query = "INSERT INTO `service_emoney` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				_mysqli_query($query);

				return $balance;
			}
		}


		/*  리셀러 주문 승인
		 *  주문자 이머니 차감 > 리셀러 이머니 적립 
		 *  리셀링 발주 차감 > 
		 *  상위 릴셀러 : 마진 적립 
		 */ 
		function _service_auth_reseller($rows,$order_uid){
			// 신청자(email) 이머니 체크
			$query1 = "select * from `service_reseller` where email = '".$rows->email."'";
			if($reseller_rows = _mysqli_query_rows($query1)){
				$amount = $rows->setup + $rows->charge;
				if($reseller_rows->emoney >= $amount){

					// 주문자 이머니 차감 
					// ex) 10만원 결제
					_reseller_emoney_down($amount,$rows->email,"리셀러 가입 및 유지비용 차감");


					// 리셀러1 : 이머니 적립 이동
					// ex) 10만원 적립
					if($reseller1 = _reseller_rows($rows->reseller)){
						_reseller_emoney_up($amount,$reseller1->email,"리셀러 가입 및 유지비용 결제 적립");

						// 리셀러1 : 리셀링 발주
						// ex) 마진율 20%, 10 * 0.8 = 8만원 리셀링 차감 결제 
						// 20% 이윤으로 남음 
						$margin_amount =  $amount / 100 * $reseller1->margin;
						$order_prices = $amount - $margin_amount;
						_reseller_emoney_down($order_prices,$reseller1->email,"주문 리셀링 발주 차감 : order($order_uid)");

					} else $order_prices = $amount;

					// **
					// 차감 8만원을 기준으로, 상위 리셀러 분배 
					// $order_prices


					// 리셀러2 : 마진 계산 적립
					// ex) 리셀러는 마진 30%, 
					if($reseller2 = _reseller_rows($reseller1->reseller)){
						$margin_rate = $reseller2->margin - $reseller1->margin; // 마진차액 계산
						$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
						$order_prices = $order_prices - $margin_amount;
						_reseller_emoney_up($margin_amount,$reseller2->email,"[리셀러] Grade2 마진 적립 <".$reseller1->email." : order($order_uid)");
					}

					// 리셀러3 : 마진 계산 적립
					// ex) 리셀러는 마진 40%, 
					if($reseller3 = _reseller_rows($reseller2->reseller)){
						$margin_rate = $reseller3->margin - $reseller2->margin; // 마진차액 계산
						$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
						$order_prices = $order_prices - $margin_amount;
						_reseller_emoney_up($margin_amount,$reseller3->email,"[리셀러] Grade3 마진 적립 <".$reseller2->email." : order($order_uid)");
					}

					// 리셀러4 : 마진 계산 적립
					// ex) 리셀러는 마진 50%, 
					if($reseller4 = _reseller_rows($reseller3->reseller)){
						$margin_rate = $reseller4->margin - $reseller3->margin; // 마진차액 계산
						$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
						$order_prices = $order_prices - $margin_amount;
						_reseller_emoney_up($margin_amount,$reseller4->email,"[리셀러] Grade4 마진 적립 <".$reseller3->email." : order($order_uid)");
					}

					// 최종 남은 금액은 , 본사 적립
					_reseller_emoney_up($order_prices,"infohojin@naver.com","[리셀러] 마진 적립 < : order($order_uid)");


					$query = "UPDATE `service_orders` SET `order_auth`='on' where Id = '".$order_uid."'";
					_mysqli_query($query);


				} else {
					// $balance = $reseller_rows->emoney - $amount;
					$msg = "$balance 적립금이 부족합니다. 추가 입금을 확인해 주세요 ";
					echo "<script>alert(\"$msg\")</script>";
				}
			} else {
				$msg = "미등록 승인된 리셀러 입니다. 승인을 먼저 처리하세요.";
				echo "<script>alert(\"$msg\")</script>";
			}
		}

		function _service_auth_members($rows,$order_uid){
			// 일반 신규회원 및 연장처리 
			$query1 = "select * from `site_members` where email = '".$rows->email."'";
			if($rows1 = _mysqli_query_rows($query1)){
				$amount = $rows->setup + $rows->charge;
				if($rows1->emoney > $amount){







					

				} else {
					$msg = "적립금이 부족합니다. 추가 입금을 확인해 주세요 ";
					echo "<script>alert(\"$msg\")</script>";
				}
			} else {
				$msg = "미등록 승인된 리셀러 입니다. 승인을 먼저 처리하세요.";
				echo "<script>alert(\"$msg\")</script>";
			}

		}

		function _service_orders_rows($uid){
			$query = "select * from `service_orders` where Id='$uid'";
			if($rows = _mysqli_query_rows($query)){	
				return $rows;
			}	
		}

		function _reseller_renewal($uid){
			global $TODAYTIME;
		
			$query = "select * from `service_reseller` WHERE `Id`='$uid'";
			if($rows = _mysqli_query_rows($query)){

				$insert_filed = "`regdate`,";
				$insert_value = "'$TODAYTIME',";

				// 서비스 주문 형태가 리셀러
				$insert_filed .= "`type`,";	$insert_value .= "'reseller',";

				// 상위 리셀러 (이메일) 
				$insert_filed .= "`reseller`,";	$insert_value .= "'".$rows->reseller."',";
				
				// 신청자 이메일 
				$insert_filed .= "`email`,";	$insert_value .= "'".$rows->email."',";

				// 선택한 리셀러 그레이드 및 서비스 상품
				$insert_filed .= "`grade`,";	$insert_value .= "'".$rows->grade."',";
					
				$insert_filed .= "`margin`,";	$insert_value .= "'".$rows->margin."',";
				$insert_filed .= "`setup`,";	$insert_value .= "'".$rows->setup."',";
				$insert_filed .= "`charge`,";	$insert_value .= "'".$rows->charge."',";
				$insert_filed .= "`priod`,";	$insert_value .= "'1',";

				$title = "리셀러 연장 결제 ";
				$insert_filed .= "`title`,";	$insert_value .= "'$title',";

				$query = "INSERT INTO `service_orders` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				_mysqli_query($query);
			}
			
		}

		if($mode == "auth"){
			// 주문 승인
			if($rows = _service_orders_rows($uid)){	
				if($rows->type == "reseller"){
					// 리벨러 신규 및 연장 처리
					_service_auth_reseller($rows,$uid);
				} else {
					// 일반 신규회원 및 연장처리 
					_service_auth_members($rows,$uid);
				}
			}
		
		} else if($mode == "reseller_renewal"){
			_reseller_renewal($uid);
		}	
	

		$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data' >
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		$query = "select * from `service_reseller` where email = '".$_COOKIE['cookie_email']."'";
		if($reseller_rows = _mysqli_query_rows($query)){
			$body = str_replace("{name}","<a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->name."</a> ( <a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->email."</a>  )",$body);
			$body = str_replace("{emoney}","<a href='#' onclick=\"javascript:emoney_list('list','".$reseller_rows->Id."')\" >".number_format($reseller_rows->emoney,0,'.',',')."</a>원",$body);

			if($reseller_rows->auth_req){
				$button ="<input type='button' value='리셀러추가' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
				$body = str_replace("{new}",$button,$body);
				
			} else {
				$body = str_replace("{new}","<input type='button' value='승인대기중' style=\"".$css_btn_gray."\" >",$body);
			}
		} else {
			$body = str_replace("{name}","",$body);
			$body = str_replace("{emoney}","0원",$body);
			$button ="<input type='button' value='리셀러신청' onclick=\"javascript:reseller_reg('reseller','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);
		}

		$button ="<input type='button' value='입금승인' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{in_check}",$button,$body);

		$button ="<input type='button' value='출금승인' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{out_check}",$button,$body);

		$button ="<input type='button' value='연장&신규' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{renewal_check}",$button,$body);

		//////////////////////

		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >타입</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >신청자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>내역</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >금액</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>상태</td>";
		$list .= "</tr></table>";

		$body = str_replace("{order_list}",$list."{order_list}",$body);		


		$query = "select * from `service_orders` where reseller = '".$_COOKIE['cookie_email']."' order by Id desc";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";

			$css_btn_auth ="width:80px; font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:20px;	font-size:12px; border:1px solid #ff0000;";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->type."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->email."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->title."</td>";

				$moeny = $rows->setup + $rows->charge;
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$moeny."</td>";

				if($rows->order_auth){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>주문취소</td>";
				} else {
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>
						<input type='button' value='주문승인' onclick=\"javascript:order_auth('auth','".$rows->Id."')\" style=\"".$css_btn_auth."\" >
					</td>";
				}
				$list .= "</tr></table>";

				
			}
			// echo $list;
			$body = str_replace("{order_list}",$list,$body);
			
		} else {
			$msg = "내역이 없습니다.";
			$body = str_replace("{order_list}",$msg,$body);

		}	
	
		
		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>