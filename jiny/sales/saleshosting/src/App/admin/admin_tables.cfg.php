<?php
    // 테이블 이름
    $_tableName = "admin_tables";

    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},        
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        
    	{"field":"table_name","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"table_title","type":"varchar(255)","default":"DEFAULT NULL"}, 

    	{"field":"table_service","type":"varchar(255)","default":"DEFAULT NULL"}, 
        {"field":"path","type":"varchar(255)","default":"DEFAULT NULL"}, 
    	{"field":"table_permit","type":"varchar(255)","default":"DEFAULT NULL"}, 

        {"field":"table_login","type":"varchar(255)","default":"DEFAULT NULL"}, 
        {"field":"permit_table","type":"varchar(255)","default":"DEFAULT NULL"}, 
        {"field":"permit_field","type":"varchar(255)","default":"DEFAULT NULL"}, 

        {"field":"theme","type":"varchar(10)","default":"DEFAULT NULL"},
    	{"field":"table_themelist","type":"varchar(255)","default":"DEFAULT NULL"}, 
    	{"field":"table_themeedit","type":"varchar(255)","default":"DEFAULT NULL"}, 
    	
    	{"field":"table_sortfield","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"table_sorttype","type":"varchar(255)","default":"DEFAULT NULL"},

    	{"field":"table_nolistmsg","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"table_search","type":"varchar(255)","default":"DEFAULT NULL"}, 
    	{"field":"table_blocknum","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"table_where","type":"varchar(255)","default":"DEFAULT NULL"}, 

        {"field":"listview_type","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_cols","type":"varchar(255)","default":"DEFAULT NULL"}, 
        {"field":"view_rows","type":"varchar(255)","default":"DEFAULT NULL"}, 

    	{"field":"comment","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        
        {"str":"{table_name}","name":"table_name","type":"input","default":"","require":"on","msg":"테이블 이름을 입력해 주세요"},
        {"str":"{table_title}","name":"table_title","type":"input","default":"","require":"","msg":""},

        {"str":"{table_service}","name":"table_service","type":"checkbox","default":"","require":"","msg":""},
        {"str":"{path}","name":"path","type":"input","default":"","require":"","msg":""},
        {"str":"{table_permit}","name":"table_permit","type":"checkbox","default":"","require":"","msg":""},

        {"str":"{table_login}","name":"table_login","type":"checkbox","default":"","require":"","msg":""},
        {"str":"{permit_table}","name":"permit_table","type":"input","default":"","require":"","msg":""},
        {"str":"{permit_field}","name":"permit_field","type":"input","default":"","require":"","msg":""},


        {"str":"{theme}","name":"theme","type":"checkbox","default":"","require":"","msg":""},
        {"str":"{table_themelist}","name":"table_themelist","type":"input","default":"","require":"","msg":""},
        {"str":"{table_themeedit}","name":"table_themeedit","type":"input","default":"","require":"","msg":""},

        {"str":"{table_sortfield}","name":"table_sortfield","type":"input","default":"","require":"","msg":""},
        {"str":"{table_sorttype}","name":"table_sorttype","type":"array","array":"desc,asc","default":"","require":"","msg":""},

        {"str":"{table_nolistmsg}","name":"table_nolistmsg","type":"input","default":"","require":"","msg":""},
        {"str":"{table_search}","name":"table_search","type":"input","default":"","require":"","msg":""},
        {"str":"{table_blocknum}","name":"table_blocknum","type":"array","array":"10,20,50,100","default":"","require":"","msg":""},
        {"str":"{table_where}","name":"table_where","type":"input","default":"","require":"","msg":""},

        {"str":"{listview_type}","name":"listview_type","type":"array","array":"list,tile,calrenda","default":"","require":"","msg":""},
        {"str":"{view_rows}","name":"view_rows","type":"input","default":"","require":"","msg":""},
        {"str":"{view_cols}","name":"view_cols","type":"input","default":"","require":"","msg":""},
    	
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
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 테이블명","width":"200","field":"table_name"},
        {"title":"form 필드","width":"100","field":"link"},
        {"title":"list 출력","width":"100","field":"link"},
        {"title":"Service","width":"50","field":"table_service"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 설명","width":"","field":"comment"},
        {"title":"","width":"10","field":"link"}
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