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
		function edit(mode,uid,limit){
			var url = \"sales_quotation_edit.php\";		
			var form = document.quotation;
			form.action = url;  //이동할 페이지
  			form.mode.value = mode;
  			form.uid.value = uid;
  			form.limit.value = limit;
			
			form.submit();	
        }
        
        function search(){
        	list('0');
        }

        function list(limit){
            var search = document.quotation.searchkey.value;

            $.ajax({
                url:'ajax_sales_quotation.php?limit='+limit+'&search='+search,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });                	
        }

            $('#btn_priod_search').click(function(){
            	var search = document.quotation.searchkey.value;
				$.ajax({
            		url:'ajax_sales_quotation.php?limit='+limit+'&search='+search,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
			});

           
    	$('#btn_print').on('click',function(){
    		var chk_count = 0;
       		var chk = document.getElementsByName('TID[]'); 
       		var uid = \"\";


       		if(chk.length > 0){

				for(var i=0;i<chk.length;i++) if(chk[i].checked) chk_count++;
       			if(chk_count > 0){
       				for(var i=0;i<chk.length;i++) if(chk[i].checked) uid = uid + chk[i].value + \";\";
       				
       				var url = \"/tcpdf/quotation_pdf.php\";		
					var form = document.quotation;
					form.action = url;  //이동할 페이지
					form.target = \"_blank\";
  					form.uid.value = uid;
			
					form.submit();


       			} else alert(\"선택된 항목이이 없습니다.\");
 			
 			} else alert(\"목록이 없습니다.\");			 

       		
       	});

       	// 상단버튼
		$('#check_all').on('click',function(){
			trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.quotation.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		}

 		// 사업장
 		$('#business_list').on('change',function(){
        	list(0);
    	});

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
					var url = \"ajax_sales_quotation_editup.php\";
					var form = document.quotation;

					form.action = url;  //이동할 페이지
  					form.mode.value = \"check_delete\";
  					// alert(\"삭제\");

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


		


		// $body = $javascript._skin_page($skin_name,"sales_quotation");
		$body = $javascript._theme_page($site_env->theme,"sales_quotation",$site_language,$site_mobile);


		$mode = _formmode();
		$limit = _formdata("limit"); 		
		$search = _formdata("searchkey");
		
		// 출력 목록수 지정
		$_block_num = 10;
		if(!$_list_num = _formdata("list_num")) $_list_num = 10;
		$body = str_replace("{list_num}", _listnum_select($_list_num),$body);

		
		$body = str_replace("{formstart}","<form name='quotation' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='mode'>
								<input type='hidden' name='uid'>
								<input type='hidden' name='limit' value='$limit'>
							<input type='hidden' name='searchkey' value='$search'>
							<input type='hidden' name='list_num' value='$list_num'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		


		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);

		$searchkey = _formdata("searchkey");
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);        
		$body = str_replace("{search}","<input type='button' value='검색' onclick=\"javascript:search()\" style=\"".$css_btn_gray."\" >",$body);

		if($start = _formdata("start")) $body = str_replace("{start}","<input type='date' name='start' value='$start'  style=\"$css_textbox\">",$body);
		else $body = str_replace("{start}","<input type='date' name='start' value='$TODAY'  style=\"$css_textbox\">",$body);

		if($end = _formdata("end")) $body = str_replace("{end}","<input type='date' name='end' value='$end'  style=\"$css_textbox\">",$body);
		else $body = str_replace("{end}","<input type='date' name='end' value='$TODAY'  style=\"$css_textbox\">",$body);

		$body = str_replace("{priod_search}","<input type='button' value='기간검색' onclick=\"javascript:search()\" style=\"".$css_btn_gray."\" id=\"btn_priod_search\">",$body);

		$body = str_replace("{print}","<input type='button' value='인쇄' style=\"".$css_btn_gray."\" id=\"btn_print\">",$body);

		$button ="<input type='button' value='선택삭제' onclick=\"javascript:check_delete()\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{delete}",$button,$body);

		//# 사업장 선택 		
		$business = _formdata("business_list");
		$form_business = "<select name='business_list' id=\"business_list\" style=\"$css_textbox\" >";
		$query = "select * from sales_business ";
		if($rowss = _sales_query_rowss($query)){
			$form_business .= "<option value=''>전체사업장</option>";
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($business == $rows1->Id) $form_business .= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>"; 
				else $form_business .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
			}
		}
		$form_business .= "</select>";
		$body = str_replace("{business}",$form_business,$body);

		$list_title  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" style='border:1px solid #D2D2D2;'><tr>";
		$list_title .= "<td style='background-color:#DEDEDF;border-right:1px solid #ffffff;font-size:12px;padding:5px;' width='100'>견적일자</td>";
		$list_title .= "<td style='background-color:#DEDEDF;border-right:1px solid #ffffff;font-size:12px;padding:5px;' >제목</td>";
		$list_title.= "<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' width='100'>견적금액</td>";
		$list_title .= "</tr></table>";
		$body = str_replace("{list}", $list_title."{list}", $body);

		$query = "select * from `sales_quotation` ";
		if($searchkey || $start || $end){
			$query .= "where ";
			if($searchkey) $query .= "title like '%$searchkey%' and ";
			if($start) $query .= "regdate >= '$start' and ";
			if($end) $query .= "regdate <= '$end' and ";
			if($business) $query .= "business_id = '$business' and ";
			$query .= ";";
		}

		$query .= "order by transdate desc ";
		$query = str_replace("and ;", "", $query);

		$total = _sales_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		// 검색된 데이터 내에서 , limit 설정 
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";
		// echo $query;

		if($rowss = _sales_query_rowss($query)){

			$list = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'> <input type='checkbox' name='chk_all' id=\"check_all\"> </td>";				
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>견적일자</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>사업장</td>
						<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>거래처</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>견적명</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>합계</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>부가세</td>
					  <td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>견적금액</td>
							</tr>
						</table>";

			if( ($total - $limit) < $_list_num ) $count = $total - $limit; else $count = $_list_num;
			for($i=0;$i<$count;$i++){
				$rows = $rowss[$i];
				
				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				if($rows->enable) $quoName = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->title."</a>";
				else $quoName = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','".$limit."')\"><span style=\"text-decoration:line-through;\">".$rows->title."</span></a>";

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$tid."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->transdate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->business."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->company."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> $quoName </td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->quo_sum."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->quo_vat."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->quo_total."</td>";
				$list .= "</tr></table>";

				
			}

			$list .= _pagination($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{datalist}", $list, $body);
		} else {
			$msg = "견적서 목록이 없습니다.";
			$list .= _msg_tableCell( _string($msg, $site_language) );
			$body = str_replace("{datalist}", $list, $body);
		}	

		echo $body;
	
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");
	}	
	
	

?>
