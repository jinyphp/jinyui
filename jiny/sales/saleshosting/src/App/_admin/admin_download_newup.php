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
			echo "<meta http-equiv='refresh' content='0; url=admin_skingoods.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;

			$enable = $_POST['enable'];
			$title = $_POST['title'];
			
			$ver = $_POST['ver'];
			
			$description = $_POST['description']; $description = addslashes($description);
			
			

			if(!$title) msg_alert("오류! 제목를 입력해주세요");
    		else {
    			$query = "INSERT INTO `shop_download` (`regdate`,`enable`, `title`, `ver`, `description`) 
    			VALUES ('$TODAYTIME','$enable', '$title', '$ver', '$description');";
				mysql_db_query($mysql_dbname,$query,$connect);  
				echo $query;
				
				///////////////////
				if ($_FILES["userfile1"][tmp_name]){

    			if(!is_dir("../download")) $an = mkdir("../download");
  			
				$uploadfile1  = "../download/".$_FILES[userfile1][name];
					
				$i=1;
				if ($_FILES["userfile".$i][tmp_name]) {
   					$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   					if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   				}	
						
				if ($_FILES["userfile1"][tmp_name]) $filename1 = "../download/file-$UID";
		
      			if ($_FILES["userfile".$i][tmp_name]) {
         			move_uploaded_file($_FILES["userfile".$i][tmp_name], "../download/file-$UID.".$ext);
      			}
      						
      			$query = "UPDATE `shop_download` SET `filename`='./download/file-$UID.".$ext."'  WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
      						
      			}

				/////////////////////////
				///////////////////
				if ($_FILES["userfile2"][tmp_name]){

    			if(!is_dir("../download")) $an = mkdir("../download");
  			
				$uploadfile2  = "../download/".$_FILES[userfile1][name];
					
				$i=2;
				if ($_FILES["userfile".$i][tmp_name]) {
   					$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   					if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   				}	
						
				if ($_FILES["userfile2"][tmp_name]) $filename2 = "../download/images-$UID";
		
      			if ($_FILES["userfile".$i][tmp_name]) {
         			move_uploaded_file($_FILES["userfile".$i][tmp_name], "../download/images-$UID.".$ext);
      			}
      						
      			$query = "UPDATE `shop_download` SET `images`='./download/images-$UID.".$ext."'  WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
      						
      			}

				/////////////////////////
				
				
			}    		
							    			
    		page_back2();				    			
    		

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

