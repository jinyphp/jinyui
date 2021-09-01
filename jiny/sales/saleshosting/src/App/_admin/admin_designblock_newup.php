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
			echo "<meta http-equiv='refresh' content='0; url=admin_designblock.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;

			$enable = $_POST['enable'];
			$code = $_POST['code'];
    		$useimage = $_POST['useimage'];
    		$images_url = $_POST['images_url'];
    		
    		$html = $_POST['html']; $html = addslashes($html);    						

			if(!$code) msg_alert("오류! 코드명이 없습니다.");
    		else {
    		
    			$query = "select * from `shop_designblock` where code = '$code' order by Id desc";
    			echo $query."<br>";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
    				msg_alert("오류! 이미 존재한 코드명 입니다.");

    			} else {

    				$query = "INSERT INTO `shop_designblock` (`regdate`, `enable`, `code`, `useimage`, `images_url`, `html`) 
    					VALUES ('$TODAYTIME', '$enable', '$code', '$useimage', '$images_url', '$html');";
					echo $query."<br>";
					mysql_db_query($mysql_dbname,$query,$connect);  
				
				
					$query = "select * from `shop_designblock` where regdate = '$TODAYTIME' and code = '$code' order by Id desc";
					echo $query."<br>";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
					if( mysql_affected_rows() ){ 
			    		$rows=mysql_fetch_array($result);
			    		
						//*** 로고이미지 등록
    					///////////////////
				
    					if ($_FILES["userfile1"][tmp_name]){
	
   		 					if(!is_dir("../skin")) $an = mkdir("../skin");
  				
							$uploadfile1  = "../skin/".$_FILES[userfile1][name];
						
							$i=1;
							if ($_FILES["userfile".$i][tmp_name]) {
   								$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   								if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   							}	
							
							if ($_FILES["userfile1"][tmp_name]) $filename1 = "../skin/block-$rows[Id]";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../skin/block-$rows[Id].".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_designblock` SET `images`='./skin/block-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images1 = "./skin/block-$rows[Id].".$ext;
								
    	  				} else $images1 = "";
      				


					} //
				
				}
  				
			}    						    			
    						    			
    		
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

