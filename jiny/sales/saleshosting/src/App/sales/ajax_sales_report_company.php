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
		function form_submit(){
			var chk = document.getElementsByName('TID[]');
			var company = \"\";
			for(var i=0;i<chk.length;i++){
				if(chk[i].checked == true) company = company + chk[i].value + \";\";
       		}

       		$('#company_id').val(company);
       		// $('input:text[name=company_search]').val(company);

			// alert(company);
			popup_close();

			/*
			$.ajax({
            	url:'ajax_sales_report_list.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#report_list').html(data);
            	}
        	});
        	*/

        	var url = \"ajax_sales_report_list.php\";
			ajax_sync('#report_list',url);

		}

		function company_select(uid,company,tax,currency){

			$('#company_id').val(uid);
			$('input:text[name=company_search]').val(company);
			$('input:hidden[name=tax]').val(tax);
			$('#tax').html(tax);
			$('#currency').html(currency);
			popup_close();

			var url = \"ajax_sales_report_list.php\";
			ajax_sync('#list',url);
			/*
				$.ajax({
            		url:'ajax_sales_report_list.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#list').html(data);
            		}
        		});
        	*/	
		}

		$('#company_search1').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	popup_list(0);
        	}
    	});

		// 팝업바디, 페이지 이동
		function popup_list(limit2){
			var compnay_search = $('#compnay_search1').val();
           	compnay_search = encodeURI(compnay_search,'UTF-8');

           	var url = \"ajax_sales_compnay_list.php?limit2=\"+limit2+\"&compnay_search1=\"+compnay_search;
			ajax_sync('#list',url);

			/*
            $.ajax({
                    url:'ajax_sales_compnay_list.php?limit2='+limit2+'&compnay_search1='+compnay_search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#popup_body').html(data);
                    }
            });
            */
        }

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});


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

    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// 판매재고 관련 함수들...
		include "sales_function.php";

		if($site_mobile == "m") $width = "300px"; else $width = "800px"; 		

		$title = "거래처 선택";
		$body = $javascript._popup_body($title,$width, _theme_popup($site_env->theme,"sales_report_company",$site_language,$site_mobile) );

		$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$_list_num = 10;
		$_block_num = 10;
		$limit2 = _formdata("limit2");

		if(_formdata("company_search1")) $company = _formdata("company_search1"); else if(_formdata("company_search")) $company = _formdata("company_search");
		$body = str_replace("{searchkey}","<input type='text' name='company_search1' value='".$company."' id=\"company_search1\" style=\"$css_textbox\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:popup_list('0')\" style=\"".$css_btn_gray."\" >";
		$body = str_replace("{btn_search}",$button_search,$body);

		$form_submit ="<input type='button' value='선택' onclick=\"javascript:form_submit()\" style=\"".$css_btn_gray."\" >";
		$body = str_replace("{form_submit}",$form_submit,$body);

		$multiple = _formdata("multiple");

		$query = "select * from `sales_company` ";
		if($company) $query .= "where company like '%$company%'";
		$query .= " order by regdate desc";
		// echo $query;

		if($rowss = _sales_query_rowss($query)){

			$table_data[0] = array('width' => 20, 'value' => "<input type='checkbox' name='chk_all' id=\"check_all\">");
			$table_data[1] = array('width' => NULL, 'value' => "거래처");
			$table_data[2] = array('width' => 100, 'value' => "대표자");
			$table_data[3] = array('width' => 100, 'value' => "연락처");
			$table_data[4] = array('width' => 50, 'value' => "통화");

			$list .= _table_array($table_data);

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	

				// 거래처 타입 아이콘
				$comtype = _company_type($rows->inout);

				$table_data[0] = array('width' => 20, 'value' => "<input type='checkbox' name='TID[]' value='".$rows->Id."'>");
				$table_data[1] = array('width' => NULL, 'value' => "$comtype ".$rows->company." $master_link $auth");
				$table_data[2] = array('width' => 100, 'value' => $rows->president);
				$table_data[3] = array('width' => 100, 'value' => $rows->phone);
				$table_data[4] = array('width' => 50, 'value' => $rows->currency);

				$list .= _table_array($table_data);			
			}
			
			$body = str_replace("{list}", $list, $body);
		
		} else {
			$msg = "거래처 목록이 없습니다.";
			$body = str_replace("{list}", _msg_tableCell($msg), $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
