<?php

	///////
    function _createTableSQL($tableName,$arr){
    	$sql = "CREATE TABLE `".$tableName."` (
			`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,";

    	for($i=0;$i<count($arr);$i++) $sql .= "`".$arr[$i]['field']."` ".$arr[$i]['type']." ,";

    	$sql .= "PRIMARY KEY (`Id`)
			) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";

		echo $sql;
		return $sql;	
    }

    // sqlTable 확인
    if(_mysqli_is_table($mysql_database,$_tableName)){

    	for($i=0;$i<count($_tableField);$i++){
    		//+ 필드값이 있는지 검사
    		
    		$query = "select * from INFORMATION_SCHEMA.COLUMNS where table_name='".$_tableName."' and column_name='".$_tableField[$i]['field']."'";
    		if(_mysqli_query($query)){

    		} else {
    			// 필드값이 없는 경우 추가
    			$query = "ALTER TABLE `".$mysql_database."`.`".$_tableName."` ADD COLUMN `".$_tableField[$i]['field']."` ".$_tableField[$i]['type'];
    			_mysqli_query($query);
    		}
    		
    	}

    } else {
    	//+ 테이블 생성
    	_mysqli_query( _createTableSQL($_tableName,$_tableField) );
    }

?>