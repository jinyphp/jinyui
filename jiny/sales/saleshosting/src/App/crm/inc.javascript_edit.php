<?php
	// 필수 입력갑 항목 체크 
	$query1 = "select * from admin_tablesfield where enable='on' and table_name = '$_tableName' ";
	$_log_history .= $query1."<br>";

	if($field_rowss = _mysqli_query_rowss($query1)){
		for($i=0;$i<count($field_rowss);$i++){
    		$formfield = $field_rowss[$i];

    		if($formfield->form_require) 
			$script_require .= "
			var ".$formfield->field_name." = $('#".$formfield->field_name."').val();
           		if(!".$formfield->field_name."){
           			alert(\"".$formfield->form_msg."\");
           			return;
           		}
           	";

    	}
    }
    /*
	for($i=0;$i<count($_form);$i++){

		if($_form[$i]['require']) 
			$script_require .= "
			var ".$_form[$i]['name']." = $('#".$_form[$i]['name']."').val();
           		if(!".$_form[$i]['name']."){
           			alert(\"".$_form[$i]['msg']."\");
           			return;
           		}
           	";
	}
	*/

	$javascript = "<script>
		function form_submit(mode,uid){
			".$script_require."
			var url = \"ajax_".$_tableName."_editup.php?uid=\"+uid+\"&mode=\"+mode;
			var formData = new FormData($('#data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});		

    		history.go(-1);	
		}



	</script>";
?>