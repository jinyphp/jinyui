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
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	$javascript = "<script>

		function mode(mode,uid,limit){
			var url = \"ajax_site_sns_editup.php\";
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
			var url = \"site_sns_edit.php\";

			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }
                
        function list(limit){
        	var url = \"ajax_site_sns.php\";
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
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"site_sns",$site_language,$site_mobile);

		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);

	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','','$limit')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);


		$query = "select * from `site_sns` ";
		// echo $query."<br>";
		if($searchkey) {
			$query .= " where domain like '%".$searchkey."%' ";
		}
		
		
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){	
			

			$list  = "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>활성</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=150>등록일자</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>도메인</td>";
			$list .= "</tr></table>";

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>";
				if($rows->enable) $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:mode('disable','".$rows->Id."','$limit')\">▣</a></td>";
				else $list .= "<td width='50' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:mode('enable','".$rows->Id."','$limit')\">□</a></td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=150>".$rows->regdate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>";
				$list .= "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\" >".$rows->domain."</a>";
				$list .= "</td></tr></table>";
			}
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}",$list,$body);
			echo $body;

		} else {
			$msg = "SN 연동 내역이 없습니다.";
			$body = str_replace("{datalist}",$msg,$body);
			echo $body;
		}	
	
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>