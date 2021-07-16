<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*	 회원 관련 처리함수

	//# update : 2016.01.20 코드정리 

	function _cookie_email(){
		if(isset($_COOKIE['cookie_email'])){
			return $_COOKIE['cookie_email'];
		} else return NULL; 
	}




	// 회원 정보 읽어옴.
	function _members_rows($email){
		$query = "select * from `site_members` WHERE `email`='$email'";
		if($rows = _mysqli_query_rows($query)){	
			return $rows;
		}	
	}

	function _members_id_rows($uid){
		$query = "select * from `site_members` WHERE `Id`='$uid'";
		
		if($rows = _mysqli_query_rows($query)){	
			return $rows;
		}	
	}


	function _is_members($email){
		$query = "select * from `site_members` WHERE `email`='$email'";
		if($rows = _mysqli_query_rows($query)){	
			return true;
		} else return false;
	}

	// 예약된 이메일 주소 확인 , 가입불가 
	function _member_reserved($email){
		$query = "select * from `site_members_reserved` WHERE `email`='$email'";
		if($rows = _mysqli_query_rows($query)){	
			return true;
		} else return false;

	}

	function _member_save($mem){
		$TODAYTIME = date("Y-m-d H:i:s",time());
		$domain = $_SERVER['HTTP_HOST'];
		
		if(isset($_SESSION['http_ref'])) $http_ref = $_SESSION['http_ref']; else $http_ref = "";

		$query = "INSERT INTO `site_members` (`regdate`, `email`, `password`, `username`, `userphone`, `sex`, `post`, `address`, 
							`country`, `language`, `currency`, `lastlog`, `point`, `money`,`auth`, `domain`,`http_ref`) 
							VALUES ('$TODAYTIME', '".$mem['email']."', '".$mem['password']."', 
							'".$mem['manager']."', '".$mem['phone']."', '".$mem['sex']."', '".$mem['post']."', '".$mem['address']."', 
							'".$mem['country1']."', '".$mem['language1']."', '".$mem['currency']."', '".$TODAYTIME."', 
							'".$mem['point']."', '".$mem['money']."', '".$mem['auth']."', '$domain', '$http_ref');";
    	_mysqli_query($query);	
	}

	// 회원 페스워드 설정
	function _member_set_password($email){

	}

	// 회원 삭제
	function _member_delete($email){

	}

	// 회원 인증
	function _member_auth($email){

	}

	// 회원 브랙처리 
	function _member_block($email){

	}

	// 회원 마지막 로그인 기록
	function _member_lastlog($email){
		$TODAYTIME = date("Y-m-d H:i:s",time());

		$query = "UPDATE site_members SET lastlog = '$TODAYTIME' WHERE email='".$email."'";
    	_mysqli_query($query);
	}

	// 회원 이메일 주소를 변경함.
	function _member_email_change($email){

		// 회원 이메일 정보들 모드 변경함.

		// CART

		//order

		//order_detail
	}






?>