<?php
    // 테이블 이름
    $_tableName = "crm_campaign";

    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        {"field":"expire","type":"datetime","default":"DEFAULT NULL"},
        {"field":"customer","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"products","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"campaign","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"manager","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"status","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"task","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{regdate}","name":"regdate","type":"field","default":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on"},
        {"str":"{expire}","name":"expire","type":"datetime","default":""},
    	{"str":"{customer}","name":"customer","type":"input","default":""},
    	{"str":"{products}","name":"products","type":"select","default":"","table":"crm_products","keyfield":"products","title":"제품선택"},
    	{"str":"{campaign}","name":"campaign","type":"input","default":""},
    	{"str":"{manager}","name":"manager","type":"input","default":""},
    	{"str":"{status}","name":"status","type":"input","default":""},
    	{"str":"{task}","name":"task","type":"textarea","default":""},
    	{"str":"{comment}","name":"comment","type":"textarea","default":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";

	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 마감일","width":"120","field":"expire"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 고객명","width":"100","field":"customer"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 캠페인","width":"","field":"campaign"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 상태","width":"100","field":"status"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "내역이 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "campaign";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "campaign";

    // 목록 정렬키값
    $_orderKey = "expire";
    $_orderSort = "desc";




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