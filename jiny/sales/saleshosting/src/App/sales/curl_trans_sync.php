<?
	// ============== 
	// CURL Trans 자료전달 처리
	// 2016.04.02

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/conf/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");

	echo "<br>SALESHosting API<br>";

	if($adminkey = _formdata("adminkey")){
		$query = "select * from `site_env`";
		echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
			if($rows->adminkey == $adminkey){

				// ====== CURL 접속 체크 성공 ======
				$mode = _formdata("mode");
				echo "curl mode: $mode<br>";

				$code = _formdata("code");
				if($mode == "export"){
					// ajax_sales_trans_export.php 에서 호출

					$export_name = _formdata("export_name");
					$export_email = _formdata("export_email");
					$export_times = _formdata("export_times");

					$import_name = _formdata("import_name");
					$import_email = _formdata("import_email");
					$import_times = _formdata("import_times");


					$company_json = $_POST['company_json'];
					$business_json = $_POST['business_json'];
					$trans_json = $_POST['trans_json'];

					$trans_rows = json_decode( stripslashes($trans_json) );
					echo "trans count = ".count($trans_rows)."<br>";

					for($i=0;$i<count($trans_rows);$i++){
						$rows = $trans_rows[$i];

						// 전표 전송
    					$insert_filed = "`regdate`,";			$insert_value = "'$TODAYTIME',";
    					$insert_filed .= "`export_data`,";		$insert_value .= "'".$business_json."',";
    					$insert_filed .= "`export_name`,";		$insert_value .= "'".$export_name."',";
						$insert_filed .= "`export_email`,";		$insert_value .= "'".$export_email."',";
						$insert_filed .= "`export_times`,";		$insert_value .= "'".$export_times."',";

						$insert_filed .= "`import_data`,";		$insert_value .= "'".$company_json."',";
						$insert_filed .= "`import_name`,";		$insert_value .= "'".$import_name."',";
						$insert_filed .= "`import_email`,";		$insert_value .= "'".$import_email."',";
						
						$insert_filed .= "`transSync_code`,";		$insert_value .= "'".$_POST['transSync_code']."',";
						$insert_filed .= "`trans_id`,";		$insert_value .= "'".$rows->Id."',";
						$insert_filed .= "`trans`,";		$insert_value .= "'".$rows->trans."',";
    					$insert_filed .= "`transdate`,";			$insert_value .= "'".$rows->transdate."',";

    					$insert_filed .= "`gid`,";			$insert_value .= "'".$rows->gid."',";
    					$insert_filed .= "`goodname`,";		$insert_value .= "'".$rows->goodname."',";
    					$insert_filed .= "`spec`,";			$insert_value .= "'".$rows->spec."',";
    					$insert_filed .= "`currency`,";		$insert_value .= "'".$rows->currency."',";
    					$insert_filed .= "`num`,";			$insert_value .= "'".$rows->num."',";
    					$insert_filed .= "`prices`,";		$insert_value .= "'".$rows->prices."',";
    					$insert_filed .= "`vat`,";			$insert_value .= "'".$rows->vat."',";
    					$insert_filed .= "`discount`,";		$insert_value .= "'".$rows->discount."',";
    					$insert_filed .= "`sum`,";			$insert_value .= "'".$rows->sum."',";
    					$insert_filed .= "`total`,";		$insert_value .= "'".$rows->total."',";

    					$insert_filed .= "`paid`,";			$insert_value .= "'".$rows->paid."',";
    					$insert_filed .= "`unpaid`,";		$insert_value .= "'".$rows->unpaid."',";
    					$insert_filed .= "`paydate`,";		$insert_value .= "'".$rows->paydate."',";
    					$insert_filed .= "`payment`,";		$insert_value .= "'".$rows->payment."',";	


						$query = "INSERT INTO service.trans_sync ($insert_filed) VALUES ($insert_value)";
						$query = str_replace(",)",")",$query);
						echo $query."<br>";
						_mysqli_query($query);


					}


					

					

				} else if($mode == "import_auth"){

					$query1 = "UPDATE `sales_trans` SET  `lock`= 'on', `import`= 'on', `import_auth`= 'on', `import_authTimes`= '$TODAYTIME' WHERE `Id`='".$_POST['uid']."'";
					echo $query1."<br>";
					_mysqli_query($query1);

				} else if($mode == "import_clear"){

					$query1 = "UPDATE `sales_trans` SET  `lock`= '', `import`= '', `import_auth`= '', `import_authTimes`= '$TODAYTIME' WHERE `Id`='".$_POST['uid']."'";
					echo $query1."<br>";
					_mysqli_query($query1);	

				}

				

				// =============================

			} else {
				echo "비정상 접속! adminkey 값이 일치하지 않습니다. 해당 접속IP를 차단합니다. 해제방법은 관리자에게 문의 바랍니다. <br>";
			}

		} else {
			echo "site_env 환경 설정값을 읽어올수 없습니다. <br>";
		}
	} else {
		echo "adminkey 값이 없습니다. <br>";
	}


	
?>