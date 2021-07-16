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
	
	////////////////////////
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());   
	
	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			
    			$query = "DELETE FROM `shop_loginenv` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			
    			page_back2();
    			break;
    			
    		case 'editup':
    		
    			$enable = $_POST['enable'];
				$skin_language = $_POST['skin_language'];
			
				$skin_login = $_POST['skin_login'];
				$skin_logout = $_POST['skin_logout'];
				$skin_memnew = $_POST['skin_memnew'];
				$skin_memedit = $_POST['skin_memedit'];
				
				$skin_fontsize = $_POST['skin_fontsize'];
				$skin_fontcolor = $_POST['skin_fontcolor'];
			
				if(!$skin_language) msg_alert("오류! 언어를 선택해주세요");
    			else {
					$query = "UPDATE `shop_loginenv` SET `language`='$skin_language', `login`='$skin_login', `logout`='$skin_logout',
											`memnew`='$skin_memnew', `memedit`='$skin_memedit', 
											`fontsize`='$skin_fontsize', `fontcolor`='$skin_fontcolor',
											`enable`='$enable'  WHERE `Id`='$UID'";
    				//echo $query."<br>";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}
    			page_back2();
    			// echo "<meta http-equiv='refresh' content='0; url=admin_loginenv.php'>";
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_loginenv_edit");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_loginenv` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='loginenv' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
					//* 언어선택
					$query1 = "select * from shop_language where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$from_language = "<table><tr>";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);

							if($rows[language] == $rows1[code]) 
							$from_language .= "<td><input type='radio' name='skin_language' value='$rows1[code]' checked>$rows1[code]</td>";
							else $from_language .= "<td><input type='radio' name='skin_language' value='$rows1[code]'>$rows1[code]</td>";
						}
						$from_language .= "</tr></table>";
					}
					$body = str_replace("{language}",$from_language,$body);

					$body = str_replace("{size}","<input type='text' name='skin_fontsize' value='$rows[fontsize]' $cssFormStyle >",$body);
					$body = str_replace("{color}","<input type='text' name='skin_fontcolor' value='$rows[fontcolor]' $cssFormStyle >",$body);
		
					$body = str_replace("{skin_login}","<input type='text' name='skin_login' value='$rows[login]' $cssFormStyle >",$body);
					$body = str_replace("{skin_logout}","<input type='text' name='skin_logout' value='$rows[logout]' $cssFormStyle >",$body);
					$body = str_replace("{skin_memnew}","<input type='text' name='skin_memnew' value='$rows[memnew]' $cssFormStyle >",$body);
					$body = str_replace("{skin_memedit}","<input type='text' name='skin_memedit' value='$rows[memedit]' $cssFormStyle >",$body);
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);		
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_loginenv_edit.php?mode=del&UID=$UID\")' $css_submit >",$body);
							
					//# 번역스트링 처리
					$body = _adminstring_converting($body);	
		
					echo $body;
						
				}


			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

