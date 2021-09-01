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

			$code = $_POST['code'];
    		$countryname = $_POST['countryname'];
    		$language1 = $_POST['language1'];
    		$enable = $_POST['enable'];
    		
			$currency = $_POST['currency'];
    		$tax = $_POST['tax'];
    				
    		$address = $_POST['address'];
    		$phone = $_POST['phone'];
    		$fax = $_POST['fax'];
    		$email = $_POST['email'];				

			if(!$code) msg_alert("오류! 국가코드 없습니다.");
    		else if(!$countryname) msg_alert("오류! 국가명 없습니다.");
    		else if(!$language1) msg_alert("오류! 언어설정이 없습니다.");
    		else {
    		
    			$query = "INSERT INTO `shop_country` (`code`, `name`, `language`, `enable`,`currency`,`tax`,`address`,`phone`,`fax`,`email`) 
    						VALUES ('$code', '$countryname', '$language1', '$enable','$currency','$tax','$address','$phone','$fax','$email');";
				mysql_db_query($mysql_dbname,$query,$connect);  
				
				
			
				
				
				/////////////////////
				/*
				$query = "show tables like 'shop_cart_$code'";
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
				} else {
				}
				////////////////////////////
				*/
				
				/*
				$query="CREATE TABLE IF NOT EXISTS `shop_cart_$code` (
  						`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  						`regdate` datetime DEFAULT NULL,
  						`cartlog` varchar(255) DEFAULT NULL,
  						`GID` int(11) DEFAULT NULL,
  						`goodname` varchar(255) DEFAULT NULL,
  						`num` varchar(10) DEFAULT NULL,
  						`currency` varchar(255) DEFAULT NULL,
  						`prices` varchar(20) DEFAULT NULL,
  						`ordertext` text,
  						`upload` varchar(255) DEFAULT NULL,
  						`status` varchar(30) DEFAULT NULL,
  						`username` varchar(255) DEFAULT NULL,
  						`email` varchar(255) DEFAULT NULL,
  						`password` varchar(255) DEFAULT NULL,
  						`phone` varchar(30) DEFAULT NULL,
  						`country` varchar(255) DEFAULT NULL,
  						`language` varchar(255) DEFAULT NULL,
  						`post` varchar(20) DEFAULT NULL,
  						`address` varchar(255) DEFAULT NULL,
  						`bankcheck` varchar(20) DEFAULT NULL,
  						`deliverydate` varchar(255) DEFAULT NULL,
  						`deliveryinvoice` varchar(255) DEFAULT NULL,
  						`deliverycompany` varchar(255) DEFAULT NULL,
  						`optionvalue` varchar(255) DEFAULT NULL,
  						`bankid` int(11) DEFAULT NULL,
  						`delivery_id` varchar(20) DEFAULT NULL,
  						PRIMARY KEY (`Id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ";
				mysql_db_query($mysql_dbname,$query,$connect); 
				*/
				
				/*
				$query = "CREATE TABLE IF NOT EXISTS `shop_member_$code` (
  						`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  						`regdate` datetime DEFAULT NULL,
  						`email` varchar(255) DEFAULT NULL,
  						`password` varchar(255) DEFAULT NULL,
  						`username` varchar(255) DEFAULT NULL,
  						`userphone` varchar(255) DEFAULT NULL,
  						`post` varchar(20) DEFAULT NULL,
  						`address` varchar(255) DEFAULT NULL,
  						`country` varchar(255) DEFAULT NULL,
  						`currency` varchar(20) DEFAULT NULL,
  						`lastlog` varchar(255) DEFAULT NULL,
  						`point` varchar(255) DEFAULT NULL,
  						`reseller` varchar(255) DEFAULT NULL,
  						`language` varchar(255) DEFAULT NULL,
  						PRIMARY KEY (`Id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ";
				mysql_db_query($mysql_dbname,$query,$connect); 
				*/
				
				/*
				$query = "CREATE TABLE IF NOT EXISTS `shop_goods_$code` (
   						 `Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
   						 `regdate` datetime DEFAULT NULL,
    					 `cate` varchar(255) DEFAULT NULL,
   						 `cateName` varchar(255) DEFAULT NULL,
   						 `code` varchar(255) DEFAULT NULL,
   						 `barcode` varchar(255) DEFAULT NULL,
   						 `goodname` varchar(255) DEFAULT NULL,
   						 `spec` varchar(255) DEFAULT NULL,
    					 `subtitle` varchar(255) DEFAULT NULL,
    					 `brand` varchar(255) DEFAULT NULL,
    					 `model` varchar(255) DEFAULT NULL,
    					 `stock` varchar(255) DEFAULT NULL,
    					 `vat` varchar(20) DEFAULT NULL,
    					 `vatrate` varchar(20) DEFAULT NULL,
    					 `buy_currency` varchar(20) DEFAULT NULL,
    					 `prices_buy` varchar(20) DEFAULT NULL,
   						 `sell_currency` varchar(20) DEFAULT NULL,
   						 `prices_sell` varchar(20) DEFAULT NULL,
    					 `images1` varchar(255) DEFAULT NULL,
   						 `images2` varchar(255) DEFAULT NULL,
   						 `images3` varchar(255) DEFAULT NULL,
   						 `description` text,
   						 `detail1` varchar(255) DEFAULT NULL,
   						 `detail2` varchar(255) DEFAULT NULL,
   						 `detail3` varchar(255) DEFAULT NULL,
   						 `click` int(11) DEFAULT NULL,
   						 `pos` int(11) DEFAULT NULL,
   						 `recommand` varchar(20) DEFAULT NULL,
   						 `optionitem` varchar(255) DEFAULT NULL,
   						 `optionvalue` varchar(255) DEFAULT NULL,
   						 `goodname_ko` varchar(255) DEFAULT NULL,
   						 `goodname_en` varchar(255) DEFAULT NULL,
   						 `goodname_jp` varchar(255) DEFAULT NULL,
   						 `goodname_cn` varchar(255) DEFAULT NULL,
   						 `goodname_de` varchar(255) DEFAULT NULL,
   						 `goodname_fr` varchar(255) DEFAULT NULL,
    					 `goodname_sp` varchar(255) DEFAULT NULL,
   						 `goodname_pt` varchar(255) DEFAULT NULL,
    					 `goodname_ru` varchar(255) DEFAULT NULL,
   						 `goodname_ar` varchar(255) DEFAULT NULL,
   						 `subtitle_ko` varchar(255) DEFAULT NULL,
   						 `subtitle_en` varchar(255) DEFAULT NULL,
   						 `subtitle_jp` varchar(255) DEFAULT NULL,
   						 `subtitle_cn` varchar(255) DEFAULT NULL,
   						 `subtitle_de` varchar(255) DEFAULT NULL,
   						 `subtitle_fr` varchar(255) DEFAULT NULL,
   						 `subtitle_sp` varchar(255) DEFAULT NULL,
   						 `subtitle_pt` varchar(255) DEFAULT NULL,
    					 `subtitle_ru` varchar(255) DEFAULT NULL,
   						 `subtitle_ar` varchar(255) DEFAULT NULL,
   						 `enable` varchar(20) DEFAULT NULL,
   						 `num` varchar(20) DEFAULT NULL,
   						 PRIMARY KEY (`Id`)
  						) ENGINE=MyISAM  DEFAULT CHARSET=utf8";		
				mysql_db_query($mysql_dbname,$query,$connect); 
  				*/
  				
			}    						    			
    						    			
    		// echo "<meta http-equiv='refresh' content='0; url=admin_country.php'>";
    		page_back2();
    	

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
		
?>

