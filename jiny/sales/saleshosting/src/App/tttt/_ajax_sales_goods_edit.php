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

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	// ERP Library
	include "./lib/company.php";
	include "./lib/goods.php";
	include "./lib/trans.php";
	include "./lib/report.php";



	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";

		$script = "<script>
				function form_submit(mode,uid){
					var url = \"/ajax_sales_goods_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('.mainbody').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					
				}

				function form_delete(mode,uid){
					var url = \"/ajax_sales_goods_editup.php?uid=\"+uid+\"&mode=\"+mode;
					
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


		$body = $script._skin_page($skin_name,"sales_goods_edit");

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
		
		$body=str_replace("{formstart}","<form id='data' name='goods' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		$query = "select * from `sales_goods` where Id = '$uid'";
		// echo $query."<br>";
    	if($rows= _sales_query_rows($query)){
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > 
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	} else {
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	}	
		

		if($rows->enable) $body = str_replace("{enable}",_form_check_enable("on"),$body);
			else $body = str_replace("{enable}",_form_check_enable(""),$body);

	
    	if($rows->bom == "on")	{
			$body = str_replace("{type_normal}","<input type=radio name=bom value=''>",$body);
			$body = str_replace("{type_bom}","<input type=radio name=bom value='on' checked='checked'>",$body);
		} else {
			$body = str_replace("{type_normal}","<input type=radio name=bom value=''checked='checked' >",$body);
			$body = str_replace("{type_bom}","<input type=radio name=bom value='on'>",$body);
		}

		if($rows->stock_check) $body = str_replace("{stock_check}",_form_checkbox("stock_check","on"),$body);
			else $body = str_replace("{stock_check}",_form_checkbox("stock_check",""),$body);	

		if($rows->stock_order) $body = str_replace("{stock_order}",_form_checkbox("stock_order","on"),$body);
			else $body = str_replace("{stock_order}",_form_checkbox("stock_order",""),$body);

		if($rows->shopping) $body = str_replace("{shopping}",_form_checkbox("shopping","on"),$body);
			else $body = str_replace("{shopping}",_form_checkbox("shopping",""),$body);		

		//# 사업장 선택 
		$form_business = "<select name='business' style=\"$css_textbox\" >";
		$form_business .= "<option value=''>사업장</option>";
		$query = "select * from sales_business where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->business == $rows1->Id) $form_business .= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>"; 
				else $form_business .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
			}
		}
		$form_business .= "</select>";
		$body = str_replace("{business}",$form_business,$body);

		//# 담당자 처리
		$form_manager = "<select name='manager' style=\"$css_textbox\" >";
		$form_manager .= "<option value=''>관리자</option>";
		$query = "select * from sales_manager where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->manager == $rows1->Id) $form_manager .= "<option value='".$rows1->Id."' selected>".$rows1->lastname."</option>"; 
				else $form_manager .= "<option value='".$rows1->Id."'>".$rows1->lastname."</option>";
			}
		}
		$form_manager .= "</select>";
		$body = str_replace("{manager}",$form_manager,$body);


		$body = str_replace("{country}",_form_select_country("goods_country","",$rows->country,$css_textbox),$body);


			if($rows->vat == "on")	{
				$body = str_replace("{vat1}","<input type=radio name=vat value='on' checked='checked'>",$body);
				$body = str_replace("{vat2}","<input type=radio name=vat value=''>",$body);
			} else {
				$body = str_replace("{vat1}","<input type=radio name=vat value='on'>",$body);
				$body = str_replace("{vat2}","<input type=radio name=vat value='' checked='checked'>",$body);
			}				
					
			$body = str_replace("{company}",_sales_company_select($rows->company),$body);	
			$body = str_replace("{cate}","<input type='text' name='cate'  value='".$rows->cate."' style=\"$css_textbox\">",$body);
			$body = str_replace("{name}","<input type='text' name='name'  value='".$rows->name."' style=\"$css_textbox\">",$body);
    		
			$body = str_replace("{barcode}","<input type='text' name='barcode'  value='".$rows->barcode."' style=\"$css_textbox\">",$body);
			$body = str_replace("{model}","<input type='text' name='model'  value='".$rows->model."' style=\"$css_textbox\">",$body);
			$body = str_replace("{brand}","<input type='text' name='brand'  value='".$rows->brand."' style=\"$css_textbox\">",$body);
			$body = str_replace("{goodcode}","<input type='text' name='goodcode'  value='".$rows->goodcode."' style=\"$css_textbox\">",$body);



		//# 매입 / B2B / 판매 가격 설정
		$query = "select * from `shop_currency`";
		if($rowss = _sales_query_rowss($query)){
			$buy_currency = "<select name='buy_currency' style=\"$css_textbox\" >";
			$b2b_currency = "<select name='b2b_currency' style=\"$css_textbox\" >";
			$sell_currency = "<select name='sell_currency' style=\"$css_textbox\" >";

			for($ii=0;$ii<count($rowss);$ii++){
				$rows1=$rowss[$ii];

				if($goods->buy_currency == $rows1->currency) {
					$buy_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$buy_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}

				if($goods->b2b_currency == $rows1->currency) {
					$b2b_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$b2b_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}

				if($goods->sell_currency == $rows1->currency) {
					$sell_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$sell_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}
			}
		}
		$buy_currency .= "</select>";
		$b2b_currency .= "</select>";
		$sell_currency .= "</select>";

		$body = str_replace("{buy_currency}",$buy_currency,$body);
		$body = str_replace("{b2b_currency}",$b2b_currency,$body);
		$body = str_replace("{sell_currency}",$sell_currency,$body);	

		$body = str_replace("{prices_sell}","<input type='text' name='prices_sell'  value='".$rows->prices_sell."' style=\"$css_textbox\">",$body);
		$body = str_replace("{prices_b2b}","<input type='text' name='prices_b2b'  value='".$rows->prices_b2b."' style=\"$css_textbox\">",$body);
		$body = str_replace("{prices_buy}","<input type='text' name='prices_buy'  value='".$rows->prices_buy."' style=\"$css_textbox\">",$body);

		//
		// $body = str_replace("{stock}","<input type='text' name='stock'  value='".$rows->stock."' style=\"$css_textbox\">",$body);
		$body = str_replace("{stock_safe}","<input type='text' name='stock_safe'  value='".$rows->stock_safe."' style=\"$css_textbox\">",$body);
		
		$body = str_replace("{comment}",_form_textarea("comment",$comment,"20",$css_textarea),$body);

		// 창고별 재고 관리
		$query1 = "select * from `sales_goods_house` ";
		if($rowss1 = _sales_query_rowss($query1)){
			for($i=0;$i<count($rowss1);$i++){
				$rows1 = $rowss1[$i];
				$code = "stock_".$rows1->Id;
				
				$stock_list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$stock_list .= "<td style='font-size:12px;padding:10px;' width=\"100\">".$rows1->name." :</td>
								<td style='font-size:12px;padding:10px;' width=\"100\"><input type='text' name='stock_".$rows1->Id."'  value='".$rows->$code."' style=\"$css_textbox\"></td>
								<td></td>";
				$stock_list .= "</tr></table>";

			}
			$body = str_replace("{stock}","",$body);
		} else {
			$body = str_replace("{stock}","<input type='text' name='stock'  value='".$rows->stock."' style=\"$css_textbox\">",$body);
		}

		$body = str_replace("{stock_list}",$stock_list,$body);	

		echo $body;		
	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$body = _skin_body($skin_name,"login");
		
		$login_script = "<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
		</script>";  

		echo $body.$login_script;
	}	

	/*
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
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
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
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    		
    		
    		switch($mode){
    			case 'del':
    				

    				page_back2();
    				
    				break;
    			case 'editup':
   		
	    			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
	    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
	 
    			
    				if(!$company) msg_alert("오류! 회사명이 없습니다.");
    				else {

						//# 사업자 번호 중복 검사
						if($rows[biznumber]) {
							$query = "select * from sales_company_$MEM[Id] where biznumber = '$biznumber'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if( mysql_num_rows($result) ) msg_alert("중복된 사업자 번호입니다.");
						} 
					
						if($rows[email]) {
							$query = "select * from sales_company_$MEM[Id] where email = '$email'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if( mysql_num_rows($result) ) msg_alert("중복된 이메일 주소 입니다.");
						} 
					
						$query = "UPDATE `sales_company_$MEM[Id]` SET `inout`='$inout', `company`='$company', `biznumber`='$biznumber', `president`='$president', 
    						`post`='$post', `address`='$address', `subject`='$subject', `item`='$item', `comment`='$comment', `discount`='$discount', `vat`='$vat', 
    						`email`='$email', `tel`='$tel', `fax`='$fax', `phone`='$phone', `group`='$group', `manager`='$manager',
    						`country`='$country', `currency`='$currency', `limitation`='$limitation' , `vat`='$vat', `vatrate`='$vatrate' WHERE `Id`='$UID'";
    					// echo $query."<br>";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					$query = "UPDATE `sales_company_$MEM[Id]` SET `balance1`='$balance1', `balance2`='$balance2' WHERE `Id`='$UID'";
    					// echo $query."<br>";
    					//mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					//# 마스터 업체목록 수정
    					if($email){
							$query = "select * from sales_company where email = '$email'";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if( mysql_num_rows($result) ){
								// 기존 DB, Tree 정보만 갱신
								$rows = mysql_fetch_array($result);
								$tree = $rows[tree]."$MEM[Id];";
								$query="UPDATE `sales_company` SET `company`='$company', `biznumber`='$biznumber', `president`='$president', 
										`post`='$post', `address`='$address', `subject`='$subject', `item`='$item', `tel`='$tel', `fax`='$fax', `phone`='$phone',
										 `country`='$country',`email`='$email'  WHERE `email`='$email'";
    							mysql_db_query($mysql_dbname,$query,$connect);
							} else {
								// 신규추가
								$tree = "$MEM[Id];";
								$query = "INSERT INTO `sales_company` (`regdate`,  
    										`company`, `biznumber`, `president`, `post`, `address`, `subject`, `item`, 
    										`email`, `tel`, `fax`, `phone`, `country`,`currency`,`vat`,`vatrate`,`tree`) 
    								VALUES ('$TODAY', 
    								'$company', '$biznumber', '$president', '$post', '$address', '$subject', '$item', 
    								'$email', '$tel', '$fax', '$phone',  '$country', '$currency',  '$vat', '$vatrate', '$tree')";
    							mysql_db_query($mysql_dbname,$query,$connect);
							}
						}

    					//#
    					
    					
    					
    					///////////
    					
    					
					 
					}
    			
    				page_back2(); 
    			
    				break;
    			default:
    				
    			
    				
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
	*/
?>

