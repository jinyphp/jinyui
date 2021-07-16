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
		function site_edit(mode,uid){
			var url = \"site_env_edit.php\";
			var form = document.env;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			form.submit();             	
        }

		function form_submit(mode,uid){
			var url = \"ajax_site_env_editup.php\";

			var form = document.env;
			form.mode.value = mode;
  			form.uid.value = uid;

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

		$body = $javascript._theme_page($site_env->theme,"site_env",$site_language,$site_mobile);
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,185),$body);

		// $body = $javascript._skin_page($skin_name,"site_env");

		$body=str_replace("{formstart}",$script."<form id='data' name='env' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='uid' id=\"uid\">
					   			<input type='hidden' name='mode' id=\"mode\">
					   			<input type='hidden' name='limit' id=\"limit\">
					    		<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='환경추가' onclick=\"javascript:site_edit('new','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);


		//# ***********
		//# 리스트 출력

		$query = "select * from `site_env` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	
			/*
			$list = "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=20></td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>코드명</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >도메인</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>메뉴</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>적용테마</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>관리자접속</td>
						</tr>
					</table>";
			*/

			$datalist_width = array(20, 0, 100, 100, 100);
			$list = _table_datalist($datalist_width, array("", "도메인", "메뉴", "적용테마", "관리자접속"));	


			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				/*
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>
						<td style='font-size:12px;padding:10px;' width=20>".$rows->Id."</td>
						<td style='font-size:12px;padding:10px;' width='150'><a href='site_env_edit.php?mode=edit&uid=".$rows->Id."'>".$rows->code."</a></td>
						<td style='font-size:12px;padding:10px;'><a href='#' onclick=\"javascript:site_edit('edit','".$rows->Id."')\" >".$rows->domain."</a> </td>
						<td style='font-size:12px;padding:10px;' width='100'>".$rows->menu_code."</td>
						<td style='font-size:12px;padding:10px;' width='100'>".$rows->theme."</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'><a href='http://".$rows->domain."?admin=".$rows->adminkey."'>관리자접속</a></td>
				</tr></table>";
				*/
				$list .= _table_datalist($datalist_width, 
							array("<input type='checkbox' name='TID[]' value='".$rows->Id."'>", 
								"<a href='#' onclick=\"javascript:site_edit('edit','".$rows->Id."')\" >".$rows->domain."</a>", 
								$rows->menu_code, 
								$rows->theme, 
								"<a href='http://".$rows->domain."?admin=".$rows->adminkey."'>관리자접속</a>"
							)
						);
			}
			// echo $list;
			$body = str_replace("{rows_list}",$list,$body);

		} else {
			$msg = "사이트(도메인) 환경 목록이 없습니다.";
			$body = str_replace("{rows_list}",$msg,$body);
			// echo $msg;
		}	

		echo $body;
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>