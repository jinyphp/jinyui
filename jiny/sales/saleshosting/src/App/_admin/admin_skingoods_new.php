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
		$body = admin_shopskin("admin_skingoods_new");    			
		
    	$body=str_replace("{formstart}","<form name='skins' method='post' enctype='multipart/form-data' action='admin_skingoods_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
		$body = str_replace("{formend}","</form>",$body);
											
		$body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
		$body = str_replace("{pageview}","<input type='checkbox' name='pageview' >",$body);

		
		$body1 = "<select size='1' name='skin_type' $cssFormStyle> ";
		$body1 .= "<option value='goods' >제품출력</option>";
		$body1 .= "<option value='board' >계시판</option>";
		$body1 .= "</select>";
		$body = str_replace("{type}",$body1,$body);
		
		
		$body = str_replace("{code}","<input type='text' name='skin_code' $cssFormStyle >",$body);
			
		
		$query1 = "select * from `shop_cate` order by pos asc";
		$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    	$total1=mysql_result($result1,0,0);
		
		$result1=mysql_db_query($mysql_dbname,$query1,$connect);
		if(mysql_affected_rows()) {
			$body1 = "<select size='1' name='skin_cate' $cssFormStyle> ";
			$body1 .= "<option value='' >출력 상품 카테고리</option>";
			for($ii=0;$ii<$total1;$ii++){
				$rows1=mysql_fetch_array($result1);
				
				for($jj=0,$level="";$jj<$rows1[level];$jj++) $level .= "&nbsp;";
				
				$language = $_SESSION['language']; //해당언어 상품명, 없으면 기본이름 적용
				if($rows1[$language]) $catename = $rows1[$language]; else $catename = $rows1[catename];
				
				if($rows[layout] == $rows1[Id]) 
					$body1 .= "<option value='$rows1[Id]' selected=\"selected\">$level $catename</option>";
				else $body1 .= "<option value='$rows1[Id]' >$level $catename</option>";
			}
			$body1 .= "</select>";
			$body = str_replace("{cate}",$body1,$body);
		}
		
		
		$body = str_replace("{mode}","<input type='text' name='skin_mode' $cssFormStyle >",$body);
		$body = str_replace("{rows}","<input type='text' name='skin_rows' $cssFormStyle >",$body);
		$body = str_replace("{cols}","<input type='text' name='skin_cols' $cssFormStyle >",$body);
		$body = str_replace("{sorting}","<input type='text' name='skin_sorting' $cssFormStyle >",$body);
		
		$body = str_replace("{skin}","<textarea name='skin_skin' rows='20' style='width:100%'></textarea>",$body);
							
		$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $css_submit>",$body);
		
		//# 번역스트링 처리
		$body = _adminstring_converting($body);					
		echo $body;

	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

