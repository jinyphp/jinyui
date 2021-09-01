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
	
	include "./func_curl.php";
	
	include "./func_adminstring.php";
	
    
	if($_COOKIE[adminemail]){ ///////////////
	
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_api");
		
		$json = explode("\n", fetch_page("http://www.dojangshop.co.kr/admin/server_good_list.php","name=hojinlee&password=1234",$cookies,$referer_url) );

		for($i=0;$i<count($json)-1; $i++) {
			$rows = json_decode($json[$i],true);
			
			$listform = admin_bodyskin("admin_api_list","pc","ko");
					
			$listform = str_replace("{images}","<img src='$rows[images]' border=0 width='100'>",$listform);
			$listform = str_replace("{regdate}","$rows[regdate]",$listform);
			$listform = str_replace("{domain}","$rows[domain]",$listform);
			
			$goodname = json_decode($rows[goodname],true);
			$language = $_SESSION['language'];
			$listform = str_replace("{goodname}","$goodname[$language]",$listform);
			$listform = str_replace("{spec}","$rows[spec]",$listform);
			$listform = str_replace("{subtitle}","$rows[subtitle]",$listform);
			$listform = str_replace("{sell_price}","$rows[sell_prices]",$listform);
			$listform = str_replace("{supply_price}","$rows[supply_prices]",$listform);
			
			$listform = str_replace("{insale}",skin_button("입점승인","admin_api_goodsave.php?MID=$rows[Id]"),$listform);
			// $aaa = explode(";", $rows[goodname]);
	
			$list .= $listform;
		}
		$body = str_replace("{datalist}",$list,$body);

		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";

?>
