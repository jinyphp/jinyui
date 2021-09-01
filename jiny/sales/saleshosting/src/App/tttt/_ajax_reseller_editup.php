<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	//* 리셀러별 회원 고객 서비스 목록 
	//* 2016.01.27 : 생성 

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/css.php";
	include "./func/members.php";
	include "./func/reseller.php";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");		

		if($uid && $mode == "edit"){
			_reseller_edit($uid);
			echo "<script> location.replace(\"/service_reseller.php?limit=$limit\"); </script>";
			
		} else if($mode == "new"){
			_reseller_neww();
			echo "<script> location.replace(\"/service_reseller.php?limit=$limit\"); </script>";
			
		} else if($mode == "sub"){
			_reseller_newsub($uid);
			echo "<script> location.replace(\"/service_reseller.php?limit=$limit\"); </script>";

		} else if($mode == "regist"){
			// 신규 리셀러 등록 및 신청 
			_reseller_regist();
			echo "<script> location.replace(\"reseller_history.php\"); </script>";

		} else if($mode == "reg_auth"){
			_reseller_reg_auth($uid);
			// echo "<script> location.replace(\"/service_reseller.php?limit=$limit\"); </script>";

		} else if($mode == "renewal"){
			_reseller_renewal($uid);

		} else if($mode == "renewal_auth"){
			_reseller_renewal_auth($uid);


		} else if($mode == "cancel"){
			// 리셀러 신청 취소
			_reseller_renewal_delete_byId($uid);

    		// 리셀러 신청 페이지로 이동
    		echo "<script> location.replace(\"/reseller_new.php\"); </script>";
    		// echo $query;
    		
		} else if($mode == "delete"){
			
			$query = "select * from `service_reseller` WHERE `ref`='$uid'";
			if($rows = _mysqli_query_rows($query)){
				$msg = "하두 리셀러가 있는 경우, 삭제할 수 없습니다.";
				echo "<script>alert(\"$msg\")</script>";
			} else {
				// $query = "DELETE FROM `service_reseller` WHERE `Id`='$uid'";
    			//_mysqli_query($query);
    			_reseller_delete_byId($uid);
    		}
			echo "<script> location.replace(\"reseller.php?limit=$limit\"); </script>";
		} 

		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	function _reseller_neww(){
		global $TODAYTIME;

			$email = _formdata("email");
			$reseller = $_COOKIE['cookie_email'];
			
			$query = "select * from `service_reseller` WHERE `email`='$email'";
			if($rows = _mysqli_query_rows($query)){
				echo "오류, 중복된 코드 입니다.";
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

				if($grade = _formdata("grade")){
					$insert_filed .= "`grade`,";
					$insert_value .= "'$grade',";
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
    			$query = "select * from `service_reseller` order by pos desc";
    			if( $rows = _mysqli_query_rows($query) ){
					$pos = $rows->pos+1;
    			} else $pos = 1;

    			$insert_filed .= "`level`,";	$insert_value .= "'2',";
    			$insert_filed .= "`pos`,";	$insert_value .= "'$pos',";
    			$insert_filed .= "`ref`,";	$insert_value .= "'1',";

				$query = "INSERT INTO `service_reseller` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_mysqli_query($query);

				$query = "select * from `service_reseller` where pos='$pos'";
    			if( $rows = _mysqli_query_rows($query) ){
					$tree = "infohojin@naver.com>".$rows->email;
					$query = "UPDATE `service_reseller` SET `tree`='$tree' WHERE `Id`=".$rows->Id;
    				_mysqli_query($query);
    			}

			}

	}	



	function _reseller_newsub($uid){
		global $TODAYTIME;


			$email = _formdata("email");
			$reseller = $_COOKIE['cookie_email'];
			
			$query = "select * from `service_reseller` WHERE `email`='$email'";
			if($rows = _mysqli_query_rows($query)){
				echo "오류, 중복된 코드 입니다.";
			} else {	

				// 삽입위치, pos값 전체 +1 씩 증가
    			$query = "select * from `service_reseller` where `Id`=".$uid."";	
				if( $reseller_tree = _mysqli_query_rows($query) ){

					//$POS = $reseller_tree->pos + 1;
    				$LEVEL = $reseller_tree->level + 1;

					$query = "select * from `service_reseller` where pos >= '".$reseller_tree->pos."' order by pos desc";	
    				if( $rowss = _mysqli_query_rowss($query) ){
						for($i=0;$i<count($rowss);$i++){
							$rows1=$rowss[$i];
							$position = $rows1->pos+1;
    						$queryUp = "UPDATE `service_reseller` SET `pos`=$position WHERE `Id`=".$rows1->Id;
    						_mysqli_query($queryUp);
    						//echo "++ ".$queryUp."<br>";
    					}
    				}	
				
					/*
    				$query = "INSERT INTO `site_menu` (`code`, `check_members`, `name`, `url`, `urlmode`, `alt`, `title`, `enable`, `level`, `pos`, `ref`, `hassub`) 
    									VALUES ('$menu_code', '$check_members', '$name', '$url', '$urlmode', '$alt', '$title', '$enable', '$LEVEL', '".$reseller_tree->pos."', '$uid','hassub');";
					_sales_query($query);
					//echo $query."<br>";

					*/

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

				if($grade = _formdata("grade")){
					$insert_filed .= "`grade`,";
					$insert_value .= "'$grade',";
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


				$insert_filed .= "`level`,";	$insert_value .= "'$LEVEL',";
    			$insert_filed .= "`pos`,";	$insert_value .= "'".$reseller_tree->pos."',";
    			$insert_filed .= "`ref`,";	$insert_value .= "'$uid',";

				$query = "INSERT INTO `service_reseller` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_mysqli_query($query);


					//Tree값 분석 및 생성, 갱신
					$query = "select * from `service_reseller` where pos='".$reseller_tree->pos."'";
					if( $rows = _mysqli_query_rows($query) ){
						$tree = $reseller_tree->tree.">".$rows->email;
						$queryUp = "UPDATE `service_reseller` SET `tree`='$tree' WHERE pos=".$reseller_tree->pos."";
    					_mysqli_query($queryUp);
					}


				} else echo "상품을 찾을 수 없습니다.";


			}

	}

	function _reseller_edit($uid){

		$query = "select * from `service_reseller` WHERE `Id`='$uid'";
		if($rows = _mysqli_query_rows($query)){

			$query = "UPDATE `service_reseller` SET ";

			// 자기 본인 정보는 승인 및 활성화 수정이 불가능함		
			if($rows->email != $_COOKIE['cookie_email']){
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
				if($auth_req = _formdata("auth_req")) $query .= "`auth_req`='on' ,"; else $query .= "`auth_req`='' ,";

				if($sub = _formdata("sub")) $query .= "`sub`='$sub' ,";
				if($margin = _formdata("margin")) $query .= "`margin`='$margin' ,";

				if($setup = _formdata("setup")) $query .= "`setup`='$setup' ,";
				if($charge = _formdata("charge")) $query .= "`charge`='$charge' ,";
				if($expire = _formdata("expire")) $query .= "`expire`='$expire' ,";

				if($grade = _formdata("grade")) $query .= "`grade`='$grade' ,";
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
	}



	function _reseller_regist(){
		global $TODAYTIME;
			
		// 가입 되어진 리셀러인지 미리 검사
		$email = $_COOKIE['cookie_email'];			
		$query = "select * from `service_reseller` WHERE `email`='$email'";
		if($rows = _mysqli_query_rows($query)){
			$msg = "오류, 이미 가입된 리셀러 입니다.";
			echo "<script> alert(\"$msg\"); </script>";

		} else {
				
			//////////////////////////////
			// 리셀러 가입 신청서 기록 
			$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
			$insert_filed .= "`type`,";		$insert_value .= "'new',";

			if($reseller = _formdata("reseller")){
				$insert_filed .= "`reseller`,";	$insert_value .= "'$reseller',"; // 상위 리셀러 (이메일) 
			}

			$insert_filed .= "`email`,";	$insert_value .= "'$email',"; // 신청자 이메일 
			if($service_code = _formdata("service_code")){
				$insert_filed .= "`service_code`,";	$insert_value .= "'$service_code',"; // 상위 리셀러 (이메일) 
			}

			if($domain = _formdata("domain")){
				$insert_filed .= "`domain`,";	$insert_value .= "'$domain',"; // 상위 리셀러 (이메일) 
			}

			if($name = _formdata("name")){
				$insert_filed .= "`name`,";	$insert_value .= "'$name',"; // 상위 리셀러 (이메일) 
			}

			if($bankname = _formdata("bankname")){
				$insert_filed .= "`bankname`,";	$insert_value .= "'$bankname',"; // 상위 리셀러 (이메일) 
			}

			if($bankuser = _formdata("bankuser")){
				$insert_filed .= "`bankuser`,";	$insert_value .= "'$bankuser',"; // 상위 리셀러 (이메일) 
			}

			if($banknum = _formdata("banknum")){
				$insert_filed .= "`banknum`,";	$insert_value .= "'$banknum',"; // 상위 리셀러 (이메일) 
			}

			// 선택한 리셀러 프로그램
			if($reseller_program = _formdata("reseller_program")){
					
				$insert_filed .= "`program`,";	$insert_value .= "'$reseller_program',";
					
				$query = "select * from `service_reseller_program` WHERE `Id`='$reseller_program'";
				if($grade_rows = _mysqli_query_rows($query)){
					// $insert_filed .= "`depth`,";	$insert_value .= "'".$grade_rows->level."',";
					$insert_filed .= "`margin`,";	$insert_value .= "'".$grade_rows->margin."',";
					$insert_filed .= "`setup`,";	$insert_value .= "'".$grade_rows->setup."',";
					$insert_filed .= "`charge`,";	$insert_value .= "'".$grade_rows->charge."',";
					$insert_filed .= "`priod`,";	$insert_value .= "'".$grade_rows->priod."',";
					$insert_filed .= "`sub`,";	$insert_value .= "'".$grade_rows->level."',";

					$pay_amount = $grade_rows->setup + $grade_rows->charge;
					$insert_filed .= "`pay_amount`,";	$insert_value .= "'".$pay_amount."',";

					$title = "리셀러 ".$grade_rows->title." 가입 및 유지비용 결제 ";
					$insert_filed .= "`title`,";	$insert_value .= "'$title',";

				}
					
			}

			$query = "INSERT INTO `service_reseller_renewal` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);
				

			///////////////
			// 입금확인 체크요청 기록
			$insert_filed = "`regdate`,";		$insert_value = "'$TODAYTIME',";
			$insert_filed .= "`email`,";		$insert_value .= "'$email',";

			$title = "리셀러 ".$reseller_program->title." 가입 및 유지비용 결제 ";
			$insert_filed .= "`title`,";		$insert_value .= "'$title',";

			$emoney = $grade_rows->setup + $grade_rows->charge;
			// $money *= 1.1; // 부가세처리 
			$insert_filed .= "`type`,";			$insert_value .= "'in',";  //입금
			$insert_filed .= "`emoney`,";		$insert_value .= "'$emoney',";

			// 금액은 담당자 확인 및 승인시 자동으로 증감 됩니다.
			//$insert_filed .= "`check_auth`,";	$insert_value .= "'',";
			$insert_filed .= "`balance`,";		$insert_value .= "'0',";
			$insert_filed .= "`reseller`,";		$insert_value .= "'$reseller',";

			$query = "INSERT INTO `site_members_emoney` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);
			
				
		}
	}	


	function _reseller_reg_auth($uid){
		global $TODAYTIME;

		// *************************************
		// 리셀러 가입 승인

		$query = "select * from `service_reseller_renewal` where Id =$uid";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){

			$reseller_rows = _reseller_rows($rows->reseller);
			$members = _members_rows($rows->email);

			$query = "select * from `service_reseller` WHERE `email`='".$rows->email."'";
			echo $query."<br>";
			if($rows1 = _mysqli_query_rows($query)){
				$msg = "오류, 가입된 리셀러 회원 입니다.";
				echo $msg;
					
			} else {	
				///////////////
				// 가입신청 내역을 기반으로 리셀러 정보 삽입
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

				//$insert_filed .= "`pay_amount`,";		$insert_value .= "'".$rows->pay_amount."',";
				//$insert_filed .= "`pay_user`,";		$insert_value .= "'".$rows->pay_user."',";

				$insert_filed .= "`domain`,";		$insert_value .= "'".$rows->domain."',";					
				$insert_filed .= "`name`,";		$insert_value .= "'".$rows->name."',";
				$insert_filed .= "`sub`,";		$insert_value .= "'".$rows->sub."',";
				$insert_filed .= "`bankname`,";		$insert_value .= "'".$rows->bankname."',";
				$insert_filed .= "`bankuser`,";		$insert_value .= "'".$rows->bankuser."',";
				$insert_filed .= "`banknum`,";		$insert_value .= "'".$rows->banknum."',";
				
    			$query1 = "select * from `service_reseller` where pos >= '".$reseller_rows->pos."' order by pos desc";	
    			if( $rowss1 = _mysqli_query_rowss($query1) ){
					for($i=0;$i<count($rowss1);$i++){
						$rows1=$rowss1[$i];
						$position = $rows1->pos+1;
    					$queryUp = "UPDATE `service_reseller` SET `pos`=$position WHERE `Id`=".$rows1->Id;
    					_mysqli_query($queryUp);
    					//echo "++ ".$queryUp."<br>";
    				}
    			}	

    			$insert_filed .= "`level`,";	
    			$level = $reseller_rows->level + 1 ;
    			$insert_value .= "'$level',";

    			$insert_filed .= "`pos`,";	$insert_value .= "'".$reseller_rows->pos."',";
    			$insert_filed .= "`ref`,";	$insert_value .= "'".$reseller_rows->Id."',";
				
				$priod = "1";
    			$expire = _date_month("+".$priod." months",$TODAY);
    			$insert_filed .= "`expire`,";	$insert_value .= "'".$expire."',";

				$query = "INSERT INTO `service_reseller` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				echo $query."<br>";
				_mysqli_query($query);

				///////////////
				// 리셀러 계층 트리 생성
				$query1 = "select * from `service_reseller` where pos='".$reseller_rows->pos."'";
    			if( $rows1 = _mysqli_query_rows($query1) ){
					$tree = $reseller_rows->tree.">".$rows1->email;
					$query = "UPDATE `service_reseller` SET `tree`='$tree' WHERE `Id`='".$rows1->Id."'";
    				_mysqli_query($query);
    			}

    				

    			///////////////////
    			// 이머니 처리 및 체널 계층 분배
    			echo "이머니 처리 및 체널 계층 분배"."<br>";
    			/*  리셀러 주문 승인
		 		*  주문자 이머니 차감 > 리셀러 이머니 적립 
		 		*  리셀링 발주 차감 > 
		 		*  상위 릴셀러 : 마진 적립 
		 		*/ 
		 			
				// 주문자 이머니 차감 
				// ex) 10만원 결제
				//$amount = $rows->setup + $rows->charge;
				_reseller_emoney_down($rows->pay_amount,$rows->email,"리셀러 가입비용 /출금");


				// 리셀러1 : 이머니 적립 이동
				// ex) 10만원 적립
				if($reseller1 = _reseller_rows($rows->reseller)){
					_reseller_emoney_up($amount,$reseller1->email,"리셀러 가입비용 /입금");

					// 리셀러1 : 리셀링 발주
					// ex) 마진율 20%, 10 * 0.8 = 8만원 리셀링 차감 결제 
					// 20% 이윤으로 남음 
					$margin_amount =  $amount / 100 * $reseller1->margin;
					$order_prices = $amount - $margin_amount;
					_reseller_emoney_down($order_prices,$reseller1->email,"재발주] 리셀러가입비 (".$reseller1->margin."%) /결제: order(".$rows->Id.")");

				} else $order_prices = $amount;

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
						_reseller_emoney_up($margin_amount,$reseller2->email,"커미션 L2(".$margin_rate."%) /입금 <".$reseller1->email." : order(".$rows->Id.")");
					}						
				}

				// 리셀러3 : 마진 계산 적립
				// ex) 리셀러는 마진 40%, 
				if($reseller3 = _reseller_rows($reseller2->reseller)){
					if($reseller3->level >1 && $reseller2->sub > 3){
						$margin_rate = $reseller3->margin - $reseller2->margin; // 마진차액 계산
						$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
						$order_prices = $order_prices - $margin_amount;
						_reseller_emoney_up($margin_amount,$reseller3->email,"커미션 L3(".$margin_rate."%) /입금 <".$reseller2->email." : order(".$rows->Id.")");
					}
				}

				// 리셀러4 : 마진 계산 적립
				// ex) 리셀러는 마진 50%, 
				if($reseller4 = _reseller_rows($reseller3->reseller)){
					if($reseller4->level >1 && $reseller2->sub > 4){
						$margin_rate = $reseller4->margin - $reseller3->margin; // 마진차액 계산
						$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
						$order_prices = $order_prices - $margin_amount;
						_reseller_emoney_up($margin_amount,$reseller4->email,"커미션 L4(".$margin_rate."%) /입금 <".$reseller3->email." : order(".$rows->Id.")");
					}
				}

				// 최종 남은 금액은 , 본사 적립
				_reseller_emoney_up($order_prices,"infohojin@naver.com","커미션 M /입금 : order(".$rows->Id.")");

				

				///////////////////
    			// 신청서, 승인 부분 체크 
				$query = "UPDATE `service_reseller_renewal` SET `auth`='on' WHERE `Id`='$uid'";
    			echo $query."<br>";
    			_mysqli_query($query);

				////////
			}

		} else {
			$msg = "리셀러 주문 정보가 없습니다.";
			echo $msg;
		}

	}


	function _reseller_renewal($uid){
		global $TODAYTIME;

		//////////////////////////////
		// 리셀러 연장신청서 삽입 
		$query = "select * from `service_reseller` WHERE `Id`='$uid'";
		if($rows = _mysqli_query_rows($query)){
			$insert_filed = "`regdate`,";	$insert_value = "'$TODAYTIME',";
			$insert_filed .= "`type`,";		$insert_value .= "'renewal',";
				
			$insert_filed .= "`reseller`,";	$insert_value .= "'".$rows->reseller."',"; // 상위 리셀러 (이메일) 
			$insert_filed .= "`email`,";	$insert_value .= "'".$rows->email."',"; // 신청자 이메일 

			$insert_filed .= "`service_code`,";	$insert_value .= "'".$rows->code."',"; // 상위 리셀러 (이메일) 
			$insert_filed .= "`domain`,";	$insert_value .= "'".$rows->domain."',"; // 상위 리셀러 (이메일) 

			$insert_filed .= "`name`,";	$insert_value .= "'".$rows->name."',"; // 상위 리셀러 (이메일) 

			//$insert_filed .= "`bankname`,";	$insert_value .= "'".$rows->bankname."',"; // 상위 리셀러 (이메일) 
			//$insert_filed .= "`bankuser`,";	$insert_value .= "'".$rows->bankuser."',"; // 상위 리셀러 (이메일) 
			//$insert_filed .= "`banknum`,";	$insert_value .= "'".$rows->banknum."',"; // 상위 리셀러 (이메일)

			$insert_filed .= "`program`,";	$insert_value .= "'".$rows->program."',";

			$insert_filed .= "`margin`,";	$insert_value .= "'".$rows->margin."',";
			$insert_filed .= "`setup`,";	$insert_value .= "'0',"; // 설정 비용은 처리 하지 않은 
			$insert_filed .= "`charge`,";	$insert_value .= "'".$rows->charge."',";
				
			$insert_filed .= "`sub`,";		$insert_value .= "'".$rows->level."',";

			if($priod = _formdata("priod")){
				$insert_filed .= "`priod`,";	$insert_value .= "'$priod',"; // 상위 리셀러 (이메일) 
			}
				
			if($pay_amount = _formdata("pay_amount")){
				$insert_filed .= "`pay_amount`,";	$insert_value .= "'$pay_amount',"; // 상위 리셀러 (이메일) 
			}

			if($pay_user = _formdata("pay_user")){
				$insert_filed .= "`pay_user`,";	$insert_value .= "'$pay_user',"; // 상위 리셀러 (이메일) 
			}

			$title = "리셀러 ".$grade_rows->title." 연장 ";
			$insert_filed .= "`title`,";	$insert_value .= "'$title',";
				
			$query = "INSERT INTO `service_reseller_renewal` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			_mysqli_query($query);

			// echo "<script> location.replace(\"reseller.php?limit=$limit\"); </script>";

		}
	}



	function _reseller_renewal_auth($uid){
		$query = "select * from `service_reseller_renewal` where Id =$uid";
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
			_reseller_emoney_down($rows->pay_amount,$rows->email,"리셀러 연장비용 /출금");


			// 리셀러1 : 이머니 적립 이동
			// ex) 10만원 적립
			if($reseller1 = _reseller_rows($rows->reseller)){
				_reseller_emoney_up($rows->pay_amount,$reseller1->email,"리셀러 연장비용 /입금");

				// 리셀러1 : 리셀링 발주
				// ex) 마진율 20%, 10 * 0.8 = 8만원 리셀링 차감 결제 
				// 20% 이윤으로 남음 
				$margin_amount =  $rows->pay_amount / 100 * $reseller1->margin;
				$order_prices = $rows->pay_amount - $margin_amount;
				_reseller_emoney_down($order_prices,$reseller1->email,"재발주] 리셀러 연장비용 (".$reseller1->margin."%) /결제: order(".$rows->Id.")");

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
					_reseller_emoney_up($margin_amount,$reseller2->email," 연장비용 커미션 L2(".$margin_rate."%) /입금 <".$reseller1->email." : order(".$rows->Id.")");
				}						
			}

			// 리셀러3 : 마진 계산 적립
			// ex) 리셀러는 마진 40%, 
			if($reseller3 = _reseller_rows($reseller2->reseller)){
				if($reseller3->level >1 && $reseller2->sub > 3){
					$margin_rate = $reseller3->margin - $reseller2->margin; // 마진차액 계산
					$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
					$order_prices = $order_prices - $margin_amount;
					_reseller_emoney_up($margin_amount,$reseller3->email," 연장비용 커미션 L3(".$margin_rate."%) /입금 <".$reseller2->email." : order(".$rows->Id.")");
				}
			}

			// 리셀러4 : 마진 계산 적립
			// ex) 리셀러는 마진 50%, 
			if($reseller4 = _reseller_rows($reseller3->reseller)){
				if($reseller4->level >1 && $reseller2->sub > 4){
					$margin_rate = $reseller4->margin - $reseller3->margin; // 마진차액 계산
					$margin_amount =  $amount / 100 * $margin_rate; // 차액 계산 
					$order_prices = $order_prices - $margin_amount;
					_reseller_emoney_up($margin_amount,$reseller4->email," 연장비용 커미션 L4(".$margin_rate."%) /입금 <".$reseller3->email." : order(".$rows->Id.")");
				}
			}

			// 최종 남은 금액은 , 본사 적립
			_reseller_emoney_up($order_prices,"infohojin@naver.com"," 연장비용 커미션 M /입금 : order(".$rows->Id.")");

				

			///////////////////
    		// 신청서, 승인 부분 체크 
    		// $expire = $reseller_rows->expire + $rows->priod;
    		$expire = _date_month("+".$rows->priod." months",$rows->expire);
			$query = "UPDATE `service_reseller` SET `expire`='$expire' WHERE `email`='".$rows->email."'";
    		echo $query."<br>";
    		_mysqli_query($query);

    		// 연장 승인 처리
    		$query = "UPDATE `service_reseller_renewal` SET `auth`='on' WHERE `Id`='".$uid."'";
    		echo $query."<br>";
    		_mysqli_query($query);
			
		}	
	}
	
?>