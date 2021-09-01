<?php


	// sql injection 공격을 방지하기 위하여 post / get 데이터를 필터링 합니다.
	function _formdata($key){
		if(isset($_POST[$key])){
    		$value = $_POST[$key];
    		// 보안 체크 ' 마크 제거
			$value = str_replace("'","",$value); 

    	} else if(isset($_GET[$key])) {
    		$value = $_GET[$key];
    		// 보안 체크 ' 마크 제거
			$value = str_replace("'","",$value);

		} else $value= NULL;
		
		return $value;
	}

	function _post($key){
		if(isset($_POST[$key])){ 		
			return str_replace("'","",$_POST[$key]); // 보안 체크 ' 마크 제거
		} else return NULL;
	}

	function _get($key){
		if(isset($_GET[$key])){ 		
			return str_replace("'","",$_GET[$key]); // 보안 체크 ' 마크 제거
		} else return NULL;
	}


	// mode 값을 읽어옴.
	function _formmode(){
		return _formdata("mode");
		/*
		if(isset($_POST['mode'])){
    		$mode = $_POST['mode'];
    	} else if(isset($_GET['mode'])) {
    		$mode = $_GET['mode'];
		} else $mode="";

		// 보안 체크 ' 마크 제거
		$mode = str_replace("'","",$mode); 

		return $mode;
		*/
	}


	function _form_upload($upload,$save){
		if (isset($_FILES[$upload][tmp_name])){
			$uploadfile = "./orders/$THIS_YEAR/$THIS_MONTH/$THIS_DAY/".$_FILES[$upload][name];
   			$ext = substr($uploadfile, strrpos($uploadfile, '.') + 1); 
   			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   			$filename = "./orders/$THIS_YEAR/$THIS_MONTH/$THIS_DAY/$cartlog-$UID".$ext;
   			move_uploaded_file($_FILES[$upload][tmp_name], $filename);
   		} 
	}

	function _form_check_enable($check){
		if($check){
			return "<input type='checkbox' name='enable' checked >";
		} else {
			return "<input type='checkbox' name='enable' >";
		}
	}

	function _form_checkbox($name,$check){
		if($check){
			return "<input type='checkbox' name='$name' checked >";
		} else {
			return "<input type='checkbox' name='$name' >";
		}
	}	

	function _form_text($name,$value,$css){
		return "<input type='text' name='$name' value='".$value."' style=\"$css\" >";
	}

	function _form_text_require($name,$value,$css){
		return "<input type='text' name='$name' value='".$value."' style=\"$css\" require>";
	}

	function _form_email($name,$value,$css){
		return "<input type='email' name='$name' value='".$value."' style=\"$css\" >";
	}

	function _form_email_require($name,$value,$css){
		return "<input type='email' name='$name' value='".$value."' style=\"$css\" require>";
	}

	function _form_password($name,$value,$css){
		return "<input type='password' name='$name' value='".$value."' style=\"$css\" >";
	}

	function _form_password_require($name,$value,$css){
		return "<input type='password' name='$name' value='".$value."' style=\"$css\" require>";
	}

	function _form_number($name,$value,$css){
		return "<input type='text' name='$name' value='".$value."' style=\"$css\" >";
	}

	function _form_date($name,$value,$css){
		return "<input type='date' name='$name' value='".$value."' style=\"$css\" >";
	}

	function _form_textarea($name,$value,$rows,$css){
		return "<textarea name='$name' rows='$rows' style='$css'>".$value."</textarea>";
	}

	function _form_file($name,$css){
		return "<input type='file' name='$name' style=\"$css\" >";
	}


	function _html_form_uploadfile($formname,$filename){
    	if($_FILES[$formname]['tmp_name']){
    		// 파일 확장자 검사
    			
    		$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    		if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    		else {
    			if($filename == ""){
    				// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    				move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    			} else {
    					
    				move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    			}
    			$files['filename'] = $filename;
    			$files['name'] = $_FILES[$formname]['name'];
    			$files['ext'] = $ext;
    			return $files;
    		}  
				
    	} else return NULL;
	}


	// HTML Form
	function _html_form_select($id,$css,$name,$rowss,$select,$value_field,$title_field,$title){
		// $rowss 어레이 데이터 기반으로 select 생성
		$form_select = "<select name=\"".$name."\" style=\"$css\" id=\"$id\">";
		$form_select .= "<option value=''>".$title."</option>";
		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];

			if($rows->$value_field == $select){
				$form_select .= "<option value='".$rows->$value_field."' selected>".$rows->$title_field."</option>";
			} else {
				$form_select .= "<option value='".$rows->$value_field."'>".$rows->$title_field."</option>";
			}
		}
		
		$form_select .= "</select>";
		return $form_select;
	}

	function _html_form_select_json($id,$css,$name,$rowss,$select,$value_field,$title_field,$title){
		global $site_language;
		// $rowss 어레이 데이터 기반으로 select 생성
		// $title_field : json 언어별 처리로 표기
		$form_select = "<select name=\"".$name."\" style=\"$css\" id=\"$id\">";
		$form_select .= "<option value=''>".$title."</option>";
		for($i=0;$i<count($rowss);$i++){
			$rows = $rowss[$i];

			if(isset($rows->level)){
				for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;"; 
				$space .= "└"; 
			} else $space = "";
			

			$json = json_decode($rows->$title_field);
			if($rows->$value_field == $select){
				$form_select .= "<option value='".$rows->$value_field."' selected>".$space.$json->$site_language."</option>";
			} else {
				$form_select .= "<option value='".$rows->$value_field."'>".$space.$json->$site_language."</option>";
			}
		}
		
		$form_select .= "</select>";
		return $form_select;
	}



	// HTML From 생성
	// Type 	: 	여러개 라디오 버튼 생성 및 선택
	// Descript :	$radio_string = "inout=sell;inout=buy;inout=buysell;inout=personal"; 
	function _html_FormRadio_sel($name,$string,$sel){
		$_radio = explode(";", $string);
		for($i=0;$i<count($_radio);$i++){
			$radio = explode("=", $_radio[$i]);
			$body .= " <input type=radio name='".$name."' value='".$radio[1]."'";
			if($radio[1] == $sel) $body .= " checked='checked'";
			$body .= ">&nbsp;".$radio[0]."&nbsp;&nbsp;&nbsp;";
		}
		return $body;
	}


	// ======================================================================================
	// ======================================================================================



	//////////
	// HTML 코드생성 함수
	
	function _html_div($id,$css,$content){
		if($content){
			$html = "<div ";
			if($css) $html .= "style=\"$css\" ";
			if($id) $html .= "id=\"$id\" ";
			$html .= "> $content </div>";
			return $html;
		}		
	}

	function _html_div_clearfix($content,$css){
		return "<div class=\"clearfix\" style=\"$css\"> $content </div>";
	}






	//# 기본 리스트 select
	function _listnum_select($_list_num){
		global $css_textbox;
		$form_num = "<select name='list_num' id=\"list_num\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		return $form_num;
	}







	// 국가 목록 select
	function _country_OnSelect($country){
		global $css_textbox;
		global $site_language;

		$query = "select * from country where enable ='on'";
		$country_select = "<select name='country' style=\"$css_textbox\">";	
		if($rowss = _sales_query_rowss($query)){					
			
			if($country){
				$country_select .= "<option value=''>국가 선택</option>";
			} else {
				$country_select .= "<option value='' selected>국가 선택</option>";
			}

			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];

				$title = stripslashes($rows1->name);
				$name = json_decode($title);

				if($country == $rows1->Id){
					$country_select.= "<option value='".$rows1->code."' selected>".$name->$site_language."(".$rows1->code.")</option>";
				} else $country_select .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
			}			
		}
		$country_select .= "</select>";
		return $country_select; 
	}















	// 상품별 판매국가 : 수동으로 지정 가능 , multi select 문으로 작성	
	function _form_select_country($name,$multi,$sel,$css){
		global $site_language;

		//echo "$name - $multi - $sel - $css <br>";
		$query = "select * from `shop_country` ";
		if($rowss = _mysqli_query_rowss($query)){	
			
			if($multi){ // 멀티 선택여부 체크, 
				$form_select = "<select multiple name='".$name."[]' size='5' style='$css'>";
				$country_check = explode(";",$sel);
			} else {
				$form_select = "<select name='".$name."' style='$css'>";	
			}		
			
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				
				$title = stripslashes($rows1->name);
				//echo $title."<br>";
				$name = json_decode($title);
						
				if($sel){

					// 선택값 체크...
					if($multi){ 
						for($country_flag = NULL, $k=0;$k<count($country_check); $k++) {
							if($country_check[$k] == $rows1->code) $country_flag = true; else $country_flag = false; 
						}	
					} else {
						if($sel == $rows1->code) $country_flag = true; else $country_flag = false; 
					}

					if($country_flag) $form_select .= "<option value='".$rows1->code."' selected>".$name->$site_language."(".$rows1->code.")</option>";
					else $form_select .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
				
				} else {
					$form_select .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
				}
			}

			$form_select .= "</select>";
			
		}
		return $form_select;
	}

	// 언어 셀렉트 폼 생성	
	function _form_select_language($name,$sel,$css){
		global $site_language;
		
		//echo "$name - $multi - $sel - $css <br>";
		$query = "select * from `site_language` ";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$form_select = "<select name='".$name."' style='$css'>";	
			
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				
				$title = stripslashes($rows1->name);
				//echo $title."<br>";
				$name = json_decode($title);
						
				if($sel){

					// 선택값 체크...
					if($sel == $rows1->code) $country_flag = true; else $country_flag = false; 

					if($country_flag) $form_select .= "<option value='".$rows1->code."' selected>".$name->$site_language."(".$rows1->code.")</option>";
					else $form_select .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
				
				} else {
					$form_select .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
				}
			}
			
			$form_select .= "</select>";
			
		}
		

		return $form_select;
	}	


	// Table and Div
	// 메세지 출력을 위한 테이블 셀 형식
	function _msg_tableCell($msg){
		return "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
				<tr>
				<td style='font-size:12px;padding:10px;' align='center'>".$msg."</td>
				</tr>
				</table>";
	}

	function _table_array($table_data){				
		$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		for($i=0;$i<count($table_data);$i++){
			$list .= "<td ";

			if($table_data[$i]['css']) $list .= "style='".$table_data[$i]['css']."' ";
			else $list .= "style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' ";

			$list .= " width='".$table_data[$i]['width']."'>".$table_data[$i]['value']."</td>";
		}
		$list .= "</tr></table>";
		//print_r($table_data);	
		return $list;
	}

	// ++ 리스트나열 테이블 출력
	function _table_datalist($width, $title){
		$list = "<table id=\"datalist\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
		$list .= "<tr>";

		for($i=0;$i<count($title);$i++){
			$list .= "<td ";
			if($width[$i]>0) $list .= "width='".$width[$i]."'";
			$list .=" valign='top'>".$title[$i]."</td>";
		}

		$list .= "</tr>";
		$list .= "</table>";
		return $list;
	}



?>