<?

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";

	include "./func/css.php";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";


		// 카테고리에 대한 자바스크립트 함수 정의
		$javascript = "<script>
		function menu_mode(menu_code,mode,uid){
			var url = \"/ajax_site_menu_editup.php?uid=\"+uid+\"&mode=\"+mode+\"&code=\"+menu_code;
			var url = \"/ajax_site_menu_editup.php?uid=\"+uid+\"&mode=\"+mode;

			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
		}

        function menu_edit(menu_code,mode,uid){
        	var url = \"/site_menu_edit.php?uid=\"+uid+\"&mode=\"+mode+\"&menu_code=\"+menu_code;
        	
        	location.replace(url);
        	/*
            var url = \"/ajax_site_menu_edit.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
            */ 	
        }

        function menu_setting(){
            var url = \"/ajax_site_menu_setting_edit.php\";	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 	
        }

        function menu_save(){
        	alert(\"save\");
        	var url = \"/ajax_site_menu_editup.php?mode=save\";
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#menu_edit').html(data);
                }
            });
        }

        function menu_change(){
        	$.ajax({
        		url:'/ajax_site_menu.php',
        		type:'post',
        		data:$('form').serialize(),
        		success:function(data){
        			$('#mainbody').html(data);
        		}
        	});
        }
        </script>";
		//$body = $javascript._skin_page($skin_name,"site_menu");
		$body = $javascript._theme_page($site_env->theme,"site_menu",$site_language,$site_mobile);
		

		// 카테고리 리스트는 // ajax 형태로 처리함.               
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='menu' method='post' enctype='multipart/form-data' >
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		// 메뉴코드 리스트 출력 
		$menu_code = _formdata("menu_code");
		$form_menucode = "<select name='menu_code' style=\"$css_textbox\" onChange=\"javascript:menu_change()\">";
		$query = "select * from site_menu_setting";
		if($rowss = _sales_query_rowss($query)){	
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
		// echo $query."<br>";
		if($rowss = _sales_query_rowss($query)){	
				  
			$list ="";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				if($site_mobile == "m") $list .= _datalist_m($rows); else $list .= _datalist($rows);	
				
			}
			//echo $list;
			$body = str_replace("{menu_list}",$list,$body);
		} else {
			$msg = "$menu_code 메뉴가 없습니다.";
			$body = str_replace("{menu_list}",$msg,$body);
		}

		echo $body;
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	function _datalist_m($rows){
		global $menu_code;
		
		for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				
				
		if($rows->enable) $list .= "<a href='#' onclick=\"javascript:menu_mode('$menu_code','disable','".$rows->Id."')\">▣</a>";
		else $list .= "<a href='#' onclick=\"javascript:menu_mode('$menu_code','enable','".$rows->Id."')\">□</a>";
					
		//*** 트리모양 만들기
		if($rows->level == 0) {
			$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
			if( _sales_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
							
		} else {
			$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
			if( _sales_query_rows($query1) ) $depth = "┃"; else $depth = "&#4515;";

			for($k=0;$k<$rows->level;$k++) $depth .= "&#4515;";
						
			$query1 = "select * from `site_menu` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
			if( _sales_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
		}
			
		if($rows->name) $menuname = $rows->name; else $menuname = "none";

		$mark_sub = "<a href='#' onclick=\"javascript:menu_edit('$menu_code','sub','".$rows->Id."')\" alt=\"".$rows->url."\">+</a>";
		$mark_up = "<a href='#' onclick=\"javascript:menu_mode('$menu_code','up','".$rows->Id."')\">▲</a>";
		$mark_down = "<a href='#' onclick=\"javascript:menu_mode('$menu_code','down','".$rows->Id."')\">▼</a>";
		$url = "<a href='#' onclick=\"javascript:menu_edit('$menu_code','edit','".$rows->Id."')\" >".$menuname."</a> ";
		$list .= "$depth $mark_sub $mark_up $mark_down $url <br>";

		$list .= $rows->urlmode."<br>";
		$list .= $rows->url."<br>";
		$list .= $rows->tree."<br>";

		return "<div style=\"width:100%;text-align:left;\">".$list."</div>";	

	}

	function _datalist($rows){
		global $menu_code;

		for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				
				if($rows->enable) $list .= "<td width='20' style='font-size:12px;padding:5px;'> <a href='#' onclick=\"javascript:menu_mode('$menu_code','disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td width='20' style='font-size:12px;padding:5px;'> <a href='#' onclick=\"javascript:menu_mode('$menu_code','enable','".$rows->Id."')\">□</a></td>";
					
				//*** 트리모양 만들기
				if($rows->level == 0) {
					$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
								
				} else {
					$query1 = "select * from `site_menu` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth = "┃"; else $depth = "&#4515;";

					for($k=0;$k<$rows->level;$k++) $depth .= "&#4515;";
						
					$query1 = "select * from `site_menu` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
				}
			
				if($rows->name) $menuname = $rows->name; else $menuname = "none";

				$mark_sub = "<a href='#' onclick=\"javascript:menu_edit('$menu_code','sub','".$rows->Id."')\" alt=\"".$rows->url."\">+</a>";
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