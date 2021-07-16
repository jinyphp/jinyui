<?
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";

/*
		$javascript = "<script>
			function business_edit(mode,uid){
				// alert(uid);
				$('#company').html(uid);
				
					$.ajax({
                        url:'/ajax_sales_business_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#company').html(data);
                        }
                    }); 
				

				
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
            		url:'/ajax_sales_business_edit.php?uid='+uid+'&mode='+mode,
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
		</script>";
		echo $javascript;
*/ 

       
		$javascript = "<script>
				$('input:radio[name=business]').change(function(){
					// alert(\"aaa\");
		 			var business = $('input:radio[name=business]:checked').val();
        			$.ajax({
            				url:'./ajax_sales_company.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#company').html(data);
            				}
        			});
    			}); 

			$('#business_country').on('change',function(){
      			// var search = document.business.searchkey.value;
                $.ajax({
                    url:'/ajax_sales_business.php',
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#business').html(data);
                    }
                }); 	
   			});

			function company_list(){
				$('input:radio[name=business]:checked').attr(\"checked\", false);
				$.ajax({
            				url:'./ajax_sales_company.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#company').html(data);
            				}
        			});
			}

			
		</script>";
		echo $javascript;

		//$body = $javascript._skin_page($skin_name,"sales_business");
		$business_country = _formdata("business_country");

		

		// 국가 선택 
		$query = "select * from `shop_country` ";
		if($rowss = _mysqli_query_rowss($query)){	
			$_form_select_country = "<select name='business_country' style='$css_textbox' id=\"business_country\">";
			$_form_select_country .= "<option value=''>사업장 국가</option>";			
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				
				$title = stripslashes($rows1->name);
				$name = json_decode($title);
						
				if($business_country == $rows1->code) $_form_select_country .= "<option value='".$rows1->code."' selected>".$name->$site_language."(".$rows1->code.")</option>";
				else $_form_select_country .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
			}
			$_form_select_country .= "</select>";
		}
	
	
		echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style='font-size:12px;padding:10px;'>
			$_form_select_country
		</td></tr></table>";


		$query = "select * from `sales_business` ";
		if($business_country){
			$query .= "where `country`='$business_country' ";
		}
		$query .= "order by regdate desc";
		// echo $query."<br>";
		if($rowss = _sales_query_rowss($query)){


			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='font-size:12px;padding:10px;' width='20'><input type=radio name=business value='' id=\"company_all\"></td>";
			$list .= "<td style='font-size:12px;padding:10px;'><a href='#' onclick=\"javascript:company_list()\">전체 거래처</a></td>";
			$list .= "</tr></table>";
			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style='border-top:1px solid #E9E9E9;' height='5'></td></tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";

				if($rows->enable) {
					$from_radio_business = "<input type=radio name=business value='".$rows->Id."'  id=\"company_list\">";
					$business_name = "<a href='#' onclick=\"javascript:business_edit('edit','".$rows->Id."')\">".$rows->business."</a>";
				} else {
					$from_radio_business = "<input type=radio name=business value='".$rows->Id."'  id=\"company_list\">";
					$business_name  = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:business_edit('edit','".$rows->Id."')\">".$rows->business."</a></span>";
				}
				$list .= "<td style='font-size:12px;padding:10px;' width='20'>".$from_radio_business."</td>";
				$list .= "<td style='font-size:12px;padding:10px;'>$business_name (".$rows->country.")</td>";
				$list .= "</tr></table>";
	
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style='border-top:1px solid #E9E9E9;' height='5'></td></tr></table>";

				
			}

			//$body = str_replace("{list}", $list, $body);
			echo $list;

		} else {
			$msg = "거래처 목록이 없습니다.";
			//$body = str_replace("{list}", $msg, $body);
			echo $msg;
		}	

		//echo $body;
		echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td height='20'></td></tr></table>";

		$button ="<input type='button' value='사업장 추가' onclick=\"javascript:business_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		// $body = str_replace("{new}",$button,$body);
		echo "<center>".$button."</center>";
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
