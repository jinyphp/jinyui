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
	
	
	if( !isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {    
		$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>"; 
	} else { //////////////////////////////////////////

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if( mysql_num_rows($result) ){ 
			$MEM=mysql_fetch_array($result);
			
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_num_rows($result) )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}


		
			//////////////////////////////////////////////////////////////////
			$body = shopskin("sales_company_new");
		
			//# 좌측 메뉴 트리구조 표시
			include "sales_company_left.php";

    		$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());   		
    		$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='sales_company_newup.php'> 
										<input type='hidden' name='nonce' value='$nonce'>					    				
					    				<input type='hidden' name='mode' value='new'>",$body);
			$body = str_replace("{formend}","</form>",$body);
				
			$body = str_replace("{r1}","<input type=radio name=inout value=1>",$body);
			$body = str_replace("{r2}","<input type=radio name=inout value=2>",$body);
			$body = str_replace("{r3}","<input type=radio name=inout value=3 checked>",$body);
			$body = str_replace("{r4}","<input type=radio name=inout value=4 >",$body);
				
    		
			$body=str_replace("{country}",form_country1($_SESSION['country']),$body);
			
			$query1 = "select * from `sales_currency`";
			$result1=mysql_db_query($mysql_dbname,$query1,$connect);
			if( $total1=mysql_num_rows($result1) ) {
				$currency = "<select name='currency' $cssFormStyle >";
				for($ii=0;$ii<$total1;$ii++){
					$rows1=mysql_fetch_array($result1);
					if($GOO[buy_currency] == $rows1[currency]) $currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
					else $currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
				}
				$body = str_replace("{currency}",$currency,$body);
			}	
			
			
			$body = str_replace("{limit}","<input type='text' name='limitation' $cssFormStyle placeholder='거래한도'>",$body);
				
			$body = str_replace("{company}","<input type='text' name='company' $cssFormStyle placeholder='회사명'>",$body);
			$body = str_replace("{biznumber}","<input type='text' name='biznumber' $cssFormStyle placeholder='사업자번호'>",$body);

			$body = str_replace("{president}","<input type='text' name='president' $cssFormStyle placeholder='대표자명'>",$body);
			$body = str_replace("{post}","<input type='text' name='post' $cssFormStyle  placeholder='우편번호'>",$body);
			$body = str_replace("{address}","<input type='text' name='address' $cssFormStyle placeholder='주소'>",$body);
			$body = str_replace("{subject}","<input type='text' name='subject' $cssFormStyle placeholder='업태'>",$body);
			$body = str_replace("{item}","<input type='text' name='item' $cssFormStyle placeholder='업종'>",$body);
			$body = str_replace("{email}","<input type='text' name='email' $cssFormStyle placeholder='이메일'>",$body);

				
			$body = str_replace("{discount}","<input type='text' name='discount' $cssFormStyle placeholder='할인율'>",$body);
			$body = str_replace("{vat}","<input type='checkbox' name='vat'>",$body);
			$body = str_replace("{vatrate}","<input type='text' name='vatrate' $cssFormStyle placeholder='부가세'>",$body);
						
			$body = str_replace("{tel}","<input type='text' name='tel' $cssFormStyle placeholder='전화번호'>",$body);
			$body = str_replace("{fax}","<input type='text' name='fax' $cssFormStyle placeholder='팩스'>",$body);
			$body = str_replace("{phone}","<input type='text' name='phone' $cssFormStyle placeholder='핸드폰'>",$body);
			$body = str_replace("{group}","<input type='text' name='group' $cssFormStyle placeholder='그룹'>",$body);
			
			
			$query1 = "select * from sales_manager where members_id = '$MEM[Id]'";
			$result1=mysql_db_query($mysql_dbname,$query1,$connect);
			if( $total1=mysql_num_rows($result1) ) {
				$manager = "<select name='manager' $cssFormStyle >";
				for($ii=0;$ii<$total1;$ii++){
					$rows1=mysql_fetch_array($result1);
					if($GOO[manager] == $rows1[Id]) $manager .= "<option value='$rows1[Id]' selected>$rows1[name]</option>"; 
					else $manager .= "<option value='$rows1[Id]'>$rows1[name]</option>";
				}
				$body = str_replace("{manager}","$manager",$body);
			}
			
			
			
			$body = str_replace("{comment}","<textarea name='comment' rows='10' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='메모'></textarea>",$body);
		
					
			
						
			$body = str_replace("{submit}","<input type='submit' name='reg' value='추가' $btn_style_blue >",$body);
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

