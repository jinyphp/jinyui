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
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
		$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>"; 
	} else { //////////////////////////////////////////

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if( mysql_num_rows($result) ){ 
			$MEM=mysql_fetch_array($result);
			
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_num_rows($result) )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}

			
			//////////////////////////////////////////////////////////////////
			$company = $_GET['company']; if(!$company) $company = $_POST['company'];
			$start = $_POST['start'];  if(!$start) $start = $_GET['start'];
			$end = $_POST['end']; if(!$end) $end = $_GET['end'];
			
			$body = shopskin("sales_order");
			$body = str_replace("{new}",_button_black("신규작성","sales_order_new.php?mode=new"),$body);
			
			//제목이 없는 임시, 견적서 파일은 삭제...		
			$query = "DELETE FROM `sales_quotation_$MEM[Id]` WHERE `title` IS NULL or `title` = '' ";
			// mysql_db_query($mysql_dbname,$query,$connect);
			mysql_db_query($server[dbname],$query,$dbconnect);


			$body=str_replace("{formstart}","<form name='quo' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='company' value='$company'>
					    						 <input type='hidden' name='mode' value='search'>",$body);
			$body = str_replace("{formend}","</form>",$body);
	
			$body = str_replace("{search}","<input type='text' name='search' $cssFormStyle placeholder='발주서명'>",$body);	
			$body = str_replace("{submit}","<input type='submit' name='reg' $cssFormStyle value='검색' >",$body);
				
			if($start){			
				$body = str_replace("{startdate}","<input type='date' name='start' value='$start' $cssFormStyle onChange=\"javascript:submit()\" >",$body);		
			} else $body = str_replace("{startdate}","<input type='date' name='start' value='$TODAY' $cssFormStyle onChange=\"javascript:submit()\" >",$body);
			
			if($end){
				$body = str_replace("{enddate}","<input type='date' name='end' value='$end' $cssFormStyle onChange=\"javascript:submit()\" >",$body);
			} else $body = str_replace("{enddate}","<input type='date' name='end' value='$TODAY' $cssFormStyle onChange=\"javascript:submit()\" >",$body);

	
							
			$query = "select * from `sales_quotation_$MEM[Id]` where type = 'order' ";
			
			if($start && $end)
			$query .= " and transdate >= '".$start."' and transdate <= '".$end."' ";
			else $query .= " and transdate >= '".$TODAY."' and transdate <= '".$TODAY."' ";

			
			if($_POST['search']) $query .= " and title like '%".$_POST['search']."%'";
			$query .= " order by transdate desc";
			$query = str_replace("and  order","order",$query);
				
			// echo $query."<br>";	
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){ 
    				
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_quotation_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{transdate}","$rows[transdate]","$listform");
					$listform = str_replace("{company}","$rows[company_name]","$listform");
					$listform = str_replace("{title}","<a href='sales_quotation_new.php?mode=edit&UID=$rows[Id]'>$rows[title]</a> $auth",$listform);
					
					$listform = str_replace("{amount}","$rows[quoPrices]","$listform");
					
	    			$list .= $listform;
	    		}
	    		
	    		$body=str_replace("{databody}",$list,$body);
			} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
	    		
	    		if($_POST['goods']) $listform = str_replace("{nodata}","검색된 발주서명이 없습니다.",$listform);
				else $listform = str_replace("{nodata}","등록된 발주서가 없습니다.",$listform);
	    		
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
