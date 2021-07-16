<?php
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

	// 환경설정 읽어보기
	require_once ($_SERVER['DOCUMENT_ROOT']."/crm/admin_service_permit.cfg.php");

	require_once("inc.javascript_list.php");

	

	


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$query = "select * from admin_tables where table_name = '".$_tableName."' ";
		$_log_history .= $query."<br>";
		if($table_rows = _sales_query_rows($query)){

			// ++ 테마 파일 정보를 읽어옴
			$body = $javascript._theme_page($site_env->theme,$_tableName,$site_language,$site_mobile);

			$submenu_id = _formdata("submenu_id");
			$body = str_replace("<!--{#side_menu}-->", _submenu($_current_menuCode,$site_language,$submenu_id),$body);

			// POST키값을 기준으로 변수 = 값 지정.
			// hidden 값으로 처리
			$arr = array_keys($_POST);
			for($i=0;$i<count( $arr );$i++){
				$key_name = $arr[$i];
				${$key_name} = _formdata($key_name);

				$hidden .= "<input type='hidden' name='".$key_name."' value='".${$key_name}."'>";
			}

			$hidden .= "<input type='hidden' name='mode'>";
			$hidden .= "<input type='hidden' name='uid'>";
			$hidden .= "<input type='hidden' name='limit'>";

			$body = str_replace("{formstart}","<form name='sales' method='post' enctype='multipart/form-data'>".$hidden,$body);
			$body = str_replace("{formend}","</form>",$body);

			// 출력 목록수 지정		
			if(!$_list_num = _formdata("list_num")) $_list_num = 10;
			$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

			$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_new\">";          
			$body = str_replace("{new}",$button,$body);

			$searchkey = _formdata("searchkey");
			$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"search_box\">",$body);
			$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" id=\"css_btn_search\">";           
			$body = str_replace("{search}",$button_search,$body);

			$country_rowss = _country_rows();
			$body = str_replace("{country}", _html_form_select_json("country",$css_textbox,"country",$country_rowss,$site_country,"code","name","국가별 창고위치") ,$body);


			///////////////////
			// 상품 목록을 검색
			$query = "select * from ".$_tableName." ";
			// query where절 처리 ...
		
			if($table_rows->table_where) $_where = explode(";", $table_rows->table_where);
			if($searchkey || count($_where)>0 ){
				$query .= "where ";

				for($i=0;$i<count($_where);$i++){
					// echo $_where[$i]['field']."<br>";
					// echo _formdata("customer");
					$query .= $_where[$i]." = '"._formdata($_where[$i])."' and ";
				}

				if($searchkey) $query .= $table_rows->table_search." like '%".$searchkey."%' and ";

				$query .= ";";
				$query = str_replace("and ;","",$query); // where 절을 ;으로 마감 후 and ; 를 처리
			}
		
			if( $table_rows->sortfield && $table_rows->table_sorttype )
			$query .= " order by ".$table_rows->sortfield." ".$table_rows->table_sorttype." ";
		
			// 전체 또는 검색된 데이터 갯수를 얻음.
			$total = _sales_query_count($query); 
			//echo $query."<br>";

			// 검색된 데이터 내에서 , limit 설정 
			if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
			$_log_history .= $query."<br>";

			// ++ 상단 타이틀 
			require_once("inc.list_title.php");
	
			if($rowss = _sales_query_rowss($query)){

				// ++ 데이터 처리
				require_once("inc.list_data.php");					
			
				$list .= _pagination($_list_num,$_block_num,$limit,$total);
				$body = str_replace("{datalist}","<div id=\"data_rows\">".$list."</div>",$body);
		
			} else {
				$list .= _msg_tableCell( _string($noListMsg, $site_language) );
				$body = str_replace("{datalist}","<div id=\"data_rows\">".$list."</div>",$body);
			
			}

			echo $body;

		} else {
			echo $_tableName." 테이블 정보를 읽어올 수 없습니다.";
		}			
	
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}	


	
?>
