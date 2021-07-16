<?php
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

		} else if($_form[$i]['type'] == "hidden"){
			$key = $_form[$i]['name'];
			// $query .= "`$key`='".$_POST[$key]."' ,";
			$insert_filed .= "`$key`,"; $insert_value .= "'".$_POST[$key]."',";

		} else if($_form[$i]['type'] == "select"){
			$key = $_form[$i]['name'];
			// $query .= "`$key`='".$_POST[$key]."' ,";
			$insert_filed .= "`$key`,"; $insert_value .= "'".$_POST[$key]."',";

		} else if($_form[$i]['type'] == "array"){
			$key = $_form[$i]['name'];
			// $query .= "`$key`='".$_POST[$key]."' ,";
			$insert_filed .= "`$key`,"; $insert_value .= "'".$_POST[$key]."',";

		}
	}	
?>