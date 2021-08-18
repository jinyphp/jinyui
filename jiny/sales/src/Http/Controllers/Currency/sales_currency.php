<?php	
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
	include "./func_goods.php";
	
	include "./func_string.php";
	

	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

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
			
			///////////////////////////
			//# 스킨 레이아웃 
			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
			$body = shopskin("sales_currency"); 
		
			$body = str_replace("{new}",skin_button("통화추가","sales_currency_new.php"),$body); 
		
			$body = str_replace("{status}",$_GET['status'],$body); 
		
			$query = "select * from `sales_currency` ";
			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
		
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_num_rows($result) ) {

				for($i=0;$i<$total;$i++){
					$rows=mysql_fetch_array($result);
			
					$listform = bodyskin("admin_currency_list",$_SESSION['mobile'],$_SESSION['language']);
					
				
					if($rows[enable]) $listform = str_replace("{en}","▣",$listform);
					else $listform = str_replace("{en}","□",$listform);	
				
					$listform = str_replace("{currency}","<a href='sales_currency_edit.php?UID=$rows[Id]'>$rows[currency]</a>",$listform);
				
					$listform = str_replace("{code}","$rows[currencyid]",$listform);
					$listform = str_replace("{name}","$rows[name]",$listform);
					$listform = str_replace("{display}","$rows[currency_mark]",$listform);
					$listform = str_replace("{rate}","$rows[currency_rate]",$listform);
				
					$list .= $listform;
				}
			
				$body = str_replace("{datalist}","$list",$body); //# 완성된 LIST를 치환합니다.
			} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","등록된 환율리스트가 없습니다.",$listform);
	    		$body=str_replace("{datalist}",$listform,$body);
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
