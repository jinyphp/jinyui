<?php
    // 테이블 이름
    $_tableName = "admin_members";

    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},        
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        
    	{"field":"email","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"password","type":"varchar(255)","default":"DEFAULT NULL"}, 

    	{"field":"name","type":"varchar(255)","default":"DEFAULT NULL"}, 
        {"field":"securekey","type":"varchar(255)","default":"DEFAULT NULL"}, 
    	{"field":"database","type":"varchar(255)","default":"DEFAULT NULL"}, 

    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        
        {"str":"{email}","name":"email","type":"input","default":"","require":"on","msg":"이메일 주소을 입력해 주세요."},
        {"str":"{password}","name":"password","type":"input","default":"","require":"on","msg":"페스워드를 입력해 주세요."},

        {"str":"{name}","name":"name","type":"input","default":"","require":"","msg":""},
        {"str":"{database}","name":"database","type":"checkbox","default":"","require":"on","msg":""},
        {"str":"{securekey}","name":"securekey","type":"input","default":"","require":"","msg":""},
    	
    	{"str":"{comment}","name":"comment","type":"textarea","default":"","require":"","msg":""}
    ]',true);

    $sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";



    // 리스트를 출력 합니다.

    // 리스트테이블 출력 where 값 처리
    /*
    $_where = json_decode('[
        {"field":"plan","type":"get"}
    ]',true);
    */ 



	//+ 리스트 타이을 이름
	$_titleName = json_decode('[
        {"title":"<input type=\"checkbox\" name=\"chk_all\" id=\"check_all\" >","width":"20","field":"Id"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 일자","width":"120","field":"regdate"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 이름","width":"200","field":"name"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 이메일","width":"","field":"email"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 이메일","width":"200","field":"database"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 설명","width":"","field":"comment"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "table_name 목록 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "table_name";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "table_name";

    // 목록 정렬키값
    $_orderKey = "table_name";
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