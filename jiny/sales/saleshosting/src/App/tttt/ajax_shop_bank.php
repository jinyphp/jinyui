<?
	//*  OpenShopping V2.1
	//*  Program by : hojin lee

	// update : 2016.01.18 = 코드정리 

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/css.php";

	include "./func/error.php";
	include "./func/goods.php";
	include "./func/members.php";
	include "./func/orders.php";

	


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		// 내부 스크립트 설정
		
		$javascript = "<script>
			function edit(mode,uid){
                  	$.ajax({
                        url:'/ajax_shop_bank_edit.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);
                        }
                    }); 	
            }
                
            function mode(mode,uid){
                  	$.ajax({
                        url:'/ajax_shop_bank_editup.php?uid='+uid+'&mode='+mode,
                        type:'post',
                        data:$('form').serialize(),
                        success:function(data){
                            $('#mainbody').html(data);
                        }
                    }); 	
            }
        </script>";
	


		// 스킨템플릿 읽어오기
		$body = $javascript._skin_page($skin_name,"shop_bank");
		
		$mode = _formmode();
		$limit = _formdata("limit"); 
	
		// Form 설정
		$body = str_replace("{formstart}","<form name='bank' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		
	
		$button ="<input type='button' value='은행추가' onclick=\"javascript:edit('new','0','$limit')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{new}",$button,$body);
		
		$query = "select * from `shop_bank` ";
		$query .="order by regdate desc";
		if($rowss = _sales_query_rowss($query)){	

			$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\">은행명</td>			
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">swiff</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\">계좌번호</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >예금주</td>
					</tr>
					</table>";

			for($i=0,$total_prices=0,$sub_prices=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				if($rows->enable) {
					$enable = "<a href='#' onclick=\"javascript:mode('disable','".$rows->Id."')\">▣</a>";
				} else {
					$enable = "<a href='#' onclick=\"javascript:mode('enable','".$rows->Id."')\">□</a>";
				}

				$list .= "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\">$enable <a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\" >".$rows->bankname."</a></td>			
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\">".$rows->swiff."</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"150\" >".$rows->banknum."</td>
					<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->bankuser."</td>
					</tr>
					</table>";

				


			}

			$body = str_replace("{payment_list}",$list,$body);		

		} else {
			$msg = "결제 목록이 없습니다.";
			$body = str_replace("{payment_list}",$msg,$body);
		}
		
		echo $body;	
		
	} else {
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


?>