<?php
	// Curl 관련 태스트 및 정리
	// 2016.01.03
	// Program by : hojin lee

	// POST 방식으로 접속 
	// ex)  $body = _curl_post("www.saleshosting.co.kr","postvar1=value1&postvar2=value2&postvar3=value3")
	function _curl_post($url,$postfild){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$postfild);

		// in real life you should use something like:
		// curl_setopt($ch, CURLOPT_POSTFIELDS, 
		// http_build_query(array('postvar1' => 'value1')));

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);	
		curl_close($ch);

		return $server_output;
	}

	// GET 방식으로 접속
	// ex) $body = curl_get("http://www.shinystamp.co.kr/json.txt"); 
	function curl_get($url) { 
    	$agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)"; 
    	
    	$ch = curl_init(); 
    
    	curl_setopt ($ch, CURLOPT_URL,             $url); 
    	curl_setopt ($ch, CURLOPT_HEADER,          0); 
    	curl_setopt ($ch, CURLOPT_RETURNTRANSFER,  1); 
    	curl_setopt ($ch, CURLOPT_POST,            0); 
    	curl_setopt ($ch, CURLOPT_USERAGENT,       $agent); 
    	curl_setopt ($ch, CURLOPT_REFERER,         ""); 
    	curl_setopt ($ch, CURLOPT_TIMEOUT,         3); 

    	$buffer = curl_exec($ch); 
    	$cinfo = curl_getinfo($ch); 
    	curl_close($ch); 

    	if ($cinfo['http_code'] != 200){ 
        	echo "Error 200";
        	return ""; 
    	} 

    	return $buffer; 
	} 


	function _curl_upload($mode,$target_url,$path,$file){

		$file_name_with_full_path = realpath($file);

		$post = array('mode'=>$mode, 'path'=>$path, 'file_contents'=>'@'.$file_name_with_full_path);
 
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$target_url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$result=curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}


	// POST 방식으로 로컬 파일 복사 
	// 수신 : curl_filecopy.php 필요
	// ex) _curl_filecopy("http://api.saleshosting.co.kr/curl_filecopy.php";,"./images/logo.gif");
	function _curl_filecopy($target_url,$path,$file){
		//This needs to be the full path to the file you want to send.
		// $file_name_with_full_path = realpath('./images/logo.gif');
		$file_name_with_full_path = realpath($file);

        /* curl will accept an array here too.
         * Many examples I found showed a url-encoded string instead.
         * Take note that the 'key' in the array will be the key that shows up in the
         * $_FILES array of the accept script. and the at sign '@' is required before the
         * file name.
         */

		$post = array('extra_info' => '123456abcd','path' => $path,'file_contents'=>'@'.$file_name_with_full_path);
 
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$target_url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$result=curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	
	/* curl_filecopy.php 내용 
	-------------------------------
	$uploaddir = realpath('./') . '/';
	$uploadfile = $uploaddir . basename($_FILES['file_contents']['name']);
	echo "uploadfile : $uploadfile <br>";
	echo '<pre>';
	if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	    echo "File is valid, and was successfully uploaded.\n";
	} else {
	    echo "Possible file upload attack!\n";
	}
	echo 'Here is some more debugging info:';
	print_r($_FILES);
	echo "\n<hr />\n";
	print_r($_POST);
	print "</pr" . "e>\n";
	------------------------------
	*/


    // POST 방식으로 form file 업로드
    function _curl_file($url,$postdata){

    }

	

?>