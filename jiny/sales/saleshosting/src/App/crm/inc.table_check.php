<?php
	// 테이블 및 데이터 베이스 체크
	// require_once ($_SERVER['DOCUMENT_ROOT']."/crm/inc_table_check.php");
	///////
    function _createTableSQL($tableName,$arr){
    	$sql = "CREATE TABLE `".$tableName."` (
			`Id` int(6) unsigned NOT NULL AUTO_INCREMENT,";

    	for($i=0;$i<count($arr);$i++) {
    		$rows = $arr[$i];
    		// $sql .= "`".$arr[$i]['field']."` ".$arr[$i]['type']." ".$arr[$i]['default'].",";
    		$sql .= "`".$rows->field_name."` ".$rows->field_type." ".$rows->field_default.",";
    	}    		

    	$sql .= "PRIMARY KEY (`Id`)
			) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";

		//echo $sql;
		return $sql;	
    }



    // sqlTable 확인
    if(_mysqli_is_table($mysql_database,$_tableName)){

    	$query1 = "select * from admin_tablesfield where enable='on' and table_name = '$_tableName' ";
		// echo $query1."<br>";

		if($field_rowss = _mysqli_query_rowss($query1)){
			for($i=0;$i<count($field_rowss);$i++){
    			//+ 필드값이 있는지 검사
    			$rows = $field_rowss[$i];
    			$query = "select * from INFORMATION_SCHEMA.COLUMNS where table_name='".$_tableName."' and column_name='".$rows->field_name."'";
    			if(_mysqli_query($query)){

    			} else {
    				// 필드값이 없는 경우 추가
    				$query = "ALTER TABLE `".$mysql_database."`.`".$_tableName."` ADD COLUMN `".$rows->field_name."` ".$rows->field_type;
    				_mysqli_query($query);
    			}
    		
    		}

		}    	

    } else {
    	//+ 테이블 생성
    	$query1 = "select * from admin_tablesfield where enable='on' and table_name = '$_tableName' ";
		//echo $query1."<br>";

		if($field_rowss = _mysqli_query_rowss($query1)){
			_mysqli_query( _createTableSQL($_tableName,$field_rowss) );
		} else {
            $sql = "CREATE TABLE `".$tableName."` (
            `Id` int(6) unsigned NOT NULL AUTO_INCREMENT,";
            $sql .= "PRIMARY KEY (`Id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
            _mysqli_query( $sql );

        }

    	
    }
?>