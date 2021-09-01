<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


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

		function edit(mode,uid){
			var url = \"site_plug_board_edit.php\";
			var form = document.site;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			form.submit();
	
        }
                
        function list(limit){
            var url = \"ajax_site_plug_board.php?limit=\"+limit;
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

    </script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if( isset($_SESSION['ajaxkey']) == $ajaxkey ) { // Ajax CallKey Securities Checking...
		
		// include "./conf/sales.php";	// Sales 사용자 DB 접근.

		// $body = $javascript._skin_page($skin_name,"site_index_board");
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"site_plug_board",$site_language,$site_mobile);

		

		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);



		$body = str_replace("{formstart}","<form id=\"data\" name='site' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='mode'>
					   			<input type='hidden' name='uid'>
					   			<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0')\" id=\"css_btn_gray\" >";          
		$body = str_replace("{new}",$button,$body);


		$query = "select * from `site_plug_board` ";
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){	
			
			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
				<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\"> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>전처리코드</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=50>코드</td>
				</tr>
				</table>";

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0; $i<$count; $i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\">$tid</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>";
				$list .= "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\" >{boardlist_".$rows->code."}</a><br>";
				$list .= "</td>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=50>".$rows->code."</td>
				</tr></table>";
			}

			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}",$list,$body);

		} else {
			$msg = " 목록이 없습니다.";
			$body = str_replace("{datalist}",$msg,$body);
		}	
	
		echo $body;

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	
?>