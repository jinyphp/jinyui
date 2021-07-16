<?php
	@session_start();

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");


	// POST키값을 기준으로 변수 = 값 지정.
	$arr = array_keys($_POST);
	for($i=0;$i<count( $arr );$i++){
		$key_name = $arr[$i];
		${$key_name} = _formdata($key_name);		
	}

	echo "mode = ".$mode."<br>";

	if($mode == "enable"){
			$query = "UPDATE $_tableName SET `enable`='on' WHERE `$_primaryKey`='$_primaryValue'";
			_mysqli_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE $_tableName SET `enable`='' WHERE `$_primaryKey`='$_primaryValue'";
			_mysqli_query($query);

		} else if($mode == "delete"){
			
			$query = "DELETE FROM $_tableName WHERE `$_primaryKey`='$_primaryValue'";
    		_mysqli_query($query);    		
		
		} else if($mode == "edit"){

			$query = "select * from $_tableName where $_primaryKey='$_primaryValue'";
			echo $query;
			if($rows = _mysqli_query_rows($query)){

				// 원본 데이터베이스 / 테이블 필트 목록 읽어오기...
				$query1 = "SHOW COLUMNS FROM ".$mysql_database.".".$_tableName.";";
				echo "비교중... <br>";				
				if($rowss1 = _mysqli_query_rowss($query1)){					
					for($j=0;$j<count($rowss1);$j++){
						$rows1 = $rowss1[$j];
						$filed_name = $rows1->Field;
						
						echo $filed_name."<br>"; 

							
					} // field 검사 끝.
				}


			
				// 수정 	
				/*			
				$query = "UPDATE $_tableName SET ";



				
				for($i=0;$i<count($_form);$i++){
					if($_form[$i]['type'] == "input"){
						$key = $_form[$i]['name'];
						$query .= "`$key`='".$_POST[$key]."' ,";

					} else if($_form[$i]['type'] == "checkbox"){
						$key = $_form[$i]['name'];
						$query .= "`$key`='".$_POST[$key]."' ,";

					} else if($_form[$i]['type'] == "textarea"){
						$key = $_form[$i]['name'];
						$query .= "`$key`='".addslashes($_POST[$key])."' ,";	
					}
				}
				

				$query .= "WHERE `$_primaryKey`='$_primaryValue'";
				$query = str_replace(",WHERE","WHERE",$query);
				_mysqli_query($query);
				*/
			}

		} else if($mode == "new"){

			/*
			for($i=0;$i<count($_form);$i++){
				if($_form[$i]['type'] == "input"){
					$key = $_form[$i]['name'];
					// $query .= "`$key`='".$_POST[$key]."' ,";
					$insert_filed .= "`$key`,"; $insert_value .= "'".$_POST[$key]."',";

				} else if($_form[$i]['type'] == "checkbox"){
					$key = $_form[$i]['name'];
					//$query .= "`$key`='".$_POST[$key]."' ,";
					$insert_filed .= "`$key`,"; $insert_value .= "'".$_POST[$key]."',";

				} else if($_form[$i]['type'] == "textarea"){
					$key = $_form[$i]['name'];
					$insert_filed .= "`$key`,"; $insert_value .= "'".addslashes($_POST[$key])."',";
					
				} else if($_form[$i]['name'] == "regdate"){
					$key = $_form[$i]['name'];					
					$insert_filed .= "`$key`,"; $insert_value .= "'".$TODAYTIME."',";
				}	
			}

			

			$query = "INSERT INTO $_tableName ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			// echo $query."<br>";
			_mysqli_query($query);
			*/

		}







	
?>