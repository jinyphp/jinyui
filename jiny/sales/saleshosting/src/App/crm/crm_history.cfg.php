<?php
    // 테이블 이름
    $_tableName = "crm_history";

    // 테이블 구조
	$_tableField = json_decode('[
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},
        {"field":"customer","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"manager","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"status","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"title","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
        {"str":"{customer}","name":"customer","type":"input","default":"","require":"","msg":""},	
    	{"str":"{manager}","name":"manager","type":"input","default":"","require":"","msg":""},
    	{"str":"{status}","name":"status","type":"array","default":"","array":"미진행,진행중,진행완료","require":"","msg":"상태"},
    	{"str":"{title}","name":"title","type":"input","default":"","require":"on","msg":"상담기록 제목을 입력해 주세요"},
    	{"str":"{comment}","name":"comment","type":"textarea","default":"","require":"","msg":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";

	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 일자","width":"120","field":"regdate"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 타이틀","width":"","field":"title"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 담당자","width":"100","field":"manager"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 상태","width":"100","field":"status"}
    ]',true);

    // 리스트테이블 출력 where 값 처리
    $_where = json_decode('[
        {"field":"customer","type":"post"}
    ]',true); 
    

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "상담내역이 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "title";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "title";



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