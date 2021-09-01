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
	include "./func/orders.php";
	include "./func/butten.php";
	

	if(isset($_SESSION['language'])){
		$site_language = $_SESSION['language'];
	} else {
		$site_language = "ko";
	}


	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}

	if(isset($_COOKIE['cookie_email'])){
		$cookie_email = $_COOKIE['cookie_email'];
	} else {
		$cookie_email = "";
	}


	function _form_check_enable($check){
		if($check){
			return "<input type='checkbox' name='enable' checked >";
		} else {
			return "<input type='checkbox' name='enable' >";
		}
	}


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		// 지정된 상품 하나를 읽어옴
		function _shop_goods_rows($uid){
			$query = "select * from `shop_goods` WHERE `Id`='$uid'";
			if($rows = _sales_query_rows($query)){	
				return $rows;
			}	
		}


		/////////////
		$skin_name = "default";
		$body = _skin_page("default","shop_goods_detail");


		$mode = _formmode();
		echo $mode;
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$cate = _formdata("cate");
		$ajaxkey = _formdata("ajaxkey");






	
			$body=str_replace("{formstart}","<form name='good' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>					    				
										<input type='hidden' name='uid' value='$uid'>",$body);
			$body = str_replace("{formend}","</form>",$body);
		
			$script = "<script>
				function form_submit(mode,uid){
					var url = \"/ajax_shop_goods_detail_up.php?uid=\"+uid+\"&mode=\"+mode;
				
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    });
				}

				function form_delete(mode,uid){
					var url = \"/ajax_shop_goods_detail_up.php?uid=\"+uid+\"&mode=\"+mode;
					
					$.ajax({
                        url:url,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);

                        }
                    });
				}
				</script>";
			$body = str_replace("{form_submit}","$script
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" id=\"".$btn_style_gray."\" >
				",$body);


			//$goodname = _goods_name($goods,$site_language);
		    //$spec = _goods_spec($goods,$site_language);
		    //$subtitle = _goods_subtitle($goods,$site_language);
		    //$optionitem = json_decode( $goods->optionitem ); 
		    //$ajaxkey = _formdata("ajaxkey"); 

		   
			
			$body = str_replace("{enable}",_form_check_enable($goods->enable),$body);
			$body = str_replace("{pos}","<input type='number' name='pos' >",$body);
			$body = str_replace("{startselling}","<input type='date' name='start' >",$body);
			$body = str_replace("{endselling}","<input type='date' name='end' >",$body);


			// 상품별 판매국가 : 수동으로 지정 가능 , multi select 문으로 작성			
			$query = "select * from `shop_country` ";	
			if($rowss = _sales_query_rowss($query)){	
				$country_check = explode(";",$goods->sales_country);
					
				$sales_country = "<select multiple name='sales_country[]' size='5' style='width:100%'>";
				$seller_country = "<select name='country'  id=\"cssFormStyle\">";
				for($i=0;$i<count($rowss);$i++){
					$rows1 = $rowss[$i];
					$seller_country .= "<option value='".$rows1->code."'>".$rows1->code."</option>";

					$sales_country .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>";
				}
				$sales_country .= "</select>";
				$seller_country .= "</select>";
			}
				
			$body = str_replace("{country}",$seller_country,$body);
			$body = str_replace("{sales_country}",$sales_country,$body);


			// 상품 기본 카테고리 
			$query = "select * from `shop_cate` ";
			// $query .= "where code = 'default' ";
			$query .= "order by pos desc";	
			if($rowss = _sales_query_rowss($query)){
				$check = explode(";",$goods->cate);
				$cate = "<select multiple name='cate[]' size='5' style='width:100%'>";
				for($i=0;$i<count($rowss);$i++){
					$rows= $rowss[$i];
					$cate .= "<option value='".$rows->Id."' ";
					for($k=0;$k<count($check); $k++){
						if($check[$k] == $rows->Id) $cate .= "selected";
					}
					$title = stripslashes($rows->title);
					$title_name = json_decode($title);
					$cate .= ">".$title_name->$site_language."</option>";
				}
				$cate .= "</select>";	
			}
			$body = str_replace("{cate}",$cate,$body);


			// 주문 문구 입력
			$body = str_replace("{ordertext}","<input type='checkbox' name='ordertext' >",$body);
			

			// 주문 문구 입력
			$body = str_replace("{attach}","<input type='checkbox' name='attach' >",$body);
			

			
			$body = str_replace("{blog}","<input type='text' name='blog' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{youtube}","<textarea name='youtube' rows='5' style='width:100%'></textarea>",$body);
			$body = str_replace("{name}","<input type='text' name='name' id=\"cssFormStyle\" >",$body);
				// $body = str_replace("{reseller}","<input type='text' name='reseller' value='$GOO[reseller]' id=\"cssFormStyle\" >",$body);		
							
				// $body = str_replace("{scan}",$barcodeScan,$body);
			$body = str_replace("{barcode}","<input type='text' name='barcode' id=\"cssFormStyle\" >",$body);			
			$body = str_replace("{goodcode}","<input type='text' name='goodcode' id=\"cssFormStyle\" >",$body);			
			$body = str_replace("{model}","<input type='text' name='model' id=\"cssFormStyle\" >",$body);
			$body = str_replace("{brand}","<input type='text' name='brand' id=\"cssFormStyle\" >",$body);


			// ***** ***** ***** *****
			
			//# 매입 / B2B / 판매 가격 설정
			$query = "select * from `shop_currency`";
			if($rowss = _sales_query_rowss($query)){
				$buy_currency = "<select name='buy_currency' id=\"cssFormStyle\" >";
				$b2b_currency = "<select name='b2b_currency' id=\"cssFormStyle\" >";
				$sell_currency = "<select name='sell_currency' id=\"cssFormStyle\" >";

				for($ii=0;$ii<count($rowss);$ii++){
					$rows1=$rowss[$ii];
					$buy_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
					$b2b_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
					$sell_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
					
				}

				$buy_currency .= "</select>";
				$b2b_currency .= "</select>";
				$sell_currency .= "</select>";

				$body = str_replace("{buy_currency}",$buy_currency,$body);
				$body = str_replace("{b2b_currency}",$b2b_currency,$body);
				$body = str_replace("{sell_currency}",$sell_currency,$body);

				$body = str_replace("{prices_buy}","<input type='text' name='prices_buy'  id=\"cssFormStyle\" >",$body);
				$body = str_replace("{prices_b2b}","<input type='text' name='prices_b2b'  id=\"cssFormStyle\" >",$body);
				$body = str_replace("{prices_sell}","<input type='text' name='prices_sell'  id=\"cssFormStyle\"  >",$body);
			}
					

					
							
			// 부가세, 부가세율, 재고			
			
				$body = str_replace("{vat}","<input type='checkbox' name='vat' >",$body);
			

			$body = str_replace("{vatrate}","<input type='text' name='vatrate' id=\"cssFormStyle\"  >",$body);
			$body = str_replace("{stock}","<input type='text' name='stock' id=\"cssFormStyle\"  >",$body);

			// ***** ***** ***** *****
							
			//# 상품이미지	
			
				$body = str_replace("{images1}","이미지1",$body);
				$body = str_replace("{goodimg1}","<input type='file' name='userfile1' >",$body);
				$body = str_replace("{goodimg1_filename}","",$body);
			

				
			
				$body = str_replace("{images2}","이미지2",$body);
				$body = str_replace("{goodimg2}","<input type='file' name='userfile2' >",$body);
				$body = str_replace("{goodimg2_filename}","",$body);		
			

				
			
				$body = str_replace("{images3}","이미지3",$body);
				$body = str_replace("{goodimg3}","<input type='file' name='userfile3' >",$body);
				$body = str_replace("{goodimg3_filename}","",$body);
			

			//# 첨부파일 
			$body = str_replace("{filename1}","<input type='file' name='userfile6'>",$body);
			$body = str_replace("{filelink1}","",$body);

			$body = str_replace("{filename2}","<input type='file' name='userfile7'>",$body);
			$body = str_replace("{filelink2}","",$body);
				
			$body = str_replace("{filename3}","<input type='file' name='userfile8'>",$body);
			$body = str_replace("{filelink3}","",$body);



			//#언어별 상품명, 상품설명
			$query1 = "select * from `site_language` ";	
			if($rowss1 = _sales_query_rowss($query1)){
					
				$products_language = "";
				$products_forms = "";
				for($i=0;$i<count($rowss1);$i++){
					$rows1=$rowss1[$i];

					if($rows1->code == $site_language){
						$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='".$rows1->code."' checked=\"checked\">";
					} else {
						$products_language .= "<input id='tab-$i' type='radio' name='goods_language' value='".$rows1->code."'>";
					}
									
					$products_language .= "<label for='tab-$i'>".$rows1->code."</label>";
									
						
					$desktop = $rows1->code;
					$mobile = $rows1->code."_m";
									
					//$goodstring = _goodstring($UID,$rows1[code]);
					$code = $rows1->code;		
					$products_forms .="<div class='tab-$i_content'>
													   
											<table border='0' width='100%' cellspacing='5' cellpadding='5' style='border:1px solid #D2D2D2;' bgcolor='#FAFAFA'>
											<tr>
												<td width='110' align='right'>상품명(".$rows1->code.")</td>
												<td><textarea name='goodname_".$rows1->code."' rows='2' style='width:100%'></textarea></td>
											</tr>
											<tr>
												<td width='110' align='right'>스팩(".$rows1->code.")</td>
												<td><textarea name='spec_".$rows1->code."' rows='2' style='width:100%'></textarea></td>
											</tr>
											<tr>
												<td width='110' align='right'>간략설명(".$rows1->code.")</td>
												<td><textarea name='subtitle_".$rows1->code."' rows='2' style='width:100%'></textarea></td>
											</tr>
											<tr>
												<td width='110' align='right'>옵션(".$rows1->code.")</td>
												<td><textarea name='optionitem_".$rows1->code."' rows='2' style='width:100%'></textarea></td>
											</tr>
											<tr>
												<td width='110' align='right' valign='top'>HTML PC</td>
												<td><textarea name='".$rows1->code."' rows='10' style='width:100%'></textarea></td>
											</tr>
											<tr>
												<td width='110' align='right' valign='top'>HTML MOBILE</td>
												<td><textarea name='".$rows1->code."_m' rows='10' style='width:100%'></textarea></td>
											</tr>
											</table>
													   
										</div>";
									 
									
				}
								
				$body = str_replace("{selling_language_form}","<div id='css_tabs'> $products_language $products_forms </div>",$body);			
								
			}

			echo $body;
	

	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	/*




		

		
		// echo $uid;
			
		//$skin = "scm_shop_goods_edit";
		// if($_POST['popup'] || $_GET['popup']) $body = __popup_skin("Good Edit",$skin); else $body = __skin("Good Edit",$skin);

		

		
			
		if($goods = _shop_goods_rows($uid)){

		    
				

				


	*/
	
?>