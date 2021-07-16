<?php
	$query1 = "select * from admin_tablesfield where enable='on' and table_name = '$_tableName' ";
	$_log_history .= $query1."<br>";

	if($field_rowss = _mysqli_query_rowss($query1)){
		for($i=0;$i<count($field_rowss);$i++){
    		$formfield = $field_rowss[$i];

    		if($formfield->form_type == "input"){
				$key = $formfield->field_name;
				$query .= "`$key`='".$_POST[$key]."' ,";

			} else if($formfield->form_type == "checkbox"){
				$key = $formfield->field_name;
				$query .= "`$key`='".$_POST[$key]."' ,";

			} else if($formfield->form_type == "textarea"){
				$key = $formfield->field_name;
				$query .= "`$key`='".addslashes($_POST[$key])."' ,";	
		
			} else if($formfield->form_type == "array"){
				$key = $formfield->field_name;
				$query .= "`$key`='".$_POST[$key]."' ,";

			}

    	}
    }

	
?>