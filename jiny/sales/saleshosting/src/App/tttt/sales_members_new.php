<?
	//* ////////////////////////////////////////////////////////////
	//* SalesRecoard 판매관리 V 1.1 
	//* 2015.01.27
	//* Program By : hojin lee 
	//*
	
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
	include "./func_goods.php";
	
	include "./func_string.php";
	
	
	// 회원약관 및 동의서 체크
	$query = "select * from sales_mem_agree where enable = 'on' ";
	$result=mysql_db_query($mysql_dbname,$query,$connect);
    if(mysql_affected_rows()){
		if($_POST['agree'] || $_SESSION['agree']) {
			$agreement = "true"; 
			$_SESSION['agree'] = "true";
		} else {
			$agreement = "false";
			$_SESSION['agree'] = NULL;	
			$msg = "회원가입 동의가 필요합니다.";
			msg_alert($msg);
		}
	} else {
		$agreement = "true";
		$_SESSION['agree'] = "true";
	}
 
	if( $_SESSION['agree'] ){
	
		$_SESSION['nonce'] = $nonce = md5('salt'.microtime());
		
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = shopskin("sales_members_new"); 	

		$body=str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data' action='sales_members_newup.php'> 
										<input type='hidden' name='nonce' value='$nonce'>
					    				<input type='hidden' name='mode' value='new'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
		$body=str_replace("{country}",form_country1($_SESSION['country']),$body);	
		$body = str_replace("{language}",form_language1($_SESSION['language']),$body);
		
		
		$query1 = "select * from `sales_currency`";
		$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    	$total1=mysql_result($result1,0,0);
		
		$result1=mysql_db_query($mysql_dbname,$query1,$connect);
		if( mysql_num_rows($result) ) {
			$currency = "<select name='currency' $cssFormStyle>";
			for($ii=0;$ii<$total1;$ii++){
				$rows1=mysql_fetch_array($result1);
				if($GOO[buy_currency] == $rows1[currency]) $currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
				else $currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
			}
			$body = str_replace("{currency}",$currency,$body);
		}					
		//$body = str_replace("{currency}","<input type='text' name='currency' $cssFormStyle>",$body);
		$body = str_replace("{taxrate}","<input type='text' name='taxrate' $cssFormStyle>",$body);
			
		$body = str_replace("{company}","<input type='text' name='company' $cssFormStyle>",$body);
		$body = str_replace("{biznumber}","<input type='text' name='biznumber' $cssFormStyle>",$body);

		$body = str_replace("{president}","<input type='text' name='president' $cssFormStyle>",$body);
		$body = str_replace("{post}","<input type='text' name='post' $cssFormStyle>",$body);
		$body = str_replace("{address}","<input type='text' name='address' $cssFormStyle>",$body);
		$body = str_replace("{subject}","<input type='text' name='subject' $cssFormStyle>",$body);
		$body = str_replace("{item}","<input type='text' name='item' $cssFormStyle>",$body);
							
		$body = str_replace("{email}","<input type='text' name='email' $cssFormStyle>",$body);					
		$body = str_replace("{tel}","<input type='text' name='tel' $cssFormStyle>",$body);
		$body = str_replace("{fax}","<input type='text' name='fax' $cssFormStyle>",$body);
		$body = str_replace("{phone}","<input type='text' name='phone' $cssFormStyle>",$body);
		$body = str_replace("{manager}","<input type='text' name='manager' $cssFormStyle>",$body);
		$body = str_replace("{password}","<input type='text' name='password' $cssFormStyle>",$body);
		$body = str_replace("{password2}","<input type='text' name='password2' $cssFormStyle>",$body);
	
		$body = str_replace("{r1}","<input type=radio name=memtype value=1 checked>",$body);
		$body = str_replace("{r2}","<input type=radio name=memtype value=2>",$body);
		
		$msg_email = "이메일 필드값을 입력해주세요.";
		$msg_password1 = "회원 접속 페스워드를 설정해 주세요.";
		$msg_password2 = "페스워드 재확인 설정해 주세요.";
		$msg_manager = "담당자명을 설정해 주세요.";
		$script = "<script>
       			function onSubmit(){
       				var submit = false;
  					if( !document.members.email.value ) {
  						alert(\"$msg_email\");
   						document.members.email.focus();  					       
   					} else if( !document.members.password.value ) {
  						alert(\"$msg_password1\");
   						document.members.password.focus();  					          
   					} else if( !document.members.password2.value ) {
  						alert(\"$msg_password2\");
   						document.members.password2.focus();  					          
   					} else if( !document.members.manager.value ) {
  						alert(\"$msg_manager\");
   						document.members.manager.focus();  					            
   					} else document.members.submit();
  								
 				}
    			</script>"; 
    	$body = str_replace("{submit}","$script <input type='button' value='가입하기' $btn_style_blue onclick=\"javascript:onSubmit()\">",$body);											
		// $body = str_replace("{submit}","<input type='submit' name='reg' value='가입하기'  $btn_style_blue>",$body);
	
		//# 번역스트링 처리
		$body = _string_converting($body);
		
		echo $body;
	
	
	} else echo "<meta http-equiv='refresh' content='0; url=sales_members_agree.php'>";

	mysql_close($connect);

?>
