<?

	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.15
	//*

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

	include "./func/error.php";
	include "./func/css.php";
	include "./func/pagination.php";


	$javascript = "<script>

	function list(limit){
		var url = \"/ajax_site_theme.php\";
        var form = document.site;
        form.limit.value = limit;
			
		ajax_html('#mainbody',url);
    }

	function theme_edit(mode,uid,limit){
		var url = \"/site_theme_edit.php\";
		

		var form = document.site;
		form.action = url;  //이동할 페이지
  		form.mode.value = mode;
  		form.uid.value = uid;
  		form.limit.value = limit;
			
		form.submit();	
    } 

    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./conf/sales.php";

		/////////////
		// $body = $javascript._skin_page($skin_name,"site_theme");
		$body = $javascript._theme_page($site_env->theme,"site_theme",$site_language,$site_mobile);

		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		$list_num = _formdata("list_num");
	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='테마만들기' onclick=\"javascript:theme_edit('new','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='테마복사' onclick=\"javascript:theme_copy('copy','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{copy}",$button,$body);

		$button ="<input type='button' value='테마읽기' onclick=\"javascript:theme_load('load','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{load}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);


		///////////////////
		// 상품 목록을 검색
		$query = "select * from `site_theme` ";
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
				<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='10'></td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>테마코드</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >테마이름</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 파일 </td>
				</tr>
			  </table>";

		if($rowss = _sales_query_rowss($query)){
			// $total = count($rowss);
			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";
				$theme = "<a href='#' onclick=\"javascript:theme_edit('edit','".$rows->Id."','".$limit."')\">".$rows->theme."</a>";
				$theme_files = "<a href='site_themefiles.php?theme=".$rows->theme."'>Theme files</a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='10'>".$tid."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$theme."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->title."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> $theme_files </td>
							</tr>
						</table>";
			}


			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{theme_list}",$list,$body);
			echo $body;
		} else {
			$msg = "테마가 없습니다.";
			$body = str_replace("{theme_list}",$list.$msg,$body);
			echo $body;
		}	
	
	} else {
		$body = _skin_pages($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>