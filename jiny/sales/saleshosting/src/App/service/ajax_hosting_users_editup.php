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
		
		// 서비스 관련 함수들 
		include "service_function.php";

		$mode = _formmode();
		echo "mode = ".$mode."<br>";
		$uid = _formdata("uid");	

		if($mode == "enable"){
			$query = "UPDATE service.service_host SET `enable`='on' WHERE Id =$uid";
			_mysqli_query($query);

			// 페이지 이동 
			$url = "hosting_users.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "disable"){
			$query = "UPDATE service.service_host SET `enable`='' WHERE Id =$uid";
			_mysqli_query($query);

			// 페이지 이동 
			$url = "hosting_users.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode=="edit"){
			$query = "select * from service.service_host WHERE Id = $uid";
			if($rows = _mysqli_query_rows($query)) {
				// 수정모드
				$query = "UPDATE service.service_host SET ";

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

				if($plan = _formdata("plan")) $query .= "`plan`='$plan' ,";

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

			// 페이지 이동 
			$url = "hosting_users.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode=="new"){
			// _hosting_new();
			// 신규 서비스 Host 등록

			$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
			$insert_filed = "`enable`,";	$insert_value = "'"._formdata("enable")."',";

			$insert_filed = "`reseller`,";	$insert_value = "'"._formdata("reseller")."',";
			$insert_filed = "`email`,";	$insert_value = "'"._formdata("email")."',";
			$insert_filed = "`domain`,";	$insert_value = "'"._formdata("domain")."',";
			$insert_filed = "`name`,";	$insert_value = "'"._formdata("name")."',";

			$insert_filed = "`db_server`,";	$insert_value = "'"._formdata("db_server")."',";
			$insert_filed = "`db_address`,";	$insert_value = "'"._formdata("db_address")."',";
			$insert_filed = "`db_database`,";	$insert_value = "'"._formdata("db_database")."',";
			$insert_filed = "`db_id`,";	$insert_value = "'"._formdata("db_id")."',";
			$insert_filed = "`db_password`,";	$insert_value = "'"._formdata("db_password")."',";
			
			$insert_filed = "`plan`,";	$insert_value = "'"._formdata("plan")."',";

			$insert_filed = "`shop`,";	$insert_value = "'"._formdata("shop")."',";
			$insert_filed = "`site`,";	$insert_value = "'"._formdata("site")."',";
			$insert_filed = "`sales`,";	$insert_value = "'"._formdata("sales")."',";
			$insert_filed = "`company`,";	$insert_value = "'"._formdata("company")."',";
			$insert_filed = "`business`,";	$insert_value = "'"._formdata("business")."',";
			$insert_filed = "`trans`,";	$insert_value = "'"._formdata("trans")."',";
			$insert_filed = "`house`,";	$insert_value = "'"._formdata("house")."',";
			$insert_filed = "`manager`,";	$insert_value = "'"._formdata("manager")."',";
			$insert_filed = "`quotation`,";	$insert_value = "'"._formdata("quotation")."',";
			$insert_filed = "`taxprint`,";	$insert_value = "'"._formdata("taxprint")."',";


			$insert_filed = "`setup`,";	$insert_value = "'"._formdata("setup")."',";
			$insert_filed = "`charge`,";	$insert_value = "'"._formdata("charge")."',";
			$insert_filed = "`description`,";	$insert_value = "'".addslashes(_formdata("description"))."',";


			$query = "INSERT INTO service.service_host ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);

			// 페이지 이동 
			$url = "hosting_users.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "hostingRenewal"){
			_hosting_user_renewal($uid);

		} else if($mode == "renewal_auth"){	
			_hosting_user_renewal_auth($uid);

			// 페이지 이동 
			$url = "hosting_users.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";

		} else if($mode == "delete"){
			$query = "DELETE FROM service.service_host WHERE `Id`='$uid'";
			_mysqli_query($query);

			// 페이지 이동 
			$url = "hosting_users.php?limit=".$limit."&ajaxkey=".$ajaxkey;
			echo "<script> url_replace(\"$url\") </script>";
		}		

	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}










	function _hosting_user_renewal_auth($uid){
		global $TODAYTIME;

/*
		$query = "select * from `service_host_renewal` where Id =$uid";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){

			$reseller_rows = _service_resellerRows($rows->email);

			echo "이머니 처리 및 체널 계층 분배"."<br>";
    	
		 			
			// 주문자 이머니 차감 
			// ex) 10만원 결제
			//$amount = $rows->setup + $rows->charge;
			_reseller_emoney_down($rows->pay_amount,$rows->email,"호스팅 연장비용 /출금");


			// 리셀러1 : 이머니 적립 이동
			// ex) 10만원 적립
			if($reseller1 = _service_resellerRows($rows->reseller)){
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
			if($reseller2 = _service_resellerRows($reseller1->reseller)){
				if($reseller2->level >1 && $reseller2->sub > 2 ){
					$margin_rate = $reseller2->margin - $reseller1->margin; // 마진차액 계산
					$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
					$order_prices = $order_prices - $margin_amount;
					_reseller_emoney_up($margin_amount,$reseller2->email," 호스팅 연장비용 커미션 L2(".$margin_rate."%) /입금 <".$reseller1->email." : order(".$rows->Id.")");
				}						
			}

			// 리셀러3 : 마진 계산 적립
			// ex) 리셀러는 마진 40%, 
			if($reseller3 = _service_resellerRows($reseller2->reseller)){
				if($reseller3->level >1 && $reseller2->sub > 3){
					$margin_rate = $reseller3->margin - $reseller2->margin; // 마진차액 계산
					$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
					$order_prices = $order_prices - $margin_amount;
					_reseller_emoney_up($margin_amount,$reseller3->email," 호스팅 연장비용 커미션 L3(".$margin_rate."%) /입금 <".$reseller2->email." : order(".$rows->Id.")");
				}
			}

			// 리셀러4 : 마진 계산 적립
			// ex) 리셀러는 마진 50%, 
			if($reseller4 = _service_resellerRows($reseller3->reseller)){
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
			$query = "UPDATE service.service_host SET `expire`='$expire' WHERE `email`='".$rows->email."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		// 연장 승인 처리
    		$query = "UPDATE `service_host_renewal` SET `auth`='on' WHERE `Id`='".$uid."'";
    		echo $query."<br>";
    		_mysqli_query($query);
			
		}
		*/	

	}	








	function _hosting_user_renewal($uid){
		global $TODAYTIME;
		// 리셀러 연장신청서 삽입 
	
		// $query = "select * from service.service_host WHERE `Id`='$uid'";
		if($rows = _service_hostRows_Id($uid)){

			$insert_filed = "`regdate`,";	
			$insert_value = "'$TODAYTIME',";
			
			$insert_filed .= "`type`,";		
			$insert_value .= "'hostingRenewal',";
				
			$insert_filed .= "`reseller`,";	
			$insert_value .= "'".$rows->reseller."',"; 
			
			$insert_filed .= "`email`,";	
			$insert_value .= "'".$rows->email."',"; 

			$insert_filed .= "`service_code`,";	
			$insert_value .= "'".$rows->code."',"; 
			
			$insert_filed .= "`domain`,";	
			$insert_value .= "'".$rows->domain."',"; 

			$insert_filed .= "`name`,";	
			$insert_value .= "'".$rows->name."',"; 

			$insert_filed .= "`plan`,";	
			$insert_value .= "'".$rows->plan."',";

			$insert_filed .= "`setup`,";	
			$insert_value .= "'".$rows->setup."',";
			
			$insert_filed .= "`charge`,";	
			$insert_value .= "'".$rows->charge."',";

			$insert_filed .= "`priod`,";	
			$insert_value .= "'1',"; 

			$insert_filed .= "`pay_amount`,";	
			$insert_value .= "'".$rows->charge."',"; 

			$insert_filed .= "`pay_user`,";		
			$insert_value .= "'system',"; 

			$title = "호스팅 ".$rows->plan." 연장 ";
			$insert_filed .= "`title`,";	
			$insert_value .= "'$title',";

			$insert_filed .= "`server`,";	
			$insert_value .= "'".$rows->server."',"; 

			$query = "INSERT INTO service.service_host_renewal ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);

		}
	

	}




	

	

	
?>