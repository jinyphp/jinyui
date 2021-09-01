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
			$code = $_GET['code']; if(!$code) $code = $_POST['code'];
			$search = $_GET['search']; if(!$search) $search = $_POST['search'];
			
			//# 스킨 레이아웃 
			$body = shopskin("sales_board");
			
			//# 좌측 메뉴 트리구조 표시
			$leftBody = "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
			$query = "select * from `sales_board` group by code desc";
			$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){
    		
    			while($rows=mysql_fetch_array($result)){
    				$leftBody .= "<tr><td width='5' valign='top' style='font-size:12px;padding:10px;'><font color='#3B5998'>▪</font></td>
    							  <td style='font-size:12px;padding:10px;'><a href='sales_board.php?code=$rows[code]'>$rows[code]</a></td></tr>";    			
    			}
    			mysql_free_result($result);
    						
    		}
			$leftBody .= "</table>";
			$body = str_replace("{board_list}","$leftBody ",$body);
			
			////////////////////
			
			$body = str_replace("{new}",_button_blue("글쓰기","sales_board_new.php?mode=new&code=$code"),$body);
			$body = str_replace("{boardname}","$code",$body);
			
			$body=str_replace("{formstart}","<form name='company' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='code' value='$code'>
					    						 <input type='hidden' name='mode' value='search'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$body = str_replace("{search}","<input type='text' name='search' $cssFormStyle placeholder='검색명'>",$body);	
			$body = str_replace("{submit}","<input type='submit' name='reg' $cssFormStyle value='검색' >",$body);
			
			if($search){
				$query = "SELECT * FROM `sales_board` where code = '$code' and title like '%$search%'";	
			} else {
				$query = "SELECT * FROM `sales_board` where code = '$code'";			
			}
			// echo $query;
			$result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total = mysql_result($result,0,0);
    		
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
    		if( mysql_num_rows($result) ){ 				
	    		
				for($i=0;$i<$total;$i++){
	    			$rows=mysql_fetch_array($result);
	    			
	    			$listform = bodyskin("sales_board_list",$_SESSION['mobile'],$_SESSION['language']);
	
					$listform = str_replace("{en}","<input type='checkbox' name='BID[]' value='$rows[Id]' >","$listform");
					$listform = str_replace("{regdate}","$rows[regdate]",$listform);
					
					$listform = str_replace("{title}","<a href='sales_board_new.php?mode=view&UID=$rows[Id]'>$rows[title]</a>",$listform);	
					
					$list .= $listform;	
			
	    		}
	    	
				$body=str_replace("{databody}",$list,$body);
	    	} else {
	    		$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
				$listform = str_replace("{nodata}","작성된 내용이 없습니다.",$listform);
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
