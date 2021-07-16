<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	// update : 2016.01.25 = 수정편집 

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




	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$body = _skin_page($skin_name,"site_pages");


		
		$_list_num = 10;
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 



		
		$body = str_replace("{formstart}","<form name='pages' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='새페이지' onclick=\"javascript:page_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);
		

		///////////////////
		// 상품 목록을 검색
		$query = "select * from `site_pages` ";

		if($searchkey) {
			$query .= " where title like '%".$searchkey."%' ";
		}
		
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		if($rowss = _sales_query_rowss($query)){

			$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>작성일자</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>코드명</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>타이틀명</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>바로가기</td>
							</tr>
						</table>";

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];


				$title_name = "<a href='#' onclick=\"javascript:page_edit('edit','".$rows->Id."')\">".$rows->title."</a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->code."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$title_name."</td>
							<td style='border-top:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'><a href='http://".$site_env->domain."/pages.php?code=".$rows->code."'>Goto Site</a></td>
							</tr>
						</table>";				


			}


			
			// $list .= _listbar($_list_num,$_block_num,$limit, $total);
			$body = str_replace("{page_list}",$list,$body);
			echo $body;
			//echo $list;
		} else {
			$msg = "정적 페이지가 없습니다.";
			$body = str_replace("{page_list}",$msg,$body);
			echo $body;
			// echo $msg;
		}	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>