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
			echo "<meta http-equiv='refresh' content='0; url=admin_board.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;

			$code = $_POST['code'];
			$title = $_POST['title'];
    		
    		$html = $_POST['html']; $html = addslashes($html);    						

			if(!$title) msg_alert("오류! 제목이이 없습니다.");
    		else {
    		

    				$query = "INSERT INTO `shop_board` (`regdate`,  `code`, `title`, `html`) 
    					VALUES ('$TODAYTIME',  '$code', '$title', '$html');";
					echo $query."<br>";
					mysql_db_query($mysql_dbname,$query,$connect);  
				
				
					$query = "select * from `shop_board` where regdate = '$TODAYTIME' and code = '$code' and title = '$title' order by Id desc";
					echo $query."<br>";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
					if( mysql_affected_rows() ){ 
			    		$rows=mysql_fetch_array($result);
			    		
						//*** 로고이미지 등록
    					///////////////////
				
    					if ($_FILES["userfile1"][tmp_name]){
	
   		 					if(!is_dir("../board")) $an = mkdir("../board");
  				
							$uploadfile1  = "../board/".$_FILES[userfile1][name];
						
							$i=1;
							if ($_FILES["userfile".$i][tmp_name]) {
   								$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   								if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   							}	
							
							if ($_FILES["userfile1"][tmp_name]) $filename1 = "../board/board-$code-$rows[Id]";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../board/board-$code-$rows[Id].".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_board` SET `file1`='./board/board-$code-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images1 = "./board/board-$code-$rows[Id].".$ext;
								
    	  				} else $images1 = "";
      				


					} //
				
				
  				
			}    						    			
    						    			
    		
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

