<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	// 2014.12.24
	//* 관리자페이지 스킨관리.
	
	$cssFormStyle = "style='width:100%; height:30px;line-height:30px; font-size:15px;border:1px solid #bbb;'";

	$css_submit =" 
		style='width:80px; 
		font-family:\"맑은고딕\",\"돋움\",\"Arial\";
		font-size:12px; 
		color:#444444; 
		font-weight:bold;
		background-color:#f4f4f4; 
		height:28px;
		font-size:12px;
		border:1px solid #d8d8d8;'";
		
	$css_butten =" 
		style='width:80px; 
		font-family:\"맑은고딕\",\"돋움\",\"Arial\";
		font-size:12px; 
		color:#444444; 
		font-weight:bold;
		background-color:#f4f4f4; 
		height:28px;
		font-size:12px;
		border:1px solid #d8d8d8;'";
	
	$css_butten1 =" 
		style='width:80px; 
		font-family:\"맑은고딕\",\"돋움\",\"Arial\";
		font-size:12px; 
		color:#ffffff; 
		font-weight:bold;
		background-color:#6079ab; 
		height:28px;
		font-size:12px;
		border:1px solid #2f477a;'";	
					
	$_top_BgColor = "#f1f1f1";
	$_top_BgColor = "#3B5998";
	
	
	function skin_button($name,$url){
		$button ="<input type='button' value='".$name."' onclick=\"javascript:location.href='".$url."'\" 
		style='width:80px; 
		font-family:\"맑은고딕\",\"돋움\",\"Arial\";
		font-size:12px; 
		color:#ffffff; 
		font-weight:bold;
		background-color:#6079ab; 
		height:28px;
		font-size:12px;
		border:1px solid #2f477a;'>";
		
		return $button;
	}
	
	function adminskin_layout(){
	
		global $connect, $mysql_dbname;
    	global $MOBILE, $LANG, $COUNTRY;

		$query = "select * from `shop_skin` where skinname = 'admin' ";
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$rows=mysql_fetch_array($result);
			if($rows[enable]){
							
				$skin_head = stripslashes($rows[head]);
				$skin_body = stripslashes($rows[body]);

				$body = "<!doctype html>
						<html>
						<head> $skin_head </head>
						<body bgcolor='{bgcolor}'> 
						<div align='{align}'>
						$skin_body 
						</div>
						</body>
						</html>";	
						
			
				$body = str_replace("{bgcolor}",$rows[bgcolor],$body); 		
				$body = str_replace("{align}",$rows[align],$body); 		
				$body = str_replace("{width}",$rows[width],$body); 
				
				
				$top = admin_bodyskin("admin_top","pc","ko");
				if($_COOKIE[adminemail]) $body = str_replace("{top}","$top</td><td valign='top'><a href='./admin_skinbody.php?code=admin_top'><img src='./images/design.jpg' boarder='0'></a>",$body); 
				else $body = str_replace("{top}",$top,$body); 
				
				$body = str_replace("{menu}","",$body); 
				
				$bottom = admin_bodyskin("admin_bottom","pc","ko");
				if($_COOKIE[adminemail]) $body = str_replace("{bottom}","$bottom</td><td valign='top'><a href='./admin_skinbody.php?code=admin_bottom'><img src='./images/design.jpg' boarder='0'></a>",$body); 
				else $body = str_replace("{bottom}",$bottom,$body); 
				
				$body = str_replace("{logo}","<img src='$rows[skinlogo]' border='0'>",$body);				
						
				return $body;
			
			} else echo "Error! please check website design.";
		}
	}

	//* 구글광고 부분 치환처리 (shop_adsense)
	function admin_adsense_apply($body){
		global $connect, $mysql_dbname;
		
		$query = "select * from `shop_adsense` ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			for($i=1;$i<=$total;$i++){
				$rows=mysql_fetch_array($result);
				
				$html = stripslashes($rows[html]);
				$body = str_replace("{".$rows[code]."}",$html,$body);
			}
		}
		
		return $body;
	}



	
	function admin_bodyskin($code,$mobile,$language){
		global $connect, $mysql_dbname;
		
		$query = "select * from `shop_skinbody` where code = '$code' and mobile = '$mobile' and language ='$language'";
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			$rows=mysql_fetch_array($result);
			$html = stripslashes($rows[html]);			
		}
		
		return $html;
	}
	
	
	function admin_login(){
		if($_COOKIE[adminemail]){
			return "<a href='admin_logout.php'><font color='ffffff' size='2'>로그아웃</font></a> | 
					<a href='admin_manager.php'><font color='ffffff' size='2'>관리설정</font></a>";
		
		} else {
			return "<a href='admin_login.php'><font color='ffffff' size='2'>로그인</font></a>";
		}
	}
	
	
	
	/////////////////////////
	
	//* 스킨 조합, 최종 결과물 읽어오기...
	function admin_shopskin($bodyskin_name){
		global $language_form;
		
		$body = adminskin_layout();
		
		//# 사이트 제목 설정
		$body = str_replace("{shop_sitetitle}","관리자 어드민",$body);
		
		//# 로그아웃 버튼
		$body = str_replace("{logout}",admin_login(),$body);
		
		/*
		//# SEO 설정
		$body = str_replace("{shop_title}",$seo[title],$body);
		$body = str_replace("{shop_keyword}",$seo[keyword],$body); 
		$body = str_replace("{shop_description}",$seo[description],$body); 
		*/
		
		//# 모바일 링크
		$body = str_replace("{mobile}",mobile_link(),$body);

		//# 언어 //# 지역
		$body=str_replace("{language_set}",$language_form,$body);
		
		
		
		//* 애드센스 광고 적용
		$body = admin_adsense_apply($body);
		
		$mainbody = admin_bodyskin($bodyskin_name,"pc","ko");
		if($_COOKIE[adminemail]) $body = str_replace("{body}","$mainbody</td><td valign='top'><a href='./admin_skinbody.php?code=$bodyskin_name'><img src='./images/design.jpg' boarder='0'></a>",$body);
		else $body = str_replace("{body}","$mainbody",$body);
		/*
		if($_COOKIE[adminemail]){ 
			$admintool = admin_bodyskin("admintool_bar","pc","ko");
			
			$admintool = str_replace("{admin}","<font color='ffffff'>$_COOKIE[adminemail]</font>",$admintool);
			$admintool = str_replace("{bodyskin}","<a href='./admin_skinbody.php?code=$bodyskin_name'><font color='ffffff'>body skin</font></a>",$admintool);
			$admintool = str_replace("{top}","<a href='./admin_skinbody.php?code=admin_top'><font color='ffffff'>TOP</font></a>",$admintool);
			$admintool = str_replace("{bottom}","<a href='./admin_skinbody.php?code=admin_bottom'><font color='ffffff'>BOTTOM</font></a>",$admintool);
			$admintool = str_replace("{logout}","<a href='./admin_logout.php'><font color='ffffff'>LOGOUT</font></a>",$admintool);
			
			$body = "$admintool $body";
			
		}
		*/
		
		
		return $body;

	}


?>

