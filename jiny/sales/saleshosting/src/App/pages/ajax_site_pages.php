<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*

	// update : 2016.01.25 = 수정편집 

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

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	$javascript = "<script>
		function mode(mode,uid,limit){
			var url = \"ajax_site_pages_editup.php\";
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
            var url = \"site_pages_edit.php\";		
			var form = document.site;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }

        function list(limit){
			var url = \"ajax_site_pages.php\";
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

    	// 선택 삭제
		function check_delete(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       		var chk_count = 0;
       				
       		for(var i=0;i<chk.length;i++){
       			if(chk[i].checked) chk_count++;
       		}
       				
			if(chk_count > 0){
				var returnValue = confirm(\"삭제하겠습니까?\");
				if(returnValue == true){
					var url = \"ajax_site_pages_editup.php\";
					var form = document.site;

					form.action = url;  //이동할 페이지
  					form.mode.value = \"check_delete\";

 					$.ajax({
            			url:url,
            			type:'post',
            			data:$('form').serialize(),
            			success:function(data){
            				$('#mainbody').html(data);
            			}
        			});

 				}
 			} else alert(\"선택된 항목이 없습니다.\"); 			
        }        
    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// $body = _skin_page($skin_name,"site_pages");
		$body = $javascript._theme_page($site_env->theme,"site_pages",$site_language,$site_mobile);

		// 서브메뉴 출력 
		$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,185),$body);

		
		
		$_block_num = 10;
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
	

		if($_list_num = _formdata("list_num")){
		} else $_list_num = 10;

		$form_num = "<select name='list_num' id=\"list_num\" style=\"$css_textbox\">";
		if($_list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($_list_num == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($_list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($_list_num == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);
	
		$body = str_replace("{formstart}","<form name='site' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='searchkey' value='$search'>
						<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='새페이지' onclick=\"javascript:edit('new','0','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$button ="<input type='button' value='선택삭제' onclick=\"javascript:check_delete()\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{delete}",$button,$body);

		
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
			$query .= " where code like '%".$searchkey."%' ";
		}
		
		$query .= "order by Id desc ";
		
		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;



		$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";				
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>작성일자</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>코드명</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>타이틀명</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='70''>조회수</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='300''>바로가기</td>
							
							</tr>
						</table>";


		if($rowss = _sales_query_rowss($query)){			

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];

				if($rows->enable) $code_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\">".$rows->code."</a>";
				else $code_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\"><span style=\"text-decoration:line-through;\">".$rows->code."</span></a>";
				
				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$page_url = "http://".$sales_db->domain."/pages.php?code=".$rows->code;

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='120'>".$rows->regdate."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$code_name."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->title."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='70'>".$rows->click."</td>
							<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='300'>
									<a href='http://".$sales_db->domain."/pages.php?code=".$rows->code."' target=\"_blank\">$page_url</a></td>
							
							</tr>
						</table>";				


			}
			
			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}",$list,$body);
			
		} else {
			$msg = "정적 페이지가 없습니다.";
			$body = str_replace("{datalist}",$list._string($msg,$site_language),$body);
			
		}	
		
		echo $body;

	} else {
		// Ajax 오류 메세지 출력
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>