<?php
    // 테이블 이름
    $_tableName = "crm_campaign_scenario";

    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},        
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        {"field":"plan","type":"varchar(255)","default":"DEFAULT NULL"},

    	{"field":"ddays","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"scenario_task","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"manager","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"status","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"work_task","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        {"str":"{plan}","name":"plan","type":"hidden","default":"","require":"","msg":""},
        
    	{"str":"{ddays}","name":"ddays","type":"input","default":"","require":"","msg":""},
        {"str":"{scenario_task}","name":"scenario_task","type":"input","default":"","require":"","msg":""},

    	{"str":"{manager}","name":"manager","type":"select","default":"","table":"sales_manager","keyfield":"lastname","title":"담당자명","require":"","msg":""},
    	
    	{"str":"{status}","name":"status","type":"input","default":"","require":"","msg":""},
        {"str":"{work_task}","name":"work_task","type":"textarea","default":"","require":"","msg":""},
    	{"str":"{comment}","name":"comment","type":"textarea","default":"","require":"","msg":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";



    // 리스트를 출력 합니다.

    // 리스트테이블 출력 where 값 처리
    $_where = json_decode('[
        {"field":"plan","type":"get"}
    ]',true); 



	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 일자","width":"120","field":"regdate"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> ddays","width":"50","field":"ddays"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 시나리오","width":"","field":"scenario_task"},        
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 담당자","width":"100","field":"manager"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "시나리오가 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "scenario_task";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "scenario_task";

    // 목록 정렬키값
    $_orderKey = "ddays";
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