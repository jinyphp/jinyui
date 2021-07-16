<?php
    // 테이블 이름
    $_tableName = "crm_customer";

    // 테이블 구조
	$_titleField = json_decode('[
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},
    	{"field":"customer","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"customer_phone","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"customer_fax","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"customer_email","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"customer_user","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"customer_address","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"manager","type":"varchar(255)","default":"DEFAULT NULL"},

    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{customer}","name":"customer","type":"input","default":"","require":"on","msg":"고객사명을 입력해 주세요"},
    	{"str":"{customer_phone}","name":"customer_phone","type":"input","default":"","require":"","msg":""},
    	{"str":"{customer_fax}","name":"customer_fax","type":"input","default":"","require":"","msg":""},
    	{"str":"{customer_email}","name":"customer_email","type":"input","default":"","require":"","msg":""},
    	{"str":"{customer_user}","name":"customer_user","type":"input","default":"","require":"","msg":""},
    	{"str":"{customer_address}","name":"customer_address","type":"input","default":"","require":"","msg":""},
    	{"str":"{manager}","name":"manager","type":"input","default":"","require":"","msg":""},
    	{"str":"{comment}","name":"comment","type":"textarea","default":"","require":"","msg":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";

	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 일자","width":"120","field":"regdate"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 고객명","width":"200","field":"customer"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 에메일","width":"","field":"email"},   
        {"title":"라이센스","width":"100","field":"link"},
        {"title":"상담내용","width":"100","field":"link"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 영업담당자","width":"100","field":"manager"}

    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "고객 목록이 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "customer";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "customer";




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