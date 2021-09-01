<?php


	function _mail($to,$subject,$body){

		$limit = 10;  // 첨부파일 제한 용량 (단위:MB)

		// $to 값이 공백일 경우 에러출력 후 한페이지 뒤로 이동
 		if(!ereg("([^[:space:]]+)",$to)) {
  			$msg = "메일을 받는사람의 메일주소가 필요합니다.";
  			exit;
 		}

 		// $to 값이 정확한 이메일 주소가 아닐 경우 에러출력 후 한페이지 뒤로 이동
	 	if(!ereg("([a-zA-Z0-9,_]{2,15})@([a-zA-Z0-9]{2,15}).([a-zA-Z0-9]{2,15})", $to, $regs)) {
	  		$msg = "받는사람의 Email 주소 형식이 틀립니다. [예] yourmail@server.domain";
	  		exit;
	 	}

		// $subject 값이 공백일 경우 에러출력 후 한페이지 뒤로 이동
		if(!ereg("([^[:space:]]+)",$subject)) {
		  	$msg = "메일 제목이 없습니다. 메일 제목을 입력해 주십시오.";
		  	exit;
		}

		$boundary = "----".uniqid("part"); // 이메일 내용 구분자 설정
		//## 헤더생성 ##
	 	$header .= "Return-Path: $from\r\n";    // 반송 이메일 주소
	 	$header .= "From: $from\r\n";      // 보내는 사람 이메일 주소
	 	$header .= "MIME-Version: 1.0\r\n";    // MIME 버전 표시
	 	$header .= "Content-Type: Multipart/mixed; boundary = \"$boundary\"";  // 구분자가 $boundary 임을 알려줌

		//## 여기부터는 이메일 본문 생성 ##
	 	$mailbody .= "This is a multi-part message in MIME format.\r\n\r\n";  // 메세지
	 	$mailbody .= "--$boundary\r\n";               // 내용 구분 시작
		//내용이 일반 텍스트와 html 을 사용하며 한글이라고 알려줌
	 	$mailbody .= "Content-Type: text/html; charset=\"ks_c_5601-1987\"\r\n";
		//암호화 방식을 알려줌
	 	$mailbody .= "Content-Transfer-Encoding: base64\r\n\r\n";
		//이메일 내용을 암호화 해서 추가
	 	$mailbody .= base64_encode(nl2br($body))."\r\n\r\n";


	 	//## 첨부 파일 개수만큼 루프를 돌면서 본문에 추가함 ##
	 	/*
 		for($i=1;$i<=5;$i++) {
  			if($rows["filename".$i]) {
  
	   			$file = FileLoad($rows["filename".$i]);
	   						
	   			$filename = basename($rows["filename".$i]); 
   
	   			// 파일첨부파트
	   			$mailbody .= "--$boundary\r\n";     // 내용 구분자 추가
	 			// 여기부터는 어떤 내용이라는 것을 알려줌
	   			$mailbody.= "Content-Type: ".$rows["filename".$i]."; name=\"".$filename."\"\r\n";
	 			//암호화 방식을 알려줌
	   			$mailbody .= "Content-Transfer-Encoding: base64\r\n";
	 			// 첨부파일임을 알려줌
	   			$mailbody .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	 			// 파일 내요을 암호화 하여 추가
	   			$mailbody .= base64_encode($file)."\r\n\r\n";
	  		}
	 	}
	 	*/


	 	// ## 첨부 파일 개수만큼 루프를 돌면서 본문에 추가함 ##
 		for($i=0;$i<count($userfile);$i++) {
  			if($userfile[$i]) {
 			
	 			// $limit 으로 설정한 용량 보다 클경우 에러 출력 후 뒤로 이동
	   			if($userfile_size[$i] > ($limit * 1024 * 1024)) {
	    			back(($i+1)."번째 첨부파일이 제한용량(".$limit."MB)을 초과하였습니다.");
	    			exit;
	   			}
   
	   			$filename = basename($userfile_name[$i]);  // 파일명만 추출 후 $filename에 저장
	   			$fp = fopen($userfile[$i], "r");     // 파일 open
	   			$file = fread($fp, $userfile_size[$i]);  // 파일 내용을 읽음
	   			fclose($fp);           // 파일 close
	   						
	   			echo " filetype $userfile_type[$i]<br>";
   
	   			// 파일첨부파트
	   			$mailbody .= "--$boundary\r\n";     // 내용 구분자 추가
	 			// 여기부터는 어떤 내용이라는 것을 알려줌
	   			$mailbody.= "Content-Type: ".$userfile_type[$i]."; name=\"".$filename."\"\r\n";
	 			//암호화 방식을 알려줌
	   			$mailbody .= "Content-Transfer-Encoding: base64\r\n";
	 			// 첨부파일임을 알려줌
	   			$mailbody .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	 			// 파일 내요을 암호화 하여 추가
	   			$mailbody .= base64_encode($file)."\r\n\r\n";
	  		}
	 	}


		if(!mail($to,addslashes($subject),$mailbody,$header)) $msg = "이메일 발송해 실패 하였습니다.";
 		else $msg = "메일을 발송하였습니다.";

		// $a = mail("infohojin@naver.com","제목","내용");

	}
	

?>