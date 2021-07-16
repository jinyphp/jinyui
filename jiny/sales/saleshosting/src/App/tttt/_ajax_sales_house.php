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
       
		$javascript = "<script>
			$('input:radio[name=house]').change(function(){
				alert(\"aaa\");
		 		var house = $('input:radio[name=house]:checked').val();
        		$.ajax({
            		url:'./ajax_sales_goods.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#goods').html(data);
            		}
        		});
    		}); 

			$('#house_country').on('change',function(){
                $.ajax({
                    url:'/ajax_sales_house.php',
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#house').html(data);
                    }
                }); 	
   			});

			function goods_list(){
				$('input:radio[name=house]:checked').attr(\"checked\", false);
				$.ajax({
            				url:'./ajax_sales_goods.php',
            				type:'post',
            				data:$('form').serialize(),
            				success:function(data){
            					$('#goods').html(data);
            				}
        			});
			}

			
		</script>";
		echo $javascript;

		//$body = $javascript._skin_page($skin_name,"sales_house");
		$house_country = _formdata("house_country");

		

		// 국가 선택 
		$query = "select * from `shop_country` ";
		if($rowss = _mysqli_query_rowss($query)){	
			$_form_select_country = "<select name='house_country' style='$css_textbox' id=\"house_country\">";
			$_form_select_country .= "<option value=''>국가별 창고</option>";			
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				
				$title = stripslashes($rows1->name);
				$name = json_decode($title);
						
				if($house_country == $rows1->code) $_form_select_country .= "<option value='".$rows1->code."' selected>".$name->$site_language."(".$rows1->code.")</option>";
				else $_form_select_country .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
			}
			$_form_select_country .= "</select>";
		}
	
	
		echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style='font-size:12px;padding:10px;'>
			$_form_select_country
		</td></tr></table>";


		$query = "select * from `sales_goods_house` ";
		if($house_country){
			$query .= "where `country`='$house_country' ";
		}
		$query .= "order by regdate desc";
		// echo $query."<br>";
		if($rowss = _sales_query_rowss($query)){


			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='font-size:12px;padding:10px;' width='20'><input type=radio name=house value='' id=\"company_all\"></td>";
			$list .= "<td style='font-size:12px;padding:10px;'><a href='#' onclick=\"javascript:goods_list()\">전체 제품목록</a></td>";
			$list .= "</tr></table>";
			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style='border-top:1px solid #E9E9E9;' height='5'></td></tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";

				if($rows->enable) {
					$from_radio_house = "<input type=radio name=house value='".$rows->Id."'  id=\"company_list\">";
					$house_name = "<a href='#' onclick=\"javascript:house_edit('edit','".$rows->Id."')\">".$rows->name."</a>";
				} else {
					$from_radio_house = "<input type=radio name=house value='".$rows->Id."'  id=\"company_list\">";
					$house_name  = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:house_edit('edit','".$rows->Id."')\">".$rows->name."</a></span>";
				}
				$list .= "<td style='font-size:12px;padding:10px;' width='20'>".$from_radio_house."</td>";
				$list .= "<td style='font-size:12px;padding:10px;'>$house_name (".$rows->country.")</td>";
				$list .= "</tr></table>";
	
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style='border-top:1px solid #E9E9E9;' height='5'></td></tr></table>";

				
			}

			//$body = str_replace("{list}", $list, $body);
			echo $list;

		} else {
			$msg = "창고 목록이 없습니다.";
			//$body = str_replace("{list}", $msg, $body);
			echo $msg;
		}	

		//echo $body;
		echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td height='20'></td></tr></table>";

		$button ="<input type='button' value='창고 추가' onclick=\"javascript:house_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		// $body = str_replace("{new}",$button,$body);
		echo "<center>".$button."</center>";
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
