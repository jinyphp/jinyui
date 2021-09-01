<?
	@session_start();
	
	
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; 
	include "mobile.php";
	
	include "./func_skin.php"; 
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
		$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";      
	} else { //////////////////////////////////////////
	

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(  mysql_num_rows($result)  ){ 
			$MEM=mysql_fetch_array($result);
		
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(  mysql_num_rows($result)  )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}

			
			//////////////////////////////////////////////////////////////////
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    		
    		
    		
    	
    		switch($mode){
    			case 'del':
    			
    				$query = "DELETE FROM `sales_warehouse` WHERE `Id`='$UID'";
    				mysql_db_query($server[dbname],$query,$dbconnect);
    				
    				echo "<script> history.go(-1); </script>";
    			
    				break;
    			case 'editup':
    				
					$enable = $_POST['enable'];
				
					$housename = $_POST['housename'];
    				$manager = $_POST['manager'];
    			
    				$phone = $_POST['phone']; 
    				$fax = $_POST['fax'];
    				$address = $_POST['address']; 
    			
    				$memo = $_POST['memo'];
    			
    		
    				if(!$housename) msg_alert("오류! 창고명이 없습니다.");
    				else {
    				
    					$query="UPDATE `sales_warehouse_$MEM[Id]` SET `housename`='$housename', `manager`='$manager', 
									`fax`='$fax', `phone`='$phone', `address`='$address',`memo`='$memo' WHERE `Id`='$UID' ";
    					mysql_db_query($server[dbname],$query,$dbconnect);
    						
    				}
    				echo "<script> history.go(-2); </script>";	
    			
    				
    				break;
    			default:
				
    				$query = "select * from `sales_warehouse_$MEM[Id]` where  Id = '$UID'";
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ){ 
		    			$rows=mysql_fetch_array($result);
		    			
		    			$body = shopskin("sales_warehouse_edit");
    				
						
						$body=str_replace("{formstart}","<form name='warehouse' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
										<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);
						
						$body = str_replace("{housename}","<input type='text' name='housename' value='$rows[housename]' $cssFormStyle placeholder='창고명'>",$body);	
			
						$query1 = "select * from sales_manager where members_id = '$MEM[Id]'";
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( $total1=mysql_num_rows($result1) ) {
							$manager = "<select name='manager' $cssFormStyle >";
							for($ii=0;$ii<$total1;$ii++){
								$rows1=mysql_fetch_array($result1);
								if($rows[manager] == $rows1[Id]) $manager .= "<option value='$rows1[Id]' selected>$rows1[name]</option>"; 
								else $manager .= "<option value='$rows1[Id]'>$rows1[name]</option>";
							}
							$body = str_replace("{manager}","$manager",$body);
						} else $body = str_replace("{manager}","",$body);
			
			
						$body = str_replace("{phone}","<input type='text' name='phone' value='$rows[phone]' $cssFormStyle placeholder='전화번호'>",$body);
						$body = str_replace("{fax}","<input type='text' name='fax' value='$rows[fax]' $cssFormStyle placeholder='팩스'>",$body);
						$body = str_replace("{address}","<input type='text' name='address' value='$rows[address]' $cssFormStyle placeholder='주소'>",$body);
			
						$body = str_replace("{memo}","<textarea name='memo' rows='10' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='메모'>$rows[memo]</textarea>",$body);
						
						
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $btn_style_blue>",$body);
									
					
						$body = str_replace("{delete}",skin_button("삭제","sales_manager_edit.php?mode=del&UID=$UID"),$body); 
						
							
						
						
					}	
					
    				break;
    		}
    		
			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	mysql_close($connect);
	mysql_close($dbconnect);

?>

