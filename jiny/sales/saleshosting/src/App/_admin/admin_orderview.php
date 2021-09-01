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
    	$countryCode = $_GET['code']; if(!$countryCode) $countryCode = $_POST['code']; if(!$countryCode) $countryCode = $COUNTRY; 
		$status = $_POST['status']; if(!$status) $status = $_GET['status'];
    	
			
		switch($mode){
				
			case 'editup':
				$cartlog = $_POST['cartlog'];					
					
    			$deliveryway = $_POST['deliveryway'];
    			$deliverycom = $_POST['deliverycom'];
    			$deliveryinvoice = $_POST['deliveryinvoice'];
    			$deliverydate = $_POST['deliverydate'];

				$deliverynum = $_POST['deliverynum'];
    				    					
    			$query = "UPDATE `shop_order` SET `status`='finish', `deliverydate`='$deliverydate', `deliverynum`='$deliverynum' WHERE `cartlog`='$cartlog'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    									
				echo "<meta http-equiv='refresh' content='0; url=admin_orders.php'>";
				break;

					
			default:
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.		
				$body = admin_shopskin("admin_orderview");
    					
				include "admin_order_left.php";
   
				$query = "select * from `shop_order` WHERE `cartlog`='".$_GET['cartlog']."'";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					$rows=mysql_fetch_array($result);
							
					$body = str_replace("{regdate}","$rows[regdate]",$body);
							
							
					$query2 = "select * from `shop_country` where code ='$rows[deliverycode]'";
					$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
					if(mysql_affected_rows()) $rows2 = mysql_fetch_array($result2);
					$body = str_replace("{target}","$rows2[name]",$body);
							
					
					$query2 = "select * from `shop_delivery` where Id ='$rows[deliveryway]'";
					$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
					if(mysql_affected_rows()) $rows2 = mysql_fetch_array($result2);
					$body = str_replace("{way}","$rows2[name]",$body);
					
					$param2 = explode(":",$rows[bankid]);
					if($param2[0] == "bank"){
						$query2 = "select * from `shop_bank` where Id ='$param2[1]'";
						// $query2 = "select * from `shop_bank` where Id ='$rows[bankid]'";
						$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
						if(mysql_affected_rows()) $rows2 = mysql_fetch_array($result2);
							$body = str_replace("{bank}","$rows2[bankname]",$body);
						} else {
						$body = str_replace("{bank}","$param2[0]",$body);
						}

						$body = str_replace("{totalsum}","$rows[totalsum]",$body);
					
						switch($rows[status]){
							case 'bankcheck':
								$body = str_replace("{status}","입금확인",$body);	
								break;
							case 'ordering':
								$body = str_replace("{status}","접수완료",$body);						
								break;
							case 'credit': 
								$body = str_replace("{status}","신용카드",$body); 
								break;	
							case 'finish':
								$body = str_replace("{status}","완료",$body);						
								break;		
						}
							
						$body = str_replace("{username}","$rows[username]",$body);	
						$body = str_replace("{userphone}","$rows[userphone]",$body);	
						$body = str_replace("{address}","$rows[address]",$body);	

							
					}
						
				////////////////////////////
						
				$query = "select * from `shop_cart` WHERE `cartlog`='".$_GET['cartlog']."'";
				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    			$total=mysql_result($result,0,0);
		
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {

				for($i=0;$i<$total;$i++){
					$rows1=mysql_fetch_array($result);
					$numsum = $rows1[prices] * $rows1[num];
								
					$listfrom = admin_bodyskin("admin_orderview_list","pc","ko");
								
					$listfrom = str_replace("{goodname}",$rows1[goodname],$listfrom);
					$listfrom = str_replace("{currency}","$rows1[num]개",$listfrom);
					$listfrom = str_replace("{prices}","$rows1[currency] $numsum",$listfrom);
					$listfrom = str_replace("{upload}","<a href='.$rows[upload]'>$rows1[upload]</a>",$listfrom);
					$listfrom = str_replace("{ordertext}",$rows1[ordertext],$listfrom);
								
					$list .= $listfrom;				
								
				}
				$body = str_replace("{datalist}",$list,$body);
			} else 	$body = str_replace("{datalist}","기록된 주문상품이 없습니다.",$body);	
						
			///////////////////////////////
						
			$body=str_replace("{formstart}","<form name='orderview' method='post' enctype='multipart/form-data' action='admin_orderview.php'> 
										<input type='hidden' name='status' value='$status'> 
									    <input type='hidden' name='code' value='$countryCode'>
										<input type='hidden' name='cartlog' value='".$_GET['cartlog']."'>			    				
					    				<input type='hidden' name='mode' value='editup'>",$body);
			$body = str_replace("{formend}","</form>",$body);
						
			$body = str_replace("{deliveryway}","<input type='text' name='deliveryway'  $cssFormStyle >",$body);
			$body = str_replace("{deliverycom}","<input type='text' name='deliverycom' $cssFormStyle >",$body);
			$body = str_replace("{deliverynum}","<input type='text' name='deliverynum' value='$rows[deliverynum]' $cssFormStyle >",$body);
						
						
			if($rows[deliverydate]){
				$body = str_replace("{deliverydate}","<input type='date' name='deliverydate' value='$rows[deliverydate]' $cssFormStyle >",$body);
			} else {
				$body = str_replace("{deliverydate}","<input type='date' name='deliverydate' value='$TODAY' $cssFormStyle >",$body);
    		}
    					
    		$body = str_replace("{submit}","<input type='submit' name='reg' value='배송' >",$body);
    					
						
 						
    					
			//# 번역스트링 처리
			$body = _adminstring_converting($body);
			
			echo $body;
						
			break;
		}
				
				
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
					
			


?>

