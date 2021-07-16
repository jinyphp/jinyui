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

		
	////////////////////////
	
	if($_COOKIE[adminemail]){ ///////////////

		if($_SESSION['nonce'] != $_POST['nonce']){
			$_SESSION['nonce'] = NULL;	
			echo "<meta http-equiv='refresh' content='0; url=admin_country.php'>";

		} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;

    		$menucode = $_POST['menucode'];
    		$enable = $_POST['enable'];
    			
    		$menu_skin = $_POST['menu_skin'];
    		$menu_skinhtml = $_POST['menu_skinhtml']; $menu_skinhtml = addslashes($menu_skinhtml);
    		$menu_skinmobile = $_POST['menu_skinmobile']; $menu_skinmobile = addslashes($menu_skinmobile);			
	
			$link = $_POST['link'];
			$link_pages = $_POST['link_pages'];
			$link_board = $_POST['link_board'];
			$link_cate = $_POST['link_cate'];
			$link_download = $_POST['link_download'];
			$link_url = $_POST['link_url'];
				
			$menu_color = $_POST['menu_color'];
			$menu_size = $_POST['menu_size'];
    		
    		$UID = $_POST['UID'];
    		$POS = $_POST['POS'];
    		$LEVEL = $_POST['LEVEL'];
    						

			if(!$menucode) msg_alert("오류! 메뉴 코드가 없습니다.");
    		else {
    		
    			if( $UID && $POS ){
    				//%%%%%%%%%%%%%%%%%
    				//% 서브 카테고리 등록
    				$POS = $POS + 1;
    				$LEVEL = $LEVEL + 1;
    				
    				// 삽입위치, pos값 전체 +1 씩 증가
    				$query = "select * from `pages_menu` where pos >= '$POS' order by pos desc";
    				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    				$total=mysql_result($result,0,0);

    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if(mysql_affected_rows()){ 
						for($i=0;$i<$total;$i++){
							$rows=mysql_fetch_array($result);
							$position = $rows[pos]+1;
    						$queryUp = "UPDATE `pages_menu` SET `pos`=$position WHERE `Id`=$rows[Id]";
    						mysql_db_query($mysql_dbname,$queryUp,$connect);
    					}
    				}	

					// 카테고리 추가...
    				$query = "INSERT INTO `pages_menu` (`code`, `catename`,  `enable`, `level`, `pos`, `ref`) 
    				VALUES ('$catecode', '$catecode',   '$enable', '$LEVEL', '$POS', '$UID');";
					mysql_db_query($mysql_dbname,$query,$connect);
					echo $query."<br>"; 
					
					//Tree값 분석 및 생성, 갱신
					$query = "select * from `pages_menu` where Id='$UID'";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if(mysql_affected_rows()){ 
						$rows=mysql_fetch_array($result);
						
						$query1 = "select * from `pages_menu` where pos='$POS'";
    					$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
    					if(mysql_affected_rows()){ 
							$rows1 = mysql_fetch_array($result1);
							$tree = $rows[tree].">".$rows1[Id];
							$UID = $rows1[Id];
							$queryUp = "UPDATE `pages_menu` SET `tree`='$tree' WHERE `Id`=$rows1[Id]";
    						mysql_db_query($mysql_dbname,$queryUp,$connect);
						}
					}	
					
    			
    			} else {
    				//%%%%%%%%%%%%%%%%%%
    				//% 최상단 메뉴추가...
    				$query = "select * from `pages_menu` order by pos desc";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if(mysql_affected_rows()){ 
						$rows=mysql_fetch_array($result);
						$pos = $rows[pos]+1;
					} else $pos = 1;
					
					
					
    				$query = "INSERT INTO `pages_menu` (`code`, `menuname`,  `enable`, `level`, `pos`, `ref`,`menu_color`, `menu_size`,
    				`link`,`link_pages`,`link_board`,`link_cate`,`link_download`,`link_url`,`menu_skin`,`menu_skinhtml`,`menu_skinmobile`) 
    				VALUES ('$menucode', '$menucode',  '$enable', '0', '$pos', '0','$menu_color', '$menu_size',
    				'$link','$link_pages','$link_board','$link_cate','$link_download','$link_url','$menu_skin','$menu_skinhtml','$menu_skinmobile')";
					mysql_db_query($mysql_dbname,$query,$connect);
					echo $query."<br>"; 
					
					//% Id 번호 추출 및 Tree 추가...
					$query = "select * from `pages_menu` where pos='$pos'";
    				$result=mysql_db_query($mysql_dbname,$query,$connect);
    				if(mysql_affected_rows()){ 
						$rows=mysql_fetch_array($result);
						$tree = "0>$rows[Id]";
						$UID = $rows[Id];
						$queryUp = "UPDATE `pages_menu` SET `tree`='$tree' WHERE `Id`=$rows[Id]";
    					mysql_db_query($mysql_dbname,$queryUp,$connect);
    				}
					
					
				}		
						
			}    						    			
    		
    		
    		
    		/////////////////////
    		
    		//# 언어별 카테고리 메뉴명 처리...
			$query1 = "select * from `shop_language` ";	
			$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    		$total1 = mysql_result($result1,0,0);
			
			$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
			if(mysql_affected_rows()){
				for($i=0;$i<$total1;$i++){
					$rows1=mysql_fetch_array($result1);
					
					$_catename = "catename_".$rows1[code];
					
					$query = "UPDATE `pages_menu` SET `$rows1[code]`='".$_POST[$_catename]."'  WHERE `Id`='$UID'";
    				echo $query."<br>"; 	
    				mysql_db_query($mysql_dbname,$query,$connect);
							
				}				
			}	


    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

