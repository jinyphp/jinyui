<?php

	function _hosting_host($email){
		$query = "select * from service_host where email='".$email."'";
		$rows = _mysqli_query_rows($query);
		return $rows;
	}

	// Mysqli DB 연결.
	if(isset($_COOKIE['cookie_email'])){
		$hosting_db = _hosting_host($_COOKIE['cookie_email']);
		$hosting_mysqli = new mysqli($hosting_db->hostname, $hosting_db->user, $hosting_db->password, $hosting_db->database);
	}	

	/* check connection */
	if($hosting_mysqli->connect_errno) {
    	die('DB Connect Error'.$hosting_mysqli->connect_error);
	}

	$hosting_mysqli->query("set names utf8");

	// Query 데이터 갯수 체크
	function _hosting_query_count($query){
		global $hosting_mysqli;
		if($result = $hosting_mysqli->query($query)){
			$row_cnt = mysqli_num_rows($result);
			$result->free();
			return $row_cnt;
		} else echo "Error Query: $query<br>";	
	}


	// Query 실행
	function _hosting_query($query){
		global $hosting_mysqli;
		if($result = $hosting_mysqli->query($query)){
		} else echo "Error Query: $query<br>";		
	}


	// Query 데이터 한개 리턴
	function _hosting_query_rows($query){
		global $hosting_mysqli;
		if($result = $hosting_mysqli->query($query)){
			if(mysqli_num_rows($result)) {
				$row = mysqli_fetch_object($result);
				$result->free();
				return $row;
			}
		} else echo "Error Query: $query<br>";	
	}

	// Query 데이터 rows 리턴
	function _hosting_query_rowss($query){
		global $hosting_mysqli;
		if($result = $hosting_mysqli->query($query)){
			$rowss = "";
			$row_cnt = mysqli_num_rows($result);
			for($i=0;$i<$row_cnt;$i++){
				$rowss[$i] = mysqli_fetch_object($result);
			}

			$result->free();
			return $rowss;
		} else echo "Error Query: $query<br>";
	}
	

	/*

	// SHOW FULL COLUMNS FROM tbl_name
    	$query = "SHOW FULL COLUMNS FROM $table"; 
    	echo $query."<br>";
    	$rowss = _local_query_rowss($query);
    	//echo "count ".count($rows);
    	for($i=0;$i<count($rowss);$i++) {
    		$rows = $rowss[$i];
    		//echo "$rows[0] <br>";
    		echo "ALTER TABLE `$table` CHANGE `$rows[Field]` `$rows[Field]` $rows[Type] COMMENT '$rows[Comment]' <br>";
    	}
    	
	*/
?>