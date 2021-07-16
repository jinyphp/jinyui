<?
	// 판매재고 관련 라이브러리 정리
	// 2016.04.01


	// ++ 상품별 창고 수량 변경
	function _sales_goodStock($gid,$house,$num){
		$query1 = "select * from sales_goods where Id='".$gid."'";
		if($goods_rows = _sales_query_rows($query1)){
			$stock = $goods_rows->$house + $num; 
			
			$query1 = "UPDATE sales_goods SET `$house`='$stock' where Id='".$gid."'";
			//echo $query1."<br>";
			_sales_query($query1);
		}
	}

	// ++ 판매재고 가격 설정
	function _sales_goodPricesSet($gid,$prices_sell,$prices_b2b,$prices_buy){
		$query1 = "UPDATE sales_goods SET ";

		if($prices_sell) $query1 .= "`prices_sell`='$prices_sell' ";
		if($prices_b2b) $query1 .= "`prices_b2b`='$prices_b2b' ";
		if($prices_buy) $query1 .= "`prices_buy`='$prices_buy' ";

		$query1 .= "where Id='".$gid."'";
		_sales_query($query1);
	}

	function _sales_totalStockHouse($rows,$house_rowss){
		$query1 = "select * from sales_goods where Id='".$rows->Id."'";
		//echo $query1."<br>";
		if($goods_rows = _sales_query_rows($query1)){
			for($i=0;$i<count($house_rowss);$i++){
				$rows = $house_rowss[$i];
				$house = "stock_".$rows->Id;
				$stock += $goods_rows->$house;
			}
			return $stock;
		}
	}



	function _company_type($type){
		if($type == "sell") $comtype = "←";
		else if($type == "buy") $comtype = "→";
		else if($type == "buysell") $comtype = "↔";
		else if($type == "personal") $comtype = "☺";
		return $comtype;
	}



	// 이메일 정보로, 서비스정보를 읽어옴
	function _service_hostRows_email($email){
		$query = "select * from service_host where email = '".$email."'";
		//echo $query."<br>";
		if($host_rows = _mysqli_query_rows($query)){
			return $host_rows;
		}
			
	}



	// 서비스에서 공유된 전표 정보를 읽어옵니다.
	function _service_transRows_Id($uid){
		$query = "select * from service.trans_sync where Id = '".$uid."'";
		// echo $query."<br>";	
		if($rows = _sales_query_rows($query)){
			return $rows;
		}
	}



	// ##### Business

	// 선택한 ID값으로 사업장 rows 가지고 옵니다
	function _sales_businessRows_Id($uid){
		$query = "select * from `sales_business` where Id = '".$uid."'";
		if($rows = _sales_query_rows($query)){	
			return $rows;
		}			
	}

	function _sales_businessRows_Email_Name($email,$business){
		$query = "select * from `sales_business` where email = '".$email."' and business = '".$business."'";
		if($business_rows = _sales_query_rows($query)){
			return $business_rows;
		}
	}

	function _sales_buinsessInsert_json($json){
		$import_rows = json_decode($json);

		$query = "INSERT INTO `sales_business` (`regdate`,`enable`,`auth`,
						`country`,`currency`,`inout`,`business`,
						`biznumber`,`president`,`post`,`address`,
						`subject`,`item`,`email`,
						`tel`,`fax`,`phone`,`vat`) 
					VALUES ('$TODAY','on','on',
						'".$import_rows->country."', '".$import_rows->currency."', '".$import_rows->inout."', '".$import_rows->company."', 
						'".$import_rows->biznumber."', '".$import_rows->president."', '".$import_rows->post."', '".$import_rows->address."', 
						'".$import_rows->subject."', '".$import_rows->item."', '".$import_rows->email."', 
						'".$import_rows->tel."', '".$import_rows->fax."', '".$import_rows->phone."', '".$import_rows->vat."')";
		// $query = str_replace(",)",")",$query);
		// echo $query."<br>";
		_sales_query($query);
	}


	// ##### Company

	function _sales_companyInsert_json($json){
		$export_rows = json_decode($json);    					
    	
		$query = "INSERT INTO `sales_company` (`regdate`,`enable`,`auth`,`business`,
						`country`,`currency`,`inout`,`company`,`biznumber`,
						`president`,`post`,`address`,
						`subject`,`item`,
						`email`,`tel`,`fax`,`phone`,`vat`,
						`balance_sell`,`balance_buy`,) 
					VALUES ('$TODAYTIME','on','on','$business',
						'".$export_rows->country."', '".$export_rows->currency."', '".$export_rows->inout."', '".$export_rows->business."', 
						'".$export_rows->biznumber."', '".$export_rows->president."', '".$export_rows->post."', '".$export_rows->address."', 
						'".$export_rows->subject."', '".$export_rows->item."',
						'".$export_rows->email."', '".$export_rows->tel."', '".$export_rows->fax."', '".$export_rows->phone."', ''".$export_rows->vat."', 
						'".$company_balance_sell."', '".$company_balance_buy."'') ";
		// $query = str_replace(",)",")",$query);
		// echo $query."<br>";
		_sales_query($query);
	}	

	// 선택한 ID값으로 거래처 rows 가지고 옵니다
	function _sales_companyRows_Id($uid){
		$query = "select * from `sales_company` where Id = '".$uid."'";
		//echo $query."<br>";
		if($rows = _sales_query_rows($query)){	
			return $rows;
		}			
	}

	function _sales_companyRows_Email_Name($email,$company){
		$query = "select * from `sales_company` where email = '".$email."' and company = '".$company."'";
		if($company_rows = _sales_query_rows($query)){
			return $company_rows;
		}
	}

	// Rows 거래처의 balance값을 trans타입에 따라서 prices 금액을 조정, sql 데이터를 갱신한다
	// 더가하는 그냉 prices , 빼기는 "-".prices 형태로 값을 넘긴다.
	function _sales_companyRows_balance($company_rows,$trans,$prices){
		if($trans == "sell"){
			$balance_sell = $company_rows->balance_sell + $prices;
			$query = "UPDATE `sales_company` SET `balance_sell`= '$balance_sell' WHERE `Id`='".$company_rows->Id."'";	
		} else if($trans == "buy"){
			$balance_buy = $company_rows->balance_buy + $prices;
			$query = "UPDATE `sales_company` SET `balance_buy`= '$balance_buy' WHERE `Id`='".$company_rows->Id."'";
		}
		_sales_query($query);		
	}

	// 선택한 ID거래처의 balance값을 trans타입에 따라서 prices 금액을 조정, sql 데이터를 갱신한다
	// 더가하는 그냉 prices , 빼기는 "-".prices 형태로 값을 넘긴다.
	function _sales_companyId_balance($uid,$trans,$prices){
		if($company_rows = _sales_companyRows_Id($uid)){	
			if($trans == "sell"){
				$balance_sell = $company_rows->balance_sell + $prices;
				$query = "UPDATE `sales_company` SET `balance_sell`= '$balance_sell' WHERE `Id`='".$uid."'";	
			} else if($trans == "buy"){
				$balance_buy = $company_rows->balance_buy + $prices;
				$query = "UPDATE `sales_company` SET `balance_buy`= '$balance_buy' WHERE `Id`='".$uid."'";
			}
			_sales_query($query);
			return true;
		} else {
			return false;
		}
	}

	// #####
	// 선택한 ID값으로 상품 rows 가지고 옵니다.
	function _sales_goodsRows_Id($uid){
		$query1 = "select * from `sales_goods` where Id='".$uid."'";
		//echo $query1."<br>";
		if($rows = _sales_query_rows($query1)){
			return $rows;
		}
	}


	
	// #####

	// 선택한 ID값으로 전표데이터 rows 가지고 옵니다.
	function _sales_transRows_Id($uid){
		$query = "select * from `sales_trans` where Id = '$uid'";
		if($rows = _sales_query_rows($query)){
			return $rows;
		}
	}

	// 선택한 전표를 삭제합니다.
	function _sales_transDelete_Id($uid){
		$query = "DELETE FROM `sales_trans` WHERE `Id`='$uid'";
    	//echo $query."<br>";
		_sales_query($query);
	}

	
	// 거래 전표를 import 입력합니다.
	function _sales_transImport($business_rows,$company_rows,$rows){
		global $TODAYTIME;

		$insert_filed .= "`business`,";
		$insert_value .= "'".$business_rows->Id."',";

		$insert_filed .= "`company_id`,";     		$insert_value .= "'".$company_rows->Id."',"; 
		$insert_filed .= "`company`,";     			$insert_value .= "'".$company_rows->company."',"; 


		$insert_filed .= "`regdate`,";		$insert_value .= "'$TODAYTIME',";    		
    	$insert_filed .= "`transdate`,";	$insert_value .= "'".$rows->transdate."',"; 

    	// 매입/매출 서로 교환하여 저장함  
    	if($rows->trans == "sell") $trans = "buy"; else if($rows->trans == "buy") $trans = "sell";
    	$insert_filed .= "`trans`,";   		$insert_value .= "'".$trans."',"; 
    		
    	// 상품정보 
    	$insert_filed .= "`gid`,"; 			$insert_value .= "'".$rows->gid."',";
    	$insert_filed .= "`goodname`,"; 	$insert_value .= "'".$rows->goodname."',";
    	$insert_filed .= "`spec`,"; 		$insert_value .= "'".$rows->spec."',";
    	$insert_filed .= "`num`,"; 			$insert_value .= "'".$rows->num."',";
    	$insert_filed .= "`currency`,"; 	$insert_value .= "'".$rows->currency."',";
    	$insert_filed .= "`prices`,"; 		$insert_value .= "'".$rows->prices."',";
    	$insert_filed .= "`vat`,"; 			$insert_value .= "'".$rows->vat."',";
    	$insert_filed .= "`discount`,"; 	$insert_value .= "'".$rows->discount."',";
    	$insert_filed .= "`sum`,"; 			$insert_value .= "'".$rows->sum."',";
    	$insert_filed .= "`total`,"; 		$insert_value .= "'".$rows->total."',";    			

    	$insert_filed .= "`paid`,";     	$insert_value .= "'".$rows->paid."',"; 
    	$insert_filed .= "`unpaid`,";     	$insert_value .= "'".$rows->unpaid."',"; 
    	$insert_filed .= "`paydate`,";     	$insert_value .= "'".$rows->paydate."',"; 
    	$insert_filed .= "`payment`,";     	$insert_value .= "'".$rows->payment."',"; 

		// cde : 바료 발급 상대방  
    	$insert_filed .= "`export_link`,"; 	$insert_value .= "'".$rows->transSync_code."',";

    	// 원 전표 Id
    	$insert_filed .= "`export_tid`,"; 	$insert_value .= "'".$rows->trans_id."',";

    	$insert_filed .= "`import`,"; 	$insert_value .= "'on',";  	
			

    	$query = "INSERT INTO `sales_trans` ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		echo $query."<br>";
		_sales_query($query);
	}



	// #####

	function _sales_managerPart_OnSelect($part){
		global $css_textbox;
		$query = "select * from sales_manager_part where enable ='on'";
		$form_part = "<select name='part' style=\"$css_textbox\" id=\"part\">";
		if($rowss = _sales_query_rowss($query)){
			if($part){
				$form_part .= "<option value=''>부서 선택</option>";
			} else {
				$form_part .= "<option value='' selected>부서 선택</option>";
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($part == $rows1->name) $form_part .= "<option value='".$rows1->name."' selected>".$rows1->name."</option>"; 
				else $form_part .= "<option value='".$rows1->name."'>".$rows1->name."</option>";
			}			
		}
		$form_part .= "</select>";
		return $form_part; 
	}	

	function _sales_managerLevel_OnSelect($level){
		global $css_textbox;
		$query = "select * from sales_manager_level where enable ='on'";
		$form_level = "<select name='level' style=\"$css_textbox\" id=\"level\">";
		if($rowss = _sales_query_rowss($query)){
			if($level){
				$form_level .= "<option value=''>직급 선택</option>";
			} else {
				$form_level .= "<option value='' selected>직급 선택</option>";
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($level == $rows1->name) $form_level .= "<option value='".$rows1->name."' selected>".$rows1->name."</option>"; 
				else $form_level .= "<option value='".$rows1->name."'>".$rows1->name."</option>";
			}			
		}
		$form_level .= "</select>";
		return $form_level; 
	}

			

	function _sales_warehouseRows_OnSelect($warehouse){
		global $css_textbox;
		$query = "select * from sales_goods_house where enable ='on'";
		$form_warehouse = "<select name='warehouse' style=\"$css_textbox\" id=\"warehouse\">";
		if($rowss = _sales_query_rowss($query)){
			if($warehouse){
				$form_warehouse .= "<option value=''>창고 선택</option>";
			} else {
				$form_warehouse .= "<option value='' selected>창고 선택</option>";
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($warehouse == $rows1->Id) $form_warehouse .= "<option value='".$rows1->Id."' selected>".$rows1->name."</option>"; 
				else $form_warehouse .= "<option value='".$rows1->Id."'>".$rows1->name."</option>";
			}
			
			
		}
		$form_warehouse .= "</select>";
		return $form_warehouse; 
	}	



	// 담당 관리자 테이블 selelct 2016.04.07
	// enable 담당자만 출력
	function _sales_managerRows_OnSelect($manager){
		global $css_textbox;
		$query = "select * from `sales_manager` where enable ='on'";
		$manager_select = "<select name='manager' style=\"$css_textbox\">";	
		if($rowss = _sales_query_rowss($query)){					
			
			if($manager){
				$manager_select .= "<option value=''>관리자 선택</option>";
			} else {
				$manager_select .= "<option value='' selected>관리자 선택</option>";
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($manager == $rows1->Id){
					$manager_select.= "<option value='".$rows1->Id."' selected>".$rows1->firstname." ".$rows1->lastname."</option>";
				} else $manager_select .= "<option value='".$rows1->Id."'>".$rows1->firstname." ".$rows1->lastname."</option>";
			}			
		}
		$manager_select .= "</select>";
		return $manager_select; 
	}


	// Business table을 셀렉트 2016.04.07
	//  
	function _sales_businessRows_select($business){
		global $css_textbox;
		$query = "select * from `sales_business`";
		$business_select = "<select name='business' style=\"$css_textbox\" id=\"business_id\">";	
		if($rowss = _sales_query_rowss($query)){					
			if(count($rowss)>1 || count($rowss)==0){
				if($business){
					$business_select .= "<option value=''>사업장 선택</option>";
				} else {
					$business_select .= "<option value='' selected>사업장 선택</option>";
				}
			}			

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($business == $rows1->Id){
					$business_select.= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>";
				} else $business_select .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
			}			
		}
		$business_select .= "</select>";
		return $business_select; 
	}



	// Company table을 셀렉트 2016.04.07
	//  
	function _sales_companyRows_select($company){
		global $css_textbox;
		$query = "select * from `sales_company`";
		$company_select = "<select name='company' style=\"$css_textbox\">";	
		if($rowss = _sales_query_rowss($query)){					
			if(count($rowss)>1 || count($rowss)==0){
				if($company){
					$company_select .= "<option value=''>거래처 선택</option>";
				} else {
					$company_select .= "<option value='' selected>거래처 선택</option>";
				}
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($company == $rows1->Id){
					$company_select.= "<option value='".$rows1->Id."' selected>".$rows1->company."</option>";
				} else $company_select .= "<option value='".$rows1->Id."'>".$rows1->company."</option>";
			}			
		}
		$company_select .= "</select>";
		return $company_select; 
	}


	// 국가별 사업자 입력양식 출력 2016.04.06
	// 
	function _sales_CompanyLicense_From($license,$country){
		
		if($country == "kr"){
			$licenseNumber = explode("-", $license);
			return "
			<input type='text' name='license1' value='".$licenseNumber[0]."' style=\"width:30px;height:24px;	font-size:12px;	border:1px solid #d8d8d8;\"> - 
			<input type='text' name='license2' value='".$licenseNumber[1]."' style=\"width:20px;height:24px;	font-size:12px;	border:1px solid #d8d8d8;\"> - 
			<input type='text' name='license3' value='".$licenseNumber[2]."' style=\"width:50px;height:24px;	font-size:12px;	border:1px solid #d8d8d8;\">";
		} else {
			$css_textbox = "width:50px;height:24px;	font-size:12px;	border:1px solid #d8d8d8;";
			return "<input type='text' name='biznumber'  value='".$rows->biznumber."' style=\"$css_textbox\" placeholder='사업자번호'>";
		}
	}

	function _sales_CompanyLicense_POST($country){
    	if($country == "kr"){
    		return $_POST['license1']."-".$_POST['license2']."-".$_POST['license3'];
    	} else {
    		return $_POST['biznumber'];
    	}
    }





    // 거래처 정보 조회
    // 거래처명 and Email
    function _is_salesCompany_NameEmail($name,$email){
    	$query = "select * from `sales_company` where email = '".$email."' and company = '".$name."'";
    	//echo $query."<br>";
		if($company_rows = _sales_query_rows($query)){
			return $company_rows;
		}
    }




    // 사업자 정보 조회
    // 사업자명 and Email
    function _is_salesBusiness_NameEmail($name,$email){
    	$query = "select * from `sales_business` where email = '".$email."' and business = '".$name."'";
		//echo $query."<br>";
		if($business_rows = _sales_query_rows($query)){
			return $business_rows;
		}
    }






































/*


	function _service_business_rowsByEmailName($email,$company){
		$query = "select * from service.business where email = '".$email."' and name = '$company'";
		if($TransBusiness_rows = _sales_query_rows($query)){
			// Service.Business 에서 데이터를 읽어, 새로운 거래처 삽입
			return _sales_company_newByBusiness($TransBusiness_rows);
		}
	}


	// 이메일, 상호명 으로 거래처 정보를 읽기
	// 정보가 있으면 데이터를 리턴, 없으면 거래처 추가함.
	function _sales_company_byNew($email,$company){
		$query1 = "select * from `sales_company` where email = '".$email."' and company = '".$company."'";
		if($company_rows = _sales_query_rows($query1)){
			return $company_rows;

		} else {
			// 등록된 거래처가 없습니다.
			// 신규 등록을 위해서 Master에 종보를 요구
			$query = "select * from service.business where email = '".$email."' and name = '$company'";
			if($TransBusiness_rows = _sales_query_rows($query)){
				// Service.Business 에서 데이터를 읽어, 새로운 거래처 삽입
				return _sales_company_newByBusiness($TransBusiness_rows);

			} else {
				// 신규 삽입
				$insert_filed .= "`regdate`,";	$insert_value .= "'$TODAYTIME',";
				$insert_filed .= "`email`,";	$insert_value .= "'$email',";
				$insert_filed .= "`company`,";	$insert_value .= "'$company',";

				$query = "INSERT INTO `sales_company` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);



				return _sales_company_rowsByEmailName($email,$company);

			}			
		}
	}


	//
	// service.Business 정보를 기준으로, 새로운 거래처를 삽입합니다.
	function _sales_company_newByBusiness($TransBusiness_rows){
		global $TODAYTIME;

		$insert_filed .= "`regdate`,";		$insert_value .= "'$TODAYTIME',";
		$insert_filed .= "`enable`,";		$insert_value .= "'on',";
		
    	$insert_filed .= "`country`,";		$insert_value .= "'".$transBusiness_rows->country."',";
		$insert_filed .= "`currency`,";		$insert_value .= "'".$transBusiness_rows->currency."',";
				
		$insert_filed .= "`inout`,";		$insert_value .= "'"._trans_reverse($transBusiness_rows->inout)."',";
    			
    	$insert_filed .= "`company`,";		$insert_value .= "'".$transBusiness_rows->name."',";
    	$insert_filed .= "`biznumber`,";	$insert_value .= "'".$transBusiness_rows->license."',";
    	$insert_filed .= "`president`,";	$insert_value .= "'".$transBusiness_rows->president."',";
    	$insert_filed .= "`post`,";			$insert_value .= "'".$transBusiness_rows->post."',";
    	$insert_filed .= "`address`,";		$insert_value .= "'".$transBusiness_rows->address."',";
    	$insert_filed .= "`subject`,";		$insert_value .= "'".$transBusiness_rows->subject."',";
    	$insert_filed .= "`item`,";			$insert_value .= "'".$transBusiness_rows->item."',";
    	$insert_filed .= "`email`,";		$insert_value .= "'".$transBusiness_rows->email."',";    					
    	$insert_filed .= "`tel`,";			$insert_value .= "'".$transBusiness_rows->tel."',";
    	$insert_filed .= "`fax`,";			$insert_value .= "'".$transBusiness_rows->fax."',";
    	$insert_filed .= "`phone`,";		$insert_value .= "'".$transBusiness_rows->phone."',";
    	$insert_filed .= "`vat`,";			$insert_value .= "'".$transBusiness_rows->vat."',";
    	$insert_filed .= "`vatrate`,";		$insert_value .= "'".$transBusiness_rows->vatrate."',";

    	$insert_filed .= "`link_auth`,";		$insert_value .= "'on',";
    	$insert_filed .= "`link`,";		$insert_value .= "'".$uid."',";
    	$insert_filed .= "`link_times`,";		$insert_value .= "'".$TODAYTIME."',";

		$query = "INSERT INTO `sales_company` ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		_sales_query($query);
		echo $query."<br>";

		return _sales_company_rowsByEmailName($transBusiness_rows->email, $transBusiness_rows->name);
	}

	function _trans_reverse($trans){
		if($trans == "sell") return "buy";
		else if($trans == "buy") return "sell";
		else return $trans;
	}

	*/

?>