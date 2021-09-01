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

	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");

	/////////////



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$javascript = "<script>
			// 거래처 검색 , 키 엔터 
			$('#goodname').on('keydown',function(e){         
        		if(e.keyCode == 13){
            		e.preventDefault();            
            		goods_search();            
        		}
    		});

			function goods_search(){
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
				//var goodname = document.trans.goodname.value;
				//alert(goodname);
				$.ajax({
            		url:'ajax_sales_goods_list.php',
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
					alert(data);

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

    	$mode = _formdata("mode");
    	echo "mode = $mode <br>";
    	if($mode == "newdata"){
    		// 전표일자
    		
    		$insert_filed .= "`regdate`,"; $insert_value .= "'$TODAYTIME',";
    		if($transdate = _formdata("transdate")) { $insert_filed .= "`transdate`,"; $insert_value .= "'$transdate',"; }
    		
    		// 상품정보 
    		if($gid = _formdata("gid")) { $insert_filed .= "`gid`,"; $insert_value .= "'$gid',"; }
    		if($goodname = _formdata("goodname")) { $insert_filed .= "`goodname`,"; $insert_value .= "'$goodname',"; }
    		if($spec = _formdata("spec")) { $insert_filed .= "`spec`,"; $insert_value .= "'$spec',"; }
    		if($num = _formdata("num")) { $insert_filed .= "`num`,"; $insert_value .= "'$num',"; }
    		if($currency = _formdata("currency")) { $insert_filed .= "`currency`,"; $insert_value .= "'$currency',"; }
    		if($prices = _formdata("prices")) { $insert_filed .= "`prices`,"; $insert_value .= "'$prices',"; }
    		if($vat = _formdata("vat")) { $insert_filed .= "`vat`,"; $insert_value .= "'$vat',"; }
    		if($discount = _formdata("discount")) { $insert_filed .= "`discount`,"; $insert_value .= "'$discount',"; }
    		if($sum = _formdata("sum")) { $insert_filed .= "`sum`,"; $insert_value .= "'$sum',"; }
    		if($total = _formdata("total")) { $insert_filed .= "`total`,"; $insert_value .= "'$total',"; }

    		// 사업장 정보 
    		if($business = _formdata("business")) { $insert_filed .= "`business`,"; $insert_value .= "'$business',"; }

    		// 거래처 정보 
    		if($company = _formdata("company_search")) { $insert_filed .= "`company`,"; $insert_value .= "'$company',"; }
    		if($company_id = _formdata("company_id")) { $insert_filed .= "`company_id`,"; $insert_value .= "'$company_id',"; }


    		
			// 전표 소유자, 이메일 
    		$insert_filed .= "`email`,"; $insert_value .= "'".$_COOKIE['cookie_email']."',"; 

    		$insert_filed .= "`quotation`,"; $insert_value .= "'".$_SESSION['quotation_data']."',"; 

    		$query = "INSERT INTO `sales_quotation_data` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			echo $query."<br>";
			//_sales_query($query);

			// balance값 처리 ....


			$uid = _formdata("uid");
			$query = "select * from `sales_quotation` where Id = '$uid'";
    		if($rows= _sales_query_rows($query)){

				$data = $rows->data.$gid.":".$goodname.":".$spec.":".$num.":".$prices.":".$sum.":".$vat.":".$discount.":".$prices.";";
				echo "<=== $data";
				// $query = "UPDATE `sales_quotation` SET `data`='$data' where Id = '$uid'";
				// _sales_query($query);
    		}

			echo "<script>

				// var data = $('#quodata').val();
				// alert(data);

				$.ajax({
            		url:'ajax_sales_quotation_list.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#list').html(data);
            		}
        		});

    		</script>";
			

       	}

       
		


    	$css_btn_save ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";

		$company_id = _formdata("company_id"); 
		$transdate = _formdata("transdate");
		
		$barcodeMode = "trans_sell"; 
		$url_return = "sales_trans_sell.php?company_id=$company_id&transdate=$transdate&";

		$form_barcode = "<butten onclick='showBarcode(\"$barcodeMode \",\" $url_return\")'><img src='./images/barcode.gif' width=20 border=0></butten>";


		$check_all = "<input type='checkbox' name='chk_all' id=\"check_all\">";	

		// $body = _skin_page($skin_name,"sales_trans_form");
		$day=substr($transdate,8,2);
		$form_day = "<input type='text' name='day' value='$day' style=\"$css_textbox\">";


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
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\" width=\"20\"> 일</td>
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
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"25\"> $form_barcode </td>
					<td style='font-size:12px;padding:5px;' align=\"center\" width=\"20\"> $form_day </td>
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

		echo $javascript.$list;		

	
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>