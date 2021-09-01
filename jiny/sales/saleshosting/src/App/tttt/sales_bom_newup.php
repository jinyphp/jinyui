<?
	@session_start();
	if($_SESSION['nonce'] != $_POST['nonce']){
		$_SESSION['nonce'] = NULL;	
	} else {
		///////////////////////////
		// 섹션 중복처리 방지 기능

		include "./dbinfo.php";
		$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

		include "language.php"; //# 사이트 언어, 지역 설정
		include "mobile.php";
	
		include "./func_skin.php"; //# 스킨 레이아웃 함수들...
		include "./func_files.php"; 
		include "./func_datetime.php";
		include "./func_javascript.php";
		include "./func_log.php";
	
		include "./func_string.php";
	
		include "thumbnail.php";
		
		if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
		else { //////////////////////////////////////////
		
			$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    		// echo $query; 
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_num_rows($result) ){ 
				$MEM=mysql_fetch_array($result);
				
				//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
				$query = "select * from `sales_server` where Id = '$MEM[server]'";
    			$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_num_rows($result) )	{
					$server=mysql_fetch_array($result);
					$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
				} else {
					$dbconnect = $connect;
					$server[dbname] = $mysql_dbname;
				}

		
				//////////////////////////////////////////////////////////////////
			
    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    			$REF = $_GET['REF']; if(!$REF) $REF = $_POST['REF'];

    			// 상품이미지 등록
    			if ($_FILES["userfile1"][tmp_name]){
    				
    				if(!is_dir("./goodimg")) $an = mkdir("./goodimg");
    				if(!is_dir("./goodimg/$MEM[Id]")) $an = mkdir("./goodimg/$MEM[Id]");
  			
					$uploadfile1  = "./goodimg/$MEM[Id]/".$_FILES[userfile1][name];
					
					$i=1;
					if ($_FILES["userfile".$i][tmp_name]) {
   						$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); //확장자 추출
   						if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") {
      					print "<script>alert('업로드 불가 파일입니다.'); history.back();</script>";
      					exit; //php 파일 업로드 제한
   						} 
   					}	
						
					$FName = $MEM[Id]."-".$UID;
					if ($_FILES["userfile1"][tmp_name]) $filename1 = "./goodimg/$MEM[Id]/$FName.$ext";
		
						
      				if ($_FILES["userfile".$i][tmp_name]) {
      					// ${"uploadfile".$i}
         				move_uploaded_file($_FILES["userfile".$i][tmp_name], "./goodimg/$MEM[Id]/$FName.$ext");
         				//업로드 임시파일을 원하는 위치로 이동. 이것이 곧 업로드의 핵심.
      				}
      							
      				thumbnail_squre($filename1,$filename1.".jpg","50","50");      						
    			}
    	
    	
    			//////////////////////////////////////
    			$goodcode = $_POST['goodcode'];
    			$name = $_POST['name'];
    			$model = $_POST['model'];
    			$brand = $_POST['brand'];
    			$barcode = $_POST['barcode'];
    			$cate1 = $_POST['cate1'];
    			$cate = $_POST['cate']; if($cate1 && !$cate) $cate = $cate1;
    					
    			$company1 = $_POST['company1'];
    			$company = $_POST['company']; if($company1 && !$company) $company = $company1;
				
    			$prices_buy = $_POST['prices_buy'];
    			$prices_sell = $_POST['prices_sell'];
    			$vat = $_POST['vat'];
    			$stock = $_POST['stock'];
    			$description = $_POST['description'];
    			$nonce = $_POST['nonce'];
    			$company = $_POST['company'];
    					
    			$exsales = $_POST['exsales'];
    	
    	
    			if($name){
    						    						
    				$query ="INSERT INTO `sales_goods_$MEM[Id]` (`regdate`, `mem`, `GOODID`, `goodcode`, `name`, `model`, `brand`, `cate`, `CID`, `company`, `barcode`, `prices_buy`, `prices_sell`, `images`, `vat`, `stock`, `sales`, `exsales`, `description`, `click`, `pos`,`nonce`,`bom`) 
    						VALUES ('$TODAY', '$MEM[Id]', '', '$goodcode', '$name', '$model', '$brand', '$cate', '$company', '$company1', '$barcode', '$prices_buy', '$prices_sell', '$filename1', '$vat', '$stock', '0', '$exsales', '$comment', 0, 0, '$nonce', 'bom')";
    				// echo $query."<br>";
    				// mysql_db_query($mysql_dbname,$query,$connect);
    				mysql_db_query($server[dbname],$query,$dbconnect);
    						
    				$query = "select * from `sales_goods_$MEM[Id]` where name = '$name' and nonce = '$nonce' order by Id desc";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
    				if( mysql_num_rows($result) ) {
    					$good_ID=mysql_fetch_array($result);
    							
    					$query = "UPDATE `sales_goods_$MEM[Id]` SET `GOODID`='$MEM[Id]-$good_ID[Id]' WHERE `Id`='$good_ID[Id]'";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    				}
    						
    				
    				//# 거래처 지정시, 상대거래처에 내상품 등록
					if($company){
						$query = "select * from sales_company_$MEM[Id] where Id = '$company'";
						// $result=mysql_db_query($mysql_dbname,$query,$connect);
						$result=mysql_db_query($server[dbname],$query,$dbconnect);
						if( mysql_num_rows($result) ){
							$rows=mysql_fetch_array($result);

							$query = "select * from sales_members where Id = '$rows[mem]'";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if( mysql_num_rows($result) ){
								//# 같은 서비스를 받고 있는 회원.
								$COM = mysql_fetch_array($result);
								
								// 거래처 DB접속 정보 
								$query = "select * from `sales_server` where Id = '$COM[server]'";
    							$result=mysql_db_query($mysql_dbname,$query,$connect);
								if( mysql_num_rows($result) )	{
									$_server=mysql_fetch_array($result);
									$_dbconnect=mysql_connect($_server[ip],$_server[userid],$_server[password]) or die("user database can not connect.");
								}
							
								$query = "select * from `sales_goods_$COM[Id]` where GOODID = '$MEM[Id]-$good_ID[Id]'";
								// $result=mysql_db_query($mysql_dbname,$query,$connect);
								$result=mysql_db_query($_server[dbname],$query,$_dbconnect);
								if( mysql_num_rows($result) ){
									// 상품 중복 등록. 갱신요청
								} else {
								
									$query ="INSERT INTO `sales_goods_$COM[Id]` (`regdate`, `mem`, `GOODID`, `goodcode`, `name`, `model`, `brand`, `cate`, `barcode`, `images`, `prices_sell`, `vat`, `sales`, `description`, `click`, `pos`,`nonce`) 
    									VALUES ('$TODAY', '$MEM[Id]', '$MEM[Id]-$good_ID[Id]', '$goodcode', '$name', '$model', '$brand', '$cate', '$barcode', '$filename1', '$prices_buy', '$vat', '0', '$comment', 0, 0, '$nonce')";
    								// mysql_db_query($mysql_dbname,$query,$connect);
    								mysql_db_query($_server[dbname],$query,$_dbconnect);
    							}
    							
    							
    							
							}
						
						}
					}
	
    						
    					

					/*
					//////////////////////
					// 바코드 DB 설정 및 저장
					if($barcode){
						$query = "select * from sales_goods_barcode where barcode='$barcode'";
						$result=mysql_db_query($mysql_dbname,$query,$connect);
    					if( mysql_num_rows($result) ) {
    						$rows=mysql_fetch_array($result);
    								
    						if(!$rows[images] && $filename1 ){
    							$query1 = "UPDATE `sales_goods_barcode` SET `images`='$filename1' WHERE `barcode`='$barcode'";
    							mysql_db_query($mysql_dbname,$query1,$connect);
    						}
    								
    						if(!$rows[brand] && $brand ){
    							$query1 = "UPDATE `sales_goods_barcode` SET `brand`='$brand' WHERE `barcode`='$barcode'";
    							mysql_db_query($mysql_dbname,$query1,$connect);
    						}

								
						} else {
							$query1 = "INSERT INTO `sales_goods_barcode` (`regdate`, `albacode`, `barcode`, `brand`, `name`, `images`, `scribe`) VALUES ('$TODAYTIME', '$ALBA[albacode]', '$barcode', '$brand', '$name', '$filename1','$ALBA[albacode]:')";
							mysql_db_query($mysql_dbname,$query1,$connect);
						}
							
					}
					*/		
							
							
    		
    			} else msg_alert("오류! 제품명 없습니다.");
    			
    			page_back2();	
		
				//////////////////////////////////////////////////////////////////		
		
			} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
	
		}
	

	} ///// ##### SESSION END ##### /////
	
	mysql_close($connect);
	mysql_close($dbconnect);	

?>

