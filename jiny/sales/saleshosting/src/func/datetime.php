<?php

	//*  WebLib V1.5
	//*  Program by : hojin lee
	//*  
	//*

	// update : 2016.01.04 = 코드정리 

	$TODAY = date("Y-m-d",time());
    $TODAYTIME = date("Y-m-d H:i:s",time());
    
    $THIS_YEAR = date("Y",time());
    $THIS_MONTH = date("m",time());
    $THIS_DAY = date("d",time());


    function _date_month($offset,$date){
    	$time = strtotime($date);
    	$month = strtotime($offset,$time);
    	return date("Y-m-d",$month);
    }

    function _date_after_1month($date){
    	$time = strtotime($date);
    	$month = strtotime("+1 months",$time);
    	return date("Y-m-d",$month);
    }



    function get_time() {
    	list($usec, $sec) = explode(" ", microtime());
    	return ((float)$usec + (float)$sec);
	}

	$php_start = get_time(); // php 코드 실행 시작 시간 저장 



	/*
	PHP 에서 날짜계산 정리
$time = time(); echo date("Y-m-d",strtotime("-1 day", $time))." 하루 전(어제)"; echo date("Y-m-d",strtotime("-1 day", $time))." 하루 전(어제)
"; echo date("Y-m-d",strtotime("now", $time))." 현재
"; echo date("Y-m-d",strtotime("+1 day", $time))." 하루 후(내일)
"; echo date("Y-m-d",strtotime("+1 week", $time))." 일주일 후
"; echo date("Y-m-d",strtotime("-1 month", $time))." 한달 전
"; echo date("Y-m-d",strtotime("+1 month", $time))." 다음달
"; echo date("Y-m-d",strtotime("+6 month", $time))." 6달후
"; echo date("Y-m-d",strtotime("+12 month", $time))." 12달후
"; echo date("Y-m-d",strtotime("next Thursday", $time))." 다음주 목요일
"; echo date("Y-m-d",strtotime("last Monday", $time))." 지난 월요일
"; echo date("Y-m-d",strtotime("10 September 2000", $time))." 2000년 9월 10일 
"; echo strtotime("+5 minutes"); " 현재 시간보다 5분 후";
쿼리문으로 날짜계산
$query = "SELECT (now() - interval ′1 month′)::timestamp"; // 현재 부터 한 달 전 날짜 $query = "SELECT (now() + interval ′6 month′)::timestamp"; // 현재 부터 6 달 후 날짜 ... 


	*/

?>