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
    	$limit = $_POST['limit']; if(!$limit) $limit = $_GET['limit'];
    
    	$countryCode = $_GET['code']; if(!$countryCode) $countryCode = $_POST['code']; if(!$countryCode) $countryCode = $COUNTRY;
	
 		
 		$pages_listcount = 30;
	
		// 간편수정
		if($mode == "quickedit"){
			
			$TID = $_POST['TID'];
		
			$prices_buy = $_POST['prices_buy'];
			$prices_sell = $_POST['prices_sell'];
			$subtitle = $_POST['subtitle'];   					
		
    		for($i=0;$i<count($TID);$i++){
    			$query = "UPDATE `shop_goods` SET `subtitle`='$subtitle[$i]', `prices_buy`='$prices_buy[$i]', `prices_sell`='$prices_sell[$i]' WHERE `Id`='$TID[$i]'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    							
        	}

		}
	
		/////////////////////
		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    	$body = admin_shopskin("admin_goods");
    	
    	include "./admin_catelist.php";
    	$body = str_replace("{category}","$category",$body);
		
		
		$body=str_replace("{formstart}","<form name='form1' method='post' enctype='multipart/form-data' action='admin_goods.php'> 
					    				<input type='hidden' name='mode' value='quickedit'>",$body);
		$body = str_replace("{formend}","</form>",$body);
							
		
		$body = str_replace("{quickedit}","<input type='submit' name='reg' value='간편수정' $css_butten>",$body);
    	$body = str_replace("{new}","<input type='button' name='reg' value='상품추가' onclick='pageClick(\"admin_goodsnew.php?limit=$limit&code=$countryCode\")' $css_butten>",$body);
    
				

		
		
		
		$query = "select * from `shop_goods` ";
		if($_GET['cate']) $query .= " where cate = '".$_GET['cate']."'";
		$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    	$total=mysql_result($result,0,0);
    	
		if($limit) $query .= "LIMIT $limit , $pages_listcount"; else $query .= "LIMIT 0 , $pages_listcount";
		// echo "limit $limit $query <br>";
		
		$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(mysql_affected_rows()) {
		
			if( ($total - $limit) < $pages_listcount ) $count = $total - $limit; else $count = $pages_listcount;
			// echo "count $count<br>";
			
			for($i=0;$i<$count;$i++){
				$rows=mysql_fetch_array($result);
				
				//# 언어별 상품정보 읽어옴
				$goodstring = _goodstring($rows[Id],$_SESSION['language']);
				
				
				$listfrom = admin_bodyskin("admin_goods_list","pc","ko");
		
				$listfrom = str_replace("{images}","<img src='.$rows[images1]' border='0' width='100'>",$listfrom);
				$listfrom = str_replace("{tid}","<input type='checkbox' name='TID[]' value='$rows[Id]' checked>",$listfrom);
				
				
				$query1 = "select * from `shop_cate` where tree = '$rows[cate]'";
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$rows1=mysql_fetch_array($result1);
					$catename = $rows1[catename];		
				} else $catename = "";

				
				
				if($rows[enable])
				$listfrom = str_replace("{goodname}","<a href='admin_goodsedit.php?UID=$rows[Id]&limit=$limit&cate=".$_GET['cate']."&code=$countryCode'><font size='2'><b>$goodstring[goodname]</b></a> / $catename",$listfrom);
				else $listfrom = str_replace("{goodname}","<a href='admin_goodsedit.php?UID=$rows[Id]&limit=$limit&cate=".$_GET['cate']."&code=$countryCode'><font size='2'>$goodstring[goodname]</a> / $catename",$listfrom);
				
				
				$listfrom = str_replace("{buy_currency}","$rows[buy_currency]",$listfrom);
				$listfrom = str_replace("{sell_currency}","$rows[sell_currency]",$listfrom);
				$listfrom = str_replace("{prices_buy}","<input type='text' name='prices_buy[]' value='$rows[prices_buy]' style='width:100%'>",$listfrom);
				$listfrom = str_replace("{prices_sell}","<input type='text' name='prices_sell[]' value='$rows[prices_sell]' style='width:100%'>",$listfrom);
				
				$listfrom = str_replace("{subtitle}","<textarea name='subtitle[]' rows='3' style='width:100%'>$rows[subtitle]</textarea>",$listfrom);
				
				//#
				$query1 = "select * from `shop_goods_relation` where GID = '$rows[Id]'";
				$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1=mysql_result($result1,0,0);
				$listfrom = str_replace("{relation}","<a href='admin_goods_relation.php?UID=$rows[Id]&limit=$limit'>관련상품</a>($total1)",$listfrom);
				
				//#
				$query1 = "select * from `shop_goods_apiset` where GID = '$rows[Id]'";
				$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1=mysql_result($result1,0,0);
				$listfrom = str_replace("{api}","<a href='admin_goods_apiset.php?GID=$rows[Id]&limit=$limit'>API연결</a>($total1)",$listfrom);
				
				
				$listfrom = str_replace("{comment}","<a href='admin_goods_comment.php?GID=$rows[Id]&limit=$limit'>상품평</a>",$listfrom);
				
				$list .= $listfrom;
				
						  
				
			}
		
		
			$pageMenu = "<table border='0' cellpadding='5' cellspacing='5' width='100%'><tr><td align='center'>";
			for($i=1, $j=0; $j<$total; $i++, $j+=$pages_listcount){
				if($limit == $j)
				$pageMenu .= "<b><font size=2>$i</font></b>  |  ";
				else $pageMenu .= "<a href='admin_goods.php?limit=$j'><font size=2>$i</font></a>  |  ";
			}
			$pageMenu .= "</td></tr></table>";
			$list .= $pageMenu;
		
		
			$body = str_replace("{datalist}","$list",$body); //# 완성된 LIST를 치환합니다.
			
			
			
			
			
		
		}
	 
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
		
		echo $body;
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
