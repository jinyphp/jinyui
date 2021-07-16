<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*

	//* 사이트 환경 설정 및 도메인
	//* 복수의 도메인으로 사이트를 운영할 수 있음

	// update : 2016.01.11 = 코드정리 
	// update : 2016.01.31 = ajax 링크 방식 변경

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

	$javascript = "<script>
		function edit(mode,uid,limit){
			var url = \"site_layout_edit.php\";
			var form = document.site;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();             	
        }

		function form_submit(mode,uid){
			var url = \"ajax_site_layout_editup.php\";

			var form = document.site;
			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;

			var formData = new FormData($('#data')[0]);
			$.ajax({
				url:url,
        		type: 'POST',
        		data: formData,
        		async: false,
        		success: function (data) {
        			$('#mainbody').html(data);
        		},
        		cache: false,
        		contentType: false,
        		processData: false
    		});					
		}
	</script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"site_layout",$site_language,$site_mobile);

		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}","",$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);



		//# ***********
		//# 리스트 출력

		$query = "select * from `site_env` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list = "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
					<tr>
						
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >도메인 레이아웃</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>정렬</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>가로크기</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>배경색</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>상단여백</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>좌측여백</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>관리자접속</td>
						</tr>
					</table>";


			// $list .= _html_div($id,"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;width:150px","코드명");


			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>
					
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
							<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\" >".$rows->domain."</a>
						</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->align."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->width."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->bgcolor."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->top_margin."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='80'>".$rows->left_margin."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'><a href='http://".$rows->domain."?admin=".$rows->adminkey."'>관리자접속</a></td>
				</tr></table>";
			}
			// echo $list;
			$body = str_replace("{datalist}",$list,$body);

		} else {
			$msg = "사이트(도메인) 환경 목록이 없습니다.";
			$body = str_replace("{datalist}",$msg,$body);
			// echo $msg;
		}	

		echo $body;
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>