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
		// domain='".$_SERVER['HTTP_HOST']."' and 
		$query = "select * from `site_block` where code='$code' and enable='on'";
		if($rows = _mysqli_query_rows($query)){
			echo "<div id=\"plug_block\" class=\"$code\">".stripslashes($rows->html)."</div>";



			/*
			if(count($rowss)>1){
				// 슬라이드로 처리
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];
					echo "<img src='./images/".$rows->images."' boarder='0'>";
				}
			} else {
				$rows = $rowss[0];
				// echo $rows->images;
				// echo "<img src='./images/".$rows->images."' boarder='0'>";

				
				$body ="<div class=\"title_images\" style=\"position:relative;z-index:3;\"> <img src='./images/".$rows->images."'";
                if($rows->alt) $body .=" alt=\"".$rows->alt."\"";
                if($rows->width) $body .=" width=\"".$rows->width."\"";
                if($rows->height) $body .=" height=\"".$rows->height."\"";
                $body .= " boarder='0'>";
                
                if($rows->inner){
                	$body .= "<div class=\"inner\" style=\"position:absolute;width:".$rows->inner_width."px;top:".$rows->inner_top."px;left:".$rows->inner_left."px;z-index:3;\">";
                   if($rows->inner_title) $body .= "<h3 class=\"title\">".$rows->inner_title."</h3>";
                   if($rows->inner_html) $body .= "<p class=\"description\">".$rows->inner_html."</p>";
                   $body .= "</div>";
                }
                $body .= "</div>";
                echo $body;
              	

                
			}
			*/

		} else {
			$msg = "$code 는 잘못된 코드값 입니다. 정보를 읽을 수 없습니다.";
			$msg_string = _string($msg,$site_language);
			echo $msg;
		}

	} else {
		$msg = "Block 코드가 없습니다.";
		$msg_string = _string($msg,$site_language);
		echo $msg;
	}


?>