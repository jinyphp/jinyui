<?php
//헬퍼파일


function logsave($php_start)
{
	// ********************
	// 페이지 처리 속도를 측정합니다.
	$php_end = get_time();
	$php_time = $php_end - $php_start;
	echo "<!-- Second ".$php_time."-->";

	// ********************
	// 접속 로그기록...
	if(!$_SESSION['log']){
		// . $_SERVER['HTTP_ACCEPT_LANGUAGE'].";"
		$log = $TODAYTIME.";". $_SERVER['SERVER_NAME'].";". $_SERVER['REMOTE_ADDR'].";". $site_mobile.";". $_SERVER['HTTP_REFERER']." \n";
		$_SESSION['log'] = $log;

		if(!is_dir("./log")) mkdir("./log");
		$file = fopen("./log/$TODAY.log","a");
		fwrite($file, $log);
		fclose($file);
	}
}


/**
 * 스킨 처리
 */
function skin($skin, $vars=[])
{
	extract($vars); // 키명으로 변수화
	ob_start(); // 출력 버퍼링
	require($skin);
	return ob_get_clean(); // 버퍼를 반환합니다.
}








