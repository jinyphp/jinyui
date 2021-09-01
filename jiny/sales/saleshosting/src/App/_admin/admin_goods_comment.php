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

	if($_COOKIE[adminemail]){ ///////////////	
		
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	$GID = $_GET['GID']; if(!$GID) $GID = $_POST['GID'];
    	
    	//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_goods_comment");	
		
		$body = str_replace("{new}",skin_button("상품평추가","admin_goods_comment_new.php?GID=$GID"),$body); 
		
		$query = "select * from `shop_goods_comment` where GID = '$GID'";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
				
				$comment = stripslashes($rows[comment]);	
				$list .= "<table border='0' width='100%' cellspacing='5' cellpadding='5'>
				<tr><td><a href='admin_goods_comment_new.php?mode=del&UID=$rows[Id]'>DEL</a> <a href='admin_goods_comment_new.php?mode=edit&GID=$GID&UID=$rows[Id]'>$rows[regdate]</a></td></tr>
				<tr><td>$comment</td></tr>
				</table>";
				
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";

			}
			$body = str_replace("{datalist}","$list",$body); 
		} else $body = str_replace("{datalist}","상품평이 없습니다.",$body);
		
		
		
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
				
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
