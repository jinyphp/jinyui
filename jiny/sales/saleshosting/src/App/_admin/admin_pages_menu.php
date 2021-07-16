<?
	// ////////////////////////////////////////////////////////////
	// 거래처 목록 리스트
	// 2014.08.04 hojinlee
	//
	//
	
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
	
	
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
	
		switch($mode){
			case 'up': 
				if($_SESSION['nonce'] == $_GET['nonce']){
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
				
				//% 선택 카테고리 정보 읽기...
				$query = "select * from `pages_menu` where Id = '$UID'"; 
				//echo $query."<br>";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result); 
		    		
		    		$query1 = "select * from `pages_menu` where level = '$rows[level]' and pos < $rows[pos] and ref = $rows[ref] order by pos desc "; 
		    		//echo $query1."<br>";;
					$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					if( mysql_affected_rows() ){ 
		    			$rows1 = mysql_fetch_array($result1); 
		    			
		    			$query2 = "select * from `pages_menu` where tree like '%$UID%' order by pos desc";
		    			//echo $query2."<br>";
						$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
						if( mysql_affected_rows() ){ 
		    				$rows2 = mysql_fetch_array($result2);
		    				// echo "point pos : $rows2[pos]";
		    				
		    				$offset1 = $rows[pos] - $rows1[pos];
		    				$offset2 = $rows2[pos] - $rows[pos] +1;
		    				$j=0;
		    				//echo "offset1 = $offset1, offset2 = $offset2 <br>";
		    				
		    				//***
		    				$query3 = "select * from `pages_menu` where tree like '%$UID%' order by pos desc";
		    				//echo $query3."<br>";
		    				$result3=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query3),$connect);
    						$total3=mysql_result($result3,0,0);
    					
							$result3 = mysql_db_query($mysql_dbname,$query3,$connect);
							if( mysql_affected_rows() ){ 
								for($i=0;$i<$total3;$i++){
		    						$rows3 = mysql_fetch_array($result3);
		    						$position = $rows3[pos] - $offset1;
		    						$queryUp[$j++] = "UPDATE `pages_menu` SET `pos`=$position WHERE `Id`=$rows3[Id];"; 
		    						// echo $queryUp."<br>";
		    					}
		    				}
		    				
		    				//***
		    				//***
		    				$query3 = "select * from `pages_menu` where tree like '%$rows1[Id]%' order by pos desc";
		    				//echo $query3."<br>";
		    				$result3=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query3),$connect);
    						$total3=mysql_result($result3,0,0);
    					
							$result3 = mysql_db_query($mysql_dbname,$query3,$connect);
							if( mysql_affected_rows() ){ 
								for($i=0;$i<$total3;$i++){
		    						$rows3 = mysql_fetch_array($result3);
		    						$position = $rows3[pos] + $offset2;
		    						$queryUp[$j++] = "UPDATE `pages_menu` SET `pos`=$position WHERE `Id`=$rows3[Id];"; 
		    						// echo $queryUp."<br>";
		    					}
		    				}


							//***
							for($j=0;$j<count($queryUp);$j++){
		    					//echo $queryUp[$j]."<br>";
		    					mysql_db_query($mysql_dbname,$queryUp[$j],$connect);
		    				}


						}
		    			
					} else msg_alert("오류! 최상위 더이상 이동할 수 없습니다.");
				}
				} else msg_alert("오류! 중복실행."); 
				break;
			case 'down': 
				if($_SESSION['nonce'] == $_GET['nonce']){
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
				
				//% 선택 카테고리 정보 읽기...
				$query = "select * from `pages_menu` where Id = '$UID'"; 
				//echo $query."<br>";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result); 
		    		
		    		
		    		$query1 = "select * from `pages_menu` where level = '$rows[level]' and pos > $rows[pos] and ref = $rows[ref] order by pos asc "; 
		    		//echo $query1."<br>";
					$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
					if( mysql_affected_rows() ){ 
		    			$rows1 = mysql_fetch_array($result1); 
		    			
		    			
		    			$query2 = "select * from `pages_menu` where tree like '%$rows1[Id]%' order by pos desc";
		    			//echo $query2."<br>";
						$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
						if( mysql_affected_rows() ){ 
		    				$rows2 = mysql_fetch_array($result2);
		    				//echo "point pos : $rows2[pos]";
		    				
		    				//***
		    				$offset1 = $rows1[pos] - $rows[pos];
		    				$offset2 = $rows2[pos] - $rows1[pos] +1;
		    				$j=0;
		    				//echo "offset1 = $offset1, offset2 = $offset2";
							
							//***
		    				$query3 = "select * from `pages_menu` where tree like '%$rows1[Id]%' order by pos desc";
		    				//echo $query3."<br>";
		    				$result3=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query3),$connect);
    						$total3=mysql_result($result3,0,0);
    					
							$result3 = mysql_db_query($mysql_dbname,$query3,$connect);
							if( mysql_affected_rows() ){ 
								for($i=0;$i<$total3;$i++){
		    						$rows3 = mysql_fetch_array($result3);
		    						$position = $rows3[pos] - $offset1;
		    						$queryUp[$j++] = "UPDATE `pages_menu` SET `pos`=$position WHERE `Id`=$rows3[Id];"; 
		    						// echo $queryUp."<br>";
		    					}
		    				}
		    				
		    				//***
		    				$query3 = "select * from `pages_menu` where tree like '%$UID%' order by pos desc";
		    				//echo $query3."<br>";
		    				$result3=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query3),$connect);
    						$total3=mysql_result($result3,0,0);
    					
							$result3 = mysql_db_query($mysql_dbname,$query3,$connect);
							if( mysql_affected_rows() ){ 
								for($i=0;$i<$total3;$i++){
		    						$rows3 = mysql_fetch_array($result3);
		    						$position = $rows3[pos] + $offset2;
		    						$queryUp[$j++] = "UPDATE `pages_menu` SET `pos`=$position WHERE `Id`=$rows3[Id];"; 
		    						// echo $queryUp."<br>";
		    					}
		    				}
		    				
		    				for($j=0;$j<count($queryUp);$j++){
		    					//echo $queryUp[$j]."<br>";
		    					mysql_db_query($mysql_dbname,$queryUp[$j],$connect);
		    				}


		    				
						}
		    			

		    		} else msg_alert("오류! 최하위 더이상 이동할 수 없습니다."); 
		    	}
		    		
				} else msg_alert("오류! 중복실행."); 
			
								
				break;
				
			case 'disable':
				if($_SESSION['nonce'] == $_GET['nonce']){
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
					$query = "UPDATE `pages_menu` SET `enable` = '' WHERE `tree` like '%$UID%'";
					mysql_db_query($mysql_dbname,$query,$connect);
				} else msg_alert("오류! 중복실행."); 
				break;
				 
			case 'enable':
				if($_SESSION['nonce'] == $_GET['nonce']){
					$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
					$query = "UPDATE `pages_menu` SET `enable` = 'on' WHERE `tree` like '%$UID%'";
					mysql_db_query($mysql_dbname,$query,$connect);
				} else msg_alert("오류! 중복실행."); 
				break;
				 	
			default:	
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
		}
		
		
		
		//////////////////////////
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_page_menu");
		
		$body = str_replace("{new}",skin_button("추가","admin_pages_menu_new.php"),$body);    
		
		include "admin_goods_left.php";
		
		
		$query = "select * from `pages_menu` order by pos asc";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
		
			$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
			$list .= "<td width='40' bgcolor='ffffff'> <font size=2> 코드</font></td>";
			$list .= "<td width='150' bgcolor='ffffff'> <font size=2> 카테고리명 </font></td>";
			$list .= "<td width='150' bgcolor='ffffff'> <font size=2> Tree </font></td>";
			$list .= "<td width='20' bgcolor='ffffff'> <font size=2> LEVEL</font></td>";
			$list .= "<td width='20' bgcolor='ffffff'> <font size=2> REF</font></td>";
			$list .= "<td width='20' bgcolor='ffffff'> <font size=2> POS</font></td>";
			$list .= "</tr></table>";
				
			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
		
			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
			
			
				for($LevelSpace="",$j=0;$j<$rows[level];$j++) $LevelSpace .= "-";
			
				if($MOBILE == "mobile") {
					$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
					
					if($rows[enable]) $list .= "<td width='30' bgcolor='ffffff'> <font size=2>▣</font></td>";
					else $list .= "<td width='30' bgcolor='ffffff'> <font size=2>□</font></td>";
					
					$list .= "<td bgcolor='ffffff'> <font size=2> <a href='admin_pages_menu_new.php?UID=$rows[Id]&pos=$rows[pos]&level=$rows[level]'>+</a> <a href='admin_pages_menu.php?mode=up&UID=$rows[Id]'>▲</a><a href='admin_pages_menu.php?mode=down&UID=$rows[Id]'>▼</a> $LevelSpace <a href='admin_pages_menu_edit.php?UID=$rows[Id]'>$rows[catename]</a> </font></td>";
					//$list .= "<td width='100' bgcolor='ffffff'> <font size=2> $rows[code]</font></td>";
					$list .= "<td width='100' bgcolor='ffffff'> <font size=2> $rows[skinname]</font></td>";
					$list .= "</tr></table>";
		
				} else {
					//*** PC모드 출력
					$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
					
					if($rows[enable]) $list .= "<td width='40' bgcolor='ffffff'> <font size=2>$rows[Id] <a href='admin_pages_menu.php?mode=disable&UID=$rows[Id]&nonce=$nonce'>▣</a></font></td>";
					else $list .= "<td width='40' bgcolor='ffffff'> <font size=2>$rows[Id] <a href='admin_pages_menu.php?mode=enable&UID=$rows[Id]&nonce=$nonce'>□</a></font></td>";
					
					//*** 트리모양 만들기
					if($rows[level] == 0) {
						$query1 = "select * from `pages_menu` where ref = '0' and pos > '$rows[pos]'"; 
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_affected_rows() )	$depth = "┣"; else $depth = "┗";
						
						
					} else {	
						
						$query1 = "select * from `pages_menu` where ref = '0' and pos > '$rows[pos]'"; 
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_affected_rows() )	$depth = "┃"; else $depth = "&#4515;";

						for($k=0;$k<$rows[level];$k++) $depth .= "&#4515;";
						
						$query1 = "select * from `pages_menu` where ref = '$rows[ref]' and pos > '$rows[pos]'"; 
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_affected_rows() ) $depth .= "┣"; else $depth .= "┗";
					}
					
					
					
					
					$list .= "<td bgcolor='ffffff'> <font size=2> $depth <a href='admin_pages_menu_new.php?UID=$rows[Id]&pos=$rows[pos]&level=$rows[level]'>+</a> <a href='admin_pages_menu.php?mode=up&UID=$rows[Id]&nonce=$nonce'>▲</a><a href='admin_pages_menu.php?mode=down&UID=$rows[Id]&nonce=$nonce'>▼</a>  <a href='admin_pages_menu_edit.php?UID=$rows[Id]'>$rows[menuname]</a> </font></td>";
					//$list .= "<td width='150' bgcolor='ffffff'> <font size=2> $rows[code]</font></td>";
					$list .= "<td width='150' bgcolor='ffffff'> <font size=2> $rows[tree]</font></td>";
					$list .= "<td width='20' bgcolor='ffffff'> <font size=2> $rows[level]</font></td>";
					$list .= "<td width='20' bgcolor='ffffff'> <font size=2> $rows[ref]</font></td>";
					$list .= "<td width='20' bgcolor='ffffff'> <font size=2> $rows[pos]</font></td>";
					$list .= "</tr></table>";
				}
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
			}
		}
		
		$body = str_replace("{datalist}","$list",$body); 
		
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		echo $body;
	
		
		
	} else { /////////////////
	
		echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
	}	


?>
