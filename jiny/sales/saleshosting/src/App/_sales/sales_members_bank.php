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
	include "./func_goods.php";
	
	include "./func_string.php";
	

	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

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
					$query="DELETE FROM `sales_members_bank` WHERE `Id`='$UID' and mem = '$MEM[Id]'";
					
					mysql_db_query($mysql_dbname,$query,$connect);
					echo "<meta http-equiv='refresh' content='0; url=sales_members_bank.php'>";
					break;
				case 'editup':
					$bankname = $_POST['bankname'];
    				$bankuser = $_POST['bankuser']; 
    				$banknum = $_POST['banknum']; 
    				$defaultbank = $_POST['defaultbank'];
    					
    				$country = $_POST['country'];
    				$swiff = $_POST['swiff'];
    					
					if(!$bankname) msg_alert("은행명 없습니다.");
    				else if(!$banknum) msg_alert("계좌번호 없습니다.");
    				else if(!$bankuser) msg_alert("예금주명 없습니다.");
					else {
						$query="UPDATE `sales_members_bank` SET `bankname`='$bankname', `bankuser`='$bankuser', `banknum`='$banknum', `defaultbank`='$defaultbank', `country`='$country', `swiff`='$swiff' WHERE `Id`='$UID'";
						mysql_db_query($mysql_dbname,$query,$connect);
					}
					echo "<meta http-equiv='refresh' content='0; url=sales_members_bank.php'>";
					break;
				case 'edit':
					$query = "select * from sales_members_bank where Id = '$UID' and mem = '$MEM[Id]'";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){ 
	    				$rows=mysql_fetch_array($result);
	    					
	    				$body = shopskin("sales_members_bank_new");
    					
    					$body=str_replace("{formstart}","<form name='fbankorm1' method='post' enctype='multipart/form-data' action='sales_members_bank.php'> 
										<input type='hidden' name='UID' value='$UID'>
					    			<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);
						
						if($rows[defaultbank]) $defaultbank = "checked";
						$body = str_replace("{default}","<input type='checkbox' name='defaultbank' $defaultbank>",$body);	
						$body = str_replace("{bankname}","<input type='text' name='bankname' value='$rows[bankname]' $cssFormStyle>",$body);
						$body = str_replace("{bankuser}","<input type='text' name='bankuser' value='$rows[bankuser]'  $cssFormStyle>",$body);
						$body = str_replace("{banknum}","<input type='text' name='banknum' value='$rows[banknum]' $cssFormStyle>",$body);
							
						$body = str_replace("{country}","<input type='text' name='country' value='$rows[country]' $cssFormStyle placeholder='국가명'>",$body);
						$body = str_replace("{swiff}","<input type='text' name='swiff' value='$rows[swiff]' $cssFormStyle placeholder='Swiff Code'>",$body);
						
						
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $btn_style_blue>",$body);
						// $body = str_replace("{delete}","<a href='sales_members_bank.php?mode=del&UID=$rows[Id]'>삭제</a>",$body);
						$body = str_replace("{delete}",_button_gray("삭제","sales_members_bank.php?mode=del&UID=$rows[Id]"),$body); 

						// echo $body;
	    					
	    				}
					break;
				case 'newup':
					if($_SESSION['nonce'] == $_POST['nonce']){
    					$bankname = $_POST['bankname'];
    					$bankuser = $_POST['bankuser']; 
    					$banknum = $_POST['banknum']; 
    					$defaultbank = $_POST['defaultbank'];
    						
    					$country = $_POST['country'];
    					$swiff = $_POST['swiff'];
    						
    					if(!$bankname) msg_alert("은행명 없습니다.");
    					else if(!$banknum) msg_alert("계좌번호 없습니다.");
    					else if(!$bankuser) msg_alert("예금주명 없습니다.");
						else {
    							$query ="INSERT INTO `sales_members_bank` (`mem`, `bankname`, `bankuser`, `banknum`, `defaultbank`, `country`, `swiff`) 
    										VALUES ('$MEM[Id]', '$bankname', '$bankuser', '$banknum', '$defaultbank', '$country', '$swiff');";
								mysql_db_query($mysql_dbname,$query,$connect);
						}
						echo "<meta http-equiv='refresh' content='0; url=sales_members_bank.php'>";

    				}
    				$_SESSION['nonce'] = NULL;	
				
					break;
				case 'new':
					$_SESSION['nonce'] = $nonce = md5('bank'.microtime());
					
					$body = shopskin("sales_members_bank_new");
					    					
    				$body=str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data' action='sales_members_bank.php'> 
										<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='newup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
						
						
					$body = str_replace("{default}","<input type='checkbox' name='defaultbank' >",$body);	
					$body = str_replace("{bankname}","<input type='text' name='bankname' $cssFormStyle placeholder='은행명'>",$body);
					$body = str_replace("{bankuser}","<input type='text' name='bankuser'  $cssFormStyle placeholder='예금주명'>",$body);
					$body = str_replace("{banknum}","<input type='text' name='banknum' $cssFormStyle placeholder='계좌번호'>",$body);
						
					$body = str_replace("{country}","<input type='text' name='country' $cssFormStyle placeholder='국가명'>",$body);
					$body = str_replace("{swiff}","<input type='text' name='swiff' $cssFormStyle placeholder='Swiff Code'>",$body);					
					
					$msg_bankname = "은행명 필드값을 입력해주세요.";
					$script = "<script>
       					function onSubmit(){
       						var submit = false;
  							if( !document.members.bankname.value ) {
  								alert(\"$msg_bankname\");
   								document.members.bankname.focus();  					       
   							} else document.members.submit();
  								
 						}
    					</script>"; 
    				$body = str_replace("{submit}","$script <input type='button' value='등록' $btn_style_blue onclick=\"javascript:onSubmit()\">",$body);		
					// $body = str_replace("{submit}","<input type='submit' name='reg' value='확인' >",$body);
					$body = str_replace("{delete}","",$body);
						
					break;	
				default:
					$body = shopskin("sales_members_bank");
					
					$body = str_replace("{new}",_button_blue("은행추가","sales_members_bank.php?mode=new"),$body);	
					
					$query = "select * from sales_members_bank where mem = '$MEM[Id]' order by bankname desc";
    				//echo $query."<br>"; 
    				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);
						
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if( mysql_num_rows($result) ){
    					for($i=0;$i<$total;$i++){
	    					$rows=mysql_fetch_array($result);
	    					$listform = bodyskin("sales_members_bank_list",$_SESSION['mobile'],$_SESSION['language']);
	    					$listform = str_replace("{country}","$rows[country]",$listform);
	    					$listform = str_replace("{swifft}","$rows[swifft]",$listform);
	    					$listform = str_replace("{bankname}","<a href='sales_members_bank.php?mode=edit&UID=$rows[Id]'>$rows[bankname]</a>",$listform);
	    					$listform = str_replace("{banknum}","$rows[banknum]",$listform);
	    					$listform = str_replace("{bankuser}","$rows[bankuser]",$listform);
	    					$list .= $listform;	
	    				}
	    				$body=str_replace("{databody}",$list,$body);		
					} else {
						$listform = bodyskin("sales_nodata",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{nodata}","등록된 은행정보가 없습니다.",$listform);
	    				$body=str_replace("{databody}",$listform,$body);	    	
	    			}

					
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

