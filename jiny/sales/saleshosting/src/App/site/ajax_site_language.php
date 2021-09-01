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

	$javascript = "<script>
		function mode(mode,uid,limit){
			var url = \"ajax_site_language_editup.php\";
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
            var url = \"site_language_edit.php\";		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }

        function list(limit){
			var url = \"ajax_site_language.php\";
        	var form = document.site;
        	form.limit.value = limit;

			ajax_html('#mainbody',url);
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

    	// 국가
 		$('#country').on('change',function(){
        	list(0);
    	});
                
    </script>";

	
	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"site_language",$site_language,$site_mobile);
		
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


		$button ="<input type='button' value='제품추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);



	

		///////////////////
		// 주문목록 및 이력 출력  
		$query = "select * from `site_language` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	

			$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\"> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\"> </td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>언어코드</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>치환코드</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >언어 스트링</td>";
			$list .= "</tr></table>";

			$seller="";
			$sub_shipping = 0;
			$sub_shipping_method = "";
			
			for($i=0,$total_prices=0,$sub_prices=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\">$tid</td>";
				
				if($rows->enable) $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\"> 
									<a href='#' onclick=\"javascript:mode('disable','".$rows->Id."')\">▣</a></td>";
				else $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20' id=\"table_td\"> 
									<a href='#' onclick=\"javascript:mode('enable','".$rows->Id."')\">□</a></td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->code."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->replace_code."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
							<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\" >".$rows->name."</a>
						  </td>";
				$list .= "</tr></table>";

			

			}

			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}",$list,$body);
			echo $body;		

		} else {
			$msg = "목록이 없습니다.";
			$body = str_replace("{datalist}",_string($msg,$site_language),$body);
			echo $body;
		}	
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}

	
?>