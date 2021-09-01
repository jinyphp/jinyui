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
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
			$code = $_GET['code']; if(!$code) $code = $_POST['code'];
			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
			$search = $_GET['search']; if(!$search) $search = $_POST['search'];
			
			
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
			
			////////////////
			
			switch($mode){

				case 'delete':
					$query = "SELECT * FROM `sales_board` where Id = '$UID'";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					$rows=mysql_fetch_array($result);
					
						if($rows[mem] == $MEM[Id]){
							$query = "DELETE FROM `sales_board` WHERE `Id`='$UID'";
							mysql_db_query($mysql_dbname,$query,$connect);
						} else msg_alert("오류! 본인 작성글만 삭제할 수 있습니다.");
						
						echo "<meta http-equiv='refresh' content='0; url=sales_board.php?code=$rows[code]'>";
					} else msg_alert("오류! 선택된 계시물이 없습니다.");

				
					break;

				case 'replyup':
					
					$reply = $_POST['reply']; $reply = addslashes($reply); 
					
					$query = "UPDATE `sales_board` SET `replydate`='$TODAYTIME', `reply`='$reply' WHERE `Id`='$UID'";
					mysql_db_query($mysql_dbname,$query,$connect);

					echo "<meta http-equiv='refresh' content='0; url=sales_board.php?code=$code'>";
				
					break;
					
				case 'reply':
					//# 스킨 레이아웃 
					$body = shopskin("sales_board_reply");
					$body = str_replace("{board_list}","$leftBody ",$body);
					
					$query = "SELECT * FROM `sales_board` where Id = '$UID'";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					$rows=mysql_fetch_array($result);
					
						$body=str_replace("{formstart}","<form name='board' method='post' enctype='multipart/form-data' action='sales_board_new.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='code' value='$rows[code]'>
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='replyup'>",$body);
						$body = str_replace("{formend}","</form>",$body);

						$body = str_replace("{title}","$rows[title]",$body);
						
						$content = stripslashes($rows[content]);
						$body = str_replace("{content}","$content",$body);
						
						$reply = stripslashes($rows[reply]);
						$body = str_replace("{reply}","<textarea name='reply' rows='10' style='width:100%;' placeholder='답변내용'>$reply</textarea>",$body);
		
						$body = str_replace("{submit}","<input type='submit' name='reg' value='답변' $btn_style_blue>",$body);
					
					} else msg_alert("오류! 선택된 계시물이 없습니다.");

					break;
					
				case 'editup':
					$title = $_POST['title'];
					$content = $_POST['content']; $content = addslashes($content); 
					
					$query = "UPDATE `sales_board` SET `title`='$title', `content`='$content' WHERE `Id`='$UID'";
					mysql_db_query($mysql_dbname,$query,$connect);

					echo "<meta http-equiv='refresh' content='0; url=sales_board.php?code=$code'>";
				
					break;
					
				case 'edit':
					//# 스킨 레이아웃 
					$body = shopskin("sales_board_new");
					$body = str_replace("{board_list}","$leftBody ",$body);
					
					$query = "SELECT * FROM `sales_board` where Id = '$UID'";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					$rows=mysql_fetch_array($result);
					
						$body=str_replace("{formstart}","<form name='board' method='post' enctype='multipart/form-data' action='sales_board_new.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='code' value='$rows[code]'>
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);

						$body = str_replace("{title}","<input type='text' name='title' value='$rows[title]' $cssFormStyle placeholder='글 제목'>",$body);
						
						$content = stripslashes($rows[content]);
						$body = str_replace("{content}","<textarea name='content' rows='10' style='width:100%;' placeholder='작성내용'>$content</textarea>",$body);
		
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $btn_style_blue>",$body);
					
					} else msg_alert("오류! 선택된 계시물이 없습니다.");
					break;
			
				case 'newup':
					if($_SESSION['nonce'] == $_POST['nonce']){
						
						$title = $_POST['title'];
						$content = $_POST['content']; $content = addslashes($content); 
					
						$query = "INSERT INTO `sales_board` (`regdate`, `mem`, `code`, `title`, `content`) 
							VALUES ('$TODAYTIME', '$MEM[Id]', '$code', '$title', '$content');";
						mysql_db_query($mysql_dbname,$query,$connect);

						
					} 
					$_SESSION['nonce'] = NULL;
					echo "<meta http-equiv='refresh' content='0; url=sales_board.php?code=$code'>";
				
					break;
			
				case 'new':
					//# 스킨 레이아웃 
					$body = shopskin("sales_board_new");
					$body = str_replace("{board_list}","$leftBody ",$body);
					
					$_SESSION['nonce'] = $nonce = md5('board'.microtime());
					$body=str_replace("{formstart}","<form name='board' method='post' enctype='multipart/form-data' action='sales_board_new.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='code' value='$code'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
					$body = str_replace("{formend}","</form>",$body);

					$body = str_replace("{title}","<input type='text' name='title' $cssFormStyle placeholder='글 제목'>",$body);

					$body = str_replace("{content}","<textarea name='content' rows='10' style='width:100%;' placeholder='작성내용'></textarea>",$body);
		
					$body = str_replace("{submit}","<input type='submit' name='reg' value='등록' $btn_style_blue>",$body);
					break;
				
				case 'view':
				default:
					//# 스킨 레이아웃 
					$body = shopskin("sales_board_view");	
					$body = str_replace("{board_list}","$leftBody ",$body);
					
					$query = "SELECT * FROM `sales_board` where Id = '$UID'";
					$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					$rows=mysql_fetch_array($result);
    					
    					$body = str_replace("{boardname}","<a href='sales_board.php?code=$rows[code]'>$rows[code]</a>",$body);
    					
    					$body = str_replace("{title}","$rows[title]",$body);
    					
    					$content = stripslashes($rows[content]);
    					if($rows[reply]){
    						$content .= "<br> ---------- reply : $rows[replydate] ---------- <br>".stripslashes($rows[reply]);
    					}
    					$body = str_replace("{content}","$content",$body);
    					
    					if($rows[mem] == $MEM[Id])
    					$body = str_replace("{edit}",_button_blue("수정","sales_board_new.php?mode=edit&UID=$UID"),$body);
    					else $body = str_replace("{edit}","",$body);
    					
    					if($rows[mem] == $MEM[Id])
    					$body = str_replace("{delete}",_button_gray("삭제","sales_board_new.php?mode=del&UID=$UID"),$body);
    					else $body = str_replace("{delete}","",$body);
    					
    					if($rows[reply]){
    						if($rows[mem] == $MEM[Id])
    						$body = str_replace("{reply}",_button_gray("답변수정","sales_board_new.php?mode=reply&UID=$UID"),$body);
    						else $body = str_replace("{reply}","",$body);
    					
    					} else $body = str_replace("{reply}",_button_gray("답변","sales_board_new.php?mode=reply&UID=$UID"),$body);
    				} else msg_alert("오류! 선택된 계시물이 없습니다.");
					
			}
			
			
			

			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	mysql_close($connect);
	mysql_close($dbconnect);	

	
	
	
	
	
	/*
	if($_POST['LANG']) $_SESSION['language'] = $_POST['LANG']; else if($_GET['LANG']) $_SESSION['language'] = $_GET['LANG'];
	if(!$_SESSION['language']) $_SESSION['language'] = "ko";
	$LANG = $_SESSION['language'];
	
    include "./dbinfo.php";
    include "./sales_function.php";
    include "./func_javascript.php";
    include "./func_files.php";
    include "./func_datetime.php";
    include "./func_mysql.php";
	include "./func_skin.php";
	
    $connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	if($_GET['MOBILE']) $_SESSION['mobile'] = $_GET['MOBILE']; // 모바일 접속구분을 체크한경우...
    if(!$_SESSION['mobile']) { $_SESSION['mobile'] =  is_checkMobile(); } else $MOBILE = $_SESSION['mobile'];
	$MOBILE = $_SESSION['mobile'];

    
    if(!isset($_COOKIE[Session]) && !isset($_COOKIE[albaCode]) ) login();
    else { //////////////////////////////////////////
	
	
		if($_COOKIE[albaCode]){
    
    		$result=mysql_db_query($mysql_dbname,"select * from `sales_members`  where albacode = '$_COOKIE[albaCode]'",$connect);
			if( mysql_affected_rows() ){ $ALBA=mysql_fetch_array($result);
		    	
		    	//////////////////////////////////////////////////////////////////
		    	
		    	
		    	$albaCode = $_COOKIE[albaCode];
    			
    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    			$code = $_GET['code']; if(!$code) $code = $_POST['code'];

    	
    	
				switch($mode){
					case 'del':
						$query = "select * from `sales_board` where Id = '$UID'";
						$result=mysql_db_query($mysql_dbname,$query,$connect);
						if( mysql_affected_rows() ){ 
		    				$rows=mysql_fetch_array($result);
		    				
							if($ALBA[albacode] == $rows[albacode]){
							
								$query ="DELETE FROM `sales_board` WHERE `Id`='$UID'";
								mysql_db_query($mysql_dbname,$query,$connect);
								
							} else 	msg_alert("작성자만 삭제가 가능합니다.");
						
						}
						echo "<meta http-equiv='refresh' content='0; url=sales_board.php?code=$code'>";
						break;
					case 'replyup':	
							$reply = $_POST['reply'];
							$query = "UPDATE `sales_board` SET `reply`='$reply' WHERE `Id`='$UID'";
							mysql_db_query($mysql_dbname,$query,$connect);
							
							echo "<meta http-equiv='refresh' content='0; url=sales_boardnew.php?code=$code&mode=view&UID=$UID'>";
							
						break;
					case 'reply':
					
						$result=mysql_db_query($mysql_dbname,"select * from `sales_board` where Id = '$UID'",$connect);
						if( mysql_affected_rows() ){ 
		    				$rows=mysql_fetch_array($result);
		    			
		    				// $TOP = FileLoad("top.htm"); echo $TOP;
		    				if($MOBILE == "mobile") $body = skinLoad("sales_boardreply.htm"); else $body = skinLoad("sales_boardreply_pc.htm");
    						$body=str_replace("{logout}","<a href='logout.php'>Logout</a>",$body);
    						$body=str_replace("{code}","<a href='sales_board.php?code=$code'>$code</a>",$body);	

							$body=str_replace("{formstart}","<form name='board' method='post' enctype='multipart/form-data' action='sales_boardnew.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='code' value='$code'>
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='replyup'>",$body);
							$body = str_replace("{formend}","</form>",$body);

							$body = str_replace("{title}","$rows[title]",$body);

							$body = str_replace("{comment}","$rows[content]",$body);

							$body = str_replace("{reply}","<textarea name='reply' rows='5' $cssFormStyle placeholder='답변내용'></textarea>",$body);
		
							$body = str_replace("{submit}","<input type='submit' name='reg' value='답변' >",$body);
								
							$body = str_replace("{delete}","<a href='sales_boardnew.php?mode=del&code=$code&UID=$UID'>삭제</a>",$body);
							echo $body;
							
							// echo FileLoad("./copyright.htm");
							include "./copyright.php";
		    			}	
						break;
					case 'view':
					
					
					
						$result=mysql_db_query($mysql_dbname,"select * from `sales_board` where Id = '$UID'",$connect);
						if( mysql_affected_rows() ){ 
		    				$rows=mysql_fetch_array($result);
		    				
		    				// $TOP = FileLoad("top.htm"); echo $TOP;
		    				if($MOBILE == "mobile") $body = skinLoad("sales_boardreply.htm"); else $body = skinLoad("sales_boardreply_pc.htm");
    						$body=str_replace("{logout}","<a href='logout.php'>Logout</a>",$body);		
							
							$body=str_replace("{code}","<a href='sales_board.php?code=$code'>$code</a>",$body);
							
							
								
						
							$body=str_replace("{formstart}","<form name='board' method='post' enctype='multipart/form-data' action='sales_boardnew.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='code' value='$code'>
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='reply'>",$body);
							$body = str_replace("{formend}","</form>",$body);

							$body = str_replace("{title}","$rows[title]",$body);

							$body = str_replace("{comment}","$rows[content]",$body);
							$body = str_replace("{reply}","$rows[reply]",$body);
		
							$body = str_replace("{submit}","<input type='submit' name='reg' value='답글' >",$body);
								
							// $body = str_replace("{delete}","<a href='sales_boardnew.php?mode=del&code=$code&UID=$UID'>삭제</a>",$body);
							$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"sales_boardnew.php?mode=del&code=$code&UID=$UID\")' style='font-size:9pt'>",$body);

							echo $body;
							
							// echo FileLoad("./copyright.htm");
							include "./copyright.php";
		    				
		    			}	
						break;
					case 'new':
						

						break;
					default:

    					// $TOP = FileLoad("top.htm"); echo $TOP;
    					if($MOBILE == "mobile") $body = skinLoad("sales_boardnew.htm"); else  $body = skinLoad("sales_boardnew_pc.htm");

    					$body=str_replace("{logout}","<a href='logout.php'>Logout</a>",$body);
    					$body=str_replace("{code}","<a href='sales_board.php?code=$code'>$code</a>",$body);
    							

						
								
						$body = str_replace("{delete}","",$body);
						echo $body;
						
						
						// echo FileLoad("./copyright.htm");
						include "./copyright.php";

				}	
    			
		    	
		    	
		    	
		    	///////////////////////////////////////////////////////////////////
    
    		} else msg_alert("오류! 잘못된 파트너 코드입니다.");
    
    	} else msg_alert("오류! 파트너 코드가 없습니다.");
		

	///////////////////////////
	}
    
    
    

	*/
		

?>

