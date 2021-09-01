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
	
	if($_GET['MOBILE']) $_SESSION['mobile'] = $_GET['MOBILE']; // 모바일 접속구분을 체크한경우...
    if(!$_SESSION['mobile']) { $_SESSION['mobile'] =  is_checkMobile(); } else $MOBILE = $_SESSION['mobile'];
	$MOBILE = $_SESSION['mobile'];

	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			$query = "UPDATE `shop_board` SET `reply`=''  WHERE `Id`='$UID'";
    			echo $query."<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			page_back2();
    			break;
    			
    		case 'editup':
    		
    			$reply = $_POST['reply']; $reply = addslashes($reply); 
    			
    			$query = "UPDATE `shop_board` SET `reply`='$reply'  WHERE `Id`='$UID'";
    			echo $query."<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
    		
    			
    			//echo "<meta http-equiv='refresh' content='0; url=admin_boardlist.php'>";
    			page_back2();
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_board_reply");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_board` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='skin' method='post' enctype='multipart/form-data' action='admin_board_reply.php'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
							
					$reply = stripslashes($rows[reply]);
					$body = str_replace("{reply}","<textarea name='reply' rows='8' style='width:100%'>$reply</textarea>",$body);		
		
					
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
					
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_board_reply.php?mode=del&UID=$UID\")' $css_submit >",$body);
					
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


				
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

