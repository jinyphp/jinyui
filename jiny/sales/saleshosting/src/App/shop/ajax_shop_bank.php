<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.18 = 코드정리 

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
			var url = \"ajax_shop_bank_editup.php\";
			var form = document.shop;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			ajax_html('#mainbody',url);         	
        }

		function edit(mode,uid,limit){
            var url = \"shop_bank_edit.php\";		
			var form = document.shop;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }

        function list(limit){
			var url = \"ajax_shop_bank.php\";
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
       			if(document.shop.chk_all.checked == true) chk[i].checked = true;
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

		$body = $javascript._theme_page($site_env->theme,"shop_bank",$site_language,$site_mobile);
		
		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");

		// 출력 목록수 지정
		$_block_num = 10;
		if($_list_num = _formdata("list_num")){ } else $_list_num = 10;		
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form name='shop' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);

		
		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"$css_textbox\" >",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		$body = str_replace("{search}",$button_search,$body);
		
		$query = "select * from shop_bank ";
		$query .="order by Id desc";
		if($rowss = _sales_query_rowss($query)){	

			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\">은행명</td>			
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">swiff</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\">계좌번호</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >예금주</td>
					</tr>
					</table>";

			for($i=0,$total_prices=0,$sub_prices=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				if($rows->enable) {
					$enable = "<a href='#' onclick=\"javascript:mode('disable','".$rows->Id."')\">▣</a>";
				} else {
					$enable = "<a href='#' onclick=\"javascript:mode('enable','".$rows->Id."')\">□</a>";
				}

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\">$enable <a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\" >".$rows->bankname."</a></td>			
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">".$rows->swiff."</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\" >".$rows->banknum."</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->bankuser."</td>
					</tr>
					</table>";
			}

			// $list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{payment_list}",$list,$body);		

		} else {
			$msg = "목록이 없습니다.";
			$body = str_replace("{payment_list}",$msg,$body);
		}
		
		echo $body;	
		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}


?>