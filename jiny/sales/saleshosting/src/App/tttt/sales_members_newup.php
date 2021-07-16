<?
	@session_start();
	
	include "./dbinfo.php";
		$connect = mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

		include "language.php"; //# 사이트 언어, 지역 설정
		include "mobile.php";
	
		include "./func_skin.php"; //# 스킨 레이아웃 함수들...
		include "./func_files.php"; 
		include "./func_datetime.php";
		include "./func_javascript.php";
		include "./func_log.php";
	
		include "./func_string.php";
		
		include "./func_mysql.php";
	
	
	
	if($_SESSION['nonce'] != $_POST['nonce']){
		$_SESSION['nonce'] = NULL;	
	} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능
		
		
		
		
		////////////////////////////////////////////////////////////////
	
		
		$company = $_POST['company'];
		$biznumber = $_POST['biznumber']; $biznumber = str_replace("-","",$biznumber);
		$president = $_POST['president']; 
		$post = $_POST['post'];
		$address = $_POST['address']; 
		$subject = $_POST['subject']; 
		$item = $_POST['item'];
    					
		$tel = $_POST['tel']; 
		$fax = $_POST['fax']; 
		$phone = $_POST['phone']; $phone = str_replace("-","",$phone);
		$email = $_POST['email']; 
		$manager = $_POST['manager'];
		$password = $_POST['password'];
	
		$memtype = $_POST['memtype']; 
		
		$country = $_POST['country1']; 
		$language = $_POST['language1']; 
		
		$currency = $_POST['currency']; 
		$taxrate = $_POST['taxrate']; 
	
		if(!$email) msg_alert("오류! 이메일이 없습니다.");
		else if(!$manager) msg_alert("오류! 담당자명이 없습니다.");
		else if(!$password) msg_alert("비밀번호 없습니다.");
		else {
		
			$query = "select * from sales_members where email = '$email'";
			// echo $query."<br>";
			$result = mysql_db_query($mysql_dbname,$query,$connect);
			// echo "$result <br>";
			if( mysql_num_rows($result) ) $msg = "$email 는 이미 등록된 회원 입니다.<br>";
			
			if($biznumber){
				$query = "select * from sales_members  where biznumber = '$biznumber'";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_num_rows($result) ) $msg .= "사업자번호 $biznumber는 기등록된 번호입니다.<br>";
			}
		
		
			if($msg){
				/////////////////////////////////////
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
				$body = shopskin("sales_member_error"); 
				$body = str_replace("{msg}","$msg",$body);
				$body = str_replace("{regist}",skin_button("회원가입","sales_members_agree.php"),$body);
		
			} else {
				
				//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
				$query = "select * from `sales_server` where mainserver = 'on'";
				//echo $query."<br>";
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_num_rows($result) )	{
					$server = mysql_fetch_array($result);
					$dbconnect = mysql_connect($server[ip],$server[userid],$server[password],TRUE);		
				} else {
					$dbconnect = $connect;
					$server[dbname] = $mysql_dbname;
				}
				
				
			
			
				if($biznumber){ 
					$query = "INSERT INTO `sales_members` (`regdate`, `server`, `password`, `email`, `tel`, `fax`, `manager`, `phone`, `bizmenu`) 
    			 	 VALUES ('$TODAYTIME', '$server[Id]', '$password', '$email', '$tel', '$fax', '$manager', '$phone', 'default')";
    				//echo $query."<br>";
    				mysql_db_query($mysql_dbname,$query,$connect);
						
					$query = "UPDATE `sales_members` SET `company`='$company', `biznumber`='$biznumber', `president`='$president', `post`='$post', `address`='$address', 
    							`item`='$item', `subject`='$subject' WHERE `albacode`='$mcode'";			
    				//echo $query."<br>";
    				mysql_db_query($mysql_dbname,$query,$connect);
    					
				} else {
					// 개인 정보만 입력하고 회원 가입하는 경우 처리
					$query = "INSERT INTO `sales_members` (`regdate`, `server`, `password`, `email`, `tel`, `fax`, `manager`, `phone`, `bizmenu`) 
    			  	VALUES ('$TODAYTIME', '$server[Id]', '$password', '$email', '$tel', '$fax', '$manager', '$phone', 'default')";
    				//echo $query."<br>";
    				mysql_db_query($mysql_dbname,$query,$connect);
    		
    				$query = "UPDATE `sales_members` SET `company`='$company', `president`='$president', `post`='$post', `address`='$address', 
    						`item`='$item', `subject`='$subject' WHERE `albacode`='$mcode'";			
    				//echo $query."<br>";
    				mysql_db_query($mysql_dbname,$query,$connect);
				
				}
				
				//# 신규가입 : 무료회원으로 등록됨
				$expire = date('Y-m-d', strtotime("+90 days"));
				$query = "UPDATE `sales_members` SET `memtype`='free', `expire`='$expire', `maxcompany`='20', `maxtrans`='100', `maxid`='0', `resellerpoint`='0' WHERE `email`='$email'";			
    			//echo $query."<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
		
				//# 안드로이드폰 : 회원가입시, 기기 등록
				$query = "UPDATE `sales_members` SET `DEVICE`='$_COOKIE[DEVICEID]' WHERE `email`='$email'";			
    			//echo $query."<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
    		
    			//# 상위, 리셀러 판매자 정보 등록
    			$query = "UPDATE `sales_members` SET `reseller`='infohojin@naver.com', `resellerpoint`='100000', `resellerauth`='on' WHERE `email`='$email'";			
    			//echo $query."<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
    		
    			//# 국가 및 언어 설정.
    			$query = "UPDATE `sales_members` SET `country`='$country1', `language`='$language1', `currency`='$currency', `taxrate`='$taxrate' WHERE `email`='$email'";			
    			//echo $query."<br>";
    			mysql_db_query($mysql_dbname,$query,$connect);
				//echo "$mysql_dbname, $query, $connect <br>";
			
				//# 기본 직원 아이디 등록
				$query = "select * from `sales_members` where email = '$email'";
    			//echo $query."<br>";
    			//echo "$mysql_dbname, $query, $connect <br>";
    			$result = mysql_db_query($mysql_dbname,$query,$connect);
				// if( mysql_affected_rows() ){ 
				if( mysql_num_rows($result) ){ 
					$MEM=mysql_fetch_array($result);
					$query = "INSERT INTO sales_manager (`regdate`, `members_id`, `part`, `name`, `email`, `password`, `fax`, `phone`, `mobile`,`memo`,`master`) 
    								VALUES ('$TODAY', '$MEM[Id]', '$part', '$manager', '$email', '$password', '$fax', '$tel', '$phone', '$comment', 'on')";
    				//echo $query."<br>";
    				mysql_db_query($mysql_dbname,$query,$connect);	
				}
				
				////////////////////////////////
				//# 테이블 생성...
				
				//# 신규 회원코드 번호 생성
				$query = "select * from `sales_members` where `email`='$email'";
    			//echo $query."<br>";
    			$result = mysql_db_query($mysql_dbname,$query,$connect);
    			// if( mysql_affected_rows() ){ 
    			if( mysql_num_rows($result) ){ 
					$rows=mysql_fetch_array($result);
					$mcode =$rows[Id];
				}
				
				
				//# 거래처 테이블
				$query = "CREATE TABLE `sales_company_$mcode` (
  					`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 					`regdate` date DEFAULT NULL,
 					`regcode` varchar(20) DEFAULT NULL,
 					`mem` varchar(20) DEFAULT NULL,
 					`inout` varchar(20) DEFAULT NULL,
 					`country` varchar(255) DEFAULT NULL,
 					`company` varchar(255) DEFAULT NULL,
 					`biznumber` varchar(20) DEFAULT NULL,
 					`president` varchar(20) DEFAULT NULL,
 					`post` varchar(10) DEFAULT NULL,
  					`address` varchar(255) DEFAULT NULL,
  					`subject` varchar(255) DEFAULT NULL,
  					`item` varchar(255) DEFAULT NULL,
  					`currency` varchar(255) DEFAULT NULL,
  					`balance1` varchar(20) DEFAULT NULL,
  					`balance2` varchar(20) DEFAULT NULL,
  					`limitation` varchar(20) DEFAULT NULL,
  					`comment` text,
  					`email` varchar(255) DEFAULT NULL,
  					`tel` varchar(20) DEFAULT NULL,
  					`fax` varchar(20) DEFAULT NULL,
 					`phone` varchar(20) DEFAULT NULL,
 					`manager` varchar(20) DEFAULT NULL,
   					`group` varchar(255) DEFAULT NULL,
  					`discount` varchar(10) DEFAULT NULL,
  					`vat` varchar(10) DEFAULT NULL,
  					`vatrate` varchar(20) DEFAULT NULL,
  					`hosting` varchar(10) DEFAULT NULL,
  					`auth` varchar(10) DEFAULT NULL,
  					PRIMARY KEY (`Id`)
 					) ENGINE=InnoDB";		
    			// mysql_db_query($mysql_dbname,$query,$connect);
    			//echo $query."<br>";
    			mysql_db_query($server[dbname],$query,$dbconnect);	
    
    	
    			//# 상품 테이블
    			$query = "CREATE TABLE `sales_goods_$mcode` (
  				 `Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 				 `regdate` date DEFAULT NULL,
				 `mem` varchar(20) DEFAULT NULL,
				 `GOODID` varchar(20) DEFAULT NULL,
				 `goodcode` varchar(20) DEFAULT NULL,
				 `name` varchar(255) DEFAULT NULL,
				 `option` varchar(255) DEFAULT NULL,
				 `model` varchar(255) DEFAULT NULL,
				 `brand` varchar(255) DEFAULT NULL,
 				 `cate` varchar(255) DEFAULT NULL,
  				 `CID` int(11) DEFAULT NULL,
  				 `COMPANYID` varchar(255) DEFAULT NULL,
 				 `company` varchar(255) DEFAULT NULL,
 				 `barcode` varchar(20) DEFAULT NULL,
 				 `currency` varchar(255) DEFAULT NULL,
 				 `prices` varchar(20) DEFAULT NULL,
 				 `prices_buy` varchar(20) DEFAULT NULL,
				 `prices_sell` varchar(20) DEFAULT NULL,
 				 `images` varchar(255) DEFAULT NULL,
				 `vat` varchar(20) DEFAULT NULL,
 				 `stock` varchar(20) DEFAULT NULL,
 				 `sales` varchar(20) DEFAULT NULL,
 				 `exsales` varchar(20) DEFAULT NULL,
 				 `description` text,
				 `click` int(10) DEFAULT NULL,
 				 `pos` int(11) DEFAULT NULL,
 				 `nonce` varchar(255) DEFAULT NULL,
 				 `trans` varchar(20) DEFAULT NULL,
 				 `margin` varchar(20) DEFAULT NULL,
 				 `supply_prices` varchar(20) DEFAULT NULL,
 				 `autodelivery` varchar(20) DEFAULT NULL,
 				 `autoorder` varchar(20) DEFAULT NULL,
 				 `exnote` text,
 				 `auth` varchar(10) DEFAULT NULL,
 				 
 				 `bom` varchar(20) DEFAULT NULL,
 				 `bom_parts` text,
 				 
 				 `b2b` varchar(255) DEFAULT NULL,
 				 `b2b_prices` varchar(255) DEFAULT NULL,
 				 `b2b_users` text,
 				 
 				 PRIMARY KEY (`Id`)
				 ) ENGINE=InnoDB";
				// mysql_db_query($mysql_dbname,$query,$connect);
				//echo $query."<br>";
				mysql_db_query($server[dbname],$query,$dbconnect);
				
				//# 전표관리 테이블
				$query = "CREATE TABLE `sales_trans_$mcode` (
 				 `Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 				 `regdate` datetime DEFAULT NULL,
 				 
 				 `transdate` date DEFAULT NULL,
				 `memid` varchar(20) DEFAULT NULL,
				 
				 `trans` varchar(20) DEFAULT NULL,					
				 
				 `UIDA` varchar(20) DEFAULT NULL,					
				 `UIDB` varchar(20) DEFAULT NULL,					
				 `companyB` varchar(255) DEFAULT NULL,				
				 
				 `goods` int(11) DEFAULT NULL,						
				 `goodname` varchar(255) DEFAULT NULL,				
				 `spec` varchar(20) DEFAULT NULL,				
				 `num` int(11) DEFAULT NULL,					
				 `currency` varchar(255) DEFAULT NULL,			
				 `prices` varchar(20) DEFAULT NULL,				
				 `vat` varchar(20) DEFAULT NULL,					
				 `discount` varchar(20) DEFAULT NULL,				
				 `prices_sum` varchar(20) DEFAULT NULL,				
				 `prices_total` varchar(20) DEFAULT NULL,
				 
				 `warehouse` varchar(20) DEFAULT NULL,			
				 
				 `pay` varchar(255) DEFAULT NULL,
				 `payment` varchar(20) DEFAULT NULL,
				 `paydate` date DEFAULT NULL,
				 `paymoney` varchar(20) DEFAULT NULL,
				 `paymemo` text ,
				 
				 `comment` text ,
				 `invoicedate` date DEFAULT NULL,
				 `invoicemethod` varchar(20) DEFAULT NULL,
				 `invoicecompany` varchar(20) DEFAULT NULL,
				 `invoice` varchar(20) DEFAULT NULL,
				 `invoicemanager` varchar(20) DEFAULT NULL,
				 `TIDA` int(11) DEFAULT NULL,
				 `nonce` varchar(255) DEFAULT NULL,
				 `status` varchar(20) DEFAULT NULL,
				 
				 `report` varchar(255) DEFAULT NULL,
				 `report_date` varchar(255) DEFAULT NULL,
				 
				 `taxprint` varchar(20) DEFAULT NULL,
				 `balance1` varchar(20) DEFAULT NULL,
				 `balance2` varchar(20) DEFAULT NULL,
				 `manager` varchar(255) DEFAULT NULL,
				 
				 `expert` varchar(20) DEFAULT NULL,
				 `auth` varchar(20) DEFAULT NULL,
				 PRIMARY KEY (`Id`)
				 ) ENGINE=InnoDB";
				// mysql_db_query($mysql_dbname,$query,$connect);
				//echo $query."<br>";
				mysql_db_query($server[dbname],$query,$dbconnect);
			
				/*
				$query = "CREATE TABLE `sales_board_$mcode` (
  						`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  						`regdate` datetime DEFAULT NULL,
 						`albacode` varchar(20) DEFAULT NULL,
  						`code` varchar(20) DEFAULT NULL,
 						`title` varchar(255) DEFAULT NULL,
  						`content` text,
  						`reply` text,
  						`click` int(11) DEFAULT NULL,
  						PRIMARY KEY (`Id`)
					) ENGINE=InnoDB ";
				// mysql_db_query($mysql_dbname,$query,$connect);
				//echo $query."<br>";
				mysql_db_query($server[dbname],$query,$dbconnect);
				*/
			
				$query = "CREATE TABLE `sales_quotation_$mcode` (
  						`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 						 `regdate` datetime DEFAULT NULL,
 						 `title` varchar(255) DEFAULT NULL,
 						 `com` varchar(10) DEFAULT NULL,
 						 `companyName` varchar(255) DEFAULT NULL,
 						 `biznumber` varchar(20) DEFAULT NULL,
 						 `president` varchar(255) DEFAULT NULL,
 						 `post` varchar(10) DEFAULT NULL,
						 `address` varchar(255) DEFAULT NULL,
						 `subject` varchar(255) DEFAULT NULL,
 						 `item` varchar(255) DEFAULT NULL,
 						 `country` varchar(255) DEFAULT NULL,
						 `currency` varchar(255) DEFAULT NULL,
 						 `vat` varchar(20) DEFAULT NULL,
  						`vatrate` varchar(20) DEFAULT NULL,
  						`status` varchar(30) DEFAULT NULL,
  						`quoPrices` varchar(30) DEFAULT NULL,
 						 `email` varchar(255) DEFAULT NULL,
 						 `manager` varchar(255) DEFAULT NULL,
 						 `phone` varchar(255) DEFAULT NULL,
 						 `fax` varchar(255) DEFAULT NULL,
						  `newQuotation` varchar(255) DEFAULT NULL,
						 `quo` varchar(255) DEFAULT NULL,
							 PRIMARY KEY (`Id`)
						) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
				// mysql_db_query($mysql_dbname,$query,$connect);
				//echo $query."<br>";
				mysql_db_query($server[dbname],$query,$dbconnect);
	
				$query = "CREATE TABLE `sales_b2b_$mcode` (
  							`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  							`regdate` varchar(20) DEFAULT NULL,
  							`type` varchar(10) DEFAULT NULL,
  							`mem` varchar(11) DEFAULT NULL,
  							`b2b` varchar(11) DEFAULT NULL,
  							`GID` varchar(10) DEFAULT NULL,
  							`auth` varchar(10) DEFAULT NULL,
  							`goodname` varchar(255) DEFAULT NULL,
  							`spec` varchar(255) DEFAULT NULL,
  							`prices_sell` varchar(20) DEFAULT NULL,
  							`prices_buy` varchar(20) DEFAULT NULL,
  							`images` varchar(255) DEFAULT NULL,
  							PRIMARY KEY (`Id`)
							) ENGINE=InnoDB ;";
				// mysql_db_query($mysql_dbname,$query,$connect);
				//echo $query."<br>";
				mysql_db_query($server[dbname],$query,$dbconnect);


				$query = "CREATE TABLE `sales_bom_$mcode` (
  							`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  							`regdate` varchar(20) DEFAULT NULL,
  							`type` varchar(10) DEFAULT NULL,
  							`GID` varchar(11) DEFAULT NULL,
  							`num` varchar(11) DEFAULT NULL,
  							PRIMARY KEY (`Id`)
							) ENGINE=InnoDB ;";
				// mysql_db_query($mysql_dbname,$query,$connect);
				//echo $query."<br>";
				mysql_db_query($server[dbname],$query,$dbconnect);


				//////////////////////////////////////////////////////////////
				// 환율정보 테이블

				$query "CREATE TABLE `sales_currency_$mcode` (
 						 `Id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  						`currency` varchar(20) DEFAULT NULL,
  						`currencyid` varchar(4) DEFAULT NULL,
  						`name` varchar(255) DEFAULT NULL,
  						`enable` varchar(20) DEFAULT NULL,
  						`currency_align` varchar(255) DEFAULT NULL,
  						`currency_mark` varchar(255) DEFAULT NULL,
  						`currency_rate` varchar(255) DEFAULT NULL,
  						`dec_point` int(4) DEFAULT NULL,
  						PRIMARY KEY (`Id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
				mysql_db_query($server[dbname],$query,$dbconnect);

				$query = "INSERT INTO `sales_currency_$mcode` (`Id`, `currency`, `currencyid`, `name`, `enable`, `currency_align`, `currency_mark`, `currency_rate`, `dec_point`) VALUES
							(1, 'KRW', '410', 'Korea Won', 'on', 'right', '원', '1250', 0),
							(2, 'USD', '840', 'US Dollar', 'on', 'left', '$', '1', 2),
							(3, 'EUR', '978', 'Euro', 'on', '', '', '1300', 0),
							(4, 'GBP', '826', 'Pounds Sterling', NULL, NULL, NULL, NULL, NULL),
							(5, 'JPY', '392', 'Japan Yen', 'on', NULL, NULL, NULL, NULL),
							(6, 'THB', '764', 'Thailand Baht', NULL, NULL, NULL, NULL, NULL),
							(7, 'SGD', '702', 'Singapore Doller', 'on', NULL, NULL, NULL, NULL),
							(8, 'RUB', '643', 'Russia Ruble', NULL, NULL, NULL, NULL, NULL),
							(9, 'HKD', '344', 'Hong Kong Dollars', NULL, NULL, NULL, NULL, NULL),
							(10, 'CAD', '124', 'Canadian Dollars', NULL, NULL, NULL, NULL, NULL),
							(11, 'AUD', '036', 'Australian Dollars', '', NULL, NULL, NULL, NULL);";
				mysql_db_query($server[dbname],$query,$dbconnect);
				
				


				// GCM_SenderByPhone("01039113106","신규회원등록:$company $manager 신규회원가입!","sales",$mysql_dbname,$connect);
				// GCM_SenderByDEVICEID($_COOKIE[DEVICEID],"서비스가입 감사합니다:거래처와 함께 사용하시면 많은 전표입력이 자동!","sales",$mysql_dbname,$connect);
			
			
			
			
			
				/////////////////////////////////////
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
				$body = shopskin("sales_member_ok"); 
		
				$body = str_replace("{email}","$email",$body);
				$body = str_replace("{manager}","$manager",$body);
				$body = str_replace("{password}","$password",$body);
		
				$body = str_replace("{login}",skin_button("로그인","sales_login.php"),$body); 
				
				
			}
		
		
		}
		
	
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;		
		
		
		////////////////////////////////////////////////////////////////
		
			
	} ///// ##### SESSION END ##### /////
	
	mysql_close($connect);
	mysql_close($dbconnect);
	
?>

