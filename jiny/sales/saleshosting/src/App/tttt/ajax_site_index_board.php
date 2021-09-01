<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee


	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/css.php";

	$javascript = "<script>

		function edit(mode,uid){
			var url = \"/site_index_board_edit.php\";
			var form = document.site;

			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
			
			form.submit();
	
        }
                
        function list(limit){
            var url = \"/ajax_site_index_board.php?limit=\"+limit;
            ajax_html(\"#mainbody\",url);
        }
    </script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if( isset($_SESSION['ajaxkey']) == $ajaxkey ) { // Ajax CallKey Securities Checking...
		
		include "./conf/sales.php";	// Sales 사용자 DB 접근.

		$body = $javascript._skin_page($skin_name,"site_index_board");
		
		$body = str_replace("{formstart}","<form id=\"data\" name='site' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='mode'>
					   			<input type='hidden' name='uid'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$query = "select * from `site_index_board` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>전처리코드</td>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=50>코드</td>
				</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>";
				$list .= "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\" >{boardlist_".$rows->code."}</a><br>";
				$list .= "</td>
				<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=50>".$rows->board."</td>
				</tr></table>";
			}
			$body = str_replace("{datalist}",$list,$body);

		} else {
			$msg = " 목록이 없습니다.";
			$body = str_replace("{datalist}",$msg,$body);
		}	
	
		echo $body;

	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>