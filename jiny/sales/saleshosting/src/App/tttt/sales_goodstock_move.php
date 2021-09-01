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
    		$GID = $_GET['GID']; if(!$GID) $GID = $_POST['GID'];
    		$warehouse = $_GET['warehouse']; if(!$warehouse) $warehouse = $_POST['warehouse'];
    		
    		
    	
    		switch($mode){
    			
    			case 'editup':
    			
    				$num = $_POST['num'];
    				$target = $_POST['target'];
    			
    		
    				if(!$num) msg_alert("오류! 이동 수량이 없습니다.");
    				else {
    				
    					$query = "select * from `sales_goodstock_$MEM[Id]` where  GID = '$GID' and warehouse = '$warehouse'";
    					//echo $query."<br>";
    					$result=mysql_db_query($server[dbname],$query,$dbconnect);
						if(  mysql_num_rows($result)  ){ 
		    				$rows=mysql_fetch_array($result);
    				
    						//echo "stock .. $rows[stock] , num $num <br>";
    				
    						$stock = $rows[stock] - $num;
    						//echo "$stock = stock : $rows[stock] - num : $num <br>";
    						$query="UPDATE `sales_goodstock_$MEM[Id]` SET `stock`='$stock' where  GID = '$GID' and warehouse = '$warehouse'";
    						//echo $query."<br>";
    					
    						mysql_db_query($server[dbname],$query,$dbconnect);
    				
    				
    						//////////////////
    						
    						$query = "select * from `sales_goodstock_$MEM[Id]` where  GID = '$GID' and warehouse = '$target'";
    						//echo $query."<br>";
    						$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if(  mysql_num_rows($result)  ){ 
		    					$rows=mysql_fetch_array($result);
		    					
		    					$stock = $rows[stock] + $num;
    							$query="UPDATE `sales_goodstock_$MEM[Id]` SET `stock`='$stock' where  GID = '$GID' and warehouse = '$target'";
    							//echo $query."<br>";
    							mysql_db_query($server[dbname],$query,$dbconnect);
    						
    						} else {
    							$query = "INSERT INTO `sales_goodstock_$MEM[Id]` (`warehouse`, `GID`, `stock`) VALUES ('$target', '$GID', '$num')";
    							//echo $query."<br>";
    							mysql_db_query($server[dbname],$query,$dbconnect);
    						
    						}
    					
    						
    						
    					}
    				
    					
    						
    				}
    				echo "<script> history.go(-2); </script>";	
    			
    				
    				break;
    			default:
				
    				$query = "select * from `sales_goodstock_$MEM[Id]` where  GID = '$GID' and warehouse = '$warehouse'";
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ){ 
		    			$rows=mysql_fetch_array($result);
		    			
		    			$body = shopskin("sales_goodstock_move");
    				
						
						$body=str_replace("{formstart}","<form name='warehouse' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
										<input type='hidden' name='GID' value='$GID'>
										<input type='hidden' name='warehouse' value='$warehouse'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);
						
						
						$query1 = "SELECT * FROM `sales_warehouse_$MEM[Id]` where Id = '$rows[warehouse]'";
						$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
    					if( mysql_num_rows($result1) ){ 
    						$rows1=mysql_fetch_array($result1);
							$body = str_replace("{warehouse}","$rows1[housename]",$body);	
						} else $body = str_replace("{warehouse}","",$body);
						
						
						//# 창고리스트  처리
						$query1 = "select * from sales_warehouse_$MEM[Id] ";
						$result1=mysql_db_query($server[dbname],$query1,$dbconnect);
						if( $total1=mysql_num_rows($result1) ) {
							$form_warehouse = "<select name='target' $cssFormStyle >";
							for($ii=0;$ii<$total1;$ii++){
								$rows1=mysql_fetch_array($result1);
								//if($warehouse == $rows1[Id]) $form_warehouse .= "<option value='$rows1[Id]' selected>$rows1[housename]</option>"; 
								//else 
								$form_warehouse .= "<option value='$rows1[Id]'>$rows1[housename]</option>";
							}
							$body = str_replace("{target}","$form_warehouse",$body);
						} else $body = str_replace("{target}","",$body);
						
						
						
						
						$body = str_replace("{num}","<input type='text' name='num'  $cssFormStyle placeholder='수량'>",$body);
						$body = str_replace("{stock}","$rows[stock]",$body);

						
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

