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

	// ERP Library
	include ($_SERVER['DOCUMENT_ROOT']."/lib/company.php");
	include ($_SERVER['DOCUMENT_ROOT']."/lib/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/lib/trans.php");
	include ($_SERVER['DOCUMENT_ROOT']."/lib/report.php");


	$javascript = "<script>

		function form_submit(mode,uid){
			var title = $('#title').val();
					
			if(!title){
				alert(\"견적서 제목을 입력해 주세요.\");
			} else {
				var url = \"ajax_sales_quotation_editup.php?uid=\"+uid+\"&mode=\"+mode;
				var formData = new FormData($('#data')[0]);
				$.ajax({
					url:url,
        			type: 'POST',
        			data: formData,
        			async: false,
        			success: function (data) {
        				$('#mainbody').html(data);
        			},
        			cache: false,
        			contentType: false,
        			processData: false
    			});
			}
					
		}

		// 거래처 검색 , 키 엔터 
		$('#company_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	company_search();
        	}
    	});

		// 거래처 검색 팝업 
		$('#btn_company_search').click(function(){
			company_search();
		});

		function company_search(){
			var maskHeight = $(document).height();  
			var maskWidth = $(window).width();

			//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
			$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
			// 팡법창 크기 계산
			//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
			// popup_size(1000,500);
			var width = 800;
			var height = 500;
			var left = ($(window).width() - width )/2;
			var top = ( $(window).height() - height )/2;			
			$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 			  
    
    		//마스크의 투명도 처리
    		$('#popup_mask').fadeTo(\"slow\",0.8); 
			$('#popup_body').show();

			// 팝업 내용을 Ajax로 읽어옴
			$.ajax({
           		url:'ajax_sales_quotation_company.php',
           		type:'post',
           		data:$('form').serialize(),
           		success:function(data){
               		$('#popup_body').html(data);

               		var maskHeight1 = $(document).height();  
					var maskWidth1 = $(window).width();

					//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
					$('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
           		}
        	}); 
		}


		// 선택항목 삭제
		$('#btn_delete').on('click',function(){
        	trans_del();
       	});

		function trans_del(){
			var chk_count = 0;

       		var chk = document.getElementsByName('TID[]');      	
       		var data = \"\";

       		var gid = document.getElementsByName('_gid[]'); 
       		var goodname = document.getElementsByName('_goodname[]'); 
       		var spec = document.getElementsByName('_spec[]'); 
       		var num = document.getElementsByName('_num[]'); 
       		var prices = document.getElementsByName('_prices[]'); 
       		var sum = document.getElementsByName('_sum[]'); 
       		var vat = document.getElementsByName('_vat[]'); 
       		var discount = document.getElementsByName('_discount[]'); 
       		var total = document.getElementsByName('_total[]'); 


			var quo_sum = 0, quo_vat = 0, quo_total = 0;
			
			if(chk.length > 0){

				for(var i=0;i<chk.length;i++){
       				if(chk[i].checked) {
       					// 선택 부분 삭제
       					chk_count++;
       				} else {
       					// 추가 ...
       					data = data + gid[i].value + \":\" + goodname[i].value + \":\" + spec[i].value + \":\" + num[i].value + \":\" + prices[i].value + \":\" + sum[i].value + \":\" + vat[i].value + \":\" + discount[i].value + \":\" + total[i].value + \";\";

       					quo_sum = Number(quo_sum) + Number(sum[i].value);
       					quo_vat = Number(quo_vat) + Number(vat[i].value);
       					quo_total = Number(quo_total) + Number(total[i].value);
       				}
       			}

				if(chk_count > 0){
					var returnValue = confirm(\"선택한 학목을 삭제하겠습니까?\");
					if(returnValue == true){
						//alert(data);
						$('#quodata').val(data);

						$('#quo_sum').val(quo_sum);
						$('#quo_vat').val(quo_vat);
						$('#quo_total').val(quo_total);
 						
 						$.ajax({
            				url:'ajax_sales_quotation_list.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#list').html(data);
            				}
        				});						

 					}
 				} else alert(\"선택된 항목이이 없습니다.\");
 			
 			} else alert(\"목록이 없습니다.\");
 			
 		}



		$('#btn_print').on('click',function(){
 			var url = \"/tcpdf/quotation_pdf.php\";		
			var form = document.quotation;
			form.action = url;  //이동할 페이지
			form.target = \"_blank\";
  				//form.mode.value = mode;
  			// form.uid.value = uid;
  				//form.limit.value = limit;
			
			form.submit();	
       	});

       	// 상품 검색 , 키 엔터 
		$('#goodname').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();            
           		goods_search();            
        	}
    	});




    	




		function goods_search(){
			var url = \"ajax_sales_goods_list.php\";
			popup_ajax(url);
		}



		$('#company_tax').on('keyup',function(e){ 
			list_prices();
		});

		function list_prices(){
			var num = document.getElementsByName('_num[]'); 
       		var prices = document.getElementsByName('_prices[]');
       		var sum = document.getElementsByName('_sum[]');

       		var vat = document.getElementsByName('_vat[]');
       		var tax = $('#company_tax').val();

       		var discount = document.getElementsByName('_discount[]');

       		var total = document.getElementsByName('_total[]');

       		var _sum,_vat,_total;

       		var quo_sum = 0, quo_vat = 0, quo_total = 0;

       		for(var i=0;i<num.length;i++){
       			_sum = Number(num[i].value) * Number(prices[i].value);
				_vat = ( Number(_sum) - Number(discount[i].value) ) / 100 * tax;
     			_total = ( Number(_sum) - Number(discount[i].value) )+ _vat;

       			sum[i].value =  _sum;
       			vat[i].value =  _vat;
       			total[i].value =  _total;

       			quo_sum = Number(quo_sum) + Number(_sum);
       			$('#quo_sum').val(quo_sum);

       			quo_vat = Number(quo_vat) + Number(_vat);
       			$('#quo_vat').val(quo_vat);

       			quo_total = Number(quo_total) + Number(_total);
       			$('#quo_total').val(quo_total);


       		}
		}

		function list_vat(){
			// 부가세 부분 직접 수정
			// 부가세율 자동 계산하지 않음. 

			var vat = document.getElementsByName('_vat[]');
			var sum = document.getElementsByName('_sum[]');
			var discount = document.getElementsByName('_discount[]');
			var total = document.getElementsByName('_total[]');

			var quo_sum = 0, quo_vat = 0, quo_total = 0;

			for(var i=0;i<vat.length;i++){
				total[i].value = Number(sum[i].value) + Number(vat[i].value) - Number(discount[i].value);

				quo_sum = Number(quo_sum) + Number(sum[i].value);
       			$('#quo_sum').val(quo_sum);

       			quo_vat = Number(quo_vat) + Number(vat[i].value);
       			$('#quo_vat').val(quo_vat);

       			quo_total = Number(quo_total) + Number(total[i].value);
       			$('#quo_total').val(quo_total);
			}	

		}


		$('#num').on('keyup',function(e){ 
			calculating_prices();
    	});

		$('#prices').on('keyup',function(e){ 
			calculating_prices();
    	});

		$('#sum').on('keyup',function(e){ 
			calculating_prices();
    	});
       		
       	$('#vat').on('keyup',function(e){ 
			calculating_prices();
    	});
       		
       	$('#discount').on('keyup',function(e){ 
			calculating_prices();
    	});

       	$('#total').on('keyup',function(e){ 
			calculating_prices();
    	});
       		
       		
       	function calculating_prices(){
       		var num = $('input:text[name=num]').val();
			var prices = $('input:text[name=prices]').val();
			var tax = $('#company_tax').val();
			var discount = $('input:text[name=discount]').val();
			var sum,vat,total;			

			sum = num * prices;
			vat = (sum - discount) / 100 * tax;
     		total = (sum - discount) + vat;
     			
     		//document.trans.sum.value = sum;
     		$('input:text[name=sum]').val(sum);

     		//document.trans.vat.value = vat;
     		$('input:text[name=vat]').val(vat);
     			
     		//document.trans.total.value = total;
     		$('input:text[name=total]').val(total);

       	}


       	$('#save_newdata').on('click',function(){
       		var company_id = $('#company_id').val();
       		
       		var gid = $('#gid').val();
       		var goodname = $('#goodname').val();
       		var spec = $('#spec').val();
       		var prices = $('#prices').val();
       		var num = $('#num').val();
			var tax = $('#company_tax').val();
			var discount = $('input:text[name=discount]').val();
			var sum,vat,total;

			sum = num * prices;
			vat = (sum - discount) / 100 * tax;
     		total = (sum - discount) + vat;       			
       			
       		if(!goodname){
           		alert(\"상품명을 입력해 주세요\");
           	} else 	if(!prices){
           		alert(\"가격을 선택해 주세요\");
           	} else 	if(!num){
           		alert(\"수량을 선택해 주세요\");
           	} else {

           		var data = $('#quodata').val();
           		data = data + gid + \":\" + goodname + \":\" + spec + \":\" + num + \":\" + prices + \":\" + sum + \":\" + vat + \":\" + discount + \":\" + prices + \";\";
           		$('#quodata').val(data);
				//alert(data);

				// 입력 초기화
				$('#gid').val('');
				$('#goodname').val('');
				$('#spec').val('');
				$('#prices').val('');
				$('#num').val('');
				$('#sum').val('');
				$('#vat').val('');
				$('#discount').val('');
				$('#total').val('');            		

        		// 리스트 목록 갱신
        		$.ajax({
           			url:'ajax_sales_quotation_list.php',
           			type:'post',
           			data:$('form').serialize(),
           			success:function(data){
           				$('#list').html(data);
           			}
        		});

        		var quo_sum = $('#quo_sum').val();
     			var quo_vat = $('#quo_vat').val(); 
     			var quo_total = $('#quo_total').val();

     			quo_sum = Number(quo_sum) + Number(sum);
       			$('#quo_sum').val(quo_sum);

       			quo_vat = Number(quo_vat) + Number(vat);
       			$('#quo_vat').val(quo_vat);

       			quo_total = Number(quo_total) + Number(total);
       			$('#quo_total').val(quo_total);


           	}

       	});

		// 상단버튼
		$('#check_all').on('click',function(){
			//alert(\"all check\");
			quo_chkall();
		});	

       	function quo_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.quotation.chk_all.checked == true) chk[i].checked = true;
       			else chk[i].checked = false;
       		}
 		}     	

	</script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"sales_quotation_edit",$site_language,$site_mobile);

		$mode = _formmode();	
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$list_num = _formdata("list_num");
		$search = _formdata("searchkey");
		$start = _formdata("start");
		$end = _formdata("end");


		$query = "select * from `sales_quotation` where Id = '$uid'";
    	if($rows= _sales_query_rows($query)){
    		
    		$form_submit = "<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >  ";
    		$form_submit .= "<input type='button' value='삭제' onclick=\"javascript:form_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >";
    		$body = str_replace("{form_submit}",$form_submit,$body);

    		$body = str_replace("{print}","<input type='button' value='인쇄' style=\"".$css_btn_gray."\" id=\"btn_print\">",$body);
			
    	} else {
    		    	
    		$body = str_replace("{form_submit}","<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >",$body);

    		//# 신규 등록일 경우, 정보가 입력 되지 않은 관계로 출력은 제한합니다.
    		$body = str_replace("{print}","저장후 인쇄가능",$body);
    	}

    	$body=str_replace("{formstart}","<form id='data' name='quotation' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>
										<input type='hidden' name='data' value='".$rows->data."' id=\"quodata\">
										<input type='hidden' name='limit' value='$limit'>
					<input type='hidden' name='searchkey' value='$search'>
					<input type='hidden' name='list_num' value='$list_num'>
					<input type='hidden' name='start' value='$start'>
					<input type='hidden' name='end' value='$end'>",$body);
		$body = str_replace("{formend}","</form>",$body);


		$body = str_replace("{mail}","<input type='button' value='메일' style=\"".$css_btn_gray."\" id=\"btn_mail\">",$body);
		$body = str_replace("{pdf}","<input type='button' value='PDF' style=\"".$css_btn_gray."\" id=\"btn_pdf\">",$body);
		$body = str_replace("{excel}","<input type='button' value='엑셀' style=\"".$css_btn_gray."\" id=\"btn_excel\">",$body);

		$body = str_replace("{delete}","<input type='button' value='항목삭제' style=\"".$css_btn_gray."\" id=\"btn_delete\">",$body);
	
		

		

    	if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
		else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{title}","<input type='text' name='title' value='".$rows->title."' id=\"title\" style=\"$css_textbox\">",$body);

		if($rows->transdate){
			$body = str_replace("{transdate}","<input type='date' name='transdate' value='".$rows->transdate."' id=\"transdate\" style=\"$css_textbox\">",$body);
		} else {
			$body = str_replace("{transdate}","<input type='date' name='transdate' value='".$TODAY."' id=\"transdate\" style=\"$css_textbox\">",$body);
		}

		//# 거래처 화면 및 검색처리..
		/*
		if(!$company_id) $company_id = $rows->company_id;
		$query = "select * from `sales_company` where Id = '$company_id'";
		if($coms = _sales_query_rows($query)){
			$balance1 = $coms->balance1;			
			$body = str_replace("{company_search}","<input type='text' name='company_search' style=\"$css_textbox\" id=\"company_search\">",$body);
		} else {
			$body = str_replace("{company_search}","<input type='text' name='company_search' placeholder='거래처명 검색' style=\"".$css_btn_gray."\" id=\"company_search\">",$body);
		}
		*/
		if($rows->company){
			$body = str_replace("{company_search}","<input type='text' name='company_search' value='".$rows->company."' style=\"$css_textbox\" id=\"company_search\">",$body);
		} else {
			$body = str_replace("{company_search}","<input type='text' name='company_search' placeholder='거래처명 검색' style=\"$css_textbox\" id=\"company_search\">",$body);
		}
		$body = str_replace("{search}","<input type=hidden name=company_id value='$company_id' id=\"company_id\">
			<input type='button' value='검색' style=\"".$css_btn_gray."\" id=\"btn_company_search\">",$body);


		$body = str_replace("{customer}","<input type='text' name='customer' value='".$rows->customer."' style=\"$css_textbox\">",$body);
		$body = str_replace("{phone}","<input type='text' name='phone' value='".$rows->phone."' style=\"$css_textbox\">",$body);
		$body = str_replace("{email}","<input type='text' name='email' value='".$rows->email."' style=\"$css_textbox\">",$body);

		if($rows->tax)
			$body = str_replace("{tax}","<input type='text' name='tax' value='".$rows->tax."' id=\"company_tax\" style=\"$css_textbox\">",$body);
		else $body = str_replace("{tax}","<input type='text' name='tax' value='0'  id=\"company_tax\" style=\"$css_textbox\">",$body);

		

		$query = "select * from `shop_currency`";
		if($currency_rowss = _sales_query_rowss($query)){
			$form_currency = "<select name='currency' style=\"$css_textbox\" >";	

			for($ii=0;$ii<count($currency_rowss);$ii++){
				$rows1=$currency_rowss[$ii];

				if($rows->currency == $rows1->currency) {
					$form_currency .= "<option value='".$rows1->currency."' selected>".$rows1->currency."-".$rows1->name."</option>"; 
				} else {
					$form_currency .= "<option value='".$rows1->currency."'>".$rows1->currency."-".$rows1->name."</option>";
				}
				
			}
		}
		$form_currency .= "</select>";
		// $body = str_replace("{currency}","<input type='text' name='currency' value='".$rows->currency."' style=\"$css_textbox\">",$body);
		$body = str_replace("{currency}",$form_currency,$body);


		//# 사업장 선택 
		$form_business = "<select name='business_id' style=\"$css_textbox\" >";
		$form_business .= "<option value=''>사업장</option>";
		$query = "select * from sales_business where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->business == $rows1->Id) $form_business .= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>"; 
				else $form_business .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
			}
		}
		$form_business .= "</select>";
		$body = str_replace("{business}",$form_business,$body);
			

		$body = str_replace("{memo}",_form_textarea("quomemo",$rows->quomemo,"10",$css_textarea),$body);	

		$body = str_replace("{quo_sum}","<input type='text' name='quo_sum' value='".$rows->quo_sum."' style=\"$css_textbox\" id=\"quo_sum\">",$body);
		$body = str_replace("{quo_vat}","<input type='text' name='quo_vat' value='".$rows->quo_vat."' style=\"$css_textbox\" id=\"quo_vat\">",$body);
		$body = str_replace("{quo_total}","<input type='text' name='quo_total' value='".$rows->quo_total."' style=\"$css_textbox\"  id=\"quo_total\">",$body);


		// 신규 자료 입력 
		/*
		$newdata_form = "<span id=\"newdata\">	
		<script>
			$.ajax({
            	url:'ajax_sales_quotation_newdata.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#newdata').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{newdata}",$newdata_form,$body);
    	*/


    	$css_btn_save ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";

		// $company_id = _formdata("company_id"); 
		// $transdate = _formdata("transdate");
		
		// $barcodeMode = "trans_sell"; 
		// $url_return = "sales_trans_sell.php?company_id=$company_id&transdate=$transdate&";

		// $form_barcode = "<butten onclick='showBarcode(\"$barcodeMode \",\" $url_return\")'><img src='./images/barcode.gif' width=20 border=0></butten>";

    	$barcode = "<i class=\"fa fa-barcode\"></i>";
		$check_all = "<input type='checkbox' name='chk_all' id=\"check_all\">";	

		// $body = _skin_page($skin_name,"sales_trans_form");
		// $day=substr($transdate,8,2);
		// $form_day = "<input type='text' name='day' value='$day' style=\"$css_textbox\">";


		$form_goodname = "<input type='hidden' name='gid' id=\"gid\"><input type='text' name='goodname' placeholder='상품명' autofocus style=\"$css_textbox\" id=\"goodname\">";
		$form_spec = "<input type='text' name='spec' placeholder='규격' style=\"$css_textbox\" id=\"spec\">";
		$form_num = "<input type='text' name='num' placeholder='수량' style=\"$css_textbox\" id=\"num\">";
		$form_prices ="<input type='text' name='prices' placeholder='단가' style=\"$css_textbox\" id=\"prices\">";
		$form_sum = "<input type='text' name='sum' placeholder='공급액' style=\"$css_textbox\" id=\"sum\">";
		$form_vat = "<input type='text' name='vat' placeholder='부가세' style=\"$css_textbox\" id=\"vat\">";
		$form_discount = "<input type='text' name='discount' placeholder='할인액' style=\"$css_textbox\" id=\"discount\">";
		$form_total = "<input type='text' name='total' placeholder='합계' style=\"$css_textbox\" id=\"total\">";

		
		$list = "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
				<tr>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"25\"> $check_all </td>
					
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\"> 제품명  </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"50\"> 스팩 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"50\"> 수량 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"60\"> 단가 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"60\"> 합계 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"60\"> 부가세 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"60\"> 할인 </td>
					<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' align=\"center\" width=\"80\"> 합계 </td>
					<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' align=\"center\" width=\"50\">상태</td>
				</tr>
				<tr>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"25\"> $barcode </td>					
					<td style='font-size:12px;padding:5px;' align=\"center\"> $form_goodname </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"50\"> $form_spec </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"50\"> $form_num </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_prices </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_sum  </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_vat </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"60\"> $form_discount </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"80\"> $form_total </td>
					<td style='font-size:12px;padding:10px;' width='40'>
						<input type=\"button\" value=\"저장\" style=\"".$css_btn_save."\" id=\"save_newdata\"/>
					</td>
				</tr>
			</table>";

		$body = str_replace("{newdata}",$list,$body);


		

		// =================
		//# 전표 자료 출력 
		$list_form = "<span id=\"list\">	
		<script>
			$.ajax({
            	url:'ajax_sales_quotation_list.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#list').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{list}",$list_form,$body);


		echo $body;		
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	

	
?>

