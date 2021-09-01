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
			function edit(mode,uid){
					//alert(\"edit\");
                  	$.ajax({
                        url:'/ajax_sales_bom_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
                
            function list(limit){
                	var search = document.bom.searchkey.value;
                  	$.ajax({
                        url:'/ajax_sales_bom.php?limit='+limit+'&search='+search,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('.mainbody').html(data);
                        }
                    }); 	
            }
        </script>";


		$body = $javascript._skin_page($skin_name,"sales_bom");

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='manager' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
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



		$query = "select * from `sales_bom` order by regdate desc";
		if($rowss = _sales_query_rowss($query)){

			$list  = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>이름</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >이메일</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>부서</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>전화</td>";
			$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>팩스</td>";
			$list .= "</tr></table>";

			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				/*
							if($rows[images]) $listform = str_replace("{images}","<img src='$rows[images]' border=0 width=50>","$listform");
					else $listform = str_replace("{images}","","$listform");
					
					if($rows[mem] != $MEM[Id] && $rows[auth] != "on") $auth ="<em style='font-size:10px;padding:1px;background-color:#aaaaaa;'><a href='sales_goods_auth.php?UID=$rows[Id]'>승인요청</a></em>";	
					
					
					$listform = str_replace("{goodname}","<a href='sales_goods_edit.php?mode=edit&UID=$rows[Id]'>$rows[name]</a> $auth",$listform);
					$listform = str_replace("{sell}","$rows[prices_sell]","$listform");
					$listform = str_replace("{stock}","$rows[stock]","$listform");
					$listform = str_replace("{bom}","<a href='sales_bom_parts.php?UID=$rows[Id]'>+PARTS</a>","$listform");
	    			$list .= $listform;
				*/
				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->lastname.$rows->firstname."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>
								$comtype  <a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\">".$rows->email."</a> </td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->part."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_sell.php?company_id=".$rows->Id."'>".$rows->balance_sell."</a></td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <a href='sales_trans_buy.php?company_id=".$rows->Id."'>".$rows->balance_buy."</a></td>";
				$list .= "</tr></table>";

				
			}
			$body = str_replace("{list}", $list, $body);
		} else {
			$msg = "담당자 목록이 없습니다.";
			$body = str_replace("{list}", $msg, $body);
		}	

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	



	
?>
