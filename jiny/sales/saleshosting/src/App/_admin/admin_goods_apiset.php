<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2015.01.26
	//* Program By : hojin lee 
	//*
	//* 상품 API 및 출점 설정. 설정시 -> ms_goods 에 상품 정보 등록.
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";
	
	include "./func_curl.php";
	
	include "./func_adminstring.php";
	

	if($_COOKIE[adminemail]){ ///////////////	
		
		$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	$GID = $_GET['GID']; if(!$GID) $GID = $_POST['GID'];
    	
    	if($mode == "apiset"){
    		//# shop_goods, API 설정...
    		$enable = $_POST['enable'];
			$query = "UPDATE `shop_goods` SET `api`='$enable' WHERE `Id`='$GID'";
    		mysql_db_query($mysql_dbname,$query,$connect);
    		
    		
    		$currency = $_POST['currency'];
			$sell_prices = $_POST['sell_prices'];
			$supply_prices = $_POST['supply_prices'];
			$margin = $_POST['margin'];
			$margin_rate = $_POST['margin_rate'];
					
			$reseller = $_POST['reseller']; if(!$reseller) $reseller = "default";
			$reseller_domain = $_POST['reseller_domain'];
			$description = $_POST['description'];
					
			if(!$supply_prices) msg_alert("오류! 공급단가를 입력해주세요");
    		else {
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_goods_apiset` where GID = '$GID'",$connect);
				if( mysql_affected_rows() ) {
    						
    				$query = "UPDATE `shop_goods_apiset` SET `enable`='$enable', `reseller`='$reseller',`reseller_domain`='$reseller_domain',
    					`currency`='$currency', `sell_prices`='$sell_prices', `supply_prices`='$supply_prices',
    					`margin`='$margin',`margin_rate`='$margin_rate',`description`='$description' WHERE GID = '$GID'";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			} else {
    				$query = "INSERT INTO `shop_goods_apiset` (`regdate`,`enable`,`GID`, `currency`,  `sell_prices`, `supply_prices`,  `margin`, `margin_rate`,  `reseller`, `reseller_domain`, `description`) 
    					VALUES ( '$TODAYTIME','$enable','$GID', '$currency', '$sell_prices', '$supply_prices', '$margin', '$margin_rate', '$reseller', '$reseller_domain', '$description');";
					mysql_db_query($mysql_dbname,$query,$connect);  
					// echo $query;
				}
					
			}    
    		
  		
    		//# 마스터 상품서버에, 자료등록...
    		$result=mysql_db_query($mysql_dbname,"select * from `shop_goods` where Id = '$GID'",$connect);
			if( mysql_affected_rows() ) {
				$GOO=mysql_fetch_array($result);
		
    			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);

    			$query = "select * from `shop_goods_string` where gid='$GID'";
				echo $query;
				$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    			$total=mysql_result($result,0,0);
    			
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if(mysql_affected_rows()) {
					$goodname = "{";
					for($i=0;$i<$total;$i++){
						$rows=mysql_fetch_array($result);
						$goodname .="\"$rows[language]\":\"$rows[goodname]\"";
						if($i < $total-1) $goodname .=",";
					}
					$goodname .= "}";
				}
    			
    			
    			$post_value  = "domain=$domain&";
    			$post_value .= "sypplyer=$supplyer&";
    			$post_value .= "GID=$GID&";
    			$post_value .= "goodname=$goodname&";
    			$post_value .= "images=".str_replace("./","/",$GOO[images1])."&";
    			$post_value .= "sell_prices=$GOO[prices_sell]&";
    			$post_value .= "supply_prices=".$_POST['supply_prices']."&";
    			$post_value .= "description=".$_POST['description']."&";

    			$aaa = fetch_page("http://www.dojangshop.co.kr/admin/server_goods_save.php",$post_value,$cookies,$referer_url);
				// echo $aaa;
    		
    		}
    	} 
    	
    	//////
    		//# 화면 디자인 템플릿을 스킨 읽어옵니다.
			$body = admin_shopskin("admin_goods_apiset");	
			$body = str_replace("{new}",skin_button("출점설정","admin_goods_apiset_new.php?GID=$GID&UID=$UID"),$body); 
		
			//# 상품 출점조건 표시
			
			$body=str_replace("{formstart}","<form name='skins' method='post' enctype='multipart/form-data' action='admin_goods_apiset.php'>
				    				<input type='hidden' name='GID' value='$GID'>
				    				<input type='hidden' name='mode' value='apiset'>",$body);
			$body = str_replace("{formend}","</form>",$body);
				
			$query = "select * from `shop_goods_apiset` where GID = '$GID'";
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()){
				//# 수정입력
				$rows=mysql_fetch_array($result);
										
				if($rows[enable])
				$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
				else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
						
				//# 판매 통화설정
				$query1 = "select * from `shop_currency`";
				$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1=mysql_result($result1,0,0);
			
				$result1=mysql_db_query($mysql_dbname,$query1,$connect);
				if(mysql_affected_rows()) {
					$sell_currency = "<select name='currency' $cssFormStyle>";
					for($ii=0;$ii<$total1;$ii++){
						$rows1=mysql_fetch_array($result1);
						if($rows[currency] == $rows1[currency]) $sell_currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
						else $sell_currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
					}
					$body = str_replace("{currency}",$sell_currency,$body);
				}
				
				$body = str_replace("{sell_prices}","<input type='text' name='sell_prices' value='$rows[sell_prices]' $cssFormStyle >",$body);
				$body = str_replace("{supply_prices}","<input type='text' name='supply_prices' value='$rows[supply_prices]' $cssFormStyle >",$body);
				$body = str_replace("{margin}","<input type='text' name='margin' value='$rows[margin]' $cssFormStyle >",$body);
				$body = str_replace("{margin_rate}","<input type='text' name='margin_rate' value='$rows[margin_rate]' $cssFormStyle >",$body);
				$body = str_replace("{reseller}","<input type='text' name='reseller' value='$rows[reseller]' $cssFormStyle >",$body);
				$body = str_replace("{reseller_domain}","<input type='text' name='reseller_domain' value='$rows[reseller_domain]' $cssFormStyle >",$body);
			
				$body = str_replace("{description}","<textarea name='description' rows='10' style='width:100%'>$rows[description]</textarea>",$body);
					
			} else {
				//# 신규입력
				$result=mysql_db_query($mysql_dbname,"select * from `shop_goods` where Id = '$GID'",$connect);
				if( mysql_affected_rows() ) {
					$GOO=mysql_fetch_array($result);
					
					$body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
						
					//# 판매 통화설정
					$query1 = "select * from `shop_currency`";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
			
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$sell_currency = "<select name='currency' $cssFormStyle>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
							if($rows[sell_currency] == $rows1[currency]) $sell_currency .= "<option value='$rows1[currency]' selected>$rows1[currency]-$rows1[name]</option>"; 
							else $sell_currency .= "<option value='$rows1[currency]'>$rows1[currency]-$rows1[name]</option>";
						}
						$body = str_replace("{currency}",$sell_currency,$body);
					}
				
					$body = str_replace("{sell_prices}","<input type='text' name='sell_prices' value='$GOO[prices_sell]' $cssFormStyle >",$body);
					$body = str_replace("{supply_prices}","<input type='text' name='supply_prices' $cssFormStyle >",$body);
					$body = str_replace("{margin}","<input type='text' name='margin' $cssFormStyle >",$body);
					$body = str_replace("{margin_rate}","<input type='text' name='margin_rate' $cssFormStyle >",$body);
					$body = str_replace("{reseller}","<input type='text' name='reseller' $cssFormStyle >",$body);
					$body = str_replace("{reseller_domain}","<input type='text' name='reseller_domain' $cssFormStyle >",$body);
			
					$body = str_replace("{description}","<textarea name='description' rows='10' style='width:100%'></textarea>",$body);
					
				}
			}
			$body = str_replace("{submit}","<input type='submit' name='reg' value='출점설정' $css_butten1 >",$body);
			
			//////////////
			// 판매자 개별정보
			/*
			$query = "select * from `shop_goods_apiset` where GID = '$GID'";
			$result=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
    		$total=mysql_result($result,0,0);
		
			$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(mysql_affected_rows()) {
				for($i=0;$i<$total;$i++){
					$rows=mysql_fetch_array($result);
					
					
					$listfrom = admin_bodyskin("admin_goods_apiset_list","pc","ko");
				
					$listfrom = str_replace("{reseller}","<a href='admin_goods_apiset_new.php?mode=edit&GID=$GID&UID=$rows[Id]'>$rows[reseller]</a>",$listfrom);
				
					$listfrom = str_replace("{currency}","$rows[currency]",$listfrom);
					$listfrom = str_replace("{sell_prices}","$rows[sell_prices]",$listfrom);
					$listfrom = str_replace("{supply_prices}","$rows[supply_prices]",$listfrom);
					$listfrom = str_replace("{margin}","$rows[margin]",$listfrom);
					$listfrom = str_replace("{margin_rate}","$rows[margin_rate]",$listfrom);
				
					$list .= "$listfrom";
					//  <table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";

				}
				$body = str_replace("{datalist}","$list",$body); 
			} else $body = str_replace("{datalist}","API단가 없습니다.",$body);
		
			*/
			
			$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);
			$post_value  = "domain=$domain&";
    		$post_value .= "GID=$GID&";
			$json = explode("\n", fetch_page("http://www.dojangshop.co.kr/admin/server_goods_seller_list.php",$post_value,$cookies,$referer_url) );

			// $body = str_replace("{datalist}",$json[0],$body);
			
			for($i=0;$i<count($json)-1; $i++) {
				$rows = json_decode($json[$i],true);
				
				$listfrom = admin_bodyskin("admin_goods_apiset_list","pc","ko");
				
				$listfrom = str_replace("{reseller}","<a href='admin_goods_apiset_new.php?mode=edit&GID=$GID&UID=$rows[Id]'>$rows[domain]</a>",$listfrom);
				
				$listfrom = str_replace("{currency}","$rows[buy_currency]",$listfrom);
				$listfrom = str_replace("{sell_prices}","$rows[sell_prices]",$listfrom);
				$listfrom = str_replace("{supply_prices}","$rows[buy_prices]",$listfrom);
				$margin = $rows[sell_prices] - $rows[buy_prices];
				$listfrom = str_replace("{margin}","$margin",$listfrom);
				$margin_rate = 100 - $rows[buy_prices] / $rows[sell_prices] * 100;
				$listfrom = str_replace("{margin_rate}","$margin_rate %",$listfrom);
				
				$list .= "$listfrom";
			}
			
			$body = str_replace("{datalist}",$list,$body);

			
			///
			
	
		//# 번역스트링 처리
		$body = _adminstring_converting($body);
			
		echo $body;
		
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	


?>
