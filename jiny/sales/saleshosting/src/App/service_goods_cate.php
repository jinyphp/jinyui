<?php
	//*  WebLib V1.5
	//*  Program by : hojin lee
	//*  
	//*
	// update : 2016.01.04 = 코드정리 

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/css.php";

	// 메인 카테고리,

	$master_cate = _formdata("master_cate");
	//echo "Master = $master_cate";
	$query = "select * from `shop_cate` ";
	$query .= "order by pos desc";	
	if($rowss = _mysqli_query_rowss($query)){

		if($site_mobile == "m"){
			$css_multiselect = "width:100%;	height:50px; font-size:12px; border:1px solid #d8d8d8;";
		} else {
			$css_multiselect = "width:100%;	height:400px; font-size:12px; border:1px solid #d8d8d8;";
		}
		
				

		$check = explode(";",$master_cate);
		$cate = "<select multiple name='master_cate[]' size='30' style='$css_multiselect'>";
					
		for($i=0;$i<count($rowss);$i++){
						
			$rows= $rowss[$i];
			$cate .= "<option value='".$rows->Id."' ";
					
			for($k=0;$k<count($check); $k++){
				if($check[$k] == $rows->Id) $cate .= "selected";
			}
				
			$title = stripslashes($rows->title);
			$title_name = json_decode($title);

			for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;└"; 

			$cate .= ">$space".$title_name->$site_language."</option>";

		}
		$cate .= "</select>";	
					
	}
				
	echo $cate;


?>