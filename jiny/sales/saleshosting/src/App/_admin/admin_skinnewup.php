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
			echo "<meta http-equiv='refresh' content='0; url=admin_skin.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;

			$enable = $_POST['enable'];
			$skinname = $_POST['skinname'];
    		$width = $_POST['width'];
    		$bgcolor = $_POST['bgcolor'];
    		$align = $_POST['align'];
    		
    		$skin_head = $_POST['skin_head']; $skin_layout = addslashes($skin_head);
    		$skin_body = $_POST['skin_body']; $skin_top = addslashes($skin_body);
    		// $skin_menu = $_POST['skin_menu']; $skin_menu = addslashes($skin_menu);
    		// $skin_bottom = $_POST['skin_bottom']; $skin_bottom = addslashes($skin_bottom);
    						

			if(!$skinname) msg_alert("오류! 스킨명이 없습니다.");
    		else {
    		
    			$query = "select * from `shop_skin` where skinname = '$skinname' order by Id desc";
    			echo $query."<br>";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
    				msg_alert("오류! 이미 존재한 스킨명 입니다.");

    			} else {

    				$query = "INSERT INTO `shop_skin` (`regdate`, `skinname`, `width`, `bgcolor`, `align`, `enable`, `head`, `body`) 
    					VALUES ('$TODAYTIME', '$skinname', '$width', '$bgcolor', '$align', '$enable', '$skin_head', '$skin_body');";
					echo $query."<br>";
					mysql_db_query($mysql_dbname,$query,$connect);  
				
				
					$query = "select * from `shop_skin` where regdate = '$TODAYTIME' and skinname = '$skinname' order by Id desc";
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
							
							if ($_FILES["userfile1"][tmp_name]) $filename1 = "../skin/logo-$rows[Id]";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../skin/logo-$rows[Id].".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_skin` SET `skinlogo`='./skin/logo-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images1 = "./skin/logo-$rows[Id].".$ext;
								
    	  				} else $images1 = "";
      				
    	  				//*** 메인타이틀 이미지 등록
    					///////////////////
				
    					if ($_FILES["userfile2"][tmp_name]){
	
   		 					if(!is_dir("../skin")) $an = mkdir("../skin");
  				
							$uploadfile2  = "../skin/".$_FILES[userfile2][name];
						
							$i=2;
							if ($_FILES["userfile".$i][tmp_name]) {
   								$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   								if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   							}	
							
							if ($_FILES["userfile2"][tmp_name]) $filename2 = "../skin/title-$rows[Id]";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../skin/title-$rows[Id].".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_skin` SET `skintitle`='./skin/title-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images2 = "./skin/title-$rows[Id].".$ext;
								
    	  				} else $images2 = "";


					} //
				
				}
  				
			}    						    			
    						    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_skin.php'>";
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

