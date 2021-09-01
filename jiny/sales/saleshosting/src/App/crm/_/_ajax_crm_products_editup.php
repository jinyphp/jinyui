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

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");
	

	// 환경설정 읽어보기
	require_once ($_SERVER['DOCUMENT_ROOT']."/crm/crm_products.cfg.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// POST키값을 기준으로 변수 = 값 지정.
		$arr = array_keys($_POST);
		for($i=0;$i<count( $arr );$i++){
			$key_name = $arr[$i];
			${$key_name} = _formdata($key_name);		
		}

		if($mode == "enable"){
			$query = "UPDATE $_tableName SET `enable`='on' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE $_tableName SET `enable`='' WHERE `Id`='$uid'";
			_sales_query($query);

		} else if($mode == "delete"){
			
			$query = "DELETE FROM $_tableName WHERE `Id`='$uid'";
    		_sales_query($query);

    		
		
		} else if($mode == "edit"){
	
			$query = "select * from $_tableName where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 				
				$query = "UPDATE $_tableName SET ";

				for($i=0;$i<count($_form);$i++){
					if($_form[$i]['type'] == "input"){
						$key = $_form[$i]['name'];
						$query .= "`$key`='".$_POST[$key]."' ,";

					} else if($_form[$i]['type'] == "checkbox"){
						$key = $_form[$i]['name'];
						$query .= "`$key`='".$_POST[$key]."' ,";

					} else if($_form[$i]['type'] == "textarea"){
						$key = $_form[$i]['name'];
						$query .= "`$key`='".addslashes($_POST[$key])."' ,";	
					}
				}

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query."<br>";
				_sales_query($query);

				
			}

			$url = $_tableName.".php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
			echo "<script> location.replace('$url'); </script>";			
		
		} else if($mode == "new"){
			// 삽입

			for($i=0;$i<count($_form);$i++){
				if($_form[$i]['type'] == "input"){
					$key = $_form[$i]['name'];
					// $query .= "`$key`='".$_POST[$key]."' ,";
					$insert_filed .= "`$key`,"; $insert_value .= "'".$_POST[$key]."',";

				} else if($_form[$i]['type'] == "checkbox"){
					$key = $_form[$i]['name'];
					//$query .= "`$key`='".$_POST[$key]."' ,";
					$insert_filed .= "`$key`,"; $insert_value .= "'".$_POST[$key]."',";

				} else if($_form[$i]['type'] == "textarea"){
					$key = $_form[$i]['name'];
					$insert_filed .= "`$key`,"; $insert_value .= "'".addslashes($_POST[$key])."',";
					
				} else if($_form[$i]['name'] == "regdate"){
					$key = $_form[$i]['name'];					
					$insert_filed .= "`$key`,"; $insert_value .= "'".$TODAYTIME."',";
				}	
			}

			/*
			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAY',";

			if($enable = _formdata("enable")){ $insert_filed .= "`enable`,"; $insert_value .= "'on',"; }
	   		if($auth = _formdata("auth")){	$insert_filed .= "`auth`,"; $insert_value .= "'on',"; }    			
			if($country = _formdata("business_country")){	$insert_filed .= "`country`,"; $insert_value .= "'$country',"; }
			if($currency = _formdata("currency")){	$insert_filed .= "`currency`,"; $insert_value .= "'$currency',"; }
			if($limitation = _formdata("limitation")){	$insert_filed .= "`limitation`,"; $insert_value .= "'$limitation',"; }
   	 		if($inout = _formdata("inout")){	$insert_filed .= "`inout`,"; $insert_value .= "'$inout',"; }
    		if($business= _formdata("business")){	$insert_filed .= "`business`,"; $insert_value .= "'$business',"; }

    		if($biznumber = _formdata("biznumber")){
    			$biznumber = str_replace("-","",$biznumber);
				$insert_filed .= "`biznumber`,";
				$insert_value .= "'$biznumber',";
			}

    		if($president = _formdata("president")){	$insert_filed .= "`president`,"; $insert_value .= "'$president',"; }
    		if($post = _formdata("post")){	$insert_filed .= "`post`,"; $insert_value .= "'$post',"; }
    		if($address = _formdata("address")){	$insert_filed .= "`address`,"; $insert_value .= "'$address',"; }
    		if($subject = _formdata("subject")){ $insert_filed .= "`subject`,"; $insert_value .= "'$subject',"; }
    		if($item = _formdata("item")){ $insert_filed .= "`item`,"; $insert_value .= "'$item',"; }
    		if($email = _formdata("email")){ $insert_filed .= "`email`,"; $insert_value .= "'$email',"; }    					
    		if($tel = _formdata("tel")){ $insert_filed .= "`tel`,"; $insert_value .= "'$tel',"; }
    		if($fax = _formdata("fax")){ $insert_filed .= "`fax`,"; $insert_value .= "'$fax',"; }
    		if($phone = _formdata("phone")){ $insert_filed .= "`phone`,"; $insert_value .= "'$phone',"; }
    		if($group = _formdata("group")){ $insert_filed .= "`group`,"; $insert_value .= "'$group',"; }
    		if($manager = _formdata("manager")){ $insert_filed .= "`manager`,"; $insert_value .= "'$manager',"; }    					
    		if($discount = _formdata("discount")){ $insert_filed .= "`discount`,"; $insert_value .= "'$discount',"; }

    		$insert_filed .= "`vat`,";
    		if($vat = _formdata("vat")) $insert_value .= "'on',"; else $insert_value .= "'',";					
    				
    		if($balance_sell = _formdata("balance_sell")){ $insert_filed .= "`balance_sell`,"; $insert_value .= "'$balance_sell',";}
			if($balance_buy = _formdata("balance_buy")){ $insert_filed .= "`balance_buy`,"; $insert_value .= "'$balance_buy',";}
			if($comment = _formdata("comment")){ $insert_filed .= "`comment`,"; $insert_value .= "'".addslashes($comment)."',";}
			*/

			$query = "INSERT INTO $_tableName ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			//echo $query."<br>";
			_sales_query($query);

		
		}

		$url = $_tableName.".php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";	
		
	} else {
		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>