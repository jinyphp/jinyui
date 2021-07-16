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
	
		$DOMAIN = $_POST['domain']; if(!$DOMAIN) $DOMAIN = $_GET['domain'];
		
		if($DOMAIN){
			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
			$body = admin_shopskin("admin_seo");
			
			$body = str_replace("{domain}",$DOMAIN,$body); 
			
			$query = "select * from `shop_language` ";
			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
		
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()) {
				
				$bodylist = admin_bodyskin("admin_seo_list","pc","ko");
		
				$list ="<form name='domain' method='post' enctype='multipart/form-data' action='admin_seo_edit.php'> 
					    	<input type='hidden' name='domain' value='$DOMAIN'>
					    	<input type='hidden' name='mode' value='editup'>";
			
		
				for($i=0;$i<$total;$i++){
					$rows = mysql_fetch_array($result);
		
					$list .= $bodylist;
					
					$list = str_replace("{language}",$rows[code],$list);
					
					$query1 = "select * from `shop_seo` where domain = '$DOMAIN' and language = '$rows[code]'";
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$rows1=mysql_fetch_array($result1);
					}	
					
					$list = str_replace("{title}","<input type='text' name='title_$rows[code]' value='$rows1[title]' $cssFormStyle >",$list);
					$list = str_replace("{keyword}","<input type='text' name='keyword_$rows[code]' value='$rows1[keyword]' $cssFormStyle >",$list);
					$list = str_replace("{description}","<input type='text' name='description_$rows[code]' value='$rows1[description]' $cssFormStyle >",$list);
					
					$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'  height='5'><tr><td></td></tr></table>";
				}
				$list .= "<center><input type='submit' name='reg' value='수정'></center>";
				$list .= "</form>";
				
			}
		
			$body = str_replace("{datalist}","$list",$body); 

			//# 번역스트링 처리
			$body = _adminstring_converting($body);	
		
			echo $body;
	
		
		} else msg_alert("오류! SEO 도메인이 없습니다.");
		

	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
