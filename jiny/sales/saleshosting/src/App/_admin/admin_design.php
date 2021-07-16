<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	
	include "./func_adminstring.php";
    
	if($_COOKIE[adminemail]){ ///////////////
	
		switch($mode){
		
			case 'makeskin':
				
				$TID = $_POST['TID']; 					
    			for($i=0;$i<count($TID);$i++){
    			
    				$query = "SELECT * FROM `shop_desgin` WHERE `Id`='$TID[$i]'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(mysql_affected_rows()) {
						$rows=mysql_fetch_array($result);
						
						///////////////
						if($rows[pc]) SkinFileSave($LANG,$rows[pages]."_pc.htm",$rows[pc]);
						else {
							if(strstr($rows[pages],"admin")){
							// 어드민 파일...
								if(file_exists("./$LANG/".$rows[pages]."_pc.htm")){
						
									$html1 = FileLoad("./$LANG/".$rows[pages]."_pc.htm");
									$html1 = addslashes($html1);
							
									//$query = "UPDATE `shop_desgin` SET `pc`='$html1' WHERE `code`='$language1' and `pages`='$pages'";
    								//mysql_db_query($mysql_dbname,$query,$connect);
						
								}
							} else {
						
							// Shop 스킨
								if(file_exists("../$LANG/".$rows[pages]."_pc.htm")){
								
											
									$html1 = FileLoad("../$LANG/".$rows[pages]."_pc.htm");
									$html1 = addslashes($html1);
							
									//$query = "UPDATE `shop_desgin` SET `pc`='$html1' WHERE `code`='$language1' and `pages`='$pages'";
    								//mysql_db_query($mysql_dbname,$query,$connect);
						
								}	
							}
					
						}
				
						//////////////
    					if($rows[mobile]) SkinFileSave($LANG,$rows[pages].".htm",$rows[mobile]); 
    					else {
							if(strstr($rows[pages],"admin")){
							// 어드민 파일...
								if(file_exists("./$LANG/".$rows[pages].".htm")){
									$html2 = FileLoad("./$LANG/".$rows[pages].".htm");
									$html2 = addslashes($html2);
							
									//$query = "UPDATE `shop_desgin` SET `mobile`='$html2' WHERE `code`='$language1' and `pages`='$pages'";
    								//mysql_db_query($mysql_dbname,$query,$connect);
								}	
							} else {
							// Shop 스킨
								if(file_exists("../$LANG/".$rows[pages].".htm")){
									$html2 = FileLoad("../$LANG/".$rows[pages].".htm");
									$html2 = addslashes($html2);
							
									//$query = "UPDATE `shop_desgin` SET `mobile`='$html2' WHERE `code`='$language1' and `pages`='$pages'";
    								//mysql_db_query($mysql_dbname,$query,$connect);
								}	
							}
					
						}
				
 						//////////

						
						
							}			
        				}

				
				break;
			
			case 'skincopy':
				$language1 = $_POST['language1'];
				$TID = $_POST['TID']; 
									
    			for($i=0;$i<count($TID);$i++){
    			
    				$query = "SELECT * FROM `shop_desgin` WHERE `Id`='$TID[$i]'";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
					if(mysql_affected_rows()) {
						$rows=mysql_fetch_array($result);
						
						///////////////
						$query = "SELECT * FROM `shop_desgin` WHERE `code`='$language1' and `pages`='$rows[pages]'";
    					$result = mysql_db_query($mysql_dbname,$query,$connect);
						if(mysql_affected_rows()) {
							echo "Duplicate skip : $language1 $rows[pages] <br>";
						} else {
							echo "Copy : $language1 $rows[pages] <br>";
							////////////
							if($rows[pc]) SkinFileSave($language1,$rows[pages]."_pc.htm",$rows[pc]);
	    					if($rows[mobile]) SkinFileSave($language1,$rows[pages].".htm",$rows[mobile]); 
	    					
	    					$skin_mobile = addslashes($rows[mobile]);
	    					$skin_pc = addslashes($rows[pc]);
							$query = "INSERT INTO `shop_desgin` (`code`, `pages`, `mobile`, `pc`) VALUES ('$language1', '$rows[pages]', '$skin_mobile', '$skin_pc')";							
							mysql_db_query($mysql_dbname,$query,$connect);
						
						}
						
						
					} //end if			
    			} // end for

				

			
				break;
			
		}
		//////////////////
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_design");	 
	
		
			
			$body = str_replace("{status}",$_GET['status'],$body); 
		
			$body=str_replace("{formstart}","<form name='design' method='post' enctype='multipart/form-data' action='admin_design.php'> 
					    				<input type='hidden' name='mode' >",$body);
			$body = str_replace("{formend}","</form>",$body);
		
			/////
		
			$query1 = "select * from shop_language where enable = 'on' or enable = 'checked'";
			$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    		$total1 = mysql_result($result1,0,0);
				
    		$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    		if(mysql_affected_rows()){
    			$body1 = "<select size='1' name='language1' $cssFormStyle> ";
				for($i1=1;$i1<=$total1;$i1++){
					$rows1=mysql_fetch_array($result1);
				
					if($_GET['code'] == $rows1[code] || $_POST['language1'] == $rows1[code]) 
					$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[language]</option>";
					else $body1 .= "<option value='$rows1[code]' >$rows1[language]</option>";
				}
				$body1 .= "</select>";
				$body = str_replace("{language1}",$body1,$body); //# 완성된 LIST를 치환합니다.
			}
			


			/////
		
			$body = str_replace("{makeskin}","<input type='button' value='".multiString_conv("ko","스킨 재생성",$LANG)."' onclick='makeSkin()' style='font-size:9pt'>",$body);
			$body = str_replace("{skincopy}","<input type='button' value='".multiString_conv("ko","언어복사",$LANG)."' onclick='skinCopy()' style='font-size:9pt'>",$body);

		
			////////////////////
		
			include "admin_design_left.php";
		
			//////////////////////
		
			if($language1){
				$languagecode = $language1;
			} else {
				$languagecode = $_GET['code'];
				if(!$languagecode) $languagecode = $_SESSION['language'];
			}
		
			$query = "SELECT * FROM `shop_desgin` where code = '$languagecode' order by pages desc";
			// echo $query;
		
			$body = str_replace("{countrycode}",$countrycode,$body); 
		
			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
		
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()) {
		
				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
				$list .= "<td width='15' bgcolor='ffffff'> <font size=2></font></td>";
				$list .= "<td width='15' bgcolor='ffffff'> </td>";
				$list .= "<td width='50' bgcolor='ffffff'> <font size=2> 언어</font></td>";
				$list .= "<td bgcolor='ffffff'> <font size=2> 스킨제목</font></td>";
				$list .= "<td width='100' bgcolor='ffffff'> <font size=2>모바일용 HTML</font></td>";
				$list .= "<td width='100' bgcolor='ffffff'> <font size=2>pc용 HTML</font></td>";
				$list .= "</tr></table>";
			
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
			
				for($i=0,$j=1;$i<$total;$i++,$j++){
					$rows=mysql_fetch_array($result);
				
					if($MOBILE == "mobile") {
						$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
						$list .= "<td width='15' bgcolor='ffffff'> <font size=2> $j</font></td>";
						$list .= "<td width='15' bgcolor='ffffff'> <input type='checkbox' name='TID[]' value='$rows[Id]'> </td>";
						$list .= "<td width='50' bgcolor='ffffff'> <font size=2> $rows[code]</font></td>";
						$list .= "<td bgcolor='ffffff'> <font size=2> <a href='admin_designedit.php?mode=edit&UID=$rows[Id]'> $rows[pages] </a> </font></td>";
						$list .= "<td width='100' bgcolor='ffffff'> <font size=2> <a target='new' href='../$rows[code]/$rows[pages].htm'>mobile HTML</a></font></td>";
						$list .= "<td width='100' bgcolor='ffffff'> <font size=2> <a target='new' href='../$rows[code]/$rows[pages]_pc.htm'>pc HTML</a></font></td>";
						$list .= "</tr></table>";
		
					} else {
						$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
						$list .= "<td width='15' bgcolor='ffffff'> <font size=2> $j</font></td>";
						$list .= "<td width='15' bgcolor='ffffff'> <input type='checkbox' name='TID[]' value='$rows[Id]'> </td>";
						$list .= "<td width='50' bgcolor='ffffff'> <font size=2> $rows[code]</font></td>";
						$list .= "<td bgcolor='ffffff'> <font size=2> <a href='admin_designedit.php?mode=edit&UID=$rows[Id]'> $rows[pages] </a> </font></td>";
						$list .= "<td width='100' bgcolor='ffffff'> <font size=2> <a target='new' href='../$rows[code]/$rows[pages].htm'>mobile HTML</a></font></td>";
						$list .= "<td width='100' bgcolor='ffffff'> <font size=2> <a target='new' href='../$rows[code]/$rows[pages]_pc.htm'>pc HTML</a></font></td>";
						$list .= "</tr></table>";
					}
					$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
				}
			}
		
			$body = str_replace("{datalist}","$list",$body); 
		
		
		
		
		
	 
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		 
		echo $body;
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
