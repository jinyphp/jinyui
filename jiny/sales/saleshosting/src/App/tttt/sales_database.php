<?

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";


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


	$database = "saleshosting";
    $database_target = "maxstamp";

   	if(_mysqli_is_database($database_target)){
   		echo "$database_target 데이터 베이스 있습 <br>";
   	} else {
   		//$query = "create database $database_target ";
   		// echo $query."<br>";
   		echo "$database_target 데이터베이스 생성<br>";
   		_mysqli_database_create($database_target);
   	}
		




	
	$query = "show tables from $database";
	if($rowss = _mysqli_query_rowss($query)){
		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];
			// echo json_encode($rows);
			$filedname = "Tables_in_".$database;
			echo "$i ".$rows->$filedname."<br>";
			$table_name = $rows->$filedname;

			if(_mysqli_is_table($database_target,$table_name)){
				echo "테이블 좀재 <br>"; 	
			} else {
				echo "테이블 업습xxxx <br>";
				_mysqli_table_create($database_target,$table_name);
			}

			$query1 = "SHOW COLUMNS FROM ".$table_name;
			if($rowss1 = _mysqli_query_rowss($query1)){
				for($j=0;$j<count($rowss1);$j++){
					$rows1 = $rowss1[$j];
					$filed_name = $rows1->Field;
					$filed_type = $rows1->Type;
					echo "- ".$rows1->Field."/ ".$rows1->Type." / <br>";
					if($filed_name != "Id") _mysqli_table_alter($database_target,$table_name,$filed_name,$filed_type);
				}
			}
			



		}
	}		


?>