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
	    
	if($_COOKIE[adminemail]){ ///////////////

		$body = str_replace("{status}",$_GET['status'],$body); 

		////////////////////
		// include "admin_members_left.php";	
		//////////////////////
	
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    	
    		case 'auth':
    			$body = admin_shopskin("admin_memauth_edit");
    			
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_member` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='memauth' method='post' enctype='multipart/form-data' action='admin_memauth.php'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
					
				
					if($rows[auth])
					$body = str_replace("{memauth}","<input type='checkbox' name='auth' checked >",$body);
					else $body = str_replace("{memauth}","<input type='checkbox' name='auth' >",$body);
					
					$body = str_replace("{regdate}","$rows[regdate]",$body);
					$body = str_replace("{email}","$rows[email]",$body);
					$body = str_replace("{name}","$rows[username]",$body);
					$body = str_replace("{phone}","$rows[userphone]",$body);
					$body = str_replace("{password}","$rows[password]",$body);
					$body = str_replace("{address}","$rows[address]",$body);
					
					$body = str_replace("{living_county}","$rows[country]",$body);
					$body = str_replace("{use_language}","$rows[langauge]",$body);
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' >",$body);
				}	
    			
    			//# 번역스트링 처리
				$body = _adminstring_converting($body);
    			echo $body;
    		
    			break;
    		
			case 'editup':	
				$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
				$auth = $_POST['auth'];
				
				$query = "UPDATE `shop_member` SET `auth`='$auth' WHERE `Id`='$UID'";
				mysql_db_query($mysql_dbname,$query,$connect);
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_memauth");

				$query = "select * from `shop_member` where auth != 'on' or auth is NULL";
				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    			$total=mysql_result($result,0,0);
		
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					for($i=0;$i<$total;$i++){
						$rows=mysql_fetch_array($result);
						
						// $listfrom = admin_bodyskin("admin_members_list","pc","ko");
						$listfrom = admin_bodyskin("admin_memlist_list","pc","ko");
							
						$listfrom = str_replace("{email}","<font size=2><a href='admin_memauth.php?mode=auth&UID=$rows[Id]'>$rows[email]</a></font>",$listfrom);
						$listfrom = str_replace("{name}","<font size=2>$rows[username]</font>",$listfrom);		
						$listfrom = str_replace("{phone}","<font size=2>$rows[userphone]</font>",$listfrom);
						$listfrom = str_replace("{point}","<font size=2>$rows[point]</font>",$listfrom);
						$listfrom = str_replace("{mtype}","<font size=2>$rows[mtype]</font>",$listfrom);
						$list .= $listfrom;
					}
					$body = str_replace("{datalist}","$list",$body); 
				} else {
					$body = str_replace("{datalist}","미승인 회원이 없습니다.",$body); 
				}
		
				
				//# 번역스트링 처리
				$body = _adminstring_converting($body);
				echo $body;
    	}

	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
		


?>
