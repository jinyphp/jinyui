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
	
		
	function status_string($status){
		switch($status){
			case 'new': return "신규주문"; break;
			case 'bankcheck': return "입금확인"; break;
			case 'credit': return "신용카드"; break;	
			case 'ordering': return "주문처리중"; break;
			case 'delivery': return "배송준비"; break;
			case 'delivering': return "배송중"; break;
			case 'finish': return "발송완료"; break;
			case 'cancel': return "취소"; break; 
			default: return "";	break; 
		}
	
	}
	
    
	if($_COOKIE[adminemail]){ ///////////////
	
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
     	$countryCode = $_GET['code']; if(!$countryCode) $countryCode = $_POST['code']; if(!$countryCode) $countryCode = $COUNTRY; 
		$status = $_POST['status']; if(!$status) $status = $_GET['status'];
		$limit = $_POST['limit']; if(!$limit) $limit = $_GET['limit'];
		 
		if($mode == "bankcheck"){
		
			$TID = $_POST['TID']; 					
    		for($i=0;$i<count($TID);$i++){
    			$query = "UPDATE `shop_order` SET  `status`='ordering' WHERE `Id`='$TID[$i]'";
    			mysql_db_query($mysql_dbname,$query,$connect);					
        	}

		} else if($mode == "ordercancel"){
		
			$TID = $_POST['TID']; 					
		
    		for($i=0;$i<count($TID);$i++){
    			$query = "UPDATE `shop_order` SET  `status`='cancel' WHERE `Id`='$TID[$i]'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    		}

		} 

		/////////////
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_orders");
		
		include "admin_order_left.php";
		


	
	
	
		$body = str_replace("{formstart}","<form name='ordercheck' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>
										<input type='hidden' name='status' value='$status'> 
									   <input type='hidden' name='code' value='$countryCode'>									 	
					      			   <input type='hidden' name='mode' >",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		
		if($_GET['status'] == "bankcheck"){
			$body = str_replace("{bankcheck}","<input type='button' name='bankcheck' value='입금확인' onclick='bankCheck()' style='font-size:9pt'>",$body);
			// $body = str_replace("{new}",skin_button("회원추가","admin_memlist_new.php"),$body);  
		} else $body = str_replace("{bankcheck}","",$body);

		
		$body = str_replace("{cancel}","<input type='button' name='ordercancel' value='주문취소' onclick='orderCancel()' style='font-size:9pt'>",$body);
		$body = str_replace("{delivery}","<input type='button' name='orderdelivery' value='물품발송' onclick='orderDelivery()' style='font-size:9pt'>",$body);
		


	
		$body = str_replace("{status}",status_string($status),$body); 
	

		
		$query = "select * from `shop_order` ";
		if($status)	{
			if($countryCode) $query .= "where status = '$status' and country = '$countryCode' ";
			else $query .= "where status = '$status' ";
		} else if($countryCode) $query .= "where country = '$countryCode' ";

		$query .= " order by regdate desc";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    	
    	$pages_listcount = 5;
		if($limit) $query .= " LIMIT $limit , $pages_listcount"; else $query .= " LIMIT 0 , $pages_listcount";
		
		echo $query;
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
		
			$ordername = "";
			if( ($total - $limit) < $pages_listcount ) $count = $total - $limit; else $count = $pages_listcount;
			// echo "COUNT = $count";
			
			for($i=0;$i<$count;$i++){
				$rows=mysql_fetch_array($result);
				//////////////////

					// $listfrom = FileLoad("./$LANG/admin_orders_list_pc.htm");
					$listfrom = admin_bodyskin("admin_orders_list","pc","ko");
					
					if($status == "new")
					$listfrom = str_replace("{regdate}","<a href='admin_orderview_new.php?cartlog=$rows[cartlog]&code=$countryCode&status=$status'>$rows[regdate]</a>",$listfrom);
					else 
					$listfrom = str_replace("{regdate}","<a href='admin_orderview.php?cartlog=$rows[cartlog]&code=$countryCode&status=$status'>$rows[regdate]</a>",$listfrom);
					
					$listfrom = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$rows[Id]'>",$listfrom);				
					
					// 배송방법
					$query2 = "select * from `shop_delivery` where Id ='$rows[deliveryway]'";
					$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
					if(mysql_affected_rows()) $rows2 = mysql_fetch_array($result2);
					$listfrom = str_replace("{way}","$rows2[name]",$listfrom);
					
					
					// 결제방법
					$param2 = explode(":",$rows[bankid]);
					if($param2[0] == "bank"){
						$query2 = "select * from `shop_bank` where Id ='$param2[1]'";
						$result2 = mysql_db_query($mysql_dbname,$query2,$connect);
						if(mysql_affected_rows()) {
							$rows2 = mysql_fetch_array($result2);
							$listfrom = str_replace("{bank}","$rows2[bankname]",$listfrom);
						}
					} else {
						$listfrom = str_replace("{bank}","$param2[0]",$listfrom);
					}
					
					
					
					
					
				
					$listfrom = str_replace("{status}",status_string($rows[status]),$listfrom);
					
		
					$listfrom = str_replace("{username}","$rows[username]",$listfrom);	
					$listfrom = str_replace("{userphone}","$rows[userphone]",$listfrom);	
					$listfrom = str_replace("{address}","$rows[address]",$listfrom);
					$listfrom = str_replace("{totalsum}","$rows[totalsum]",$listfrom);	
					$list .= $listfrom;
					
				///////////////
					
				$query1 = "select * from `shop_cart` where cartlog = $rows[cartlog]";
				$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1=mysql_result($result1,0,0);
		
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$total_sum = 0;
					for($ii=0;$ii<$total1;$ii++){
						$rows1=mysql_fetch_array($result1);
			 			$list .= "$rows1[goodname] $rows1[num] $rows1[currency] $rows1[prices]";
			 			$total_sum += $rows1[prices];
				 	}
				 	
				 	
				 	
				}
					
			/////////////////
			}
			
			$pageMenu = "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr><td align='center'>";
			for($i=1, $j=0; $j<$total; $i++, $j+=$pages_listcount){
				if($limit == $j)
				$pageMenu .= "<b><font size=2>$i</font></b>  |  ";
				else $pageMenu .= "<a href='admin_orders.php?limit=$j&status=$status'><font size=2>$i</font></a>  |  ";
			}
			$pageMenu .= "</td></tr></table>";
			$list .= $pageMenu;
			
			
			$body = str_replace("{datalist}","$list",$body);  //# 완성된 LIST를 치환합니다.
		
		} else {
			$listfrom = admin_bodyskin("admin_list_nodata","pc","ko");	
			$listfrom = str_replace("{nodata}","주문내역이 없습니다.",$listfrom);	
			$body = str_replace("{datalist}",$listfrom,$body); 
		}
		
		//# 번역스트링 처리
		$body = _adminstring_converting($body);	
		
		echo $body;

	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
			


?>
