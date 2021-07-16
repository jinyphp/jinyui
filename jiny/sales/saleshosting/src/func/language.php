<?php

	// ===========================================================
	// 페이지 로딩시, 사이트 언어 체크 
 	$__site_language = _formdata("lang");
	if( $__site_language && $__site_language != ""){
		// 직접 입력
		// 소문자로 변환하여 저장 
		$site_language = strtolower($temp);
		$_SESSION['session_language'] = $__site_language;
		
	} else {
	
		if(isset($_SESSION['session_language'])){
			//섹션값이 설정되어 있을 경우, 섹션값 적용.
			//echo "섹션값이 설정되어 있을 경우, 섹션값 적용.";
			$site_language = $_SESSION['session_language'];
		} else {
			$domain = $_SERVER['HTTP_HOST'];
			$query = "select * from `site_env` where domain = '".$domain."'";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){
				$site_language = $rows->language;
			} else {
				$site_language = "ko";
			}
		}
	}


	function _language_bar($lang){
		// echo "country is $country, language is $lang <br>";
		$query = "select * from `site_language` where enable = 'on'";
		if($rowss = _mysqli_query_rowss($query)){
			
			for($list="",$i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];
				$title = stripslashes($rows->name);
				$name = json_decode($title);
				
				if($lang) $language_name = $name->$lang; else $language_name = $name->ko; 

				// $country_name = $name->$lang; 

				/*
				
				if($country == $rows->code) {
					$list .= "<b><a href='#'>".$title->$site_language."</a></b>";
				} else {
					$list .= "<a href='#'>".$title->$site_language."</a>";
				}
				*/

				$url = $_SERVER['PHP_SELF']."?lang=".$rows->code;
				$list .= "<a href='$url'>".$language_name."</a>";

				if($i < (count($rowss)-1)) $list .= " | ";
				
			}
		}
		
		return $list;
	}


?>