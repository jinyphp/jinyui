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
    			$query = "DELETE FROM `shop_pg` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    						
    			// echo "<meta http-equiv='refresh' content='0; url=admin_pg.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    			
    			
    			$pgcountry = $_POST['pgcountry'];
    		
    			$pgname = $_POST['pgname'];
    			$pgid = $_POST['pgid'];
    			$pgkey = $_POST['pgkey'];
    			
				$enable = $_POST['enable'];	
				
				$pgcomment = $_POST['pgcomment'];
    						

				if(!$pgname) msg_alert("오류! PG 이름이 없습니다.");
    			else {

    				$query = "UPDATE `shop_pg` SET `country`='$pgcountry', `pgname`='$pgname', `pgid`='$pgid', `pgkey`='$pgkey', `pgsite`='$pgsite', `enable`='$enable', `pgcomment`='$pgcomment'  WHERE `Id`='$UID'";
    				// echo $query ;
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}  
    			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_pg.php'>";
    			page_back2();
    			break;
    			
    		default:
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
				$body = admin_shopskin("admin_pgedit"); 		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_pg` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='domain' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
					
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked $cssFormStyle >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' $cssFormStyle >",$body);
					
					
					// $body = str_replace("{country}","<input type='text' name='pgcountry' value='$rows[country]' $cssFormStyle >",$body);	
					$query1 = "select * from shop_country where enable = 'on' or enable = 'checked'";
					$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1 = mysql_result($result1,0,0);
				
    				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    				if(mysql_affected_rows()){
    					$body1 = "<select size='1' name='pgcountry' $cssFormStyle> ";
						for($i1=1;$i1<=$total1;$i1++){
							$rows1=mysql_fetch_array($result1);
				
							if($rows[country] == $rows1[code]) 
							$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[name]</option>";
							else $body1 .= "<option value='$rows1[code]' >$rows1[name]</option>";
						}
						$body1 .= "</select>";
					}
					$body = str_replace("{country}",$body1,$body);
					

					
					$body = str_replace("{pgname}","<input type='text' name='pgname' value='$rows[pgname]' $cssFormStyle >",$body);
					$body = str_replace("{pgid}","<input type='text' name='pgid' value='$rows[pgid]' $cssFormStyle >",$body);
					$body = str_replace("{pgkey}","<input type='text' name='pgkey'  value='$rows[pgkey]'  $cssFormStyle >",$body);
					$body = str_replace("{pgsite}","<input type='text' name='pgsite' value='$rows[pgsite]' $cssFormStyle >",$body);
					$body = str_replace("{pgcomment}","<input type='text' name='pgcomment' value='$rows[pgcomment]' $cssFormStyle >",$body);	
				
					
					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit>",$body);
							
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_pgedit.php?mode=del&UID=$UID\")' $css_submit>",$body);
							

						
				}

			//# 번역스트링 처리
			$body = _adminstring_converting($body);
			echo $body;
				
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>

