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
	
	if($_COOKIE[adminemail]){ ///////////////	
		
		
		// if($MOBILE == "mobile") $body = admin_skinLoad("admin_string.htm"); else $body = admin_skinLoad("admin_string_pc.htm");		
		$body = admin_shopskin("admin_string");
		
		////////////////////
		
		include "admin_design_left.php";
		
		//////////////////////
					
				$query = "select * from shop_string order by LENGTH(ko) desc";
    			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    			$total=mysql_result($result,0,0);
    					
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
    			if(mysql_affected_rows()){
    							
					if($MOBILE == "mobile") {
						$width = "100%"; 
						$databody = "<table border='0' cellspacing='5' cellpadding='5' width='$width' bgcolor='e9eaed' align='center'><tr><td>";
					} else {
						$width = "100%";
    					$databody = "<table border='0' cellspacing='0' cellpadding='0' width='$width' 0align='center'><tr><td>";	
					}	
						
						for($i=0;$i<$total;$i++){
	    					$rows = mysql_fetch_array($result);
	    							
	    					$list = "<table border='0' cellspacing='2' cellpadding='2' width=100%>";
	    					
	    					$list .=  "<tr><td width='50'><font size=2>CODE</font></td><td><font size='2'>{@<a href='admin_string1_new.php?mode=edit&UID=$rows[Id]'>$rows[code]</a>}</font></td></tr>";
							$list .=  "<tr><td width='50'><font size=2>KO:</font></td><td><font size='2'>$rows[ko]</font></td></tr>";
							$list .=  "<tr><td width='50'><font size=2>EN:</font></td><td><font size='2'>$rows[en]</font></td></tr>";
							$list .=  "<tr><td width='50'><font size=2>JP:</font></td><td><font size='2'>$rows[jp]</font></td></tr>";
							$list .=  "<tr><td width='50'><font size=2>CN:</font></td><td><font size='2'>$rows[cn]</font></td></tr>";
	    					
						
							
							//$list .=  "<tr><td><font size=2>DE:</font></td><td><font size='2'>$rows[de]</font></td></tr>";
							//$list .=  "<tr><td><font size=2>RU:</font></td><td><font size='2'>$rows[ru]</font></td></tr>";
							//$list .=  "<tr><td><font size=2>SP:</font></td><td><font size='2'>$rows[sp]</font></td></tr>";
							//$list .=  "<tr><td><font size=2>PT:</font></td><td><font size='2'>$rows[pt]</font></td></tr>";
							//$list .=  "<tr><td><font size=2>AR:</font></td><td><font size='2'>$rows[ar]</font></td></tr>";
						
							
							
		
							$list .=  "</table>";
									
							$databody .= "$list";
							$databody .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
	    							
	    				}	
	    						
	    			$databody .= "</td></tr></table>";
				}

				
				
				$body=str_replace("{databody}",$databody,$body);


		echo $body;
	
	
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

    
    
    
    
    
	
?>
