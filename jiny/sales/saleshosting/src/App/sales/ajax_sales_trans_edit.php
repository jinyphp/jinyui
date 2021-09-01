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

		function popup_submit(){
				// 
				var url = \"ajax_sales_trans_list.php\";
				$.ajax({
            		url:url,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#translist').html(data);
            		}
        		});

				// 팝업창 종료
				popup_close();	
		}


		$('#num1').on('keyup',function(e){ 
			calculating_prices1();
    	});

		$('#prices1').on('keyup',function(e){ 
			calculating_prices1();
    	});

		$('#sum1').on('keyup',function(e){ 
			calculating_prices1();
    	});
       		
       	$('#vat1').on('keyup',function(e){ 
			calculating_prices1();
    	});
       		
       	$('#discount1').on('keyup',function(e){ 
			calculating_prices1();
    	});

       	$('#total1').on('keyup',function(e){ 
			calculating_prices1();
    	});

    	function calculating_prices1(){
       		var num = $('input:text[name=num1]').val();
			var prices = $('input:text[name=prices1]').val();
			var tax = $('#company_tax').val();
			var discount = $('input:text[name=discount1]').val();
			var sum,vat,total;

			sum = num * prices;
			vat = (sum - discount) / 100 * tax;
     		total = (sum - discount) + vat;
     			
     		$('input:text[name=sum1]').val(sum);    	
     		$('input:text[name=vat1]').val(vat);     		
     		$('input:text[name=total1]').val(total);
       	}


			

		// 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});

    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		if($site_mobile == "m") $width = "300px"; else $width = "500px"; 		

		$uid = _formdata("uid");		
		$query = "select * from `sales_trans` where Id = '$uid'";
		//echo $query."<br>";
		if($rows = _sales_query_rows($query)){

			if($rows->lock == "on"){
				$title = "전표내용 수정 ";
				$body_msg = "본 전표는 lock 상태 입니다. 전표전송 또는 세금계산서 발급된 자료는 lock 상태로 전환 됩니다.";
				$body = $javascript._popup_body( $title, $width, $body_msg);
				
			} else {
				$title = "전표내용 수정";
				$body = $javascript._popup_body( $title, $width, _theme_popup($site_env->theme,"sales_trans_edit",$site_language,$site_mobile) );

				$limit = _formdata("limit");
				$search = _formdata("searchkey");
				$category = _formdata("category");

				$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='uid' value='$uid'>
								<input type='hidden' name='mode' value='edit'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='category' value='$category'>	
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
				$body = str_replace("{formend}","</form>",$body);

				$body = str_replace("{form_submit}","
				<input type='button' value='수정' onclick=\"javascript:popup_submit()\" style=\"".$css_btn_gray."\" >
				",$body);

				$transdate = _formdata("transdate");
				$day=substr($transdate,8,2);
				$form_day = "<input type='date' name='transdate1' value='".$rows->transdate."' style=\"$css_textbox\">";
				$body = str_replace("{transdate}", $form_day, $body);

				$form_goodname = "<input type='hidden' name='gid1' id=\"gid1\">
				<input type='text' name='goodname1' value='".$rows->goodname."' placeholder='상품명' autofocus style=\"$css_textbox\" id=\"goodname1\">";
				$body = str_replace("{goodname}", $form_goodname, $body);

				$form_spec = "<input type='text' name='spec1' value='".$rows->spec."' placeholder='규격' style=\"$css_textbox\">";
				$body = str_replace("{spec}", $form_spec, $body);

				$form_num = "<input type='text' name='num1' value='".$rows->num."' placeholder='수량' style=\"$css_textbox\" id=\"num1\">";
				$body = str_replace("{num}", $form_num, $body);

				$form_prices ="<input type='text' name='prices1' value='".$rows->prices."' placeholder='단가' style=\"$css_textbox\" id=\"prices1\">";
				$body = str_replace("{prices}", $form_prices, $body);

				$form_sum = "<input type='text' name='sum1' value='".$rows->sum."' placeholder='공급액' style=\"$css_textbox\" id=\"sum1\">";
				$body = str_replace("{sum}", $form_sum, $body);

				$form_vat = "<input type='text' name='vat1' value='".$rows->vat."' placeholder='부가세' style=\"$css_textbox\" id=\"vat1\">";
				$body = str_replace("{vat}", $form_vat, $body);

				$form_discount = "<input type='text' name='discount1' value='".$rows->discount."' placeholder='할인액' style=\"$css_textbox\" id=\"discount1\">";
				$body = str_replace("{discount}", $form_discount, $body);

				$form_total = "<input type='text' name='total1' value='".$rows->total."' placeholder='합계' style=\"$css_textbox\" id=\"total1\">";
				$body = str_replace("{total}", $form_total, $body);
			}
			



		} else {
			$title = "전표내용 수정 ";
			$body_msg = "수정할 전표가 없습니다.";
			$body = $javascript._popup_body( $title, $width, $body_msg);
		}

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
