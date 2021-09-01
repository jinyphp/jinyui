<?php

	// ===========================================================
	// 페이지 로딩시, 모바일 접속 여부 체크

	// require_once ("/Mobile_Detect.php");
	$detect = new \Modules\MobileDetect;

 	$__mobile=_formdata("mobile");
 	if($__mobile == "m"){
 		$site_mobile = "m";
		$_SESSION['session_mobile'] = "m";
 	} else if($__mobile == "pc"){
	 	$site_mobile = "";
		$_SESSION['session_mobile'] = "pc";
 	} else if(isset($_SESSION['session_mobile'])){
 		if( $_SESSION['session_mobile'] == "m") $site_mobile = "m";
		else if( $_SESSION['session_mobile'] == "pc") $site_mobile = "";
 	} else {
 		// 섹션 값이 없을때, 검색...
		if( $detect->isMobile() ) {// Any mobile device (phones or tablets).
 			if( $detect->isTablet() ){// Any tablet device.
				$site_mobile = "m";
				$_SESSION['session_mobile'] = "m";
			} else {
 				$site_mobile = "m";
 				$_SESSION['session_mobile'] = "m";
 			}
		} else {
			$site_mobile = "";
			$_SESSION['session_mobile'] = "pc";
		}
 	}

 	// echo "site mobile = $site_mobile<br>";


?>