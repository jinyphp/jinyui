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

		// 전표에 거래처 정보를 전달
		function company_select(uid,company,tax,currency){				
			$('#company_id').val(uid);
			$('input:text[name=company_search]').val(company);
			$('input:hidden[name=tax]').val(tax);
			
			$('#tax').html(tax);
			$('#currency_view').html(currency);	

			// alert(currency);
			$('input:hidden[name=currency]').val(currency);		

			// 거래처 내역을 다시 출력함.
			var url = \"ajax_sales_trans_list.php\";
			ajax_async('#translist',url);

			popup_close();
		}

		// 팝업창: 검색폼에서 엔터
		$('#popup_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	popup_list(0);
        	}
    	});

		// 팝업바디, 페이지 이동
		function popup_list(limit2){
			var url = \"ajax_sales_company_list.php?limit2=\" + limit2;
			ajax_async('#popup_body',url);
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

        $trans = _formdata("trans");
        if($site_mobile == "m") $width = "300px"; else $width = "600px"; 		

		$title = "거래처 선택";
		$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"sales_trans_company",$site_language,$site_mobile) );

		$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		// 출력 목록수 지정
		$_block_num = 10;
		if($popupListNum = _formdata("popupListNum")){ } else $popupListNum = 10;
		$limit2 = _formdata("limit2");

		$form_num = str_replace("name='list_num'","name='popupListNum'",_listnum_select($popupListNum));
		$body = str_replace("{list_num}", $form_num,$body);

        if(_formdata("popup_search")) $company = _formdata("popup_search"); // else if(!$company) $company = _formdata("company_search");
		$body = str_replace("{searchkey}","<input type='text' name='popup_search' value='".$company."' id=\"popup_search\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:popup_list('0')\" style=\"".$css_btn_gray."\" >";
		$body = str_replace("{btn_search}",$button_search,$body);

		$query = "select * from `sales_company` ";
		if($company) $query .= "where company like '%$company%'";
		$query .= " order by regdate desc";
		// echo $query;
		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			if($multiple) $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'><input type='checkbox' name='chk_all' id=\"check_all\"></td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>거래처</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>연락처</td>";
			if($trans == "sell") $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매출액</td>";
			if($trans == "buy") $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매입액</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
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
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>";
				if($trans == "sell") $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->balance_sell."</td>";
				if($trans == "buy") $list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->balance_buy."</td>";				
				$list .= "</tr></table>";				
			}

			$list .= str_replace(":list", ":popup_list", _pagination($_list_num,$_block_num,$limit,$total) );
			$body = str_replace("{list}", $list, $body);

		} else {
			$msg = "거래처 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
