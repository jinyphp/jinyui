<?php

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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


	// 환경설정 
	// include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");



	$javascript = "<script>
		function themefiles_mode(mode,uid,limit){
			var url = \"ajax_site_themefiles_editup.php\";
		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
    	}


		function list(limit){
			var url = \"ajax_site_themefiles.php\";
        	var form = document.site;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);
    	}

		function themefiles_edit(mode,uid,limit){
			var url = \"site_themefiles_edit.php\";
		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
    	}
                
    	$('#theme').on('change',function(){
			list(0);
		}); 

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
		
		include "theme_function.php";
		
		// $body = $javascript._skin_page($skin_name,"site_themefiles");
		$body = $javascript._theme_page($site_env->theme,"site_themefiles",$site_language,$site_mobile);
	
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		if($theme = _formdata("theme")){} else $theme = "default"; // 테마코드가 없는 경우 기본: default
		
		
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		$button ="<input type='button' value='파일추가' onclick=\"javascript:themefiles_edit('new','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='파일갱신' onclick=\"javascript:themefiles_mode('files','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{files}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);

		//# 테마 목록		
		$body = str_replace("{theme}",_site_theme_onSelect($theme),$body);



		///////////////////
		// 상품 목록을 검색
		$query = "select * from site_themefiles where theme = '$theme' ";
		if($search) $query .= " and filename like '%$search%' ";
		$query .= "order by filename desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";	// 검색된 데이터 내에서 , limit 설정 
		// echo $query;

		if($rowss = _sales_query_rowss($query)){
			
			$list = _themefiles_header();						

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$title_name = "<a href='#' onclick=\"javascript:themefiles_edit('edit','".$rows->Id."','$limit')\">".$rows->filename."</a>";
				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->theme."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$title_name."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->comment."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							</tr>
						</table>";
			}
			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{theme_list}",$list,$body);
			echo $body;
			
		} else {
			$msg = "테마 페이지 파일이 없습니다.";
			$body = str_replace("{theme_list}",$list._msg_tableCell( _string($msg,$site_language) ),$body);
			echo $body;
		}	


	
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


	function _themefiles_header(){
		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>테마</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>파일이름</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >설명</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>등록일</td>
					</tr>
				</table>";
		return $list;				
	}

	
?>