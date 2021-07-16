<?

	//*  OpenShopping V2.1
	//*  programing by hojin lee

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/reseller.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/hosting.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/service/service.php");



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();	// echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		$server = _formdata("server");	

		if($mode == "delete"){
			// DB 레코드 삭제
			$query = "DELETE FROM `service_host_renewal` where Id =$uid";	// echo $query."<br>";
    		_mysqli_query($query);

    	} else if($mode == "cancel"){	

		} else if($mode == "reg_auth"){
			
			// 신규 가입한 회원
			// 가입 승인을 처리합니다.
			
			$query = "select * from `service_host_renewal` where Id =$uid";
			// echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){

				// 회원만 서비스 신청처리가 가능합니다.
				if(_is_members($rows->email)){

					_hosting_regauth($rows,$server);

				} else {
					$msg = "Error! 존재하지 않는 ".$rows->email." 회원 입니다.";
					echo "<script> alert(\"$msg\") </script>";
				}

			} else {
				$msg = "선택한 주문/연장 정보가 존재하지 않습니다.";
			}

		} else if($mode == "regauth_cencel"){
			_hosting_regauth_cancel($uid);
		}	

		// 페이지 이동 
		$url = "hosting_renewal.php?limit=".$limit."&ajaxkey=".$ajaxkey."&list_num=".$list_num;
		echo "<script> url_replace(\"$url\") </script>";		
		

	} else {
		// Ajax 오류 메세지 출력
		$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;	
	}





	function _hosting_regauth_cancel($uid){
		$query = "select * from `service_host_renewal` where Id ='$uid'";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){

			// 미승인 상태로 변경 
			$query = "UPDATE `service_host_renewal` SET `auth`='' WHERE `Id`='".$uid."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		$query = "DELETE FROM `service_host` where email ='".$rows->email."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    	}

	}

	//**
	//** 호스팅 신규사용자 승인처리 함수
	function _hosting_regauth($rows,$server){
		global $TODAYTIME;

		// 서비스 Host 퀴리 생성
		//
		$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
		$insert_filed .= "`enable`,";	$insert_value .= "'on',";
		$insert_filed .= "`reseller`,";	$insert_value .= "'".$rows->reseller."',";
		$insert_filed .= "`email`,";	$insert_value .= "'".$rows->email."',";
		$insert_filed .= "`name`,";		$insert_value .= "'".$rows->name."',";

		$query = "select * from `service_server` where name = '".$server."'"; 
		// echo $query."<br>";
		if($server_rows = _mysqli_query_rows($query)){
			$insert_filed .= "`server`,";	$insert_value .= "'".$server_rows->name."',";
			$insert_filed .= "`hostname`,";	$insert_value .= "'".$server_rows->host."',";
			$insert_filed .= "`database`,";	$insert_value .= "'".$server_rows->dbname."',";

			// 
			$insert_filed .= "`user`,";		$insert_value .= "'".$server_rows->root."',";
			$insert_filed .= "`password`,";	$insert_value .= "'".$server_rows->password."',";
		}

		$query = "select * from `service_products` where Id = '".$rows->plan."'"; 
		// echo $query."<br>";
		if($plan_rows = _mysqli_query_rows($query)){	
			$insert_filed .= "`title`,";	$insert_value .= "'".$plan_rows->title."',";
			$insert_filed .= "`site`,";		$insert_value .= "'".$plan_rows->site."',";
			$insert_filed .= "`shop`,";		$insert_value .= "'".$plan_rows->shop."',";
			$insert_filed .= "`sales`,";	$insert_value .= "'".$plan_rows->sales."',";
			$insert_filed .= "`company`,";	$insert_value .= "'".$plan_rows->company."',";
			$insert_filed .= "`business`,";	$insert_value .= "'".$plan_rows->business."',";
			$insert_filed .= "`trans`,";	$insert_value .= "'".$plan_rows->trans."',";
			$insert_filed .= "`quotation`,";$insert_value .= "'".$plan_rows->quotation."',";
			$insert_filed .= "`house`,";	$insert_value .= "'".$plan_rows->house."',";
			$insert_filed .= "`manager`,";	$insert_value .= "'".$plan_rows->manager."',";
			$insert_filed .= "`taxprint`,";	$insert_value .= "'".$plan_rows->taxprint."',";
			
			$insert_filed .= "`setup`,";	$insert_value .= "'".$plan_rows->setup."',";
			$insert_filed .= "`charge`,";	$insert_value .= "'".$plan_rows->charge."',";
		}

		$insert_filed .= "`description`,";	$insert_value .= "'".$rows->description."',";

		$insert_filed .= "`expire`,";					
		$insert_value .= "'$TODAY',";

		// 어드민 토큰키
		$adminkey = md5('admin'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$insert_filed .= "`adminkey`,";					
		$insert_value .= "'$adminkey',";

		$query = "INSERT INTO `service_host` ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		// echo $query."<br>";
		_mysqli_query($query);	


		//
		// 주믄을 승인 상태로 변경 처림함 
		$query = "UPDATE `service_host_renewal` SET `auth`='on' WHERE `Id`='".$rows->Id."'";
    	echo $query."<br>";
    	_mysqli_query($query);

    	//
    	// 결제비용 처리

    	//
    	// 호스팅 데이터베이스 생성 
    	if(_mysqli_is_database($rows->service_code)){
   			echo "Database : ".$rows->service_code."<br>";
   		} else {
   			echo "Create : $database_target"."<br>";
   			_mysqli_database_create($rows->service_code);
   		}

	}





	function _hosting_user_renewal_auth($uid){
		global $TODAYTIME;

		$query = "select * from `service_host_renewal` where Id =$uid";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){

			$reseller_rows = _reseller_rows($rows->email);

			echo "이머니 처리 및 체널 계층 분배"."<br>";
    				/*  리셀러 주문 승인
		 			*  주문자 이머니 차감 > 리셀러 이머니 적립 
		 			*  리셀링 발주 차감 > 
		 			*  상위 릴셀러 : 마진 적립 
		 			*/ 
		 			
			// 주문자 이머니 차감 
			// ex) 10만원 결제
			//$amount = $rows->setup + $rows->charge;
			_reseller_emoney_down($rows->pay_amount,$rows->email,"호스팅 연장비용 /출금");


			// 리셀러1 : 이머니 적립 이동
			// ex) 10만원 적립
			if($reseller1 = _reseller_rows($rows->reseller)){
				_reseller_emoney_up($rows->pay_amount,$reseller1->email,"호스팅 연장비용 /입금");

				// 리셀러1 : 리셀링 발주
				// ex) 마진율 20%, 10 * 0.8 = 8만원 리셀링 차감 결제 
				// 20% 이윤으로 남음 
				$margin_amount =  $rows->pay_amount / 100 * $reseller1->margin;
				$order_prices = $rows->pay_amount - $margin_amount;
				_reseller_emoney_down($order_prices,$reseller1->email,"재발주] 호스팅 연장비용 (".$reseller1->margin."%) /결제: order(".$rows->Id.")");

			} else $order_prices = $rows->pay_amount;

			// **
			// 차감 8만원을 기준으로, 상위 리셀러 분배 
			// $order_prices

			// 리셀러2 : 마진 계산 적립
			// ex) 리셀러는 마진 30%, 
			if($reseller2 = _reseller_rows($reseller1->reseller)){
				if($reseller2->level >1 && $reseller2->sub > 2 ){
					$margin_rate = $reseller2->margin - $reseller1->margin; // 마진차액 계산
					$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
					$order_prices = $order_prices - $margin_amount;
					_reseller_emoney_up($margin_amount,$reseller2->email," 호스팅 연장비용 커미션 L2(".$margin_rate."%) /입금 <".$reseller1->email." : order(".$rows->Id.")");
				}						
			}

			// 리셀러3 : 마진 계산 적립
			// ex) 리셀러는 마진 40%, 
			if($reseller3 = _reseller_rows($reseller2->reseller)){
				if($reseller3->level >1 && $reseller2->sub > 3){
					$margin_rate = $reseller3->margin - $reseller2->margin; // 마진차액 계산
					$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
					$order_prices = $order_prices - $margin_amount;
					_reseller_emoney_up($margin_amount,$reseller3->email," 호스팅 연장비용 커미션 L3(".$margin_rate."%) /입금 <".$reseller2->email." : order(".$rows->Id.")");
				}
			}

			// 리셀러4 : 마진 계산 적립
			// ex) 리셀러는 마진 50%, 
			if($reseller4 = _reseller_rows($reseller3->reseller)){
				if($reseller4->level >1 && $reseller2->sub > 4){
					$margin_rate = $reseller4->margin - $reseller3->margin; // 마진차액 계산
					$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
					$order_prices = $order_prices - $margin_amount;
					_reseller_emoney_up($margin_amount,$reseller4->email," 호스팅 연장비용 커미션 L4(".$margin_rate."%) /입금 <".$reseller3->email." : order(".$rows->Id.")");
				}
			}

			// 최종 남은 금액은 , 본사 적립
			_reseller_emoney_up($order_prices,"infohojin@naver.com"," 호스팅 연장비용 커미션 M /입금 : order(".$rows->Id.")");

				

			///////////////////
    		// 신청서, 승인 부분 체크 
    		// $expire = $reseller_rows->expire + $rows->priod;
    		$expire = _date_month("+".$rows->priod." months",$rows->expire);
			$query = "UPDATE `service_host` SET `expire`='$expire' WHERE `email`='".$rows->email."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		// 연장 승인 처리
    		$query = "UPDATE `service_host_renewal` SET `auth`='on' WHERE `Id`='".$uid."'";
    		echo $query."<br>";
    		_mysqli_query($query);
			
		}	

	}	

	function _hosting_user_renewal($uid){
		global $TODAYTIME;
		// 리셀러 연장신청서 삽입 
	
		$query = "select * from `service_host` WHERE `Id`='$uid'";
		if($rows = _mysqli_query_rows($query)){
			$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
			$insert_filed .= "`type`,";		$insert_value .= "'renewal',";
				
			$insert_filed .= "`reseller`,";	$insert_value .= "'".$rows->reseller."',"; // 상위 리셀러 (이메일) 
			$insert_filed .= "`email`,";	$insert_value .= "'".$rows->email."',"; // 신청자 이메일 

			$insert_filed .= "`service_code`,";	$insert_value .= "'".$rows->code."',"; // 상위 리셀러 (이메일) 
			$insert_filed .= "`domain`,";	$insert_value .= "'".$rows->domain."',"; // 상위 리셀러 (이메일) 

			$insert_filed .= "`name`,";	$insert_value .= "'".$rows->name."',"; // 상위 리셀러 (이메일) 

			$insert_filed .= "`plan`,";	$insert_value .= "'".$rows->plan."',";

			$insert_filed .= "`setup`,";	$insert_value .= "'".$rows->setup."',";
			$insert_filed .= "`charge`,";	$insert_value .= "'".$rows->charge."',";

			if($priod = _formdata("priod")){
				$insert_filed .= "`priod`,";	$insert_value .= "'$priod',"; // 상위 리셀러 (이메일) 
			}

			if($pay_amount = _formdata("pay_amount")){
				$insert_filed .= "`pay_amount`,";	$insert_value .= "'$pay_amount',"; // 상위 리셀러 (이메일) 
			}

			if($pay_user = _formdata("pay_user")){
				$insert_filed .= "`pay_user`,";	$insert_value .= "'$pay_user',"; // 상위 리셀러 (이메일) 
			}


			$title = "호스팅 ".$rows->plan." 연장 ";
			$insert_filed .= "`title`,";	$insert_value .= "'$title',";

			$query = "INSERT INTO `service_host_renewal` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);

				// echo "<script> location.replace(\"reseller.php?limit=$limit\"); </script>";

		}
	

	}


	function _hosting_update($uid){
		// 수정모드
		$query = "UPDATE `service_host` SET ";

		if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

		if($reseller = _formdata("reseller")) $query .= "`reseller`='$reseller' ,";
		if($email = _formdata("email")) $query .= "`email`='$email' ,";
		if($name = _formdata("name")) $query .= "`name`='$name' ,";
		if($domain = _formdata("domain")) $query .= "`domain`='$domain' ,";

		if($db_server = _formdata("db_server")) $query .= "`server`='$db_server' ,";
		if($db_address = _formdata("db_address")) $query .= "`hostname`='$db_address' ,";
		if($db_database = _formdata("db_database")) $query .= "`database`='$db_database' ,";
		if($db_id = _formdata("db_id")) $query .= "`user`='$db_id' ,";
		if($db_password = _formdata("db_password")) $query .= "`password`='$db_password' ,";

		if($title = _formdata("title")) $query .= "`title`='$title' ,";

		if($shop = _formdata("shop")) $query .= "`shop`='$shop' ,";
		if($site = _formdata("site")) $query .= "`site`='$site' ,";
		if($sales = _formdata("sales")) $query .= "`sales`='$sales' ,";
		if($company = _formdata("company")) $query .= "`company`='$company' ,";
		if($business = _formdata("business")) $query .= "`business`='$business' ,";
		if($trans = _formdata("trans")) $query .= "`trans`='$trans' ,";
		if($house = _formdata("house")) $query .= "`house`='$house' ,";
		if($manager = _formdata("manager")) $query .= "`manager`='$manager' ,";
		if($quotation = _formdata("quotation")) $query .= "`quotation`='$quotation' ,";
		if($taxprint = _formdata("taxprint")) $query .= "`taxprint`='$taxprint' ,";

		if($setup = _formdata("setup")) $query .= "`setup`='$setup' ,";
		if($charge = _formdata("charge")) $query .= "`charge`='$charge' ,";
				
		if($description = _formdata("description")) $query .= "`description`='$description' ,";				

		$query .= "WHERE Id =$uid";
		$query = str_replace(",WHERE","where ",$query);
		echo $query;
		_mysqli_query($query);
	}

	

	

	
?>