<?php

	// 장바구니 코드 확인
	function _cartlog(){
		$TODAYTIME = date("Y-m-d H:i:s",time());

		// 장바구니 섹션 존재 유무를 검사.
		if(isset($_SESSION['cartlog'])){
			$cartlog = $_SESSION['cartlog'];
		} else {
			$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
			$_SESSION['cartlog'] = $cartlog;			
		}

		return $cartlog;
	}


	// 장바구니 데이터 하나를 읽어옴.
	function _cart_rows($uid){
		$query = "select * from `shop_cart` WHERE `Id`='".$uid."' ";
		if($rows = _mysqli_query_rows($query)){
			return $rows;
		}	
	}

	// 카트키값으로 장바구니 내용을 읽어옴.
	function _cart_rowss($cartlog){
		$query = "select * from `shop_cart` WHERE `cartlog`='".$cartlog."' and status = 'cart' ";
		$query .= "order by reseller desc";
		if($rowss = _mysqli_query_rowss($query)){	
			return $rowss;
		}	
	} 

	// 장바구니 하나를 삭제함.
	function _cart_delete($uid){
		$query = "DELETE FROM `shop_cart` WHERE `Id`='$uid'";
    	_mysqli_query($query);
	}

	// 카트로그 키값으로, 장바구니 내용 초기화.
	function _cart_delete_cartlog($cartlog){
		$query = "DELETE FROM `shop_cart` WHERE `cartlog`='".$cartlog."'";
    	_mysqli_query($query);
	}

	// 상품 하나를 장바구니에 저장
	function _cart_goods_save($rows,$num,$shipping,$ordertext,$filename){
		global $cartlog;

		$query ="INSERT INTO `shop_cart` (`regdate`, `seller`, `reseller`, `cartlog`, `GID`, `goodname`, `currency`, `prices`, `ordertext`, `status`, `num`, `images`, `option`,`upload`
				,`shipping`,`shipping_cost`,`vat`,`subtitle`,`email`) 
				VALUES ('$TODAYTIME', '".$rows->seller."', '".$rows->seller."','$cartlog', '$UID', '$goodname', '".$rows->sell_currency."', '".$rows->prices_sell."', '$ordertext', 'cart', '$num', 
				'".$rows->images1."', '$optionitems', '$filename1'
				,'$shipping','$shipping_cost', '$tax', '$subtitle','".$cookie_email."');";
			
		_mysqli_query($query);
	}


	// ++ 장바구니 이동
	function _cart_up(){
		global $site_language;
		global $site_env,$members_rows;
		global $cartlog;
		global $TODAYTIME;

		if(isset($_COOKIE['cookie_email'])){
			$cookie_email = $_COOKIE['cookie_email'];
		} else {
			$cookie_email = "";
		}

		$UID = 	$_POST['UID'];
		$ordertext = $_POST['ordertext'];
		$num = $_POST['num'];

		if(isset($_POST['optionitem'])){
			$optionitem = $_POST['optionitem'];
			$optionitems = "";	
	 		for($i=0;$i<count($optionitem);$i++) $optionitems .=  $optionitem[$i].";";	
	 	} else $optionitems = "";	

	 	$shipping = $_POST['shipping'];
	 	$shipping_cost = ""; //$_POST['shipping_cost'];

	 	$tax = $_POST['tax'];				
       
		$query = "select * from shop_goods WHERE `Id`='$UID'";
		if($goods_rows = _mysqli_query_rows($query)){


			$label = explode(";", $goods_rows->attach_label);
			for($i=0,$j=1;$i<count($label);$i++,$j++){
				$userfile = "userfile".$j;
				// 사용자 첨부 파일이 있는 경우 
				if (isset($_FILES[$userfile]['tmp_name'])){

					$dir = "/Y".date("Y",time())."/M".date("m",time())."/D".date("d",time())."/".$cartlog;
					_is_path("./orders".$dir);
					//echo "./orders".$dir."<br>";
				
					$uploadfile1  = "./orders".$dir."/".$_FILES[$userfile][name];
   					$ext = substr($uploadfile1, strrpos($uploadfile1,'.') + 1); 
   					if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 		

					if (move_uploaded_file($_FILES[$userfile]['tmp_name'], "./orders".$dir."/".$_FILES[$userfile]['name'])) {
	    			//echo "File is valid, and was successfully uploaded.\n";

					} else {
	    			//echo "Possible file upload attack!\n";
	    			
					}

					$upload_file .= "./orders".$dir."/".$_FILES[$userfile]['name'].";";
   				   						
      			} else $upload_file = "";
			}

			



			$goodname = _goods_name($goods_rows,$site_language);
			$subtitle = _goods_subtitle($goods_rows,$site_language);

			if(isset($site_env->dome) && $site_env->dome){
				//도매가격 사이트
				$price_currency = $goods_rows->b2b_currency;
				$price = $goods_rows->prices_b2b;
			} else {
				// 일반 사이트 
				$price_currency = $goods_rows->sell_currency;
				$price = $goods_rows->prices_sell;
			}	

			if(isset($members_rows->discount)){
				$price = $price/100 * (100-intval($members_rows->discount));
			}	

			// 장바구니 데이터 등록
			$insert_filed = "`regdate`, `seller`, `reseller`, `cartlog`
				,`GID`, `goodname`, `currency`, `prices`, `ordertext`, `status`, `num`
				,`images`, `option`,`upload`
				,`shipping`,`shipping_cost`,`vat`,`subtitle`,`email`";		
			$insert_value = "'$TODAYTIME', '".$goods_rows->seller."', '".$goods_rows->seller."','$cartlog'
				,'$UID', '$goodname', '".$price_currency."', '".$price."', '$ordertext', 'cart', '$num'
				,'".$goods_rows->images1."', '$optionitems', '$upload_file'
				,'$shipping','$shipping_cost', '$tax', '$subtitle','".$cookie_email."'";				

			$query ="INSERT INTO shop_cart ($insert_filed) VALUES ($insert_value);";	//echo $query;
			//echo $query."<br>";
			_mysqli_query($query);

			
		} else {
			$msg  = "Error! 존재하지 않는 상품입니다.";				
			$body = _theme_page($skin_name,"error");
			$body = str_replace("{error_message}",$msg,$body);
			echo $body;
		} 
	}






?>