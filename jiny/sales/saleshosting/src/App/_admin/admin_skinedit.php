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
	
	include "./func_adminstring.php";
	
	////////////////////////
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());   

	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_skin` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    				
    				$query = "DELETE FROM `shop_skin` WHERE `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			
    				//echo "<meta http-equiv='refresh' content='0; url=admin_skin.php'>";
    				page_back2();
    			}
    			break;
    			
    		case 'editup':
    		
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_skin` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
		    		
    				$enable = $_POST['enable'];
					$skinname = $_POST['skinname'];
    				$width = $_POST['width'];
    				$bgcolor = $_POST['bgcolor'];
    				$align = $_POST['align'];
    		
    				$skin_head = $_POST['skin_head']; $skin_head = addslashes($skin_head);
    				$skin_body = $_POST['skin_body']; $skin_body = addslashes($skin_body);
    				// $skin_menu = $_POST['skin_menu']; $skin_menu = addslashes($skin_menu);
    				// $skin_bottom = $_POST['skin_bottom']; $skin_bottom = addslashes($skin_bottom);
    			
    				if(!$skinname) msg_alert("오류! 스킨명이 없습니다.");
    				else {
    				
    					if($rows[skinname] != $skinname){
    						$update = "true";
    						$query = "select * from `shop_skin` where skinname = '$skinname' order by Id desc";
    						echo $query."<br>";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if( mysql_affected_rows() ){ 
								$update = "false";
    							msg_alert("오류! 이미 존재한 스킨명 입니다.");

    						} 
						} else $update = "true";
    				
    					if($update = "true"){
    						$query = "UPDATE `shop_skin` SET `skinname`='$skinname', `width`='$width', `bgcolor`='$bgcolor', `align`='$align',  
    							`head`='$skin_head', `body`='$skin_body', `enable`='$enable'  WHERE `Id`='$UID'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect);
    						
    						
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

    					
    					}	
    					
    				} 
    				
 
    			}
    			
    			page_back2();
    			break;
    			
    		default:
    	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_skinedit");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_skin` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='skin' method='post' enctype='multipart/form-data' action='admin_skinedit.php'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
					
					$body = str_replace("{skinname}","<input type='text' name='skinname' value='$rows[skinname]' $cssFormStyle >",$body);
					$body = str_replace("{width}","<input type='text' name='width' value='$rows[width]' $cssFormStyle >",$body);
					$body = str_replace("{bgcolor}","<input type='text' name='bgcolor' value='$rows[bgcolor]'  $cssFormStyle >",$body);
					$body = str_replace("{align}","<input type='text' name='align' value='$rows[align]'  $cssFormStyle >",$body);
				
					$body = str_replace("{skin_logo}","<input type='file' name='userfile1' >",$body);
					$body = str_replace("{skin_title}","<input type='file' name='userfile2' >",$body);
				
					$skin_head = stripslashes($rows[head]);	
					$body = str_replace("{skin_head}","<textarea name='skin_head' rows='10' style='width:100%'>$skin_head</textarea>",$body);
					$skin_body = stripslashes($rows[body]);	
					$body = str_replace("{skin_body}","<textarea name='skin_body' rows='10' style='width:100%'>$skin_body</textarea>",$body);
					// $skin_menu = stripslashes($rows[menu]);	
					// $body = str_replace("{skin_menu}","<textarea name='skin_menu' rows='10' style='width:100%'>$skin_menu</textarea>",$body);
					// $skin_bottom = stripslashes($rows[bottom]);	
					// $body = str_replace("{skin_bottom}","<textarea name='skin_bottom' rows='10' style='width:100%'>$skin_bottom</textarea>",$body);
					
					
					
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
							
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_skinedit.php?mode=del&UID=$UID\")' $css_submit >",$body);
							
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
					
					echo $body;
						
				}	
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

