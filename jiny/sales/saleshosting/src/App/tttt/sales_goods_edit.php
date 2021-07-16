<?
	@session_start();
	
	
	
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; 
	include "mobile.php";
	
	include "./func_skin.php"; 
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	include "thumbnail.php";
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ){
		$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";     
	} else { //////////////////////////////////////////
	

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(  mysql_num_rows($result)  ){ 
			$MEM=mysql_fetch_array($result);
		
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(  mysql_num_rows($result)  )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}


			//////////////////////////////////////////////////////////////////
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    		
    		
    		switch($mode){
    			case 'del':
    				$query = "select * from sales_trans_$MEM[Id] where goods = '$UID' ";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ) $FlagTRANS = FALSE; else $FlagTRANS = TRUE;
    					
    				if($FlagTRANS){
    					$query = "DELETE FROM `sales_goods_$MEM[Id]` WHERE `Id`='$UID'";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    						
    					//$query = "DELETE FROM `sales_goods` WHERE `GOODID`='$ALBA[albacode]-$UID'";
    					//mysql_db_query($mysql_dbname,$query,$connect);
    						
    				} else msg_alert("거래 내역이 있는 상품은 삭제가 되지 않습니다.");
    				
    				echo "<script> history.go(-2); </script>";
    				
    				break;
    			case 'editup':
    				$b2b = $_POST['b2b'];
    				$b2b_prices = $_POST['b2b_prices'];    				
    					
    				$goodcode = $_POST['goodcode'];
    				$name = $_POST['name'];
    				$model = $_POST['model'];
    				$brand = $_POST['brand'];
    				$barcode = $_POST['barcode'];
    				$cate = $_POST['cate'];
    				$company = $_POST['company'];
    				$company1 = $_POST['company1'];
    				$prices_buy = $_POST['prices_buy'];
    				$prices_sell = $_POST['prices_sell'];
    				$vat = $_POST['vat'];
    				$stock = $_POST['stock'];
    				$description = $_POST['description'];
    			
    				if(!$name) msg_alert("상품명이 없습니다.");
					else {
						
    					$query = "UPDATE `sales_goods_$MEM[Id]` SET `goodcode`='$goodcode', `name`='$name', `model`='$model', `brand`='$brand', `cate`='$cate', 
    										`CID`='$company',`company`='$company1', `exsales`='$exsales', `barcode`='$barcode', `prices_buy`='$prices_buy', `prices_sell`='$prices_sell', 
    										`vat`='$vat', `stock`='$stock', `description`='$description' WHERE `Id`='$UID'";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    				
    					//////////////////////////////////////////////////////////////////////
    					if ($_FILES["userfile1"][tmp_name]){

    						if(!is_dir("./goodimg")) $an = mkdir("./goodimg");
    						if(!is_dir("./goodimg/$MEM[Id]")) $an = mkdir("./goodimg/$MEM[Id]");
  			
							$uploadfile1  = "../goodimg/$MEM[Id]/".$_FILES[userfile1][name];
					
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
      						
      						
      						$query = "UPDATE `sales_goods_$MEM[Id]` SET `images`='$filename1' WHERE `Id`='$UID'";
    						// mysql_db_query($mysql_dbname,$query,$connect);
    						mysql_db_query($server[dbname],$query,$dbconnect);
      					}
      					
      					
    				
    				
    				
    					//# 거래처 지정시, 상대거래처에 내상품 등록
						if($company){
							$query = "select * from sales_company_$MEM[Id] where Id = '$company'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if(  mysql_num_rows($result)  ){
								$rows=mysql_fetch_array($result);

								$query = "select * from sales_members where Id = '$rows[mem]'";
								$result=mysql_db_query($mysql_dbname,$query,$connect);
								if(  mysql_num_rows($result)  ){
									//# 같은 서비스를 받고 있는 회원.
									$COM = mysql_fetch_array($result);
								
									// 거래처 DB접속 정보 
									$query = "select * from `sales_server` where Id = '$COM[server]'";
    								$result=mysql_db_query($mysql_dbname,$query,$connect);
									if(  mysql_num_rows($result)  )	{
										$_server=mysql_fetch_array($result);
										$_dbconnect=mysql_connect($_server[ip],$_server[userid],$_server[password]) or die("user database can not connect.");
									}

								
								
									$query = "select * from `sales_goods_$COM[Id]` where GOODID = '$MEM[Id]-$good_ID[Id]'";
									// $result=mysql_db_query($mysql_dbname,$query,$connect);
									$result=mysql_db_query($_server[dbname],$query,$_dbconnect);
									if(  mysql_num_rows($result)  ){
									// 상품 중복 등록. 갱신요청
										/*
										$query = "UPDATE `sales_goods_$COM[Id]` SET `goodcode`='$goodcode', `name`='$name', `model`='$model', `brand`='$brand', `cate`='$cate', 
    										`vat`='$vat', WHERE GOODID = '$MEM[Id]-$good_ID[Id]'";
    									mysql_db_query($mysql_dbname,$query,$connect);
    									*/
									} else {
								
										$query ="INSERT INTO `sales_goods_$COM[Id]` (`regdate`, `mem`, `GOODID`, `goodcode`, `name`, `model`, `brand`, `cate`, `barcode`, `images`, `prices_sell`, `vat`, `sales`, `description`, `click`, `pos`,`nonce`) 
    									VALUES ('$TODAY', '$MEM[Id]', '$MEM[Id]-$good_ID[Id]', '$goodcode', '$name', '$model', '$brand', '$cate', '$barcode', '$filename1', '$prices_buy', '$vat', '0', '$comment', 0, 0, '$nonce')";
    									// mysql_db_query($mysql_dbname,$query,$connect);
    									mysql_db_query($_server[dbname],$query,$_dbconnect);
    								}
    							
								}
						
							}
						}
    					/////////////
    				
    					if($b2b){
							$query = "UPDATE `sales_goods_$MEM[Id]` SET `b2b`='$b2b', `b2b_prices`='$b2b_prices' WHERE `Id`='$UID'";
    						// mysql_db_query($mysql_dbname,$query,$connect);
    						mysql_db_query($server[dbname],$query,$dbconnect);
    						//echo $query."<br>";
    						
    						if(!$filename1){
    							$query = "select * from `sales_goods_$MEM[Id]` where Id = '$UID'";
								// $result=mysql_db_query($mysql_dbname,$query,$connect);
								$result=mysql_db_query($server[dbname],$query,$dbconnect);
								if(  mysql_num_rows($result)  ) $rows=mysql_fetch_array($result);
								
								$filename1 = $rows[images];
    						}
    						
    						$query = "select * from `sales_b2b` where mem = '$MEM[Id]' and GID='$UID'";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if(  mysql_num_rows($result)  ){
								// 정보수정
								$query = "UPDATE `sales_b2b` SET `images`='$filename1', `name`='$name', `model`='$model', `brand`='$brand', 
    								`cate`='$cate', `barcode`='$barcode', `prices_buy`='$b2b_prices', `prices_sell`='$prices_sell', `vat`='$vat', 
    								`stock`='$stock', `description`='$description', `b2b`='$b2b' where mem = '$MEM[Id]' and GID='$UID'";
								mysql_db_query($mysql_dbname,$query,$connect);
							} else {
								// 신규삽입
    							$query = "INSERT INTO `sales_b2b` (`regdate`, `mem`, `GID`, `images`, `name`, `model`, `brand`, 
    								`cate`, `barcode`, `prices_buy`, `prices_sell`, `vat`, `stock`, `description`, `b2b`) 
    								VALUES ('$TODAY', '$MEM[Id]', '$UID', '$filename1', '$name', '$model', '$brand', 
    								'$cate', '$barcode', '$b2b_prices', '$prices_sell', '$vat', '$stock', '$description', '$b2b');";
    							mysql_db_query($mysql_dbname,$query,$connect);	
    						}
						} else {
							$query = "UPDATE `sales_goods_$MEM[Id]` SET `b2b`='$b2b' WHERE `Id`='$UID'";
    						// mysql_db_query($mysql_dbname,$query,$connect);
    						mysql_db_query($server[dbname],$query,$dbconnect);
    						//echo $query."<br>";
    						
    						$query = "UPDATE `sales_b2b` SET `b2b`='$b2b' where mem = '$MEM[Id]' and GID='$UID'";
							mysql_db_query($mysql_dbname,$query,$connect);
    						
						}
						
						///////////////
    					//////////////////////
						// 바코드 DB 설정 및 저장
						if($barcode){
							$query = "select * from sales_barcode where barcode='$barcode'";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
    						if( mysql_num_rows($result) ) {
    							$rows=mysql_fetch_array($result);

    							if(!$rows[images] && $filename1 ){
    								$query1 = "UPDATE `sales_barcode` SET `images`='$filename1' WHERE `barcode`='$barcode'";
    								mysql_db_query($mysql_dbname,$query1,$connect);
    							}
    								
    							if(!$rows[brand] && $brand ){
    								$query1 = "UPDATE `sales_barcode` SET `brand`='$brand' WHERE `barcode`='$barcode'";
    								mysql_db_query($mysql_dbname,$query1,$connect);
    							}
	
							} else {
								$query1 = "INSERT INTO `sales_barcode` (`barcode`, `name`, `model`, `brand`, `prices`) VALUES ('$barcode', '$name', '$model', '$brand','$prices_sell')";
								mysql_db_query($mysql_dbname,$query1,$connect);
							}
							
						}
	
    				
    					////////////////////////
    				}
    			
    			
    				echo "<script> history.go(-2); </script>";
    			
    				break;
    			default:
    				$body = shopskin("sales_goods_edit");
    				
    				include "sales_goods_left.php";
    				
    				$query = "select * from `sales_goods_$MEM[Id]` where Id = '$UID'";
    				// $result=mysql_db_query($mysql_dbname,$query,$connect);
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ){ 
		    			$GOO=mysql_fetch_array($result); 						

						$body=str_replace("{formstart}","<form name='good' method='post' enctype='multipart/form-data' action='sales_goods_edit.php'> 
					    				<input type='hidden' name='nonce' value='$nonce'>
										<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);

						$body = str_replace("{scan}","",$body);
						$body = str_replace("{barcode}","<input type='text' name='barcode' value='$GOO[barcode]' $cssFormStyle placeholder='바코드'>",$body);
						$body = str_replace("{goodcode}","<input type='text' name='goodcode' value='$GOO[goodcode]' $cssFormStyle placeholder='제품코드'>",$body);
						$body = str_replace("{name}","<input type='text' name='name' value='$GOO[name]'$cssFormStyle placeholder='이름'>",$body);
						$body = str_replace("{model}","<input type='text' name='model' value='$GOO[model]' $cssFormStyle placeholder='모델명'>",$body);
						$body = str_replace("{brand}","<input type='text' name='brand' value='$GOO[brand]' $cssFormStyle placeholder='브랜드'>",$body);
							
						$body = str_replace("{cate}","<input type='text' name='cate' value='$GOO[cate]' $cssFormStyle placeholder='분류 카테고리'>",$body);
						
						//# 거래처 선택 	
						$query = "select * from `sales_company_$MEM[Id]` order by company desc";
						// $result = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query),$connect);
						$result = mysql_db_query($server[dbname],str_replace("*","count(*)",$query),$dbconnect);
    					$total = mysql_result($result,0,0);
    						// echo $query."<br>";
    					// $result=mysql_db_query($mysql_dbname,$query,$connect);	
    					$result=mysql_db_query($server[dbname],$query,$dbconnect);
    					if( mysql_num_rows($result) ){
    		 				$company_select = "<select size='1' name='company' $cssFormStyle>";
    		 				$company_select .= "<option value=''>거래처 선택</option>";		
							for($i=0;$i<$total;$i++){
								$rows=mysql_fetch_array($result);
		    					if($GOO[CID] == $rows[Id]) $company_select .= "<option value='$rows[Id]' selected >$rows[company]</option>";
		    					else $company_select .= "<option value='$rows[Id]' >$rows[company]</option>";
		    		
							}
							$company_select .= "</select>";
							$body = str_replace("{company}","$company_select",$body);
						}	
						
						$body = str_replace("{prices_buy}","<input type='text' name='prices_buy' value='$GOO[prices_buy]' $cssFormStyle placeholder='판매가격'>",$body);
						$body = str_replace("{prices_sell}","<input type='text' name='prices_sell' value='$GOO[prices_sell]' $cssFormStyle placeholder='매입가격'>",$body);
						$body = str_replace("{vat}","<input type='text' name='vat' value='$GOO[vat]' $cssFormStyle placeholder='부가세'>",$body);
						
						$body = str_replace("{stock}","<input type='text' name='stock' value='$GOO[stock]' $cssFormStyle placeholder='실재고량'>",$body);
						$body = str_replace("{stock1}","<input type='text' name='stock1' value='$GOO[stock1]' $cssFormStyle placeholder='안전재고량'>",$body);

						$body = str_replace("{filename}","<input type='file' name='userfile1' >",$body);
							
						if($GOO[b2b]) $body = str_replace("{b2b}","<input type='checkbox' name='b2b' checked>",$body);
						else $body = str_replace("{b2b}","<input type='checkbox' name='b2b' >",$body);
						$body = str_replace("{b2b_prices}","<input type='text' name='b2b_prices' value='$GOO[b2b_prices]' $cssFormStyle placeholder='공급단가'>",$body);
							
							
						// $body = str_replace("{comment}","<textarea name='comment' rows='10' $cssFormStyle placeholder='설명'>$GOO[description]</textarea>",$body);
						$body = str_replace("{comment}","<textarea name='comment' rows='10' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='제품 상세설명'>$GOO[description]</textarea>",$body);
		
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $butten_style>",$body);
									
						
						$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"sales_goods_edit.php?mode=del&UID=$UID\")' $butten_style>",$body);
						
					}		
						
							
    				break;
    		}
    			
			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}

	mysql_close($connect);
	mysql_close($dbconnect);
	
?>

