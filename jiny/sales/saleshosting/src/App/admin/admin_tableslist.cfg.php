<?php
    // 테이블 이름
    $_tableName = "admin_tableslist";

    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},        
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        
    	{"field":"table_name","type":"varchar(255)","default":"DEFAULT NULL"},

    	{"field":"list_name","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"list_type","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"field_name","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"list_value","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"list_width","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"max_string","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"editlink","type":"varchar(10)","default":"DEFAULT NULL"},

        {"field":"pos","type":"int","default":"DEFAULT NULL"},
    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    	

    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        
        {"str":"{table_name}","name":"table_name","type":"post_value"},
        {"str":"{tablesname}","name":"table_name","type":"hidden","default":"","require":""},


        {"str":"{list_name}","name":"list_name","type":"input","default":"","require":"on","msg":"리스트명을 입력해 주세요."},
        {"str":"{list_type}","name":"list_type","type":"array","array":"field,link,string","default":"","require":"on","msg":"리스트 타입"},
        {"str":"{list_field}","name":"field_name","type":"select","table":"admin_tablesfield","keyfield":"field_name","title":"필드선택","where":"table_name","where_value":"table_name","default":"","require":"","msg":""},
        {"str":"{list_value}","name":"list_value","type":"input","default":"","require":"","msg":""},
        {"str":"{list_width}","name":"list_width","type":"input","default":"","require":"","msg":""},
    	
        {"str":"{max_string}","name":"max_string","type":"input","default":"","require":"","msg":""},

        {"str":"{pos}","name":"pos","type":"input","default":"","require":"","msg":""},
        {"str":"{editlink}","name":"editlink","type":"checkbox","default":"","require":"","msg":""},

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
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 리스트명","width":"150","field":"list_name"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 타입","width":"150","field":"list_type"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 필드값","width":"100","field":"list_field"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 가로크기","width":"100","field":"list_width"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 순서","width":"50","field":"pos"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 설명","width":"","field":"comment"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "list_name 목록 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "list_name";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "list_name";

    // 목록 정렬키값
    $_orderKey = "pos";
    $_orderSort = "asc";


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