<?php

	$form_table = _formdata("form_table");

	$form_select = "<select name=\"".$_form[$i]['name']."\" id=\"".$_form[$i]['name']."\" >";
	$form_select .= "<option value=''>".$_form[$i]['title']."</option>";

	if($_form[$i]['table']){
		// 셀렉트값이 테이블일 경우
					$query1 = "select * from ".$_form[$i]['table']." where enable ='on'";
					if($rowss1 = _sales_query_rowss($query1)){	
						for($k=0;$k<count($rowss1);$k++){
							$rows1 = $rowss1[$k];
							$keyField = $_form[$i]['keyfield'];
							if($rows1->$keyField == $rows->$keyField){
								$form_select .= "<option value='".$rows1->$keyField."' selected>".$rows1->$keyField."</option>";
							} else {
								$form_select .= "<option value='".$rows1->$keyField."'>".$rows1->$keyField."</option>";
							}
						}

					}	
	} else {
		// 데이터 어레이

	}							
		
	$form_select .= "</select>";
?>