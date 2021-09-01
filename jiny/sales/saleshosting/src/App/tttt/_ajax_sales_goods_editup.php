<?
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/members.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$name = _formdata("name");
		//echo "uid = $uid <br>";

		
		function _ajax_pagecall_script($url,$ajaxkey){
			
			echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
    			</script>";
    		
    	}		

    	function _form_uploadfile($formname,$filename){
    		if($_FILES[$formname]['tmp_name']){
    			// 파일 확장자 검사
    			
    			$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    			else {
    				if($filename == ""){
    					// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {
    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}

		if($mode == "assamble"){
			// echo "assamble";
			$stock_house = "stock_"._formdata("stock_house");
			$assamble_num = _formdata("assamble_num");

			$query = "select * from `sales_goods_bom` where bom='$uid'";
			if($rowss = _sales_query_rowss($query)){
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];

					// 재료 수량을 생산 수량만큼 감소 : 생산수량 * 부품수
					$assm =  $assamble_num * $rows->num;

					$query1 = "select * from `sales_goods` where Id='".$rows->bom."'";
					if($rows1 = _sales_query_rows($query1)){
						$stock = $rows1->$stock_house - $assm;
						// 
						$query = "UPDATE `sales_goods` SET `$stock_house`='$stock' where Id='".$rows->bom."'";
						_sales_query($query);
					}

				}

				////
				$query1 = "select * from `sales_goods` where Id='".$uid."'";
				if($rows1 = _sales_query_rows($query1)){
					$stock = $rows1->$stock_house + $assamble_num;

					$query = "UPDATE `sales_goods` SET `$stock_house`='$stock' where Id='".$uid."'";
					_sales_query($query);
				}

			}	

		} else if($mode == "disassamble"){
			// echo "disassamble";
			$stock_house = "stock_"._formdata("stock_house");
			$assamble_num = _formdata("assamble_num");

			$query = "select * from `sales_goods_bom` where bom='$uid'";
			if($rowss = _sales_query_rowss($query)){
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];

					// 재료 수량을 생산 수량만큼 감소 : 생산수량 * 부품수
					$assm =  $assamble_num * $rows->num;

					$query1 = "select * from `sales_goods` where Id='".$rows->bom."'";
					if($rows1 = _sales_query_rows($query1)){
						$stock = $rows1->$stock_house + $assm;
						// 
						$query = "UPDATE `sales_goods` SET `$stock_house`='$stock' where Id='".$rows->bom."'";
						_sales_query($query);
					}

				}

				////
				$query1 = "select * from `sales_goods` where Id='".$uid."'";
				if($rows1 = _sales_query_rows($query1)){
					$stock = $rows1->$stock_house - $assamble_num;

					$query = "UPDATE `sales_goods` SET `$stock_house`='$stock' where Id='".$uid."'";
					_sales_query($query);
				}

			}	

		} else if($mode == "delete"){
			
    		$query = "DELETE FROM `sales_goods` WHERE `Id`='$uid'";
    		_sales_query($query);
    	

		} else {

			$REF = $_GET['REF']; if(!$REF) $REF = $_POST['REF'];
    			
		
			$query = "select * from `sales_goods` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				// 이메일 중복여부 체크
				$query1 = "select * from `sales_goods` where name='$name'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query1)){
					echo "중복된 상품명 입니다.";
				} else {
					$query = "UPDATE `sales_goods` SET ";
					
					if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					if($bom = _formdata("bom")) $query .= "`bom`='on' ,"; else $query .= "`bom`='' ,";
					
					$cate = _formdata("cate"); $query .= "`cate`='$cate' ,";
					$name = _formdata("name"); $query .= "`name`='$name' ,";
					$option = _formdata("option"); $query .= "`option`='$option' ,";
					$barcode = _formdata("barcode"); $query .= "`barcode`='$barcode' ,";
					$goodcode = _formdata("goodcode"); $query .= "`goodcode`='$goodcode' ,";
					$model = _formdata("model"); $query .= "`model`='$model' ,";
					$brand = _formdata("brand"); $query .= "`brand`='$brand' ,";

					$country = _formdata("country"); $query .= "`country`='$country' ,";

					$company = _formdata("company"); $query .= "`company`='$company' ,";
					$business = _formdata("business"); $query .= "`business`='$business' ,";

					if($vat = _formdata("vat")) $query .= "`vat`='on' ,"; else $query .= "`vat`='' ,";

					$sell_currency = _formdata("sell_currency"); $query .= "`sell_currency`='$sell_currency' ,";
					$prices_sell = _formdata("prices_sell"); $query .= "`prices_sell`='$prices_sell' ,";

					$buy_currency = _formdata("buy_currency"); $query .= "`buy_currency`='$buy_currency' ,";
					$prices_buy = _formdata("prices_buy"); $query .= "`prices_buy`='$prices_buy' ,";

					$b2b_currency = _formdata("b2b_currency"); $query .= "`b2b_currency`='$b2b_currency' ,";
					$prices_b2b = _formdata("prices_b2b"); $query .= "`prices_b2b`='$prices_b2b' ,";

					
					$stock_safe = _formdata("stock_safe"); $query .= "`stock_safe`='$stock_safe' ,";
					if($stock_check = _formdata("stock_check")) $query .= "`stock_check`='on' ,"; else $query .= "`stock_check`='' ,";
					if($stock_order = _formdata("stock_order")) $query .= "`stock_order`='on' ,"; else $query .= "`stock_order`='' ,";

					if($shopping = _formdata("shopping")) $query .= "`shopping`='on' ,"; else $query .= "`shopping`='' ,";
					
					$comment = _formdata("comment"); $query .= "`comment`='$comment' ,";

					
					// 창고별 재고 관리
					$query1 = "select * from `sales_goods_house` ";
					if($rowss1 = _sales_query_rowss($query1)){
						$stock_total = 0;
						for($i=0;$i<count($rowss1);$i++){
							$rows1 = $rowss1[$i];
							$code = "stock_".$rows1->Id;
				
							$_stock = _formdata("$code"); $query .= "`$code`='$_stock' ,";
							$stock_total += $_stock; 
						}
						$stock = _formdata("stock"); $query .= "`stock`='$stock_total' ,";
					} else {
						$stock = _formdata("stock"); $query .= "`stock`='$stock' ,";
					}


					$query .= "WHERE `Id`='$uid'";
					$query = str_replace(",WHERE","WHERE",$query);
					echo $query;
					_sales_query($query);

				}
			} else {
				// 삽입 
				
				$query1 = "select * from `sales_goods` where name='$name'";
				if($rows->email != $email && $rows1 = _sales_query_rows($query1)){
					echo "중복된 상품 입니다.";
				} else {
					$insert_filed .= "`regdate`,";
					$insert_value .= "'$TODAYTIME',";

					if($enable = _formdata("enable")){
						$insert_filed .= "`auth`,";
						$insert_value .= "'on',";
					}

					if($bom = _formdata("bom")){
						$insert_filed .= "`bom`,";
						$insert_value .= "'on',";
					}

					if($company = _formdata("company")){
						$insert_filed .= "`company`,";
						$insert_value .= "'$company',";
					}

					if($business = _formdata("business")){
						$insert_filed .= "`business`,";
						$insert_value .= "'$business',";
					}

					if($cate = _formdata("cate")){
						$insert_filed .= "`cate`,";
						$insert_value .= "'$cate',";
					}

					if($name = _formdata("name")){
						$insert_filed .= "`name`,";
						$insert_value .= "'$name',";
					}

					if($option = _formdata("option")){
						$insert_filed .= "`option`,";
						$insert_value .= "'$option',";
					}

					if($barcode = _formdata("barcode")){
						$insert_filed .= "`barcode`,";
						$insert_value .= "'$barcode',";
					}

					if($goodcode = _formdata("goodcode")){
						$insert_filed .= "`goodcode`,";
						$insert_value .= "'$goodcode',";
					}

					if($model = _formdata("model")){
						$insert_filed .= "`model`,";
						$insert_value .= "'$model',";
					}

					if($brand = _formdata("brand")){
						$insert_filed .= "`brand`,";
						$insert_value .= "'$brand',";
					}

					if($country = _formdata("country")){
						$insert_filed .= "`country`,";
						$insert_value .= "'$country',";
					}

					$insert_filed .= "`vat`,";
					if($vat = _formdata("vat")) $insert_value .= "'on',"; else $insert_value .= "'',"; 

					if($sell_currency = _formdata("sell_currency")){
						$insert_filed .= "`sell_currency`,";
						$insert_value .= "'$sell_currency',";
					}
					if($prices_sell = _formdata("prices_sell")){
						$insert_filed .= "`prices_sell`,";
						$insert_value .= "'$prices_sell',";
					}

					if($buy_currency = _formdata("buy_currency")){
						$insert_filed .= "`buy_currency`,";
						$insert_value .= "'$buy_currency',";
					}
					if($prices_buy = _formdata("prices_buy")){
						$insert_filed .= "`prices_buy`,";
						$insert_value .= "'$prices_buy',";
					}

					if($b2b_currency = _formdata("b2b_currency")){
						$insert_filed .= "`b2b_currency`,";
						$insert_value .= "'$b2b_currency',";
					}
					if($prices_b2b = _formdata("prices_b2b")){
						$insert_filed .= "`prices_b2b`,";
						$insert_value .= "'$prices_b2b',";
					}

					

					if($stock_safe = _formdata("stock_safe")){
						$insert_filed .= "`stock_safe`,";
						$insert_value .= "'$stock_safe',";
					}

					if($stock_check = _formdata("stock_check")){
						$insert_filed .= "`stock_check`,";
						$insert_value .= "'on',";
					}

					if($stock_order = _formdata("stock_order")){
						$insert_filed .= "`stock_order`,";
						$insert_value .= "'on',";
					}

					if($shopping = _formdata("shopping")){
						$insert_filed .= "`shopping`,";
						$insert_value .= "'on',";
					}

					if($comment = _formdata("comment")){
						$insert_filed .= "`comment`,";
						$insert_value .= "'$comment',";
					}

					// 창고별 재고 관리
					$query1 = "select * from `sales_goods_house` ";
					if($rowss1 = _sales_query_rowss($query1)){
						$stock_total = 0;
						for($i=0;$i<count($rowss1);$i++){
							$rows1 = $rowss1[$i];
							$code = "stock_".$rows1->Id;
				
							$_stock = _formdata("$code");
							$insert_filed .= "`$code`,";
							$insert_value .= "'$_stock',";

							$stock_total += $_stock;
						}

						$insert_filed .= "`stock`,";
						$insert_value .= "'$stock_total',";

					} else {

						if($stock = _formdata("stock")){
							$insert_filed .= "`stock`,";
							$insert_value .= "'$stock',";
						}
					}

					$query = "INSERT INTO `sales_goods` ($insert_filed) VALUES ($insert_value)";
					$query = str_replace(",)",")",$query);
					_sales_query($query);
				}	
				
			}	

			// _ajax_pagecall_script("/ajax_site_members.php",_formdata("ajaxkey"));

		}


		$ajaxkey = _formdata("ajaxkey");
		$url = "/ajax_sales_goods.php";
		echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#goods').html(data);
            		}
        		});
    			</script>";	

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>