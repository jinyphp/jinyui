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
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
		$limit = $_POST['limit']; if(!$limit) $limit = $_GET['limit'];
		
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
		$body = admin_shopskin("admin_memlist");
		$body = str_replace("{new}",skin_button("회원추가","admin_memlist_new.php"),$body);  
		
		
		$_count = $_POST['count']; if(!$_count) $_count = $_GET['count']; if(!$_count) $_count = 10;
		
	
		$form_listcount = "<select size='1' name='count' $cssFormStyle onChange=\"submit()\">";
		
		if($_count == 10 ) 
			$form_listcount .= "<option value='10' selected=\"selected\">LIST 10</option>";
		else $form_listcount .= "<option value='10' >LIST 10</option>";
		
		if($_count == 20 ) 
			$form_listcount .= "<option value='20' selected=\"selected\">LIST 20</option>";
		else $form_listcount .= "<option value='20' >LIST 20</option>";
		
		if($_count == 50 ) 
			$form_listcount .= "<option value='50' selected=\"selected\">LIST 50</option>";
		else $form_listcount .= "<option value='50' >LIST 50</option>";
		
		if($_count == 100 ) 
			$form_listcount .= "<option value='100' selected=\"selected\">LIST 100</option>";
		else $form_listcount .= "<option value='100' >LIST 100</option>";
		
		$form_listcount .= "</select>";
		
		
		
		// 검색폼
		$search_form = "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
		<form name='skin' method='post' enctype='multipart/form-data' action='admin_memlist.php'>
		<input type='hidden' name='mode' value='search'>
		<tr><td width='100'>$form_listcount</td>
		<td><input type='text' name='keyword' $cssFormStyle></td><td width='5'></td><td width='30'><input type='submit' name='reg' value='검색' $cssFormStyle></td></tr>
		</form>
		</table>";
		$body=str_replace("{search}",$search_form,$body);
		
		
		////////////////////
		// include "admin_members_left.php";
		//////////////////////

		// $countrycode = $_GET['code'];
		// if(!$countrycode) $countrycode = $_SESSION['country'];
		// $body = str_replace("{countrycode}",$countrycode,$body); 
		

		
		
		// 검색키워드 값이 있는경우
		$_keyword = $_POST['keyword']; if(!$_keyword) $_keyword = $_GET['keyword'];
		
		if($_keyword) {
		$search_keyword = "where ( email like '%$_keyword%' or username like '%$_keyword%' )"; 
		} else $search_keyword = "";

		$query = "select * from `shop_member` $search_keyword ";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
		
		
		if($_count <= 0){
			//한페이지 상품출력 상품이 0인경우, 상품 전체 출력...
			$count = $total; 
			$query .= " order by regdate desc LIMIT 0 , $total";
			echo "카운트조건 1 $_count <= 0 ... ".$_GET['count']." <br>";
		} else {
			if($limit) $query .= " order by regdate desc LIMIT $limit , $_count"; else $query .= " order by regdate desc LIMIT 0 , $_count";
			if( ($total - $limit) < $_count ) $count = $total - $limit; else $count = $_count;
			echo "카운트조건 2<br>";
			
		}

		echo $query;

		
		
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
			for($i=0;$i<$count;$i++){
				$rows=mysql_fetch_array($result);
		
					// $listfrom = FileLoad("./$LANG/admin_members_list_pc.htm");
					$listfrom = admin_bodyskin("admin_memlist_list","pc","ko");
					
					if($rows[auth]) $listfrom = str_replace("{auth}","<font size=2>▣</font>",$listfrom);
					else $listfrom = str_replace("{auth}","<font size=2>□</font>",$listfrom);					
					
					$listfrom = str_replace("{email}","<font size='2'><a href='admin_memlist_edit.php?mode=edit&UID=$rows[Id]'>$rows[email]</a></font>",$listfrom);
					$listfrom = str_replace("{name}","<font size='2'>$rows[username]</font>",$listfrom);		
					$listfrom = str_replace("{phone}","<font size='2'>$rows[userphone]</font>",$listfrom);
					$listfrom = str_replace("{point}","<font size='2'>$rows[point]</font>",$listfrom);
					
					
					$query1 = "select * from `shop_memgrade` where Id='$rows[grade]'";
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$rows1=mysql_fetch_array($result1);
						$listfrom = str_replace("{grade}","<font size='2'>$rows1[grade]</font>",$listfrom);
					} else $listfrom = str_replace("{grade}","<font size='2'></font>",$listfrom);
					
					$listfrom = str_replace("{grade}","<font size='2'>$rows[grade]</font>",$listfrom);
					$list .= $listfrom;
	
			}
			
			if($_count > 0  && $total > $_count){
				$pageMenu = "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr><td align='center'>";
				for($i=1, $j=0; $j<$total; $i++, $j+=$_count){
					if($limit == $j)
					$pageMenu .= "<b><font size=2>$i</font></b>";
					else $pageMenu .= "<a href='".$_SERVER['PHP_SELF']."?limit=$j&keyword=$_keyword&count=$_count'><font size=2>$i</font></a>";
				
					if($j<($total-$_count)) $pageMenu .= "  |  ";
				}
				$pageMenu .= "</td></tr></table>";
				$list .= $pageMenu;
			}
			
			
			$body = str_replace("{datalist}","$list",$body);  //# 완성된 LIST를 치환합니다.
			
		} else $body = str_replace("{datalist}","등록 또는 검색된 회원이 없습니다.",$body); 

		//# 번역스트링 처리
		$body = _adminstring_converting($body);	
		
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";

?>
