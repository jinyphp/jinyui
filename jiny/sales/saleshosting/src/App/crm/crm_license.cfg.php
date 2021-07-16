<?php
    // 테이블 이름
    $_tableName = "crm_license";

    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"customer","type":"varchar(255)","default":"DEFAULT NULL"},
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},
    	{"field":"brand","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"products","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"license_type","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"license_day","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"manager","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"company","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"prices_sell","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"prices_b2b","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"prices_buy","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{customer}","name":"customer","type":"hidden","default":"","require":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":""},
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":""},
    	{"str":"{brand}","name":"brand","type":"input","default":"","require":"on","msg":"브렌드를 입력해 주세요"},
    	{"str":"{products}","name":"products","type":"select","default":"","table":"crm_products","keyfield":"products","title":"제품선택","require":"on","msg":"제품을 선택해 주세요"},
    	{"str":"{license_type}","name":"license_type","type":"input","default":"","require":""},
    	{"str":"{license_day}","name":"license_day","type":"input","default":"","require":""},
    	{"str":"{manager}","name":"manager","type":"input","default":"","require":""},
    	{"str":"{company}","name":"company","type":"input","default":"","require":""},
    	{"str":"{prices_sell}","name":"prices_sell","type":"input","default":"","require":""},
    	{"str":"{prices_b2b}","name":"prices_b2b","type":"input","default":"","require":""},
    	{"str":"{prices_buy}","name":"prices_buy","type":"input","default":"","require":""},
    	{"str":"{comment}","name":"comment","type":"textarea","default":"","require":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";



    // 리스트를 출력 합니다.

    // 리스트테이블 출력 where 값 처리
    
    $_where = json_decode('[
        {"field":"customer","type":"post"}
    ]',true); 
    



	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 일자","width":"120","field":"regdate"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 고객명","width":"100","field":"customer"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 제품명","width":"","field":"products"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 타입","width":"100","field":"license_type"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 기간","width":"100","field":"license_day"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "제품 목록이 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "products";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "products";


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