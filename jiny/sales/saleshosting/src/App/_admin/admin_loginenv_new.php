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
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());

	if($_COOKIE[adminemail]){ ///////////////
	
    	//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_loginenv_new");    			
		
    	$body=str_replace("{formstart}","<form name='skins' method='post' enctype='multipart/form-data' action='admin_loginenv_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
		$body = str_replace("{formend}","</form>",$body);
											
		$body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
		

		//* 언어선택
		$query1 = "select * from shop_language where enable = 'on' or enable = 'checked'";
		$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    	$total1 = mysql_result($result1,0,0);
				
    	$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    	if(mysql_affected_rows()){
    		$from_language = "<table><tr>";
			for($i1=1;$i1<=$total1;$i1++){
				$rows1=mysql_fetch_array($result1);

				if($rows[language] == $rows1[code]) 
				$from_language .= "<td><input type='radio' name='skin_language' value='$rows1[code]' checked>$rows1[code]</td>";
				else $from_language .= "<td><input type='radio' name='skin_language' value='$rows1[code]'>$rows1[code]</td>";
			}
			$from_language .= "</tr></table>";
		}
		$body = str_replace("{language}",$from_language,$body);

		$body = str_replace("{size}","<input type='text' name='skin_fontsize' $cssFormStyle >",$body);
		$body = str_replace("{color}","<input type='text' name='skin_fontcolor' $cssFormStyle >",$body);
			
		$body = str_replace("{skin_login}","<input type='text' name='skin_login' $cssFormStyle >",$body);
		$body = str_replace("{skin_logout}","<input type='text' name='skin_logout' $cssFormStyle >",$body);
		$body = str_replace("{skin_memnew}","<input type='text' name='skin_memnew' $cssFormStyle >",$body);
		$body = str_replace("{skin_memedit}","<input type='text' name='skin_memedit' $cssFormStyle >",$body);
				
		$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit>",$body);
		
		//# 번역스트링 처리
		$body = _adminstring_converting($body);				
		echo $body;

	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

