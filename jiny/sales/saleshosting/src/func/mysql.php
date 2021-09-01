<?php

	// Mysqli DB 연결.
	$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

	/* check connection */
	if($mysqli->connect_errno) {
    	die('DB Connect Error'.$mysqli->connect_error);
	}

	$mysqli->query("set names utf8");

	// Query 데이터 갯수 체크
	function _mysqli_query_count($query){
		global $mysqli;
		if($result = $mysqli->query($query)){
			$row_cnt = mysqli_num_rows($result);
			$result->free();
			return $row_cnt;
		} 
		//else echo "Error Query: $query<br>";	
	}

	// Query Insert
	function _mysqli_insert($query){
		global $mysqli;
		if($result = $mysqli->query($query)){
			$uid = $mysqli->insert_id;
			// $result->free();
			return $uid;
		} 
		//else echo "Error Query: $query<br>";		
	}

	// Query 실행
	function _mysqli_query($query){
		global $mysqli;
		if($result = $mysqli->query($query)){
		} 
		//else echo "Error Query: $query<br>";		
	}


	// Query 데이터 한개 리턴
	function _mysqli_query_rows($query){
		global $mysqli;
		if($result = $mysqli->query($query)){
			if(mysqli_num_rows($result)) {
				$row = mysqli_fetch_object($result);
				$result->free();
				return $row;
			}
		} 
		//else echo "Error Query: $query<br>";	
	}

	// Query 데이터 rows 리턴
	function _mysqli_query_rowss($query){
		global $mysqli;
		if($result = $mysqli->query($query)){
			
			$rowss = [];
			$row_cnt = mysqli_num_rows($result);
			for($i=0;$i<$row_cnt;$i++){
				$rowss[$i] = mysqli_fetch_object($result);
			}

			$result->free();
			return $rowss;
		} 
		//else echo "Error Query: $query<br>";
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


    // 데이터베이스
	function _mysqli_is_database($database){
		$query = "show databases like '$database'";
		if($rows = _mysqli_query_rows($query)) return true; else return false;
	}

	function _mysqli_database_create($database){
		$query = "CREATE DATABASE `$database`";
		_mysqli_query($query);
	}

	function _mysqli_database_delete($database){
		$query = "DROP DATABASE `$database`";
		_mysqli_query($query);
	}

	function _mysqli_database_rename($database,$target){
		//$query = "DROP DATABASE `$database`";
		//_mysqli_query($query);
	}


	// 테이블 
    function _mysqli_is_table($database,$table){
    	// $query = "show tables like '$table'";
    	// echo $query."<br>";
    	$query = "show tables from $database like '$table'";
    	if($rows = _mysqli_query_rows($query)) return true; else return false;
    }

    function _mysqli_table_create($database,$table){
    	$query = "CREATE TABLE `$database`.`$table` (
					`Id` int(6) unsigned NOT NULL auto_increment,
					PRIMARY KEY (`Id`)
				)  ENGINE=MyISAM CHARACTER SET='utf8';";
		_mysqli_query($query);
    }

    function _mysqli_table_alter($database,$table,$filedname,$type){
    	$query = "ALTER TABLE `$database`.`$table` ADD COLUMN `$filedname` $type CHARACTER SET 'utf8' NULL;";
    	echo $query."<br>";
    	_mysqli_query($query);
    }
    
    // 테이블 필드명 변경
    // ALTER TABLE `colop`.`dfasfd` CHANGE COLUMN `test` `fff` varchar(255) NULL;

    //필드 삭제 
    function _mysqli_table_filed_delete($database,$table,$filedname){
    	$query = "ALTER TABLE `$database`.`$table` DROP COLUMN `$filedname`";
    	_mysqli_query($query);
    }
   

    function _mysqli_tables_rowss($database){
    	$query = "show tables from $database";
		if($rowss = _mysqli_query_rowss($query)){
			return $rowss;
		}
    }

    function _mysqli_tables_columns($database,$table){
    	$query1 = "SHOW COLUMNS FROM $database.".$table;
		if($rowss1 = _mysqli_query_rowss($query1)){
			return $rowss1;
		}
    }


    function _mysqli_rows_id($table,$uid){
    	if($table){
    		if($uid){
    			$query = "select * from `$table` WHERE Id =$uid";
				return _mysqli_query_rows($query);
    		}
    	}
    }

    class query {
    	public $table_name = "";
    	public $insert_filed = "";
    	public $insert_value = "";
    	public $update = "";

    	public $where = "";

    	function insert($filed,$value) { 
        	$this->insert_filed .= "`$filed`,";
			$this->insert_value .= "'$value',";
    	}

    	function update($filed,$value) { 
        	$this->update .= "`".$filed."`='".$value."' ,";
    	}

    	function insert_query(){
    		$query = "INSERT INTO ".$this->table_name." (".$this->insert_filed.") VALUES (".$this->insert_value.")";
			$query = str_replace(",)",")",$query);
    		return $query;
    	}

    	function update_query(){
    		$query = "UPDATE ".$this->table_name." SET ".$this->update;
    		$query .= "WHERE ".$this->where;

			$query = str_replace(",WHERE","WHERE",$query);
			return $query;
    	}

    	function clear(){
    		$this->table_name = "";
    		$this->insert_filed = "";
    		$this->insert_value = "";
    		$this->update = "";

    		$this->where = "";
    	}
		
    }

    
    	
?>