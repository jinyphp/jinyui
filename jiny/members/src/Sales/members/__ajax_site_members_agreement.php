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
			var url = \"ajax_site_members_agreement_editup.php\";
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
			var url = \"site_members_agreement_edit.php\";

			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }
                
        function list(limit){
        	var url = \"ajax_site_agreement_members.php\";
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

		$body = $javascript._theme_page($site_env->theme,"site_members_agreement",$site_language,$site_mobile);


		
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:edit('new','0','$limit')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);
		

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `site_members_agree` ";
		// echo $query."<br>";
		if($searchkey) {
			$query .= " where title like '%".$searchkey."%' ";
		}
		
		$query .= "group by code ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);
			

			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					  <tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";		  
			$list .= "<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\">사용</td>
					  <td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\">필수</td>";
							
			$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>코드명</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>제목</td>
							</tr>
						</table>";	

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];		
				
				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$title_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->code."</a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>";			
				if($rows->enable) $list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:agree_mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\"> 
						<a href='#' onclick=\"javascript:agree_mode('enable','".$rows->Id."')\">□</a></td>";
				
				$list .= "<td width='50' style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' id=\"table_td\">".$rows->require."</td>";
										
				$list .= "<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$title_name."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->title."</td>
							</tr>
						</table>";				


			}


			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{agreement_list}",$list,$body);
			echo $body;
			//echo $list;
		} else {
			$msg = "동의서 내역이 없습니다.";
			$body = str_replace("{agreement_list}",$msg,$body);
			echo $body;
			// echo $msg;
		}	
		
	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>