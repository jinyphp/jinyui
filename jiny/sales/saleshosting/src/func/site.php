<?php
	//*  WebLib V1.5
	//*  Program by : hojin lee
	//*  
	//*
	// update : 2016.01.04 = 코드정리 


	//
	// 도메인 사이트 환경정보
	// 도메인 환경정보를 읽어옴입니다.
	function _site_env($domain){
		global $site_language;
		$query = "select * from `site_env` where domain = '$domain'";
		if($rows = _mysqli_query_rows($query)){
			return $rows;

		} else {
			// 접속한 도메인 환경설정 값이 없는 경우, 디폴트 환경 설정값을 읽어옴.
			$query = "select * from `site_env`";
			if($rows = _mysqli_query_rows($query)){
				return $rows;			
			} else {
				$msg = "도메인 환경설정 값을 읽어올 수 없습니다.";
				$msg_string = _string($msg,$site_language);
				echo $msg;
			}
		}
	}

	$domain = $_SERVER['HTTP_HOST'];
	echo $domain;

	$site_env = _site_env($domain); // 접속 도메인의 환경 설정값
	// echo $site_env->domain."...";


	// ********** *********** ***********



	
	// 사이트 스킨 입력코드 
	function _skin_name(){
		if($skin = _formdata("skin")){
			return $skin;
		} else {
			return "default";
		}
	}

	// 사이트 스킨값을 읽어옴
	$skin_name = _skin_name();
	


	// 리셀러 코드 입력처리
	// 입력변수 : ?reseller=xxxx
	$__site_reseller = _formdata("reseller");
	if( $__site_reseller && $__site_reseller != ""){
		// 직접 리셀러 코드값 입력시, 바로 섹션 저장
		$_SESSION['session_reseller'] = $__site_reseller;
		$query = "select * from `service_reseller` where reseller = '".$__site_reseller."'";
		if($reseller_rows = _mysqli_query_rows($query)){
			$site_reseller = $reseller_rows->code;
		} else {
			$site_reseller = "saleshosting";
		}
	} else {

		if(isset($_SESSION['session_reseller'])){
			//섹션값이 설정되어 있을 경우, 섹션값 적용.
			//echo "섹션값이 설정되어 있을 경우, 섹션값 적용.";
			$site_reseller = $_SESSION['session_reseller'];
		} else {
			// 리셀러 코드가 없는 경우, 호드트 도메인 정보로 리셀러를 찾음. 
			$domain = $_SERVER['HTTP_HOST'];
			$query = "select * from `service_reseller` where domain = '".$domain."'";
			if($reseller_rows = _mysqli_query_rows($query)){
				$site_reseller = $reseller_rows->code;
			} else {
				$site_reseller = "saleshosting";
			}
		}	
	}


	// 관리자 로그인 체크
	// 사이트 관리자 모드 접속 여부 
	$__site_admin = _formdata("admin");
	if( $__site_admin && $__site_admin != ""){
		if($site_env->adminkey == $__site_admin) $_SESSION['session_admin'] = $__site_admin;
		// echo "admin mode<br>";
	}	


	// 사이트 환경 설정 관련 함수


	// ++ 메뉴코드
	// ++ 현재 로그인 상태에 따라 메뉴코드가 클림
	if(isset($_COOKIE['cookie_email'])){
		if($site_env->menu_code_login){
			$site_menuCode = $site_env->menu_code_login;
		} else {
			// 기본 메뉴값이 없는 경우, default로 처리
			if($site_env->menu_code){
				$site_menuCode = $site_env->menu_code;
			} else $site_menuCode = "default";
		}
	} else {
		// 기본 메뉴값이 없는 경우, default로 처리
		if($site_env->menu_code){
			$site_menuCode = $site_env->menu_code;
		} else $site_menuCode = "default";
	}
	
