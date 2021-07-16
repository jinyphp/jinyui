<?php
    // 테이블 이름
    $_tableName = "admin_tablesfield";

    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},        
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        
    	{"field":"table_name","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"field_title","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"field_name","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"field_type","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"field_default","type":"varchar(255)","default":"DEFAULT NULL"},  

    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"pos","type":"int","default":"DEFAULT NULL"},

    	{"field":"list_display","type":"varchar(10)","default":"DEFAULT NULL"},
        {"field":"list_width","type":"varchar(10)","default":"DEFAULT NULL"},
        

    	{"field":"form_check","type":"varchar(10)","default":"DEFAULT NULL"},
    	{"field":"form_str","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"form_type","type":"varchar(20)","default":"DEFAULT NULL"},
    	{"field":"form_require","type":"varchar(20)","default":"DEFAULT NULL"},
    	{"field":"form_msg","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"form_lang","type":"varchar(10)","default":"DEFAULT NULL"},

        {"field":"form_table","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"form_selecttitle","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"form_tablefield","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"form_arrayname","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"form_array","type":"varchar(255)","default":"DEFAULT NULL"}

    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        
        {"str":"{table_name}","name":"table_name","type":"post_value"},
        {"str":"{tablesname}","name":"table_name","type":"hidden","default":"","require":""},

        {"str":"{field_title}","name":"field_title","type":"input","default":"","require":"on","msg":"필드 타이틀"},
        {"str":"{field_name}","name":"field_name","type":"input","default":"","require":"on","msg":"필드명을 입력해 주세요"},
        {"str":"{field_type}","name":"field_type","type":"input","default":"","require":"on","msg":"필드타입을 선택해 주세요"},
        {"str":"{field_default}","name":"field_default","type":"input","default":"","require":"","msg":""},
    	
    	{"str":"{form_check}","name":"form_check","type":"checkbox","default":"","require":"","msg":""},
    	{"str":"{form_str}","name":"form_str","type":"input","default":"","require":"","msg":""},
    	{"str":"{form_type}","name":"form_type","type":"array","array":"input,checkbox,textarea,hidden,datetime,number,select,array,field,post_value,string,inc,max,min","default":"","require":"","msg":""},
    	{"str":"{form_require}","name":"form_require","type":"checkbox","default":"","require":"","msg":""},
    	{"str":"{form_msg}","name":"form_msg","type":"input","default":"","require":"","msg":""},

    	{"str":"{form_table}","name":"form_table","type":"select","default":"","table":"site_tables","keyfield":"table_name","title":"테이블 선택","require":"","msg":""},
    	{"str":"{form_selecttitle}","name":"form_selecttitle","type":"input","default":"","require":"","msg":""},
    	{"str":"{form_tablefield}","name":"form_tablefield","type":"input","default":"","require":"","msg":""},

    	{"str":"{form_arrayname}","name":"form_arrayname","type":"input","default":"","require":"","msg":""},
    	{"str":"{form_array}","name":"form_array","type":"input","default":"","require":"","msg":""},

        {"str":"{form_lang}","name":"form_lang","type":"checkbox","default":"","require":"","msg":""},

        {"str":"{list_display}","name":"list_display","type":"checkbox","default":"","require":"","msg":""},
        {"str":"{list_width}","name":"list_width","type":"input","default":"","require":"","msg":""},
        {"str":"{pos}","name":"pos","type":"input","default":"","require":"","msg":""},

    	{"str":"{comment}","name":"comment","type":"textarea","default":"","require":"","msg":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";



    // 리스트를 출력 합니다.

    // 리스트테이블 출력 where 값 처리
    
    $_where = json_decode('[
        {"field":"table_name","type":"get"}
    ]',true);
    



	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 타이틀명","width":"150","field":"field_title"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 필드명","width":"150","field":"field_name"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 필드타입","width":"100","field":"field_type"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 기본값","width":"100","field":"field_default"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 치환코드","width":"150","field":"form_str"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 설명","width":"","field":"comment"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "field_name 목록 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "field_name";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "field_name";

    // 목록 정렬키값
    $_orderKey = "field_name";
    $_orderSort = "desc";


    function _tableField_Id($table,$field,$id){
        $query = "select ".$field." from ".$table." where Id='".$id."'";
        $rows = _sales_query_rows($query);
        return $rows->$field;
    }





	// ++ 리스트나열 테이블 출력
	function _dataTitleHeader($arr){
	
		$list = "<table id=\"dataTitleHreader\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
		$list .= "<tr>";

		for($i=0;$i<count($arr);$i++){
			$list .= "<td ";
			if($arr[$i]['width']>0) $list .= "width='".$arr[$i]['width']."'";
			$list .=" valign='top'>".$arr[$i]['title']."</td>";
		}

		$list .= "</tr>";
		$list .= "</table>";
		return $list;
		
	}

	// ++ 리스트나열 테이블 출력
	function _dataListRows($arr, $dataRows){
		$list = "<table id=\"datalist\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
		$list .= "<tr>";

		for($i=0;$i<count($dataRows);$i++){
			$list .= "<td ";
			if($arr[$i]['width']>0) $list .= "width='".$arr[$i]['width']."'";
			$list .=" valign='top'>".$dataRows[$i]."</td>";
		}

		$list .= "</tr>";
		$list .= "</table>";
		return $list;
	}



?>