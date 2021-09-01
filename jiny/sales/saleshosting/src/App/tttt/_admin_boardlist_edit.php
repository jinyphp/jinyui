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
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_boardlist` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    				
    				$query = "DELETE FROM `shop_boardlist` WHERE `Id`='$UID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			
    				//echo "<meta http-equiv='refresh' content='0; url=admin_boardlist.php'>";
    				page_back2();
    			}
    			break;
    			
    		case 'editup':
    		
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_boardlist` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
		    		
    				$enable = $_POST['enable'];
					$code = $_POST['code'];
					$title = $_POST['title'];
			
    				$listnum = $_POST['listnum'];
    		
    				$seo_use = $_POST['seo_use'];
    				$seo_title = $_POST['seo_title'];
    				$seo_keyword = $_POST['seo_keyword'];
    				$seo_description = $_POST['seo_description'];
    		
    				$useskin = $_POST['useskin'];
    				$html = $_POST['html']; $html = addslashes($html); 
    			
    				if(!$code) msg_alert("오류! 코드명이 없습니다.");
    				else {
    				
    					if($rows[code] != $code){
    						$update = "true";
    						$query = "select * from `shop_boardlist` where code = '$code' order by Id desc";
    						echo $query."<br>";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if( mysql_affected_rows() ){ 
								$update = "false";
    							msg_alert("오류! 이미 존재한 코드명 입니다.");

    						} 
						} else $update = "true";
    				
    					if($update = "true"){
    						$query = "UPDATE `shop_boardlist` SET `enable`='$enable', `code`='$code', `title`='$title', `listnum`='$listnum', 
    						`seo_use`='$seo_use', `seo_title`='$seo_title', `seo_keyword`='$seo_keyword', `seo_description`='$seo_description', 
    						`useskin`='$useskin', `skinhtml`='$html'  WHERE `Id`='$UID'";
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
							
							if ($_FILES["userfile1"][tmp_name]) $filename1 = "../skin/board-$rows[Id]";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../skin/board-$rows[Id].".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_boardlist` SET `images`='./skin/board-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images1 = "./skin/board-$rows[Id].".$ext;
								
    	  				} else $images1 = "";
      					///////////

    					
    					}	
    					
    				} 
    				
 
    			}
    			//echo "<meta http-equiv='refresh' content='0; url=admin_boardlist.php'>";
    			page_back2();
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_boardlist_edit");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_boardlist` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='skin' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
					
					$body = str_replace("{code}","<input type='text' name='code' value='$rows[code]' $cssFormStyle >",$body);
					$body = str_replace("{title}","<input type='text' name='title' value='$rows[title]' $cssFormStyle >",$body);
					$body = str_replace("{listnum}","<input type='text' name='listnum' value='$rows[listnum]' $cssFormStyle >",$body);	
				
		
					$body = str_replace("{images}","<input type='file' name='userfile1' >",$body);
		
					if($rows[seo_use])
					$body = str_replace("{use_seo}","<input type='checkbox' name='seo_use' checked >",$body);
					else $body = str_replace("{use_seo}","<input type='checkbox' name='seo_use' >",$body);
					
					$body = str_replace("{seo_title}","<input type='text' name='seo_title' value='$rows[seo_title]' $cssFormStyle >",$body);	
					$body = str_replace("{seo_keyword}","<input type='text' name='seo_keyword' value='$rows[seo_keyword]' $cssFormStyle >",$body);	
					$body = str_replace("{seo_description}","<input type='text' name='seo_description' value='$rows[seo_description]' $cssFormStyle >",$body);	
		
					if($rows[useskin])
					$body = str_replace("{useskin}","<input type='checkbox' name='useskin' checked >",$body);
					else $body = str_replace("{useskin}","<input type='checkbox' name='useskin' >",$body);
					$html = stripslashes($rows[skinhtml]);
					$body = str_replace("{html}","<textarea name='html' rows='8' style='width:100%'>$html</textarea>",$body);					
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
							
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_boardlist.php?mode=del&UID=$UID\")' $css_submit >",$body);
							
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


				
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

