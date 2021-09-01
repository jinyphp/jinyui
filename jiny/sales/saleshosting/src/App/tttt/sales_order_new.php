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
	
	
	$CSS_search = "style='height:30px;;width:100%;margin:-3px;border:2px;border:1px solid #D2D2D2;'";
	
	function _form_newdata($tid,$transdate,$goods,$goodname,$spec,$num,$prices,$sum,$vat,$discount,$total){
				
		$CSS = "style='height:30px;;width:100%;margin:-3px;border:2px;background-color:#f2f2f2'";
		
		$listform = bodyskin("sales_quotation_new_list",$_SESSION['mobile'],$_SESSION['language']);
		
		// $listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$tid' >","$listform");
		$listform = str_replace("{TID}","","$listform");
				
		$day=substr($transdate,8,2);
		$listform = str_replace("{day}","<input type='text' name='day' value='$day' $CSS>","$listform");
			
		if($goodname) 
		$listform = str_replace("{goodname}","<input type='hidden' name='goods' value='$goods'><input type='text' name='goodname' value='$goodname' autofocus $CSS onChange=\"javascript:submit()\">","$listform");	
		else $listform = str_replace("{goodname}","<input type='hidden' name='goods' value='$goods'><input type='text' name='goodname' placeholder='상품명' autofocus $CSS onChange=\"javascript:submit()\">","$listform");
		
		if($spec) 	
		$listform = str_replace("{spec}","<input type='text' name='spec' value='$spec' $CSS>",$listform );
		else $listform = str_replace("{spec}","<input type='text' name='spec' placeholder='규격' $CSS>",$listform );
		
		

		$listform .= "<script>
       			function trans_sum(vat){
 					document.quo.sum.value = document.quo.num.value * document.quo.prices.value;
 					
 					if(vat) document.quo.vat.value = document.quo.sum.value / 100 * vat;
 					
 					document.quo.total.value = Number(document.quo.sum.value)  + Number(document.quo.vat.value);
 				}
    		</script>"; 
		
		if($num)
		$listform = str_replace("{num}","<input type='text' name='num' value='$num' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{num}","<input type='text' name='num' placeholder='수량' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($prices)
		$listform = str_replace("{prices}","<input type='text' name='prices' value='$prices' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{prices}","<input type='text' name='prices' placeholder='단가' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($sum)
		$listform = str_replace("{sum}","<input type='text' name='sum' value='$sum' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{sum}","<input type='text' name='sum' placeholder='공급액' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($vat)
		$listform = str_replace("{vat}","<input type='text' name='vat' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{vat}","<input type='text' name='vat' placeholder='부가세' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($discount)
		$listform = str_replace("{discount}","<input type='text' name='discount' value='$discount' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		else $listform = str_replace("{discount}","<input type='text' name='discount' placeholder='할인액' $CSS onChange=\"javascript:trans_sum($vat)\">",$listform );
		
		if($total)
		$listform = str_replace("{total}","<input type='text' name='total' value='$total' $CSS onChange=\"javascript:submit($vat)\">",$listform );
		else $listform = str_replace("{total}","<input type='text' name='total' placeholder='합계' $CSS onChange=\"javascript:submit($vat)\">",$listform );
		
		return $listform; 
	}
	

	//
	//
	
	
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

			$body = shopskin("sales_order_new");
			
			if($mode == "remove" && $_SESSION['nonce'] == $_POST['nonce']){
	    		$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$query = "select * from `sales_quotation_$MEM[Id]` where quo = '".$_SESSION['quotation']."'";		
				// $result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ) $quo=mysql_fetch_array($result);	    		
	
	    		if( $quo[quo_parts] ){
					$TID = $_POST['TID'];
					$_quo = explode(";",$quo[quo_parts]);
					$bbb = "";
					for($i=0;$i<count($_quo);$i++){
						$quo_part = explode(":",$_quo[$i]);
    					for($j=0;$j<count($TID);$j++) {
    						if($TID[$j] == $i) $delete = "true"; else $delete = "false";
    						//echo "is $TID[$j] == $i <br>";
						}
						if($delete == "false" && $_quo[$i] ) 
							if($bbb) $bbb .= ";".$_quo[$i]; else  $bbb = $_quo[$i];
					}
						
					$query = "UPDATE `sales_quotation_$MEM[Id]` SET `quo_parts`= '$bbb' where quo = '".$_SESSION['quotation']."'";
					// echo $query."<br>";
					// mysql_db_query($mysql_dbname,$query,$connect);
					mysql_db_query($server[dbname],$query,$dbconnect);
				}
	    	} else if($mode == "new"){
				// 견적 섹션값이 없는 경우, 생성 및 테이블 추가
				$_SESSION['quotation'] = md5('quo'.microtime()); 
				
				$query = "INSERT INTO `sales_quotation_$MEM[Id]` (`type`,`quo`) VALUES ('order','".$_SESSION['quotation']."');";
				// mysql_db_query($mysql_dbname,$query,$connect);
				mysql_db_query($server[dbname],$query,$dbconnect);
			
				$query = "select * from `sales_quotation_$MEM[Id]` where quo = '".$_SESSION['quotation']."'";		
				// $result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ) $quo=mysql_fetch_array($result);
			
			} else if($mode == "edit"){
				$query = "select * from `sales_quotation_$MEM[Id]` where Id = '$UID'";		
				// $result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){
	    			$quo=mysql_fetch_array($result);
	    			$_SESSION['quotation'] = $quo[quo]; // 견적 섹션값 설정
	    		}
			
			} else if($mode == "save"){

				// echo $_POST['title'];
				$query = "UPDATE `sales_quotation_$MEM[Id]` SET `title`='".$_POST['title']."', `transdate`='".$_POST['transdate']."',
					`company_name`='".$_POST['company_name']."', `company_manager`='".$_POST['company_manager']."', `company_ref`='".$_POST['company_ref']."',
					`email`='".$_POST['email']."', `phone`='".$_POST['phone']."', `fax`='".$_POST['fax']."', `quomemo`='".$_POST['quomemo']."' WHERE `quo`='".$_SESSION['quotation']."'";
				// mysql_db_query($mysql_dbname,$query,$connect);
				mysql_db_query($server[dbname],$query,$dbconnect);
				
				// echo $query."<br>"; 
				$_SESSION['quotation'] = NULL;
				echo "<meta http-equiv='refresh' content='0; url=sales_quotation.php'>";
			} else if($mode == "delete"){
				$query = "DELETE FROM `sales_quotation_$MEM[Id]` WHERE `Id`='$UID'";
				// mysql_db_query($mysql_dbname,$query,$connect);
				mysql_db_query($server[dbname],$query,$dbconnect);			
				
				$_SESSION['quotation'] = NULL;
				echo "<meta http-equiv='refresh' content='0; url=sales_quotation.php'>";
			}

			
			//////
			// 정보 다시 읽음
			$query = "select * from `sales_quotation_$MEM[Id]` where quo = '".$_SESSION['quotation']."'";		
			// $result=mysql_db_query($mysql_dbname,$query,$connect);
			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ) $quo=mysql_fetch_array($result);
    			
			//////////////////////////////
			$script = "<script>
       			function quo_chkall(){
       				var submit = false;
       				var chk = document.getElementsByName('TID[]');
       				
       				for(var i=0;i<chk.length;i++){
       					if(document.quo.chk_all.checked == true) chk[i].checked = true;
       					else chk[i].checked = false;
       				}
 				}
    			</script>"; 
			$body = str_replace("선택","$script <input type='checkbox' name='chk_all' onclick=\"javascript:quo_chkall()\">",$body);
			
			
			$script = "<script>
       			function quo_remove(){
       				var submit = false;
       				var chk = document.getElementsByName('TID[]');
       				var chk_count = 0;
       				
       				for(var i=0;i<chk.length;i++){
       					if(chk[i].checked) chk_count++;
       				}
       				
					if(chk.length > 0){
						if(chk_count > 0){
							var returnValue = confirm(\"선택한 항목을 삭제하겠습니까?\");
							if(returnValue == true){
 								document.quo.mode.value = \"remove\";
 								document.quo.submit();
 							}
 						} else alert(\"삭제할 항목이 없습니다.\");
 					} else alert(\"견적 리스트가 없습니다.\");
 				}
    			</script>"; 
			$body = str_replace("{remove}","$script <input type='button' value='항목제거' $btn_style_gray onclick=\"javascript:quo_remove()\">",$body);
				
			
			$script = "<script>
       			function quo_save(){
       				if(!document.quo.title.value){
       					alert(\"견적서 제목이 없습니다.\");
       				} else {
       			
 						document.quo.mode.value = \"save\";
 						document.quo.submit();
 					}
 				}
    			</script>"; 
    		$body = str_replace("{save}","$script <input type='button' value='저장' $btn_style_blue onclick=\"javascript:quo_save()\">",$body);
 
 			$body = str_replace("{print}",_button_gray("인쇄","sales_order_print.php?UID=$quo[Id]"),$body);
 			$body = str_replace("{delete}",_button_gray("견적삭제","sales_quotation_new.php?mode=delete&UID=$quo[Id]"),$body);
 			
 
 			if($_POST['transdate']) $_transdate = $_POST['transdate']; else if($quo[transdate]) $_transdate = $quo[transdate]; else $_transdate = "$TODAY";
 			// echo " .. transdate : ". $_POST['transdate']. " $quo[transdate] $_transdate $TODAY";
			$body = str_replace("{transdate}","<input type='date' name='transdate' value='$_transdate' $CSS_search>",$body);
			
			$query = "select * from `sales_company_$MEM[Id]` where Id = '$company_id'";
			// $result=mysql_db_query($mysql_dbname,$query,$connect);
			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){
    			$coms=mysql_fetch_array($result);
				$body = str_replace("{company_name}","<input type='text' name='company_name' value='$coms[company]' placeholder='업체명' $CSS_search>",$body);
				$body = str_replace("{company_manager}","<input type='text' name='company_manager' value='$coms[manager]' placeholder='업체 담당자' $CSS_search>",$body);
				
				$body = str_replace("{email}","<input type='text' name='email' value='$coms[email]' placeholder='업체 이메일' $CSS_search>",$body);
				$body = str_replace("{phone}","<input type='text' name='phone' value='$coms[phone]' placeholder='업체 전화' $CSS_search>",$body);
				$body = str_replace("{fax}","<input type='text' name='fax' value='$coms[fax]' placeholder='업체 팩스' $CSS_search>",$body);
			
			} else {
				if($_POST['company_name']) $_company_name = $_POST['company_name']; else if($quo[company_name]) $_company_name = $quo[company_name];
				$body = str_replace("{company_name}","<input type='text' name='company_name' value='$_company_name' placeholder='업체명' $CSS_search>",$body);
				
				if($_POST['company_manager']) $_company_manager = $_POST['company_manager']; else if($quo[company_manager]) $_company_manager = $quo[company_manager];
				$body = str_replace("{company_manager}","<input type='text' name='company_manager' value='$_company_manager' placeholder='업체 담당자' $CSS_search>",$body);
				
				if($_POST['email']) $_email = $_POST['email']; else if($quo[email]) $_email = $quo[email];
				$body = str_replace("{email}","<input type='text' name='email' value='$_email' placeholder='업체 이메일' $CSS_search>",$body);
				
				if($_POST['phone']) $_phone = $_POST['phone']; else if($quo[phone]) $_phone = $quo[phone];
				$body = str_replace("{phone}","<input type='text' name='phone' value='$_phone' placeholder='업체 전화' $CSS_search>",$body);
				
				if($_POST['fax']) $_fax = $_POST['fax']; else if($quo[fax]) $_fax = $quo[fax];
				$body = str_replace("{fax}","<input type='text' name='fax' value='$_fax' placeholder='업체 팩스' $CSS_search>",$body);
				
			}
			
			
			
			if($_POST['company_ref']) $_company_ref = $_POST['company_ref']; else if($quo[company_ref]) $_company_ref = $quo[company_ref];
			$body = str_replace("{company_ref}","<input type='text' name='company_ref' value='$_company_ref' placeholder='업체 참고' $CSS_search>",$body);
			
			if($_POST['title']) $_title = $_POST['title']; else if($quo[title]) $_title = $quo[title];
			$body = str_replace("{title}","<input type='text' name='title' value='$_title' placeholder='견적 제목명' $CSS_search >",$body);
			
			if($_POST['quomemo']) $_quomemo = $_POST['quomemo']; else if($quo[quomemo]) $_quomemo = $quo[quomemo];
			$body = str_replace("{quomemo}","<input type='text' name='quomemo' value='$_quomemo' placeholder='견적 메모사항' $CSS_search >",$body);
			
			/////////////////////////
			
			
			if($_POST['goodname'] && $_POST['num'] && $_POST['prices'] && $_POST['total'] && $_SESSION['nonce'] == $_POST['nonce']){
			//# 신규 상품을 등록 처리합니다. 상품명/수량/단가/ 합계 가격이 다 입력이 된 경우는 정상적인 상품으로 등록 처리.
			
				$log .= "data saving... <br>";
				echo $log;
				
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$goodname = $_POST['goodname'];
				$spec = $_POST['spec'];
				$num = $_POST['num'];
				$currency = $_POST['currency'];
				$prices = $_POST['prices'];
				$vat = $_POST['vat'];
				$discount = $_POST['discount'];
				$prices_sum = $_POST['sum'];
				$prices_total = $_POST['total'];
				

				if($quo[quo_parts])
				$parts = $quo[quo_parts] .";". $_POST['goods'].":$goodname:$spec:$num:$currency:$prices:$vat:$discount:$prices_sum:$prices_total";
				else $parts = $_POST['goods'] .":$goodname:$spec:$num:$currency:$prices:$vat:$discount:$prices_sum:$prices_total";
					
					
					//echo $parts."<br>";
				$query = "UPDATE `sales_quotation_$MEM[Id]` SET `quo_parts`= '$parts' where quo = '".$_SESSION['quotation']."'";
					//echo $query."<br>";
				// mysql_db_query($mysql_dbname,$query,$connect);
				mysql_db_query($server[dbname],$query,$dbconnect);	
					
				
				 
				//# 신규 자료 입력후, 다시 입력 할 수 있도록 초기화
				if($transdate) $transday=$transdate; else $transday=$TODAY;
				if($coms[vat]) $vat = $coms[vatrate];
				
				$listform = _form_newdata("",$transday,$goods,"","","","","",$vat,"","");
				$body = str_replace("{newdata}",$listform,"$body");
				
			} else if($_GET['goods_id'] && $_SESSION['nonce'] == $_GET['nonce']){
			//# 검색상품 선택. 상품명만 입력후, 엔터를 누른경우 거래전표 / 상품 목록에서 상품을 검색하여 찾아 줍니다.
			
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				//상품 목록에서 상품을 검색합니다.
				$query = "select * from `sales_goods_$MEM[Id]` where Id = '".$_GET['goods_id']."'";
				//$result=mysql_db_query($mysql_dbname,$query,$connect);
				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ) {
    				$rows=mysql_fetch_array($result);
    			
    				if($_POST['transdate']) $transday=$_POST['transdate']; else $transday=$TODAY;
    				$prices = $rows[prices_sell];
    				// $vat = $rows[prices_sell] * $MEM[vatrate];
    				if($coms[vat]) $vat = $coms[vatrate];
    				// echo "VAT is $vat<br>";
					$listform = _form_newdata("",$transdate,$rows[Id],$rows[name],$spec,$num,$prices,$sum,$vat,$discount,$total);
					$body = str_replace("{newdata}",$listform,"$body");
	    		}
	
			} else if( $_POST['goodname'] ){
				//# 상품명만 입력한 경우, 상품 목록에서 상품을 검색
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());  
				
				$query = "select * from `sales_goods_$MEM[Id]` where name like '%".$_POST['goodname']."%'"; 
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    			$total = mysql_result($result,0,0);
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
						$listform = bodyskin("sales_trans_sell_goods",$_SESSION['mobile'],$_SESSION['language']);
						
						if($rows[images]) $listform = str_replace("{img}","<img src='$rows[images]' border=0 width=50>","$listform");
						else $listform = str_replace("{img}","","$listform");
						
						$listform = str_replace("{goodname}","<a href='".$_SERVER['PHP_SELF']."?goods_id=$rows[Id]&company_id=$company_id&transdate=$transdate&nonce=$nonce'>$rows[name]</a>","$listform");
						$goodlist .= $listform;
					}
				}
				$goodlist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
				$body = str_replace("{search_result}",$goodlist,$body);
				$status = "good_search";
				
				//# 상품명으로 검색시, 검색키워드는 상품명으로 입력 남김
				if($transdate) $transday=$_POST['transdate']; else $transday=$TODAY;
				if($coms[vat]) $vat = $coms[vatrate];
				
				$listform = _form_newdata("",$transday,$goods,$_POST['goodname'],"","","","",$vat,"","");
				$body = str_replace("{newdata}",$listform,"$body");
				
			} else {
				$_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				if($transdate) $transday=$transdate; else $transday=$TODAY;
				if($coms[vat]) $vat = $coms[vatrate];
				
				$listform = _form_newdata("",$transday,$goods,"","","","","",$vat,"","");
				$body = str_replace("{newdata}",$listform,"$body");
			}

			//////////////////////
			
			$body = str_replace("{search_result}","",$body);
			$body = str_replace("{formstart}","<form name='quo' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    						<input type='hidden' name='nonce' value='$nonce'>
					    						<input type='hidden' name='UID' value='$UID'>
					    						<input type='hidden' name='mode' >",$body);
			$body = str_replace("{formend}","</form>",$body);
			$body = str_replace("{submit}","<input type='submit' value='검색' $butten_style>",$body);
			
			
			if($_POST['company_name']){
			//# 거래처 검색
				// $_SESSION['nonce'] = $nonce = md5('goodname'.microtime()); 
				
				$query = "select * from `sales_company_$MEM[Id]` where company like '%".$_POST['company_name']."%'";
				// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
				$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    			$total = mysql_result($result,0,0);
    			// $result=mysql_db_query($mysql_dbname,$query,$connect);
    			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    			if( mysql_num_rows($result) ){ 				
					for($i=0;$i<$total;$i++){
	    				$rows=mysql_fetch_array($result);
						$listform = bodyskin("sales_trans_sell_search",$_SESSION['mobile'],$_SESSION['language']);
						$listform = str_replace("{goodname}","<a href='".$_SERVER['PHP_SELF']."?company_id=$rows[Id]&transdate=$transdate&nonce=$nonce'>$rows[company]</a>","$listform");
						$companylist .= $listform;
					}
				}
				$companylist .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-bottom:1px solid #D2D2D2;'><tr><td></td></tr></table>";
				$body = str_replace("{company_list}",$companylist,$body);

			} else $body = str_replace("{company_list}","",$body);

			
			
			//////////////////////////////
			// 리스트 표시...	
			$query = "select * from `sales_quotation_$MEM[Id]` where quo = '".$_SESSION['quotation']."'";			
			// $result=mysql_db_query($mysql_dbname,$query,$connect);
			$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){
    		
	    		$quo=mysql_fetch_array($result);
	    			
				if($quo[quo_parts]){
					$_quo = explode(";",$quo[quo_parts]);
					
					for($i=0,$prices=0;$i<count($_quo);$i++){
						$listform = bodyskin("sales_order_new_list",$_SESSION['mobile'],$_SESSION['language']);
						
						//$parts = $_POST['goods'] .":$goodname:$spec:$num:$currency:$prices:$vat:$discount:$prices_sum:$prices_total";
						$quo_part = explode(":",$_quo[$i]);
						$listform = str_replace("{TID}","<input type='checkbox' name='TID[]' value='$i'>",$listform);
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
						
					$query = "UPDATE `sales_quotation_$MEM[Id]` SET `quoPrices`= '$prices' where quo = '".$_SESSION['quotation']."'";
					// echo $query."<br>";
					// mysql_db_query($mysql_dbname,$query,$connect);
					mysql_db_query($server[dbname],$query,$dbconnect);
						
				} else $body = str_replace("{datalist}","","$body");
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
