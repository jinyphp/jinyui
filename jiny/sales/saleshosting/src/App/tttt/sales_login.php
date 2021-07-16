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
	include "./func_goods.php";
	
	include "./func_string.php";
	
	
	function android_alertShowMessage($title,$message){
		echo "<script type=\"text/javascript\">
			showAlertDialog(\"$title\",\"$message\")
	    	history.go(-1) 
	    </script>";
    }
    
    
    if( $_COOKIE[email] ){
		echo "<meta http-equiv='refresh' content='0; url=./sales_main.php'>";
	} else { //////////////////////////////////////////
    
    	
    	//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    	$body = shopskin("shop_login");
    	$body = str_replace("{new}",_button_gray("신규가입","sales_members_agree.php"),$body); 
    		
    	if($_COOKIE[DEVICEID]){
    		$query = "select * from sales_members where DEVICE = '$_COOKIE[DEVICEID]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_affected_rows() ) $rows=mysql_fetch_array($result);
    	}
		
		$body=str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data' action='sales_loginup.php'> 
					    				<input type='hidden' name='mode' value='login'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		$body = str_replace("{email}","<input type='text' name='email' value='$rows[email]' $cssFormStyle placeholder='이메일'>",$body);    	
		$body = str_replace("{password}","<input type='password' name='password' $cssFormStyle placeholder='비밀번호'>",$body);
		
		$msg_email = "이메일 필드값을 입력해주세요.";
		$msg_password1 = "회원 접속 페스워드를 입력해 주세요.";
		$script = "<script>
       			function onSubmit(){
       				var submit = false;
  					if( !document.members.email.value ) {
  						alert(\"$msg_email\");
   						document.members.email.focus();  					       
   					} else if( !document.members.password.value ) {
  						alert(\"$msg_password1\");
   						document.members.password.focus();  					          
   					} else document.members.submit();
  								
 				}
    			</script>"; 
    	$body = str_replace("{submit}","$script <input type='button' value='로그인' $btn_style_blue onclick=\"javascript:onSubmit()\">",$body);	
		//$body = str_replace("{submit}","<input type='submit' name='reg' value='로그인' $btn_style_blue >",$body);
		
		$body = str_replace("{google}","",$body);

		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
    	
	}    
    
    
	mysql_close($connect);
  
    
    
	

?>
