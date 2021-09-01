<?

	@session_start();

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");


	if(isset($_COOKIE['cookie_email'])){

		// 환경설정 읽어보기
		require_once ($_SERVER['DOCUMENT_ROOT']."/crm/crm_campaign_scenario.cfg.php");

		// 테이블 및 데이터 베이스 체크
		require_once ($_SERVER['DOCUMENT_ROOT']."/crm/inc_table_check.php");

		$body = _theme_emptybody();
    
		// Form and Ajax Process
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$hidden = "<input type='hidden' name='ajaxkey' value='$ajaxkey'>";

		$arr = array_keys($_GET);
		for($i=0;$i<count( $arr );$i++){
			$key_name = $arr[$i];
			$hidden .= "<input type='hidden' name='".$key_name."' value='".$_GET[$key_name]."'>";
		}
	
		$body = str_replace("<!--{skin_emptybody}-->","
					<center><img src='../images/loading.gif' border='0'></center>
					<form name='goods' method='post' enctype='multipart/form-data'>".$hidden."						
						<script>"._javascript_ajax_html("#mainbody","ajax_".$_tableName.".php")."</script>				
					</form>",$body);
		echo $body;

	} else {
		
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$body =  _theme_emptybody($skin_name);
		$login_script = "<script>"._javascript_ajax_html("#mainbody","/ajax_login.php")."</script>";	
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;
		

	}

?>