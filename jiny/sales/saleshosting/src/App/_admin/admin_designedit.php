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
    			$query = "DELETE FROM `shop_desgin` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
    			// echo "<meta http-equiv='refresh' content='0; url=admin_desgin.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    			$pages = $_POST['pages'];
    			$language2 = $_POST['language2'];
    			$pc_skin = $_POST['pc_skin']; $pc_skin = addslashes($pc_skin);
    			$mobile_skin = $_POST['mobile_skin']; $mobile_skin = addslashes($mobile_skin);
    			
    			if(!$language2) msg_alert("오류! 언어설정이 없습니다.");
    			else {
    				$query = "SELECT * FROM `shop_desgin` WHERE `code`='$rows[code]' and `pages`='$rows[pages]'";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(mysql_affected_rows()) {
						$msg = multiString_conv("ko","중복된 스킨이름 입니다.",$LANG);
    					msg_alert($msg);
					} else {
    					$query = "UPDATE `shop_desgin` SET `code`='$language2', `pages`='$pages', `pc`='$pc_skin', `mobile`='$mobile_skin'  WHERE `Id`='$UID'";
    					mysql_db_query($mysql_dbname,$query,$connect);
    				
    					if($pc_skin) SkinFileSave($LANG,$pages."_pc.htm",$pc_skin);
    					if($mobile_skin) SkinFileSave($LANG,$pages.".htm",$mobile_skin);
    				}
    			}  
    			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_design.php'>";
    			page_back2();
    			break;
    			
    		default:
    	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_designedit");	
    			
    			////////////////////
		
				include "admin_design_left.php";
		
				//////////////////////		
    			$query = "select * from `shop_desgin` where Id = '$UID'";
    			// echo $query;	
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='country1' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					$body = str_replace("{pages}","<input type='text' name='pages' value='$rows[pages]' $cssFormStyle >",$body);
					
					$pc_skin = stripslashes($rows[pc]);		
					$body = str_replace("{pc_skin}","<textarea name='pc_skin' rows='8' style='width:100%'>$pc_skin</textarea>",$body);
					
					$mobile_skin = stripslashes($rows[mobile]);	
					$body = str_replace("{mobile_skin}","<textarea name='mobile_skin' rows='8' style='width:100%'>$mobile_skin</textarea>",$body);
					
					//////////////////////
					// $body = str_replace("{language}","<input type='text' name='language1' value='$rows[language]'  $cssFormStyle >",$body);
					
					$query1 = "select * from shop_language where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$body1 = "<select size='1' name='language2' $cssFormStyle> ";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);
				
							if($rows[code] == $rows1[code]) 
							$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[language]</option>";
							else $body1 .= "<option value='$rows1[code]' >$rows1[language]</option>";
						}
						$body1 .= "</select>";
					}
					$body = str_replace("{language}",$body1,$body);

					///////////////////////
					
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);
							
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_designedit.php?mode=del&UID=$UID\")' $css_submit >",$body);
							

					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

