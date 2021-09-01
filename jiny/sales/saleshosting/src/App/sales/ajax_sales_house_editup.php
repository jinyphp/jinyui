<?

	@session_start();

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	//include "./func/goods.php";
	//include "./func/members.php";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		
		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");
		


		if($mode == "delete"){
			
    		$query = "DELETE FROM `sales_goods_house` WHERE `Id`='$uid'";
    		_sales_query($query);

    		$query = "ALTER TABLE `sales_goods` DROP COLUMN `stock_".$uid."`";
    		_sales_query($query);
    	

		} else {

			$query = "select * from `sales_goods_house` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				
					$query = "UPDATE `sales_goods_house` SET ";
					
					if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					
					$manager = _formdata("manager"); $query .= "`manager`='$manager' ,";
					$name = _formdata("name"); $query .= "`name`='$name' ,";
					$post = _formdata("post"); $query .= "`post`='$post' ,";
					$state = _formdata("state"); $query .= "`state`='$state' ,";
					$city = _formdata("city"); $query .= "`city`='$city' ,";
					$address = _formdata("address"); $query .= "`address`='$address' ,";
					$phone = _formdata("phone"); $query .= "`phone`='$phone' ,";
					$tel = _formdata("tel"); $query .= "`tel`='$tel' ,";
					$fax = _formdata("fax"); $query .= "`fax`='$fax' ,";
					$comment = _formdata("comment"); $query .= "`comment`='$comment' ,";
					$country = _formdata("house_country"); $query .= "`country`='$country' ,";

					$business = _formdata("business"); $query .= "`business`='$business' ,";
					$company = _formdata("company"); $query .= "`company`='$company' ,";


					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					_sales_query($query);

				
			} else {
				// 삽입 
				
		
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";

					if($enable = _formdata("enable")){
						$insert_filed .= "`enable`,";
						$insert_value .= "'on',";
					}

					if($name = _formdata("name")){
						$insert_filed .= "`name`,";
						$insert_value .= "'$name',";
					}

					if($manager = _formdata("manager")){
						$insert_filed .= "`manager`,";
						$insert_value .= "'$manager',";
					}

					if($post = _formdata("post")){
						$insert_filed .= "`post`,";
						$insert_value .= "'$post',";
					}

					if($address = _formdata("address")){
						$insert_filed .= "`address`,";
						$insert_value .= "'$address',";
					}

					if($phone = _formdata("phone")){
						$insert_filed .= "`phone`,";
						$insert_value .= "'$phone',";
					}

					if($state = _formdata("state")){
						$insert_filed .= "`state`,";
						$insert_value .= "'$state',";
					}

					if($city = _formdata("city")){
						$insert_filed .= "`city`,";
						$insert_value .= "'$city',";
					}

					if($fax = _formdata("fax")){
						$insert_filed .= "`fax`,";
						$insert_value .= "'$fax',";
					}

					if($tel = _formdata("tel")){
						$insert_filed .= "`tel`,";
						$insert_value .= "'$tel',";
					}

					if($country = _formdata("house_country")){
						$insert_filed .= "`country`,";
						$insert_value .= "'$country',";
					}

					if($comment = _formdata("comment")){
						$insert_filed .= "`comment`,";
						$insert_value .= "'$comment',";
					}

					if($business = _formdata("business")){
						$insert_filed .= "`business`,";
						$insert_value .= "'$business',";
					}

					if($company = _formdata("company")){
						$insert_filed .= "`company`,";
						$insert_value .= "'$company',";
					}
					
					$query = "INSERT INTO `sales_goods_house` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);
			
				$query = "select * from `sales_goods_house` WHERE `name`='$name' and `regdate`='$TODAYTIME' order by Id desc";
				if($rows = _sales_query_rows($query)){
					$query = "ALTER TABLE `sales_goods` ADD COLUMN `stock_".$rows->Id."` varchar(20) CHARACTER SET 'utf8' NULL;";
					_sales_query($query);
				}
				
			}	

		

		}

		$url = "sales_house.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";

		
	} else {
		$body = _theme_pages($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;	
	}



/*
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
	
	
		if( !isset( $_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
		  	$msg = "회원 로그인이 필요합니다.";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";
		} else { //////////////////////////////////////////
		
			$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    		// echo $query; 
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
			
    			$enable = $_POST['enable'];
				
				$housename = $_POST['housename'];
    			$manager = $_POST['manager'];
    			
    			$phone = $_POST['phone']; 
    			$fax = $_POST['fax']; $fax = str_replace("-","",$fax);
    			$address = $_POST['address']; 
    			
    			$memo = $_POST['memo'];
    			
    		
    			if( !$housename ) msg_alert("오류! 창고명이 없습니다.");
    			else {
					
					$query = "INSERT INTO sales_warehouse_$MEM[Id] (`regdate`, `enable`, `housename`, `manager`, `phone`, `fax`, `memo`) 
    								VALUES ('$TODAY', '$enable', '$housename', '$manager', '$phone', '$fax', '$memo')";
    				mysql_db_query($server[dbname],$query,$dbconnect);
					
					
					//echo $query;
					echo "<script> history.go(-2); </script>";
				}	
				
    				
		
				//////////////////////////////////////////////////////////////////		
		
			} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
	
		}
	

	} ///// ##### SESSION END ##### /////
	
	mysql_close($connect);
	mysql_close($dbconnect);	
	
	*/
?>

