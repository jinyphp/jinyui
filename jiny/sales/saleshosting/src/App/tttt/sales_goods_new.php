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

    		$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());  
    		
    		$body = shopskin("sales_goods_new");
    		include "sales_goods_left.php";
    			
			/////////////////////////////

			$body=str_replace("{formstart}","<form name='good' method='post' enctype='multipart/form-data' action='sales_goods_newup.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
										<input type='hidden' name='company' value='$company'>
					    				<input type='hidden' name='mode' value='new'>",$body);
			$body = str_replace("{formend}","</form>",$body);

			$body = str_replace("{goodcode}","<input type='text' name='goodcode' $cssFormStyle placeholder='상품코드'>",$body);
			$body = str_replace("{name}","<input type='text' name='name' $cssFormStyle placeholder='상품명'>",$body);
			$body = str_replace("{model}","<input type='text' name='model' $cssFormStyle placeholder='모델명'>",$body);
			$body = str_replace("{brand}","<input type='text' name='brand' $cssFormStyle placeholder='브랜드'>",$body);
			
			/*	
			// $barcodeMode = "상품추가"; $url_return = "&company=$company";
			$barcodeScan = "<table border='0' cellpadding='2' bgcolor='#000080' align='right'><tr>
											<td><b><font size='1' color='#FFFFFF'><butten onclick='showBarcode(\"$barcodeMode \",\" $url_return\")'>
											<span style='text-decoration: none'><font color='#FFFFFF'>바코드스켄</font></span></butten></font></b></td>
											</tr></table>";
							
			$body = str_replace("{scan}",$barcodeScan,$body);
			if($_GET['barcode']) $barcode = $_GET['barcode'];
			*/
			
			$barcodeMode = "goodlist"; 
			$url_return = "sales_goods_new.php?";
			$body = str_replace("{scan}","<butten onclick='showBarcode(\"$barcodeMode \",\" $url_return\")'><img src='./images/barcode.gif' width=30 border=0></butten>",$body);
			if($_GET['barcode']) $barcode = $_GET['barcode'];
			$body = str_replace("{barcode}","<input type='text' name='barcode' value = '$barcode' $cssFormStyle placeholder='바코드'>",$body);
					
		    $body = str_replace("{cate}","<input type='text' name='cate' value='$GOO[cate]' $cssFormStyle placeholder='분류 카테고리'>",$body);	
			
			$query = "select * from `sales_company_$MEM[Id]` order by company desc";
			// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
			$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    		$total = mysql_result($result,0,0);
    	
    		// $result=mysql_db_query($mysql_dbname,$query,$connect);
    		$result=mysql_db_query($server[dbname],$query,$dbconnect);
    		if( mysql_num_rows($result) ){
    		 	$company_select = "<select size='1' name='company' $cssFormStyle>";
    		 	$company_select .= "<option value=''>거래처 선택</option>";		
				for($i=0;$i<$total;$i++){
					$rows=mysql_fetch_array($result);
		    		if($company == $rows[Id]) $company_select .= "<option value='$rows[Id]' selected >$rows[company]</option>";
		    		else $company_select .= "<option value='$rows[Id]' >$rows[company]</option>";
		    		
				}
				$company_select .= "</select>";
				$body = str_replace("{company}","$company_select",$body);
			} else $body = str_replace("{company}","등록된 거래처가 없습니다.",$body);	 					
			
			
			$body = str_replace("{prices_buy}","<input type='text' name='prices_buy' $cssFormStyle placeholder='매입가격'>",$body);
			$body = str_replace("{prices_sell}","<input type='text' name='prices_sell' $cssFormStyle placeholder='매출가격'>",$body);
			$body = str_replace("{vat}","<input type='text' name='vat' $cssFormStyle placeholder='부가세'>",$body);
			$body = str_replace("{stock}","<input type='text' name='stock' $cssFormStyle placeholder='재고'>",$body);
			$body = str_replace("{stock1}","<input type='text' name='stock1' value='$GOO[stock1]' $cssFormStyle placeholder='안전재고량'>",$body);
			
			if($GOO[b2b]) $body = str_replace("{b2b}","<input type='checkbox' name='b2b' checked>",$body);
			else $body = str_replace("{b2b}","<input type='checkbox' name='b2b' >",$body);
			$body = str_replace("{b2b_prices}","<input type='text' name='b2b_prices' value='$GOO[b2b_prices]' $cssFormStyle placeholder='공급단가'>",$body);
						
			
			$body = str_replace("{filename}","<input type='file' name='userfile1' >",$body);
						
			$body = str_replace("{exsales}","<input type='checkbox' name='exsales' >",$body);
						
			$body = str_replace("{comment}","<textarea name='comment' rows='10' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='제품 상세설명'></textarea>",$body);
		
			$body = str_replace("{submit}","<input type='submit' name='reg' value='등록' $butten_style>",$body);
			$body = str_replace("{login}","",$body);			
			$body = str_replace("{delete}","",$body);
		
    			
		
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);	
	

	
?>

