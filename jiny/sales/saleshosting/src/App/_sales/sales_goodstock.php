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
			
			
			// 테이블 확인 및 생성...
			$query = "show tables like 'sales_warehouse_$MEM[Id]'";
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
			if(  !mysql_num_rows($result)  ) {
				$query = "CREATE TABLE `sales_warehouse_$MEM[Id]` (
  							`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  							`regdate` date DEFAULT NULL,
  							`enable` varchar(10) DEFAULT NULL,
  							`housename` varchar(255) DEFAULT NULL,
  							`manager` varchar(255) DEFAULT NULL,
  							`phone` varchar(20) DEFAULT NULL,
  							`fax` varchar(20) DEFAULT NULL,
  							`address` varchar(255) DEFAULT NULL,
  							`memo` varchar(255) DEFAULT NULL,
  							PRIMARY KEY (`Id`)
						) ENGINE=InnoDB";
				mysql_db_query($server[dbname],$query,$dbconnect);
				
				$query = "CREATE TABLE `sales_goodstock_$MEM[Id]` (
  							`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  							`warehouse` varchar(10) DEFAULT NULL,
  							`GID` varchar(10) DEFAULT NULL,
  							`stock` varchar(10) DEFAULT NULL,
  							PRIMARY KEY (`Id`)
						 ) ENGINE=InnoDB ";
				mysql_db_query($server[dbname],$query,$dbconnect);		 
				
				/*
				$msg = "테이블 생성";
				echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script> alert(\"$msg\"); </script>"; 
				*/ 
			} else {
				
       			/*
       			$msg = "sales_warehouse_$MEM[Id]";
				echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script> alert(\"$msg\"); </script>";
       			*/
			}
			
			//////////////////////////////////////////////////////////////////
			$GID = $_GET['GID']; if(!$GID) $GID = $_POST['GID'];
			
			$body = shopskin("sales_goodstock");
			$body = str_replace("{new}",_button_blue("창고추가","sales_warehouse_new.php"),$body);
			$body = str_replace("{list}",_button_green("창고목록","sales_warehouse.php"),$body);
			
			
			$query1 = "SELECT * FROM `sales_goods_$MEM[Id]` where Id = '$GID'";
			$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    		if( mysql_num_rows($result1) ){ 
    			$rows1=mysql_fetch_array($result1);
				$body = str_replace("{goodname}","$rows1[name]",$body);	
			} else $body = str_replace("{goodname}","",$body);	
			
			
			
			$body=str_replace("{formstart}","<form name='warehouse' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    					 <input type='hidden' name='mode' value='search'>",$body);
			$body = str_replace("{formend}","</form>",$body);
			$body = str_replace("{submit}","<input type='submit' name='reg' $cssFormStyle value='검색' >",$body);
			
			$query = "SELECT * FROM `sales_goodstock_$MEM[Id]` where GID = '$GID'";
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    		
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 				
	    		
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_goodstock_list",$_SESSION['mobile'],$_SESSION['language']);
					
					$query1 = "SELECT * FROM `sales_warehouse_$MEM[Id]` where Id = '$rows[warehouse]'";
					$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    				if( mysql_num_rows($result1) ){ 
    					$rows1=mysql_fetch_array($result1);
						$listform = str_replace("{warehouse}","<a href='sales_warehouse_edit.php?mode=edit&UID=$rows[warehouse]'>$rows1[housename]</a>",$listform);	
					} else $listform = str_replace("{warehouse}","",$listform);	
					
					
					$listform = str_replace("{stock}","$rows[stock]",$listform);
					
					$listform = str_replace("{move}","<a href='sales_goodstock_move.php?GID=$GID&warehouse=$rows[warehouse]'>이동</a>",$listform);
					
					$list .= $listform;	
	    			
			
	    		}
	    	
				$body=str_replace("{databody}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","등록된 창고/지점이 없습니다.",$listform);
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
