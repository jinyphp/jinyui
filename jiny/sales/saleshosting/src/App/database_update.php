<?php

	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";
	include "./func/form.php";

	include "./conf/sales.php";

	echo "CURL Database"."<br>";

	$database = "vidacar";
    if($database_target = _formdata("database")){
    	echo "--- Checking Database ---"."<br>";
    	
    	// 데이터베이스 검사 
    	if(_mysqli_is_database($database_target)){
   			echo "Database : ".$database_target."<br>";
   		} else {
   			echo "Create : $database_target"."<br>";
   			_mysqli_database_create($database_target);
   		}

   		echo "--- Checking Tables ---"."<br>";

   		// 테이블 목록읽어 오기 
   		$query = "show tables from $database";
   		echo $query."<br>";
   		if($rowss = _mysqli_query_rowss($query)){
   			echo "tables = ".count($rowss)."<br>";
   			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$filedname = "Tables_in_".$database;
				$table_name = $rows->$filedname;
				echo "$i : Tables = ".$table_name;

				// 대상 Target 데이터베이스 , 테이블 확인 
				if(_sales_is_table($database_target,$table_name)){
					echo "<br>"; 	
				} else {
					echo " >> Creating... <br>";
					_sales_table_create($database_target,$table_name);
				}


				// 원본 데이터베이스 / 테이블 필트 목록 읽어오기...
				$query1 = "SHOW COLUMNS FROM ".$database.".".$table_name;
				echo $query1;
				if($rowss1 = _mysqli_query_rowss($query1)){
					for($j=0;$j<count($rowss1);$j++){
						$rows1 = $rowss1[$j];
						$filed_name = $rows1->Field;
						$filed_type = $rows1->Type;
						echo "* ".$rows1->Field."(".$rows1->Type.")<br>";
						if($filed_name != "Id") _sales_table_alter($database_target,$rows->$filedname,$filed_name,$filed_type);
					}
				}
				

				echo "<br>";




			}	

   		}

   		/*
		if($rowss = _mysqli_query_rowss($query)){
			//echo "tables = ".count($rowss)."<br>";
			
			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];
				echo "$i : Tables = ".$rows->$filedname;
				
				// 대상 Target 데이터베이스 , 테이블 확인 
				if(_mysqli_is_table($database_target,$rows->$filedname)){
					echo "<br>"; 	
				} else {
					echo " >> Creating... <br>";
					_mysqli_table_create($database_target,$rows->$filedname);
				}

				$filedname = "Tables_in_".$database;
				
				
			
			} 
			
		} else {
			echo "--- Error : can't find source database ----"."<br>";

		}
*/
    } else {
    	echo "--- Error : database is not define ----"."<br>";
    }

    

	

?>