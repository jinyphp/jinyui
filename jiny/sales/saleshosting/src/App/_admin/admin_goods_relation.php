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
	include "./func_admingoods.php";
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	
	include "./func_adminstring.php";
	

	if($_COOKIE[adminemail]){ ///////////////	
		
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
		$keyword = $_GET['keyword']; if(!$keyword) $keyword = $_POST['keyword'];
		$limit = $_POST['limit']; if(!$limit) $limit = $_GET['limit'];
		
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_goods_relation");	
			
		include "./admin_catelist.php";
    	$body = str_replace("{category}","$category",$body);
    	
		
		if($UID){
		
			if($mode == "add" && $_SESSION['nonce'] == $_GET['nonce']){
				
				$RID = $_GET['RID'];
				$query = "INSERT INTO `shop_goods_relation` (`GID`, `RID`, `enable`) VALUES ('$UID', '$RID', 'on');";
				mysql_db_query($mysql_dbname,$query,$connect);
			} else if($mode == "del" && $_SESSION['nonce'] == $_GET['nonce']){
					
				$RID = $_GET['RID'];
				$query = "DELETE FROM `shop_goods_relation` WHERE `GID`='$UID' and `RID`='$RID';";
				mysql_db_query($mysql_dbname,$query,$connect);
			}
			
			$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());
		
			$query = "select * from `shop_goods` where Id = '$UID'";
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()) {
				$rows=mysql_fetch_array($result);
				$GOO = _goodstring($rows[Id],$_SESSION['language']);
				$body = str_replace("{goods}","<a href='admin_goods.php?limit=$limit'>$GOO[goodname]</a>",$body);
			}
			
			$query = "select * from `shop_goods_relation` where GID = '$UID'";
			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
		
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()) {
				for($i=0;$i<$total;$i++){
					$rows=mysql_fetch_array($result);
					
					
					
					$query1 = "select * from `shop_goods` where Id = '$rows[RID]'";
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) $rows1=mysql_fetch_array($result1);
					
					$goodstring = _goodstring($rows1[Id],$_SESSION['language']);
					$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
					$list .= "<td width='10' valign='top'><a href='admin_goods_relation.php?UID=$UID&keyword=$keyword&mode=del&RID=$rows1[Id]&nonce=$nonce&limit=$limit'><img src='./images/delete.jpg' border='0' width='20'></a></td>";
					$list .= "<td><img src='.$rows1[images1]' border='0' width='50'></td>";						
					$list .= "<td>$goodstring[goodname]</td></tr></table>";					
					$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
					// $list .= "<img src='.$rows1[images1]' border='0' width='150'>";
				
				}
				$body = str_replace("{relation_list}","$list",$body);
			} else $body = str_replace("{relation_list}","등록된 관련 상품이 없습니다.",$body);
			
			
			/////////////////
			
			$body=str_replace("{formstart}","<form name='relation' method='post' enctype='multipart/form-data' action='admin_goods_relation.php'>
										<input type='hidden' name='nonce' value='$nonce'> 
										<input type='hidden' name='UID' value='$UID'>
										<input type='hidden' name='limit' value='$limit'>
					    				<input type='hidden' name='mode' value='search'>",$body);
			$body = str_replace("{formend}","</form>",$body);
			$body = str_replace("{search}","<input type='text' name='keyword' value='$keyword' $cssFormStyle>",$body);
			$body = str_replace("{submit}","<input type='submit' name='reg' value='검색' $cssFormStyle>",$body);
    
			
			
			if($keyword){
				$query = "select * from `shop_goodstring` where goodname like '%$keyword%'";
				//echo $query."<br>";
				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
	    		$total=mysql_result($result,0,0);
		
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					for($i=0;$i<$total;$i++){
						$rows=mysql_fetch_array($result);
					
						if($UID != $rows[gid]){
							$query1 = "select * from `shop_goods` where Id = '$rows[gid]'";
							$result1=mysql_db_query($mysql_dbname,$query1,$connect);
							if(mysql_affected_rows()) $rows1=mysql_fetch_array($result1);
					
							$goodstring = _goodstring($rows1[Id],$_SESSION['language']);
							$list1 .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr>";
							$list1 .= "<td width='10' valign='top'><a href='admin_goods_relation.php?UID=$UID&keyword=$keyword&mode=add&RID=$rows1[Id]&nonce=$nonce&limit=$limit'><img src='./images/add.jpg' border='0' width='20'></a></td>";
							$list1 .= "<td><img src='.$rows1[images1]' border='0' width='50'></td>";						
							$list1 .= "<td>$goodstring[goodname]</td></tr></table>";					
							$list1 .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";
						}
					}
					$body = str_replace("{search_list}","$list1",$body);	
				} else $body = str_replace("{search_list}","검색된 상품이 없습니다.",$body);		
			
			} else $body = str_replace("{search_list}","검색 키워드가 없습니다..",$body);		
						
			
			/*
				$listform = admin_bodyskin("admin_domain_list","pc","ko");
				
				if($rows[enable]) $listform = str_replace("{en}","▣",$listform);
				else $listform = str_replace("{en}","□",$listform);	
				
				$listform = str_replace("{domain}","<a href='admin_domainedit.php?UID=$rows[Id]'>$rows[domain]</a></font>",$listform);
				
				// Layour skin
				$query1 = "select * from `shop_skin` where Id = '$rows[layout]' ";
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$rows1=mysql_fetch_array($result1);
					$listform = str_replace("{layout}","$rows1[skinname]",$listform);
				} else 	$listform = str_replace("{layout}","",$listform);
				
				// SEO
				$query1 = "select * from `shop_seo` where domain = '$rows[domain]' and language = '$rows[language]'";
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$rows1=mysql_fetch_array($result1);
					$domain_language = $rows[language];
					$listform = str_replace("{seo}","<a href='admin_seo.php?domain=$rows[domain]'>SEO설정</a>",$listform);
				} else 	$listform = str_replace("{seo}","SEO설정",$listform);
				
				
				$listform = str_replace("{country}","$rows[country]",$listform);
				$listform = str_replace("{language}","$rows[language]",$listform);
				*/
				$list .= $listform;
		
		
		 
		
			//# 번역스트링 처리
			$body = _adminstring_converting($body);
			
			echo $body;
		} else msg_alert("오류! 선택된 상품이 없습니다.");
		
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
