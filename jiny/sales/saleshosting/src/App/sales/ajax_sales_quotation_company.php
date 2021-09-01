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
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/popup.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");

	$javascript = "<script>
		function company_select(uid,company,tax,currency){
			
			$('#company_id').val(uid);			
			$('input:text[name=company_search]').val(company);			
			$('input:hidden[name=tax]').val(tax);			
			$('#tax').html(tax);
			$('#currency').html(currency);
			popup_close();

			$.ajax({
           		url:'ajax_sales_trans_list.php',
           		type:'post',
           		data:$('form').serialize(),
           		success:function(data){
           			$('#translist').html(data);
           		}
        	});

		}

		$('#popup_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		//alert(\"search\");
           		popup_list(0);
        	}
    	});



		// 팝업바디, 페이지 이동
		function popup_list(limit2){			
           	$.ajax({
                    url:'ajax_sales_quotation_company.php?limit2='+limit2,
                    type:'post',
                    async: false,
                    data:$('form').serialize(),
                    success:function(data){
						$('#popup_body').html(data);
                    }
            });          
        }	


    	// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.popup.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		}

 		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

    	$('#popup_close').hover(function() {
        	$(this).css('cursor','pointer');
    	});

    	// 팝업창 리스트 변경
 		$('#popupListNum').on('change',function(){

        	// 목록 데이터 변경
        	popup_list(0);

        	// 팝업창 세로크기 가변으로 변경 처리
        	$('#popup_body').css('height','auto');

        	// 팝업창 생성으로 늘아난 윈도우 크기, 사이즈 재조정
            popup_maskSize();              

    	});


    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		

        if($site_mobile == "m") $width = "300px"; else $width = "800px"; 		

		$title = "거래처 선택";
		$body = $javascript._popup_body($title,$width, _theme_page($site_env->theme,"sales_quotation_company",$site_language,$site_mobile) );

		$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		/*
        // 팝업창
		// $body = $javascript._skin_page($skin_name,"sales_company_list");
		// $body = $javascript._theme_page($site_env->theme,"sales_company_list",$site_language,$site_mobile);
		// $body = str_replace("{close}","<input type=\"button\" onclick=\"popup_close();\" value=\"Close\" style=\"".$css_btn_gray."\"/>",$body);

        // 팝업창
        function _popup_div($title,$width){
        	$title_width = $width - 42;

        	$popup_header  = _html_div("popup_title","float:left;width:".$title_width."px; height:30px;display:table-cell;vertical-align:middle;padding:5px;",$title);
        	$popup_header .= _html_div("popup_close","width:30px;text-align:center; height:30px;display:table-cell;vertical-align:middle;","X");

        	$width = $width -2;
			return _html_div_clearfix($popup_header,"width:".$width."px;border-bottom:1px solid #E9E9E9;");
        }

        if($site_mobile == "m") $width = "300"; else $width = "800"; 
        
        $title = "견적서: 거래처선택 ";
		$body = $javascript
				._html_div("popup", "width:".$width."px;",
					_popup_div($title,$width)._theme_page($site_env->theme,"sales_quotation_company",$site_language,$site_mobile) );

		$_list_num = 10;
		$_block_num = 10;
		$limit2 = _formdata("limit2");

		$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		*/

		// 출력 목록수 지정
		$_block_num = 10;
		if($popupListNum = _formdata("popupListNum")){
		} else $popupListNum = 10;
		$limit2 = _formdata("limit2");

		$form_num = "<select name='popupListNum' id=\"popupListNum\" style=\"$css_textbox\">";
		if($popupListNum == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
		if($popupListNum == "25") $form_num .= "<option value='25' selected>Listing 25</option>"; else $form_num .= "<option value='25'>Listing 25</option>";
		if($popupListNum == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
		if($popupListNum == "100") $form_num .= "<option value='100' selected>Listing 100</option>"; else $form_num .= "<option value='100'>Listing 100</option>";
		$form_num .= "</select>";
		$body = str_replace("{list_num}", $form_num,$body);



		if(_formdata("popup_search")) $company = _formdata("popup_search"); // else if(!$company) $company = _formdata("company_search");
		$body = str_replace("{searchkey}","<input type='text' name='popup_search' value='".$company."' id=\"popup_search\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:popup_list('0')\" style=\"".$css_btn_gray."\" >";
		$body = str_replace("{btn_search}",$button_search,$body);

		$multiple = _formdata("multiple");

		$query = "select * from `sales_company` ";
		if($company) $query .= "where company like '%$company%'";
		$query .= " order by regdate desc ";

		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit2 설정 
		if($limit2) $query .= "LIMIT $limit2 , $popupListNum"; else $query .= "LIMIT 0 , $popupListNum ";	

		// echo $query."<br>";

		//
		// 상단 타이틀
		$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		if($multiple) $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'><input type='checkbox' name='chk_all' id=\"check_all\"></td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>거래처</td>";
			
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>대표자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>연락처</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>부가세율</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>통화</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매출액</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매입액</td>";
		$list .= "</tr></table>";


		if($rowss = _sales_query_rowss($query)){			

			if( ($total - $limit2) < $popupListNum ) $count = $total - $limit2; else $count = $popupListNum;

			for($i=0; $i<$count; $i++){
				$rows = $rowss[$i];	

				if($rows->inout == "sell") $comtype = "←";
				else if($rows->inout == "buy") $comtype = "→";
				else if($rows->inout == "buysell") $comtype = "↔";
				else if($rows->inout == "personal") $comtype = "☺";

				if($rows->vat) $tax = $rows->vatrate; else $tax = 0;

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				if($multiple) $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'>".$tid."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
								$comtype  <a href='#' onclick=\"javascript:company_select('".$rows->Id."','".$rows->company."','".$tax."','".$rows->currency."')\">".$rows->company."</a> $master_link $auth</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->president."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->vatrate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->currency."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
							<a href='sales_trans_sell.php?company_id=".$rows->Id."'>".$rows->balance1."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
							<a href='sales_trans_buy.php?company_id=".$rows->Id."'>".$rows->balance2."</a></td>";				
				$list .= "</tr></table>";

				
			}

			
			$list .= str_replace(":list", ":popup_list", _pagination($popupListNum,$_block_num,$limit,$total) );
			$body = str_replace("{list}", $list, $body);


		} else {
			$msg = "거래처 목록이 없습니다.";
			$body = str_replace("{list}", $list.$msg, $body);
		}	





		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
