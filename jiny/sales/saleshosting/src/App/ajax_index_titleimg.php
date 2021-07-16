<?php
	//* ///////////////////////
	//* OpenShopping V2.1 
	//* Program By : hojin lee 
	//*
	
	// update : 2016.01.04 = 코드정리 

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";
	
	/////////////////
	// 타이틀 이미지 처리
	if($code = _formdata("code")){

		include ($_SERVER['DOCUMENT_ROOT']."/func/plugin_function.php");

		echo _plugIn_title($code);
		
		// domain='".$_SERVER['HTTP_HOST']."' and 
		/*
		$query = "select * from `site_index_title` where code='$code' and enable='on'";
		// echo $query."<br>";
		if($rowss = _mysqli_query_rowss($query)){
			if(count($rowss)>1){
				// 슬라이드로 처리
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];
					echo "<div id=\"title_$code\"> <img src='./images/".$rows->images."' boarder='0' style='max-width:100%;height:auto;'> </div>";
				}
			} else {
				$rows = $rowss[0];
				$body ="<div class=\"title_images\" style=\"position:relative;z-index:3;\" align=\"left\"> <img src='./images/".$rows->images."' boarder='0' style='max-width:100%;height:auto;'>";
                
                if($rows->inner){
                	$body .= "<div class=\"inner\" style=\"position:absolute;width:".$rows->inner_width."px;top:".$rows->inner_top."px;left:".$rows->inner_left."px;z-index:3;\">";
                   if($rows->inner_title) $body .= "<h3 class=\"title\">".$rows->inner_title."</h3>";
                   if($rows->inner_html) $body .= "<p class=\"description\">".$rows->inner_html."</p>";
                   $body .= "</div>";
                }
                $body .= "</div>";
                echo $body;
                
			}

		} else {
			$msg = "$code 는 잘못된 코드값 입니다. 정보를 읽을 수 없습니다.";
			$msg_string = _string($msg,$site_language);
			echo $msg;
		}
		*/

	} else {
		$msg = "title_images 코드가 없습니다.";
		$msg_string = _string($msg,$site_language);
		echo $msg;
	}


?>