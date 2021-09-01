<?
	@session_start();
	
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; //# 사이트 언어, 지역 설정
	include "mobile.php";
	
	include "./func_skin.php"; //# 스킨 레이아웃 함수들...
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
			$company = $_GET['company']; if(!$company) $company = $_POST['company'];
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];

			$body = shopskin("sales_order_print");
			
			//////////////////////////////
			// 리스트 표시...	
			$query = "select * from `sales_quotation_$MEM[Id]` where Id = '$UID'";	
			//echo $query."<br>";		
			// $result=mysql_db_query($mysql_dbname,$query,$connect);
			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){
	    		$quo=mysql_fetch_array($result);
	    		
				//echo "$quo[quo_parts] <br>";
	
				if($quo[quo_parts]){
					$_quo = explode(";",$quo[quo_parts]);
					
					//echo "count".count($_quo);
					
					for($i=0,$prices=0;$i<count($_quo);$i++){
						$listform = bodyskin("sales_quotation_new_list",$_SESSION['mobile'],$_SESSION['language']);
						
						$listform = str_replace("#D2D2D2","#000000",$listform);
						
						//$parts = $_POST['goods'] .":$goodname:$spec:$num:$currency:$prices:$vat:$discount:$prices_sum:$prices_total";
						$quo_part = explode(":",$_quo[$i]);
						$listform = str_replace("{TID}","$i",$listform);
						$listform = str_replace("{goodname}","$quo_part[1]",$listform);
						$listform = str_replace("{spec}","$quo_part[2]",$listform);
						$listform = str_replace("{num}","$quo_part[3]",$listform);
						$listform = str_replace("{currency}","$quo_part[4]",$listform);
						$listform = str_replace("{prices}","$quo_part[5]",$listform);
						$listform = str_replace("{vat}","$quo_part[6]",$listform);
						$listform = str_replace("{discount}","$quo_part[7]",$listform);
						$listform = str_replace("{sum}","$quo_part[8]",$listform);
						$listform = str_replace("{total}","$quo_part[9]",$listform);
						
						$prices += $quo_part[9];
						
						$list .= $listform; 
					}
					$body = str_replace("{datalist}",$list,"$body");
						
					$body = str_replace("{quoprices}",$prices,"$body");
						
				} else {
					$body = str_replace("{datalist}","","$body");
					$body = str_replace("{quoprices}","","$body");
				}
			} 
			
			
			$body=str_replace("{biznumber1}","$MEM[biznumber]",$body);
			$body=str_replace("{company1}","$MEM[company]",$body);
			$body=str_replace("{president1}","$MEM[president]",$body);
			$body=str_replace("{address1}","$MEM[address]",$body);
			$body=str_replace("{subject1}","$MEM[subject]",$body);
			$body=str_replace("{item1}","$MEM[item]",$body);
			
			
			$body=str_replace("{transdate}","$quo[transdate]",$body);
			$body=str_replace("{company_name}","$quo[company_name]",$body);
			$body=str_replace("{company_manager}","$quo[company_manager]",$body);
			$body=str_replace("{company_ref}","$quo[company_ref]",$body);
			
			$body=str_replace("{phone}","$quo[phone]",$body);
			$body=str_replace("{fax}","$quo[fax]",$body);
			$body=str_replace("{email}","$quo[email]",$body);
			
			
			$body=str_replace("{title}","$quo[title]",$body);
			
			$body=str_replace("{quomemo}","$quo[quomemo]",$body);
			
			$body = str_replace("{formstart}","<form name='print' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						 <input type='hidden' name='UID' value='$UID'>
					    						 <input type='hidden' name='company_id' value='$company_id'>					    						
					    						 <input type='hidden' name='mode'>",$body);
			$body = str_replace("{formend}","</form>",$body);
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
    		$body = str_replace("{print}","$script <input type='button' value='인쇄' $btn_style_blue onclick=\"javascript:pageprint()\">",$body);	
			
			$body = str_replace("{pdf}","$script <input type='button' value='PDF' $btn_style_gray onclick=\"javascript:pdf()\">",$body);
			
			
			
			
			
			
			
			
			
			
		
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	mysql_close($connect);
	mysql_close($dbconnect);	

	
?>
