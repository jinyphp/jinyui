<?php
	// r고객DB 연결.
	if(isset($_COOKIE['cookie_email'])){
		if($sales_db = _sales_host($_COOKIE['cookie_email'])){
			$sales_mysqli = new mysqli($sales_db->hostname, $sales_db->user, $sales_db->password, $sales_db->database);
			$sales_mysqli->query("set names utf8");
		} else {

		}
		
	}	

	// 고객 DB 정보를 읽어 옵니다.
	function _sales_host($email){
		$query = "select * from service.service_host where email='".$email."'";
		$rows = _mysqli_query_rows($query);
		return $rows;
	}	

	// Query 데이터 갯수 체크
	function _sales_query_count($query){
		global $sales_mysqli;
		if($result = $sales_mysqli->query($query)){
			$row_cnt = mysqli_num_rows($result);
			$result->free();
			return $row_cnt;
		} else {
			// echo "Error Query: $query<br>";	
		}
	}

		// Query Insert
	function _sales_insert($query){
		global $sales_mysqli;
		if($result = $sales_mysqli->query($query)){
			$uid = $sales_mysqli->insert_id;
			// $result->free();
			return $uid;
		} 
		//else echo "Error Query: $query<br>";		
	}

	// Query 실행
	function _sales_query($query){
		global $sales_mysqli;
		if($result = $sales_mysqli->query($query)){
		} else {
			// echo "Error Query: $query<br>";		
		}
	}

	// Query 데이터 한개 리턴
	function _sales_query_rows($query){
		global $sales_mysqli;
		if($result = $sales_mysqli->query($query)){
			if(mysqli_num_rows($result)) {
				$row = mysqli_fetch_object($result);
				$result->free();
				return $row;
			}
		} else {
			// echo "Error Query: $query<br>";	
		}
	}

	// Query 데이터 rows 리턴
	function _sales_query_rowss($query){
		global $sales_mysqli;
		if($result = $sales_mysqli->query($query)){
			$rowss = "";
			$row_cnt = mysqli_num_rows($result);
			for($i=0;$i<$row_cnt;$i++){
				$rowss[$i] = mysqli_fetch_object($result);
			}

			$result->free();
			return $rowss;
		} else {
			// echo "Error Query: $query<br>";
		}
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

    function _sales_rows_id($table,$uid){
    	if($table){
    		if($uid){
    			$query = "select * from `$table` WHERE Id =$uid";
				return _sales_query_rows($query);
    		}
    	}
    }


    // 테이블 
    function _sales_is_table($database,$table){
    	// $query = "show tables like '$table'";
    	// echo $query."<br>";
    	$query = "show tables from $database like '$table'";
    	if($rows = _sales_query_rows($query)) return true; else return false;
    }

    function _sales_table_create($database,$table){
    	$query = "CREATE TABLE `$database`.`$table` (
					`Id` int(6) unsigned NOT NULL auto_increment,
					PRIMARY KEY (`Id`)
				)  ENGINE=MyISAM CHARACTER SET='utf8';";
		_sales_query($query);
    }

    function _sales_table_alter($database,$table,$filedname,$type){
    	$query = "ALTER TABLE `$database`.`$table` ADD COLUMN `$filedname` $type CHARACTER SET 'utf8' NULL;";
    	// echo $query."<br>";
    	_sales_query($query);
    }


    

?>