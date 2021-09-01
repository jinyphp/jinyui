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
			echo "<meta http-equiv='refresh' content='0; url=admin_language.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;
    		
    		// $countryCode = $_GET['code']; if(!$countryCode) $countryCode = $_POST['code']; if(!$countryCode) $countryCode = $COUNTRY; 

			$code = $_POST['code'];
    		
    		$language1 = $_POST['language1'];
    		$enable = $_POST['enable'];
    						

			// skin Directory 생성....
			
			if(!is_dir("../$code")) $an = mkdir("../$code");
			/// copy("../en/*.*","../$code/");
			

			if(!$code) msg_alert("오류! 코드 없습니다.");
    		else if(!$language1) msg_alert("오류! 언어명이 없습니다.");
    		else {
    			$query = "select * from `shop_language` where code = '$code'";
    			
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
		    		msg_alert("오류! 중복된 $code 입니다.");
				} else {
    				
    				$query = "INSERT INTO `shop_language` (`code`, `language`, `enable`) VALUES ('$code',  '$language1', '$enable');";
					mysql_db_query($mysql_dbname,$query,$connect);
					
					//% 언어명 필드 추가
					$query = "ALTER TABLE `shop_language` ADD COLUMN `$code` varchar(255) CHARACTER SET 'utf8' NULL;";
					mysql_db_query($mysql_dbname,$query,$connect);
					

					
					$query = "ALTER TABLE `shop_cate` ADD COLUMN `$code` varchar(255) CHARACTER SET 'utf8' NULL;";
					mysql_db_query($mysql_dbname,$query,$connect);
					//echo $query."<br>";
					
					
					// #1118 - Row size too large. The maximum row size for the used table type, not counting BLOBs, is 65535. You have to change some columns to TEXT or BLOBs 
					
					//% 언어별 언어이름 설정저장
					$query = "select * from `shop_language` ";
					$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
		
					$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(mysql_affected_rows()) {
						for($i=0;$i<$total;$i++){
							$rows=mysql_fetch_array($result);
    						$codetext = $rows[code];
    						$codetext1 = "name_".$rows[code];
    						$query1 = "UPDATE `shop_language` SET `$codetext`='".$_POST[$codetext1]."'  WHERE `code`='$code'";
    						//echo $query1."<br>"; 
    						mysql_db_query($mysql_dbname,$query1,$connect);
    						
    					}
    				}

	
					

					////////////////
				
				}
				
				
			}    						    			
    						    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_language.php'>";
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
				
					
?>

