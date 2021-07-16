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
	
	function form_memgrade($grade){
    	global $connect, $mysql_dbname;
    	global $cssFormStyle;
	
		$query1 = "select * from shop_memgrade where enable = 'on' or enable = 'checked'";
		$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    	$total1 = mysql_result($result1,0,0);
				
    	$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    	if(mysql_affected_rows()){
    		$body1 = "<select size='1' name='memgrade' $cssFormStyle> ";
			for($i1=1;$i1<=$total1;$i1++){
				$rows1=mysql_fetch_array($result1);
				
				if($grade == $rows1[code]) 
				$body1 .= "<option value='$rows1[Id]' selected=\"selected\">$rows1[grade]</option>";
				else $body1 .= "<option value='$rows1[Id]' >$rows1[grade]</option>";
			}
			$body1 .= "</select>";
		}
						
    	return $body1;
	}
	
	    
	if($_COOKIE[adminemail]){ ///////////////
	
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
   		$result=mysql_db_query($mysql_dbname,"select * from `shop_member` where Id = '$UID'",$connect);
		if( mysql_affected_rows() ){ 
			$rows=mysql_fetch_array($result);
		  	//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    		$body = admin_shopskin("admin_memlist_new");

			$body=str_replace("{formstart}","<form name='memauth' method='post' enctype='multipart/form-data' action='admin_memlist_editup.php'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
			$body = str_replace("{formend}","</form>",$body);
					 
			if($rows[auth])
			$body = str_replace("{memauth}","<input type='checkbox' name='auth' checked >",$body);
			else $body = str_replace("{memauth}","<input type='checkbox' name='auth' >",$body);
				
			$body = str_replace("{living_county}",form_country1($_SESSION['country']),$body);	
			$body = str_replace("{use_language}",form_language1($_SESSION['language']),$body);
				
			/////////////////////////
			
			$body = str_replace("{email}","<input type='email' name='email' value='$rows[email]' autofocus required $cssFormStyle>",$body);
			$body = str_replace("{phone}","<input type='text' name='phone' value='$rows[userphone]' required $cssFormStyle>",$body);
			$body = str_replace("{password}","<input type='password' name='password' value='$rows[password]' required $cssFormStyle>",$body);
			$body = str_replace("{name}","<input type='text' name='name' value='$rows[username]' required $cssFormStyle>",$body);
				
			$body = str_replace("{post}","<input type='text' name='post' value='$rows[post]' $cssFormStyle>",$body);
			$body = str_replace("{address}","<input type='text' name='address' value='$rows[address]' $cssFormStyle>",$body);
								
			$body = str_replace("{mem_grade}",form_memgrade($grade),$body);
		
			$body = str_replace("{point}","<input type='text' name='point' value='$rows[point]' $cssFormStyle>",$body);
			$body = str_replace("{money}","<input type='text' name='money' value='$rows[money]' $cssFormStyle>",$body);

			$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit>",$body);

			//# 번역스트링 처리
			$body = _adminstring_converting($body);	
		
			echo $body;
    	}

	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
		


?>
