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

	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/orders.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");


	$javascript = "<script>

		$('#goodname').focus();
		
		// ++ 상품 검색 
		$('#goodname').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		var company_id = $('#company_id').val();
           		var warehouse = $('#warehouse').val();

       			if(!warehouse){
            		alert(\"저장창고를 선택해 주세요.\");
            	} else {
            		if(company_id){
           				goods_search();
           			} else {
           				// alert(\"상품 입력 거래처를 선택해 주세요\");
           				$('#msg').val(\"상품 입력 거래처를 선택해 주세요\");
           				var url = \"ajax_alert.php\";
						popup_ajax(url);
        			}
            	} 

           		
        	}
    	});

    	// ++ day 엔터시 포커스 이동
    	$('#day').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		$('#goodname').focus();
        	}
        }); 

    	// 상품 검색 팝업창
		function goods_search(){
			var url = \"ajax_sales_trans_goods.php\";
			popup_ajax(url);			
		}

		// ++ 수량 변경 재계산
		$('#num').on('keyup',function(e){ 
			calculating_prices();
    	});

    	// ++ num 엔터시 포커스 이동
    	$('#num').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		$('#prices').focus();
        	}
        });   		

		$('#prices').on('keyup',function(e){ 
			calculating_prices();
    	});

    	// ++ prices 엔터시 포커스 이동
    	$('#prices').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		$('#vat').focus();
        	}
        });  

		$('#sum').on('keyup',function(e){ 
			calculating_prices();
    	});
       		
       	$('#vat').on('keyup',function(e){ 
			calculating_prices();
    	});

    	// ++ vat 엔터시 포커스 이동
    	$('#vat').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		$('#discount').focus();
        	}
        }); 
       		
       	$('#discount').on('keyup',function(e){ 
			calculating_prices();
    	});

    	// ++ discount 엔터시 포커스 이동
    	$('#discount').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		$('#total').focus();
        	}
        }); 

       	$('#total').on('keyup',function(e){ 
			calculating_prices();
			
    	});

    	// ++ total 엔터시 저장
    	$('#total').on('keydown',function(e){         
        	if(e.keyCode == 13){
           		e.preventDefault();
           		newdata();
        	}
        });
       		
       		
       	function calculating_prices(){
       		var num = $('#num').val();
			var prices = $('#prices').val();
			var tax = $('#company_tax').val();
			var discount = $('#discount').val();
			var sum,vat,total;

			sum = num * prices;
			vat = (sum - discount) / 100 * tax;
     		total = (sum - discount) + vat;

     		//$('input:number[name=sum]').val(sum);
     		$('#sum').val(sum);

     		//$('input:number[name=vat]').val(vat);
     		$('#vat').val(vat);

     		//$('input:number[name=total]').val(total);
     		$('#total').val(total);
       	}


       	$('#save_newdata').on('click',function(){
       		newdata();
       	});

       	function newdata(){
       		var company_id = $('#company_id').val();
       		var gid = $('#gid').val();
       		var prices = $('#prices').val();
       		var num = $('#num').val();
       		
       		if(!company_id){
            	alert(\"거래처를 선택해 주세요\");
            } else if(!gid){
            	alert(\"상품을 선택해 주세요\");
            } else 	if(!prices){
            	alert(\"가격을 선택해 주세요\");
            } else 	if(!num){
            	alert(\"수량을 선택해 주세요\");
            } else {
        		var url = \"ajax_sales_trans_newdata.php?mode=newdata\";
        		ajax_html('#newdata',url);
            }
       	}


		// 상단버튼
		$('#check_all').on('click',function(){
				trans_chkall();
		});	
       	function trans_chkall(){
       		var submit = false;
       		var chk = document.getElementsByName('TID[]');
       				
       		for(var i=0;i<chk.length;i++){
       			if(document.trans.chk_all.checked == true) chk[i].checked = true;
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

    	$mode = _formdata("mode");
    	$company_id = _formdata("company_id"); 
		$transdate = _formdata("transdate");
    	$currency = _formdata("currency");   	
    

    	// ++ 전표 신규 등록
    	if($mode == "newdata"){

    		$query = new query;
			$query->table_name = "sales_trans";

			$query->insert("regdate",$TODAYTIME);// 자료 전산 작업하는 실제적인 날짜/시간

			$transdate = substr($transdate,0,8)._formdata("day");
			$query->insert("transdate",$transdate);// 전표상의 날짜

			$trans = _formdata("trans");
    		$query->insert("trans",$trans);// 거래유형     	

    		$gid = _formdata("gid");
    		$query->insert("gid",$gid);
    		$query->insert("goodname",_formdata("goodname"));
    		$query->insert("spec",_formdata("spec"));

    		$num = _formdata("num");
    		$query->insert("num",$num);

    		$prices = _formdata("prices");
    		$query->insert("prices",$prices);

    		$query->insert("vat",_formdata("vat"));
    		$query->insert("discount",_formdata("discount"));
    		$query->insert("sum",_formdata("sum"));

    		$total = _formdata("total");
    		$query->insert("total",$total);

    		$query->insert("currency",_formdata("currency"));

    		// 해당 전표 대금 결제 부분을 체크, 미수금 잔액 표시 , // 금액 = unpaid 같은 경우 : 전체 미결제 상태
    		// unpaid < total : 일부, 부분 결제   		// unpaid - paid = 0 완전결제 
    		$query->insert("unpaid",$total);
    		 
    		$query->insert("business",_formdata("business")); // 내: 사업장 정보  
    		$query->insert("company",_formdata("company_search")); // 거래처 정보 
    		$company_id = _formdata("company_id");
    		$query->insert("company_id",$company_id);

    		$warehouse = _formdata("warehouse");
    		$query->insert("warehouse",$warehouse); // 제품 저장 창고 	

			$query->insert("email",$_COOKIE['cookie_email']); // 전표 소유자, 이메일     		

    		$_query = $query->insert_query();				
			// echo $_query;
			$insert_id = _sales_insert($_query);


    		// ++ 창고 위치 및 입출력 수량 조절     		
    		if($trans == "sell") {
    			_sales_goodStock($gid,"stock_".$warehouse,"-".$num);
    			
    		} else if($trans == "buy") {
    			_sales_goodStock($gid,"stock_".$warehouse, $num);
    			
    		}

    		
    		$query1 = "select * from `sales_goods` where Id='".$gid."'";
			if($rows1 = _sales_query_rows($query1)){
				
				// ++ 미설정 가격 상품 갱신
				if($trans == "sell" && $rows1->prices_sell == 0){
					_sales_goodPricesSet($gid,$prices,"","");
				} else if($trans == "buy" && $rows1->prices_buy == 0){
					_sales_goodPricesSet($gid,"","",$prices);
				}

			}	


			// ======================
			// ++ balance값 처리 ....
			$query1 = "select * from `sales_company` where Id = '$company_id'";
			// echo $query1."<br>";
			if($rows1 = _sales_query_rows($query1)){
				if($trans == "sell"){
					$balance_sell = $rows1->balance_sell + $total;
					$query1 = "UPDATE `sales_company` SET `balance_sell`= '$balance_sell' WHERE `Id`='$company_id'";
				} else if($rows->trans == "buy"){
					$balance_buy = $rows1->balance_buy + $total;
					$query1 = "UPDATE `sales_company` SET `balance_buy`= '$balance_buy' WHERE `Id`='$company_id'";
				}
				// echo $query1."<br>";
				_sales_query($query1);
			}
			
			
			// 신규 입력한 내역을 포함, 거래내역을 갱신함.
			echo "<script>
        		var url = \"ajax_sales_trans_list.php\";
        		ajax_html('#translist',url);
        		$('#transdate').val(\"$transdate\");
    		</script>";			

       	}

       
		// =====================
    	// ++ 신규 등록 상품 입력부분 출력
    	// $css_btn_save ="font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:28px;	font-size:12px;	border:1px solid #d8d8d8;";
		
		$barcodeMode = "trans_sell"; 
		$url_return = "sales_trans_sell.php?company_id=$company_id&transdate=$transdate&";

		$form_barcode = "<i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>";
		$check_all = "<input type='checkbox' name='chk_all' id=\"check_all\">";	


		$day=substr($transdate,8,2);
		$form_day = "<input type='text' name='day' value='$day' id=\"day\" style=\"$css_textbox\">";

		$form_goodname = "<input type='hidden' name='gid' id=\"gid\"><input type='text' name='goodname' placeholder='상품명' autofocus style=\"$css_textbox\" id=\"goodname\">";
		$form_spec = "<input type='text' name='spec' placeholder='규격' style=\"$css_textbox\">";
		$form_num = "<input type='number' name='num' placeholder='수량' style=\"$css_textbox\" id=\"num\">";
		$form_prices ="<input type='number' name='prices' placeholder='단가' style=\"$css_textbox\" id=\"prices\">";
		$form_sum = "<input type='number' name='sum' placeholder='공급액' style=\"$css_textbox\" id=\"sum\">";
		$form_vat = "<input type='number' name='vat' placeholder='부가세' style=\"$css_textbox\" id=\"vat\">";
		$form_discount = "<input type='number' name='discount' placeholder='할인액' style=\"$css_textbox\" id=\"discount\">";
		$form_total = "<input type='number' name='total' placeholder='합계' style=\"$css_textbox\" id=\"total\">";

		

		$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
				<tr>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"25\"> $check_all </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"20\"> 일</td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' align=\"center\"> 제품명  </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"50\"> 스팩 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"50\"> 수량 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"60\"> 단가 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"60\"> 합계 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"60\"> 부가세 </td>
					<td style='background-color:#DEDEDF;border-right:1px solid #D2D2D2; font-size:12px;padding:5px;' width=\"60\"> 할인 </td>
					<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' width=\"80\"> 합계 </td>
					<td style='background-color:#DEDEDF;font-size:12px;padding:5px;' width=\"50\">상태</td>
				</tr>
				<tr>
					<td style='font-size:12px;padding:5px;' width=\"25\"> $form_barcode </td>
					<td style='font-size:12px;padding:5px;' width=\"20\"> $form_day </td>
					<td style='font-size:12px;padding:5px;' > $form_goodname </td>
					<td style='font-size:12px;padding:5px;' width=\"50\"> $form_spec </td>
					<td style='font-size:12px;padding:5px;' width=\"50\"> $form_num </td>
					<td style='font-size:12px;padding:5px;' width=\"60\"> $form_prices </td>
					<td style='font-size:12px;padding:5px;' width=\"60\"> $form_sum  </td>
					<td style='font-size:12px;padding:5px;' width=\"60\"> $form_vat </td>
					<td style='font-size:12px;padding:5px;' width=\"60\"> $form_discount </td>
					<td style='font-size:12px;padding:5px;' width=\"80\"> $form_total </td>
					<td style='font-size:12px;padding:5px;' width='40'><input type=\"button\" value=\"저장\" id=\"save_newdata\"/></td>
				</tr>
			</table>";
		

		echo $list.$javascript;		
		
	} else {
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $msg;	
	}

?>