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
	
	
	include "./func_string.php";
	


	// 회원약관 및 동의서 부분 출력 처리
	$query = "select * from sales_mem_agree where enable = 'on' ";
	$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
	$total=mysql_result($result,0,0);
				
	$result=mysql_db_query($mysql_dbname,$query,$connect);
    if( mysql_num_rows($result) ){
    
    	//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = shopskin("sales_member_agreement"); 
			
		$body=str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data' action='sales_members_new.php'> 
					    				<input type='hidden' name='mode' value='reg'>",$body);
		$body = str_replace("{formend}","</form>",$body);
    
		for($i=0;$i<$total;$i++){
			$rows=mysql_fetch_array($result);
						
			$agreement = stripslashes($rows[agreement]);
			$agreement_form .= "<textarea name='agree1' rows='10' readonly style='width:100%;margin:-3px;border:2px inset #eee' >$agreement</textarea>";
			$agreement_form .= "<br>";
		}
					
		$body = str_replace("{agreement}",$agreement_form,$body);
	
		$body = str_replace("{agree}","<input type=checkbox name=agree required>",$body);
		
		

  
  		$script = "<script>
       			function onSubmit(){
       				
  					if( document.members.agree.checked == true ) {
  					    document.members.submit();        
   					} else {
   						alert(\"동의서 확인이 필요합니다\");
   						document.members.agree.focus();
   					
  					} 					
 				}
    			</script>"; 
    	$body = str_replace("{submit}","$script <input type='button' value='가입신청' $btn_style_blue onclick=\"javascript:onSubmit()\">",$body);			
		// $body = str_replace("","<input type='submit' name='reg' value='' >",$body);

		///////////////////
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		
		echo $body;
	
	
	} else {
		//* 회원가입 동의서가 없는 경우, 바로 회원가입으로 이동.
		echo "<meta http-equiv='refresh' content='0; url=sales_members_new.php'>";
		
	}	

	mysql_close($connect);
	
?>
