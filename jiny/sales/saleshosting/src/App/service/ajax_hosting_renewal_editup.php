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

	function _expire_month($month,$date){
		// 0123 4 56 7 89
		$_year = substr($date,0,4);	// 주어진 날짜의 년도
		$_month = substr($date,5,2);	// 주어진 날짜의 달
		$_day = substr($date,8,2);		// 주어진 날짜의 일

		$m = $_month + $month;	// 주어진 달 + 연장할 달
		$_year += intval($m / 12);		// 합산한 달이 12달을 넘을 경우, 년도를 증가함.
		$mm = intval($m % 12);			// 합산한 달이 12 이하의 수 

		return $_year."-".$mm."-".$_day;
	}

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// 서비스 관련 함수들 
		include "service_function.php";

		$mode = _formmode();	
		// echo "mode = ".$mode."<br>";
		
		$uid = _formdata("uid");
		$limit = _formdata("limit");		
		$list_num = _formdata("list_num");
		$server = _formdata("server");	

		
		if($mode == "delete"){
			// DB 레코드 삭제
			$query = "DELETE FROM service.service_host_renewal where Id =$uid";
    		//echo $query."<br>";
    		_mysqli_query($query);

    	} else if($mode == "cancel"){	
    		// 가입 신청 삭제
    		//echo "가입 신청 삭제";
    		$query = "DELETE FROM service.service_host_renewal where Id =$uid";
    		//echo $query."<br>";
    		_mysqli_query($query);

    	} else if($mode == "hostingRenewal_auth"){
    		// 호스팅 연장 승인
    		$query = "select * from service.service_host_renewal where Id =$uid";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){		

				$host_rows = _service_hostRows_Id($rows->Id);

				///////////////////
    			// 신청서, 승인 부분 체크 
    			// $expire = _date_month("+".$rows->priod." months",$host_rows->expire);
    			$expire = _expire_month($rows->priod, $host_rows->expire);
				$query = "UPDATE service.service_host SET `expire`='$expire' WHERE `email`='".$rows->email."'";
    			//echo $query."<br>";
    			_mysqli_query($query);

    			// 연장 승인 처리
    			$query = "UPDATE service.service_host_renewal SET `auth`='on' WHERE `Id`='".$uid."'";
    			//echo $query."<br>";
    			_mysqli_query($query);

    			// 금액차감, 결제금액
    			_marginTreeLoop("hostingRenewal",$uid,$rows->pay_amount,$rows->email);
			
			}	

		} else if($mode == "hostingRenewal_cancel"){
			// 호스팅 연장을 취소합니다.
    		$query = "select * from service.service_host_renewal where Id =$uid";
			//echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){		

				$host_rows = _service_hostRows_Id($rows->Id);

				// 금액차감, 결제금액
    			_marginTreeLoop("hostingRenewal",$uid,"-".$rows->pay_amount,$rows->email);

				///////////////////
    			// 신청서, 승인 부분 체크 
    			// $expire = _date_month("-".$rows->priod." months",$host_rows->expire);
    			$expire = _expire_month("-".$rows->priod, $host_rows->expire);
				$query = "UPDATE service.service_host SET `expire`='$expire' WHERE `email`='".$rows->email."'";
    			//echo $query."<br>";
    			_mysqli_query($query);

    			// 연장 승인 처리
    			$query = "UPDATE service.service_host_renewal SET `auth`='' WHERE `Id`='".$uid."'";
    			//echo $query."<br>";
    			_mysqli_query($query);
			
			}	



		} else if($mode == "hostingRegist_auth"){
			// 호스팅 가입 승인
			echo "신규가입을 승인합니다.";

			$query = "select * from service.service_host_renewal where Id =$uid";
			echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){
				// 회원만 서비스 신청처리가 가능합니다.
				if(_is_members($rows->email)){

					_service_hostingRegistAuth($rows,$server);

					//
    				// 결제비용 처리
    				// 금액차감, 결제금액
					_marginTreeLoop("hostingRegist",$uid,$rows->pay_amount,$rows->email);

				} else {
					$msg = "Error! 존재하지 않는 ".$rows->email." 회원 입니다.";
					echo "<script> alert(\"$msg\") </script>";
				}	

			} else {
				$msg = "선택한 주문/연장 정보가 존재하지 않습니다.";
				echo "<script> alert(\"$msg\") </script>";
			}

			

		} else if($mode == "hostingRegist_cancel"){
			// 호스팅 가입승인 취소
			_hosting_hostingRegist_cancel($uid);

		}	

		// 페이지 이동 
		$url = "hosting_renewal.php?limit=".$limit."&list_num=".$list_num;
		// echo "<script> url_replace(\"$url\") </script>";		
		


	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}





	// 신규 호스팅 사용자 승인
	function _service_hostingRegistAuth($rows,$server){
		global $TODAYTIME,$TODAY;

		$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
		$insert_filed .= "`enable`,";	$insert_value .= "'on',";
		$insert_filed .= "`reseller`,";	$insert_value .= "'".$rows->reseller."',";
		$insert_filed .= "`email`,";	$insert_value .= "'".$rows->email."',";
		$insert_filed .= "`name`,";		$insert_value .= "'".$rows->name."',";

		// 선택한 서버정보 설정
		
		if($server_rows = _service_serverRows_Id($server)){
			$insert_filed .= "`server`,";	$insert_value .= "'".$server_rows->name."',";
			$insert_filed .= "`hostname`,";	$insert_value .= "'".$server_rows->host."',";
			$insert_filed .= "`database`,";	$insert_value .= "'".$rows->service_code."',";
			$insert_filed .= "`user`,";		$insert_value .= "'".$server_rows->root."',";
			$insert_filed .= "`password`,";	$insert_value .= "'".$server_rows->password."',";
		}

		// 선택한 호스팅 프렌설정 
		if($plan_rows = _service_hostingPlanRows_Id($rows->plan)){	
			$insert_filed .= "`plan`,";	$insert_value .= "'".$rows->plan."',";

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

		//만기일
		// $expire = _date_month("+".$rows->priod." months",$TODAY);
		$expire = _expire_month($rows->priod, $TODAY);
		$insert_filed .= "`expire`,";		$insert_value .= "'$expire',";

		// 어드민 토큰키
		$adminkey = md5('admin'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$insert_filed .= "`adminkey`,";					
		$insert_value .= "'$adminkey',";

		$query = "INSERT INTO service.service_host ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		echo $query."<br>";
		_mysqli_query($query);	

		
		// #####
		// 주믄을 승인 상태로 변경 처림함 
		$query = "UPDATE service.service_host_renewal SET `auth`='on' WHERE `Id`='".$rows->Id."'";
    	echo $query."<br>";
    	_mysqli_query($query);


    	//
    	// 계정 생성 및 데이터베이스 처리    	
    	if(_mysqli_is_database($rows->service_code)){
   			// 데이터베이스가 존재합니다.
   			echo "Database : ".$rows->service_code."<br>";
   		
   		} else {
   			// 데이터베이스를 생성합니다.
   			echo "Create : ".$rows->service_code."<br>";
   			$service_code = $rows->service_code;
   			_mysqli_database_create($rows->service_code);

   			/*
   			$database = "dojangshop";
   			$query = "show tables from ".$database;
   			echo $query."<br>";
   			if($rowss = _mysqli_query_rowss($query)){
   				echo "tables = ".count($rowss)."<br>";
   				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];

					$filedname = "Tables_in_".$database;
					$table_name = $rows->$filedname;
					echo "$i : Tables = ".$table_name."<br>";

					$query = "create table ".$service_code.".$table_name like $database.$table_name;";
					echo $query."<br>";
					_mysqli_query($query);

					$query = "INSERT INTO ".$service_code.".$table_name SELECT * FROM $database.$table_name;";
					echo $query."<br>";
					_mysqli_query($query);

				}
   			}


			*/

   			// 생성한 데이터베이스에 기초 DB를 입력합니다.
   			// shop_default.sql 기본데이터를 삽입합니다.
   			global $mysql_user,$mysql_password; 
   			$command = "mysql -u$mysql_user -p$mysql_password ".$rows->service_code." < shop_default.sql &";
   			echo $command;
   			exec($command,$output);

   			// shell 방식으로 계정생성 및 파일을 복사합니다.
   			$user = $rows->service_code;
			$domain = $user.".dojangshop.com";


			$db_host = "localhost";
			$db_user = $server_rows->root;
			$db_password = $server_rows->password;
			$db_database = $user;


			echo "<br>create user directory<br>";
			$command = "sh ./add_sales.sh ".$user;
   			echo $command;
   			exec($command,$output);

   			echo "<br>create db conf <br>";
			$command = "sh ./add_dbconf.sh $db_host $db_database $db_user $db_password > ../../$user/conf/dbinfo.php";
   			echo $command;
   			exec($command,$output);

   			//echo "<br>create vhost <br>";
   			//$command = "sh ./add_vhost.sh $user $domain >> httpd-vhosts.conf";
   			//echo $command;
   			//exec($command,$output);



   		}	
   	
   		
   		



   		////

	}


	//** 가입승인 취소
	function _hosting_hostingRegist_cancel($uid){
		$query = "select * from service.service_host_renewal where Id ='$uid'";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){

			// 결제비용 처리
    		// 금액차감, 결제금액
			_marginTreeLoop("hostingRegist",$uid,"-".$rows->pay_amount,$rows->email);

			// 미승인 상태로 변경 
			$query = "UPDATE service.service_host_renewal SET `auth`='' WHERE `Id`='".$uid."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		// 서비스 정보 삭제
    		$query = "DELETE FROM service.service_host where email ='".$rows->email."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		// 데이터베이스 삭제
    		$query = "DROP DATABASE `".$rows->service_code."`";
    		_mysqli_query($query);

    	}
	}

	


	/*

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

	

	*/

	
?>