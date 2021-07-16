<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

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



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		// 서비스 관련 함수들 
		include "service_function.php";

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");		

		if($uid && $mode == "edit"){
					// $query = "select * from service.reseller WHERE `Id`='$uid'";
			if($rows = _service_resellerRows_Id($uid)){

				$query = "UPDATE service.reseller SET ";

				// 자기 본인 정보는 승인 및 활성화 수정이 불가능함		
				if($rows->email != $_COOKIE['cookie_email']){
					if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					if($auth_req = _formdata("auth_req")) $query .= "`auth_req`='on' ,"; else $query .= "`auth_req`='' ,";

					if($sub = _formdata("sub")) $query .= "`sub`='$sub' ,";
					if($margin = _formdata("margin")) $query .= "`margin`='$margin' ,";

					if($setup = _formdata("setup")) $query .= "`setup`='$setup' ,";
					if($charge = _formdata("charge")) $query .= "`charge`='$charge' ,";
					if($expire = _formdata("expire")) $query .= "`expire`='$expire' ,";

					if($program = _formdata("program")) $query .= "`program`='$program' ,";

					$msg = "Reseller Updated...";

				} else {
					$msg = "can't update self";
				}

				if($email = _formdata("email")) $query .= "`email`='$email' ,";
				if($name = _formdata("name")) $query .= "`name`='$name' ,";
				if($code = _formdata("code")) $query .= "`code`='$code' ,";
				if($domain = _formdata("domain")) $query .= "`domain`='$domain' ,";

				if($bankname = _formdata("bankname")) $query .= "`bankname`='$bankname' ,";
				if($bankswiff = _formdata("bankswiff")) $query .= "`bankswiff`='$bankswiff' ,";
				if($banknum = _formdata("banknum")) $query .= "`banknum`='$banknum' ,";
				if($bankuser = _formdata("bankuser")) $query .= "`bankuser`='$bankuser' ,";
			
				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				_mysqli_query($query);
				//echo $query;			
			}
			
			echo "<script> location.replace(\"reseller.php?limit=$limit&msg=$msg\"); </script>";
			
		} else if($mode == "new"){
			_reseller_new();
			echo "<script> location.replace(\"reseller.php?limit=$limit\"); </script>";
			
		} else if($mode == "sub"){
			_reseller_newsub($uid);
			echo "<script> location.replace(\"reseller.php?limit=$limit\"); </script>";

		} else if($mode == "regist"){
			// 리셀러 가입 신청처리
			_resellerRegist();

			echo "<script> location.replace(\"reseller_renewal.php\"); </script>";

		} else if($mode == "resellerRegist_auth"){
			_resellerRegist_auth($uid);
			// echo "<script> location.replace(\"/service_reseller.php?limit=$limit\"); </script>";

		} else if($mode == "resellerRegist_cancel"){
			// 리셀러 회원가입을 취소승인 합니다.
			if($rows = _service_resellerRenewalRows_Id($uid)){

				// 취소에 따른 비용을 역정산
    			// 금액차감, 결제금액
    			_marginTreeLoop("resellerRegist",$uid,"-".$rows->pay_amount,$rows->email);

				$query = "UPDATE service.reseller_renewal SET `auth`='' WHERE `Id`='$uid'";
    			echo $query."<br>";
    			_mysqli_query($query);

    			$query = "DELETE FROM service.reseller WHERE `email`='".$rows->email."'";
    			echo $query."<br>";
    			_mysqli_query($query);    			

    		}

    		// echo "<script> location.replace(\"reseller_renewal.php\"); </script>";


		} else if($mode == "resellerRenewal"){
			// 리셀러 연장
			_resellerRenewal($uid);

			echo "<script> location.replace(\"reseller_renewal.php\"); </script>";

		} else if($mode == "resellerRenewal_auth"){
			_resellerRenewal_auth($uid);

			echo "<script> location.replace(\"reseller_renewal.php\"); </script>";

		} else if($mode == "cancel"){
			// 자신 리셀러 신청정보를 삭제합니다.
			$query = "DELETE FROM service.reseller_renewal WHERE `Id`='$uid'";
    		_mysqli_query($query);

    		// 이머니 입금정보도 삭제
    		$query = "DELETE FROM site_members_emoney WHERE `type`='resellerRegist' and `type_id`='$uid' ";
    		_mysqli_query($query);


    		// 리셀러 신청 페이지로 이동
    		echo "<script> location.replace(\"reseller_regist.php\"); </script>";
    		// echo $query;
    		
		} else if($mode == "delete"){
			
			$query = "select * from service.reseller WHERE `ref`='$uid'";
			if($rows = _mysqli_query_rows($query)){
				$msg = "하부 리셀러가 있는 경우, 삭제할 수 없습니다.";
				echo "<script>alert(\"$msg\")</script>";

			} else {
				if($rows = _service_resellerRows_Id($uid)){
					// 리셀러 회원 삭제
					$query = "DELETE FROM service.reseller WHERE `Id`='$uid'";
    				_mysqli_query($query);

    				// 리셀러 회원 연장 정보 삭제
    				$query = "DELETE FROM service.reseller_renewal WHERE `email`='".$rows->email."'";
    				_mysqli_query($query);

    				// 리셀러 이머니 내역 삭제
    				$query = "DELETE FROM site_members_emoney WHERE `type`='resellerRegist' and `email`='".$rows->email."' ;";
    				$query .= "DELETE FROM site_members_emoney WHERE `type`='resellerRenewal' and `email`='".$rows->email."' ;";
    				_mysqli_query($query);
    			} else {
    				echo "삭제할 회원 정보가 일치하지 않습니다.";
    			}			
    		}
			echo "<script> location.replace(\"reseller.php?limit=$limit\"); </script>";
		} 

		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}



	// 상위 리셀러가 없는 최상위 
	function _reseller_new(){
		global $TODAYTIME;

		$email = _formdata("email");
		$reseller = $_COOKIE['cookie_email'];
			
		// $query = "select * from service.reseller WHERE `email`='$email'";
		if($rows = _service_resellerRows($email)){
			echo "오류, 가입된 리셀러 이메일 주소입니다.";
		} else {	

			$insert_filed .= "`regdate`,";
			$insert_value .= "'$TODAYTIME',";

			if($enable = _formdata("enable")){
				$insert_filed .= "`enable`,";
				$insert_value .= "'on',";
			}

			if($auth_req = _formdata("auth_req")){
				$insert_filed .= "`auth_req`,";
				$insert_value .= "'on',";
			}

			$insert_filed .= "`email`,";	$insert_value .= "'$email',";
			$insert_filed .= "`reseller`,";	$insert_value .= "'$reseller',";

			if($name = _formdata("name")){
				$insert_filed .= "`name`,";
				$insert_value .= "'$name',";
			}

			if($code = _formdata("code")){
				$insert_filed .= "`code`,";
				$insert_value .= "'$code',";
			}

			if($domain = _formdata("domain")){
				$insert_filed .= "`domain`,";
				$insert_value .= "'$domain',";
			}

			if($sub = _formdata("sub")){
				$insert_filed .= "`sub`,";
				$insert_value .= "'$sub',";
			}
			
			if($margin = _formdata("margin")){
				$insert_filed .= "`margin`,";
				$insert_value .= "'$margin',";
			}

			if($setup = _formdata("setup")){
				$insert_filed .= "`setup`,";
				$insert_value .= "'$setup',";
			}
			
			if($charge = _formdata("charge")){
				$insert_filed .= "`charge`,";
				$insert_value .= "'$charge',";
			}
			
			if($expire = _formdata("expire")){
				$insert_filed .= "`expire`,";
				$insert_value .= "'$expire',";
			}

			if($program = _formdata("program")){
				$insert_filed .= "`program`,";
				$insert_value .= "'$program',";
			}

			if($bankname = _formdata("bankname")){
				$insert_filed .= "`bankname`,";
				$insert_value .= "'$bankname',";
			}
			
			if($bankswiff = _formdata("bankswiff")){
				$insert_filed .= "`bankswiff`,";
				$insert_value .= "'$bankswiff',";
			}
			
			if($banknum = _formdata("banknum")){
				$insert_filed .= "`banknum`,";
				$insert_value .= "'$banknum',";
			}

			if($bankuser = _formdata("bankuser")){
				$insert_filed .= "`bankuser`,";
				$insert_value .= "'$bankuser',";
			}

			// 최상위 Level 0 추가   
    		$query = "select * from service.reseller order by pos desc";
    		if( $rows = _mysqli_query_rows($query) ){
				$pos = $rows->pos+1;
    		} else $pos = 1;

    		$insert_filed .= "`level`,";	$insert_value .= "'2',";
    		$insert_filed .= "`pos`,";	$insert_value .= "'$pos',";
    		$insert_filed .= "`ref`,";	$insert_value .= "'1',";

    		$insert_filed .= "`tree`,";	
    		$tree = "infohojin@naver.com>".$email;
    		$insert_value .= "'".$tree."',";

			$query = "INSERT INTO service.reseller ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			_mysqli_query($query);

			/*
			$query = "select * from service.reseller where pos='$pos'";
    		if( $rows = _mysqli_query_rows($query) ){
				$tree = "infohojin@naver.com>".$rows->email;
				$query = "UPDATE service.reseller SET `tree`='$tree' WHERE `Id`=".$rows->Id;
    			_mysqli_query($query);
    		}
    		*/

		}

	}	


	// 서브 리셀러 회원을 생성합니다.
	function _reseller_newsub($uid){
		global $TODAYTIME;

		$email = _formdata("email");
		$reseller = $_COOKIE['cookie_email'];
			
		// $query = "select * from service.reseller WHERE `email`='$email'";
		if($rows = _service_resellerRows($email)){
			echo "오류, 가입된 리셀러 이메일 주소입니다.";
		} else {	

			// 삽입위치, pos값 전체 +1 씩 증가
    		// $query = "select * from service.reseller where `Id`=".$uid."";	
			if( $upperReseller_rows = _service_resellerRows_Id($uid) ){					

				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				if($enable = _formdata("enable")){
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				if($auth_req = _formdata("auth_req")){
					$insert_filed .= "`auth_req`,";
					$insert_value .= "'on',";
				}

				$insert_filed .= "`email`,";	$insert_value .= "'$email',";
				$insert_filed .= "`reseller`,";	$insert_value .= "'$reseller',";

				if($name = _formdata("name")){
					$insert_filed .= "`name`,";
					$insert_value .= "'$name',";
				}

				if($code = _formdata("code")){
					$insert_filed .= "`code`,";
					$insert_value .= "'$code',";
				}

				if($domain = _formdata("domain")){
					$insert_filed .= "`domain`,";
					$insert_value .= "'$domain',";
				}

				if($sub = _formdata("sub")){
					$insert_filed .= "`sub`,";
					$insert_value .= "'$sub',";
				}
				if($margin = _formdata("margin")){
					$insert_filed .= "`margin`,";
					$insert_value .= "'$margin',";
				}

				if($setup = _formdata("setup")){
					$insert_filed .= "`setup`,";
					$insert_value .= "'$setup',";
				}
				if($charge = _formdata("charge")){
					$insert_filed .= "`charge`,";
					$insert_value .= "'$charge',";
				}
				if($expire = _formdata("expire")){
					$insert_filed .= "`expire`,";
					$insert_value .= "'$expire',";
				}

				if($program = _formdata("program")){
					$insert_filed .= "`program`,";
					$insert_value .= "'$program',";
				}

				if($bankname = _formdata("bankname")){
					$insert_filed .= "`bankname`,";
					$insert_value .= "'$bankname',";
				}
				if($bankswiff = _formdata("bankswiff")){
					$insert_filed .= "`bankswiff`,";
					$insert_value .= "'$bankswiff',";
				}
				if($banknum = _formdata("banknum")){
					$insert_filed .= "`banknum`,";
					$insert_value .= "'$banknum',";
				}
				if($bankuser = _formdata("bankuser")){
					$insert_filed .= "`bankuser`,";
					$insert_value .= "'$bankuser',";
				}

				$LEVEL = $upperReseller_rows->level + 1;

				$query = "select * from service.reseller where pos >= '".$upperReseller_rows->pos."' order by pos desc";	
    			if( $rowss = _mysqli_query_rowss($query) ){
					for($i=0;$i<count($rowss);$i++){
						$rows1=$rowss[$i];
						$position = $rows1->pos+1;
    					$queryUp = "UPDATE service.reseller SET `pos`=$position WHERE `Id`=".$rows1->Id;
    					_mysqli_query($queryUp);
    					//echo "++ ".$queryUp."<br>";
    				}
    			}	

				$insert_filed .= "`level`,";	$insert_value .= "'$LEVEL',";
    			$insert_filed .= "`pos`,";	$insert_value .= "'".$upperReseller_rows->pos."',";
    			$insert_filed .= "`ref`,";	$insert_value .= "'$uid',";

    			$insert_filed .= "`tree`,";	
    			$tree = $upperReseller_rows->tree.">".$email;
    			$insert_value .= "'".$tree."',";


				$query = "INSERT INTO service.reseller ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_mysqli_query($query);


					//Tree값 분석 및 생성, 갱신
					/*
					$query = "select * from service.reseller where pos='".$upperReseller_rows->pos."'";
					if( $rows = _mysqli_query_rows($query) ){
						$tree = $upperReseller_rows->tree.">".$rows->email;
						$queryUp = "UPDATE service.reseller SET `tree`='$tree' WHERE pos=".$upperReseller_rows->pos."";
    					_mysqli_query($queryUp);
					}
					*/


			} else {
				echo "상위 리셀러 정보를 읽어올 수 없습니다.";
			}
		}

	}





	// #####
	// #####




	// 리셀러 회원가압을 처리합니다.
	function _resellerRegist(){

		// 가입 되어진 리셀러인지 미리 검사
		$email = $_COOKIE['cookie_email'];			
		if($rows = _service_resellerRows($email)){
			$msg = "오류, 이미 가입된 리셀러 입니다.";
			echo "<script> alert(\"$msg\"); </script>";

		} else {
			// 선택 리셀러프로그램 정보
			if($reseller_program = _formdata("reseller_program")){						
				if($program_rows = _service_resellerProgramRows_Id($reseller_program)){
				}
			}

			// 리셀러 신정 DB 삽입
			$insert_id = _resellerRegist_insert();
			echo "insert Id = $insert_id <br>";

			// 입금요청 history 기록
			$reseller = _formdata("reseller");
			$name = _formdata("name");
			$auth = ""; // 미승인
			$emoney = $program_rows->setup + $program_rows->charge;
			$title = "리셀러 ".$reseller_program->title." 가입 및 유지비용 결제 ";
			_emoneyHistory("resellerRegist", $insert_id, $emoney, $balance, $_COOKIE['cookie_email'], $title, $name, $auth, $reseller);
		
		}
	}	


	// 회원가입 정보를 renewal 테이블에 삽입한다.
	function _resellerRegist_insert(){
		global $TODAYTIME;

		//////////////////////////////
		// 리셀러 가입 신청서 기록 
		$insert_filed = "`regdate`,";	
		$insert_value = "'$TODAYTIME',";
		
		$insert_filed .= "`type`,";		
		$insert_value .= "'resellerRegist',";

		if($reseller = _formdata("reseller")){
			$insert_filed .= "`reseller`,";	
			$insert_value .= "'$reseller',"; // 상위 리셀러 (이메일) 
		}

		$insert_filed .= "`email`,";	
		$insert_value .= "'".$_COOKIE['cookie_email']."',"; // 신청자 이메일 
		
		if($service_code = _formdata("service_code")){
			$insert_filed .= "`service_code`,";	
			$insert_value .= "'$service_code',"; // 상위 리셀러 (이메일) 
		}

		if($domain = _formdata("domain")){
			$insert_filed .= "`domain`,";	
			$insert_value .= "'$domain',"; // 상위 리셀러 (이메일) 
		}

		if($name = _formdata("name")){
			$insert_filed .= "`name`,";	
			$insert_value .= "'$name',"; // 상위 리셀러 (이메일) 
		}

		if($bankname = _formdata("bankname")){
			$insert_filed .= "`bankname`,";	
			$insert_value .= "'$bankname',"; // 상위 리셀러 (이메일) 
		}

		if($bankuser = _formdata("bankuser")){
			$insert_filed .= "`bankuser`,";	
			$insert_value .= "'$bankuser',"; // 상위 리셀러 (이메일) 
		}

		if($banknum = _formdata("banknum")){
			$insert_filed .= "`banknum`,";	
			$insert_value .= "'$banknum',"; // 상위 리셀러 (이메일) 
		}

		// 선택한 리셀러 프로그램
		if($reseller_program = _formdata("reseller_program")){
					
			$insert_filed .= "`program`,";	
			$insert_value .= "'$reseller_program',";					
			if($program_rows = _service_resellerProgramRows_Id($reseller_program)){

				$insert_filed .= "`margin`,";	
				$insert_value .= "'".$program_rows->margin."',";
				$insert_filed .= "`setup`,";	
				$insert_value .= "'".$program_rows->setup."',";
				$insert_filed .= "`charge`,";	
				$insert_value .= "'".$program_rows->charge."',";
				$insert_filed .= "`priod`,";	
				$insert_value .= "'".$program_rows->priod."',";
				$insert_filed .= "`sub`,";	
				$insert_value .= "'".$program_rows->level."',";

				$pay_amount = $program_rows->setup + $program_rows->charge;
				$insert_filed .= "`pay_amount`,";	
				$insert_value .= "'".$pay_amount."',";

				$title = "리셀러 ".$program_rows->title." 가입 및 유지비용 결제 ";
				$insert_filed .= "`title`,";	
				$insert_value .= "'$title',";

			}					
		}

		$query = "INSERT INTO service.reseller_renewal ($insert_filed) VALUES ($insert_value)";
		$query = str_replace(",)",")",$query);
		echo $query."<br>";
		return _mysqli_insert($query);

	}
	

	// 회원 정보를 가지고, 연장을 처리합니다.
	function _resellerRenewal($uid){
		global $TODAYTIME;

		if($rows = _service_resellerRows_Id($uid)){
			$insert_filed = "`regdate`,";	
			$insert_value = "'$TODAYTIME',";
			
			$insert_filed .= "`type`,";		
			$insert_value .= "'resellerRenewal',";
				
			$insert_filed .= "`reseller`,";	
			$insert_value .= "'".$rows->reseller."',"; // 상위 리셀러 (이메일) 
			
			$insert_filed .= "`email`,";	
			$insert_value .= "'".$rows->email."',"; // 신청자 이메일 

			$insert_filed .= "`service_code`,";	
			$insert_value .= "'".$rows->code."',"; // 상위 리셀러 (이메일) 
			
			$insert_filed .= "`domain`,";	
			$insert_value .= "'".$rows->domain."',"; // 상위 리셀러 (이메일) 

			$insert_filed .= "`name`,";	
			$insert_value .= "'".$rows->name."',"; // 상위 리셀러 (이메일) 

			$insert_filed .= "`program`,";	
			$insert_value .= "'".$rows->program."',";

			$insert_filed .= "`margin`,";	
			$insert_value .= "'".$rows->margin."',";
			
			$insert_filed .= "`setup`,";	
			$insert_value .= "'0',"; // 설정 비용은 처리 하지 않은 
			
			$insert_filed .= "`charge`,";	
			$insert_value .= "'".$rows->charge."',";
				
			$insert_filed .= "`sub`,";		
			$insert_value .= "'".$rows->level."',";

			if($priod = _formdata("priod")){
				$insert_filed .= "`priod`,";	
				$insert_value .= "'$priod',"; 
			}
				
			if($pay_amount = _formdata("pay_amount")){
				$insert_filed .= "`pay_amount`,";	
				$insert_value .= "'$pay_amount',"; 
			}

			if($pay_user = _formdata("pay_user")){
				$insert_filed .= "`pay_user`,";	
				$insert_value .= "'$pay_user',"; 
			}

			$title = "리셀러 ".$grade_rows->title." 연장 ";
			$insert_filed .= "`title`,";	
			$insert_value .= "'$title',";
				
			$query = "INSERT INTO service.reseller_renewal ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			$insert_id = _mysqli_insert($query);

			// 입금요청 history 기록			
			//$auth = ""; // 미승인
			//$title = "리셀러 ".$reseller_program->title." 연장비용 결제 ";
			// _emoneyHistory("resellerRenewal", $last_id, $rows->charge, $balance, $rows->email, $title, $rows->name, $auth, $rows->reseller);

		}
	}


	// 리셀러 회원가입을 승인합니다.
	function _resellerRegist_auth($uid){
		global $TODAYTIME,$TODAY;

		if($rows = _service_resellerRenewalRows_Id($uid)){
			//상위 리셀러 정보
			$upperResellerRows = _service_resellerRows($rows->reseller);
			// $reseller_rows = _reseller_rows($rows->reseller);
			//$members = _members_rows($rows->email);
			echo $rows->email."<br>";
			if($rows1 = _service_resellerRows($rows->email)){
				$msg = "오류, 가입된 리셀러 회원 입니다.";
				msg_alert($msg);
					
			} else {	
				// reseller_renewal => reseller 로 회원가입 query를 생성합니다.				
				$insert_filed = "`regdate`,";		$insert_value = "'$TODAYTIME',";
				$insert_filed .= "`enable`,";		$insert_value .= "'on',"; // 미승인 으로 처리 
				$insert_filed .= "`emoney`,";		$insert_value .= "'0',";// 이머니는 0으로 설정 
				$insert_filed .= "`in_check`,";		$insert_value .= "'on',"; // 입금 확인 체크
				$insert_filed .= "`auth_req`,";		$insert_value .= "'on',";
				$insert_filed .= "`code`,";			$insert_value .= "'".$rows->service_code."',";
				$insert_filed .= "`reseller`,";		$insert_value .= "'".$rows->reseller."',";					
				$insert_filed .= "`email`,";		$insert_value .= "'".$rows->email."',";// 신청자 이메일 					
				$insert_filed .= "`program`,";		$insert_value .= "'".$rows->program."',";// 선택한 리셀러 그레이드 및 서비스 상품						
				$insert_filed .= "`margin`,";		$insert_value .= "'".$rows->margin."',";
				$insert_filed .= "`setup`,";		$insert_value .= "'".$rows->setup."',";
				$insert_filed .= "`charge`,";		$insert_value .= "'".$rows->charge."',";

				$insert_filed .= "`domain`,";		$insert_value .= "'".$rows->domain."',";					
				$insert_filed .= "`name`,";			$insert_value .= "'".$rows->name."',";
				$insert_filed .= "`sub`,";			$insert_value .= "'".$rows->sub."',";
				$insert_filed .= "`bankname`,";		$insert_value .= "'".$rows->bankname."',";
				$insert_filed .= "`bankuser`,";		$insert_value .= "'".$rows->bankuser."',";
				$insert_filed .= "`banknum`,";		$insert_value .= "'".$rows->banknum."',";
				
    			$query1 = "select * from service.reseller where pos >= '".$upperResellerRows->pos."' order by pos desc";	
    			if( $rowss1 = _mysqli_query_rowss($query1) ){
					for($i=0;$i<count($rowss1);$i++){
						$rows1=$rowss1[$i];
						$position = $rows1->pos+1;
    					$queryUp = "UPDATE service.reseller SET `pos`=$position WHERE `Id`=".$rows1->Id;
    					_mysqli_query($queryUp);
    					//echo "++ ".$queryUp."<br>";
    				}
    			}	

    			$insert_filed .= "`level`,";	
    			$level = $upperResellerRows->level + 1 ;
    			$insert_value .= "'$level',";

    			$insert_filed .= "`pos`,";	
    			$insert_value .= "'".$upperResellerRows->pos."',";
    			
    			$insert_filed .= "`ref`,";	
    			$insert_value .= "'".$upperResellerRows->Id."',";

    			$insert_filed .= "`tree`,";	
    			$tree = $upperResellerRows->tree.">".$rows->email;
    			$insert_value .= "'".$tree."',";

				
				$priod = "1";
    			$expire = _date_month("+".$priod." months",$TODAY);
    			$insert_filed .= "`expire`,";
    			$insert_value .= "'".$expire."',";


				$query = "INSERT INTO service.reseller ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				$insert_id = _mysqli_insert($query);

    			// 신청서, 승인 부분 체크 
				$query = "UPDATE service.reseller_renewal SET `auth`='on' WHERE `Id`='$uid'";
    			echo $query."<br>";
    			_mysqli_query($query);

    			// 금액차감, 결제금액
    			_marginTreeLoop("resellerRegist",$uid,$rows->pay_amount,$rows->email);

				////////
			}

		} else {
			$msg = "리셀러 주문 정보가 없습니다.";
			echo $msg;
		}

	}

	


	function _resellerRenewal_auth($uid){
		if($rows = _service_resellerRenewalRows_Id($uid)){
		
			$upperResellerRows = _service_resellerRows($rows->reseller);
			$rows1 = _service_resellerRows($rows->email);

    		// 신청서, 승인 부분 체크 
    		$priod = "1";
    		$expire = _date_month("+".$priod." months",$rows1->expire);
			$query = "UPDATE service.reseller SET `expire`='$expire' WHERE `email`='".$rows->email."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		// 연장 승인 처리
    		$query = "UPDATE service.reseller_renewal SET `auth`='on' WHERE `Id`='".$uid."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		// 금액차감, 결제금액
    		_marginTreeLoop("resellerRenewal",$uid,$rows->pay_amount,$rows->email);
			
		}	
	}





	
?>