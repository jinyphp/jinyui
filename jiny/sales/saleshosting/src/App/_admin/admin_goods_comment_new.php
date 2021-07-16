<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	//# 2014.12.28 hojin lee
	//# 로그인 버튼 / 신규등록 페이지
	//# 
	
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
	
	

	if($_COOKIE[adminemail]){ ///////////////
    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	$GID = $_GET['GID']; if(!$GID) $GID = $_POST['GID'];
    	
    	switch($mode){
    		case 'del':
    			$query = "DELETE FROM `shop_goods_comment` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			page_back2();
    			break;
    			
    		case 'editup':
    			$comment = $_POST['comment']; $comment = addslashes($comment);
    			$query = "UPDATE `shop_goods_comment` SET `comment`='$comment'  WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			page_back2();
    			break;
    			
    		case 'edit':
    			$body = admin_shopskin("admin_goods_comment_new");    			
				
				$query = "select * from `shop_goods_comment` where Id = '$UID'";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()){
					$rows=mysql_fetch_array($result);
					
					$body=str_replace("{formstart}","<form name='skins' method='post' enctype='multipart/form-data' action='admin_goods_comment_new.php'> 
					    				
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
					$comment = stripslashes($rows[comment]);						
					$body = str_replace("{comment}","<textarea name='comment' rows='20' style='width:100%'>$comment</textarea>",$body);
							
					$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
							
					
				
				}
				echo $body;
    			
    			break;
    			
    		case 'newup':
    			if($_SESSION['nonce'] != $_POST['nonce']){
					$_SESSION['nonce'] = NULL;	
					echo "<meta http-equiv='refresh' content='0; url=admin_goods_comment.php?UID=$UID'>";

				} else {
				///////////////////////////
				// 섹션 중복처리 방지 기능
	
					$_SESSION['nonce'] = NULL;
			
					$comment = $_POST['comment']; $comment = addslashes($comment);
					
					if(!$comment) msg_alert("오류! 상품평을 입력해주세요");
    				else {
    					$query = "INSERT INTO `shop_goods_comment` (`GID`, `email`, `regdate`, `comment`, `star`) 
    					VALUES ('$GID', '$email', '$TODAYTIME', '$comment', '$star');";
						mysql_db_query($mysql_dbname,$query,$connect);  
						echo $query;
					}    		
							    			
    				page_back2();				    			
    				

				///// ##### SESSION END ##### /////
				}
		
				break;
    	
    	
    	
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
				$body = admin_shopskin("admin_goods_comment_new");    			
				
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
				
    			$body=str_replace("{formstart}","<form name='skins' method='post' enctype='multipart/form-data' action='admin_goods_comment_new.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='GID' value='$GID'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
											
				$body = str_replace("{comment}","<textarea name='comment' rows='20' style='width:100%'></textarea>",$body);
							
				$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit >",$body);
			
				//# 번역스트링 처리
				$body = _adminstring_converting($body);
						
				echo $body;
		}
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

