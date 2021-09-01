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
	
	include "./func_adminstring.php";
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());   
	


	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_board` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    				
    				$query = "DELETE FROM `shop_board` WHERE `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			
    				
    				page_back2();
    			}
    			break;
    			
    		case 'editup':
    		
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_board` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
		    		
    				
					$title = $_POST['title'];

    				$html = $_POST['html']; $html = addslashes($html); 
    			
    				if(!$title) msg_alert("오류! 코드명이 없습니다.");
    				else {
    				
    					$query = "UPDATE `shop_board` SET `title`='$title', `html`='$html'  WHERE `Id`='$UID'";
    					echo $query."<br>";
    					mysql_db_query($mysql_dbname,$query,$connect);
    				
    				
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
							
							if ($_FILES["userfile1"][tmp_name]) $filename1 = "../board/board-$code-$UID";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../board/board-$code-$UID.".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_board` SET `file1`='./board/board-$code-$UID.".$ext."'  WHERE `Id`='$UID'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images1 = "./board/board-$code-$UID.".$ext;
								
    	  				} else $images1 = "";
    				
    				
    				
    				
    				
    				
    				
    				
    				
    				
    					
    				} 
   
    			}
    		
    			page_back2();
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_board_edit");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_board` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='skin' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					
					$body = str_replace("{title}","<input type='text' name='title' value='$rows[title]' $cssFormStyle >",$body);
					$html = stripslashes($rows[html]);
					$body = str_replace("{html}","<textarea name='html' rows='8' style='width:100%'>$html</textarea>",$body);		
		
					$body = str_replace("{file1}","<input type='file' name='userfile1' >",$body);
					$body = str_replace("{file2}","<input type='file' name='userfile2' >",$body);
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
					
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_board_edit.php?mode=del&UID=$UID\")' $css_submit >",$body);
					
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


				
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

