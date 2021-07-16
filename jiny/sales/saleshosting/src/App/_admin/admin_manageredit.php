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
		
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());

	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			$query = "DELETE FROM `shop_manager` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
    			page_back2();
    			break;
    			
    		case 'editup':
    			$enable = $_POST['enable'];
    			
    			$name = $_POST['name'];
    			$manager = $_POST['manager'];
    			$password = $_POST['password'];
    			$country1 = $_POST['country1'];
    			
    			$per1 = $_POST['per1']; //주문관리
    			$per2 = $_POST['per2']; //상품관리
    			$per3 = $_POST['per3']; //디자인관리
    			$per4 = $_POST['per4']; //관리자
    			
    			if($manager){
    				$query = "UPDATE `shop_manager` SET `enable`='$enable', `name`='$name', `email`='$manager', `password`='$password', 
    				`per1`='$per1', `per2`='$per2', `per3`='$per3', `per4`='$per4',
    				`country`='$country1'  WHERE `Id`='$UID'";
    				// echo $query ;
    				mysql_db_query($mysql_dbname,$query,$connect);
    			} else msg_alert("오류! 관리자 이메일이 없습니다.");
    			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_manager.php'>";
    			page_back2();
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_manageredit");			
    			////////////////////
		
				include "admin_design_left.php";
		
				//////////////////////
				
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_manager` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='manager' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
					if($rows[per1])
					$body = str_replace("{per1}","<input type='checkbox' name='per1' checked >",$body);
					else $body = str_replace("{per1}","<input type='checkbox' name='per1' >",$body);					

					if($rows[per2])
					$body = str_replace("{per2}","<input type='checkbox' name='per2' checked >",$body);
					else $body = str_replace("{per2}","<input type='checkbox' name='per2' >",$body);
					
					if($rows[per3])
					$body = str_replace("{per3}","<input type='checkbox' name='per3' checked >",$body);
					else $body = str_replace("{per3}","<input type='checkbox' name='per3' >",$body);					

					if($rows[per4])
					$body = str_replace("{per4}","<input type='checkbox' name='per4' checked >",$body);
					else $body = str_replace("{per4}","<input type='checkbox' name='per4' >",$body);
					
					$body = str_replace("{name}","<input type='text' name='name' value='$rows[name]' $cssFormStyle >",$body);
					
					$body = str_replace("{manager}","<input type='text' name='manager' value='$rows[email]' $cssFormStyle >",$body);
					$body = str_replace("{password}","<input type='text' name='password' value='$rows[password]'  $cssFormStyle >",$body);
					
					//* 기본 국가 선택
					// $body = str_replace("{country}","<input type='text' name='country1' value='$rows[country]'  $cssFormStyle >",$body);
					
					$query1 = "select * from shop_country where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$body1 = "<select size='1' name='country1' $cssFormStyle> ";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);
				
							if($rows[country] == $rows1[code]) 
							$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[name]</option>";
							else $body1 .= "<option value='$rows1[code]' >$rows1[name]</option>";
						}
						$body1 .= "</select>";
					}
					$body = str_replace("{manager_country}",$body1,$body);		
					// $body = str_replace("{manager_country}","<input type='text' name='manager_country' value='$rows[country]'  $cssFormStyle >",$body);
					

		
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit>",$body);
							
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_manageredit.php?mode=del&UID=$UID\")' $css_submit>",$body);
					
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
					echo $body;
						
				}


			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

