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
    						
    			page_back1(); //갱신 수정후, 이전페이지로 이동...
    			
    			break;
    			
    		case 'editup':

    			$memauth = $_POST['memauth'];
    			
    			$money = $_POST['money'];
    			$point = $_POST['point'];
    			
    			$reg_money = $_POST['reg_money'];
    			$reg_point = $_POST['reg_point'];
    			
    			$save_money = $_POST['save_money'];
    			$save_point = $_POST['save_point'];
    			
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_memenv` ",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
		    		$query = "UPDATE `shop_memenv` SET `memauth`='$memauth', `money`='$money',`point`='$point'
		    		,`reg_money`='$reg_money',`reg_point`='$reg_point',`black_block`='$black_block',`black_alert`='$black_alert' 
		    		,`save_money`='$save_money',`save_point`='$save_point' ";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			} else {
    				$query = "INSERT INTO `shop_memenv` (`memauth`,`money`,`point`,`reg_money`,`reg_point`,`balck_block`,`black_alert`,`save_money`,`save_point`) 
    				VALUES ('$memauth','$money','$point','$reg_money','$reg_point','$balck_block','$black_alert','$save_money','$save_point');";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}
    			
				page_back1(); //갱신 수정후, 이전페이지로 이동...
    			break;
    			
    		default:	
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_memenv");
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_memenv` ",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    			}
				$body=str_replace("{formstart}","<form name='memenv' method='post' enctype='multipart/form-data' action='admin_memenv.php'> 
					    				<input type='hidden' name='UID' value='$UID'>
				    				<input type='hidden' name='mode' value='editup'>",$body);
				$body = str_replace("{formend}","</form>",$body);
					
				
				if($rows[memauth])
					$body = str_replace("{memauth}","<input type='checkbox' name='memauth' checked >",$body);
				else $body = str_replace("{memauth}","<input type='checkbox' name='memauth' >",$body);
					
				if($rows[point])
					$body = str_replace("{point}","<input type='checkbox' name='point' checked >",$body);
				else $body = str_replace("{point}","<input type='checkbox' name='point' >",$body);
				
				if($rows[money])
					$body = str_replace("{money}","<input type='checkbox' name='money' checked >",$body);
				else $body = str_replace("{money}","<input type='checkbox' name='money' >",$body);
				
				if($rows[reg_point])
					$body = str_replace("{reg_point}","<input type='checkbox' name='reg_point' checked >",$body);
				else $body = str_replace("{reg_point}","<input type='checkbox' name='reg_point' >",$body);
				
				if($rows[reg_money])
					$body = str_replace("{reg_money}","<input type='checkbox' name='reg_money' checked >",$body);
				else $body = str_replace("{reg_money}","<input type='checkbox' name='reg_money' >",$body);
				
				if($rows[black_block])
					$body = str_replace("{black_block}","<input type='checkbox' name='black_block' checked >",$body);
				else $body = str_replace("{black_block}","<input type='checkbox' name='black_block' >",$body);
				
				if($rows[black_alert])
					$body = str_replace("{black_alert}","<input type='checkbox' name='black_alert' checked >",$body);
				else $body = str_replace("{black_alert}","<input type='checkbox' name='black_alert' >",$body);
				
				$body = str_replace("{save_money}","<input type='text' name='save_money' value='$rows[save_money]' $cssFormStyle>",$body);
				$body = str_replace("{save_point}","<input type='text' name='save_point' value='$rows[save_point]' $cssFormStyle>",$body);
				
				$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);		
				$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_memenv.php?mode=del&UID=$UID\")' style='font-size:9pt' $css_submit>",$body);

				//# 번역스트링 처리
				$body = _adminstring_converting($body);
		
				echo $body;
				
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

