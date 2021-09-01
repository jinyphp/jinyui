<?
	$adsense1 = "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
				<!-- 짢징C짖짭A징횈u짖짭짖챌 -->
				<ins class=\"adsbygoogle\"
     				style=\"display:inline-block;width:320px;height:50px\"
     				data-ad-client=\"ca-pub-3321560028329475\"
     				data-ad-slot=\"4555338379\"></ins>
				<script>(adsbygoogle = window.adsbygoogle || []).push({}); </script>";

	$adsense2 = "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
				 <!-- ?먮ℓ愿由?愿묎퀬2 -->
				 <ins class=\"adsbygoogle\"
     				style=\"display:inline-block;width:320px;height:50px\"
     				data-ad-client=\"ca-pub-3321560028329475\"
     				data-ad-slot=\"5215559177\"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({}); </script>";

	
	$adsense3 = "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
				<!-- ?먮ℓ愿由?愿묎퀬3 -->
				<ins class=\"adsbygoogle\"
     				style=\"display:inline-block;width:320px;height:50px\"
     				data-ad-client=\"ca-pub-3321560028329475\"
     				data-ad-slot=\"9226956373\"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>";
	
	
	
	
	
	if($MOBILE == "mobile"){
	
		$adsense = "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
		  <tr><td align='center'> $adsense1 </td></tr></table>";	
		  
		$body = FileLoad("./$LANG/copyright.htm");
		$body = str_replace("{adsense}",$adsense,$body);  
		
		if($_COOKIE[albaCode] == "70000000"){
			$body = str_replace("{admin}","<a href='sales_admin.php'>Admin</a>",$body);
		} else $body = str_replace("{admin}","",$body);
		
		$body = str_replace("{mobile}","<a href='".$_SERVER['PHP_SELF']."?MOBILE=pc'>PC접속</a>",$body);
		
		$body = str_replace("{United States}","<a href='".$_SERVER['PHP_SELF']."?LANG=en'>United States</a>",$body);
		$body = str_replace("{Canada}","<a href='".$_SERVER['PHP_SELF']."?LANG=en'>Canada</a>",$body);
		$body = str_replace("{Germany}","<a href='".$_SERVER['PHP_SELF']."?LANG=de'>Germany</a>",$body);
		$body = str_replace("{France}","<a href='".$_SERVER['PHP_SELF']."?LANG=fr'>France</a>",$body);
		$body = str_replace("{Russia}","<a href='".$_SERVER['PHP_SELF']."?LANG=ru'>Russia</a>",$body);
		$body = str_replace("{Singapore}","<a href='".$_SERVER['PHP_SELF']."?LANG=en'>Singapore</a>",$body);
		$body = str_replace("{Taiwan}","<a href='".$_SERVER['PHP_SELF']."?LANG=cn'>Taiwan</a>",$body);
		$body = str_replace("{Hongkong}","<a href='".$_SERVER['PHP_SELF']."?LANG=cn'>Hongkong</a>",$body);
		$body = str_replace("{Japan}","<a href='".$_SERVER['PHP_SELF']."?LANG=jp'>Japan</a>",$body);
		$body = str_replace("{Australia}","<a href='".$_SERVER['PHP_SELF']."?LANG=en'>Australia</a>",$body);
		$body = str_replace("{China}","<a href='".$_SERVER['PHP_SELF']."?LANG=cn'>China</a>",$body);
		$body = str_replace("{Vetnam}","<a href='".$_SERVER['PHP_SELF']."?LANG=en'>Vetnam</a>",$body);
		$body = str_replace("{indonesia}","<a href='".$_SERVER['PHP_SELF']."?LANG=en'>indonesia</a>",$body);
		$body = str_replace("{Italia}","<a href='".$_SERVER['PHP_SELF']."?LANG=il'>Italia</a>",$body);
		$body = str_replace("{Korea}","<a href='".$_SERVER['PHP_SELF']."?LANG=ko'>Korea</a>",$body);
		
		
		if($_COOKIE[albaCode]){
			$body = str_replace("{logout}","<a href='shop_membersedit.php'><font size='2'>".multiString_conv("ko","회원수정",$LANG)."</font></a> | 
			<a href='logout.php'><font size='2'>".multiString_conv("ko","로그아웃",$LANG)."</font></a>",$body);
		} else {
			$body = str_replace("{logout}","<a href='shop_membersnew.php'><font size='2'>".multiString_conv("ko","회원가입",$LANG)."</font></a> | 
			<a href='login.php'><font size='2'>".multiString_conv("ko","로그인",$LANG)."</font></a>",$body);

		}	
 		
 		
	} else {
	
		$adsense = "<table border='0' width='1000' cellspacing='0' cellpadding='0'><tr> 
		  <td align='center'> $adsense1 </td> 
		  <td width='10'></td> 
		  <td align='center'> $adsense2 </td> 
		  <td width='10'></td> 
		  <td align='center'> $adsense3 </td> 
		  </tr></table>";
		  
		  // <td width='10'></td> 
		  // <td align='center'> $adsense3 </td> 
		  
		$body = FileLoad("./$LANG/copyright_pc.htm");
		$body = str_replace("{adsense}",$adsense,$body);  
		
		if($_COOKIE[albaCode] == "70000000"){
			$body = str_replace("{admin}","<a href='sales_admin.php'>Admin</a>",$body);
		} else $body = str_replace("{admin}","",$body);
	  
	}
	
	
	
	
	
	
	
	echo $body;
	
?>

