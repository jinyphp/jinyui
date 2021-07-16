<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*

	// update : 2016.01.11 = 코드정리 

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	$javascript = "<script>

		function css_mode(mode,uid){
			var url = \"ajax_site_css_editup.php\";
			// alert(url);

			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			ajax_html(\"#mainbody\",url);
	
        }

		function edit(mode,uid){
			var url = \"site_css_edit.php\";
			var form = document.site;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			form.submit();
	
        }
                
        function list(limit){
            var url = \"ajax_site_css.php\";
            var form = document.site;
            form.limit.value = limit;

            ajax_html(\"#mainbody\",url);
        }

        // 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.site.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

    	// 검색창, 키 엔터 
		$('#searchkey').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
            	list(0);
        	}
    	});

    	// 거래처 검색 팝업 
		$('#css_btn_search').click(function(){
			list(0);
		});

		function tag(tag){
            var url = \"ajax_site_css.php\";
            var form = document.site;
            form.tag.value = tag;
            // alert(tag);
          
            ajax_html(\"#mainbody\",url);
        }

    </script>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"site_css",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,185),$body);
		
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$tag = _formdata("tag");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);


		$body = str_replace("{formstart}","<form id=\"data\" name='site' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='mode'>
					   			<input type='hidden' name='uid'>
					   			<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='tag' value='$tag'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='NEW' onclick=\"javascript:edit('new','0')\" id=\"css_btn_new\">";          
		$body = str_replace("{new}",$button,$body);


		$button ="<input type='button' value='적용' onclick=\"javascript:css_mode('save','0')\" id=\"css_btn_save\">";          
		$body = str_replace("{save}",$button,$body);

		/*
		
		*/
		if($site_mobile == "m"){
			$searchkey = _formdata("searchkey");
			// echo "searchkey = $searchkey";
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_box\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" id=\"css_btn_search\" >";           
			// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
			$body = str_replace("{search}",$button_search,$body);

		} else {
			$searchkey = _formdata("searchkey");
			// echo "searchkey = $searchkey";
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_box\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" id=\"css_btn_search\" >";           
			// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
			$body = str_replace("{search}",$button_search,$body);
		}	


		///////////////////
		// 상품 목록을 검색
		$query = "select * from `site_css` ";
		if($searchkey) {
			$query .= " where code like '%".$searchkey."%' ";
			
			if($tag) {
				$query .= " and tag like '%".$tag."%' ";
			}
		}

		if($tag) {
			$query .= " where tag like '%".$tag."%' ";
		}
		
		$query .= " order by code desc ";

		// echo $query."<br>";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){

			$datalist_width = array(20, 150, 0);
			$list = _table_datalist($datalist_width, array("", "선택자", "설명/CSS"));	

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];
	
				if($rows->enable) $enable = "<a href='#' onclick=\"javascript:css_mode('disable','".$rows->Id."')\">▣</a>";
				else $enable = "<a href='#' onclick=\"javascript:css_mode('enable','".$rows->Id."')\">□</a>";
				
				if($rows->tag) $tag ="  <i class=\"fa fa-tags\" aria-hidden=\"true\"></i> ".$rows->tag; else $tag = "";

				$dataCell = _table_datalist(
							$datalist_width, 
							array($enable, "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->code."</a>", $rows->title.$tag)
						);
				$dataCell .= _table_datalist(
							array(20, 0), 
							array("", $rows->css)
						);	
				$dataCell = str_replace(" id=\"datalist\"","",$dataCell);	// 데이터 2출로 id=datalist 를 제거 후  
				$list .= "<div id=\"datalist\">".$dataCell."</div>";	// div datalist 추가
											

			}
			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{css_list}",$list,$body);


			// ++ 테그 부분 처리
			$taglist = "<div id=\"css_tagrows\"> Quick Tag listing...</div>";
			$query1 = "select * from site_css group by tag desc";
			if($tag_rowss = _sales_query_rowss($query1)){
				for($j=0;$j<count($tag_rowss);$j++){
					$tagRows = $tag_rowss[$j];

					if($tagRows->tag)
					$taglist .= "<div id=\"css_tagrows\">"."<a href='#' onclick=\"javascript:tag('".$tagRows->tag."')\">".$tagRows->tag."</a>"."</div>";
				}
			}
			$body = str_replace("{tag_list}",$taglist,$body);

			echo $body;

		} else {
			$msg = "CSS 코드가 없습니다.";
			$list .= _msg_tableCell( _string($msg, $site_language) );
			$body = str_replace("{css_list}",$list,$body);

			$body = str_replace("{tag_list}","",$body);
			echo $body;
		}	
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>