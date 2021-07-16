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
	/*
	function _listbar($_list_num,$_block_num,$limit,$total){

		// $code = _formdata("cate");
		

		$total_list = intval( $total / $_list_num ); // 전페 리스트 수
		$total_block = intval( $total_list / $_block_num ); // 전체 블럭 수
		$pageMenu = "";
		$pre = ""; $next = "";

		$pageMenu = "";
	   
		// 처음 데이터가 아닌경우, 처음으로 이동 버튼 생성.
		if($limit != 0) $pageMenu .= "[<a href='#' onclick=\"javascript:pagelist('0')\">First</a>] "; // 처음 테이터

		// 현재 위치의 list 값 체크
		$current_list = intval( $limit / $_list_num );
		// 현제 위치의 block값 체크
		$current_block = intval( $current_list / $_block_num );

		if( $current_block >0) {
			// $pre = ($current_block - 1) * $_block_num * $_list_num; 
			$pre = $current_block * $_block_num * $_list_num - $_list_num; 
			$pageMenu .= "[<a href='#' onclick=\"javascript:pagelist('".$pre."')\">Pre($pre)</a>] "; // 이전 블럭 
		}

		
		$i = $current_block * $_block_num; //현재 블럭의 시작
		$count = $i + $_block_num; // 블럭 크기많큼 표기 loop
		if($count>$total_list) $count = $total_list; // 만일 제일 마지막 loop가, total보다 적을때, 마지막을 total로 지정 
		for(;$i<$count; $i++){
			$j = $i * $_list_num;
				// if($limit == $j) $pageMenu .= "[<b>$i</b>] "; else $pageMenu .= "[<a href='".$_SERVER['PHP_SELF']."?limit=$j'>$i</a>] ";
				//  
			if($limit == $j){
				$pageMenu .= "[<b>$j</b>] "; 
			} else {
				$pageMenu .= "[<a href='#' onclick=\"javascript:pagelist('".$j."')\">$j</a>] ";
			}
		}


		if( ($j + $_list_num) < $total) {
			$next = $j + $_list_num;
			//$next = $pre + $_block_num * $_list_num * 2; 
			//$next = $current_block + $_list_num*$_block_num;
			$pageMenu .= "[<a href='#' onclick=\"javascript:pagelist('".$next."')\">Next($next)</a>] "; // 다음 블럭 
		}

		$last = $total_list * $_list_num;
		if($limit != $last) $pageMenu .= "[<a href='#' onclick=\"javascript:pagelist('".$last."')\">Last</a>]"; // 마지막 데이터

		return "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				<tr><td style='font-size:12px;padding:10px;' align=center>".$pageMenu."</td></tr></table>";
	}
	*/
	
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		include "./sales.php";


		$javascript = "<script>
			function company_mode(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_sales_company_editup.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#company').html(data);
                        }
                    }); 	
            }

			function edit(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_sales_company_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#company').html(data);
                        }
                    }); 	
            }
                
            function pagelist(limit){
                	var search = document.business.searchkey.value;
                  	$.ajax({
                        url:'/ajax_sales_company.php?limit='+limit+'&search='+search,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#company').html(data);
                        }
                    }); 	
            }

            $('#inout').on('change',function(){
      			var search = document.business.searchkey.value;
                $.ajax({
                    url:'/ajax_sales_company.php?search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#company').html(data);
                    }
                }); 	
   			});

			$('#company_country').on('change',function(){
      			var search = document.business.searchkey.value;
                $.ajax({
                    url:'/ajax_sales_company.php?search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#company').html(data);
                    }
                }); 	
   			});

			$('#btn_search').on('click',function(){
				var search = document.business.searchkey.value;
        		$.ajax({
                    url:'/ajax_sales_company.php?search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#company').html(data);
                    }
                }); 

        		
    		});

			$('#com_search').on('keydown',function(e){         
        	if(e.keyCode == 13){
            	e.preventDefault();
            	var search = document.business.searchkey.value;
        		$.ajax({
                    url:'/ajax_sales_company.php?search='+search,
                    type:'post',
                    data:$('form').serialize(),
                    success:function(data){
                        $('#company').html(data);
                    }
                }); 
        	}
    		});

        </script>";


		$body = $javascript._skin_page($skin_name,"sales_company");

		$company_country = _formdata("company_country");
		// echo "country = $company_country <br>";
		$inout = _formdata("company_type"); if(!$inout) $inout = _formdata("inout");
		// echo "inout = $inout <br>";
		
		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='company' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>
					   			<input type='hidden' name='inout' value='$inout'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		// $body = str_replace("{new}",_button_css("Add","scm_shop_goods_edit.php?limit=$limit&code=$country","btn_css_add"),$body);	
		$button ="<input type='button' value='NEW' onclick=\"javascript:edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);

		$searchkey = _formdata("searchkey");
		// echo "searchkey = $searchkey";
		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' id=\"com_search\" style=\"".$css_textbox."\">",$body);
		$button_search ="<input type='button' value='검색' id=\"btn_search\" style=\"".$css_btn_gray."\" >";           
		// $button_search = "<a href='#' onclick=\"javascript:goodlist('0')\">Search</a>";
		$body = str_replace("{search}",$button_search,$body);


		// 국가 선택 
		$query = "select * from `shop_country` ";
		if($rowss = _mysqli_query_rowss($query)){	
			$_form_select_country = "<select name='company_country' style='$css_textbox' id=\"company_country\">";			
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				
				$title = stripslashes($rows1->name);
				$name = json_decode($title);
						
				if($company_country == $rows1->code) $_form_select_country .= "<option value='".$rows1->code."' selected>".$name->$site_language."(".$rows1->code.")</option>";
				else $_form_select_country .= "<option value='".$rows1->code."'>".$name->$site_language."(".$rows1->code.")</option>";
			}

			$_form_select_country .= "</select>";
			
		}
	
		$body = str_replace("{compnay_country}",$_form_select_country,$body);


		function _form_select_company_type($name,$sel,$css){
			
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

		$body = str_replace("{company_type}",_form_select_company_type("company_type",$inout,$css_textbox),$body);

		

		$query = "select * from `sales_company` ";

		$business = _formdata("business");
		if($searchkey || $business || $inout || $company_country){
			// where 검색 query 필요 
			$query .= "where ";

			// 지정 사업장이 있는 경우
			if($business) $query .= "and `business`='$business' ";

			// 거래 구분이 있는 경우,
			if($inout) $query .= "and `inout`='$inout' ";

			// 거래구분 + 국가 선택이 있는 경우
			if($company_country) $query .= "and `country`='$company_country' ";

			// 검색어  
			if($searchkey) $query .= "and `company` like '%$searchkey%' ";

			$query = str_replace("where and", "where ", $query);

		}
		/*
		if($business) {
			// 지정 사업장이 있는 경우
			$query .= "where `business`='$business' ";

			// 거래 구분이 있는 경우,
			if($inout) $query .= "and `inout`='$inout' ";
				
			// 거래구분 + 국가 선택이 있는 경우
			if($company_country) $query .= "and `country`='$company_country' ";

		} else {
			if($inout) {
				// 거래 구분이 있는 경우,
				$query .= "where `inout`='$inout' ";
				// 거래구분 + 국가 선택이 있는 경우
				if($company_country) $query .= "and `country`='$company_country' ";
		
			} else if($company_country){
				// 국가 선택이 있는 경우
				$query .= "where `country`='$company_country' ";
				
			}
		}
		*/

		$query .= "order by regdate desc ";
		// echo $query."<br>";

		$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

		$_list_num = 10;
		$limit = _formdata("limit");
		if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// 검색된 데이터 내에서 , limit 설정 



		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'></td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>국가</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>거래처</td>";
			
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>연락처</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>통화</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매출액</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매입액</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];	

				if($rows->inout == "sell") $comtype = "←";
				else if($rows->inout == "buy") $comtype = "→";
				else if($rows->inout == "buysell") $comtype = "↔";
				else if($rows->inout == "personal") $comtype = "☺";


				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";

				if($rows->enable) {
					$enable = "<a href='#' onclick=\"javascript:company_mode('disable','".$rows->Id."')\">▣</a>";
					$company_name = "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->company."</a>";
				} else {
					$enable = "<a href='#' onclick=\"javascript:company_mode('enable','".$rows->Id."')\">□</a>";
					$company_name  = "<span style=\"text-decoration:line-through;\"><a href='#' onclick=\"javascript:edit('edit','".$rows->Id."','$limit')\">".$rows->company."</a></span>";
				}
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='20'>".$enable."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30'>".$rows->country."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>$comtype  $company_name</td>";
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->phone."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->currency."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_sell.php?company_id=".$rows->Id."'>".$rows->balance_sell."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_buy.php?company_id=".$rows->Id."'>".$rows->balance_buy."</a></td>";
				$list .= "</tr></table>";				
			}

			$listbar = _listbar($_list_num,$_block_num,$limit,$total);
			$body = str_replace("{list}", $list.$listbar, $body);
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
