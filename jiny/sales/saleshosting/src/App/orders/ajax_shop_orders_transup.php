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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");


    //********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		$uid = _formdata("uid");

		echo "mode : $mode <br>";
		echo "uid : $uid <br>";

		$company = _formdata("company");
		$business = _formdata("business");
		$company_new = _formdata("company_new");

		echo "company : $company <br>";
		echo "business : $business <br>";
		echo "company_new : $company_new <br>";

		// 거래처 등록 체크


		$query = "select * from `shop_orders` where Id='$uid'";
		echo $query."<br>";
		if($rows = _sales_query_rows($query)){
			$query = "select * from `shop_orders_detail` WHERE ordercode = '".$rows->ordercode."' order by regdate desc";
			echo $query."<br>";
			if($rowss_orders_detail = _sales_query_rowss($query)){	
				for($j=0;$j<count($rowss_orders_detail);$j++){
					$rows2 = $rowss_orders_detail[$j];

					// 상품 등록 체크

					

					// 자료 전산 작업하는 실제적인 날짜/시간
    				$insert_filed = "`regdate`,"; 
    				$insert_value = "'$TODAYTIME',";

    				$insert_filed .= "`transdate`,"; 
    				$insert_value .= "'$TODAYTIME',"; 
    		
    				$insert_filed .= "`trans`,"; 
    				$insert_value .= "'sell',"; 

    				$insert_filed .= "`gid`,"; 		$insert_value .= "'$gid',";
    				$insert_filed .= "`goodname`,"; $insert_value .= "'".$rows2->goodname."',";
    				$insert_filed .= "`spec`,"; 	$insert_value .= "'$spec',";
    				$insert_filed .= "`num`,";		$insert_value .= "'".$rows2->num."',";
    				$insert_filed .= "`currency`,"; $insert_value .= "'".$rows2->currency."',";
    				$insert_filed .= "`prices`,"; 	$insert_value .= "'".$rows2->prices."',";

    				$sum = $rows2->prices * $rows2->num;		// 수량별 가격 
    				$vat= $sum / 100 * $rows2->vat;	// 부가세 부분 추가 4
    				$insert_filed .= "`vat`,"; 		$insert_value .= "'$vat',";
    				$insert_filed .= "`discount`,"; $insert_value .= "'$discount',";

    				$insert_filed .= "`sum`,"; 		$insert_value .= "'$sum',";
    				$total = $sum + $vat;
    				$insert_filed .= "`total`,"; 	$insert_value .= "'$total',";

    				$insert_filed .= "`unpaid`,"; 
    				$insert_value .= "'$total',"; 

    				$insert_filed .= "`business`,"; 
    				$insert_value .= "'$business',"; 

    				$insert_filed .= "`company`,"; 
    				$insert_value .= "'$company',";
    			
    				$insert_filed .= "`company_id`,"; 
    				$insert_value .= "'$company',"; 

    				$insert_filed .= "`warehouse`,"; 
					$insert_value .= "'$warehouse',"; 

					// 전표 소유자, 이메일 
    				$insert_filed .= "`email`,"; 
    				$insert_value .= "'".$_COOKIE['cookie_email']."',"; 

    				$query = "INSERT INTO `sales_trans` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					echo $query."<br>";
					// _sales_query($query);
				}


				// ****************
				// 배송비 전표 입력...
				// $prices .= "<div>배송방식: ". $rows2->shipping ."</div>";
				$shipping = explode(":", $rows2->shipping);

				// 자료 전산 작업하는 실제적인 날짜/시간
    			$insert_filed = "`regdate`,"; 
    			$insert_value = "'$TODAYTIME',";

    			$insert_filed .= "`transdate`,"; 
    			$insert_value .= "'$TODAYTIME',"; 
    		
    			$insert_filed .= "`trans`,"; 
    			$insert_value .= "'sell',"; 

    			$insert_filed .= "`gid`,"; 		$insert_value .= "'$gid',";
    			$insert_filed .= "`goodname`,"; $insert_value .= "'".$rows2->shipping."',";
    			$insert_filed .= "`spec`,"; 	$insert_value .= "'$spec',";
    			$insert_filed .= "`num`,";		$insert_value .= "'1',";
    			$insert_filed .= "`currency`,"; $insert_value .= "'".$rows2->currency."',";
    			$insert_filed .= "`prices`,"; 	$insert_value .= "'".$shipping[1]."',";

    			$sum = $shipping[1];		// 수량별 가격 
    			$vat = $sum / 100 * $rows2->vat;	// 부가세 부분 추가 4
    			$insert_filed .= "`vat`,"; 		$insert_value .= "'$vat',";
    			$insert_filed .= "`discount`,"; $insert_value .= "'$discount',";

    			$insert_filed .= "`sum`,"; 		$insert_value .= "'$sum',";
    			$total = $sum + $vat;
    			$insert_filed .= "`total`,"; 	$insert_value .= "'$total',";

    			$insert_filed .= "`unpaid`,"; 
    			$insert_value .= "'$total',"; 

    			$insert_filed .= "`business`,"; 
    			$insert_value .= "'$business',"; 

    			$insert_filed .= "`company`,"; 
    			$insert_value .= "'$company',";
    			
    			$insert_filed .= "`company_id`,"; 
    			$insert_value .= "'$company',"; 

    			$insert_filed .= "`warehouse`,"; 
				$insert_value .= "'$warehouse',"; 

				// 전표 소유자, 이메일 
    			$insert_filed .= "`email`,"; 
    			$insert_value .= "'".$_COOKIE['cookie_email']."',"; 

    			$query = "INSERT INTO `sales_trans` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				// _sales_query($query);

				
			}		
		}




	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	

?>