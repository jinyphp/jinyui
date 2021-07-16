<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";

		
	////////////////////////
	
	if($_COOKIE[adminemail]){ ///////////////
	
	
		if($_SESSION['nonce'] != $_POST['nonce']){
			$_SESSION['nonce'] = NULL;	
			echo "<meta http-equiv='refresh' content='0; url=admin_country.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;
	
    	
   			include "../func_files.php";
    		include "../func_skin.php";

			$pages = $_POST['pages'];
    		$language1 = $_POST['language1'];
    		$pc_skin = $_POST['pc_skin']; $pc_skin = addslashes($pc_skin);
    		$mobile_skin = $_POST['mobile_skin']; $mobile_skin = addslashes($mobile_skin);				

    		if(!$language1) msg_alert("오류! 언어설정이 없습니다.");
    		else {
    		
    			$query = "SELECT * FROM `shop_desgin` WHERE `code`='$rows[code]' and `pages`='$rows[pages]'";
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					$msg = multiString_conv("ko","중복된 스킨이름 입니다.",$LANG);
    				msg_alert($msg);
				} else {
    		
    		
    			////////////////////
    			$query = "INSERT INTO `shop_desgin` (`code`, `pages`, `mobile`, `pc`) VALUES ('$language1', '$pages', '$mobile_skin', '$pc_skin');";
				// echo "$query";
				mysql_db_query($mysql_dbname,$query,$connect);  
				
				///////////////
				if($pc_skin) SkinFileSave($LANG,$pages."_pc.htm",$pc_skin);
				else {
					if(strstr($pages,"admin")){
						// 어드민 파일...
						if(file_exists("./$LANG/".$pages."_pc.htm")){
						
							$html1 = FileLoad("./$LANG/".$pages."_pc.htm");
							$html1 = addslashes($html1);
							
							$query = "UPDATE `shop_desgin` SET `pc`='$html1' WHERE `code`='$language1' and `pages`='$pages'";
    						mysql_db_query($mysql_dbname,$query,$connect);
						
						}
					} else {
						// Shop 스킨
						if(file_exists("../$LANG/".$pages."_pc.htm")){
											
							$html1 = FileLoad("../$LANG/".$pages."_pc.htm");
							$html1 = addslashes($html1);
							
							$query = "UPDATE `shop_desgin` SET `pc`='$html1' WHERE `code`='$language1' and `pages`='$pages'";
    						mysql_db_query($mysql_dbname,$query,$connect);
						
						}	
					}
					
				}
				
				//////////////
    			if($mobile_skin) SkinFileSave($LANG,$pages.".htm",$mobile_skin); 
    			else {
					if(strstr($pages,"admin")){
						// 어드민 파일...
						if(file_exists("./$LANG/".$pages.".htm")){
							$html2 = FileLoad("./$LANG/".$pages.".htm");
							$html2 = addslashes($html2);
							
							$query = "UPDATE `shop_desgin` SET `mobile`='$html2' WHERE `code`='$language1' and `pages`='$pages'";
    						mysql_db_query($mysql_dbname,$query,$connect);
						}	
					} else {
						// Shop 스킨
						if(file_exists("../$LANG/".$pages.".htm")){
							$html2 = FileLoad("../$LANG/".$pages.".htm");
							$html2 = addslashes($html2);
							
							$query = "UPDATE `shop_desgin` SET `mobile`='$html2' WHERE `code`='$language1' and `pages`='$pages'";
    						mysql_db_query($mysql_dbname,$query,$connect);
						}	
					}
					
				}
				
 				//////////
 				
 				
 				
 				}
    							
			}    						    			
    						    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_design.php'>";
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

