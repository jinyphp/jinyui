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
			function business_mode(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_sales_business_editup.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }

			function edit(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_sales_business_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
                
            function list(limit){
                	var search = document.business.searchkey.value;
                  	$.ajax({
                        url:'/ajax_sales_business.php?limit='+limit+'&search='+search,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }

            $('#inout').on('change',function(){
      			var search = document.business.searchkey.value;
                $.ajax({
                    url:'/ajax_sales_business.php?search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('.mainbody').html(data);
                    }
                }); 	
   			});

			$('#business_country').on('change',function(){
      			var search = document.business.searchkey.value;
                $.ajax({
                    url:'/ajax_sales_business.php?search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('.mainbody').html(data);
                    }
                }); 	
   			});
        </script>";


		$body = $javascript._skin_page($skin_name,"sales_business");

		$business_country = _formdata("business_country");
		echo "country = $business_country <br>";
		$inout = _formdata("business_type"); if(!$inout) $inout = _formdata("inout");
		echo "inout = $inout <br>";
		
		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='business' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='inout' value='$inout'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);
		$button_search ="<input type='button' value='검색' onclick=\"javascript:list('0')\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);


		// 국가 선택 
		$query = "select * from `shop_country` ";
		if($rowss = _mysqli_query_rowss($query)){	
			$_form_select_country = "<select name='business_country' style='$css_textbox' id=\"business_country\">";			
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				
				$title = stripslashes($rows1->name);
				$name = json_decode($title);
						
				if($business_country == $rows1->code) $_form_select_country .= "<option value='".$rows1->code."' selected>".$name->$site_language."(".$rows1->code.")</option>";
				else $_form_select_country .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
			}

			$_form_select_country .= "</select>";
			
		}
	
		$body = str_replace("{compnay_country}",$_form_select_country,$body);


		function _form_select_business_type($name,$sel,$css){
			
			$form_select = "<select name='".$name."' style='$css' id=\"inout\">";	
		
			if($sel == "buysell") $form_select .= "<option value='buysell' selected>매입매출</option>";
			else $form_select .= "<option value='buysell'>매입매출</option>";

			if($sel == "sell") $form_select .= "<option value='sell' selected>매출</option>";
			else $form_select .= "<option value='sell'>매출</option>";

			if($sel == "buy") $form_select .= "<option value='buy' selected>매입</option>";
			else $form_select .= "<option value='buy'>매입</option>";

			if($sel == "personal") $form_select .= "<option value='personal' selected>일반</option>";
			else $form_select .= "<option value='personal'>일반</option>";

			$form_select .= "</select>";
			return $form_select;
		}

		$body = str_replace("{business_type}",_form_select_business_type("business_type",$inout,$css_textbox),$body);


		$query = "select * from `sales_business` ";
		if($business_country){
			$query .= "where `country`='$business_country' ";
		}
		$query .= "order by regdate desc";
		echo $query."<br>";
		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'></td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>국가</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>거래처</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>대표자</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>연락처</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>통화</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매출액</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매입액</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";

				if($rows->enable) {
					$enable = "<a href='#' onclick=\"javascript:business_mode('disable','".$rows->Id."')\">▣</a>";
					$business_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->business."</a>";
				} else {
					$enable = "<a href='#' onclick=\"javascript:business_mode('enable','".$rows->Id."')\">□</a>";
					$business_name  = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->business."</a></span>";
				}
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'>".$enable."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$rows->country."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>$business_name</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->president."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->currency."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_sell.php?business_id=".$rows->Id."'>".$rows->balance_sell."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_buy.php?business_id=".$rows->Id."'>".$rows->balance_buy."</a></td>";
				$list .= "</tr></table>";

				
			}

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
