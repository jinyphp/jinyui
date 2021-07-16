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

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	// 카테고리에 대한 자바스크립트 함수 정의
	$javascript = "<script>
		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});
    </script>";
















    if($site_mobile == "m") $width = "300px"; else $width = "500px";

	$title = "메뉴 트리구성";
	$body = $javascript._popup_body( $title, $width, _theme_page($site_env->theme,"site_menu",$site_language,$site_mobile) );


		

		// 카테고리 리스트는 // ajax 형태로 처리함.               
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}",
								"<form id=\"data\" name='menu' method='post' enctype='multipart/form-data' >
					   			<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		// 메뉴코드 리스트 출력 
		$menu_code = _formdata("menu_code");
		$form_menucode = "<select name='menu_code' style=\"$css_textbox\" onChange=\"javascript:menu_change()\">";
		$query = "select * from site_menu_setting";
		if($rowss = _mysqli_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($menu_code == $rows1->code) $form_menucode .= "<option value='".$rows1->code."' selected>".$rows1->code."</option>"; 
				else $form_menucode .= "<option value='".$rows1->code."'>".$rows1->code."</option>";
			}
		} else {
			$form_menucode .= "<option value='default'>기본메뉴</option>";
		}
		$form_menucode .= "</select>";
		$body = str_replace("{menu_code}",$form_menucode,$body);

		if($menu_code = _formdata("menu_code")) {

		} else $menu_code = "default";

		
		$button ="<input type='button' value='메뉴추가' onclick=\"javascript:menu_edit('$menu_code','new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='메뉴설정' onclick=\"javascript:menu_setting()\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{setting}",$button,$body);

		$body = str_replace("{apply}","<input type='button' value='메뉴적용' onclick=\"javascript:menu_save()\" style=\"".$css_btn_gray."\" >",$body);

		$mode = _formmode();
		$uid = _formdata("uid");
		
		
		

		$query = "select * from `site_menu` where code = '$menu_code' order by pos desc";
		if($rowss = _mysqli_query_rowss($query)){	
				  
			$list  = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:5px;'>메뉴구조</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:5px;' width='350'>연결방식</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:5px;' width='200'>메뉴트리</td>";			
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:5px;' width='100'>메뉴순번(ID)</td>";	
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				if($site_mobile == "m") {
					$list .= _datalist_m($rows); 
				} else {
					$list .= _datalist($rows);	
				}
			}
			//echo $list;
			$body = str_replace("{menu_list}",$list,$body);

		} else {
			$msg = "$menu_code 메뉴가 없습니다. 우측 상단 메뉴추가를 선택하여 메뉴를 생성해 주세요.";
			$body = str_replace("{menu_list}",$msg,$body);

		}

		echo $body;



	// 모바일용 트리메뉴 
	function _datalist_m($rows){
		global $menu_code;
		
		for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				
				
		if($rows->enable) $list .= "<a href='#' onclick=\"javascript:menu_mode('$menu_code','disable','".$rows->Id."')\">▣</a>";
		else $list .= "<a href='#' onclick=\"javascript:menu_mode('$menu_code','enable','".$rows->Id."')\">□</a>";
					
		//*** 트리모양 만들기
		if($rows->level == 0) {
			$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
			if( _mysqli_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
							
		} else {
			$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
			if( _mysqli_query_rows($query1) ) $depth = "┃"; else $depth = "&nbsp;&nbsp;&nbsp;";

			for($k=0;$k<$rows->level;$k++) $depth .= "&nbsp;&nbsp;&nbsp;";
						
			$query1 = "select * from `site_menu` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
			if( _mysqli_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
		}
			
		if($rows->name) $menuname = $rows->name; else $menuname = "none";

		$mark_sub = "<a href='#' onclick=\"javascript:menu_edit('$menu_code','sub','".$rows->Id."')\" alt=\"".$rows->url."\"> <i class=\"fa fa-plus-square-o\"></i> </a>";
		$mark_up = "<a href='#' onclick=\"javascript:menu_mode('$menu_code','up','".$rows->Id."')\">▲</a>";
		$mark_down = "<a href='#' onclick=\"javascript:menu_mode('$menu_code','down','".$rows->Id."')\">▼</a>";
		$url = "<a href='#' onclick=\"javascript:menu_edit('$menu_code','edit','".$rows->Id."')\" >".$menuname."</a> ";
		$list .= "$depth $mark_sub $mark_up $mark_down $url <br>";

		$list .= $rows->urlmode."<br>";
		$list .= $rows->url."<br>";
		$list .= $rows->tree."<br>";

		return "<div style=\"width:100%;text-align:left;\">".$list."</div>";	

	}


	// PC용 트리메뉴
	function _datalist($rows){
		global $menu_code;

		for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
		$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				
		if($rows->enable) $list .= "<td width='20' style='font-size:12px;padding:5px;'> <a href='#' onclick=\"javascript:menu_mode('$menu_code','disable','".$rows->Id."')\">▣</a></td>";
		else $list .= "<td width='20' style='font-size:12px;padding:5px;'> <a href='#' onclick=\"javascript:menu_mode('$menu_code','enable','".$rows->Id."')\">□</a></td>";
					
		//*** 트리모양 만들기
		if($rows->level == 0) {
			$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
			if( _mysqli_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
							
		} else {
			$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
			if( _mysqli_query_rows($query1) ) $depth = "┃"; else $depth = "&nbsp;&nbsp;&nbsp;";

			for($k=0;$k<$rows->level;$k++) $depth .= "&nbsp;&nbsp;&nbsp;";
						
			$query1 = "select * from `site_menu` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
			if( _mysqli_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
		}
			
		if($rows->name) $menuname = $rows->name; else $menuname = "none";

		$mark_sub = "<a href='#' onclick=\"javascript:menu_edit('$menu_code','sub','".$rows->Id."')\" alt=\"".$rows->url."\"> <i class=\"fa fa-plus-square-o\"></i> </a>";
		$mark_up = "<a href='#' onclick=\"javascript:menu_mode('$menu_code','up','".$rows->Id."')\">▲</a>";
		$mark_down = "<a href='#' onclick=\"javascript:menu_mode('$menu_code','down','".$rows->Id."')\">▼</a>";
		$url = "<a href='#' onclick=\"javascript:menu_edit('$menu_code','edit','".$rows->Id."')\" >".$menuname."</a> ";
		$list .= "<td style='font-size:12px;padding:5px;'> $depth $mark_sub $mark_up $mark_down $url </td>";
		$list .= "<td width='50'> ".$rows->urlmode."</td>";
		$list .= "<td width='300'> ".$rows->url."</td>";
		$list .= "<td width='200'> ".$rows->tree."</td>";
			
		$list .= "<td width='100' style='font-size:12px;padding:5px;'>: ".$rows->pos."(".$rows->Id.")</td>";
				
		$list .= "</tr></table>";
		
		return $list;			

	}
	
?>