<?php

	// 이메일 key를 통하여 리셀러 정보 읽음
	function _is_reseller($email){
    	$query = "select * from `service_reseller` where email = '".$_COOKIE['cookie_email']."'";
    	if($rows = _mysqli_query_rows($query)) return $rows;
    }

    // 이메일 key를 통하여 리셀러 정보 읽음
    function _reseller_rows($email){
    	$query = "select * from `service_reseller` where email = '".$_COOKIE['cookie_email']."'";
    	if($rows = _mysqli_query_rows($query)) return $rows;
    }

    // ID key를 통하여 리셀러 정보 읽음
    function _reseller_id_rows($uid){
			$query1 = "select * from `service_reseller` where Id = '".$uid."'";
			if($reseller_rows = _mysqli_query_rows($query1)){
				return $reseller_rows;
			}	
	}

	function _reseller_delete_byId($uid){
		$query = "DELETE FROM `service_reseller` WHERE `Id`='$uid'";
    	_mysqli_query($query);
	}








	

	// 이머니 기록을 남긴다.
	// 인수값 : 회원정보, 이머니 , 타이틀
	function _service_resellerEmoney($emoney,$email,$title){
		global $TODAYTIME;

		if($reseller_rows = _service_emoneyRows_email($email)){
			$balance = $reseller_rows->emoney + $emoney;

			_service_emoenySet_email($balance,$email);

			// 기록
			$insert_filed = "`regdate`,"; $insert_value = "'$TODAYTIME',";
			$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";
			$insert_filed .= "`title`,";	$insert_value .= "'$title',";
			$insert_filed .= "`type`,";	$insert_value .= "'in',";
			$insert_filed .= "`emoney`,";	$insert_value .= "'$emoney',";
			$insert_filed .= "`balance`,";	$insert_value .= "'$balance',";

			$insert_filed .= "`name`,";	$insert_value .= "'system',";

			$insert_filed .= "`auth`,";	$insert_value .= "'on',";

			// 리셀러용 체크필드
			$insert_filed .= "`reseller`,"; $insert_value .= "'".$reseller_rows->reseller."',";

			$query = "INSERT INTO `site_members_emoney` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);

			return $balance;
		}
	}







	// 리셀러 : 이머니 적립 기록
	function _reseller_emoney_up($emoney,$email,$title){
		global $TODAYTIME;

		// $query1 = "select * from `site_members` where email = '".$email."'";
		if($reseller_rows = _service_emoneyRows_email($email)){
			$balance = $reseller_rows->emoney + $emoney;

			// $query = "UPDATE `site_members` SET `emoney`='$balance' where email = '".$email."'";
			// _mysqli_query($query);
			_service_emoenySet_email($balance,$email);

			// 기록
			$insert_filed = "`regdate`,"; $insert_value = "'$TODAYTIME',";
			$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";
			$insert_filed .= "`title`,";	$insert_value .= "'$title',";
			$insert_filed .= "`type`,";	$insert_value .= "'in',";
			$insert_filed .= "`emoney`,";	$insert_value .= "'$emoney',";
			$insert_filed .= "`balance`,";	$insert_value .= "'$balance',";

			$insert_filed .= "`name`,";	$insert_value .= "'system',";

			$insert_filed .= "`auth`,";	$insert_value .= "'on',";

			// 리셀러용 체크필드
			$insert_filed .= "`reseller`,"; $insert_value .= "'".$reseller_rows->reseller."',";

			$query = "INSERT INTO `site_members_emoney` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);

			return $balance;
		}
	}


	// 리셀러 : 이머니 사용 기록
	function _reseller_emoney_down($emoney,$email,$title){
		global $TODAYTIME;

		// $query1 = "select * from `site_members` where email = '".$email."'";
		if($reseller_rows = _service_emoneyRows_email($email)){
			$balance = $reseller_rows->emoney - $emoney;

			// $query = "UPDATE `site_members` SET `emoney`='$balance' where email = '".$email."'";
			// _mysqli_query($query);
			_service_emoenySet_email($balance,$email);

			// 기록
			$insert_filed = "`regdate`,"; $insert_value = "'$TODAYTIME',";
			$insert_filed .= "`email`,";	$insert_value .= "'".$email."',";
			$insert_filed .= "`title`,";	$insert_value .= "'$title',";
			$insert_filed .= "`type`,";	$insert_value .= "'out',";
			$insert_filed .= "`emoney`,";	$insert_value .= "'$emoney',";
			$insert_filed .= "`balance`,";	$insert_value .= "'$balance',";

			$insert_filed .= "`name`,";	$insert_value .= "'system',";
			
			$insert_filed .= "`auth`,";	$insert_value .= "'on',";

			// 리셀러용 체크필드
			$insert_filed .= "`reseller`,"; $insert_value .= "'".$reseller_rows->reseller."',";

			$query = "INSERT INTO `site_members_emoney` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);

			return $balance;
		}
	}






?>