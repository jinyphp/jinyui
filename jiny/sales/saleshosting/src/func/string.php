<?php
	//*  WebLib V1.5
	//*  Program by : hojin lee
	//*  
	//*

	// update : 2016.01.04 = 코드정리 


	// 다국어 문자열 처리 
	function _string($msg,$lang){
		return $msg;
	}


	function _multistring($lang,$src){
		$string = json_decode( iconv('CP949','UTF-8',$src) );
		if($lang) return $string->$lang; else $string->{'ko'}; 
	}


?>