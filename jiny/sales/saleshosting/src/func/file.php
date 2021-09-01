<?php

	// 파일 읽어오기 
	function _file_load($filename){
		if(_is_file($filename)){
			$fp = fopen($filename, "r");
			$buffer = "";
		
			if($fp){
	    		while (!feof ($fp)) $buffer .= fgets($fp, 4096);
	    		fclose($fp);
	    		return $buffer;
			} else {
	    		echo "Can not open $filename.\n";
	    		fclose($fp);
	    		return "";
			}
		} else {
			return "$filename 스킨/html 파일이 존재하지 않습니다.";
		}
	}

	// 파일 저장하기 
	function _file_save($filename,$body){
		if(is_file($filename)){ 
			unlink($filename); // 기존파일 먼저 삭제 
			//echo "$filename delete";
		} 
		//echo "$filename new";

		$file = fopen($filename,"w");
		fwrite($file,$body);
		fclose($file);
	}

	// 파일 삭제하기 
	function _file_delete($filename){
		unlink($filename);
	}

	// 파일 존재 확인 
	function _is_file($filename){
		return file_exists($filename);
	}

	// =====================
	// 디펙토리 관련 함수 제작

	// 입력된 path_dir 를 검사하여, 존재하지 않으면 단계별로 디렉토리 생성
	function _is_path($dir){
		if(!is_dir($dir)) {
			$path = explode("/",$dir);
			for($i=0,$mkpath="";$i<count($path);$i++) {
						// echo $path[$i]."<br>";
				if($path[$i] == ".") $mkpath .= $path[$i]."/";
				else {
					$mkpath .= $path[$i]."/";
					if(!is_dir($mkpath)) {
						// echo "create mkdir :".$mkpath."<br>";
						mkdir($mkpath);
					} else {
						// echo "exist : ".$mkpath."<br>";
					}
				}
			}
		}
		
		return true;
	}

	// 디렉토리 체크
	function _is_dir($dir){
		return is_dir($dir);
	}

	// 디렉토리 생성
	function _mkdir($mydir){
		if(!is_dir($mydir)) $dir = mkdir($mydir);
	}

	// 디렉토리 삭제
	function _dir_rm(){

	}

	// 디렉토리 이동
	function _dir_mv(){

	}


	// 장바구니 key, 디렉토리 생성
	function _mk_order_dir($mydir){

		$THIS_YEAR = date("Y",time());
    	$THIS_MONTH = date("m",time());
		$THIS_DAY = date("d",time());

		_mkdir($mydir);

		$mydir .= "/$THIS_YEAR";
		_mkdir($mydir);

		$mydir .= "/$THIS_MONTH";
		_mkdir($mydir);

		$mydir .= "/$THIS_DAY";
		_mkdir($mydir);

	}

?>