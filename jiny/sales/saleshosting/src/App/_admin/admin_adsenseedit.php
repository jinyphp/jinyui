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
    			$query = "DELETE FROM `shop_adsense` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
    			// echo "<meta http-equiv='refresh' content='0; url=admin_adsense.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
 
    			$enable = $_POST['enable'];	
    			$code = $_POST['code'];
    		
				$html = $_POST['html']; $html = addslashes($html);	
    						

				if(!$code) msg_alert("오류! 광고 코드값이 없습니다.");
    			else {

    				$query = "UPDATE `shop_adsense` SET `code`='$code', `html`='$html', `enable`='$enable'  WHERE `Id`='$UID'";
    				// echo $query ;
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}  
    			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_adsense.php'>";
    			page_back2();
    			break;
    			
    		default:
    	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_adsenseedit");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_adsense` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='adsense' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
					
				
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
					$body = str_replace("{code}","<input type='text' name='code' value='$rows[code]' $cssFormStyle >",$body);
				
					$html = stripslashes($rows[html]);	
					$body = str_replace("{html}","<textarea name='html' rows='10' style='width:100%'>$html</textarea>",$body);	
				
						
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
							
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_siteedit.php?mode=del&UID=$UID\")' $css_submit >",$body);
							
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


				
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

