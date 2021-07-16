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

    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_board_view");
		
		$body = str_replace("{board_edit}",skin_button("작성글 수정","admin_board_edit.php?UID=$UID"),$body); 
		$body = str_replace("{board_reply}",skin_button("답변","admin_board_reply.php?UID=$UID"),$body); 
    					
    	$result=mysql_db_query($mysql_dbname,"select * from `shop_board` where Id = '$UID'",$connect);
		if( mysql_affected_rows() ){ 
		   	$rows=mysql_fetch_array($result);
			
			$body = str_replace("{email}","$rows[email]",$body);
			
			$body = str_replace("{title}","$rows[title]",$body);
			
			$html = stripslashes($rows[html]);
			$body = str_replace("{html}","$html",$body);
			
			$reply = stripslashes($rows[reply]);
			$body = str_replace("{reply}","$reply",$body);

			$body = str_replace("{file1}","$rows[file1]",$body);
			$body = str_replace("{file2}","$rows[file2]",$body);
						
		}
		
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
					
		echo $body;

	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

