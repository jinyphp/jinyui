<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	

	function _goodstring_update($GID,$language,$name,$value){
		global $connect, $mysql_dbname;
							
		$query1 = "select * from `shop_goods_string` where gid='$GID' and language = '$language' ";
		//echo $query1."<br>"; 
		mysql_db_query($mysql_dbname,$query1,$connect);
		if(mysql_affected_rows()){	
			// 갱신
			$query = "UPDATE `shop_goods_string` SET `$name`='$value' where gid='$GID' and language = '$language' ";	
    		//echo $query."<br>"; 	
    		mysql_db_query($mysql_dbname,$query,$connect);
    							
		} else {
			// 신규 삽입
			$query = "INSERT INTO `shop_goods_string` (`gid`, `language`, `$name`) VALUES ('$GID', '$language', '$value');";
			//echo $query."<br>"; 	
			mysql_db_query($mysql_dbname,$query,$connect);
		}
							
	}
						
	function _goodstring($GID,$language){
		global $connect, $mysql_dbname;
							
		$query1 = "select * from `shop_goods_string` where gid='$GID' and language = '$language' ";
		// echo $query1."<br>"; 
		$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
		if(mysql_affected_rows()){	
			$rows1=mysql_fetch_array($result1);
    		return $rows1;					
		} else {
		
			$query1 = "select * from `shop_goods_string` where gid='$GID' order by goodname desc";
			//echo $query1."<br>"; 
			$result1 = mysql_db_query($mysql_dbname,$query1,$connect);
			if(mysql_affected_rows()){	
				$rows1=mysql_fetch_array($result1);
    			return $rows1;					
			}
		
		
		}
							
	}	
					

	//# 카테고리 셀렉트박스
	function _form_cate_select($cate){
		global $connect, $mysql_dbname;
		global $cssFormStyle;
		
		$query1 = "select * from `shop_cate` order by pos asc";
		$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    	$total1=mysql_result($result1,0,0);
		
		$result1=mysql_db_query($mysql_dbname,$query1,$connect);
		if(mysql_affected_rows()) {
			$body1 = "<select size='1' name='cate' $cssFormStyle> ";
			$body1 .= "<option value='' >상품 카테고리</option>";
			for($ii=0;$ii<$total1;$ii++){
				$rows1=mysql_fetch_array($result1);
				
				for($jj=0,$level="";$jj<$rows1[level];$jj++) $level .= "&nbsp;";
				
				$language = $_SESSION['language']; //해당언어 상품명, 없으면 기본이름 적용
				if($rows1[$language]) $catename = $rows1[$language]; else $catename = $rows1[catename];
									
				// echo "GOO : $GOO[cate], Tree : $rows1[tree] <br>";
				if($cate == $rows1[tree]) 
					$body1 .= "<option value='$rows1[tree]' selected=\"selected\">$level $catename</option>";
					else $body1 .= "<option value='$rows1[tree]' >$level $catename</option>";
				}
				$body1 .= "</select>";
				
		}
		
		return $body1;
	}

?>

