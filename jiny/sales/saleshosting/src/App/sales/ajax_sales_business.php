<?
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
		function mode(mode,uid,limit){
			var url = \"ajax_sales_business_editup.php\";
			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
            var url = \"sales_business_edit.php\";		
			var form = document.sales;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }

        function list(limit){
			var url = \"ajax_sales_business.php\";
        	var form = document.site;
        	form.limit.value = limit;

			ajax_html('#mainbody',url);
    	}

    	// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.sales.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		} 

 		// 리스트 변경
 		$('#list_num').on('change',function(){
        	list(0);
    	});

    	// 국가
 		$('#country').on('change',function(){
        	list(0);
    	});
                
    </script>";



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"sales_business",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,177),$body);
		
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form name='sales' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='신규추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_new\">";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_box\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" id=\"css_btn_search\">";           
		$body = str_replace("{search}",$button_search,$body);

		$country_rowss = _country_rows();
		$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","국가별 창고위치") ,$body);

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `sales_business` ";
		if($searchkey) {
			$query .= " where business like '%".$searchkey."%' ";
		}
		
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		$sort_descIcon = "<i class=\"fa fa-sort-amount-desc\" aria-hidden=\"true\"></i>";

		$datalist_width = array(20, 100, 50, 0, 100, 100, 100);
		$list = _table_datalist($datalist_width, array(
			"<input type='checkbox' name='chk_all' id=\"check_all\">", 
			"$sort_descIcon 등록일자", 
			"$sort_descIcon 국가", 
			"$sort_descIcon 사업장",
			"$sort_descIcon 사업자번호", 
			"$sort_descIcon 대표자", 
			"$sort_descIcon 연락처"
		));	

		/*
		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";				
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>등록일자</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>국가</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>사업장</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>사업자번호</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>대표자</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>연락처</td>
					  </tr>
					</table>";
					*/


		if($rowss = _sales_query_rowss($query)){

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				// 거래처: 활성화 체크
				if($rows->enable) {
					$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\">".$rows->business."</a>";
				} else $title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\">
									<span style=\"text-decoration:line-through;\">".$rows->business."</span></a>";

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= _table_datalist($datalist_width, array(
							$tid, 
							$rows->regdate, 
							$rows->country, 
							$title_name,
							$rows->biznumber, 
							$rows->president, 
							$rows->phone
						));	

				/*
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'>".$tid."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->country."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->biznumber."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->president."</td>
						  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>
							</tr>
						</table>";
				*/					


			}
			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}","<div id=\"data_rows\">".$list."</div>",$body);
		
		} else {
			$msg = "사업자 목록이 없습니다.";
			$list .= _msg_tableCell( _string($msg, $site_language) );
			$body = str_replace("{datalist}","<div id=\"data_rows\">".$list."</div>",$body);
			
		}

		echo $body;		
	
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}	


	
?>
