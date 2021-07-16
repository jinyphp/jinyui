<?php	
	function fetch_page($url,$param,$cookies,$referer_url){
	// POST방식으로 데이터 전송(function)
		$agent = "'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)'";
		
		if(strlen(trim($referer_url)) == 0) $referer_url= $url; 
	
		$curlsession = curl_init ();

		curl_setopt ($curlsession, CURLOPT_URL, $url);
		curl_setopt ($curlsession, CURLOPT_POST, 1);
		curl_setopt ($curlsession, CURLOPT_POSTFIELDS, $param);
		curl_setopt ($curlsession, CURLOPT_POSTFIELDSIZE, 0);
		curl_setopt ($curlsession, CURLOPT_TIMEOUT, 60);

		if($cookies && $cookies != "") curl_setopt ($curlsession, CURLOPT_COOKIE, $cookies);

		// curl_setopt ($curlsession, CURLOPT_HEADER, 1); //헤더값을 가져오기위해 사용합니다. 쿠키를 가져오려고요.
		curl_setopt ($curlsession, CURLOPT_HEADER, 0); 
		curl_setopt ($curlsession, CURLOPT_USERAGENT, $agent);
		curl_setopt ($curlsession, CURLOPT_REFERER, $referer_url); 

		ob_start();

		$res = curl_exec ($curlsession);
		$buffer = ob_get_contents();
		ob_end_clean();

		if (!$buffer) $returnVal = "Curl Fetch Error : ".curl_error($curlsession);
		else $returnVal = $buffer;
		
		curl_close($curlsession); 

		return $returnVal;
	} 

	
	function _curl_get_content($url) {
	// : cURL을 이용한 웹페이지 가져오기
		$agent = "'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)'";
		
		$curlsession = curl_init ();
		
		curl_setopt ($curlsession, CURLOPT_URL, $url);
		curl_setopt ($curlsession, CURLOPT_HEADER, 0);
		curl_setopt ($curlsession, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curlsession, CURLOPT_POST, 0);
		curl_setopt ($curlsession, CURLOPT_USERAGENT, $agent);
		curl_setopt ($curlsession, CURLOPT_REFERER, "");
		curl_setopt ($curlsession, CURLOPT_TIMEOUT, 3);
		$buffer = curl_exec ($curlsession);
		$cinfo = curl_getinfo($curlsession);
		curl_close($curlsession);
		
		if ($cinfo['http_code'] != 200){
			return "";
		}
		
		return $buffer;
	}
	
	/*
	
	[예제3 : 파일 전송]

	$post_data['data[0]'] = "@image/img_01.jpg";
	$post_data['data[0]'] = "@image/img_02.jpg";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, http://www.example.com/upload.php);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	$postResult = curl_exec($ch);
	
	*/
	
	
    
?>
