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
				
	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    $UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
				
	switch($mode){
				
		case 'editup':
						
    		$TID = $_POST['TID'];
    						
    		$deliveryway = $_POST['deliveryway'];
    		$deliverycom = $_POST['deliverycom'];
    		$deliveryinvoice = $_POST['deliveryinvoice'];
    		$deliverydate = $_POST['deliverydate'];
    					
    		$TID = $_POST['TID']; 					
		
    		for($i=0;$i<count($TID);$i++){
    			$query = "UPDATE `shop_cart` SET `status`='finish', `deliverydate`='$deliverydate', `deliverycompany`='$deliverycom', `deliveryinvoice`='$deliveryinvoice' WHERE `Id`='$TID[$i]'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    							
        	}
						
			echo "<meta http-equiv='refresh' content='0; url=admin_orders.php'>";
			break;

					
		default:
			//# 화면 디자인 템플릿을 스킨 읽어옵니다.			
			$body = admin_shopskin("admin_ordersdelivery");
    					    					
    		$TID = $_POST['TID']; 
    					
    		for($i=0;$i<count($TID);$i++){
    					
    			$query = "select * from `shop_cart` WHERE `Id`='$TID[$i]'";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
							
					$rows=mysql_fetch_array($result);
    							
    				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
					$list .= "<td width='10'> <input type='checkbox' name='TID[]' value='$rows[Id]' checked></td>";
					$list .= "<td width='150' bgcolor='ffffff'> <font size=2> $rows[goodname]</font></td>";
					$list .= "<td width='50' bgcolor='ffffff'> <font size=2> $rows[currency]</font></td>";
					$list .= "<td width='50' bgcolor='ffffff'> <font size=2> $rows[prices]</font></td>";
					$list .= "<td bgcolor='ffffff'> <font size=2> $rows[ordertext]</font></td>";
					$list .= "</tr></table>";
				}
    							
        	}

    		$body = str_replace("{datalist}","$list",$body); 
    					
    		$body=str_replace("{formstart}","<form name='delivery' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						<input type='hidden' name='mode' value='editup'>",$body);
			$body = str_replace("{formend}","</form>",$body);
    					    					
    		$body = str_replace("{deliveryway}","<input type='text' name='deliveryway'  $cssFormStyle >",$body);
			$body = str_replace("{deliverycom}","<input type='text' name='deliverycom' $cssFormStyle >",$body);
							
			$body = str_replace("{deliveryinvoice}","<input type='text' name='deliveryinvoice'  $cssFormStyle >",$body);
			$body = str_replace("{deliverydate}","<input type='date' name='deliverydate'  value='$TODAY'  $cssFormStyle >",$body);
    					
    		$body = str_replace("{submit}","<input type='submit' name='reg' value='발송' >",$body);
    					
    					
    					
			//# 번역스트링 처리
			$body = _adminstring_converting($body);	
			echo $body;
						
			break;
		}
				
				
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
			
	

?>

