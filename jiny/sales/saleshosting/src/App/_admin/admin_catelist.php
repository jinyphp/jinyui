<?
	// ////////////////////////////////////////////////////////////
	// 거래처 목록 리스트
	// 2014.08.04 hojinlee
	//
	//
	/*
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	*/

	
		$query = "select * from `shop_cate` order by pos asc";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {

			for($i=0;$i<$total;$i++){
				$rows=mysql_fetch_array($result);
			
			
				for($LevelSpace="",$j=0;$j<$rows[level];$j++) $LevelSpace .= "-";
			
		
				//*** PC모드 출력
				$category .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
					

					
				//*** 트리모양 만들기
				if($rows[level] == 0) {
						$query1 = "select * from `shop_cate` where ref = '0' and pos > '$rows[pos]'"; 
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_affected_rows() )	$depth = "┣"; else $depth = "┗";
						
						
				} else {	
						
						$query1 = "select * from `shop_cate` where ref = '0' and pos > '$rows[pos]'"; 
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_affected_rows() )	$depth = "┃"; else $depth = "&#4515;";

						for($k=0;$k<$rows[level];$k++) $depth .= "&#4515;";
						
						$query1 = "select * from `shop_cate` where ref = '$rows[ref]' and pos > '$rows[pos]'"; 
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( mysql_affected_rows() ) $depth .= "┣"; else $depth .= "┗";
				}
					
					
					
					
				$category .= "<td bgcolor='ffffff'> <font size=2> $depth  <a href='#'>$rows[catename]</a> </font></td>";
				
				$category .= "</tr></table>";
			
			
			}			 
		}
		
		// echo $category;
	


?>
