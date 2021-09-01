<?
	//# #################
	//# 서비스 결제관련 함수들
	//#

	// 이머니 적립
	function _emoeny_save($emoney, $email){
		// 리셀러 회원 정보를 읽어옵니다.
		if($reseller_rows = _service_membersEmoneyRows_email($email)){			
			// 리셀러 적립금을 적립, 재저장. => 기록
			$balance = $reseller_rows->emoney + $emoney;
			_service_membersEmoneySet_email($balance,$email);
			return $balance;
		}
	}

	// 이머니 사용
	function _emonmey_use($emoney, $email){
		// 리셀러 회원 정보를 읽어옵니다.
		if($reseller_rows = _service_membersEmoneyRows_email($email)){			
			// 리셀러 적립금을 적립, 재저장. => 기록
			$balance = $reseller_rows->emoney - $emoney;
			_service_membersEmoneySet_email($balance,$email);
			return $balance;
		}
	}

	// 회원 이머니를 읽어온다.
	function _service_membersEmoneyRows_email($email){
		$query = "select * from `site_members` where email = '".$email."'";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}	
	}

	// 회원 이머니를 지정된 값으로 설정한다.
	function _service_membersEmoneySet_email($emoeny,$email){
		$query = "UPDATE `site_members` SET `emoney`='$emoeny' where email = '".$email."'";
		echo $query."<br>";
		_mysqli_query($query);
	}


	// 서비스 관련, 회원 이머니 사용처리
	function _service_membersEmoney_use($emoney, $email, $renewal, $title){
		if($members_rows = _service_membersEmoneyRows_email($email)){
			if($members_rows->emoney >= $emoney){
				
				// 회원 적립금을 차감후, 재저장. => 기록
				$balance = $members_rows->emoney - $emoney;
				_service_membersEmoneySet_email($balance,$email);
				// _service_emoneyHistory("-".$emoney, $balance, $email, $renewal, $title);

			} else {
				$msg = "적립금이 부족합니다.";
				echo $msg."<br>";
			}

		} else {
			$msg = "회원 정보를 읽어 올 수 없습니다.";
			echo $msg."<br>";
		}
	}



	// 리셀러별 마진 계층적 실행
	function _marginTreeLoop($type,$type_id,$emoney,$email){

		// 차감한 이머니를 , 리셀러트리 마진율에 따라 분배합니다.
		$amount = $emoney; // 결제한 총금액
		$amount_balance = $emoney; // 마진을 지급한 나머지 금액

		if($type == "hostingRegist" || $type == "hostingRenewal"){
			$rows = _service_hostRows($email); 
		} else if($type == "hostingRegist" || $type == "hostingRenewal"){
			$rows = _service_resellerRows($email); 
		}
		
		$reseller = $rows->reseller; // 현재 이메일의 상위 리셀러 정보를 읽어옵니다.
		$margin_rate = 0;

		// 1. 결제금액을 해당 이메일에서 이머니를 차감합니다.
		$balance = _emonmey_use($emoney, $email);	
		// 적립금 사용을 기록합니다.
		$title = "적립금 사용: $type($type_id) $email";
		echo $title."<br>";
		_emoneyHistory($type, $type_id, $emoney, $balance, $email, $title, "system", "on", $rows->reseller);

		
		for($i=0;$i<5;$i++){
			// 리셀러 정보를 읽음
			if($reseller_rows = _service_resellerRows($reseller)){
				if($reseller_rows->level > 0) { 
					// 마진율 차이많큼 계산
					$margin =  $amount / 100 * ($reseller_rows->margin - $margin_rate);
					$margin_rate = $reseller_rows->margin;  // 마지막 마진율 저장

					//if($amount_balance >= $margin){
						// 2. 상위 리셀러에게 마진을 지급합니다.
						$balance = _emoeny_save($margin, $reseller);

						// 기록음 남김
						$title = "레벨:".$reseller_rows->level." 마진율:".$reseller_rows->margin."%  금액:".$margin." ".$email." <br>";
						echo $title."<br>";
						_emoneyHistory("margin", $type_id, $margin, $balance, $reseller, $title, "system", "on", $reseller_rows->reseller);

						// 리셀러 정보를 상위 리셀러로 변경후 loop 재실행
						$amount_balance -= $margin;  
						$reseller = $reseller_rows->reseller; 
						if($reseller_rows->level == 1) break;

					//} else {
						//echo "마진을 지급하기 위해서 금액이 부족합니다.";
					//}

				} else {
					break; // 최상의 레벨의 경우 루프 탈출						
				} 			
			} else {
				echo $reseller." 리셀러 회원 정보를 읽어올 수 없습니다.";
			}
		}

	}



	// 서비스: 이머니 사용기록을 남김
	// 이머니기록 : 리셀러 신규가입
	function _emoenyHistory_hostingRegist($type_id, $emoney, $balance, $email, $title, $reseller){
		_emoneyHistory("hostingRegist", $type_id, $emoney, $balance, $email, $title, "system", "on", $reseller);
	}

	function _emoneyHistory_hostingRenewal($type_id, $emoney, $balance, $email, $title, $reseller){
		_emoneyHistory("hostingRenewal", $type_id, $emoney, $balance, $email, $title, "system", "on", $reseller);
	}

	function _emoenyHistory_resellerRegist($type_id, $emoney, $balance, $email, $title, $reseller){
		_emoneyHistory("resellerRegist", $type_id, $emoney, $balance, $email, $title, "system", "on", $reseller);
	}

	function _emoneyHistory_resellerRenewal($type_id, $emoney, $balance, $email, $title, $reseller){
		_emoneyHistory("resellerRenewal", $type_id, $emoney, $balance, $email, $title, "system", "on", $reseller);
	}

	function _emoneyHistory($type, $type_id, $emoney, $balance, $email, $title, $name, $auth, $reseller){
		global $TODAYTIME;

		$insert_filed = "`regdate`,";		// 기록일자와 시간
		$insert_value = "'$TODAYTIME',";

		$insert_filed .= "`reseller`,";		// 리셀러 이메일
		$insert_value .= "'$reseller',";	// 이머니 기록 검색시, 해당 리셀러 내용만 출력하고 싶을때
			
		$insert_filed .= "`email`,";		// 이머니기록 이메일주소
		$insert_value .= "'$email',";

		$insert_filed .= "`name`,";			// 소유자 이름	
		$insert_value .= "'$name',";
		
		$insert_filed .= "`type`,";			// 이머니 타입		
		$insert_value .= "'$type',";  		// 적립, 사용, 입금, 출금, 호스팅신청, 호스팅연장, 리셀러신청, 리셀러연장

		$insert_filed .= "`type_id`,";		// 	
		$insert_value .= "'$type_id',";  	// 

		$insert_filed .= "`title`,";		// 이머니 타일틀 네임
		$insert_value .= "'$title',";
			
		$insert_filed .= "`emoney`,";		// 이머니 금액		
		$insert_value .= "'$emoney',";

		$insert_filed .= "`balance`,";		// 현재 잔액
		$insert_value .= "'$balance',";

		$insert_filed .= "`auth`,";			// 자료 승인 여부
		$insert_value .= "'$auth',";

		$query = "INSERT INTO `site_members_emoney` ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		echo $query."<br>";
		_mysqli_query($query);	

	}


	











	//# #################
	//# 서비스 DB 관련 함수들
	//#

	// 서비스 호스트 정보를 읽어옵니다.
	function _service_hostRows_Id($uid){
		$query = "select * from service.service_host WHERE Id = $uid";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}

	function _service_hostRows($email){
		$query = "select * from service.service_host WHERE email = '$email'";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}

	// 서비스 호스팅플랜 정보를 읽어옵니다.
	function _service_hostingPlanRows_Id($uid){
		$query = "select * from service.hosting_plan WHERE Id = $uid";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}

	// 서비스 호스팅 연장 정보를 읽어옵니다.
	function _service_hostingRenewalRows_Id($uid){
		$query = "select * from service.service_host_renewal WHERE Id = $uid";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}



	// 서비스 서버 정보를 읽어 옵니다.
	function _service_serverRows_Id($uid){
		$query = "select * from service.server WHERE Id = $uid";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}

	// 리셀러 정보 읽음
	function _service_resellerRows_Id($uid){
		$query = "select * from service.reseller WHERE Id = $uid";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}

	// 이메일 리셀러 정보 읽음
    function _service_resellerRows($email){
    	$query = "select * from service.reseller where email = '".$email."'";
    	// echo $query."<br>";
    	if($rows = _mysqli_query_rows($query)) return $rows;
    }

    // 서비스 레셀러 프로그램 정보를 읽어옵니다.
	function _service_resellerProgramRows_Id($uid){
		$query = "select * from service.reseller_program WHERE Id = $uid";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}

	// 서비스 리셀러 연장 정보를 읽어옵니다.
	function _service_resellerRenewalRows_Id($uid){
		$query = "select * from service.reseller_renewal WHERE Id = $uid";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}
	}



	//# #################
	//# 서비스 HTML form 관련 함수들
	//#

	function _service_serverRows_OnSelect($server,$reseller){
		global $css_textbox;

		$server_select = "<select name='server' style=\"$css_textbox\" id=\"server\">";
				
		$query = "select * from service.server where reseller='$reseller'";
		if($rowss = _mysqli_query_rowss($query)){
			if($server){
				$server_select .= "<option value=''>서버선택</option>";
			} else {
				$server_select .= "<option value='' selected>서버선택</option>";
			}
					
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($server == $rows1->name){
					$server_select .= "<option value='".$rows1->Id."' selected>".$rows1->name."</option>";
				} else $server_select .= "<option value='".$rows1->Id."'>".$rows1->name."</option>";
			}		
			
		}

		$server_select .= "</select>";
		return $server_select;
	}


	function _service_hostingPlanRows_OnSelect($hostingPlan){
		global $css_textbox;

		$query = "select * from service.hosting_plan where enable ='on'";
		$form_hostingPlan = "<select name='plan' style=\"$css_textbox\" >";
		if($rowss = _mysqli_query_rowss($query)){
			if($hostingPlan){
				$form_hostingPlan .= "<option value=''>호스팅유형 선택</option>";
			} else {
				$form_hostingPlan .= "<option value='' selected>호스팅유형 선택</option>";
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($hostingPlan == $rows1->Id) $form_hostingPlan .= "<option value='".$rows1->Id."' selected>".$rows1->title."</option>"; 
				else $form_hostingPlan .= "<option value='".$rows1->Id."'>".$rows1->title."</option>";
			}
			
			
		}
		$form_hostingPlan .= "</select>";
		return $form_hostingPlan; 
	}	

	function _service_resellerProgramRows_OnSelect($program){
		global $css_textbox;

		$query = "select * from service.reseller_program where enable ='on' order by level desc";
		$form_program = "<select name='program' style=\"$css_textbox\" >";
		if($rowss = _mysqli_query_rowss($query)){
			if($program){
				$form_program .= "<option value=''>리셀러프로그램 선택</option>";
			} else {
				$form_program .= "<option value='' selected>리셀러프로그램 선택</option>";
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($program == $rows1->Id) $form_program .= "<option value='".$rows1->Id."' selected>".$rows1->title."</option>"; 
				else $form_program .= "<option value='".$rows1->Id."'>".$rows1->title."</option>";
			}
			
			
		}
		$form_program .= "</select>";
		return $form_program; 
	}	

?>