<?php
	

	// ++ form 입력 처리 루틴
	// 해당 테이블의 form처리할 field을 검색
	$query1 = "select * from admin_tablesfield where form_check='on' and table_name = '$_tableName' ";
	//echo $query1."<br>";
	if($field_rowss = _mysqli_query_rowss($query1)){

		for($i=0;$i<count($field_rowss);$i++){
    		$formfield = $field_rowss[$i];

    		//echo $formfield->form_str." type:".$formfield->form_type."<br>";

    		if($formfield->form_type == "post_value"){	
				//+ post 값을 출력
				$post_key = $formfield->field_name;
				$body = str_replace($formfield->form_str,${$post_key},$body);			
		
			} else if($formfield->form_type == "field"){	
				//+ 데이터 필드값을 출력함
				$_field = $formfield->field_name;	
				$body = str_replace($formfield->form_str,$rows->$_field,$body);				

			} else if($formfield->form_type == "checkbox"){
				//+ 체크박스 처리
				$_field = $formfield->field_name;
				if($rows->$_field) $value = $rows->$_field; else $value = $formfield->field_default;

				if($value) $str = "<input type='checkbox' name='".$_field."' id=\"".$_field."\"  checked >";
				else $str = "<input type='checkbox' name='".$_field."' id=\"".$_field."\" >";

				$body = str_replace($formfield->form_str,$str,$body);
				

			} else if($formfield->form_type == "datetime"){
				//+ input 시간일자로 처리 
				$_field = $formfield->field_name;
				if($rows->$_field) $value = $rows->$_field; else $value = $TODAYTIME;
				$str = "<input type='date' name='".$_field."'  value='".$value."' style=\"$css_textbox\" id=\"".$_field."\" >";
				$body = str_replace($formfield->form_str,$str,$body);				

			} else if($formfield->form_type == "input"){
				//+ input 값 처리
				if($formfield->form_lang){
					$_field = $formfield->field_name;
					if($rows->$_field) $value = $rows->$_field; else $value = $formfield->field_default;
					
					// 다국어로 처리함
					$query = "select * from `site_language` ";	
					if($lang_rowss = _mysqli_query_rowss($query)){
						$skin_language = "";
						$skin_forms = "";
						for($j=0;$j<count($lang_rowss);$j++){
							$lang_rows= $lang_rowss[$j];
							$form_langcode = $lang_rows->code;

							//탭라벨 이름표기
							if($site_language == $lang_rows->$form_langcode){
								$skin_language .= "<input id='tab-".$j."' type='radio' name='skin_language' value='".$lang_rows->$form_langcode."' checked=\"checked\">";
							} else {								
								$skin_language .= "<input id='tab-".$j."' type='radio' name='skin_language' value='".$lang_rows->$form_langcode."'>";
							}

							$skin_language .= "<label for='tab-".$j."'>".$form_langcode."</label>";
						
							//if(isset($title->$$form_langcode)) $lang_text = $title->$$form_langcode; else $lang_text = "";
							$skin_forms .="<div class='tab-$j"."_content'>				   
										<table border='0' width='100%' cellspacing='2' cellpadding='2'  bgcolor='#FAFAFA'>			
											<tr>
											<td><textarea name='".$_field."_".$form_langcode."' rows='5' style='width:100%'>".$value."</textarea></td>
											</tr>
										</table>
										</div>";
						}
								
						$tabbar = "<div id='css_tabs'> $skin_language $skin_forms </div>";
					}

					$body = str_replace("{seo_language}","$tabbar",$body);

				} else {
					$_field = $formfield->field_name;
					if($rows->$_field) $value = $rows->$_field; else $value = $formfield->field_default;

					$str = "<input type='text' name='".$_field."'  value='".$value."' style=\"$css_textbox\" id=\"".$_field."\" $require >";
					$body = str_replace($formfield->form_str,$str,$body);
				}
								

			} else if($formfield->form_type == "number"){
				// input 값 처리 
				$_field = $formfield->field_name;
				if($rows->$_field) $value = $rows->$_field; else $value = $formfield->field_default;
				$str = "<input type='number' name='".$_field."' value='".$value."' style=\"$css_textbox\" id=\"".$_field."\" >";
				$body = str_replace($formfield->form_str,$str,$body);
				
					
			} else if($formfield->form_type == "textarea"){
				// textarea 처리
				$_field = $formfield->field_name;
				if($rows->$_field) $value = $rows->$_field; else $value = $formfield->field_default;
				$str = "<textarea name='".$_field."' style=\"$css_textbox\" id=\"".$_field."\" >".stripslashes($value)."</textarea>";
				$body = str_replace($formfield->form_str,$str,$body);				

			} else if($formfield->form_type == "hidden"){
				// hidden값 처리 ...
				$_field = $formfield->field_name;
				if($value = _formdata($_field )) {
					// POST / GET 값을 처리 
				} else if($rows->$_field ) {
					// 데이터값을
					$value = $rows->$_field ;  
				} else {
					// 디폴트값
					$value = $formfield->field_default; 
				}
				$str = "<input type='hidden' name='".$_field."' value='".$value."' id=\"".$_field."\" >";
				$form_start .= $str;
				$body = str_replace($formfield->form_str,$str,$body);
				

			} else if($formfield->form_type == "select"){
				// form필드 셀렉트값일 경우.
				$_field = $formfield->field_name;
				$form_select = "<select name=\"".$_field."\" id=\"".$_field."\" >";
				$form_select .= "<option value=''>".$formfield->form_selecttitle."</option>";

				if($formfield->form_table){
					// 셀렉트값이 테이블일 경우
					$query1 = "select * from ".$formfield->form_table." where enable ='on'";
					
					// +검색조건이 있는 경우
					if($formfield->form_tablewhere && $formfield->form_tablewherevalue){
						$query1 .= " and ".$formfield->form_tablewhere." = '"._formdata($formfield->form_tablewherevalue)."'";
					}

					//echo $query1;

					if($rowss1 = _sales_query_rowss($query1)){	
						for($k=0;$k<count($rowss1);$k++){
							$rows1 = $rowss1[$k];
							$keyField = $formfield->form_tablefield;
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
				$body = str_replace($formfield->form_str,$form_select,$body);
				
				
			} else if($formfield->form_type == "array"){
				// form필드 셀렉트값일 경우.
				$_field = $formfield->field_name;
				$form_select = "<select name=\"".$_field."\" id=\"".$_field."\" >";
				$rows1 = explode(",", $formfield->form_array);
				$keyField = $_field;

				for($k=0;$k<count($rows1);$k++){
					if($rows1[$k] == $rows->$keyField){
						$form_select .= "<option value='".$rows1[$k]."' selected>".$rows1[$k]."</option>";
					} else {
						$form_select .= "<option value='".$rows1[$k]."'>".$rows1[$k]."</option>";
					}
				}

										
		
				$form_select .= "</select>";
				$body = str_replace($formfield->form_str,$form_select,$body);
				
			} else if($formfield->form_type == "inc"){
				// ++ 자동증가 1
				
			
			} else if($formfield->form_type == "max"){
				// ++ 최대값으로 저장

			} else if($formfield->form_type == "min"){
				// ++ 최소값 으로 저장
			
			}



    	}
    }			


?>