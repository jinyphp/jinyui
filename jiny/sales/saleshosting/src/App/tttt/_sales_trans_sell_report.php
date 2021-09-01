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
    	// echo $query; 
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
			$company_id = $_POST['company_id']; if(!$company_id) $company_id = $_GET['company_id'];
			$transdate = $_POST['transdate']; if(!$transdate) $transdate = $_GET['transdate'];
			$report = $_POST['report']; if(!$report) $report = $_GET['report'];
			$TID = $_POST['TID'];
			
			// echo "$report";
			
			if($mode == "print"){
				$nonce = md5('print'.microtime());
				for($i=0;$i<count($TID);$i++){
					$query = "UPDATE `sales_trans_$MEM[Id]` SET `report`= '$nonce', `report_date`= '$TODAY' where Id = '$TID[$i]'";
					// echo $query."<br>";
					// mysql_db_query($mysql_dbname,$query,$connect);
					mysql_db_query($server[dbname],$query,$dbconnect);
					$script = "<script> document.print.mode.value = \"\"; </script>";
					echo $script;
    			}
			} 
			
			if($_POST['formtype'] == "page"){
				$body = shopskin("sales_trans_sell_report");
			} else if($_POST['formtype'] == "half"){
				$body = shopskin("sales_trans_sell_report_half");
			} else $body = shopskin("sales_trans_sell_report");
		
			$script = "<script>
       				function pageprint() {
						var divElements = document.getElementById('printbody').innerHTML;
            			var oldPage = document.body.innerHTML;
           				document.body.innerHTML = \"<html><head><title></title><link rel='stylesheet' type='text/css' href='css/print.css' media='print'></head><body>\" + divElements + \"</body>\";
           				
           				window.print();
           				document.body.innerHTML = oldPage;
           				
           				document.print.mode.value = \"print\";
      					document.print.submit();
       				 } 			
    			</script>"; 
    		
    		$body = str_replace("{formstart}","<form name='print' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='report' value='$report'>
					    						 <input type='hidden' name='company_id' value='$company_id'>					    						
					    						 <input type='hidden' name='mode'>",$body);
			$body = str_replace("{formend}","</form>",$body);
    		$body = str_replace("{print}","$script <input type='button' value='인쇄' $butten_style onclick=\"javascript:pageprint()\">",$body);	
    	
    		$CSS = "style='height:28px;;width:100%;margin:-3px;border:2px;background-color:#f2f2f2'";
			$FORM_type = "<select size='1' name='formtype' $CSS onChange=\"javascript:submit()\">";
		    if($_POST['formtype'] == "page") $FORM_type .= "<option value='page' selected>A4 전체</option>"; else $FORM_type .= "<option value='page'>A4 전체</option>";
		    if($_POST['formtype'] == "half") $FORM_type .= "<option value='half' selected>A4 반장</option>"; else $FORM_type .= "<option value='half'>A4 반장</option>";
		    $FORM_type .= "</select>";
		    $body=str_replace("{formtype}","$FORM_type",$body);
			
			
			
			
			$body=str_replace("{biznumber1}","$MEM[biznumber]",$body);
			$body=str_replace("{company1}","$MEM[company]",$body);
			$body=str_replace("{president1}","$MEM[president]",$body);
			$body=str_replace("{address1}","$MEM[address]",$body);
			$body=str_replace("{subject1}","$MEM[subject]",$body);
			$body=str_replace("{item1}","$MEM[item]",$body);
			
			
			if($company_id){
				$query = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
				// $result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
	    			$coms=mysql_fetch_array($result);
				}
			}
			
			$body=str_replace("{biznumber2}","$coms[biznumber]",$body);
			$body=str_replace("{company2}","$coms[company]",$body);
			$body=str_replace("{president2}","$coms[president]",$body);
			$body=str_replace("{address2}","$coms[address]",$body);
			$body=str_replace("{subject2}","$coms[subject]",$body);
			$body=str_replace("{item2}","$coms[item]",$body);
			
			$list = "";	
				
			//# 선택한 결제 전표 목록 출력.
			if($TID){
					// $list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
					for($i=0,$amount=0;$i<count($TID);$i++){
    					$query = "select * from `sales_trans_$MEM[Id]` where Id = '$TID[$i]'";
    					// $result=mysql_db_query($mysql_dbname,$query,$connect);
    					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ) {
    						$rows=mysql_fetch_array($result); 
    					
    						$listform = bodyskin("sales_trans_sell_report_list",$_SESSION['mobile'],$_SESSION['language']);
							
							$tid_form .= "<input type='hidden' name='TID[]' value='$TID[$i]'>";
							
							$listform = str_replace("{goodname}","$rows[goodname]","$listform");
							$listform = str_replace("{num}","$rows[num]","$listform");
							$listform = str_replace("{prices}","$rows[prices]","$listform");
							$listform = str_replace("{sum}","$rows[prices_sum]","$listform");
							$listform = str_replace("{vat}","$rows[vat]","$listform");
							$listform = str_replace("{discount}","$rows[discount]","$listform");
							$listform = str_replace("{total}","$rows[prices_total]","$listform");
							
							$day=substr($rows[transdate],8,2);
    						  						
							$listform = str_replace("{TID}","$day","$listform");

							$prices_sum += $rows[prices_sum];
							$vat_sum += $rows[vat];

							$tot_prices += $rows[prices_total];
							
							if(!$_POST['formtype'] || $_POST['formtype'] == "page") $list .= $listform;
							else if($_POST['formtype'] == "half" && $i<8) $list .= $listform;
							
							
        				}		
    				}
    				
    				
    				$body=str_replace("{prices_sum}","$prices_sum",$body);
    				$body=str_replace("{tax_sum}","$vat_sum",$body);
    				$body=str_replace("{balance}","$coms[balance1]",$body);
    				$body=str_replace("{prices_total}","$tot_prices",$body);
    				
    				$body=str_replace("{trans_memo}","$rows[transmemo]",$body);
    				
    				if($transdate) $body=str_replace("{transdate}","$transdate",$body);
					else $body=str_replace("{transdate}","$rows[transdate]",$body);
    				
			} else if($report){
				
				$query = "SELECT * FROM `sales_trans_$MEM[Id]` where report = '$report'";
				// echo $query."<br>";
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    			$total = mysql_result($result,0,0);
    		
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
	    				
	    				$listform = bodyskin("sales_trans_sell_report_list",$_SESSION['mobile'],$_SESSION['language']);
							
						$form_tid .= "<input type='hidden' name='TID[]' value='$TID[$i]'>";
							
						$listform = str_replace("{goodname}","$rows[goodname]","$listform");
						$listform = str_replace("{num}","$rows[num]","$listform");
						$listform = str_replace("{prices}","$rows[prices]","$listform");
						$listform = str_replace("{sum}","$rows[prices_sum]","$listform");
						$listform = str_replace("{vat}","$rows[vat]","$listform");
						$listform = str_replace("{discount}","$rows[discount]","$listform");
						$listform = str_replace("{total}","$rows[prices_total]","$listform");
							
						$day=substr($rows[transdate],8,2);
    						  						
						$listform = str_replace("{TID}","$day","$listform");

						$prices_sum += $rows[prices_sum];
						$vat_sum += $rows[vat];

						$tot_prices += $rows[prices_total];
						
						if(!$_POST['formtype'] || $_POST['formtype'] == "page") $list .= $listform;
						else if($_POST['formtype'] == "half" && $i<8) $list .= $listform;

					}
					
    				$body=str_replace("{prices_sum}","$prices_sum",$body);
    				$body=str_replace("{tax_sum}","$vat_sum",$body);
    				$body=str_replace("{balance}","$coms[balance1]",$body);
    				$body=str_replace("{prices_total}","$tot_prices",$body);
    				
    				$body=str_replace("{trans_memo}","$rows[transmemo]",$body);
    				
    				if($transdate) $body=str_replace("{transdate}","$transdate",$body);
					else $body=str_replace("{transdate}","$rows[transdate]",$body);
				}
				
			} else msg_alert("오류! 인쇄할 내용이 없습니다.");
			
			
			if($_POST['formtype'] == "half" && $i<7){
    			for(;$i<7;$i++){
    				$listform = bodyskin("sales_trans_sell_report_list",$_SESSION['mobile'],$_SESSION['language']);
						
					$listform = str_replace("{TID}","&nbsp;","$listform");
					$listform = str_replace("{goodname}","","$listform");
					$listform = str_replace("{num}","","$listform");
					$listform = str_replace("{prices}","","$listform");
					$listform = str_replace("{sum}","","$listform");
					$listform = str_replace("{vat}","","$listform");
					$listform = str_replace("{discount}","","$listform");
					$listform = str_replace("{total}","","$listform");
						
					$list .= $listform;
				}
						
    		}
    				
    		$body=str_replace("{paylist}","$list",$body);
    				
			$body=str_replace("{tid}","$tid_form",$body);
			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
		
		/*
		if($mode == "print") {
			$script = "<script>
       				
						var divElements = document.getElementById('printbody').innerHTML;
            			var oldPage = document.body.innerHTML;
           				document.body.innerHTML = \"<html><head><title></title><link rel='stylesheet' type='text/css' href='css/print.css' media='print'></head><body>\" + divElements + \"</body>\";
           				
           				window.print();
           				document.body.innerHTML = oldPage;	       
       				 			
    			</script>"; 
    		echo $script;
		}	
		*/						
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);	


?>

