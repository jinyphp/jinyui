<?php
	//+ form 리스트처리
	for($i=0;$i<count($_form);$i++){

		//if($rows->$_form[$i]['require']) $require = "require"; else $require = "";
		if($_form[$i]['type'] == "post_value"){	
			// post 값을 출력	
			$post_key = $_form[$i]['name'];
			//echo $_form[$i]['str']."<br>";
			//echo "postkey = ".$post_key;
			$body = str_replace($_form[$i]['str'],${$post_key},$body);			
		
		} else if($_form[$i]['type'] == "field"){	
			// 필드값을 출력함		
			$body = str_replace($_form[$i]['str'],$rows->$_form[$i]['name'],$body);				

		} else if($_form[$i]['type'] == "checkbox"){
				// 체크박스 처리
				
				if($rows->$_form[$i]['name']) $value = $rows->$_form[$i]['name']; else $value = $_form[$i]['default'];

				if($value)$str = "<input type='checkbox' name='".$_form[$i]['name']."' id=\"".$_form[$i]['name']."\"  checked >";
				else $str = "<input type='checkbox' name='".$_form[$i]['name']."' id=\"".$_form[$i]['name']."\" >";

				$body = str_replace($_form[$i]['str'],$str,$body);
				

		} else if($_form[$i]['type'] == "datetime"){
				// input 값 처리 
				
				if($rows->$_form[$i]['name']) $value = $rows->$_form[$i]['name']; else $value = $TODAYTIME;
				$str = "<input type='date' name='".$_form[$i]['name']."'  value='".$value."' style=\"$css_textbox\" id=\"".$_form[$i]['name']."\" >";
				$body = str_replace($_form[$i]['str'],$str,$body);
				

		} else if($_form[$i]['type'] == "input"){
				// input 값 처리
				
				if($rows->$_form[$i]['name']) $value = $rows->$_form[$i]['name']; else $value = $_form[$i]['default'];

				$str = "<input type='text' name='".$_form[$i]['name']."'  value='".$value."' style=\"$css_textbox\" id=\"".$_form[$i]['name']."\" $require >";
				$body = str_replace($_form[$i]['str'],$str,$body);
				

		} else if($_form[$i]['type'] == "number"){
				// input 값 처리 
				
				if($rows->$_form[$i]['name']) $value = $rows->$_form[$i]['name']; else $value = $_form[$i]['default'];
				$str = "<input type='number' name='".$_form[$i]['name']."' value='".$value."' style=\"$css_textbox\" id=\"".$_form[$i]['name']."\" >";
				$body = str_replace($_form[$i]['str'],$str,$body);
				
					
		} else if($_form[$i]['type'] == "textarea"){
				// textarea 처리
				
				if($rows->$_form[$i]['name']) $value = $rows->$_form[$i]['name']; else $value = $_form[$i]['default'];
				$str = "<textarea name='".$_form[$i]['name']."' style=\"$css_textbox\" id=\"".$_form[$i]['name']."\" >".stripslashes($value)."</textarea>";
				$body = str_replace($_form[$i]['str'],$str,$body);
				

		} else if($_form[$i]['type'] == "hidden"){
				// hidden값 처리 ...
				
				if($value = _formdata($_form[$i]['name'])) {
					// POST / GET 값을 처리 
				} else if($rows->$_form[$i]['name']) {
					// 데이터값을
					$value = $rows->$_form[$i]['name'];  
				} else {
					// 디폴트값
					$value = $_form[$i]['default']; 
				}
				$str = "<input type='hidden' name='".$_form[$i]['name']."' value='".$value."' id=\"".$_form[$i]['name']."\" >";
				$form_start .= $str;
				$body = str_replace($_form[$i]['str'],$str,$body);
				

		} else if($_form[$i]['type'] == "select"){
				// form필드 셀렉트값일 경우.
				
				$form_select = "<select name=\"".$_form[$i]['name']."\" id=\"".$_form[$i]['name']."\" >";
				$form_select .= "<option value=''>".$_form[$i]['title']."</option>";

				if($_form[$i]['table']){
					// 셀렉트값이 테이블일 경우
					$query1 = "select * from ".$_form[$i]['table']." where enable ='on'";
					
					// +검색조건이 있는 경우
					if($_form[$i]['where'] && $_form[$i]['where_value']){
						$query1 .= " and ".$_form[$i]['where']." = '"._formdata($_form[$i]['where_value'])."'";
					}

					echo $query1;

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
				$body = str_replace($_form[$i]['str'],$form_select,$body);
				
				
		} else if($_form[$i]['type'] == "array"){
				// form필드 셀렉트값일 경우.
				
				$form_select = "<select name=\"".$_form[$i]['name']."\" id=\"".$_form[$i]['name']."\" >";
				$rows1 = explode(",", $_form[$i]['array']);
				$keyField = $_form[$i]['name'];

				for($k=0;$k<count($rows1);$k++){
					if($rows1[$k] == $rows->$keyField){
						$form_select .= "<option value='".$rows1[$k]."' selected>".$rows1[$k]."</option>";
					} else {
						$form_select .= "<option value='".$rows1[$k]."'>".$rows1[$k]."</option>";
					}
				}

										
		
				$form_select .= "</select>";
				$body = str_replace($_form[$i]['str'],$form_select,$body);
				
				
		}

			
	}
?>