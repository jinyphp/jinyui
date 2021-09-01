<?php
    // 테이블 이름
    $_tableName = "site_boardlist";


    // 테이블 구조
	$_tableField = json_decode('[
        {"field":"regdate","type":"datetime","default":"DEFAULT NULL"},        
		{"field":"enable","type":"varchar(10)","default":"DEFAULT NULL"},
        {"field":"type","type":"varchar(50)","default":"DEFAULT NULL"},
        {"field":"code","type":"varchar(50)","default":"DEFAULT NULL"},
    	{"field":"title","type":"text","default":"DEFAULT NULL"},
        
        {"field":"images","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"seo_use","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"seo_title","type":"varchar(255)","default":"DEFAULT NULL"},
    	{"field":"seo_keyword","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"seo_description","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"listnum","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"check_login","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"check_reply","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"check_comment","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"check_write","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"str","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"bgcolor","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"index_listnum","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"skin_m","type":"text","default":"DEFAULT NULL"},
        {"field":"check_skin_m","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"skin","type":"text","default":"DEFAULT NULL"},
        {"field":"check_skin","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"skin_check","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"check_attach","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"attach_label","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"attach_files","type":"text","default":"DEFAULT NULL"},

        {"field":"themefiles_list","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"themefiles_view","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"themefiles_edit","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_secure","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_reply","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_content","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"relation_goods","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"relation_type","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"relation_cols","type":"varchar(255)","default":"DEFAULT NULL"},

        {"field":"relation_rows","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_regdate","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_writer","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_images","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_images_maxsize","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_images_type","type":"varchar(255)","default":"DEFAULT NULL"},
        {"field":"view_attach_view","type":"varchar(255)","default":"DEFAULT NULL"},

    	{"field":"view_attach_down","type":"varchar(255)","default":"DEFAULT NULL"}
    ]',true);

	// Form 구조
	// 타입 field => 필드를 출력 
    $_form = json_decode('[
        {"str":"{regdate}","name":"regdate","type":"field","default":"","require":"","msg":""},
    	{"str":"{enable}","name":"enable","type":"checkbox","default":"on","require":"","msg":""},
        
        {"str":"{channel}","name":"channel","type":"input","default":"","require":"on","msg":"체널명을 입력해 주세요"},
        {"str":"{channel_user}","name":"channel_user","type":"input","default":"","require":"","msg":""},
        {"str":"{channel_phone}","name":"channel_phone","type":"input","default":"","require":"","msg":""},
        {"str":"{channel_fax}","name":"channel_fax","type":"input","default":"","require":"","msg":""},
        {"str":"{channel_email}","name":"channel_email","type":"input","default":"","require":"","msg":""},
        {"str":"{channel_address}","name":"channel_address","type":"input","default":"","require":"","msg":""},

    	{"str":"{manager}","name":"manager","type":"select","default":"","table":"sales_manager","keyfield":"lastname","title":"담당자명","require":"","msg":""},
    	
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
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 체널명","width":"150","field":"channel"},
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 담당자","width":"100","field":"channel_user"},  
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 연락처","width":"100","field":"channel_phone"},  
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 이메일","width":"","field":"channel_email"},  
        {"title":"<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i> 관리자","width":"100","field":"manager"}
    ]',true);

	//+ 목록이 출력할 값이 없을 경우 표시할 문구
	$noListMsg = "체널 목록 없습니다.";

	$_block_num = 10;

	//+ 검색시 필터링할 필드명
	$_search_keyField = "channel";

	//+ 수정버튼 클릭할 필드명
	$_editFiled = "channel";

    // 목록 정렬키값
    $_orderKey = "channel";
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