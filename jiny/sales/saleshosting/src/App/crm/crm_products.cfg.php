<?php
    // 테이블 이름
    $_tableName = "crm_products";

    // 테이블 구조
	$_tableField = json_decode('[
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
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{brand}","name":"brand","type":"input","default":"","require":"","msg":""},
    	{"str":"{products}","name":"products","type":"input","default":"","require":"on","msg":"제품명을 입력해 주세요."},
    	{"str":"{license_type}","name":"license_type","type":"input","default":"","require":"","msg":""},
    	{"str":"{license_day}","name":"license_day","type":"input","default":"","require":"","msg":""},
    	{"str":"{manager}","name":"manager","type":"input","default":"","require":"","msg":""},
    	{"str":"{company}","name":"company","type":"input","default":"","require":"","msg":""},
    	{"str":"{prices_sell}","name":"prices_sell","type":"input","default":"","require":"","msg":""},
    	{"str":"{prices_b2b}","name":"prices_b2b","type":"input","default":"","require":"","msg":""},
    	{"str":"{prices_buy}","name":"prices_buy","type":"input","default":"","require":"","msg":""},
    	{"str":"{comment}","name":"comment","type":"textarea","default":"","require":"","msg":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";

	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 브랜드","width":"120","field":"brand"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 제품명","width":"","field":"products"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 타입","width":"100","field":"license_type"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 라이센스","width":"100","field":"license_day"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 판매가격","width":"100","field":"prices_sell"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 매입가격","width":"100","field":"prices_buy"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "라이센스가 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "products";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "products";




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