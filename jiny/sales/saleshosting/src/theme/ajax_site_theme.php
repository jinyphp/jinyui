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
		function theme_mode(mode,uid,limit){
			var url = \"ajax_site_theme_editup.php\";
		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
    	}

		function list(limit){
			var url = \"ajax_site_theme.php\";
        	var form = document.site;
        	form.limit.value = limit;
			
			ajax_html('#mainbody',url);
    	}

		function theme_edit(mode,uid,limit){
			var url = \"site_theme_edit.php\";
		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
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

		// 테마관련 함수들
		include "theme_function.php";

		/////////////
		// $body = $javascript._skin_page($skin_name,"site_theme");
		$body = $javascript._theme_page($site_env->theme,"site_theme",$site_language,$site_mobile);

		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		// $list_num = _formdata("list_num");
	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='추가' onclick=\"javascript:theme_edit('new','0','0')\" id=\"css_btn_new\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='복사' onclick=\"javascript:theme_mode('copy','0','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{copy}",$button,$body);

		$button ="<input type='button' value='테마읽기' onclick=\"javascript:theme_load('load','0','0')\" id=\"css_btn_gray\" >";          
		$body = str_replace("{load}",$button,$body);

		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_box\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" id=\"css_btn_search\" >";           
		$body = str_replace("{search}",$button_search,$body);

			
		


		///////////////////
		// 상품 목록을 검색
		$query = "select * from site_theme ";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;
		/*
		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
				<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='10'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>테마이미지</td>
					
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >테마이름</td>
					
				</tr>
			  </table>";
		*/	  
		
		$datalist_width = array(10, 150, 0);
		$list = _table_datalist($datalist_width, array("<input type='checkbox' name='chk_all' id=\"check_all\">", "테마이미지", "테마이름"));	  

		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$theme = "<a href='#' onclick=\"javascript:theme_edit('edit','".$rows->Id."','".$limit."')\">".$rows->theme."</a>";
				$theme_files = "<a href='site_themefiles.php?theme=".$rows->theme."'>Theme files</a>";

				$screenshot = "./".$rows->theme."/".$rows->screenshot;

				$title = $theme."<br>";
				$title .= $rows->title."<br>";
				$title .= $theme_files."<br>";

				/*
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='10' valign='top'>".$tid."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150' valign='top'>"."<img src=\"$screenshot\" width=100>"."</td>					
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' valign='top'>".$title."</td>							
							</tr>
						</table>";
				*/
				$list .= _table_datalist($datalist_width, array($tid, "<img src=\"$screenshot\" width=100>", $title));			
			}


			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{theme_list}",$list,$body);
			echo $body;

		} else {
			$msg = "테마가 없습니다.";
			$body = str_replace("{theme_list}",$list._msg_tableCell( _string($msg,$site_language) ),$body);
			echo $body;
		}	

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>