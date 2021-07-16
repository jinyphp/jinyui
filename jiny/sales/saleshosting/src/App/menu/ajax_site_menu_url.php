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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	$mode = _formmode();

	// Sales 사용자 DB 접근.
	include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");



	include ($_SERVER['DOCUMENT_ROOT']."/site/site_function.php");

	switch($mode){
		case 'category':
			$query = "select * from `shop_cate` ";
			$query .= "order by pos desc";	
			if($rowss = _sales_query_rowss($query)){

				$cate = "<select name='url' size='15' style='width:100%'>";
					
				for($i=0;$i<count($rowss);$i++){
					$rows= $rowss[$i];
					$cate .= "<option value='".$rows->Id."' ";
					
					for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;└";
				
					$title = stripslashes($rows->title);
					$title_name = json_decode($title);
					$cate .= ">$space".$title_name->$site_language."</option>";

				}
				$cate .= "</select>";		
			
			} else {
				$cate = "등록된 카테고리가 없습니다.";
			}
			echo $cate;
			break;

		case 'board':

			$css_multiSelectbox = "width:100%; font-size:12px; border:1px solid #d8d8d8;";

			//echo "계시판 선택";
			$query = "select * from `site_boardlist` ";
			$query .= "order by Id desc";	
			if($rowss = _sales_query_rowss($query)){

				$cate = "<select name='url' size='15' style='$css_multiSelectbox' >";
					
				for($i=0;$i<count($rowss);$i++){
					$rows= $rowss[$i];
					$cate .= "<option value='".$rows->code."' ";
					$cate .= ">".$rows->code.":".$rows->title."</option>";

				}
				$cate .= "</select>";	
					
			} else {
				$cate = "등록된 계시판 목록이 없습니다.";
			}
			echo $cate;
			break;

		case 'pages':
			//echo "페이지 선택";
			$query = "select * from `site_pages` ";
			$query .= "order by Id desc";	
			if($rowss = _sales_query_rowss($query)){

				$cate = "<select name='url' size='15' style='width:100%' >";
					
				for($i=0;$i<count($rowss);$i++){
					$rows= $rowss[$i];
					$cate .= "<option value='".$rows->code."' ";
					$cate .= ">".$rows->title."</option>";

				}
				$cate .= "</select>";	
					
			} else {
				$cate = "등록된 페이지 목록이 없습니다.";
			}
			
			echo $cate;
			break;

		case 'direct':
			//echo "직접입력";
			echo "<input type='text' name='url' id=\"cssFormStyle\">";
			break;			
	}

		


	
?>