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

	include "../thumbnail.php";
		
	////////////////////////
	
	if($_COOKIE[adminemail]){ ///////////////
	
	
		if($_SESSION['nonce'] != $_POST['nonce']){
			$_SESSION['nonce'] = NULL;	
			// echo "<meta http-equiv='refresh' content='0; url=admin_goodsnew.php'>";
			page_back2();
		} else {
			///////////////////////////
			// 섹션 중복처리 방지 기능
	
			$_SESSION['nonce'] = NULL;
		
			
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    		$limit = $_POST['limit']; if(!$limit) $limit = $_GET['limit'];
    		$countryCode = $_GET['code']; if(!$countryCode) $countryCode = $_POST['code']; if(!$countryCode) $countryCode = $COUNTRY; 
    		
    			
    		$enable = $_POST['enable'];

			$barcode = $_POST['barcode'];
    		$goodcode = $_POST['goodcode'];
    		$name = $_POST['name'];
    						
    		$spec = $_POST['spec'];
    		$subtitle = $_POST['subtitle'];
    		$optionitem = $_POST['optionitem'];
    						
    		$model = $_POST['model'];
    		$brand = $_POST['brand'];
    		$barcode = $_POST['barcode'];
    		$cate = $_POST['cate'];
    		$company = $_POST['company'];
    		$company1 = $_POST['company1'];
    						
    		$buy_currency = $_POST['buy_currency'];
    		$prices_buy = $_POST['prices_buy'];
    		$sell_currency = $_POST['sell_currency'];
    		$prices_sell = $_POST['prices_sell'];
    						
    		if($_POST['vat']) $vat="checked"; else $vat="";
    		$vatrate = $_POST['vatrate'];
    						
    		$stock = $_POST['stock'];
    						
    		$description = $_POST['description'];
    					
    		//$detail1 = $_POST['detail1'];
    		//$detail2 = $_POST['detail2'];
    		//$detail3 = $_POST['detail3'];
			
			$countrycode = $COUNTRY;

			if($name){
			
				$query ="INSERT INTO `shop_goods` (`regdate`, `cate`, `cateName`, `code`, `barcode`, `goodname`, `spec`, `subtitle`, `brand`, `model`, 
					`stock`, `vat`, `vatrate`, `buy_currency`, `prices_buy`, `sell_currency`, `prices_sell`, 
					`description`, `images1`, `detail1`, `detail2`, `optionitem`,
					`click`, `pos`, `recommand`, `enable`) 
					
					VALUES ('$TODAYTIME', '$cate', '$cateName', '$code', '$barcode', '$name', '$spec', '$subtitle', '$brand', 'model', 
					'$tock', '$vat', '$vatrate', '$buy_currency', '$prices_buy', '$sell_currency', '$prices_sell', 
					'$description', '$images1', '$detail1', '$detail2', '$optionitem',
					0, 0, '', '$enable')";
				// echo "$query <br>";	    				
				mysql_db_query($mysql_dbname,$query,$connect);
			
				//////////////////////////////////////////
			
				$query = "select * from `shop_goods` where regdate = '$TODAYTIME' and goodname = '$name' order by Id desc";
				$result=mysql_db_query($mysql_dbname,$query,$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
    				// 상품이미지 등록1
    				///////////////////
   
    							
    				if ($_FILES["userfile1"][tmp_name]){

   	 					if(!is_dir("../goodimgs")) $an = mkdir("../goodimgs");
  			
						$uploadfile1  = "../goodimgs/".$_FILES[userfile1][name];
					
						$i=1;
						if ($_FILES["userfile".$i][tmp_name]) {
   							$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   							if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   						}	
						
						if ($_FILES["userfile1"][tmp_name]) $filename1 = "../goodimgs/goodimgs1_$COUNTRY-$rows[Id]";
		
      					if ($_FILES["userfile".$i][tmp_name]) {
         					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../goodimgs/goodimgs1_$COUNTRY-$rows[Id].".$ext);
      					}
      							
      					thumbnail_squre($filename1.".".$ext,"../goodimgs/goodimgs1_$COUNTRY-$rows[Id].s.".$ext,"100","100");	
      						
      					$query = "UPDATE `shop_goods` SET `images1`='./goodimgs/goodimgs1_$COUNTRY-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    					mysql_db_query($mysql_dbname,$query,$connect);
      					// echo "$query <br>";	 
      						
						$images1 = "./goodimgs/goodimgs1_$COUNTRY-$rows[Id].".$ext;
							
      				} else $images1 = "";
    		
    		///////////////////
    							
    				if ($_FILES["userfile4"][tmp_name]){

    					if(!is_dir("../goodimgs")) $an = mkdir("../goodimgs");
  			
						$uploadfile4  = "../goodimgs/".$_FILES[userfile4][name];
					
						$i=4;
						if ($_FILES["userfile".$i][tmp_name]) {
   							$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   							if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 	
   						}	
						
						if ($_FILES["userfile4"][tmp_name]) $filename4 = "../goodimgs/dtail1_$COUNTRY-$rows[Id]";
		
						
      					if ($_FILES["userfile".$i][tmp_name]) {
         					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../goodimgs/detail1_$COUNTRY-$rows[Id].".$ext);
         				}
      							
      					// thumbnail_squre($filename4.".".$ext,"../goodimgs/detail1_$COUNTRY-$rows[Id].s.".$ext,"100","100");
      						
      					$query = "UPDATE `shop_goods` SET `detail1`='./goodimgs/detail1_$COUNTRY-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    					mysql_db_query($mysql_dbname,$query,$connect);
    					// echo "$query <br>";	 
    					
    					$detail1 = "./goodimgs/detail1_$COUNTRY-$rows[Id].".$ext;	
      						
      				} else $detail1 = "";
      		
      		///////////////////////
      		
     				if ($_FILES["userfile5"][tmp_name]){

    					if(!is_dir("../goodimgs")) $an = mkdir("../goodimgs");
  			
						$uploadfile4  = "../goodimgs/".$_FILES[userfile5][name];
					
						$i=4;
						if ($_FILES["userfile".$i][tmp_name]) {
   							$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   							if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 	
   						}	
						
						if ($_FILES["userfile5"][tmp_name]) $filename4 = "../goodimgs/dtail2_$COUNTRY-$rows[Id]";
		
						
      					if ($_FILES["userfile".$i][tmp_name]) {
         					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../goodimgs/detail2_$COUNTRY-$rows[Id].".$ext);
         				}
      							
      					//thumbnail_squre($filename5.".".$ext,"../goodimgs/detail2_$COUNTRY-$rows[Id].s.".$ext,"100","100");
      						
      					$query = "UPDATE `shop_goods` SET `detail2`='./goodimgs/detail2_$COUNTRY-$rows[Id].".$ext."'  WHERE `Id`='$rows[Id]'";
    					mysql_db_query($mysql_dbname,$query,$connect);
    					// echo "$query <br>";	 
    					
    					$detail2 = "./goodimgs/detail2_$COUNTRY-$rows[Id].".$ext;	
      						
      				} else $detail2 = "";
      		  		
    				///////////////////////
    		
				
    		
				}
				
    			///////////////////
    		
				// echo "<meta http-equiv='refresh' content='0; url=admin_goods.php?limit=$limit&code=$countryCode'>";
				page_back2();
			} else msg_alert("오류! 제품명 없습니다.");


    

		///// ##### SESSION END ##### /////
			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	
?>

