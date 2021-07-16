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
    			$query = "DELETE FROM `shop_partner` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
    			// echo "<meta http-equiv='refresh' content='0; url=admin_partner.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    			$manager = $_POST['manager'];
    			$password = $_POST['password'];
    			$manager_country = $_POST['manager_country'];
    			
    			if($manager){
    				$query = "UPDATE `shop_partner` SET `email`='$manager', `password`='$password', `country`='$manager_country'  WHERE `Id`='$UID'";
    				// echo $query ;
    				mysql_db_query($mysql_dbname,$query,$connect);
    			} else msg_alert("오류! 관리자 이메일이 없습니다.");
    			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_partner.php'>";
    			page_back2();
    			break;
    			
    		default:
    	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_partneredit");	
    					
    			////////////////////
		
				include "admin_design_left.php";
		
				//////////////////////
				
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_partner` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='manager' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
							
					$body = str_replace("{manager}","<input type='text' name='manager' value='$rows[email]' $cssFormStyle >",$body);
					$body = str_replace("{password}","<input type='text' name='password' value='$rows[password]'  $cssFormStyle >",$body);
							
					$body = str_replace("{manager_country}","<input type='text' name='manager_country' value='$rows[country]'  $cssFormStyle >",$body);
							
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit>",$body);
							
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_manageredit.php?mode=del&UID=$UID\")' $css_submit>",$body);
					
					
						
				}
				
				//# 번역스트링 처리
				$body = _adminstring_converting($body);
				echo $body;


		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

