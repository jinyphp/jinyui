<?

	@session_start();
	
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; //# 사이트 언어, 지역 설정
	include "mobile.php";
	
	include "./func_skin.php"; //# 스킨 레이아웃 함수들...
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	
	if(!isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
		$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";   
	} else { //////////////////////////////////////////

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(  mysql_num_rows($result)  ){ 
			$MEM=mysql_fetch_array($result);
			
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(  mysql_num_rows($result)  )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}

		
			//////////////////////////////////////////////////////////////////
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
			
			
			
			if($mode == "editup"){
				$code = $_POST['code'];			
				$query = "UPDATE `sales_members` SET `bizmenu`='$code' WHERE Id='$MEM[Id]'";			
    			mysql_db_query($mysql_dbname,$query,$connect);
				$bizmenu = $code;
			} else $bizmenu = $MEM[bizmenu];
			
			
			$body = shopskin("sales_bizmenu");
			
			
			$body=str_replace("{formstart}","<form name='bizmenu' method='post' enctype='multipart/form-data' action='sales_bizmenu.php'> 
					    				<input type='hidden' name='mode' value='editup'>",$body);
			$body = str_replace("{formend}","</form>",$body);
			$body = str_replace("{submit}","<input type='submit' name='reg' value='선택' $btn_style_blue>",$body);
			
			$query = "SELECT * FROM `sales_bizmenu` where enable = 'on'";	
			$result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total = mysql_result($result,0,0);
    		
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){ 				
	    		
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_bizmenu_list",$_SESSION['mobile'],$_SESSION['language']);
	
					if($rows[code] == $bizmenu)
					$listform = str_replace("{sel}","<input type='radio' name='code' value='$rows[code]' checked>",$listform);
					else $listform = str_replace("{sel}","<input type='radio' name='code' value='$rows[code]' >",$listform);
					
					$listform = str_replace("{service_name}","$rows[name]",$listform);
					$list .= $listform;	
	    			
			
	    		}
	    	
				$body=str_replace("{databody}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","등록된 서비스 유형이 없습니다.",$listform);
	    		$body=str_replace("{databody}",$listform,$body);
	    	}
		    	
		   
		    
		
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	mysql_close($connect);
	mysql_close($dbconnect);
?>
