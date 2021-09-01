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
    	
    	//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_skingoods");
		$body = str_replace("{new}",skin_button("블럭추가","admin_skingoods_new.php"),$body);  
		
		
		
		$query = "SELECT * FROM `shop_skingoods` ";	
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {

			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
			
					$listform = admin_bodyskin("admin_skingoods_list","pc","ko");
					
					$listform = str_replace("{type}","$rows[type]",$listform);
					$listform = str_replace("{mode}",$rows[mode],$listform);
					$listform = str_replace("{code}","<a href='admin_skingoods_edit.php?UID=$rows[Id]'>$rows[code]</a>",$listform);
					$listform = str_replace("{cols}","$rows[cols]",$listform);
					$listform = str_replace("{rows}","$rows[rows]",$listform);
					
					
					$query1 = "SELECT * FROM `shop_cate` where Id='$rows[cate]'";
					//echo $query1."<br>";
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$rows1=mysql_fetch_array($result1);
						$language = $_SESSION['language'];
						$listform = str_replace("{category}",$rows1[$language],$listform);
					}
					
					
					// $listform = str_replace("{category}",$rows[cate],$listform);
					$list .= $listform;

			}
			$body = str_replace("{datalist}","$list",$body); //# 완성된 LIST를 치환합니다.
		}
		
		
	
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		echo $body;
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
